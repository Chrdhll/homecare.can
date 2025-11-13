<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::table('services', function (Blueprint $table) {
            // Tambah kolom baru 'gallery' (tipe JSON) setelah kolom 'image'
            $table->json('gallery')->nullable()->after('image');

            // Bikin kolom 'image' lama jadi boleh kosong (buat cadangan)
            $table->string('image')->nullable()->change();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('gallery');
            $table->string('image')->nullable(false)->change();
        });

    }
};
