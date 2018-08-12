@extends("template.admin.whole")
@section('title','权限首页')
@section('content')
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>name</th>
            <th>guard_name</th>
            <th>操作</th>
        </tr>
        @foreach($permission as $p)
        <tr>
            <td>{{$p->id}}</td>
            <td>{{$p->name}}</td>
            <td>{{$p->guard_name}}</td>
            <td>
                <a href="{{route('admin.permission.edit',$p)}}">修改</a>
                <a href="{{route('admin.permission.del',$p)}}">删除</a>
            </td>
        </tr>
        @endforeach
    </table>
@endsection