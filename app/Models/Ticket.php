<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    /**
     * A Ticket Has Many Comments
     *
     */
    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class);
    }
}
