<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_user', function (Blueprint $table) {
         $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('leave_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('leave_id')->references('id')->on('leaves_request');
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
        Schema::dropIfExists('leave_user');
    }
}
