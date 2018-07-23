<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AdminController extends BaseController
{
    /**
     * 首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //获取数据
        $admin = Admin::all();
        //显示视图 传递数据
        return view('admin.admin.index',compact('admin'));
    }
    public function login(Request $request){
        if ($request->isMethod('post')) {
            if (Auth::guard('admin')->attempt(['name'=>$request->post('name'),'password'=>$request->post('password')],$request->has('remember'))) {

                return redirect()->route('admin.index');
            }
        }
        return view('admin.admin.login');
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
            ]);
            $data = $request->all();
            $data['password'] = bcrypt($data['password']);
            Admin::create($data);


            return redirect()->route('admin.index');
        }
        //显示视图
        return view('admin.admin.add');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request,$id)
    {
        $admin = Admin::findOrfail($id);
        // dd($shop);
        if ($request->isMethod('post')) {
            $this->validate($request,[
                'name'=>'required',
                'email'=>'required',
                'password'=>'required',
            ]);
            $data = $request->all();
            $data['password'] = bcrypt($data['password']);
            $admin->update($data);
            return redirect()->route('admin.admin.index');
        }
        return view('admin.admin.edit',compact('admin'));
    }

    /**
     * 删除
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function del(Request $request,$id)
    {
        $admin=Admin::findOrfail($id);
        $admin->delete();
        return redirect()->route('admin.index');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
