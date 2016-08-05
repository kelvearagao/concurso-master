<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('name');
            $table->text('description');
        });

        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->integer('type_id')->unsigned();
            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('question_types');
        });

        Schema::create('options', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
        });

        // Questão com várias opções e uma resposta
            /*
            Schema::create('question_options', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('question_id')->unsigned();
                $table->integer('option_id')->unsigned();
                $table->boolean('value');

                $table->foreign('question_id')->references('id')->on('question_id')->onDelete('cascade'); 
                $table->foreign('option_id')->references('id')->on('option_id')->onDelete('cascade');
            });
            */

            /*
            Schema::create('question_options_answers', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('question_id')->unsigned();
                $table->integer('option_id')->unsigned();

                $table->foreign('question_id')->references('id')->on('question_id')->onDelete('cascade'); 
                $table->foreign('option_id')->references('id')->on('option_id')->onDelete('cascade');
            });
            */

        // Questão com opções booleanas
        Schema::create('boolean_options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id')->unsigned();
            $table->integer('option_id')->unsigned();
            $table->boolean('value');

            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');
        });

        // Questão de ligar
        Schema::create('link_options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id')->unsigned();
            $table->integer('option_id')->unsigned();
            $table->integer('link_id')->unsigned();

            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade'); 
            $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');
            $table->foreign('link_id')->references('id')->on('options')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boolean_options');
        Schema::dropIfExists('link_options');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('question_types');
        Schema::dropIfExists('options');
    }
}
