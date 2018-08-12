<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Role;

class AdminController extends BaseController
{
    /**
     * 首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //获取数据
        $admin = Admin::paginate(4);
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
            $admin = Admin::create($data);
            //dd($request->post('role'));
            $admin->syncRoles($request->post('role'));

            return redirect()->route('admin.index');
        }
        //用户组
        $role = Role::all();
        //显示视图
        return view('admin.admin.add',compact('role'));
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
            $admin->syncRoles($request->post('role'));
            return redirect()->route('admin.index');
        }
        //用户组
        $role = Role::all();
        //显示视图
        return view('admin.admin.edit',compact('admin','role'));
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
        if($admin->id==1){
            return back()->withErrors(['超级管理员不能删除！']);
        }
        $admin->delete();
        return redirect()->route('admin.index');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
