<?php

// Static Pages
Route::get('/', 'PageController@homePage')->name('home');
Route::get('/about', 'PageController@aboutPage')->name('aboutUs');
Route::get('/contacts', 'PageController@contactsPage')->name('contacts');


//Admin Pages
Route::get('/admin-panel','AdminPanelController@homePageAdmin')->name('homeAdminPanel')->middleware('auth:admin');
//Route::get('/admin-panel/users','AdminPanelController@usersPageAdmin')->name('usersAdminPanel')->middleware('auth:admin');
Route::get('/admin-panel/products','AdminPanelController@productsPageAdmin')->name('productsAdminPanel')->middleware('auth:admin');
Route::get('/admin-panel/promotions','AdminPanelController@promotionsPageAdmin')->name('promotionsAdminPanel')->middleware('auth:admin');
Route::get('/admin-panel/orders','AdminPanelController@ordersPageAdmin')->name('ordersAdminPanel')->middleware('auth:admin');
Route::get('/admin-panel/reviews','AdminPanelController@reviewsPageAdmin')->name('reviewsAdminPanel')->middleware('auth:admin');
Route::get('/admin-panel/reports','AdminPanelController@reportsPageAdmin')->name('reportsAdminPanel')->middleware('auth:admin');
/*
Route::get('/admin-panel','PageController@homePageAdmin')->name('homeAdminPanel')->middleware('auth:admin');
//Route::get('/admin-panel/users','AdminPanelController@usersPageAdmin')->name('usersAdminPanel')->middleware('auth:admin');
Route::get('/admin-panel/products','PageController@productsPageAdmin')->name('productsAdminPanel')->middleware('auth:admin');
Route::get('/admin-panel/promotions','PageController@promotionsPageAdmin')->name('promotionsAdminPanel')->middleware('auth:admin');
Route::get('/admin-panel/orders','PageController@ordersPageAdmin')->name('ordersAdminPanel')->middleware('auth:admin');
Route::get('/admin-panel/reviews','PageController@reviewsPageAdmin')->name('reviewsAdminPanel')->middleware('auth:admin');
Route::get('/admin-panel/reports','PageController@reportsPageAdmin')->name('reportsAdminPanel')->middleware('auth:admin');
*/


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
Route::get('/products', 'ProductController@showSearchPage')->name('searchProductView');
Route::get('/products/{id}', 'ProductController@show')->name('productView');

//API
Route::get('/api/products/', 'PageController@homePage')->name('homePageAPI');
Route::get('/api/products/', 'ProductController@searchAPI')->name('productSearchAPI');
Route::get('/api/products/stock', 'StockController@stockAPI')->name('productStockAPI');
Route::post('/api/shopping-cart/add', 'ShoppingController@addProductCart')->name('addProductCart');
Route::post('/api/shopping-cart/delete', 'ShoppingController@deleteProductCart')->name('deleteProductCart');
Route::post('/api/shopping-cart/update', 'ShoppingController@updateProductCart')->name('updateProductCart');

Route::get('/shopping-cart', 'ShoppingCartController@show')->name('shoppingCartView');