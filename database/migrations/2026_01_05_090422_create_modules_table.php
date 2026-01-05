<?php
/**
 * @Author: Anwarul
 * @Date: 2026-01-05 15:04:22
 * @LastEditors: Anwarul
 * @LastEditTime: 2026-01-05 17:20:30
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
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('course_id')->nullable()->index(); // indexed, no FK
            $table->string('slug')->nullable();
            $table->integer('order')->default(0);
            $table->string('status')->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
