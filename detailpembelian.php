    <?php include "koneksi.php"; ?>
      <div class="container">
            

                <?php 
                    $ambil = $koneksi->query("SELECT * FROM tb_pembelian WHERE id_pembelian='$_GET[id_pembelian]'");
                    $detail = $ambil->fetch_assoc();

                    $ambil = $koneksi->query("SELECT * FROM tb_profile");
                    $pecah = $ambil->fetch_assoc();

                    $ambil = $koneksi->query("SELECT * FROM tb_user");
                    $value = $ambil->fetch_assoc();

                    $ambil = $koneksi->query("SELECT * FROM tb_ongkir");
                    $ongkir = $ambil->fetch_assoc();

                ?>
            <br>
            <div class="row">
                <div class="col-md-3 vl">
                    <h4>DATA PEMBELIAN</h4>
                    <strong>No. Pembelian: <?php echo $detail['id_pembelian']; ?></strong> <br>
                    Tanggal: <?php echo $detail['tanggal']; ?> <br>
                    Total: Rp. <?php echo number_format($detail['totalbelanja']); ?>
                </div>
                <div class="col-md-3 vl">
                    <h4>PEMBELI</h4>
                    <strong><?php echo $pecah['nama']; ?></strong> <br>
                    <p>
                        <?php echo $pecah['nomorhp']; ?> <br>
                        <?php echo $value['email']; ?>
                    </p>
                </div>
                <div class="col-md-3 vl">
                    <h4>PENGIRIMAN</h4>
                    <strong><?php echo $ongkir['kota']; ?></strong> <br>
                    Ongkos Kirim: Rp. <?php echo number_format($ongkir['tarif']); ?> <br>
                    Alamat: <?php echo $pecah['alamat']; ?>
                </div>
            </div>

            <table class="table table-bordered table-responsive-md" style="margin-top: 50px;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $id=$_GET['id_pembelian']; ?>
                    <?php $nomor=1; ?>
                    <?php $ambil=$koneksi->query("SELECT * FROM tb_keranjang WHERE id_pembelian='$id'"); ?>
                    <?php while($beli=$ambil->fetch_assoc()) {
                        $id_produk=$beli['id_produk'];

                        $query="SELECT * FROM tb_produk WHERE id_produk='$id_produk'";
                        $hasil=mysqli_query($koneksi,$query);
                        $data=mysqli_fetch_array($hasil);

                        $subharga=$beli['jumlah']*$data['harga'];

                     ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $data['nama']; ?></td>
                        <td>Rp. <?php echo number_format($data['harga']); ?></td>
                        <td><?php echo $beli['jumlah']; ?></td>
                        <td>Rp. <?php echo number_format($subharga); ?></td>
                    </tr>
                      <?php $nomor++; ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>