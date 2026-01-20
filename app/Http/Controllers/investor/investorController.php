<?php

namespace App\Http\Controllers\investor;

use App\Http\Controllers\Controller;
use App\Models\investor_startup;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\startup;
class investorController extends Controller
{
    //add investor
    public function investorCreate(Request $request, string $id)
    {
        $validater = Validator::make($request->all(), [
            'inv_name' => 'required|string|max:1000',
            'company' => 'required|string',
            'inv_location' => 'required|string',
            'inv_industry' => 'required|string',
            'year' => 'required|digits:4|integer',
            'inv_teamsize' => 'required|integer',
            'funding_ned' => 'required|numeric',
            'pitch_summ' => 'required|string',
            'inv_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);


        if ($validater->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validater->errors()->all()
            ], 422);
        }
        $investor = $validater->validated();

        $investor['user_id'] = Auth::id();

        if ($request->hasFile('inv_image')) {
            $investor['inv_image'] = $request->file('inv_image')->store('investor', 'public');
        }
        //dd($data, Auth::id());

        $startup = investor_startup::create($investor);

        return response()->json([
            'status' => true,
            'message' => 'profile created successfully',
            'investor' => $startup->load('user')
        ], 201);
    }

    //show investor profile
    public function InvestorShow($id)
    {
        $user = user::with(['inv_startup'])->find($id);



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
        $search = $request->input('search', '');

        // Query your model based on search
        $investors = investor_startup::where('inv_name', 'like', "%{$search}%")
            ->orWhere('pitch_summ', 'like', "%{$search}%")
            ->orWhere('inv_teamsize', 'like', "%{$search}%")
            ->orWhere('company', 'like', "%{$search}%")
            ->orWhere('funding_ned', 'like', "%{$search}%")
            ->orWhere('inv_image', 'like', "%{$search}%")
            ->select('inv_name', 'inv_teamsize', 'pitch_summ', 'funding_ned', 'inv_industry', 'company','inv_image')
            ->get();

        // Return JSON response
        if ($investors->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => $search . " " .'Not Found',
            ],404);
        }

        return response()->json([
            'status' => true,
            'investors' => $investors
        ],200);



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
