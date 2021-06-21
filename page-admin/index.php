<?php
session_start();
if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] == "gagal") {
        $gagal = "Login gagal! username atau password salah!";
    } else if ($_GET['pesan'] == "logout") {
        $logout = "Anda telah berhasil logout";
    } else if ($_GET['pesan'] == "belum_login") {
        $harus = "Anda harus login untuk mengakses halaman admin";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PKO Admin - Login</title>
    <link rel="stylesheet" href="vendor/css/login.css">
    <link rel="shortcut icon" href="../vendor/images/ifsu.png" />
</head>

<body onload="init()">
    <div class="wrapper">
        <div class="container">
            <h1 class="textz">Selamat Datang</h1>
            <!-- pesan saat login gagal -->
            <?php if (isset($gagal)) {
                echo "$gagal";
            } ?>
            <!-- pesan saat berhasil logout -->
            <?php if (isset($logout)) {
                echo "$logout";
            }  ?>
            <!-- pesan saat mencoba masuk tanpa login-->
            <?php if (isset($harus)) {
                echo "$harus";
            }  ?>
            <form class="form" action="cek_login" method="POST">
                <input type="text" placeholder="Username" name="nama" autocomplete="off" class="shadowz">
                <input type="password" placeholder="Password" name="password" autocomplete="off" class="shadowz">
                <button type="submit" id="login-button" name="login" class="shadowz">Login</button>
            </form>
        </div>
        <ul class="bg-bubbles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
        <div class="pengembang">&copy; <span class="text">pemiluIfsu2020</span></div>
    </div>
</body>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/js/demo/eternal.js"></script>

</html>