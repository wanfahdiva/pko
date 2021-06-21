<?php
session_start();
if ($_SESSION['status'] != "login" || $_SESSION['level'] != "admin") {
	header("location:../login?pesan=belum_login");
}

include '../../conn.php';
if (isset($_GET['id'])) {
	//membuat variabel $id yang menyimpan nilai dari $_GET['id']
	$id = mysqli_real_escape_string($conn, $_GET['id']);
	$cek = mysqli_query($conn, "SELECT * FROM guru WHERE id='$id'");
	if (mysqli_num_rows($cek) > 0) {
		$hapus = mysqli_query($conn, "DELETE FROM guru where id='$id'");
		if ($hapus) {
			echo '<script>alert("Berhasil menghapus data."); document.location="../data_guru";</script>';
		} else {
			echo '<script>alert("Gagal menghapus data."); document.location="../data_guru";</script>';
		}
	} else {
		echo '<script>alert("ID tidak ditemukan di database."); document.location="../data_guru";</script>';
	}
} else {
	echo '<script>alert("ID tidak ditemukan di database."); document.location="../data_guru";</script>';
}
