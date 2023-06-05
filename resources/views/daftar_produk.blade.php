@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-9 mx-auto py-4">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-interval="false">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="gambar/assets/banner1.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="gambar/assets/banner2.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="gambar/assets/banner3.jpg" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </button>
            </div>
            
        </div>
    </div>

    <div class="row">
        @foreach($data_produk as $row)
            <div class="col-md-3 mb-4">
                <div class="card position-relative" style="width: 15rem;">
                    <img src="{{ asset('gambar/gambar_produk/'.$row->gambar_produk) }}" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">{{ $row->nama_produk }}</h5>
                        <p class="card-text">Rp. {{ format_rupiah($row->harga) }}</p>
                        <a href="{{ url('/detail_produk/'.$row->id) }}" class="btn btn-primary">Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


<!-- Footer -->
<footer class="page-footer font-small bg-primary text-white pt-4">

    <div class="container-fluid text-md-left">    
        <div class="row">

            <!-- Grid column -->
            <div class="col-md-8 mt-md-0 mt-3 px-5">

                <!-- Content -->
                <h4 class="text-uppercase">Kunjungi Kami</h4>
                <p>Jl. Sidoharjo-Girimarto, Girimarto, Wonogiri.</p>
                <h5><a class="btn btn-success btn-lg" href="https://wa.me/81229343031"><i class="fa fa-whatsapp text-white"> Hubungi via Whatsapp</i></a></h5>

            </div>

            <!-- Grid column -->
            <div class="col-md-4 mb-md-0 mb-3">
                <!-- Links -->
                <h5 class="text-uppercase">Ikuti Kami di Media Sosial</h5>
                <ul class="list-unstyled">
                <li>
                    <a href="https://instagram.com"><i class="fa fa-instagram text-white"> trendy_footwear</i></a>
                </li>
                <li>
                    <a href="https://facebook.com"><i class="fa fa-facebook text-white"> trendy_footwear</i></a>            
                </li>
                <li>
                    <a href="https://twitter.com"><i class="fa fa-twitter text-white"> trendy_footwear</i></a>            
                </li>          
                </ul>
            </div>
            <!-- Grid column -->
        </div>
        <!-- Grid row -->
    </div>

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© <?= date('Y'); ?> Copyright Trendy Footwear</div>

</footer>
<!-- Footer -->
@endsection
