<?php
// ambil fpdf
require_once "vendor/fpdf182/fpdf.php";
// koneksi
include '../conn.php';
// ambil data siswa dan guru kosong
$ambil_siswa_kosong = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM siswa WHERE pilihan=0"));
$ambil_guru_kosong = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM guru WHERE pilihan=0"));
// total siswa + guru kosong
$jumlah_kosong = intval($ambil_siswa_kosong + $ambil_guru_kosong);

// ambil data siswa dan guru
$ambil_siswa = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM siswa"));
$ambil_guru = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM guru"));
// total siswa + guru
$jumlah = intval($ambil_siswa + $ambil_guru);



class myPDF extends FPDF
{
    function header()
    {
        $this->Image('../vendor/images/ifsu.png', 10, 6, 20);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(276, 5, 'Data Siswa', 0, 0, 'C');
        $this->Ln();
        $this->SetFont('Times', '', 12);
        $this->Cell(276, 10, 'SMK INFORMATIKA SUMEDANG', 0, 0, 'C');
        $this->Ln(15);
    }
    function Table($jumlah_kosong, $jumlah)
    {
        $this->SetFont('Times', '', 10);
        $this->Cell(0, 5, '-Daftar Pemilih Tetap : ' . $jumlah . '', 0, 0, 'L');
        $this->Ln();
        $this->Cell(0, 5, '-Total Tidak Memilih : ' . $jumlah_kosong . '', 0, 0, 'L');
        $this->Ln();
        $this->Cell(0, 5, '-Berikut Data Yang Tidak Memilih: ', 0, 0, 'L');
        $this->Ln(10);
    }
    function footer()
    {
        $this->SetY(-15);
        $this->SetFont('Times', '', 8);
        $this->Cell(0, 10, 'Page' . $this->PageNo() . '', 0, 0, 'C');
    }
    function headerTable()
    {
        $this->SetFont('Times', 'B', 12);
        $this->Cell(20, 10, 'No', 1, 0, 'C');
        $this->Cell(90, 10, 'Nama', 1, 0, 'C');
        $this->Cell(40, 10, 'Nis', 1, 0, 'C');
        $this->Cell(60, 10, 'Password', 1, 0, 'C');
        $this->Cell(36, 10, 'Kelas', 1, 0, 'C');
        $this->Cell(30, 10, 'Sesi', 1, 0, 'C');
        $this->Ln();
    }
    function viewTable()
    {
        include '../conn.php';
        $this->SetFont('Times', '', 10);
        $ambil = mysqli_query($conn, "SELECT * FROM siswa WHERE pilihan=0");
        $i = 1;
        while ($data = mysqli_fetch_assoc($ambil)) {
            $this->Cell(20, 10, $i, 1, 0, 'C');
            $this->Cell(90, 10, $data['nama'], 1, 0, 'L');
            $this->Cell(40, 10, $data['nis'], 1, 0, 'L');
            $this->Cell(60, 10, $data['password'], 1, 0, 'L');
            $this->Cell(36, 10, $data['kelas'], 1, 0, 'L');
            $this->Cell(30, 10, $data['sesi'], 1, 0, 'L');
            $this->Ln();
            $i++;
        }
    }
}
$pdf = new myPDF();
$title = 'Cetak Data Pemlilihan';
$pdf->SetTitle($title);
$pdf->AliasNbPages();
$pdf->AddPage('L', 'A4', 0);
$pdf->Table($jumlah_kosong, $jumlah);
$pdf->headerTable();
$pdf->viewTable();
$pdf->Output('I', 'CetakLaporanPemilih.pdf');
