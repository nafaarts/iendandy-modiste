@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-dark">Detail Katalog</h6>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <img class="img-fluid" src="{{ asset('storage/img/katalog/' . $katalog->gambar) }}" alt="Katalog">
                    </div>
                    <div class="col-md-9">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Kode Katalog</span>
                                <h5 class="m-0"><b>{{ $katalog->kode_katalog }}</b></h5>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Jumlah Stok</span>
                                <h5 class="m-0">{{ $katalog->stok() }}</h5>
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
                                <span>Jumlah dipesanan</span>
                                <span class="m-0">{{ $katalog->order()->count() }} pesanan</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Tanggal ditambahkan</span>
                                <span class="m-0">{{ $katalog->created_at->format('d F Y') }}</span>
                            </li>
                            {{-- <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Warna</span>
                                <div class="d-flex" style="gap: 5px">
                                    @foreach (json_decode($katalog->warna) as $item)
                                        <div style="height: 20px; width: 20px; background: {{ $item }}"></div>
                                    @endforeach
                                </div>
                            </li> --}}
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Deskripsi</span>
                                <small style="max-width: 500px"
                                    class="m-0 text-right">{{ $katalog->deskripsi ?? '-' }}</small>
                            </li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6>Opsi Warna</h6>
                    <a class="btn btn-sm btn-gold" href="{{ route('katalog.warna.create', $katalog) }}">
                        <i class="fas fa-fw fa-plus"></i> Tambah Opsi Warna
                    </a>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Gambar</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($katalog->warna as $item)
                            <tr>
                                <th scope="row">
                                    <div class="bg-danger"
                                        style="height: 40px; width: 40px;
                                            background-image: url({{ asset('storage/img/katalog/' . $item->gambar) }});
                                            background-size: cover;
                                            background-position: center center">
                                    </div>
                                </th>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->stok }}</td>
                                <td>
                                    <div class="d-flex" style="gap: 5px;">
                                        <a href="{{ route('katalog.warna.edit', [$katalog, $item]) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fas fa-fw fa-edit"></i>
                                        </a>
                                        <form action="{{ route('katalog.warna.destroy', [$katalog, $item]) }}"
                                            method="POST" onsubmit="return confirm('yakin dihapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-fw fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <a href="{{ route('katalog.index') }}" class="btn btn-secondary">Kembali</a>
                <a href="{{ route('katalog.edit', $katalog) }}" class="btn btn-gold">Ubah</a>
                <form action="{{ route('katalog.destroy', $katalog) }}" method="post" class="d-inline"
                    onsubmit="return confirm('Yakin dihapus? pesanan yang berkaitan juga akan dihapus.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
@endsection
