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
Route::get('/', function(){
    return view('pages.home');
})->name('home');

//Admin Panel

Route::get('/admin-panel', function(){
    return view('pages.admin.home');
})->name('homeAdminPanel')->middleware('auth:admin');

//User 

Route::post('login', 'Auth\LoginController@login')->name('userLogin');
Route::get('/users/{id}', 'UserController@show')->name('userView');
Route::patch('/users/{id}', 'UserController@update')->name('userUpdate');
Route::delete('/users/{id}', 'UserController@destroy')->name('userDelete');
Route::get('/users/{id}/edit', 'UserController@edit')->name('userUpdateForm');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('userRegisterForm');
Route::post('login', 'Auth\LoginController@login')->name('userLogin');
Route::post('register', 'Auth\RegisterController@register')->name('userRegister');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

//Admin

Route::get('/admin-panel/login', 'Auth\LoginController@showLoginForm')->name('adminLoginForm');
Route::post('/admin-panel/login', 'Auth\LoginController@adminLogin')->name('adminLogin');


//Products
Route::get('/api/products', 'ProductController@searchAPI')->name('productSearchAPI');
Route::get('/products', function(){
    return view('pages.searchProduct');
})->name('listProducts');
Route::get('/products/{id}', 'App\Http\Controllers\ProductController@show');

Route::get('teste/{id}', 'CategoryController@getAllSubCategories');