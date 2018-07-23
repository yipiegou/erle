<?php

namespace App\Http\Controllers\Shop;


use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MenuCategoryController extends BaseController
{
    /**
     * 只显示当前登录商户自身的菜品类
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        $menuss = MenuCategory::where('shop_id','=',Auth::user()->shop_id)->get();

        return view('shop.menus.index',compact('menuss'));
    }

    /**
     * 添加
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function add(Request $request){
        if ($request->isMethod('post')) {
            $this->validate($request,[
                'name'=>'required|max:10',
                'description'=>'required',
                'type_accumulation'=>'required|max:10',
            ]);
            $data = $request->all();
            $menuss = MenuCategory::where('shop_id','=',Auth::user()->shop_id)->orwhere('type_accumulation','=','true')->count();
            if ($menuss) {
                session()->flash('success','已经存在一个默认类');
                return redirect(url()->previous());
            }
            $data['shop_id'] = Auth::user()->shop_id;
            MenuCategory::create($data);
            session()->flash('success','添加成功');
            return redirect()->route('menus.index');
        }
        return view('shop.menus.add');
    }

    /**
     * 编辑
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function edit(Request $request,$id){
        $menus = MenuCategory::find($id);
        if(Auth::user()->shop_id!=$menus->shop_id){
            session()->flash('success','你没有权限这样做');
            return redirect(url()->previous());
        }
        if ($request->isMethod('post')) {
            $this->validate($request,[
                'name'=>'required|max:10',
                'description'=>'required',
                'type_accumulation'=>'required|max:10',
            ]);
            $data = $request->all();
            $menuss = MenuCategory::where('shop_id','=',Auth::user()->shop_id)->orwhere('type_accumulation','=','true')->count();
            if ($menuss) {
                session()->flash('success','已经存在一个默认类');
                return redirect(url()->previous());
            }
            $name = MenuCategory::where('shop_id','=',Auth::user()->shop_id)->orwhere('name','=',$data['name'])->count();
            if ($name) {
                session()->flash('success','已经存在一个默认类');
                return redirect(url()->previous());
            }
            $menus->update($data);
            session()->flash('success','编辑成功');
            return redirect()->route('menus.index');
        }
        return view('shop.menus.edit',compact('menus'));
    }
    public function del(Request $request,$id){
        $menus = MenuCategory::findOrFail($id);
        if(Auth::user()->shop_id!=$menus->shop_id){
            session()->flash('success','你没有权限这样做');
            return redirect(url()->previous());
        }
        $menu = Menu::where('category_id','=',$id)->count();
        if ($menu) {
            session()->flash('success','该菜品类下还存在菜品不能删除');
            return redirect(url()->previous());
        }
        $menus->delete();
        session()->flash('success','删除成功');
        return redirect()->route('menus.index');
    }
}
