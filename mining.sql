-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2021 at 08:35 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mining`
--

-- --------------------------------------------------------

--
-- Table structure for table `aspirasi`
--

CREATE TABLE `aspirasi` (
  `id` int(11) NOT NULL,
  `namaUser` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `idjalan` varchar(11) NOT NULL,
  `tgl` datetime NOT NULL,
  `lampiran` varchar(50) NOT NULL,
  `komentar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `datajalan`
--

CREATE TABLE `datajalan` (
  `id` varchar(11) NOT NULL,
  `namajalan` varchar(255) NOT NULL,
  `desa` varchar(255) NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `uradukung` varchar(255) NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `namalintas` varchar(255) NOT NULL,
  `panjang` varchar(255) NOT NULL,
  `jnspen` varchar(255) NOT NULL,
  `tanahkrikil` varchar(255) NOT NULL,
  `aspal` varchar(255) NOT NULL,
  `rigit` varchar(255) NOT NULL,
  `thn_pem` varchar(20) NOT NULL,
  `mandor` varchar(255) NOT NULL,
  `gambar1` varchar(25) DEFAULT NULL,
  `gambar2` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `datajalan`
--

INSERT INTO `datajalan` (`id`, `namajalan`, `desa`, `provinsi`, `uradukung`, `kecamatan`, `namalintas`, `panjang`, `jnspen`, `tanahkrikil`, `aspal`, `rigit`, `thn_pem`, `mandor`, `gambar1`, `gambar2`) VALUES
('JLN001', 'Rungkom -  Kulee', 'Rungkom, Kulam, Kulee', 'Aceh', 'Kawasan Minapolitan dan Kawasan Industri', 'Kec Batee', 'Lintas Jalan Provinsi', '2,80', 'pemeliharaan Berkala', '21,43', '78,57', '0,00', '2018', 'CV. LAMPOIH SAKA COMPANY', '60d4285a2431f.jpg', '60d4285a256a7.jpg'),
('JLN002', 'Rungkom -  Neuheun', 'Rungkom, Neuheun', 'Aceh', 'Kawasan Minapolitan dan Kawasan Industri', 'Kec Batee', 'Lintas Jalan Provinsi', '1,60', 'pemeliharaan Berkala', '9,38', '90,63', '0.00', '2016', 'CV. LUENG GUCI CONTRUCTION', '60d42adfb20da.jpg', '60d42adfb3462.jpg'),
('JLN003', 'Crueng - Rungkom', 'Crueng, Rungkom', 'Aceh', 'Kawasan Minapolitan dan Kawasan Industri', 'Kec Batee', 'Lintas Jalan Provinsi', '1,30', 'Peningkatan', '84,62', '15,38', '0,00', '2016', 'CV. LUENG GUCI CONTRUCTION', '60d42d44b1609.jpg', '60d42d44b2991.jpg'),
('JLN004', 'Kulee - Pasi Beurandeh', 'Kulee, Kulam Pasi Beurandeh', 'Aceh', 'Kawasan Minapolitan dan Kawasan Industri', 'Kec Batee', 'Lintas Jalan Kabupaten', '3,80', 'Peningkatan', '81,58', '18,42', '0,00', '2018', 'CV. MADYA RAYA GROUP', '60d430cb9263c.jpg', '60d430cb92e0c.jpg'),
('JLN005', 'Padang Tiji - Kunyet', 'Seunadeu, Kambuek Nicah, Dayah Tanoh, Baro Kunyet,Mesjid Kunyet, Cot Kunyet,Blang Geuliding, Mesjid Geuliding, Geulumpang Geuliding, Jurong Anoe Teungoh Peudaya, Leuhop Paloh', 'Aceh', 'Kawasan Agropolitan', 'Padang Tiji', 'Lintas Jalan Kabupaten', '7,50', 'pemeliharaan Berkala', '25,33', '74,67', '2,70', '2016', 'CV. MULTI KARYA PERDANA', '60d433f08ed64.jpg', '60d433f08f14c.jpg'),
('JLN006', 'Beungga - Alue Calong', 'Beungga', 'Aceh', 'Kawasan Agropolitan', 'Tangse', 'Lintas Jalan Nasional', '2,30', 'Peningkatan', '100,00', '0,00', '0,00', '2014', 'PT.PUTRA UKEE UTAMA', '60d8191776051.jpg', '60d819177aa8a.jpg'),
('JLN007', 'Dayah Andeu - Glee Lubuk', 'Dayah Andeue', 'Aceh', 'Kawasan Pertanian / Kawasan Perikanan dan Kawasan Hutan Produksi', 'Mila', 'Lintas Jalan Kabupaten', '1,50', 'Peningkatan', '80,00', '20,00', '0,00', '2020', 'CV. JAYA MARGA PERKASA', '60d81a85c1ef9.jpg', '60d81a85c2ab1.jpg'),
('JLN008', 'Glp. Minyeuk - Glp. Payong', 'Pulo Dayah, Neurok, Lambaro, Manyang, Sagoe', 'Aceh', 'Kawasan Pertanian / Kawasan Perikanan dan Kawasan Hutan Produksi', 'Glumpang Tiga', 'Lintas Jalan Nasional', '2,50', 'pemeliharaan Berkala', '36,00', '64,00', '0,00', '2019', 'TAKABEYA JAYA', '60d81ba3aa95a.jpg', '60d81ba3ab12a.jpg'),
('JLN009', 'Lala - Cot Sukon', 'Krueng Lala, Cot Sukon', 'Aceh', 'Kawasan Pertanian / Kawasan Perikanan dan Kawasan Hutan Produksi', 'Kec Mila/Sakti', 'Lintas Jalan Kabupaten', '2,20', 'Peningkatan', '54,55', '45,45', '0,00', '2019', 'CV. CAHAYA KUTA MALAKA', '60d81d10e2b5c.jpg', '60d81d10e332c.jpg'),
('JLN010', 'Laweung - Gampong Cot', 'Krueng, Suka Jaya, Keupula, Mesjid, Teungku Dilaeueng, Cot', 'Aceh', 'Kawasan Minapolitan dan Kawasan Industri', 'Muara Tiga', 'Lintas Jalan Provinsi', '4,20', 'pemeliharaan Berkala', '0,00', '100,00', '0,00', '2018', 'PT. TRIPA KARYA', '60d81e6423e3e.jpg', '60d81e642460e.jpg'),
('JLN011', 'Lingkar Keude  -   Kb Tanjong', 'Aron Asan Kumbang, Tanjong', 'Aceh', 'Kawasan Minapolitan', 'Kembang Tanjong', 'Lintas Jalan Kabupaten', '0,50', 'pemeliharaan Berkala', '20,00', '80,00', '0,00', '2018', 'CV. BOSNIA MOTOR', '60d81f5e50e33.jpg', '60d81f5e51604.jpg'),
('JLN012', 'Sp. Camat -  Lampeudeu Tunong', 'Lampeudeu Tunong', 'Aceh', 'Kawasan Pertanian / Kawasan Perikanan dan Kawasan Hutan Produksi', 'Pidie', 'Lintas Jalan Nasional', '1,60', 'pemeliharaan Berkala', '30,00', '70,00', '0,00', '2018', 'CV. AULA NEKPAK', '60d82255dc280.jpg', '60d822561473b.jpg'),
('JLN013', 'Sukon Mesjid - Ketapang Mesjid', 'Sukon mesjid', 'Aceh', 'Kawasan Pertanian / Kawasan Perikanan dan Kawasan Hutan Produksi', 'Glumpang Tiga', 'Lintas Jalan Nasional', '0,90', 'pemeliharaan Berkala', '100,00', '0,00', '0,00', '2016', 'PT.ASPHALT MADYA RAYA', '60d823475ce9c.jpg', '60d823475d66c.jpg'),
('JLN014', 'Buloh - Mesjid Kunyet', 'Buloh Peudaya, Peurlak, Buni Reuling Peudaya, Dayah Baroh Kunyet, Mesjid Kunyet', 'Aceh', 'Kawasan Agropolitan', 'Padang Tiji', 'Lintas Jalan Kabupaten', '3,20', 'Peningkatan', '75,00', '25,00', '0,00', '2016', 'CV. CEURIPAY JAYA', '60d8250a08244.jpg', '60d8250a0862c.jpg'),
('JLN015', 'Cot Keutapang - Seumayam', 'Siron Tanjong, Cot Keutapang', 'Aceh', 'Kawasan Agropolitan', 'Padang Tiji', 'Lintas Jalan Kabupaten', '2,70', 'Peningkatan', '62,96', '37,04', '0,00', '2018', 'CV. REZEKI ANANDA', '60d8262e547d3.jpg', '60d8262e54fa4.jpg'),
('JLN016', 'Padang Tiji - Kali Satu', 'Pasar Paloh, Trieng Paloh, Pulo Hagu', 'Aceh', 'Kawasan Agropolitan', 'Padang Tiji', 'Lintas Jalan Kabupaten', '6,50', 'Peningkatan', '69,23', '30,77', '0,00', '2015', 'CV. KHANA PRAKARSA', '60d887f89458d.jpg', '60d887f894d5e.jpg'),
('JLN017', 'Kupula Tanjong - Seulingging', 'Keupula Tanjong, Khang Lanjong, Meuriya Tanjong, Baro Beurabo', 'Aceh', 'Kawasan Agropolitan', 'Padang Tiji', 'Lintas Jalan Kabupaten', '4,00', 'Peningkatan', '82,50', '17,50', '0,00', '2016', 'CV. ADAN PRAKARSA', '60d88953c42a0.jpg', '60d88953c4e58.jpg'),
('JLN018', 'Leuen Tanjong - Seukeumbrok', 'Leun Tanjong, Grong - grong, Seukeumbrok Beurabo', 'Aceh', 'Kawasan Agropolitan', 'Padang Tiji', 'Lintas Jalan Nasional', '3,00', 'pemeliharaan Berkala', '46,67', '53,33', '0,00', '2014', 'CV. CAHAYA BARONA', '60d88ae2734e2.jpg', '60d88ae2738cb.jpg'),
('JLN019', 'Meuriya - Seukombrok', 'Grong - grong, Meuriya Tanjong, Khang Tanjong', 'Aceh', 'Kawasan Agropolitan', 'Padang Tiji', 'Lintas Jalan Kabupaten', '1,00', 'Peningkatan', '100,00', '0,00', '0.00', '2014', 'CV. ASOLON UTAMA', '60d88c8db5d19.jpg', '60d88c8db64e9.jpg'),
('JLN020', 'Padang Tiji - Kunyet', 'Seunadeu, Kambuek Nicah, Dayah Tanoh, Baro Kunyet,Mesjid Kunyet, Cot Kunyet,Blang Geuliding, Mesjid Geuliding, Geulumpang Geuliding, Jurong Anoe Teungoh Peudaya, Leuhop Paloh', 'Aceh', 'Kawasan Agropolitan', 'Padang Tiji', 'Lintas Jalan Kabupaten', '7,50', 'pemeliharaan Berkala', '25,33', '74,67', '0,00', '2016', 'CV. MULTI KARYA PERDANA', '60d88f7d4b204.jpg', '60d88f7d4bdbc.jpg'),
('JLN021', 'Suyo Paloh - Alue Baroh', 'Suyo Paloh, Balee Paloh', 'Aceh', 'Kawasan Agropolitan', 'Padang Tiji', 'Lintas Jalan Kabupaten', '1,10', 'Peningkatan', '72,73', '27,27', '0,00', '2015', 'CV. YOSE ENGINEERING', '60d8908b30dd9.jpg', '60d8908b315a9.jpg'),
('JLN022', 'Sp. Rajui - Rajui', 'Mesjid Tanjong', 'Aceh', 'Kawasan Agropolitan', 'Padang Tiji', 'Lintas Jalan Nasional', '5,00', 'pemeliharaan Berkala', '40,00', '60,00', '0,00', '2018', 'CV. MULTI KARYA PERDANA', '60d891f66ca01.jpg', '60d891f66cde9.jpg'),
('JLN023', 'Siron Paloh - Jurong Anoe', 'Siron Paloh, Balee Paloh, Capa Paloh, Jurong Anoe', 'Aceh', 'Kawasan Agropolitan', 'Padang Tiji', 'Lintas Jalan Kabupaten', '2,60', 'pemeliharaan Berkala', '50,00', '50,00', '0,00', '2014', 'CV. MULTI KARYA PERDANA', '60d8930485262.jpg', '60d8930485a32.jpg'),
('JLN024', 'Tuha Peudaya - Mesjid Peudaya', 'Tuha Peudaya, Mesjid Peudaya', 'Aceh', 'Kawasan Agropolitan', 'Padang Tiji', 'Lintas Jalan Kabupaten', '0,60', 'pemeliharaan Berkala', '30,00', '100,00', '0,00', '2018', 'CV. MULTI KARYA PERDANA', '60d89499f2d09.jpg', '60d89499f30f1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `datapreprocessing`
--

CREATE TABLE `datapreprocessing` (
  `id` int(11) NOT NULL,
  `ura_dukung` varchar(255) NOT NULL,
  `namaLintas` varchar(255) NOT NULL,
  `panjangRuas` varchar(255) NOT NULL,
  `jns_pen` varchar(255) NOT NULL,
  `tanah_krikil` varchar(255) NOT NULL,
  `aspal` varchar(255) NOT NULL,
  `rigit` varchar(255) NOT NULL,
  `target` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `datapreprocessing`
--

INSERT INTO `datapreprocessing` (`id`, `ura_dukung`, `namaLintas`, `panjangRuas`, `jns_pen`, `tanah_krikil`, `aspal`, `rigit`, `target`) VALUES
(2, 'KMI', 'LJN', 'PE', 'PB', 'SPE', 'SPA', 'SPES', 'S'),
(3, 'KMI', 'LJP', 'SPES', 'PB', 'SPE', 'SPA', 'SPES', 'S'),
(4, 'KMI', 'LJN', 'SS', 'P', 'PA', 'SS', 'SPES', 'RB'),
(5, 'KMI', 'LJP', 'SPE', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(6, 'KMI', 'LJP', 'SPE', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(7, 'KMI', 'LJP', 'PE', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(8, 'KMI', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(9, 'KMI', 'LJP', 'SPES', 'PB', 'PE', 'SPA', 'SPES', 'B'),
(10, 'KMI', 'LJP', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(11, 'KMI', 'LJP', 'SPE', 'P', 'SPES', 'CS', 'SPES', 'RR'),
(12, 'KMI', 'LJP', 'SPE', 'P', 'PA', 'CS', 'SPES', 'RR'),
(13, 'KMI', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(14, 'KMI', 'LJP', 'PE', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(15, 'KMI', 'LJP', 'SPES', 'P', 'PA', 'SS', 'SPES', 'RB'),
(16, 'KMI', 'LJK', 'SPES', 'P', 'SPES', 'SPES', 'SPAS', 'RR'),
(17, 'KMI', 'LJP', 'SPES', 'PB', 'PE', 'CP', 'SPES', 'B'),
(18, 'KMI', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'RB'),
(19, 'KMI', 'LJP', 'SPES', 'P', 'SPA', 'SPE', 'SPES', 'RB'),
(20, 'KA', 'LJK', 'PE', 'PB', 'PE', 'CP', 'SPES', 'RR'),
(21, 'KA', 'LJK', 'SPE', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(22, 'KA', 'LJN', 'SPE', 'PB', 'CS', 'S', 'SPES', 'S'),
(23, 'KA', 'LJK', 'PE', 'P', 'CP', 'PE', 'SPES', 'RR'),
(24, 'KA', 'LJN', 'PE', 'PB', 'CS', 'PA', 'SPES', 'S'),
(25, 'KA', 'LJN', 'SPE', 'PB', 'CS', 'S', 'SPES', 'RR'),
(26, 'KA', 'LJK', 'PE', 'P', 'PA', 'SS', 'SPES', 'RR'),
(27, 'KA', 'LJN', 'SPE', 'PB', 'SS', 'PA', 'SPES', 'S'),
(28, 'KA', 'LJK', 'SPE', 'P', 'SPA', 'SPE', 'SPES', 'RB'),
(29, 'KA', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(30, 'KA', 'LJK', 'SPES', 'PB', 'S', 'S', 'SPES', 'S'),
(31, 'KA', 'LJK', 'SPES', 'P', 'PA', 'SS', 'SPES', 'RR'),
(32, 'KA', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(33, 'KA', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(34, 'KA', 'LJK', 'PE', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(35, 'KA', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(36, 'KA', 'LJK', 'SPES', 'PB', 'SS', 'PA', 'SPES', 'RB'),
(37, 'KA', 'LJK', 'SPES', 'P', 'CP', 'PE', 'SPES', 'RB'),
(38, 'KA', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(39, 'KA', 'LJN', 'PE', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(40, 'KA', 'LJN', 'PE', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(41, 'KP', 'LJN', 'SS', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(42, 'KP', 'LJP', 'SPE', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(43, 'KP', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(44, 'KP', 'LJP', 'SPES', 'P', 'CP', 'PE', 'SPES', 'RR'),
(45, 'KP', 'LJK', 'SPE', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(46, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'S'),
(47, 'KP', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(48, 'KP', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(49, 'KP', 'LJK', 'SPES', 'PB', 'CS', 'S', 'SPES', 'RR'),
(50, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(51, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(52, 'KP', 'LJK', 'SPE', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(53, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(54, 'KP', 'LJK', 'SPE', 'PB', 'SPES', 'SPAS', 'SPES', 'S'),
(55, 'KP', 'LJK', 'SPE', 'PB', 'CS', 'S', 'SPES', 'RR'),
(56, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(57, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'RB'),
(58, 'KP', 'LJN', 'SPES', 'P', 'SPA', 'PE', 'SPES', 'RB'),
(59, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'S'),
(60, 'KP', 'LJK', 'SPES', 'P', 'SPES', 'SPE', 'PE', 'RB'),
(61, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(62, 'KP', 'LJN', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(63, 'KP', 'LJN', 'SPE', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(64, 'KP', 'LJN', 'SPE', 'PB', 'SPES', 'SPAS', 'SPES', 'S'),
(65, 'KP', 'LJN', 'SPE', 'PB', 'SPES', 'SPAS', 'SPES', 'S'),
(66, 'KP', 'LJN', 'SPE', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(67, 'KP', 'LJK', 'PE', 'PB', 'SS', 'PA', 'SPES', 'S'),
(68, 'KP', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(69, 'KP', 'LJK', 'SPES', 'P', 'PA', 'SS', 'SPES', 'RB'),
(70, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(71, 'KP', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(72, 'KP', 'LJK', 'SPES', 'P', 'SPA', 'PE', 'SPES', 'RB'),
(73, 'KP', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(74, 'KP', 'LJP', 'SPES', 'PB', 'SS', 'PA', 'SPES', 'S'),
(75, 'KP', 'LJP', 'SPES', 'PB', 'SS', 'PA', 'SPES', 'S'),
(76, 'KP', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(77, 'KP', 'LJK', 'SPES', 'P', 'SPA', 'PE', 'SPES', 'RB'),
(78, 'KP', 'LJP', 'PE', 'PB', 'SPES', 'SPAS', 'SPES', 'RR'),
(79, 'KP', 'LJK', 'PE', 'PB', 'CS', 'S', 'SPES', 'S'),
(80, 'KP', 'LJK', 'SPES', 'P', 'S', 'CS', 'SPES', 'RR'),
(81, 'KP', 'LJK', 'SPES', 'PB', 'SPE', 'SPA', 'SPES', 'RR'),
(82, 'KP', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(83, 'KP', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'S'),
(84, 'KP', 'LJK', 'SPES', 'PB', 'PE', 'CP', 'SPES', 'RB'),
(85, 'KP', 'LJK', 'SPES', 'P', 'S', 'CS', 'SPES', 'RB'),
(86, 'KP', 'LJP', 'SPE', 'P', 'CP', 'PE', 'SPES', 'RB'),
(87, 'KP', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(88, 'KP', 'LJP', 'SPE', 'P', 'PA', 'SS', 'SPES', 'RB'),
(89, 'KP', 'LJK', 'SPES', 'P', 'PA', 'SS', 'SPES', 'RR'),
(90, 'KP', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(91, 'KP', 'LJN', 'SPE', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(92, 'KP', 'LJP', 'PE', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(93, 'KP', 'LJK', 'SPE', 'P', 'S', 'CS', 'SPES', 'RR'),
(94, 'KP', 'LJP', 'SPES', 'PB', 'SPE', 'SPA', 'SPES', 'S'),
(95, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(96, 'KP', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(97, 'KP', 'LJP', 'SPES', 'P', 'CP', 'PE', 'SPES', 'RR'),
(98, 'KP', 'LJP', 'PE', 'PB', 'PE', 'CP', 'SPES', 'S'),
(99, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(100, 'KP', 'LJN', 'SPE', 'PB', 'SPE', 'SPA', 'SPES', 'B'),
(101, 'KP', 'LJP', 'SPE', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(102, 'KP', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(103, 'KP', 'LJK', 'SPES', 'PB', 'SPE', 'SPA', 'SPES', 'B'),
(104, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'RB'),
(105, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(106, 'KP', 'LJN', 'SPE', 'PB', 'PE', 'SPA', 'SPES', 'S'),
(107, 'KP', 'LJK', 'SPES', 'PB', 'SS', 'PA', 'SPES', 'RB'),
(108, 'KP', 'LJK', 'SPES', 'PB', 'SS', 'PA', 'SPES', 'RB'),
(109, 'KP', 'LJN', 'SPE', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(110, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(111, 'KP', 'LJN', 'SPES', 'PB', 'PE', 'CP', 'SPES', 'S'),
(112, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(113, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(114, 'KP', 'LJN', 'SPE', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(115, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(116, 'KP', 'LJK', 'SPES', 'PB', 'SS', 'PA', 'SPES', 'RR'),
(117, 'KP', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(118, 'KP', 'LJN', 'SPES', 'P', 'PE', 'SPES', 'CP', 'RB'),
(119, 'KP', 'LJN', 'PE', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(120, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(121, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(122, 'KP', 'LJN', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(123, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(124, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(125, 'KP', 'LJN', 'SPE', 'P', 'S', 'CS', 'SPES', 'RR'),
(126, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(127, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(128, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(129, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(130, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(131, 'KP', 'LJN', 'SPES', 'PB', 'SPE', 'SPA', 'SPES', 'B'),
(132, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(133, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(134, 'KP', 'LJN', 'SPES', 'PB', 'SPE', 'SPA', 'SPES', 'S'),
(135, 'KP', 'LJP', 'SPES', 'PB', 'PE', 'CP', 'SPES', 'S'),
(136, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(137, 'KP', 'LJN', 'SPES', 'PB', 'PE', 'CP', 'SPES', 'S'),
(138, 'KP', 'LJN', 'SPES', 'PB', 'SPE', 'SPA', 'SPES', 'S'),
(139, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(140, 'KP', 'LJK', 'SPES', 'P', 'PA', 'SS', 'SPES', 'RB'),
(141, 'KP', 'LJN', 'SPES', 'PB', 'SPE', 'SPA', 'SPES', 'S'),
(142, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(143, 'KP', 'LJN', 'SPES', 'PB', 'CS', 'PA', 'SPES', 'S'),
(144, 'KP', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(145, 'KP', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(146, 'KP', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(147, 'KP', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(148, 'KP', 'LJN', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(149, 'KP', 'LJN', 'SPES', 'P', 'CP', 'PE', 'SPES', 'RB'),
(150, 'KP', 'LJK', 'SPES', 'P', 'S', 'CS', 'SPES', 'RR'),
(151, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(152, 'KP', 'LJK', 'SPES', 'PB', 'PE', 'CP', 'SPES', 'S'),
(153, 'KP', 'LJK', 'SPE', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(154, 'KP', 'LJN', 'SPE', 'PB', 'SPE', 'SPA', 'SPES', 'RR'),
(155, 'KP', 'LJK', 'SPE', 'P', 'PA', 'SS', 'SPES', 'RR'),
(156, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'RR'),
(157, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'S'),
(158, 'KP', 'LJK', 'SPES', 'PB', 'S', 'S', 'SPES', 'RB'),
(159, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(160, 'KP', 'LJP', 'SPES', 'PB', 'PE', 'SPA', 'SPES', 'B'),
(161, 'KP', 'LJN', 'SPES', 'P', 'SPES', 'SPES', 'SPES', 'RB'),
(162, 'KP', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(163, 'KP', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(164, 'KP', 'LJN', 'SPES', 'PB', 'PE', 'SPA', 'SPES', 'RR'),
(165, 'KP', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'S'),
(166, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(167, 'KP', 'LJP', 'SPES', 'P', 'SPA', 'PE', 'SPES', 'RB'),
(168, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(169, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'RB'),
(170, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(171, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(172, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(173, 'KP', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(174, 'KP', 'LJP', 'SPES', 'PB', 'CS', 'S', 'SPES', 'RB'),
(175, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'RB'),
(176, 'KP', 'LJP', 'SPES', 'P', 'PA', 'SS', 'SPES', 'RB'),
(177, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'RB'),
(178, 'KP', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(179, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'RR'),
(180, 'KP', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(181, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(182, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(183, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(184, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'S'),
(185, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(186, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(187, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'RB'),
(188, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(189, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(190, 'KP', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(191, 'KP', 'LJP', 'SPES', 'PB', 'SPE', 'SPAS', 'SPES', 'S'),
(192, 'KP', 'LJN', 'SPES', 'P', 'SPES', 'SPES', 'SPES', 'RB'),
(193, 'KP', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(194, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(195, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(196, 'KP', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(197, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'RR'),
(198, 'KP', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(199, 'KP', 'LJP', 'SPES', 'PB', 'S', 'S', 'SPES', 'S'),
(200, 'KP', 'LJP', 'SPES', 'P', 'SPES', 'SPES', 'SPAS', 'B'),
(201, 'KP', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(202, 'KP', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(203, 'KP', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(204, 'KP', 'LJP', 'SPES', 'P', 'CP', 'PE', 'SPES', 'RR'),
(205, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(206, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(207, 'KP', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(208, 'KP', 'LJN', 'SPES', 'PB', 'S', 'S', 'SPES', 'S'),
(209, 'KM', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'RR'),
(210, 'KM', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(211, 'KM', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(212, 'KM', 'LJK', 'SPES', 'PB', 'SPE', 'SPA', 'SPES', 'B'),
(213, 'KM', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(214, 'KM', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(215, 'KM', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(216, 'KM', 'LJP', 'SPE', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(217, 'KM', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(218, 'KM', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'RB'),
(219, 'KM', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'S'),
(220, 'KM', 'LJK', 'SPES', 'P', 'SPES', 'SPES', 'SPES', 'RB'),
(221, 'KM', 'LJK', 'SPES', 'P', 'S', 'CS', 'SPES', 'RR'),
(222, 'KM', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'S'),
(223, 'KM', 'LJP', 'SPES', 'PB', 'SPE', 'SPA', 'SPES', 'S'),
(224, 'KM', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(225, 'KM', 'LJK', 'SPE', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(226, 'KM', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(227, 'KM', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(228, 'KM', 'LJK', 'SPES', 'PB', 'CS', 'S', 'SPES', 'S'),
(229, 'KM', 'LJK', 'SPE', 'PB', 'CS', 'S', 'SPES', 'RR'),
(230, 'KM', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(231, 'KM', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(232, 'KM', 'LJK', 'SPE', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(233, 'KM', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(234, 'KM', 'LJK', 'SPE', 'PB', 'SPE', 'SPA', 'SPES', 'B'),
(235, 'KM', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(236, 'KM', 'LJK', 'SPE', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(237, 'KM', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(238, 'KM', 'LJP', 'SPE', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(239, 'KM', 'LJP', 'PE', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(240, 'KM', 'LJP', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(241, 'KM', 'LJK', 'SPE', 'PB', 'CS', 'S', 'SPES', 'RR'),
(242, 'KM', 'LJK', 'SPES', 'PB', 'PE', 'SPA', 'SPES', 'S'),
(243, 'KM', 'LJK', 'SPES', 'PB', 'SPE', 'SPA', 'SPES', 'B'),
(244, 'KM', 'LJP', 'SPES', 'PB', 'CS', 'S', 'SPES', 'RR'),
(245, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(246, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'S'),
(247, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(248, 'KP', 'LJP', 'SPES', 'PB', 'CS', 'PA', 'SPES', 'RR'),
(249, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(250, 'KP', 'LJK', 'SPES', 'PB', 'SPE', 'SPA', 'SPES', 'RB'),
(251, 'KP', 'LJP', 'SPES', 'P', 'S', 'CS', 'SPES', 'RR'),
(252, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(253, 'KP', 'LJP', 'SPES', 'PB', 'CS', 'PA', 'SPES', 'RR'),
(254, 'KP', 'LJK', 'SPE', 'PB', 'SPE', 'SPAS', 'SPES', 'B'),
(255, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(256, 'KP', 'LJK', 'SPE', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(257, 'KP', 'LJN', 'PE', 'P', 'S', 'CS', 'SPES', 'RR'),
(258, 'KP', 'LJN', 'SPES', 'PB', 'SS', 'PA', 'SPES', 'S'),
(259, 'KP', 'LJN', 'SPES', 'PB', 'SPE', 'SPA', 'SPES', 'S'),
(260, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(261, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(262, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(263, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(264, 'KP', 'LJK', 'PE', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(265, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(266, 'KP', 'LJP', 'SPES', 'PB', 'PE', 'CP', 'SPES', 'S'),
(267, 'KP', 'LJP', 'SPE', 'P', 'SPA', 'SPE', 'SPES', 'RB'),
(268, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(269, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(270, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(271, 'KP', 'LJP', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'S'),
(272, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(273, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(274, 'KP', 'LJN', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(275, 'KP', 'LJN', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(276, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(277, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(278, 'KP', 'LJN', 'SPES', 'PB', 'PE', 'CP', 'SPES', 'S'),
(279, 'KP', 'LJP', 'SPES', 'PB', 'CS', 'S', 'SPES', 'S'),
(280, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(281, 'KP', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(282, 'KP', 'LJP', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(283, 'KP', 'LJP', 'SPE', 'PB', 'SS', 'PA', 'SPES', 'RR'),
(284, 'KCT', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(285, 'KCT', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(286, 'KCT', 'LJK', 'SPES', 'P', 'S', 'CS', 'SPES', 'RR'),
(287, 'KCT', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'S'),
(288, 'KCT', 'LJN', 'SPE', 'PB', 'PE', 'CP', 'SPES', 'B'),
(289, 'KCT', 'LJN', 'SPE', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(290, 'KCT', 'LJN', 'SPE', 'P', 'S', 'CS', 'SPES', 'RR'),
(291, 'KCT', 'LJK', 'SPE', 'PB', 'PE', 'CP', 'SPES', 'S'),
(292, 'KCT', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(293, 'KCT', 'LJN', 'SPES', 'PB', 'PE', 'CP', 'SPES', 'B'),
(294, 'KCT', 'LJN', 'PE', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(295, 'KCT', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(296, 'KCT', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(297, 'KCT', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(298, 'KCT', 'LJP', 'SPES', 'P', 'SPA', 'SPE', 'SPES', 'RB'),
(299, 'KCT', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(300, 'KCT', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(301, 'KCT', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(302, 'KCT', 'LJP', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(303, 'KCT', 'LJK', 'SPES', 'PB', 'SS', 'PA', 'SPES', 'S'),
(304, 'KCT', 'LJN', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(305, 'KCT', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(306, 'KCT', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'RR'),
(307, 'KCT', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(308, 'KCT', 'LJK', 'SPES', 'P', 'S', 'CS', 'SPES', 'RR'),
(309, 'KCT', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(310, 'KCT', 'LJK', 'SPE', 'PB', 'PE', 'CP', 'SPES', 'S'),
(311, 'KCT', 'LJN', 'SPES', 'PB', 'SS', 'PA', 'SPES', 'S'),
(312, 'KCT', 'LJP', 'SPE', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(313, 'KCT', 'LJN', 'PE', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(314, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'S'),
(315, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(316, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(317, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(318, 'KP', 'LJN', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(319, 'KP', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'B'),
(320, 'KP', 'LJK', 'SPES', 'PB', 'CS', 'S', 'SPES', 'S'),
(321, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'S'),
(322, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'S'),
(323, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(324, 'KP', 'LJN', 'SPES', 'PB', 'PE', 'SPA', 'SPES', 'B'),
(325, 'KP', 'LJN', 'SPES', 'PB', 'CS', 'PA', 'SPES', 'S'),
(326, 'KP', 'LJP', 'SPE', 'P', 'CP', 'PE', 'SPES', 'RB'),
(327, 'KP', 'LJP', 'SPE', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(328, 'KP', 'LJN', 'PE', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(329, 'KP', 'LJN', 'PE', 'PB', 'SPE', 'SPA', 'SPES', 'RR'),
(330, 'KP', 'LJK', 'SPE', 'PB', 'SPE', 'SPA', 'SPES', 'S'),
(331, 'KP', 'LJK', 'SPE', 'PB', 'CS', 'S', 'SPES', 'RB'),
(332, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(333, 'KP', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(334, 'KP', 'LJK', 'SPE', 'P', 'CP', 'PE', 'SPES', 'RB'),
(335, 'KP', 'LJK', 'SPES', 'PB', 'CS', 'S', 'SPES', 'RR'),
(336, 'KP', 'LJK', 'SPES', 'P', 'PA', 'SS', 'SPES', 'RR'),
(337, 'KP', 'LJK', 'SPE', 'P', 'SPA', 'SPE', 'SPES', 'RB'),
(338, 'KP', 'LJK', 'SPES', 'PB', 'PE', 'CP', 'SPES', 'S'),
(339, 'KP', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(340, 'KP', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(341, 'KP', 'LJK', 'SPES', 'PB', 'PE', 'SPA', 'SPES', 'S'),
(342, 'KP', 'LJK', 'SPES', 'P', 'CP', 'PE', 'SPES', 'RR'),
(343, 'KP', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(344, 'KP', 'LJP', 'PE', 'PB', 'SPES', 'SPAS', 'SPES', 'S'),
(345, 'KP', 'LJK', 'SPES', 'PB', 'SS', 'PA', 'SPES', 'S'),
(346, 'KA', 'LJP', 'SPE', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(347, 'KA', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(348, 'KA', 'LJN', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(349, 'KA', 'LJK', 'SPES', 'P', 'S', 'CS', 'SPES', 'RR'),
(350, 'KA', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(351, 'KA', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(352, 'KA', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(353, 'KA', 'LJN', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(354, 'KA', 'LJN', 'SPES', 'PB', 'CS', 'S', 'SPES', 'S'),
(355, 'KA', 'LJP', 'SPES', 'P', 'SPES', 'CS', 'PA', 'RR'),
(356, 'KA', 'LJP', 'SPES', 'P', 'PA', 'SS', 'SPES', 'RR'),
(357, 'KA', 'LJN', 'SPE', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(358, 'KA', 'LJK', 'SS', 'PB', 'CS', 'S', 'SPES', 'RR'),
(359, 'KA', 'LJP', 'SPE', 'PB', 'CS', 'S', 'SPES', 'RR'),
(360, 'KA', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(361, 'KA', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(362, 'KP', 'LJN', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(363, 'KP', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(364, 'KP', 'LJK', 'SPE', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(365, 'KP', 'LJK', 'SPE', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(366, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'RB'),
(367, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(368, 'KP', 'LJN', 'SS', 'PB', 'CS', 'S', 'SPES', 'RR'),
(369, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(370, 'KP', 'LJN', 'PE', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(371, 'KP', 'LJN', 'PE', 'P', 'S', 'CS', 'SPES', 'RR'),
(372, 'KP', 'LJN', 'SPES', 'PB', 'CS', 'PA', 'SPES', 'S'),
(373, 'KP', 'LJN', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(374, 'KP', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(375, 'KP', 'LJN', 'SPE', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(376, 'KP', 'LJK', 'PE', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(377, 'KP', 'LJK', 'S', 'P', 'PE', 'SPES', 'SPES', 'RB'),
(378, 'KA', 'LJN', 'CS', 'PB', 'CS', 'S', 'SPES', 'RB'),
(379, 'KA', 'LJN', 'SPE', 'PB', 'SPES', 'SPAS', 'SPES', 'S'),
(380, 'KA', 'LJN', 'PE', 'P', 'SPE', 'SPES', 'SPES', 'RB'),
(381, 'KA', 'LJN', 'SPE', 'PB', 'PE', 'CP', 'SPES', 'S'),
(382, 'KA', 'LJK', 'SPES', 'P', 'SPES', 'SPES', 'SPES', 'RB'),
(383, 'KA', 'LJK', 'SPE', 'P', 'PA', 'SS', 'SPES', 'RR'),
(384, 'KA', 'LJN', 'SPE', 'PB', 'CS', 'S', 'SPES', 'S'),
(385, 'KA', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(386, 'KA', 'LJN', 'PE', 'PB', 'SPE', 'SPA', 'SPES', 'B'),
(387, 'KA', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(388, 'KA', 'LJN', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(389, 'KA', 'LJK', 'SPES', 'P', 'SPA', 'SPE', 'SPES', 'RB'),
(390, 'KA', 'LJK', 'CS', 'P', 'PE', 'SPES', 'SPES', 'RB'),
(391, 'KA', 'LJN', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(392, 'KA', 'LJK', 'SPES', 'P', 'SPES', 'PE', 'SPES', 'RB'),
(393, 'KA', 'LJK', 'SPE', 'P', 'SPE', 'SPES', 'SPES', 'RB'),
(394, 'KA', 'LJK', 'SS', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(395, 'KA', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B'),
(396, 'KA', 'LJK', 'SPES', 'P', 'CS', 'SPES', 'SPES', 'RB'),
(397, 'KA', 'LJK', 'SPE', 'P', 'SS', 'SPES', 'SPES', 'RB'),
(398, 'KA', 'LJN', 'PE', 'P', 'SPES', 'PE', 'SPES', 'RR'),
(399, 'KA', 'LJN', 'SPES', 'P', 'PA', 'CS', 'SPES', 'RR'),
(400, 'KA', 'LJN', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(401, 'KA', 'LJK', 'SPE', 'P', 'PE', 'SPES', 'SPES', 'RB'),
(402, 'KA', 'LJK', 'SPE', 'P', 'PE', 'SPES', 'SPES', 'RB'),
(403, 'KA', 'LJN', 'PE', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(404, 'KA', 'LJN', 'SPE', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(405, 'KA', 'LJN', 'SPE', 'P', 'PA', 'SPES', 'SPES', 'RB'),
(406, 'KP', 'LJN', 'SPES', 'P', 'CP', 'PE', 'SPES', 'RR'),
(407, 'KP', 'LJP', 'SPAS', 'PB', 'PE', 'SPA', 'SPES', 'RB'),
(408, 'KP', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(409, 'KP', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(410, 'KP', 'LJP', 'SPES', 'PB', 'CS', 'S', 'SPES', 'RB'),
(411, 'KP', 'LJK', 'PA', 'P', 'PE', 'SPES', 'SPES', 'RB'),
(412, 'KP', 'LJK', 'SPES', 'P', 'SPES', 'SPES', 'SPES', 'RB'),
(413, 'KP', 'LJK', 'SPES', 'P', 'SPA', 'PE', 'SPES', 'RB'),
(414, 'KP', 'LJN', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(415, 'KP', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(416, 'KP', 'LJP', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(417, 'KP', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(418, 'KP', 'LJN', 'SPES', 'P', 'SPA', 'PE', 'SPES', 'RB'),
(419, 'KP', 'LJK', 'SPES', 'PB', 'PE', 'SPA', 'SPES', 'S'),
(420, 'KP', 'LJN', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB'),
(421, 'KP', 'LJK', 'S', 'P', 'SPAS', 'SPES', 'SPES', 'RB');

-- --------------------------------------------------------

--
-- Table structure for table `datauji`
--

CREATE TABLE `datauji` (
  `id` int(11) NOT NULL,
  `ura_dukung` varchar(100) NOT NULL,
  `namaLintas` varchar(100) NOT NULL,
  `panjangRuas` varchar(100) NOT NULL,
  `jns_pen` varchar(100) NOT NULL,
  `tanah_krikil` varchar(100) NOT NULL,
  `aspal` varchar(6) NOT NULL,
  `rigit` varchar(6) NOT NULL,
  `target` varchar(20) NOT NULL,
  `target_hasil` varchar(20) NOT NULL,
  `id_rule` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `datauji`
--

INSERT INTO `datauji` (`id`, `ura_dukung`, `namaLintas`, `panjangRuas`, `jns_pen`, `tanah_krikil`, `aspal`, `rigit`, `target`, `target_hasil`, `id_rule`) VALUES
(1, 'KMI', 'LJN', 'PE', 'PB', 'SPE', 'SPA', 'SPES', 'B', 'B', '38'),
(2, 'KMI', 'LJP', 'SPES', 'PB', 'SPE', 'SPA', 'SPES', 'B', 'B', '39'),
(3, 'KMI', 'LJN', 'SS', 'P', 'PA', 'SS', 'SPES', 'RB', 'RB', '16'),
(4, 'KP', 'LJK', 'SPE', 'P', 'SPAS', 'SPES', 'SPES', 'RB', 'RB', '10'),
(5, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B', 'B', '40'),
(6, 'KP', 'LJK', 'SPE', 'PB', 'SPES', 'SPAS', 'SPES', 'B', 'B', '40'),
(7, 'KP', 'LJK', 'SPE', 'PB', 'CS', 'S', 'SPES', 'B', 'B', '22'),
(8, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B', 'B', '40'),
(9, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B', 'B', '40'),
(10, 'KP', 'LJN', 'SPES', 'P', 'SPA', 'PE', 'SPES', 'B', 'B', '13'),
(11, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'S', 'B', '40'),
(12, 'KP', 'LJK', 'SPES', 'P', 'SPES', 'SPE', 'PE', 'RB', 'RB', '11'),
(13, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B', 'B', '40'),
(14, 'KP', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B', 'B', '41'),
(15, 'KP', 'LJN', 'SPES', 'PB', 'PE', 'CP', 'SPES', 'B', 'S', '35'),
(16, 'KP', 'LJP', 'SPES', 'PB', 'CS', 'S', 'SPES', 'B', 'B', '21'),
(17, 'KP', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B', 'B', '40'),
(18, 'KP', 'LJK', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB', 'RB', '10'),
(19, 'KP', 'LJP', 'SPES', 'P', 'SPAS', 'SPES', 'SPES', 'RB', 'RB', '10'),
(20, 'KP', 'LJP', 'SPE', 'PB', 'SS', 'PA', 'SPES', 'B', 'S', '33'),
(21, 'KCT', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B', 'B', '40'),
(22, 'KCT', 'LJN', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B', 'B', '41'),
(23, 'KCT', 'LJK', 'SPES', 'P', 'S', 'CS', 'SPES', 'B', 'B', '18'),
(24, 'KCT', 'LJK', 'SPES', 'PB', 'SPES', 'SPAS', 'SPES', 'B', 'B', '40'),
(25, 'KCT', 'LJN', 'SPE', 'PB', 'PE', 'CP', 'SPES', 'B', 'S', '35');

-- --------------------------------------------------------

--
-- Table structure for table `datausulan`
--

CREATE TABLE `datausulan` (
  `id` int(11) NOT NULL,
  `idjalan` varchar(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `tahunusulan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `datausulan`
--

INSERT INTO `datausulan` (`id`, `idjalan`, `iduser`, `tahunusulan`) VALUES
(3, 'JLN001', 2, '2021-06-19');

-- --------------------------------------------------------

--
-- Table structure for table `data_hasil_klasifikasi`
--

CREATE TABLE `data_hasil_klasifikasi` (
  `id` int(11) NOT NULL,
  `idjalan` varchar(11) NOT NULL,
  `kondisi_hasil` varchar(100) NOT NULL,
  `id_rule` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_hasil_klasifikasi`
--

INSERT INTO `data_hasil_klasifikasi` (`id`, `idjalan`, `kondisi_hasil`, `id_rule`) VALUES
(10, 'JLN002', 'B', 20),
(11, 'JLN003', 'RB', 4),
(12, 'JLN004', 'RB', 4),
(13, 'JLN005', 'B', 14),
(14, 'JLN006', 'RB', 10),
(15, 'JLN007', 'B', 12),
(16, 'JLN008', 'S', 32),
(17, 'JLN009', 'B', 18),
(18, 'JLN010', 'B', 42),
(19, 'JLN011', 'B', 37),
(20, 'JLN012', 'S', 35),
(21, 'JLN013', 'RB', 10),
(22, 'JLN014', 'B', 12),
(23, 'JLN015', 'B', 15),
(24, 'JLN016', 'B', 15),
(25, 'JLN017', 'RB', 11),
(26, 'JLN018', 'B', 22),
(27, 'JLN019', 'RB', 10),
(28, 'JLN020', 'B', 21),
(29, 'JLN020', 'B', 34),
(30, 'JLN021', 'B', 12),
(31, 'JLN022', 'S', 32),
(32, 'JLN023', 'B', 21),
(33, 'JLN024', 'B', 40);

-- --------------------------------------------------------

--
-- Table structure for table `gain`
--

CREATE TABLE `gain` (
  `id` int(11) NOT NULL,
  `node_id` int(11) DEFAULT NULL,
  `atribut` varchar(100) DEFAULT NULL,
  `gain` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gain`
--

INSERT INTO `gain` (`id`, `node_id`, `atribut`, `gain`) VALUES
(1, 1, 'panjangRuas', 0),
(2, 1, 'jns_pen', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_keputusan`
--

CREATE TABLE `t_keputusan` (
  `id` int(11) NOT NULL,
  `parent` text DEFAULT NULL,
  `akar` text DEFAULT NULL,
  `keputusan` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_keputusan`
--

INSERT INTO `t_keputusan` (`id`, `parent`, `akar`, `keputusan`) VALUES
(1, '(jns_pen=\'PB\')', '(ura_dukung=\'KMI\')', 'B'),
(2, '(jns_pen=\'PB\') AND (ura_dukung=\'KA\')', '(namaLintas=\'LJK\')', 'B'),
(3, '(jns_pen=\'PB\') AND (ura_dukung=\'KA\')', '(namaLintas=\'LJN\')', 'B'),
(4, '(jns_pen=\'PB\') AND (ura_dukung=\'KA\')', '(namaLintas=\'LJP\')', 'B'),
(5, '(jns_pen=\'PB\') AND (ura_dukung=\'KP\')', '(namaLintas=\'LJK\')', 'B'),
(6, '(jns_pen=\'PB\') AND (ura_dukung=\'KP\')', '(namaLintas=\'LJN\')', 'B'),
(7, '(jns_pen=\'PB\') AND (ura_dukung=\'KP\')', '(namaLintas=\'LJP\')', 'B'),
(8, '(jns_pen=\'PB\')', '(ura_dukung=\'KM\')', 'B'),
(9, '(jns_pen=\'PB\') AND (ura_dukung=\'KCT\')', '(namaLintas=\'LJK\')', 'B'),
(10, '(jns_pen=\'PB\') AND (ura_dukung=\'KCT\')', '(namaLintas=\'LJN\')', 'B'),
(11, '(jns_pen=\'PB\') AND (ura_dukung=\'KCT\')', '(namaLintas=\'LJP\')', 'B'),
(12, '(jns_pen=\'P\') AND (tanah_krikil=\'SPES\')', '(namaLintas=\'LJK\')', 'B'),
(13, '(jns_pen=\'P\') AND (tanah_krikil=\'SPES\')', '(namaLintas=\'LJN\')', 'B'),
(14, '(jns_pen=\'P\') AND (tanah_krikil=\'SPES\')', '(namaLintas=\'LJP\')', 'B'),
(15, '(jns_pen=\'P\')', '(tanah_krikil=\'SPE\')', 'RB'),
(16, '(jns_pen=\'P\')', '(tanah_krikil=\'PE\')', 'RB'),
(17, '(jns_pen=\'P\')', '(tanah_krikil=\'SS\')', 'RB'),
(18, '(jns_pen=\'P\')', '(tanah_krikil=\'CS\')', 'RB'),
(19, '(jns_pen=\'P\') AND (tanah_krikil=\'S\')', '(namaLintas=\'LJK\')', 'B'),
(20, '(jns_pen=\'P\') AND (tanah_krikil=\'S\')', '(namaLintas=\'LJN\')', 'RR'),
(21, '(jns_pen=\'P\') AND (tanah_krikil=\'S\')', '(namaLintas=\'LJP\')', 'RR'),
(22, '(jns_pen=\'P\') AND (tanah_krikil=\'PA\')', '(namaLintas=\'LJK\')', 'B'),
(23, '(jns_pen=\'P\') AND (tanah_krikil=\'PA\')', '(namaLintas=\'LJN\')', 'B'),
(24, '(jns_pen=\'P\') AND (tanah_krikil=\'PA\')', '(namaLintas=\'LJP\')', 'B'),
(25, '(jns_pen=\'P\') AND (tanah_krikil=\'CP\')', '(namaLintas=\'LJK\')', 'B'),
(26, '(jns_pen=\'P\') AND (tanah_krikil=\'CP\')', '(namaLintas=\'LJN\')', 'B'),
(27, '(jns_pen=\'P\') AND (tanah_krikil=\'CP\')', '(namaLintas=\'LJP\')', 'B'),
(28, '(jns_pen=\'P\')', '(tanah_krikil=\'SPA\')', 'RB'),
(29, '(jns_pen=\'P\') AND (tanah_krikil=\'SPAS\') AND (namaLintas=\'LJK\')', '(ura_dukung=\'KMI\')', 'RB'),
(30, '(jns_pen=\'P\') AND (tanah_krikil=\'SPAS\') AND (namaLintas=\'LJK\')', '(ura_dukung=\'KA\')', 'RB'),
(31, '(jns_pen=\'P\') AND (tanah_krikil=\'SPAS\') AND (namaLintas=\'LJK\')', '(ura_dukung=\'KP\')', 'B'),
(32, '(jns_pen=\'P\') AND (tanah_krikil=\'SPAS\') AND (namaLintas=\'LJK\')', '(ura_dukung=\'KM\')', 'RB'),
(33, '(jns_pen=\'P\') AND (tanah_krikil=\'SPAS\') AND (namaLintas=\'LJK\')', '(ura_dukung=\'KCT\')', 'RB'),
(34, '(jns_pen=\'P\') AND (tanah_krikil=\'SPAS\')', '(namaLintas=\'LJN\')', 'RB'),
(35, '(jns_pen=\'P\') AND (tanah_krikil=\'SPAS\')', '(namaLintas=\'LJP\')', 'RB');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `alamat` text NOT NULL,
  `level` enum('1','2','3','4') NOT NULL,
  `jk` enum('laki-laki','perempuan','','') NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `alamat`, `level`, `jk`, `gambar`) VALUES
(1, ' Admin', 'admin', '$2y$10$QaJYETIwiD54iOKJscxaQO645kGXGrIMVL53JSP5kQwKr7eLxfDm2', 'lhoksukon', '1', 'perempuan', '60d1f6b10d8a3.jpeg'),
(2, 'Kepala Bidang', 'user1', '$2y$10$FFGm4bv01XhEPSiKooF67O1V585iZxuIPotx2QMMgJ2ZwUmDYMwhy', 'lhoksukon', '2', 'laki-laki', 'default.svg'),
(3, 'Petugas Lapangan', 'user2', '$2y$10$UMl18CiU3RCTYobx8XqLJ.yh6pp7EBNWP69vHzKqh45WQXnJEON1O', 'lhokseumawe', '3', 'perempuan', '60c85308e3c94.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aspirasi`
--
ALTER TABLE `aspirasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idjalan` (`idjalan`);

--
-- Indexes for table `datajalan`
--
ALTER TABLE `datajalan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `datapreprocessing`
--
ALTER TABLE `datapreprocessing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `datauji`
--
ALTER TABLE `datauji`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `datausulan`
--
ALTER TABLE `datausulan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idjalan` (`idjalan`),
  ADD KEY `iduser` (`iduser`);

--
-- Indexes for table `data_hasil_klasifikasi`
--
ALTER TABLE `data_hasil_klasifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gain`
--
ALTER TABLE `gain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_keputusan`
--
ALTER TABLE `t_keputusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aspirasi`
--
ALTER TABLE `aspirasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `datauji`
--
ALTER TABLE `datauji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `datausulan`
--
ALTER TABLE `datausulan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `data_hasil_klasifikasi`
--
ALTER TABLE `data_hasil_klasifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `gain`
--
ALTER TABLE `gain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_keputusan`
--
ALTER TABLE `t_keputusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `datausulan`
--
ALTER TABLE `datausulan`
  ADD CONSTRAINT `datausulan_ibfk_2` FOREIGN KEY (`iduser`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
