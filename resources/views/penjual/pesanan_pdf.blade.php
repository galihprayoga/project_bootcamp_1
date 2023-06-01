<!DOCTYPE html>
<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	
 
	<table class='table table-bordered'>
		<thead>
			<tr>
                <th>Invoice</th>
                <th>Nama Pemesan</th>                                    
                <th>Nama Produk</th>                                    
                <th>Jumlah</th>
                <th>Bukti Pembayaran</th>                
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($data_pesanan as $row)
			<tr>
                <td>{{ $row->invoice }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->nama_produk }}</td>
                <td>{{ $row->jumlah }}</td>
                <td>{{ $row->bukti_pembayaran }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>