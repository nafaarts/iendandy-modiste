<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class UbahStatusPesananController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, Pesanan $pesanan)
    {
        // ENUM : 'PESANAN_DIBUAT', 'DIKONFIRMASI', 'MENUNGGU_PEMBAYARAN', 'DIPROSES', 'DIKIRIM', 'SELESAI', 'DIBATALKAN'

        // update data status pesanan di database
        $pesanan->update([
            'status_pesanan' => $request->status_pesanan
        ]);

        // kembalikan halaman ke halaman sebelumnya dengan mengirimkan pesan sukses.
        return back()->with('success', 'Status pesanan berhasil diubah menjadi ' . $pesanan->status_pesanan);
    }
}