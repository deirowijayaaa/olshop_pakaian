
<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<style >
  body{
    background-image:url(img/banner/banner-bg.jpg); 
  }
</style>
<body>
<form method="post">
 
  <div class="container" style="margin-top: 100px;">
    <div class="row">
        <div class="col-md-6">
            <div class="cart">
    <?php
    session_start();
    include 'koneksi.php';
    $username=$_SESSION['username'];
    $query="SELECT * FROM tb_profile where username='$username'";
    $hasil=mysqli_query($koneksi,$query);
    $data=mysqli_fetch_array($hasil);
    $cek=mysqli_num_rows($hasil);
    ?>
 
   
        <h1 class="mb-3">PROFILE ANDA</h1>
    <br>
      <label for="inputAddress">Username</label>
      <input type="text" name="username" readonly class="form-control" id="inputAddress" value="<?php echo $_SESSION['username']; ?>" style="background-color: white">
    <br>
    <label for="inputAddress">Nama Lengkap</label>
    <input type="text" name="nama" class="form-control" id="inputAddress" placeholder="Nama Lengkap" value="<?php echo $data['nama'] ?>">
 
   <br>
    <label for="inputAddress">No Handphone</label>
    <input type="text" name="nomorhp" class="form-control" id="inputAddress" placeholder="No Handphone" value="<?= $data['nomorhp']?>">
   <br>
    <label for="inputAddress">Alamat</label>
    <input type="text" name="alamat" class="form-control" id="inputAddress" placeholder="Alamat" value="<?= $data['alamat']?>">
   <br>
  <button type="submit" name="submit" class="btn btn-primary btn-xs">Simpan</button>
  <a href="user.php" class="btn btn-primary btn-xs">Kembali</a>
 
</div>
        </div>
        <div class="col-md-6 text-center">
            <div class="cart"><img src="" style="width: 50%; margin-top: 100px;"></div>
        </div>
    </div>
   
</div>
</form>
</body>
</html>
<?php
echo $cek;
if ($cek==0) {
include 'koneksi.php';
  @$username=$_POST['username'];
  @$nama=$_POST['nama'];
  @$nomorhp=$_POST['nomorhp'];
  @$alamat=$_POST['alamat'];
 
  if (isset($_POST['submit'])) {
    $query3="INSERT INTO tb_profile VALUES ('$username', '$nama', '$nomorhp', '$alamat')";
    $result=mysqli_query($koneksi,$query3);
    header('location:profile.php');
  }
}else{
  @$username=$_POST['username'];
  @$nama=$_POST['nama'];
  @$nomorhp=$_POST['nomorhp'];
  @$alamat=$_POST['alamat'];
 
  if (isset($_POST['submit'])) {
        $query3="UPDATE tb_profile set nama='$nama',nomorhp='$nomorhp', alamat='$alamat'  where username='$username'";
    $result=mysqli_query($koneksi,$query3);
    echo "<script>alert('Data Tersimpan')</script>";
    echo "<script>location:'profile.php'</script>";
  }
   
}
?>