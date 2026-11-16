@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Alat</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">Alat</li>
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
                        <div class="card-header">
                            <h3>Tabel Alat
                                @if (Auth::user()->role === 'admin')
                                    <a class="btn btn-primary" href="{{ route('alat.create') }}">
                                        <i class="fas fa-plus"></i> Tambah Alat</a>
                                @endif
                                @if (Auth::user()->role === 'peminjam')
                                    <a class="btn btn-primary" href="{{ route('peminjaman.create') }}">
                                        <i class="fas fa-hand-holding"></i> Ajukan Peminjaman</a>
                                @endif
                            </h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Alat</th>
                                        <th>Kategori</th>
                                        <th>Stok</th>
                                        @if (Auth::user()->role === 'admin')
                                            <th class="no-export">Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alat as $a)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $a->nama_alat }}</td>
                                            <td>{{ $a->kategori->nama_kategori }}</td>
                                            <td>{{ $a->stok }}</td>
                                            @if (Auth::user()->role === 'admin')
                                                <td>
                                                    <a class="btn btn-warning" href="{{ route('alat.edit', $a->id) }}">
                                                        <i class="fas fa-edit"></i> Edit</a>
                                                    <a class="btn btn-danger" href="{{ route('alat.destroy', $a->id) }}"
                                                        onclick="return confirm('Yakin alat mau dihapus ?')">
                                                        <i class="fas fa-trash"></i> Hapus</a>
                                                </td>
                                            @endif
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
