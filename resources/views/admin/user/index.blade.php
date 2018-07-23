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
                    {{$user->status===0?'禁用':'启用'}}
            </td>
            <td>
                @if($user->status===0)
                    <a href="{{route("admin.user.auditing",$user)}}">审核</a>
                @endif
                <a href="{{route("admin.user.selete",$user)}}">查看商铺</a>
                <a href="{{route("admin.user.reset",$user)}}">重置密码</a>
                <a href="{{route("admin.user.edit",$user)}}">编辑</a>
                <a href="{{route("admin.user.del",$user)}}" onclick="return confirm('删除商户会把商铺也删除了确认删除吗！')">删除</a>
            </td>
        </tr>
        @endforeach
    </table>
    {{ $users->links() }}
@endsection