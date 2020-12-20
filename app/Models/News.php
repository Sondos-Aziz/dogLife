<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Carbon\Carbon;

class News extends Model
{
    use Translatable;

    protected $guarded = [];
    protected $table = 'news';
    protected $translatedAttributes = ['title','description'];
    protected $appends = ['user_image','user_name', 'snaps_count','bones_count'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function snaps(){
        return $this->hasMany('App\Models\Snap');
    }
    public function bones(){
        return $this->hasMany('App\Models\Bone');
    }
    public function getVideoAttribute($value){
        return $value ? url('/') . '/videos/' . $value : null;
    }

    public function getImageAttribute($value){
        return $value ? url('/') . '/images/newsImages/' . $value : null;
    }

    public function getSnapsCountAttribute(){
        return $this->snaps->count();
    }
    public function getBonesCountAttribute(){
        return $this->bones->count();
    }
    
    public function getUserImageAttribute(){
        return @$this->user->image;
    }
    public function getUserNameAttribute(){
        return @$this->user->name;
    }


    // public function news_translations(){
    //     return $this->belongsTo('App\Models\NewsTranslation');
    // }

    protected $hidden = [
        'updated_at','translations','user','bones','snaps',
    ];

    public function getCreatedAtAttribute($value){
        if(Carbon::parse($value)->isToday()){
            return Carbon::parse($value)->format('g:i A');
        }
        return Carbon::parse($value)->format('Y-m-d g:i A');
    }
}
