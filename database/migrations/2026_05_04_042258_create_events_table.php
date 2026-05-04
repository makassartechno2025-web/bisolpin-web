<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->dateTime('event_date');
            $table->string('location')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->boolean('is_free')->default(true);
            $table->string('image_url')->nullable(); // Cloudinary URL
            $table->string('registration_link')->nullable();
            $table->string('icon_url')->nullable(); // small icon for slider
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
