<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('call_id');
            $table->string('complain_no');
            $table->integer('status_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('severity_id')->nullable();
            $table->integer('type_id')->nullable();
            $table->text('remark')->nullable();
            $table->string('flat_no')->nullable();
            $table->integer('building_id')->nullable();
            $table->integer('location_id')->nullable();
            $table->integer('ward_id')->nullable();
            $table->integer('zone_id')->nullable();
            $table->integer('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incidents');
    }
}
