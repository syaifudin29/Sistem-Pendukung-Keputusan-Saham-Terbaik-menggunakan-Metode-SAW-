-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jun 2022 pada 05.29
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbsawsaham`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `status` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `status`) VALUES
(1, 'admin', 'admin', '2'),
(2, 'user', 'user', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(11) NOT NULL,
  `id_saham` int(11) NOT NULL,
  `tahun` int(4) NOT NULL,
  `nilai_preferensi` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `id_saham`, `tahun`, `nilai_preferensi`) VALUES
(89, 2, 2018, 0.757),
(90, 3, 2018, 0.47),
(91, 4, 2018, 0.537),
(92, 5, 2018, 0.933),
(93, 6, 2018, 0.657),
(94, 7, 2018, 0.808),
(95, 8, 2018, 0.72),
(96, 9, 2018, 0.657),
(97, 10, 2018, 0.817),
(111, 2, 2019, 0.867),
(112, 5, 2019, 0.6),
(124, 6, 2020, 0.65);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(20) NOT NULL,
  `bobot_kriteria` float NOT NULL,
  `keterangan` enum('cost','benefit') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `bobot_kriteria`, `keterangan`) VALUES
(1, 'EPS', 0.15, 'benefit'),
(2, 'PER', 0.25, 'cost'),
(3, 'PBV', 0.22, 'cost'),
(4, 'DER', 0.18, 'cost'),
(5, 'ROE', 0.2, 'benefit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_kriteria`
--

CREATE TABLE `nilai_kriteria` (
  `id_nilai` int(11) NOT NULL,
  `id_saham` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai_kriteria` float NOT NULL,
  `tahun` int(4) NOT NULL,
  `date_create` date NOT NULL DEFAULT current_timestamp(),
  `id_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `nilai_kriteria`
--

INSERT INTO `nilai_kriteria` (`id_nilai`, `id_saham`, `id_kriteria`, `nilai_kriteria`, `tahun`, `date_create`, `id_admin`) VALUES
(1, 1, 1, 175.58, 2018, '2022-06-14', 1),
(2, 1, 2, 8.86, 2018, '2022-06-14', 1),
(3, 1, 3, 0.9, 2018, '2022-06-14', 1),
(4, 1, 4, 0.81, 2018, '2022-06-14', 1),
(5, 1, 5, 10.15, 2018, '2022-06-14', 1),
(6, 2, 1, 179.3, 2018, '2022-06-14', 1),
(7, 2, 2, 22.02, 2018, '2022-06-14', 1),
(8, 2, 3, 1.58, 2018, '2022-06-14', 1),
(9, 2, 4, 1.13, 2018, '2022-06-14', 1),
(10, 2, 5, 7.12, 2018, '2022-06-14', 1),
(11, 3, 1, 68.17, 2018, '2022-06-14', 1),
(12, 3, 2, 11.22, 2018, '2022-06-14', 1),
(13, 3, 3, 1.11, 2018, '2022-06-14', 1),
(14, 3, 4, 0.67, 2018, '2022-06-14', 1),
(15, 3, 5, 1.07, 2018, '2022-06-14', 1),
(16, 4, 1, 535.98, 2018, '2022-06-14', 1),
(17, 4, 2, 12.92, 2018, '2022-06-14', 1),
(18, 4, 3, 1.5, 2018, '2022-06-14', 1),
(19, 4, 4, 0.88, 2018, '2022-06-14', 1),
(20, 4, 5, 11.62, 2018, '2022-06-14', 1),
(21, 5, 1, 1170.7, 2018, '2022-06-14', 1),
(22, 5, 2, 28.55, 2018, '2022-06-14', 1),
(23, 5, 3, 4, 2018, '2022-06-14', 1),
(24, 5, 4, 4.28, 2018, '2022-06-14', 1),
(25, 5, 5, 16.4, 2018, '2022-06-14', 1),
(26, 6, 1, 831.11, 2018, '2022-06-14', 1),
(27, 6, 2, 9.44, 2018, '2022-06-14', 1),
(28, 6, 3, 1.16, 2018, '2022-06-14', 1),
(29, 6, 4, 5.76, 2018, '2022-06-14', 1),
(30, 6, 5, 12.31, 2018, '2022-06-14', 1),
(31, 7, 1, 281.51, 2018, '2022-06-14', 1),
(32, 7, 2, 15.63, 2018, '2022-06-14', 1),
(33, 7, 3, 2.57, 2018, '2022-06-14', 1),
(34, 7, 4, 5.79, 2018, '2022-06-14', 1),
(35, 7, 5, 16.46, 2018, '2022-06-14', 1),
(36, 8, 1, 19.93, 2018, '2022-06-14', 1),
(37, 8, 2, 106.37, 2018, '2022-06-14', 1),
(38, 8, 3, 0.93, 2018, '2022-06-14', 1),
(39, 8, 4, 12.08, 2018, '2022-06-14', 1),
(40, 8, 5, 0.88, 2018, '2022-06-14', 1),
(41, 9, 1, 594.85, 2018, '2022-06-14', 1),
(42, 9, 2, 12.9, 2018, '2022-06-14', 1),
(43, 9, 3, 1.7, 2018, '2022-06-14', 1),
(44, 9, 4, 5.31, 2018, '2022-06-14', 1),
(45, 9, 5, 13.15, 2018, '2022-06-14', 1),
(46, 10, 1, 6.89, 2018, '2022-06-14', 1),
(47, 10, 2, 219, 2018, '2022-06-14', 1),
(48, 10, 3, 3.51, 2018, '2022-06-14', 1),
(49, 10, 4, 1.61, 2018, '2022-06-14', 1),
(50, 10, 5, 1.6, 2018, '2022-06-14', 1),
(106, 5, 1, 1, 2019, '2022-06-14', 1),
(107, 5, 2, 6, 2019, '2022-06-14', 1),
(108, 5, 3, 6, 2019, '2022-06-14', 1),
(109, 5, 4, 6, 2019, '2022-06-14', 1),
(110, 5, 5, 6, 2019, '2022-06-14', 1),
(116, 6, 1, 6, 2020, '2022-06-14', 1),
(117, 6, 2, 6, 2020, '2022-06-14', 1),
(118, 6, 3, 6, 2020, '2022-06-14', 1),
(119, 6, 4, 6, 2020, '2022-06-14', 1),
(120, 6, 5, 6, 2020, '2022-06-14', 1),
(121, 2, 1, 455, 2019, '2022-06-14', 1),
(122, 2, 2, 66, 2019, '2022-06-14', 1),
(123, 2, 3, 7, 2019, '2022-06-14', 1),
(124, 2, 4, 88, 2019, '2022-06-14', 1),
(125, 2, 5, 9, 2019, '2022-06-14', 1),
(130, 90, 5, 6, 2020, '2022-06-14', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `saham`
--

CREATE TABLE `saham` (
  `id_saham` int(11) NOT NULL,
  `kode_saham` varchar(10) NOT NULL,
  `nama_saham` varchar(30) NOT NULL,
  `id_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `saham`
--

INSERT INTO `saham` (`id_saham`, `kode_saham`, `nama_saham`, `id_admin`) VALUES
(2, 'AKRA', '', 1),
(3, 'ANTM', '', 1),
(4, 'ASII', 'asasas', 0),
(5, 'BBCA', 'BANK BCA', 0),
(6, 'BBNI', '', 1),
(7, 'BBRI', '', 1),
(8, 'BBTN', '', 1),
(9, 'BMRI', '', 1),
(10, 'BRPT', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indeks untuk tabel `saham`
--
ALTER TABLE `saham`
  ADD PRIMARY KEY (`id_saham`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT untuk tabel `saham`
--
ALTER TABLE `saham`
  MODIFY `id_saham` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
