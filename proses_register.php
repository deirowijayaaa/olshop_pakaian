<?php
//endskripsi md5
include "koneksi.php";
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$ulang_pass = $_POST['ulang_pass'];
$level = "user";
@$kirim = $_POST['kirim'];
//acak password
$pengacak = 'p3ng4c4k';
$password_acak = md5($pengacak.md5($password).$pengacak);
if($password==$ulang_pass){
	if($kirim){
		$query = "INSERT INTO tb_user VALUES ('$username','$email','$password_acak','$level')";
		$hasil = mysqli_query($koneksi,$query);
		header("location:login.html");
	}else{	
		header("location:register.html?pesan=gagal");
	}
}else{
	header("location:register.html?pesan=gagal");
}
?>