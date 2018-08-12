@extends("template.admin.whole")
@section('title','导航条数据添加')
@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleInputname1">菜单</label>
            <input type="text" class="form-control" id="exampleInputname1" placeholder="名字" name="name" value="{{$na->name}}">
        </div>
        <label for="exampleInputEmail1">上级目录</label><br/>
        <select class="form-control" name="pid">
            <option value="0">一级目录</option>
            @foreach($nav as $n)
                <option value="{{$n->id}}" {{$na->pid==$n->id?'selected':''}}>{{$n->name}}</option>
            @endforeach
        </select>
        <label for="exampleInputEmail1">路由</label><br/>
        <select class="form-control" name="url">
            @foreach($url as $u)
                <option value="{{$u}}" {{$na->url==$u?'selected':''}}>{{$u}}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-success">提交</button>
    </form>
@endsection