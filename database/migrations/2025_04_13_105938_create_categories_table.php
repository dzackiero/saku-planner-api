<?php

use App\Enums\CategoryType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();

            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('icon')->nullable();

            $table->string('type');
            $table->timestampTz("synced_at")->nullable();
            $table->timestampsTz();
            $table->softDeletesTz();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
