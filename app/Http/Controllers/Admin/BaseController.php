<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Closure;

class BaseController extends Controller
{
    public function __construct()
    {
      //  $this->middleware('auth:admin');
        $this->middleware('auth:admin')->except("login");
        //在这里判断用户有没有权限
        $this->middleware(function ($request, Closure $next) {
            $admin = Auth::guard('admin')->user();
            //判断当前路由在不在这个数组里，不在的话才验证权限，在的话不验证，还可以根据排除用户ID为1
            if (!in_array(Route::currentRouteName(), ['admin.login', 'admin.logout']) && $admin->id !== 1) {
                //判断当前用户有没有权限访问 路由名称就是权限名称
                if ($admin->can(Route::currentRouteName()) === false) {
                    /* echo view('admin.fuck');
                      exit;*/
                    //显示视图 不能用return 只能exit
                    exit(redirect(url()->previous()));
                }
            }
            return $next($request);
        });
    }
    //得到所有admin的路由
    public function url(){
        $url = [];
        $app = app();
        $routes = $app->routes->getRoutes();
        foreach ($routes as $k=>$value){
            if($value->action['namespace']==='App\Http\Controllers\Admin'){
                $url[] = $value->action['as'];
            }

        }
        return $url;
    }
}
