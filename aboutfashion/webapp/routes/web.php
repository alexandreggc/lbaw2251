<?php

// Static Pages
Route::get('/', 'PageController@homePage')->name('home');
Route::get('/admin-panel','PageController@homePageAdmin')->name('homeAdminPanel')->middleware('auth:admin');
Route::get('/about', 'PageController@aboutPage')->name('aboutUs');
Route::get('/contacts', 'PageController@contactsPage')->name('contacts');


//User 
Route::post('/login', 'Auth\LoginController@userLogin')->name('userLogin');
Route::get('/users/{id}', 'UserController@show')->name('userView');
Route::patch('/users/{id}', 'UserController@update')->name('userUpdate');
Route::delete('/users/{id}', 'UserController@delete')->name('userDelete');
Route::get('/users/{id}/edit', 'UserController@edit')->name('userUpdateForm');
Route::post('register', 'Auth\RegisterController@register')->name('userRegister');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

//Forgot Password
Route::get('/forgot-password', 'Auth\ForgotPasswordController@showForgetPasswordForm')->name('forgot.password.view');
Route::post('/forgot-password', 'Auth\ForgotPasswordController@submitForgetPasswordForm')->name('forgot.password.action');
Route::get('/reset-password/{token}', 'Auth\ForgotPasswordController@showResetPasswordForm')->name('password.reset');
Route::post('/reset-password', 'Auth\ForgotPasswordController@submitResetPasswordForm')->name('reset.password.action');


Route::get('/admin-panel/forgot-password', 'Auth\ForgotPasswordController@showForgetPasswordAdminForm')->name('forgot.password.view');
Route::post('/admin-panel/forgot-password', 'Auth\ForgotPasswordController@submitForgetPasswordAdminForm')->name('forgot.password.action');
Route::get('/admin-panel/reset-password/{token}', 'Auth\ForgotPasswordController@showResetPasswordAdminForm')->name('password.reset');
Route::post('/admin-panel/reset-password', 'Auth\ForgotPasswordController@submitResetPasswordAdminForm')->name('reset.password.action');

//Orders
Route::get('/order/{id}', 'OrderController@show')->name('orderDetails');

//Cards
Route::get('/cards/{id}/edit', 'CardController@edit')->name('cardEditForm');
Route::delete('/cards/{id}', 'CardController@delete')->name('cardDelete');
Route::patch('/cards/{id}', 'CardController@update')->name('cardUpdate');
Route::get('/cards/create', 'CardController@create')->name('cardCreateForm');
Route::put('/cards/create', 'CardController@store')->name('cardCreate');

//Addresses
Route::get('/address/{id}/edit', 'AddressController@edit')->name('addressEditForm');
Route::delete('/address/{id}', 'AddressController@delete')->name('addressDelete');
Route::patch('/address/{id}', 'AddressController@update')->name('addressUpdate');
Route::get('/address/create', 'AddressController@create')->name('addressCreateForm');
Route::put('/address/create', 'AddressController@store')->name('addressCreate');


//Admin
Route::get('/admin-panel/login', 'Auth\LoginController@showLoginForm')->name('adminLoginForm');
Route::post('/admin-panel/login', 'Auth\LoginController@adminLogin')->name('adminLogin');
Route::delete('/admin-panel/users/{id}', 'AdminController@deleteUser')->name('deleteUserAdmin');
Route::patch('/admin-panel/users/{id}/block', 'AdminController@blockUser')->name('blockUser');
Route::get('/admin-panel/logout', 'Auth\LoginController@adminLogout')->name('adminLogout');


//Products
Route::get('/products', 'ProductController@showSearchPage')->name('searchProductView');
Route::get('/products/{id}', 'ProductController@show')->name('productView');

//API
Route::get('/api/products/', 'ProductController@searchAPI')->name('productSearchAPI');
Route::get('/api/products/stock', 'StockController@stockAPI')->name('productStockAPI');
Route::post('/api/shopping-cart', 'ShoppingCartController@add')->name('addProductCart');
Route::delete('/api/shopping-cart', 'ShoppingCartController@delete')->name('deleteProductCart')->middleware('auth:web');
Route::patch('/api/shopping-cart', 'ShoppingCartController@update')->name('updateProductCart')->middleware('auth:web');

Route::get('/shopping-cart', 'ShoppingCartController@show')->name('shoppingCartView');

Route::get('/shopping-cart/test', 'ShoppingCartController@add');