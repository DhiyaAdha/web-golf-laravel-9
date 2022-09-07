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
            // $table->integer('user_id')->unsigned();
            $table->integer('report_limit_id')->unsigned();
            $table->enum('type', ['VIP','VVIP']);
            $table->integer('quota');
            $table->integer('quota_kupon')->nullable();
            $table->enum('status', ['bertambah', 'berkurang']);
            $table->timestamps();

            $table->foreign('visitor_id')
                ->references('id')
                ->on('visitors')
                ->onDelete('cascade');
            // $table->foreign('user_id')
            //     ->references('id')
            //     ->on('users')
            //     ->onDelete('cascade');
            $table->foreign('report_limit_id')
                ->references('id')
                ->on('report_limits')
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
