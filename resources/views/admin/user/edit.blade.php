@extends("template.admin.whole")
@section('title','商家类型添加')
@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleInputname1">用户名</label>
            <input type="text" class="form-control" id="exampleInputname1" placeholder="用户名" name="name" value="{{$user->name}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">email</label>
            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="email" name="email" value="{{$user->email}}">
        </div>
        </select>
        <div class="form-group">
            <label for="exampleInputshopname1">商铺名称</label>
            <input type="text" class="form-control" id="exampleInputshopname1" placeholder="商铺名称" name="shop_name" value="{{$shop->shop_name}}">
        </div>
        <label>店铺分类</label>
        <select class="form-control" name="shop_category_id">
            <option value="">请选择</option>
            @foreach($shops as $row)
                <option value="{{$row->id}}" {{$shop->shop_category_id==$row->id?'selected':''}}>{{$row->name}}</option>
            @endforeach
        </select>
        <div class="form-group">
            <label for="exampleInputFile">店铺图片</label>
            <input type="file" id="exampleInputFile" name="shop_logo">
        </div>
        <img src="{{$shop->shop_img}}" >
        <div class="form-group">
            <label>是否品牌</label>
            <label>
                <input type="radio" name="brand" value="1" {{$shop->brand==1?'checked':''}}>是
            </label>
            <label>
                <input type="radio" name="brand" value="0" {{$shop->brand==0?'checked':''}}>否
            </label>
        </div>
        <div class="form-group">
            <label>是否准时送达</label>
            <label>
                <input type="radio" name="on_time" value="1" {{$shop->on_time==1?'checked':''}}>是
            </label>
            <label>
                <input type="radio" name="on_time" value="0" {{$shop->on_time==0?'checked':''}}>否
            </label>
        </div>
        <div class="form-group">
            <label>是否蜂鸟配送</label>
            <label>
                <input type="radio" name="fengniao" value="1" {{$shop->fengniao==1?'checked':''}}>是
            </label>
            <label>
                <input type="radio" name="fengniao" value="0" {{$shop->fengniao==0?'checked':''}}>否
            </label>
        </div>
        <div class="form-group">
            <label>是否保标记</label>
            <label>
                <input type="radio" name="bao" value="1" {{$shop->bao==1?'checked':''}}>是
            </label>
            <label>
                <input type="radio" name="bao" value="0" {{$shop->bao==0?'checked':''}}>否
            </label>
        </div>
        <div class="form-group">
            <label>是否票标记</label>
            <label>
                <input type="radio" name="piao" value="1" {{$shop->piao==1?'checked':''}}>是
            </label>
            <label>
                <input type="radio" name="piao" value="0" {{$shop->piao==0?'checked':''}}>否
            </label>
        </div>
        <div class="form-group">
            <label>是否准标记</label>
            <label>
                <input type="radio" name="zhun" value="1" {{$shop->zhun==1?'checked':''}}>是
            </label>
            <label>
                <input type="radio" name="zhun" value="0" {{$shop->zhun==0?'checked':''}}>否
            </label>
        </div>
        <div class="form-group">
            <label for="exampleInputstartsend1">起送金额</label>
            <input type="text" class="form-control" id="exampleInputstartsend1" placeholder="起送金额" name="start_send" value="{{$shop->start_send}}">
        </div>
        <div class="form-group">
            <label for="exampleInputstartsend1">配送费</label>
            <input type="text" class="form-control" id="exampleInputstartsend1" placeholder="配送费" name="send_cost" value="{{$shop->send_cost}}">
        </div>
        <div class="form-group">
            <label for="exampleInputnotice1">店公告</label><br/>
            <textarea name="notice" id="exampleInputnotice1" cols="80" rows="3">{{$shop->notice}}</textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputdiscount1">优惠信息</label><br/>
            <textarea name="discount" id="exampleInputdiscount1" cols="80" rows="3">{{$shop->discount}}</textarea>
        </div>
        <button type="submit" class="btn btn-success">提交</button>
    </form>
@endsection