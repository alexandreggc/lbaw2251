<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Review;
use App\Models\Product;

use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewPolicy{
    use HandlesAuthorization;

    public function store(User $user, Product $product){
      // Users can only give reviews of products they bought
      if(Auth::check()){
        $orders = $user->orders;
        foreach($orders as $order){
            $details = $order->details;
            foreach($details as $detail){
                if($detail->id_product == $product->id){
                    return true;
                }
            }
        }
      }
      return false;
    }

    public function update(User $user, Review $review){
      // Users can only update reviews they own
      if(Auth::check()){
        return $user->id == $review->id_user;
      }
    }

    public function delete(User $user, Review $review){
      // Users can only delete reviews they own
      if(Auth::check()){
        return $user->id == $review->id_user;
      }
    }
}