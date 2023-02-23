@extends('layouts.front')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-4">
                <div class="d-flex justify-content-center align-items-start w-100" style="height: 500px">
                    <img class="img-fluid rounded" src="{{ asset('storage/img/katalog/' . $katalog->gambar) }}" alt="Katalog">
                </div>
            </div>
            <div class="col-md-8">
                <h4>Detail Katalog</h4>
                <hr>
                <ul class="list-group list-group-flush mb-5">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Kode Katalog</span>
                        <h5 class="m-0"><b>{{ $katalog->kode_katalog }}</b></h5>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Harga</span>
                        <h5 class="m-0">Rp {{ number_format($katalog->harga_tanpa_kain) }}</h5>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Harga (Dengan Kain)</span>
                        <h5 class="m-0">Rp {{ number_format($katalog->harga_dengan_kain) }}</h5>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Tanggal ditambahkan</span>
                        <span class="m-0">{{ $katalog->created_at->format('d F Y') }}</span>
                    </li>
                    <li class="list-group-item d-flex flex-column">
                        <span class="mb-2">Deskripsi</span>
                        <small class="m-0 text-right text-muted">{{ $katalog->deskripsi ?? '-' }}</small>
                    </li>
                </ul>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('beranda') }}" class="btn btn-secondary me-2">Kembali</a>
                    <a href="" class="btn btn-gold">Buat Pesanan</a>
                </div>
            </div>
        </div>
    </div>
@endsection
