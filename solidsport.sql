-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Des 2020 pada 18.19
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
-- Database: `solidsport`
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
  `bermain` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `atlet`
--

INSERT INTO `atlet` (`idAtlet`, `namaAtlet`, `kelas`, `kontingen`, `namaKata`, `grup`, `atribut`, `bermain`) VALUES
(1, 'Anji Nur Gilang', 'Kadet Putra', 'Citra Indah', 'Gojushiho', 'B', 'Ao', 0),
(2, 'Raya Tegas Syuhada', 'Kadet Putra', 'Hiroshima', 'Unsu', 'B', 'Ao', 0),
(3, 'Asep Cahya Nugraha', 'Kadet Putra', 'Gojukai Chaki', 'Popuren', 'B1', 'Ao', 0),
(4, 'Ade Ajie Ferizal', 'Kadet Putra', 'INKAI Jakarta', 'Suparimpei', 'B1', 'Ao', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `klasemen`
--

CREATE TABLE `klasemen` (
  `idKlasemen` int(11) NOT NULL,
  `idAtlet` int(11) NOT NULL,
  `namaAtlet` varchar(50) NOT NULL,
  `kontingen` varchar(50) NOT NULL,
  `grup` varchar(50) NOT NULL,
  `totalPoint` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `papanskor`
--

CREATE TABLE `papanskor` (
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `papanskor`
--

INSERT INTO `papanskor` (`status`) VALUES
('klasemen'),
('scoreboard');

-- --------------------------------------------------------

--
-- Struktur dari tabel `point`
--

CREATE TABLE `point` (
  `idPoint` int(11) NOT NULL,
  `namaAtlet` varchar(50) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `kontingen` varchar(50) NOT NULL,
  `namaKata` varchar(50) NOT NULL,
  `grup` varchar(10) NOT NULL,
  `atribut` char(3) NOT NULL,
  `namaJuri` varchar(50) NOT NULL,
  `nilaiTeknik` double NOT NULL,
  `nilaiAtletik` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `point`
--

INSERT INTO `point` (`idPoint`, `namaAtlet`, `kelas`, `kontingen`, `namaKata`, `grup`, `atribut`, `namaJuri`, `nilaiTeknik`, `nilaiAtletik`) VALUES
(1, '-', '-', '-', '-', '-', '-', 'J-1', 0, 0),
(2, '-', '-', '-', '-', '-', '-', 'J-2', 0, 0),
(3, '-', '-', '-', '-', '-', '-', 'J-3', 0, 0),
(4, '-', '-', '-', '-', '-', '-', 'J-4', 0, 0),
(5, '-', '-', '-', '-', '-', '-', 'J-5', 0, 0);

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
  ADD PRIMARY KEY (`status`);

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
  MODIFY `idKlasemen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `point`
--
ALTER TABLE `point`
  MODIFY `idPoint` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
