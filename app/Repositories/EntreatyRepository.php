<?php

namespace App\Repositories;

use App\User;
use App\Entreaty;

class EntreatyRepository
{
    /**
     * Get all of the entreaties for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return Entreaty::where('user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->get();
    }
}
