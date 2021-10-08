<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->integer('productid', true)->unique('productid');
            $table->string('product_name', 250)->nullable();
            $table->float('unit_cost', 9)->nullable()->default(0);
            $table->float('unit_price', 9)->nullable()->default(0);
            $table->integer('inventory')->nullable()->default(0);
            $table->string('sms_in_1', 250)->nullable();
            $table->string('sms_in_2', 250)->nullable();
            $table->string('sms_in_3', 250)->nullable();
            $table->string('sms_out_1', 250)->nullable();
            $table->string('sms_out_2', 250)->nullable();
            $table->string('sms_out_3', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
