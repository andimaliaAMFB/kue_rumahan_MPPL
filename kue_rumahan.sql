-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Des 2021 pada 16.50
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
-- Struktur dari tabel `cek`
--

CREATE TABLE `cek` (
  `id` int(11) NOT NULL,
  `kode_member` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `cek`
--

INSERT INTO `cek` (`id`, `kode_member`) VALUES
(1, 'M-2021-12-02-1'),
(2, 'M-2021-12-02-1'),
(3, 'M-2021-12-02-1'),
(4, 'M-2021-12-02-1'),
(5, 'M-2021-12-02-1');

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
-- Struktur dari tabel `orderkue`
--

CREATE TABLE `orderkue` (
  `kode_order` int(11) NOT NULL,
  `waktu_pemesanan` datetime NOT NULL,
  `waktu_pembayaran` datetime NOT NULL,
  `kode_member` varchar(20) NOT NULL,
  `status` varchar(15) NOT NULL,
  `komentar` text DEFAULT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `orderkue`
--

INSERT INTO `orderkue` (`kode_order`, `waktu_pemesanan`, `waktu_pembayaran`, `kode_member`, `status`, `komentar`, `alamat`) VALUES
(1, '2021-12-07 11:43:44', '2021-12-07 11:43:44', 'M-2021-12-02-2', 'Sedang Dikirim', NULL, 'Jakarta'),
(101, '2021-12-07 10:58:20', '2021-12-07 10:58:20', 'M-2021-12-02-1', 'Sedang Diantar', NULL, 'Bandung'),
(102, '2021-12-07 10:58:20', '2021-12-07 10:58:20', 'M-2021-12-02-1', 'Sedang Diantar', NULL, 'Bandung'),
(103, '2021-12-07 10:58:20', '2021-12-07 10:58:20', 'M-2021-12-02-1', 'Sedang Diantar', NULL, 'Bandung'),
(104, '2021-12-07 10:58:20', '2021-12-07 10:58:20', 'M-2021-12-02-1', 'Sedang Diantar', NULL, 'Bandung'),
(105, '2021-12-07 10:58:20', '2021-12-07 10:58:20', 'M-2021-12-02-1', 'Sedang Diantar', NULL, 'Bandung'),
(106, '2021-12-07 10:58:20', '2021-12-07 10:58:20', 'M-2021-12-02-1', 'Sedang Diantar', NULL, 'Bandung'),
(107, '2021-12-07 10:58:20', '2021-12-07 10:58:20', 'M-2021-12-02-1', 'Sedang Diantar', NULL, 'Bandung'),
(108, '2021-12-07 10:58:20', '2021-12-07 10:58:20', 'M-2021-12-02-2', 'Sedang Diantar', NULL, 'Bandung'),
(109, '2021-12-07 10:58:20', '2021-12-07 10:58:20', 'M-2021-12-02-2', 'Sedang Diantar', NULL, 'Bandung'),
(110, '2021-12-07 10:58:20', '2021-12-07 10:58:20', 'M-2021-12-02-2', 'Sedang Diantar', NULL, 'Bandung'),
(111, '2021-12-07 11:45:08', '2021-12-07 11:45:08', 'M-2021-12-02-2', 'Sedang Dikirim', NULL, 'Jakarta'),
(112, '2021-12-07 15:04:16', '2021-12-09 15:32:22', 'M-2021-12-02-4', 'Sedang Diantar', NULL, 'Jakarta'),
(113, '2021-12-07 16:12:53', '2021-12-09 16:12:59', 'M-2021-12-02-4', 'Sedang Diantar', NULL, 'Bandung'),
(114, '2021-12-07 16:16:10', '2021-12-09 16:16:15', 'M-2021-12-02-4', 'Sedang Diantar', '', 'Jakarta'),
(115, '2021-12-07 16:19:59', '2021-12-09 16:20:04', 'M-2021-12-02-4', 'Sedang Diantar', '', 'Bandung'),
(116, '2021-12-07 16:35:25', '2021-12-09 16:36:57', 'M-2021-12-02-4', 'Sedang Diantar', '', 'Subang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orderkuedetail`
--

CREATE TABLE `orderkuedetail` (
  `kode_order` int(11) NOT NULL,
  `kode_produk` varchar(20) NOT NULL,
  `kode_admin` varchar(20) NOT NULL,
  `jumlahBeli` int(11) NOT NULL,
  `hargasatuan` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `orderkuedetail`
--

INSERT INTO `orderkuedetail` (`kode_order`, `kode_produk`, `kode_admin`, `jumlahBeli`, `hargasatuan`) VALUES
(1, 'A211203-1_1', 'A-2021-12-03-1', 3, '7000.00'),
(101, 'A211203-1_1', 'A-2021-12-03-1', 8, '7000.00'),
(102, 'A211203-1_3', 'A-2021-12-03-1', 2, '3500.00'),
(103, 'A211203-2_2', 'A-2021-12-03-2', 13, '3000.00'),
(106, 'A211203-1_2', 'A-2021-12-03-1', 9, '3000.00'),
(108, 'A211203-2_3', 'A-2021-12-03-2', 7, '3500.00'),
(109, 'A211203-1_5', 'A-2021-12-03-1', 4, '4500.00'),
(111, 'A211203-2_2', 'A-2021-12-03-2', 8, '3000.00'),
(113, 'A211203-1_1', 'A-2021-12-03-1', 3, '7000.00'),
(114, 'A211203-1_2', 'A-2021-12-03-1', 2, '3500.00'),
(115, 'A211203-1_3', 'A-2021-12-03-1', 3, '3500.00'),
(116, 'A211203-1_3', 'A-2021-12-03-1', 5, '3500.00');

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
('A211203-1_1', '19050000', 'Roti haha', 16, '7000.00', '2022-03-04'),
('A211203-1_2', '19051000', 'Roti Kering haha', 28, '3000.00', '2022-04-10'),
('A211203-1_3', '19053100', 'Biskuit haha', 42, '3500.00', '2022-03-18'),
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
-- Indeks untuk tabel `cek`
--
ALTER TABLE `cek`
  ADD PRIMARY KEY (`id`);

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
-- Indeks untuk tabel `orderkue`
--
ALTER TABLE `orderkue`
  ADD PRIMARY KEY (`kode_order`),
  ADD KEY `kode_member` (`kode_member`);

--
-- Indeks untuk tabel `orderkuedetail`
--
ALTER TABLE `orderkuedetail`
  ADD KEY `kode_order` (`kode_order`),
  ADD KEY `kode_produk` (`kode_produk`),
  ADD KEY `kode_admin` (`kode_admin`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`kode_produk`),
  ADD KEY `jenisProduk` (`kode_kategori`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cek`
--
ALTER TABLE `cek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `orderkue`
--
ALTER TABLE `orderkue`
  MODIFY `kode_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

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
-- Ketidakleluasaan untuk tabel `orderkue`
--
ALTER TABLE `orderkue`
  ADD CONSTRAINT `FK_ORDERKUE_MEMBER` FOREIGN KEY (`kode_member`) REFERENCES `member` (`kode_member`);

--
-- Ketidakleluasaan untuk tabel `orderkuedetail`
--
ALTER TABLE `orderkuedetail`
  ADD CONSTRAINT `FK_OKD_A` FOREIGN KEY (`kode_admin`) REFERENCES `admin` (`kode_admin`),
  ADD CONSTRAINT `FK_OKD_KO` FOREIGN KEY (`kode_order`) REFERENCES `orderkue` (`kode_order`),
  ADD CONSTRAINT `FK_OKD_P` FOREIGN KEY (`kode_produk`) REFERENCES `produk` (`kode_produk`);

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `jenisProduk` FOREIGN KEY (`kode_kategori`) REFERENCES `kategori` (`kode_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
