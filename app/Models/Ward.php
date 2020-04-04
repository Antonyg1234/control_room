<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $table_name = "wards";

    protected $fillable = ["zone_id", "name", "description"];
}
