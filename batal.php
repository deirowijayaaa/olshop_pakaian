<?php 
include "koneksi.php";
$id_pembelian = $_GET['id'];

$ambil=$koneksi->query("DELETE FROM tb_pembelian WHERE id_pembelian='$id_pembelian'");
$ambil2=$koneksi->query("DELETE FROM tb_keranjang WHERE id_pembelian='$id_pembelian'");

if ($ambil&&$ambil2) {
	header("location:riwayat.php");
}
?>