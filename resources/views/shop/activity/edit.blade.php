@extends("template.shop.whole")
@section('title','活动修改')
@section('content')
    <table class="table table-bordered">
        <tr>
            <th>标题</th>
            <td>{{$activity->title}}</td>
        </tr>
        <tr>
            <th>内容</th>
            <td>{!! $activity->content !!}</td>
        </tr>
        <tr>
            <th>开始时间</th>
            <td>{{date('Y-m-d',$activity->start_time)}}</td>
        </tr>
        <tr>
            <th>结束时间</th>
            <td>{{date('Y-m-d',$activity->end_time)}}</td>
        </tr>
    </table>
@endsection