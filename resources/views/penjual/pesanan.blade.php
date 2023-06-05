@extends('layouts.app')


@section('content')
<ul class="nav nav-pills bg-secondary justify-content-center mb-4 sticky-top">
    <li class="nav-item">
        <a class="nav-link active" href="{{ url('pesanan') }}">Pesanan</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-light" href="{{ url('input_produk') }}">Input Produk</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-light" href="{{ url('report_produk') }}">Daftar Produk</a>
    </li>
</ul>
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
                                    <th>Invoice</th>
                                    <th>Nama Pemesan</th>
                                    <th>Nomor Telepon</th>
                                    <th>Total</th>
                                    <th>Status Pesanan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1; @endphp
                                @foreach($data_pesanan as $row)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $row->invoice }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->no_telp_pemesan }}</td>
                                    <td>Rp. {{ format_rupiah($row->total) }}</td>
                                    
                                        @if($row->status_pesanan==2)
                                        <td class="bg-warning">Menunggu Verifikasi</td>
                                        @elseif($row->status_pesanan==3)
                                        <td class="bg-info">Pembayaran Terverifikasi</td>
                                        @elseif($row->status_pesanan==4)
                                        <td class="bg-success">Produk Dikirim</td>
                                        @else
                                        <td class="bg-primary">Pesanan Selesai</td>
                                        @endif
                                    
                                    
                                    <td align="center">
                                        <a href="{{ url('/detail_pesanan/'.$row->invoice) }}" class="btn btn-sm btn-primary">Detail</a>                                        
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
