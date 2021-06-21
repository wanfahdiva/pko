-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2021 at 04:34 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pko`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '24842b3bc4a46dc1e3eb13158fad6f81'),
(2, 'informatika', 'caa420c305cedd335dbebb739cc94bfc'),
(3, 'kepsek', 'ee53d4213c897ad632bb8d824762f918');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `pilihan` varchar(10) NOT NULL,
  `sesi` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nama`, `password`, `pilihan`, `sesi`) VALUES
(2, 'test', '60f4k2qt', '', '10');

-- --------------------------------------------------------

--
-- Table structure for table `paslon`
--

CREATE TABLE `paslon` (
  `id` int(11) NOT NULL,
  `no_paslon` int(5) NOT NULL,
  `ketua` varchar(100) NOT NULL,
  `wk1` varchar(100) NOT NULL,
  `wk2` varchar(100) NOT NULL,
  `visi` varchar(500) NOT NULL,
  `misi` varchar(500) NOT NULL,
  `program` varchar(500) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `jumlah` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paslon`
--

INSERT INTO `paslon` (`id`, `no_paslon`, `ketua`, `wk1`, `wk2`, `visi`, `misi`, `program`, `gambar`, `jumlah`) VALUES
(1, 1, 'Cahya Hidayat', 'Maya Sri Rahayu Ningsih', 'M. Agil Dedi Herdian', 'Menciptakan lingkungan sekolah yang menginspirasi,saling menghormati,dan aktif, serta Peduli terhadap lingkungan sekitar, dengan  berlandaskan iman dan taqwa', 'Menumbuhkan ketaqwaan dan keimanan terhadap Tuhan Yang Maha Esa.Meningkatkan tali persaudaraan dan keharmonisan para siswa dalam pergaulan.Mengadakan berbagai kegiatan yang positif.Menyadarkan berharganya sampah', 'Bank sampah.Mengadakan berbagai kegiatan yang positif.Mempererat tali persaudaraan antar pengurus OSIS / Osis-Mpk.Menumbuhkan rasa percaya diri dan bertanggung jawab pada pengurus OSIS', 'paslon_1.png', 0),
(2, 2, 'Gilang Sobana', 'Andrian ladiah Vega', 'Herdini indriantri', 'Menjadikan OSIS sebagai wadah untuk menampung inspirasi, aspirasi, dan kreatifitas siswa siswi SMK Informatika Sumedang, juga membentuk kepribadian yang berprestasi, inovatif, bertanggung jawab dan dilandasi dengan iman dan takwa. ', 'Menumbuhkan keimanan dan ketaqwaan pada Tuhan yang Maha Esa.Meningkatkan kesadaran siswa tentang keberhasilan sekolah.Mengembangkan kreatifitas, bakat, minat, dan pontensi siswa.Mengoptimalkan fungsi dan peran OSIS di Sekolah, serta meningkatkan kinerja OSIS di sekolah.Melanjutkan program OSIS sebelumnya yang belum terlaksanakan ataupun yang belum di laksanakan sekiranya efektif', 'Mengadakan binroh dan Solat Duha berjamaah minimal 1 Bulan 1 kali.Waktu : Pada hari jum`at sebelum dimulai nya jam pelajaran.Tujuan :  meningkatkan keimanan dan ketakwaan siswa-siswi dan guru-guru SMK Informatika Sumedang sekaligus menyeimbanhkan antara pendidikan dan kerohanian.Target : Semua siswa-siswi dan juga Guru,staf SMK Informatika Sumedang.Harapan : Dapat berjalan dengan efektif sebagaimana mestinya sehingga tercipta siswa siswi yang berahlak mulia', 'paslon_2.png', 0),
(3, 3, 'Syarmila Isabila  ', 'Obi  Dirgantara Bagas', 'Rival  Alfian  Firdaus', 'B A M B (Beriman, Aktif, Maju, Berbudaya)', 'Menumbuhkan rasa keimanan dan ketaqwaan kepada Allah SWT.Mempererat rasa kekeluargaan antar anggota organisasi.Menjaga kekompakan organisasi.Ikut serta dalam kegiatan positif di sekolah maupun di luar sekolah.Mempererta hubungan baik antar organisasi.Lebih mengenal buadaya lokal.Mempererat rasa Nasionalisme, rasa cinta terhadap tanah air', 'Menyelenggarakan kegiatan-kegiatan yang berhubungan dengan agama,memperingati hari-hari besar agama islam.Memeriahkan hari kemerdekaan Indonesia.Memperingati hari hari bersejarah serta melaksanakan kegiatan-kegiatan kebudayaan seperti pada hari batik nasional,bulan bahasa dll.Mengadakan porseni', 'paslon_3.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sesi`
--

CREATE TABLE `sesi` (
  `id` int(11) NOT NULL,
  `nama_sesi` int(11) NOT NULL,
  `mulai` varchar(225) NOT NULL,
  `akhir` varchar(20) NOT NULL,
  `hari` varchar(225) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sesi`
--

INSERT INTO `sesi` (`id`, `nama_sesi`, `mulai`, `akhir`, `hari`) VALUES
(1, 1, '00:00', '21:59', 'Thursday');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `password` varchar(8) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `sesi` int(11) NOT NULL,
  `pilihan` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nama`, `nis`, `password`, `kelas`, `sesi`, `pilihan`) VALUES
(1, 'wanfah', '12345678', '64cu2ng1', 'XII-R7', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tanggal`
--

CREATE TABLE `tanggal` (
  `id` int(11) NOT NULL,
  `mulai` varchar(20) NOT NULL,
  `selesai` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tanggal`
--

INSERT INTO `tanggal` (`id`, `mulai`, `selesai`) VALUES
(1, '14:01:2021', '16:01:2021');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paslon`
--
ALTER TABLE `paslon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sesi`
--
ALTER TABLE `sesi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tanggal`
--
ALTER TABLE `tanggal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paslon`
--
ALTER TABLE `paslon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sesi`
--
ALTER TABLE `sesi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tanggal`
--
ALTER TABLE `tanggal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
