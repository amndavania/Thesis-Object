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
            $table->string('reference_number')->nullable();
            $table->float('amount');
            $table->string('status');
            $table->string('type');
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
