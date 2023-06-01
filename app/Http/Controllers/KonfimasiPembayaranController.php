<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;

class KonfimasiPembayaranController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Pesanan $pesanan)
    {
        // update data di database
        // ubah status pembayaran menjadi sudah dibayar dengan 'true'
        // dan ubah status pesanan menjadi DIPROSES
        $pesanan->update([
            'konfirmasi_pembayaran' => true,
            'status_pesanan' => 'DIPROSES'
        ]);

        // kembalikan halaman ke halaman sebelumnya dengan mengirimkan pesan sukses.
        return back()->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }
}
