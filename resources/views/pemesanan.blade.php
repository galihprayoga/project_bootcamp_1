@extends('layouts.app')


@section('content')
<div class="container">
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
                    <form method="POST" action="{{ url('/pesan_produk/'.$id) }}" enctype="multipart/form-data">
                        @csrf
                        @foreach($data_produk as $row)
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
                                <input id="jumlah" type="number" class="form-control" name="jumlah" value="1">
                            </div>
                        </div>
                        
                        
                        <div class="row mb-3">
                            <label for="harga" class="col-md-4 col-form-label text-md-end">Harga</label>


                            <div class="col-md-6">
                                <input id="harga" type="number" class="form-control" name="harga" value="{{ format_rupiah($row->harga) }}">
                            </div>
                        </div>
                        
                        
                        <div class="row mb-3">
                            <label for="sub_total" class="col-md-4 col-form-label text-md-end">Sub Total</label>


                            <div class="col-md-6">
                                <input id="sub_total" type="number" class="form-control" name="sub_total">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="alamat" class="col-md-4 col-form-label text-md-end">Alamat Pengiriman</label>


                            <div class="col-md-6">
                                <textarea id="alamat" class="form-control" name="alamat"></textarea>
                            </div>
                        </div>
                        
                        
                        <div class="row mb-3">
                            <label for="no_telp_pemesan" class="col-md-4 col-form-label text-md-end">Nomor Telepon</label>


                            <div class="col-md-6">
                                <input id="no_telp_pemesan" class="form-control" name="no_telp_pemesan"></input>
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
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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
            $("#sub_total").val(number_with_dot(sub_total));
      })
    });
      
  </script>

@endsection
