<?php

namespace App\Http\Controllers\enterprenure;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Startup;
use App\Models\User;
use function PHPUnit\Framework\isEmpty;


class enterprenureController extends Controller
{
    public function show($id)
    {
        $user = user::with(['startup'])->find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'startup Not Found'
            ], 422);
        }

        return response()->json([
            'status' => true,
            'startup' => $user
        ], 200);

    }

    //search ----------------------------------------------------------------------------
    public function search(Request $request)
    {
        // Get ?search= value from URL
        $search = $request->query('search', '');

        // Query your model based on search
        $startup = startup::where('startup_name', 'like', "%{$search}%")
            ->orWhere('pitch_summary', 'like', "%{$search}%")
            ->orWhere('location', 'like', "%{$search}%")
            ->orWhere('industry_name', 'like', "%{$search}%")
            ->orWhere('company_name', 'like', "%{$search}%")
            ->select('startup_name', 'location', 'pitch_summary', 'company_name', 'industry_name','image')
            ->get();
         
            if($startup->isEmpty()){
            return response()->json([
            'status' => false,
            'message' =>  $search . " ". 'Not Found',
           ],404); }
            
        // Return JSON response
        return response()->json([
            'status' => true,
            'startup' =>  $startup
        ],200);
    }

    //create startups
    public function create(Request $request, string $id)
    {
        $validater = Validator::make($request->all(), [
            'startup_name' => 'required|string|max:1000',
            'company_name' => 'required|string',
            'location' => 'required|string',
            'industry_name' => 'required|string',
            'founded_year' => 'required|digits:4|integer',
            'team_size' => 'required|integer',
            'funding_need' => 'required|numeric',
            'pitch_summary' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);


        if ($validater->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validater->errors()->all()
            ], 422);
        }
        $startups = $validater->validated();

        $startups['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $startups['image'] = $request->file('image')->store('profiles', 'public');
        }
        //dd($data, Auth::id());

        $startup = Startup::create($startups);

        return response()->json([
            'status' => true,
            'message' => 'profile created successfully',
            'startups' => $startup->load('user')
        ], 201);
    }

    //update startups
  public function update(Request $request, $id)
{
    // Fetch the startup entry
    $startup = Startup::findOrFail($id);

    $validator = Validator::make($request->all(), [
        'startup_name'   => 'required|string|max:1000',
        'company_name'   => 'required|string',
        'location'       => 'required|string',
        'industry_name'  => 'required|string',
        'founded_year'   => 'required|digits:4|integer',
        'team_size'      => 'required|integer',
        'funding_need'   => 'required|numeric',
        'pitch_summary'  => 'required|string',

        // Optional image
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status'  => false,
            'message' => 'Validation error',
            'errors'  => $validator->errors()->all()
        ], 422);
    }

    $data = $validator->validated();
     dd($data);
    // Handle image upload
    if ($request->hasFile('image')) {

        // Delete old image
        if ($startup->image && Storage::disk('public')->exists($startup->image)) {
            Storage::disk('public')->delete($startup->image);
        }

        // Upload new image
        $data['image'] = $request->file('image')->store('startups', 'public');
    }

    // Update startup
    $startup->update($data);

    return response()->json([
        'status'  => true,
        'message' => 'Startup updated successfully',
        'startup' => $startup->fresh(),
    ]);
}

}
