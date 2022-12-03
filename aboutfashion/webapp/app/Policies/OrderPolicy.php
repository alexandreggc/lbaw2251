<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function updateCart(User $user, int $id_user){
        return $user->id == $id_user;
    }

    public function show(User $user, Order $order){
        return $user->id == $order->id_user;
    }
}