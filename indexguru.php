<?php
session_start();
include "conn.php";
if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] == "gagal") {
        echo "<script>alert('Login gagal! username dan password salah!');</script>";
    } else if ($_GET['pesan'] == "logout") {
        echo "<script>alert('Anda telah berhasil logout');</script>";
    } else if ($_GET['pesan'] == "belum_login") {
        echo "<script>alert('Anda harus login untuk memilih');</script>";
    }
}


// lamun dipencet
if (isset($_POST['login'])) {
    // menangkap data yang dikirim dari form
    $nama = trim(mysqli_real_escape_string($conn, $_POST['nama']));
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    // menyeleksi data admin dengan username dan password yang sesuai
    $data2 = mysqli_query($conn, "SELECT * from guru where nama='$nama' and password='$password'");

    // menghitung jumlah data yang ditemukan
    $cek_guru = mysqli_num_rows($data2);
    if ($cek_guru > 0) {
        $assosiasi = mysqli_fetch_assoc($data2);
        $_SESSION['id'] = $assosiasi['id'];
        $_SESSION['username'] = $username;
        $_SESSION['level'] = "guru";
        $_SESSION['status'] = "login";
        header("location:halaman_pilih");
    } else {
        header("location:halaman_guru?pesan=gagal");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PKO - Login Guru</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/css/style_login.css">
    <link rel="shortcut icon" href="vendor/images/ifsu.png" />
</head>

<body>
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <div class="card shadow login-card">
                <div class="row no-gutters">
                    <div class="col-md-5">
                        <img src="vendor/images/bg5.jpg" alt="login" class="login-card-img">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <div class="brand-wrapper d-flex align-items-center justify-content-center">
                                <img src="vendor/images/ifsu.png" alt="logo" class="logo">
                            </div>
                            <div class="brand-wrapper d-flex align-items-center justify-content-center" style="text-align: center;">
                                PEMILIHAN KETUA OSIS <br> SMK INFORMATIKA SUMEDANG
                            </div>
                            <p class="login-card-description d-flex justify-content-center">silahkan login</p>
                            <div class="container-fluid d-flex justify-content-center">
                                <form action="" method="post" style="width: 100%;">
                                    <div class="form-group">
                                        <label for="NISN" class="sr-only">NAMA :</label>
                                        <input type="text" name="nama" id="email" class="form-control" placeholder="Masukkan Nama Anda !" autocomplete="off">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="password" class="sr-only">PASSWORD :</label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password Anda !" autocomplete="off">
                                    </div>
                                    <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Login">
                                </form>
                            </div>
                            <p class="forgot-password-link d-flex justify-content-center"">Powered By :</p>
                        <div class=" brand-wrapper d-flex justify-content-center"" style="padding: 10px 20% 0px 20%;">
                                <img src="vendor/images/osis.jpg" alt="logo" class="logo">
                                <img src="vendor/images/mpk.jpg" alt="logo" class="logo" style="margin:0 10px 0 10px;">
                                <img src="vendor/images/icso.png" alt="logo" class="logo">
                        </div>
                        <nav class="login-card-footer-nav d-flex justify-content-center">
                            <a href="https://www.smkifsu.sch.id/">&copy; copyright PemiluIfsu<?= date('Y'); ?></a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</html>