<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incident_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('incident_id');
            $table->text('remark')->nullable();
            $table->string('order_request')->nullable();
            $table->integer('responded_by');
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
        Schema::dropIfExists('incident_actions');
    }
}
