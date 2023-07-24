<?php

namespace App\Http\Controllers;

use App\Models\Katalog;
use App\Models\KatalogWarna;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        // cek apakah stok tersedia
        if ($katalog->stok() == 0) {
            return back()->with('error', 'Mohon maaf stok habis!');
        }

        // validasi data pesanan yang di input.
        $request->validate([
            'warna' => Rule::requiredIf($request->dengan_kain == '1'),
            'alamat' => 'required',
            'catatan' => 'nullable'
        ]);

        // ubah data ukuran yang awalnya json menjadi array
        $ukuran = json_decode($request->ukuran, true);

        // cek apakah ukuran ada, jika tidak tampilkan validasi (pesan) error.
        if (count($ukuran['value']) == 0) {
            return back()->with('error', 'Mohon masukan ukuran anda!');
        }

        // buat nomor pesanan
        $code = $katalog->kode_katalog . '-' . time() . '-' . date('Y');

        // ambil harga sesuai dengan harga yang telah ditetapkan
        // misalnya kalo pake kain berapa dan kalau tidak pakai kain berapa
        $biaya = $request->dengan_kain ? $katalog->harga_dengan_kain : $katalog->harga_tanpa_kain;

        // masukan data pesanan ke dalam database.
        $pesanan = Pesanan::create([
            'user_id' => auth()->id(),
            'no_pesanan' => $code,
            'status_pesanan' => 'MENUNGGU_PEMBAYARAN',
            'katalog_id' => $katalog->id,
            'katalog_warna_id' => $request->warna ?? null,
            'biaya' => $biaya,
            'ukuran' => $request->ukuran,
            'termasuk_kain' => $request->dengan_kain,
            'alamat' => $request->alamat,
            'catatan' => $request->catatan
        ]);

        // jika pesanan berhasil dibuat, kurangi jumlah stok.
        if ($request->dengan_kain && $request->warna) {
            $warna = KatalogWarna::find($request->warna);
            $warna->update(['stok' => $warna->stok - 1]);
        }
        // if ($pesanan) {
        //     $katalog->update(['stok' => $katalog->stok - 1]);
        // }

        // redirect halaman ke halaman detail pesanan dengan pesanan terkait
        // dan kirimkan pesan alert success dipesan.
        return redirect()->route('detail.pesanan', $pesanan)
            ->with('success', 'Terima kasih, Pesanan anda berhasil dibuat. silahkan selesaikan pembayaran anda.');
    }
}
