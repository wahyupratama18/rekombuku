<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdministrativePolicy
{
    use HandlesAuthorization;

    /**
     * Is an administrator user
     *
     * @param User $user
     * @return boolean
     */
    public function isAdmin(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Is not an administrator
     *
     * @param User $user
     * @return boolean
     */
    public function isNotAdmin(User $user): bool
    {
        return !$this->isAdmin($user);
    }
}
