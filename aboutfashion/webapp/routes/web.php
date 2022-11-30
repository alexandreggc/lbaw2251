<?php

// Static Pages
Route::get('/', 'PageController@homePage')->name('home');
Route::get('/admin-panel','PageController@homePageAdmin')->name('homeAdminPanel')->middleware('auth:admin');
Route::get('/about', 'PageController@aboutPage')->name('aboutUs');
Route::get('/contacts', 'PageController@contactsPage')->name('contacts');


//User 
Route::post('login', 'Auth\LoginController@login')->name('userLogin');
Route::get('/users/{id}', 'UserController@show')->name('userView')->middleware();
Route::patch('/users/{id}', 'UserController@update')->name('userUpdate');
Route::delete('/users/{id}', 'UserController@delete')->name('userDelete');
Route::get('/users/{id}/edit', 'UserController@edit')->name('userUpdateForm');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('userRegisterForm');
Route::post('register', 'Auth\RegisterController@register')->name('userRegister');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');


//Orders
//Route::get('/orders/create', 'OrderController@create')->name('orderCreateForm');
Route::post('/orders/create', 'OrderController@create')->name('orderCreate');
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


//Products
Route::get('/api/products/', 'ProductController@searchAPI')->name('productSearchAPI');
Route::get('/api/products/stock', 'StockController@stockAPI')->name('productStockAPI');
Route::get('/products', 'ProductController@showSearchPage')->name('searchProductView');
Route::get('/products/{id}', 'ProductController@show')->name('productView');

//Shopping Cart -- VER ESTA PARTE DO URL COM /USERS/{ID} -- MELHOR PASSAR PARA A SECÇÃO USER?
Route::get('/users/{id}/shopping-cart', 'ShoppingCartController@show')->name('shoppingCartView');
//Route::post('/users/{id}/shopping-cart/add', 'ShoppingCartController@addProductCart')->name('addProductCart');
//Route::post('/users/{id}shopping-cart/remove', 'ShoppingCartController@removeProductCart')->name('removeProductCart');
//Route::post('/users/{id}/shopping-cart/checkout', 'ShoppingCartController@checkout')->name('checkoutCart');
Route::post('/api/shopping-cart/add', 'ShoppingController@addProductCart')->name('addProductCart');