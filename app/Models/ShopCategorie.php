<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopCategorie extends Model
{
    //
    public $fillable = ["name","logo","states"];
    public function usershop()
    {
        return $this->hasMany(Shop::class);
    }
}
