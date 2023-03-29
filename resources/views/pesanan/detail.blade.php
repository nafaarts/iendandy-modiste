@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark">Detail Pesanan</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card border-0 p-3 mb-3">
                            <div class="d-flex justify-content-center align-items-start w-100 mb-3 mb-md-0">
                                @if ($pesanan->foto_katalog)
                                    <img class="img-fluid rounded"
                                        src="{{ asset('storage/img/kostum_katalog/' . $pesanan->foto_katalog) }}"
                                        height="500" alt="Katalog">
                                @else
                                    <img class="img-fluid rounded"
                                        src="{{ asset('storage/img/katalog/' . $pesanan->katalog?->gambar) }}"
                                        height="500" alt="Katalog">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card border-0 p-3 mb-3">
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                                <a href="{{ route('pesanan.index') }}"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                        data-target="#ubahStatus">Ubah Status</button>
                                    @if ($pesanan->status_pesanan !== 'DIBATALKAN')
                                        <button type="button" @class([
                                            'btn',
                                            'btn-success' => !$pesanan->konfirmasi_pembayaran,
                                            'btn-danger' => $pesanan->konfirmasi_pembayaran,
                                        ])
                                            onclick="document.querySelector('#konfirmasi-pembayaran-form').submit()">Konfirmasi
                                            Pembayaran</button>
                                    @endif
                                    @if ($pesanan->tipe_pesanan == 'KOSTUM')
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#tetapkanHarga">Tetapkan Harga</button>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <table>
                                <tr>
                                    <th>No Pesanan</th>
                                    <td>{{ $pesanan->no_pesanan }}</td>
                                </tr>
                                <tr>
                                    <th>Status Pesanan</th>
                                    <td>{{ $pesanan->status_pesanan }}</td>
                                </tr>
                                <tr>
                                    <th>Tipe Pesanan</th>
                                    <td>{{ $pesanan->tipe_pesanan }}</td>
                                </tr>
                                @if ($pesanan->katalog_id)
                                    <tr>
                                        <th>Referensi Katalog</th>
                                        <td>
                                            <a href="{{ route('detail.katalog', $pesanan->katalog) }}">
                                                <i>{{ $pesanan->katalog->kode_katalog }}</i>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <th>Termasuk Kain</th>
                                    <td>{{ $pesanan->termasuk_kain ? 'Ya' : 'Tidak' }}</td>
                                </tr>
                                <tr>
                                    <th>Harga Pesanan</th>
                                    <td>Rp {{ number_format($pesanan->biaya) }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal dipesan</th>
                                    <td>{{ $pesanan->created_at->format('d M Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal diterima</th>
                                    <td>{{ $pesanan->tanggal_diterima ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ $pesanan->alamat }}</td>
                                </tr>
                                <tr>
                                    <th>Catatan</th>
                                    <td>{{ $pesanan->catatan }}</td>
                                </tr>
                            </table>
                        </div>

                        @if ($pesanan->status_pesanan != 'DIBATALKAN')
                            <div class="card border-0 p-3 mb-3">
                                <h6>Pembayaran</h6>
                                <hr>
                                <table>
                                    <tr>
                                        <th>Status pembayaran</th>
                                        <td>{{ $pesanan->konfirmasi_pembayaran ? 'Sudah dibayar' : 'Belum diterima' }}</td>
                                    </tr>
                                    @if ($pesanan->bukti_transfer)
                                        <tr>
                                            <th>Bukti Transfer</th>
                                            <td><a href="{{ asset('storage/img/bukti_transfer/' . $pesanan->bukti_transfer) }}"
                                                    target="_blank"><i class="fas fa-fw fa-eye"></i> Lihat bukti
                                                    transfer</a></td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        @endif

                        <div class="card border-0 p-3 mb-3">
                            <h6>Ukuran</h6>
                            <hr>
                            <table>
                                <tr>
                                    <th>Tipe Ukuran</th>
                                    <td>{{ $pesanan->ukuran['type'] }}</td>
                                </tr>
                                @if ($pesanan->ukuran['type'] == 'universal')
                                    <tr>
                                        <th>Ukuran</th>
                                        <td>{{ $pesanan->ukuran['value']['size'] ?? '-' }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <th>Lingkar Pinggang</th>
                                        <td>{{ $pesanan->ukuran['value']['lingkar_pinggang'] ?? '-' }} CM</td>
                                    </tr>
                                    <tr>
                                        <th>Panjang Lengan</th>
                                        <td>{{ $pesanan->ukuran['value']['panjang_lengan'] ?? '-' }} CM</td>
                                    </tr>
                                    <tr>
                                        <th>Panjang Punggung</th>
                                        <td>{{ $pesanan->ukuran['value']['panjang_punggung'] ?? '-' }} CM</td>
                                    </tr>
                                    <tr>
                                        <th>Lebar Punggung</th>
                                        <td>{{ $pesanan->ukuran['value']['lebar_punggung'] ?? '-' }} CM</td>
                                    </tr>
                                    <tr>
                                        <th>Panjang Gaun</th>
                                        <td>{{ $pesanan->ukuran['value']['panjang_gaun'] ?? '-' }} CM</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('pesanan.konfirmasi-pembayaran', $pesanan) }}" method="post" id="konfirmasi-pembayaran-form">
        @csrf
        @method('PUT')
    </form>

    <div class="modal fade" id="ubahStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Status</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pesanan.ubah-status', $pesanan) }}" method="post" id="ubah-status-form">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="status_pesanan" class="form-label">Status Pesanan</label>
                            <select class="form-control" id="status_pesanan" name="status_pesanan">
                                @foreach (['PESANAN_DIBUAT', 'DIKONFIRMASI', 'MENUNGGU_PEMBAYARAN', 'DIPROSES', 'DIKIRIM', 'SELESAI', 'DIBATALKAN'] as $item)
                                    <option value="{{ $item }}" @selected($item == $pesanan->status_pesanan)>{{ $item }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-gold"
                        onclick="document.querySelector('#ubah-status-form').submit()">
                        Ubah
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tetapkanHarga" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tetapkan Harga</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pesanan.tetapkan-harga', $pesanan) }}" method="post" id="tetapkan-harga-form">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="biaya" class="form-label">Biaya</label>
                            <input type="number" name="biaya" id="biaya" class="form-control"
                                placeholder="Masukan harga jahit">
                            @error('biaya')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-gold"
                        onclick="document.querySelector('#tetapkan-harga-form').submit()">
                        Ubah
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
