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


            $table->foreign('package_id')
                ->references('id')
                ->on('packages')
                ->onDelete('cascade');
            $table->foreign('log_transaction_id')
                ->references('id')
                ->on('log_transactions')
                ->onDelete('cascade');

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