<?php

namespace App\Http\Controllers\Shop;

use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends BaseController
{
    /**
     * 只显示当前登录商户自身的菜品类
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){
        $vale = '%';
        $min = 0;
        $man = 100000000000000;
        $data = $request->all();
        if(isset($data['goods_name'])){
            $vale = $data['goods_name'];
        }
        if(isset($data['min'])){
            $min = $data['min'];
        }
        if(isset($data['man'])){
            $man = $data['man'];
        }
        $menus = Menu::where('shop_id','=',Auth::user()->shop_id)
                    ->where('goods_price','>',$min)
                    ->where('goods_price','<',$man)
                    ->where('goods_name','like','%'.$vale.'%')
                    ->get();
        //dd($menus);
        return view('shop.menu.index',compact('menus'));
    }

    /**
     * 添加
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function add(Request $request){
        $menuss = MenuCategory::where('shop_id','=',Auth::user()->shop_id)->get();
        if ($request->isMethod('post')) {
            $this->validate($request,[
                'goods_name'=>'required|max:10',
                'description'=>'required',
                'category_id'=>'required',
                'goods_price'=>'required',
                'tips'=>'required',
                'is_selected'=>'required',
                'logo'=>'required',
            ]);
            $data = $request->all();
            //dd($_FILES);
            //dd($request->file('goods_img'));
            if($request->file('goods_img')){
                $logo = $request->file('goods_img')->store("menu");
                //dd($logo);
                $data['goods_img'] = env('ALIYUN_OSS_URL').$logo;
            }
            dd($data);
            $data['shop_id'] = Auth::user()->shop_id;
            Menu::create($data);
            return redirect()->route('menu.index')->with('success','添加成功');
        }
        return view('shop.menu.add',compact('menuss'));
    }

    /**
     * 编辑
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function edit(Request $request,$id){
        $menu = Menu::find($id);
        $menuss = MenuCategory::where('shop_id','=',Auth::user()->shop_id)->get();
        if(Auth::user()->shop_id!=$menu->shop_id){
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
            if($request->file('logo')){
                $logo = $request->file('logo')->store("menu");
                $data['logo'] = '/storage/'.$logo;
            }
            $menu->update($data);
            session()->flash('success','编辑成功');
            return redirect()->route('menu.index');
        }
        return view('shop.menu.edit',compact('menu','menuss'));
    }
    public function del(Request $request,$id){
        $menu = Menu::findOrFail($id);
        if(Auth::user()->shop_id!=$menu->shop_id){
            session()->flash('success','你没有权限这样做');
            return redirect(url()->previous());
        }
        $menu->delete();
        session()->flash('success','删除成功');
        return redirect()->route('menu.index');
    }
}
