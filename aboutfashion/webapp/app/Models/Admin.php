<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\Admin as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'birth_date', 'gender', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function notifications(){
        return $this->belongsToMany('\App\Models\Notifications', 'admin_notification', 'id_admin', 'id_notification');
    }

    public function image(){
        return $this->belongsTo('\App\Models\Image', 'id_image');
    }

}