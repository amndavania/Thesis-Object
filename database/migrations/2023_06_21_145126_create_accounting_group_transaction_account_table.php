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
        Schema::create('accounting_group_transaction_account', function (Blueprint $table) {
            $table->unsignedBigInteger('transaction_account_id');
            $table->unsignedBigInteger('accounting_group_id');

            $table->foreign('transaction_account_id', 'ag_ta_transaction_account_foreign')->references('id')->on('transaction_accounts')->onDelete('cascade');
            $table->foreign('accounting_group_id', 'ag_ta_accounting_group_foreign')->references('id')->on('accounting_groups')->onDelete('cascade');

            $table->unique(['transaction_account_id', 'accounting_group_id'], 'ag_ta_unique');
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounting_group_transaction_account');
    }
};
