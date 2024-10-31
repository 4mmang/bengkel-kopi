-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table warkop.menus
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE armscii8_bin DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `status` enum('on','off') COLLATE armscii8_bin DEFAULT 'off',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Dumping data for table warkop.menus: ~17 rows (approximately)
INSERT INTO `menus` (`id`, `nama`, `harga`, `status`) VALUES
	(1, 'Air Mineral', 5000, 'on'),
	(2, 'Kopi Hitam', 5000, 'off'),
	(3, 'Kopi Klasik', 5000, 'off'),
	(4, 'Kopi Tubruk Susu', 5000, 'off'),
	(5, 'Vietnam Drip', 10000, 'off'),
	(6, 'Ice Kopi Susu BK', 13000, 'off'),
	(7, 'Ice Espresso X Matcha', 15000, 'off'),
	(8, 'Ice Espresso X Aren', 15000, 'on'),
	(9, 'Ice Espresso X Banana', 15000, 'off'),
	(10, 'Ice Espresso X Avocado', 15000, 'off'),
	(11, 'Ice Espresso X Vanilla', 15000, 'off'),
	(12, 'Ice Espresso X Pandan', 15000, 'off'),
	(13, 'Ice Americano', 15000, 'off'),
	(14, 'Ice Spanish Latte BK', 15000, 'off'),
	(15, 'Original Avocado Latte', 13000, 'off'),
	(16, 'Original Pandan Latte', 13000, 'off'),
	(17, 'Ice X Banana Milk', 13000, 'off'),
	(18, 'Ice X Vanilla Milk', 13000, 'off'),
	(19, 'Ice X Matcha Latte', 13000, 'off');

-- Dumping structure for table warkop.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pesanan` int NOT NULL,
  `id_menu` int NOT NULL,
  `jumlah` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Dumping data for table warkop.orders: ~0 rows (approximately)
INSERT INTO `orders` (`id`, `id_pesanan`, `id_menu`, `jumlah`) VALUES
	(1, 1, 1, 2),
	(2, 2, 8, 2),
	(3, 2, 1, 1);

-- Dumping structure for table warkop.pesanan
CREATE TABLE IF NOT EXISTS `pesanan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE armscii8_bin NOT NULL,
  `meja` enum('luar','dalam') COLLATE armscii8_bin NOT NULL,
  `take_away` enum('ya','tidak') COLLATE armscii8_bin NOT NULL DEFAULT 'tidak',
  `status` enum('proses','selesai') COLLATE armscii8_bin NOT NULL DEFAULT 'proses',
  `waktu_pemesanan` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Dumping data for table warkop.pesanan: ~0 rows (approximately)
INSERT INTO `pesanan` (`id`, `nama`, `meja`, `take_away`, `status`, `waktu_pemesanan`) VALUES
	(1, 'Arman', 'dalam', 'tidak', 'selesai', '2024-10-31 06:52:39'),
	(2, 'Allcode', 'luar', 'ya', 'selesai', '2024-10-31 07:48:27');

-- Dumping structure for table warkop.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE armscii8_bin NOT NULL,
  `password` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Dumping data for table warkop.users: ~0 rows (approximately)
INSERT INTO `users` (`id`, `username`, `password`) VALUES
	(1, 'admin', '$2y$10$Bg7MSUbxf5G57EKvKE640OUmDTpsuwMMvdG84BBhfvBw.qPn1IFXC');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
