<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $guarded = [];

    protected $hidden = [
        'updated_at',
    ];
    
    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->format('Y-m-d g:i A');
    }
}
