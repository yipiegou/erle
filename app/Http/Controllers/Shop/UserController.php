<?php

namespace App\Http\Controllers\Shop;

use App\Models\ShopCategorie;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends BaseController
{
    /**
     * 首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //获取数据
        $users = User::all();
        //显示视图 传递数据
        return view('shop.user.index',compact('users'));
    }
    public function login(Request $request){
        if ($request->isMethod('post')) {

            if(Auth::attempt(["name"=>$request->input('name'),"password"=>$request->input('password')])){
                $request->session()->flash("success","登录成功");
                return redirect()->route('user.index');
            }else {
                $request->session()->flash("danger", "账号或密码输入错误");
                return redirect()->back()->withInput();
            }
        }
        return view('shop.user.login');
    }
    /**
     * 添加
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        //类型
        $shop = ShopCategorie::all();
        if ($request->isMethod('post')) {
            $this->validate($request,[
                'name'=>'required',
                'email'=>'required',
                'password'=>'required',
                'shop_category_id'=>'required',
                'shop_name'=>'required',
                'start_send'=>'required',
                'send_cost'=>'required',
                'notice'=>'required',
                'discount'=>'required',
            ]);
            $data = $request->all();
            if($request->file('shop_logo')){
                $logo = $request->file('shop_logo')->store("usershop");
                $data['shop_logo'] = '/storage/'.$logo;
            }
            $data['password'] = bcrypt($data['password']);
            DB::transaction(function () use ($data){
                $shop = Shop::create($data);
                $data['shop_id'] = $shop->id;
                User::create($data);
                return redirect()->route('user.index');
            });
            //显示视图
            return view('shop.user.add',compact('shop'));
        }

        //显示视图
        return view('shop.user.add',compact('shop'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request,$id)
    {
        $shop = User::find($id);
        if ($request->isMethod('post')) {
            $this->validate($request,[
                'name'=>'required',
                'email'=>'required',
                'password'=>'required',
                'shop_category_id'=>'required',
                'shop_name'=>'required',
                'start_send'=>'required',
                'send_cost'=>'required',
                'notice'=>'required',
                'discount'=>'required',
            ]);
            DB::transaction(function () use ($shop,$request){
                $shop->update($request->all());
                $shops = Shop::find($shop->id);
                $shops->update($request->all());
                return redirect()->route('user.index');
            });
            return view('shop.user.edit',compact('shop'));
        }
        return view('shop.user.edit',compact('shop'));
    }

    /**
     * 删除
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function del(Request $request,$id)
    {
        $shop=User::findOrfail($id);
        File::delete($shop->logo);
        $shop->delete();
        return redirect()->route('user.index');
    }
}
