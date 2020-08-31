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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::get('/token', 'Auth\LoginController@token')->name('token');
Route::group([['middleware' => ['auth:admin-api']],['middleware' => ['auth:kios-api']]], function() {
    Route::get('/kategori','KategoriController@all');
	Route::get('/kategori/{id}','KategoriController@show');
	Route::post('/kategori','KategoriController@store');
	Route::put('/kategori/{id}','KategoriController@update');
	Route::delete('/kategori/{id}','KategoriController@delete');

	Route::get('/produk','ProdukKontroller@all');
	Route::post('/pesan','ProdukKontroller@pesan');
	Route::post('/harga','ProdukKontroller@harga');
	Route::get('/produk/{id}','ProdukKontroller@show');
	Route::post('/produk','ProdukKontroller@store');
	Route::post('/produkExcel','ProdukKontroller@storeExcel');
	Route::post('/produk/{id}','ProdukKontroller@update');
	Route::delete('/produk/{id}','ProdukKontroller@delete');

	Route::get('/kios','KiosController@all');
	Route::get('/kota','KiosController@kota');
	Route::get('/kotaadmin','KiosController@kotaAdmin');
	Route::get('/kios/{id}','KiosController@show');
	Route::get('/kiosAdmin/{id}','KiosController@adminUser');
	Route::post('/kios','KiosController@store');
	Route::put('/kios/{id}','KiosController@update');
	Route::delete('/kios/{id}','KiosController@delete');

	Route::get('/konsumen','KonsumenKontroller@all');
	Route::get('/konsumen/{id}','KonsumenKontroller@show');
	Route::post('/konsumen','KonsumenKontroller@store');
	Route::put('/konsumen/{id}','KonsumenKontroller@update');
	Route::delete('/konsumen/{id}','KonsumenKontroller@delete');

	Route::get('/admin','AdminController@all');
	Route::get('/admin/{id}','AdminController@show');
	Route::post('/admin','AdminController@store');
	Route::put('/admin/{id}','AdminController@update');
	Route::delete('/admin/{id}','AdminController@delete');

	Route::get('/trx','TransaksiController@trx');
	Route::get('/grafis','TransaksiController@grafis');
	Route::get('/dashboard','TransaksiController@dashboard');
	Route::get('/transaksiCount','TransaksiController@transaksiCount');
	Route::get('/kiosCount','TransaksiController@kiosCount');
});