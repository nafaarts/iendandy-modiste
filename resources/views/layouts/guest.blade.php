<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Sri Murni">

    <title>@yield('title', 'Login') - {{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('sm-logo.png') }}" type="image/png">

    @vite('resources/css/app.css')
    <!-- Custom fonts for this template-->
    <link href="{{ asset('css/fontawsome-free-all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        .btn-gold {
            color: white;
            background-color: #D5B141;
        }

        .btn-gold:hover {
            color: white;
            background-color: #b89731;
        }

        .text-gold {
            color: #D5B141;
        }

        a.text-gold:hover {
            color: #b89731;
        }
    </style>
</head>

<body class="bg-light">
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh">
        @yield('content')
    </div>

    @vite('resources/js/app.js')

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.easing-1.4.1.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>

</html>
