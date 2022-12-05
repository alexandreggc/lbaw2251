<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Detail;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShoppingCartPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Detail $detail){
        return $user->id == $detail->order->id_user;
    }

    public function update(User $user, Detail $detail){
        return $user->id == $detail->order->id_user;
    }
}