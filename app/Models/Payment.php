<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'order_id',
        'metode_pembayaran',
        'jumlah_bayar',
    ];

    protected $casts = [
        'jumlah_bayar' => 'decimal:2',
    ];

    /**
     * Relasi pembayaran ke pesanan
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(
            Order::class,
            'order_id'
        );
    }
}
