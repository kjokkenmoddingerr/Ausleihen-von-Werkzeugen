@extends('layouts.master')

@section('content')
<style>
    @media print {
        .main-sidebar, .main-header, .main-footer, .no-print { display: none !important; }
        .content-wrapper { margin-left: 0 !important; background: #fff !important; }
        .card { border: none !important; box-shadow: none !important; }
    }
</style>

<div class="content-wrapper">
    <div class="content-header no-print">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1 class="m-0">Laporan Peminjaman</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Laporan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header no-print">
                    <form action="{{ route('laporan.index') }}" method="GET" class="form-inline">
                        <label class="mr-2">Dari</label>
                        <input type="date" name="dari" value="{{ $dari }}" class="form-control mr-3">
                        <label class="mr-2">Sampai</label>
                        <input type="date" name="sampai" value="{{ $sampai }}" class="form-control mr-3">
                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        <a href="{{ route('laporan.index') }}" class="btn btn-secondary mr-2">Reset</a>
                        <button type="button" class="btn btn-success ml-auto" onclick="window.print()">
                            <i class="fas fa-print"></i> Cetak
                        </button>
                    </form>
                </div>

                <div class="card-body">
                    <div class="text-center mb-3">
                        <h4 class="mb-0">LAPORAN PEMINJAMAN DAN PENGEMBALIAN ALAT</h4>
                        <small>
                            Periode:
                            {{ $dari ? \Carbon\Carbon::parse($dari)->format('d-m-Y') : 'Awal' }}
                            s/d
                            {{ $sampai ? \Carbon\Carbon::parse($sampai)->format('d-m-Y') : 'Sekarang' }}
                        </small>
                    </div>

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Peminjam</th>
                                <th>Alat</th>
                                <th>Jumlah</th>
                                <th>Tgl Pinjam</th>
                                <th>Batas Kembali</th>
                                <th>Tgl Kembali</th>
                                <th>Status</th>
                                <th>Denda</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($laporan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->user->name ?? '-' }}</td>
                                    <td>{{ $item->alat->nama_alat ?? '-' }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->batas_kembali)->format('d-m-Y') }}</td>
                                    <td>
                                        {{ $item->pengembalian
                                            ? \Carbon\Carbon::parse($item->pengembalian->tanggal_kembali)->format('d-m-Y')
                                            : '-' }}
                                    </td>
                                    <td class="text-capitalize">{{ $item->status }}</td>
                                    <td>Rp {{ number_format($item->pengembalian->denda ?? 0, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">Tidak ada data pada periode ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                        @if ($laporan->count())
                            <tfoot>
                                <tr>
                                    <th colspan="8" class="text-right">Total Denda</th>
                                    <th>Rp {{ number_format($laporan->sum(fn ($p) => $p->pengembalian->denda ?? 0), 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
