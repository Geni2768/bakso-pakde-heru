<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'jumlah_bayar',
        'kembalian',
        'metode_pembayaran',
        'status_pembayaran',
    ];

    protected $casts = [
        'jumlah_bayar' => 'decimal:2',
        'kembalian'    => 'decimal:2',
    ];

    /** Relasi ke order */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
