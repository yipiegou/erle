<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderGood;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class OrderController extends BaseController
{
    //所有
    public function index(Request $request)
    {
        $data = $request->all();
        $min = strtotime($data['min']??0);
        $max = time();
        if (isset($data['max'])){
            $max = strtotime($data['max'])+86399;
        }
        //dd($max);
        $orders = Order::where('order_birth_time','>',$min)
            ->where('order_birth_time','<',$max)
            ->paginate(5);
        $status = [
            '-1' => '已取消',
            '0' => '待支付',
            '1' => '待发货',
            '2' => '待确认',
            '3' => '已完成',
        ];
        foreach ($orders as $order):
            $order->status = $status[$order->status];
        endforeach;
        return view('admin/order/index',compact('orders'));
    }
    public function selete($id){
        $order = Order::where('id',$id)->first();
        $status = [
            '-1' => '已取消',
            '0' => '待支付',
            '1' => '待发货',
            '2' => '待确认',
            '3' => '已完成',
        ];
        $order->status = $status[$order->status];
        $order->orderSelete = OrderGood::where('orders_id',$order->id)->get();
        return view('admin/order/selete',compact('order'));
    }
    public function menu(){
        $data=\request()->input("max");
        $data = isset($data)==1?'%Y-%m':'%Y-%m-%d';
        $query = DB::select("SELECT DATE_FORMAT(created_at, '".$data."') AS date,goods_id,goods_name,goods_price as money,SUM(amount) as nums
FROM order_goods WHERE orders_id IN (SELECT id from orders) GROUP BY date,money,goods_id,goods_name,goods_id");
        return view('admin/order/menu',compact('query'));
    }
}
