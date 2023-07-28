<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function signInwithGoogle(Request $request)
    {
        if (request('utils') == 'register') {
            $request->session()->put('utils', 'register');
        }

        return Socialite::driver('google')->redirect();
    }

    public function callbackToGoogle(Request $request)
    {
        $utils = $request->session()->get('utils');
        $request->session()->forget('utils');

        try {
            $user = Socialite::driver('google')->user();

            if ($finduser  = User::where('gauth_id', $user->id)->orWhere('email', $user->email)->first()) {
                Auth::login($finduser);
                return redirect()->intended();
            } else {
                if ($utils == 'register') {
                    $newUser = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'gauth_id' => $user->id,
                        'gauth_type' => 'google',
                        'password' => bcrypt(str()->random(16))
                    ]);

                    Auth::login($newUser);
                    return redirect()->route('profil')->with('success', 'Hai <strong>' . $user->name . '</strong>, Terima kasih telah mendaftar pada toko kami. Sebelum memulai pesanan, mohon lengkapi <strong>nomor handphone</strong> anda.');
                } else {
                    return redirect()->route($utils ?? 'login')->withErrors([
                        'email' => [trans('auth.failed')],
                    ]);
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
