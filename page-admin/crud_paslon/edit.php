<?php
session_start();
if ($_SESSION['status'] != "login" || $_SESSION['level'] != "admin") {
    header("location:../login?pesan=belum_login");
}

include "../../conn.php";
$id = mysqli_real_escape_string($conn, $_GET['id']);
$data = mysqli_query($conn, "SELECT * from paslon where id='$id'");
if (isset($_POST['simpan'])) {

    // pindah upload gambar
    $nama = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    move_uploaded_file($file_tmp, '../vendor/img/' . $nama);
    // update isi
    $id = addslashes($_POST['id']);
    $nopas = addslashes($_POST['no_paslon']);
    $ketua = addslashes($_POST['ketua']);
    $wk1 = addslashes($_POST['wk1']);
    $wk2 = addslashes($_POST['wk2']);
    $visi = addslashes($_POST['visi']);
    $misi = addslashes($_POST['misi']);
    $program = addslashes($_POST['program']);
    $gambar = addslashes($nama);
    $sql = mysqli_query($conn, "UPDATE paslon SET no_paslon='$nopas', ketua='$ketua', wk1='$wk1', wk2='$wk2', visi='$visi', misi='$misi' , program='$program' , gambar='$gambar' where id='$id'");
    if ($sql) {
        echo '<script>alert("Berhasil menambahkan data."); document.location="../data_paslon";</script>';
    } else {
        echo '<script>alert("Gagal melakukan proses tambah data.");</script>';
    }
}


?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../vendor/images/ifsu.png" />

    <title>PKO Admin - Edit Palon</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../vendor/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../dashboard">
                <div class="sidebar-brand-icon">
                    <i class="fab fa-product-hunt mt-2"> PKO</i>
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="../dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Nav Item - Sesi -->
            <li class="nav-item">
                <a class="nav-link" href="../data_sesi">
                    <i class="fas fa-fw fa-clock"></i>
                    <span>Sesi</span></a>
            </li>

            <!-- Nav Item - Siswa -->
            <li class="nav-item">
                <a class="nav-link" href="../data_siswa">
                    <i class="fas fa-fw fa-user-injured"></i>
                    <span>Siswa</span></a>
            </li>

            <!-- Nav Item - Guru -->
            <li class="nav-item">
                <a class="nav-link" href="../data_guru">
                    <i class="fas fa-fw fa-user-graduate"></i>
                    <span>Guru</span></a>
            </li>

            <!-- Nav Item - Paslon -->
            <li class="nav-item active">
                <a class="nav-link" href="../data_paslon">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Paslon</span></a>
            </li>

            <!-- Nav Item - Hasil -->
            <li class="nav-item">
                <a class="nav-link" href="../hasil">
                    <i class="fas fa-fw fa-poll"></i>
                    <span>Hasil</span></a>
            </li>

            <!-- Nav Item - Laporan -->
            <li class="nav-item">
                <a class="nav-link" href="../laporan">
                    <i class="fas fa-fw fa-print"></i>
                    <span>Laporan</span></a>
            </li>

            <!-- Nav Item - Log out -->
            <li class="nav-item">
                <a class="nav-link" href="../logout.php">
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
                    <div class="d-sm-flex align-items-center justify-content-center mb-4">
                        <h4 class="m-0 font-weight-bold text-primary align-items-center">Edit Data Paslon</h4>
                    </div>
                    <!-- DataTales String Pass -->
                    <div class="card shadow mb-4" id="stringpass">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary align-items-center">Data</h6>
                        </div>
                        <div class="card-body">
                            <?php while ($d = mysqli_fetch_assoc($data)) { ?>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="form-group row" hidden>
                                        <label for="id" class="col-sm-2 col-form-label">Id</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" required id="id" name="id" value="<?php echo mysqli_real_escape_string($conn, $d['id']); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="no_paslon" class="col-sm-2 col-form-label">No Paslon</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" required id="no_paslon" name="no_paslon" value="<?php echo mysqli_real_escape_string($conn, $d['no_paslon']); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="ketua" class="col-sm-2 col-form-label">Ketua</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" required id="ketua" name="ketua" value="<?php echo mysqli_real_escape_string($conn, $d['ketua']); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="wk1" class="col-sm-2 col-form-label">wakil 1</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" required id="wk1" name="wk1" value="<?php echo mysqli_real_escape_string($conn, $d['wk1']); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="wk2" class="col-sm-2 col-form-label">wakil 2</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" required id="wk2" name="wk2" value="<?php echo mysqli_real_escape_string($conn, $d['wk2']); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="visi" class="col-sm-2 col-form-label">Visi</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" required id="visi" name="visi" aria-label="With textarea"><?php echo mysqli_real_escape_string($conn, $d['visi']); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="misi" class="col-sm-2 col-form-label">Misi</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" required id="misi" name="misi" aria-label="With textarea"><?php echo mysqli_real_escape_string($conn, $d['misi']); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="program" class="col-sm-2 col-form-label">Program</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" required id="program" name="program" aria-label="With textarea"><?php echo mysqli_real_escape_string($conn, $d['program']); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="file" class="col-sm-2 col-form-label">Gambar</label>
                                        <div class="col-md-2">
                                            <img src="../vendor/img/<?php echo mysqli_real_escape_string($conn, $d['gambar']); ?>" class="card-img" alt="gambar">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="float-left my-4 mx-2">
                                                <div class="col-md-2">
                                                    <label id="file" class="btn btn-outline-secondary btn-sm">
                                                        <input type="file" style="display: none;" for="file" name="file">Upload</input>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row float-right">
                                        <div class="col-sm-12 mt-2">
                                            <button type="submit" class="btn btn-primary mx-1" name="simpan">Ubah</button>
                                            <a href="../data_paslon" class="btn btn-secondary mx-1">Kembali</a>
                                        </div>
                                    </div>
                                </form>
                            <?php
                            }
                            ?>
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

        <!-- End of Page Wrapper -->
    </div>

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
                    <a class="btn btn-primary" href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../vendor/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../vendor/js/demo/datatables-demo.js"></script>

</body>

</html>






<div class="row" hidden>
    <h1 align="center">edit data paslon</h1>
    <a href="../data_paslon">kembali</a><br>
    <?php while ($d = mysqli_fetch_assoc($data)) { ?>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $d['id']; ?>">
            <label for="ketua">ketua</label>
            <input type="text" name="ketua" value="<?php echo mysqli_real_escape_string($conn, $d['ketua']); ?>">
            <br>
            <label for="wk1">wk1</label>
            <input type="text" name="wk1" value="<?php echo mysqli_real_escape_string($conn, $d['wk1']); ?>">
            <br>
            <label for="wk2">wk2</label>
            <input type="text" name="wk2" value="<?php echo mysqli_real_escape_string($conn, $d['wk2']); ?>">
            <br>
            <label for="visi">visi</label>
            <input type="text" name="visi" value="<?php echo mysqli_real_escape_string($conn, $d['visi']); ?>">
            <br>
            <label for="misi">misi</label>
            <input type="text" name="misi" value="<?php echo mysqli_real_escape_string($conn, $d['misi']); ?>">
            <br>
            <label for="program">program</label>
            <input type="text" name="program" value="<?php echo mysqli_real_escape_string($conn, $d['program']); ?>">
            <br>
            <label for="file">gambar</label>
            <input type="file" name="file" value="<?php echo mysqli_real_escape_string($conn, $d['gambar']); ?>">
            <br>
            <input type="submit" name="simpan" value="Upload">
        </form>
    <?php
    }
    ?>
</div>