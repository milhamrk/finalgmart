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

Route::get('/produk/export', 'ProdukKontroller@export');
Route::get('/{any}', 'FrontController@index')->where('any', '.*');


// Route::get('/', function () {
//     return view('welcome');
// });