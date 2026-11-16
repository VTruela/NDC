<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Override teks website yang diatur administrator.
     *
     * Baris hanya dibuat saat teks DIUBAH dari nilai default, sehingga
     * nilai default tetap berada pada file lang/*\/ui.php dan config/company.php.
     */
    public function up(): void
    {
        Schema::create('site_texts', function (Blueprint $table) {
            $table->id();
            $table->string('key', 191);
            // '' = berlaku untuk semua bahasa (data profil perusahaan).
            $table->string('locale', 8)->default('');
            $table->text('value')->nullable();
            $table->timestamps();

            $table->unique(['key', 'locale']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_texts');
    }
};
