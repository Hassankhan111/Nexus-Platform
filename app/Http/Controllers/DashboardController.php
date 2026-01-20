<?php

namespace App\Http\Controllers;
use App\Models\startup;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function Allentreprenure(){
    $entreprenure = user::where('role','entrepreneur')->with('startup')->get();
     
    if($entreprenure){
        return response()->json([
        'status' =>true,
        'entrepreure' =>$entreprenure,
        ],200);
    } 

    if(!$entreprenure){
        return response()->json([
        'status' =>false,
        'message' =>'entreprenures does not found',
        ],404);
    }
  }
 //---------------investor---------------------------------------------------------------------------------
  public function Allinvestors(){
    $investor = User::where('role','investor')->with('inv_startup')->get();
     
    if($investor){
        return response()->json([
        'status' =>true,
        'investor' =>$investor,
        ],200);
    } 

    if(!$investor){
        return response()->json([
        'status' =>false,
        'message' =>'investor does not found',
        ],404);
    }
  }
}
