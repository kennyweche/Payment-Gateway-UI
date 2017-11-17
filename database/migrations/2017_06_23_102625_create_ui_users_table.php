<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUiUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ui_users', function (Blueprint $table) {
            $table->increments('userID');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('userType')->default('UI');;
            $table->integer('clientID')->default(1);;
            $table->integer('status')->default(136);;
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}