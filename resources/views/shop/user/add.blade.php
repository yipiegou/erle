@extends("template.shop.whole")
@section('title','注册')
@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
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
        <div class="form-group">
            <label for="exampleInputshopname1">商铺名称</label>
            <input type="text" class="form-control" id="exampleInputshopname1" placeholder="商铺名称" name="shop_name">
        </div>
        <label>店铺分类</label>
        <select class="form-control" name="shop_category_id">
            <option value="">请选择</option>
            @foreach($shop as $row)
                <option value="{{$row->id}}">{{$row->name}}</option>
            @endforeach
        </select>
        <div class="form-group">
            <label for="exampleInputFile">店铺图片</label>
            <input type="file" id="exampleInputFile" name="shop_logo">
        </div>
        <div class="form-group">
            <label>是否品牌</label>
            <label>
                <input type="radio" name="brand" value="1" checked>是
            </label>
            <label>
                <input type="radio" name="brand" value="0">否
            </label>
        </div>
        <div class="form-group">
            <label>是否准时送达</label>
            <label>
                <input type="radio" name="on_time" value="1" checked>是
            </label>
            <label>
                <input type="radio" name="on_time" value="0">否
            </label>
        </div>
        <div class="form-group">
            <label>是否蜂鸟配送</label>
            <label>
                <input type="radio" name="fengniao" value="1" checked>是
            </label>
            <label>
                <input type="radio" name="fengniao" value="0">否
            </label>
        </div>
        <div class="form-group">
            <label>是否保标记</label>
            <label>
                <input type="radio" name="bao" value="1" checked>是
            </label>
            <label>
                <input type="radio" name="bao" value="0">否
            </label>
        </div>
        <div class="form-group">
            <label>是否票标记</label>
            <label>
                <input type="radio" name="piao" value="1" checked>是
            </label>
            <label>
                <input type="radio" name="piao" value="0">否
            </label>
        </div>
        <div class="form-group">
            <label>是否准标记</label>
            <label>
                <input type="radio" name="zhun" value="1" checked>是
            </label>
            <label>
                <input type="radio" name="zhun" value="0">否
            </label>
        </div>
        <div class="form-group">
            <label for="exampleInputstartsend1">起送金额</label>
            <input type="text" class="form-control" id="exampleInputstartsend1" placeholder="起送金额" name="start_send">
        </div>
        <div class="form-group">
            <label for="exampleInputstartsend1">配送费</label>
            <input type="text" class="form-control" id="exampleInputstartsend1" placeholder="配送费" name="send_cost">
        </div>
        <div class="form-group">
            <label for="exampleInputnotice1">店公告</label><br/>
            <textarea name="notice" id="exampleInputnotice1" cols="80" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputdiscount1">优惠信息</label><br/>
            <textarea name="discount" id="exampleInputdiscount1" cols="80" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-success">提交</button>
    </form>
@endsection