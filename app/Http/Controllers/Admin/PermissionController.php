<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(){
        $permission = Permission::all();
        //显示视图
        return view('admin.permission.index',compact('permission'));
    }

    /**
     * 添加权限
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();
            $permission = Permission::create($data);


            return redirect()->route('admin.permission.index');
        }
        //显示视图
        return view('admin.permission.add');
    }

    /**
     * 修改权限
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request,$id)
    {
        $permission = Permission::find($id);
        if ($request->isMethod('post')) {
            $data = $request->input();
            $permission->update($data);


            return redirect()->route('admin.permission.index');
        }
        //显示视图
        return view('admin.permission.edit',compact('permission'));
    }
    /**
     * 删除权限
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function del($id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        return redirect()->route('admin.permission.index');
    }
}
