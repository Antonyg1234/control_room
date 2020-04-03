<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Severity extends Model
{
    protected $table_name = "severities";

    protected $fillable = ["name"];
}
