<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('distributions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained('programs', 'program_id')->onDelete('cascade');
            $table->string('recipient_name');
            $table->string('recipient_location')->nullable();
            $table->decimal('amount', 15, 2);
            $table->string('status')->default('PROSES');
            $table->string('evidence_url')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('distributions');
    }
};
