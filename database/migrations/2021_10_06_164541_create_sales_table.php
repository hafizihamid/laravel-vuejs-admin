<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigInteger('salesid', true)->unique('salesid');
            $table->string('sales_mode', 20)->nullable()->comment('manual
extract
cod');
            $table->date('sales_date')->nullable()->default('0000-00-00');
            $table->bigInteger('sales_stamp')->nullable()->default(0);
            $table->string('sales_time', 50)->nullable();
            $table->dateTime('sales_datetime')->nullable()->default('0000-00-00 00:00:00');
            $table->integer('staffid')->nullable()->default(0);
            $table->integer('senderid')->nullable()->default(0);
            $table->integer('productid')->nullable()->default(0);
            $table->float('price', 12)->nullable()->default(0);
            $table->float('cost', 12)->nullable()->default(0);
            $table->integer('quantity')->nullable()->default(0);
            $table->string('pay_bank', 50)->nullable();
            $table->string('pay_method', 200)->nullable();
            $table->string('buyer_name', 250)->nullable();
            $table->text('buyer_address')->nullable();
            $table->string('mobile_no', 50)->nullable();
            $table->string('tracking_no', 50)->nullable();
            $table->float('unitcost', 12)->nullable()->default(0);
            $table->float('profit', 12)->nullable()->default(0);
            $table->string('buyer_nickname', 250)->nullable();
            $table->string('pay_type', 50)->nullable();
            $table->float('price_paid', 12)->nullable()->default(0);
            $table->float('price_pending', 12)->nullable()->default(0);
            $table->string('pay_note', 50)->nullable();
            $table->float('price_ori', 12)->nullable()->default(0);
            $table->float('discount', 12)->nullable()->default(0);
            $table->date('comm_date')->nullable()->default('0000-00-00');
            $table->date('est_pay_date')->nullable()->default('0000-00-00');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
