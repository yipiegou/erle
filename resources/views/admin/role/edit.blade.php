@extends("template.admin.whole")
@section('title','用户组编辑')
@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleInputname1">权限</label>
            <input type="text" class="form-control" id="exampleInputname1" placeholder="权限" name="name" value="{{$role->name}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">ddd</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="email" name="guard_name" value="{{$role->guard_name}}">
        </div>
        <label for="exampleInputEmail1">权限</label><br/>
        @foreach($permission as $p)
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox1" name="per[]" value="{{$p->name}}" @if($role->hasPermissionTo($p->name)) checked @endif>{{$p->name}}
            </label><br/>
        @endforeach
        <button type="submit" class="btn btn-success">提交</button>
    </form>
@endsection