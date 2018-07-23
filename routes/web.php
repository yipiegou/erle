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


Route::domain('admin.erle.com')->namespace('Admin')->group(function () {
    //Route::any('/',"AdminController@login");
    //商铺类
    Route::get('shopcategory/index',"ShopcategoryController@index")->name("shopcate.index");
    Route::any('shopcategory/add',"ShopcategoryController@add")->name("shopcate.add");
    Route::any('shopcategory/edit/{id}',"ShopcategoryController@edit")->name("shopcate.edit");
    Route::any('shopcategory/del/{id}',"ShopcategoryController@del")->name("shopcate.del");
    //管理员
    Route::get('admin/index',"AdminController@index")->name("admin.index");
    Route::any('admin/login',"AdminController@login")->name('admin.login');
    Route::any('admin/add',"AdminController@add")->name("admin.add");
    Route::any('admin/edit/{id}',"AdminController@edit")->name("admin.edit");
    Route::any('admin/del/{id}',"AdminController@del")->name("admin.del");
    Route::any('admin/logout',"AdminController@logout")->name('admin.logout');
    //后台商户管理
    Route::get('user/index',"UserController@index")->name("admin.user.index");
    Route::get('user/sel/{id}',"UserController@selete")->name("admin.user.sel");
    Route::any('user/add',"UserController@add")->name("admin.user.add");
    Route::any('admin.user.reset',"UserController@add")->name("admin.user.reset");
    Route::any('user/edit/{id}',"UserController@edit")->name("admin.user.edit");
    Route::any('user/del/{id}',"UserController@del")->name("admin.user.del");
});
Route::domain('shop.erle.com')->namespace('Shop')->group(function () {
    //商户注册
    Route::get('user/index',"UserController@index")->name("user.index");
    //登录
    Route::any('user/login',"UserController@login")->name("user.login");
    //修改密码
    Route::any('user/password/{id}',"UserController@editpassword")->name("user.password");
    Route::any('user/add',"UserController@add")->name("user.add");
    Route::any('user/edit/{id}',"UserController@edit")->name("user.edit");
    Route::any('user/logout',"UserController@logout")->name('user.logout');
});