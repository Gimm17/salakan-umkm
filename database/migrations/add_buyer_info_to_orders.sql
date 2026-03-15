-- ================================================
-- Migration: Tambah kolom buyer info ke tabel orders
-- Jalankan di server live: db_umkm_salakan
-- ================================================
ALTER TABLE `orders`
  ADD COLUMN `buyer_wa`      VARCHAR(20)  NULL AFTER `buyer_name`,
  ADD COLUMN `buyer_address` TEXT         NULL AFTER `buyer_wa`,
  ADD COLUMN `buyer_city`    VARCHAR(100) NULL AFTER `buyer_address`,
  ADD COLUMN `buyer_note`    TEXT         NULL AFTER `buyer_city`;
