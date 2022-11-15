<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model{
    // Don't add create and update timestamps in database.
    public $timestamps = false;

    protected $table = 'promotion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'discount', 'start_date', 'end_date'];

    public function product(){
        return $this->hasMany('App\Models\Product');
    }
}
