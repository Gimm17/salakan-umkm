-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2026 at 09:07 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_umkm_salakan`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`, `slug`) VALUES
(1, 'Makanan Berat', 'makanan-berat'),
(2, 'Minuman', 'minuman'),
(4, 'Camilan Enak', 'camilan-enak');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `id_user` int(11) DEFAULT 0,
  `total` int(11) NOT NULL DEFAULT 0,
  `status` enum('pending','paid','failed','canceled','expired','refunded') NOT NULL DEFAULT 'pending',
  `buyer_email` varchar(150) DEFAULT NULL,
  `buyer_name` varchar(150) DEFAULT NULL,
  `gateway_payload` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_db_id` int(11) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `nama_produk` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_produk` varchar(200) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` int(11) NOT NULL DEFAULT 0,
  `status_produk` enum('Tersedia','Habis') NOT NULL DEFAULT 'Tersedia',
  `gambar_produk` varchar(255) DEFAULT 'default_produk.jpg',
  `link_whatsapp` varchar(255) DEFAULT NULL,
  `link_gofood` varchar(255) DEFAULT NULL,
  `link_grabfood` varchar(255) DEFAULT NULL,
  `link_shopeefood` varchar(255) DEFAULT NULL,
  `link_maxim` varchar(255) DEFAULT NULL,
  `rating_rata` decimal(2,1) DEFAULT 0.0,
  `jumlah_ulasan` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `id_toko`, `id_kategori`, `nama_produk`, `deskripsi`, `harga`, `status_produk`, `gambar_produk`, `link_whatsapp`, `link_gofood`, `link_grabfood`, `link_shopeefood`, `link_maxim`, `rating_rata`, `jumlah_ulasan`, `created_at`) VALUES
(1, 1, 1, 'Nasi Kuning Komplit', 'Nasi kuning dengan lauk ayam goreng, serundeng, telur balado, dan sambal. Porsi kenyang, rasa mantap!', 25000, 'Tersedia', 'default_produk.jpg', 'https://wa.me/6281234567890', NULL, NULL, NULL, NULL, 0.0, 0, '2025-06-19 08:38:28'),
(2, 1, 2, 'Es Teh Manis Jumbo', 'Es teh segar ukuran jumbo, pelepas dahaga di siang hari.', 5000, 'Tersedia', 'default_produk.jpg', 'https://wa.me/6281234567890', NULL, NULL, NULL, NULL, 0.0, 0, '2025-06-19 08:38:28'),
(3, 1, 4, 'Keripik Singkong Balado', 'Keripik singkong renyah dengan bumbu balado pedas manis yang bikin nagih.', 15000, 'Tersedia', 'default_produk.jpg', 'https://wa.me/6281234567890', NULL, NULL, NULL, NULL, 4.0, 1, '2025-06-19 08:38:28'),
(7, 3, 4, 'Buah Mangga 2', 'aa', 10000, 'Tersedia', '76c37e7c74a1c1d336d17d4eb085aec5.jpg', NULL, NULL, 'https://wa.me/6281234567890', 'https://wa.me/6281234567890', 'https://wa.me/6281234567890', 4.0, 1, '2025-06-24 13:34:11'),
(9, 3, 4, 'ES BUAH', 'ENAKKK', 12000, 'Tersedia', '5fe05fe553a0ade24531946c3095b7ad.jpg', 'https://wa.me/6281234567890', 'https://wa.me/6281234567890', 'https://wa.me/6281234567890', 'https://wa.me/6281234567890', 'https://wa.me/6281234567890', 5.0, 1, '2025-06-24 17:04:30');

-- --------------------------------------------------------

--
-- Table structure for table `produk_favorit`
--

CREATE TABLE `produk_favorit` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk_favorit`
--

INSERT INTO `produk_favorit` (`id`, `id_user`, `id_produk`, `created_at`) VALUES
(19, 9, 1, '2025-06-22 21:04:07'),
(20, 10, 1, '2025-06-24 03:40:38'),
(22, 10, 2, '2025-06-24 03:53:48'),
(25, 10, 3, '2025-06-24 17:34:44'),
(26, 10, 7, '2025-06-25 17:17:04'),
(27, 10, 9, '2025-06-26 18:28:56');

-- --------------------------------------------------------

--
-- Table structure for table `produk_ulasan`
--

CREATE TABLE `produk_ulasan` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `komentar` text DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk_ulasan`
--

INSERT INTO `produk_ulasan` (`id`, `id_produk`, `id_user`, `rating`, `komentar`, `status`, `created_at`, `updated_at`) VALUES
(2, 3, 10, 4, 'ENAK SEKALI', 'approved', '2025-06-25 09:12:28', '2025-06-25 09:12:28'),
(3, 7, 10, 4, 'ENAK BANGET', 'approved', '2025-06-25 09:13:16', '2025-06-25 09:13:16'),
(4, 9, 10, 5, 'LUMAYAN ENAK', 'approved', '2025-06-26 10:29:27', '2025-06-26 10:29:27');

--
-- Triggers `produk_ulasan`
--
DELIMITER $$
CREATE TRIGGER `update_rating_after_delete` AFTER DELETE ON `produk_ulasan` FOR EACH ROW BEGIN
    UPDATE `produk` 
    SET 
        `rating_rata` = COALESCE((SELECT ROUND(AVG(rating), 1) FROM `produk_ulasan` WHERE `id_produk` = OLD.id_produk AND `status` = 'approved'), 0.0),
        `jumlah_ulasan` = COALESCE((SELECT COUNT(*) FROM `produk_ulasan` WHERE `id_produk` = OLD.id_produk AND `status` = 'approved'), 0)
    WHERE `id` = OLD.id_produk;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_rating_after_insert` AFTER INSERT ON `produk_ulasan` FOR EACH ROW BEGIN
    UPDATE `produk` 
    SET 
        `rating_rata` = (SELECT ROUND(AVG(rating), 1) FROM `produk_ulasan` WHERE `id_produk` = NEW.id_produk AND `status` = 'approved'),
        `jumlah_ulasan` = (SELECT COUNT(*) FROM `produk_ulasan` WHERE `id_produk` = NEW.id_produk AND `status` = 'approved')
    WHERE `id` = NEW.id_produk;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_rating_after_update` AFTER UPDATE ON `produk_ulasan` FOR EACH ROW BEGIN
    UPDATE `produk` 
    SET 
        `rating_rata` = COALESCE((SELECT ROUND(AVG(rating), 1) FROM `produk_ulasan` WHERE `id_produk` = NEW.id_produk AND `status` = 'approved'), 0.0),
        `jumlah_ulasan` = COALESCE((SELECT COUNT(*) FROM `produk_ulasan` WHERE `id_produk` = NEW.id_produk AND `status` = 'approved'), 0)
    WHERE `id` = NEW.id_produk;
    
    IF OLD.id_produk <> NEW.id_produk THEN
        UPDATE `produk` 
        SET 
            `rating_rata` = COALESCE((SELECT ROUND(AVG(rating), 1) FROM `produk_ulasan` WHERE `id_produk` = OLD.id_produk AND `status` = 'approved'), 0.0),
            `jumlah_ulasan` = COALESCE((SELECT COUNT(*) FROM `produk_ulasan` WHERE `id_produk` = OLD.id_produk AND `status` = 'approved'), 0)
        WHERE `id` = OLD.id_produk;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_toko` varchar(150) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT 'default_logo.jpg',
  `alamat` text DEFAULT NULL,
  `jam_operasional` varchar(100) DEFAULT NULL,
  `status_persetujuan` enum('menunggu','disetujui','ditolak') NOT NULL DEFAULT 'menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id`, `id_user`, `nama_toko`, `deskripsi`, `logo`, `alamat`, `jam_operasional`, `status_persetujuan`) VALUES
(1, 2, 'Warung Makan Budi', 'Menyediakan berbagai macam masakan rumahan yang lezat dan bergizi.', 'default_logo.jpg', 'Jl. Trans Peling No. 10, Salakan', '08:00 - 20:00', 'disetujui'),
(3, 8, 'Toko JONO', 'TOKO SEBRA ADA', '148f87c75229d7384e4ef856e476bf33.png', 'Jl. Tombolotutu', '08.00-18.00', 'disetujui'),
(4, 12, 'Toko KOSTA', NULL, 'default_logo.jpg', NULL, NULL, 'menunggu');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','penjual','pengguna') NOT NULL DEFAULT 'pengguna',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `lokasi` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`, `created_at`, `lokasi`, `foto`, `reset_token`, `reset_token_expires_at`) VALUES
(1, 'Administrator', 'admin@umkmsalakan.com', '$2y$10$9Uq1l1yoEkTwr0YFYW9bTeCmyoNVpoN/aCP/XeH/i9KeacTBFxmcu', 'admin', '2025-06-17 19:00:00', NULL, NULL, NULL, NULL),
(2, 'Budi Santoso', 'budi@penjual.com', '$2y$10$9Uq1l1yoEkTwr0YFYW9bTeCmyoNVpoN/aCP/XeH/i9KeacTBFxmcu', 'penjual', '2025-06-17 19:05:00', NULL, NULL, NULL, NULL),
(8, 'JONO MURTO', 'jono@penjual.com', '$2y$10$ko99u1IlrI/VGoS2ow8bK.s4R9t0W8AN2Fzg1Gt/wZ8iza02xGeP.', 'penjual', '2025-06-20 14:26:52', NULL, NULL, NULL, NULL),
(9, 'DODIT ANJAY', 'dodit@pembeli.com', '$2y$10$itWeB0Akys/iC0SItIZb4eL1K2emJGEA6TqCXZ7a8NJ/X3cu7XOGa', 'pengguna', '2025-06-21 08:49:13', 'Tombolotutu', 'f7990bed0593dbefc7df2ebdc67e792d.jpg', NULL, NULL),
(10, 'ABUN BONAR', 'abun@pembeli.com', '$2y$10$MtbQfSj6IM5.gR0DCLSRzemGvTSD3EmGwicX2XqQViH/wSw8FHQWO', 'pengguna', '2025-06-23 18:23:50', '', '16e923837f39107d8321e164b8a01d13.jpg', NULL, NULL),
(11, 'NviaZa', 'nviaza17@gmail.com', '$2y$10$AU4c520099ZbZpiDRlBLEuKdkX9S6C/X0/0T2TONVD8eiEMmtVDLy', 'pengguna', '2025-06-28 14:48:45', NULL, NULL, NULL, NULL),
(12, 'KOSTA', 'kosta@penjual.com', '$2y$10$qm0oSspFruXP8VcNPEFsnOvzLb8heNhXjgwEYofTA2.pIEmiJ30M.', 'penjual', '2025-07-11 15:27:16', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_email_change`
--

CREATE TABLE `user_email_change` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `old_email` varchar(191) NOT NULL,
  `new_email` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `code` varchar(6) NOT NULL,
  `expires_at` datetime NOT NULL,
  `used_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_order_id` (`order_id`),
  ADD KEY `idx_status` (`status`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_order_id` (`order_id`),
  ADD KEY `fk_orderitem_order` (`order_db_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_toko` (`id_toko`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `idx_produk_rating` (`rating_rata`);

--
-- Indexes for table `produk_favorit`
--
ALTER TABLE `produk_favorit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_produk_unique` (`id_user`,`id_produk`),
  ADD KEY `favorit_ibfk_2` (`id_produk`);

--
-- Indexes for table `produk_ulasan`
--
ALTER TABLE `produk_ulasan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_produk_review` (`id_user`,`id_produk`),
  ADD KEY `idx_produk_ulasan_produk` (`id_produk`),
  ADD KEY `idx_produk_ulasan_user` (`id_user`),
  ADD KEY `idx_produk_ulasan_status` (`status`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_email_change`
--
ALTER TABLE `user_email_change`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_token` (`token`),
  ADD KEY `idx_user` (`user_id`),
  ADD KEY `idx_code` (`user_id`,`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `produk_favorit`
--
ALTER TABLE `produk_favorit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `produk_ulasan`
--
ALTER TABLE `produk_ulasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_email_change`
--
ALTER TABLE `user_email_change`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_orderitem_order` FOREIGN KEY (`order_db_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `produk_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `produk_favorit`
--
ALTER TABLE `produk_favorit`
  ADD CONSTRAINT `favorit_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_favorit_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk_ulasan`
--
ALTER TABLE `produk_ulasan`
  ADD CONSTRAINT `fk_ulasan_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_ulasan_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `toko`
--
ALTER TABLE `toko`
  ADD CONSTRAINT `toko_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
