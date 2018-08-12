@extends("template.admin.whole")
@section('title','活动首页')
@section('content')
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>标题</th>
            <th>开奖时间</th>
            <th>报名开始时间</th>
            <th>报名结束时间</th>
            <th>最大报名人数</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($events as $event)
        <tr>
            <td>{{$event->id}}</td>
            <td>{{$event->title}}</td>
            <td>{{date('Y-m-d',$event->prize_date)}}</td>
            <td>{{date('Y-m-d',$event->signup_start)}}</td>
            <td>{{date('Y-m-d',$event->signup_end)}}</td>
            <td>{{$event->signup_num}}</td>
            <td>{{$event->is_prize===1?'已开奖':'未开奖'}}</td>
            <td>
                <a href="{{route("admin.event.edit",$event)}}">编辑</a>
                <a href="{{route("admin.event.del",$event)}}">删除</a>
                <a href="{{route("admin.event.open",$event)}}">开奖</a>
            </td>
        </tr>
        @endforeach
    </table>
    {{$events->links()}}
@endsection