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

-- Dumping structure for table website_inventaris.barangs
CREATE TABLE IF NOT EXISTS `barangs`
(
    `id`
    bigint
    unsigned
    NOT
    NULL
    AUTO_INCREMENT,
    `kode_barang`
    varchar
(
    255
) COLLATE utf8mb4_unicode_ci NOT NULL,
    `nama_barang` varchar
(
    255
) COLLATE utf8mb4_unicode_ci NOT NULL,
    `distributor` varchar
(
    255
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `no_akl_akd` varchar
(
    255
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `tahun_pengadaan` date NOT NULL,
    `harga` int NOT NULL,
    `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
    `photo` varchar
(
    255
) COLLATE utf8mb4_unicode_ci NOT NULL,
    `jenis_barang_id` bigint unsigned NOT NULL,
    `merk_barang_id` bigint unsigned NOT NULL,
    `kondisi_barang_id` bigint unsigned NOT NULL,
    `sumber_pengadaan_id` bigint unsigned NOT NULL,
    `unit_kerja_id` bigint unsigned NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY
(
    `id`
),
    KEY `barangs_jenis_barang_id_foreign`
(
    `jenis_barang_id`
),
    KEY `barangs_merk_barang_id_foreign`
(
    `merk_barang_id`
),
    KEY `barangs_kondisi_barang_id_foreign`
(
    `kondisi_barang_id`
),
    KEY `barangs_sumber_pengadaan_id_foreign`
(
    `sumber_pengadaan_id`
),
    KEY `barangs_unit_kerja_id_foreign`
(
    `unit_kerja_id`
),
    CONSTRAINT `barangs_jenis_barang_id_foreign` FOREIGN KEY
(
    `jenis_barang_id`
) REFERENCES `jenis_barangs`
(
    `id`
),
    CONSTRAINT `barangs_kondisi_barang_id_foreign` FOREIGN KEY
(
    `kondisi_barang_id`
) REFERENCES `kondisi_barangs`
(
    `id`
),
    CONSTRAINT `barangs_merk_barang_id_foreign` FOREIGN KEY
(
    `merk_barang_id`
) REFERENCES `merk_barangs`
(
    `id`
),
    CONSTRAINT `barangs_sumber_pengadaan_id_foreign` FOREIGN KEY
(
    `sumber_pengadaan_id`
) REFERENCES `sumber_pengadaans`
(
    `id`
),
    CONSTRAINT `barangs_unit_kerja_id_foreign` FOREIGN KEY
(
    `unit_kerja_id`
) REFERENCES `unit_kerjas`
(
    `id`
)
    ) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE =utf8mb4_unicode_ci;

-- Dumping structure for table website_inventaris.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs`
(
    `id`
    bigint
    unsigned
    NOT
    NULL
    AUTO_INCREMENT,
    `uuid`
    varchar
(
    255
) COLLATE utf8mb4_unicode_ci NOT NULL,
    `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
    `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
    `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
    `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
    `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY
(
    `id`
),
    UNIQUE KEY `failed_jobs_uuid_unique`
(
    `uuid`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE =utf8mb4_unicode_ci;

-- Dumping data for table website_inventaris.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table website_inventaris.jenis_barangs
CREATE TABLE IF NOT EXISTS `jenis_barangs`
(
    `id`
    bigint
    unsigned
    NOT
    NULL
    AUTO_INCREMENT,
    `jenis_barang`
    varchar
(
    255
) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY
(
    `id`
)
    ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE =utf8mb4_unicode_ci;

-- Dumping data for table website_inventaris.jenis_barangs: ~1 rows (approximately)
INSERT INTO `jenis_barangs` (`id`, `jenis_barang`, `created_at`, `updated_at`)
VALUES (2, 'Alat Kesehatan', '2024-07-22 19:27:45', '2024-07-22 19:27:45');

-- Dumping structure for table website_inventaris.kondisi_barangs
CREATE TABLE IF NOT EXISTS `kondisi_barangs`
(
    `id`
    bigint
    unsigned
    NOT
    NULL
    AUTO_INCREMENT,
    `kondisi_barang`
    varchar
(
    255
) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY
(
    `id`
)
    ) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE =utf8mb4_unicode_ci;

-- Dumping data for table website_inventaris.kondisi_barangs: ~2 rows (approximately)
INSERT INTO `kondisi_barangs` (`id`, `kondisi_barang`, `created_at`, `updated_at`)
VALUES (3, 'Rusak', '2024-07-22 20:06:33', '2024-07-22 20:06:33'),
       (4, 'Maintenance', '2024-07-25 08:10:38', '2024-07-25 08:10:38'),
       (5, 'Normal', '2024-07-25 18:43:34', '2024-07-25 18:43:34'),
       (6, 'Maintenance Lanjutan', '2024-07-25 18:43:44', '2024-07-25 18:43:44');

-- Dumping structure for table website_inventaris.merk_barangs
CREATE TABLE IF NOT EXISTS `merk_barangs`
(
    `id`
    bigint
    unsigned
    NOT
    NULL
    AUTO_INCREMENT,
    `merk_barang`
    varchar
(
    255
) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY
(
    `id`
)
    ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE =utf8mb4_unicode_ci;

-- Dumping data for table website_inventaris.merk_barangs: ~1 rows (approximately)
INSERT INTO `merk_barangs` (`id`, `merk_barang`, `created_at`, `updated_at`)
VALUES (2, 'Panasonic', '2024-07-22 19:28:56', '2024-07-22 19:28:56');

-- Dumping structure for table website_inventaris.migrations
CREATE TABLE IF NOT EXISTS `migrations`
(
    `id`
    int
    unsigned
    NOT
    NULL
    AUTO_INCREMENT,
    `migration`
    varchar
(
    255
) COLLATE utf8mb4_unicode_ci NOT NULL,
    `batch` int NOT NULL,
    PRIMARY KEY
(
    `id`
)
    ) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE =utf8mb4_unicode_ci;

-- Dumping data for table website_inventaris.migrations: ~16 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (1, '2014_10_12_000000_create_users_table', 1),
       (2, '2014_10_12_100000_create_password_resets_table', 1),
       (3, '2019_08_19_000000_create_failed_jobs_table', 1),
       (4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
       (5, '2024_07_21_075557_create_jenis_barangs_table', 1),
       (6, '2024_07_21_075953_create_merk_barangs_table', 1),
       (7, '2024_07_21_080035_create_kondisi_barangs_table', 1),
       (8, '2024_07_21_080126_create_sumber_pengadaans_table', 1),
       (9, '2024_07_21_080205_create_unit_kerjas_table', 1),
       (10, '2024_07_21_081411_create_barangs_table', 1),
       (11, '2024_07_22_014157_create_roles_table', 2),
       (12, '2024_07_22_014312_update_users_table', 3),
       (13, '2024_07_23_032616_update_barangs_table', 4),
       (14, '2024_07_23_033353_add_column_kode_barang_to_barangs_table', 5),
       (15, '2024_07_23_071632_update_column_barangs_table', 6),
       (16, '2024_07_24_063429_add_column_username_to_users_table', 7),
       (21, '2024_07_25_135815_create_maintenances_table', 8),
       (22, '2024_07_26_013037_add_column_harga_to_maintenances_table', 9);

-- Dumping structure for table website_inventaris.password_resets
CREATE TABLE IF NOT EXISTS `password_resets`
(
    `email`
    varchar
(
    255
) COLLATE utf8mb4_unicode_ci NOT NULL,
    `token` varchar
(
    255
) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    KEY `password_resets_email_index`
(
    `email`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE =utf8mb4_unicode_ci;

-- Dumping data for table website_inventaris.password_resets: ~0 rows (approximately)

-- Dumping structure for table website_inventaris.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens`
(
    `id`
    bigint
    unsigned
    NOT
    NULL
    AUTO_INCREMENT,
    `tokenable_type`
    varchar
(
    255
) COLLATE utf8mb4_unicode_ci NOT NULL,
    `tokenable_id` bigint unsigned NOT NULL,
    `name` varchar
(
    255
) COLLATE utf8mb4_unicode_ci NOT NULL,
    `token` varchar
(
    64
) COLLATE utf8mb4_unicode_ci NOT NULL,
    `abilities` text COLLATE utf8mb4_unicode_ci,
    `last_used_at` timestamp NULL DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY
(
    `id`
),
    UNIQUE KEY `personal_access_tokens_token_unique`
(
    `token`
),
    KEY `personal_access_tokens_tokenable_type_tokenable_id_index`
(
    `tokenable_type`,
    `tokenable_id`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE =utf8mb4_unicode_ci;

-- Dumping data for table website_inventaris.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table website_inventaris.roles
CREATE TABLE IF NOT EXISTS `roles`
(
    `id`
    bigint
    unsigned
    NOT
    NULL
    AUTO_INCREMENT,
    `name`
    varchar
(
    255
) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY
(
    `id`
)
    ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE =utf8mb4_unicode_ci;

-- Dumping data for table website_inventaris.roles: ~0 rows (approximately)
INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`)
VALUES (1, 'admin', '2024-07-22 02:28:33', '2024-07-22 02:28:35'),
       (2, 'user', '2024-07-22 02:55:04', '2024-07-22 02:55:05');

-- Dumping structure for table website_inventaris.sumber_pengadaans
CREATE TABLE IF NOT EXISTS `sumber_pengadaans`
(
    `id`
    bigint
    unsigned
    NOT
    NULL
    AUTO_INCREMENT,
    `sumber_pengadaan`
    varchar
(
    255
) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY
(
    `id`
)
    ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE =utf8mb4_unicode_ci;

-- Dumping data for table website_inventaris.sumber_pengadaans: ~0 rows (approximately)
INSERT INTO `sumber_pengadaans` (`id`, `sumber_pengadaan`, `created_at`, `updated_at`)
VALUES (2, 'RSDH', '2024-07-22 20:06:45', '2024-07-22 20:06:45');

-- Dumping structure for table website_inventaris.unit_kerjas
CREATE TABLE IF NOT EXISTS `unit_kerjas`
(
    `id`
    bigint
    unsigned
    NOT
    NULL
    AUTO_INCREMENT,
    `unit_kerja`
    varchar
(
    255
) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY
(
    `id`
)
    ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE =utf8mb4_unicode_ci;

-- Dumping data for table website_inventaris.unit_kerjas: ~2 rows (approximately)
INSERT INTO `unit_kerjas` (`id`, `unit_kerja`, `created_at`, `updated_at`)
VALUES (2, 'Administrasi', '2024-07-22 18:43:21', '2024-07-22 18:43:21'),
       (3, 'Keuangan', '2024-07-22 18:43:30', '2024-07-22 18:43:30');

-- Dumping structure for table website_inventaris.users
CREATE TABLE IF NOT EXISTS `users`
(
    `id`
    bigint
    unsigned
    NOT
    NULL
    AUTO_INCREMENT,
    `role_id`
    bigint
    unsigned
    NOT
    NULL,
    `name`
    varchar
(
    255
) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email` varchar
(
    255
) COLLATE utf8mb4_unicode_ci NOT NULL,
    `username` varchar
(
    255
) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email_verified_at` timestamp NULL DEFAULT NULL,
    `password` varchar
(
    255
) COLLATE utf8mb4_unicode_ci NOT NULL,
    `remember_token` varchar
(
    100
) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY
(
    `id`
),
    UNIQUE KEY `users_email_unique`
(
    `email`
),
    KEY `users_role_id_foreign`
(
    `role_id`
),
    CONSTRAINT `users_role_id_foreign` FOREIGN KEY
(
    `role_id`
) REFERENCES `roles`
(
    `id`
)
    ) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE =utf8mb4_unicode_ci;

-- Dumping data for table website_inventaris.users: ~2 rows (approximately)
INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `username`, `email_verified_at`, `password`, `remember_token`,
                     `created_at`, `updated_at`)
VALUES (1, 1, 'Coba', 'admin@gmail.com', 'admin', NULL, '$2y$10$J/Q8TKSJrfEriYiL.S4hKu6o4Q8NVCmgM4eXXgw0wWjTSXnJPIaRe',
        NULL, '2024-07-21 19:31:02', '2024-07-21 19:31:02'),
       (3, 2, 'Coba Update', 'user@gmail.com', '', NULL, '$2y$10$GHN9japCsyHU2EuNcCEUXO2Vgnm7fAGHtKuft.zw7gbb5AGnvvrPO',
        NULL, '2024-07-21 20:10:32', '2024-07-21 20:10:32'),
       (5, 2, 'anggacipta', 'test@example.com', 'acna', NULL,
        '$2y$10$OQsb..SgP4BC7BhvZ2YVW.LADm.eavMO.IPDbZFlXae8LJlCeAzjW', NULL, '2024-07-24 00:00:53',
        '2024-07-24 00:00:53');

-- Dumping data for table website_inventaris.barangs: ~5 rows (approximately)
INSERT INTO `barangs` (`id`, `kode_barang`, `nama_barang`, `distributor`, `no_akl_akd`, `tahun_pengadaan`, `harga`,
                       `keterangan`, `photo`, `jenis_barang_id`, `merk_barang_id`, `kondisi_barang_id`,
                       `sumber_pengadaan_id`, `unit_kerja_id`, `created_at`, `updated_at`)
VALUES (1, 'AKL00901', 'Coba Barang', 'PT. Nusa Jaya', 'KD091310', '2024-07-23', 8000, 'Coba bolo2', '1721707645.png',
        2, 2, 5, 2, 2, '2024-07-22 21:07:25', '2024-07-25 20:01:29'),
       (2, 'BRG001', 'Coba Barang', NULL, NULL, '2024-07-23', 8000, NULL, '1721719487.png', 2, 2, 6, 2, 2,
        '2024-07-23 00:24:47', '2024-07-25 20:43:11'),
       (3, 'BRG002', 'Coba Barang3', NULL, NULL, '2024-07-12', 9000, NULL, '1721720259.png', 2, 2, 3, 2, 2,
        '2024-07-23 00:37:39', '2024-07-25 19:57:55'),
       (4, 'BRG000', 'Coba Barang3', NULL, NULL, '2024-07-23', 10000, NULL, '1721720297.png', 2, 2, 3, 2, 3,
        '2024-07-23 00:38:17', '2024-07-23 00:38:17');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
