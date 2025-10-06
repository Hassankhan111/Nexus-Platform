<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Symfony\Contracts\Service\Attribute\Required;
use Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
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
            'message' => 'Validation error',
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
    $validator = validator::make($request->all(),
    [
        'email' => 'required|email',
        'password' => 'required|min:5',
        'role' => 'required|in:entrepreneur,investor', 
    ]);

    if($validator->fails())
    {
         return response()->json([
            'status' => false,
            'message' => 'Validation error',
            'errors' => $validator->errors()->all()
        ], 422);
    }

     $data = User::where('role',$request->role)->
                   where('email',$request->email)->first();

    // If user not found or password mismatch
    if (!$data || !Hash::check($request->password, $data->password)) {
         return response()->json([
            'status'  => false,
            'message' => 'Invalid credentials',
            'user' =>$data
         ],401);
        }

         $token = $data->createToken("API Token")->plainTextToken;

        return response()->json([
            'status'  => true,
            'message' => 'Login Successfully',
            'token' => $token,
            'token_type' => 'bearer',
            'role'=> $data->role
        ], 200);
    }


public function logout(Request $request)
{
   $user = $request->user();
   $user->tokens()->delete();
   

   if($user){
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


}

