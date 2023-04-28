<?php

use App\Comment;
use App\Product;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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



Auth::routes();
Route::get('/auth/google' ,'Auth\GoogleAuthController@redirect')->name('auth.google');
Route::get('/auth/google/callback' ,'Auth\GoogleAuthController@callback');



Route::get('/home', 'HomeController@index')->name('home');
Route::get('/secret' , function() {
    return 'secret';
})->middleware(['auth' , 'password.confirm']);


Route::get('products' , 'ProductController@index');
Route::get('products/{product}' , 'ProductController@single');
Route::post('comments' , 'HomeController@comment')->name('send.comment');
Route::post('/cart/add/{product}' , 'CartController@addToCart')->name('cart.add');
