@extends('layouts.front')

@section('content')
    <div class="container py-3">
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card border-1 p-3 bg-light mb-2">
                    <div class="d-flex justify-content-center align-items-start w-100 mb-3 mb-md-0">
                        <img class="img-fluid rounded" src="{{ asset('storage/img/katalog/' . $katalog->gambar) }}"
                            height="500" alt="Katalog" id="gambar-katalog">
                    </div>
                </div>
                <div class="card p-2">
                    <div class="d-flex flex-wrap" style="gap: 5px;">
                        <div class="warna-katalog image-warna-container active"
                            data-image="{{ asset('storage/img/katalog/' . $katalog->gambar) }}">
                            <div class="image-warna"
                                style="background-image: url({{ asset('storage/img/katalog/' . $katalog->gambar) }});">
                            </div>
                        </div>
                        @foreach ($katalog->warna as $item)
                            <div class="warna-katalog image-warna-container"
                                data-image="{{ asset('storage/img/katalog/' . $item->gambar) }}">
                                <div class="image-warna"
                                    style="background-image: url({{ asset('storage/img/katalog/' . $item->gambar) }});">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <style>
                .image-warna-container {
                    width: 50px;
                    height: 50px;
                    border-radius: 5px;
                    cursor: pointer;
                }

                .image-warna-container:hover>.image-warna {
                    opacity: 0.5;
                }

                .image-warna {
                    width: 100%;
                    height: 100%;
                    background-size: cover;
                    border-radius: 5px;
                }

                .warna-katalog.active {
                    border: 1px solid #D5B141;
                    padding: 2px;
                }
            </style>

            <script defer>
                const opsiWarna = document.querySelectorAll('.warna-katalog');
                let selected = null

                function setActive(e) {
                    opsiWarna.forEach(warna => warna.classList.remove('active'));
                    e.classList.add('active')
                    setImage()
                }

                function setImage() {
                    opsiWarna.forEach(warna => {
                        if (warna.classList.contains('active')) selected = warna;
                        warna.onclick = () => setActive(warna)
                    });
                    document.getElementById('gambar-katalog').src = selected.dataset.image
                }

                setImage()
            </script>

            <div class="col-md-8">
                <div class="card p-3 bg-light h-100">
                    <div class="d-flex flex-column justify-content-between h-100">
                        <div class="flex-grow">
                            <h4>Detail Katalog</h4>
                            <hr>
                            <ul class="list-group list-group-flush mb-5">
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                    <span>Kode Katalog</span>
                                    <h5 class="m-0"><b>{{ $katalog->kode_katalog }}</b></h5>
                                </li>
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                    <span>Stok</span>
                                    @if ($katalog->stok() == 0)
                                        <span class="badge bg-danger">Stok Habis!</span>
                                    @else
                                        <h5 class="m-0">
                                            {{ $katalog->stok() }}
                                        </h5>
                                    @endif
                                </li>
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                    <span>Harga</span>
                                    <h5 class="m-0">Rp {{ number_format($katalog->harga_tanpa_kain) }}</h5>
                                </li>
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                    <span>Harga Dengan Kain</span>
                                    <h5 class="m-0">Rp {{ number_format($katalog->harga_dengan_kain) }}</h5>
                                </li>
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                    <span>Tanggal ditambahkan</span>
                                    <span class="m-0">{{ $katalog->created_at->format('d F Y') }}</span>
                                </li>
                                {{-- <li
                                    class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                    <span>Warna</span>
                                    <div class="d-flex" style="gap: 5px">
                                        @foreach (json_decode($katalog->warna) as $item)
                                            <div style="height: 20px; width: 20px; background: {{ $item }}"></div>
                                        @endforeach
                                    </div>
                                </li> --}}
                                <li class="list-group-item d-flex flex-column bg-transparent">
                                    <span class="mb-2">Deskripsi</span>
                                    <small class="m-0 text-right text-muted">{{ $katalog->deskripsi ?? '-' }}</small>
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('beranda') }}" class="btn btn-secondary me-2">Kembali</a>
                            <a @if ($katalog->stok() != 0) href="{{ route('buat.pesanan', $katalog) }}"
                                @else href="javascript:alert('Maaf, Stok Habis!')" @endif
                                class="btn btn-gold">Buat Pesanan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
