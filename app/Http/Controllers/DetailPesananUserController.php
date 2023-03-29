<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;

class DetailPesananUserController extends Controller
{
    public function detail(Pesanan $pesanan)
    {
        // mengubah format ukuran dari json ke array php
        $pesanan->ukuran = json_decode($pesanan->ukuran, true);

        // menampilkan halaman detail-pesanan-user yang ada di folder resources/views/detail-pesanan-user.blade.php
        return view('detail-pesanan-user', compact('pesanan'));
    }
}