<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class EditProfilController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        // memvalidasi data yang di input.
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|numeric'
        ]);

        // mencari user dengan id yang sedang login
        // dan mengubah user tersebut dengan inputan baru di database
        $user = User::findOrFail(auth()->id());
        $user->update($validated);

        // kembali ke halaman profil dengan pesan success
        return back()->with('success', 'Profil berhasil diubah');
    }
}
