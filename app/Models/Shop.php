<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Shop extends Model
{
    use Searchable;
    public $fillable = ['shop_category_id','shop_name','shop_logo','shop_rating','brand','on_time','fengniao',
        'bao','piao','zhun','start_send','send_cost','notice','discount','status'];
    //和商铺类型发生关系
    public function shopcategorie(){
        return $this->belongsTo(ShopCategorie::class,'shop_category_id');
    }
    //和菜品类型发生关系
    public function menus(){
        return $this->hasMany(MenuCategory::class);
    }
    //和菜品发生关系
    public function menu(){
        return $this->hasMany(Menu::class);
    }
    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray(['id','shop_name']);

        // Customize array...

        return $array;
    }
}
