<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $table_name = "zones";

    protected $fillable = ["name", "description"];
}
