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
            $table->decimal('dpp', 10, 2)->nullable();
            $table->decimal('krs', 10, 2)->nullable();
            $table->decimal('uts', 10, 2)->nullable();
            $table->decimal('uas', 10, 2)->nullable();
            $table->decimal('wisuda', 10, 2)->nullable();
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
