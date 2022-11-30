<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function updateCart(User $user, User $requestUser){
        return $user->id == $requestUser->id;
    }
}