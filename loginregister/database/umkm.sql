SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

-- Table structure for table `umkm`

CREATE TABLE `umkm` (
  `id_umkm` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap_umkm` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat_umkm` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email_umkm` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `nmr_telepon_umkm` int(11) NOT NULL,
  `nama_usaha_umkm` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `bidang_usaha_umkm` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password_umkm` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(10) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'umkm',
  `verification_code` int(11) DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_umkm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
