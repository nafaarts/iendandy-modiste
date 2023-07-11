<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Sri Murni">

    <title>@yield('title', 'Beranda') - {{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('sm-logo.png') }}" type="image/png">

    @vite('resources/css/app.css')

    <!-- Custom fonts for this template-->
    <link href="{{ asset('css/fontawsome-free-all.min.css') }}" rel="stylesheet" type="text/css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">

    <style>
        .btn-gold {
            color: white;
            background-color: #D5B141;
        }

        .btn-outline-gold {
            border: 1px solid #D5B141;
            color: #D5B141;
        }

        .btn-outline-gold:hover {
            background: #D5B141;
        }

        .btn-gold:hover {
            color: white;
            background-color: #b89731;
        }

        .bg-gold {
            background: #D5B141;
        }

        .text-gold {
            color: #D5B141;
        }

        a.text-gold:hover {
            color: #b89731;
        }

        td {
            vertical-align: middle !important;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    @yield('custom_styles')
</head>

<body>
    <div class="min-vh-100 d-flex flex-column justify-content-between">
        <nav class="navbar navbar-expand-lg bg-light sticky-top">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="{{ asset('logo.png') }}" alt="Iendandy" height="40">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('buat.pesanan-kostum') }}">Pesan Kustom</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                @can('is-admin')
                                    <a class="nav-link" href="{{ route('dashboard') }}">Admin</a>
                                @else
                                    <a class="nav-link" href="{{ route('profil') }}">Profil Saya</a>
                                @endcan
                            </li>
                        @endauth
                        <li class="nav-item">
                            <a class="nav-link" href="/tentang">Tentang</a>
                        </li>
                    </ul>
                    @guest
                        <a class="ms-2 btn btn-sm btn-outline-gold" href="{{ route('login') }}">Masuk / Daftar</a>
                    @else
                        <a class="ms-2 btn btn-sm btn-outline-gold" data-toggle="modal" data-target="#logoutModal"><i
                                class="fas fa-fw fa-sign-out-alt"></i> Keluar</a>
                    @endguest
                </div>
            </div>
        </nav>

        <main class="flex-grow-1">
            @yield('content')
        </main>

        <footer class="py-3 text-center bg-light">
            <small>Copyright &copy; Iendandy Modiste {{ date('Y') }}</small>
        </footer>
    </div>

    {{-- whatsapp --}}
    <div class="sc-whatsapp position-fixed bg-success rounded-circle d-flex justify-content-center align-items-center"
        style="bottom: 25px; right: 25px; height: 70px; width: 70px">
        <a href="https://wa.me/6285321379190" target="_blank" class="text-white">
            <h2 class="m-0"><i class="fab fa-fw fa-whatsapp"></i></h2>
        </a>
    </div>

    <style>
        .sc-whatsapp {
            cursor: pointer;
            transition: .3s;
        }

        .sc-whatsapp:hover {
            transform: translateY(-10px) scale(1.2)
        }
    </style>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                    <button class="btn close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">Apakah anda yakin untuk keluar?</div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a href="{{ route('logout') }}" class="btn btn-gold"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="mr-2 fas fa-sign-out-alt"></i>
                            Keluar
                        </a>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @vite('resources/js/app.js')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    @yield('custom_scripts')

</body>

</html>
