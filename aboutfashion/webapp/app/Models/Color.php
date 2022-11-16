<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model{
    // Don't add create and update timestamps in database.
    public $timestamps = false;

    protected $table = 'stock';

    public function stock(){
        return $this->belongsToMany('App\Models\Stock', 'id_color');
    }

    public function details(){
        return $this->hasMany('App\Models\Detail', 'id_color');
    }
}