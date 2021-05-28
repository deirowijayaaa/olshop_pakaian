<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		&emsp;<label>Nama Produk</label><br>
		&emsp;<input type="text" size=100 name="nama">
	</div>
	<div class="form-group">
		&emsp;<label>Harga</label><br>
		&emsp;<input type="text" size="100" name="harga">
	</div>
	<div>
		&emsp;<img src="img/product/<?php echo $pecah['foto']; ?>" width="80">
	</div>
	<div class="form-group">
		&emsp;<label>Foto</label><br>
		&emsp;<input type="file" size="100" name="foto">
	</div>
	<div class="form-group">
		&emsp;<label>Deskripsi</label><br>
		&emsp;<textarea  name="deskripsi" rows="10" cols="100"></textarea>
	</div>
	&emsp;<button class="btn btn-warning" name="kirim">Simpan</button>
</form>
<?php
	include "koneksi.php";
	if (isset($_POST['kirim'])) {
		@$nama = $_POST['nama'];
		@$harga = $_POST['harga'];
		@$foto = $_POST['foto'];
		@$deskripsi = $_POST['deskripsi'];
		@$nama = $_FILES['foto']['name'];
		@$lokasi = $_FILES['foto']['tmp_name'];
		move_uploaded_file($lokasi, "img/product/".$nama);
		$koneksi->query("INSERT INTO tb_produk(nama,harga,foto,deskripsi)
		VALUES('$_POST[nama]','$_POST[harga]','$nama','$_POST[deskripsi]')");

		header('location:admin.php?page=produk');
	}
?>