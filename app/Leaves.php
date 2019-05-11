<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leaves extends Model
{
    protected $table = 'leaves_request';

     /**
     * Get the user that owns the leaves.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'leave_user');
    }
}
