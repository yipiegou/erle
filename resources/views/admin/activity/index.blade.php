@extends("template.admin.whole")
@section('title','活动首页')
@section('content')
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>标题</th>
            <th>开始时间</th>
            <th>结束时间</th>
            <th>操作</th>
        </tr>
        @foreach($activity as $activit)
        <tr>
            <td>{{$activit->id}}</td>
            <td>{{$activit->title}}</td>
            <td>{{date('Y-m-d',$activit->start_time)}}</td>
            <td>{{date('Y-m-d',$activit->end_time)}}</td>
            <td>
                <a href="{{route("activity.edit",$activit)}}">编辑</a>
                <a href="{{route("activity.del",$activit)}}">删除</a>
            </td>
        </tr>
        @endforeach
    </table>
    {{$activity->links()}}
@endsection