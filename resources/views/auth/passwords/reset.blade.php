@extends('layouts.guest')

@section('content')
    <div class="card py-5 px-4 m-2 w-100" style="max-width: 600px">
        <div class="text-center">
            <img class="mb-3" src="{{ asset('logo.png') }}" alt="Iendandy Modiste" height="60">
            <hr>
            <h1 class="h4 text-gray-900 my-4">Lupa Password</h1>
        </div>
        <form class="user" action="{{ route('password.update') }}" method="post">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <input type="email" name="email" value="{{ request('email') }}" class="form-control" readonly>
            </div>

            {{-- <div class="form-group">
                <input type="email" name="email" value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail"
                    placeholder="{{ __('Email Address') }}">
            </div> --}}
            {{-- @error('email')
                <div class="form-group custom-control">
                    <label class="">{{ $message }}</label>
                </div>
            @enderror --}}

            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        id="exampleInputPassword" placeholder="{{ __('New Password') }}">
                </div>
                @error('password')
                    <div class="form-group custom-control">
                        <label class="">{{ $message }}</label>
                    </div>
                @enderror

                <div class="col-sm-6">
                    <input type="password" name="password_confirmation"
                        class="form-control @error('password_confirmation') is-invalid @enderror" id="exampleRepeatPassword"
                        placeholder="{{ __('Repeat New Password') }}">
                </div>
                @error('password_confirmation')
                    <div class="form-group custom-control">
                        <label class="">{{ $message }}</label>
                    </div>
                @enderror
            </div>
            <br>
            <button type="submit" class="btn btn-gold btn-block">
                {{ __('Reset Password') }}
            </button>
        </form>
    </div>
@endsection
