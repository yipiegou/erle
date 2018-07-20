<?php

namespace App\Http\Controllers\Admin;

use App\Models\ShopCategorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ShopCategoryController extends Controller
{
    /**
     * 首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //获取数据
        $categs = ShopCategorie::all();
        //显示视图 传递数据
        return view('admin.shopcate.index',compact('categs'));
    }

    /**
     * 添加
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
//            $request->validate([
//                'name'=>'required',
//                'states'=>'required'
//            ]);
            $data = $request->all();
            if($request->file('logo')){
                $logo = $request->file('logo')->store("books");
                $data['logo'] = '/storage/'.$logo;
            }
            ShopCategorie::create($data);
            return redirect()->route('shopcate.index');
        }
        //显示视图
        return view('admin.shopcate.add');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request,$id)
    {
        $shop = ShopCategorie::find($id);
        if ($request->isMethod('post')) {
            ShopCategorie::create($request->all());
            return redirect()->route('shopcate.index');
        }
        return view('admin.shopcate.edit',compact('shop'));
    }

    /**
     * 删除
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function del(Request $request,$id)
    {
        $shop=ShopCategorie::findOrfail($id);
        File::delete($shop->logo);
        $shop->delete();
        return redirect()->route('shopcate.index');
    }
}
