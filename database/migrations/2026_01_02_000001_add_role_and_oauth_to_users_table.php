<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 20)->default('guest')->after('email');
            $table->string('provider', 50)->nullable()->after('password');
            $table->string('provider_id', 191)->nullable()->after('provider');
            $table->string('avatar', 255)->nullable()->after('provider_id');
            $table->string('password')->nullable()->change();
        });

        // Sebelum perombakan ini semua akun berperan sebagai administrator.
        DB::table('users')->update(['role' => 'admin']);
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'provider', 'provider_id', 'avatar']);
            $table->string('password')->nullable(false)->change();
        });
    }
};
