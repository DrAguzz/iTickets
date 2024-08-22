-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2024 at 09:28 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kvkualas_bas`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `id_admin` varchar(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `katalaluan` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `id_admin`, `nama`, `katalaluan`, `role`) VALUES
(1, 'admin', 'ERFAN BAGUS', 'admin', '1');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id_program` int(11) NOT NULL,
  `year` varchar(50) NOT NULL,
  `course` varchar(60) NOT NULL,
  `program` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id_program`, `year`, `course`, `program`) VALUES
(1, 'TAHUN 1 SIJIL VOKASIONAL MALAYSIA', 'PERAKAUNAN', '1 SVM BAK'),
(2, 'TAHUN 2 SIJIL VOKASIONAL MALAYSIA', 'PERAKAUNAN', '2 SVM BAK'),
(3, 'TAHUN 1 DIPLOMA VOKASIONAL MALAYSIA', 'PERAKAUNAN', '1 DVM BAK'),
(4, 'TAHUN 2 DIPLOMA VOKASIONAL MALAYSIA', 'PERAKAUNAN', '2 DVM BAK'),
(7, 'TAHUN 1 SIJIL VOKASIONAL MALAYSIA', 'PEMASARAN', '1 SVM BPM'),
(8, 'TAHUN 2 SIJIL VOKASIONAL MALAYSIA', 'PEMASARAN', '2 SVM BPM'),
(9, 'TAHUN 1 DIPLOMA VOKASIONAL MALAYSIA', 'PEMASARAN', '1 DVM BPM'),
(10, 'TAHUN 2 DIPLOMA VOKASIONAL MALAYSIA', 'PEMASARAN', '2 DVM BPM'),
(11, 'TAHUN 1 SIJIL VOKASIONAL MALAYSIA', 'SENI KULINARI', '1 SVM HSK'),
(12, 'TAHUN 2 SIJIL VOKASIONAL MALAYSIA', 'SENI KULINARI', '2 SVM HSK'),
(13, 'TAHUN 1 DIPLOMA VOKASIONAL MALAYSIA', 'SENI KULINARI', '1 DVM HSK'),
(14, 'TAHUN 2 DIPLOMA VOKASIONAL MALAYSIA', 'SENI KULINARI', '2 DVM HSK'),
(15, 'TAHUN 1 SIJIL VOKASIONAL MALAYSIA', 'BAKERI & PASTERI', '1 SVM HBP'),
(16, 'TAHUN 2 SIJIL VOKASIONAL MALAYSIA', 'BAKERI & PASTERI', '2 SVM HBP'),
(17, 'TAHUN 1 DIPLOMA VOKASIONAL MALAYSIA', 'BAKERI & PASTERI', '1 DVM HBP'),
(18, 'TAHUN 2 DIPLOMA VOKASIONAL MALAYSIA', 'BAKERI & PASTERI', '2 DVM HBP'),
(23, 'TAHUN 1 SIJIL VOKASIONAL MALAYSIA', 'TEKNOLOGI SISTEM PENGURUSAN PANGKALAN DATA & APLIKASI WEB', '1 SVM KPD'),
(24, 'TAHUN 2 SIJIL VOKASIONAL MALAYSIA', 'TEKNOLOGI SISTEM PENGURUSAN PANGKALAN DATA & APLIKASI WEB', '2 SVM KPD'),
(25, 'TAHUN 1 DIPLOMA VOKASIONAL MALAYSIA', 'TEKNOLOGI SISTEM PENGURUSAN PANGKALAN DATA & APLIKASI WEB', '1 DVM KPD'),
(26, 'TAHUN 2 DIPLOMA VOKASIONAL MALAYSIA', 'TEKNOLOGI SISTEM PENGURUSAN PANGKALAN DATA & APLIKASI WEB', '2 DVM KPD'),
(27, 'TAHUN 1 SIJIL VOKASIONAL MALAYSIA', 'MULTIMEDIA KREATIF ANIMASI', '1 SVM KMK'),
(28, 'TAHUN 2 SIJIL VOKASIONAL MALAYSIA', 'MULTIMEDIA KREATIF ANIMASI', '2 SVM KMK'),
(29, 'TAHUN 1 DIPLOMA VOKASIONAL MALAYSIA', 'MULTIMEDIA KREATIF ANIMASI', '1 DVM KMK'),
(30, 'TAHUN 2 DIPLOMA VOKASIONAL MALAYSIA', 'MULTIMEDIA KREATIF ANIMASI', '2 DVM KMK'),
(31, 'TAHUN 1 SISTEM LATIHAN DUAL NASIONAL', 'OPERASI PEMBUATAN PERABOT', '1 SLDN OPP'),
(32, 'TAHUN 2 SISTEM LATIHAN DUAL NASIONAL', 'OPERASI PEMBUATAN PERABOT', '2 SLDN OPP');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id_tkt` int(11) NOT NULL,
  `id_vehicle` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `method` varchar(50) NOT NULL,
  `reciept` varchar(225) DEFAULT NULL,
  `amount` int(11) NOT NULL DEFAULT 1,
  `date` date DEFAULT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0(pending) | 1(done) | 2(cancel)',
  `attendance` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1(blom naik) | 2(dh naik)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id_tkt`, `id_vehicle`, `id_user`, `method`, `reciept`, `amount`, `date`, `status`, `attendance`) VALUES
(41, 1, 9, 'Tunai', NULL, 1, '2024-08-07', '1', '1'),
(44, 11, 10, 'Tunai', NULL, 1, NULL, '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `nric` varchar(12) NOT NULL,
  `nrtel` varchar(13) NOT NULL,
  `email` varchar(35) NOT NULL,
  `id_program` int(11) NOT NULL,
  `name_father` varchar(100) NOT NULL,
  `nrtel_father` varchar(13) NOT NULL,
  `name_mother` varchar(100) NOT NULL,
  `nrtel_mother` varchar(13) NOT NULL,
  `role` enum('0','1','2','3') NOT NULL DEFAULT '0' COMMENT '0 (student) | 1 (mpp) | 2 (exco kebajikan) | 3 (super admin)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `name`, `nric`, `nrtel`, `email`, `id_program`, `name_father`, `nrtel_father`, `name_mother`, `nrtel_mother`, `role`) VALUES
(9, 'ERFAN BAGUS', '060813100709', '0102135831', 'erfanbagus06@gmail.com', 25, 'NURAINI BIN KASAN', '0162821106', 'KHOSNAWATI', '0162147274', '0'),
(10, 'TEST', '010101010101', '0102135831', 'erfanbagus06@gmail.com', 16, 'ADMIN', '0102135831', 'ADMIN', '0102135831', '0');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id_vehicle` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `date` date DEFAULT NULL,
  `seat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id_vehicle`, `type`, `date`, `seat`) VALUES
(1, 'BAS', '2024-08-09', 40),
(11, 'Van', '2024-08-09', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id_program`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id_tkt`),
  ADD UNIQUE KEY `id_std` (`id_user`),
  ADD KEY `id_vehicle` (`id_vehicle`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `no_kp` (`nric`),
  ADD KEY `id_program` (`id_program`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id_vehicle`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id_program` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id_tkt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id_vehicle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
