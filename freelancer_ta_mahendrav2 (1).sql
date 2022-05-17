-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2022 at 12:41 PM
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

--
-- Dumping data for table `bukti_bayar`
--

INSERT INTO `bukti_bayar` (`id_bukti_bayar`, `idtransaksi`, `waktu_bayar`, `bukti`, `status`) VALUES
(22, 23, '2022-01-05 02:44:44', '1641349716_200.png', 'Gagal'),
(23, 24, '2022-01-05 17:56:31', '1641351391_891.png', 'Proses'),
(24, 23, '2022-01-05 19:19:57', '1641356396_286.png', 'Proses'),
(27, 30, '2022-04-25 18:12:52', '15d.png', 'Proses'),
(28, 30, '2022-05-17 14:31:14', '1652790674_529.png', 'Proses'),
(29, 36, '2022-05-17 14:39:33', '1652791173_784.png', 'Proses');

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

--
-- Dumping data for table `favorit`
--

INSERT INTO `favorit` (`idrumah`, `idpenyewa`) VALUES
(3, 20);

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
(51, '1639437707_236.png', 20),
(52, '1639666708_808.png', 21),
(53, '1640004065_363.png', 22),
(54, '1640004065_527.png', 22),
(55, '1640004140_701.jpg', 23),
(56, '1640004140_941.png', 23),
(57, '1640667451_906.png', 2046),
(58, '1641175692_733.png', 2047),
(59, '1641175692_727.png', 2047),
(60, '1641175692_537.png', 2047),
(61, '1650903805_304.png', 2048),
(62, '1650903805_909.png', 2048),
(63, '1650903805_895.png', 2048),
(64, '1650903805_919.png', 2048);

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
-- Table structure for table `nilai_kriteria`
--

CREATE TABLE `nilai_kriteria` (
  `id_nilai_kriteria` int(11) NOT NULL,
  `kriteria_1` varchar(64) NOT NULL,
  `kriteria_2` varchar(64) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai_kriteria`
--

INSERT INTO `nilai_kriteria` (`id_nilai_kriteria`, `kriteria_1`, `kriteria_2`, `nilai`) VALUES
(982, 'Carport', 'Carport', 1),
(983, 'Carport', 'Kitchen Set', 0.11111111111111),
(984, 'Carport', 'Air Bersih', 0.125),
(985, 'Carport', 'Harga', 0.14285714285714),
(986, 'Carport', 'Jumlah Kamar', 0.16666666666667),
(987, 'Carport', 'Jumlah Kamar Mandi', 0.2),
(988, 'Carport', 'Luas Tanah', 0.25),
(989, 'Carport', 'Luas Bangunan', 0.33333333333333),
(990, 'Carport', 'Daya Listrik', 0.5),
(991, 'Kitchen Set', 'Carport', 9),
(992, 'Kitchen Set', 'Kitchen Set', 1),
(993, 'Kitchen Set', 'Air Bersih', 5),
(994, 'Kitchen Set', 'Harga', 2),
(995, 'Kitchen Set', 'Jumlah Kamar', 4),
(996, 'Kitchen Set', 'Jumlah Kamar Mandi', 7),
(997, 'Kitchen Set', 'Luas Tanah', 8),
(998, 'Kitchen Set', 'Luas Bangunan', 8),
(999, 'Kitchen Set', 'Daya Listrik', 3),
(1000, 'Air Bersih', 'Carport', 8),
(1001, 'Air Bersih', 'Kitchen Set', 0.2),
(1002, 'Air Bersih', 'Air Bersih', 1),
(1003, 'Air Bersih', 'Harga', 3),
(1004, 'Air Bersih', 'Jumlah Kamar', 2),
(1005, 'Air Bersih', 'Jumlah Kamar Mandi', 8),
(1006, 'Air Bersih', 'Luas Tanah', 6),
(1007, 'Air Bersih', 'Luas Bangunan', 5),
(1008, 'Air Bersih', 'Daya Listrik', 4),
(1009, 'Harga', 'Carport', 7),
(1010, 'Harga', 'Kitchen Set', 0.5),
(1011, 'Harga', 'Air Bersih', 0.33333333333333),
(1012, 'Harga', 'Harga', 1),
(1013, 'Harga', 'Jumlah Kamar', 2),
(1014, 'Harga', 'Jumlah Kamar Mandi', 4),
(1015, 'Harga', 'Luas Tanah', 5),
(1016, 'Harga', 'Luas Bangunan', 5),
(1017, 'Harga', 'Daya Listrik', 8),
(1018, 'Jumlah Kamar', 'Carport', 6),
(1019, 'Jumlah Kamar', 'Kitchen Set', 0.25),
(1020, 'Jumlah Kamar', 'Air Bersih', 0.5),
(1021, 'Jumlah Kamar', 'Harga', 0.5),
(1022, 'Jumlah Kamar', 'Jumlah Kamar', 1),
(1023, 'Jumlah Kamar', 'Jumlah Kamar Mandi', 9),
(1024, 'Jumlah Kamar', 'Luas Tanah', 7),
(1025, 'Jumlah Kamar', 'Luas Bangunan', 4),
(1026, 'Jumlah Kamar', 'Daya Listrik', 3),
(1027, 'Jumlah Kamar Mandi', 'Carport', 5),
(1028, 'Jumlah Kamar Mandi', 'Kitchen Set', 0.14285714285714),
(1029, 'Jumlah Kamar Mandi', 'Air Bersih', 0.125),
(1030, 'Jumlah Kamar Mandi', 'Harga', 0.25),
(1031, 'Jumlah Kamar Mandi', 'Jumlah Kamar', 0.11111111111111),
(1032, 'Jumlah Kamar Mandi', 'Jumlah Kamar Mandi', 1),
(1033, 'Jumlah Kamar Mandi', 'Luas Tanah', 3),
(1034, 'Jumlah Kamar Mandi', 'Luas Bangunan', 7),
(1035, 'Jumlah Kamar Mandi', 'Daya Listrik', 9),
(1036, 'Luas Tanah', 'Carport', 4),
(1037, 'Luas Tanah', 'Kitchen Set', 0.125),
(1038, 'Luas Tanah', 'Air Bersih', 0.16666666666667),
(1039, 'Luas Tanah', 'Harga', 0.2),
(1040, 'Luas Tanah', 'Jumlah Kamar', 0.14285714285714),
(1041, 'Luas Tanah', 'Jumlah Kamar Mandi', 0.33333333333333),
(1042, 'Luas Tanah', 'Luas Tanah', 1),
(1043, 'Luas Tanah', 'Luas Bangunan', 8),
(1044, 'Luas Tanah', 'Daya Listrik', 3),
(1045, 'Luas Bangunan', 'Carport', 3),
(1046, 'Luas Bangunan', 'Kitchen Set', 0.125),
(1047, 'Luas Bangunan', 'Air Bersih', 0.2),
(1048, 'Luas Bangunan', 'Harga', 0.2),
(1049, 'Luas Bangunan', 'Jumlah Kamar', 0.25),
(1050, 'Luas Bangunan', 'Jumlah Kamar Mandi', 0.14285714285714),
(1051, 'Luas Bangunan', 'Luas Tanah', 0.125),
(1052, 'Luas Bangunan', 'Luas Bangunan', 1),
(1053, 'Luas Bangunan', 'Daya Listrik', 4),
(1054, 'Daya Listrik', 'Carport', 2),
(1055, 'Daya Listrik', 'Kitchen Set', 0.33333333333333),
(1056, 'Daya Listrik', 'Air Bersih', 0.25),
(1057, 'Daya Listrik', 'Harga', 0.125),
(1058, 'Daya Listrik', 'Jumlah Kamar', 0.33333333333333),
(1059, 'Daya Listrik', 'Jumlah Kamar Mandi', 0.11111111111111),
(1060, 'Daya Listrik', 'Luas Tanah', 0.33333333333333),
(1061, 'Daya Listrik', 'Luas Bangunan', 0.25),
(1062, 'Daya Listrik', 'Daya Listrik', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_rumah_kriteria`
--

CREATE TABLE `nilai_rumah_kriteria` (
  `id_nilai_rumah_kriteria` int(11) NOT NULL,
  `rumah_1` int(11) NOT NULL,
  `rumah_2` int(11) NOT NULL,
  `kriteria` varchar(64) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id_notifikasi`, `notifikasi`, `idpenerima`, `created_at`) VALUES
(6, '{\"type\":\"Konfirmasi Rumah\",\"status\":\"Tolak\",\"message\":\"Proses penambahan rumah ditolak, karenalokasi rumah tidak jelas\"}', 17, '2021-12-28 01:47:00'),
(7, '{\"type\":\"Konfirmasi Rumah\",\"status\":\"Setuju\",\"message\":\"Proses penambahan rumah disetujui\"}', 17, '2022-01-03 03:09:33'),
(8, '{\"type\":\"Konfirmasi Rumah\",\"status\":\"Tolak\",\"message\":\"Proses penambahan rumah ditolak, karena tidak jelas\"}', 17, '2022-01-03 03:10:11'),
(10, '{\"type\":\"Pembayaran\",\"status\":\"Gagal\",\"message\":\"Pemabayaran Rumah Melebihi Batas Waktu Transaksi, Transaksi Telah Dibatalkan Otomatis Oleh Sistem\"}', 21, '2022-04-27 13:19:40'),
(11, '{\"type\":\"Pembayaran\",\"status\":\"Gagal\",\"message\":\"Pemabayaran Rumah Melebihi Batas Waktu Transaksi, Transaksi Telah Dibatalkan Otomatis Oleh Sistem\"}', 23, '2022-05-17 12:30:34'),
(12, '{\"type\":\"Pembayaran\",\"status\":\"Gagal\",\"message\":\"Pemabayaran Rumah Melebihi Batas Waktu Transaksi, Transaksi Telah Dibatalkan Otomatis Oleh Sistem\"}', 23, '2022-05-17 12:34:17'),
(13, '{\"type\":\"Pembayaran\",\"status\":\"Gagal\",\"message\":\"Pemabayaran Rumah Melebihi Batas Waktu Transaksi, Transaksi Telah Dibatalkan Otomatis Oleh Sistem\"}', 23, '2022-05-17 12:35:43'),
(14, '{\"type\":\"Pembayaran\",\"status\":\"Gagal\",\"message\":\"Pemabayaran Rumah Melebihi Batas Waktu Transaksi, Transaksi Telah Dibatalkan Otomatis Oleh Sistem\"}', 23, '2022-05-17 12:36:18');

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
  `air_bersih` enum('Tidak Ada Air Bersih','PDAM','Air Sumur') DEFAULT NULL,
  `carport` enum('Tidak Ada','Ada') DEFAULT NULL,
  `kitchen_set` enum('Tidak Ada','Ada') DEFAULT NULL,
  `status` enum('Disewa','Kosong','Proses','Ditolak') NOT NULL,
  `alasan_tolak` varchar(128) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rumah`
--

INSERT INTO `rumah` (`idrumah`, `id_pemilik`, `alamat`, `kota`, `provinsi`, `keterangan`, `harga`, `luas_tanah`, `luas_bangunan`, `jumlah_kamar`, `jumlah_kamar_mandi`, `daya_listrik`, `air_bersih`, `carport`, `kitchen_set`, `status`, `alasan_tolak`, `deleted_at`) VALUES
(1, 17, 'jalan rumah baru', '', '', 'ini adalah rumah yang baru', 220000000, 1000, 1000, 10, 10, 450, 'Tidak Ada Air Bersih', 'Tidak Ada', 'Tidak Ada', 'Disewa', '', NULL),
(2, 17, 'jalan rumah mewah', '', '', 'ini adalah rumah mewah', 240000000, 300, 500, 10, 10, 450, 'Tidak Ada Air Bersih', 'Tidak Ada', 'Tidak Ada', 'Ditolak', 'tidak jelas', NULL),
(3, 17, 'jalan rumah mewah', '', '', 'ini adalah rumah mewah', 200000000, 200, 800, 10, 10, 450, 'Tidak Ada Air Bersih', 'Tidak Ada', 'Tidak Ada', 'Proses', '', NULL),
(4, 17, 'jalan rumah contoh', '', '', 'ini adalah rumah contoh', 230000000, 400, 600, 10, 10, 450, 'Tidak Ada Air Bersih', 'Tidak Ada', 'Tidak Ada', 'Proses', '', NULL),
(5, 17, 'Koala Regency C-49', 'KABUPATEN SIMEULUE', '11', 'rumah di jalan koala regency c-49', 100000, 10, 10, 10, 10, 450, 'Tidak Ada Air Bersih', 'Tidak Ada', 'Tidak Ada', 'Kosong', '', NULL),
(22, 18, 'Jalan surabaya baru no 123', 'KABUPATEN SIMEULUE', 'ACEH', 'ini adalah rumah yang berlokasi di surabaya', 30000000, 100, 100, 10, 10, 450, 'PDAM', 'Tidak Ada', 'Tidak Ada', 'Kosong', '', NULL),
(23, 18, 'rumah surabaya', 'KOTA SURABAYA', 'JAWA TIMUR', 'rumah di surabaya', 999999999, 100, 100, 10, 10, 450, 'Tidak Ada Air Bersih', 'Tidak Ada', 'Tidak Ada', 'Kosong', '', NULL),
(2046, 17, 'jalan rumah baru no 45', 'KABUPATEN TAPANULI UTARA', 'SUMATERA UTARA', 'tidak ada rumah disini', 1000000, 2000, 1000, 5, 5, 900, 'PDAM', 'Ada', 'Ada', 'Kosong', NULL, NULL),
(2047, 17, 'tidak ada alamat', 'KABUPATEN SIMEULUE', 'ACEH', 'rumah ini tidak ada alamatnya', 1000000, 1000, 1000, 1, 2, 450, 'Tidak Ada Air Bersih', 'Tidak Ada', 'Tidak Ada', 'Kosong', NULL, NULL),
(2048, 22, 'jalan 123 456', 'KABUPATEN SIMEULUE', 'ACEH', 'tidak ada', 1000000, 1000, 1000, 1, 1, 450, 'PDAM', NULL, 'Ada', 'Disewa', NULL, NULL);

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
  `dp` bigint(16) NOT NULL,
  `status` enum('Proses Pembayaran','Proses Verifikasi Pembayaran','Selesai Sewa','Pembayaran Berhasil','Pembayaran Gagal') NOT NULL,
  `waktu_transaksi` timestamp NOT NULL DEFAULT current_timestamp(),
  `batas_waktu_transaksi` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaksi_sewa`
--

INSERT INTO `transaksi_sewa` (`id_transaksi_sewa`, `idrumah`, `iduser`, `lama_sewa`, `mulai_sewa`, `selesai_sewa`, `total`, `dp`, `status`, `waktu_transaksi`, `batas_waktu_transaksi`) VALUES
(23, 3, 21, 5, '2022-04-27 13:19:40', '2027-01-15 08:00:00', 1000000000, 0, 'Pembayaran Gagal', '2022-04-25 15:40:51', '2022-04-28 08:05:22'),
(24, 3, 21, 5, '2022-04-27 13:14:49', '2027-01-06 08:00:00', 1000000000, 0, 'Proses Verifikasi Pembayaran', '2022-04-25 15:40:51', NULL),
(30, 3, 21, 10, '2022-04-25 16:12:53', '2032-04-02 07:00:00', 2000000000, 1500000000, 'Proses Verifikasi Pembayaran', '2022-04-25 15:53:25', NULL),
(31, 4, 23, 1, '2022-05-17 12:30:34', '2023-05-07 07:00:00', 230000000, 100000, 'Pembayaran Gagal', '2022-05-17 12:30:34', '2022-05-19 02:30:34'),
(32, 4, 23, 1, '2022-05-17 12:34:16', '2023-05-07 07:00:00', 230000000, 100000, 'Pembayaran Gagal', '2022-05-17 12:34:16', '2022-05-19 02:34:16'),
(33, 4, 23, 2, '2022-05-17 12:35:43', '2024-05-07 07:00:00', 460000000, 200000, 'Pembayaran Gagal', '2022-05-17 12:35:42', '2022-05-19 02:35:42'),
(34, 4, 23, 2, '2022-05-17 12:36:18', '2024-05-07 07:00:00', 460000000, 200000, 'Pembayaran Gagal', '2022-05-17 12:36:17', '2022-05-19 02:36:17'),
(35, 4, 23, 3, '2022-05-07 07:00:00', '2025-05-07 07:00:00', 690000000, 100000, 'Proses Pembayaran', '2022-05-17 12:37:14', '2022-05-19 02:37:14'),
(36, 4, 23, 2, '2022-05-17 12:39:33', '2024-05-07 07:00:00', 460000000, 100000, 'Proses Verifikasi Pembayaran', '2022-05-17 12:38:05', '2022-05-19 02:38:05');

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
(13, 'mahendra', '$2y$10$xMs5wJf/HUUa4c9xGMbBh.YtqtCQ.obxP.pkeWZP7H3Mi7UW5A.PG', 'mahendra', 'pemilik', 'mahendrasaputra@gmail.com', '0812341110', NULL, NULL, NULL),
(14, 'ahmad', '$2y$10$yYK43dGfL7f1qqCgdiv1WuiomO9Gb.ZqvEwTHQ.O/TNJy42KH7wTi', 'ahmad', 'penyewa', 'ahmad@gmail.com', '012859127154', NULL, NULL, NULL),
(17, 'member', '$2y$10$dabf.McBZLC/MR0Gn0d2dukW6nvGkNlG465DsXlOtfHGhkD2u1DQi', 'member', 'admin', 'member@gmail.com', '083857006866', '123', NULL, NULL),
(18, 'admin', '$2y$10$mbc1PEE2iqnqM8Buj8OvTOy8OU45mMmIIoLJyzFoGEmz8/GJ50Fx2', 'admin', 'pemilik', 'admin@gmail.com', '8489898888888', '123', NULL, NULL),
(19, 'pemilik', '$2y$10$BLALxrxRnu9ZPsgIBsRT8uMA90dCel6iHvKkDHeYq.EO5xig/4mwe', 'pemilik', 'pemilik', 'pemilik@gmail.com', '0192929292929', NULL, NULL, NULL),
(20, 'penyewa', '$2y$10$FPyqZJZ.LL0deWhPkJIkIelc8aSoK4uRBL3ZL0OUaCcsCooFitdy6', 'penyewa', 'penyewa', 'penyewa@gmail.com', '9429492492492', NULL, NULL, NULL),
(21, 'alvin123', '$2y$10$ny0BOGuEZPAUL4ZFVGFehecCBCWo39rzICnH5kLfyGkbTwc2wO3.a', 'Alvin', 'penyewa', 'alvin@gmail.com', '1234567890', NULL, NULL, NULL),
(22, 'kevin123', '$2y$10$EKMd/iFa27p7WsgKZ5xrweVONZXGRmFIqFPwaHa6pYq1E1p51Ou.W', 'kevin', 'pemilik', 'kevin@gmail.com', '02020202020', NULL, NULL, NULL),
(23, 'test123', '$2y$10$tAl29TjtIGMzdCcWNvsW1.O1EAT2HSRlAVMd60JcmQd7R2s2EYRqW', 'test', 'admin', 'test@gmail.com', '0123666999222', NULL, NULL, NULL);

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
-- Indexes for table `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  ADD PRIMARY KEY (`id_nilai_kriteria`);

--
-- Indexes for table `nilai_rumah_kriteria`
--
ALTER TABLE `nilai_rumah_kriteria`
  ADD PRIMARY KEY (`id_nilai_rumah_kriteria`),
  ADD KEY `rumah_1` (`rumah_1`),
  ADD KEY `rumah_2` (`rumah_2`);

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
  MODIFY `id_bukti_bayar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
  MODIFY `idgambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  MODIFY `id_nilai_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1063;

--
-- AUTO_INCREMENT for table `nilai_rumah_kriteria`
--
ALTER TABLE `nilai_rumah_kriteria`
  MODIFY `id_nilai_rumah_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1576;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `reminder`
--
ALTER TABLE `reminder`
  MODIFY `idreminder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `rumah`
--
ALTER TABLE `rumah`
  MODIFY `idrumah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2049;

--
-- AUTO_INCREMENT for table `transaksi_sewa`
--
ALTER TABLE `transaksi_sewa`
  MODIFY `id_transaksi_sewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
