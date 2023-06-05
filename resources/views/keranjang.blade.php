@extends('layouts.app')
@section('content')
<div class="container p-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Keranjang</div>

                @csrf
                @foreach($data_pesanan as $row)
                <div class="card-body">
                    <div class="card mb-3" style="max-width: 750px;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="{{ asset('gambar/gambar_produk/'.$row->gambar_produk) }}" alt="Gambar Produk" class="card-img">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $row->nama_produk }}</h5>
                                    <p class="card-text">Banyaknya: {{ $row->jumlah }}</p>
                                    <h3 class="card-text">Rp. {{ number_format($row->sub_total,0,'','.') }}</h3>
                                    <a href="{{ url('/hapus_produk_keranjang/'.$row->id_pesanan) }}" class="btn btn-sm btn-danger">Hapus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <h2 align="right" class="card-title px-3 pb-3">Total Harga: Rp. {{ number_format($total,0,'','.') }}</h2>
                <div class="row mb-3 mx-auto">
                    <div class="col-md-8">
                        <a href="{{ url('pembayaran') }}" class="btn btn-sm btn-success px-5 pt-2"><h3>Bayar</h3></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
