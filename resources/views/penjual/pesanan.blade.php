@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Pesanan Masuk</div>


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
                    <div class="responsive">
                        <table class="table table-stripped table-bordered">
                            <thead>
                                <tr class="bg-primary text-white" align="center">
                                    <th>No</th>
                                    <th>Nama Pemesan</th>
                                    <th>Nama Produk</th>
                                    <th>Nomor Telepon</th>
                                    <th>Jumlah</th>
                                    <th>Total Harga</th>
                                    <th>Bukti Pembayaran</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1; @endphp
                                @foreach($data_produk as $row)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->nama_produk }}</td>
                                    <td>{{ $row->no_telp_pemesan }}</td>
                                    <td>{{ $row->jumlah }}</td>
                                    <td>{{ $row->total_harga }}</td>
                                    <td align="center">                                        
                                        <img class="img-fluid rounded shadow-sm"
                                        src="{{ asset('gambar/bukti_pembayaran/'.$row->bukti_pembayaran) }}"
                                        style="width: 90px; height:90px" alt="Bukti Pembayaran">
                                    </td>
                                    <td>{{ $row->alamat }}</td>
                                    <td align="center">
                                        <a href="#" class="btn btn-sm btn-primary">Cetak Alamat</a>                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
