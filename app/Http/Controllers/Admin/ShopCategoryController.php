<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shop;
use App\Models\ShopCategorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ShopCategoryController extends BaseController
{
    /**
     * 首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //获取数据
        $categs = ShopCategorie::paginate(4);
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
            $this->validate($request,[
                'name'=>'required',
                'logo'=>'required',
            ]);
            $data = $request->all();
            if($request->file('logo')){
                $logo = $request->file('logo')->store("books");
                $data['logo'] = env('ALIYUN_OSS_URL').$logo;
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
            $this->validate($request,[
                'name'=>'required',
                'logo'=>'required',
            ]);
            $data = $request->all();
            if($request->file('logo')){
                $logo = $request->file('logo')->store("books");
                $data['logo'] = env('ALIYUN_OSS_URL').$logo;
                Storage::delete($shop->logo);
            }
            $shop->update($data);
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
        $unm = Shop::where('shop_category_id','=',$shop->id)->count();
        if($unm){
            return back()->withErrors(['该类下面还存在商铺不能删除']);
        }
        Storage::delete($shop->logo);
        $shop->delete();
        return redirect()->route('shopcate.index');
    }
}
