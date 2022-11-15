<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model{
    // Don't add create and update timestamps in database.
    public $timestamps = false;

    protected $table = 'stock';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name'];

    public function stock(){
        return $this->belongsToMany('App\Models\Stock');
    }

    /*para a tabela details necessária paa o shopping cart
    ver se é necessário
    public function details(){
        return $this->belongsToMany('App\Models\Details');
    }*/
}
