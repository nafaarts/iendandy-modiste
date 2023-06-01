<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class TetapkanHargaPesananController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, Pesanan $pesanan)
    {
        // validasi
        $request->validate([
            'biaya' => 'required|numeric',
        ]);

        // Update data biaya di database
        $pesanan->update([
            'biaya' => $request->biaya,
            'status_pesanan' => 'MENUNGGU_KONFIRMASI_USER'
        ]);

        // Kembalikan halaman ke halaman sebelumnya dengan mengirimkan pesan sukses.
        return back()->with('success', 'Harga berhasil ditetapkan menjadi Rp ' . number_format($pesanan->biaya));
    }
}
