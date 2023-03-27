<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class UbahUkuranPesananController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, Pesanan $pesanan)
    {
        // ubah data pesanan yang dikirim di parameter dengan data yang baru di input.
        $pesanan->update([
            'ukuran' => $request->ukuran
        ]);

        // kembalikan halaman dengan pesan sukses
        return back()->with('success', 'Ukuran baju anda berhasil diubah.');
    }
}