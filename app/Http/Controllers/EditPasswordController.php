<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class EditPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        // validasi data yang di input
        $request->validate([
            'password' => 'required|confirmed|min:8'
        ]);

        // ambil data user di database dengan id yang telah login.
        $user = User::findOrFail(auth()->id());

        // simpan password yang telah di ubah ke database.
        $user->update([
            'password' => bcrypt($request->password)
        ]);

        // kembalikan ke halaman sebelumnya dengan mengirimkan pesan sukses.
        return back()->with('success', 'Password berhasil diubah.');
    }
}