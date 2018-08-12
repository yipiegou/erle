<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){
        $role = Role::all();
        //显示视图
        return view('admin.role.index',compact('role'));
    }

    /**
     * 添加用户组
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $data['name'] = $request->input('name');
            $data['guard_name'] = $request->input('guard_name');
            //dd($data);
            $role = Role::create($data);
            //$role->syncPermissions($request->input('pey'));
            $role->syncPermissions($request->post('per'));
            return redirect()->route('admin.role.index');
        }
        //查询出所有的权限
        $permission = Permission::all();
        //显示视图
        return view('admin.role.add',compact('permission'));
    }

    /**
     * 修改权限
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request,$id)
    {
        $role = Role::find($id);
        if ($request->isMethod('post')) {
            $data['name'] = $request->input('name');
            $data['guard_name'] = $request->input('guard_name');
            $role->update($data);
            $role->syncPermissions($request->post('per'));
            return redirect()->route('admin.role.index');

            return redirect()->route('admin.role.index');
        }
        //查询出所有的权限
        $permission = Permission::all();
        //显示视图
        return view('admin.role.edit',compact('role','permission'));
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
