<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_codes', function (Blueprint $table) {
            $table->integer('codeid', true);
            $table->string('code_mode', 20)->nullable()->default('in')->comment('in
out');
            $table->integer('code_level')->nullable()->default(1)->comment('1
2
3');
            $table->string('code_keyword', 250)->nullable();
            $table->integer('ref_pid')->nullable()->default(0)->comment('product id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_codes');
    }
}
