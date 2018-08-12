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
Route::get('/',function (){
    return view('index');
});

Route::get('/order/clear', function () {
//处理超时未支付的订单
    /**
     * 1.找出 超时   未支付   订单
     * 当前时间-创建时间>15*60
     * 当前时间-15*60>创建时间
     * 创建时间<当前时间-15*60
     * */
     \App\Models\Order::where("status",0)->where('created_at','<',date("Y-m-d H:i:s",(time()-15*60)))->update(['status'=>-1]);

});
//管理员端
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
    //后台审核商户
    Route::get('user/auditing/{id}',"UserController@auditing")->name("admin.user.auditing");
    //查询
   // Route::get('user/sel/{id}',"UserController@selete")->name("admin.user.sel");
    //后台添加商户
    Route::any('user/add',"UserController@add")->name("admin.user.add");
    Route::any('admin/user/reset/{id}',"UserController@reset")->name("admin.user.reset");
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

    Route::any('admin/order/index',"OrderController@index")->name("admin.order.index");
    //订单查看
    Route::any('admin/order/selete/{id}',"OrderController@selete")->name("admin.order.selete");
    Route::any('admin/order/menu',"OrderController@menu")->name("admin.order.menu");

    //会员管理
    Route::any('admin/member/index',"MemberController@index")->name("admin.member.index");
    //会员详情
    Route::any('admin.member.selete/{id}',"MemberController@selete")->name("admin.member.selete");
    //账号禁用
    Route::any('admin.member.edit/{id}',"MemberController@edit")->name("admin.member.edit");

    //region权限处理
    Route::any('permission/index',"PermissionController@index")->name("admin.permission.index");
    //添加权限
    Route::any('permission/add',"PermissionController@add")->name("admin.permission.add");
    //删除权限
    Route::any('permission/del/{id}',"PermissionController@del")->name("admin.permission.del");
    //编辑权限
    Route::any('permission/edit/{id}',"PermissionController@edit")->name("admin.permission.edit");
    //endregion
    //region权限组处理
    Route::any('role/index',"RoleController@index")->name("admin.role.index");
    //添加权限组
    Route::any('role/add',"RoleController@add")->name("admin.role.add");
    //删除权限组
    Route::any('role/del/{id}',"RoleController@del")->name("admin.role.del");
    //编辑权限组
    Route::any('role/edit/{id}',"RoleController@edit")->name("admin.role.edit");
    //endregion

    //region导航条管理
    Route::any('nav/index',"NavController@index")->name("admin.nav.index");
    //导航条添加
    Route::any('nav/add',"NavController@add")->name("admin.nav.add");
    //导航条删除
    Route::any('nav/del/{id}',"NavController@del")->name("admin.nav.del");
    //导航条修改
    Route::any('nav/edit/{id}',"NavController@edit")->name("admin.nav.edit");
    //endregion
    //region抽奖活动管理
    //抽奖活动列表
    Route::any('event/index',"EventController@index")->name("admin.event.index");
    //抽奖活动添加
    Route::any('event/add',"EventController@add")->name("admin.event.add");
    //抽奖活动修改
    Route::any('event/edit/{id}',"EventController@edit")->name("admin.event.edit");
    //抽奖活动删除
    Route::any('event/del/{id}',"EventController@del")->name("admin.event.del");
    //抽奖活动删除
    Route::any('event/prizeAdd/{id}',"EventController@prizeAdd")->name("admin.event.prizeAdd");
    //活动开奖
    Route::any('event/open/{id}',"EventController@open")->name("admin.event.open");
    //endregion
});
//商户端
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
    Route::any('menus/del/{id}',"MenuCategoryController@del")->name("menus.del");

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

    //订单管理
    Route::any('shop/order/index',"OrderController@index")->name("order.index");
    //订单查看
    Route::any('shop/order/selete/{id}',"OrderController@selete")->name("order.selete");
    //订单发货
    Route::any('shop/order/edit/{id}',"OrderController@edit")->name("order.edit");
    //取消订单
    Route::any('shop/order/del/{id}',"OrderController@del")->name("order.del");

    //销量查询
    Route::any('shop/order/menu',"OrderController@menu")->name("order.menu");
    //抽奖活动列表
    Route::any('event/index',"EventController@index")->name("shop.event.index");
    Route::any('event/edit/{id}',"EventController@edit")->name("shop.event.edit");
});