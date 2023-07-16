-- Adminer 4.8.1 MySQL 5.7.24 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

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
  CONSTRAINT `tb_siswa_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE SET NULL
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
  `role` enum('siswa','osis','admin','guru_bk','guru') NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `role`) VALUES
(4,	'widya123',	'$2y$10$7RSsQIukaQx3W9hds9iofeLMF.EK1Wo1r13Fi8CtP34.EUNHN2nna',	'siswa'),
(5,	'sutrisman',	'$2y$10$cRgiM/99e0IMJPLGqWccB.IMJeloJpKy4iIz4FSoCpdJ3i.HYKQQ6',	'siswa'),
(8,	'nurhadi123',	'$2y$10$/uMvyBG9UtRIHbBpZ938Fuh5dI0kG2krIDpXElN5YfIC92ZJgKTMS',	'siswa');

-- 2023-07-16 02:08:18
