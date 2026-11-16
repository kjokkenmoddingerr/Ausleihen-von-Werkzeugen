@extends('layouts.master')
@section('content')
    @php
        $role = Auth::user()->role;
    @endphp

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">

                {{-- ================= KOTAK ADMIN ================= --}}
                @if ($role === 'admin')
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ $total_alat }}</h3>
                                    <p>Total Alat</p>
                                </div>
                                <div class="icon"><i class="fas fa-tools"></i></div>
                                <a href="{{ route('alat.index') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $total_kategori }}</h3>
                                    <p>Total Kategori</p>
                                </div>
                                <div class="icon"><i class="fas fa-tags"></i></div>
                                <a href="{{ route('kategori.index') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ $total_peminjaman }}</h3>
                                    <p>Total Peminjaman</p>
                                </div>
                                <div class="icon"><i class="fas fa-hand-holding"></i></div>
                                <a href="{{ route('peminjaman.index') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $total_user }}</h3>
                                    <p>Total User</p>
                                </div>
                                <div class="icon"><i class="fas fa-users"></i></div>
                                <a href="{{ route('user.index') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- ================= KOTAK PETUGAS ================= --}}
                @if ($role === 'petugas')
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ $total_menunggu }}</h3>
                                    <p>Menunggu Persetujuan</p>
                                </div>
                                <div class="icon"><i class="fas fa-hourglass-half"></i></div>
                                <a href="{{ route('peminjaman.index') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $total_dipinjam }}</h3>
                                    <p>Sedang Dipinjam</p>
                                </div>
                                <div class="icon"><i class="fas fa-hand-holding"></i></div>
                                <a href="{{ route('peminjaman.index') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $total_dikembalikan }}</h3>
                                    <p>Sudah Dikembalikan</p>
                                </div>
                                <div class="icon"><i class="fas fa-undo-alt"></i></div>
                                <a href="{{ route('pengembalian.index') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ $total_terlambat }}</h3>
                                    <p>Terlambat Dikembalikan</p>
                                </div>
                                <div class="icon"><i class="fas fa-exclamation-triangle"></i></div>
                                <a href="{{ route('peminjaman.index') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- ================= KOTAK PEMINJAM ================= --}}
                @if ($role === 'peminjam')
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ $total_menunggu }}</h3>
                                    <p>Menunggu Persetujuan</p>
                                </div>
                                <div class="icon"><i class="fas fa-hourglass-half"></i></div>
                                <a href="{{ route('peminjaman.index') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $total_dipinjam }}</h3>
                                    <p>Sedang Saya Pinjam</p>
                                </div>
                                <div class="icon"><i class="fas fa-hand-holding"></i></div>
                                <a href="{{ route('peminjaman.index') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $total_dikembalikan }}</h3>
                                    <p>Sudah Dikembalikan</p>
                                </div>
                                <div class="icon"><i class="fas fa-undo-alt"></i></div>
                                <a href="{{ route('pengembalian.index') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>Rp {{ number_format($total_denda, 0, ',', '.') }}</h3>
                                    <p>Total Denda Saya</p>
                                </div>
                                <div class="icon"><i class="fas fa-money-bill-wave"></i></div>
                                <a href="{{ route('pengembalian.index') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- ================= HISTORY PEMINJAMAN (semua role) ================= --}}
                <div class="card">
                    <div class="card-header">
                        <h3>
                            @if ($role === 'peminjam')
                                History Peminjaman Saya
                            @else
                                History Terakhir dari Tabel <b>Peminjaman</b>
                            @endif
                        </h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Alat</th>
                                    @if ($role !== 'peminjam')
                                        <th>Peminjam</th>
                                    @endif
                                    <th>Jumlah</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($riwayat_peminjaman as $p)
                                    <tr>
                                        <td>{{ $p->alat->nama_alat ?? '-' }}</td>
                                        @if ($role !== 'peminjam')
                                            <td>{{ $p->user->name ?? '-' }}</td>
                                        @endif
                                        <td>{{ $p->jumlah }}</td>
                                        <td>{{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d-m-Y') }}</td>
                                        <td class="text-center font-weight-bold">
                                            @if ($p->status === 'disetujui')
                                                <span class="badge badge-success">Disetujui</span>
                                            @elseif ($p->status === 'ditolak')
                                                <span class="badge badge-danger">Ditolak</span>
                                            @else
                                                <span class="badge badge-warning">Menunggu</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ $role === 'peminjam' ? 4 : 5 }}" class="text-center">Belum ada
                                            data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- ================= HISTORY PENGEMBALIAN (semua role) ================= --}}
                <div class="card">
                    <div class="card-header">
                        <h3>
                            @if ($role === 'peminjam')
                                History Pengembalian Saya
                            @else
                                History Terakhir dari Tabel <b>Pengembalian</b>
                            @endif
                        </h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Alat</th>
                                    @if ($role !== 'peminjam')
                                        <th>Peminjam</th>
                                    @endif
                                    <th>Tgl Kembali</th>
                                    <th>Denda</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($riwayat_pengembalian as $r)
                                    <tr>
                                        <td>{{ $r->peminjaman->alat->nama_alat ?? '-' }}</td>
                                        @if ($role !== 'peminjam')
                                            <td>{{ $r->peminjaman->user->name ?? '-' }}</td>
                                        @endif
                                        <td>{{ \Carbon\Carbon::parse($r->tanggal_kembali)->format('d-m-Y') }}</td>
                                        <td>Rp {{ number_format($r->denda, 0, ',', '.') }}</td>
                                        <td class="text-center font-weight-bold">
                                            @if ($r->denda > 0)
                                                <span class="badge badge-danger">Terlambat</span>
                                            @else
                                                <span class="badge badge-success">Tepat Waktu</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ $role === 'peminjam' ? 3 : 4 }}" class="text-center">Belum ada
                                            data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>
    </div><!-- /.content-wrapper -->
@endsection
