<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->foreignId('promotion_id')->nullable()->constrained('promotions')->onDelete('set null');
            $table->dateTime('service_schedule'); // Jadwal yang disepakati
            $table->text('address'); // Alamat layanan
            $table->decimal('base_price', 10, 2); // Harga asli layanan
            $table->decimal('discount_amount', 10, 2)->default(0); // Jumlah potongan diskon
            $table->decimal('transport_cost', 10, 2)->default(0); // Ongkir
            $table->decimal('total_price', 10, 2); // Harga final
            $table->enum('status', ['Menunggu Konfirmasi', 'Diproses', 'Selesai', 'Dibatalkan'])->default('Menunggu Konfirmasi');
            $table->enum('payment_status', ['Belum Lunas', 'Lunas'])->default('Belum Lunas');
            $table->string('payment_method')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};