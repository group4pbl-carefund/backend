<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('education_articles', function (Blueprint $table) {
            $table->id('article_id');
            $table->string('title');
            $table->text('content');
            $table->string('category')->nullable();
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
            $table->string('thumbnail_url')->nullable();
            $table->string('status')->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->integer('read_time')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('education_articles');
    }
};
