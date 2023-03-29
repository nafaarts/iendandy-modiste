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
        $pesanan->update([
            'konfirmasi_pembayaran' => !$pesanan->konfirmasi_pembayaran
        ]);

        // buat pesan untuk ditampilkan
        if ($pesanan->konfirmasi_pembayaran) {
            $pesan = 'Pembayaran berhasil di konfirmasi.';
        } else {
            $pesan = 'Pembayaran berhasil di batalkan.';
        }

        // kembalikan halaman ke halaman sebelumnya dengan mengirimkan pesan sukses.
        return back()->with('success', $pesan);
    }
}