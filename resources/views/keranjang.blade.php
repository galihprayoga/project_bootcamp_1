@extends('layouts.app')
@section('content')
<div class="container p-4 d-flex flex-column min-vh-100">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Keranjang</div>
                
                @csrf
                @forelse($data_pesanan as $row)
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
                                        <button onclick="confirmationHapusData('{{ url('/hapus_produk_keranjang/'.$row->id_pesanan) }}')" class="btn btn-sm btn-danger m-2">Hapus</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h2 align="right" class="card-title px-3 pb-3">Total Harga: Rp. {{ number_format($total,0,'','.') }}</h2>
                    <div class="row mb-3 mx-auto">
                        <div class="col-md-8">
                            <a href="{{ url('pembayaran') }}" class="btn btn-sm btn-success px-5 pt-2"><h3>Bayar</h3></a>
                        </div>
                    </div>
                @empty
                <h3 class="bg-danger text-white p-4 my-2">Tidak ada produk dalam keranjang Anda!</h3>
                @endforelse
            </div>
        </div>
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

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmationHapusData(url) {
            Swal.fire({
                title: 'Anda Yakin Untuk Menghapus Data Ini ?',
                text: 'Data Tidak Dapat Dikembalikan!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Hapus!',
                closeOnConfirm: false
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            })
        }
</script>
@endsection
