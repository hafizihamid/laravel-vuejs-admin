<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogCallTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_call', function (Blueprint $table) {
            $table->bigInteger('calllid', true)->unique('smslid');
            $table->integer('staffid')->nullable()->default(0);
            $table->integer('customerid')->nullable()->default(0);
            $table->string('staff_phone', 50)->nullable();
            $table->string('customer_phone', 50)->nullable();
            $table->dateTime('call_date')->nullable()->default('0000-00-00 00:00:00');
            $table->bigInteger('call_stamp')->nullable()->default(0);
            $table->string('call_type', 20)->nullable()->default('in')->comment('in
out');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_call');
    }
}
