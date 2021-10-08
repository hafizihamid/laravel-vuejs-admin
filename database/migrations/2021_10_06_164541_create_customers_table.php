<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigInteger('custid', true);
            $table->string('cust_mobile', 50)->nullable();
            $table->string('cust_name', 250)->nullable();
            $table->text('cust_address')->nullable();
            $table->integer('cust_status')->nullable()->default(1)->comment('1 = leads
2 = prospects
3 = clients');
            $table->integer('cust_type')->nullable()->default(0)->comment('0 = just an enquiry
1 = paid customer
2 = repeat customer');
            $table->integer('all_qty')->nullable()->default(0);
            $table->dateTime('join_datetime')->nullable()->default('0000-00-00 00:00:00');
            $table->bigInteger('join_stamp')->nullable()->default(0);
            $table->dateTime('last_datetime')->nullable()->default('0000-00-00 00:00:00');
            $table->bigInteger('last_stamp')->nullable()->default(0);
            $table->integer('staffid')->nullable()->default(0);
            $table->integer('last_productid')->nullable()->default(0);
            $table->integer('cust_feedback')->nullable()->default(0)->comment('0 no feedback
1 loving
2 so so 
3 crying');
            $table->integer('cust_special')->nullable()->default(0)->comment('0 not special
1 change date
2 problem');
            $table->date('followup_date')->nullable()->default('0000-00-00');
            $table->bigInteger('followup_stamp')->nullable()->default(0);
            $table->string('cust_nickname', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
