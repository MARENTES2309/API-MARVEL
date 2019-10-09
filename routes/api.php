<?php

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

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

    Route::post('/registro','API\AuthController@registro');
    Route::post('/login','API\AuthController@login');
    Route::middleware('auth:api')->post('/comics','API\AuthController@comics');
    Route::middleware('auth:api')->post('/personaje','API\AuthController@personaje');
    Route::middleware('auth:api')->post('/series','API\AuthController@series');
    Route::middleware('auth:api')->post('/stories','API\AuthController@stories');
    Route::middleware('auth:api')->post('/logout','API\AuthController@logout');
