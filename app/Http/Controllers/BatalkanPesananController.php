<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class BatalkanPesananController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, Pesanan $pesanan)
    {
        // ubah status pesanan dari pesanan yang dikirimkan di parameter menjadi DIBATALKAN
        $pesanan->update([
            'status_pesanan' => 'DIBATALKAN'
        ]);

        // kembalikan halaman dengan pesan sukses
        return back()->with('success', 'Pesanan anda berhasil dibatalkan.');
    }
}