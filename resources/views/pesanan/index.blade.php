@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark">Data Pesanan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">Nomor Pesanan</th>
                                <th scope="col">Jenis Pesanan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Tanggal Pesanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pesanan as $item)
                                <tr>
                                    <th scope="row">
                                        <a href="{{ route('pesanan.show', $item) }}">{{ $item->no_pesanan }}</a>
                                    </th>
                                    <td>{{ $item->tipe_pesanan }}</td>
                                    <td><strong>{{ $item->status_pesanan }}</strong></td>
                                    <td>Rp {{ number_format($item->biaya) }}</td>
                                    <td>{{ $item->created_at }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-3">Belum ada pesanan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- pagination --}}
                    {{ $pesanan->links() }}
                </div>
            </div>
        </div>

    </div>
@endsection
