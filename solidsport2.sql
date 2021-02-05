-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Feb 2021 pada 03.11
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
(1, 'ALIF LANGIT RAMADHAN ', 'USIA DINI PUTRA', ' PREDATOR KARATE CLUB', 'HEIAN YONDAN ', 'A1', 'Ao', 0, 'standby'),
(2, 'NIZAM FAIZ', 'USIA DINI PUTRA', 'DOJO OPUNG ASKI', 'HEIAN YONDAN', 'A1', 'Ao', 0, 'standby'),
(3, 'Wahyu Williansah', 'USIA DINI PUTRA', 'BENGPUSHUB PUSHUBAD KOTA BANDUNG', 'HEIAN YONDAN', 'A1', 'Ao', 0, 'standby'),
(4, 'Daniel Florencio Dermawan', 'USIA DINI PUTRA', 'SDN RRI CISALAK', 'HEIAN YONDAN', 'A1', 'Ao', 0, 'standby'),
(5, 'ABDILLATUL QUBRO', 'USIA DINI PUTRA', 'AMC INKANAS DKI JAKARTA', 'HEIAN YONDAN', 'A1', 'Ao', 0, 'standby'),
(6, 'TRAVIS NATHA DAFFA KUMARA', 'USIA DINI PUTRA', 'DONSKA', 'HEIAN YONDAN', 'A1', 'Ao', 0, 'standby'),
(7, 'YUSUF AR RAHMAN RUSLI', 'USIA DINI PUTRA', 'COAST GUARD KARATE TEAM - SULAWESI TENGGARA', 'HEIAN YONDAN', 'A2', 'Ao', 0, 'standby'),
(8, 'HAFIZH MAULANA', 'USIA DINI PUTRA', 'GOJU ASS LAMPUNG', 'Gekisai Dai Ich', 'A2', 'Ao', 0, 'standby'),
(9, 'Mochamad  Raihan NN', 'USIA DINI PUTRA', 'CIPAISAN PURWAKARTA', 'HEIAN SODAN', 'A2', 'Ao', 0, 'standby'),
(10, 'HIROKI AMMARKIANDRA PITANA', 'USIA DINI PUTRA', 'AGGAZI KARATE CLUB', 'HEIAN YONDAN', 'A2', 'Ao', 0, 'standby'),
(11, 'MUHAMMAD SAFARAZ AKMA WAFRIE', 'USIA DINI PUTRA', 'UNTAN KARATE CLUB', 'HEIAN YONDAN', 'A2', 'Ao', 0, 'standby'),
(12, 'MUHAMMAD ALIEF PUTRA SATRIA', 'USIA DINI PUTRA', 'DONSKA', 'HEIAN YONDAN', 'A2', 'Ao', 0, 'standby'),
(13, 'ALFATH RIZQY NASRUDDIN ', 'USIA DINI PUTRA', ' PREDATOR KARATE CLUB', 'HEIAN YONDAN ', 'B1', 'Ao', 0, 'standby'),
(14, 'M. FAUZAN AL-BARIZY', 'USIA DINI PUTRA', 'GOJU ASS LAMPUNG', 'Gekisai Dai Ich', 'B1', 'Ao', 0, 'standby'),
(15, 'ALFARIZI', 'USIA DINI PUTRA', 'DOJO OPUNG ASKI', 'HEIAN YONDAN', 'B1', 'Ao', 0, 'standby'),
(16, 'Bintang Aleka Pratama Yusa', 'USIA DINI PUTRA', 'KOREM 064 MAULANA YUSUF', 'HEIAN YONDAN', 'B1', 'Ao', 0, 'standby'),
(17, 'M. Akbar Alfatih M', 'USIA DINI PUTRA', 'SDN RRI CISALAK', 'HEIAN YONDAN ', 'B1', 'Ao', 0, 'standby'),
(18, 'ZESHAN EXEL RIZKY SATRIA RAMADHAN', 'USIA DINI PUTRA', 'AMC INKANAS DKI JAKARTA', 'HEIAN YONDAN', 'B1', 'Ao', 0, 'standby'),
(19, 'RAYYAN AGHA MURDANA', 'USIA DINI PUTRA', 'DONSKA', 'HEIAN YONDAN ', 'B1', 'Ao', 0, 'standby'),
(20, 'MUHAMMAD KAUTSAR MEHAGA PERANGINANGIN', 'USIA DINI PUTRA', 'BUMI MAKMUR', 'HEIAN YONDAN', 'B2', 'Ao', 0, 'standby'),
(21, 'M. ASKAR GOJURYU', 'USIA DINI PUTRA', 'GOJU ASS LAMPUNG', 'Gekisai Dai Ich', 'B2', 'Ao', 0, 'standby'),
(22, 'Virzatollah Ramadhan hillary', 'USIA DINI PUTRA', 'CIPAISAN PURWAKARTA', 'HEIAN YONDAN', 'B2', 'Ao', 0, 'standby'),
(23, 'M. AKBAR RAFSANJANI', 'USIA DINI PUTRA', 'PUMA KARATE CLUB PONTIANAK TIMUR KALBAR', 'HEIAN YONDAN', 'B2', 'Ao', 0, 'standby'),
(24, 'AHMAD MADINAH', 'USIA DINI PUTRA', 'DONSKA', 'HEIAN YONDAN', 'B2', 'Ao', 0, 'standby'),
(25, 'MUHAMMAD YAZID ILMANY WIJAYA', 'USIA DINI PUTRA', 'DONSKA', 'HEIAN YONDAN', 'B2', 'Ao', 0, 'standby');

-- --------------------------------------------------------

--
-- Struktur dari tabel `klasemen`
--

CREATE TABLE `klasemen` (
  `idKlasemen` int(11) NOT NULL,
  `idAtlet` char(3) NOT NULL,
  `namaAtlet` varchar(50) NOT NULL,
  `atribut` char(3) NOT NULL,
  `kontingen` varchar(50) NOT NULL,
  `grup` varchar(50) NOT NULL,
  `totalPoint` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `papanskor`
--

CREATE TABLE `papanskor` (
  `jenisScoreboard` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `kelas` varchar(150) NOT NULL,
  `grup` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `papanskor`
--

INSERT INTO `papanskor` (`jenisScoreboard`, `status`, `kelas`, `grup`) VALUES
('klasemen', 'idle', '', 'final'),
('scoreboard', 'aktif', '', '-');

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
(1, '-', '-', '-', '-', '-', '-', '-', 'J-1', 0, 0, 'standby', 0),
(2, '-', '-', '-', '-', '-', '-', '-', 'J-2', 0, 0, 'standby', 0),
(3, '-', '-', '-', '-', '-', '-', '-', 'J-3', 0, 0, 'standby', 0),
(4, '-', '-', '-', '-', '-', '-', '-', 'J-4', 0, 0, 'standby', 0),
(5, '-', '-', '-', '-', '-', '-', '-', 'J-5', 0, 0, 'standby', 0);

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
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 4, 1),
(2, 'J-1', '6caeba444797a281a0110e0c80ad5814', 0, 2),
(3, 'J-2', '843eca7556234d9c90eae1fc0f1e2939', 0, 2),
(4, 'J-3', '6050b64b6ad6fa8f163ca9e06c05a815', 0, 2),
(5, 'J-4', '6a0cf6edf20060344b465706b61719aa', 0, 2),
(6, 'J-5', '839b73fc7ea3dbf8ad62b3bf4434d094', 0, 2);

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
  MODIFY `idAtlet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `klasemen`
--
ALTER TABLE `klasemen`
  MODIFY `idKlasemen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `point`
--
ALTER TABLE `point`
  MODIFY `idPoint` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
