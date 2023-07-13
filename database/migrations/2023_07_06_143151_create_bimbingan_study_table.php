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
        Schema::create('bimbingan_study', function (Blueprint $table) {
            $table->id();
            $table->foreignId('students_id')->constrained();
            $table->string('year');
            $table->string('semester');
            $table->enum('status', ['Aktif','Tunda']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bimbingan_study');
    }
};
