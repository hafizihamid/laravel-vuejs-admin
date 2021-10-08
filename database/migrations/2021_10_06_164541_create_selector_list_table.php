<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelectorListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selector_list', function (Blueprint $table) {
            $table->integer('ID', true);
            $table->string('callgroup', 20)->nullable();
            $table->string('returnvalue', 100)->nullable();
            $table->string('returntext', 100)->nullable();
            $table->integer('orderid')->nullable()->default(0);
            $table->integer('status')->nullable()->default(0);
            $table->integer('editable')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('selector_list');
    }
}
