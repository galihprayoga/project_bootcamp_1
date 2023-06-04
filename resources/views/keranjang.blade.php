@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Keranjang</div>

                @csrf
                @foreach($data_pesanan as $row)
                <div class="card-body">
                    <div class="card mb-3" style="max-width: 540px;">
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
                <label for="total">{{ $total }}</label>
            </div>
            <a href="{{ url('pembayaran') }}" class="btn btn-sm btn-success">Bayar</a>
        </div>
    </div>
</div>
@endsection
