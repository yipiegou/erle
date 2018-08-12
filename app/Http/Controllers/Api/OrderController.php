<?php

namespace App\Http\Controllers\Api;

use App\Models\AddRey;
use App\Models\Cart;
use App\Models\Member;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderGood;
use App\Models\Shop;
use EasyWeChat\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;

class OrderController extends BaseController
{
    /**
     * 添加订单接口
     * @return array
     */
    public function addorder(){
        //接收数据
        $data = \request()->all();
        //根据接收到的地址id去地址
        $addrey = AddRey::find($data['address_id']);
        //根据接收到的会员id去购物车找菜品id和数量
        $carts = Cart::where('user_id',$data['user_id'])->get();
        //根据菜品id去找到商铺
        $menu = Menu::where('id',$carts[0]['goods_id'])->first();
        $data['shop_id'] = $menu->shop_id;
        //订单生成时间
        $data['order_birth_time'] = time();
        //生成唯一订单号
        $data['order_code'] = date('ymdhis',time()).rand(1000,9999);
        //姓名
        $data['name']=$addrey->name;
        //电话
        $data['tel']=$addrey->tel;
        //地址
        $data['provence']=$addrey->provence;
        $data['city']=$addrey->city;
        $data['area']=$addrey->area;
        $data['order_address']=$addrey->detail_address;
        //价格
        $data['order_price'] = 0;
        foreach ($carts as $v):
            $data['order_price'] += Menu::where('id',$v['goods_id'])->first()->goods_price*$v['amount'];
        endforeach;
        //把数据存到订单表中
        $order = Order::create($data);
        foreach ($carts as $v):
            $menu = Menu::where('id',$v['goods_id'])->first();
            $good['goods_name'] = $menu->goods_name;
            $good['goods_img'] = $menu->goods_img;
            $good['goods_price'] = $menu->goods_price;
            $good['goods_id'] = $v['goods_id'];
            $good['amount'] = $v['amount'];
            $good['orders_id'] = $order->id;
            $goods[] = OrderGood::create($good);
        endforeach;
//        $data['order_birth_time'] = date('Y-m-d H:i',time());
//        $shop = Shop::where('id',$data['shop_id'])->first();
//        $data['shop_name'] = $shop->shop_name;
//        $data['shop_name'] = $shop->shop_img;
//        $data['goods_list'] = $goods;
//        //dd($data);
        return [
              "status"=> "true",
              "message"=> "添加成功",
              "order_id"=>$order->id
        ];
    }

    /**
     * 获得指定订单接口
     * @return mixed
     */
    public function order(){
        $id = \request()->all();
        $order = Order::where('id',$id)->first();
       // return $order;
        $data['id'] = $id['id'];
        $data['order_code'] = $order->order_code;
        //return $data;
        $status = [
            '-1' => '已取消',
            '0' => '代付款',
            '1' => '待发货',
            '2' => '待确认',
            '3' => '已完成',
        ];
        $data['order_birth_time'] = date('Y-m-d H:i',$order->order_birth_time);
        $data['order_status'] = $status[$order->status];
        $data['shop_id'] = $order->shop_id;
        //return $data;
        $shop = Shop::where('id',$order->shop_id)->first();
        $data['shop_name'] = $shop->shop_name;
        $data['shop_img'] = $shop->shop_img;
        $data['goods_list'] = OrderGood::where('orders_id',$id['id'])->get();
        $data['order_price'] = $order->order_price;
        $data['order_address'] = $order->order_address;
//        "order_price": 120,
//        "order_address": "北京市朝阳区霄云路50号 距离市中心约7378米北京市朝阳区霄云路50号 距离市中心约7378米"
//    }
        return $data;
    }
    /**
     * 获得订单列表接口
     */
    public function orderList(){
        $id = \request()->all();
//return $id;
        $status = [
            '-1' => '已取消',
            '0' => '代付款',
            '1' => '待发货',
            '2' => '待确认',
            '3' => '已完成',
        ];
        $order =  Order::where('user_id',$id['user_id'])->get();
        foreach ($order as $value):
            $value->order_birth_time = date('Y-m-d H:i',$value->order_birth_time);
            $value->order_status = $status[$value->status];
            $shop = Shop::where('id',$value->shop_id)->first();
            $value->shop_name = $shop->shop_name;
            $value->shop_img = $shop->shop_img;
            $value->goods_list = OrderGood::where('orders_id',$value->id)->get();
            $orders[] = $value;
            //return $value;
        endforeach;
        return $orders;
    }
    public function pay(){
        $id = \request()->all();
        $order = Order::where('id',$id['id'])->first();
        if ($order->status == 1){
            return [
                "status"=> "false",
                "message"=> "该订单不需要支付"
            ];
        };
        $member = Member::where('id',$order['user_id'])->first();
        if ($order->money > $member->money){
            return [
            "status"=> "false",
            "message"=> "余额不足"
            ];
        };
        $member->money = $member->money - $order->order_price;
        $order->status = 1;
        //事务开启
        DB::beginTransaction();
        try{
            $member->save();
            $order->save();
            DB::commit();
        }catch (\Exception $e) {
            DB::rollBack();
            return [
                "status"=> "false",
                "message"=> $e->getMessage(),
            ];
        }catch (RarException $rarException) {
            DB::rollBack();
            return [
                "status"=> "false",
                "message"=> $rarException->getMessage(),
            ];
        }

        return [
            "status"=> "true",
            "message"=> "支付成功"
        ];
    }
    public function wxPay(Request $request){
        //得到订单
        $order=Order::find($request->input('id'));
        //1.创建操作微信的对象
        $app = new Application(config('wechat'));
        //2.得到支付对象
        $payment = $app->payment;
        //3.生成订单
        //3.1 订单配置
        $attributes = [
            'trade_type'       => 'NATIVE', // JSAPI，NATIVE，APP...
            'body'             => '源码点餐',
            'detail'           => '源码点餐详情',
            'out_trade_no'     => $order->order_code,
            'total_fee'        => $order->order_price*100, // 单位：分
            'notify_url'       => 'http://www.erle.com/api/order/ok', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            // 'openid'           => '当前用户的 openid', // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
            // ...
        ];
        //3.2 订单生成
        $order = new \EasyWeChat\Payment\Order($attributes);
        //4.统一下单
        $result = $payment->prepare($order);
//        dd($result->code_url);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
            //5.取出预支付链接
            $payUrl=  $result->code_url;
            //6.把支付链接生成二维码
            /*$qrCode = new QrCode($payUrl);
            header('Content-Type: '.$qrCode->getContentType());
            echo $qrCode->writeString();*/

            // Create a basic QR code
            $qrCode = new QrCode($payUrl);//地址
            $qrCode->setSize(200);//二维码大小

// Set advanced options
            $qrCode->setWriterByName('png');
            $qrCode->setMargin(10);
            $qrCode->setEncoding('UTF-8');
            $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH);//容错级别
            $qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
            $qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);
            $qrCode->setLabel('微信扫码支付', 16, public_path().'/assets/noto_sans.otf', LabelAlignment::CENTER);
            $qrCode->setLogoPath(public_path().'/assets/symfony.png');
            $qrCode->setLogoWidth(80);//logo大小


// Directly output the QR code
            header('Content-Type: '.$qrCode->getContentType());
            echo $qrCode->writeString();
            exit;
        }
    }
    //微信异步通知方法
    public function ok(){

        //1.创建操作微信的对象
        $app = new Application(config('wechat'));
        //2.处理微信通知信息
        $response = $app->payment->handleNotify(function($notify, $successful){
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
            //  $order = 查询订单($notify->out_trade_no);
            $order=Order::where("order_code",$notify->out_trade_no)->first();
            if (!$order) { // 如果订单不存在
                return 'Order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }
            // 如果订单存在
            // 检查订单是否已经更新过支付状态
            if ($order->status!==0) { // 假设订单字段“支付时间”不为空代表已经支付
                return true; // 已经支付成功了就不再更新了
            }
            // 用户是否支付成功
            if ($successful) {
                // 不是已经支付状态则修改为已经支付状态
                // $order->paid_at = time(); // 更新支付时间为当前时间
                $order->status = 1;//更新订单状态
            }

            $order->save(); // 保存订单

            return true; // 返回处理完成
        });

        return $response;

    }

    public function status(Request $request){
        return [
            'status' => Order::find($request->input('id'))->status
        ];
    }
}
