@extends("template.admin.whole")
@section('title','活动修改')
@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleInputEmail1">标题</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="标题" name="title" value="{{$activity->title}}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">内容</label><br/>
            <textarea name="content" id="exampleInputPassword1" cols="80" rows="3">{{$activity->content}}</textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputFile">开始时间</label>
            <input type="date" id="exampleInputFile" name="start_time" value="{{date('Y-m-d',$activity->start_time)}}">
        </div>
        <div class="form-group">
            <label for="exampleInputFile2">结束时间</label>
            <input type="date" id="exampleInputFile2" name="end_time"  value="{{date('Y-m-d',$activity->end_time)}}">
        </div>
        <button type="submit" class="btn btn-success">提交</button>
    </form>
@endsection