<?php
session_start();
if ($_SESSION['status'] != "login" || $_SESSION['level'] != "admin") {
  header("location:login?pesan=belum_login");
}
include "../conn.php";

$ambil = "SELECT * FROM tanggal";
$query = mysqli_query($conn, $ambil);
$assosiasi = mysqli_fetch_assoc($query);

if (isset($_POST['simpan'])) {
  $mulai = $_POST['awal'];
  $selesai = $_POST['akhir'];
  $a = mysqli_query($conn, "UPDATE tanggal SET mulai='$mulai', selesai='$selesai'");
  if ($a) {
    echo '<script>alert("Berhasil Mengubah data."); document.location="dashboard";</script>';
  } else {
    echo '<script>alert("Gagal Mengubah data.");</script>';
  }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="../vendor/images/ifsu.png" />

  <!-- my css -->
  <link rel="stylesheet" href="vendor/css/dashboard.css">

  <title>PKO Admin - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="vendor/css/sb-admin-2.min.css" rel="stylesheet">
  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard">
        <div class="sidebar-brand-icon">
          <i class="fab fa-product-hunt mt-2"> PKO</i>
        </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="dashboard">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Nav Item - Sesi -->
      <li class="nav-item">
        <a class="nav-link" href="data_sesi">
          <i class="fas fa-fw fa-clock"></i>
          <span>Sesi</span></a>
      </li>

      <!-- Nav Item - Siswa -->
      <li class="nav-item">
        <a class="nav-link" href="data_siswa">
          <i class="fas fa-fw fa-user-injured"></i>
          <span>Siswa</span></a>
      </li>

      <!-- Nav Item - Guru -->
      <li class="nav-item">
        <a class="nav-link" href="data_guru">
          <i class="fas fa-fw fa-user-graduate"></i>
          <span>Guru</span></a>
      </li>

      <!-- Nav Item - Paslon -->
      <li class="nav-item">
        <a class="nav-link" href="data_paslon">
          <i class="fas fa-fw fa-user"></i>
          <span>Paslon</span></a>
      </li>

      <!-- Nav Item - Hasil -->
      <li class="nav-item">
        <a class="nav-link" href="hasil">
          <i class="fas fa-fw fa-poll"></i>
          <span>Hasil</span></a>
      </li>

      <!-- Nav Item - Laporan -->
      <li class="nav-item">
        <a class="nav-link" href="laporan">
          <i class="fas fa-fw fa-print"></i>
          <span>Laporan</span></a>
      </li>

      <!-- Nav Item - Log out -->
      <li class="nav-item">
        <a class="nav-link" href="logout.php">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Log out</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle mr-2 mt-1"></i>
                <span class="mt-2 mr-2 mb-1 d-none d-lg-inline text-gray-600"><?= ucfirst($_SESSION['nama']); ?></span>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex justify-content-between mb-4">
            <h5 class="ml10 mb-0 text-gray-800">
              <span class="text-wrapper">
                <span class="letters">Selamat Datang Di Dashboard <?= ucfirst($_SESSION['nama']); ?></span>
              </span>
            </h5>
          </div>


          <!-- Page Heading -->
          <div class="d-sm-flex align-items-left justify-content-left mb-4">
            <h4 class="m-0 font-weight-bold text-primary">Tanggal Mulai</h4>
          </div>

          <!-- DataTales Date -->
          <div class="row">
            <div class="col-6">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-gray">-Format penulisan:"<b class="text-info"> tanggal:bulan:tahun </b>"</h6>
                  <p class="m-0 font-weight-bold text-gray">-Contoh:"<b class="text-info"> 10:12:2020 </b>"</p>
                </div>
                <div class="card-body">
                  <form action="" method="post">
                    <div class="form-group row">
                      <label for="awal" class="col-sm-2 col-form-label">awal</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" required id="awal" placeholder="awal" name="awal" autocomplete="off" value="<?php echo mysqli_real_escape_string($conn, $assosiasi['mulai']); ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="akhir" class="col-sm-2 col-form-label">akhir</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" required id="akhir" placeholder="akhir" name="akhir" autocomplete="off" value="<?php echo mysqli_real_escape_string($conn, $assosiasi['selesai']); ?>">
                      </div>
                    </div>
                    <div class="form-group row float-right">
                      <div class="col-sm-12 mt-2">
                        <button type="submit" class="btn btn-primary mx-1" name="simpan">Ubah</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>


          <!-- /.container-fluid -->
        </div>


        <!-- End of Main Content -->
      </div>
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; pemiluIfsu <?= date('Y'); ?></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>


  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Bener Yeuh?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Pencet Logout Mun Bener Ek Kaluar</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="vendor/anime-master/lib/anime.min.js"></script>

  <script>
    // Wrap every letter in a span
    var textWrapper = document.querySelector('.ml10 .letters');
    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

    anime.timeline({
        loop: true
      })
      .add({
        targets: '.ml10 .letter',
        rotateY: [-90, 0],
        duration: 1300,
        delay: (el, i) => 45 * i
      }).add({
        targets: '.ml10',
        opacity: 0,
        duration: 1300,
        easing: "easeOutExpo",
        delay: 2000
      });
  </script>

  <!-- Custom scripts for all pages-->
  <script src="vendor/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/js/Chart.bundle.js"></script>

</body>

</html>