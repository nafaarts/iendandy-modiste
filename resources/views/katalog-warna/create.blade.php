@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-dark">Tambah Katalog</h6>
                </div>
            </div>
            <form action="{{ route('katalog.warna.store', $katalog) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" name="gambar" id="gambar" class="d-none" onchange="previewImage()">
                        <label for="gambar" class="d-block">
                            <div class="card overflow-hidden d-flex justify-content-center align-items-center  @error('gambar') border border-danger @enderror"
                                style="width: 300px">
                                <img id="frame" class="img-fluid" src="{{ asset('add-image.jpg') }}"
                                    alt="selected image">
                            </div>
                        </label>
                        @error('gambar')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control  @error('nama') is-invalid @enderror"
                            placeholder="Masukan nama" value="{{ old('nama') }}">
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">stok</label>
                        <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror"
                            placeholder="Masukan stok" value="{{ old('stok') }}">
                        @error('stok')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('katalog.show', $katalog) }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-gold">{{ __('Submit') }}</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function previewImage() {
            frame.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
