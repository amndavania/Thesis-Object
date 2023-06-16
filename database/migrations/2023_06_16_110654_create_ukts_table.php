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
            $table->string('type');
            $table->string('reference_number')->nullable();
            $table->decimal('amount', 14, 2);
            $table->decimal('total', 14, 2);
            $table->string('status');
            $table->integer('transaction_debit_id');
            $table->integer('transaction_kredit_id');
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
