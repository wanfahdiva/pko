<?php
require_once "vendor/fpdf182/fpdf.php";
include '../conn.php';
$ambil_siswa = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM siswa"));
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
        $this->Ln(20);
    }
    function Table($ambil_siswa)
    {
        $this->SetFont('Times', '', 10);
        $this->Cell(0, 5, '-Total Siswa : ' . $ambil_siswa . '', 0, 0, 'L');
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
        $this->Cell(110, 10, 'Nama', 1, 0, 'C');
        $this->Cell(40, 10, 'Nis', 1, 0, 'C');
        $this->Cell(40, 10, 'Password', 1, 0, 'C');
        $this->Cell(36, 10, 'Kelas', 1, 0, 'C');
        $this->Cell(30, 10, 'Sesi', 1, 0, 'C');
        $this->Ln();
    }
    function viewTable()
    {
        include '../conn.php';
        $this->SetFont('Times', '', 10);
        $ambil = mysqli_query($conn, "SELECT * FROM siswa");
        $i = 1;
        while ($data = mysqli_fetch_assoc($ambil)) {
            $this->Cell(20, 10, $i, 1, 0, 'C');
            $this->Cell(110, 10, $data['nama'], 1, 0, 'L');
            $this->Cell(40, 10, $data['nis'], 1, 0, 'L');
            $this->Cell(40, 10, $data['password'], 1, 0, 'L');
            $this->Cell(36, 10, $data['kelas'], 1, 0, 'L');
            $this->Cell(30, 10, $data['sesi'], 1, 0, 'L');
            $this->Ln();
            $i++;
        }
    }
}
$pdf = new myPDF();
$title = 'Cetak Data Siswa';
$pdf->SetTitle($title);
$pdf->AliasNbPages();
$pdf->AddPage('L', 'A4', 0);
$pdf->Table($ambil_siswa);
$pdf->headerTable();
$pdf->viewTable();
$pdf->Output('I', 'CetakSiswa.pdf');
