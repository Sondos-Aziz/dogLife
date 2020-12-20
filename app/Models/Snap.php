<?php

namespace App\Models;

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
}
