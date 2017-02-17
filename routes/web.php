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

Route::get('/home', 'HomeController@index');
Route::get('/kembalibuku/{id}','BukuController@pinjamselesai');
Route::get('/pinjam/{id}','BukuController@pinjam');
Route::get('/accpinjam/{id}','BukuController@accpinjam');
Route::get('/tambahbuku','BukuController@tambahbuku');
Route::post('/tambahbuku','BukuController@simpanbuku');
Route::post('/cari','BukuController@caribuku');
