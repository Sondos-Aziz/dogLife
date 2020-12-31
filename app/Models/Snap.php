<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Snap extends Model
{
    protected $guarded = [];
    protected $table = 'snaps';

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function news(){
        return $this->belongsTo('App\Models\News');
    }

    protected $hidden = [
        'updated_at',
    ];

    public function getCreatedAtAttribute($value){
        if(Carbon::parse($value)->isToday()){
            return Carbon::parse($value)->format('g:i A');
        }
        return Carbon::parse($value)->format('Y-m-d g:i A');
    }
}
