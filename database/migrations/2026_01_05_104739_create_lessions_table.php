<?php
/**
 * @Author: Anwarul
 * @Date: 2026-01-05 16:47:39
 * @LastEditors: Anwarul
 * @LastEditTime: 2026-01-05 16:48:59
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
        Schema::create('lessions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('course_id')->index();
            $table->integer('module_id')->nullable()->index();
            $table->enum('type', ['video', 'docs', 'quiz']);
            $table->string('video_link')->nullable();
            $table->enum('video_type', ['Youtube', 'Vimio'])->nullable();
            $table->string('document')->nullable();
            $table->longText('description')->nullable();
            $table->integer('order')->default(0)->index();
            $table->enum('status', ['Active', 'Inactive'])->default('Active')->index();
            $table->string('duration')->nullable(); // e.g. 10:30
            $table->double('mark')->nullable();
            $table->boolean('is_free')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessions');
    }
};
