<?php

namespace App\Http\Controllers;

use App\Models\Katalog;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class BuatPesananKatalogController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, Katalog $katalog)
    {
        // validasi data pesanan yang di input.
        $request->validate([
            'alamat' => 'required',
            'catatan' => 'nullable'
        ]);

        // buat nomor pesanan
        $code = $katalog->kode_katalog . '-' . time() . '-' . date('Y');

        // ambil harga sesuai dengan harga yang telah ditetapkan
        // misalnya kalo pake kain berapa dan kalau tidak pakai kain berapa
        $biaya = $request->dengan_kain ? $katalog->harga_dengan_kain : $katalog->harga_tanpa_kain;

        // masukan data pesanan ke dalam database.
        $pesanan = Pesanan::create([
            'user_id' => auth()->id(),
            'no_pesanan' => $code,
            'katalog_id' => $katalog->id,
            'biaya' => $biaya,
            'ukuran' => $request->ukuran,
            'termasuk_kain' => $request->dengan_kain,
            'alamat' => $request->alamat,
            'catatan' => $request->catatan
        ]);

        // redirect halaman ke halaman detail pesanan dengan pesanan terkait
        // dan kirimkan pesan alert success dipesan.
        return redirect()->route('detail.pesanan', $pesanan)
                ->with('success', 'Terima kasih, Pesanan anda berhasil dibuat. silahkan selesaikan pembayaran anda.');
    }
}