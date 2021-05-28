<?php 

include "koneksi.php";
$id_keranjang = $_GET['id'];
$ambil=$koneksi->query("DELETE FROM tb_keranjang WHERE id_keranjang='$id_keranjang'");
if ($ambil) {
	header("location:keranjang2.php");
}

 ?>