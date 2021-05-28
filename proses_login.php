<?php
session_start();
include "koneksi.php";
//menangkap data dari form login
$username = $_POST['username'];
$password = $_POST['password'];
$kirim = $_POST['kirim'];
//acak password
$pengacak = 'p3ng4c4k';
$password_acak = md5($pengacak . md5($password) . $pengacak);

$query = "SELECT*FROM tb_user WHERE username='$username' and password='$password_acak'";
$hasil = mysqli_query($koneksi, $query);

$cek = mysqli_num_rows($hasil);

if ($cek > 0) {
    $data = mysqli_fetch_array($hasil);
    if ($data['level'] == "admin") {
        $_SESSION['username'] = $username;
        $_SESSION['level'] = "admin";
        header("location:admin.php?page=produk");
    } else if ($data['level'] = "user") {
        $_SESSION['username'] = $username;
        $_SESSION['level'] = "user";
        header("location:user.php");
    } else {
        header("location:login.html?pesan=gagal");
    }
} else {
    header("location:login.html?pesan=gagal");
}
