/*
Navicat MySQL Data Transfer

Source Server         : mysqlku
Source Server Version : 100126
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 100126
File Encoding         : 65001

Date: 2018-02-08 08:33:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for kelas
-- ----------------------------
DROP TABLE IF EXISTS `kelas`;
CREATE TABLE `kelas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `nama_kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_ajaran` int(10) unsigned DEFAULT NULL,
  `wali_kelas` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kelas_tahun_ajaran_foreign` (`tahun_ajaran`),
  KEY `kelas_wali_kelas_foreign` (`wali_kelas`),
  CONSTRAINT `kelas_tahun_ajaran_foreign` FOREIGN KEY (`tahun_ajaran`) REFERENCES `tahun_ajaran` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `kelas_wali_kelas_foreign` FOREIGN KEY (`wali_kelas`) REFERENCES `walikelas` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of kelas
-- ----------------------------

-- ----------------------------
-- Table structure for kepala_sekolah
-- ----------------------------
DROP TABLE IF EXISTS `kepala_sekolah`;
CREATE TABLE `kepala_sekolah` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nip` int(30) DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `a` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of kepala_sekolah
-- ----------------------------
INSERT INTO `kepala_sekolah` VALUES ('3', '123456', '2', '2018-02-08 00:56:10', '2018-02-08 00:56:10', null);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2018_01_16_110458_entrust_setup_tables', '1');
INSERT INTO `migrations` VALUES ('4', '2018_01_27_005332_create_kelas_table', '1');
INSERT INTO `migrations` VALUES ('5', '2018_01_27_005332_create_kepala_sekolah_table', '1');
INSERT INTO `migrations` VALUES ('6', '2018_01_27_005332_create_nilai_table', '1');
INSERT INTO `migrations` VALUES ('7', '2018_01_27_005332_create_siswa_table', '1');
INSERT INTO `migrations` VALUES ('8', '2018_01_27_005332_create_tahun_ajaran_table', '1');
INSERT INTO `migrations` VALUES ('9', '2018_01_27_005332_create_walikelas_table', '1');
INSERT INTO `migrations` VALUES ('10', '2018_01_27_005342_create_foreign_keys', '1');

-- ----------------------------
-- Table structure for nilai
-- ----------------------------
DROP TABLE IF EXISTS `nilai`;
CREATE TABLE `nilai` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `siswa` int(10) unsigned DEFAULT NULL,
  `kelas` int(10) unsigned DEFAULT NULL,
  `nilai_kelas4_s1` double(8,2) NOT NULL,
  `nilai_kelas4_s2` double(8,2) NOT NULL,
  `nilai_kelas5_s1` double(8,2) NOT NULL,
  `nilai_kelas5_s2` double(8,2) NOT NULL,
  `nilai_kelas6_s1` double(8,2) NOT NULL,
  `uas` double(8,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nilai_siswa_foreign` (`siswa`),
  KEY `nilai_kelas_foreign` (`kelas`),
  CONSTRAINT `nilai_kelas_foreign` FOREIGN KEY (`kelas`) REFERENCES `kelas` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `nilai_siswa_foreign` FOREIGN KEY (`siswa`) REFERENCES `siswa` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of nilai
-- ----------------------------

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------

-- ----------------------------
-- Table structure for permission_role
-- ----------------------------
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permission_role
-- ----------------------------

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'superadmin', 'Super Admin', 'Semua Akses Sistem', '2018-02-04 08:28:26', '2018-02-04 08:28:29');
INSERT INTO `roles` VALUES ('2', 'guru', 'Guru', 'Akses Memberi Nilai', '2018-02-04 14:40:58', '2018-02-04 14:40:58');
INSERT INTO `roles` VALUES ('3', 'kepsek', 'Kepala Sekolah', 'Akses Arsip Ijazah', '2018-02-04 14:41:33', '2018-02-04 14:41:33');
INSERT INTO `roles` VALUES ('4', 'admin', 'Administrasi', 'Melengkapi Data', '2018-02-04 14:42:19', '2018-02-04 14:42:19');

-- ----------------------------
-- Table structure for role_user
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role_user
-- ----------------------------
INSERT INTO `role_user` VALUES ('1', '1');
INSERT INTO `role_user` VALUES ('2', '3');
INSERT INTO `role_user` VALUES ('4', '2');

-- ----------------------------
-- Table structure for siswa
-- ----------------------------
DROP TABLE IF EXISTS `siswa`;
CREATE TABLE `siswa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_ortu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of siswa
-- ----------------------------
INSERT INTO `siswa` VALUES ('1', '2018-02-04 06:12:49', '2018-02-08 00:58:43', null, 'siswa1', '123456', 'Tangerang', '2018-02-08', 'Laki-Laki', 'Islam', 'Tangerang', 'Wali1');
INSERT INTO `siswa` VALUES ('2', '2018-02-04 06:12:49', '2018-02-08 01:01:00', '2018-02-08 01:01:13', 'siswa12', '123456000', 'Tangeranghh', '2018-02-08', 'Laki-Laki', 'Islamm', 'Tangerangk', 'Wali1');

-- ----------------------------
-- Table structure for tahun_ajaran
-- ----------------------------
DROP TABLE IF EXISTS `tahun_ajaran`;
CREATE TABLE `tahun_ajaran` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tahun_ajaran
-- ----------------------------
INSERT INTO `tahun_ajaran` VALUES ('3', '2018/2019', '2', '2018-02-04 02:38:44', '2018-02-04 02:38:44', null);
INSERT INTO `tahun_ajaran` VALUES ('5', '2017/2018', '1', '2018-02-04 03:09:43', '2018-02-04 03:09:43', null);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'superadmin', 'irvanirawan1993@gmail.com', '$2y$10$a3lFezMlNc1GzcBlhaazjuOVmnw8ik3D6eHO2wixHAKRM44n/6GYO', 'vaDZ8rrmvCTrGP7BjniQuCLirA4rk4aSUAc80Sat8NbbqgT7mRkHhFBtmPgB', '2018-02-04 01:30:16', '2018-02-04 01:30:16');
INSERT INTO `users` VALUES ('2', 'irvani', 'irvan.irn@gmail.coma', '$2y$10$GcNR3TSGjpkvddNmwBGVnechO/FS5zEYrSFbpC1EePpyTAZV5Mkji', '1utjHojtukHDtmVC1L8bjrmMT0cmoI9gsfO1c7GChSuCRSgFAubGgvxb0WaN', '2018-02-04 05:12:05', '2018-02-08 00:55:14');
INSERT INTO `users` VALUES ('4', 'walikelas1edit', 'walikelas1@walikelas1.coma', '$2y$10$9U2if/f7vrCaIaBrphYnEeofwW/2eiyc5PfkSAYqYE/vqZAg26SXm', 'oax7et2kEWJ4H5LQzepYmBEfYPEwfR0tFuhrBT3gm023rvlISswNzPexUUG5', '2018-02-07 23:53:58', '2018-02-08 00:28:40');

-- ----------------------------
-- Table structure for walikelas
-- ----------------------------
DROP TABLE IF EXISTS `walikelas`;
CREATE TABLE `walikelas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `walikelas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of walikelas
-- ----------------------------
INSERT INTO `walikelas` VALUES ('5', '12345', '4', '2018-02-08 00:13:42', '2018-02-08 00:28:40', null);
