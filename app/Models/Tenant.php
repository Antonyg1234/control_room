<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $table_name = "tenants";

    protected $fillable = ["building_id", "flat_no", "first_name", "last_name", "middele_name"];
}
