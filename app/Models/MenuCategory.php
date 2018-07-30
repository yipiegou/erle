<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    //设置可修改字段
    public $fillable = ['name','type_accumulation','shop_id','description','is_selected'];

    //和菜品发生关系
//    public function menu(){
//        return $this->hasMany(Menu::class,'category_id');
//    }
//和菜品发生关系
    public function goodslist(){
        return $this->hasMany(Menu::class,'category_id');
    }
    //和商铺发生关系
    public function shop(){
        return $this->belongsTo(Shop::class);
    }
}
