<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $guarded = [];
    protected $table = 'contacts';

    public function user(){
        return $this->belongsTo('App\User');
    }
}
