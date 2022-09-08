
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('visitor_id')->unsigned();
            // $table->integer('user_id')->unsigned();
            $table->integer('report_deposit_id')->unsigned();
            $table->integer('balance');
            $table->string('activities')->nullable();
            // $table->enum('payment_type',['cash', 'transfer']);
            $table->enum('status',['bertambah', 'berkurang']);
            $table->timestamps();

            $table->foreign('visitor_id')
                ->references('id')
                ->on('visitors')
                ->onDelete('cascade');
            // $table->foreign('user_id')
            //     ->references('id')
            //     ->on('users')
            //     ->onDelete('cascade');
            $table->foreign('report_deposit_id')
                ->references('id')
                ->on('report_deposits')
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
        Schema::dropIfExists('deposits');
    }
}
