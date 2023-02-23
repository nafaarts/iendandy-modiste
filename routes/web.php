<?php

use App\Http\Controllers\AdminController;
use App\Models\Katalog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $katalog = Katalog::latest()->get();
    return view('beranda', compact('katalog'));
})->name('beranda');

Route::get('/detail/{katalog:kode_katalog}', function (Katalog $katalog) {
    return view('detail-katalog', compact('katalog'));
})->name('detail.katalog');

Route::get('/tentang', function () {
    return view('tentang');
});

Auth::routes([
    "reset" => false,
]);

Route::middleware('auth')->group(function () {
    Route::middleware('can:is-admin')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

        Route::resource('users', App\Http\Controllers\UserController::class);
        Route::resource('katalog', App\Http\Controllers\KatalogController::class);

        Route::get('/admin', [AdminController::class, 'show'])->name('admin');
        Route::put('/admin', [AdminController::class, 'update'])->name('admin');
    });

    Route::get('/profil', function () {
        return view('profil');
    })->name('profil');
});
