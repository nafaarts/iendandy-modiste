@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-dark">Data Warna</h6>
                    <a class="btn btn-sm btn-gold" href="{{ route('warna.create') }}">
                        <i class="fas fa-fw fa-plus"></i>
                        Warna
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Warna</th>
                                <th>Nama</th>
                                <th>Catatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($warna as $item)
                                <tr>
                                    <td>
                                        <div style="height: 30px; width: 30px; background: {{ $item->warna }}"></div>
                                    </td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->catatan ?? '-' }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <form action="{{ route('warna.destroy', $item) }}" method="post"
                                                onsubmit="return confirm('hapus warna ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger ml-2">
                                                    <i class="fas fa-fw fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- pagination --}}
                    {{ $warna->links() }}
                </div>
            </div>
        </div>

    </div>
@endsection
