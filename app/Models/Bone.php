<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bone extends Model
{
    protected $guarded = [];
    protected $table = 'bones';

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function news(){
        return $this->belongsTo('App\Models\News');
    }
}
