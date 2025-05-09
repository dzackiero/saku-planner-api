<?php

use App\Enums\TransactionType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')
                ->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('wallet_id')
                ->constrained()->nullOnDelete();
            $table->foreignId('to_wallet_id')
                ->nullable()->constrained('wallets')->nullOnDelete();
            $table->enum('type', enum_values(TransactionType::class));
            $table->currency('amount');
            $table->string('note')->nullable();
            $table->timestampTz('transaction_at')
                ->default(now());
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
