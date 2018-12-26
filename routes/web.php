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


///login admin
Route::match(['get', 'post'], 'admin/login', 'Admin\AdminController@login')->name('admin.login');

///route dashboard
Route::get('admin/logout', 'Admin\AdminController@logout')->name('admin.logout');

Auth::routes();

Route::group(['namespace' => 'Admin', 'middleware' => ['auth']], function(){

    ///route dashboard
    Route::get('admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');

    ///route setting acc
    Route::get('admin/setting', 'AdminController@setting')->name('admin.setting');

    //route check pass acc ad
    Route::get('admin/check-pwd', 'AdminController@chkPassword');

    ///route updatepassword
    Route::match(['get', 'post'], '/admin/updatePassword', 'AdminController@UpdatePassword')->name('admin.updatePassword');

    //Admin category routes
    Route::resource('admin/category', 'CategoryController');
    Route::match(['get', 'post'], '/admin/deleteCategory/{id}', 'CategoryController@deleteCategory')->name('admin.deleteCategory');

    //Admin Products route
    Route::match(['get', 'post'], '/admin/product/create', 'ProductController@create')->name('product.create');
    Route::get('admin/product/index', 'ProductController@index')->name('product.index');
    Route::match(['get', 'post'], '/admin/product/edit/{id}', 'ProductController@edit')->name('product.edit');
    Route::get('admin/product-image/delete/{id}', 'ProductController@deleteProductImage')->name('productImage.delete');
    Route::get('admin/delete-product/{product}', 'ProductController@deleteProduct')->name('product.delete');

    /// Products Attributes Route
    Route::match(['get', 'post'], '/admin/add-attributes/{id}', 'ProductAttributeController@addAttributes' )->name('productAttributes.create');
    Route::post( '/admin/update-attributes/{id}', 'ProductAttributeController@editAttributes' )->name('productAttributes.edit');
    Route::get('admin/delete-attribute/{id}', 'ProductAttributeController@deleteAttribute')->name('productAttribute.delete');

    // Product alternate Image
    Route::match(['get', 'post'], '/admin/add-images/{id}', 'ProductController@addImage' )->name('AlternateImage');
    Route::get('admin/delete-alt-image/{id}', 'ProductController@deleteProductAltImage');

    //Coupon Routes
    Route::match(['get', 'post'], '/admin/add-coupon', 'CouponsController@create' )->name('Coupon.create');
    Route::match(['get', 'post'], '/admin/edit-coupon/{id}', 'CouponsController@edit' )->name('Coupon.edit');
    Route::get('admin/index-coupon', 'CouponsController@index')->name('Coupon.index');
    Route::get('admin/delete-coupon/{id}', 'CouponsController@delete')->name('Coupon.delete');
    
    // Banner route
    Route::match(['get','post'],'/admin/add-banner','BannerController@create')->name('Banner.create');
	Route::match(['get','post'],'/admin/edit-banner/{id}','BannerController@edit')->name('Banner.edit');
    Route::get('admin/index-banners','BannerController@index')->name('Banner.index');
    Route::get('admin/delete-banner/{id}','BannerController@delete');

    ///order
    Route::get('admin/order','OrderController@index')->name('order.index');
    Route::get('admin/view-order/{id}','OrderController@view')->name('order.view');
    Route::post('admin/update-order-status/{id}','OrderController@updateOrderStatus')->name('order.view');
    

});

////all router after login
Route::group(['namespace' => 'User', 'middleware' => ['UserAccess']], function()
{
    ///add to cart
    Route::post('/add-cart','CartController@addtoCart')->name('addCart');
    
    // Cart Page route
    Route::match(['get', 'post'], '/cart', 'CartController@Cart')->name('Cart');
    Route::get('/cart/delete-product/{id}','CartController@deleteCartProduct')->name('removeCartProduct');
    Route::get('/cart/update-quantity/{id}/{quantity}','CartController@updateCartQuantity');
    Route::post('/cart/apply-coupon','CartController@applyCoupon')->name('applyCoupon');

    Route::match(['get', 'post'], '/account', 'UserController@account')->name('account');
    
    ///Checkout page
    Route::match(['get', 'post'], '/checkout', 'ProcessOrderController@checkout')->name('checkout');
    Route::get('/order-review', 'ProcessOrderController@oderReview')->name('orderReview');
    Route::post('/place-order', 'ProcessOrderController@placeOrder')->name('placeOrder');
    
    ///thank page
    Route::get('/thanks', 'ProcessOrderController@thanks')->name('thanksPage');

    //user order
    Route::get('/orders', 'ProcessOrderController@userOrders')->name('userOrders');
    Route::get('/order/{id}', 'ProcessOrderController@userOrderDetail')->name('userOrder');
    
    
});

Route::group(['namespace' => 'User'], function(){

    /// Register/login for user
    Route::get('/login-register', 'UserController@userLoginRegister')->name('Login_register');
    Route::post('/user-register', 'UserController@register')->name('UserRegister');
    Route::post('/user-login', 'UserController@login')->name('UserLogin');
    Route::get('/user-logout', 'UserController@logout')->name('UserLogout');
    Route::get('/check-email', 'UserController@checkEmail');
    
    //Home page
    Route::get('/', 'IndexController@index')->name('home');
    
    /// Category/listing page
    Route::get('/{slug}', 'IndexController@listCategory');
    
    //product detail page
    Route::get('/{name}/{id}', 'IndexController@productDetail')->name('productDetail');
    
    //get product attribute price
    Route::get('/get-product-price', 'IndexController@getProductPrice');
    
    
});


