@extends("template.admin.whole")
@section('title','抽奖活动添加')
@section('content')
@include('vendor.ueditor.assets')
    <form action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <label>活动</label>
        <select class="form-control" name="events_id">
            @foreach($events as $event)
                <option value="{{$event->id}}">{{$event->title}}</option>
            @endforeach
        </select>
        <div class="form-group">
            <label for="exampleInputname1">奖品名称</label>
            <input type="text" class="form-control" id="exampleInputname1" placeholder="奖品名称" name="name">
        </div>
        <label for="exampleInputname1">奖品详情</label>
        <!-- 编辑器容器 -->
        <script id="description" name="description" type="text/plain"></script>
        <!-- 实例化编辑器 -->
        <script type="text/javascript">
            var ue = UE.getEditor('description');
            ue.ready(function() {
                ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
            });
        </script>
        <button type="submit" class="btn btn-success">提交</button>
    </form>
@endsection