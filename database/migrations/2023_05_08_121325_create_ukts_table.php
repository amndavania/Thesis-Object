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
        Schema::create('ukts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('students_id')->constrained();
            $table->string('semester');
            $table->string('reference_number')->nullable();
            $table->float('amount');
            $table->float('total');
            $table->string('status');
            $table->foreignId('transaction_accounts_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ukts');
    }
};
