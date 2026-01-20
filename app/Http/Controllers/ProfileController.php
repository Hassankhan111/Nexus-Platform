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

   

    // show profile 
    



    //insert profile

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


