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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// AUTH
Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@api_login');
Route::post('logout', 'Auth\LoginController@api_logout');

// POSTS
Route::get('posts', 'PostController@index');
Route::get('posts/{post}', 'PostController@show');
Route::group(['middleware' => 'auth:api'], function() {
    Route::post('posts', 'PostController@store');
    Route::put('posts/{post}', 'PostController@update');
    Route::delete('posts/{post}', 'PostController@destroy');
});
