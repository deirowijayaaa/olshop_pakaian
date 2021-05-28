<?php
session_start();
include "koneksi.php";
$username = $_SESSION['username'];
$id_produk = $_POST['id_produk'];
$jumlah=1;
$query="INSERT INTO tb_keranjang (id_produk,jumlah,username) VALUES ('$id_produk','$jumlah','$username')";
$hasil = mysqli_query($koneksi,$query);
if ($hasil) {
	header('location : keranjang.php');
}
else{
	echo "Gagal";
}

?>