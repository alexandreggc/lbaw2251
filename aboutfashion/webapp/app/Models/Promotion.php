<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model{
    // Don't add create and update timestamps in database.
    public $timestamps = false;

    protected $table = 'promotion';

    public function product(){
        return $this->hasMany('App\Models\Product', 'id_promotion');
    }
}