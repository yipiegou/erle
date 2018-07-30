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
    //获得商家列表接口
    Route::get('shop/list',"ShopController@list")->name("shop.list");
    //获得指定商家接口
    Route::any('shop/selete',"ShopController@selete")->name("shop.selete");

    //注册接口
    Route::post('member/reg',"MemberController@reg")->name("member.reg");
    //登录接口
    Route::any('member/login',"MemberController@login")->name("member.login");
    //短信验证接口
    Route::any('member/sms',"MemberController@sms")->name("member.sms");
    //修改密码
    Route::any('member/changePassword',"MemberController@changePassword")->name("member.changePassword");
    //重置密码
    Route::any('member/forgetPassword',"MemberController@forgetPassword")->name("member.forgetPassword");
});

