<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = "services";
    public function user_data()
    {
        return $this->belongsToMany(User_data::class,'user_data_services');
    }

    public function pro_data()
    {
        return $this->belongsToMany(Pro_data::class,'pro_data_services');
    }
}
