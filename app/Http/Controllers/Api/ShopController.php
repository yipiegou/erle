<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends BaseController
{
    public function list(Request $request)
    {
        $key = $request->input('keyword')??'%';
        $shop = Shop::where('shop_name','like','%'.$key.'%')->where('status',1)->get();
        foreach ($shop as $s):
            $s->distance= 637;
            $s->estimate_time= 30;
        endforeach;
        return $shop;
    }
    public function selete(Request $request){
        $id = $request->input('id');
        $shop = Shop::findOrFail($id);
            $shop->distance= 637;
            $shop->estimate_time= 30;
            $shop->commodity = MenuCategory::with('goodslist')->where('shop_id',$id)->get();
//            foreach ($shop->commodity as $c):
//                $c->goods_list = Menu::where('category_id',$c->id)->get();
//            endforeach;
        return $shop;
    }
}
