@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark">Tambah Pengguna</h6>
            </div>
            <form action="{{ route('warna.store') }}" method="POST">
                @csrf

                <div class="card-body ">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Warna</label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                            id="nama" placeholder="masukan nama warna" value="{{ old('nama') }}">
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="warna" class="form-label">Warna</label>
                        <br>
                        <input type="color" name="warna" class="@error('warna') is-invalid @enderror" id="warna"
                            placeholder="Masukan Warna" value="{{ old('warna') }}" required>
                        @error('warna')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <label for="catatan" class="form-label">Catatan Warna</label>
                        <textarea name="catatan" class="form-control @error('catatan') is-invalid @enderror" id="catatan"
                            placeholder="masukan catatan">{{ old('catatan') }}</textarea>
                        @error('catatan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

                <div class="card-footer">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-gold">{{ __('Submit') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
