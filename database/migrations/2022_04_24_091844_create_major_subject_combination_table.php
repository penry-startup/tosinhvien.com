<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMajorSubjectCombinationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('major_subject_combination', function (Blueprint $table) {
            $table->integer('major_id')->unsigned()->index();
            $table->integer('subject_combination_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('major_id')->references('id')->on('majors')->onDelete('cascade');
            $table->foreign('subject_combination_id')->references('id')->on('subject_combinations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('major_subject_combination');
    }
}
