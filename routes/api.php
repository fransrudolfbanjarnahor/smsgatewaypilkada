<?php

use Illuminate\Http\Request;
use App\ConfigApp;
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

// Route::middleware('auth:api')->group(function () {
//     Route::get('/v1/test','ApiController@test');
// });
// Route::middleware('auth:api')->get('/v1/config', function (Request $request) {
//     $config = ConfigApp::where('user_id',$request->user()->id)->get();
//     return $config;
// });

Route::middleware('auth:api')->group(function () {
    Route::get('/v1/config','ApiController@getConfig');
    Route::get('/v1/lokasitps','ApiController@getTPS');
    Route::get('/v1/sms','ApiController@getSms');
    Route::get('/v1/peserta','ApiController@getPeserta');
    Route::get('/v1/test','ApiController@test');
    Route::post('/v1/smsdata','ApiController@smsdata');
    Route::post('/v1/petugas','ApiController@petugas');
});

// Route::post('/v1/smsdata','ApiController@smsdata')->middleware('client_credentials');

// Route::get('/v1/test', ['middleware' => 'password','uses'=>'ApiController@test']);

// Route::post('/v1/smsdata', 'ApiController@smsdata');
// Route::get('/v1/test', 'ApiController@test');
