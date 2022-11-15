<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model{
    // Don't add create and update timestamps in database.
    public $timestamps = false;

    protected $table = 'stock';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['stock', 'id_product', 'id_size', 'id_color'];
 
    public function product(){
        //id_product
        return $this->belongsTo('App\Models\Product');
    }

    public function size(){
        //id_size
        return $this->belongsTo('App\Models\Size');
    }

    public function color(){
        //id_color
        return $this->belongsTo('App\Models\Color');
    }
}
