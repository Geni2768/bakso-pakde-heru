<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration untuk membuat tabel orders.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');         // pelanggan
            $table->foreignId('kasir_id')
                  ->constrained('users')
                  ->onDelete('cascade');         // kasir yang melayani
            $table->enum('status', ['pending', 'diproses', 'selesai', 'dibatalkan'])
                  ->default('pending');
            $table->decimal('total_harga', 12, 2)->default(0);
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Batalkan migration (rollback).
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
