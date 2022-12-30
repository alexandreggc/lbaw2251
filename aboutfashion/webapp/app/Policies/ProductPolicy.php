<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function updateProduct(Admin $admin, Product $product){
        return $admin->role == 'Collaborator';
    }
}