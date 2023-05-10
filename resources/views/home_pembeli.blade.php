@extends('layouts.header_pembeli')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-9 mx-auto py-4">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://dummyimage.com/16:9x1080/" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="https://dummyimage.com/16:9x1080/" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="https://dummyimage.com/16:9x1080/" class="d-block w-100" alt="...">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="row">
        <div class="col text-center">
            <img src="https://beforeigosolutions.com/wp-content/uploads/2021/12/dummy-profile-pic-300x300-1.png" alt="" width="100">
        </div>
    </div> -->

    <!-- <div class="row">
        <div class="col text-center">
            <i class="fas fa-store"></i>
        </div>
        <div class="col text-center">
            <i class="fas fa-list"></i>
        </div>
        <div class="col text-center">
            <i class="fas fa-star"></i>
        </div>
    </div> -->

    <div class="row">
        @foreach($data_produk as $row)
            <div class="col-md-3 mb-4">
                <div class="card position-relative" style="width: 15rem;">
                    <img src="{{ asset('gambar/gambar_produk/'.$row->gambar_produk) }}" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">{{ $row->nama_produk }}</h5>
                        <p class="card-text">Rp 250.000</p>
                        <a href="#" class="btn btn-primary">Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
        
@endsection
