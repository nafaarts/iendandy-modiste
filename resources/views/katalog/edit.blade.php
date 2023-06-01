@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-dark">Tambah Katalog</h6>
                </div>
            </div>
            <form action="{{ route('katalog.update', $katalog) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar</label>
                                <input type="file" name="gambar" id="gambar" class="d-none"
                                    onchange="previewImage()">
                                <label for="gambar" class="d-block">
                                    <div class="card w-100 overflow-hidden d-flex justify-content-center align-items-center  @error('gambar') border border-danger @enderror"
                                        style="height: 310px">
                                        <img id="frame" class="img-fluid"
                                            src="{{ asset('storage/img/katalog/' . $katalog->gambar) }}"
                                            alt="selected image">
                                    </div>
                                </label>
                                @error('gambar')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="mb-3">
                                <label class="form-label">Kode Katalog</label>
                                <input type="text" name="kode_katalog" class="form-control"
                                    value="{{ $katalog->kode_katalog }}" readonly>
                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="harga_tanpa_kain" class="form-label">Harga</label>
                                        <input type="text" name="harga_tanpa_kain"
                                            class="form-control @error('harga_tanpa_kain') is-invalid @enderror"
                                            id="harga_tanpa_kain" placeholder="Masukan harga jahit"
                                            value="{{ old('harga_tanpa_kain', $katalog->harga_tanpa_kain) }}">
                                        @error('harga_tanpa_kain')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="harga_dengan_kain" class="form-label">Harga dengan kain</label>
                                        <input type="text" name="harga_dengan_kain"
                                            class="form-control @error('harga_dengan_kain') is-invalid @enderror"
                                            id="harga_dengan_kain" placeholder="Masukan harga jahit dengan kain"
                                            value="{{ old('harga_dengan_kain', $katalog->harga_dengan_kain) }}">
                                        @error('harga_dengan_kain')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Warna</label>
                                <br>
                                <input type="color" name="warna" value="{{ old('warna', $katalog->warna) }}">
                                @error('warna')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" rows="5"
                                    placeholder="Masukan deskripsi">{{ old('deskripsi', $katalog->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('katalog.index') }}" class="btn btn-secondary">Kembali</a>
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
