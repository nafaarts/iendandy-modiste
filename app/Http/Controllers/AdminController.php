<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;

class AdminController extends Controller
{
    public function show()
    {
        // menampilkan halaman admin yang ada di folder resources/views/admin/index.blade.php
        return view('admin.index');
    }

    public function update(ProfileUpdateRequest $request)
    {
        // mengambil data didatabase dengan id yang sedang login.
        $user = User::findOrFail(auth()->id());

        // mengecek jika user merubah password.
        if ($request->password) {
            // jika ada, ubah password didatabase.
            // password di hash agar tidak diketahui oleh hacker maupun developer.
            $user->update(['password' => Hash::make($request->password)]);
        }

        // ubah data user didatabase sesuai dengan inputan baru.
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            // 'username' => $request->username,
            'phone_number' => $request->phone_number
        ]);

        // kembalikan ke halaman sebelumnya dan berikan pesan sukses.
        return redirect()->back()->with('success', 'Admin berhasil diubah!');
    }
}
