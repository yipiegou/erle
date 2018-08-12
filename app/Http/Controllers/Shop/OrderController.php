<?php

namespace App\Http\Controllers\Shop;

use App\Models\Member;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderGood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{
    /**
     * 订单首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){
        $data = $request->all();
       // dd($data);
        $min = strtotime($data['min']??0);
        $max = time();
        if (isset($data['max'])){
            $max = strtotime($data['max'])+86399;
        }

        $orders = Order::where('shop_id','=',Auth::user()->shop_id)
            ->where('order_birth_time','>',$min)
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
        return view('shop/order/index',compact('orders'));
    }

    /**
     * 发货
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit($id){
        $order = Order::where('id',$id)->first();
        if($order->status != 0){
            session()->flash('success','该订单已发货或已取消订单');
            return redirect(url()->previous());
        }
        $order->status = 2;
        $order->save();
        session()->flash('success','发货成功');
        return redirect(url()->previous());
    }

    /**
     * 取消订单
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function del($id){
        $order = Order::where('id',$id)->first();
        if($order->status == 3){
            session()->flash('success','该订单已完成无法取消订单');
            return redirect(url()->previous());
        }
        if($order->status == -1){
            session()->flash('success','该订单已被取消');
            return redirect(url()->previous());
        }
        $member = Member::where('id',$order->user_id)->first();
        $member->money = $member->money + $order->order_price;
        $order->status = -1;
        $order->save();
        $member->save();
        session()->flash('success','取消订单成功');
        return redirect(url()->previous());
    }

    /**
     * 订单详情
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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
        return view('shop/order/selete',compact('order'));
    }

    /**
     * 每日
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function menu(){
        $data=\request()->input("max");
        //dd($data);
//        $member = Member::where('id',)->first();
//        $query = Menu::where('shop_id','=',Auth::user()->shop_id)->Select(DB::raw("DATE_FORMAT
//        (created_at, '%Y-%m-%d') AS date,goods_id,goods_name,SUM(amount) as nums"))
//            ->groupBy("date")->orderBy("date", 'desc');substr(“abcdef”, 0, -2)
//        $data = $request->all();  '".$data['max']."'
        $data = isset($data)==1?'%Y-%m':'%Y-%m-%d';
        $id = Auth::user()->shop_id;
//        dd($sql);
        $query = DB::select("SELECT DATE_FORMAT(created_at, '".$data."') AS date,goods_id,goods_name,goods_price as money,SUM(amount) as nums
FROM order_goods WHERE orders_id IN (SELECT id from orders where shop_id = ".$id.") GROUP BY date,money,goods_id,goods_name,goods_id");
        return view('shop/order/menu',compact('query'));
    }
}
