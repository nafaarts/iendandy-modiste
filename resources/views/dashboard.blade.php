@extends('layouts.app')

@section('custom_styles')
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="row mb-3">
            <div class="col-md-3">
                <div class="card border-0 bg-danger text-white">
                    <div class="card-body">
                        <small class="card-text">
                            Jumlah Pengguna
                        </small>
                        <h5 class="m-0">{{ $jumlahPengguna }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 bg-primary text-white">
                    <div class="card-body">
                        <small class="card-text">
                            Jumlah Katalog
                        </small>
                        <h5 class="m-0">{{ $jumlahKatalog }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 bg-success text-white">
                    <div class="card-body">
                        <small class="card-text">
                            Jumlah Pesanan
                        </small>
                        <h5 class="m-0">{{ $jumlahPesanan }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 bg-warning text-white"> 
                    <div class="card-body">
                        <small class="card-text">
                            Total Transaksi
                        </small>
                        <h5 class="m-0">Rp {{ number_format($totalTransaksi) }}</h5>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="row">
            <div class="col-md-8">
                <div class="card border-0">
                    <div class="card-body">
                        <small class="card-text">
                            Grafik Penjualan Mingguan
                        </small>
                        <canvas class="mt-2" id="penjualan_mingguan"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0">
                    <div class="card-body">
                        <small class="card-text">
                            Grafik Tipe Pesanan
                        </small>
                        <canvas class="mt-2" id="tipe_pesanan"></canvas>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const penjualan_mingguan = document.getElementById('penjualan_mingguan');
        const tipe_pesanan = document.getElementById('tipe_pesanan');

        new Chart(penjualan_mingguan, {
            type: 'bar',
            data: {
                labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                datasets: [{
                    data: [300000, 5300000, 2300000, 4850000, 2800000, 1470000, 2800000],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        new Chart(tipe_pesanan, {
            type: 'pie',
            data: {
                labels: ['Katalog', 'Costum'],
                datasets: [{
                    data: [36, 100 - 36],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script> --}}
@endsection
