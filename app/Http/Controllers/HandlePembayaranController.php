<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HandlePembayaranController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, Pesanan $pesanan)
    {
        // validasi gambar yang di input.
        $request->validate([
            'bukti_transfer' => 'required|image'
        ]);

        // check jika data pesanan sudah pernah di upload atau belum, kalau sudah hapus yang lama
        if ($pesanan->bukti_transfer) {
            File::delete(storage_path('app/public/img/bukti_transfer/') . $pesanan->bukti_transfer);
        }

        // update gambar ke server aplikasi (storage)
        $request->bukti_transfer->store('public/img/bukti_transfer/');

        // update data pesanan di database dengan nama yang sudah di hashing agar tidak ada duplikasi nama file.
        $pesanan->update([
            'status_pesanan' => 'MENUNGGU_KONFIRMASI_PEMBAYARAN',
            'bukti_transfer' => $request->bukti_transfer->hashName()
        ]);

        // kembalikan halaman ke halaman pesanan dengan menyertakan pesan sukses.
        return redirect()->route('detail.pesanan', $pesanan)
            ->with('success', 'Terima kasih, Bukti transfer berhasil disimpan dan akan di periksa oleh admin.');
    }
}
