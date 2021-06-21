<?php
session_start();
include "conn.php";
date_default_timezone_set('Asia/Jakarta');
if ($_SESSION['status'] != "login") {
  header("location:halaman_login");
  exit();
}

//nyokot id na
$id = mysqli_real_escape_string($conn, $_SESSION['id']);

//milih anu login teh siswa atawa guru
if ($_SESSION['level'] == "siswa") {
  $ambil = "SELECT * FROM siswa WHERE id='$id'";
} elseif ($_SESSION['level'] == "guru") {
  $ambil = "SELECT * FROM guru WHERE id='$id'";
}
//nyokot data ti database
$ambil_data = mysqli_query($conn, $ambil);
$assosiasi = mysqli_fetch_assoc($ambil_data);

$sesi = mysqli_real_escape_string($conn, $assosiasi['sesi']);
$pilihan = mysqli_real_escape_string($conn, intval($assosiasi['pilihan']));

//ngacek geus milih atawa acan
if ($pilihan == 1) {
  header("location:page/sudah_memilih");
} elseif ($pilihan == 2) {
  header("location:page/sudah_memilih");
} elseif ($pilihan == 3) {
  header("location:page/sudah_memilih");
}


//jang ngacek tanggal mulai na
$ambil_data_tanggal = mysqli_query($conn, "SELECT * FROM tanggal");
$assosiasi_tanggal = mysqli_fetch_assoc($ambil_data_tanggal);

$misah_tanggal_awal = explode(":", $assosiasi_tanggal['mulai']);
$misah_tanggal_akhir = explode(":", $assosiasi_tanggal['selesai']);

$tanggal_awal = intval($misah_tanggal_awal[0]);
$bulan_awal = intval($misah_tanggal_awal[1]);
$tahun_awal = intval($misah_tanggal_awal[2]);

$tanggal_akhir = intval($misah_tanggal_akhir[0]);
$bulan_akhir = intval($misah_tanggal_akhir[1]);
$tahun_akhir = intval($misah_tanggal_akhir[2]);


$aa = date('j');
$bb = date('n');
$cc = date('Y');

$tanggal = intval($aa);
$bulan = intval($bb);
$tahun = intval($cc);


//jang ngacek tanggal mulai
if ($tahun <= $tahun_awal) {
  $kurang = $tahun_awal - $tahun;
  if ($kurang > 0) {
    header("location:page/belum_waktu");
    exit();
  } elseif ($bulan <= $bulan_awal) {
    $kurang_bulan = $bulan_awal - $bulan;
    if ($kurang_bulan > 0) {
      header("location:page/belum_waktu");
      exit();
    } elseif ($tanggal <= $tanggal_awal) {
      $kurang_tanggal = $tanggal_awal - $tanggal;
      if ($kurang_tanggal > 0) {
        header("location:page/belum_waktu");
        exit();
      }
    }
  }
}


//jang ngacek tanggal akhir
if ($tahun >= $tahun_akhir) {
  $kurang = $tahun - $tahun_akhir;
  if ($kurang > 0) {
    header("location:page/telat");
    exit();
  } elseif ($bulan >= $bulan_akhir) {
    $kurang_bulan = $bulan - $bulan_akhir;
    if ($kurang_bulan > 0) {
      header("location:page/telat");
      exit();
    } elseif ($tanggal >= $tanggal_akhir) {
      $kurang_tanggal = $tanggal - $tanggal_akhir;
      if ($kurang_tanggal > 0) {
        header("location:page/telat");
        exit();
      }
    }
  }
}

//ngacek guru atawa lain
if ($sesi != 10) {
  //nyokot ti database sesi
  $ambil_sesi = mysqli_query($conn, "SELECT * FROM sesi WHERE nama_sesi='$sesi'");
  $a = mysqli_fetch_assoc($ambil_sesi);


  //jang misahkeun titik dua
  $pisah_awal = explode(":", $a['mulai']);
  $pisah_akhir = explode(":", $a['akhir']);

  $hari = mysqli_real_escape_string($conn, $a['hari']);

  $jam_mulai = intval($pisah_awal[0]);
  $menit_mulai = intval($pisah_awal[1]);

  $jam_akhir = intval($pisah_akhir[0]);
  $menit_akhir = intval($pisah_akhir[1]);

  $jam = date('H');
  $menit = date('i');

  $cek_jam = intval($jam);
  $cek_menit = intval($menit);
  $cek_hari = date('l');

  if ($cek_hari != $hari) {
    header("location:page/beda_hari");
  }
  // ngecek jam na
  if ($cek_jam <= $jam_mulai) {
    $kurang = $jam_mulai - $cek_jam;
    if ($kurang > 0) {
      header("location:page/belum_waktu");
    } else if ($cek_menit < $menit_mulai) {
      header("location:page/belum_waktu");
    }
  } elseif ($cek_jam >= $jam_akhir) {
    $kurang = $cek_jam - $jam_akhir;
    if ($kurang > 0) {
      header("location:page/telat");
    } else if ($cek_menit >= $menit_akhir) {
      header("location:page/telat");
    }
  }
}

//lamun tombol na geus diteken
if (isset($_POST['simpan'])) {
  $pilih = mysqli_real_escape_string($conn, $_POST['simpan']);
  if ($_SESSION['level'] == "siswa") {
    mysqli_query($conn, "UPDATE siswa set pilihan='$pilih' where id='$id' ");
  } elseif ($_SESSION['level'] == "guru") {
    mysqli_query($conn, "UPDATE guru set pilihan='$pilih' where id='$id' ");
  }
  header("location:selesai_memilih");
}

?>

<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PKO - Pilih Paslon</title>
  <link rel="stylesheet" href="vendor/css/style_pilih.css">
  <link rel="stylesheet" href="vendor/css/style_footer.css">
  <link rel="shortcut icon" href="vendor/images/ifsu.png">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@500&display=swap" rel="stylesheet">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>

<body>
  <div class="page-wrap">
    <div class="container">
      <div class="text-center" style="margin-top: 5%;">
        <h2 class="testing"><img src="vendor/images/ifsu.png" class="img1" class="img1 mb-1">&nbsp; Pemilihan Ketua Osis &nbsp;<img src="vendor/images/osis.jpg" class="img2 mb-1"></h2>
        <p>Silahkan untuk memilih paslon.</p>
      </div>
      <div class="card-deck">
        <?php
        $no = 1;
        $pas = mysqli_query($conn, "SELECT * FROM paslon");
        while ($asosiasi = mysqli_fetch_assoc($pas)) {
          $id = mysqli_real_escape_string($conn, $asosiasi['id']);
          $no_paslon = mysqli_real_escape_string($conn, $asosiasi['no_paslon']);
          $data_ketua = mysqli_real_escape_string($conn, $asosiasi['ketua']);
          $data_wk1 = mysqli_real_escape_string($conn, $asosiasi['wk1']);
          $data_wk2 = mysqli_real_escape_string($conn, $asosiasi['wk2']);
          $data_visi = mysqli_real_escape_string($conn, $asosiasi['visi']);
          $data_misi = mysqli_real_escape_string($conn, $asosiasi['misi']);
          $data_program = mysqli_real_escape_string($conn, $asosiasi['program']);
          $data_gambar = mysqli_real_escape_string($conn, $asosiasi['gambar']);
        ?>
          <div class="card shadow">
            <img class="card-img-top" src="vendor/images/<?php echo mysqli_real_escape_string($conn, "$data_gambar"); ?>" alt="Gambar Paslon Urut <?= $no; ?>">
            <div class="card-body">
              <h5 class="card-title text-center">Nomor Urut <?php echo mysqli_real_escape_string($conn, "$no_paslon"); ?></h5>
              <p class="card-text">
                <div class="input-group mb-3 mt-3">
                  <span class="input-group-text" style="width: 100%;">Nama Ketua Osis</span>
                  <input type="text" class="form-control" value="<?php echo mysqli_real_escape_string($conn, "$data_ketua"); ?>" disabled style="background-color: transparent;">
                </div>
                <div class="input-group mb-3">
                  <span class="input-group-text" style="width: 100%;">Nama Wakil Ketua 1</span>
                  <input type="text" class="form-control" value="<?php echo  mysqli_real_escape_string($conn, "$data_wk1"); ?>" disabled style="background-color: transparent;">
                </div>
                <div class="input-group">
                  <span class="input-group-text" style="width: 100%;">Nama Wakil Ketua 2</span>
                  <input type="text" class="form-control" value="<?php echo  mysqli_real_escape_string($conn, "$data_wk2"); ?>" disabled style="background-color: transparent;">
                </div>
              </p>
            </div>
            <form action="" method="post">
              <div class="card-footer d-flex justify-content-center">
                <button type="button" class="btn btn-outline-secondary mr-1 tbtn" style="width: 45%;" data-toggle="modal" data-target="#no_paslon<?= $no; ?>" data-id="<?= $id; ?>">VISI/MISI</button>
                <button type="submit" class="btn btn-primary ml-1 tbtn" style="width: 45%;" name="simpan" value="<?php echo mysqli_real_escape_string($conn, "$no_paslon"); ?>" onclick="return confirm('anda yakin memilih paslon <?= $no_paslon; ?>');">Pilih Paslon</button>
              </div>
            </form>
          </div>
        <?php
          $no++;
        }
        ?>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="no_paslon1" tabindex="-1" aria-labelledby="paslon" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">VISI DAN MISI PASLON 1</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-justy">
          <?php
          include "conn.php";
          $ambil_paslon_1 = "SELECT * FROM paslon WHERE no_paslon='1'";
          $ambil_data_paslon_1 = mysqli_query($conn, $ambil_paslon_1);
          $assosiasi_paslon_1 = mysqli_fetch_assoc($ambil_data_paslon_1);
          ?>
          <div class="card" style="margin: 5% 0%;">
            <div class="card-body" style="padding: 1.1rem !important;">
              <h5 style="margin: 3% 0%;">VISI</h5>
              <p class="lead"><?php echo ($assosiasi_paslon_1['visi']); ?> </p>
            </div>
          </div>
          <div class="card" style="margin: 5% 0%;">
            <div class="card-body" style="padding: 1.1rem !important;">
              <h5 style="margin: 3% 0%;">MISI</h5>
              <p class="lead">
                <?php
                $misi_1 = $assosiasi_paslon_1['misi'];
                $pisah_misi_1 = explode(".", $misi_1);
                $no_misi_1 = 1;
                foreach ($pisah_misi_1 as $a) {
                  echo "$no_misi_1" . ". ";
                  echo "$a" . "." . "<br>";
                  $no_misi_1++;
                }
                ?>
              </p>
            </div>
          </div>
          <div class="card" style="margin: 5% 0%;">
            <div class="card-body" style="padding: 1.1rem !important;">
              <h5 style="margin: 3% 0%;">Program Kerja</h5>
              <p class="lead">
                <?php
                $program_1 = $assosiasi_paslon_1['program'];
                $pisah_program_1 = explode(".", $program_1);
                $no_program_1 = 1;
                foreach ($pisah_program_1 as $a) {
                  echo "$no_program_1" . ". ";
                  echo "$a" . "." . "<br>";
                  $no_program_1++;
                }
                ?>
              </p>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="width: 100%">Kembali</button>
        </div>
      </div>
    </div>
  </div>

  <!-- modal 2 -->
  <div class="modal fade" id="no_paslon2" tabindex="-1" aria-labelledby="paslon" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">VISI DAN MISI PASLON 2</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-justy">
          <?php
          include "conn.php";
          $ambil_paslon_2 = "SELECT * FROM paslon WHERE no_paslon='2'";
          $ambil_data_paslon_2 = mysqli_query($conn, $ambil_paslon_2);
          $assosiasi_paslon_2 = mysqli_fetch_assoc($ambil_data_paslon_2);
          ?>
          <div class="card" style="margin: 5% 0%;">
            <div class="card-body" style="padding: 1.1rem !important;">
              <h5 style="margin: 3% 0%;">VISI</h5>
              <p class="lead"><?php echo ($assosiasi_paslon_2['visi']); ?> </p>
            </div>
          </div>
          <div class="card" style="margin: 5% 0%;">
            <div class="card-body" style="padding: 1.1rem !important;">
              <h5 style="margin: 3% 0%;">MISI</h5>
              <p class="lead">
                <?php
                $misi_2 = $assosiasi_paslon_2['misi'];
                $pisah_misi_2 = explode(".", $misi_2);
                $no_misi_2 = 1;
                foreach ($pisah_misi_2 as $a) {
                  echo "$no_misi_2" . ". ";
                  echo "$a" . "." . "<br>";
                  $no_misi_2++;
                }
                ?>
              </p>
            </div>
          </div>
          <div class="card" style="margin: 5% 0%;">
            <div class="card-body" style="padding: 1.1rem !important;">
              <h5 style="margin: 3% 0%;">Program Kerja</h5>
              <p class="lead">
                <?php
                $program_2 = $assosiasi_paslon_2['program'];
                $pisah_program_2 = explode(".", $program_2);
                $no_program_2 = 1;
                foreach ($pisah_program_2 as $a) {
                  echo "$no_program_2" . ". ";
                  echo "$a" . "." . "<br>";
                  $no_program_2++;
                }
                ?>
              </p>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="width: 100%">Kembali</button>
        </div>
      </div>
    </div>
  </div>

  <!-- modal 3 -->
  <div class="modal fade" id="no_paslon3" tabindex="-1" aria-labelledby="paslon" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">VISI DAN MISI PASLON 3</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-justy">
          <?php
          include "conn.php";
          $ambil_paslon_3 = "SELECT * FROM paslon WHERE no_paslon='3'";
          $ambil_data_paslon_3 = mysqli_query($conn, $ambil_paslon_3);
          $assosiasi_paslon_3 = mysqli_fetch_assoc($ambil_data_paslon_3);
          ?>
          <div class="card" style="margin: 5% 0%;">
            <div class="card-body" style="padding: 1.1rem !important;">
              <h5 style="margin: 3% 0%;">VISI</h5>
              <p class="lead"><?php echo ($assosiasi_paslon_3['visi']); ?> </p>
            </div>
          </div>
          <div class="card" style="margin: 5% 0%;">
            <div class="card-body" style="padding: 1.1rem !important;">
              <h5 style="margin: 3% 0%;">MISI</h5>
              <p class="lead">
                <?php
                $misi_3 = $assosiasi_paslon_3['misi'];
                $pisah_misi_3 = explode(".", $misi_3);
                $no_misi_3 = 1;
                foreach ($pisah_misi_3 as $a) {
                  echo "$no_misi_3" . ". ";
                  echo "$a" . "." . "<br>";
                  $no_misi_3++;
                }
                ?>
              </p>
            </div>
          </div>
          <div class="card" style="margin: 5% 0%;">
            <div class="card-body" style="padding: 1.1rem !important;">
              <h5 style="margin: 3% 0%;">Program Kerja</h5>
              <p class="lead">
                <?php
                $program_3 = $assosiasi_paslon_3['program'];
                $pisah_program_3 = explode(".", $program_3);
                $no_program_3 = 1;
                foreach ($pisah_program_3 as $a) {
                  echo "$no_program_3" . ". ";
                  echo "$a" . "." . "<br>";
                  $no_program_3++;
                }
                ?>
              </p>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="width: 100%">Kembali</button>
        </div>
      </div>
    </div>
  </div>


  <footer>
    <div class="foot">
      <div class="kontak mt-2 mb-0">
        <h4>Pemilu Ifsu <?= date('Y'); ?></h4>
      </div>
      <div class="gf">
        <img src="vendor/images/osis.jpg">
        <img class="ml-2 mr-2" src="vendor/images/mpk.jpg">
        <img src="vendor/images/icso.png">
      </div>
      <div class="cp">
        <a href="https://www.smkifsu.sch.id/" target="_blank">
          <p>&copy; copyright PemiluIfsu<?= date('Y'); ?></p>
        </a>
      </div>
    </div>
  </footer>

</body>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="vendor/js/sb-admin-2.min.js"></script>

</html>