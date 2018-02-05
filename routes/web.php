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

// Route::get('/', function () {
//     return view('index');
// });


Route::get('getmahasiswa', 'mahasiswaController@getmahasiswa');
Route::post('addmahasiswa', 'mahasiswaController@store');
Route::get('mahasiswa/{id}', 'mahasiswaController@show');
Route::delete('mahaiswa/{id}','mahasiswaController@destroy');
Route::put('mahasiswa/{id}', 'mahasiswaController@update');

Route::get('{path}', function () {
    return view('index');
})->where( 'path', '[\/\w\.-]*' );

