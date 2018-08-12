@extends("template.admin.whole")
@section('title','权限修改')
@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleInputname1">权限</label>
            <input type="text" class="form-control" id="exampleInputname1" placeholder="权限" name="name" value="{{$permission->name}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">ddd</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="email" name="guard_name" value="{{$permission->guard_name}}">
        </div>
        <button type="submit" class="btn btn-success">提交</button>
    </form>
@endsection