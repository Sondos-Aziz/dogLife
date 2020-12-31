<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $guarded = [];
    protected $appends = ['type_name'];

    protected $hidden = [
        'updated_at',
    ];
    
    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->format('Y-m-d g:i A');
    }

     public function getTypeNameAttribute()
    {
        $array =[1=>__('general.add_post'),2=> __('general.comment'),
        3=> __('general.like'),4=>__('general.admin')
        ];
    //    if($this->type == 1){  //1: add post
    //        return __('general.add_post');
    //    }elseif($value == 2){ // add comment
    //     return __('general.comment');
    // }elseif($value == 3){ // do like on post
    //     return __('general.like');
    // }elseif($value == 4){ // from admin
        // return __('general.admin');
        return $array[$this->type];
    }
// }
}
