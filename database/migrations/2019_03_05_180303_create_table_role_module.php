<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRoleModule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_modele', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id');
            $table->integer('module_id');
            $table->integer('can_view')->default(0);
            $table->integer('can_create')->default(0);
            $table->integer('can_edit')->default(0);
            $table->integer('can_delete')->default(0);
            $table->integer('can_print')->default(0);
            $table->integer('can_export')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_modele');
    }
}
