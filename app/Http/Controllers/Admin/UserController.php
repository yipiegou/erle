<?php

namespace App\Http\Controllers\Admin;

use App\Models\ShopCategorie;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

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
        return view('admin.user.index',compact('users'));
    }
    public function selete(Request $request,$id)
    {
        //获取数据
        $user = Shop::find($id);
        if ($request->isMethod('post')) {
            dd($request->all());
            $user->update($request->all());
            return redirect()->route('user.index');
        }
        //显示视图 传递数据
        return view('admin.user.selete',compact('user'));
    }

    /**
     * 添加
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function add(Request $request)
    {
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
                $logo = $request->file('shop_logo')->store("public/usershop");
                $data['shop_logo'] = '/storage/'.$logo;
            }
            $data['password'] = bcrypt($data['password']);
            DB::transaction(function () use ($data){
                $shop = Shop::create($data);
                $data['shop_id'] = $shop->id;
                User::create($data);

            });


            return redirect()->route('user.index');
        }
        //类型
        $shop = ShopCategorie::all();
        //显示视图
        return view('admin.user.add',compact('shop'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request,$id)
    {
        $shop = User::find($id);
       // dd($shop);
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
            $data =$request->all();
            if($request->file('shop_logo')){
                //File::delete($shop->);
                $logo = $request->file('shop_logo')->store("usershop");
                $data['shop_logo'] = '/storage/'.$logo;

            }
            $shop->update($data);
            return redirect()->route('admin.user.index');
        }
        return view('admin.user.edit',compact('shop'));
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
