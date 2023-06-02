<!DOCTYPE html>
<html>
<head>
	<title>Cetak Alamat</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body style="border">
	<style type="text/css">
		*{
			font-size: 9pt;
		}
		html,body{
			margin: 0; 
			padding: 5;
		}
		div.alamat{
			width: 95%;
			margin: 0;
			padding: 5;
			border: solid black;
			border-width: thin;
			overflow:hidden;
			display:block;
			box-sizing: border-box;
		}
	</style>
	<div class="alamat">
		<p align="right">Nomor Pemesanan : {{ $id }}
			<br>Tanggal : {{ now()->format('d-m-Y') }}
		</p>

		<p>Pengirim : Trendy Footwear
			<br>Nomor Telepon : 081229343031
			<br>Alamat : Jl. Jendral Sudirman, No. 45, Wonogiri
		</p>
		
		<p>Penerima : {{ $data_pesanan[0]->name }}
			<br>Nomor Telepon : {{ $data_pesanan[0]->no_telp_pemesan }}
			<br>Alamat : {{ $data_pesanan[0]->alamat }}
		</p>
		
		<table class='table table-bordered'>
			<thead>
				<tr>Produk</tr>
				<tr>
					<th>Nama Produk</th>                                    
					<th>Jumlah</th>
				</tr>
			</thead>
			<tbody>
				@php $i=1 @endphp
				@foreach($data_pesanan as $row)
				<tr>
					<td>{{ $row->nama_produk }}</td>
					<td>{{ $row->jumlah }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</body>
</html>