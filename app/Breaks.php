<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Breaks extends Model
{ 
    protected $table='breaks';

	protected $fillable = ['employee_id', 'break_checkin', 'break_checkout','break_type','break_reason'];
	// public function getBreakCheckoutAttribute($date) {
 //   			 return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
	// 	}
}
