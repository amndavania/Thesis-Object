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
            $table->float('dpp')->nullable();
            $table->float('krs')->nullable();
            $table->float('uts')->nullable();
            $table->float('uas')->nullable();
            $table->float('wisuda')->nullable();
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
