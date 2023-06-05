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
                    <a href="{{ url('/cetak_pdf/'.$id) }}" target="_blank" class="btn btn-primary mb-3">Cetak Alamat</a>
                    <div class="responsive">
                        <table class="table table-stripped table-bordered">
                            <thead>
                                <tr class="bg-primary text-white" align="center">
                                    <th>No</th>
                                    <th>Invoice</th>
                                    <th>Nama Pemesan</th>                                    
                                    <th>Nama Produk</th>                                    
                                    <th>Jumlah</th>
                                    <th>Bukti Pembayaran</th>
                                    <th>Aksi</th>
                                    <th>Status Pesanan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1; @endphp
                                @foreach($data_pesanan as $row)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $row->invoice }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->nama_produk }}</td>
                                    <td>{{ $row->jumlah }}</td>
                                    <td>
                                        <img id="bukti_pembayaran" class="img-fluid rounded shadow-sm"
                                        src="{{ asset('gambar/bukti_pembayaran/'.$row->bukti_pembayaran) }}"
                                        style="width: 90px; height:90px" alt="Bukti Pembayaran"
                                        onmouseover="enlargeImg()" onmouseout="resetImg()">
                                    </td>
                                    @if($row->status_pesanan==2)
                                    <td><button onclick="confirmationUpdateData('{{ url('/verifikasi_pembayaran/'.$id) }}')" 
                                    class="btn btn-sm btn-info m-2">Verifikasi Pembayaran</button></td>
                                    @else
                                    <td>Pembayaran Telah Diverifikasi</td>
                                    @endif
                                        @if($row->status_pesanan==2)
                                        <td class="bg-warning">Menunggu Verifikasi</td>
                                        @elseif($row->status_pesanan==3)
                                        <td class="bg-info">Pembayaran Terverifikasi</td>
                                        @elseif($row->status_pesanan==4)
                                        <td class="bg-success">Produk Dikirim</td>
                                        @else
                                        <td class="bg-primary">Pesanan Selesai</td>
                                        @endif                                
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
    // Get the img object using its Id
    img = document.getElementById("bukti_pembayaran");
        // Function to increase image size
        function enlargeImg() {
            // Set image size to 6 times original
            img.style.transform = "scale(6)";
            // Animation effect
            img.style.transition = "transform 0.25s ease";
        }
        // Function to reset image size
        function resetImg() {
            // Set image size to original
            img.style.transform = "scale(1)";
            img.style.transition = "transform 0.25s ease";
        }
    
        function confirmationUpdateData(url) {
            Swal.fire({
                title: 'Anda Yakin Untuk Memverifikasi Pembayaran Ini ?',
                text: 'Data Tidak Dapat Dikembalikan!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Verifikasi!',
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
