<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsSendTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_send', function (Blueprint $table) {
            $table->bigInteger('sendid', true)->unique('smslid');
            $table->integer('staffid')->nullable()->default(0);
            $table->integer('customerid')->nullable()->default(0);
            $table->string('staff_phone', 50)->nullable();
            $table->string('customer_phone', 50)->nullable();
            $table->dateTime('sms_date')->nullable()->default('0000-00-00 00:00:00');
            $table->bigInteger('sms_stamp')->nullable()->default(0);
            $table->integer('template_id')->nullable()->default(0);
            $table->text('message')->nullable();
            $table->integer('itemstatus')->nullable()->default(0)->comment('0 new
1 send');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_send');
    }
}
