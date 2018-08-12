<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ShopController extends BaseController
{
    public function list(Request $request)
    {
        $key = $request->input('keyword');
        if ($key) {
            $shop = Shop::search($key)->where('status',1)->get();
            foreach ($shop as $s):
                $s->distance= 637;
                $s->estimate_time= 30;
            endforeach;
            return $shop;
        }else{
            if (Redis::get('shop:list')) {
                return Redis::get('shop:list');
            }else{
                $shop = Shop::where('status',1)->get();
            }
        }

        foreach ($shop as $s):
            $s->distance= 637;
            $s->estimate_time= 30;
        endforeach;
        Redis::setex('shop:list',60*60*24,$shop);
        return $shop;
    }
    public function selete(Request $request){
        $id = $request->input('id');
        if (Redis::get('shop:'.$id)) {
            return Redis::get('shop:'.$id);
        }
        $shop = Shop::findOrFail($id);
            $shop->distance= 637;
            $shop->estimate_time= 30;
            $shop->commodity = MenuCategory::with('goods_list')->where('shop_id',$id)->get();
//            foreach ($shop->commodity as $c):
//                $c->goods_list = Menu::where('category_id',$c->id)->get();
//            endforeach;
        Redis::setex('shop:'.$id,60*60*24,$shop);
        return $shop;
    }
}
