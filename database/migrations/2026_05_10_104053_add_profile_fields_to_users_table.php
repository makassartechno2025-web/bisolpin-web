<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone', 20)->nullable()->after('role');
            $table->string('avatar')->nullable()->after('phone');
            $table->text('bio')->nullable()->after('avatar');
            $table->string('status', 20)->default('active')->after('bio'); // active, suspended, pending
        });

        // Update existing 'user' roles to 'siswa'
        DB::table('users')->where('role', 'user')->update(['role' => 'siswa']);
    }

    public function down(): void
    {
        // Revert role names
        DB::table('users')->where('role', 'siswa')->update(['role' => 'user']);

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'avatar', 'bio', 'status']);
        });
    }
};
