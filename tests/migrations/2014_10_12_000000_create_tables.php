<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category', 64);
            $table->string('name', 96);
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('password')->nullable();
            $table->string('role', 16)->default('testing');
            $table->string('name', 16)->nullable();
            $table->timestamp('passed_at')->nullable();
            $table->timestamps();
        });

        Schema::create('receipts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('exams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 32)->nullable();
            $table->timestamps();
        });

        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('exam_id');
            $table->unsignedInteger('question_id')->nullable();
            $table->timestamps();
        });

        Schema::create('options', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('question_id');
            $table->timestamps();
        });

        Schema::create('papers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });

        Schema::create('paper_question', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('paper_id');
            $table->unsignedInteger('question_id');
        });

        Schema::create('listings', function (Blueprint $table) {
            $table->increments('id');
            $table->char('code', 15);
            $table->timestamp('began_at')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->string('room', 8);
            $table->unsignedTinyInteger('duration');
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
        Schema::dropIfExists('listings');
        Schema::dropIfExists('paper_question');
        Schema::dropIfExists('papers');
        Schema::dropIfExists('options');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('exams');
        Schema::dropIfExists('receipts');
        Schema::dropIfExists('users');
        Schema::dropIfExists('categories');
    }
}
