<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;
    protected $table = 'model';

    public function card(){
        return $this->belongsTo('App\Models\Card', 'id_card');
    } 

    public function address(){
        return $this->belongsTo('App\Models\Address', 'id_address');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'id_user');
    }

    public function details(){
        return $this->belongsToMany('App\Models\Detail', 'order_details', 'id_order', 'id_details');
    }
}