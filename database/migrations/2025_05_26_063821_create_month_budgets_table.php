<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('month_budgets', function (Blueprint $table) {
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();

            $table->uuid('id')->primary();
            $table->foreignUuid('budget_id')
                ->constrained('budgets')
                ->cascadeOnDelete();
            $table->unsignedInteger("year");
            $table->unsignedInteger("month");
            $table->currency('amount');

            $table->timestampTz("synced_at")->nullable();
            $table->timestampsTz();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('month_budgets');
    }
};
