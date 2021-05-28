<?php session_start(); ?>
<div class="container"><br>
	<h2 align="center">Data Pembelian Pelanggan</h2><br>
<table class="table table-striped table-bordered">
	<thead class="thead-dark">
		<tr>
			<th>No</th>
			<th>Pelanggan</th>
			<th>Tanggal</th>
			<th>Status</th>
			<th>Total</th>
			<th>Aksi</th>
		</tr>
	</thead>
</div>
	<tbody>
		<?php $nomor = 1; ?>
		<?php $ambil = $koneksi->query("SELECT * FROM tb_pembelian as a JOIN tb_profile as b ON a.username=b.username ") ?>
		<?php while($detail = $ambil->fetch_assoc()){ ?>
			<tr>
				<td><?php echo $nomor; ?></td>
				<td><?php echo $detail['nama']; ?></td>
				<td><?php echo $detail['tanggal']; ?></td>
				<td><?php echo $detail['status']; ?></td>
				<td>Rp. <?php echo number_format($detail['totalbelanja']); ?></td>
				<td>
					<a href="admin.php?page=detailpembelian&id_pembelian=<?php echo $detail['id_pembelian']; ?>" 
						class="btn btn-sm btn-info m-1">Detail</a>
					<?php if ($detail['status']=="lunas"): ?>
					<a href="admin.php?page=bayar&id_pembelian=<?php echo $detail['id_pembelian']; ?>"
						class="btn btn-sm btn-success m-1">Bukti</a>
					<?php elseif ($detail['status']=="Barang Dikirim"): ?>
					<a href="admin.php?page=bayar&id_pembelian=<?php echo $detail['id_pembelian']; ?>"
						class="btn btn-sm btn-success m-1">Bukti</a>
					<?php endif ?>
				</td>
			</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>