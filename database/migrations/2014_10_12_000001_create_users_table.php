<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('role_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
        
            // $table->foreignId('role_id')
            //         ->constrained('roles')
            //         ->onUpdate('cascade')
            //         ->onDelete('cascade');
            // $table->integer('role_id')->unsigned();
            // $table->foreign('role_id')->reference('id')->on('roles');  
            // $table->foreign('role_id')->constrained();
            // $table->foreign('country_id')->references('id')->on('countries');
            
        });

        // Schema::table('users', function($table) {
        //     $table->foreign('role_id')->references('id')->on('roles');
        // });
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
