@extends("template.shop.whole")
@section('title','密码修改')
@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="name" value="{{$user->name}}">
        <table class="table-bordered">
            <tr>
                <th>用户名</th>
                <td>{{$user->name}}</td>
            </tr>
            <tr>
                <th>原密码</th>
                <td><input type="password" name="password" class="input-group"></td>
            </tr>
            <tr>
                <th>新密码</th>
                <td><input type="password" name="password1" class="input-group"></td>
            </tr>
            <tr>
                <th>确认密码</th>
                <td><input type="password" name="password2" class="input-group"></td>
            </tr>
        </table>
        <button type="submit" class="btn btn-success">提交</button>
    </form>
@endsection