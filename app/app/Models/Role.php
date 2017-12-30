<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     *  many-to-many relationship between User and Role.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
