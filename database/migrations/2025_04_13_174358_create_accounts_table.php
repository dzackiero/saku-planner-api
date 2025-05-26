<?php

use App\Enums\WalletType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('accounts', callback: function (Blueprint $table) {
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();

            $table->uuid('id')->primary();
            $table->string('name');
            $table->currency('balance');
            $table->string('description')->nullable();
            $table->foreignUuid('target_id')->nullable();
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
