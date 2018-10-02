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
Route::match(['get', 'post'], 'admin/login', 'AdminController@login')->name('admin.login');

///route dashboard
Route::get('admin/logout', 'AdminController@logout')->name('admin.logout');

Auth::routes();

Route::group(['middleware' => ['auth']], function(){

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
    Route::match(['get', 'post'], '/admin/add-product', 'ProductController@create')->name('product.create');
    Route::get('admin/index-products', 'ProductController@indexp')->name('product.index');
    Route::match(['get', 'post'], '/admin/edit-product', 'ProductController@edit')->name('product.edit');
    Route::get('admin/index-products', 'ProductController@delete')->name('product.index');
});
