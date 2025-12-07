<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

/**
 * Mengambil nilai setting dari database.
 * Menggunakan cache agar lebih cepat.
 */
if (!function_exists('settings')) {
    function settings($key, $default = null)
    {
        // Ambil semua settings dari cache (atau DB jika belum ada)
        $settings = Cache::rememberForever('all_settings', function () {
            return DB::table('settings')->pluck('value', 'key')->toArray();
        });

        // Kembalikan nilai berdasarkan key
        return $settings[$key] ?? $default;
    }
}