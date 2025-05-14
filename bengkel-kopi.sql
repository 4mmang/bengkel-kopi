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

-- Dumping structure for table keyva.backset
CREATE TABLE IF NOT EXISTS `backset` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.backset: ~0 rows (approximately)

-- Dumping structure for table keyva.barang
CREATE TABLE IF NOT EXISTS `barang` (
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_jual` double(8,2) NOT NULL,
  `harga_beli` double(8,2) NOT NULL,
  `terjual` int NOT NULL,
  `terbeli` int NOT NULL,
  `sisa` int NOT NULL,
  `retur` int NOT NULL,
  `stokmin` int NOT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warna` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expired` datetime NOT NULL,
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode`),
  KEY `barang_kode_kategori_foreign` (`kode_kategori`),
  KEY `barang_kode_brand_foreign` (`kode_brand`),
  CONSTRAINT `barang_kode_brand_foreign` FOREIGN KEY (`kode_brand`) REFERENCES `kategori` (`kode`),
  CONSTRAINT `barang_kode_kategori_foreign` FOREIGN KEY (`kode_kategori`) REFERENCES `kategori` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.barang: ~0 rows (approximately)

-- Dumping structure for table keyva.barang_setting
CREATE TABLE IF NOT EXISTS `barang_setting` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.barang_setting: ~0 rows (approximately)

-- Dumping structure for table keyva.bayar
CREATE TABLE IF NOT EXISTS `bayar` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_bayar` date NOT NULL,
  `jam` time NOT NULL,
  `bayar` double(8,2) NOT NULL,
  `total` double(8,2) NOT NULL,
  `kembali` double(8,2) NOT NULL,
  `keluar` double(8,2) NOT NULL,
  `kasir` bigint unsigned NOT NULL,
  `diskon` int NOT NULL,
  `tipe_bayar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bayar_kasir_foreign` (`kasir`),
  CONSTRAINT `bayar_kasir_foreign` FOREIGN KEY (`kasir`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.bayar: ~0 rows (approximately)

-- Dumping structure for table keyva.beli_barang
CREATE TABLE IF NOT EXISTS `beli_barang` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_beli` date NOT NULL,
  `total` int NOT NULL,
  `kode_supplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kasir` bigint unsigned NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `beli_barang_kode_supplier_foreign` (`kode_supplier`),
  KEY `beli_barang_kasir_foreign` (`kasir`),
  CONSTRAINT `beli_barang_kasir_foreign` FOREIGN KEY (`kasir`) REFERENCES `users` (`id`),
  CONSTRAINT `beli_barang_kode_supplier_foreign` FOREIGN KEY (`kode_supplier`) REFERENCES `supplier` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.beli_barang: ~0 rows (approximately)

-- Dumping structure for table keyva.brand
CREATE TABLE IF NOT EXISTS `brand` (
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.brand: ~0 rows (approximately)

-- Dumping structure for table keyva.chmenu
CREATE TABLE IF NOT EXISTS `chmenu` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.chmenu: ~0 rows (approximately)

-- Dumping structure for table keyva.data
CREATE TABLE IF NOT EXISTS `data` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.data: ~0 rows (approximately)

-- Dumping structure for table keyva.dataretur
CREATE TABLE IF NOT EXISTS `dataretur` (
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `harga` double(8,2) NOT NULL,
  `hargaakhir` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.dataretur: ~0 rows (approximately)

-- Dumping structure for table keyva.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table keyva.hutang
CREATE TABLE IF NOT EXISTS `hutang` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.hutang: ~0 rows (approximately)

-- Dumping structure for table keyva.info
CREATE TABLE IF NOT EXISTS `info` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.info: ~0 rows (approximately)

-- Dumping structure for table keyva.invoicebeli
CREATE TABLE IF NOT EXISTS `invoicebeli` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.invoicebeli: ~0 rows (approximately)

-- Dumping structure for table keyva.invoicejual
CREATE TABLE IF NOT EXISTS `invoicejual` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.invoicejual: ~0 rows (approximately)

-- Dumping structure for table keyva.kategori
CREATE TABLE IF NOT EXISTS `kategori` (
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.kategori: ~0 rows (approximately)

-- Dumping structure for table keyva.log_warehouse
CREATE TABLE IF NOT EXISTS `log_warehouse` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `source_id` bigint unsigned NOT NULL,
  `dest_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `stok` int NOT NULL,
  `kode_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `log_warehouse_source_id_foreign` (`source_id`),
  KEY `log_warehouse_dest_id_foreign` (`dest_id`),
  KEY `log_warehouse_user_id_foreign` (`user_id`),
  KEY `log_warehouse_kode_barang_foreign` (`kode_barang`),
  CONSTRAINT `log_warehouse_dest_id_foreign` FOREIGN KEY (`dest_id`) REFERENCES `warehouse` (`id`),
  CONSTRAINT `log_warehouse_kode_barang_foreign` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode`),
  CONSTRAINT `log_warehouse_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `warehouse` (`id`),
  CONSTRAINT `log_warehouse_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.log_warehouse: ~0 rows (approximately)

-- Dumping structure for table keyva.menus
CREATE TABLE IF NOT EXISTS `menus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.menus: ~4 rows (approximately)
INSERT INTO `menus` (`id`, `nama`, `created_at`, `updated_at`) VALUES
	(1, 'Dashboard', '2025-04-18 14:41:19', '2025-04-18 14:41:19'),
	(2, 'Pelanggan', '2025-04-18 14:41:19', '2025-04-18 14:41:19'),
	(3, 'User', '2025-04-18 14:41:19', '2025-04-18 14:41:19'),
	(4, 'Role', '2025-04-18 14:41:19', '2025-04-18 14:41:19');

-- Dumping structure for table keyva.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.migrations: ~0 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2025_03_05_215008_create_kategori_table', 1),
	(6, '2025_03_05_215710_create_brand_table', 1),
	(7, '2025_03_05_220714_create_supplier_table', 1),
	(8, '2025_03_05_222520_create_data_table', 1),
	(9, '2025_03_05_223454_create_operasional_tipe_table', 1),
	(10, '2025_03_05_223744_create_operasional_table', 1),
	(11, '2025_03_05_224140_create_operasional_view_table', 1),
	(12, '2025_03_05_224405_create_backset_table', 1),
	(13, '2025_03_05_224806_create_barang_setting_table', 1),
	(14, '2025_03_05_225039_create_bayar_table', 1),
	(15, '2025_03_05_230211_create_beli_barang_table', 1),
	(16, '2025_03_06_012206_create_pembelian_table', 1),
	(17, '2025_03_06_012704_create_chmenu_table', 1),
	(18, '2025_03_06_013110_create_dataretur_table', 1),
	(19, '2025_03_06_013259_create_hutang_table', 1),
	(20, '2025_03_06_013445_create_info_table', 1),
	(21, '2025_03_06_013713_create_options_table', 1),
	(22, '2025_03_06_013726_create_mutasi_table', 1),
	(23, '2025_03_06_013743_create_invoicejual_table', 1),
	(24, '2025_03_06_013748_create_invoicebeli_table', 1),
	(25, '2025_03_06_013804_create_payment_table', 1),
	(26, '2025_03_06_013814_create_pelanggan_table', 1),
	(27, '2025_03_06_013828_create_pin_table', 1),
	(28, '2025_03_06_013844_create_quotation_table', 1),
	(29, '2025_03_06_013917_create_rekening_table', 1),
	(30, '2025_03_06_014000_create_retur_table', 1),
	(31, '2025_03_06_014004_create_sale_table', 1),
	(32, '2025_03_06_014018_create_stokretur_table', 1),
	(33, '2025_03_06_014046_create_stok_keluar_table', 1),
	(34, '2025_03_06_014114_create_stok_masuk_table', 1),
	(35, '2025_03_06_014123_create_stok_sesuai_table', 1),
	(36, '2025_03_06_014138_create_surat_table', 1),
	(37, '2025_04_07_220245_create_barang_table', 1),
	(38, '2025_04_07_225905_create_stok_sesuai_daftar_table', 1),
	(39, '2025_04_07_232948_create_warehouse_table', 1),
	(40, '2025_04_07_233031_create_warehouse_product_table', 1),
	(41, '2025_04_07_233413_create_log_warehouse_table', 1),
	(42, '2025_04_08_115300_create_menus_table', 1),
	(43, '2025_04_08_115457_create_role_permission_table', 1),
	(44, '2025_04_08_121933_create_quotation_list_table', 1),
	(45, '2025_04_08_122125_create_stok_keluar_daftar_table', 1),
	(46, '2025_04_08_122236_create_stok_masuk_daftar_table', 1),
	(47, '2025_04_08_122319_create_transaksi_beli_table', 1),
	(48, '2025_04_08_122352_create_transaksi_masuk_table', 1);

-- Dumping structure for table keyva.mutasi
CREATE TABLE IF NOT EXISTS `mutasi` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.mutasi: ~0 rows (approximately)

-- Dumping structure for table keyva.operasional
CREATE TABLE IF NOT EXISTS `operasional` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.operasional: ~0 rows (approximately)

-- Dumping structure for table keyva.operasional_tipe
CREATE TABLE IF NOT EXISTS `operasional_tipe` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.operasional_tipe: ~0 rows (approximately)

-- Dumping structure for table keyva.operasional_view
CREATE TABLE IF NOT EXISTS `operasional_view` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.operasional_view: ~0 rows (approximately)

-- Dumping structure for table keyva.options
CREATE TABLE IF NOT EXISTS `options` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.options: ~0 rows (approximately)

-- Dumping structure for table keyva.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.password_resets: ~0 rows (approximately)

-- Dumping structure for table keyva.payment
CREATE TABLE IF NOT EXISTS `payment` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tipe` int NOT NULL,
  `nota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cara` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payday` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.payment: ~0 rows (approximately)

-- Dumping structure for table keyva.pelanggan
CREATE TABLE IF NOT EXISTS `pelanggan` (
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_daftar` date NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nohp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.pelanggan: ~0 rows (approximately)

-- Dumping structure for table keyva.pembelian
CREATE TABLE IF NOT EXISTS `pembelian` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `tgl_sale` date DEFAULT NULL,
  `total` int DEFAULT NULL,
  `kode_supplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kasir` bigint unsigned NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diterima` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_po` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pembelian_kode_supplier_foreign` (`kode_supplier`),
  KEY `pembelian_kasir_foreign` (`kasir`),
  CONSTRAINT `pembelian_kasir_foreign` FOREIGN KEY (`kasir`) REFERENCES `users` (`id`),
  CONSTRAINT `pembelian_kode_supplier_foreign` FOREIGN KEY (`kode_supplier`) REFERENCES `supplier` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.pembelian: ~0 rows (approximately)

-- Dumping structure for table keyva.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table keyva.pin
CREATE TABLE IF NOT EXISTS `pin` (
  `pin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ubah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.pin: ~0 rows (approximately)

-- Dumping structure for table keyva.quotation
CREATE TABLE IF NOT EXISTS `quotation` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl` date NOT NULL,
  `due` date NOT NULL,
  `pelanggan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modal` double(8,2) NOT NULL,
  `total` double(8,2) NOT NULL,
  `diskon` int NOT NULL,
  `potongan` double(8,2) NOT NULL,
  `biaya_tambahan` double(8,2) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `oleh` bigint unsigned NOT NULL,
  `notainvoice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quotation_oleh_foreign` (`oleh`),
  CONSTRAINT `quotation_oleh_foreign` FOREIGN KEY (`oleh`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.quotation: ~0 rows (approximately)

-- Dumping structure for table keyva.quotation_list
CREATE TABLE IF NOT EXISTS `quotation_list` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` double(8,2) DEFAULT NULL,
  `jumlah` double(8,2) DEFAULT NULL,
  `harga_akhir` double(8,2) DEFAULT NULL,
  `modal` double(8,2) NOT NULL,
  `conv` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quotation_list_kode_barang_foreign` (`kode_barang`),
  CONSTRAINT `quotation_list_kode_barang_foreign` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.quotation_list: ~0 rows (approximately)

-- Dumping structure for table keyva.rekening
CREATE TABLE IF NOT EXISTS `rekening` (
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `norek` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.rekening: ~0 rows (approximately)

-- Dumping structure for table keyva.retur
CREATE TABLE IF NOT EXISTS `retur` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.retur: ~0 rows (approximately)

-- Dumping structure for table keyva.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.roles: ~0 rows (approximately)
INSERT INTO `roles` (`kode`, `name`, `created_at`, `updated_at`) VALUES
	('A001', 'admin', '2025-04-18 14:41:19', '2025-04-18 14:41:19'),
	('A002', 'pengguna', '2025-04-18 16:15:47', '2025-04-18 16:15:47');

-- Dumping structure for table keyva.role_permission
CREATE TABLE IF NOT EXISTS `role_permission` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_permission_kode_role_foreign` (`kode_role`),
  KEY `role_permission_menu_id_foreign` (`menu_id`),
  CONSTRAINT `role_permission_kode_role_foreign` FOREIGN KEY (`kode_role`) REFERENCES `roles` (`kode`) ON DELETE CASCADE,
  CONSTRAINT `role_permission_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.role_permission: ~4 rows (approximately)
INSERT INTO `role_permission` (`id`, `kode_role`, `permission`, `menu_id`, `created_at`, `updated_at`) VALUES
	(1, 'A001', 'view', 1, '2025-04-18 14:41:19', '2025-04-18 14:41:19'),
	(2, 'A001', 'view,create,edit,delete', 2, '2025-04-18 14:41:19', '2025-04-18 14:41:19'),
	(3, 'A001', 'view,create,edit,delete', 3, '2025-04-18 14:41:19', '2025-04-18 14:41:19'),
	(4, 'A001', 'view,create,edit,delete', 4, '2025-04-18 14:41:19', '2025-04-18 14:41:19'),
	(5, 'A002', 'view', 1, '2025-04-18 16:15:56', '2025-04-18 16:15:56');

-- Dumping structure for table keyva.sale
CREATE TABLE IF NOT EXISTS `sale` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_sale` date NOT NULL,
  `due_date` date NOT NULL,
  `total` double(8,2) DEFAULT NULL,
  `diskon` int NOT NULL,
  `potongan` double(8,2) NOT NULL,
  `biaya` double(8,2) NOT NULL,
  `modal_beli` double(8,2) NOT NULL,
  `kode_pelanggan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kasir` bigint unsigned NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sale_kode_pelanggan_foreign` (`kode_pelanggan`),
  KEY `sale_kasir_foreign` (`kasir`),
  CONSTRAINT `sale_kasir_foreign` FOREIGN KEY (`kasir`) REFERENCES `users` (`id`),
  CONSTRAINT `sale_kode_pelanggan_foreign` FOREIGN KEY (`kode_pelanggan`) REFERENCES `pelanggan` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.sale: ~0 rows (approximately)

-- Dumping structure for table keyva.stok_keluar
CREATE TABLE IF NOT EXISTS `stok_keluar` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cabang` int NOT NULL,
  `tgl` date NOT NULL,
  `kode_pelanggan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stok_keluar_kode_pelanggan_foreign` (`kode_pelanggan`),
  KEY `stok_keluar_user_id_foreign` (`user_id`),
  CONSTRAINT `stok_keluar_kode_pelanggan_foreign` FOREIGN KEY (`kode_pelanggan`) REFERENCES `pelanggan` (`kode`),
  CONSTRAINT `stok_keluar_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.stok_keluar: ~0 rows (approximately)

-- Dumping structure for table keyva.stok_keluar_daftar
CREATE TABLE IF NOT EXISTS `stok_keluar_daftar` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stok_keluar_daftar_kode_barang_foreign` (`kode_barang`),
  CONSTRAINT `stok_keluar_daftar_kode_barang_foreign` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.stok_keluar_daftar: ~0 rows (approximately)

-- Dumping structure for table keyva.stok_masuk
CREATE TABLE IF NOT EXISTS `stok_masuk` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cabang` int NOT NULL,
  `tgl` date NOT NULL,
  `kode_supplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stok_masuk_kode_supplier_foreign` (`kode_supplier`),
  KEY `stok_masuk_user_id_foreign` (`user_id`),
  CONSTRAINT `stok_masuk_kode_supplier_foreign` FOREIGN KEY (`kode_supplier`) REFERENCES `supplier` (`kode`),
  CONSTRAINT `stok_masuk_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.stok_masuk: ~0 rows (approximately)

-- Dumping structure for table keyva.stok_masuk_daftar
CREATE TABLE IF NOT EXISTS `stok_masuk_daftar` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stok_masuk_daftar_kode_barang_foreign` (`kode_barang`),
  CONSTRAINT `stok_masuk_daftar_kode_barang_foreign` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.stok_masuk_daftar: ~0 rows (approximately)

-- Dumping structure for table keyva.stok_retur
CREATE TABLE IF NOT EXISTS `stok_retur` (
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.stok_retur: ~0 rows (approximately)

-- Dumping structure for table keyva.stok_sesuai
CREATE TABLE IF NOT EXISTS `stok_sesuai` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl` date NOT NULL,
  `oleh` bigint unsigned NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stok_sesuai_oleh_foreign` (`oleh`),
  CONSTRAINT `stok_sesuai_oleh_foreign` FOREIGN KEY (`oleh`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.stok_sesuai: ~0 rows (approximately)

-- Dumping structure for table keyva.stok_sesuai_daftar
CREATE TABLE IF NOT EXISTS `stok_sesuai_daftar` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sebelum` int NOT NULL,
  `sesudah` int NOT NULL,
  `selisih` int NOT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stok_sesuai_daftar_kode_barang_foreign` (`kode_barang`),
  CONSTRAINT `stok_sesuai_daftar_kode_barang_foreign` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.stok_sesuai_daftar: ~0 rows (approximately)

-- Dumping structure for table keyva.supplier
CREATE TABLE IF NOT EXISTS `supplier` (
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_daftar` date NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nohp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode`),
  UNIQUE KEY `supplier_nohp_unique` (`nohp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.supplier: ~0 rows (approximately)

-- Dumping structure for table keyva.surat
CREATE TABLE IF NOT EXISTS `surat` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nosurat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `kode_pelanggan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tujuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notelp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nopol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `oleh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `surat_kode_pelanggan_foreign` (`kode_pelanggan`),
  CONSTRAINT `surat_kode_pelanggan_foreign` FOREIGN KEY (`kode_pelanggan`) REFERENCES `pelanggan` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.surat: ~0 rows (approximately)

-- Dumping structure for table keyva.transaksi_beli
CREATE TABLE IF NOT EXISTS `transaksi_beli` (
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` double(8,2) NOT NULL,
  `jumlah` int NOT NULL,
  `harga_akhir` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode`),
  KEY `transaksi_beli_kode_barang_foreign` (`kode_barang`),
  CONSTRAINT `transaksi_beli_kode_barang_foreign` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.transaksi_beli: ~0 rows (approximately)

-- Dumping structure for table keyva.transaksi_masuk
CREATE TABLE IF NOT EXISTS `transaksi_masuk` (
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` double(8,2) NOT NULL,
  `harga_beli` double(8,2) NOT NULL,
  `jumlah` int NOT NULL,
  `harga_akhir` double(8,2) NOT NULL,
  `harga_beli_akhir` double(8,2) NOT NULL,
  `retur` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode`),
  KEY `transaksi_masuk_kode_barang_foreign` (`kode_barang`),
  CONSTRAINT `transaksi_masuk_kode_barang_foreign` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.transaksi_masuk: ~0 rows (approximately)

-- Dumping structure for table keyva.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nohp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `tgl_aktif` date NOT NULL,
  `kode_role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_nohp_unique` (`nohp`),
  KEY `users_kode_role_foreign` (`kode_role`),
  CONSTRAINT `users_kode_role_foreign` FOREIGN KEY (`kode_role`) REFERENCES `roles` (`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.users: ~0 rows (approximately)
INSERT INTO `users` (`id`, `name`, `username`, `alamat`, `nohp`, `tgl_lahir`, `tgl_aktif`, `kode_role`, `avatar`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Arman', 'mailprinting', 'Sabang subik', '082290762799', '2025-04-18', '2025-04-19', 'A001', 'avatars/jK7sKK5yy3E765yU2MjEgW7N34C8Arof22aGtLP1.png', '$2y$10$o6qNFop0ccrajhg6ZdTDkOufyUAF8i.oC5pThYVP9AvH3GdgcoN.G', NULL, '2025-04-18 15:01:32', '2025-04-18 15:53:01');

-- Dumping structure for table keyva.warehouse
CREATE TABLE IF NOT EXISTS `warehouse` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.warehouse: ~0 rows (approximately)

-- Dumping structure for table keyva.warehouse_product
CREATE TABLE IF NOT EXISTS `warehouse_product` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `warehouse_id` bigint unsigned NOT NULL,
  `kode_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `warehouse_product_warehouse_id_foreign` (`warehouse_id`),
  KEY `warehouse_product_kode_barang_foreign` (`kode_barang`),
  CONSTRAINT `warehouse_product_kode_barang_foreign` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode`),
  CONSTRAINT `warehouse_product_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouse` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keyva.warehouse_product: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
