@extends('layouts.app')

@section('content')
<div class="container p-4">
<div class="row">
            <div class="col-md-7 card shadow mb-6">
                @csrf
                @foreach($data_produk as $row)
                    <div class="card-body">
                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-interval="false">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 2"></button>
                            </div>
                            <div class="carousel-inner">                                
                                <div class="carousel-item active">
                                    <img src="{{ asset('gambar/gambar_produk/'.$row->gambar_produk) }}" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('gambar/gambar_produk/'.$row->gambar_produk_2) }}" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('gambar/gambar_produk/'.$row->gambar_produk_3) }}" class="d-block w-100" alt="...">
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
            <div class="col-lg-5 pb-5" style="min-height: 400px;">
                <div class="position-relative h-100 ms-5">
                    <p>
                    <h1 class="display-5 text-uppercase mb-4">{{ $row->nama_produk }} </h1>
                    </p>
                    <p>
                    <h5 class="text-uppercase mb-3 text-body">{{ $row->deskripsi_produk }}</h5>
                    </p>
                    <p>
                    <h2><span class="text-primary">{{ format_rupiah($row->harga) }}</span></h2>
                    <a href="{{ url('/pemesanan/'.$row->id) }}" class="btn btn-primary">Pesan</a>
                    </p>
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
