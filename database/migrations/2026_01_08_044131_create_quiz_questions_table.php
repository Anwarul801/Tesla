<?php
/**
 * @Author: Anwarul
 * @Date: 2026-01-08 10:41:31
 * @LastEditors: Anwarul
 * @LastEditTime: 2026-01-08 14:11:57
 * @Description: Innova IT
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->id();
            $table->integer('lesson_id')->nullable();
            $table->integer('module_id')->nullable();
            $table->integer('course_id')->nullable();
            $table->longText('name')->nullable();
            $table->string('option1')->nullable();
            $table->string('option2')->nullable();
            $table->string('option3')->nullable();
            $table->string('option4')->nullable();
            $table->double('mark')->nullable();
            $table->integer('correct_answers')->nullable();
            $table->integer('order')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_questions');
    }
};
