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
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');




Route::post('/data/lokasitps/export', 'LokasiTPSController@export');
Route::post('/data/lokasitps/petugas', 'LokasiTPSController@setPetugas');
Route::post('/data/lokasitps/filter', 'LokasiTPSController@filter');
Route::get('/hasil', 'HasilController@index');

Route::resources([
    '/data/lokasitps'=>'LokasiTPSController',
    '/data/pesertapemilihan'=>'PesertaPemilihanController',
    '/data/sms'=>'SmsDataController',
     'configapp'=>'ConfigAppController',
 ]);

Route::get('/ref/propinsi', 'ReferensiController@getPropinsi');
Route::get('/ref/kabupatenkota/{prop_id}', 'ReferensiController@getKabupatenKota');
Route::get('/ref/kecamatan/{id}', 'ReferensiController@getKecamatan');
Route::get('/ref/kelurahandesa/{id}', 'ReferensiController@getKelurahanDesa');
Route::get('/ref/test', 'ReferensiController@test');



Route::get('/test/hasmanythrough', 'TestController@hasmanythrough');
Route::get('/test/hasmanythrough2', 'TestController@hasmanythrough2');
Route::get('/test/wherehas', 'TestController@wherehas');


// Route::post('api/v1/smsdata', function(Request $request) {
//     return $request->all);
// });