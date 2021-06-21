<?php
session_start();
if ($_SESSION['status'] != "login" || $_SESSION['level'] != "admin") {
	header("location:../login?pesan=belum_login");
}
include '../../conn.php';
if (isset($_POST['upload'])) {

	require('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
	require('spreadsheet-reader-master/SpreadsheetReader.php');
	//upload data excel kedalam lalu pindahkan ke folder uploads
	$target_dir = "uploads/" . basename($_FILES['filemhsw']['name']);
	move_uploaded_file($_FILES['filemhsw']['tmp_name'], $target_dir);
	$nama = $_FILES['filemhsw']['name'];
	$Reader = new SpreadsheetReader($target_dir);
	foreach ($Reader as $Key => $Row) {
		// import data excel mulai baris ke-2 (karena ada header pada baris 1)
		if ($Key < 1) continue;
		$nama = addslashes($Row[0]);
		$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
		$password = addslashes(substr(str_shuffle($permitted_chars), 0, 8));
		$sesi = addslashes(10);
		$query = mysqli_query($conn, "INSERT INTO guru(nama,password,sesi) VALUES ('" . $nama . "', '" . $password . "','" . $sesi . "')");
	}
	unlink("uploads/$nama");
	if ($query) {
		header("location:../data_guru?import=data");
	} else {
		echo "Gagal Import";
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

	<title>PKO Admin - Kelola Guru</title>

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
			<li class="nav-item active">
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
					<!-- pass acak -->
					<div class="row">
						<div class="col-6">
							<div class="card shadow mb-4">
								<div class="card-header py-3">
									<h6 class="m-0 font-weight-bold text-primary align-items-center">Import Data</h6>
								</div>
								<div class="card-body">
									<form method="post" enctype="multipart/form-data" class="form-inline">
										<div class="custom-file col-8">
											<input type="file" class="custom-file-input" id="filemhsw" name="filemhsw" required>
											<label class="custom-file-label" for="filemhsw" style="display: inline !important;">Filih File</label>
										</div>
										<button class="btn btn-primary ml-3" name="upload">Import</button>
										<a class="btn btn-secondary ml-2" href="../data_guru">Kembali</a>
									</form>
								</div>
							</div>
						</div>

						<!-- end row -->
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