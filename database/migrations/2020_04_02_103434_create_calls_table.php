<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('mobile');
            $table->string('email');
            $table->string('address')->nullable();
            $table->string('remark')->nullable();
            $table->integer('issue_type');
            $table->integer('incident_id');
            $table->string('call_time');
            $table->integer('attended_by');
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
        Schema::dropIfExists('calls');
    }
}
