<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('fieldname', 50)->nullable();
            $table->string('fieldinfo', 250)->nullable();
            $table->string('fieldvalue', 250)->nullable();
            $table->integer('sorting')->nullable()->default(0);
            $table->integer('allowedit')->nullable()->default(0);
            $table->string('combogroup', 50)->nullable();
            $table->integer('textboxwidth')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('config');
    }
}
