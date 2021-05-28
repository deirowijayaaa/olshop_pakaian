<?php 
session_start();
include "koneksi.php";
error_reporting(0);
if(!isset($_SESSION['username']) and !isset($_SESSION['level'])){
  echo "<script>alert('Silahkan login dulu!');</script>";
  echo "<script>location='login.html';</script>";
  exit;
}
if (empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"])) {
  echo "<script>alert('Checkout kosong, Silahkan masukkan produk dalam keranjang belanja dulu!');</script>";
  echo "<script>location='user.php';</script>";
}
else if($_SESSION['level']!=="user"){
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
              <li class="nav-item active"><a class="nav-link" href="keranjang.php">Keranjang</a></li>
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
                    <h1>Keranjang Belanja</h1>
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
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $nomor=1; ?>
                  <?php foreach (@$_SESSION['keranjang'] as $id => $jumlah) { ?> 
                  <?php 
                    $ambil = $koneksi->query("SELECT * FROM tb_produk WHERE id_produk ='$id'");
                    $pecah = $ambil->fetch_assoc();
                    $subtotal = $pecah["harga"] * $jumlah;

                   ?>                            
                  
                  <tr>
                      <td><?php echo $nomor ?></td>
                      <td><?php echo $pecah['nama']; ?></td>
                      <td><?php echo $pecah['harga']; ?></td>
                      <td><?php echo $jumlah; ?></td>
                      <td><?php echo $subtotal; ?></td>
                      <td>
                            <a href="hapus_keranjang.php?id_produk=<?php echo $pecah['id_produk']; ?>" 
                            onclick="return confirm('Apakah anda yakin')"
                            class="btn btn-sm btn-danger m-1">Hapus</a>
                      </td>
                  </tr>
                  <?php $nomor++; ?>
                  <?php } ?>
                  
              </tbody>
            </table>

            <a href="shop.php"     class="btn btn-sm btn-secondary m-1">Lanjutkan Belanja</a>
            <a href="checkout.php" class="btn btn-sm btn-primary m-1">Checkout</a>
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