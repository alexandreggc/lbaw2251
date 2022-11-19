<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model{
    // Don't add create and update timestamps in database.
    public $timestamps = false;

    protected $table = 'product';


    public function category(){
        return $this->belongsTo('App\Models\Category', 'id_category');
    }

    public function images(){
        return $this->belongsToMany('\App\Models\Image', 'product_image', 'id_product', 'id_image');
    }

    public function reviews(){
        return $this->hasMany('\App\Models\Review', 'id_product');
    }
    
    public function promotion(){
        return $this->belongsToMany('\App\Models\Promotion', 'promotion_product', 'id_product', 'id_promotion');
    }

    public function stocks(){
        return $this->hasMany('\App\Models\Stock', 'id_product');
    }

    public function details(){
        return $this->hasMany('App\Models\Detail', 'id_product');
    }

    public function scopeSearch($query, $search)
    {


        if (!$search) {
            return $query;
        }

        return $query->whereRaw('tsvectors @@ plainto_tsquery(\'english\', ?)', [$search])->orderByRaw('ts_rank(tsvectors, to_tsquery(\'english\', ?)) DESC', [$search]);
    }

    public function avgEvaluationProduct($id){
        return Review::where('id_product', $id)->avg('evaluation')->get();   
    }
}