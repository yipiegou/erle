@extends("template.shop.whole")
@section('title','订单首页')
@section('content')
    <form class="form-inline" method="post">
        <div class="form-group">
            <label class="sr-only" for="exampleInputEmail3">Email address</label>
            <input type="date" class="form-control" id="exampleInputEmail3" name="min" value="{{request()->input('min')}}"/>
        </div>
        <div class="form-group">
            <label class="sr-only" for="exampleInputPassword3">Password</label>
            <input type="date" class="form-control" id="exampleInputPassword3" name="max" value="{{request()->input('max')}}"/>
        </div>
        <button type="submit" class="btn btn-default">查询</button>
    </form>
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>收货人</th>
            <th>联系电话</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($orders as $order)
        <tr>
            <td>{{$order->id}}</td>
            <td>{{$order->name}}</td>
            <td>{{$order->tel}}</td>
            <td>{{$order->status}}</td>
            <td>
                <a href="{{route("order.selete",$order)}}">查看订单</a>
                <a href="{{route("order.edit",$order)}}">确认送餐</a>
                <a href="{{route("order.del",$order)}}">取消订单</a>
            </td>
        </tr>
        @endforeach
    </table>
    {{--->appends(['min' => old("min")?old("min"):0,'max' => old("max")?old("max"):time()])--}}
    {{$orders->links()}}
@endsection