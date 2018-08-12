@extends("template.shop.whole")
@section('title','销量首页')
@section('content')
    <form class="form-inline" method="get" action="">
        <div class="form-group">
            <input type="hidden" name="max" value="1"/>
        </div>
        <button type="submit" class="btn btn-default">按月</button>
    </form>
    <table class="table table-bordered">
        <tr>
            <th>时间</th>
            <th>商品名</th>
            <th>数量</th>
            <th>金额</th>
        </tr>
        @foreach($query as $quer)
        <tr>
            <td>{{$quer->date}}</td>
            <td>{{$quer->goods_name}}</td>
            <td>{{$quer->nums}}</td>
            <td>{{$quer->nums*$quer->money}}</td>
        </tr>
        @endforeach
    </table>
    {{--->appends(['min' => old("min")?old("min"):0,'max' => old("max")?old("max"):time()])--}}
@endsection