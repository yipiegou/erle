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

Route::get('/', function () {
    return view('welcome');
});
Route::domain('admin.erle.com')->namespace('Admin')->group(function () {
    Route::get('shopcategory/index',"ShopcategoryController@index")->name("shopcate.index");
    Route::any('shopcategory/add',"ShopcategoryController@add")->name("shopcate.add");
    Route::any('shopcategory/edit/{id}',"ShopcategoryController@edit")->name("shopcate.edit");
    Route::any('shopcategory/del/{id}',"ShopcategoryController@del")->name("shopcate.del");
});
Route::domain('shop.erle.com')->namespace('Shop')->group(function () {
    Route::get('shop/index',"ShopController@index")->name("shop.index");
});