<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTransaction extends Model
{
    public function userDetails(){
        
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    
    
    public function bookingDetails(){
        
        return $this->belongsTo('App\Models\Booking','booking_id','id');
    }
}
