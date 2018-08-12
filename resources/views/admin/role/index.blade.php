@extends("template.admin.whole")
@section('title','用户组首页')
@section('content')
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>name</th>
            <th>guard_name</th>
            <th>权限</th>
            <th>操作</th>
        </tr>
        @foreach($role as $p)
        <tr>
            <td>{{$p->id}}</td>
            <td>{{$p->name}}</td>
            <td>{{$p->guard_name}}</td>
            <td>{{ str_replace(['[',']','"'],'', $p->permissions()->pluck('name')) }}</td>
            <td>
                <a href="{{route('admin.role.edit',$p)}}">修改</a>
                <a href="{{route('admin.permission.del',$p)}}">删除</a>
            </td>
        </tr>
        @endforeach
    </table>
@endsection