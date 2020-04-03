<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnMobUserNameToUsersTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('last_name')->nullable()->after('email');
            $table->string('first_name')->nullable()->after('email');
            $table->string('user_name')->nullable()->after('email');
            $table->string('mobile')->nullable()->after('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('last_name');
            $table->dropColumn('first_name');
            $table->dropColumn('user_name');
            $table->dropColumn('mobile');
        });
    }
}
