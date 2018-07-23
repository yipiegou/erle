@extends("template.admin.whole")
@section('title','商家类型')
@section('content')
    <a href="{{route('shopcate.add')}}">添加</a>
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>类名</th>
            <th>图片</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($categs as $categ)
        <tr>
            <td>{{$categ->id}}</td>
            <td>{{$categ->name}}</td>
            <td><img src="{{$categ->logo}}" ></td>
            <td>{{$categ->states}}</td>
            <td>
                <a href="{{route("shopcate.edit",$categ)}}">编辑</a>
                <a href="{{route("shopcate.del",$categ)}}">删除</a>
            </td>
        </tr>
        @endforeach
    </table>
    {{$categs->links()}}
@endsection