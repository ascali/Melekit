-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 21 Des 2016 pada 05.38
-- Versi Server: 5.6.14
-- Versi PHP: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `db_sekolah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `nama`, `username`, `password`, `foto`, `email`, `create`, `update`) VALUES
(1, 'admin', 'admin', 'admin', '', 'admin@gmail.com', '2016-11-26 00:32:55', '2016-11-23 09:14:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `agenda`
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
-- Dumping data untuk tabel `agenda`
--

INSERT INTO `agenda` (`id`, `tanggal`, `acara`, `kegiatan`, `tempat`, `created`, `updated`) VALUES
(1, '11', 'coba', 'coba', 'intern', '2016-11-22 00:21:49', '2016-11-22 00:21:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_kelas`
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
-- Dumping data untuk tabel `detail_kelas`
--

INSERT INTO `detail_kelas` (`id`, `kelas`, `jumlah_room`, `rata_siswa`, `jumlah`, `id_jurusan`, `created`, `updated`) VALUES
(1, 'TKJ', 12, 30, 300, 11, '2016-11-04 00:32:16', '2016-11-27 03:28:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `eskull`
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
-- Struktur dari tabel `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NULL DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text,
  `url` text,
  `created` timestamp NULL DEFAULT NULL,
  `create_by` varchar(30) NOT NULL,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `event`
--

INSERT INTO `event` (`id`, `date`, `type`, `title`, `description`, `url`, `created`, `create_by`, `updated`) VALUES
(1, '2016-11-29 17:00:00', 'meeting', 'Test Event', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '#', '2016-11-25 17:00:00', 'admin', '2016-11-27 05:27:48'),
(2, '2016-11-28 17:00:00', 'meeting', 'est Last Year', 'Lorem ipsum dolor si', '#', '2016-11-26 17:25:55', 'admin', '2016-11-27 05:28:13'),
(3, '2016-11-27 17:00:00', 'dsfds', 'sdfsd', 'sdf', '#', '2016-11-27 05:53:35', 'admin', '2016-11-27 05:54:18'),
(4, '2016-11-29 17:00:00', 'asdasd', 'asdasd', 'asdasd', '#', '2016-11-27 05:55:09', 'admin', '2016-11-27 05:55:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `external_url`
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
-- Struktur dari tabel `galeri`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `galeri`
--

INSERT INTO `galeri` (`id`, `nama`, `keterangan`, `banner`, `file`, `created`, `updated`) VALUES
(3, 'gambar 1', 'ket', 'Iya', '1480218432702.jpg', '2016-11-27 03:47:12', '2016-11-27 03:47:12'),
(4, 'hamdan', 'detail', 'Iya', '1480227684808.jpg', '2016-11-27 06:21:24', '2016-11-27 06:21:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
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
  `status_karyawan` varchar(30) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `blog` varchar(255) NOT NULL,
  `prestasi` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id`, `nama`, `nip`, `nuptk`, `kelamin`, `ttl`, `pelajaran_jabatan`, `status`, `status_karyawan`, `alamat`, `blog`, `prestasi`, `foto`, `created`, `updated`) VALUES
(1, 'ibnu', 111, 111, 'Laki-Laki', 'hjhjh', 'jhjh', 'Kontrak', 'guru', 'jbbj', 'jkihjh', 'jhjh', '1479831735728.jpg', '2016-12-18 10:00:49', '2016-11-22 16:22:15'),
(2, 'Salsa', 1203046, 1203046, 'Perempuan', 'Indramayu, 1 April 1996', 'staff', 'Tetap', 'staff', 'Indramayu', 'salsa.wordpress.com', '', '', '2016-12-18 10:37:22', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE IF NOT EXISTS `jurusan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `detail_jurusan` varchar(255) NOT NULL,
  `lambang_jurusan` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`id`, `nama`, `detail_jurusan`, `lambang_jurusan`, `created`, `updated`) VALUES
(7, 'kkk', 'kkk', '', '2016-11-27 02:45:06', '2016-11-27 02:45:06'),
(8, 'mmm', 'mmm', '', '2016-11-27 02:45:29', '2016-11-27 02:45:29'),
(9, 'hhhh', 'hhh', '', '2016-11-27 02:56:06', '2016-11-27 02:56:06'),
(11, 'coba', 'detail', '1480216531468.jpg', '2016-11-27 03:15:31', '2016-11-27 03:15:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_konten`
--

CREATE TABLE IF NOT EXISTS `kategori_konten` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `kategori_konten`
--

INSERT INTO `kategori_konten` (`id`, `nama`, `created`, `updated`) VALUES
(2, 'Artikel', '2016-12-06 15:01:43', '2016-12-06 15:01:43'),
(3, 'Berita', '2016-11-21 14:37:00', '2016-11-21 14:37:00'),
(4, 'Loker', '2016-12-06 15:37:01', '2016-12-06 15:37:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kemitraan`
--

CREATE TABLE IF NOT EXISTS `kemitraan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `kemitraan`
--

INSERT INTO `kemitraan` (`id`, `nama`, `alamat`, `id_jurusan`, `created`, `updated`) VALUES
(1, 'Indosat', 'Indramayu', 11, '2016-12-15 14:13:09', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komen`
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
-- Dumping data untuk tabel `komen`
--

INSERT INTO `komen` (`id`, `oleh`, `email`, `date`, `isi`, `status_publish`, `created`, `updated`) VALUES
(1, 'jj', 'admin@gmail.com', '0000-00-00', 'sss', 1, '2016-11-14 16:31:28', '2016-11-15 17:23:59'),
(3, 'raden', 'op@gmail.com', '2016-11-15', 'kkk', 0, '2016-11-15 16:52:11', '2016-11-15 16:52:11'),
(4, 'ddd', 'admin@gmail.com', '2016-11-15', 'ddd', 0, '2016-11-15 16:52:38', '2016-11-15 16:52:38'),
(5, 'kk', 'ibnuhamdani234@gmail', '2016-11-18', 'OKI', 1, '2016-11-15 17:06:21', '2016-11-17 19:04:59'),
(6, 'jj', 'admin@gmail.com', '2016-11-18', 'OK', 1, '2016-11-17 19:02:13', '2016-11-17 19:04:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kontak`
--

CREATE TABLE IF NOT EXISTS `kontak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(30) NOT NULL,
  `isi` text NOT NULL,
  `map` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `create_by` varchar(30) NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `kontak`
--

INSERT INTO `kontak` (`id`, `judul`, `isi`, `map`, `create_date`, `update_date`, `create_by`) VALUES
(1, 'Kontak SMK 1 Indramayu', 'Indramayu', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.0402176358093!2d110.37821475!3d-7.785560899999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59d2a47d2609%3A0xd5a7d343fbdbcd63!2sJalan+Doktor+Wahidin+Sudirohusodo!5e0!3m2!1sid!2s!4v1395643159663" width="775" height="450" frameborder="0" style="border:0"></iframe>', '2016-12-19 08:09:36', '0000-00-00 00:00:00', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konten`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data untuk tabel `konten`
--

INSERT INTO `konten` (`id`, `judul`, `isi`, `id_kategori_konten`, `gambar`, `created`, `updated`, `create_by`) VALUES
(1, 'coba 2', 'detail coba 2', 3, '1479834848274.jpg', NULL, NULL, ''),
(2, 'coba 1', 'detail coba 1', 3, '1479836663038.jpg', NULL, NULL, ''),
(3, 'coba 3', 'detail coba 3', 3, '1480526302949.jpg', NULL, NULL, ''),
(4, 'coba 4', 'detail coba 4', 3, '1480526467803.jpg', NULL, NULL, ''),
(5, 'coba 5', 'detail coba 5', 3, '1480531153214.jpg', NULL, NULL, ''),
(6, 'Artikel 1', 'Artikel 1', 2, '1481036637241.jpg', '2016-12-05 17:00:00', '2016-12-05 17:00:00', 'Admin'),
(7, 'Artikel 2', 'Artikel 2', 2, '1481037881692.jpg', '2016-12-05 17:00:00', '2016-12-05 17:00:00', 'Admin'),
(8, 'Web Developer', 'Web Developer', 4, '1481038696245.jpg', NULL, NULL, ''),
(9, 'Administrator', 'Administrator', 4, '1481038729987.jpg', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `materi_ajar`
--

CREATE TABLE IF NOT EXISTS `materi_ajar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `materi_ajar`
--

INSERT INTO `materi_ajar` (`id`, `nama`, `created`, `updated`) VALUES
(1, 'test', '2016-12-18 09:06:19', '2016-12-18 09:06:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaturan`
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
-- Struktur dari tabel `profil`
--

CREATE TABLE IF NOT EXISTS `profil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(254) DEFAULT NULL,
  `tentang` text NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `profil`
--

INSERT INTO `profil` (`id`, `nama`, `tentang`, `kepala_sekolah`, `email`, `telp`, `visi`, `misi`, `sejarah`, `alamat`, `struktur_organisasi`, `program_kerja`, `fasilitas`, `prestasi_sekolah`, `logo`, `created`, `updated`) VALUES
(1, 'SMKN 1 BALONGAN', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vestibulum pellentesque urna. Phasellus adipiscing et massa et aliquam. Ut odio magna, interdum quis dolor non, tristique vestibulum nisi. Nam accumsan convallis venenatis. Nullam posuere risus odio, in interdum felis venenatis sagittis. Integer malesuada porta fermentum. Sed luctus nibh sed mi auctor imperdiet. Cras et sapien rhoncus, pulvinar dolor sed, tincidunt massa. Nullam fringilla mauris non risus ultricies viverra. Donec a turpis non lorem pulvinar posuere.', 'pa Dalban', 'balongang@gggg.com', '0222332', 'jjjnghdmdmh', 'kjugfmjhfjhfmmmm', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vestibulum pellentesque urna. Phasellus adipiscing et massa et aliquam. Ut odio magna, interdum quis dolor non, tristique vestibulum nisi. Nam accumsan convallis venenatis. Nullam posuere risus odio, in interdum felis venenatis sagittis. Integer malesuada porta fermentum. Sed luctus nibh sed mi auctor imperdiet. Cras et sapien rhoncus, pulvinar dolor sed, tincidunt massa. Nullam fringilla mauris non risus ultricies viverra. Donec a turpis non lorem pulvinar posuere.', 'jl balongan', '1480641734488.jpg', 'proker', 'banyak fasilitas', 'prestasi sekolah', '1480641734552.jpg', '2016-12-02 01:22:14', '2016-12-03 15:43:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `registrasi`
--

CREATE TABLE IF NOT EXISTS `registrasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(254) DEFAULT NULL,
  `email` varchar(254) DEFAULT NULL,
  `username` varchar(254) DEFAULT NULL,
  `password` varchar(254) DEFAULT NULL,
  `jurusan` varchar(255) NOT NULL,
  `status_kartu` tinyint(1) DEFAULT NULL,
  `status_terdaftar` tinyint(1) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `registrasi`
--

INSERT INTO `registrasi` (`id`, `nama`, `email`, `username`, `password`, `jurusan`, `status_kartu`, `status_terdaftar`, `created`, `updated`) VALUES
(1, 'ibnu', 'ibnugmail.com', 'ibnu', 'ibnu', 'TKJ', 1, 1, '2016-11-07 17:00:00', '2016-10-31 17:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id`, `nis`, `nama`, `kelas`, `id_jurusan`, `created`, `updated`) VALUES
(4, 1111, 'jjj', '1A', 11, '2016-11-27 03:35:55', '2016-11-27 03:35:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `video`
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
-- Dumping data untuk tabel `video`
--

INSERT INTO `video` (`id`, `nama`, `link`, `created`, `updated`) VALUES
(1, 'sssssss', 'sdsdaddddas', NULL, NULL),
(2, 'kk', 'kkk', '2016-11-16 16:56:48', '2016-11-16 16:56:48');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
