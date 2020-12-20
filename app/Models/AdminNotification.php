<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class AdminNotification extends Model
{
    protected $table = 'admin_notifications';
    protected $guarded = [];
     protected $appends = ['name'];
    protected $hidden = [
        'updated_at','user',
    ];
    
    // public function getCreatedAtAttribute($value){
    //     return Carbon::parse($value)->format('Y-m-d g:i A');
    // }
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function getCreatedAtAttribute($value){
        if(Carbon::parse($value)->isToday()){
            return Carbon::parse($value)->format('g:i A');
        }
        return Carbon::parse($value)->format('Y-m-d g:i A');
    }

    public function getNameAttribute(){
        return $this->user->name;
    }
}
