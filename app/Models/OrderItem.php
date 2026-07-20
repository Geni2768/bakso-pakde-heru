<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'menu_id',
        'qty',
        'harga_satuan',
        'subtotal',
    ];

    protected $casts = [
        'harga_satuan' => 'decimal:2',
        'subtotal'     => 'decimal:2',
        'qty'          => 'integer',
    ];

    /** Relasi ke order */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /** Relasi ke menu — dengan eager loading */
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
