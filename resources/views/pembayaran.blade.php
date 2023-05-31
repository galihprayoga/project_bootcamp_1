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
                    <form method="POST" action="{{ url('simpan_pembayaran') }}" enctype="multipart/form-data">
                        
                        
                        <!-- <div class="row mb-3">
                            <label for="sub_total" class="col-md-4 col-form-label text-md-end">Sub Total</label>
                            
                            
                            <div class="col-md-6">
                                <input id="sub_total" type="number" class="form-control" name="sub_total">
                            </div>
                        </div> -->

                        
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

@endsection
