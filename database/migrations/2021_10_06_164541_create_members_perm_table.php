<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersPermTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members_perm', function (Blueprint $table) {
            $table->integer('permid', true);
            $table->integer('sortingid')->nullable()->default(0);
            $table->string('permcat', 50)->nullable();
            $table->string('permname', 100)->nullable();
            $table->string('permcode', 50)->nullable();
            $table->integer('itemstatus')->nullable()->default(0)->comment('0=enabled
1=disabled');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members_perm');
    }
}
