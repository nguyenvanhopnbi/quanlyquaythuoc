<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->isAbleTo('permission-browse');
    }

    public function create(User $user)
    {
        return $user->isAbleTo('permission-add');
    }

    public function update(User $user, Permission $permission)
    {
        return $user->isAbleTo('permission-edit');
    }

    public function delete(User $user, Permission $permission)
    {
        return $user->isAbleTo('permission-delete');
    }
}
