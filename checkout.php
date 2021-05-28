<?php 
include "koneksi.php";
session_start();
if(!isset($_SESSION['username']) and !isset($_SESSION['level'])){
    header('location:login.html');
    exit;
}else if($_SESSION['level']!=="user"){
    echo "ANDA TIDAK BERHAK MENGAKSES !";
    exit;
}
?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="CodePixar">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Casual Shoes</title>

    <!--
            CSS
            ============================================= -->
    <link rel="stylesheet" href="css/linearicons.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/nouislider.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>

    <!-- Start Header Area -->
	<header class="header_area sticky-header">
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light main_box">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<a class="navbar-brand logo_h" href="user.php"><img src="img/fav.png" alt=""></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item"><a class="nav-link" href="user.php">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="shop.php">Shop</a></li>
                            <li class="nav-item"><a class="nav-link" href="keranjang2.php">Keranjang</a></li>
                            <li class="nav-item active"><a class="nav-link" href="checkout.php">Checkout</a></li>
                            <div class=" mx-3 mt-2 dropdown">
                                <a href="" data-toggle="dropdown">
                                    <i class="fa fa-user ml-2"></i>
                                </a>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="profile.php">Profile</a>
                                    <a class="dropdown-item" href="logout.php">Logout</a>
                                </div>
                            </div>
                        </ul>
                    </div>
				</div>
			</nav>
		</div>
		<div class="search_input" id="search_input_box">
			<div class="container">
				<form class="d-flex justify-content-between">
					<input type="text" class="form-control" id="search_input" placeholder="Search Here">
					<button type="submit" class="btn"></button>
					<span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
				</form>
			</div>
		</div>
	</header>
	<!-- End Header Area -->

    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Checkout</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Cart Area =================-->

    
    <section class="konten">
        <div class="container">
            <hr>
            <table class="table table-bordered">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Produk</th>
                      <th>Harga</th>
                      <th>Jumlah</th>
                      <th>SubTotal</th>
                    
                  </tr>
              </thead>
              <tbody>
                  <?php $nomor=1; ?>
                  <?php $total=0; ?>
                  <?php $username=$_SESSION["username"]; ?>
                  <?php $ambil=$koneksi->query("SELECT * FROM tb_keranjang WHERE username='$username' AND proses='keranjang'"); ?>
                   <?php $ambil2=$koneksi->query("SELECT * FROM tb_keranjang WHERE username='$username' AND proses='keranjang'"); ?>
                   <?php $cek=mysqli_num_rows($ambil2); ?>
                   <?php if ($cek==0) {
                        ?>
                        <script type="text/javascript">document.location.href="keranjang2.php";</script>
                        <?php
                   } ?>
                  <?php while($pecah=$ambil->fetch_assoc()) { ?>
          
                  <?php
                  $id_produk = $pecah["id_produk"];
                  $am = $koneksi->query("SELECT * FROM tb_produk WHERE id_produk='$id_produk'");
                  $perproduk = $am->fetch_assoc();
                  $id_keranjang = $pecah["id_keranjang"];
                  $jumlah = $pecah["jumlah"];
                  $subtotal = $perproduk["harga"]*$jumlah;
                  ?>
          <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $perproduk["nama"]; ?></td>
            <td>Rp. <?php echo number_format($perproduk["harga"]); ?></td>
            <td><?php echo $jumlah; ?></td>
            <td>Rp. <?php echo number_format($subtotal); ?></td>
            
          </tr>
          <?php 
          $total+=$subtotal;
           ?>
          <?php $nomor++; ?>
          <?php } ?>
            <tr>
                <td colspan="4" align="center">Total</td>
                <td>Rp. <?php echo number_format($total) ?></td>
            </tr>        
              </tbody>
            </table>

           

            <?php
            $username=$_SESSION["username"]; 
            $ambil = $koneksi->query("SELECT * FROM tb_profile WHERE username='$username'"); 
            $value = $ambil->fetch_assoc();
            ?>
            <form method="post" enctype="multypart/form-data">
                <h3>PEMESAN</h3>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-control">
                            <label><?php echo $value['nama']; ?></label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-control">
                            <label><?php echo $value['nomorhp']; ?></label><br>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" name="id_ongkir"><br>
                            <option value="">Pilih Ongkos Kirim</option>
                            <?php
                            $ambil = $koneksi->query("SELECT * FROM tb_ongkir");
                            while ($ongkir = $ambil->fetch_assoc()){
                            ?>
                            <option value="<?php echo $ongkir['id_ongkir'] ?>">
                                <?php echo $ongkir['kota'] ?> -
                                Rp <?php echo number_format($ongkir['tarif']) ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <textarea class="form-control" readonly=""><?php echo $value['alamat']; ?></textarea>
                </div>
                
                <a href="keranjang2.php" class="btn btn-sm btn-secondary m-1">Kembali</a>
                <button class="btn btn-sm btn-info m-1" name="kirim">Lanjutkan</button>
                <br>
            </form>
            <?php 
                if (isset($_POST['kirim'])) 
                {
                    $ambil = $koneksi->query("SELECT * FROM tb_profile"); 
                    $pecah = $ambil->fetch_assoc();

                    $username = $_SESSION['username'];
                    $id_ongkir = $_POST['id_ongkir'];
                    $tanggal = date("Y-m-d");

                    $ambil = $koneksi->query("SELECT * FROM tb_ongkir WHERE id_ongkir='$id_ongkir'"); 
                    $arrayongkir = $ambil->fetch_assoc();
                    $tarif = $arrayongkir['tarif'];

                    $totalbelanja = $total+$tarif;

                    $koneksi->query("INSERT INTO tb_pembelian(username,id_ongkir,tanggal,totalbelanja) 
                                    VALUES('$username','$id_ongkir','$tanggal','$totalbelanja')");

                    $id_pembelianbaru = $koneksi->insert_id;

                    $query_update="UPDATE tb_keranjang SET id_pembelian='$id_pembelianbaru',proses='pending' WHERE username='$username' AND proses='keranjang'";
                    $hasil_update=mysqli_query($koneksi,$query_update);

                    if($hasil_update){
                         echo "<script>location='nota.php?id=$id_pembelianbaru';</script>";
                     }else{
                        echo "GAGAl";
                     }


                    /*
                  foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) 
                    {
                        $ambil=$koneksi->query("SELECT * FROM tb_produk WHERE id_produk='$id_produk'");
                        $per=$ambil->fetch_assoc();

                        $nama = $per['nama'];
                        $harga = $per['harga'];

                        $subharga = $per['harga']*$jumlah;

                        $koneksi->query("INSERT INTO tb_checkout (id_pembelian,id_produk,jumlah,nama,harga,subharga) 
                            VALUES ('$id_pembelianbaru','$id_produk','$jumlah','$nama','$harga','$subharga')");

                        $koneksi->query("UPDATE tb_produk SET stokbarang=stokbarang - $jumlah 
                            WHERE id_produk='$id_produk'");
                    }

                    unset($_SESSION["keranjang"]);
                    */
                   
            
                }
            ?>
        </div>
    </section>
    <!--================End Cart Area =================-->

    <!-- start footer Area -->
    
    <!-- End footer Area -->

    <script src="js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
	 crossorigin="anonymous"></script>
	<script src="js/vendor/bootstrap.min.js"></script>
	<script src="js/jquery.ajaxchimp.min.js"></script>
	<script src="js/jquery.nice-select.min.js"></script>
	<script src="js/jquery.sticky.js"></script>
    <script src="js/nouislider.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="js/gmaps.min.js"></script>
	<script src="js/main.js"></script>
</body>

</html>