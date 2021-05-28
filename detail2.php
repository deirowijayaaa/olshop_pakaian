<?php session_start(); ?>
<?php error_reporting(0); ?>
<?php include 'koneksi.php'; ?>
<?php
$id = $_GET["id_produk"];
$ambil = $koneksi->query("SELECT * FROM tb_produk WHERE id_produk='$id'");
$detail = $ambil->fetch_assoc();

$ambil=$koneksi->query("SELECT * FROM tb_profile");
$em=$ambil->fetch_assoc();

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

<body id="category">

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
							<li class="nav-item active"><a class="nav-link" href="shop.php">Shop</a></li>
							<li class="nav-item"><a class="nav-link" href="keranjang.php">Keranjang</a></li>
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
	<form method="POST" >
		<div class="search_input" id="search_input_box">
			<div class="container">
				<form class="d-flex justify-content-between">
					<input type="text" class="form-control" name="keyword" id="search_input" placeholder="Search Here">
					<button type="submit" class="btn"></button>
					<span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
				</form>
			</div>
		</div>
	</form>
	</header>
	<!-- End Header Area -->

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Belanja </h1>
				</div>
			</div>
		</div>
	</section>
<link rel="stylesheet" href="css/bootstrap.css">
<section class="konten">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<img src="img/product/<?php echo $detail['foto']; ?>" width="400">
			</div>
			<div class="col-md-6"><br><br><br>
				<h2><?php echo $detail["nama"]; ?></h2>
				<h3>Rp. <?php echo number_format($detail["harga"]); ?></h4>
				<h4>Stok Barang : <?php echo $detail['stokbarang']; ?></h4>
				<form method="post">
					<div class="form-group">
						<div class="input-group">
							<input type="number" min="1" class="form-control" name="jumlah" 
							max="<?php echo $detail['stokbarang']; ?>">
							<div>
								<button class="btn btn btn-primary" name="beli">Beli</button>
							</div>
						</div>
					</div> 
				</form>

				<?php
				if (isset($_POST["beli"])) {
						
						$id = $_GET["id_produk"];
						$jumlah = $_POST["jumlah"];
						
						$username = $_SESSION["username"];
						$nama=$detail['nama'];
						$harga=$detail['harga'];
						
						$data = $koneksi->query("SELECT * FROM tb_keranjang WHERE username='$username' 
							AND id_produk='$id' AND proses='keranjang'");
    
						$jum = mysqli_num_rows($data);

							
							if ($jum==1) {
							
								$koneksi->query("UPDATE tb_keranjang SET jumlah='$jumlah' 
									WHERE username='$username' AND id_produk='$id'");
									echo "<script>location='keranjang2.php';</script>";
								
							}
							else {
							
								$koneksi->query("INSERT INTO tb_keranjang (username,id_produk,jumlah) 
									VALUES ('$username','$id','$jumlah')");
									echo "<script>location='keranjang2.php';</script>";
								
							}
					}
				?>
				<p><?php echo $detail["deskripsi"]; ?></p>
			</div>
		</div>
	</div>
</section>

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