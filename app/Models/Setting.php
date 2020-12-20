<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Setting extends Model
{
    use Translatable;
    protected $guarded = [];
    protected $translatedAttributes = ['content'];
    protected $hidden = [
        'updated_at','translations','created_at',
    ];

}
