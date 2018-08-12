<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $fillable = ['user_id','shop_id','order_code','order_birth_time','name','tel','provence','city','area',
        'order_address','order_price','status'];
    public function shop(){
        return $this->belongsTo(Shop::class);
    }
}
