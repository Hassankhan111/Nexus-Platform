<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\investor\investorController;
use App\Http\Controllers\enterprenure\enterprenureController;
use App\Http\Controllers\ProfileController;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Sanctum;
use Phiki\Grammar\Injections\Group;



Route::POST('signup',[AuthController::class,'register']);
  //login user
Route::POST('login',[AuthController::class,'login']);


Route::middleware('auth:sanctum')->Group(function(){
//-----------------------profile api's-----------------------------------------
  //logout user
Route::POST('logout',[AuthController::class,'logout']);
//create profile
Route::POST('create',[ProfileController::class,'create']);
//update profile
Route::POST('update/{id}',[ProfileController::class,'update']);
//show profile
Route::POST('profile/{id}',[ProfileController::class,'show']);
//delete profile
Route::POST('delete/{id}',[ProfileController::class,'destory']);

//----------------------startup api's investor--------------------------------------------
Route::GET('investor/{id}',[investorController::class,'InvestorShow']);
Route::GET('investor_search',[investorController::class,'search']);
//----------------------startup api's entreprenure--------------------------------------------
Route::POST('enterprenure/{id}',[enterprenureController::class,'show']);
Route::GET('entreprenure_search',[enterprenureController::class,'search']);

});


route::middleware('auth:sanctum')->get('user',function(Request $request){
  return response()->json([
    'success' => true,
    'data' => $request->user()
  ]);
});


//------------------get startup-------------------------------------------
Route::GET('startup',[investorController::class,'index']);
//-----------------INVESTOR SHOW ----------------------------------------
