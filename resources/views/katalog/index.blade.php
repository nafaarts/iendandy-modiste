@extends('layouts.app')

@section('content')
    <style>
        .katalog-card {
            cursor: pointer;
            transition: .3s;
        }

        .katalog-card:hover {
            transform: scale(1.02);
            box-shadow: 2px 2px 10px gray;
        }
    </style>

    <div class="container-fluid">
        <div class="card-header border py-3 mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-dark">Data Katalog</h6>
                <a href="{{ route('katalog.create') }}" class="btn btn-sm btn-gold"><i class="fas fa-fw fa-plus"></i>
                    Tambah Katalog</a>
            </div>
        </div>

        <form class="mb-3">
            <input type="text" name="cari" class="form-control form-control-lg"
                placeholder="Cari katalog berdasarkan kode.." value="{{ request('cari') }}">
        </form>

        <div class="row mb-3">
            @forelse ($katalog as $item)
                <div class="col-md-3 col-lg-2 p-2">
                    <a href="{{ route('katalog.show', $item) }}" class="position-relative">
                        @if ($item->stok == 0)
                            <div class="position-absolute bg-danger px-2 m-2 text-white" style="z-index: 9999">
                                Stok Habis
                            </div>
                        @endif
                        <div class="katalog-card card position-relative overflow-hidden d-flex justify-content-center align-items-center"
                            style="height: 300px">
                            <img src="{{ asset('storage/img/katalog/' . $item->gambar) }}" class="img-fluid" alt="...">
                            <div class="bg-white p-2 text-dark position-absolute rounded">
                                <h5 class="card-title m-0">{{ $item->kode_katalog }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="card py-3 text-center">
                        <span>Tidak ada data</span>
                    </div>
                </div>
            @endforelse
        </div>

        {{ $katalog->links() }}
    </div>
@endsection
