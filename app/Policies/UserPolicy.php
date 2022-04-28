<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->isAbleTo('user-browse');
    }

    public function create(User $user)
    {
        return $user->isAbleTo('user-add');
    }

    public function update(User $user, User $model)
    {
        return $user->isAbleTo('user-edit');
    }

    public function delete(User $user, User $model)
    {
        return $user->isAbleTo('user-delete');
    }
}
