<?php 
include "koneksi.php";
session_start();
$semua = array();
$tgl_mulai = "-";
$tgl_selesai = "-";
if (isset($_POST["kirim"])) 
{
	$tgl_mulai = $_POST["tglm"];
	$tgl_selesai = $_POST["tgls"];
	$ambil = $koneksi->query("SELECT * FROM tb_pembelian JOIN tb_profile ON tb_pembelian.username=tb_profile.username
		WHERE tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai' ");
		while ($laporan = $ambil->fetch_assoc())
	{
		$semua[] = $laporan;
	}
}

?>
<div class="container"><br>
	<h2>Laporan Pembelian Dari <?php echo $tgl_mulai ?> Hingga <?php echo $tgl_selesai ?></h2><br>
<form method="post">
	<div class="row">
		<div class="col-md-5">
			<div class="form-group">
				<label>Tanggal</label>
				<input type="date" class="form-control" name="tglm" value="<?php echo $tgl_mulai ?>">
			</div>
		</div>
		<div class="col-md-5">
			<div class="form-group">
				<label>Tanggal Selesai</label>
				<input type="date" class="form-control" name="tgls" value="<?php echo $tgl_selesai ?>">
			</div>
		</div>
		<div class="col-md-2">
			<label>&nbsp;</label><br>
			<button class="btn btn-sm btn-info m-1" name="kirim">Lihat</button>
		</div>
	</div>
</form>

<table class="table table-striped table-bordered mt-3">
	<thead>
		<tr align="center">
			<th>No</th>
			<th>Pelanggan</th>
			<th>Tanggal</th>
			<th>Total</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($semua as $key => $value): ?>
		<tr>
			<td align="center"><?php echo $key+1; ?></td>
			<td><?php echo $value["username"]; ?></td>
			<td><?php echo $value["tanggal"]; ?></td>
			<td>Rp. <?php echo number_format($value["totalbelanja"]); ?></td>
			<td><?php echo $value["status"];  ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
</div>