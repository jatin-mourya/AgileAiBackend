<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newusers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->string('mobile_no');
            $table->string('email');
            $table->string('username');
            $table->string('password');
            $table->string('conformpassword');
            $table->string('date_of_birth');
            $table->string('pan_no');
            $table->string('qualification');
            $table->string('marital_status');
            $table->string('joining_date');
            $table->string('experience_in_year');
            $table->string('last_package');
            $table->string('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('newusers');
    }
}
