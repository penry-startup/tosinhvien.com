<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMajorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('majors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->text('name')->nullable();
            $table->string('subject_group')->nullable();
            $table->float('thpt_score')->nullable();
            $table->float('hocba_score')->nullable();
            $table->float('dgnl_score')->nullable();
            $table->integer('university_id')->unsigned();
            $table->timestamps();

            $table->foreign('university_id')->references('id')->on('universities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('majors');
    }
}
