<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $table_name = "tenants";

    protected $gaurded = [];
}
