@extends("template.admin.whole")
@section('title','抽奖活动修改')
@section('content')
    @include('vendor.ueditor.assets')
    <form action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleInputEmail1">标题</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="标题" name="title" value="{{$event->title}}">
        </div>

        <!-- 编辑器容器 -->
        <script id="container" name="content" type="text/plain">{!! $event->content !!}</script>
        <!-- 实例化编辑器 -->
        <script type="text/javascript">
            var ue = UE.getEditor('container');
            ue.ready(function() {
                ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
            });
        </script>
        <div class="form-group">
            <label for="exampleInputFile">报名开始时间</label>
            <input type="date" id="exampleInputFile" name="signup_start" value="{{date('Y-m-d',$event->signup_start)}}">
        </div>
        <div class="form-group">
            <label for="exampleInputFile2">报名截止时间</label>
            <input type="date" id="exampleInputFile2" name="signup_end"  value="{{date('Y-m-d',$event->signup_end)}}">
        </div>
        <div class="form-group">
            <label for="exampleInputFile2">开奖时间</label>
            <input type="date" id="exampleInputFile2" name="prize_date" value="{{date('Y-m-d',$event->prize_date)}}">
        </div>
        <div class="form-group">
            <label for="exampleInputFile2">报名人数限制</label>
            <input type="text" id="exampleInputFile2" onkeyup="value=value.replace(/[^\d]/g,'')" name="signup_num" placeholder="只能输入数字" value="{{$event->signup_num}}">
        </div>
        @if($event->signup_end < time())
        <button  class="btn btn-success">报名已截止</button>
            @else
            <button type="submit" class="btn btn-success">提交</button>
        @endif
    </form>
@endsection