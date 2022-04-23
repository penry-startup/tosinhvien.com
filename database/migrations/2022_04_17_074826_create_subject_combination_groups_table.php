<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectCombinationGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_combination_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('subject_combinations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('group_id')->unsigned();
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('subject_combination_groups')->onDelete('cascade');
        });

        Schema::create('group_subject', function (Blueprint $table) {
            $table->integer('group_id')->unsigned()->index();
            $table->integer('subject_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('subject_combinations')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_subject');
        Schema::dropIfExists('subject_combinations');
        Schema::dropIfExists('subject_combination_groups');
    }
}
