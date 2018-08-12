@extends("template.admin.whole")
@section('title','活动添加')
@section('content')
@include('vendor.ueditor.assets')
    <form action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleInputEmail1">标题</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="标题" name="title">
        </div>

        <!-- 编辑器容器 -->
        <script id="container" name="content" type="text/plain"></script>
        <!-- 实例化编辑器 -->
        <script type="text/javascript">
            var ue = UE.getEditor('container');
            ue.ready(function() {
                ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
            });
        </script>
        <div class="form-group">
            <label for="exampleInputFile">开始时间</label>
            <input type="date" id="exampleInputFile" name="start_time">
        </div>
        <div class="form-group">
            <label for="exampleInputFile2">结束时间</label>
            <input type="date" id="exampleInputFile2" name="end_time">
        </div>
        <button type="submit" class="btn btn-success">提交</button>
    </form>
@endsection