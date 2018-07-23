@extends("template.shop.whole")
@section('title','菜品类型添加')
@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleInputname1">菜品名</label>
            <input type="text" class="form-control" id="exampleInputname1" placeholder="菜品名" name="goods_name">
        </div>
        <div class="form-group">
            <label for="exampleInputtextarea3">菜品描述</label><br/>
            <textarea name="description" id="exampleInputtextarea3" cols="80" rows="3"></textarea>
        </div>
        <label>菜品分类</label>
        <select class="form-control" name="category_id">
            <option value="">请选择</option>
            @foreach($menuss as $menus)
                <option value="{{$menus->id}}">{{$menus->name}}</option>
            @endforeach
        </select>
        <div class="form-group">
            <label for="exampleInputtextarea4">菜品价钱</label><br/>
            <input type="text" class="form-control" id="exampleInputtextarea4" placeholder="菜品价钱" name="goods_price">
        </div>
        <div class="form-group">
            <label for="exampleInputtextarea4">提示信息</label><br/>
            <input type="text" class="form-control" id="exampleInputtextarea4" placeholder="提示信息" name="tips">
        </div>
        <div class="form-group">
            <label for="exampleInputFile">菜品图片</label>
            <input type="file" id="exampleInputFile" name="goods_img">
        </div>
        <div class="form-group">
            <label for="exampleInputtextarea1">是否上架</label><br/>
            <label class="radio-inline">
                <input type="radio" name="is_selected" id="inlineRadio1" value="1" checked>是
            </label>
            <label class="radio-inline">
                <input type="radio" name="is_selected" id="inlineRadio2" value="0">否
            </label>
        </div>
        <button type="submit" class="btn btn-success">提交</button>
    </form>
@endsection