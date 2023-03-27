@extends('layouts.front')

@section('content')
    <div class="container py-3">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="card border-0 bg-light p-3 mb-3">
            <small><strong>Profil Saya</strong></small>
            <hr>
            <form action="{{ route('edit.profil') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label text-muted">Nama</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Masukan nama anda"
                        value="{{ old('name', auth()->user()->name) }}">
                    @error('name')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="row mb-4">
                    <div class="col-6">
                        <label for="email" class="form-label text-muted">Email</label>
                        <input type="text" id="email" name="email" class="form-control"
                            placeholder="Masukan email anda" value="{{ old('email', auth()->user()->email) }}">
                        @error('email')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="phone_number" class="form-label text-muted">Nomor Telepon</label>
                        <input type="text" id="phone_number" name="phone_number" class="form-control"
                            placeholder="Masukan Nomor Telepon anda"
                            value="{{ old('phone_number', auth()->user()->phone_number) }}">
                        @error('phone_number')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-sm btn-gold"><i class="fas fa-fw fa-pen"></i> Ubah
                        profil</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">
                        <i class="fas fa-fw fa-lock"></i> Ubah password
                    </button>
                </div>
            </form>
        </div>

        <div class="card border-0 bg-light p-3">
            <small><strong>Pesanan saya</strong></small>
            <hr>
            <div class="table-responsive">
                <table class="table">
                    {{-- <caption>Riwayat Pesanan</caption> --}}
                    <thead>
                        <tr>
                            <th scope="col">Nomor Pesanan</th>
                            <th scope="col">Jenis Pesanan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Tanggal Pesanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pesanan as $item)
                            <tr>
                                <th scope="row">
                                    <a href="{{ route('detail.pesanan', $item) }}">{{ $item->no_pesanan }}</a>
                                </th>
                                <td>{{ $item->tipe_pesanan }}</td>
                                <td><strong>{{ $item->status_pesanan }}</strong></td>
                                <td>Rp {{ number_format($item->biaya) }}</td>
                                <td>{{ $item->created_at }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-3">Belum ada pesanan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ route('edit.password') }}" method="post" class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah password</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="password" class="form-label text-muted">Password baru</label>
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="Masukan password anda" autocomplete="false">
                        @error('password')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label text-muted">Ulangi password</label>
                        <input type="password" id="password" name="password_confirmation" class="form-control"
                            placeholder="Ulangi password anda">
                        @error('password_confirmation')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-gold">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
