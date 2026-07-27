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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Pelanggan yang membuat pesanan
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Data pelanggan saat checkout
            $table->string('nama_lengkap');
            $table->string('no_whatsapp');
            $table->text('alamat');

            // Total seluruh pesanan
            $table->decimal('total_harga', 12, 2);

            // Status pesanan
            $table->enum('status', [
                'pending',
                'diproses',
                'selesai',
                'dibatalkan',
            ])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
