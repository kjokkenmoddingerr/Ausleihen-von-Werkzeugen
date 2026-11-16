@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Kategori</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">Kategori</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        @php
                            $role = Auth::user()->role;
                        @endphp
                        <div class="card-header">
                            <h3>Data Pengembalian</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        @if ($role !== 'peminjam')
                                            <th>Peminjam</th>
                                        @endif
                                        <th>Alat</th>
                                        <th>Jumlah</th>
                                        <th>Tgl Kembali</th>
                                        <th>Denda</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengembalian as $r)
                                        @php
                                            $terlambat = ($r->denda ?? 0) > 0;
                                            $status = $terlambat ? 'Terlambat' : 'Tepat Waktu';
                                            $warna = $terlambat ? 'danger' : 'success';
                                        @endphp
                                        <tr>

                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            @if ($role !== 'peminjam')
                                                <td>{{ $r->peminjaman->user->name }}</td>
                                            @endif
                                            <td>{{ $r->peminjaman->alat->nama_alat }}</td>
                                            <td>{{ $r->peminjaman->jumlah }}</td>
                                            <td>{{ $r->tanggal_kembali->format('d-m-Y') }}</td>
                                            <td>Rp {{ number_format($r->denda, 0, ',', '.') }}</td>

                                            <td class="text-center">
                                                <span class="badge badge-{{ $warna }}">
                                                    {{ $status }}
                                                </span>
                                            </td>

                                            <td>{{ $r->keterangan }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
