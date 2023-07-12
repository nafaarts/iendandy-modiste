@extends('layouts.front')

@section('content')
    <div class="container py-3">
        @if (session('error'))
            <div class="alert alert-warning" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-4">
                <div class="card border-0 p-3 bg-light">
                    <label for="foto_katalog">
                        <div class="d-flex justify-content-center align-items-start w-100 mb-3 mb-md-0">
                            <img class="img-fluid rounded" src="{{ asset('upload-gambar-katalog.png') }}" height="500"
                                alt="Katalog" id="preview">
                        </div>
                    </label>
                    @error('foto_katalog')
                        <small class="text-danger mt-2">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-8">
                <div class="card border-0 p-3 bg-light">
                    <div class="d-flex flex-column justify-content-between h-100">
                        <div class="flex-grow mb-3">
                            <h4>Buat Pesanan Kostum</h4>
                            <hr>
                            @csrf
                            <div class="mb-3">
                                <label for="ukuran" class="form-label">Ukuran</label>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                            <input type="radio" class="btn-check" name="ukuran" id="ukuran1"
                                                autocomplete="off" value="ukuran-universal" checked
                                                onclick="getUkuranType()">
                                            <label class="btn btn-outline-secondary" for="ukuran1">Universal</label>
                                            <input type="radio" class="btn-check" name="ukuran" id="ukuran2"
                                                autocomplete="off" value="ukuran-kostum" onclick="getUkuranType()">
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
                                                    value="{{ $item['kode'] }}">
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
                                                onkeyup="getUkuranKostum(this, '{{ str()->slug($item, '_') }}')">
                                        </div>
                                    @endforeach
                                    <small>* Masukan ukuran dalam CM</small>
                                </div>
                            </div>

                            <form action="{{ route('simpan.pesanan-kostum') }}" method="POST" id="pesan-form"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="foto_katalog" id="foto_katalog" class="d-none"
                                    onchange="previewImage()">
                                <input type="hidden" name="ukuran" id="ukuran" class="form-control">

                                <div class="mb-3">
                                    <label for="termasuk_kain" class="form-label">Dengan Kain</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="dengan_kain"
                                                id="dengan_kain1" value="1" checked onclick="getType()">
                                            <label class="form-check-label" for="dengan_kain1">
                                                Ya, Dengan kain
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="dengan_kain"
                                                id="dengan_kain2" value="0" onclick="getType()">
                                            <label class="form-check-label" for="dengan_kain2">
                                                Tidak, Kain sendiri
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="mb-3" id="wrapper-form-warna">
                                    <label for="warna" class="form-label">Warna</label>
                                    <input type="color" class="form-control" id="warna" name="warna"
                                        placeholder="Masukan warna anda" style="width: 70px; height: 40px"
                                        onchange="setWarna()" value="{{ old('warna', $katalog->warna ?? '#000000') }}">
                                </div> --}}

                                <div class="mb-3" id="wrapper-form-warna">
                                    <label class="form-label">Warna</label>

                                    <div class="d-flex gap-4">
                                        @foreach ($warna as $item)
                                            <label for="warna-{{ $loop->iteration }}" class="d-flex gap-2">
                                                <input type="radio" name="warna" id="warna-{{ $loop->iteration }}"
                                                    value="{{ $item->warna }}" @checked($loop->iteration == 1)
                                                    onclick="setWarna()">
                                                <div style="height: 30px; width: 30px; background: {{ $item->warna }}"
                                                    class="border">
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>

                                    {{-- <input type="color" class="form-control" id="warna" name="warna"
                                        placeholder="Masukan warna anda" style="width: 70px; height: 40px"
                                        onchange="setWarna()" value="{{ old('warna', $katalog->warna ?? '#000000') }}"> --}}
                                </div>

                                {{-- <pre id="previews"></pre> --}}

                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat"
                                        placeholder="Masukan alamat anda">
                                    @error('alamat')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="catatan" class="form-label">Catatan</label>
                                    <textarea class="form-control" name="catatan" id="catatan" rows="3" placeholder="Tinggalkan catatan"></textarea>
                                    @error('catatan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <hr>
                                <small>*Harga pesanan kostum akan dikalkulasikan oleh penjahit dan akan di update pada
                                    data
                                    pesanan anda.</small>
                            </form>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('beranda') }}" class="btn btn-secondary me-2">Kembali</a>
                            <button type="submit" class="btn btn-gold"
                                onclick="document.querySelector('#pesan-form').submit()">Buat Pesanan</button>
                        </div>
                    </div>
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
                    <img src="{{ asset('guide.png') }}" alt="Panduan Pengukuran" class="img-fluid">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-target="#ubahUkuran"
                        data-bs-toggle="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const radios = document.getElementsByName('dengan_kain');
        const ukuranRadios = document.getElementsByName('ukuran');

        const universal = document.querySelector('#ukuran-universal');
        const kostum = document.querySelector('#ukuran-kostum');
        const universalSize = document.getElementsByName('opsi-ukuran-universal')
        const inputUkuran = document.querySelector('#ukuran');

        const wrapperFormWarna = document.querySelector("#wrapper-form-warna");
        const warnaRadios = document.getElementsByName('warna');

        let withColor = true,
            color, selectedType, selectedUniversalSize, selectedKostumSize;

        function previewImage() {
            preview.src = URL.createObjectURL(event.target.files[0]);
        }

        function getType() {
            for (let i = 0, length = radios.length; i < length; i++) {
                if (radios[i].checked) {
                    if (radios[i].value === '1') {
                        wrapperFormWarna.classList.remove('d-none');
                        withColor = true;
                    } else {
                        wrapperFormWarna.classList.add('d-none');
                        withColor = false;
                    }
                    updateUkuran()
                    break;
                }
            }
        }

        function updateUkuran() {
            let type = selectedType === 'ukuran-universal' ? 'ukuran-universal' : 'ukuran-kostum';
            let result = {
                type: type,
                color: withColor ? color : null,
                value: type === 'ukuran-universal' ? {
                    size: selectedUniversalSize
                } : selectedKostumSize
            }
            // previews.textContent = JSON.stringify(result, null, 2)
            inputUkuran.value = JSON.stringify(result)
        }

        function setWarna() {
            // color = inputWarna.value;
            for (let i = 0, length = warnaRadios.length; i < length; i++) {
                if (warnaRadios[i].checked) {
                    color = warnaRadios[i].value;
                    console.log(color)
                    // updateUkuran()
                    break;
                }
            }

            updateUkuran();
        }

        function getUkuranType() {
            for (let i = 0, length = ukuranRadios.length; i < length; i++) {
                if (ukuranRadios[i].checked) {
                    kostum.classList.toggle('d-none', ukuranRadios[i].value === 'ukuran-universal')
                    universal.classList.toggle('d-none', ukuranRadios[i].value !== 'ukuran-universal')

                    selectedType = ukuranRadios[i].value;
                    updateUkuran()

                    break;
                }
            }
        }

        function getUkuranKostum(e, name) {
            selectedKostumSize = {
                ...selectedKostumSize,
                [name]: e.value
            }
            updateUkuran()
        }

        universalSize.forEach(element => {
            element.onchange = (e) => {
                selectedUniversalSize = e.target.value
                updateUkuran()
            }
        });

        // init
        getType()
        getUkuranType()
        setWarna()
    </script>
@endsection
