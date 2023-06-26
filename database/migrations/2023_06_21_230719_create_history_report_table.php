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
        Schema::create('history_report', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_accounts_id')->constrained();
            $table->enum('type', ['annual', 'monthly']);
            $table->decimal('saldo', 14, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_report');
    }
};
