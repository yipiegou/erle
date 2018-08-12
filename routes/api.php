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
Route::domain('www.erle.com')->namespace('Api')->group(function () {
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
    //用户详情接口
    Route::any('member/detail',"MemberController@detail")->name("member.detail");

    //收货地址
    Route::any('addrey/address',"AddReyController@address")->name("addrey.address");
    //收货地址
    Route::any('addrey/addresslist',"AddReyController@addresslist")->name("addrey.addresslist");
    //添加收货地址addaddress
    Route::any('addrey/addaddress',"AddReyController@addaddress")->name("addrey.addaddress");
    //修改收货地址
    Route::any('addrey/editAddress',"AddReyController@editAddress")->name("addrey.editAddress");


    //添加购物车
    Route::any('cart/addCart',"CartController@addCart")->name("cart.addCart");
    //生成购物车
    Route::any('cart/cart',"CartController@cart")->name("cart.cart");

    //添加订单
    Route::any('order/addorder',"OrderController@addorder")->name("order.addorder");
    //获得指定订单接口
    Route::any('order/order',"OrderController@order")->name("order.order");
    // 获得订单列表接口
    Route::any('order/orderList',"OrderController@orderList");
    //支付接口
    Route::any('order/pay',"OrderController@pay");

    // 微信支付
    Route::any('order/wxPay',"OrderController@wxPay");
    //订单状态
    Route::any('order/status',"OrderController@status");
    Route::any("order/ok","OrderController@ok");
});

