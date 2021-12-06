-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Des 2021 pada 02.01
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kue_rumahan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `kode_admin` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `ttl` date NOT NULL,
  `jeniskelamin` enum('L','P') NOT NULL,
  `nama_toko` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`kode_admin`, `nama`, `alamat`, `ttl`, `jeniskelamin`, `nama_toko`, `username`, `password`) VALUES
('A-2021-12-03-1', 'Andi Malia Fadilah Bahari', 'Bandung', '2001-07-01', 'P', 'haha', 'andimalia1007A', '7c2008f71c02e6f08a40'),
('A-2021-12-03-2', 'admin2', 'alamat1', '2000-01-01', 'L', 'haha1', 'admin1', '38b3eff8baf56627478e');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dijual`
--

CREATE TABLE `dijual` (
  `kode_produk` varchar(20) NOT NULL,
  `kode_admin` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dijual`
--

INSERT INTO `dijual` (`kode_produk`, `kode_admin`) VALUES
('A211203-1_1', 'A-2021-12-03-1'),
('A211203-1_2', 'A-2021-12-03-1'),
('A211203-1_3', 'A-2021-12-03-1'),
('A211203-1_4', 'A-2021-12-03-1'),
('A211203-1_5', 'A-2021-12-03-1'),
('A211203-2_1', 'A-2021-12-03-2'),
('A211203-2_2', 'A-2021-12-03-2'),
('A211203-2_3', 'A-2021-12-03-2'),
('A211203-2_4', 'A-2021-12-03-2'),
('A211203-2_5', 'A-2021-12-03-2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jasapengantar`
--

CREATE TABLE `jasapengantar` (
  `kode_badan` varchar(20) NOT NULL,
  `kode_kategori` varchar(20) DEFAULT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `notlp` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `kode_kategori` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kode_kategori`, `nama`) VALUES
('19050000', 'Roti'),
('19051000', 'Roti kering'),
('19052000', 'Roti jahe dan sejenisnya '),
('19053100', 'Biskuit manis'),
('19053110', 'Biskuit Tidak mengandung kakao'),
('19053120', 'Biskuit mengandung kakao '),
('19053200', 'Wafel dan wafer'),
('19053210', 'Wafel'),
('19053220', 'Wafer'),
('19054000', 'Rusk, roti panggang dan produk'),
('19054010', 'Produk panggang tidak mengandu'),
('19059010', 'Biskuit tidak manis'),
('19059030', 'Kue'),
('19059040', 'Kue kering'),
('19059050', 'Produk roti tanpa tepung'),
('19059060', 'Selongsong kosong dari jenis y'),
('19059070', 'Wafer komuni, sealing wafer, r');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kurir`
--

CREATE TABLE `kurir` (
  `kode_kurir` varchar(20) NOT NULL,
  `kode_badan` varchar(20) DEFAULT NULL,
  `nama` varchar(30) NOT NULL,
  `jeniskelamin` enum('L','P') NOT NULL,
  `notlp` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `kode_member` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `ttl` date NOT NULL,
  `jeniskelamin` enum('L','P') NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`kode_member`, `nama`, `alamat`, `ttl`, `jeniskelamin`, `username`, `password`) VALUES
('M-2021-12-02-1', 'Andi Malia Fadilah Bahari', 'Bandung', '2001-01-10', 'P', 'andimalia1007', '7815696ecbf1c96e6894'),
('M-2021-12-02-2', 'member2', 'alamat2', '2000-01-01', 'L', 'member2', 'fdsfnewmbghdsfnsdj'),
('M-2021-12-02-3', 'member3', 'alamat3', '2000-01-02', 'L', 'member3', '7815696ecbf1c96e6894'),
('M-2021-12-02-4', 'member4', 'alamat4', '2000-01-03', 'P', 'member4', '4f4adcbf8c6f66dcfc8a'),
('M-2021-12-03-1', 'admin3', 'alamat2', '2000-01-02', 'L', 'admin2', 'ec8956637a99787bd197');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `kode_produk` varchar(20) NOT NULL,
  `kode_kategori` varchar(20) DEFAULT NULL,
  `nama` varchar(30) NOT NULL,
  `stok` int(11) NOT NULL,
  `hargasatuan` decimal(7,2) NOT NULL,
  `kadaluarsa` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`kode_produk`, `kode_kategori`, `nama`, `stok`, `hargasatuan`, `kadaluarsa`) VALUES
('A211203-1_1', '19050000', 'Roti haha', 19, '7000.00', '2022-03-04'),
('A211203-1_2', '19051000', 'Roti Kering haha', 30, '3000.00', '2022-04-10'),
('A211203-1_3', '19053100', 'Biskuit haha', 50, '3500.00', '2022-03-18'),
('A211203-1_4', '19053120', 'Biskuit cokelat haha', 45, '3500.00', '2022-03-20'),
('A211203-1_5', '19059040', 'Kue keju haha', 60, '4500.00', '2022-03-15'),
('A211203-2_1', '19050000', 'Roti haha', 20, '7000.00', '2022-03-04'),
('A211203-2_2', '19051000', 'Roti Kering haha', 30, '3000.00', '2022-04-10'),
('A211203-2_3', '19053100', 'Biskuit haha', 50, '3500.00', '2022-03-18'),
('A211203-2_4', '19053120', 'Biskuit cokelat haha', 45, '3500.00', '2022-03-20'),
('A211203-2_5', '19059040', 'Kue keju haha', 60, '4500.00', '2022-03-15');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`kode_admin`);

--
-- Indeks untuk tabel `dijual`
--
ALTER TABLE `dijual`
  ADD KEY `admin_Dijual` (`kode_admin`),
  ADD KEY `produk_Dijual` (`kode_produk`);

--
-- Indeks untuk tabel `jasapengantar`
--
ALTER TABLE `jasapengantar`
  ADD PRIMARY KEY (`kode_badan`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kode_kategori`);

--
-- Indeks untuk tabel `kurir`
--
ALTER TABLE `kurir`
  ADD PRIMARY KEY (`kode_kurir`),
  ADD KEY `personil` (`kode_badan`);

--
-- Indeks untuk tabel `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`kode_member`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`kode_produk`),
  ADD KEY `jenisProduk` (`kode_kategori`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `dijual`
--
ALTER TABLE `dijual`
  ADD CONSTRAINT `admin_Dijual` FOREIGN KEY (`kode_admin`) REFERENCES `admin` (`kode_admin`),
  ADD CONSTRAINT `produk_Dijual` FOREIGN KEY (`kode_produk`) REFERENCES `produk` (`kode_produk`);

--
-- Ketidakleluasaan untuk tabel `kurir`
--
ALTER TABLE `kurir`
  ADD CONSTRAINT `personil` FOREIGN KEY (`kode_badan`) REFERENCES `jasapengantar` (`kode_badan`);

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `jenisProduk` FOREIGN KEY (`kode_kategori`) REFERENCES `kategori` (`kode_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
