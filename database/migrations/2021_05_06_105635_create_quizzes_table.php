<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('code');
            $table->integer('num_of_items');
            $table->integer('time_limit');
            $table->integer('num_of_attempt');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('status');
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            $table->text('note');
            $table->integer('when_release_remark');
            $table->integer('can_see_answer');
            $table->integer('can_see_points');
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
        Schema::dropIfExists('quizzes');
    }
}
