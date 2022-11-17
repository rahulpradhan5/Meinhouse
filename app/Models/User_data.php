<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_data extends Model
{
    use HasFactory;
    protected $table="user_data";

    public function services()
    {
        return $this->belongsToMany(Service::class,'user_data_services');
    }
}
