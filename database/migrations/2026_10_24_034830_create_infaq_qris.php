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
        Schema::create('infaq_qris', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('title')->nullable()->default('QRIS Yayasan');
            $table->string('description')->nullable()->default('Mendukung semua e-wallet & mobile banking');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infaq_qris');
    }
};
