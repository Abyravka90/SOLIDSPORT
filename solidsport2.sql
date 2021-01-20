-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jan 2021 pada 09.30
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `solidsport2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `atlet`
--

CREATE TABLE `atlet` (
  `idAtlet` int(11) NOT NULL,
  `namaAtlet` varchar(50) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `kontingen` varchar(50) NOT NULL,
  `namaKata` varchar(50) NOT NULL,
  `grup` varchar(10) NOT NULL,
  `atribut` char(3) NOT NULL,
  `bermain` int(1) NOT NULL DEFAULT 0,
  `statusPenilaian` varchar(10) NOT NULL DEFAULT 'standby'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `atlet`
--

INSERT INTO `atlet` (`idAtlet`, `namaAtlet`, `kelas`, `kontingen`, `namaKata`, `grup`, `atribut`, `bermain`, `statusPenilaian`) VALUES
(1, 'Anji Nur Gilang', 'Kadet Putra', 'Citra Indah', 'Gojushiho', 'B', 'Ao', 1, 'standby'),
(2, 'Raya Tegas Syuhada', 'Kadet Putra', 'Hiroshima', 'Unsu', 'B', 'Ao', 1, 'standby'),
(3, 'Asep Cahya Nugraha', 'Kadet Putra', 'Gojukai Chaki', 'Popuren', 'B1', 'Ao', 0, 'standby'),
(4, 'Ade Ajie Ferizal', 'Kadet Putra', 'INKAI Jakarta', 'Suparimpei', 'B1', 'Ao', 0, 'standby');

-- --------------------------------------------------------

--
-- Struktur dari tabel `klasemen`
--

CREATE TABLE `klasemen` (
  `idKlasemen` int(11) NOT NULL,
  `idAtlet` char(3) NOT NULL,
  `namaAtlet` varchar(50) NOT NULL,
  `kontingen` varchar(50) NOT NULL,
  `grup` varchar(50) NOT NULL,
  `totalPoint` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `klasemen`
--

INSERT INTO `klasemen` (`idKlasemen`, `idAtlet`, `namaAtlet`, `kontingen`, `grup`, `totalPoint`) VALUES
(1, '1', 'Anji Nur Gilang', 'Citra Indah', 'B', 21.26),
(2, '2', 'Raya Tegas Syuhada', 'Hiroshima', 'B', 22.02);

-- --------------------------------------------------------

--
-- Struktur dari tabel `papanskor`
--

CREATE TABLE `papanskor` (
  `jenisScoreboard` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `grup` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `papanskor`
--

INSERT INTO `papanskor` (`jenisScoreboard`, `status`, `grup`) VALUES
('klasemen', 'idle', ''),
('scoreboard', 'aktif', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `point`
--

CREATE TABLE `point` (
  `idPoint` int(11) NOT NULL,
  `idAtlet` char(3) NOT NULL,
  `namaAtlet` varchar(50) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `kontingen` varchar(50) NOT NULL,
  `namaKata` varchar(50) NOT NULL,
  `grup` varchar(10) NOT NULL,
  `atribut` char(3) NOT NULL,
  `namaJuri` varchar(50) NOT NULL,
  `nilaiTeknik` double NOT NULL,
  `nilaiAtletik` double NOT NULL,
  `statusPenilaian` varchar(10) NOT NULL DEFAULT 'standby',
  `juriMenilai` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `point`
--

INSERT INTO `point` (`idPoint`, `idAtlet`, `namaAtlet`, `kelas`, `kontingen`, `namaKata`, `grup`, `atribut`, `namaJuri`, `nilaiTeknik`, `nilaiAtletik`, `statusPenilaian`, `juriMenilai`) VALUES
(1, '2', 'Raya Tegas Syuhada', 'Kadet Putra', 'Hiroshima', 'Unsu', 'B', 'Ao', 'J-1', 7.4, 7.2, 'saved', 1),
(2, '2', 'Raya Tegas Syuhada', 'Kadet Putra', 'Hiroshima', 'Unsu', 'B', 'Ao', 'J-2', 7.4, 7.2, 'saved', 1),
(3, '2', 'Raya Tegas Syuhada', 'Kadet Putra', 'Hiroshima', 'Unsu', 'B', 'Ao', 'J-3', 7.4, 7.2, 'saved', 1),
(4, '2', 'Raya Tegas Syuhada', 'Kadet Putra', 'Hiroshima', 'Unsu', 'B', 'Ao', 'J-4', 7.4, 7.2, 'saved', 1),
(5, '2', 'Raya Tegas Syuhada', 'Kadet Putra', 'Hiroshima', 'Unsu', 'B', 'Ao', 'J-5', 7.4, 7.2, 'saved', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `statusLogin` int(1) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`idUser`, `username`, `password`, `statusLogin`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `atlet`
--
ALTER TABLE `atlet`
  ADD PRIMARY KEY (`idAtlet`);

--
-- Indeks untuk tabel `klasemen`
--
ALTER TABLE `klasemen`
  ADD PRIMARY KEY (`idKlasemen`);

--
-- Indeks untuk tabel `papanskor`
--
ALTER TABLE `papanskor`
  ADD PRIMARY KEY (`jenisScoreboard`);

--
-- Indeks untuk tabel `point`
--
ALTER TABLE `point`
  ADD PRIMARY KEY (`idPoint`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `atlet`
--
ALTER TABLE `atlet`
  MODIFY `idAtlet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `klasemen`
--
ALTER TABLE `klasemen`
  MODIFY `idKlasemen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `point`
--
ALTER TABLE `point`
  MODIFY `idPoint` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
