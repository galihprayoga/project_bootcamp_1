@extends('layouts.app')


@section('content')
<div class="container p-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
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
                    <form method="POST" action="{{ url('/do_tambah_keranjang/'.$id) }}" enctype="multipart/form-data">
                        @csrf
                        @foreach($data_pesanan as $row)
                        <input type="hidden" name="id" id="id" value="{{ $row->id }}">
                        <input type="hidden" name="id_user" id="id_user" value="{{ Auth::user()->id }}">
                        <div class="row mb-3">
                            <label for="nama_produk" class="col-md-4 col-form-label text-md-end">Nama Produk</label>


                            <div class="col-md-6">
                                <input id="nama_produk" type="text" class="form-control" name="nama_produk"
                                    value="{{ $row->nama_produk }}" readonly>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="gambar_produk" class="col-md-4 col-form-label text-md-end">Gambar Produk</label>


                            <div class="col-md-6">
                                <img class="img-fluid rounded shadow-sm mb-2"
                                    src="{{ asset('gambar/gambar_produk/'.$row->gambar_produk) }}"
                                    style="width: 90px; height:110px" alt="Gambar Produk">                                
                            </div>                                                   
                        </div>
                        
                        <div class="row mb-3">
                            <label for="jumlah" class="col-md-4 col-form-label text-md-end">Jumlah</label>


                            <div class="col-md-6">
                                <input id="jumlah" type="number" class="form-control" name="jumlah">
                            </div>
                        </div>
                        
                        
                        <div class="row mb-3">
                            <label for="harga" class="col-md-4 col-form-label text-md-end">Harga</label>


                            <div class="col-md-6">
                                <input id="harga" type="number" class="form-control" name="harga" value="{{ $row->harga }}">
                            </div>
                        </div>
                        
                        
                        <div class="row mb-3">
                            <label for="sub_total" class="col-md-4 col-form-label text-md-end">Sub Total</label>


                            <div class="col-md-6">
                                <input id="sub_total" type="number" class="form-control" name="sub_total">
                            </div>
                        </div>                        


                        <div class="row mb-3">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-sm btn-primary">Pesan</button>
                            </div>
                        </div>
                        @endforeach
                    </form>
                </div>
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

<script>
    function number_with_dot(x) {
		var parts = x.toString().split('.');
		parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.');
		return parts.join('.');        
	}

	function remove_dot(text) {
		text = text ?? '';
		return text.toString().replace(/\./g, '');
	}

    $(document).ready(function () {  
        $('#jumlah').on('keyup change', function() {
            var harga = remove_dot($('#harga').val());
            var jumlah = $("#jumlah").val();

            var sub_total = parseInt(harga) * parseInt(jumlah);
            // $("#sub_total").val(number_with_dot(sub_total));
            $("#sub_total").val(sub_total);
      })
    });
      
  </script>

@endsection
