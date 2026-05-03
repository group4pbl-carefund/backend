<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_campaigns', function (Blueprint $table) {
            $table->id('campaign_id');
            $table->foreignId('program_id')->constrained('programs', 'program_id')->onDelete('cascade');
            $table->decimal('current_amount', 15, 2)->default(0);
            $table->decimal('available_balance', 15, 2)->default(0);
            $table->integer('donor_count')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('last_update_date')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_campaigns');
    }
};
