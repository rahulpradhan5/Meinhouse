<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pro_data extends Model
{
    use HasFactory;

 protected $table="pro_data";
    public function services()
    {
        return $this->belongsToMany(Service::class,'pro_data_services');
    }
}
