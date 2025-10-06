<?php

namespace App\Http\Controllers\investor;

use App\Http\Controllers\Controller;
use App\Models\investor_startup;
use Illuminate\Http\Request;
use App\Models\startup;
use App\Models\User;
use App\Models\profile;

class investorController extends Controller
{
        public function InvestorShow($id)
    {
        $user = investor_startup::with(['user'])
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
    $investors = investor_startup::where('inv_name', 'like', "%{$search}%")
        ->orWhere('pitch_summ', 'like', "%{$search}%")
        ->orWhere('inv_teamsize', 'like', "%{$search}%")
        ->orWhere('company', 'like', "%{$search}%")
        ->orWhere('funding_ned', 'like', "%{$search}%")
        ->select( 'inv_name', 'inv_teamsize', 'pitch_summ', 'funding_ned','inv_industry','company')
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
