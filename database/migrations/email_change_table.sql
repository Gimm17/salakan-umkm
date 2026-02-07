-- ============================================================
-- SQL Migration: Tabel untuk fitur Ganti Email
-- 
-- Jalankan file ini di phpMyAdmin atau tool database lainnya
-- untuk membuat tabel yang diperlukan fitur ganti email.
-- ============================================================

-- Tabel untuk menyimpan request perubahan email
CREATE TABLE IF NOT EXISTS `user_email_change` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `old_email` VARCHAR(191) NOT NULL,
  `new_email` VARCHAR(191) NOT NULL,
  `token` VARCHAR(64) NOT NULL,
  `code` VARCHAR(6) NOT NULL,
  `expires_at` DATETIME NOT NULL,
  `used_at` DATETIME NULL,
  `created_at` DATETIME NOT NULL,
  `ip` VARCHAR(45) NULL,
  `user_agent` VARCHAR(255) NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_token` (`token`),
  KEY `idx_user` (`user_id`),
  KEY `idx_code` (`user_id`, `code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Pastikan kolom email di tabel users memiliki unique constraint
-- (Uncomment baris berikut jika email belum unique)
-- ALTER TABLE `users`
--   MODIFY `email` VARCHAR(191) NOT NULL,
--   ADD UNIQUE KEY `uniq_users_email` (`email`);
