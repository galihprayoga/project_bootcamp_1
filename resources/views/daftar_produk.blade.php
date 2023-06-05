@extends('layouts.app')

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
                        <p class="card-text">{{ format_rupiah($row->harga) }}</p>
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
