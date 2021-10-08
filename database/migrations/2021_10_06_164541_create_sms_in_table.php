<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsInTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_in', function (Blueprint $table) {
            $table->integer('smsid', true)->unique('smsid');
            $table->integer('staffid')->nullable()->default(0);
            $table->integer('code_id')->nullable()->default(0);
            $table->integer('productid')->nullable()->default(0);
            $table->text('message')->nullable();
            $table->integer('extract_status')->nullable()->default(0)->comment('0=new
1=extracted');
            $table->dateTime('sms_date')->nullable()->default('0000-00-00 00:00:00');
            $table->bigInteger('sms_stamp')->nullable()->default(0);
            $table->string('mobile_no', 50)->nullable();
            $table->integer('code_id_live')->nullable()->default(0)->comment('no monitor the latest status code');
            $table->integer('logid')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_in');
    }
}
