<?php

namespace App;

use Carbon\Carbon;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    protected $fillable = ['user_id', 'office_checkin', 'office_checkout'];

    // set current time for checkin
    // public function setTitleAttribute(){
    //     $this->attributes['office_checkin'] = Carbon::now()->toDateTimeString();
    // }

    /**
     * Get the user that owns the phone.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    // office checkout
    public function scopeOfficeCheckout($query)
    {
     return $query->where('office_checkout', '=', NULL);
    }
    // check userid
    public function scopeUserId($query)
    {
     return $query->where('user_id', '=', Auth::user()->id);
    }
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['office_checkin'];
}
