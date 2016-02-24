<?php

namespace App\Repositories;

use App\Entreaty;
use App\Attempt;

class AttemptRepository
{
    /**
     * Get all of the attempts for a given entreaty.
     *
     * @param  Entreaty  $entreaty
     * @return Collection
     */
    public function forEntreaty(Entreaty $entreaty)
    {
        return Attempt::where('entreaty_id', $entreaty->id)
                    ->orderBy('created_at', 'desc')
                    ->get();
    }
}
