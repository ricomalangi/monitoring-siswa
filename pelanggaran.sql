-- Adminer 4.8.1 MySQL 5.7.24 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `tb_admin`;
CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `role_admin` enum('admin','kesiswaan') NOT NULL,
  PRIMARY KEY (`id_admin`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `tb_admin_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_admin` (`id_admin`, `id_user`, `nama_admin`, `role_admin`) VALUES
(1,	10,	'admin',	'kesiswaan');

DROP TABLE IF EXISTS `tb_bk`;
CREATE TABLE `tb_bk` (
  `id_bk` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `nama_bk` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `alamat` text,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `agama` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_bk`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `tb_bk_ibfk_4` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_bk` (`id_bk`, `id_user`, `nama_bk`, `nip`, `alamat`, `jenis_kelamin`, `agama`, `tempat_lahir`, `tanggal_lahir`) VALUES
(1,	11,	'Guru BK 1',	'02134433234',	'Komp. Bumi Bung Permai No.A8/15, RT.001/RW.01',	'L',	'islam',	'Mataram',	'2023-08-14');

DROP TABLE IF EXISTS `tb_osis`;
CREATE TABLE `tb_osis` (
  `id_osis` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `nama_osis` varchar(255) NOT NULL,
  PRIMARY KEY (`id_osis`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `tb_osis_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `tb_prestasi`;
CREATE TABLE `tb_prestasi` (
  `id_prestasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_siswa` int(11) DEFAULT NULL,
  `jenis_prestasi` varchar(20) NOT NULL,
  `keterangan_prestasi` text,
  `sertifikat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_prestasi`),
  KEY `id_siswa` (`id_siswa`),
  CONSTRAINT `tb_prestasi_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `tb_siswa` (`id_siswa`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_prestasi` (`id_prestasi`, `id_siswa`, `jenis_prestasi`, `keterangan_prestasi`, `sertifikat`) VALUES
(1,	3,	'internasional',	NULL,	NULL),
(2,	3,	'nasional',	'Keterangan prestasi',	'nasional-20230813063024.pdf'),
(3,	4,	'nasional',	'Keterangan prestasi edit',	'internasional-20230813022043.pdf');

DROP TABLE IF EXISTS `tb_siswa`;
CREATE TABLE `tb_siswa` (
  `id_siswa` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `nisn` varchar(30) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` varchar(50) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_siswa`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `tb_siswa_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_siswa` (`id_siswa`, `id_user`, `nama_siswa`, `nisn`, `tempat_lahir`, `tanggal_lahir`, `agama`, `alamat`, `jenis_kelamin`, `status`) VALUES
(2,	NULL,	'Arico Putra Bintang Malangi',	'20092001',	'Mataram',	'2023-07-11',	'islam',	'Makassar Sulawesi Selatan Jl.Rappocini Raya Lr.5',	'L',	NULL),
(3,	4,	'Widya Khartika',	'02032002',	'Polman',	'2023-07-11',	'islam',	'JL. BUNG KARNO',	'P',	NULL),
(4,	5,	'Sutrisman',	'00123',	'Mataram',	'2023-07-18',	'islam',	'Makassar, Indonesia',	'L',	NULL),
(5,	NULL,	'Taufik Hidayat',	'42520029',	'Polman',	'2023-07-13',	'islam',	'JL Sudiang raya no 3',	'L',	NULL),
(6,	NULL,	'alif123',	'02032002',	'Mataram',	'2023-07-28',	'islam',	'Makassar, Indonesia',	'L',	NULL),
(7,	8,	'Nurhadi Sasono',	'42520030',	'Pinrang',	'2023-07-05',	'islam',	'Jl.Pinrang Raya',	'L',	NULL);

DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('siswa','osis','admin','gurubk','walikelas') NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `role`) VALUES
(4,	'widya123',	'$2y$10$7RSsQIukaQx3W9hds9iofeLMF.EK1Wo1r13Fi8CtP34.EUNHN2nna',	'siswa'),
(5,	'sutrisman',	'$2y$10$cRgiM/99e0IMJPLGqWccB.IMJeloJpKy4iIz4FSoCpdJ3i.HYKQQ6',	'siswa'),
(8,	'nurhadi123',	'$2y$10$/uMvyBG9UtRIHbBpZ938Fuh5dI0kG2krIDpXElN5YfIC92ZJgKTMS',	'siswa'),
(10,	'admin',	'$2y$10$XkZS1/09.UPdakQ1P8VkluxcqEaa3tWVIif3pcZ5UzsTRGtvjdTdO',	'admin'),
(11,	'bk1',	'$2y$10$RwycJ/iIH2Lvcw0bSzVQGeT3Z3HBO/QrP1uanbQxSfZJkSDkBb4Ty',	'gurubk');

-- 2023-08-13 06:32:24
