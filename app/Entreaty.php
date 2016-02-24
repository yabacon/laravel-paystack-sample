<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Entreaty extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The table to use.
     *
     * @var string
     */
    protected $table = 'entreaties';

    /**
     * Get the user that owns the task.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
