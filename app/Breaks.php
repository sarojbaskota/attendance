<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Breaks extends Model
{ 
    protected $table='breaks';

    protected $fillable = ['user_id', 'break_checkout', 'break_checkin', 'break_type','break_reason'];
    
	// check userid
    public function scopeUserId($query)
    {
     return $query->where('user_id', '=', Auth::user()->id);
    }
   // office checkout
   public function scopeBreakCheckout($query)
   {
    return $query->where('break_checkin', '=', NULL);
   }
   /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['break_checkout'];
}
