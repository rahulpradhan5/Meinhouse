<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProService extends Model
{
     public function serviceDetails(){

     	return $this->belongsTo('App\Models\Service','service_id','id');
     }
}
