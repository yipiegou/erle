@extends("template.shop.whole")
@section('title','商户首页')
@section('content')
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>名字</th>
            <th>店铺</th>
            <th>描述</th>
            <th>是否默认分类</th>
            <th>操作</th>
        </tr>
        @foreach($menuss as $menus)
        <tr>
            <td>{{$menus->id}}</td>
            <td>{{$menus->name}}</td>
            <td>{{$menus->shop->shop_name}}</td>
            <td>{{$menus->description}}</td>
            <td>{{$menus->is_selected!=='false'?'是':'否'}}</td>
            <td>
                <a href="{{route("menus.edit",$menus)}}">编辑</a>
                <a href="{{route("menus.del",$menus)}}">删除</a>
            </td>
        </tr>
        @endforeach
    </table>
    {{--{{$users->links()}}--}}
@endsection