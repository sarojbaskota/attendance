<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Leaves extends Model
{
    protected $table = 'leaves_request';

    protected $fillable = ['user_id', 'leave_reason', 'leave_response', 'status'];

     // check userid
     public function scopeUserId($query)
     {
      return $query->where('user_id', '=', Auth::user()->id);
     }

     /**
     * Get the user that owns the leaves.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'leave_user');
    }
}
