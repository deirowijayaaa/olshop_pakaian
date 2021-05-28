

<?php
include "koneksi.php";
$ambil = $koneksi->query("SELECT * FROM tb_produk WHERE id_produk='$_GET[id_produk]'");
$pecah = $ambil->fetch_assoc();
?>


<form method="post" enctype="multypart/form-data" action="proses_edit.php">
	<h2>Ubah Produk</h2><br>
	<div class="form-group">
		<input type="hidden" name="txt_id" class="form-control" value="<?php echo $pecah['id_produk']; ?>">
		&emsp;<label>Nama Produk</label><br>
		&emsp;<input type="text" name="nama" size="100" value="<?php echo $pecah['nama']; ?>">
	</div>
	<div class="form-group">
		&emsp;<label>Harga</label><br>
		&emsp;<input type="text" name="harga" size="100" value="<?php echo $pecah['harga']; ?>">
	</div>
	<div class="form-group">
		&emsp;<img src="img/product/<?php echo $pecah['foto']; ?>" width="80">
	</div>
	<div class="form-group">
		&emsp;<label>Foto</label><br>
		&emsp;<input type="file" name="foto" size="100">
	</div>
	<div class="form-group">
		&emsp;<label>Deskripsi</label><br>
		&emsp;<textarea name="deskripsi" cols="100" rows="3">
			<?php echo $pecah['deskripsi']; ?>
		</textarea>
	</div>
	&emsp;<button class="btn btn-primary" name="kirim">Ubah</button>
</form>

