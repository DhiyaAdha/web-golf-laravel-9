<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalAccessTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->increments('id');
            // $table->morphs('tokenable');
            $table->string('tokenable_type');
            $table->integer('tokenable_id')->unsigned();  
            // $table->foreign('tokenable_id')->reference('id')->on('users');
            //persolan accses tidak mau menggunankn relasi yg dibuat
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamps();

            $table->foreign('tokenable_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

        });

        //solusi #1
        // Schema::table('personal_access_tokens', function($table) {
        //     $table->foreign('tokenable_id')->references('id')->on('users');
        // });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_access_tokens');
    }
}
