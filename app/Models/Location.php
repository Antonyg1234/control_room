<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table_name = "locations";

    protected $fillable = ["ward_id", "name", "description"];
}
