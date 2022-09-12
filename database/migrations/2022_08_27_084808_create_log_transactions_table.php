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
            $table->integer('order_number')->unique();
            $table->integer('visitor_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->enum('payment_type',['deposit', 'cash', 'transfer', 'limit bulanan', 'limit kupon']);
            $table->integer('payment_status')->default(1);
            $table->integer('total');
            $table->string('activities')->nullable();
            $table->timestamp('created_at');

            $table->foreign('visitor_id')
                ->references('id')
                ->on('visitors')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('log_transactions');
    }

}
