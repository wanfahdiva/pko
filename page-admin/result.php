<?php
session_start();
if ($_SESSION['a'] != "login" || $_SESSION['b'] != "admin") {
    header("location:hasil?pesan=belum_login");
}

//mennghubungkan file conn
include "../conn.php";

//mengambil data dari tabel siswa
$pilihan_siswa1 = intval(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM siswa WHERE pilihan='1'")));
$pilihan_siswa2 = intval(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM siswa WHERE pilihan='2'")));
$pilihan_siswa3 = intval(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM siswa WHERE pilihan='3'")));

//mengambil data dari tabel guru
$pilihan_guru1 = intval(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM guru WHERE pilihan='1'")));
$pilihan_guru2 = intval(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM guru WHERE pilihan='2'")));
$pilihan_guru3 = intval(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM guru WHERE pilihan='3'")));

// penjumlahan
$jumlah1 = mysqli_real_escape_string($conn, $pilihan_siswa1 + $pilihan_guru1);
$jumlah2 = mysqli_real_escape_string($conn, $pilihan_siswa2 + $pilihan_guru2);
$jumlah3 = mysqli_real_escape_string($conn, $pilihan_siswa3 + $pilihan_guru3);

// testing max
// $jumlah1 = 5984723483;
// $jumlah2 = 1234567890;
// $jumlah3 = 1434356768;

// total nu milih
$total = $jumlah1 + $jumlah2 + $jumlah3;
if ($total > 0) {
    // rubah ka persen
    $persen1 = substr($jumlah1 / $total * 100, 0, 5);
    $persen2 = substr($jumlah2 / $total * 100, 0, 5);
    $persen3 = substr($jumlah3 / $total * 100, 0, 5);
} else {
    $persen1 = 0;
    $persen2 = 0;
    $persen3 = 0;
}

// refresh + update
mysqli_query($conn, "UPDATE paslon set jumlah='$jumlah1' where no_paslon='1'");
mysqli_query($conn, "UPDATE paslon set jumlah='$jumlah2' where no_paslon='2'");
mysqli_query($conn, "UPDATE paslon set jumlah='$jumlah3' where no_paslon='3'");

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

    <!-- login2 -->
    <link rel="stylesheet" href="vendor/css/login2.css">

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
            <li class="nav-item">
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
            <li class="nav-item active">
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

                    <div class="row">
                        <!-- Page Heading -->
                        <div class="d-sm-flex justify-content-center mb-4">
                            <h5 class="ml10 mb-0 text-gray-800">
                                <span class="text-wrapper">
                                    <span class="letters">Hasil Pemilihan</span>
                                </span>
                            </h5>
                        </div>
                        <!-- Content Row -->
                        <div class="row">
                            <!-- data jumlah  paslon-->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Paslon 1</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah1; ?> Suara</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-stack-3x fa-2x text-gray-300" style="margin: -5px;"><?= $persen1; ?>%</i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- data jumlah  paslon-->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Paslon 2</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah2; ?> Suara</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-stack-3x fa-2x text-gray-300" style="margin: -5px;"><?= $persen2; ?>%</i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- data jumlah  paslon-->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-secondary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Paslon 3</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah3; ?> Suara</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-stack-3x fa-2x text-gray-300" style="margin: -5px;"><?= $persen3; ?>%</i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- nilai max -->
                            <?php
                            $maxs = max($jumlah1, $jumlah2, $jumlah3);
                            if ($maxs > 0) {
                                if ($maxs == $jumlah1) {
                                    $kets = '"Congratulation to Paslon 1"';
                                } elseif ($maxs == $jumlah2) {
                                    $kets = '"Congratulation to Paslon 2"';
                                } elseif ($maxs == $jumlah3) {
                                    $kets = '"Congratulation to Paslon 3"';
                                }
                            } else {
                                $kets = ' ';
                            }
                            ?>
                            <div class="container d-flex justify-content-center mb-3">
                                <h4 class="ml6z text-gray-800">
                                    <span class="text-wrapperz">
                                        <span class="lettersz"><?= $kets; ?></span>
                                    </span>
                                </h4>
                            </div>


                            <!-- Bar Chart -->
                            <div class="col-xl-12 col-lg-7">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Data Diagram Pemilihan</h6>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="chart-area">
                                            <canvas id="myBarChart"></canvas>
                                        </div>
                                    </div>
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

    <!-- Custom scripts for all pages-->
    <script src="vendor/js/sb-admin-2.min.js"></script>

    <!-- text moving-2 -->
    <script>
        // Wrap every letter in a span
        var textWrapper = document.querySelector('.ml6z .lettersz');
        textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

        anime.timeline({
                loop: true
            })
            .add({
                targets: '.ml6z .letter',
                translateY: ["1.1em", 0],
                translateZ: 0,
                duration: 750,
                delay: (el, i) => 50 * i
            }).add({
                targets: '.ml6z',
                opacity: 0,
                duration: 1000,
                easing: "easeOutExpo",
                delay: 1000
            });
    </script>


    <!-- text moving -->
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

    <!-- Page level plugins -->
    <script src="vendor/js/Chart.bundle.js"></script>
    <script>
        // jenis diagram 'line bar radar pie doughnut'
        // diagram
        var ctx = document.getElementById("myBarChart");
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Paslon1", "Paslon2", "Paslon3"],
                datasets: [{
                    label: "jumlah pemilih",
                    backgroundColor: "#4e73df",
                    hoverBackgroundColor: "rgba(0,0,0,0.5)",
                    borderColor: "#4e73df",
                    data: [
                        <?php echo "$jumlah1"; ?>,
                        <?php echo "$jumlah2"; ?>,
                        <?php echo "$jumlah3"; ?>
                    ],
                    //atur background barchartnya
                    backgroundColor: [
                        '#4e73df',
                        '#36b9cc',
                        '#858796'
                    ],

                    //atur border barchartnya
                    borderColor: [
                        '#4e73df',
                        '#36b9cc',
                        '#858796'
                    ],
                    borderWidth: 1
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: true,
                            drawBorder: true
                        },
                        maxBarThickness: 25,
                    }],
                    yAxes: [{
                        gridLines: {
                            // color: "rgb(234, 236, 244)",
                            // zeroLineColor: "rgb(234, 236, 244)",
                            color: "rgba(0, 0, 0, 0.2)",
                            zeroLineColor: "rgba(0, 0, 0, 0.2)",
                            drawBorder: true,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        },
                        ticks: {
                            beginAtZero: true,
                        },
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                    callbacks: {}
                },
            }
        });
    </script>

</body>

</html>