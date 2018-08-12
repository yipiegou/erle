<?php

namespace App\Http\Controllers\Admin;

use App\Models\Nav;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class NavController extends BaseController
{
    public function index(){
        $navs = Nav::all();
        return view('admin.nav.index',compact('navs'));
    }

    /**
     * 导航条首页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function add(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->all();
            Nav::create($data);
            return redirect()->route('admin.nav.index');
        }
        //上级目录
        $nav = Nav::where('pid',0)->get();
        //得到所有admin的路由
        $url = $this->url();
        //显示视图
        return view('admin.nav.add',compact('url','nav'));
    }
    public function edit(Request $request,$id){
       $na = Nav::find($id);
        if ($request->isMethod('post')) {
            $data = $request->all();
            $na->update($data);
            return redirect()->route('admin.nav.index');
        }
        //上级目录
        $nav = Nav::where('pid',0)->get();
        //得到所有admin的路由
        $url = $this->url();
        //显示视图
        return view('admin.nav.edit',compact('url','nav','na'));
    }
    public function del($id){
        if (Nav::where('pid',$id)->get()) {
            return redirect()->route('admin.nav.index')->with('success','目录下存在子目录无法删除');
        }
        Nav::findOrFile($id)->delete();
        return redirect()->route('admin.nav.index')->with('success','目录删除成功');
    }
}
