<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content'); // TinyMCE HTML content
            $table->text('excerpt')->nullable(); // short summary
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('author')->default('Tim Bisolpin');
            $table->string('image_url')->nullable(); // Cloudinary URL
            $table->timestamp('published_at')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
