<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //设置可修改字段
    public $fillable = ['goods_name','rating','shop_id','category_id','goods_price','description','month_sales',
        'rating_count','tips','satisfy_count','satisfy_rate','goods_img','status'];
    //和菜品类发生关系
    public function menus(){
        return $this->belongsTo(MenuCategory::class,'category_id');
    }

    //和商铺模型发生关系
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}