@extends('layouts.front')

@section('content')
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

        .slide-image {
            height: 700px;
            background-position: center center;
            background-size: cover;
        }

        .slide-background {
            display: none;
            position: absolute;
            inset: 0;
            height: 100%;
            width: 100%;
            background: rgba(0, 0, 0, 0.2)
        }

        @media only screen and (max-width: 600px) {
            .slide-image {
                height: 300px;
                padding: 10px;
                background-position: center center;
                color: #fff;
            }

            .slide-background {
                display: block;
            }

            .splide__arrow {
                display: none;
            }
        }
    </style>

    <section class="splide" id="splide_slides" aria-label="Splide Basic HTML Example">
        <div class="splide__track">
            <ul class="splide__list">
                <li class="splide__slide">
                    <div class="slide-image" style="background-image: url({{ asset('slides/1.jpg') }});">
                        <div class="slide-background"></div>
                        <div class="container d-flex align-items-center h-100">
                            <div style="z-index: 999">
                                <h1 class="fw-bold">Example headline.</h1>
                                <p class="opacity-75">Some representative placeholder content for the first slide of the
                                    carousel.
                                </p>
                                <a class="btn btn-gold pt-1 mt-3" href="#">Sign up today</a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="splide__slide">
                    <div class="slide-image" style="background-image: url({{ asset('slides/2.jpg') }});">
                        <div class="slide-background"></div>
                        <div class="container d-flex align-items-center justify-content-end h-100">
                            <div style="z-index: 999">
                                <h1 class="fw-bold">Example headline.</h1>
                                <p class="opacity-75">Some representative placeholder content for the first slide of the
                                    carousel.
                                </p>
                                <a class="btn btn-gold pt-1 mt-3" href="#">Sign up today</a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="splide__slide">
                    <div class="slide-image" style="background-image: url({{ asset('slides/3.jpg') }});">
                        <div class="slide-background"></div>
                        <div class="container d-flex align-items-center h-100">
                            <div style="z-index: 999">
                                <h1 class="fw-bold">Example headline.</h1>
                                <p class="opacity-75">Some representative placeholder content for the first slide of the
                                    carousel.
                                </p>
                                <a class="btn btn-gold pt-1 mt-3" href="#">Sign up today</a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="splide__slide">
                    <div class="slide-image" style="background-image: url({{ asset('slides/4.jpg') }});">
                        <div class="slide-background"></div>
                        <div class="container d-flex align-items-center justify-content-end h-100">
                            <div style="z-index: 999">
                                <h1 class="fw-bold">Example headline.</h1>
                                <p class="opacity-75">Some representative placeholder content for the first slide of the
                                    carousel.
                                </p>
                                <a class="btn btn-gold pt-1 mt-3" href="#">Sign up today</a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </section>

    <div class="container py-4 mb-3">
        <h5 class="text-gold">Katalog Iendandy</h5>

        <hr>
        @if ($katalog)
            <section class="splide" id="splide_products" aria-labelledby="carousel-heading">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($katalog as $item)
                            <li class="splide__slide p-1">
                                <div class="card katalog-card" style="height: 380px">
                                    <div
                                        class="position-absolute d-flex justify-content-center
                                            align-items-center h-100 p-2">
                                        <img src="{{ asset('storage/img/katalog/' . $item->gambar) }}" class="img-fluid"
                                            alt="...">
                                    </div>
                                    <div class="katalog-konten justify-content-center align-items-center">
                                        <div class="text-center">
                                            @if ($item->stok() == 0)
                                                <span class="badge bg-danger mb-3">Stok Habis!</span>
                                            @endif
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

    <script>
        var splide = new Splide('#splide_slides', {
            type: 'loop',
            drag: 'free',
            snap: true,
            perPage: 1,
            autoplay: true,
        });

        splide.mount();

        var splide_products = new Splide('#splide_products', {
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

        splide_products.mount();
    </script>
@endsection
