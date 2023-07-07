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
            $table->string('year');
            $table->enum('semester', ['GASAL', 'GENAP']);
            $table->enum('type', ['DPP','UKT', 'WISUDA']);
            $table->string('reference_number')->nullable();
            $table->decimal('amount', 14, 2);
            $table->string('status');
            $table->string('keterangan')->nullable();
            $table->integer('transaction_debit_id');
            $table->integer('transaction_kredit_id');
            $table->integer('lbs_id')->nullable();
            $table->integer('exam_uts_id')->nullable();
            $table->integer('exam_uas_id')->nullable();
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
