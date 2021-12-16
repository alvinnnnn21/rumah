-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2021 at 02:37 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `freelancer_ta_mahendrav2`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `idbooking` int(11) NOT NULL,
  `idrumah` int(11) NOT NULL,
  `idpenyewa` int(11) NOT NULL,
  `fee` int(11) DEFAULT NULL,
  `keterangan` longtext DEFAULT NULL,
  `bukti_pembayaran` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bukti_bayar`
--

CREATE TABLE `bukti_bayar` (
  `id_bukti_bayar` int(11) NOT NULL,
  `idtransaksi` int(11) NOT NULL,
  `waktu_bayar` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `bukti` varchar(45) NOT NULL,
  `status` enum('Proses','Berhasil','Gagal','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `idchat` int(11) NOT NULL,
  `idpemilik` int(11) NOT NULL,
  `idpenyewa` int(11) NOT NULL,
  `status` enum('Aktif','Tidak Aktif','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `detail_chat`
--

CREATE TABLE `detail_chat` (
  `iddetail_chat` int(11) NOT NULL,
  `idpengirim` int(11) NOT NULL,
  `pesan` longtext NOT NULL,
  `waktu` datetime NOT NULL,
  `idchat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `favorit`
--

CREATE TABLE `favorit` (
  `idrumah` int(11) NOT NULL,
  `idpenyewa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gambar`
--

CREATE TABLE `gambar` (
  `idgambar` int(11) NOT NULL,
  `gambar` varchar(45) NOT NULL,
  `idrumah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gambar`
--

INSERT INTO `gambar` (`idgambar`, `gambar`, `idrumah`) VALUES
(37, '1639413302_818.jpg', 13),
(38, '1639413440_17.jpg', 14),
(39, '1639413440_628.jpg', 14),
(40, '1639413440_111.jpg', 14),
(41, '1639413568_40.jpg', 15),
(42, '1639416739_368.jpg', 16),
(43, '1639437512_848.png', 17),
(44, '1639437512_582.PNG', 17),
(45, '1639437513_628.png', 17),
(46, '1639437550_626.png', 18),
(47, '1639437550_327.png', 18),
(48, '1639437550_383.png', 19),
(49, '1639437550_956.png', 19),
(50, '1639437707_576.png', 20),
(51, '1639437707_236.png', 20);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` int(11) NOT NULL,
  `notifikasi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`notifikasi`)),
  `idpenerima` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reminder`
--

CREATE TABLE `reminder` (
  `idreminder` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `acara` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reminder`
--

INSERT INTO `reminder` (`idreminder`, `iduser`, `date`, `time`, `acara`) VALUES
(27, 17, '2021-12-13', '15:46:00', 'testing');

-- --------------------------------------------------------

--
-- Table structure for table `rumah`
--

CREATE TABLE `rumah` (
  `idrumah` int(11) NOT NULL,
  `id_pemilik` int(11) NOT NULL,
  `alamat` varchar(64) DEFAULT NULL,
  `kota` varchar(64) NOT NULL,
  `provinsi` varchar(64) NOT NULL,
  `keterangan` longtext DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `luas_tanah` double DEFAULT NULL,
  `luas_bangunan` double DEFAULT NULL,
  `jumlah_kamar` int(11) DEFAULT NULL,
  `jumlah_kamar_mandi` int(11) DEFAULT NULL,
  `daya_listrik` int(11) DEFAULT NULL,
  `air_bersih` enum('Tidak Ada','Ada') DEFAULT NULL,
  `carport` enum('Tidak Ada','Ada') DEFAULT NULL,
  `kitchen_set` enum('Tidak Ada','Ada') DEFAULT NULL,
  `status` enum('Disewa','Kosong','Proses') NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rumah`
--

INSERT INTO `rumah` (`idrumah`, `id_pemilik`, `alamat`, `kota`, `provinsi`, `keterangan`, `harga`, `luas_tanah`, `luas_bangunan`, `jumlah_kamar`, `jumlah_kamar_mandi`, `daya_listrik`, `air_bersih`, `carport`, `kitchen_set`, `status`, `deleted_at`) VALUES
(17, 17, 'jalan rumah baru', '', '', 'ini adalah rumah yang baru', 220000000, 1000, 1000, NULL, 10, 1000, 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'Proses', NULL),
(18, 17, 'jalan rumah mewah', '', '', 'ini adalah rumah mewah', 220000000, 10, 10, NULL, 10, 10, 'Ada', 'Ada', 'Ada', 'Kosong', NULL),
(19, 17, 'jalan rumah mewah', '', '', 'ini adalah rumah mewah', 220000000, 10, 10, NULL, 10, 10, 'Ada', 'Ada', 'Ada', 'Kosong', NULL),
(20, 17, 'jalan rumah contoh', '', '', 'ini adalah rumah contoh', 230000000, 10, 10, 10, 10, 1000, 'Tidak Ada', 'Ada', 'Tidak Ada', 'Kosong', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_sewa`
--

CREATE TABLE `transaksi_sewa` (
  `id_transaksi_sewa` int(11) NOT NULL,
  `idrumah` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `lama_sewa` int(11) NOT NULL,
  `mulai_sewa` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `selesai_sewa` timestamp NULL DEFAULT NULL,
  `total` bigint(16) NOT NULL,
  `status` enum('Proses Pembayaran','Proses Verifikasi Pembayaran','Selesai Sewa','Pembayaran Berhasil') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `roles` enum('admin','penyewa','pemilik') DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `no_telpon` varchar(45) NOT NULL,
  `no_rekening` varchar(45) DEFAULT NULL,
  `bank` varchar(64) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `username`, `password`, `nama`, `roles`, `email`, `no_telpon`, `no_rekening`, `bank`, `deleted_at`) VALUES
(12, 'admin', '$2y$10$/Psfd7bzWw55tsqcUeguNOGiA8F3mC0WgPFeMD.7Ev1PV0MhjF5yS', 'admin', 'admin', 'admin@gmail.com', '08120947123', NULL, NULL, NULL),
(13, 'mahendra', '$2y$10$xMs5wJf/HUUa4c9xGMbBh.YtqtCQ.obxP.pkeWZP7H3Mi7UW5A.PG', 'mahendra', 'pemilik', 'mahendrasaputra@gmail.com', '0812341110', NULL, NULL, NULL),
(14, 'ahmad', '$2y$10$yYK43dGfL7f1qqCgdiv1WuiomO9Gb.ZqvEwTHQ.O/TNJy42KH7wTi', 'ahmad', 'penyewa', 'ahmad@gmail.com', '012859127154', NULL, NULL, NULL),
(17, 'member', '$2y$10$dabf.McBZLC/MR0Gn0d2dukW6nvGkNlG465DsXlOtfHGhkD2u1DQi', 'member', 'pemilik', 'member@gmail.com', '083857006866', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`idbooking`),
  ADD KEY `fk_booking_rumah1_idx` (`idrumah`),
  ADD KEY `fk_booking_users1_idx` (`idpenyewa`);

--
-- Indexes for table `bukti_bayar`
--
ALTER TABLE `bukti_bayar`
  ADD PRIMARY KEY (`id_bukti_bayar`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`idchat`),
  ADD KEY `idpemilik` (`idpemilik`),
  ADD KEY `idpenyewa` (`idpenyewa`);

--
-- Indexes for table `detail_chat`
--
ALTER TABLE `detail_chat`
  ADD PRIMARY KEY (`iddetail_chat`),
  ADD KEY `idchat` (`idchat`),
  ADD KEY `idpengirim` (`idpengirim`);

--
-- Indexes for table `favorit`
--
ALTER TABLE `favorit`
  ADD PRIMARY KEY (`idrumah`,`idpenyewa`),
  ADD KEY `fk_rumah_has_users_users1_idx` (`idpenyewa`),
  ADD KEY `fk_rumah_has_users_rumah1_idx` (`idrumah`);

--
-- Indexes for table `gambar`
--
ALTER TABLE `gambar`
  ADD PRIMARY KEY (`idgambar`),
  ADD KEY `idrumah` (`idrumah`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`);

--
-- Indexes for table `reminder`
--
ALTER TABLE `reminder`
  ADD PRIMARY KEY (`idreminder`),
  ADD KEY `iduser` (`iduser`);

--
-- Indexes for table `rumah`
--
ALTER TABLE `rumah`
  ADD PRIMARY KEY (`idrumah`),
  ADD KEY `fk_rumah_users1_idx` (`id_pemilik`);

--
-- Indexes for table `transaksi_sewa`
--
ALTER TABLE `transaksi_sewa`
  ADD PRIMARY KEY (`id_transaksi_sewa`),
  ADD KEY `idrumah` (`idrumah`),
  ADD KEY `iduser` (`iduser`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `idbooking` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bukti_bayar`
--
ALTER TABLE `bukti_bayar`
  MODIFY `id_bukti_bayar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `idchat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `detail_chat`
--
ALTER TABLE `detail_chat`
  MODIFY `iddetail_chat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `gambar`
--
ALTER TABLE `gambar`
  MODIFY `idgambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reminder`
--
ALTER TABLE `reminder`
  MODIFY `idreminder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `rumah`
--
ALTER TABLE `rumah`
  MODIFY `idrumah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `transaksi_sewa`
--
ALTER TABLE `transaksi_sewa`
  MODIFY `id_transaksi_sewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_booking_rumah1` FOREIGN KEY (`idrumah`) REFERENCES `rumah` (`idrumah`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_booking_users1` FOREIGN KEY (`idpenyewa`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`idpemilik`) REFERENCES `user` (`iduser`),
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`idpenyewa`) REFERENCES `user` (`iduser`);

--
-- Constraints for table `detail_chat`
--
ALTER TABLE `detail_chat`
  ADD CONSTRAINT `detail_chat_ibfk_1` FOREIGN KEY (`idpengirim`) REFERENCES `user` (`iduser`),
  ADD CONSTRAINT `detail_chat_ibfk_2` FOREIGN KEY (`idchat`) REFERENCES `chat` (`idchat`);

--
-- Constraints for table `favorit`
--
ALTER TABLE `favorit`
  ADD CONSTRAINT `fk_rumah_has_users_rumah1` FOREIGN KEY (`idrumah`) REFERENCES `rumah` (`idrumah`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rumah_has_users_users1` FOREIGN KEY (`idpenyewa`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rumah`
--
ALTER TABLE `rumah`
  ADD CONSTRAINT `fk_rumah_users1` FOREIGN KEY (`id_pemilik`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
