<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    protected $fillable = [
        'user_id',
        'no_pesanan',
        'status_pesanan', // ENUM :  'MENUNGGU_KONFIRMASI_ADMIN', 'MENUNGGU_KONFIRMASI_USER', 'MENUNGGU_PEMBAYARAN', 'DIPROSES', 'DIKIRIM', 'SELESAI', 'DIBATALKAN'
        'tipe_pesanan', // ENUM : 'KATALOG', 'KOSTUM'
        'katalog_id',
        'foto_katalog',
        'ukuran', // json
        'termasuk_kain', // boolean
        'biaya', // integer
        'bukti_transfer',
        'konfirmasi_pembayaran', // boolean
        'tanggal_dibayar', // date
        'tanggal_diterima',
        'alamat',
        'catatan' // text
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function katalog()
    {
        return $this->belongsTo(Katalog::class, 'katalog_id');
    }
}
