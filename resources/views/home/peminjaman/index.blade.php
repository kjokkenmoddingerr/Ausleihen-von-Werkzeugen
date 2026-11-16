@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Peminjaman</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">Peminjaman</li>
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
                            <h3>{{ $role === 'peminjam' ? 'Peminjaman Saya' : 'Data Peminjaman' }}
                                @if ($role === 'peminjam')
                                    <a class="btn btn-primary" href="{{ route('peminjaman.create') }}">
                                        <i class="fas fa-plus"></i> Ajukan Peminjaman</a>
                                @endif
                            </h3>
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
                                        <th>Tgl Pinjam</th>
                                        <th>Batas Kembali</th>
                                        <th>Status</th>
                                        <th class="no-export">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($peminjaman as $p)
                                        @php
                                            $warna = [
                                                'menunggu' => 'warning',
                                                'disetujui' => 'info',
                                                'ditolak' => 'danger',
                                                'dikembalikan' => 'success',
                                            ][$p->status];
                                            $terlambat = $p->status === 'disetujui' && $p->batas_kembali->lt(today());
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            @if ($role !== 'peminjam')
                                                <td>{{ $p->user->name }}</td>
                                            @endif
                                            <td>{{ $p->alat->nama_alat }}</td>
                                            <td>{{ $p->jumlah }}</td>
                                            <td>{{ $p->tanggal_pinjam->format('d-m-Y') }}</td>
                                            <td class="{{ $terlambat ? 'text-danger font-weight-bold' : '' }}">
                                                {{ $p->batas_kembali->format('d-m-Y') }}{{ $terlambat ? ' (terlambat)' : '' }}
                                            </td>
                                            <td><span
                                                    class="badge badge-{{ $warna }}">{{ ucfirst($p->status) }}</span>
                                            </td>
                                            <td>
                                                @if ($role === 'petugas' && $p->status === 'menunggu')
                                                    <form action="{{ route('peminjaman.setujui', $p->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        <button class="btn btn-success btn-sm" type="submit">
                                                            <i class="fas fa-check"></i> Setujui</button>
                                                    </form>
                                                    <form action="{{ route('peminjaman.tolak', $p->id) }}" method="POST"
                                                        class="d-inline"
                                                        onsubmit="return confirm('Yakin tolak peminjaman ini ?')">
                                                        @csrf
                                                        <button class="btn btn-danger btn-sm" type="submit">
                                                            <i class="fas fa-times"></i> Tolak</button>
                                                    </form>
                                                @endif

                                                @if ($role === 'peminjam' && $p->status === 'disetujui')
                                                    <form action="{{ route('pengembalian.store', $p->id) }}" method="POST"
                                                        class="d-inline"
                                                        onsubmit="return confirm('Yakin mengembalikan alat ini ?')">
                                                        @csrf
                                                        <button class="btn btn-warning btn-sm" type="submit">
                                                            <i class="fas fa-undo"></i> Kembalikan</button>
                                                    </form>
                                                @endif

                                                @if ($role === 'admin' && $p->status !== 'disetujui')
                                                    <a class="btn btn-danger btn-sm"
                                                        href="{{ route('peminjaman.destroy', $p->id) }}"
                                                        onclick="return confirm('Yakin mau hapus data ini ?')">
                                                        <i class="fas fa-trash"></i> Hapus</a>
                                                @endif
                                            </td>
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
