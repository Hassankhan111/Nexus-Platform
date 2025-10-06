<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Auth.login');
});

// --- Auth ------------------------------------------------------
route::get('login', function(){
    return view('Auth.login');
});

route::view('register','Auth.register');

//----------dashboard-=----------------------------
route::get('Investor', function(){
    return view('dashboard.Investor');
});

route::get('entrepreneure', function(){
    return view('dashboard.entrepreneur');
});
//----------investor-=----------------------------
route::view('Investor_','investor.investor_startup');
//route::view('Investors','investor.addInvestor');
Route::view('/investors/{id}', 'investor.investor')->name('investor.profile');

//----------entreprenure-=----------------------------

route::view('entreprenure_startup','entreprenure.intreprenure_startup');
route::view('/entrepreneur/{id}','entreprenure.entrepreneur');


//-----------------user profile ----------------------------//
//-----------------setting page -----------------------------//
route::view('setting','setting');

route::view('header','layout.header');
