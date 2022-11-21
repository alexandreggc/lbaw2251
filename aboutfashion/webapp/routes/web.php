<?php

// Static Pages
Route::get('/', 'PageController@home')->name('home');
Route::get('/admin-panel','PageController@homePageAdmin')->name('homeAdminPanel')->middleware('auth:admin');

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
Route::get('/api/products/', 'ProductController@searchAPI')->name('productSearchAPI');
Route::get('/products', 'PageController@showSearchPage')->name('searchProductView');
Route::get('/products/{id}', 'App\Http\Controllers\ProductController@show')->name('productView');

//Order

Route::post('/api/cart/add', 'OrderController@addProductCart')->name('addProductCart')->middleware('auth:user');