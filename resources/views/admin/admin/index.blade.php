@extends("template.admin.whole")
@section('title','商家类型')
@section('content')
    <a href="{{route('admin.add')}}">添加</a>
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>用户名</th>
            <th>邮箱</th>
            <th>操作</th>
        </tr>
        @foreach($admin as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>
                <a href="{{route("admin.edit",$user)}}">编辑</a>
                @if($user->id!=1)
                <a href="{{route("admin.del",$user)}}">删除</a>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
    {{$admin->links()}}
@endsection