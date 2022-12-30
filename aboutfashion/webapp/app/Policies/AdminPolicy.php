<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    public function view(Admin $admin, Admin $model)
    {
        return $admin->id == $model->id;
    }

    public function updateUser(Admin $admin)
    {
        return $admin->role == 'Technician';
    }

   
}