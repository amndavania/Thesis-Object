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
        Schema::create('student_types', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->decimal('dpp', 14, 2)->nullable();
            $table->decimal('krs', 14, 2)->nullable();
            $table->decimal('uts', 14, 2)->nullable();
            $table->decimal('uas', 14, 2)->nullable();
            $table->decimal('wisuda', 14, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_types');
    }
};
