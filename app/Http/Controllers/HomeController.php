<?php

namespace App\Http\Controllers;

use App\Models\Katalog;
use App\Models\Pesanan;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // ambil jumlah pengguna
        $jumlahPengguna = User::count();

        // ambil jumlah katalog
        $jumlahKatalog = Katalog::count();

        // ambil jumlah pesanan
        $jumlahPesanan = Pesanan::count();

        // ambil total transaksi dari pesanan yang telah selesai
        $totalTransaksi = Pesanan::where('status_pesanan', 'SELESAI')->sum('biaya');

        // menampilkan halaman dashboard yang ada di folder resources/views/dashboard.blade.php
        return view('dashboard', compact('jumlahPengguna', 'jumlahKatalog', 'jumlahPesanan', 'totalTransaksi'));
    }
}