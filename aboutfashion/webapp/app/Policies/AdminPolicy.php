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

    public function deleteUser(Admin $admin)
    {
        return $admin->type == 'Technician';
    }

    public function blockUser(Admin $admin)
    {
        return $admin->type == 'Technician';
    }

   
}