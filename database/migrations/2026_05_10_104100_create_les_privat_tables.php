<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ── Tutor Profiles ────────────────────────────────
        Schema::create('tutor_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('subjects');           // JSON: ["Matematika","Fisika"]
            $table->string('location_city');
            $table->string('location_area')->nullable();
            $table->text('bio')->nullable();
            $table->integer('experience_years')->default(0);
            $table->string('education')->nullable();
            $table->string('photo')->nullable();
            $table->decimal('rating_avg', 3, 2)->default(0);
            $table->integer('total_reviews')->default(0);
            $table->boolean('is_available')->default(true);
            $table->text('schedule')->nullable(); // JSON: {"senin":["pagi","siang"]}
            $table->timestamps();
        });

        // ── Tutor Rates ───────────────────────────────────
        Schema::create('tutor_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tutor_profile_id')->constrained()->onDelete('cascade');
            $table->integer('duration_minutes'); // 30, 60, 90, 120
            $table->integer('price');            // dalam rupiah
            $table->timestamps();
        });

        // ── Bookings ──────────────────────────────────────
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code')->unique();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('tutor_profile_id')->constrained()->onDelete('cascade');
            $table->string('subject');
            $table->integer('duration_minutes');
            $table->integer('price');
            $table->date('booking_date');
            $table->string('start_time', 10)->nullable();
            $table->string('location_type', 20)->default('offline'); // online / offline
            $table->text('location_address')->nullable();
            $table->text('notes')->nullable();
            $table->string('status', 20)->default('pending'); // pending, confirmed, ongoing, completed, cancelled
            $table->string('cancelled_by', 20)->nullable();
            $table->text('cancel_reason')->nullable();
            $table->timestamps();
        });

        // ── Tutor Reviews ─────────────────────────────────
        Schema::create('tutor_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->unique()->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('tutor_profile_id')->constrained()->onDelete('cascade');
            $table->tinyInteger('rating'); // 1-5
            $table->text('comment')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tutor_reviews');
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('tutor_rates');
        Schema::dropIfExists('tutor_profiles');
    }
};
