<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;
    protected $table = 'user_order';

    public function card(){
        return $this->belongsTo('\App\Models\Card', 'id_card');
    } 

    public function address(){
        return $this->belongsTo('\App\Models\Address', 'id_address');
    }

    public function user(){
        return $this->belongsTo('\App\Models\User', 'id_user');
    }

    public function details(){
        return $this->hasMany('\App\Models\Detail', 'id_order');
    }

    public function totalPrice($id)
    {
        $order = Order::find($id);
        $total = 0;
        foreach($order->details as $detail){
            $total += $detail->product->getPriceWithPromotion($order->date) * $detail->quantity;
        }
        return $total;
    }
}