<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'kasir_id',
        'nama_lengkap',
        'no_whatsapp',
        'alamat',
        'total_harga',
        'status',
        'catatan',
    ];

    protected $casts = [
        'total_harga' => 'decimal:2',
    ];

    /**
     * Pelanggan yang membuat pesanan
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Kasir yang menangani pesanan
     * Boleh kosong karena pesanan baru belum tentu
     * langsung ditangani kasir.
     */
    public function kasir(): BelongsTo
    {
        return $this->belongsTo(User::class, 'kasir_id');
    }

    /**
     * Detail item pesanan
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    /**
     * Data pembayaran
     */
    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class, 'order_id');
    }
}
