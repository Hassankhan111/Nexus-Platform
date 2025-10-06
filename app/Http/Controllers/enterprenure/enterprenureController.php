<?php

namespace App\Http\Controllers\enterprenure;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\startup;
use App\Models\User;
use App\Models\profile;

class enterprenureController extends Controller
{
         public function show($id)
    {
        $user = startup::with(['user'])
                ->find($id)->get();

        if (!$user) {       
            return response()->json([
                'status' => false,
                'message' => 'User Not Found'
            ], 422);
        }

        return response()->json([
            'status' => true,
            'user' => $user
        ], 200);

    }

      //search ----------------------------------------------------------------------------
    public function search(Request $request)
{
    // Get ?search= value from URL
    $search = $request->query('search', '');

    // Query your model based on search
    $investors = startup::where('startup_name', 'like', "%{$search}%")
        ->orWhere('pitch_summary', 'like', "%{$search}%")
        ->orWhere('location', 'like', "%{$search}%")
        ->orWhere('industry_name', 'like', "%{$search}%")
        ->orWhere('company_need', 'like', "%{$search}%")
        ->select( 'startup_name', 'location', 'pitch_summary', 'company_need','industry_name')
        ->get();

    // Return JSON response
    return response()->json([
        'status' => true,
        'user' => $investors
    ]);
}

    public function index()
    {
       $startup = startup::all();

        if (!$startup) {       
            return response()->json([
                'status' => false,
                'message' => 'startupt Not Found'
            ], 422);
        }

        
          return response()->json([
            'status' => true,
            'startup' => $startup
        ], 200);

    }
}
