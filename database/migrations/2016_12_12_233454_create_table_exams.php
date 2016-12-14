<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableExams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
        });

        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
        });

        Schema::create('juries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
        });

        Schema::create('exams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->string('year');
            $table->string('edital');

            $table->enum('schooling', ['FUNDAMENTAL', 'MEDIO', 'TECNICO', 'SUPERIOR']);

            $table->integer('institute_id')->unsigned();
            $table->integer('job_id')->unsigned();
            $table->integer('jury_id')->unsigned();
            $table->timestamps();

            $table->foreign('jury_id')->references('id')->on('juries');
            $table->foreign('job_id')->references('id')->on('jobs');
            $table->foreign('institute_id')->references('id')->on('institutes');
        });

        Schema::create('exam_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('exam_id')->unsigned();
            $table->integer('question_id')->unsigned();

            $table->foreign('exam_id')->references('id')->on('exams');
            $table->foreign('question_id')->references('id')->on('questions'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_questions');
        Schema::dropIfExists('exams');
        Schema::dropIfExists('juries');
        Schema::dropIfExists('institutes');
        Schema::dropIfExists('jobs');
    }
}
