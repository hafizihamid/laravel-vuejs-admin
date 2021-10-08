<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_list', function (Blueprint $table) {
            $table->bigInteger('slid', true)->unique('slid');
            $table->integer('productid')->nullable()->default(0);
            $table->float('price', 12)->nullable()->default(0);
            $table->float('cost', 12)->nullable()->default(0);
            $table->integer('quantity')->nullable()->default(0);
            $table->float('unitcost', 12)->nullable()->default(0);
            $table->float('profit', 12)->nullable()->default(0);
            $table->bigInteger('ref_salesid')->nullable()->default(0);
            $table->float('unitprice', 12)->nullable()->default(0);
            $table->bigInteger('updatestamp')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_list');
    }
}
