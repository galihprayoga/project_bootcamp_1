@extends('layouts.header_pembeli')

@section('content')
<div class="container">
<div class="row">
            <div class="col-md-7 card shadow mb-6">
                @csrf
                @foreach($data_produk as $row)
                    <div class="card-body">
                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-interval="false">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            </div>
                            <div class="carousel-inner">                                
                                <div class="carousel-item active">
                                    <img src="{{ asset('gambar/gambar_produk/'.$row->gambar_produk) }}" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('gambar/gambar_produk/'.$row->gambar_produk) }}" class="d-block w-100" alt="...">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
            </div>
            <div class="col-lg-5 pb-5" style="min-height: 400px;">
                <div class="position-relative h-100 ms-5">
                    <p>
                    <h1 class="display-5 text-uppercase mb-4">{{ $row->nama_produk }} </h1>
                    </p>
                    <p>
                    <h5 class="text-uppercase mb-3 text-body">{{ $row->deskripsi_produk }}</h5>
                    </p>
                    <p>
                    <h2><span class="text-primary">Rp 250.000</span></h2>
                    <a href="#" class="btn btn-primary">Pesan</a>
                    </p>
                </div>
            </div>
            @endforeach
        </div>

        
</div>
        
@endsection
