<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','image','mobile',
    ];
    // protected $appends = [ 'default_image' ];

    public function news(){
        return $this->hasMany('App\Models\News');
    }

    public function snaps(){
        return $this->hasMany('App\Models\Snap');
    }
    public function bones(){
        return $this->hasMany('App\Models\Bone');
    }
    public function contacts(){
        return $this->hasMany('App\Models\Contact');
    }

    public function notifications(){
        return $this->hasMany('App\Models\AdminNotification');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','created_at','updated_at','email_verified_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getImageAttribute($value){
        return $value ? url('/') . '/images/userImages/' . $value :  url('/'). '/images/userImages/avatar.jpg';
    }
    
}
