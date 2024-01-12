-- Adminer 4.8.1 MySQL 5.7.24 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `tb_admin`;
CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_admin` (`id_admin`, `username`, `password`) VALUES
(2,	'admin1',	'$2y$10$KvnIMRYB9uQR4bphrGHXQOJW6SKQ.eapzlGGQ5.1qbzcPaRsC4dE.'),
(3,	'admin2',	'$2y$10$T.QJNihI7mc46GfxIF/gR.REGptHcvvx106t/5PjoNXfYcWzvyDd.'),
(4,	'admin3',	'$2y$10$lD.As0FpiDAvJP62ue301eI7vUWTnTj8lZ5S/C.LAqFqFMouww/kC');

DROP TABLE IF EXISTS `tb_bk`;
CREATE TABLE `tb_bk` (
  `id_bk` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bk` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` text,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `agama` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_bk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_bk` (`id_bk`, `nama_bk`, `nip`, `password`, `alamat`, `jenis_kelamin`, `agama`, `tempat_lahir`, `tanggal_lahir`) VALUES
(1,	'GURU BK 1',	'11111111',	'$2y$10$Sy.SN8i5fg7PJVqv4nHIGefuypeh4vlmaZlGSVrD.iBoaA7Mh/ctq',	'KOMP. BUMI BUNG PERMAI NO.A8/15, RT.001/RW.01',	'L',	'ISLAM',	'MATARAM',	'2023-08-14'),
(2,	'GURU BK 2',	'0213443323421',	'12345678',	'JL. BUNG KARNO',	'P',	'KRISTEN KATOLIK',	'PINRANG',	'2023-09-22');

DROP TABLE IF EXISTS `tb_nama_pelanggaran`;
CREATE TABLE `tb_nama_pelanggaran` (
  `id_nama_pelanggaran` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pelanggaran` varchar(255) NOT NULL,
  PRIMARY KEY (`id_nama_pelanggaran`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_nama_pelanggaran` (`id_nama_pelanggaran`, `nama_pelanggaran`) VALUES
(2,	'BOLOS SAAT JAM PELAJARAN'),
(3,	'MEROKOK DI LINGKUNGAN SEKOLAH'),
(4,	'TIDUR');

DROP TABLE IF EXISTS `tb_notifikasi`;
CREATE TABLE `tb_notifikasi` (
  `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_bk` int(11) DEFAULT NULL,
  `id_walikelas` int(11) DEFAULT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `keterangan` text NOT NULL,
  `surat` varchar(255) NOT NULL,
  PRIMARY KEY (`id_notifikasi`),
  KEY `id_bk` (`id_bk`),
  KEY `id_siswa` (`id_siswa`),
  KEY `id_walikelas` (`id_walikelas`),
  CONSTRAINT `tb_notifikasi_ibfk_5` FOREIGN KEY (`id_bk`) REFERENCES `tb_bk` (`id_bk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_notifikasi_ibfk_6` FOREIGN KEY (`id_siswa`) REFERENCES `tb_siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_notifikasi_ibfk_7` FOREIGN KEY (`id_walikelas`) REFERENCES `tb_walikelas` (`id_walikelas`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `tb_pelanggaran`;
CREATE TABLE `tb_pelanggaran` (
  `id_pelanggaran` int(11) NOT NULL AUTO_INCREMENT,
  `id_siswa` int(11) DEFAULT NULL,
  `id_walikelas` int(11) DEFAULT NULL,
  `id_petugas_piket` int(11) NOT NULL,
  `id_nama_pelanggaran` int(11) NOT NULL,
  `kategori_pelanggaran` varchar(50) DEFAULT NULL,
  `poin_pelanggaran` int(11) DEFAULT NULL,
  `status` enum('waiting','approve') NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `date_created` timestamp NOT NULL,
  `date_updated` timestamp NOT NULL,
  PRIMARY KEY (`id_pelanggaran`),
  KEY `id_nama_pelanggaran` (`id_nama_pelanggaran`),
  KEY `id_siswa` (`id_siswa`),
  KEY `id_petugas_piket` (`id_petugas_piket`),
  KEY `id_walikelas` (`id_walikelas`),
  CONSTRAINT `tb_pelanggaran_ibfk_3` FOREIGN KEY (`id_nama_pelanggaran`) REFERENCES `tb_nama_pelanggaran` (`id_nama_pelanggaran`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_pelanggaran_ibfk_4` FOREIGN KEY (`id_siswa`) REFERENCES `tb_siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_pelanggaran_ibfk_5` FOREIGN KEY (`id_petugas_piket`) REFERENCES `tb_petugas_piket` (`id_petugas_piket`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_pelanggaran_ibfk_7` FOREIGN KEY (`id_walikelas`) REFERENCES `tb_walikelas` (`id_walikelas`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_pelanggaran` (`id_pelanggaran`, `id_siswa`, `id_walikelas`, `id_petugas_piket`, `id_nama_pelanggaran`, `kategori_pelanggaran`, `poin_pelanggaran`, `status`, `keterangan`, `date_created`, `date_updated`) VALUES
(2,	8,	1,	1,	2,	'sedang',	50,	'approve',	'Belajar Lagi Yah',	'2023-09-05 16:24:03',	'2023-09-06 00:39:27'),
(3,	9,	NULL,	1,	4,	NULL,	NULL,	'waiting',	NULL,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(5,	9,	2,	1,	3,	'sedang',	40,	'approve',	'Nakal yah kamu',	'2023-09-05 15:03:23',	'2023-09-06 00:40:07'),
(6,	10,	NULL,	1,	4,	NULL,	NULL,	'waiting',	NULL,	'2023-09-05 16:37:59',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `tb_petugas_piket`;
CREATE TABLE `tb_petugas_piket` (
  `id_petugas_piket` int(11) NOT NULL AUTO_INCREMENT,
  `nama_petugas` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id_petugas_piket`),
  KEY `id_user` (`nama_petugas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_petugas_piket` (`id_petugas_piket`, `nama_petugas`, `password`) VALUES
(1,	'osis1',	'$2y$10$s9eXgS5EuSPvoLWmSYNLt.gW5ohhTPd.lDeG66DSH4HiO8Qfd4DTK');

DROP TABLE IF EXISTS `tb_prestasi`;
CREATE TABLE `tb_prestasi` (
  `id_prestasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_siswa` int(11) NOT NULL,
  `id_walikelas` int(11) NOT NULL,
  `jenis_prestasi` varchar(20) NOT NULL,
  `keterangan_prestasi` text,
  `sertifikat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_prestasi`),
  KEY `id_siswa` (`id_siswa`),
  KEY `id_walikelas` (`id_walikelas`),
  CONSTRAINT `tb_prestasi_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `tb_siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_prestasi_ibfk_3` FOREIGN KEY (`id_walikelas`) REFERENCES `tb_walikelas` (`id_walikelas`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_prestasi` (`id_prestasi`, `id_siswa`, `id_walikelas`, `jenis_prestasi`, `keterangan_prestasi`, `sertifikat`) VALUES
(2,	8,	1,	'internasional',	'Keterangan prestasi',	'wilayah-20230905085155.pdf'),
(3,	8,	1,	'wilayah',	'Juara 2 ',	'wilayah-20230905125513.pdf'),
(4,	10,	2,	'nasional',	'Juara 2 ',	'nasional-20230905125621.pdf');

DROP TABLE IF EXISTS `tb_siswa`;
CREATE TABLE `tb_siswa` (
  `id_siswa` int(11) NOT NULL AUTO_INCREMENT,
  `nama_siswa` varchar(255) NOT NULL,
  `nisn` varchar(30) NOT NULL,
  `nipd` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` varchar(255) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_siswa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_siswa` (`id_siswa`, `nama_siswa`, `nisn`, `nipd`, `password`, `tempat_lahir`, `tanggal_lahir`, `agama`, `alamat`, `jenis_kelamin`, `status`) VALUES
(8,	'SISWA 1',	'42520029',	'42520029',	'$2y$10$c2.VuAMTgqOVKGyyHNHdpOsqHJnr/buFDyoV5b7ILVloUCY7BnvQG',	'PINRANG',	'2023-09-15',	'KRISTEN PROTESTAN',	'JL SUDIANG RAYA NO 3',	'L',	NULL),
(9,	'SISWA 2',	'123',	'321',	'12345678',	'MATARAM',	'2023-09-18',	'KONGHUCU',	'KOMP. BUMI BUNG PERMAI NO.A8/15, RT.001/RW.01',	'L',	NULL),
(10,	'SISWA 3',	'12345',	'12345',	'12345678',	'SIDOARJO',	'2023-09-15',	'HINDU',	'RAPPOCINI RAYA STREET',	'P',	NULL);

DROP TABLE IF EXISTS `tb_walikelas`;
CREATE TABLE `tb_walikelas` (
  `id_walikelas` int(11) NOT NULL AUTO_INCREMENT,
  `nama_walikelas` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `agama` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` varchar(255) NOT NULL,
  PRIMARY KEY (`id_walikelas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_walikelas` (`id_walikelas`, `nama_walikelas`, `nip`, `password`, `alamat`, `jenis_kelamin`, `agama`, `tempat_lahir`, `tanggal_lahir`) VALUES
(1,	'WALIKELAS 1',	'11111111',	'$2y$10$qMOlk/tsHFTV7Dtx9PhZwO1FCShkkf.J9PPfD6KN6hvwnhI8G9uV6',	'RAPPOCINI RAYA STREET',	'P',	'KRISTEN PROTESTAN',	'PINRANG',	'2023-09-27'),
(2,	'WALIKELAS 2',	'123',	'$2y$10$Y/9EJ8OBWsQRnKXOPONsxeSGoW1/gKi0mECDhXP6wuZYyK0nSQr0G',	'KOMP. BUMI BUNG PERMAI NO.A8/15, RT.001/RW.01',	'L',	'HINDU',	'MATARAM',	'2023-09-12');

-- 2023-09-06 13:41:32
