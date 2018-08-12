<?php

namespace App\Http\Controllers\Shop;

use App\Models\ShopCategorie;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mrgoon\AliSms\AliSms;

class UserController extends BaseController
{
    /**
     * 首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //获取数据
        $users = User::find(Auth::user()->id);
        //显示视图 传递数据
        return view('shop.user.index',compact('users'));
    }

    /**
     * 重置密码
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function editpassword(Request $request,$id){
        if(Auth::user()->id!=$id){
            session()->flash('success','你没有权限这样做');
            return redirect(url()->previous());
        }
        $user=User::find($id);
        if ($request->isMethod('post')) {

            if(Auth::attempt(["name"=>$request->post('name'),"password"=>$request->post('password')],$request->has('remember'))){
                $data = $request->all();
                if($data['password1']!==$data['password2']){
                    $request->session()->flash("danger","两次密码不一致");
                    return redirect()->back()->withInput();
                }
                $data['password'] = bcrypt($data['password1']);
                $user->update($data);
                Auth::logout();
                $request->session()->flash("success","修改成功，请重新登录");
                return redirect()->route('user.login');
            }else {
                $request->session()->flash("danger", "原密码输入错误");
                return redirect()->back()->withInput();
            }
        }
        return view('shop.user.password',compact('user'));
    }
    public function login(Request $request){
        if ($request->isMethod('post')) {

            if(Auth::attempt(["name"=>$request->post('name'),"password"=>$request->post('password')],$request->has('remember'))){
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
                $data['shop_img'] = env('ALIYUN_OSS_URL').$logo;
            }
            $data['password'] = bcrypt($data['password']);
            DB::transaction(function () use ($data){
                $shop = Shop::create($data);
                $data['shop_id'] = $shop->id;
                User::create($data);
                return redirect()->route('user.index');
            });
            $aliSms = new AliSms();
            $response = $aliSms->sendSms('1813465800', 'SMS_140695123', ['code'=> 'value in your template']);
            //类型
            $shop = ShopCategorie::all();
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
        if(Auth::user()->id!=$id){
            session()->flash('success','你没有权限这样做');
            return redirect(url()->previous());
        }
        $user = User::findOrfail($id);
        $shop = Shop::findOrfail($user->shop_id);
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
            $data = $request->all();
            if($request->file('shop_logo')){
                $logo = $request->file('shop_logo')->store("usershop");
                $data['shop_img'] = env('ALIYUN_OSS_URL').$logo;
            }
            DB::transaction(function () use ($shop,$data){
                $shop->update($data);
                $shops = Shop::find($shop->id);
                $shops->update($data);
                return redirect()->route('user.index');
            });
            return view('shop.user.edit',compact('shop'));
        }
        return view('shop.user.edit',compact('shop','user','shops'));
    }

    /**
     * 删除
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function del(Request $request,$id)
    {
        if(Auth::user()->id!=$id){
            session()->flash('success','你没有权限这样做');
            return redirect(url()->previous());
        }
        $user=User::findOrfail($id);
        $shop=Shop::findOrfail($user->shop_id);
        File::delete($shop->shop_img);
        $shop->delete();
        $user->delete();
        return redirect()->route('user.index');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login');
    }
}
