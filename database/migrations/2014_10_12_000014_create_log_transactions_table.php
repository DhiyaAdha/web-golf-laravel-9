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
            $table->integer('user_id')->unsigned();
            $table->enum('payment_type',['deposit', 'cash', 'transfer', 'limit bulanan', 'limit kupon']);
            $table->integer('payment_status');
            $table->integer('total');
            $table->integer('status');
            $table->timestamp('created_at');
            // $table->integer('visitor_id');

            $table->foreign('visitor_id')
                ->references('id')
                ->on('visitors')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');


        });
        
        // Schema::table('log_transactions', function($table) {
        //     $table->foreign('visitor_id')->references('id')->on('visitors');
        //     $table->foreign('user_id')->references('id')->on('users');
        // });
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
