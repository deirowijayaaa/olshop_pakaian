<?php
include "koneksi.php";
		@$id_prod=$_POST['txt_id'];
		@$nama=$_POST['nama'];
		@$harga=$_POST['harga'];
		@$foto1=$_POST['foto'];
		@$deskripsi=$_POST['deskripsi'];
		@$nama2 = $_FILES['foto']['name'];
		@$lokasi = $_FILES['foto']['tmp_name'];

if(!empty($foto1)){
	move_uploaded_file($lokasi, "img/product/".$nama2);
$query="UPDATE tb_produk SET nama='$nama', harga='$harga', foto='$foto1', deskripsi='$deskripsi'
		WHERE id_produk='$id_prod';";
	}
else {
	$query="UPDATE tb_produk SET nama='$nama', harga='$harga', deskripsi='$deskripsi'
		WHERE id_produk='$id_prod';";
}
$hasil=mysqli_query($koneksi,$query);
if ($hasil) {
	header('location:admin.php?page=produk');
	}else{
		echo "Gagal update data";
		echo mysqli_error();
	}
?>