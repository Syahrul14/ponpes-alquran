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
        Schema::create('footer_settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('pesantren_name')->default("Ponpes Al-Qur'an Rizky Amalia");
            $table->text('about_text')->nullable();
            $table->string('copyright_text')->default("Ponpes Al-Qur'an Rizky Amalia. All Rights Reserved.");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footer_settings');
    }
};
