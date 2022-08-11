<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_number');
            $table->integer('pakage_default_id');
            $table->integer('pakage_additional_id');
            $table->bigInteger('price');
            $table->enum('payment_type',['cash', 'transfer', 'deposit']);
            $table->integer('payment_status');
            $table->string('status');


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
        Schema::dropIfExists('order_payments');
    }
}
