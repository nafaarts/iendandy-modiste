<?php

namespace App\Http\Controllers;

use App\Models\Katalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KatalogController extends Controller
{
    public function index()
    {
        // ambil data katalog di database dan diurutkan berdasarkan inputan yang terbaru.
        $katalog = Katalog::latest();

        // check jika ada inputan cari
        if (request('cari')) {
            // pilah data katalog dengan kode yang diinput.
            $katalog->where('kode_katalog', 'LIKE', '%' . request('cari') . '%');
        }

        // bagikan katalog menjadi berapa halaman.
        $katalog = $katalog->paginate();

        // tampilkan halaman katalog dan kirim data katalog ke halaman tersebut dengat compact.
        return view('katalog.index', compact('katalog'));
    }

    public function create()
    {
        // buat kode katalog.
        $kode = 'KTLG-' . str_pad((Katalog::latest()->first()?->id ?? 0) + 1, 4, '0', STR_PAD_LEFT);

        // tampilkan halaman buat katalog dengan menampilkan kode yang telah di generate.
        return view('katalog.create', compact('kode'));
    }

    public function store(Request $request)
    {
        // validasi data yang diinput.
        $validated = $request->validate([
            'kode_katalog' => 'required|unique:katalog',
            'gambar' => 'required',
            'harga_dengan_kain' => 'required|numeric',
            'harga_tanpa_kain' => 'required|numeric',
            'deskripsi' => 'nullable'
        ]);

        // simpan gambar yang diinput ke folder /public/img/katalog.
        $request->gambar->store('/public/img/katalog');

        // simpan nama gambar yang telah di simpan.
        $validated['gambar'] = $request->gambar->hashName();

        // masukan data yang telah diinput ke database katalog.
        Katalog::create($validated);

        // kembalikan halaman ke halaman index katalog dengan pesan sukses.
        return redirect()->route('katalog.index')->with('success', 'Katalog berhasil ditambahkan!');
    }

    public function edit(Katalog $katalog)
    {
        // tampilkan halaman edit katalog dengan mengirimkan data katalog.
        return view('katalog.edit', compact('katalog'));
    }

    public function show(Katalog $katalog)
    {
        // tampilkan halaman show katalog dengan mengirimkan data katalog.
        return view('katalog.show', compact('katalog'));
    }

    public function update(Request $request, Katalog $katalog)
    {
        // validasi data uang di input.
        $validated = $request->validate([
            'gambar' => 'nullable',
            'harga_dengan_kain' => 'required|numeric',
            'harga_tanpa_kain' => 'required|numeric',
            'deskripsi' => 'required'
        ]);

        // check jika user ada input gambar atau tidak.
        if ($request->has('gambar')) {
            // jika ada, hapus gambar lama.
            Storage::delete('/public/img/katalog/' . $katalog->gambar);
            // simpan gambar yang di input ke /public/img/katalog/
            $request->gambar->store('/public/img/katalog');
            // simpan nama gambar yang yang baru.
            $validated['gambar'] = $request->gambar->hashName();
        } else {
            // jika tidak ada gambar yang diinput. tetapkan nama gambar dengan yang lama.
            $validated['gambar'] = $katalog->gambar;
        }

        // ubah data di database.
        $katalog->update($validated);

        // kembalikan ke halaman index katalog dengan melampirkna pesan sukses.
        return redirect()->route('katalog.index')->with('success', 'Katalog berhasil diubah!');
    }

    public function destroy(Katalog $katalog)
    {
        // hapus gambar yang disimpan.
        Storage::delete('/public/img/katalog/' . $katalog->gambar);

        // hapus data di database.
        $katalog->delete();

        // kembalikan ke halaman index katalog dengan pesan sukses.
        return redirect()->route('katalog.index')->with('success', 'Katalog berhasil dihapus!');
    }
}