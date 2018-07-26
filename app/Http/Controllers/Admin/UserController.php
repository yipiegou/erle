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
    public function index($id = 1)
    {
        //获取数据
        $users = User::where('status','=',$id)->paginate(4);
        //显示视图 传递数据
        return view('admin.user.index',compact('users'));
    }
    //查看店铺
    public function selete(Request $request,$id)
    {
        //获取数据
        $user = Shop::find($id);

        if ($request->isMethod('post')) {
            dd($request->all());
            $user->update($request->all());
            return redirect()->route('admin.user.index');
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
                $data['shop_logo'] = env('ALIYUN_OSS_URL').$logo;
            }
            $data['password'] = bcrypt($data['password']);
            DB::transaction(function () use ($data){
                $shop = Shop::create($data);
                $data['shop_id'] = $shop->id;
                User::create($data);

            });


            return redirect()->route('admin.user.index',1);
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
        $user = User::find($id);
        $shop = Shop::find($user->shop_id);
       $shops = ShopCategorie::all();
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
                //File::delete($shop->);public/
                $logo = $request->file('shop_logo')->store("usershop");
                $data['shop_logo'] = env('ALIYUN_OSS_URL').$logo;
                Storage::delete($shop->shop_logo);
            }
            $shop->update($data);
            return redirect()->route('admin.user.index',1);
        }
        return view('admin.user.edit',compact('shop','shops','user'));
    }

    /**
     * 软删除
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function del(Request $request,$id)
    {
        $user=User::findOrFail($id);
        $shop=Shop::findOrFail($user->shop_id);
        $user->status = 0;
        $shop->status = -1;
        $user->save();
        $shop->save();
        return redirect()->route('admin.user.index',1);
    }
    //重置密码
    public function reset($id)
    {
        $user = User::findOrFail($id);
        $passwrod = bcrypt(000000);
        $user->password = $passwrod;
        $user->seav();
        return redirect()->route('admin.user.index',1);
    }
    //审核
    public function auditing($id)
    {
        $user=User::findOrFail($id);
        $shop=Shop::findOrFail($user->shop_id);
        $user->status = 1;
        $shop->status = 1;
        $user->save();
        $shop->save();
        session()->flash('success','审核成功');
        return redirect()->route('admin.user.index',1);
    }
}
