<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BatalkanPesananController;
use App\Http\Controllers\BuatPesananKatalogController;
use App\Http\Controllers\BuatPesananKostumController;
use App\Http\Controllers\DetailPesananUserController;
use App\Http\Controllers\EditPasswordController;
use App\Http\Controllers\EditProfilController;
use App\Http\Controllers\HandlePembayaranController;
use App\Http\Controllers\KonfimasiPembayaranController;
use App\Http\Controllers\KonfirmasiPesananSelesaiUserController;
use App\Http\Controllers\KonfirmasiPesananUserController;
use App\Http\Controllers\TetapkanHargaPesananController;
use App\Http\Controllers\UbahStatusPesananController;
use App\Http\Controllers\UbahUkuranPesananController;
use App\Models\Katalog;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// route untuk menampilkan halaman utama dan diberi nama 'beranda'.
Route::get('/', function () {
    // ambil katalog untuk di tampilkan di halaman utama
    $katalog = Katalog::latest()->get();
    // tampilkan halaman yang ada di folder resources/views/beranda.blade.php
    return view('beranda', compact('katalog'));
})->name('beranda');

// route untuk menampilkan halaman detail katalog dan diberi nama 'detail.katalog'.
Route::get('/detail/{katalog:kode_katalog}', function (Katalog $katalog) {
    // tampilkan halaman yang ada di folder resources/views/detail-katalog.blade.php
    return view('detail-katalog', compact('katalog'));
})->name('detail.katalog');

// route untuk menampilkan halaman tentang
Route::get('/tentang', function () {
    // tampilkan halaman tentang yang ada di folder resources/views/tentang.blade.php
    return view('tentang');
});

// route untuk mengelola authentikasi
// route ini sudah dibuat otomatis oleh library dari laravel yang bernama
// 'laravel ui' dengan tema bootstrap
Auth::routes([
    "reset" => false,
]);

// middleware ini berguna untuk mengecek jika ingin mengakses route yang ada didalamnya harus sudah login.
Route::middleware('auth')->group(function () {
    // route ini menggunakan middleware yang bertujuan untuk mengecek dan memberi izin
    // hanya kepada admin untuk mengakses routes didalamnya.
    Route::middleware('can:is-admin')->prefix('admin')->group(function () {
        // route ini untuk menampilkan halaman dashboard yang di control dari controller HomeController
        // yang ada di folder App/Http/Controllers/HomeController di method 'index'.
        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

        // route ini berguna untuk mengontrol semua data users di beberapa method yang berupa
        // [index, create, store, edit, update, destroy]
        // yang berada di halaman App/Http/Controllers/UserController
        Route::resource('users', App\Http\Controllers\UserController::class);

        // sama halnya seperti resources users diatas tetapi ini untuk mengontrol data katalog.
        Route::resource('katalog', App\Http\Controllers\KatalogController::class);

        // resource ini berfungsi untuk mengontrol data pesanan dengan mengecualikan method 'create' & 'store'.
        Route::resource('pesanan', App\Http\Controllers\PesananController::class)->except(['create', 'store']);

        // route ini untuk mengkonfirmasi pembayaran pesanan user dan diberi nama 'pesanan.konfirmasi-pembayaran'
        // di kontrol di controller KonfimasiPembayaranController yang ada di folder App/Http/Controllers/KonfimasiPembayaranController
        Route::put('/pesanan/{pesanan}/pembayaran', KonfimasiPembayaranController::class)->name('pesanan.konfirmasi-pembayaran');

        // route ini untuk mengubah status pesanan user dan diberi nama 'pesanan.ubah-status'
        // di kontrol di controller UbahStatusPesananController yang ada di folder App/Http/Controllers/UbahStatusPesananController
        Route::put('/pesanan/{pesanan}/ubah-status', UbahStatusPesananController::class)->name('pesanan.ubah-status');

        // route ini untuk menetapkan harga pesanan kostum user dan diberi nama 'pesanan.tetapkan-harga'
        // di kontrol di controller TetapkanHargaPesananController yang ada di folder App/Http/Controllers/TetapkanHargaPesananController
        Route::put('/pesanan/{pesanan}/tetapkan-harga', TetapkanHargaPesananController::class)->name('pesanan.tetapkan-harga');

        // route ini berguna untuk menampilkan halaman profil admin dan diberi nama admin.
        // di kontrol di controller AdminController di folder App/Http/Controllers/AdminController di method 'show'
        Route::get('/admin', [AdminController::class, 'show'])->name('admin');

        // route ini berguna untuk mengelola data yang dikirimkan
        // dari halaman profil admin di atas dan diberi nama 'admin.update'
        Route::put('/admin', [AdminController::class, 'update'])->name('admin.update');
    });

    // route ini untuk menampilkan halaman profil user dan diberi nama profil.
    Route::get('/profil', function () {
        // ambil data pesanan dari database dengan id user yang login dan di urutkan dari yang terakhir dipesan.
        $pesanan = Pesanan::where('user_id', auth()->id())->latest()->limit(5)->get();

        // menampilkan halaman dari folder resources/views/profil.blade.php dan mengirimkan data pesanan.
        return view('profil', compact('pesanan'));
    })->name('profil');

    // route ini bertujuan untuk meng-handle inputan edit profil user yang diberi nama 'edit.profil'
    // di kontrol di controller EditProfilController yang ada di folder App/Http/Controllers/EditProfilController
    Route::put('/profil/edit', EditProfilController::class)->name('edit.profil');

    // route ini bertujuan untuk meng-handle inputan edit password user dan diberi nama 'edit.password'
    // di kontrol di controller EditPasswordController yang ada di folder App/Http/Controllers/EditPasswordController
    Route::put('/profil/edit-password', EditPasswordController::class)->name('edit.password');

    // route ini untuk menampilakn halaman buat pesanan dan diberi nama 'buat.pesanan'
    Route::get('/pesan/{katalog:kode_katalog}', function (Katalog $katalog) {
        // menampilkan halaman buat-pesanan-katalog dan melampirkan data katalog dari parameter
        // halaman ini ada di folder resources/views/buat-pesanan-katalog.blade.php
        return view('buat-pesanan-katalog', compact('katalog'));
    })->name('buat.pesanan');

    // route ini untuk menghadle pesanan user dan menyimpannya kedalam database, diberi nama 'simpan.pesanan'
    // di kontrol di controller BuatPesananKatalogController yang ada di folder App/Http/Controllers/BuatPesananKatalogController
    Route::post('/pesan/{katalog:kode_katalog}/pesan', BuatPesananKatalogController::class)->name('simpan.pesanan');

    // route ini untuk menampilakn halaman buat pesanan kostum dan diberi nama 'buat.pesanan-kostum'
    Route::get('/pesan-kostum', function () {
        // menampilkan halaman buat-pesanan-kostum
        // halaman ini ada di folder resources/views/buat-pesanan-kostum.blade.php
        return view('buat-pesanan-kostum');
    })->name('buat.pesanan-kostum');

    // route ini untuk menghadle pesanan kostum user dan menyimpannya kedalam database, diberi nama 'simpan.pesanan-kostum'
    // di kontrol di controller BuatPesananKostumController yang ada di folder App/Http/Controllers/BuatPesananKostumController
    Route::post('/pesan-kostum/pesan', BuatPesananKostumController::class)->name('simpan.pesanan-kostum');

    // route ini untuk menampilkan data pesanan user dan diberi nama 'detail.pesanan'
    // di kontrol di controller DetailPesananUserController yang ada di folder App/Http/Controllers/DetailPesananUserController
    // di method 'detail'
    Route::get('/pesanan/{pesanan:no_pesanan}/detail', [DetailPesananUserController::class, 'detail'])->name('detail.pesanan');

    // route ini untuk menghandle ubah ukuran pada pesanan dan diberi nama 'ubah-ukuran.pesanan'
    // di kontrol di controller UbahUkuranPesananController yang ada di folder App/Http/Controllers/UbahUkuranPesananController
    Route::put('/pesanan/{pesanan:no_pesanan}/ubah-ukuran', UbahUkuranPesananController::class)->name('ubah-ukuran.pesanan');

    // route ini untuk menghandle pembatalan pada pesanan dan diberi nama 'batalkan.pesanan'
    // di kontrol di controller BatalkanPesananController yang ada di folder App/Http/Controllers/BatalkanPesananController
    Route::put('/pesanan/{pesanan:no_pesanan}/batalkan', BatalkanPesananController::class)->name('batalkan.pesanan');

    // route ini untuk menghandle konfirmasi user pada pesanan dan diberi nama 'konfirmasi.pesanan'
    // di kontrol di controller KonfirmasiPesananUserController yang ada di folder App/Http/Controllers/KonfirmasiPesananUserController
    Route::put('/pesanan/{pesanan:no_pesanan}/konfirmasi', KonfirmasiPesananUserController::class)->name('konfirmasi.pesanan');

    // route ini untuk menghandle konfirmasi selesai user pada pesanan dan diberi nama 'konfirmasi-selesai.pesanan'
    // di kontrol di controller KonfirmasiPesananSelesaiUserController yang ada di folder App/Http/Controllers/KonfirmasiPesananSelesaiUserController
    Route::put('/pesanan/{pesanan:no_pesanan}/konfirmasi-selesai', KonfirmasiPesananSelesaiUserController::class)->name('konfirmasi-selesai.pesanan');

    // route ini untuk menghandle pembayaran pada pesanan dan diberi nama 'pembayaran.pesanan'
    // di kontrol di controller HandlePembayaranController yang ada di folder App/Http/Controllers/HandlePembayaranController
    Route::put('/pesanan/{pesanan:no_pesanan}/pembayaran', HandlePembayaranController::class)->name('pembayaran.pesanan');
});
