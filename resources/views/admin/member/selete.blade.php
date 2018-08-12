@extends("template.admin.whole")
@section('title','商家类型')
@section('content')
    <table class="table table-bordered">
        <tr>
            <th>会员名</th>
            <td>{{$user->username}}</td>
        </tr>
        <tr>
            <th>联系电话</th>
            <td>{{$user->tel}}</td>
        </tr>
        @foreach($user->order as $order)
        <tr>
            <th>订单号</th>
            <td>{{$order->order_code}}</td>
        </tr>
        <tr>
            <th>店铺名</th>
            <td>{{$order->shop->shop_name}}</td>
        </tr>
        @endforeach
    </table>
@endsection