<?php error_reporting(0); ?>
<div class="container"><br>	
<h2>Data Pembayaran</h2>	
<div class="row">
    <div class="col-md-12">
<table class="table table-bordered">
        <?php $id=$_GET['id_pembelian']; ?>
        <?php $ambil=$koneksi->query("SELECT * FROM tb_pembayaran WHERE id_pembelian='$id'");?>
        <?php $pecah=$ambil->fetch_assoc();?>
        <?php $ambil=$koneksi->query("SELECT * FROM tb_pembelian WHERE id_pembelian='$id'"); ?>
        <?php $status=$ambil->fetch_assoc(); ?>
    <thead>
        <tr>
            <th>Nama</th>
            <td><?php echo $pecah['nama']; ?></td>
        </tr>
        <tr>
            <th>Bank</th>
            <td><?php echo $pecah['bank']; ?></td>
        </tr>
        <tr>   
            <th>Total</th>
            <td>Rp. <?php echo number_format($pecah['jumlah']); ?></td>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td><?php echo $pecah['tanggal']; ?></td>
        </tr>
        <tr>	
        	<th>Bukti Foto</th>
        	<td align="center">
				<img src="bukti_pembayaran/<?php echo $pecah['bukti']; ?>" width="80">
			</td>
		</tr>
    </thead>
</table>
		<a href="proseskirim.php?id_pembelian=<?php echo $id ?>" class="btn btn-sm btn-success m-1">Kirim</a>
		<a href="admin.php?page=pembelian" class="btn btn-sm btn-info m-1">Kembali</a>
</div>
<?php if ($_GET['pesan']=="berhasil"): ?>	
<div class="container" align="center"><div class="alert alert-success">Barang Dikirim</div></div>
<?php elseif ($status['status']=="Barang Dikirim"): ?>
<div class="container" align="center"><div class="alert alert-success">Barang Dikirim</div></div>
<?php endif ?>

    