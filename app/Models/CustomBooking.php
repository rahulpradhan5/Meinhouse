<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;


class CustomBooking extends Model
{
    public function userDetails(){

    	return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function serviceDetails(){

    	return $this->belongsTo('App\Models\Service','service_id','id');
    }

    public function proDetails(){

    	return $this->belongsTo('App\Models\User','pro_id','id');
    }
}
