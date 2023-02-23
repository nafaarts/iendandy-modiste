@extends('layouts.guest')

@section('content')
    <div class="card py-5 px-4 m-2 w-100" style="max-width: 600px">
        <div class="text-center">
            <img class="mb-3" src="{{ asset('logo.png') }}" alt="Iendandy Modiste" height="60">
            <hr>
            <h1 class="h4 text-gray-900 my-4">DAFTAR AKUN BARU</h1>
        </div>
        <form class="user" action="{{ route('register') }}" method="post">
            @csrf
            <div class="form-group">
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                    value="{{ old('name') }}" placeholder="Nama Lengkap">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    id="email" value="{{ old('email') }}" placeholder="Alamat Email">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <input type="phone" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror"
                    id="phone_number" value="{{ old('phone_number') }}" placeholder="Nomor Telepon">
                @error('phone_number')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        id="password" placeholder="Password">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <input type="password" name="password_confirmation"
                        class="form-control @error('password_confirmation') is-invalid @enderror" id="password-repeat"
                        placeholder="Ulangi Password">
                </div>
            </div>

            <button type="submit" class="btn btn-gold btn-block">
                REGISTRASI
            </button>
        </form>
        <hr>
        @if (Route::has('password.request'))
            <div class="text-center">
                <a class="small text-gold" href="{{ route('password.request') }}">{{ __('Forgot Password?') }}</a>
            </div>
        @endif
        @if (Route::has('login'))
            <div class="text-center">
                <a class="small text-gold" href="{{ route('login') }}">Sudah punya akun? Masuk</a>
            </div>
        @endif
    </div>
@endsection
