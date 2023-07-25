<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function signInwithGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackToGoogle()
    {
        try {
            $user = Socialite::driver('google')->user();

            $finduser = User::where('gauth_id', $user->id)
                ->orWhere('email', $user->email)->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect('/');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'gauth_id' => $user->id,
                    'gauth_type' => 'google',
                    'password' => bcrypt(str()->random(16))
                ]);
                Auth::login($newUser);
                return redirect('/');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            // echo "terjadi kesalahan...";
        }
    }
}
