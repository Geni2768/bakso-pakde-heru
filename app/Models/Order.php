<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kasir_id',
        'status',
        'total_harga',
        'catatan',
    ];

    protected $casts = [
        'total_harga' => 'decimal:2',
    ];

    /** Relasi ke pelanggan */
    public function pelanggan()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /** Relasi ke kasir */
    public function kasir()
    {
        return $this->belongsTo(User::class, 'kasir_id');
    }

    /** Relasi ke item-item dalam order */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    /** Relasi ke pembayaran */
    public function payment()
    {
        return $this->hasOne(Payment::class, 'order_id');
    }
}
