-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2021 at 07:28 AM
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
(51, '1639437707_236.png', 20),
(52, '1639666708_808.png', 21),
(53, '1640004065_363.png', 22),
(54, '1640004065_527.png', 22),
(55, '1640004140_701.jpg', 23),
(56, '1640004140_941.png', 23),
(57, '1640667451_906.png', 2046);

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
(820, 'Carport', 'Carport', 1),
(821, 'Carport', 'Kitchen Set', 2),
(822, 'Carport', 'Air Bersih', 3),
(823, 'Carport', 'Harga', 5),
(824, 'Carport', 'Jumlah Kamar', 2),
(825, 'Carport', 'Jumlah Kamar Mandi', 4),
(826, 'Carport', 'Luas Tanah', 9),
(827, 'Carport', 'Luas Bangunan', 1),
(828, 'Carport', 'Daya Listrik', 1),
(829, 'Kitchen Set', 'Carport', 0.5),
(830, 'Kitchen Set', 'Kitchen Set', 1),
(831, 'Kitchen Set', 'Air Bersih', 5),
(832, 'Kitchen Set', 'Harga', 2),
(833, 'Kitchen Set', 'Jumlah Kamar', 4),
(834, 'Kitchen Set', 'Jumlah Kamar Mandi', 7),
(835, 'Kitchen Set', 'Luas Tanah', 8),
(836, 'Kitchen Set', 'Luas Bangunan', 8),
(837, 'Kitchen Set', 'Daya Listrik', 3),
(838, 'Air Bersih', 'Carport', 0.33333333333333),
(839, 'Air Bersih', 'Kitchen Set', 0.2),
(840, 'Air Bersih', 'Air Bersih', 1),
(841, 'Air Bersih', 'Harga', 3),
(842, 'Air Bersih', 'Jumlah Kamar', 2),
(843, 'Air Bersih', 'Jumlah Kamar Mandi', 8),
(844, 'Air Bersih', 'Luas Tanah', 6),
(845, 'Air Bersih', 'Luas Bangunan', 5),
(846, 'Air Bersih', 'Daya Listrik', 4),
(847, 'Harga', 'Carport', 0.2),
(848, 'Harga', 'Kitchen Set', 0.5),
(849, 'Harga', 'Air Bersih', 0.33333333333333),
(850, 'Harga', 'Harga', 1),
(851, 'Harga', 'Jumlah Kamar', 2),
(852, 'Harga', 'Jumlah Kamar Mandi', 4),
(853, 'Harga', 'Luas Tanah', 5),
(854, 'Harga', 'Luas Bangunan', 5),
(855, 'Harga', 'Daya Listrik', 8),
(856, 'Jumlah Kamar', 'Carport', 0.5),
(857, 'Jumlah Kamar', 'Kitchen Set', 0.25),
(858, 'Jumlah Kamar', 'Air Bersih', 0.5),
(859, 'Jumlah Kamar', 'Harga', 0.5),
(860, 'Jumlah Kamar', 'Jumlah Kamar', 1),
(861, 'Jumlah Kamar', 'Jumlah Kamar Mandi', 9),
(862, 'Jumlah Kamar', 'Luas Tanah', 7),
(863, 'Jumlah Kamar', 'Luas Bangunan', 4),
(864, 'Jumlah Kamar', 'Daya Listrik', 3),
(865, 'Jumlah Kamar Mandi', 'Carport', 0.25),
(866, 'Jumlah Kamar Mandi', 'Kitchen Set', 0.14285714285714),
(867, 'Jumlah Kamar Mandi', 'Air Bersih', 0.125),
(868, 'Jumlah Kamar Mandi', 'Harga', 0.25),
(869, 'Jumlah Kamar Mandi', 'Jumlah Kamar', 0.11111111111111),
(870, 'Jumlah Kamar Mandi', 'Jumlah Kamar Mandi', 1),
(871, 'Jumlah Kamar Mandi', 'Luas Tanah', 3),
(872, 'Jumlah Kamar Mandi', 'Luas Bangunan', 7),
(873, 'Jumlah Kamar Mandi', 'Daya Listrik', 9),
(874, 'Luas Tanah', 'Carport', 0.11111111111111),
(875, 'Luas Tanah', 'Kitchen Set', 0.125),
(876, 'Luas Tanah', 'Air Bersih', 0.16666666666667),
(877, 'Luas Tanah', 'Harga', 0.2),
(878, 'Luas Tanah', 'Jumlah Kamar', 0.14285714285714),
(879, 'Luas Tanah', 'Jumlah Kamar Mandi', 0.33333333333333),
(880, 'Luas Tanah', 'Luas Tanah', 1),
(881, 'Luas Tanah', 'Luas Bangunan', 8),
(882, 'Luas Tanah', 'Daya Listrik', 3),
(883, 'Luas Bangunan', 'Carport', 1),
(884, 'Luas Bangunan', 'Kitchen Set', 0.125),
(885, 'Luas Bangunan', 'Air Bersih', 0.2),
(886, 'Luas Bangunan', 'Harga', 0.2),
(887, 'Luas Bangunan', 'Jumlah Kamar', 0.25),
(888, 'Luas Bangunan', 'Jumlah Kamar Mandi', 0.14285714285714),
(889, 'Luas Bangunan', 'Luas Tanah', 0.125),
(890, 'Luas Bangunan', 'Luas Bangunan', 1),
(891, 'Luas Bangunan', 'Daya Listrik', 4),
(892, 'Daya Listrik', 'Carport', 1),
(893, 'Daya Listrik', 'Kitchen Set', 0.33333333333333),
(894, 'Daya Listrik', 'Air Bersih', 0.25),
(895, 'Daya Listrik', 'Harga', 0.125),
(896, 'Daya Listrik', 'Jumlah Kamar', 0.33333333333333),
(897, 'Daya Listrik', 'Jumlah Kamar Mandi', 0.11111111111111),
(898, 'Daya Listrik', 'Luas Tanah', 0.33333333333333),
(899, 'Daya Listrik', 'Luas Bangunan', 0.25),
(900, 'Daya Listrik', 'Daya Listrik', 1);

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

--
-- Dumping data for table `nilai_rumah_kriteria`
--

INSERT INTO `nilai_rumah_kriteria` (`id_nilai_rumah_kriteria`, `rumah_1`, `rumah_2`, `kriteria`, `nilai`) VALUES
(1351, 17, 17, 'Carport', 1),
(1352, 17, 18, 'Carport', 1),
(1353, 17, 19, 'Carport', 4),
(1354, 17, 20, 'Carport', 5),
(1355, 17, 21, 'Carport', 5),
(1356, 18, 17, 'Carport', 1),
(1357, 18, 18, 'Carport', 1),
(1358, 18, 19, 'Carport', 7),
(1359, 18, 20, 'Carport', 5),
(1360, 18, 21, 'Carport', 6),
(1361, 19, 17, 'Carport', 0.25),
(1362, 19, 18, 'Carport', 0.14285714285714),
(1363, 19, 19, 'Carport', 1),
(1364, 19, 20, 'Carport', 8),
(1365, 19, 21, 'Carport', 5),
(1366, 20, 17, 'Carport', 0.2),
(1367, 20, 18, 'Carport', 0.2),
(1368, 20, 19, 'Carport', 0.125),
(1369, 20, 20, 'Carport', 1),
(1370, 20, 21, 'Carport', 8),
(1371, 21, 17, 'Carport', 0.2),
(1372, 21, 18, 'Carport', 0.16666666666667),
(1373, 21, 19, 'Carport', 0.2),
(1374, 21, 20, 'Carport', 0.125),
(1375, 21, 21, 'Carport', 1),
(1376, 17, 17, 'Kitchen Set', 1),
(1377, 17, 18, 'Kitchen Set', 2),
(1378, 17, 19, 'Kitchen Set', 3),
(1379, 17, 20, 'Kitchen Set', 5),
(1380, 17, 21, 'Kitchen Set', 7),
(1381, 18, 17, 'Kitchen Set', 0.5),
(1382, 18, 18, 'Kitchen Set', 1),
(1383, 18, 19, 'Kitchen Set', 4),
(1384, 18, 20, 'Kitchen Set', 7),
(1385, 18, 21, 'Kitchen Set', 9),
(1386, 19, 17, 'Kitchen Set', 0.33333333333333),
(1387, 19, 18, 'Kitchen Set', 0.25),
(1388, 19, 19, 'Kitchen Set', 1),
(1389, 19, 20, 'Kitchen Set', 8),
(1390, 19, 21, 'Kitchen Set', 2),
(1391, 20, 17, 'Kitchen Set', 0.2),
(1392, 20, 18, 'Kitchen Set', 0.14285714285714),
(1393, 20, 19, 'Kitchen Set', 0.125),
(1394, 20, 20, 'Kitchen Set', 1),
(1395, 20, 21, 'Kitchen Set', 1),
(1396, 21, 17, 'Kitchen Set', 0.14285714285714),
(1397, 21, 18, 'Kitchen Set', 0.11111111111111),
(1398, 21, 19, 'Kitchen Set', 0.5),
(1399, 21, 20, 'Kitchen Set', 1),
(1400, 21, 21, 'Kitchen Set', 1),
(1401, 17, 17, 'Air Bersih', 1),
(1402, 17, 18, 'Air Bersih', 5),
(1403, 17, 19, 'Air Bersih', 5),
(1404, 17, 20, 'Air Bersih', 3),
(1405, 17, 21, 'Air Bersih', 2),
(1406, 18, 17, 'Air Bersih', 0.2),
(1407, 18, 18, 'Air Bersih', 1),
(1408, 18, 19, 'Air Bersih', 7),
(1409, 18, 20, 'Air Bersih', 5),
(1410, 18, 21, 'Air Bersih', 8),
(1411, 19, 17, 'Air Bersih', 0.2),
(1412, 19, 18, 'Air Bersih', 0.14285714285714),
(1413, 19, 19, 'Air Bersih', 1),
(1414, 19, 20, 'Air Bersih', 9),
(1415, 19, 21, 'Air Bersih', 3),
(1416, 20, 17, 'Air Bersih', 0.33333333333333),
(1417, 20, 18, 'Air Bersih', 0.2),
(1418, 20, 19, 'Air Bersih', 0.11111111111111),
(1419, 20, 20, 'Air Bersih', 1),
(1420, 20, 21, 'Air Bersih', 6),
(1421, 21, 17, 'Air Bersih', 0.5),
(1422, 21, 18, 'Air Bersih', 0.125),
(1423, 21, 19, 'Air Bersih', 0.33333333333333),
(1424, 21, 20, 'Air Bersih', 0.16666666666667),
(1425, 21, 21, 'Air Bersih', 1),
(1426, 17, 17, 'Harga', 1),
(1427, 17, 18, 'Harga', 8),
(1428, 17, 19, 'Harga', 2),
(1429, 17, 20, 'Harga', 3),
(1430, 17, 21, 'Harga', 9),
(1431, 18, 17, 'Harga', 0.125),
(1432, 18, 18, 'Harga', 1),
(1433, 18, 19, 'Harga', 2),
(1434, 18, 20, 'Harga', 9),
(1435, 18, 21, 'Harga', 4),
(1436, 19, 17, 'Harga', 0.5),
(1437, 19, 18, 'Harga', 0.5),
(1438, 19, 19, 'Harga', 1),
(1439, 19, 20, 'Harga', 5),
(1440, 19, 21, 'Harga', 9),
(1441, 20, 17, 'Harga', 0.33333333333333),
(1442, 20, 18, 'Harga', 0.11111111111111),
(1443, 20, 19, 'Harga', 0.2),
(1444, 20, 20, 'Harga', 1),
(1445, 20, 21, 'Harga', 7),
(1446, 21, 17, 'Harga', 0.11111111111111),
(1447, 21, 18, 'Harga', 0.25),
(1448, 21, 19, 'Harga', 0.11111111111111),
(1449, 21, 20, 'Harga', 0.14285714285714),
(1450, 21, 21, 'Harga', 1),
(1451, 17, 17, 'Jumlah Kamar', 1),
(1452, 17, 18, 'Jumlah Kamar', 7),
(1453, 17, 19, 'Jumlah Kamar', 2),
(1454, 17, 20, 'Jumlah Kamar', 3),
(1455, 17, 21, 'Jumlah Kamar', 1),
(1456, 18, 17, 'Jumlah Kamar', 0.14285714285714),
(1457, 18, 18, 'Jumlah Kamar', 1),
(1458, 18, 19, 'Jumlah Kamar', 4),
(1459, 18, 20, 'Jumlah Kamar', 5),
(1460, 18, 21, 'Jumlah Kamar', 6),
(1461, 19, 17, 'Jumlah Kamar', 0.5),
(1462, 19, 18, 'Jumlah Kamar', 0.25),
(1463, 19, 19, 'Jumlah Kamar', 1),
(1464, 19, 20, 'Jumlah Kamar', 7),
(1465, 19, 21, 'Jumlah Kamar', 8),
(1466, 20, 17, 'Jumlah Kamar', 0.33333333333333),
(1467, 20, 18, 'Jumlah Kamar', 0.2),
(1468, 20, 19, 'Jumlah Kamar', 0.14285714285714),
(1469, 20, 20, 'Jumlah Kamar', 1),
(1470, 20, 21, 'Jumlah Kamar', 9),
(1471, 21, 17, 'Jumlah Kamar', 1),
(1472, 21, 18, 'Jumlah Kamar', 0.16666666666667),
(1473, 21, 19, 'Jumlah Kamar', 0.125),
(1474, 21, 20, 'Jumlah Kamar', 0.11111111111111),
(1475, 21, 21, 'Jumlah Kamar', 1),
(1476, 17, 17, 'Jumlah Kamar Mandi', 1),
(1477, 17, 18, 'Jumlah Kamar Mandi', 2),
(1478, 17, 19, 'Jumlah Kamar Mandi', 5),
(1479, 17, 20, 'Jumlah Kamar Mandi', 4),
(1480, 17, 21, 'Jumlah Kamar Mandi', 7),
(1481, 18, 17, 'Jumlah Kamar Mandi', 0.5),
(1482, 18, 18, 'Jumlah Kamar Mandi', 1),
(1483, 18, 19, 'Jumlah Kamar Mandi', 9),
(1484, 18, 20, 'Jumlah Kamar Mandi', 3),
(1485, 18, 21, 'Jumlah Kamar Mandi', 7),
(1486, 19, 17, 'Jumlah Kamar Mandi', 0.2),
(1487, 19, 18, 'Jumlah Kamar Mandi', 0.11111111111111),
(1488, 19, 19, 'Jumlah Kamar Mandi', 1),
(1489, 19, 20, 'Jumlah Kamar Mandi', 7),
(1490, 19, 21, 'Jumlah Kamar Mandi', 3),
(1491, 20, 17, 'Jumlah Kamar Mandi', 0.25),
(1492, 20, 18, 'Jumlah Kamar Mandi', 0.33333333333333),
(1493, 20, 19, 'Jumlah Kamar Mandi', 0.14285714285714),
(1494, 20, 20, 'Jumlah Kamar Mandi', 1),
(1495, 20, 21, 'Jumlah Kamar Mandi', 8),
(1496, 21, 17, 'Jumlah Kamar Mandi', 0.14285714285714),
(1497, 21, 18, 'Jumlah Kamar Mandi', 0.14285714285714),
(1498, 21, 19, 'Jumlah Kamar Mandi', 0.33333333333333),
(1499, 21, 20, 'Jumlah Kamar Mandi', 0.125),
(1500, 21, 21, 'Jumlah Kamar Mandi', 1),
(1501, 17, 17, 'Luas Tanah', 1),
(1502, 17, 18, 'Luas Tanah', 9),
(1503, 17, 19, 'Luas Tanah', 9),
(1504, 17, 20, 'Luas Tanah', 8),
(1505, 17, 21, 'Luas Tanah', 9),
(1506, 18, 17, 'Luas Tanah', 0.11111111111111),
(1507, 18, 18, 'Luas Tanah', 1),
(1508, 18, 19, 'Luas Tanah', 7),
(1509, 18, 20, 'Luas Tanah', 9),
(1510, 18, 21, 'Luas Tanah', 4),
(1511, 19, 17, 'Luas Tanah', 0.11111111111111),
(1512, 19, 18, 'Luas Tanah', 0.14285714285714),
(1513, 19, 19, 'Luas Tanah', 1),
(1514, 19, 20, 'Luas Tanah', 6),
(1515, 19, 21, 'Luas Tanah', 5),
(1516, 20, 17, 'Luas Tanah', 0.125),
(1517, 20, 18, 'Luas Tanah', 0.11111111111111),
(1518, 20, 19, 'Luas Tanah', 0.16666666666667),
(1519, 20, 20, 'Luas Tanah', 1),
(1520, 20, 21, 'Luas Tanah', 2),
(1521, 21, 17, 'Luas Tanah', 0.11111111111111),
(1522, 21, 18, 'Luas Tanah', 0.25),
(1523, 21, 19, 'Luas Tanah', 0.2),
(1524, 21, 20, 'Luas Tanah', 0.5),
(1525, 21, 21, 'Luas Tanah', 1),
(1526, 17, 17, 'Luas Bangunan', 1),
(1527, 17, 18, 'Luas Bangunan', 6),
(1528, 17, 19, 'Luas Bangunan', 5),
(1529, 17, 20, 'Luas Bangunan', 4),
(1530, 17, 21, 'Luas Bangunan', 6),
(1531, 18, 17, 'Luas Bangunan', 0.16666666666667),
(1532, 18, 18, 'Luas Bangunan', 1),
(1533, 18, 19, 'Luas Bangunan', 6),
(1534, 18, 20, 'Luas Bangunan', 6),
(1535, 18, 21, 'Luas Bangunan', 3),
(1536, 19, 17, 'Luas Bangunan', 0.2),
(1537, 19, 18, 'Luas Bangunan', 0.16666666666667),
(1538, 19, 19, 'Luas Bangunan', 1),
(1539, 19, 20, 'Luas Bangunan', 1),
(1540, 19, 21, 'Luas Bangunan', 8),
(1541, 20, 17, 'Luas Bangunan', 0.25),
(1542, 20, 18, 'Luas Bangunan', 0.16666666666667),
(1543, 20, 19, 'Luas Bangunan', 1),
(1544, 20, 20, 'Luas Bangunan', 1),
(1545, 20, 21, 'Luas Bangunan', 5),
(1546, 21, 17, 'Luas Bangunan', 0.16666666666667),
(1547, 21, 18, 'Luas Bangunan', 0.33333333333333),
(1548, 21, 19, 'Luas Bangunan', 0.125),
(1549, 21, 20, 'Luas Bangunan', 0.2),
(1550, 21, 21, 'Luas Bangunan', 1),
(1551, 17, 17, 'Daya Listrik', 1),
(1552, 17, 18, 'Daya Listrik', 4),
(1553, 17, 19, 'Daya Listrik', 5),
(1554, 17, 20, 'Daya Listrik', 3),
(1555, 17, 21, 'Daya Listrik', 6),
(1556, 18, 17, 'Daya Listrik', 0.25),
(1557, 18, 18, 'Daya Listrik', 1),
(1558, 18, 19, 'Daya Listrik', 1),
(1559, 18, 20, 'Daya Listrik', 2),
(1560, 18, 21, 'Daya Listrik', 5),
(1561, 19, 17, 'Daya Listrik', 0.2),
(1562, 19, 18, 'Daya Listrik', 1),
(1563, 19, 19, 'Daya Listrik', 1),
(1564, 19, 20, 'Daya Listrik', 7),
(1565, 19, 21, 'Daya Listrik', 2),
(1566, 20, 17, 'Daya Listrik', 0.33333333333333),
(1567, 20, 18, 'Daya Listrik', 0.5),
(1568, 20, 19, 'Daya Listrik', 0.14285714285714),
(1569, 20, 20, 'Daya Listrik', 1),
(1570, 20, 21, 'Daya Listrik', 2),
(1571, 21, 17, 'Daya Listrik', 0.16666666666667),
(1572, 21, 18, 'Daya Listrik', 0.2),
(1573, 21, 19, 'Daya Listrik', 0.5),
(1574, 21, 20, 'Daya Listrik', 0.5),
(1575, 21, 21, 'Daya Listrik', 1);

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
(6, '{\"type\":\"Konfirmasi Rumah\",\"status\":\"Tolak\",\"message\":\"Proses penambahan rumah ditolak, karenalokasi rumah tidak jelas\"}', 17, '2021-12-28 01:47:00');

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
(1, 17, 'jalan rumah baru', '', '', 'ini adalah rumah yang baru', 220000000, 1000, 1000, 10, 10, 450, 'Tidak Ada Air Bersih', 'Tidak Ada', 'Tidak Ada', 'Proses', '', NULL),
(2, 17, 'jalan rumah mewah', '', '', 'ini adalah rumah mewah', 240000000, 300, 500, 10, 10, 450, 'Tidak Ada Air Bersih', 'Tidak Ada', 'Tidak Ada', 'Proses', '', NULL),
(3, 17, 'jalan rumah mewah', '', '', 'ini adalah rumah mewah', 200000000, 200, 800, 10, 10, 450, 'Tidak Ada Air Bersih', 'Tidak Ada', 'Tidak Ada', 'Kosong', '', NULL),
(4, 17, 'jalan rumah contoh', '', '', 'ini adalah rumah contoh', 230000000, 400, 600, 10, 10, 450, 'Tidak Ada Air Bersih', 'Tidak Ada', 'Tidak Ada', 'Kosong', '', NULL),
(5, 17, 'Koala Regency C-49', 'KABUPATEN SIMEULUE', '11', 'rumah di jalan koala regency c-49', 100000, 10, 10, 10, 10, 450, 'Tidak Ada Air Bersih', 'Tidak Ada', 'Tidak Ada', 'Kosong', '', NULL),
(22, 18, 'Jalan surabaya baru no 123', 'KABUPATEN SIMEULUE', 'ACEH', 'ini adalah rumah yang berlokasi di surabaya', 30000000, 100, 100, 10, 10, 450, 'PDAM', 'Tidak Ada', 'Tidak Ada', 'Kosong', '', NULL),
(23, 18, 'rumah surabaya', 'KOTA SURABAYA', 'JAWA TIMUR', 'rumah di surabaya', 999999999, 100, 100, 10, 10, 450, 'Tidak Ada Air Bersih', 'Tidak Ada', 'Tidak Ada', 'Kosong', '', NULL),
(2046, 17, 'jalan rumah baru no 45', 'KABUPATEN TAPANULI UTARA', 'SUMATERA UTARA', 'tidak ada rumah disini', 1000000, 2000, 1000, 5, 5, 900, 'PDAM', 'Ada', 'Ada', 'Disewa', NULL, NULL);

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
(13, 'mahendra', '$2y$10$xMs5wJf/HUUa4c9xGMbBh.YtqtCQ.obxP.pkeWZP7H3Mi7UW5A.PG', 'mahendra', 'pemilik', 'mahendrasaputra@gmail.com', '0812341110', NULL, NULL, NULL),
(14, 'ahmad', '$2y$10$yYK43dGfL7f1qqCgdiv1WuiomO9Gb.ZqvEwTHQ.O/TNJy42KH7wTi', 'ahmad', 'penyewa', 'ahmad@gmail.com', '012859127154', NULL, NULL, NULL),
(17, 'member', '$2y$10$dabf.McBZLC/MR0Gn0d2dukW6nvGkNlG465DsXlOtfHGhkD2u1DQi', 'member', 'pemilik', 'member@gmail.com', '083857006866', NULL, NULL, NULL),
(18, 'admin', '$2y$10$mbc1PEE2iqnqM8Buj8OvTOy8OU45mMmIIoLJyzFoGEmz8/GJ50Fx2', 'admin', 'pemilik', 'admin@gmail.com', '8489898888888', NULL, NULL, NULL);

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
  MODIFY `idgambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  MODIFY `id_nilai_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=901;

--
-- AUTO_INCREMENT for table `nilai_rumah_kriteria`
--
ALTER TABLE `nilai_rumah_kriteria`
  MODIFY `id_nilai_rumah_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1576;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reminder`
--
ALTER TABLE `reminder`
  MODIFY `idreminder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `rumah`
--
ALTER TABLE `rumah`
  MODIFY `idrumah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2047;

--
-- AUTO_INCREMENT for table `transaksi_sewa`
--
ALTER TABLE `transaksi_sewa`
  MODIFY `id_transaksi_sewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
