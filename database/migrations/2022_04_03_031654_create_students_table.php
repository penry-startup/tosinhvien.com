<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('avatar')->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('dob')->nullable();
            $table->string('mob')->nullable();
            $table->string('yob')->nullable();
            $table->tinyInteger('sex')->unsigned()->nullable();
            $table->string('password')->nullable();
            $table->tinyInteger('is_active')->default(1)->nullable();
            $table->tinyInteger('is_draft')->default(0)->nullable();
            $table->timestamp('email_verified')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('students');
    }
}
