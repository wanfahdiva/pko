<?php
session_start();
if ($_SESSION['status'] != "login" || $_SESSION['level'] != "admin") {
	header("location:../login?pesan=belum_login");
}
include "../../conn.php";

if (isset($_POST['simpan'])) {
	$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
	$nama = addslashes($_POST['nama']);
	$nis = addslashes($_POST['nis']);
	$kelas = addslashes($_POST['kelas']);
	$sesi = addslashes($_POST['sesi']);

	$password = addslashes(substr(str_shuffle($permitted_chars), 0, 8));

	$cek = mysqli_query($conn, "SELECT * FROM siswa WHERE nis='$nis'") or die(mysqli_error($conn));
	if (mysqli_num_rows($cek) == 0) {
		$sql = mysqli_query($conn, "INSERT INTO siswa (id,nama,nis,password,kelas,sesi) VALUES('','$nama','$nis','$password','$kelas','$sesi')");
		if ($sql) {
			echo '<script>alert("Berhasil menambahkan data."); document.location="../data_siswa";</script>';
		} else {
			echo '<script>alert("Gagal melakukan proses tambah data.");</script>';
		}
	} else {
		echo '<script>alert("Nis Sudah Terdaftar.");</script>';
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

	<title>PKO Admin - Tambah Siswa</title>

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
			<li class="nav-item active">
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
			<li class="nav-item">
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
						<h4 class="m-0 font-weight-bold text-primary align-items-center">Tambah Data Siswa</h4>
					</div>
					<!-- DataTales String Pass -->
					<div class="card shadow mb-4" id="stringpass">
						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary align-items-center">Data</h6>
						</div>
						<div class="card-body">
							<form action="" method="POST">
								<div class="form-group row">
									<label for="nama" class="col-sm-2 col-form-label">Nama</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" required id="nama" placeholder="nama" name="nama">
									</div>
								</div>
								<div class="form-group row">
									<label for="nis" class="col-sm-2 col-form-label">Nis</label>
									<div class="col-sm-10">
										<input type="number" class="form-control" required id="nis" placeholder="nis" name="nis">
									</div>
								</div>
								<div class="form-group row">
									<label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" required id="kelas" placeholder="kelas" name="kelas">
									</div>
								</div>
								<div class="form-group row">
									<label for="sesi" class="col-sm-2 col-form-label">Sesi</label>
									<div class="col-sm-10">
										<input type="number" class="form-control" required id="sesi" placeholder="sesi" name="sesi">
									</div>
								</div>
								<div class="form-group row float-right">
									<div class="col-sm-12 mt-2">
										<button type="submit" class="btn btn-primary mx-1" name="simpan">Tambah</button>
										<a href="../data_siswa" class="btn btn-secondary mx-1">Kembali</a>
									</div>
								</div>
							</form>
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