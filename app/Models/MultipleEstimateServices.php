<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultipleEstimateServices extends Model
{
    use HasFactory;
    protected $table = "multiple_estimate_services";

    protected $fillable = [
        'id','service_id','estimate_id','amount','reg_amount','reg_amount_tax','description',
    ];
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
