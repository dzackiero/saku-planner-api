<?php

use App\Enums\WalletType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('accounts', callback: function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->id();
            $table->string('name');
            $table->currency('balance');
            $table->string('description')->nullable();

            $table->foreignId('target_id')->constrained()->nullOnDelete();

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
        Schema::dropIfExists('wallets');
    }
};
