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
// Home
Route::get('/', 'Auth\LoginController@home')->name('home');

//Admin Panel

Route::get('/', 'Auth\LoginController@home')->name('home');

//User 



//Admin








// User

Route::get('/users/{id}', 'ItemController@show');
Route::patch('/users/{id}', 'ItemController@update');
Route::delete('/users/{id}', 'ItemController@destroy');
Route::get('/users/{id}/edit', 'ItemController@edit');

// API

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('adminLogin');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');



Route::get('/admin-panel/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/admin-panel/login', 'Auth\LoginController@adminLogin');

// All routes for Products

//index
Route::get('/products', 'App\Http\Controllers\ProductController@index');

// All products

// /product/{id}
Route::get('/products/{id}', 'App\Http\Controllers\ProductController@show');