<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Katalog extends Model
{
    use HasFactory;

    protected $table = 'katalog';

    protected $fillable = [
        'kode_katalog',
        'gambar',
        'harga_dengan_kain',
        'harga_tanpa_kain',
        'deskripsi'
    ];

    public function stok(): int
    {
        return $this->warna->reduce(function ($total, $item) {
            return $total += $item->stok;
        }, 0);
    }

    public function warna(): HasMany
    {
        return $this->hasMany(KatalogWarna::class);
    }

    public function order(): HasMany
    {
        return $this->hasMany(Pesanan::class, 'katalog_id');
    }
}
