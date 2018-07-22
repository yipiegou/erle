@extends("template.admin.whole")
@section('title','商家类型')
@section('content')
    <a href="{{route('user.add')}}">添加</a>
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>类名</th>
            <th>邮箱</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->status===0?'禁用':'启用'}}</td>
            <td>
                <a href="{{route("shopcate.edit",$user)}}">编辑</a>
                <a href="{{route("shopcate.del",$user)}}">删除</a>
            </td>
        </tr>
        @endforeach
    </table>
@endsection