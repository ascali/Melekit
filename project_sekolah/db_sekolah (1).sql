-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 24, 2016 at 10:09 PM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_sekolah`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `foto` text NOT NULL,
  `email` varchar(40) NOT NULL,
  `create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `username`, `password`, `foto`, `email`, `create`, `update`) VALUES
(1, 'admin', 'adminjjj', 'admin', '', 'admin@gmail.com', '2016-11-23 15:14:45', '2016-11-23 09:14:45');

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE IF NOT EXISTS `agenda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` varchar(255) NOT NULL,
  `acara` varchar(255) NOT NULL,
  `kegiatan` varchar(255) NOT NULL,
  `tempat` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`id`, `tanggal`, `acara`, `kegiatan`, `tempat`, `created`, `updated`) VALUES
(1, '11', 'coba', 'coba', 'intern', '2016-11-22 00:21:49', '2016-11-22 00:21:49');

-- --------------------------------------------------------

--
-- Table structure for table `detail_kelas`
--

CREATE TABLE IF NOT EXISTS `detail_kelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kelas` varchar(255) NOT NULL,
  `jumlah_room` int(3) NOT NULL,
  `rata_siswa` int(3) NOT NULL,
  `jumlah` int(3) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `detail_kelas`
--

INSERT INTO `detail_kelas` (`id`, `kelas`, `jumlah_room`, `rata_siswa`, `jumlah`, `id_jurusan`, `created`, `updated`) VALUES
(1, 'TKJ', 0, 0, 0, 0, '2016-11-04 00:32:16', '2016-11-10 23:11:09');

-- --------------------------------------------------------

--
-- Table structure for table `eskull`
--

CREATE TABLE IF NOT EXISTS `eskull` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isi` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `external_url`
--

CREATE TABLE IF NOT EXISTS `external_url` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `target` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE IF NOT EXISTS `galeri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(254) DEFAULT NULL,
  `keterangan` text,
  `banner` enum('Iya','Tidak') DEFAULT NULL,
  `file` varchar(255) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id`, `nama`, `keterangan`, `banner`, `file`, `created`, `updated`) VALUES
(1, 'Konten', 'Konten', '', '', '2016-11-15 00:05:56', '2016-11-17 15:39:09'),
(2, 'coba', 'OK', '', '', '2016-11-17 19:11:30', '2016-11-17 19:11:30');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE IF NOT EXISTS `guru` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `nip` int(15) NOT NULL,
  `nuptk` int(15) NOT NULL,
  `kelamin` enum('Laki-Laki','Perempuan','','') NOT NULL,
  `ttl` varchar(255) NOT NULL,
  `pelajaran_jabatan` varchar(255) NOT NULL,
  `status` enum('Kontrak','Tetap','','') NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `blog` varchar(255) NOT NULL,
  `prestasi` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nama`, `nip`, `nuptk`, `kelamin`, `ttl`, `pelajaran_jabatan`, `status`, `alamat`, `blog`, `prestasi`, `foto`, `created`, `updated`) VALUES
(1, 'ibnu', 111, 111, 'Laki-Laki', 'hjhjh', 'jhjh', 'Kontrak', 'jbbj', 'jkihjh', 'jhjh', '1479831735728.jpg', '2016-11-22 16:22:15', '2016-11-22 16:22:15');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE IF NOT EXISTS `jurusan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `detail_jurusan` varchar(255) NOT NULL,
  `lambang_jurusan` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_konten`
--

CREATE TABLE IF NOT EXISTS `kategori_konten` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `kategori_konten`
--

INSERT INTO `kategori_konten` (`id`, `nama`, `created`, `updated`) VALUES
(2, 'test', '2016-11-17 23:51:02', '2016-11-10 16:42:07'),
(3, 'Berita', '2016-11-21 14:37:00', '2016-11-21 14:37:00');

-- --------------------------------------------------------

--
-- Table structure for table `kemitraan`
--

CREATE TABLE IF NOT EXISTS `kemitraan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `komen`
--

CREATE TABLE IF NOT EXISTS `komen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oleh` varchar(90) NOT NULL,
  `email` varchar(90) NOT NULL,
  `date` date NOT NULL,
  `isi` varchar(255) NOT NULL,
  `status_publish` tinyint(1) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `komen`
--

INSERT INTO `komen` (`id`, `oleh`, `email`, `date`, `isi`, `status_publish`, `created`, `updated`) VALUES
(1, 'jj', 'admin@gmail.com', '0000-00-00', 'sss', 1, '2016-11-14 16:31:28', '2016-11-15 17:23:59'),
(3, 'raden', 'op@gmail.com', '2016-11-15', 'kkk', 0, '2016-11-15 16:52:11', '2016-11-15 16:52:11'),
(4, 'ddd', 'admin@gmail.com', '2016-11-15', 'ddd', 0, '2016-11-15 16:52:38', '2016-11-15 16:52:38'),
(5, 'kk', 'ibnuhamdani234@gmail', '2016-11-18', 'OKI', 1, '2016-11-15 17:06:21', '2016-11-17 19:04:59'),
(6, 'jj', 'admin@gmail.com', '2016-11-18', 'OK', 1, '2016-11-17 19:02:13', '2016-11-17 19:04:55');

-- --------------------------------------------------------

--
-- Table structure for table `konten`
--

CREATE TABLE IF NOT EXISTS `konten` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(254) DEFAULT NULL,
  `isi` text,
  `id_kategori_konten` int(11) DEFAULT NULL,
  `gambar` varchar(255) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL,
  `create_by` varchar(254) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `konten`
--

INSERT INTO `konten` (`id`, `judul`, `isi`, `id_kategori_konten`, `gambar`, `created`, `updated`, `create_by`) VALUES
(1, 'jkjkj', 'ughjgf HHHHH', NULL, '1479834848274.jpg', NULL, NULL, ''),
(2, 'jjj', 'jncjkbsadcvbji', 3, '1479836663038.jpg', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `materi_ajar`
--

CREATE TABLE IF NOT EXISTS `materi_ajar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE IF NOT EXISTS `pengaturan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_judul` varchar(254) DEFAULT NULL,
  `favicon` text,
  `copy_right` varchar(254) DEFAULT NULL,
  `keterangan` text,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE IF NOT EXISTS `profil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(254) DEFAULT NULL,
  `kepala_sekolah` varchar(254) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `visi` text,
  `misi` text,
  `sejarah` text,
  `alamat` text,
  `struktur_organisasi` varchar(255) NOT NULL,
  `program_kerja` varchar(255) NOT NULL,
  `fasilitas` varchar(255) NOT NULL,
  `prestasi_sekolah` varchar(255) NOT NULL,
  `logo` text,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `registrasi`
--

CREATE TABLE IF NOT EXISTS `registrasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(254) DEFAULT NULL,
  `email` varchar(254) DEFAULT NULL,
  `username` varchar(254) DEFAULT NULL,
  `password` varchar(254) DEFAULT NULL,
  `jurusan` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `registrasi`
--

INSERT INTO `registrasi` (`id`, `nama`, `email`, `username`, `password`, `jurusan`, `status`, `created`, `updated`) VALUES
(1, 'ibnu', 'ibnugmail.com', 'ibnu', 'ibnu', 'TKJ', 0, '2016-11-07 17:00:00', '2016-10-31 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nis` int(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nis`, `nama`, `kelas`, `id_jurusan`, `created`, `updated`) VALUES
(2, 0, 'coba', '1', 0, '2016-11-14 16:27:53', '2016-11-14 16:27:53'),
(3, 130303, 'hhh', '1A', 0, '2016-11-22 14:55:47', '2016-11-22 14:55:47');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(254) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id`, `nama`, `link`, `created`, `updated`) VALUES
(1, 'sssssss', 'sdsdaddddas', NULL, NULL),
(2, 'kk', 'kkk', '2016-11-16 16:56:48', '2016-11-16 16:56:48');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
