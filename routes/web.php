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
    Route::get('user/index/{id}',"UserController@index")->name("admin.user.index");
    //后台审核商户
    Route::get('user/auditing/{id}',"UserController@auditing")->name("admin.user.auditing");
    //查询
   // Route::get('user/sel/{id}',"UserController@selete")->name("admin.user.sel");
    //后台添加商户
    Route::any('user/add',"UserController@add")->name("admin.user.add");
    Route::any('admin/user/reset',"UserController@reset")->name("admin.user.reset");
    //查询商户商铺
    Route::any('admin/user/selete/{id}',"UserController@selete")->name("admin.user.selete");
    //后台编辑商户
    Route::any('user/edit/{id}',"UserController@edit")->name("admin.user.edit");
    //后台禁用商户
    Route::any('user/del/{id}',"UserController@del")->name("admin.user.del");

    //后台添加活动
    Route::any('activity/add',"ActivityController@add")->name("activity.add");
    //活动首页
    Route::any('activity/index',"ActivityController@index")->name("activity.index");
    //活动详情查看
    Route::any('activity/selete/{id}',"ActivityController@selete")->name("activity.selete");
    //编辑活动
    Route::any('activity/edit/{id}',"ActivityController@edit")->name("activity.edit");
    //禁用活动
    Route::any('activity/del/{id}',"ActivityController@del")->name("activity.del");
});
Route::domain('shop.erle.com')->namespace('Shop')->group(function () {
    //商户首页
    Route::get('user/index',"UserController@index")->name("user.index");
    //登录
    Route::any('user/login',"UserController@login")->name("user.login");
    //修改密码
    Route::any('user/password/{id}',"UserController@editpassword")->name("user.password");
    //注册
    Route::any('user/add',"UserController@add")->name("user.add");
    //修改信息
    Route::any('user/edit/{id}',"UserController@edit")->name("user.edit");
    //退出登录
    Route::any('user/logout',"UserController@logout")->name('user.logout');

    //菜品类首页
    Route::get('menus/index',"MenuCategoryController@index")->name("menus.index");
    //菜品类添加
    Route::any('menus/add',"MenuCategoryController@add")->name("menus.add");
    //菜品类修改
    Route::any('menus/edit/{id}',"MenuCategoryController@edit")->name("menus.edit");
    //菜品类删除
    Route::any('menus/del/{id}',"MenuCategoryController@edit")->name("menus.del");

    //菜品首页
    Route::any('menu/index',"MenuController@index")->name("menu.index");
    //菜品添加
    Route::any('menu/add',"MenuController@add")->name("menu.add");
    //菜品修改
    Route::any('menu/edit/{goods_id}',"MenuController@edit")->name("menu.edit");
    //菜品类删除
    Route::any('menu/del/{goods_id}',"MenuCategoryController@edit")->name("menu.del");

    //活动首页
    Route::any('activity/index',"ActivityController@index")->name("shop.activity.index");
    //活动详情查看
    Route::any('activity/edit/{id}',"ActivityController@edit")->name("shop.activity.edit");
});