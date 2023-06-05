@extends('layouts.app')


@section('content')
<div class="container p-4 d-flex flex-column min-vh-100">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pembayaran</div>
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
                    <form method="POST" action="{{ url('simpan_pembayaran') }}" enctype="multipart/form-data">
                        
                        <div class="row mb-3">
                            <h2 id="show_pembayaran" align="center"></h2>
                        </div>

                        <div class="row mb-3">
                            <label for="pembayaran" class="col-md-4 col-form-label text-md-end">Pilih Pembayaran</label>

                            <div class="col-md-6">
                                <select class="form-control" id="pembayaran">
                                    <option value="">Pilih Bank</option>
                                    <option value="1490509004">BCA</option>
                                    <option value="64501016384533">BRI</option>
                                    <option value="1380022087964">Mandiri</option>
                                </select>
                            </div>
                        </div>

                        
                        <div class="row mb-3">
                            <label for="alamat" class="col-md-4 col-form-label text-md-end">Alamat Pengiriman</label>
                            
                            
                            <div class="col-md-6">
                                <textarea id="alamat" class="form-control" name="alamat"></textarea>
                            </div>
                        </div>                                                                        
                        

                        <div class="row mb-2">
                            <label for="bukti_pembayaran" class="col-md-4 col-form-label text-md-end">Bukti Pembayaran</label>
                            
                            
                            <div class="col-md-6">
                                <input id="bukti_pembayaran" type="file" class="form-control" name="bukti_pembayaran" required>
                            </div>
                        </div>
                        
                        
                        <div class="row mb-3">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-sm btn-primary">Pesan</button>
                            </div>
                        </div>
                        @csrf
                        @foreach($data_pesanan as $row)
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="page-footer font-small bg-primary text-white pt-4 sticky-footer">

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
    $(document).ready(function () {  
        $('#pembayaran').on('keyup change', function() {
            $("#show_pembayaran").text("Nomor Rekening: "+$("option:selected", this).val());
        })
    });
      
  </script>

@endsection
