<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogSmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_sms', function (Blueprint $table) {
            $table->bigInteger('smslid', true)->unique('smslid');
            $table->integer('staffid')->nullable()->default(0);
            $table->integer('customerid')->nullable()->default(0);
            $table->string('staff_phone', 50)->nullable();
            $table->string('customer_phone', 50)->nullable();
            $table->dateTime('sms_date')->nullable()->default('0000-00-00 00:00:00');
            $table->bigInteger('sms_stamp')->nullable()->default(0);
            $table->string('sms_type', 20)->nullable()->default('in')->comment('in
out');
            $table->integer('code_id')->nullable()->default(0)->comment('0 none
1 
2
3');
            $table->integer('product_id')->nullable()->default(0);
            $table->text('message')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_sms');
    }
}
