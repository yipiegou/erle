<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    public $fillable = ['title','content','prize_date','signup_start','signup_end','signup_num','is_prize'];
    //和奖品发生关系
    public function eventPrizes(){
        return $this->hasMany(EventPrizes::class,'events_id');
    }
}
