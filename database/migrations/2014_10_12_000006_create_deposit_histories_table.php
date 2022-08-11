<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposit_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('visitor_id');
            $table->integer('balance');
            $table->string('activities');
            $table->enum('payment_type',['deposit', 'cash', 'transfer']);

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
        Schema::dropIfExists('deposit_histories');
    }
}
