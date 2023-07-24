<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KatalogWarna extends Model
{
    use HasFactory;

    protected $table = 'katalog_warna';

    protected $fillable = [
        'katalog_id',
        'nama',
        'gambar',
        'stok'
    ];

    public function katalog(): BelongsTo
    {
        return $this->belongsTo(Katalog::class);
    }
}
