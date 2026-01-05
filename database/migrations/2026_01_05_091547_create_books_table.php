<?php

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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->string('type')->nullable()->default('Hard Copy');
            $table->double('price')->nullable();
            $table->double('discount')->nullable();
            $table->longText('description')->nullable();
            $table->string('document')->nullable()->comment('একটু পরে দেখুন। pdf');
            $table->string('promo_video')->nullable();
            $table->integer('order')->nullable();
            $table->string('status')->nullable()->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
