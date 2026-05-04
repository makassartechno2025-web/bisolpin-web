<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->decimal('price', 10, 2)->default(0);
            $table->boolean('is_free')->default(true);
            $table->string('image_url')->nullable(); // Cloudinary URL
            $table->string('instructor')->nullable();
            $table->string('duration')->nullable(); // e.g. "12 Jam"
            $table->enum('level', ['pemula', 'menengah', 'mahir'])->default('pemula');
            $table->integer('total_students')->default(0);
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
