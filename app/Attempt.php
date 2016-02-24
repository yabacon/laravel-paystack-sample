<?php

namespace App;

use App\Entreaty;
use Illuminate\Database\Eloquent\Model;

class Attempt extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['reference','status'];

    /**
     * Get the entreaty that owns the task.
     */
    public function entreaty()
    {
        return $this->belongsTo(Entreaty::class);
    }
}
