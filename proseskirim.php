<?php 
include "koneksi.php";
session_start();

$idpembelian = $_GET['id_pembelian'];
$ambil=$koneksi->query("UPDATE tb_pembelian SET status='Barang Dikirim' WHERE id_pembelian='$idpembelian'");
if ($ambil) {
	header('location:admin.php?page=bayar&id_pembelian='.$idpembelian.'&pesan=berhasil');
}
?>