<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDraftQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('draft_questions', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->foreignId('draft_quiz_id')->constrained()->onDelete('cascade');
            $table->string('type')->nullable();
            $table->integer('points')->nullable();
            $table->integer('status');
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
        Schema::dropIfExists('draft_questions');
    }
}
