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
        Schema::create('book_qr_codes', function (Blueprint $table) {
            $table->id();
            $table->integer('book_id')->nullable();
            $table->string('name')->nullable();
            $table->string('code_id')->nullable()->unique();
            $table->string('status')->nullable()->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_qr_codes');
    }
};
