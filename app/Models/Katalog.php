<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function order()
    {
        // return $this->hasMany()
        return collect([1, 2, 3, 4, 5]);
    }
}
