@extends("template.shop.whole")
@section('title','商户首页')
@section('content')
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>类名</th>
            <th>邮箱</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        {{--@foreach($users as $user)--}}
        <tr>
            <td>{{$users->id}}</td>
            <td>{{$users->name}}</td>
            <td>{{$users->email}}</td>
            <td>{{$users->status===0?'禁用':'启用'}}</td>
            <td>
                <a href="{{route("user.edit",$users)}}">编辑</a>
                <a href="{{route("user.password",$users)}}">修改密码</a>
            </td>
        </tr>
        {{--@endforeach--}}
    </table>
    {{--{{$users->links()}}--}}
@endsection