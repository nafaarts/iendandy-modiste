<?php

namespace App\Http\Controllers;

use App\Models\Katalog;
use App\Models\KatalogWarna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KatalogWarnaController extends Controller
{
    public function create(Katalog $katalog)
    {
        return view('katalog-warna.create', compact('katalog'));
    }

    public function store(Request $request, Katalog $katalog)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'gambar' => 'required|image|max:2048',
            'stok' => 'required|numeric'
        ]);

        $request->gambar->store('/public/img/katalog');

        $validated['gambar'] = $request->gambar->hashName();

        $katalog->warna()->create($validated);

        return redirect()->route('katalog.show', $katalog)->with('success', 'Opsi warna berhasil ditambah!');
    }

    public function edit(Katalog $katalog, KatalogWarna $warna)
    {
        return view('katalog-warna.edit', compact('katalog', 'warna'));
    }

    public function update(Request $request, Katalog $katalog, KatalogWarna $warna)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'gambar' => 'nullable|image|max:2048',
            'stok' => 'required|numeric'
        ]);

        if ($request->has('gambar')) {
            Storage::delete('/public/img/katalog/' . $warna->gambar);
            $request->gambar->store('/public/img/katalog');
            $validated['gambar'] = $request->gambar->hashName();
        } else {
            $validated['gambar'] = $katalog->gambar;
        }

        $warna->update($validated);

        return redirect()->route('katalog.show', $katalog)->with('success', 'Opsi warna berhasil diubah!');
    }

    public function destroy(Katalog $katalog, KatalogWarna $warna)
    {
        Storage::delete('/public/img/katalog/' . $warna->gambar);
        $warna->delete();

        return redirect()->route('katalog.show', $katalog)->with('success', 'Opsi warna berhasil diubah!');
    }
}
