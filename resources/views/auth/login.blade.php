@extends('layouts.guest')

@section('content')
    <div class="card py-5 px-4 m-2 w-100" style="max-width: 600px">
        <div class="text-center">
            <img class="mb-3" src="{{ asset('logo.png') }}" alt="Iendandy Modiste" height="60">
            <hr>
            <h1 class="h4 text-gray-900 my-4">MASUK KE AKUN ANDA</h1>
        </div>
        <form class="user" action="{{ route('login') }}" method="post">
            @csrf
            <div class="form-group">
                <input type="email" name="email" value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail"
                    aria-describedby="emailHelp" placeholder="{{ __('Enter Email Address') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    id="exampleInputPassword" placeholder="{{ __('Password') }}" required>
            </div>
            @error('password')
                <div class="form-group custom-control">
                    <label class="">{{ $message }}</label>
                </div>
            @enderror

            <div class="form-group">
                <div class="custom-control custom-checkbox small">
                    <input type="checkbox" name="remember" class="custom-control-input" id="customCheck">
                    <label class="custom-control-label" for="customCheck">{{ __('Remember Me') }}</label>
                </div>
            </div>

            <button type="submit" class="btn btn-gold btn-block">
                LOGIN
            </button>
        </form>
        <hr>
        @if (Route::has('password.request'))
            <div class="text-center">
                <a class="small text-gold" href="{{ route('password.request') }}">{{ __('Forgot Password?') }}</a>
            </div>
        @endif
        @if (Route::has('register'))
            <div class="text-center">
                <a class="small text-gold" href="{{ route('register') }}">Belum punya akun? Daftar</a>
            </div>
        @endif
    </div>
@endsection
