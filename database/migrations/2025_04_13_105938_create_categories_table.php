<?php

use App\Enums\CategoryType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('type', enum_values(CategoryType::class));
            $table->timestampsTz();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
