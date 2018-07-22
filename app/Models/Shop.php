<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    public $fillable = ['shop_category_id','shop_name','shop_logo','shop_rating','brand','on_time','fengniao',
        'bao','piao','zhun','start_send','send_cost','notice','discount','status'];
    public function shopcategorie(){
        return $this->belongsTo(ShopCategorie::class,'id');
    }
}
