@extends('layouts.front')

@section('content')
    <div class="container py-3">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-4">
                <div class="card border-0 p-3 bg-light mb-3">
                    <div class="d-flex justify-content-center align-items-start w-100 mb-3 mb-md-0">
                        @if ($pesanan->foto_katalog)
                            <img class="img-fluid rounded"
                                src="{{ asset('storage/img/kostum_katalog/' . $pesanan->foto_katalog) }}" height="500"
                                alt="Katalog">
                        @else
                            <img class="img-fluid rounded"
                                src="{{ asset('storage/img/katalog/' . $pesanan->katalog?->gambar) }}" height="500"
                                alt="Katalog">
                        @endif
                    </div>
                </div>
                @if ($pesanan->status_pesanan != 'DIBATALKAN')
                    <div class="card border-0 p-3 bg-light mb-3">
                        @if (!$pesanan->konfirmasi_pembayaran)
                            <button data-bs-toggle="modal" data-bs-target="#pembayaranModal"
                                class="btn btn-sm btn-gold mb-2">
                                <i class="fas fa-fw fa-wallet"></i> Bayar Sekarang
                            </button>
                        @endif
                        @if (in_array($pesanan->status_pesanan, ['PESANAN_DIBUAT', 'DIKONFIRMASI', 'MENUNGGU_PEMBAYARAN']))
                            <button type="button" class="btn btn-sm btn-secondary mb-2" data-bs-target="#ubahUkuran"
                                data-bs-toggle="modal">
                                <i class="fas fa-fw fa-tshirt"></i> Ubah Ukuran
                            </button>
                        @endif
                        @if ($pesanan->status_pesanan == 'PESANAN_DIBUAT')
                            <form action="{{ route('batalkan.pesanan', $pesanan) }}" method="POST"
                                id="batalkan-pesanan-form"
                                onsubmit="return confirm('apakah anda yakin membatalkan pesanan ini?')" class="w-100">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-sm btn-danger w-100">
                                    <i class="fas fa-fw fa-times"></i> Batalkan pesanan
                                </button>
                            </form>
                        @endif
                    </div>
                @endif

            </div>
            <div class="col-md-8">
                <div class="card border-0 p-3 bg-light mb-3">
                    <h4>Detail Pesanan</h4>
                    <a href="{{ route('profil') }}"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
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
                                <td><a
                                        href="{{ route('detail.katalog', $pesanan->katalog) }}"><i>{{ $pesanan->katalog->kode_katalog }}</i></a>
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
                    <div class="card border-0 p-3 bg-light mb-3">
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

                <div class="card border-0 p-3 bg-light mb-3">
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

    {{-- modal pembayaran --}}
    <div class="modal fade" id="pembayaranModal" tabindex="-1" aria-labelledby="pembayaranModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="pembayaranModalLabel">Pembayaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card p-2 mb-2">
                        <hp><strong>Bank Syariah Indonesia</strong></hp>
                        <p class="m-0">123-412-51232 (Sri Murni)</p>
                    </div>
                    <form action="{{ route('pembayaran.pesanan', $pesanan) }}" method="post" id="form-bukti-pembayaran"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="bukti_transfer" class="form-label">Upload Bukti Transfer</label>
                            <input type="file" name="bukti_transfer" id="bukti_transfer" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-gold"
                        onclick="document.querySelector('#form-bukti-pembayaran').submit()">Kirim</button>
                </div>
            </div>
        </div>
    </div>

    {{-- // modal ubah ukuran --}}
    <div class="modal fade" id="ubahUkuran" tabindex="-1" role="dialog" aria-labelledby="ubahUkuranLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahUkuranLabel">Ubah Ukuran</h5>
                </div>
                <div class="modal-body">
                    <div>
                        <label for="ukuran" class="form-label">Ukuran</label>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" name="ukuran" id="ukuran1" autocomplete="off"
                                        value="ukuran-universal" @checked($pesanan->ukuran['type'] == 'universal') onclick="getUkuranType()">
                                    <label class="btn btn-outline-secondary" for="ukuran1">Universal</label>
                                    <input type="radio" class="btn-check" name="ukuran" id="ukuran2"
                                        autocomplete="off" value="ukuran-kostum" @checked($pesanan->ukuran['type'] == 'kostum')
                                        onclick="getUkuranType()">
                                    <label class="btn btn-outline-secondary" for="ukuran2">Kostum</label>
                                </div>
                            </div>
                            <a href="#" data-bs-target="#sizeGuide" data-bs-toggle="modal">
                                <i class="fas fa-fw fa-info-circle"></i> Panduan Pengukuran
                            </a>
                        </div>
                        <hr>

                        <div id="ukuran-universal">
                            <div>
                                @php
                                    $opsiUniversal = [
                                        [
                                            'kode' => 'S',
                                            'LB' => 94,
                                            'PB' => 138,
                                        ],
                                        [
                                            'kode' => 'M',
                                            'LB' => 98,
                                            'PB' => 138,
                                        ],
                                        [
                                            'kode' => 'L',
                                            'LB' => 102,
                                            'PB' => 140,
                                        ],
                                        [
                                            'kode' => 'XL',
                                            'LB' => 106,
                                            'PB' => 142,
                                        ],
                                        [
                                            'kode' => 'XXL',
                                            'LB' => 110,
                                            'PB' => 148,
                                        ],
                                    ];
                                @endphp
                                @foreach ($opsiUniversal as $item)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="opsi-ukuran-universal"
                                            id="{{ 'opsi-ukuran-universal' . $item['kode'] }}"
                                            value="{{ $item['kode'] }}" @checked($item['kode'] == ($pesanan->ukuran['value']['size'] ?? null))>
                                        <label class="form-check-label"
                                            for="{{ 'opsi-ukuran-universal' . $item['kode'] }}">
                                            <strong>{{ $item['kode'] }}</strong> -
                                            Lingkar Badan : {{ $item['LB'] }} CM |
                                            Panjang Baju : {{ $item['PB'] }} CM
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div id="ukuran-kostum">
                            @foreach (['Lingkar Pinggang', 'Panjang Lengan', 'Panjang Punggung', 'Lebar Punggung', 'Panjang Gaun'] as $item)
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text">{{ $item }}</span>
                                    <input type="text" class="form-control"
                                        placeholder="Masukan {{ $item }} anda"
                                        id="{{ str()->slug($item, '_') }}"
                                        onkeyup="getUkuranKostum(this, '{{ str()->slug($item, '_') }}')"
                                        value="{{ $pesanan->ukuran['value'][str()->slug($item, '_')] ?? null }}">
                                </div>
                            @endforeach
                            <small>* Masukan ukuran dalam CM</small>
                        </div>
                        <form action="{{ route('ubah-ukuran.pesanan', $pesanan) }}" method="post"
                            id="ubah-ukuran-form">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="ukuran" id="ukuran">
                        </form>
                        <hr>
                        <small class="text-muted">Anda tidak dapat mengubah ukuran jika pesanan sudah dalam proses
                            pengerjaan</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-gold" onclick="document.querySelector('#ubah-ukuran-form').submit()">
                        Ubah
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal panduan ukuran --}}
    <div class="modal fade" id="sizeGuide" aria-hidden="true" aria-labelledby="exampleModalSizeGuide2" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalSizeGuide2">Panduan Ukuran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="https://s2.bukalapak.com/img/7177014091/w-1000/ALEENA_GREY_Dress_Gamis_Syari___Dress_Wanita_Muslimah___Gaun.jpg"
                        alt="Panduan Pengukuran" class="img-fluid">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-target="#ubahUkuran"
                        data-bs-toggle="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const defaultValue = @json($pesanan->ukuran);

        const ukuranRadios = document.getElementsByName('ukuran');
        const universal = document.querySelector('#ukuran-universal');
        const kostum = document.querySelector('#ukuran-kostum');
        const universalSize = document.getElementsByName('opsi-ukuran-universal')
        const inputUkuran = document.querySelector('#ukuran')

        let selectedUniversalSize, selectedKostumSize;

        function setUkuran(type, value) {
            result = {
                type: type === 'ukuran-universal' ? 'universal' : 'kostum',
                value: value
            }

            inputUkuran.value = JSON.stringify(result)
        }

        function getUkuranType() {
            for (let i = 0, length = ukuranRadios.length; i < length; i++) {
                if (ukuranRadios[i].checked) {
                    kostum.classList.toggle('d-none', ukuranRadios[i].value === 'ukuran-universal')
                    universal.classList.toggle('d-none', ukuranRadios[i].value !== 'ukuran-universal')

                    if (ukuranRadios[i].value === 'ukuran-universal') {
                        setUkuran('ukuran-universal', {
                            size: selectedUniversalSize || defaultValue
                        })
                    } else {
                        setUkuran('ukuran-kostum', selectedKostumSize || defaultValue)
                    }
                    break;
                }
            }
        }

        function getUkuranKostum(e, name) {
            selectedKostumSize = {
                ...selectedKostumSize,
                [name]: e.value
            }
            setUkuran('ukuran-kostum', selectedKostumSize)
        }

        universalSize.forEach(element => {
            element.onchange = (e) => {
                selectedUniversalSize = e.target.value
                setUkuran('ukuran-universal', {
                    size: selectedUniversalSize
                })
            }
        });

        // init
        getUkuranType()
    </script>
@endsection
