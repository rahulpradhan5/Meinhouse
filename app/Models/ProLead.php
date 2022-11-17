<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;




class ProLead extends Model
{
    public function bookingsDetail(){

    	return $this->belongsTo('App\Models\Booking','booking_id','id')->with('userDetails','serviceDetails');
    }
}
