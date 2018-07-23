@extends("template.admin.whole")
@section('title','管理员登录')
@section('content')
    <form action="" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label for="exampleInputEmail1">用户名</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="用户名" name="name">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">密码</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember">记住我
            </label>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
@endsection