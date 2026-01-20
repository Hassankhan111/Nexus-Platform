<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\profile;
use Symfony\Contracts\Service\Attribute\Required;
use Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //user sign up api as a investor and entreprenure
    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5',
            'role' => 'required|in:entrepreneur,investor',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'User email alredy exist',
                'errors' => $validate->errors()->all()
            ], 422);
        }

        $data = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // hash password
            'role' => $request->role,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'User registered successfully',
            'user' => $data
        ], 201);
    }

    //api for login
    public function login(Request $request)
    {
        $validator = validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required|min:5',
                'role' => 'required|in:entrepreneur,investor',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $data = User::where('role', $request->role)->
            where('email', $request->email)->first();

        // If user not found or password mismatch
        if (!$data || !Hash::check($request->password, $data->password)) {
            return response()->json([
                'status' => false,
                'message' => 'UserName or Password is incorrect',
                'user' => $data
            ], 401);
        }

        $token = $data->createToken("API Token")->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login Successfully',
            'token' => $token,
            'token_type' => 'bearer',
            'role' => $data->role
        ], 200);
    }
    //update user
     public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:225',
            'email' => 'required|email|max:225|unique:users,email,' . $id,
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
        $user->update($validated);

        return response()->json([
            'status' => true,
            'message' => ' User updated successfully',
            'user' => 'user'
        ], 200);
    }

    //logout api
    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();


        if ($user) {
            return response()->json([
                'status' => true,
                'message' => 'Logout successful'
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'User not authenticated'
        ], 401);
    }

    //create profile

    public function create(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'bio' => 'required|string|max:1000',
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

        $profiles = profile::create($data);

        return response()->json([
            'status' => true,
            'message' => 'profile created successfully',
            'profile' => $profiles->load('user')
        ], 201);
    }

    // Getprofile
    public function showprofile(string $id)
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


    //update profile
    /*public function update(Request $request, $id)
    {
        $profile = Profile::where('user_id', $id)->firstOrFail();
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:225',
            'email' => 'required|email|max:225|unique:users,email,' . $id,
            'bio' => 'required|string|max:1000',
            'startup_history' => 'sometimes|string',
            'investment_history' => 'sometimes|string',
            'preferences' => 'sometimes|string',
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
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        // 🔹 prepare profile data (remove user-specific fields)
        $profile_data = collect($validated)->except(['name', 'email'])->toArray();
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
    }*/


    public function password(Request $request, $id)
    {
        // Validate inputs
        $validator = Validator::make($request->all(), [
            'oldpass' => 'required',
            'newpass' => 'required|min:5|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        // Find the user by ID
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ], 404);
        }

        // Check if old password matches
        if (!Hash::check($request->oldpass, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Old password does not match'
            ], 422);
        }

        // Update password
        $user->password = Hash::make($request->newpass);
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Password updated successfully'
        ], 200);
    }

}

