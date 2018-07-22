@extends("template.admin.whole")
@section('title','管理员添加')
@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="status" value="1">
        <div class="form-group">
            <label for="exampleInputname1">用户名</label>
            <input type="text" class="form-control" id="exampleInputname1" placeholder="用户名" name="name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">email</label>
            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="email" name="email">
        </div>
        <div class="form-group">
            <label for="exampleInputpassword1">密码</label>
            <input type="password" class="form-control" id="exampleInputpassword1" placeholder="密码" name="password">
        </div>
        </select>
        <button type="submit" class="btn btn-success">提交</button>
    </form>
@endsection