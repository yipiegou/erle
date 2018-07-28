<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::namespace('Api')->group(function () {
    //商户首页
    Route::get('shop/list',"ShopController@list")->name("shop.list");
    //登录
    Route::any('shop/selete',"ShopController@selete")->name("shop.selete");
});

