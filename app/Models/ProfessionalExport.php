<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProfessionalExport extends Model
{
    use HasFactory;

    protected $table='assignment';

    public static function getProff()
    {
        $records = DB::table('users')->where('role_id','3')->select('id','name','email','phone')->get()->toArray();
        return $records;
    }
}
