<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePollMultipleChoiceAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poll_multiple_choice_answers', function (Blueprint $table) {
            $table->id();
            $table->integer('poll_id');
            $table->integer('question_id');
            $table->integer('answer_id');
            $table->timestamps();

            $table->unique(['poll_id', 'question_id', 'answer_id'], 'poll_multiple_choice_answers_poquan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poll_multiple_choice_answers');
    }
}
