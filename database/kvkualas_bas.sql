-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2026 at 05:40 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
  `nrtel` varchar(12) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `id_admin`, `nama`, `katalaluan`, `nrtel`, `role`) VALUES
(37, 'admin', 'ADMIN', '$2y$10$oyU2W.n8DVgyyhujJx/cJ.5IXye99WRebLWMXLUwFevu9drOcaDHm', '0102135831', '0'),
(52, 'nisa', 'NISA', '$2y$10$662MpJxv7QtqrCak4/J5quPdCYKYDrmAaYFe7yLXvL9eeEU4uyI8a', '0102135831', '1'),
(53, 'agus', 'ERFAN BAGUS PRASETYO BIN NURAI', '$2y$10$t8h8xvxCjqCcP2rOLV8icOIGqziKsZ6TvOzfrUJi8cvNnQ92wzwCC', '0102135831', '0');

-- --------------------------------------------------------

--
-- Table structure for table `payment_qr`
--

CREATE TABLE `payment_qr` (
  `id` int(11) NOT NULL,
  `qr_image` varchar(255) NOT NULL,
  `qr_name` varchar(100) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_qr`
--

INSERT INTO `payment_qr` (`id`, `qr_image`, `qr_name`, `updated_at`, `updated_by`) VALUES
(4, 'qrcode_1767176943.jpeg', 'Touch n Go QR Code', '2025-12-31 10:29:03', 9);

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
(10, 'TEST', '010101010101', '0102135831', 'erfanbagus06@gmail.com', 16, 'ADMIN', '0102135831', 'ADMIN', '0102135831', '0'),
(11, 'MUHAMMAD AMAR BIN MOHD FHAIZAL', '060211030029', '0104416261', 'muhammadamar4111@gmail.com', 13, 'MOHD FHAIZAL', '', 'SANIAH BINTI ISMAIL', '0168166261', '0'),
(12, 'ADAM MUKHRIZZ', '060513100709', '0102135831', 'adammukhriz@gmail.com', 25, 'JALIL ', '999', 'IBU', '010', '0');

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
(30, 'Bas', '2026-01-10', 40);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_qr`
--
ALTER TABLE `payment_qr`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_by` (`updated_by`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `payment_qr`
--
ALTER TABLE `payment_qr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id_program` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id_tkt` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id_vehicle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment_qr`
--
ALTER TABLE `payment_qr`
  ADD CONSTRAINT `payment_qr_ibfk_1` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
