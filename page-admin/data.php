<?php
session_start();
// menangkap data yang dikirim dari form
$nama         = $_POST['nama'];
$pass         = $_POST['password'];
if ($nama == 'yariwara' and $pass == 'yariwara') {
    $_SESSION['nama'] = $nama;
    $_SESSION['status'] = "login";
    $_SESSION['level'] = "admin";
    header("location:dashboard");
} else {
    header("location:login?pesan=gagal");
}
