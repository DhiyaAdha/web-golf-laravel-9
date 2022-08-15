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
            $table->integer('package_default_id')->unsigned();
            $table->integer('package_additional_id')->unsigned();
            $table->bigInteger('price');
            $table->enum('payment_type',['cash', 'transfer', 'deposit']);
            $table->integer('payment_status');
            $table->string('status');


            $table->timestamps();
          });

          Schema::table('order_payments', function($table) {
            $table->foreign('package_default_id')->references('id')->on('package_defaults');
            $table->foreign('package_additional_id')->references('id')->on('package_additionals');

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
