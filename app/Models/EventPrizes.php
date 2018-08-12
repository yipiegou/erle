<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventPrizes extends Model
{
    //
    public $fillable = ['events_id','name','description','user_id'];
}
