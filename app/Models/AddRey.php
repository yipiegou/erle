<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddRey extends Model
{
    public $fillable = ['user_id','name','provence','city','area','detail_address','tel'];
}