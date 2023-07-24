@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-dark">Tambah Katalog</h6>
                </div>
            </div>
            <form action="{{ route('katalog.store') }}" method="post" enctype="multipart/form-data">
                @csrf
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
                                        <img id="frame" class="img-fluid" src="{{ asset('add-image.jpg') }}"
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
                                <input type="text" name="kode_katalog" class="form-control" value="{{ $kode }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="harga_tanpa_kain" class="form-label">Harga</label>
                                        <input type="text" name="harga_tanpa_kain"
                                            class="form-control @error('harga_tanpa_kain') is-invalid @enderror"
                                            id="harga_tanpa_kain" placeholder="Masukan harga jahit"
                                            value="{{ old('harga_tanpa_kain') }}">
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
                                            value="{{ old('harga_dengan_kain') }}">
                                        @error('harga_dengan_kain')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="mb-3">
                                <label class="form-label">Stok</label>
                                <input type="number" min="0" name="stok"
                                    class="form-control @error('stok') is-invalid @enderror"
                                    placeholder="Masukan jumlah stok" value="{{ old('stok') }}">
                                @error('stok')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div> --}}

                            {{-- <style>
                                #color-wrapper {
                                    display: flex;
                                    gap: 5px;
                                    padding: 5px;
                                    border: 1px solid lightgray;
                                    border-radius: 5px;
                                }

                                #color-node-wrapper {
                                    display: flex;
                                    gap: 5px;
                                }

                                .color-node {
                                    display: grid;
                                    width: 50px;
                                    height: 50px;
                                    border-radius: 5px;
                                    justify-content: center;
                                    align-items: center;
                                }

                                .color-node-add {
                                    display: grid;
                                    width: 50px;
                                    height: 50px;
                                    border-radius: 5px;
                                    justify-content: center;
                                    align-items: center;
                                    border: 1px dotted lightgray;
                                    cursor: pointer;
                                    transition: .3s ease-in-out;
                                }

                                .color-node-add:hover {
                                    background: lightgray;
                                }

                                .color-node-remove-button {
                                    padding: 0;
                                    border: 0;
                                    margin: 0;
                                    border-radius: 50%;
                                    width: 25px;
                                    height: 25px;
                                    background: rgba(255, 255, 255, 0.5);
                                    transition: .3s ease-in-out;
                                }

                                .color-node-remove-button:hover {
                                    width: 50px;
                                    height: 50px;
                                    border-radius: 0;
                                }
                            </style> --}}

                            {{-- <div class="d-flex flex-column">
                                <label class="form-label">Warna</label>
                                <div id="color-wrapper">
                                    <div id="color-node-wrapper">
                                    </div>
                                    <label for="color-picker" class="color-node-add m-0">
                                        <i class="fas fa-fw fa-plus"></i>
                                    </label>
                                </div>
                                @error('warna')
                                    <small class="text-danger mt-1">{{ $message }}</small>
                                @enderror
                                <input type="color" id="color-picker" style="opacity: 0">
                                <input type="hidden" name="warna" id="warna">
                            </div> --}}

                            {{-- <script defer>
                                let colors = @json(json_decode(old('warna') ?? '[]')) || [];

                                function updateColor() {
                                    const warna = document.getElementById("warna");
                                    warna.value = JSON.stringify(colors);

                                    const colorNodeWrapper = document.getElementById("color-node-wrapper");
                                    while (colorNodeWrapper.firstChild) {
                                        colorNodeWrapper.removeChild(colorNodeWrapper.lastChild);
                                    };

                                    colors.forEach(color => {
                                        const div = document.createElement('div')
                                        div.classList.add('color-node');
                                        div.style.background = color;

                                        const button = document.createElement('button');
                                        button.type = 'button';
                                        button.classList.add('color-node-remove-button');
                                        button.innerHTML = "<i class='fas fa-fw fa-trash'></i>"
                                        button.dataset.color = color

                                        button.onclick = () => {
                                            colors = colors.filter(item => item !== color)
                                            updateColor()
                                        }

                                        div.append(button);

                                        colorNodeWrapper.append(div)
                                    });
                                }

                                updateColor()

                                const inputColor = document.getElementById('color-picker')
                                inputColor.onchange = (e) => {
                                    colors.push(e.target.value);
                                    updateColor()
                                }
                            </script> --}}

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" rows="5"
                                    placeholder="Masukan deskripsi">{{ old('deskripsi') }}</textarea>
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
