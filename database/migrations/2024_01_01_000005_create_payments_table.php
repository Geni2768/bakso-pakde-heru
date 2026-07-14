<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration untuk membuat tabel payments.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')
                  ->constrained('orders')
                  ->onDelete('cascade');
            $table->decimal('jumlah_bayar', 12, 2);
            $table->decimal('kembalian', 12, 2)->default(0);
            $table->enum('metode_pembayaran', ['tunai', 'transfer', 'qris'])
                  ->default('tunai');
            $table->enum('status_pembayaran', ['lunas', 'belum_lunas'])
                  ->default('belum_lunas');
            $table->timestamps();
        });
    }

    /**
     * Batalkan migration (rollback).
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
