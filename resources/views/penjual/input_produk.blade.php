@extends('layouts.app')


@section('content')
<ul class="nav nav-pills bg-secondary justify-content-center mb-4 sticky-top">
    <li class="nav-item">
        <a class="nav-link text-light" href="{{ url('pesanan') }}">Pesanan</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="{{ url('input_produk') }}">Input Produk</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-light" href="{{ url('report_produk') }}">Daftar Produk</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-light" href="#">Profil</a>
    </li>
</ul>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Input Produk</div>


                <div class="card-body">
                    <div class="row mb-2">
                        @if (\Session::has('message'))
                            <div class="alert alert-success">
                                {!! \Session::get('message') !!}
                            </div>
                        @elseif(\Session::has('error'))
                            <div class="alert alert-danger">
                                {!! \Session::get('error') !!}
                            </div>
                        @endif
                    </div>
                    <form method="POST" action="{{ url('simpan_input_produk') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-2">
                            <label for="nama_produk" class="col-md-4 col-form-label text-md-end">Nama Produk</label>


                            <div class="col-md-6">
                                <input id="nama_produk" type="text" class="form-control" name="nama_produk" required>
                            </div>
                        </div>


                        <div class="row mb-2">
                            <label for="gambar_produk" class="col-md-4 col-form-label text-md-end">Gambar Produk</label>


                            <div class="col-md-6">
                                <input id="gambar_produk" type="file" class="form-control" name="gambar_produk" required>
                            </div>
                        </div>
                        
                        
                        <div class="row mb-2">
                            <label for="gambar_produk_2" class="col-md-4 col-form-label text-md-end">Gambar Produk 2</label>


                            <div class="col-md-6">
                                <input id="gambar_produk_2" type="file" class="form-control" name="gambar_produk_2" required>
                            </div>
                        </div>
                        
                        
                        <div class="row mb-2">
                            <label for="gambar_produk_3" class="col-md-4 col-form-label text-md-end">Gambar Produk 3</label>


                            <div class="col-md-6">
                                <input id="gambar_produk_3" type="file" class="form-control" name="gambar_produk_3" required>
                            </div>
                        </div>


                        <div class="row mb-2">
                            <label for="stok_produk" class="col-md-4 col-form-label text-md-end">Stok Produk</label>


                            <div class="col-md-6">
                                <input id="stok_produk" type="number" class="form-control" name="stok_produk" required>
                            </div>
                        </div>
                        
                        
                        <div class="row mb-2">
                            <label for="harga" class="col-md-4 col-form-label text-md-end">Harga</label>


                            <div class="col-md-6">
                                <input id="harga" type="number" class="form-control" name="harga" required>
                            </div>
                        </div>


                        <div class="row mb-2">
                            <label for="deskripsi_produk" class="col-md-4 col-form-label text-md-end">Deskripsi
                                Produk</label>


                            <div class="col-md-6">
                                <textarea id="deskripsi_produk" class="form-control" name="deskripsi_produk"></textarea>
                            </div>
                        </div>


                        <div class="row mb-2">
                            <div class="col-md-8 offset-md-4">
                                <button class="btn btn-sm btn-primary" type="submit">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
