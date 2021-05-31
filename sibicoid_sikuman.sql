-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 12 Bulan Mei 2020 pada 18.37
-- Versi server: 10.1.43-MariaDB
-- Versi PHP: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sibicoid_sikuman`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `administrator`
--

CREATE TABLE `administrator` (
  `id_admin` int(11) NOT NULL,
  `nama_A` varchar(100) NOT NULL,
  `password_A` varchar(50) NOT NULL,
  `foto_A` varchar(100) NOT NULL,
  `NIK_A` varchar(16) NOT NULL,
  `email_A` varchar(100) NOT NULL,
  `alamat_A` varchar(100) NOT NULL,
  `no_hpA` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` int(11) NOT NULL,
  `nama_D` varchar(100) NOT NULL,
  `password_D` varchar(50) NOT NULL,
  `foto_D` varchar(100) NOT NULL,
  `NIK_D` varchar(16) NOT NULL,
  `email_D` varchar(100) NOT NULL,
  `alamat_D` varchar(100) NOT NULL,
  `no_hpD` varchar(12) NOT NULL,
  `no_str` varchar(50) NOT NULL,
  `no_berkas` varchar(50) NOT NULL,
  `kelamin_D` varchar(10) NOT NULL,
  `spesialis` varchar(50) NOT NULL,
  `RS_D` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `informasi`
--

CREATE TABLE `informasi` (
  `id_info` int(11) NOT NULL,
  `foto_info` varchar(100) NOT NULL,
  `tgl_info` date NOT NULL,
  `id_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kota`
--

CREATE TABLE `kota` (
  `id_kota` int(11) NOT NULL,
  `nama_kota` varchar(50) NOT NULL,
  `id_prov` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `membaca`
--

CREATE TABLE `membaca` (
  `id_info` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `waktu` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `nama_P` varchar(100) NOT NULL,
  `password_P` varchar(50) NOT NULL,
  `foto_P` varchar(100) NOT NULL,
  `NIK_P` varchar(16) NOT NULL,
  `email_P` varchar(100) NOT NULL,
  `alamat_P` varchar(100) NOT NULL,
  `no_hpP` varchar(12) NOT NULL,
  `Goldar` varchar(2) NOT NULL,
  `kelamin_P` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL,
  `pekerjaan` varchar(20) NOT NULL,
  `ttl_P` varchar(100) NOT NULL,
  `id_kota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `provinsi`
--

CREATE TABLE `provinsi` (
  `id_prov` int(11) NOT NULL,
  `nama_prov` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekap_medis`
--

CREATE TABLE `rekap_medis` (
  `id_rekap` int(11) NOT NULL,
  `tgl_rekap` date NOT NULL,
  `nama_D` varchar(100) NOT NULL,
  `nama_P` varchar(100) NOT NULL,
  `alamat_P` varchar(100) NOT NULL,
  `Goldar` varchar(2) NOT NULL,
  `usia_P` varchar(3) NOT NULL,
  `RS` varchar(100) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indeks untuk tabel `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`id_info`);

--
-- Indeks untuk tabel `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indeks untuk tabel `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`id_prov`);

--
-- Indeks untuk tabel `rekap_medis`
--
ALTER TABLE `rekap_medis`
  ADD PRIMARY KEY (`id_rekap`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `informasi`
--
ALTER TABLE `informasi`
  MODIFY `id_info` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kota`
--
ALTER TABLE `kota`
  MODIFY `id_kota` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `provinsi`
--
ALTER TABLE `provinsi`
  MODIFY `id_prov` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rekap_medis`
--
ALTER TABLE `rekap_medis`
  MODIFY `id_rekap` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
