<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->bigInteger('expid', true);
            $table->date('exp_date')->nullable()->default('0000-00-00');
            $table->bigInteger('exp_stamp')->nullable()->default(0);
            $table->string('exp_time', 50)->nullable();
            $table->dateTime('exp_datetime')->nullable()->default('0000-00-00 00:00:00');
            $table->integer('staffid')->nullable()->default(0);
            $table->string('expenses_title', 100)->nullable();
            $table->float('amount', 12)->nullable()->default(0);
            $table->text('extra_notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
}
