<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Doctrine\Common\Lexer\Token;
use Illuminate\Http\Request;
use App\Models\profile;
use App\Models\User;




class ProfileController extends Controller
{

    //update profile
   public function update(Request $request, $id)
{
    $profile = Profile::where('user_id', $id)->firstOrFail();
    $user = User::findOrFail($id);

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:225',
        'email' => 'required|email|max:225|unique:users,email,'.$id, 
        'bio' => 'required|string|max:1000',
        'startup_history' => 'nullable|string',
        'investment_history' => 'nullable|string',
        'preferences' => 'nullable|string',
        'image' => 'sometimes|nullable|image|mimes:jpg,jpeg,png|max:2048',
        'location' => 'required|string|max:255',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Validation error',
            'errors' => $validator->errors()->all()
        ], 422);
    }

    $validated = $validator->validated();

    // 🔹 update USER table
    $user->update([
        'name'  => $validated['name'],
        'email' => $validated['email'],
    ]);

    // 🔹 prepare profile data (remove user-specific fields)
    $profile_data = collect($validated)->except(['name','email'])->toArray();
    $profile_data['user_id'] = $user->id;

    if ($request->hasFile('image')) {
        if ($profile->image && Storage::disk('public')->exists($profile->image)) {
            Storage::disk('public')->delete($profile->image);
        }
        $profile_data['image'] = $request->file('image')->store('profiles', 'public');
    }

    $profile->update($profile_data);

    return response()->json([
        'status' => true,
        'message' => 'Profile & User updated successfully',
        'profile' => $profile->fresh()->load('user')
    ], 200);
}

    // show profile 
    public function show($id)
    {
       $profile = Profile::join('users', 'profiles.user_id', '=', 'users.id')->where('profiles.user_id', $id)
                ->select(
                    'users.name',
                    'users.email',
                    'users.role',
                    'profiles.location',
                    'profiles.image',
                    'profiles.investment_history',
                    'profiles.bio',
                    'profiles.startup_history',
                    'profiles.preferences'
                )->first();

        if (!$profile) {
            return response()->json([
                'status' => false,
                'message' => 'User Not Found'
            ], 422);
        }

        return response()->json([
            'status' => true,
            'profile' => $profile
        ], 200);

    }



    //insert profile

    public function create(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'bio' => 'required|string|max:1000',
            'startup_history' => 'required|string',
            'investment_history' => 'required|integer',
            'preferences' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'location' => 'required|string|max:255',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validate->errors()->all()
            ], 422);
        }
        $data = $validate->validated();

         $data['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('profiles', 'public');
        }
//dd($data, Auth::id());

        $profiles = profile::create($data);

        return response()->json([
            'status' => true,
            'message' => 'profile created successfully',
            'profile' => $profiles->load('user')
        ], 201);
    }


    //delte profile
    public function destory(string $id)
    {
        $profiles = profile::where('profile_id', $id)->delete();
        if ($profiles) {
            return response()->json([
                'status' => true,
                'message' => 'Profile delete successfully'
            ], 201);
        }
        if (!$profiles) {
            return response()->json([
                'status' => false,
                'message' => 'user profile not found delete'
            ], 422);
        }
    }

}


