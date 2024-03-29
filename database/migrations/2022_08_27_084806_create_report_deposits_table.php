<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_deposits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('visitor_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('report_balance')->default(0);
            $table->integer('fund')->default(0);
            $table->enum('payment_type', ['cash', 'transfer', 'deposit']);
            $table->enum('status', ['Bertambah', 'Berkurang']);
            $table->timestamps();

            $table->foreign('visitor_id')
            ->references('id')
            ->on('visitors')
            ->onDelete('cascade');
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

            // $table->enum('status',['tambah', 'kurang']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_deposits');
    }
}
