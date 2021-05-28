<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin Casual</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="">Casual Shoes</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" method="get" action="pencarian.php">
      <div class="input-group">
        <input type="text" name="keyword" autocomplete="off">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search" name="keyword" href="admin.php?page=pencarian"></i>
          </button>
        </div>
      </div>
    </form>

    <a href="logout.php" class="btn btn-danger btn-xs">Logout</a>

    <!-- Navbar -->

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="admin.php?page=home">
          <i class="fa fa-home"></i>
          <span>Dashboard</span>
        </a>
      </li>  
        
      <li class="nav-item active">
        <a class="nav-link" href="admin.php?page=produk">
          <i class="fa fa-cube"></i>
          <span>Data Barang</span>
        </a>
      </li>  
    
      <li class="nav-item active">
        <a class="nav-link" href="admin.php?page=pelanggan">
          <i class="fa fa-user"></i>
          <span>Pelanggan</span>
        </a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="admin.php?page=pembelian">
          <i class="fa fa-shopping-cart"></i>
          <span>Pembelian</span>
        </a>
      </li> 

      <li class="nav-item active">
        <a class="nav-link" href="admin.php?page=laporan">
          <i class="fa fa-file"></i>
          <span>Laporan</span>
        </a>
      </li> 
    </ul>

  <?php
    include "koneksi.php";
    if (isset($_GET['page'])) {
      if ($_GET['page']=="produk") {
        include "produk.php";
      }
      if ($_GET['page']=="pelanggan") {
        include "pelanggan.php";
      }
      if ($_GET['page']=="pembelian") {
        include "pembelian.php";
      }
      if ($_GET['page']=="detailpembelian") {
        include "detailpembelian.php";
      }
      if ($_GET['page']=="laporan") {
        include "laporan.php";
      }
      if ($_GET['page']=="bayar") {
        include "bayar.php";
      }
      if ($_GET['page']=="detail") {
        include "detail.php";
      }
      if ($_GET['page']=="tambah") {
        include "tambah.php";
      }
      if ($_GET['page']=="edit") {
        include "edit.php";
      }
      if ($_GET['page']=="hapus") {
        include "hapus.php";
      }
      if ($_GET['page']=="hapususer") {
        include "hapususer.php";
      }
      if ($_GET['page']=="keyword") {
        include "pencarian.php";
      }
      if ($_GET['page']=="kirim") {
        include "laporan.php";
      }
      

    }
  ?>
 

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>

</body>

</html>
