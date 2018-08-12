<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CartController extends BaseController
{
    /**
     * 提交购物车
     * @return array
     */
    public function addCart(){
        $data = \request()->all();
        $validator = Validator::make($data,[
            'user_id' => 'required',
            'goodsList' => 'required',
            'goodsCount' => 'required',
        ]);
        //验证 如果有错
        if ($validator->fails()) {
            //返回错误
            return [
                'status' => "false",
                //获取错误信息
                "message" => $validator->errors()->first()
            ];
        }
        //dd($data);
        $cart = Cart::where('user_id',$data['user_id'])->delete();
        foreach ($data['goodsList'] as $k=>$v):
            $a = [
                'user_id' => $data['user_id'],
                'goods_id' => $data['goodsList'][$k],
                'amount' => $data['goodsCount'][$k]
            ];
            Cart::create($a);
        endforeach;
        return [
            "status" => "true",
            "message" => "添加成功"
        ];
    }
    public function cart(Request $request){
        $data = $request->all();
        $cart = Cart::where('user_id',$data['user_id'])->get();
        $totalCost = 0;
        foreach ($cart as $k=>$v):
            $good = Menu::where('id','=',$v['goods_id'])->first(['id as goods_id','goods_name','goods_img','goods_price']);

            $good->amount = $v['amount'];
            $totalCost+=$good->goods_price*$v['amount'];
            $goodslist[] = $good;
        endforeach;
        return [
            'goods_list'=>$goodslist,
            'totalCost'=>$totalCost
        ];
    }
}
