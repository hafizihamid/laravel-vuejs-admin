<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('membername', 250)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('contact_no', 50)->nullable();
            $table->string('mobile_no', 50)->nullable();
            $table->string('company', 250)->nullable();
            $table->string('website', 250)->nullable();
            $table->integer('memberstatus')->nullable()->default(0)->comment('0=active
1=blocked
2=need_activation');
            $table->string('membertype', 20)->nullable()->default('user')->comment('user
admin');
            $table->string('username', 50)->nullable();
            $table->string('password', 50)->nullable();
            $table->longText('remarks')->nullable();
            $table->dateTime('adddate')->nullable()->default('0000-00-00 00:00:00');
            $table->bigInteger('addstamp')->nullable()->default(0);
            $table->string('photo_large', 250)->nullable();
            $table->string('photo_small', 250)->nullable();
            $table->integer('groupid')->nullable()->default(0)->comment('1= for admin');
            $table->float('sales_target', 12)->nullable()->default(0);
            $table->integer('qty_target')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
