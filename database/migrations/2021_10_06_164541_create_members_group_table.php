<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members_group', function (Blueprint $table) {
            $table->integer('groupid', true);
            $table->string('group_name', 250)->nullable();
            $table->integer('itemstatus')->nullable()->default(0);
            $table->string('perm_list', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members_group');
    }
}
