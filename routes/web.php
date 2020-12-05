<?php

use Illuminate\Support\Facades\Auth;
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
    return view('home');
})->name('root');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/shop/dashboard', 'ShopController@dashboard')->name('shop.dashboard');
Route::get('/cart', 'CartController@index')->name('cart');

Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', 'CartController@index')->name('index');
});

Route::resources([
    'shop' => 'ShopController',
    'commodity' => 'CommodityController',
]);

