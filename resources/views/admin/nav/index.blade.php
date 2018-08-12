@extends("template.admin.whole")
@section('title','用户组首页')
@section('content')
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>name</th>
            <th>路由</th>
            <th>上级目录id</th>
            <th>操作</th>
        </tr>
        @foreach($navs as $nav)
        <tr>
            <td>{{$nav->id}}</td>
            <td>{{$nav->name}}</td>
            <td>{{$nav->url}}</td>
            <td>{{$nav->pid}}</td>
            <td>
                <a href="{{route('admin.nav.edit',$nav)}}">修改</a>
                <a href="{{route('admin.nav.del',$nav)}}">删除</a>
            </td>
        </tr>
        @endforeach
    </table>
@endsection