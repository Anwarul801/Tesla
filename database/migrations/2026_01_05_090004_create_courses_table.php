<?php
/**
 * @Author: Anwarul
 * @Date: 2026-01-05 15:00:04
 * @LastEditors: Anwarul
 * @LastEditTime: 2026-01-05 15:29:30
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
        Schema::create('courses', function (Blueprint $table) {
            $table->id(); // id as primary key
            $table->string('name');
            $table->integer('book_id')->nullable()->index(); // indexed, no FK
            $table->string('thumbnail')->nullable();
            $table->string('banner')->nullable();
            $table->integer('price')->default(0);
            $table->integer('discount')->default(0);
            $table->longText('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('document')->nullable();
            $table->string('promo_video')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
