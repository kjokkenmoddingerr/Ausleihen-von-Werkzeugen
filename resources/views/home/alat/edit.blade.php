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
                            <h3>Edit Data Alat</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('alat.update', $alat->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="nama_alat" class="form-label">Nama Alat</label>
                                    <input type="text" class="form-control" name="nama_alat" id="nama_alat"
                                        value="{{ old('nama_alat', $alat->nama_alat) }}" />
                                </div>
                                @error('nama_alat')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                                <div class="mb-3">
                                    <label for="id_kategori" class="form-label">Kategori</label>
                                    <select class="form-control" name="id_kategori" id="id_kategori">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach ($kategori as $k)
                                            <option value="{{ $k->id }}"
                                                {{ old('id_kategori', $alat->id_kategori) == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('id_kategori')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                                <div class="mb-3">
                                    <label for="stok" class="form-label">Stok</label>
                                    <input type="number" class="form-control" name="stok" id="stok" min="0"
                                        value="{{ old('stok', $alat->stok) }}" />
                                </div>
                                @error('stok')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                                <button class="btn btn-primary" type="submit">Simpan</button>
                                <a class="btn btn-warning" href="{{ route('alat.index') }}">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
