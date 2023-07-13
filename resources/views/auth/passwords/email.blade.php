@extends('layouts.guest')

@section('content')
    <div class="card py-5 px-4 m-2 w-100" style="max-width: 600px">
        <div class="text-center">
            <img class="mb-3" src="{{ asset('logo.png') }}" alt="Iendandy Modiste" height="60">
            <hr>
            <h1 class="h4 text-gray-900 my-4">Lupa Password</h1>
        </div>
        <form class="user" action="{{ route('password.email') }}" method="post">
            @csrf

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="form-group">
                <input type="email" name="email" value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror" id="exampleInputemail"
                    aria-describedby="emailHelp" placeholder="{{ __('Masukan email') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-gold btn-block">
                RESET PASSWORD
            </button>
        </form>
        <hr>
        @if (Route::has('password.request'))
            <div class="text-center">
                <a class="small text-gold" href="{{ route('password.request') }}">Lupa Password?</a>
            </div>
        @endif
        @if (Route::has('register'))
            <div class="text-center">
                <a class="small text-gold" href="{{ route('register') }}">Belum punya akun? Daftar</a>
            </div>
        @endif
    </div>
@endsection
