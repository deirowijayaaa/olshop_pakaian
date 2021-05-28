<?php
	include "koneksi.php";
 	$keyword=$_GET["keyword"];
 	$semua=array();
 	$ambil=$koneksi->query("SELECT * FROM tb_produk WHERE nama LIKE '%$keyword%'"); 
 	while($pecah=$ambil->fetch_assoc())
 	{
 		$semua[]=$pecah;
 	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="bootstrap.css">

</head>

<body>
	<div class="container"><br>
		
		<table class="table table-striped table-bordered">
			<thead>
			<tr align="center">
			<th>No</th>
			<th>Nama Barang</th>
			<th>Harga</th>
			<th>Foto</th>
			<th>Action</th>
			</tr>
			</thead>	
	</div>

		<?php $nomer=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM tb_produk");?>
		<?php $pecah=$ambil->fetch_assoc(); ?>
		<?php foreach ($semua as $key => $pecah): ?>
		<tr>
			<td><?php echo $nomer ?></td>
			<td><?php echo $pecah['nama']; ?></td>
			<td><?php echo number_format($pecah['harga']); ?></td>
			<td>
				<img src="img/product/<?php echo $pecah['foto']; ?>" width="80">
			</td>
			<td align="center">
				<a href="admin.php?page=edit&id_produk=<?php echo $pecah['id_produk']; ?>" class="btn btn-sm btn-secondary m-1">Edit</a>
				<a href="admin.php?page=hapus&id_produk=<?php echo $pecah['id_produk']; ?>" onclick="return confirm('Apakah anda yakin')"
				class="btn btn-sm btn-danger m-1">Hapus</a>
			</td>
		</tr>
		<?php $nomer++; ?>
		<?php endforeach ?>
</table>
	
	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>