<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class BuatPesananKostumController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        // validasi data pesanan yang di input.
        $request->validate([
            'foto_katalog' => 'required|image',
            'alamat' => 'required',
            'catatan' => 'nullable'
        ]);

        // buat nomor pesanan
        $code = 'KOSTUM-' . time() . '-' . date('Y');

        // upload gambar ke server aplikasi (storage)
        $request->foto_katalog->store('public/img/kostum_katalog/');

        // masukan data pesanan ke dalam database.
        $pesanan = Pesanan::create([
            'user_id' => auth()->id(),
            'no_pesanan' => $code,
            'tipe_pesanan' => 'KOSTUM',
            'foto_katalog' => $request->foto_katalog->hashName(),
            'ukuran' => $request->ukuran,
            'termasuk_kain' => $request->dengan_kain,
            'alamat' => $request->alamat,
            'catatan' => $request->catatan
        ]);

        // redirect halaman ke halaman detail pesanan dengan pesanan terkait
        // dan kirimkan pesan alert success dipesan.
        return redirect()->route('detail.pesanan', $pesanan)
                ->with('success', 'Terima kasih, Admin akan me-review pesanan anda.');
    }
}