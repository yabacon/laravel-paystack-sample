<?php

namespace App\Policies;

use App\User;
use App\Entreaty;
use Illuminate\Auth\Access\HandlesAuthorization;

class EntreatyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can view the given entreaty.
     *
     * @param  User  $user
     * @param  Entreaty  $entreaty
     * @return bool
     */
    public function view(User $user, Entreaty $entreaty)
    {
        return $user->id == $entreaty->user_id;
    }

    /**
     * Determine if the given user can delete the given entreaty.
     *
     * @param  User  $user
     * @param  Entreaty  $entreaty
     * @return bool
     */
    public function destroy(User $user, Entreaty $entreaty)
    {
        return $user->id == $entreaty->user_id;
    }
}
