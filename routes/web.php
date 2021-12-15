<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/cart/index', 'CartController@index')->name('cart.index');
Route::post('/cart/addtocart', 'CartController@addtocartajax')->name('cart.add');
Route::post('/cart/updatecart', 'CartController@updatecartajax')->name('cart.update');
Route::post('/cart/delcart', 'CartController@delcartajax')->name('cart.del');


