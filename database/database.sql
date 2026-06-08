-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.11.0.7065
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for medisecure
CREATE DATABASE IF NOT EXISTS `medisecure` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `medisecure`;

-- Dumping structure for table medisecure.dokter
CREATE TABLE IF NOT EXISTS `dokter` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `spesialis` varchar(100) DEFAULT NULL,
  `no_str` varchar(50) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `alamat` text,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `dokter_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table medisecure.dokter: ~0 rows (approximately)

-- Dumping structure for table medisecure.hasil_lab
CREATE TABLE IF NOT EXISTS `hasil_lab` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pasien_id` int NOT NULL,
  `nama_file` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `file_type` varchar(50) DEFAULT NULL,
  `uploaded_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `pasien_id` (`pasien_id`),
  CONSTRAINT `hasil_lab_ibfk_1` FOREIGN KEY (`pasien_id`) REFERENCES `pasien` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table medisecure.hasil_lab: ~1 rows (approximately)

-- Dumping structure for table medisecure.pasien
CREATE TABLE IF NOT EXISTS `pasien` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `nik` varbinary(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `alamat` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `pasien_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table medisecure.pasien: ~1 rows (approximately)

-- Dumping structure for table medisecure.rekam_medis
CREATE TABLE IF NOT EXISTS `rekam_medis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pasien_id` int NOT NULL,
  `dokter_id` int NOT NULL,
  `keluhan` text NOT NULL,
  `diagnosa` text NOT NULL,
  `tindakan` text,
  `tanggal_pemeriksaan` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `pasien_id` (`pasien_id`),
  KEY `dokter_id` (`dokter_id`),
  CONSTRAINT `rekam_medis_ibfk_1` FOREIGN KEY (`pasien_id`) REFERENCES `pasien` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rekam_medis_ibfk_2` FOREIGN KEY (`dokter_id`) REFERENCES `dokter` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table medisecure.rekam_medis: ~0 rows (approximately)

-- Dumping structure for table medisecure.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','dokter','pasien') NOT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table medisecure.users: ~3 rows (approximately)
INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`, `is_active`, `created_at`, `updated_at`) VALUES
	(15, 'Admin', 'admin@medisecure.com', '$2y$10$oOuhVmQ94YDK56/Bf/39o./Ht8TFLkvVT813WFdA8RftDUW3s51V.', 'admin', 1, '2026-06-08 03:23:30', '2026-06-08 03:33:46'),
	(16, 'Dokter', 'dokter@medisecure.com', '$2y$10$K4d5OLX1U58voC6ORVSb9uMl00fh4lhpVagKHZ.3YPB4R2TPPDcje', 'dokter', 1, '2026-06-08 03:23:47', '2026-06-08 03:35:27'),
	(17, 'Pasien', 'hayyu@gmail.com', '$2y$10$TrV6Cm5GJZ15NVnmrHhfNeS6hvUfA7uTPRYrUa3Q5iQJzKQ32sV.y', 'pasien', 1, '2026-06-08 03:25:31', '2026-06-08 03:38:31');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
