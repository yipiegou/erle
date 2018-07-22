@extends("template.admin.whole")
@section('title','商家类型添加')
@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleInputEmail1">商家类型名</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="商家类型名" name="name" value="{{old('name',$shop->name)}}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">状态</label>

                <label>
                    <input type="radio" name="states" value="1" {{$shop->states===1?'checked':''}}>启用
                </label>
                <label>
                    <input type="radio" name="states" value="0" {{$shop->states===0?'checked':''}}>停用
                </label>
        </div>
        <div class="form-group">
            <label for="exampleInputFile">图片</label>
            <input type="file" id="exampleInputFile" name="logo">
        </div>
        <img src="{{$shop->logo}}" class="">
        <button type="submit" class="btn btn-success">提交</button>
    </form>
@endsection