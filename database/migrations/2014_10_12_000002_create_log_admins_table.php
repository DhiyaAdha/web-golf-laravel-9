<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_admins', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('type');
            $table->string('activities');
            
            $table->timestamps();
            // $table->integer('user_id');
            // $table->integer('user_id')->unsigned();
            // $table->foreign('user_id')->reference('id')->on('users');
            // $table->foreign('user_id')->references('id')->on('users');
            
            
            // $table->foreignId('user_id')->constrained();
            // $table->foreignId('user_id')->unique();
            // $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('log_admins', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_admins');
    }
}
