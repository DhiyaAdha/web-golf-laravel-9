<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('log_transaction_id')->unsigned();
            $table->integer('package_id')->unsigned();
        });


        Schema::table('detail_transactions', function($table) {
            $table->foreign('package_id')->references('id')->on('packages');
            $table->foreign('log_transaction_id')->references('id')->on('log_transactions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_transactions');
    }
}