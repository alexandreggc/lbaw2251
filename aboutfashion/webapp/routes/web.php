<?php

// Static Pages
Route::get('/', 'PageController@homePage')->name('home');
Route::get('/admin-panel','PageController@homePageAdmin')->name('homeAdminPanel')->middleware('auth:admin');

//User 
Route::post('login', 'Auth\LoginController@login')->name('userLogin');
Route::get('/users/{id}', 'UserController@show')->name('userView');
Route::patch('/users/{id}', 'UserController@update')->name('userUpdate');
Route::delete('/users/{id}', 'UserController@delete')->name('userDelete');
Route::get('/users/{id}/edit', 'UserController@edit')->name('userUpdateForm');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('userRegisterForm');
Route::post('login', 'Auth\LoginController@login')->name('userLogin');
Route::post('register', 'Auth\RegisterController@register')->name('userRegister');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/order/{id}', 'OrderController@show')->name('orderDetails');

//Admin
Route::get('/admin-panel/login', 'Auth\LoginController@showLoginForm')->name('adminLoginForm');
Route::post('/admin-panel/login', 'Auth\LoginController@adminLogin')->name('adminLogin');


//Products
Route::get('/api/products/', 'ProductController@searchAPI')->name('productSearchAPI');
Route::get('/products', 'ProductController@showSearchPage')->name('searchProductView');
Route::get('/products/{id}', 'App\Http\Controllers\ProductController@show')->name('productView');

//Shopping Cart -- VER ESTA PARTE DO URL COM /USERS/{ID} -- MELHOR PASSAR PARA A SECÇÃO USER?
Route::get('/users/{id}/shopping-cart', 'ShoppingCartController@show')->name('shoppingCartView');
Route::post('/api/cart/add', 'ShoppingCartController@addProductCart')->name('addProductCart')->middleware('auth:user');

//Order

//Route::post('/api/cart/add', 'OrderController@addProductCart')->name('addProductCart')->middleware('auth:user');