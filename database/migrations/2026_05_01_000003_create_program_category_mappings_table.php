<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_category_mappings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained('programs', 'program_id')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('program_categories', 'category_id')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_category_mappings');
    }
};
