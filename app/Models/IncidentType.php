<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncidentType extends Model
{
    protected $table_name = "incident_types";

    protected $fillable = ["name", "description"];
}
