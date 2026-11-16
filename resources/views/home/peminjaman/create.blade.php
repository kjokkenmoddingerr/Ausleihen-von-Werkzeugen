@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Ajukan Peminjaman</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Ajukan Peminjaman</li>
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
                            <h3>Ajukan Peminjaman Alat</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('peminjaman.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="id_alat" class="form-label">Nama Alat</label>
                                    <select class="form-control" name="id_alat" id="id_alat">
                                        <option value="">-- Pilih Alat --</option>
                                        @foreach ($alat as $a)
                                            <option value="{{ $a->id }}"
                                                {{ old('id_alat') == $a->id ? 'selected' : '' }}>{{ $a->nama_alat }}
                                                (stok: {{ $a->stok }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('id_alat')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror

                                <div class="mb-3">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" class="form-control" name="jumlah" id="jumlah" min="1"
                                        value="{{ old('jumlah', 1) }}" />
                                </div>
                                @error('jumlah')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror

                                <div class="mb-3">
                                    <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                                    <input type="date" class="form-control" name="tanggal_pinjam" id="tanggal_pinjam"
                                        min="{{ now()->toDateString() }}"
                                        value="{{ old('tanggal_pinjam', now()->toDateString()) }}" />
                                </div>
                                @error('tanggal_pinjam')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror

                                <div class="mb-3">
                                    <label for="batas_kembali" class="form-label">Batas Kembali</label>
                                    <input type="date" class="form-control" name="batas_kembali" id="batas_kembali"
                                        min="{{ old('tanggal_pinjam', now()->toDateString()) }}"
                                        value="{{ old('batas_kembali') }}" />
                                </div>
                                @error('batas_kembali')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror

                                <button class="btn btn-primary" type="submit">Ajukan</button>
                                <a class="btn btn-warning" href="{{ route('peminjaman.index') }}">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        // batas kembali tidak boleh lebih awal dari tanggal pinjam
        document.getElementById('tanggal_pinjam').addEventListener('change', function() {
            document.getElementById('batas_kembali').min = this.value;
        });
    </script>
@endsection
