<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('visitor_id')->unsigned();
            $table->string('order');
            $table->string('activities');
            $table->timestamp('created_at');
            // $table->integer('visitor_id');
        });

        Schema::table('log_transactions', function($table) {
            $table->foreign('visitor_id')->references('id')->on('visitors');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_transactions');
    }
}
