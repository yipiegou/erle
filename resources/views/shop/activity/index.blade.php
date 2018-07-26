@extends("template.shop.whole")
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
                <a href="{{route("shop.activity.edit",$activit)}}">查看</a>
            </td>
        </tr>
        @endforeach
    </table>
@endsection