@extends('layouts.app')


@section('content')
<ul class="nav nav-pills bg-secondary justify-content-center mb-4 sticky-top">
    <li class="nav-item">
        <a class="nav-link text-light" href="{{ url('pesanan') }}">Pesanan</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-light" href="{{ url('input_produk') }}">Input Produk</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="{{ url('report_produk') }}">Daftar Produk</a>
    </li>    
</ul>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Report Produk</div>


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
                                    <th>Gambar Produk</th>
                                    <th>Nama Produk</th>
                                    <th>Stok</th>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1; @endphp
                                @foreach($data_produk as $row)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td align="center">
                                        <img class="img-fluid rounded shadow-sm"
                                            src="{{ asset('gambar/gambar_produk/'.$row->gambar_produk) }}"
                                            style="width: 90px; height:90px" alt="Gambar Produk">
                                        <img class="img-fluid rounded shadow-sm"
                                            src="{{ asset('gambar/gambar_produk/'.$row->gambar_produk_2) }}"
                                            style="width: 90px; height:90px" alt="Gambar Produk">
                                        <img class="img-fluid rounded shadow-sm"
                                            src="{{ asset('gambar/gambar_produk/'.$row->gambar_produk_3) }}"
                                            style="width: 90px; height:90px" alt="Gambar Produk">
                                    </td>
                                    <td>{{ $row->nama_produk }}</td>
                                    <td>{{ $row->stok }}</td>
                                    <td>{{ $row->deskripsi_produk }}</td>
                                    <td>Rp. {{ format_rupiah($row->harga) }}</td>
                                    <td align="center">
                                        <a href="{{ url('/edit_produk/'.$row->id) }}" class="btn btn-sm btn-info m-2">Edit</a>
                                        <button onclick="confirmationHapusData('{{ url('/hapus_produk/'.$row->id) }}')" class="btn btn-sm btn-danger m-2">Hapus</button>
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