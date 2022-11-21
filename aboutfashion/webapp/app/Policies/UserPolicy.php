<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function view(User $user, User $model)
    {
        return $user->id == $model->id;
    }

    public function viewAdmin(Admin $admin, User $model)
    {
        return $admin->isTec();
    }

    public function update(User $user, User $model)
    {
        return $user->id == $user->model;
    }

    public function updateAdmin(Admin $admin, User $model)
    {
        return $admin->isTec();
    }


    public function delete(User $user, User $model)
    {
        return $user->id == $user->model;
    }

    public function deleteAdmin(Admin $admin, User $model)
    {
        return $admin->isTec();
    }
}