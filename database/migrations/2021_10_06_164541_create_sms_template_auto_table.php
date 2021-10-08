<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsTemplateAutoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_template_auto', function (Blueprint $table) {
            $table->integer('templateid', true)->unique('templateid');
            $table->integer('staffid')->nullable()->default(0);
            $table->string('template_name', 250)->nullable();
            $table->date('from_date')->nullable()->default('0000-00-00');
            $table->bigInteger('from_stamp')->nullable()->default(0);
            $table->date('to_date')->nullable()->default('0000-00-00');
            $table->bigInteger('to_stamp')->nullable()->default(0);
            $table->text('message')->nullable();
            $table->integer('code_id')->nullable()->default(0);
            $table->integer('productid')->nullable()->default(0);
            $table->integer('cust_type')->nullable()->default(0);
            $table->integer('cust_feedback')->nullable()->default(0);
            $table->integer('cust_special')->nullable()->default(0);
            $table->integer('dateafter')->nullable()->default(0)->comment('may may days after the sales day to send this?');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_template_auto');
    }
}
