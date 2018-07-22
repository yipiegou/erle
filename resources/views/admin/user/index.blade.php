@extends("template.admin.whole")
@section('title','商家类型')
@section('content')
    <a href="{{route('admin.user.add')}}">添加</a>
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
            <td>
                <form action="{{route('admin.user.edit',$user)}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="status" value="{{$user->status===0?'1':'0'}}">
                    <input type="submit" value="{{$user->status===0?'启用':'禁用'}}">
                </form>
            </td>
            <td>
                <a href="{{route("admin.user.sel",$user)}}">查看商铺</a>
                <a href="{{route("admin.user.edit",$user)}}">编辑</a>
                <a href="{{route("admin.user.del",$user)}}">删除</a>
            </td>
        </tr>
        @endforeach
    </table>
@endsection