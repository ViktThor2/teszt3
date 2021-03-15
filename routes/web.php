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
Route::get('/', 'IndexController@index')->name('index');

//ShopCart
Route::get('/kosar', 'ShopCartController@index')->name('scart.index');
Route::get('/kosarba/{itemId}/hozzaad', 'ShopCartController@add')->name('scart.add');
Route::get('/kosarba/{itemId}/plus', 'ShopCartController@plus')->name('scart.plus');
Route::get('/kosarba/{itemId}/minus', 'ShopCartController@minus')->name('scart.minus');
Route::get('/kosarba/{itemId}/torles', 'ShopCartController@destroyProduct')->name('scart.delete');
Route::get('/kosarba/urites', 'ShopCartController@destroyCart')->name('scart.delete.all');


// Order
Route::get('/rendeles', 'OrederController@create')->name('order.create');
Route::post('/rendeles', 'OrederController@store')->name('order.store');
Route::get('/rendeles/osszegzes/{orderID}', 'OrederController@finalCreate')->name('order.final.create');
Route::get('/rendeles/lead/{orderID}', 'OrederController@finalStore')->name('order.final.store');


// Product
Route::get('/termekek', 'ProductController@index')->name('product.index');
Route::get('/termek/{productId}', 'ProductController@show')->name('product.show');

// Product Filter
Route::post('/szures/ar', 'ProductController@filterPrice')->name('filter.price');
Route::get('/szures/szures', 'ProductController@filterProduct')->name('filter.product');


// Customer
Route::get('/regisztracio', 'CustomerController@create')->name('customer.create');
Route::post('/regisztracio', 'CustomerController@store')->name('customer.store');

// Login Customer
Route::middleware('customer_auth')->group(function() {
  Route::get('/profil/{customerId}/modosit', 'CustomerController@edit')->name('customer.edit');
  Route::put('/profil/{customerId}/modosit', 'CustomerController@update')->name('customer.update');
  Route::get('/profil/rendelesek', 'CustomerOrderController@myorders')->name('customer.order.pivot');
  Route::get('/profil/rendeles/{orderId}', 'CustomerOrderController@show')->name('myorder.show');
});

// Customer Auth
Route::get('/bejelentkezes', 'CustomerAuthController@create')->name('customer.auth.create');
Route::post('/bejelentkezes', 'CustomerAuthController@store')->name('customer.auth.store');
Route::delete('/kilepes', 'CustomerAuthController@destroy')->name('customer.auth.destroy');
