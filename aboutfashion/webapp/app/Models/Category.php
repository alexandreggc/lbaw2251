<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model{
    // Don't add create and update timestamps in database.
    public $timestamps = false;

    protected $table = 'category';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'description'];

    public function supercategory(){
        return $this->belongsTo('App\Models\Category');
    }

    public function products(){
        return $this->hasMany('App\Models\Product');
    }
}
