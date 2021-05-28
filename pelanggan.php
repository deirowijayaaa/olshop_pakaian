<?php 
session_start();
if(!isset($_SESSION['username']) and !isset($_SESSION['level'])){
  echo "ANDA BELUM LOGIN !";
  exit;
}else if($_SESSION['level']!=="admin"){
  echo "ANDA TIDAK BERHAK MENGAKSES !";
  exit;
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
			<thead class="thead-dark">
			<tr align="center">
			<th>No</th>
			<th>Username</th>
			<th>Email</th>
			<th>Aksi</th>
			</tr>
			</thead>	
	</div>
	<?php $nomer=1; ?>
	<?php $ambil=$koneksi->query("SELECT * FROM tb_user");?>
	<?php while ($pecah=$ambil->fetch_assoc()){ ?>
	<tr>
		<td align="center"><?php echo $nomer ?></td>
		<td><?php echo $pecah['username']; ?></td>
		<td><?php echo $pecah['email']; ?></td>
		<td>
			<a href="admin.php?page=hapususer&username=<?php echo $pecah['username']; ?>" onclick="return confirm('Apakah anda yakin')"
			class="btn-danger btn btn-xs">Hapus</a>
		</td>
	</tr>
	<?php $nomer++;?>
	<?php } ?>
</table>
	
	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>