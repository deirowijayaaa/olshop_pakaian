<?php 
session_start();
include "koneksi.php";
@$idpembelian = $_GET['id'];
$ambil = $koneksi->query("SELECT * FROM tb_pembelian WHERE id_pembelian = '$idpembelian'");
$detail = $ambil->fetch_assoc();

error_reporting(0);
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
                    <h1>Pembayaran</h1>
                </div>
            </div>
        </div>
    </section>

   <?php 
    $username = $_SESSION['username'];
    $ambil = $koneksi->query("SELECT * FROM tb_profile WHERE username='$username'");
    $pecah = $ambil->fetch_assoc();
    ?>
    <div class="container">
        <h2>Konfirmasi Pembayaran</h2>
        <div class="alert alert-info">Total Tagihan Anda <strong>Rp. <?php echo number_format($detail['totalbelanja']); ?></strong></div>

        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama Penyetor</label>
                <input type="text" class="form-control" name="nama" value="<?php echo $pecah['nama'] ?>" readonly="">
            </div>
            <div class="form-group">
                <label>Bank</label>
                <input type="text" class="form-control" name="bank" value="Mandiri" readonly="">
            </div>
            <div class="form-group">
                <label>Jumlah</label>
                <input type="text" class="form-control" name="jumlah" value="<?php echo $detail['totalbelanja'] ?>" readonly="">
            </div>
            <div class="form-group">
                <label>Bukti</label>
                <input type="file" class="form-control" name="bukti" required="">
            </div>
            <button class="btn btn-primary btn-xs" name="kirim">Kirim</button>
        </form>
    </div>

    <?php 

    if (isset($_POST['kirim'])) 
    {
        if ($detail['totalbelanja']!=$_POST['jumlah']) {
           
        }else{
        $namabukti = $_FILES["bukti"]["name"];
        $lokasibukti = $_FILES["bukti"]["tmp_name"];
        $namafiks = date("YmdHis").$namabukti;
        move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");

        $nama = $_POST['nama'];
        $bank = $_POST['bank'];
        $jumlah = $_POST['jumlah'];
        $tanggal = date("Y-m-d");

        $koneksi->query("INSERT INTO tb_pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti)
            VALUES('$idpembelian','$nama','$bank','$jumlah','$tanggal','$namafiks')");

        $koneksi->query("UPDATE tb_pembelian SET status = 'lunas' WHERE id_pembelian= '$idpembelian' ");

        $koneksi->query("UPDATE tb_keranjang SET proses='lunas' WHERE id_pembelian='$idpembelian'");

        $query="SELECT * FROM tb_keranjang WHERE id_pembelian='$idpembelian'";
        $hasil=mysqli_query($koneksi,$query);

        $totalstok=0;

        while ($data=mysqli_fetch_array($hasil)) {
            $id_produk=$data['id_produk'];
            $qty=$data['jumlah'];

            $query_barang="SELECT * FROM tb_produk WHERE id_produk='$id_produk'";
            $hasil_barang=mysqli_query($koneksi,$query_barang);
            $data_barang=mysqli_fetch_array($hasil_barang);

            $stok=$data_barang['stokbarang'];

            $totalstok=$stok-$qty;

            $koneksi->query("UPDATE tb_produk SET stokbarang='$totalstok' WHERE id_produk='$id_produk'");
        }

        echo "<script>alert('Terima Kasih');</script>";
        echo "<script>location='riwayat.php';</script>";
        }
    }

    ?>
        

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