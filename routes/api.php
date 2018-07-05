<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Register new Users
Route::post('register', 'Api\Auth\RegisterController@register');

//Login Users
Route::post('login', 'Api\Auth\LoginController@login');

//Refresh
Route::post('refresh', 'Api\Auth\LoginController@refresh');

Route::middleware('auth:api')->group(function(){
    //Log Out
    Route::post('logout', 'Api\Auth\LoginController@logout');
    //Posts
    Route::get('posts', 'Api\PostController@index');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    dd("Hello World");
});
