<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogLimitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_limits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('visitor_id')->unsigned();
            $table->string('type');
            $table->string('activities' );
            $table->timestamp('created_at');

            $table->foreign('visitor_id')
                ->references('id')
                ->on('visitors')
                ->onDelete('cascade');


        });

        // Schema::table('log_limits', function($table) {
        //     $table->foreign('visitor_id')->references('id')->on('visitors');
        // });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_limits');
    }
}
