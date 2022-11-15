<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model{
    // Don't add create and update timestamps in database.
    public $timestamps = false;

    protected $table = 'product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'description', 'price'];

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function images(){
        return $this->hasMany('\App\Models\Image');
    }

    public function reviews(){
        return $this->hasMany('\App\Models\Review');
    }

    public function orders(){
        return $this->hasMany('\App\Models\Order');
    }

    public function promotion(){
        return $this->hasMany('\App\Models\Promotion');
    }

    public function stocks(){
        return $this->hasMany('\App\Models\Stock');
    }

    // Sizes e Colors representados no STOCK
    // VER SITUAÇÃO DA CLASSIFICAÇÃO
}
