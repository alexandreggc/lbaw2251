<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model{
    public $timestamps = false;

    protected $table = 'category';


    public function superCategory(){
        return $this->belongsTo('App\Models\Category', 'id_super_category');
    }

    public function subCategories(){
        return $this->hasMany('App\Models\Category', 'id_super_category');
    }

    public function products(){
        return $this->hasMany('App\Models\Product');
    }
}