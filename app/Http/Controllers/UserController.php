<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // menambil data yang bukan admin.
        $users = User::where('is_admin', '!=', 1)->paginate();

        // menampilkan halaman user yang ada difolder resources/views/users/index.blade.php
        // dan mengirimkan data users ke halaman tersebut dengan 'compact'
        return view('users.index', compact('users'));
    }

    public function create()
    {
        // menampilkan halaman form tambah user yang ada di folder resources/views/users/create.blade.php
        return view('users.create');
    }

    public function store(Request $request)
    {
        // validasi data yang diinput.
        $validated = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'phone_number' => 'required|numeric|unique:users,phone_number',
            'password' => 'required|min:8|confirmed',
        ]);

        // hashing password agar aman.
        $validated['password'] = bcrypt($request->password);

        // memasukan data ke database.
        User::create($validated);

        // kembalikan halaman ke user dengan pesan sukses.
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    public function edit(User $user)
    {
        // menampilkan halaman edit yang ada di folder resources/views/users/edit.blade.php
        // dan mengirimkan data user yang diterima di parameter ($user)
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // validasi data yang diinput.
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'phone_number' => 'required|numeric',
            'password' => 'nullable|min:8|confirmed',
        ]);

        // timpa data user yang lama dengan data yang baru diinput
        $user->name = $request->name;
        $user->username = $request->username;
        $user->phone_number = $request->phone_number;

        // check jika user meng-input password atau tidak
        if ($request->password) {
            // jika ada, timpa password yang lama dengan password baru yang telah di hashing (enkripsi).
            $user->password = bcrypt($request->password);
        }
        // simpan data yang sudah di timpa.
        $user->save();

        // kembalikan halaman ke user dengan pesan sukses.
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diubah!');
    }

    public function destroy(User $user)
    {
        // hapus user yang di kirim
        $user->delete();

        // kembalikan halaman ke user dengan pesan sukses di hapus.
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus!');
    }
}
