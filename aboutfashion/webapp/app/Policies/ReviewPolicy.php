<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Review;
use App\Models\Product;

use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewPolicy{
    use HandlesAuthorization;

    public function create(User $user, Product $product){
      // User can only create items in product they bought
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

    public function edit(User $user, Review $review){
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