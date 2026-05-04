<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Seed default settings
        $defaults = [
            ['key' => 'site_name',       'value' => 'BISOLPIN'],
            ['key' => 'site_tagline',    'value' => 'Sistem Edutech Terpadu'],
            ['key' => 'site_phone',      'value' => '+62 000-0000-0000'],
            ['key' => 'site_email',      'value' => 'info@bisolpin.com'],
            ['key' => 'site_address',    'value' => 'Makassar, Sulawesi Selatan'],
            ['key' => 'site_whatsapp',   'value' => '62000000000'],
            ['key' => 'social_instagram','value' => ''],
            ['key' => 'social_facebook', 'value' => ''],
            ['key' => 'social_youtube',  'value' => ''],
        ];
        foreach ($defaults as $setting) {
            DB::table('site_settings')->insert(array_merge($setting, [
                'created_at' => now(), 'updated_at' => now(),
            ]));
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
