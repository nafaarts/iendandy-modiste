@extends('layouts.front')

@section('content')
    <div class="bg-gold text-white py-3">
        <div class="container py-5">
            <h1>Selamat datang di <b><i>Iendandy Modiste</i></b></h2>
                <h5 class="fw-light">Pilih katalog atau jahit baju dengan desain anda, <a href=""
                        class="text-white">Pesan Kustom <i class="fas fa-fw fa-arrow-right"></i></a></h5>
        </div>
    </div>

    <div class="container py-4">
        <h5 class="text-gold">Katalog Iendandy</h5>
        <hr>
        @if ($katalog)
            <section class="splide" aria-labelledby="carousel-heading">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($katalog as $item)
                            <li class="splide__slide p-1">
                                <div class="card katalog-card" style="height: 380px">
                                    <div
                                        class="position-absolute d-flex justify-content-center align-items-center h-100 p-2">
                                        <img src="{{ asset('storage/img/katalog/' . $item->gambar) }}" class="img-fluid"
                                            alt="...">
                                    </div>
                                    <div class="katalog-konten justify-content-center align-items-center">
                                        <div class="text-center">
                                            <h3 class="m-0 text-white mb-2">{{ $item->kode_katalog }}</h3>
                                            <small class="d-block mb-4 text-white">Mulai Rp
                                                {{ number_format($item->harga_tanpa_kain) }}</small>
                                            <a class="btn btn-sm btn-light"
                                                href="{{ route('detail.katalog', $item) }}">Lihat
                                                Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        @endif
    </div>

    <style>
        .katalog-card {
            position: relative;
            overflow: hidden;
        }

        .katalog-konten {
            display: flex;
            opacity: 0;
            position: absolute;
            height: 100%;
            width: 100%;
            background: rgba(214, 177, 67, 0.7);
            transition: .3s;
        }

        .katalog-card:hover>.katalog-konten {
            opacity: 1;
            animation: fadeIn .3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                transform: translate3d(0, -20%, 0);
            }

            to {
                transform: translate3d(0, 0, 0);
            }
        }
    </style>

    <script>
        var splide = new Splide('.splide', {
            type: 'loop',
            drag: 'free',
            snap: true,
            perPage: 4,
            autoplay: true,
            breakpoints: {
                640: {
                    perPage: 1,
                },
            }
        });

        splide.mount();
    </script>
@endsection
