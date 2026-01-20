<?php

use App\Http\Controllers\CheatController;
use App\Http\Controllers\pusherController;
use Illuminate\Support\Facades\Route;



/* Auth controloer-----------------------------------------------------------------------------------------*/ 

//view route for register page
route::view('register','Auth.register');

//login page route as default route investor and entreprenure
Route::get('/', function () {
    return view('Auth.login');
});
//seting page route profile
route::view('setting','Auth.setting');


//----------dashboard-=----------------------------
route::get('Dashboard/Investor', function(){
    return view('dashboard.Investor');
});

route::get('Dashboard/entrepreneure', function(){
    return view('dashboard.entrepreneur');
});

//---------investor and entreprenure messages
route::view('messages','messages.message');
//---------investor and entreprenure notifications
route::view('notifications','notifications.notification');


//---------investor appointments--------------
route::view('Appointment','appointment.Appointment');
route::view('meetings','appointment.metting');
// entreprenure upcoming appointments
route::view('Upcomingappointment','appointment.upcoming');

//---------investor and entreprenure chats
route::view('chats','chats.chat');

//----------investor and entreprenure startup-=----------------------------
Route::view('entreprenures', 'entreprenure.startup');
Route::view('investors', 'investor.investors');

//payment ---------------------------------------------------------------
Route::view('payments', 'Auth.payment');
Route::view('showpayments/{id}', 'Auth.paymentdetails')->name('showpayments');


//investor portfortfolio-----------------------------------------------------------------------
Route::view('investor_portfolio/{id}', 'investor.investor_startup');
Route::view('addInvestor/{id}', 'investor.addInvestor');
Route::view('updateInvestor/{id}', 'investor.updateInvestor');


//entreprenure portfolio ----------------------------//
route::view('profile/entreprenure/{id}','Portfolio.entreprenure');
route::view('add-profile/{id}','Portfolio.addportfolio');
route::view('update-profile/{id}','Portfolio.updateportfolio');

//investors and startup profile ----------------------------//
route::view('investor/profile/{id}','profile.investor-profile');
route::view('startup/profile/{id}','Profile.startup-profile');

//cheat controller 
route::post('sendmessage',[CheatController::class,'sendmessage']);

