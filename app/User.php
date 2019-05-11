<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [
        'full_name','username','role' ,'avatar','status' ,'email', 'password','remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /** Set the password with hash.
     *
     * @param  string  $value
     * @return string
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] =  Hash::make($value);
    }
    public function setPasswordtestAttribute($value)
    {
        $this->attributes['passwordtest'] =  Hash::make($value);
    }
     public function setFullNameAttribute($value)
    {
        $this->attributes['full_name'] = ucwords($value);
    }
   
    public function isAdmin()    {        
    return $this->role === 1;    
    }
    /**
     * Get the timesheet record associated with the user.
     */
    public function timesheet()
    {
        return $this->hasOne('App\Timesheet');
    }
     
     /**
     * The leaves that belong to the user.
     */
    public function leaves()
    {
        return $this->belongsToMany(Leaves::class, 'leave_user');
    }
}
