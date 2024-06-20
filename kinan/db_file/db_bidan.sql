-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2023 at 09:12 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bidan`
--

-- --------------------------------------------------------

--
-- Table structure for table `bayi`
--

CREATE TABLE `bayi` (
  `id_bayi` varchar(7) NOT NULL,
  `tgl_periksa` date NOT NULL,
  `id_pasien` varchar(20) NOT NULL,
  `nama_bayi` varchar(50) NOT NULL,
  `nama_ibu` varchar(50) NOT NULL,
  `jenis` enum('periksa','imunisasi') NOT NULL,
  `jenis_imun` varchar(20) NOT NULL,
  `bb` varchar(5) NOT NULL,
  `tb` varchar(5) NOT NULL,
  `biaya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ibu_hamil`
--

CREATE TABLE `ibu_hamil` (
  `id_bumil` varchar(20) NOT NULL,
  `tgl_periksa` date NOT NULL,
  `id_pasien` varchar(20) NOT NULL,
  `nama_pasien` varchar(50) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `hpht` date NOT NULL,
  `nama_suami` varchar(50) NOT NULL,
  `td` varchar(20) NOT NULL,
  `bb` varchar(5) NOT NULL,
  `hpl` date NOT NULL,
  `tfu` int(3) NOT NULL,
  `presentasi` varchar(255) NOT NULL,
  `djj` varchar(50) NOT NULL,
  `tindakan` varchar(100) NOT NULL,
  `tgl_kembali` date NOT NULL,
  `biaya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ibu_hamil`
--

INSERT INTO `ibu_hamil` (`id_bumil`, `tgl_periksa`, `id_pasien`, `nama_pasien`, `jenis`, `hpht`, `nama_suami`, `td`, `bb`, `hpl`, `tfu`, `presentasi`, `djj`, `tindakan`, `tgl_kembali`, `biaya`) VALUES
('Bumil001', '2023-07-20', 'PAS001', 'teguh', 'Periksa', '2023-07-21', 'fgfdg', '130/80', '60', '2023-07-21', 120, 'fndfdj', '120', 'dkfgnj', '2023-08-21', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `kb`
--

CREATE TABLE `kb` (
  `id_kb` varchar(6) NOT NULL,
  `tgl_periksa` date NOT NULL,
  `id_pasien` varchar(20) NOT NULL,
  `nama_pasien` varchar(50) NOT NULL,
  `nama_suami` varchar(50) NOT NULL,
  `td` varchar(10) NOT NULL,
  `bb` varchar(5) NOT NULL,
  `jenis_kb` varchar(20) NOT NULL,
  `tgl_kembali` date NOT NULL,
  `biaya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kb`
--

INSERT INTO `kb` (`id_kb`, `tgl_periksa`, `id_pasien`, `nama_pasien`, `nama_suami`, `td`, `bb`, `jenis_kb`, `tgl_kembali`, `biaya`) VALUES
('KB001', '2023-07-20', 'PAS002', 'mojo', 'frrf', '120/60', '50', 'Suntik Kb', '2023-08-20', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id_obat` varchar(20) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `stok` int(4) NOT NULL,
  `satuan` varchar(13) NOT NULL,
  `harga_beli` int(20) NOT NULL,
  `harga_jual` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_registrasi` varchar(20) NOT NULL,
  `id_pasien` varchar(20) NOT NULL,
  `nama_pasien` varchar(50) NOT NULL,
  `no_ktp` varchar(16) NOT NULL,
  `tmpt_lahir` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `umur` varchar(30) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `alamat` text NOT NULL,
  `no_tlp` varchar(13) NOT NULL,
  `jenis_pel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_registrasi`, `id_pasien`, `nama_pasien`, `no_ktp`, `tmpt_lahir`, `tgl_lahir`, `umur`, `jk`, `alamat`, `no_tlp`, `jenis_pel`) VALUES
('REG21072023001', 'PAS001', 'teguh', '1234567890123456', 'pemalang', '2002-02-19', '21 tahun 5 bulan 2 hari', 'L', 'pemalang', '081280713797', 'pel_bayi');

-- --------------------------------------------------------

--
-- Table structure for table `registrasi`
--

CREATE TABLE `registrasi` (
  `id_registrasi` varchar(20) NOT NULL,
  `tgl_reg` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registrasi`
--

INSERT INTO `registrasi` (`id_registrasi`, `tgl_reg`) VALUES
('REG21072023001', '2023-07-21');

-- --------------------------------------------------------

--
-- Table structure for table `resep_obat`
--

CREATE TABLE `resep_obat` (
  `id_resep` varchar(20) NOT NULL,
  `tgl_resep` date NOT NULL,
  `id_registrasi` varchar(20) NOT NULL,
  `nama_pasien` varchar(50) NOT NULL,
  `id_obat` varchar(20) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `jml_obat` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_obat`
--

CREATE TABLE `transaksi_obat` (
  `id_transaksi` varchar(20) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `id_user` varchar(20) NOT NULL,
  `id_obat` varchar(20) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `qty` int(4) NOT NULL,
  `harga` int(11) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `status` enum('masuk','keluar') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_obat`
--

INSERT INTO `transaksi_obat` (`id_transaksi`, `tgl_transaksi`, `id_user`, `id_obat`, `nama_obat`, `qty`, `harga`, `satuan`, `status`) VALUES
('TRAN0001', '2023-07-20', 'U0001', 'OBAT0001', 'tramadol', 2, 12000, 'tablet', 'masuk');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_periksa`
--

CREATE TABLE `transaksi_periksa` (
  `id_transaksi` varchar(20) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `id_registrasi` varchar(20) NOT NULL,
  `jenis_periksa` varchar(30) NOT NULL,
  `biaya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_periksa`
--

INSERT INTO `transaksi_periksa` (`id_transaksi`, `tgl_transaksi`, `id_registrasi`, `jenis_periksa`, `biaya`) VALUES
('200720230001', '2023-07-20', 'REG20072023001', 'Pemeriksaan Ibu Hamil', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `umum`
--

CREATE TABLE `umum` (
  `id` varchar(4) NOT NULL,
  `tgl_periksa` date NOT NULL,
  `id_pasien` varchar(20) NOT NULL,
  `nama_pasien` varchar(50) NOT NULL,
  `keluhan` varchar(100) NOT NULL,
  `tb` varchar(5) NOT NULL,
  `bb` varchar(5) NOT NULL,
  `td` varchar(10) NOT NULL,
  `biaya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `umum`
--

INSERT INTO `umum` (`id`, `tgl_periksa`, `id_pasien`, `nama_pasien`, `keluhan`, `tb`, `bb`, `td`, `biaya`) VALUES
('U001', '2023-07-20', 'PAS001', 'teguh', 'pusing', '160', '60', '130/80', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(20) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_lengkap`, `username`, `password`, `level`) VALUES
('U0001', 'admin', 'admin', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bayi`
--
ALTER TABLE `bayi`
  ADD PRIMARY KEY (`id_bayi`);

--
-- Indexes for table `ibu_hamil`
--
ALTER TABLE `ibu_hamil`
  ADD PRIMARY KEY (`id_bumil`);

--
-- Indexes for table `kb`
--
ALTER TABLE `kb`
  ADD PRIMARY KEY (`id_kb`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `registrasi`
--
ALTER TABLE `registrasi`
  ADD PRIMARY KEY (`id_registrasi`);

--
-- Indexes for table `resep_obat`
--
ALTER TABLE `resep_obat`
  ADD PRIMARY KEY (`id_resep`);

--
-- Indexes for table `transaksi_obat`
--
ALTER TABLE `transaksi_obat`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `transaksi_periksa`
--
ALTER TABLE `transaksi_periksa`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `umum`
--
ALTER TABLE `umum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
