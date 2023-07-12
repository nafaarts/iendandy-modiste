<?php

namespace App\Http\Controllers;

use App\Models\Warna;
use Illuminate\Http\Request;

class WarnaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $warna = Warna::paginate(15);
        return view('warna.index', compact('warna'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('warna.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'warna' => 'required',
            'catatan' => 'nullable'
        ]);

        Warna::create($validated);

        return redirect()->route('warna.index')->with('success', 'warna berhasil ditambah!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warna  $warna
     * @return \Illuminate\Http\Response
     */
    // public function edit(Warna $warna)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Warna  $warna
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Warna $warna)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warna  $warna
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Warna $warna)
    {
        $warna->delete();

        return back()->with('success', 'warna berhasil dihapus!');
    }
}
