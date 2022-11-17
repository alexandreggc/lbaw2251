<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    protected $table = 'authenticated_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'first_name', 'last_name', 'email', 'password', 'birth_date', 'gender', 'blocked'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function photo(){
        return $this->belongsTo('App\Models\Image', 'id_image');
    }

    public function addresses(){
        return $this->hasMany('\App\Models\Address', 'id_address');
    }

    public function cards(){
        return $this->hasMany('\App\Models\Card', 'id_card');
    }

    public function notifications(){
        return $this->belongsToMany('\App\Models\Notification', 'user_notification', 'id_user', 'id_notification');
    }

    public function reports(){
        return $this->hasMany('\App\Models\Report', 'id_user');
    }

    public function wishlist(){
        return $this->belongsToMany('\App\Models\Product', 'wishlist', 'id_user', 'id_product');
    }

    public function orders(){
        return $this->hasMany('\App\Models\Order', 'id_user');
    }

    public function likes(){
        return $this->belongsToMany('\App\Models\Review', 'user_like', 'id_user', 'id_review');
    }

    public function reviews(){
        return $this->hasMany('App\Model\Review', 'id_user');
    }
    
}