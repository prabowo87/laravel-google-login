<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//when user already registered to website
Route::get('/', function(){
    return view('index');
})->name('index');

//login page
Route::get('/login', function(){
    return view('login');
})->name('login');

//login process with google
Route::get('/googlelogin','UserController@loginWithGoogle')->name('googlelogin');

//logout page, also delete session
Route::get('logout', function(){
    return view('logout');
})->name('logout');