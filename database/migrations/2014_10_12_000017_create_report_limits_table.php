<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportLimitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_limits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('visitor_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('report_quota')->default(0);
            $table->integer('report_quota_kupon')->default(0);
            $table->enum('status',['Reset', 'Bertambah','Berkurang']);
            $table->string('activities')->nullable();
            $table->timestamps();
            
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
        Schema::dropIfExists('report_limits');
    }
}
