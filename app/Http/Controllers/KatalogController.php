<?php

namespace App\Http\Controllers;

use App\Models\Katalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KatalogController extends Controller
{
    public function index()
    {
        $katalog = Katalog::latest();
        if (request('cari')) {
            $katalog->where('kode_katalog', 'LIKE', '%' . request('cari') . '%');
        }
        $katalog = $katalog->paginate();
        return view('katalog.index', compact('katalog'));
    }

    public function create()
    {
        $kode = 'KTLG-' . str_pad((Katalog::latest()->first()?->id ?? 0) + 1, 4, '0', STR_PAD_LEFT);
        return view('katalog.create', compact('kode'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_katalog' => 'required',
            'gambar' => 'required',
            'harga_dengan_kain' => 'required|numeric',
            'harga_tanpa_kain' => 'required|numeric',
            'deskripsi' => 'nullable'
        ]);

        $request->gambar->store('/public/img/katalog');

        $validated['gambar'] = $request->gambar->hashName();

        Katalog::create($validated);

        return redirect()->route('katalog.index')->with('success', 'Katalog berhasil ditambahkan!');
    }

    public function edit(Katalog $katalog)
    {
        return view('katalog.edit', compact('katalog'));
    }

    public function show(Katalog $katalog)
    {
        return view('katalog.show', compact('katalog'));
    }

    public function update(Request $request, Katalog $katalog)
    {
        $validated = $request->validate([
            'gambar' => 'nullable',
            'harga_dengan_kain' => 'required|numeric',
            'harga_tanpa_kain' => 'required|numeric',
            'deskripsi' => 'required'
        ]);

        if ($request->has('gambar')) {
            Storage::delete('/public/img/katalog/' . $katalog->gambar);
            $request->gambar->store('/public/img/katalog');
            $validated['gambar'] = $request->gambar->hashName();
        } else {
            $validated['gambar'] = $katalog->gambar;
        }

        $katalog->update($validated);

        return redirect()->route('katalog.index')->with('success', 'Katalog berhasil diubah!');
    }

    public function destroy(Katalog $katalog)
    {
        Storage::delete('/public/img/katalog/' . $katalog->gambar);
        $katalog->delete();
        return redirect()->route('katalog.index')->with('success', 'Katalog berhasil dihapus!');
    }
}
