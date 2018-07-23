@extends("template.shop.whole")
@section('title','菜品类型添加')
@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleInputname1">菜品类名</label>
            <input type="text" class="form-control" id="exampleInputname1" placeholder="菜品类名" name="name">
        </div>
        <div class="form-group">
            <label for="exampleInputtextarea1">菜品类描述</label><br/>
            <textarea name="description" id="exampleInputtextarea1" cols="80" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputtextarea1">菜品类编号</label><br/>
            <input type="text" class="form-control" id="exampleInputname1" placeholder="菜品类编号" name="type_accumulation">
        </div>
        <div class="form-group">
            <label for="exampleInputtextarea1">是否是默认分类</label><br/>
            <label class="radio-inline">
                <input type="radio" name="is_selected" id="inlineRadio1" value="true">是
            </label>
            <label class="radio-inline">
                <input type="radio" name="is_selected" id="inlineRadio2" value="false" checked>否
            </label>
        </div>
        <button type="submit" class="btn btn-success">提交</button>
    </form>
@endsection