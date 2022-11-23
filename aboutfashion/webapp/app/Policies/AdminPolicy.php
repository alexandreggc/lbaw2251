<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;


    public function view(User $user, Admin $admin)
    {
        //
    }

   
    public function create(User $user)
    {
        //
    }

   
    public function update(User $user, Admin $admin)
    {
        //
    }

    
    public function delete(User $user, Admin $admin)
    {
        //
    }

    
    public function restore(User $user, Admin $admin)
    {
        //
    }


    public function deleteUser(Admin $admin, User $user){
        //return $admin->role == 'Technician';
        return true;
    }

    public function blockUser(Admin $admin, User $user){
        //return $admin->role == 'Technician';
        return true;
    }
}