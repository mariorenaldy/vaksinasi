-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2021 at 01:20 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vaksinasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `idA` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`idA`, `username`, `role`, `password`) VALUES
(4, 'admin', 'admin', '$2y$10$Z8Xc/agl/.1JcqFk6hE5wOSrtJ1k2IxTyWTUUzstgUgt4mymHNwLq'),
(5, 'pimpinan', 'pimpinan', '$2y$10$Xev4WJDvPzqm.9RdeToFaeRBtHMMgsG0h2Uy9/Wg6kahvS1zLIDX6'),
(6, 'petugas', 'petugas', '$2y$10$kRSAo4edbGEBL/g6E7QkduNDsl3yYXZBQ21JjNJg05ruSRWGvahJy');

-- --------------------------------------------------------

--
-- Table structure for table `daftarpenduduk`
--

CREATE TABLE `daftarpenduduk` (
  `idDaftar` int(11) NOT NULL,
  `idPenduduk` int(11) NOT NULL,
  `tanggalPendaftaran` datetime NOT NULL,
  `awalVaksinasi` datetime DEFAULT NULL,
  `akhirVaksinasi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daftarpenduduk`
--

INSERT INTO `daftarpenduduk` (`idDaftar`, `idPenduduk`, `tanggalPendaftaran`, `awalVaksinasi`, `akhirVaksinasi`) VALUES
(2, 1, '2021-06-20 22:27:30', '2021-06-29 10:00:00', '2021-06-29 17:00:00'),
(2, 2, '2021-06-20 22:29:14', '2021-06-29 18:00:00', '2021-07-06 07:00:00'),
(2, 3, '2021-06-20 22:31:18', '2021-06-29 18:00:00', '2021-07-06 07:00:00'),
(1, 4, '2021-06-20 22:33:58', NULL, NULL),
(5, 5, '2021-06-20 22:36:27', NULL, NULL),
(5, 6, '2021-06-20 22:37:50', NULL, NULL),
(5, 7, '2021-06-20 22:38:38', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `datakesehatan`
--

CREATE TABLE `datakesehatan` (
  `id` int(11) NOT NULL,
  `idPenduduk` int(11) NOT NULL,
  `suhuTubuh` double NOT NULL,
  `tekananDarah` varchar(6) NOT NULL,
  `status` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `datakesehatan`
--

INSERT INTO `datakesehatan` (`id`, `idPenduduk`, `suhuTubuh`, `tekananDarah`, `status`, `tanggal`) VALUES
(1, 1, 36, '90/60', 1, '2021-06-23'),
(2, 2, 37, '90/60', 1, '2021-06-23');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `idDaftar` int(11) NOT NULL,
  `tahap` int(11) NOT NULL,
  `awalDaftar` datetime NOT NULL,
  `akhirDaftar` datetime NOT NULL,
  `awalVaksinasi` datetime NOT NULL,
  `akhirVaksinasi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`idDaftar`, `tahap`, `awalDaftar`, `akhirDaftar`, `awalVaksinasi`, `akhirVaksinasi`) VALUES
(1, 1, '2021-06-01 22:20:00', '2021-06-08 22:20:00', '2021-06-15 22:20:00', '2021-06-22 22:20:00'),
(2, 1, '2021-06-15 06:00:00', '2021-06-22 06:00:00', '2021-06-29 08:00:00', '2021-07-06 08:00:00'),
(3, 2, '2021-06-20 10:00:00', '2021-07-04 10:00:00', '2021-07-11 08:00:00', '2021-07-11 15:22:00'),
(4, 3, '2021-07-01 07:30:00', '2021-07-15 07:30:00', '2021-07-22 09:00:00', '2021-07-22 17:00:00'),
(5, 3, '2021-06-19 07:00:00', '2021-07-03 07:00:00', '2021-07-10 10:00:00', '2021-07-31 18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `idPenduduk` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `NIK` varchar(16) NOT NULL,
  `KTP` varchar(100) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `noHP` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`idPenduduk`, `nama`, `NIK`, `KTP`, `pekerjaan`, `noHP`, `email`) VALUES
(1, 'Hariyadi', '7308232505910001', 'uploads/hariyadi@gmail.com/ktp.jpg', 'Wiraswasta', '081293821232', 'hariyadi@gmail.com'),
(2, 'Riyanto', '3471140209790001', 'uploads/riyanto@gmail.com/ktp.jpg', 'Pedagang', '081292832123', 'riyanto@gmail.com'),
(3, 'Adhi Kurniawan', '1271212904940002', 'uploads/adhi@gmail.com/ktp.jpg', 'Mahasiswa', '081293821232', 'adhi@gmail.com'),
(4, 'Sri Aryani', '7303034906800001', 'uploads/sriaryani12@gmail.com/ktp.jpg', 'Karyawan Swasta', '081232331234', 'sriaryani12@gmail.com'),
(5, 'Mira Setiawan', '3171234567890123', 'uploads/mira02@gmail.com/ktp.jpg', 'Pegawai Swasta', '081293822934', 'mira02@gmail.com'),
(6, 'Yuni Kurniasari', '3374136006000001', 'uploads/yunikurnia@gmail.com/ktp.jpg', 'Mahasiswa', '081293844212', 'yunikurnia@gmail.com'),
(7, 'Reza Arianto', '1603120308950001', 'uploads/rezaarianto@gmail.com/ktp.jpg', 'Mahasiswa', '081203924421', 'rezaarianto@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`idA`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `daftarpenduduk`
--
ALTER TABLE `daftarpenduduk`
  ADD KEY `FK-pendaftaran_penduduk` (`idDaftar`),
  ADD KEY `FK-penduduk_penduduk` (`idPenduduk`);

--
-- Indexes for table `datakesehatan`
--
ALTER TABLE `datakesehatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK-datakesehatan` (`idPenduduk`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`idDaftar`);

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`idPenduduk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `idA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `datakesehatan`
--
ALTER TABLE `datakesehatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `idDaftar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `idPenduduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daftarpenduduk`
--
ALTER TABLE `daftarpenduduk`
  ADD CONSTRAINT `FK-pendaftaran_penduduk` FOREIGN KEY (`idDaftar`) REFERENCES `pendaftaran` (`idDaftar`),
  ADD CONSTRAINT `FK-penduduk_penduduk` FOREIGN KEY (`idPenduduk`) REFERENCES `penduduk` (`idPenduduk`);

--
-- Constraints for table `datakesehatan`
--
ALTER TABLE `datakesehatan`
  ADD CONSTRAINT `FK-datakesehatan` FOREIGN KEY (`idPenduduk`) REFERENCES `penduduk` (`idPenduduk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
