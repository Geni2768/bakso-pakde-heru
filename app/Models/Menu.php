<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $fillable = [
        'kategori_id',
        'nama_menu',
        'deskripsi',
        'harga',
        'stok',
        'gambar',
        'status',
    ];

    /**
     * Cast otomatis tipe data kolom.
     */
    protected $casts = [
        'harga'  => 'decimal:2',
        'stok'   => 'integer',
        'status' => 'string',
    ];

    /**
     * Eager loading default — setiap query Menu otomatis load kategori.
     * Mencegah N+1 Query Problem.
     */
    protected $with = ['kategori'];

    /**
     * Relasi: menu dimiliki oleh satu kategori.
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    /**
     * Relasi: menu bisa ada di banyak order_items.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'menu_id');
    }

    /**
     * Helper: ambil URL gambar atau placeholder jika tidak ada.
     */
    public function getGambarUrlAttribute(): string
    {
        if ($this->gambar && file_exists(storage_path('app/public/menus/' . $this->gambar))) {
            return asset('storage/menus/' . $this->gambar);
        }

        return asset('images/no-image.png');
    }
}
