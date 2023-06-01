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
                            <div class="d-flex justify-content-center align-items-start w-100 mb-3">
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

                            {{-- Tombol Konfirmasi --}}
                            <div class="d-flex flex-column">
                                @if ($pesanan->status_pesanan == 'MENUNGGU_KONFIRMASI_ADMIN' || $pesanan->status_pesanan == 'MENUNGGU_KONFIRMASI_USER')
                                    {{-- // set status ke MENUNGGU_PEMBAYARAN --}}
                                    <form action="{{ route('pesanan.ubah-status', $pesanan) }}" method="POST"
                                        onsubmit="return confirm('apakah anda yakin mengkonfirmasi pesanan ini?')"
                                        class="mb-2">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status_pesanan" value="MENUNGGU_PEMBAYARAN">
                                        <button type="submit" class="btn btn-primary w-100">Konfirmasi Pesanan</button>
                                    </form>

                                    {{-- // set status ke MENUNGGU_KONFIRMASI_USER --}}
                                    <button class="btn btn-secondary mb-2" data-toggle="modal"
                                        data-target="#tetapkanHarga">Ubah Biaya Jahit</button>
                                @endif

                                @if ($pesanan->status_pesanan == 'MENUNGGU_PEMBAYARAN' && $pesanan->bukti_transfer)
                                    {{-- // set status ke DIPROSES --}}
                                    <form action="{{ route('pesanan.konfirmasi-pembayaran', $pesanan) }}" method="POST"
                                        onsubmit="return confirm('apakah anda yakin mengkonfirmasi Pembayaran untuk pesanan ini?')">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success mb-2 w-100">Konfirmasi
                                            Pembayaran</button>
                                    </form>
                                @endif

                                @if ($pesanan->status_pesanan == 'DIPROSES')
                                    {{-- // set status ke DIKIRIM --}}
                                    <form action="{{ route('pesanan.ubah-status', $pesanan) }}" method="POST"
                                        onsubmit="return confirm('apakah anda yakin mengkonfirmasi Pengiriman untuk pesanan ini?')"
                                        class="mb-2">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status_pesanan" value="DIKIRIM">
                                        <button type="submit" class="btn btn-primary mb-2 w-100">Konfirmasi
                                            Pengiriman</button>
                                    </form>

                                    {{-- // set status ke SELESAI --}}
                                    <form action="{{ route('pesanan.ubah-status', $pesanan) }}" method="POST"
                                        onsubmit="return confirm('apakah anda yakin mengkonfirmasi selesai untuk pesanan ini?')"
                                        class="mb-2">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status_pesanan" value="SELESAI">
                                        <button type="submit" class="btn btn-success mb-2 w-100">Konfirmasi
                                            Selesai</button>
                                    </form>
                                @endif

                                @if ($pesanan->status_pesanan == 'DIKIRIM')
                                    {{-- // set status ke SELESAI --}}
                                    <form action="{{ route('pesanan.ubah-status', $pesanan) }}" method="POST"
                                        onsubmit="return confirm('apakah anda yakin mengkonfirmasi selesai untuk pesanan ini?')"
                                        class="mb-2">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status_pesanan" value="SELESAI">
                                        <button type="submit" class="btn btn-success mb-2 w-100">Konfirmasi
                                            Selesai</button>
                                    </form>
                                @endif

                                @if ($pesanan->status_pesanan != 'SELESAI')
                                    {{-- // set status ke DIBATALKAN --}}
                                    <form action="{{ route('pesanan.ubah-status', $pesanan) }}" method="POST"
                                        onsubmit="return confirm('apakah anda yakin membatalkan pesanan ini?')"
                                        class="mb-2">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status_pesanan" value="SELESAI">
                                        <button type="submit" class="btn btn-danger w-100">Batalkan Pesanan</button>
                                    </form>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card border-0 p-3 mb-3">
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                                <a href="{{ route('pesanan.index') }}"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
                                {{-- <div class="btn-group" role="group" aria-label="Basic example">
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
                                </div> --}}
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
                            <h6>Detail Baju</h6>
                            <hr>
                            <table>
                                <tr>
                                    <th>Tipe Ukuran</th>
                                    <td>{{ $pesanan->ukuran['type'] == 'ukuran-universal' ? 'UNIVERSAL' : 'KOSTUM' }}</td>
                                </tr>
                                @if ($pesanan->ukuran['type'] == 'ukuran-universal')
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

                                <tr>
                                    <th>Termasuk Kain</th>
                                    <td>{{ $pesanan->termasuk_kain ? 'Ya' : 'Tidak' }}</td>
                                </tr>

                                @isset($pesanan->ukuran['color'])
                                    <tr>
                                        <th>Warna</th>
                                        <td>
                                            <div
                                                style="height: 20px; width: 40px; background: {{ $pesanan->ukuran['color'] }}">
                                            </div>
                                        </td>
                                    </tr>
                                @endisset

                            </table>
                        </div>
                    </div>
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
                    <form action="{{ route('pesanan.tetapkan-harga', $pesanan) }}" method="post"
                        id="tetapkan-harga-form">
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
