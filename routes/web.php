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

Route::get('/', function () {
    return view('login');
});
Route::get('welcome', function(){
    return view('welcome');
});
Route::get('glogin',array(
    'as'    =>'glogin',
    'uses'  =>'UserController@googlelogin'
));
//Route::get('google-user',array(
//    'as'    =>'user.glist',
//    'uses'  =>'UserController@listGoogleUser'
//));