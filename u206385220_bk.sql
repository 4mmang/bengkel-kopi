-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 16 Bulan Mei 2025 pada 10.41
-- Versi server: 10.11.10-MariaDB
-- Versi PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u206385220_bk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `status` enum('on','off') DEFAULT 'off',
  `qr_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `nama`, `harga`, `status`, `qr_code`) VALUES
(1, 'Air Mineral', 5000, 'on', 'menu/Air_Mineral.png'),
(2, 'Kopi Hitam', 5000, 'on', 'menu/Kopi_Hitam.png'),
(3, 'Kopi Klasik', 5000, 'on', 'menu/Kopi_Klasik.png'),
(4, 'Kopi Tubruk Susu', 5000, 'on', 'menu/Kopi_Tubruk_Susu.png'),
(5, 'Vietnam Drip', 10000, 'on', 'menu/Vietnam_Drip.png\r\n\r\n'),
(6, 'Ice Kopi Susu BK', 13000, 'off', 'menu/Ice_Kopi_Susu_BK.png'),
(7, 'Ice Espresso X Matcha', 15000, 'off', 'menu/Ice_Espresso_X_Matcha.png'),
(8, 'Ice Espresso X Aren', 15000, 'off', 'menu/Ice_Espresso_X_Aren.png'),
(9, 'Ice Espresso X Banana', 15000, 'off', 'menu/Ice_Espresso_X_Banana.png'),
(10, 'Ice Espresso X Avocado', 15000, 'off', 'menu/Ice_Espresso_X_Avocado.png'),
(11, 'Ice Espresso X Vanilla', 15000, 'off', 'menu/Ice_Espresso_X_Vanilla.png'),
(12, 'Ice Espresso X Pandan', 15000, 'off', 'menu/Ice_Espresso_X_Pandan.png'),
(13, 'Ice Americano', 15000, 'off', 'menu/Ice_Americano.png'),
(14, 'Ice Spanish Latte BK', 15000, 'off', 'menu/Ice_Spanish_Latte_BK.png'),
(15, 'Original Avocado Latte', 13000, 'off', 'menu/Original_Avocado_Latte.png'),
(16, 'Original Pandan Latte', 13000, 'off', 'menu/Original_Pandan_Latte.png'),
(17, 'Ice X Banana Milk', 13000, 'off', 'menu/Ice_X_Banana_Milk.png'),
(18, 'Ice X Vanilla Milk', 13000, 'off', 'menu/Ice_X_Vanilla_Milk.png'),
(19, 'Ice X Matcha Latte', 13000, 'on', 'menu/Ice_X_Matcha_Latte.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `id_pesanan`, `id_menu`, `jumlah`) VALUES
(1, 1, 1, 2),
(2, 2, 8, 2),
(3, 2, 1, 1),
(4, 3, 1, 1),
(5, 4, 1, 1),
(6, 5, 1, 1),
(7, 6, 8, 3),
(8, 7, 4, 4),
(9, 8, 3, 3),
(10, 8, 5, 4),
(11, 9, 3, 4),
(12, 9, 8, 3),
(13, 10, 7, 2),
(14, 11, 19, 1),
(15, 12, 1, 1),
(16, 13, 1, 1),
(17, 14, 1, 1),
(18, 15, 1, 1),
(19, 17, 1, 1),
(20, 16, 1, 1),
(21, 18, 1, 1),
(22, 19, 5, 1),
(23, 20, 5, 1),
(24, 21, 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `meja` enum('luar','dalam') NOT NULL,
  `take_away` enum('ya','tidak') NOT NULL DEFAULT 'tidak',
  `status` enum('proses','selesai') NOT NULL DEFAULT 'proses',
  `waktu_pemesanan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id`, `nama`, `meja`, `take_away`, `status`, `waktu_pemesanan`) VALUES
(1, 'Arman', 'dalam', 'tidak', 'selesai', '2025-03-16 06:09:47'),
(2, 'Allcode', 'luar', 'ya', 'selesai', '2025-03-16 06:09:47'),
(3, 'Arman', 'luar', 'tidak', 'selesai', '2025-03-18 06:09:47'),
(4, 'Arman', 'dalam', 'tidak', 'selesai', '2025-03-19 06:09:47'),
(5, 'Arman', 'luar', 'ya', 'selesai', '2025-03-20 06:09:47'),
(6, 'Rascoding', 'dalam', 'tidak', 'selesai', '2025-03-14 07:32:45'),
(7, 'Allcode', 'dalam', 'tidak', 'proses', '2025-03-20 07:34:57'),
(8, 'Arman Umar', 'luar', 'tidak', 'proses', '2025-03-20 07:35:48'),
(9, 'Rascoding', 'dalam', 'tidak', 'proses', '2025-03-22 13:48:07'),
(10, 'Arman', 'luar', 'tidak', 'proses', '2025-05-14 09:55:21'),
(11, 'fika', 'dalam', 'tidak', 'proses', '2025-05-15 07:36:21'),
(12, 'Fani', 'luar', 'tidak', 'proses', '2025-05-16 05:28:16'),
(13, 'Fani', 'luar', 'tidak', 'proses', '2025-05-16 05:28:16'),
(14, 'Fani', 'luar', 'tidak', 'proses', '2025-05-16 05:28:16'),
(15, 'Fani', 'luar', 'tidak', 'proses', '2025-05-16 05:28:16'),
(16, 'Fani', 'luar', 'tidak', 'proses', '2025-05-16 05:28:17'),
(17, 'Fani', 'luar', 'tidak', 'proses', '2025-05-16 05:28:17'),
(18, 'Fani', 'luar', 'tidak', 'proses', '2025-05-16 05:28:17'),
(19, 'Fan', 'dalam', 'tidak', 'proses', '2025-05-16 05:29:11'),
(20, 'Mirna', 'dalam', 'tidak', 'proses', '2025-05-16 07:22:12'),
(21, 'Dira', 'dalam', 'tidak', 'proses', '2025-05-16 07:25:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','owner') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$Bg7MSUbxf5G57EKvKE640OUmDTpsuwMMvdG84BBhfvBw.qPn1IFXC', 'admin'),
(2, 'owner', '$2y$10$Bg7MSUbxf5G57EKvKE640OUmDTpsuwMMvdG84BBhfvBw.qPn1IFXC', 'owner');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
