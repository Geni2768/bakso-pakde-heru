<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            // Relasi ke order
            $table->foreignId('order_id')
                ->constrained('orders')
                ->cascadeOnDelete();

            // Metode pembayaran
            $table->enum('metode_pembayaran', [
                'cod',
                'transfer',
            ]);

            // Jumlah pembayaran
            $table->decimal('amount', 12, 2);

            // Status pembayaran
            $table->enum('status', [
                'pending',
                'dibayar',
                'gagal',
            ])->default('pending');

            // Bukti pembayaran jika transfer
            $table->string('bukti_pembayaran')
                ->nullable();

            // Waktu pembayaran
            $table->timestamp('paid_at')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
