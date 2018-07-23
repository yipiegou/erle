@extends("template.shop.whole")
@section('title','商户首页')
@section('content')
    <form class="form-inline" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <input type="text" class="form-control" id="exampleInputEmail3" placeholder="菜品名" name="goods_name">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="exampleInputEmail3" placeholder="价格" name="min">
        </div>-
        <div class="form-group">
            <input type="text" class="form-control" id="exampleInputPassword3" placeholder="价格" name="man">
        </div>
        <button type="submit" class="btn btn-default">Sign in</button>
    </form>
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>名字</th>
            <th>店铺</th>
            <th>菜品类</th>
            <th>价格</th>
            <th>描述</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($menus as $menu)
        <tr>
            <td>{{$menu->id}}</td>
            <td>{{$menu->goods_name}}</td>
            <td>{{$menu->shop->shop_name}}</td>
            <td>{{$menu->menus->name}}</td>
            <td>{{$menu->goods_price}}</td>
            <td>{{$menu->description}}</td>
            <td>{{$menu->status}}</td>
            <td>
                <a href="{{route("menu.edit",$menu)}}">编辑</a>
                <a href="{{route("menu.del",$menu)}}">删除</a>
            </td>
        </tr>
        @endforeach
    </table>
    {{--{{$users->links()}}--}}
@endsection