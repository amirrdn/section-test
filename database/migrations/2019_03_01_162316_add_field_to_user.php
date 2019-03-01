<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('identity_no')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('telephone')->nullable();
            $table->date('date_birth_day')->nullable();
            $table->string('quatification')->nullable();
            $table->integer('gender')->default(1);
            $table->integer('merital_status')->default(1);
            $table->string('user_name');
            $table->enum('is_enebled', ['yes', 'no'])->default('no');
            $table->integer('role_id');
            $table->string('user_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
