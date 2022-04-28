<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        return $user->isAbleTo('role-browse');
    }


    public function create(User $user)
    {
        return $user->isAbleTo('role-add');
    }

    public function update(User $user, Role $role)
    {
        return $user->isAbleTo('role-edit');
    }

    public function delete(User $user, Role $role)
    {
        return $user->isAbleTo('role-delete');
    }
}
