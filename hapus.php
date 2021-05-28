<?php
	include "koneksi.php";
	$id_produk=$_GET['id_produk'];
	$query="DELETE FROM tb_produk where id_produk='$id_produk'";
	$hasil=mysqli_query($koneksi,$query);

	if($hasil){
		?>
		<script language="javascript">document.location.href="admin.php?page=produk";</script>
		<?php
	}else {
		echo "gagal hapus data";
	}
?>