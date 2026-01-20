<?php

use App\Http\Controllers\AuthController;
//---------------dashboard------------------------------
//----------------investor-------------------------------
use App\Http\Controllers\investor\investorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\enterprenure\enterprenureController;
use App\Http\Controllers\notificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\cheatController;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Sanctum;
use Phiki\Grammar\Injections\Group;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


//create a new user as investor and entreprenure
Route::POST('signup', [AuthController::class, 'register']);
//login user as a investor and entreprenure
Route::POST('login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->Group(function () {
  //-----------------------profile api's-----------------------------------------
  //logout user
  Route::POST('logout', [AuthController::class, 'logout']);
  //create profile
  Route::POST('create', [AuthController::class, 'create']);
  //---------------profile api's-------------------------------------------------------
//change password
  Route::POST('changepassword/{id}', [AuthController::class, 'password']);
  //update user
  Route::POST('update/{id}', [AuthController::class, 'update']);
  //show profile
  Route::get('profile/{id}', [AuthController::class, 'showprofile']);
  //delete profile
  Route::POST('delete/{id}', [ProfileController::class, 'destory']);

  //----------------------startup aND investor SEARCH--------------------------------------------
  Route::GET('startup_search', [enterprenureController::class, 'search']);
  Route::GET('investor_search', [investorController::class, 'search']);

  //----------------------startup api's entreprenure--------------------------------------------
  Route::POST('enterprenure/{id}', [enterprenureController::class, 'show']);

  Route::GET('entreprenure_search', [enterprenureController::class, 'search']);

  Route::POST('addstartup/{id}', [enterprenureController::class, 'create']);

  Route::PUT('update-profile/{id}', [enterprenureController::class, 'update']);

  //-----------------Investor Apis startup------------------------------------------------------
  route::POST('addinvestor/{id}', [investorController::class, 'investorCreate']);
  Route::GET('investor_portfolio/{id}', [investorController::class, 'InvestorShow']);
  Route::GET('updateinvestor/{id}', [investorController::class, 'Investorupdate']);


  //----------------payments-----------------------------------------------------------------------
  Route::post('payments', [PaymentController::class, 'store']); // create payment
  Route::get('showpayments/{id}', [PaymentController::class, 'index']); // list user payments

  //------------------dashboard----------------------------------------------------------------------------
  Route::get('Dashboardentreprenure', [DashboardController::class, 'Allentreprenure']);
  Route::get('Dashboardinvestor', [DashboardController::class, 'Allinvestors']);

  
  //------------------Appointment Booking----------------------------------------------------------------------------
  Route::post('createappointment', [AppointmentController::class, 'createappintment']);
  Route::get('appointment/{id}', [AppointmentController::class, 'index']);
  //startup view appointments
  Route::get('startupappointment/{id}', [AppointmentController::class, 'appointmentstartup']);

//---------send message and notification ---------------------------------------------------------------------------
 route::post('message',[notificationController::class,'sendmessage']);
 route::GET('newnotification',[notificationController::class,'usernotification']);
 route::post('changemark/{id}',[notificationController::class,'markasread']);

 // send message cheat controll
 route::post('sendmessage',[cheatController::class,'sendmessage']);
 

});

//------------------get user online-------------------------------------------
route::middleware('auth:sanctum')->get('online', function (Request $request) {
  return response()->json([
    'success' => true,
    'data' => $request->user(),
  ]);
});
//get user id and role
route::middleware('auth:sanctum')->get('user', function (Request $request) {
  return response()->json([
    'success' => true,
    'data' => $request->user(),
  ]);
});
route::middleware('auth:sanctum')->get('userlist', function (Request $request) {
  return response()->json([
    'success' => true,
    'data' => \App\Models\User::where('id', '!=', auth()->id())->get(),
  ]);
});


//------------------get startup-------------------------------------------
Route::GET('startup', [investorController::class, 'index']);
//-----------------INVESTOR SHOW ----------------------------------------
