<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public $timestamps = false;
    protected $table = 'notification';

    public function users(){
        return $this->belongsToMany('\App\Models\User','user_notification' ,'id_notification', 'id_user');
    }

    public function admins(){
        return $this->belongsToMany('\App\Models\User','admin_notification', 'id_notification', 'id_admin');
    }
    
}