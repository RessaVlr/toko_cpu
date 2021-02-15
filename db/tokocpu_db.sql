-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Feb 2021 pada 12.58
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tokocpu_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbadmin`
--

CREATE TABLE `tbadmin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbadmin`
--

INSERT INTO `tbadmin` (`id`, `username`, `password`, `last_login`) VALUES
(1, '18111135', 'ressa123', '2021-01-12 11:50:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbclient`
--

CREATE TABLE `tbclient` (
  `id` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbclient`
--

INSERT INTO `tbclient` (`id`, `id_client`, `nama`, `username`, `password`) VALUES
(1, 212501, 'Ezra Sitompul', 'ezra', '123'),
(5, 212502, 'Hendra Simatupang', 'hendra', '123'),
(6, 212503, 'Jayyid Abdullah', 'jayyid', '123'),
(7, 212504, 'abdul', 'abdul', 'abdul123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbinvoices`
--

CREATE TABLE `tbinvoices` (
  `id` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `alamat` text DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '0 = sold out\r\n1 = ongoing\r\n2 = shipping\r\n3 = batal',
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbinvoices`
--

INSERT INTO `tbinvoices` (`id`, `id_client`, `id_invoice`, `id_produk`, `quantity`, `alamat`, `status`, `tanggal`) VALUES
(6, 212501, 2021011201, 2105, 3, 'JL. Rawe 9 Link XI', 0, '2021-01-12 10:16:41'),
(7, 212501, 2021011202, 2107, 1, 'JL. Rawe 9 Link XI', 3, '2021-01-12 10:16:44'),
(9, 212501, 2021011204, 2101, 1, 'JL. Rawe 9', 3, '2021-01-12 11:29:39'),
(16, 212503, 2021011205, 2104, 1, NULL, 3, '2021-01-12 11:50:32'),
(17, 212502, 2021011206, 2106, 1, NULL, 3, '2021-01-12 12:07:31'),
(18, 212502, 2021011207, 2105, 1, '', 3, '2021-01-12 12:08:40'),
(19, 212502, 2021011208, 2104, 1, '', 3, '2021-01-12 12:32:02'),
(20, 212502, 2021011209, 2104, 1, 'JL. Rawe 9 Link XI', 0, '2021-01-12 12:36:25'),
(21, 212504, 2021021509, 2107, 1, 'bandung', 0, '2021-02-15 07:20:01'),
(22, 212504, 2147483647, 2105, 1, NULL, 1, '2021-02-15 08:18:46'),
(24, 212501, 2021021511, 2102, 1, 'bandung', 0, '2021-02-15 14:35:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbproduk`
--

CREATE TABLE `tbproduk` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbproduk`
--

INSERT INTO `tbproduk` (`id`, `id_produk`, `nama_produk`, `harga`, `tanggal`) VALUES
(1, 2101, 'SHROUD PC', 38524000, '2021-01-10 15:17:06'),
(2, 2102, 'NINJA', 54000000, '2021-01-10 15:18:32'),
(3, 2103, 'Reza Arap', 25000000, '2021-01-10 15:21:24'),
(4, 2104, 'MiawAug', 34500000, '2021-01-10 15:23:20'),
(5, 2105, 'PewDiePie', 80000000, '2021-01-10 15:26:40'),
(6, 2106, 'Adil PC', 10500001, '2021-01-10 15:32:25'),
(8, 2107, 'Gaming Cube', 9000000, '2021-01-11 11:07:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbprodukdetail`
--

CREATE TABLE `tbprodukdetail` (
  `id` int(11) NOT NULL,
  `id_produkdetail` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `processor` varchar(255) DEFAULT NULL,
  `vga` varchar(255) DEFAULT NULL,
  `ram` varchar(20) DEFAULT NULL,
  `powersupply` varchar(255) DEFAULT NULL,
  `hardiskssd` varchar(255) DEFAULT NULL,
  `garansi` varchar(35) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbprodukdetail`
--

INSERT INTO `tbprodukdetail` (`id`, `id_produkdetail`, `id_produk`, `brand`, `processor`, `vga`, `ram`, `powersupply`, `hardiskssd`, `garansi`, `gambar`) VALUES
(1, 212101, 2101, 'ASUS', 'Intel Core i7 8700K @5.3', 'GeForce RTX 2080 TI 11GB', 'HyperX PREDATOR 32GB', '500w', 'HyperX Predator M.2 2280 960GB', '2 tahun', '1610337574.jpg'),
(2, 212102, 2102, 'SAMSUNG', 'Intel Core i7-8700K 3.7GHz CPU', 'Nvidia GTX 1080 Ti 11GB GPU', 'G.Skill Trident Z RG', 'Seasonic Focus Plus 850W 80+ Gold PSU', 'Samsung SSD 960 EVO 1TB M.2', '4 tahun', '1610337569.png'),
(3, 212103, 2103, 'ASUS', 'Intel Core i5 9400F 2.9Ghz - 4.1Ghz Box Coffee Lake', 'GeForce GTX 1650 SUPER', 'DDR4 2x8(16GB)', ' U9 500W - 80+ Bronze Certified', 'SX8200 PRO 512GB M.2', '2 tahun', '1610337563.png'),
(4, 212104, 2104, 'Lenovo', 'Intel I9 9900K', 'Asus ROG Strix Geforce RTX 2080 TI', 'RGB 32GB (16x2)', 'Corsair HX 1000', 'Western Digital WD Black 1T SSD M.2 NVMe', '5 tahun', '1610337543.png'),
(5, 212105, 2105, 'ASUS', 'Intel Core i9 7980XE (2.6/4.2 GHZ)', ' Dual 11GB NVIDIA GeForce GTX 1080 Ti', '64 GB G.Skill Triden', '1.3 KW EVGA Supernova G2', '500 GB Samsung 960 EVO', '6 tahun', '1610337537.png'),
(6, 212106, 2106, 'BlackMagic Design', 'Core i5-10400F 2.90GHz (12 CPUs)', 'NVIDIA GeForce GTX 1650 SUPER', '16 gb (8x2)', 'S19B150 500w', 'SSD 512gb M.2', '3 tahun', '1610337530.png'),
(8, 212107, 2107, 'BenQ', 'Intel i5-9600 3.1Ghz', 'GALAX RTX 2080Ti SG Edition Triple Fan', '32GB GSkill DDR4', '750W SP 11 80+ Gold Certified', 'Samsung SSD 250GB EVO 860', '4 tahun', '1610338024.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbstok`
--

CREATE TABLE `tbstok` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `tanggal` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbstok`
--

INSERT INTO `tbstok` (`id`, `id_produk`, `stok`, `tanggal`) VALUES
(1, 2107, 3, '2021-01-11 11:24:43'),
(2, 2106, 9, '2021-01-11 11:24:51'),
(3, 2105, 1, '2021-01-11 11:25:44'),
(4, 2104, 0, '2021-01-11 11:25:48'),
(5, 2102, 1, '2021-01-11 11:25:51'),
(6, 2101, 0, '2021-01-11 11:25:56'),
(7, 2103, 0, '2021-01-11 11:34:43');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbadmin`
--
ALTER TABLE `tbadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbclient`
--
ALTER TABLE `tbclient`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbinvoices`
--
ALTER TABLE `tbinvoices`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbproduk`
--
ALTER TABLE `tbproduk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbprodukdetail`
--
ALTER TABLE `tbprodukdetail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbstok`
--
ALTER TABLE `tbstok`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbadmin`
--
ALTER TABLE `tbadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbclient`
--
ALTER TABLE `tbclient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbinvoices`
--
ALTER TABLE `tbinvoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tbproduk`
--
ALTER TABLE `tbproduk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbprodukdetail`
--
ALTER TABLE `tbprodukdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbstok`
--
ALTER TABLE `tbstok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
