<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->id();
            $table->foreignId('category_id')
                ->constrained()
                ->nullOnDelete();
            $table->currency('amount');
            $table->currency('initial_amount');

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
        Schema::dropIfExists('budgets');
    }
};
