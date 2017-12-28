-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2017 at 10:32 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_slipsetoran`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slipsetor_ms_bank`
--

CREATE TABLE `tbl_slipsetor_ms_bank` (
  `ObjectID` int(11) NOT NULL,
  `Bank_ID` varchar(50) DEFAULT NULL,
  `Bank_Name` varchar(150) DEFAULT NULL,
  `Bank_Desc` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_slipsetor_ms_bank`
--

INSERT INTO `tbl_slipsetor_ms_bank` (`ObjectID`, `Bank_ID`, `Bank_Name`, `Bank_Desc`) VALUES
(1, 'MDR', 'Bank Mandiri', '-'),
(2, 'BCA', 'Bank Central Asia', '-'),
(3, 'PNN', 'Bank Panin', '-'),
(4, 'MGA', 'Bank Mega', '-'),
(5, 'CMN', 'Cimb Niaga', '-'),
(6, 'MYB', 'May Bank', 'Cabang Radio Dalam');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slipsetor_ms_curr`
--

CREATE TABLE `tbl_slipsetor_ms_curr` (
  `ObjectID` int(11) NOT NULL,
  `Curr_ShotID` varchar(30) DEFAULT NULL,
  `Curr_Name` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slipsetor_ms_currrate`
--

CREATE TABLE `tbl_slipsetor_ms_currrate` (
  `ObjectID` int(11) NOT NULL,
  `Bank_ID` int(11) DEFAULT NULL,
  `Year` int(11) DEFAULT NULL,
  `Month` int(11) DEFAULT NULL,
  `Curr_ID` int(11) DEFAULT NULL,
  `Rate` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slipsetor_ms_depositor`
--

CREATE TABLE `tbl_slipsetor_ms_depositor` (
  `ObjectID` int(11) NOT NULL,
  `Depositor_Name` varchar(50) DEFAULT NULL,
  `Depositor_Address` text,
  `Depositor_Phone` varchar(50) DEFAULT NULL,
  `Depositor_Rec` varchar(50) DEFAULT NULL,
  `Depositor_Status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slipsetor_ms_rec`
--

CREATE TABLE `tbl_slipsetor_ms_rec` (
  `ObjectID` int(11) NOT NULL,
  `Bank_ID` int(11) DEFAULT NULL,
  `Rec_No` varchar(150) DEFAULT NULL,
  `Rec_Name` varchar(50) DEFAULT NULL,
  `Rec_Status` int(11) DEFAULT NULL,
  `Rec_Desc` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slipsetor_ms_receiver`
--

CREATE TABLE `tbl_slipsetor_ms_receiver` (
  `ObjectID` int(11) NOT NULL,
  `Receiver_Name` varchar(50) DEFAULT NULL,
  `Receiver_Address` text,
  `Receiver_Phone` varchar(50) DEFAULT NULL,
  `Receiver_Rec` varchar(50) DEFAULT NULL,
  `Receiver_Status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slipsetor_ms_slip`
--

CREATE TABLE `tbl_slipsetor_ms_slip` (
  `ObjectID` int(11) NOT NULL,
  `Slip_Name_e` varchar(150) DEFAULT NULL,
  `TypeSlip_ID` int(11) DEFAULT NULL,
  `Bank_ID` int(11) DEFAULT NULL,
  `Slip_Status` int(11) DEFAULT NULL,
  `Slip_Memo` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_slipsetor_ms_slip`
--

INSERT INTO `tbl_slipsetor_ms_slip` (`ObjectID`, `Slip_Name_e`, `TypeSlip_ID`, `Bank_ID`, `Slip_Status`, `Slip_Memo`) VALUES
(3, 'Setoran Panin', 1, 3, 0, '-'),
(4, 'Slip Setoran Tunai', 1, 2, 1, '-'),
(5, 'Bukti Setoran Kliring', 2, 2, 1, '-'),
(6, 'Aplikasi Setoran/transfer/kliring/inkaso', 1, 1, 1, '-'),
(7, 'Surat Instruksi', 6, 2, 1, '-'),
(8, 'Permohonan Pengiriman Uang', 5, 2, 1, '-'),
(9, 'Aplikasi Transfer', 4, 3, 0, '-');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slipsetor_ms_type_slip`
--

CREATE TABLE `tbl_slipsetor_ms_type_slip` (
  `ObjectID` int(11) NOT NULL,
  `Slip_Name` varchar(50) DEFAULT NULL,
  `Slip_Desc` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_slipsetor_ms_type_slip`
--

INSERT INTO `tbl_slipsetor_ms_type_slip` (`ObjectID`, `Slip_Name`, `Slip_Desc`) VALUES
(1, 'Slip Setor Tunai', '-'),
(2, 'Slip Setor Kliring', '-'),
(3, 'Giro / Cek', '-'),
(4, 'Bukti Transfer', '-'),
(5, 'Slip Transfer', '-'),
(6, 'Surat Instruksi', '-');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slipsetor_ms_user`
--

CREATE TABLE `tbl_slipsetor_ms_user` (
  `ObjectID` int(11) NOT NULL,
  `User_Name` varchar(50) DEFAULT NULL,
  `User_ID` varchar(50) DEFAULT NULL,
  `User_Pass` varchar(50) DEFAULT NULL,
  `User_Status` int(11) DEFAULT NULL,
  `User_Lvl` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_slipsetor_ms_user`
--

INSERT INTO `tbl_slipsetor_ms_user` (`ObjectID`, `User_Name`, `User_ID`, `User_Pass`, `User_Status`, `User_Lvl`) VALUES
(1, 'Evan Abeiza', 'admin', 'admin', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slipsetor_setupslip_var`
--

CREATE TABLE `tbl_slipsetor_setupslip_var` (
  `ObjectID` int(11) NOT NULL,
  `Slip_ID` int(11) DEFAULT NULL,
  `Slip_Field` varchar(50) DEFAULT NULL,
  `Slip_Var_Name` text,
  `Slip_Var_Type` varchar(150) DEFAULT NULL,
  `Slip_Var_Margin_Top` varchar(150) DEFAULT NULL,
  `Slip_Var_Margin_Left` varchar(150) DEFAULT NULL,
  `Slip_Var_Align` int(11) DEFAULT NULL,
  `Slip_Var_Group` varchar(50) DEFAULT NULL,
  `Slip_Var_Border` int(11) DEFAULT NULL,
  `Slip_Var_Function` varchar(50) DEFAULT NULL,
  `Slip_Var_Css` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_slipsetor_setupslip_var`
--

INSERT INTO `tbl_slipsetor_setupslip_var` (`ObjectID`, `Slip_ID`, `Slip_Field`, `Slip_Var_Name`, `Slip_Var_Type`, `Slip_Var_Margin_Top`, `Slip_Var_Margin_Left`, `Slip_Var_Align`, `Slip_Var_Group`, `Slip_Var_Border`, `Slip_Var_Function`, `Slip_Var_Css`) VALUES
(1, 4, 'tgl_setor', 'Tanggal Setor', 'Datetime', '1.7', '15.76', 0, '', 0, 'tanggal', 'width:20%;margin-left:80%;float:right;'),
(2, 4, 'jns_rek_tahapan', 'Tahapan', 'Boolean', '2.06', '4.45', 1, 'jenis_rekening', 0, '', 'float:left;'),
(3, 4, 'jns_rek_tapres', 'Tapres', 'Boolean', '2.06', '6.65', 1, 'jenis_rekening', 0, '', 'float:left;'),
(4, 4, 'jns_rek_giro', 'Giro', 'Boolean', '2.16', '8.43', 1, 'jenis_rekening', 0, '', 'float:left;'),
(5, 4, 'jns_rek_bcadollar', 'BCA Dollar', 'Boolean', '2.16', '10.31', 1, 'jenis_rekening', 0, '', 'float:left;'),
(6, 4, 'jns_rek_kartukreditBCA', 'Kartu Kredit BCA', 'Boolean', '2.07', '12.76', 1, 'jenis_rekening', 0, '', 'float:left;'),
(7, 4, 'jns_rek_lainnya', 'Lainnya', 'Boolean', '2.07', '15.76', 1, 'jenis_rekening', 0, '', 'float:left;'),
(8, 4, 'jns_rek_nama_lainnya', 'Nama Rekening Lainnya', 'Text', '2.16', '17.18', 1, 'jenis_rekening', 0, '', 'float:left;margin-left:5px;'),
(9, 4, 'mata_uang_rupiah', 'Rupiah', 'Boolean', '2.44', '12.76', 1, 'mata_uang', 0, '', 'float:left;margin-left:75%;'),
(10, 4, 'mata_uang_valas', 'Valas', 'Boolean', '2.44', '15.76', 1, 'mata_uang', 0, '', 'float:left;'),
(11, 4, 'nama_valas', 'Nama Valas', 'Text', '2.53', '17.05', 1, 'mata_uang', 0, '', 'float:left;margin-left:5px;'),
(12, 4, 'no_rek_customer_1', 'No. Rekening/Customer', 'Text', '2.82', '4.37', 0, 'customer_rek', 0, 'customer', 'float:left;width:50%;margin-right:50%;'),
(13, 4, 'nama_customer_1', 'Nama Pemilik Rekening', 'Text', '3.19', '4.37', 0, 'customer_name', 0, '', 'float:left;width:50%;margin-right:50%;'),
(14, 4, 'berita_keterangan', 'Berita/Keterangan', 'Text', '3.53', '4.37', 0, '', 0, '', 'float:left;width:50%;margin-right:50%;'),
(15, 4, 'nama_penyetor', 'Nama Penyetor', 'Text', '4.59', '4.37', 0, 'depoitor_name', 0, 'penyetor', 'float:left;width:50%;margin-right:50%;'),
(16, 4, 'alamat_penyetor', 'Alamat Penyetor', 'Text', '4.96', '4.37', 0, 'depositor_address', 0, '', 'float:left;width:50%;margin-right:50%;'),
(17, 4, 'telp_penyetor', 'Telp', 'Text', '5.3', '7.6', 0, 'depositor_telp', 0, '', 'float:left;width:50%;margin-right:50%;'),
(18, 4, 'apakah_nasabah', 'Nasabah', 'Boolean', '5.53', '4.4', 0, '', 0, '', 'float:left;width:10%;'),
(19, 4, 'no_rek_penyetor', 'No. Rekening Penyetor', 'Text', '5.66', '7.28', 0, 'depositor_rek', 0, '', 'float:left;margin-left:5px;width:28%;margin-right:60%;'),
(20, 4, 'apakah_non_nasabah', 'Non Nasabah', 'Boolean', '5.91', '4.4', 0, '', 0, '', 'float:left;width:10%;'),
(21, 4, 'tanda_pengenal', 'Tanda Pengenal', 'Text', '6.32', '4.37', 0, '', 0, '', 'float:left;margin-left:5px;width:28%;margin-right:60%;'),
(22, 4, 'sumber_dana', 'Sumber Dana', 'Text', '7.23', '3.73', 0, '', 0, '', 'float:left;width:50%;margin-right:50%;'),
(23, 4, 'tujuan_transaksi', 'Tujuan Transaksi', 'Text', '7.55', '3.73', 0, '', 0, '', 'float:left;width:50%;margin-right:50%;'),
(24, 4, 'no_warkat_1', 'Tunai / No. Warkat 1', 'Text', '3.5', '10.43', 0, '', 0, '', 'float: left;position: absolute;margin-left: 50%;margin-top: 9.4%;'),
(25, 4, 'jumlah_valas_1', 'Jumlah Valas ke 1', 'numeric', '3.5', '13.21', 0, '', 0, '', 'float: left;position: absolute;margin-left: 60%;margin-top: 9.4%;'),
(26, 4, 'kurs_1', 'Kurs ke 1', 'numeric', '3.5', '15.1', 0, '', 0, '', 'float: left;position: absolute;margin-left: 70%;margin-top: 9.4%;'),
(27, 4, 'jumlah_rupiah_1', 'Jumlah Rupiah ke 1', 'numeric', '3.5', '16.46', 0, 'nominal_reg', 0, '', 'float: left;position: absolute;margin-left: 80%;margin-top: 9.4%;'),
(28, 4, 'no_warkat_2', 'Tunai / No. Warkat 2', 'Text', '3.85', '10.43', 0, '', 0, '', 'float: left;position: absolute;margin-left: 50%;margin-top: 12.4%;'),
(29, 4, 'jumlah_valas_2', 'Jumlah Valas ke 2', 'numeric', '3.85', '13.21', 0, '', 0, '', 'float: left;position: absolute;margin-left: 60%;margin-top: 12.4%;'),
(30, 4, 'kurs_2', 'Kurs ke 2', 'numeric', '3.85', '15.1', 0, '', 0, '', 'float: left;position: absolute;margin-left: 70%;margin-top: 12.4%;'),
(31, 4, 'jumlah_rupiah_2', 'Jumlah Rupiah ke 2', 'numeric', '3.85', '16.46', 0, 'nominal_reg', 0, '', 'float: left;position: absolute;margin-left: 80%;margin-top: 12.4%;'),
(32, 4, 'no_warkat_3', 'Tunai / No. Warkat 3', 'Text', '4.2', '10.43', 0, '', 0, '', 'float: left;position: absolute;margin-left: 50%;margin-top: 15.4%;'),
(33, 4, 'jumlah_valas_3', 'Jumlah Valas ke 3', 'numeric', '4.2', '13.21', 0, '', 0, '', 'float: left;position: absolute;margin-left: 60%;margin-top: 15.4%;'),
(34, 4, 'kurs_3', 'Kurs ke 3', 'numeric', '4.2', '15.1', 0, '', 0, '', 'float: left;position: absolute;margin-left: 70%;margin-top: 15.4%;'),
(35, 4, 'jumlah_rupiah_3', 'Jumlah Rupiah ke 3', 'numeric', '4.2', '16.46', 0, 'nominal_reg', 0, '', 'float: left;position: absolute;margin-left: 80%;margin-top: 15.4%;'),
(36, 4, 'total_jumlah_valas', 'Total Jumlah Valas', 'numeric', '5.25', '13.36', 0, '', 0, '', 'float: left;position: absolute;margin-left: 60%;margin-top: 18.4%;'),
(37, 4, 'total_jumlah_rupiah', 'Total Jumlah Rupiah', 'numeric', '5.25', '16.48', 0, 'total_reg', 0, '', 'float: left;position: absolute;margin-left: 80%;margin-top: 18.4%;'),
(38, 4, 'terbilang', 'Terbilang', 'Text', '6.71', '11.73', 1, '', 0, 'terbilang total_jumlah_rupiah', 'float: left;position: absolute;margin-left: 50%;margin-top: 25.4%;width:40%;'),
(39, 5, 'tgl_setor', 'Tanggal', 'Datetime', '3.1', '16.4', 0, '', 0, 'tanggal', 'float:right;margin-left:80%;width:19%;'),
(40, 5, 'setoran_kliring', 'Setoran Kliring', 'Boolean', '3.55', '3.85', 0, '', 0, '', 'float:left;margin-left:5%;'),
(41, 5, 'titipan_kliring', 'Titipan Kliring', 'Boolean', '3.55', '6.6', 0, '', 0, '', 'float:left;'),
(42, 5, 'tgl_jatuh_tempo', ', Tgl Jatuh Tempo :', 'Datetime', '3.5', '11.45', 0, '', 0, 'tanggal', 'float:left;margin-right:70%;'),
(43, 5, 'titipan_warkat_bca', 'Titipan Warkat BCA', 'Boolean', '4.05', '6.6', 0, '', 0, '', 'margin-left:12.7%;float:left'),
(44, 5, 'tgl_jatuh_tempo_warkat_BCA', ', Tgl Jatuh Tempo :', 'Datetime', '4', '12.1', 0, '', 0, 'tanggal', 'float:left;margin-right:65%'),
(45, 5, 'tahapan', 'Tahapan', 'Boolean', '4.55', '3.85', 0, '', 0, '', 'margin-left:5%;float:left;'),
(46, 5, 'tapres', 'Tapres', 'Boolean', '4.55', '6.6', 0, '', 0, '', 'float:left;margin-left:2.4%'),
(47, 5, 'giro', 'Giro', 'Boolean', '4.55', '8.8', 0, '', 0, '', 'float:left;magin-left:2.4%'),
(48, 5, 'rek_lainnya', 'Lainnya', 'Boolean', '4.55', '10.9', 0, '', 0, '', 'float:left;magin-left:2.4%'),
(49, 5, 'nama_rek_lainnya', 'Sertakan Nama Jenis Rekening Lainnya :', 'Text', '4.55', '12.6', 0, '', 0, '', 'float:left;margin-left:10px;margin-right:53%;'),
(50, 5, 'no_rek_customer_1', 'Nomor Rekening / Customer', 'Text', '5.3', '5', 0, '', 0, 'customer', 'margin-top:30px;float:left;width:35%;margin-right:60%;'),
(51, 5, 'nama_customer_1', 'Nama Pemilik Rekening', 'Text', '5.7', '5', 0, '', 0, '', 'float:left;width:35%;margin-right:60%;'),
(52, 5, 'berita_keterangan', 'Berita/Keterangan', 'Text', '6.1', '5', 0, '', 0, '', 'float:left;width:35%;margin-right:60%;'),
(53, 5, 'nama_penyetor', 'Nama Penyetor', 'Text', '6.9', '5', 0, '', 0, 'penyetor', 'margin-top:30px;float:left;width:35%;margin-right:60%;'),
(54, 5, 'alamat_penyetor', 'Alamat Penyetor', 'Text', '7.3', '5', 0, '', 0, '', 'float:left;width:35%;margin-right:60%;'),
(55, 5, 'telp_penyetor', 'Telp', 'Text', '7.65', '7.5', 0, '', 0, '', 'float:left;width:35%;margin-right:60%;'),
(56, 5, 'apakah_nasabah', 'Nasabah', 'Boolean', '8.1', '4.9', 0, '', 0, '', 'float:left;'),
(57, 5, 'no_rek_penyetor', ', No Rekening', 'Text', '8.5', '5.6', 0, '', 0, '', 'float:left;width:29.5%;margin-right:59%;'),
(58, 5, 'apakah_non_nasabah', 'Non Nasabah', 'Boolean', '8.9', '4.9', 0, '', 0, '', 'float:left;'),
(59, 5, 'tanda_pengenal', ', No. Tanda Pengenal', 'Text', '9.3', '5.6', 0, '', 0, '', 'float:left;width:27.6%;margin-right:59%;'),
(60, 5, 'sumber_dana', 'Sumber Dana :', 'Text', '10.3', '3.9', 0, '', 0, '', 'margin-top:30px;float:left;margin-right:59%;width:35%;'),
(61, 5, 'tujuan_transaksi', 'Tujuan Transaksi :', 'Text', '10.75', '3.9', 0, '', 0, '', 'float:left;margin-right:59%;width:35%;'),
(62, 5, 'no_warkat_1', 'Nomor Warkat 1', 'Text', '5.96', '10.3', 0, '', 0, '', 'position:absolute;margin-top:14.65%;float:left;margin-left:38%;width:15%;'),
(63, 5, 'kota_1', 'Kota 1', 'Text', '5.87', '13.4', 0, '', 0, '', 'position:absolute;margin-left:54%;margin-top:14.65%;width:13%'),
(64, 5, 'jumlah_1', 'Jumlah 1', 'numeric', '5.87', '15.9', 0, 'nominal_reg', 0, '', 'position:absolute;margin-top:14.65%;margin-left:68%;width:15%;'),
(65, 5, 'no_warkat_2', 'Nomor Warkat 2', 'Text', '6.36', '10.3', 0, '', 0, '', 'position:absolute;margin-top:17.65%;margin-left:38%;width:15%;'),
(66, 5, 'kota_2', 'Kota 2', 'Text', '6.27', '13.4', 0, '', 0, '', 'position:absolute;margin-top:17.65%;margin-left:54%;width:13%;'),
(67, 5, 'jumlah_2', 'Jumlah 2', 'numeric_reg', '6.27', '15.9', 0, 'nominal_reg', 0, '', 'position:absolute;margin-top:17.65%;margin-left:68%;width:15%;'),
(68, 5, 'no_warkat_3', 'Nomor Warkat 3', 'Text', '6.67', '10.3', 0, '', 0, '', 'position:absolute;margin-top:20.65%;margin-left:38%;width:15%;'),
(69, 5, 'kota_3', 'Kota 3', 'Text', '6.67', '13.4', 0, '', 0, '', 'position:absolute;margin-top:20.65%;margin-left:54%;width:13%;'),
(70, 5, 'jumlah_3', 'Jumlah 3', 'numeric', '6.67', '15.9', 0, 'nominal_reg', 0, '', 'position:absolute;margin-top:20.65%;margin-left:68%;width:15%;'),
(71, 5, 'no_warkat_4', 'Nomor Warkat 4', 'Text', '7.07', '10.3', 0, '', 0, '', 'position:absolute;margin-top:23.65%;margin-left:38%;width:15%;'),
(72, 5, 'kota_4', 'Kota 4', 'Text', '7.07', '13.4', 0, '', 0, '', 'position:absolute;margin-top:23.65%;margin-left:54%;width:13%;'),
(73, 5, 'jumlah_4', 'Jumlah 4', 'numeric', '7.07', '15.9', 0, 'nominal_reg', 0, '', 'position:absolute;margin-top:23.65%;margin-left:68%;width:15%;'),
(74, 5, 'no_warkat_5', 'Nomor Warkat 5', 'Text', '7.47', '10.3', 0, '', 0, '', 'position:absolute;margin-top:26.65%;margin-left:38%;width:15%;'),
(75, 5, 'kota_5', 'Kota 5', 'Text', '7.47', '13.4', 0, '', 0, '', 'position:absolute;margin-top:26.65%;margin-left:54%;width:13%;'),
(76, 5, 'jumlah_5', 'Jumlah 5', 'numeric', '7.47', '15.9', 0, 'nominal_reg', 0, '', 'position:absolute;margin-top:26.65%;margin-left:68%;width:15%;'),
(77, 5, 'total_jumlah_rupiah', 'Total', 'numeric', '7.9', '15.9', 0, 'total_reg', 0, '', 'position:absolute;margin-top:29.65%;margin-left:68%;width:15%;'),
(78, 5, 'biaya', 'Biaya', 'numeric', '8.35', '15.9', 0, '', 0, '', 'position:absolute;margin-top:32.65%;margin-left:38%;width:45%;'),
(79, 5, 'jumlah_yang_dikreditkan', 'Jumlah Yang Dikredit', 'numeric', '8.75', '15.9', 0, '', 0, '', 'position:absolute;margin-top:35.65%;margin-left:38%;width:45%;'),
(80, 5, 'terbilang', 'Terbilang', 'Text', '9.3', '11.8', 0, '', 0, 'terbilang total_jumlah_rupiah', 'position:absolute;margin-left:38%;margin-top:40%;width:45%;'),
(81, 8, 'kawat', 'Kawat / Telegraphic Wire', 'Boolean', '2.037292', '13.55', 0, '', 0, '', 'float:left;margin-left:70%;width:15%;'),
(82, 8, 'rtgs', 'RTGS', 'Boolean', '2.037292', '17.1', 0, '', 0, '', 'float:left;width:15%'),
(83, 8, 'wesel', 'Wesel / Draft', 'Boolean', '2.434167', '13.55', 0, '', 0, '', 'float:left;margin-left:70%;width:15%;'),
(84, 8, 'skn', 'SKN', 'Boolean', '2.434167', '17.1', 0, '', 0, '', 'float:left;width:15%;'),
(85, 8, 'tgl_hari_digit_1', 'Tanggal / Date : <br/> hari / day', 'numeric', '2.35', '3.55', 0, 'tanggal_digit', 0, '', 'float:left;width:7%;'),
(86, 8, 'tgl_hari_digit_2', '&nbsp;<br/><br/>', 'numeric', '2.35', '4', 0, 'tanggal_digit', 0, '', 'float:left;width:7%;margin-left:0.25%'),
(87, 8, 'tgl_bulan_digit_1', '&nbsp;<br/>bulan / month', 'numeric', '2.35', '4.75', 0, 'tanggal_digit', 0, '', 'float:left;margin-left:1%;width:7%;'),
(88, 8, 'tgl_bulan_digit_2', '&nbsp;<br/><br/>', 'numeric', '2.35', '5.2', 0, 'tanggal_digit', 0, '', 'float:left;margin-left:0.25%;width:7%;'),
(89, 8, 'tgl_tahun_digit_1', '&nbsp;<br/>tahun / year', 'numeric', '2.35', '5.9', 0, 'tanggal_digit', 0, '', 'float:left;width:7%;margin-left:1%;'),
(90, 8, 'tgl_tahun_digit_2', '&nbsp;<br/><br/>', 'numeric', '2.35', '6.35', 0, 'tanggal_digit', 0, '', 'float:left;margin-left:0.25%;width:7%;'),
(91, 8, 'no_rek_customer_1', 'Nomor Rekening Penerima', 'Text', '3.48', '4.15', 0, '', 0, 'customer', 'float:left;margin-right:35%;width:40%; margin-top:50px;'),
(92, 8, 'nama_customer_1', 'Nama Penerima', 'Text', '3.85', '4.15', 0, '', 0, '', 'float:left;width:40%;margin-right:35%;'),
(93, 8, 'alamat_customer_1', 'Alamat Penerima', 'Text', '4.28', '4.15', 0, '', 0, '', 'float:left;width:40%;margin-right:35%;'),
(94, 8, 'kota_customer_1', 'Kota', 'Text', '4.9', '4.15', 0, '', 0, '', 'width:40%;margin-right:59%;float:left;margin-top:20px;'),
(95, 8, 'penerima_perorangan', 'Perorangan', 'Boolean', '5.25', '4.25', 0, '', 0, '', 'float:left;width:15%;'),
(96, 8, 'penerima_perusahaan', 'Perusahaan', 'Boolean', '5.25', '6.22', 0, '', 0, '', 'float:left;width:15%;'),
(97, 8, 'penerima_pemerintah', 'Pemerintah', 'Boolean', '5.25', '8.25', 0, '', 0, '', 'float:left;width:15%;margin-right:45%;'),
(98, 8, 'penerima_penduduk', 'Penduduk', 'Boolean', '5.7', '4.25', 0, '', 0, '', 'width:15%;float:left;'),
(99, 8, 'penerima_non_penduduk', 'Non Penduduk', 'Boolean', '5.7', '6.22', 0, '', 0, '', 'float:left;width:15%;margin-right:69%;'),
(100, 8, 'penerima_negara_bagian', 'Negara Bagian', 'Text', '6.11', '4.15', 0, '', 0, '', 'float:left;width:40%;margin-right:59%;'),
(101, 8, 'penerima_negara', 'Negara', 'Text', '6.5', '4.15', 0, '', 0, '', 'float:left;width:40%;margin-right:59%;'),
(102, 8, 'penerima_kode_negara', 'Kode Negara', 'Text', '6.9', '4.15', 0, '', 0, '', 'float:left;width:40%;margin-right:59%;'),
(103, 8, 'nama_penyetor', 'Nama Pengirim', 'Text', '8.05', '4.15', 0, '', 0, 'penyetor', 'margin-top:50px;width:40%;float:left;margin-right:59%;'),
(104, 8, 'no_kartu_identitas', 'No Kartu Identitas', 'Text', '8.410625', '4.15', 0, '', 0, '', 'width:40%;float:left;margin-right:59%;'),
(105, 8, 'alamat_penyetor', 'Alamat Pengirim', 'Text', '8.8', '4.15', 0, '', 0, '', 'width:40%;float:left;margin-right:59%;'),
(106, 8, 'nama_yang_dapat_dihubungi', 'Nama Yang Dapat Dihubungi', 'Text', '9.25', '4.15', 0, '', 0, '', 'float:left;width:40%;margin-right:59%;'),
(107, 8, 'pengirim_no_telp', 'No Telepon', 'Text', '9.66', '8.2', 0, '', 0, '', 'float:right;width:20%;margin-right:59%;'),
(108, 8, 'pengirim_no_handphone', 'No Handphone', 'Text', '9.66', '4.15', 0, '', 0, '', 'float:left;width:20%;'),
(109, 8, 'pengirim_kota', 'Kota', 'Text', '10.08', '4.15', 0, '', 0, '', 'float:left;width:40%;margin-right:59%;'),
(110, 8, 'pengirim_perorangan', 'Perorangan', 'Boolean', '10.48021', '4.25', 0, '', 0, '', 'float:left;width:15%;'),
(111, 8, 'pengirim_perusahaan', 'Perusahaan', 'Boolean', '10.48021', '6.22', 0, '', 0, '', 'float:left;width:15%;'),
(112, 8, 'pengirim_pemerintahan', 'Pemerintah', 'Boolean', '10.48021', '8.23', 0, '', 0, '', 'float:left;width:15%;margin-right:50%;'),
(113, 8, 'pengirirm_penduduk', 'Penduduk', 'Boolean', '10.87', '4.25', 0, '', 0, '', 'float:left;width:15%;'),
(114, 8, 'pengirim_non_penduduk', 'Non Penduduk', 'Boolean', '10.87', '6.22', 0, '', 0, '', 'float:left;width:15%;margin-right:69%;'),
(115, 8, 'pengirim_kode_negara', 'Kode Negara', 'Text', '11.35', '4.15', 0, '', 0, '', 'float:left;width:40%;margin-right:59%;'),
(116, 8, 'pengirim_no_rek_di_bca', 'No Rekening di BCA', 'Text', '11.75', '4.15', 0, '', 0, '', 'float:left;width:40%;margin-right:59%;'),
(117, 8, 'nama_bank', 'Nama Bank', 'Text', '3.47', '13.55', 0, '', 0, '', 'position:absolute;margin-left:50%;width:40%;margin-top:9.7%;'),
(118, 8, 'alamat_bank', 'Alamat Bank', 'Text', '3.86', '13.55', 0, '', 0, '', 'position:absolute;margin-left:50%;width:40%;margin-top:12.7%;'),
(119, 8, 'kota_bank', 'Kota Bank', 'Text', '4.6', '13.55', 0, '', 0, '', 'position:absolute;margin-left:50%;width:40%;margin-top:18.7%'),
(120, 8, 'bank_negara_bagian', 'Negara Bagian', 'Text', '5.15', '13.55', 0, '', 0, '', 'position:absolute;margin-left:50%;width:40%;margin-top:21.7%'),
(121, 8, 'bank_negara', 'Negara', 'Text', '5.6', '13.55', 0, '', 0, '', 'position:absolute;margin-left:50%;width:40%;margin-top:24.7%'),
(122, 8, 'bank_kode_negara', 'Kode Negara', 'Text', '6', '13.55', 0, '', 0, '', 'position:absolute;margin-left:50%;width:40%;margin-top:27.7%'),
(123, 8, 'hubungan_keuangan_ya', 'Hubungan Keuangan Ya', 'Boolean', '8.03', '14.18167', 0, '', 0, '', 'position:absolute;margin-left:50%;width:40%;margin-top:41.5%'),
(124, 8, 'hubungan_keuangan_tidak', 'Hubungan Keuangan Tidak', 'Boolean', '8.03', '16.9', 0, '', 0, '', 'position:absolute;margin-left:70%;margin-top:41.5%;'),
(125, 8, 'data_tujuan_transaksi', 'Tujuan Transaksi', 'Text', '8.463542', '13.55', 0, '', 0, '', 'position:absolute;margin-left:50%;margin-top:44.5%;width:40%;'),
(126, 8, 'berita_keterangan', 'Berita', 'Text', '8.833958', '13.55', 0, '', 0, '', 'position:absolute;margin-left:50%;margin-top:47.5%; width:40%;'),
(127, 8, 'sumber_dana_tunai', 'Sumber Dana Tunai', 'Boolean', '10.15', '11.3', 0, '', 0, '', 'position:absolute;margin-left:50%;margin-top:50.5%; width:10%;'),
(128, 8, 'jumlah_sumber_dana_tunai', '&nbsp;', 'numeric', '10.15', '16.68625', 0, '', 0, '', 'position:absolute;margin-left:71%;margin-top:50.5%; width:19%;'),
(129, 8, 'sumber_dana_tabungan', 'Sumber Dana Tabungan', 'Boolean', '10.55', '11.3', 0, '', 0, '', 'position:absolute;margin-left:50%;margin-top:53.5%; width:10%;'),
(130, 8, 'sumber_dana_no_rek_tabungan', 'No.', 'Text', '10.55', '14.85', 0, '', 0, '', 'position:absolute;margin-left:60%;margin-top:53.5%; width:10%;'),
(131, 8, 'sumber_dana_jumlah_tabungan', '&nbsp;', 'numeric', '10.55', '16.68625', 0, '', 0, '', 'position:absolute;margin-left:71%;margin-top:53.5%; width:19%;'),
(132, 8, 'sumber_dana_cek', 'Sumber Dana Cek/BG', 'Boolean', '10.98', '11.3', 0, '', 0, '', 'position:absolute;margin-left:50%;margin-top:56.5%; width:10%;'),
(133, 8, 'sumber_dana_no_cek', 'No.', 'Text', '10.98', '14.85', 0, '', 0, '', 'position:absolute;margin-left:60%;margin-top:56.5%; width:10%;'),
(134, 8, 'sumber_dana_jumlah_cek', '&nbsp;', 'numeric', '10.98', '16.68625', 0, '', 0, '', 'position:absolute;margin-left:71%;margin-top:56.5%; width:19%;'),
(135, 8, 'sumber_dana_lainnya', 'Sumber Dana Lainnya', 'Boolean', '11.44', '11.3', 0, '', 0, '', 'position:absolute;margin-left:50%;margin-top:59.5%; width:10%;'),
(136, 8, 'sumber_dana_nama_lainnya', 'Keterangan :', 'Text', '11.44', '11.8', 0, '', 0, '', 'position:absolute;margin-left:60%;margin-top:59.5%; width:10%;'),
(137, 8, 'sumber_dana_jumlah_lainnya', '&nbsp;', 'numeric', '11.44', '16.68625', 0, '', 0, '', 'position:absolute;margin-left:71%;margin-top:59.5%; width:19%;'),
(138, 8, 'kode_mata_uang_yang_dikirim', 'Mata Uang <br/>(Jumlah Yang Dikirim)', 'Text', '14.43', '3.9', 0, '', 0, '', 'float:left;margin-top:50px;'),
(139, 8, 'jumlah_kiriman_valas_yang_dikirim', 'Jumlah Valuta Asing <br>(Jumlah yang dikirim)', 'numeric', '14.43', '5.29', 0, '', 0, '', 'float:left;margin-left:10px;margin-top:50px;'),
(140, 8, 'kurs_dikirim', 'Kurs <br>(Jumlah yang dikirim)', 'numeric', '14.43', '8.1', 0, '', 0, '', 'float:left;margin-top:50px;margin-left:10px;'),
(141, 8, 'jumlah_rupiah_yang_dikirim', 'Jumlah Rupiah <br/>(Jumlah yang dikirim)', 'numeric', '14.43', '9.78', 0, 'nominal_reg', 0, '', 'float:left;margin-top:50px;margin-left:10px;margin-right:50%;'),
(142, 8, 'kode_mata_uang_provisi', 'Mata Uang <br>(Provisi)', 'Text', '14.86', '3.9', 0, '', 0, '', 'float:left;'),
(143, 8, 'jumlah_provisi_valas', 'Jumlah Valuta Asing <br>(Provisi)', 'numeric', '14.86', '5.29', 0, '', 0, '', 'float:left;margin-left:10px;'),
(144, 8, 'kurs_provisi', 'Kurs <br>(Provisi)', 'numeric', '14.86', '8.1', 0, '', 0, '', 'float:left;margin-left:10px;'),
(145, 8, 'jumlah_provisi_rupiah', 'Jumlah Rupiah <br>(Provisi)', 'numeric', '14.86', '9.78', 0, 'nominal_reg', 0, '', 'float:left;margin-left:10px;margin-right:50%;'),
(146, 8, 'kode_mata_uang_biaya', 'Mata Uang <br>(Biaya)', 'Text', '15.31', '3.9', 0, '', 0, '', 'float:left;'),
(147, 8, 'jumlah_biaya_valas', 'Jumlah Valuta Asing <br>(Biaya)', 'numeric', '15.31', '5.29', 0, '', 0, '', 'float:Left;margin-left:10px;'),
(148, 8, 'kurs_biaya', 'Kurs <br>(Biaya)', 'numeric', '15.31', '8.1', 0, '', 0, '', 'float:left;margin-left:10px;'),
(149, 8, 'jumlah_biaya_rupiah', 'Jumlah Rupiah <br>(Biaya)', 'numeric', '15.31', '9.78', 0, 'nominal_reg', 0, '', 'float:left;margin-left:10px;margin-right:50%;'),
(150, 8, 'total_jumlah_rupiah', 'Jumlah / Total', 'numeric', '15.72', '9.78', 0, 'total_reg', 0, '', 'float:left;margin-left:31.7%;margin-right:50%'),
(151, 6, 'NULL', 'Tanggal', 'NULL', '2.169583', '18.30917', 0, 'NULL', 0, 'NULL', 'NULL'),
(152, 6, 'NULL', 'Apakah Setoran ke Rekening Sendiri', 'NULL', '2.75', '10.3', 0, 'NULL', 0, 'NULL', 'NULL'),
(153, 6, 'NULL', 'Apakah Transfer', 'NULL', '2.75', '12', 0, 'NULL', 0, 'NULL', 'NULL'),
(154, 6, 'NULL', 'Apakah RTGS', 'NULL', '2.75', '13.4', 0, 'NULL', 0, 'NULL', 'NULL'),
(155, 6, 'NULL', 'Apakah SKNBI', 'NULL', '2.75', '14.75', 0, 'NULL', 0, 'NULL', 'NULL'),
(156, 6, 'NULL', 'Apakah Kliring', 'NULL', '2.75', '16.3', 0, 'NULL', 0, 'NULL', 'NULL'),
(157, 6, 'NULL', 'Apakah Bank Draft', 'NULL', '2.75', '19.1', 0, 'NULL', 0, 'NULL', 'NULL'),
(158, 6, 'NULL', 'Apakah Penerima Perorangan', 'NULL', '6.25', '4.1', 0, 'NULL', 0, 'NULL', 'NULL'),
(159, 6, 'NULL', 'Apakah Penerima Perusahaan', 'NULL', '6.25', '6.2', 0, 'NULL', 0, 'NULL', 'NULL'),
(160, 6, 'NULL', 'Apakah Penerima Pemerintah', 'NULL', '6.25', '8.2', 0, 'NULL', 0, 'NULL', 'NULL'),
(161, 6, 'NULL', 'Apakah Penerima Penduduk', 'NULL', '6.9', '4.1', 0, 'NULL', 0, 'NULL', 'NULL'),
(162, 6, 'NULL', 'Apakah Penerima Non Penduduk', 'NULL', '6.9', '6.2', 0, 'NULL', 0, 'NULL', 'NULL'),
(163, 6, 'NULL', 'Nama Penerima', 'NULL', '7.3', '4.15', 0, 'NULL', 0, 'NULL', 'NULL'),
(164, 6, 'NULL', 'Nomor Rekening Penerima', 'NULL', '7.7', '4.15', 0, 'NULL', 0, 'NULL', 'NULL'),
(165, 6, 'NULL', 'Nama Bank Penerima', 'NULL', '8.2', '4.15', 0, 'NULL', 0, 'NULL', 'NULL'),
(166, 6, 'NULL', 'Alamat & Telepon Penerima', 'NULL', '8.95', '4.15', 0, 'NULL', 0, 'NULL', 'NULL'),
(167, 6, 'NULL', 'Jenis & No Identitas Penerima', 'NULL', '9.3', '4.15', 0, 'NULL', 0, 'NULL', 'NULL'),
(168, 6, 'NULL', 'Tujuan Transaksi', 'NULL', '10.15', '5.5', 0, 'NULL', 0, 'NULL', 'NULL'),
(169, 6, 'NULL', 'Apakah Pengirim Perorangan', 'NULL', '4.1', '14.25', 0, 'NULL', 0, 'NULL', 'NULL'),
(170, 6, 'NULL', 'Apakah Pengirim Perusahaan', 'NULL', '4.1', '16.3', 0, 'NULL', 0, 'NULL', 'NULL'),
(171, 6, 'NULL', 'Apakah Pengirim Pemerintah', 'NULL', '4.1', '18.3', 0, 'NULL', 0, 'NULL', 'NULL'),
(172, 6, 'NULL', 'Apakah Pengirim Penduduk', 'NULL', '4.7', '14.25', 0, 'NULL', 0, 'NULL', 'NULL'),
(173, 6, 'NULL', 'Apakah Pengirim Non Penduduk', 'NULL', '4.7', '16.3', 0, 'NULL', 0, 'NULL', 'NULL'),
(174, 6, 'NULL', 'Nama Pengirim', 'NULL', '5.159375', '14.2', 0, 'NULL', 0, 'NULL', 'NULL'),
(175, 6, 'NULL', 'Alamat & Telp Pengirim', 'NULL', '5.688542', '14.2', 0, 'NULL', 0, 'NULL', 'NULL'),
(176, 6, 'NULL', 'Jenis & No Identitas Pengirim', 'NULL', '6.1', '14.2', 0, 'NULL', 0, 'NULL', 'NULL'),
(177, 6, 'NULL', 'No Rek Pengirim (Digit 1)', 'NULL', '6.7', '14.2', 0, 'NULL', 0, 'NULL', 'NULL'),
(178, 6, 'NULL', 'No Rek Pengirim (Digit 2)', 'NULL', '6.7', '14.6', 0, 'NULL', 0, 'NULL', 'NULL'),
(179, 6, 'NULL', 'No Rek Pengirim (Digit 3)', 'NULL', '6.7', '15', 0, 'NULL', 0, 'NULL', 'NULL'),
(180, 6, 'NULL', 'No Rek Pengirim (Digit 4)', 'NULL', '6.7', '16.74813', 0, 'NULL', 0, 'NULL', 'NULL'),
(181, 6, 'NULL', 'No Rek Pengirim (Digit 5)', 'NULL', '6.7', '17.145', 0, 'NULL', 0, 'NULL', 'NULL'),
(182, 6, 'NULL', 'No Rek Pengirim (Digit 6)', 'NULL', '6.7', '17.56833', 0, 'NULL', 0, 'NULL', 'NULL'),
(183, 6, 'NULL', 'No Rek Pengirim (Digit 7)', 'NULL', '6.7', '17.96521', 0, 'NULL', 0, 'NULL', 'NULL'),
(184, 6, 'NULL', 'No Rek Pengirim (Digit 8)', 'NULL', '6.7', '18.36208', 0, 'NULL', 0, 'NULL', 'NULL'),
(185, 6, 'NULL', 'No Rek Pengirim (Digit 9)', 'NULL', '6.7', '18.75896', 0, 'NULL', 0, 'NULL', 'NULL'),
(186, 6, 'NULL', 'No Rek Pengirim (Digit 10)', 'NULL', '6.7', '19.18229', 0, 'NULL', 0, 'NULL', 'NULL'),
(187, 6, 'NULL', 'No Rek Pengirim (Digit 11)', 'NULL', '6.7', '19.57917', 0, 'NULL', 0, 'NULL', 'NULL'),
(188, 6, 'NULL', 'No Rek Pengirim (Digit 12)', 'NULL', '6.7', '19.97604', 0, 'NULL', 0, 'NULL', 'NULL'),
(189, 6, 'NULL', 'No Rek Pengirim (Digit 13)', 'NULL', '6.7', '20.37292', 0, 'NULL', 0, 'NULL', 'NULL'),
(190, 6, 'NULL', 'Apakah Sumber Dana Tunai', 'NULL', '8.08', '11.05958', 0, 'NULL', 0, 'NULL', 'NULL'),
(191, 6, 'NULL', 'Apakah Sumber Dana Debet Rekening', 'NULL', '8.08', '12.75292', 0, 'NULL', 0, 'NULL', 'NULL'),
(192, 6, 'NULL', 'Apakah Sumber Dana Cek', 'NULL', '8.08', '15.6', 0, 'NULL', 0, 'NULL', 'NULL'),
(193, 6, 'NULL', 'Bank Tertarik 1', 'NULL', '9.286875', '11.21833', 0, 'NULL', 0, 'NULL', 'NULL'),
(194, 6, 'NULL', 'No Cek/BG 1', 'NULL', '9.286875', '13.23622', 0, 'NULL', 0, 'NULL', 'NULL'),
(195, 6, 'NULL', 'Valuta 1', 'NULL', '9.286875', '15.27351', 0, 'NULL', 0, 'NULL', 'NULL'),
(196, 6, 'NULL', 'Nominal 1', 'NULL', '9.286875', '17.03917', 0, 'NULL', 0, 'NULL', 'NULL'),
(197, 6, 'NULL', 'Bank Tertarik 2', 'NULL', '9.657291', '11.21833', 0, 'NULL', 0, 'NULL', 'NULL'),
(198, 6, 'NULL', 'No Cek/BG 2', 'NULL', '9.657291', '13.23622', 0, 'NULL', 0, 'NULL', 'NULL'),
(199, 6, 'NULL', 'Valuta 2', 'NULL', '9.657291', '15.27351', 0, 'NULL', 0, 'NULL', 'NULL'),
(200, 6, 'NULL', 'Nominal 2', 'NULL', '9.657291', '17.03917', 0, 'NULL', 0, 'NULL', 'NULL'),
(201, 6, 'NULL', 'Bank Tertarik 3', 'NULL', '10.02771', '11.21833', 0, 'NULL', 0, 'NULL', 'NULL'),
(202, 6, 'NULL', 'No Cek/BG 3', 'NULL', '10.02771', '13.23622', 0, 'NULL', 0, 'NULL', 'NULL'),
(203, 6, 'NULL', 'Valuta 3', 'NULL', '10.02771', '15.27351', 0, 'NULL', 0, 'NULL', 'NULL'),
(204, 6, 'NULL', 'Nominal 3', 'NULL', '10.02771', '17.03917', 0, 'NULL', 0, 'NULL', 'NULL'),
(205, 6, 'NULL', 'Bank Tertarik 4', 'NULL', '10.39812', '11.21833', 0, 'NULL', 0, 'NULL', 'NULL'),
(206, 6, 'NULL', 'No Cek/BG 4', 'NULL', '10.39812', '13.23622', 0, 'NULL', 0, 'NULL', 'NULL'),
(207, 6, 'NULL', 'Valuta 4', 'NULL', '10.39812', '15.27351', 0, 'NULL', 0, 'NULL', 'NULL'),
(208, 6, 'NULL', 'Nominal 4', 'NULL', '10.39812', '17.03917', 0, 'NULL', 0, 'NULL', 'NULL'),
(209, 6, 'NULL', 'Bank Tertarik 5', 'NULL', '10.76854', '11.21833', 0, 'NULL', 0, 'NULL', 'NULL'),
(210, 6, 'NULL', 'No Cek/BG 5', 'NULL', '10.76854', '13.22917', 0, 'NULL', 0, 'NULL', 'NULL'),
(211, 6, 'NULL', 'Valuta 5', 'NULL', '10.76854', '15.26646', 0, 'NULL', 0, 'NULL', 'NULL'),
(212, 6, 'NULL', 'Nominal 5', 'NULL', '10.76854', '17.03917', 0, 'NULL', 0, 'NULL', 'NULL'),
(213, 6, 'NULL', 'Jumlah', 'NULL', '11.35063', '17.03917', 0, 'NULL', 0, 'NULL', 'NULL'),
(214, 6, 'NULL', 'Terbilang', 'NULL', '12.03854', '11.1125', 0, 'NULL', 0, 'NULL', 'NULL'),
(215, 6, 'NULL', 'Apakah Biaya Dibayar Tunai', 'NULL', '14.34042', '11.05958', 0, 'NULL', 0, 'NULL', 'NULL'),
(216, 6, 'NULL', 'Apakah Biaya Didebet Rekening', 'NULL', '14.34042', '12.72646', 0, 'NULL', 0, 'NULL', 'NULL'),
(217, 6, 'NULL', 'Debet Rekening (Digit 1)', 'NULL', '14.34042', '15.13417', 0, 'NULL', 0, 'NULL', 'NULL'),
(218, 6, 'NULL', 'Debet Rekening (Digit 2)', 'NULL', '14.34042', '15.5575', 0, 'NULL', 0, 'NULL', 'NULL'),
(219, 6, 'NULL', 'Debet Rekening (Digit 3)', 'NULL', '14.34042', '15.92792', 0, 'NULL', 0, 'NULL', 'NULL'),
(220, 6, 'NULL', 'Debet Rekening (Digit 4)', 'NULL', '14.34042', '16.80104', 0, 'NULL', 0, 'NULL', 'NULL'),
(221, 6, 'NULL', 'Debet Rekening (Digit 5)', 'NULL', '14.34042', '17.19792', 0, 'NULL', 0, 'NULL', 'NULL'),
(222, 6, 'NULL', 'Debet Rekening (Digit 6)', 'NULL', '14.34042', '17.59479', 0, 'NULL', 0, 'NULL', 'NULL'),
(223, 6, 'NULL', 'Debet Rekening (Digit 7)', 'NULL', '14.34042', '17.99167', 0, 'NULL', 0, 'NULL', 'NULL'),
(224, 6, 'NULL', 'Debet Rekening (Digit 8)', 'NULL', '14.34042', '18.38854', 0, 'NULL', 0, 'NULL', 'NULL'),
(225, 6, 'NULL', 'Debet Rekening (Digit 9)', 'NULL', '14.34042', '18.81187', 0, 'NULL', 0, 'NULL', 'NULL'),
(226, 6, 'NULL', 'Debet Rekening (Digit 10)', 'NULL', '14.34042', '19.18229', 0, 'NULL', 0, 'NULL', 'NULL'),
(227, 6, 'NULL', 'Debet Rekening (Digit 11)', 'NULL', '14.34042', '19.57917', 0, 'NULL', 0, 'NULL', 'NULL'),
(228, 6, 'NULL', 'Debet Rekening (Digit 12)', 'NULL', '14.34042', '19.97604', 0, 'NULL', 0, 'NULL', 'NULL'),
(229, 6, 'NULL', 'Debet Rekening (Digit 13)', 'NULL', '14.34042', '20.37292', 0, 'NULL', 0, 'NULL', 'NULL'),
(230, 6, 'NULL', 'Biaya Bank Koresponden Atas Pengirim', 'NULL', '15.53104', '11.05958', 0, 'NULL', 0, 'NULL', 'NULL'),
(231, 6, 'NULL', 'Biaya Bank Koresponden Penerima', 'NULL', '15.53104', '13.41438', 0, 'NULL', 0, 'NULL', 'NULL'),
(232, 6, 'NULL', 'Biaya Bank Koresponden Lainnya', 'NULL', '15.53104', '15.66333', 0, 'NULL', 0, 'NULL', 'NULL'),
(233, 6, 'NULL', 'Ket Lainnya Biaya Bank Koresponden', 'NULL', '15.50458', '17.30375', 0, 'NULL', 0, 'NULL', 'NULL'),
(234, 6, 'NULL', 'Berita', 'NULL', '0', '0', 0, 'NULL', 0, 'NULL', 'NULL'),
(235, 8, 'terbilang_rupiah', 'Terbilang (Rupiah)', 'Text', '16.29', '1.5', 1, '', 0, 'terbilang total_jumlah_rupiah', 'float:left;width:40%;margin-right:50%'),
(236, 7, 'tgl_pernyataan', 'Sehubungan dengan Surat Pernyataan Tertanggal :', 'Datetime', '1.2', '8.5', 0, 'inline_short', 0, 'tanggal', 'margin:5px 0;float:left;'),
(237, 7, 'bca_cabang', ', dengan ini kami memberikan instruksi kepada PT. Bank Central Asia Tbk (BCA) Kantor Cabang ', 'Text', '1.7', '8.5', 0, 'inline_short', 0, '', 'margin:5px 0;float:left;'),
(238, 7, 'berita_keterangan', 'untuk : 1. Mendebet rekening Giro Rupiah nomor :', 'Text', '2.5', '7.5', 0, 'inline_short', 0, '', 'margin:5px 0;float:left;'),
(239, 7, 'giro_atas_nama', 'atas nama :', 'Text', '2.5', '14.7', 0, 'inline_short', 0, '', 'margin:5px 0;float:left;'),
(240, 7, 'nominal_giro', 'sejumlah :', 'numeric', '3.35', '3.9', 0, 'inline_short', 0, '', 'margin:5px 0;float:left;'),
(241, 7, 'terbilang_giro', '&nbsp;', 'Text', '3.1', '8.5', 0, 'inline_long', 0, 'terbilang nominal_giro', 'margin:5px 0;float:left;'),
(242, 7, 'nominal_ekuivalen', 'atau senilai ekuivalen :', 'numeric', '4.1', '5.2', 0, 'inline_short', 0, '', 'margin:5px 0;float:left;'),
(243, 7, 'terbilang_ekuivalen', '&nbsp;', 'Text', '4', '10', 0, 'inline_long', 0, 'terbilang nominal_ekuivalen', 'margin:5px 0;float:left;margin-right:67%;'),
(244, 7, 'customer_nama_bank_1', '1. Nama Bank', 'Text', '6.6', '2', 0, '', 0, '', 'float:left;width:20%;margin-top:53px;'),
(245, 7, 'no_rek_customer_1', 'No. Rekening yang Dituju', 'Text', '6.6', '6.7', 0, '', 0, 'customer', 'float:left;margin-left:5px;width:20%;margin-top:50px;'),
(246, 7, 'nama_customer_1', 'Nama Pemilik Rekening', 'Text', '6.6', '9.8', 0, '', 0, '', 'float:left;margin-left:5px;margin-top:53px;width:25%;'),
(247, 7, 'customer_nominal_1', 'Nominal', 'numeric', '6.6', '16.2', 0, 'nominal', 0, '', 'float:left;width:20%;margin-top:53px;margin-left:5px;'),
(248, 7, 'customer_nama_bank_2', '2. Nama Bank', 'Text', '7.1', '2', 0, '', 0, '', 'float:left;width:20%;margin-top:3px;'),
(249, 7, 'no_rek_customer_2', 'No. Rekening yang Dituju', 'Text', '7.1', '6.7', 0, '', 0, 'customer', 'float:left;margin-left:5px;width:20%;'),
(250, 7, 'nama_customer_2', 'Nama Pemilik Rekening', 'Text', '7.1', '9.8', 0, '', 0, '', 'float:left;margin-left:5px;margin-top:3px;width:25%;'),
(251, 7, 'customer_nominal_2', 'Nominal', 'numeric', '7.1', '16.2', 0, 'nominal', 0, '', 'float:left;width:20%;margin-top:4px;margin-left:5px;'),
(252, 7, 'customer_nama_bank_3', '3. Nama Bank', 'NULL', '7.618', '2', 0, 'NULL', 0, '', 'float:left;width:20%;margin-top:3px;'),
(253, 7, 'no_rek_customer_3', 'No. Rekening yang Dituju', 'NULL', '7.618', '6.7', 0, 'NULL', 0, 'customer', 'float:left;margin-left:5px;width:20%;'),
(254, 7, 'nama_customer_3', 'Nama Pemilik Rekening', 'NULL', '7.618', '9.8', 0, 'NULL', 0, 'NULL', 'float:left;margin-left:5px;margin-top:3px;width:25%;'),
(255, 7, 'customer_nominal_3', 'Nominal', 'numeric', '7.618', '16.2', 0, 'nominal', 0, '', 'float:left;width:20%;margin-top:4px;margin-left:5px;'),
(256, 7, 'customer_nama_bank_4', '4. Nama Bank', 'NULL', '8.136', '2', 0, 'NULL', 0, '', 'float:left;width:20%;margin-top:3px;'),
(257, 7, 'no_rek_customer_4', 'No. Rekening yang Dituju', 'NULL', '8.136', '6.7', 0, 'NULL', 0, 'customer', 'float:left;margin-left:5px;width:20%;'),
(258, 7, 'nama_customer_4', 'Nama Pemilik Rekening', 'NULL', '8.136', '9.8', 0, 'NULL', 0, 'NULL', 'float:left;margin-left:5px;margin-top:3px;width:25%;'),
(259, 7, 'customer_nominal_4', 'Nominal', 'numeric', '8.136', '16.2', 0, 'nominal', 0, '', 'float:left;width:20%;margin-top:4px;margin-left:5px;'),
(260, 7, 'customer_nama_bank_5', '5. Nama Bank', 'NULL', '8.654', '2', 0, 'NULL', 0, '', 'float:left;width:20%;margin-top:3px;'),
(261, 7, 'no_rek_customer_5', 'No. Rekening yang Dituju', 'NULL', '8.654', '6.7', 0, 'NULL', 0, 'customer', 'float:left;margin-left:5px;width:20%;'),
(262, 7, 'nama_customer_5', 'Nama Pemilik Rekening', 'NULL', '8.654', '9.8', 0, 'NULL', 0, 'NULL', 'float:left;margin-left:5px;margin-top:3px;width:25%;'),
(263, 7, 'customer_nominal_5', 'Nominal', 'numeric', '8.654', '16.2', 0, 'nominal', 0, '', 'float:left;width:20%;margin-top:3px;margin-left:5px;'),
(264, 7, 'customer_nama_bank_6', '6. Nama Bank', 'NULL', '9.172', '2', 0, 'NULL', 0, '', 'float:left;width:20%;margin-top:3px;'),
(265, 7, 'no_rek_customer_6', 'No. Rekening yang Dituju', 'NULL', '9.172', '6.7', 0, 'NULL', 0, 'customer', 'float:left;margin-left:5px;width:20%;'),
(266, 7, 'nama_customer_6', 'Nama Pemilik Rekening', 'NULL', '9.172', '9.8', 0, 'NULL', 0, 'NULL', 'float:left;margin-left:5px;margin-top:3px;width:25%;'),
(267, 7, 'customer_nominal_6', 'Nominal', 'numeric', '9.172', '16.2', 0, 'nominal', 0, '', 'float:left;width:20%;margin-top:3px;margin-left:5px;'),
(268, 7, 'customer_nama_bank_7', '7. Nama Bank', 'NULL', '9.69', '2', 0, 'NULL', 0, '', 'float:left;width:20%;margin-top:3px;'),
(269, 7, 'no_rek_customer_7', 'No. Rekening yang Dituju', 'NULL', '9.69', '6.7', 0, 'NULL', 0, 'customer', 'float:left;margin-left:5px;width:20%;'),
(270, 7, 'nama_customer_7', 'Nama Pemilik Rekening', 'NULL', '9.69', '9.8', 0, 'NULL', 0, 'NULL', 'float:left;margin-left:5px;margin-top:3px;width:25%;'),
(271, 7, 'customer_nominal_7', 'Nominal', 'numeric', '9.69', '16.2', 0, 'nominal', 0, '', 'float:left;width:20%;margin-top:3px;margin-left:5px;'),
(272, 7, 'customer_nama_bank_8', '8. Nama Bank', 'NULL', '10.208', '2', 0, 'NULL', 0, '', 'float:left;width:20%;margin-top:3px;'),
(273, 7, 'no_rek_customer_8', 'No. Rekening yang Dituju', 'NULL', '10.208', '6.7', 0, 'NULL', 0, 'customer', 'float:left;margin-left:5px;width:20%;'),
(274, 7, 'nama_customer_8', 'Nama Pemilik Rekening', 'NULL', '10.208', '9.8', 0, 'NULL', 0, 'NULL', 'float:left;margin-left:5px;margin-top:3px;width:25%;'),
(275, 7, 'customer_nominal_8', 'Nominal', 'numeric', '10.208', '16.2', 0, 'nominal', 0, '', 'float:left;width:20%;margin-top:3px;margin-left:5px;'),
(276, 7, 'customer_nama_bank_9', '9. Nama Bank', 'NULL', '10.726', '2', 0, 'NULL', 0, '', 'float:left;width:20%;margin-top:3px;'),
(277, 7, 'no_rek_customer_9', 'No. Rekening yang Dituju', 'NULL', '10.726', '6.7', 0, 'NULL', 0, 'customer', 'float:left;margin-left:5px;width:20%;'),
(278, 7, 'nama_customer_9', 'Nama Pemilik Rekening', 'NULL', '10.726', '9.8', 0, 'NULL', 0, 'NULL', 'float:left;margin-left:5px;margin-top:3px;width:25%;'),
(279, 7, 'customer_nominal_9', 'Nominal', 'numeric', '10.726', '16.2', 0, 'nominal', 0, '', 'float:left;width:20%;margin-top:3px;margin-left:5px;'),
(280, 7, 'customer_nama_bank_10', '10. Nama Bank', 'NULL', '11.244', '2', 0, 'NULL', 0, '', 'float:left;width:20%;margin-top:3px;'),
(281, 7, 'no_rek_customer_10', 'No. Rekening yang Dituju', 'NULL', '11.244', '6.7', 0, 'NULL', 0, 'customer', 'float:left;margin-left:5px;width:20%;'),
(282, 7, 'nama_customer_10', 'Nama Pemilik Rekening', 'NULL', '11.244', '9.8', 0, 'NULL', 0, 'NULL', 'float:left;margin-left:5px;margin-top:3px;width:25%;'),
(283, 7, 'customer_nominal_10', 'Nominal', 'numeric', '11.244', '16.2', 0, 'nominal', 0, '', 'float:left;width:20%;margin-top:3px;margin-left:5px;'),
(284, 7, 'customer_nama_bank_11', '11. Nama Bank', 'NULL', '11.762', '2', 0, 'NULL', 0, '', 'float:left;width:20%;margin-top:3px;'),
(285, 7, 'no_rek_customer_11', 'No. Rekening yang Dituju', 'NULL', '11.762', '6.7', 0, 'NULL', 0, 'customer', 'float:left;margin-left:5px;width:20%;'),
(286, 7, 'nama_customer_11', 'Nama Pemilik Rekening', 'NULL', '11.762', '9.8', 0, 'NULL', 0, 'NULL', 'float:left;margin-left:5px;margin-top:3px;width:25%;'),
(287, 7, 'customer_nominal_11', 'Nominal', 'numeric', '11.762', '16.2', 0, 'nominal', 0, '', 'float:left;width:20%;margin-top:3px;margin-left:5px;'),
(288, 7, 'customer_nama_bank_12', '12. Nama Bank', 'NULL', '12.28', '2', 0, 'NULL', 0, '', 'float:left;width:20%;margin-top:3px;'),
(289, 7, 'no_rek_customer_12', 'No. Rekening yang Dituju', 'NULL', '12.28', '6.7', 0, 'NULL', 0, 'customer', 'float:left;margin-left:5px;width:20%;'),
(290, 7, 'nama_customer_12', 'Nama Pemilik Rekening', 'NULL', '12.28', '9.8', 0, 'NULL', 0, 'NULL', 'float:left;margin-left:5px;margin-top:3px;width:25%;'),
(291, 7, 'customer_nominal_12', 'Nominal', 'numeric', '12.28', '16.2', 0, 'nominal', 0, '', 'float:left;width:20%;margin-top:3px;margin-left:5px;'),
(292, 7, 'customer_nama_bank_13', '13. Nama Bank', 'NULL', '12.798', '2', 0, 'NULL', 0, '', 'float:left;width:20%;margin-top:3px;'),
(293, 7, 'no_rek_customer_13', 'No. Rekening yang Dituju', 'NULL', '12.798', '6.7', 0, 'NULL', 0, 'customer', 'float:left;margin-left:5px;width:20%;'),
(294, 7, 'nama_customer_13', 'Nama Pemilik Rekening', 'NULL', '12.798', '9.8', 0, 'NULL', 0, 'NULL', 'float:left;margin-left:5px;margin-top:3px;width:25%;'),
(295, 7, 'customer_nominal_13', 'Nominal', 'numeric', '12.798', '16.2', 0, 'nominal', 0, '', 'float:left;width:20%;margin-top:3px;margin-left:5px;'),
(296, 7, 'customer_nama_bank_14', '14. Nama Bank', 'NULL', '13.316', '2', 0, 'NULL', 0, '', 'float:left;width:20%;margin-top:3px;'),
(297, 7, 'no_rek_customer_14', 'No. Rekening yang Dituju', 'NULL', '13.316', '6.7', 0, 'NULL', 0, 'customer', 'float:left;margin-left:5px;width:20%;'),
(298, 7, 'nama_customer_14', 'Nama Pemilik Rekening', 'NULL', '13.316', '9.8', 0, 'NULL', 0, 'NULL', 'float:left;margin-left:5px;margin-top:3px;width:25%;'),
(299, 7, 'customer_nominal_14', 'Nominal', 'numeric', '13.316', '16.2', 0, 'nominal', 0, '', 'float:left;width:20%;margin-top:3px;margin-left:5px;'),
(300, 7, 'customer_nama_bank_15', '15. Nama Bank', 'NULL', '13.834', '2', 0, 'NULL', 0, '', 'float:left;width:20%;margin-top:3px;'),
(301, 7, 'no_rek_customer_15', 'No. Rekening yang Dituju', 'NULL', '13.834', '6.7', 0, 'NULL', 0, 'customer', 'float:left;margin-left:5px;width:20%;'),
(302, 7, 'nama_customer_15', 'Nama Pemilik Rekening', 'NULL', '13.834', '9.8', 0, 'NULL', 0, 'NULL', 'float:left;margin-left:5px;margin-top:3px;width:25%;'),
(303, 7, 'customer_nominal_15', 'Nominal', 'numeric', '13.834', '16.2', 0, 'nominal', 0, '', 'float:left;width:20%;margin-top:3px;margin-left:5px;'),
(304, 7, 'customer_nama_bank_16', '16. Nama Bank', 'NULL', '14.352', '2', 0, 'NULL', 0, '', 'float:left;width:20%;margin-top:3px;'),
(305, 7, 'no_rek_customer_16', 'No. Rekening yang Dituju', 'NULL', '14.352', '6.7', 0, 'NULL', 0, 'customer', 'float:left;margin-left:5px;width:20%;'),
(306, 7, 'nama_customer_16', 'Nama Pemilik Rekening', 'NULL', '14.352', '9.8', 0, 'NULL', 0, 'NULL', 'float:left;margin-left:5px;margin-top:3px;width:25%;'),
(307, 7, 'customer_nominal_16', 'Nominal', 'numeric', '14.352', '16.2', 0, 'nominal', 0, '', 'float:left;width:20%;margin-top:3px;margin-left:5px;'),
(308, 7, 'customer_nama_bank_17', '17. Nama Bank', 'NULL', '14.87', '2', 0, 'NULL', 0, '', 'float:left;width:20%;margin-top:3px;'),
(309, 7, 'no_rek_customer_17', 'No. Rekening yang Dituju', 'NULL', '14.87', '6.7', 0, 'NULL', 0, 'customer', 'float:left;margin-left:5px;width:20%;'),
(310, 7, 'nama_customer_17', 'Nama Pemilik Rekening', 'NULL', '14.87', '9.8', 0, 'NULL', 0, 'NULL', 'float:left;margin-left:5px;margin-top:3px;width:25%;'),
(311, 7, 'customer_nominal_17', 'Nominal', 'numeric', '14.87', '16.2', 0, 'nominal', 0, '', 'float:left;width:20%;margin-top:3px;margin-left:5px;'),
(312, 7, 'customer_nama_bank_18', '18. Nama Bank', 'NULL', '15.388', '2', 0, 'NULL', 0, '', 'float:left;width:20%;margin-top:3px;'),
(313, 7, 'no_rek_customer_18', 'No. Rekening yang Dituju', 'NULL', '15.388', '6.7', 0, 'NULL', 0, 'customer', 'float:left;margin-left:5px;width:20%;'),
(314, 7, 'nama_customer_18', 'Nama Pemilik Rekening', 'NULL', '15.388', '9.8', 0, 'NULL', 0, 'NULL', 'float:left;margin-left:5px;margin-top:3px;width:25%;'),
(315, 7, 'customer_nominal_18', 'Nominal', 'numeric', '15.388', '16.2', 0, 'nominal', 0, '', 'float:left;width:20%;margin-top:3px;margin-left:5px;'),
(316, 7, 'customer_nama_bank_19', '19. Nama Bank', 'NULL', '15.906', '2', 0, 'NULL', 0, '', 'float:left;width:20%;margin-top:3px;'),
(317, 7, 'no_rek_customer_19', 'No. Rekening yang Dituju', 'NULL', '15.906', '6.7', 0, 'NULL', 0, 'customer', 'float:left;margin-left:5px;width:20%;'),
(318, 7, 'nama_customer_19', 'Nama Pemilik Rekening', 'NULL', '15.906', '9.8', 0, 'NULL', 0, 'NULL', 'float:left;margin-left:5px;margin-top:3px;width:25%;'),
(319, 7, 'customer_nominal_19', 'Nominal', 'numeric', '15.906', '16.2', 0, 'nominal', 0, '', 'float:left;width:20%;margin-top:3px;margin-left:5px;'),
(320, 7, 'customer_nama_bank_20', '20. Nama Bank', 'NULL', '16.424', '2', 0, 'NULL', 0, '', 'float:left;width:20%;margin-top:3px;'),
(321, 7, 'no_rek_customer_20', 'No. Rekening yang Dituju', 'NULL', '16.424', '6.7', 0, 'NULL', 0, 'customer', 'float:left;margin-left:5px;width:20%;'),
(322, 7, 'nama_customer_20', 'Nama Pemilik Rekening', 'NULL', '16.424', '9.8', 0, 'NULL', 0, 'NULL', 'float:left;margin-left:5px;margin-top:3px;width:25%;'),
(323, 7, 'customer_nominal_20', 'Nominal', 'numeric', '16.424', '16.2', 0, 'nominal', 0, '', 'float:left;width:20%;margin-top:3px;margin-left:5px;'),
(324, 7, 'customer_nama_bank_21', '21. Nama Bank', 'NULL', '16.942', '2', 0, 'NULL', 0, '', 'float:left;width:20%;margin-top:3px;'),
(325, 7, 'no_rek_customer_21', 'No. Rekening yang Dituju', 'NULL', '16.942', '6.7', 0, 'NULL', 0, 'customer', 'float:left;margin-left:5px;width:20%;'),
(326, 7, 'nama_customer_21', 'Nama Pemilik Rekening', 'NULL', '16.942', '9.8', 0, 'NULL', 0, 'NULL', 'float:left;margin-left:5px;margin-top:3px;width:25%;'),
(327, 7, 'customer_nominal_21', 'Nominal', 'numeric', '16.942', '16.2', 0, 'nominal', 0, '', 'float:left;width:20%;margin-top:3px;margin-left:5px;'),
(328, 7, 'customer_nama_bank_22', '22. Nama Bank', 'NULL', '17.46', '2', 0, 'NULL', 0, '', 'float:left;width:20%;margin-top:3px;'),
(329, 7, 'no_rek_customer_22', 'No. Rekening yang Dituju', 'NULL', '17.46', '6.7', 0, 'NULL', 0, 'customer', 'float:left;margin-left:5px;width:20%;'),
(330, 7, 'nama_customer_22', 'Nama Pemilik Rekening', 'NULL', '17.46', '9.8', 0, 'NULL', 0, 'NULL', 'float:left;margin-left:5px;margin-top:3px;width:25%;'),
(331, 7, 'customer_nominal_22', 'Nominal', 'numeric', '17.46', '16.2', 0, 'nominal', 0, '', 'float:left;width:20%;margin-top:3px;margin-left:5px;'),
(332, 7, 'customer_nama_bank_23', '23. Nama Bank', 'NULL', '17.978', '2', 0, 'NULL', 0, '', 'float:left;width:20%;margin-top:3px;'),
(333, 7, 'no_rek_customer_23', 'No. Rekening yang Dituju', 'NULL', '17.978', '6.7', 0, 'NULL', 0, 'customer', 'float:left;margin-left:5px;width:20%;'),
(334, 7, 'nama_customer_23', 'Nama Pemilik Rekening', 'NULL', '17.978', '9.8', 0, 'NULL', 0, 'NULL', 'float:left;margin-left:5px;margin-top:3px;width:25%;'),
(335, 7, 'customer_nominal_23', 'Nominal', 'numeric', '17.978', '16.2', 0, 'nominal', 0, '', 'float:left;width:20%;margin-top:3px;margin-left:5px;'),
(336, 7, 'customer_nama_bank_24', '24. Nama Bank', 'NULL', '18.496', '2', 0, 'NULL', 0, '', 'float:left;width:20%;margin-top:3px;'),
(337, 7, 'no_rek_customer_24', 'No. Rekening yang Dituju', 'NULL', '18.496', '6.7', 0, 'NULL', 0, 'customer', 'float:left;margin-left:5px;width:20%;'),
(338, 7, 'nama_customer_24', 'Nama Pemilik Rekening', 'NULL', '18.496', '9.8', 0, 'NULL', 0, 'NULL', 'float:left;margin-left:5px;margin-top:3px;width:25%;'),
(339, 7, 'customer_nominal_24', 'Nominal', 'numeric', '18.496', '16.2', 0, 'nominal', 0, '', 'float:left;width:20%;margin-top:3px;margin-left:5px;'),
(340, 7, 'customer_nama_bank_25', '25. Nama Bank', 'NULL', '19.014', '2', 0, 'NULL', 0, '', 'float:left;width:20%;margin-top:3px;'),
(341, 7, 'no_rek_customer_25', 'No. Rekening yang Dituju', 'NULL', '19.014', '6.7', 0, 'NULL', 0, 'customer', 'float:left;margin-left:5px;width:20%;'),
(342, 7, 'nama_customer_25', 'Nama Pemilik Rekening', 'NULL', '19.014', '9.8', 0, 'NULL', 0, 'NULL', 'float:left;margin-left:5px;margin-top:3px;width:25%;'),
(343, 7, 'customer_nominal_25', 'Nominal', 'numeric', '19.014', '16.2', 0, 'nominal', 0, '', 'float:left;width:20%;margin-top:3px;margin-left:5px;'),
(344, 7, 'customer_nama_bank_26', '26. Nama Bank', 'NULL', '19.532', '2', 0, 'NULL', 0, '', 'float:left;width:20%;margin-top:3px;'),
(345, 7, 'no_rek_customer_26', 'No. Rekening yang Dituju', 'NULL', '19.532', '6.7', 0, 'NULL', 0, 'customer', 'float:left;margin-left:5px;width:20%;'),
(346, 7, 'nama_customer_26', 'Nama Pemilik Rekening', 'NULL', '19.532', '9.8', 0, 'NULL', 0, 'NULL', 'float:left;margin-left:5px;margin-top:3px;width:25%;'),
(347, 7, 'customer_nominal_26', 'Nominal', 'numeric', '19.532', '16.2', 0, 'nominal', 0, '', 'float:left;width:20%;margin-top:3px;margin-left:5px;'),
(348, 7, 'customer_nama_bank_27', '27. Nama Bank', 'NULL', '20.05', '2', 0, 'NULL', 0, '', 'float:left;width:20%;margin-top:3px;'),
(349, 7, 'no_rek_customer_27', 'No. Rekening yang Dituju', 'NULL', '20.05', '6.7', 0, 'NULL', 0, 'customer', 'float:left;margin-left:5px;width:20%;'),
(350, 7, 'nama_customer_27', 'Nama Pemilik Rekening', 'NULL', '20.05', '9.8', 0, 'NULL', 0, 'NULL', 'float:left;margin-left:5px;margin-top:3px;width:25%;'),
(351, 7, 'customer_nominal_27', 'Nominal', 'numeric', '20.05', '16.2', 0, 'nominal', 0, '', 'float:left;width:20%;margin-top:3px;margin-left:5px;'),
(352, 7, 'customer_nama_bank_28', '28. Nama Bank', 'NULL', '20.568', '2', 0, 'NULL', 0, '', 'float:left;width:20%;margin-top:3px;'),
(353, 7, 'no_rek_customer_28', 'No. Rekening yang Dituju', 'NULL', '20.568', '6.7', 0, 'NULL', 0, 'customer', 'float:left;margin-left:5px;width:20%;'),
(354, 7, 'nama_customer_28', 'Nama Pemilik Rekening', 'NULL', '20.568', '9.8', 0, 'NULL', 0, 'NULL', 'float:left;margin-left:5px;margin-top:3px;width:25%;'),
(355, 7, 'customer_nominal_28', 'Nominal', 'numeric', '20.568', '16.2', 0, 'nominal', 0, '', 'float:left;width:20%;margin-top:3px;margin-left:5px;'),
(356, 7, 'customer_nama_bank_29', '29. Nama Bank', 'NULL', '21.086', '2', 0, 'NULL', 0, '', 'float:left;width:20%;margin-top:3px;'),
(357, 7, 'no_rek_customer_29', 'No. Rekening yang Dituju', 'NULL', '21.086', '6.7', 0, 'NULL', 0, 'customer', 'float:left;margin-left:5px;width:20%;'),
(358, 7, 'nama_customer_29', 'Nama Pemilik Rekening', 'NULL', '21.086', '9.8', 0, 'NULL', 0, 'NULL', 'float:left;margin-left:5px;margin-top:3px;width:25%;'),
(359, 7, 'customer_nominal_29', 'Nominal', 'numeric', '21.086', '16.2', 0, 'nominal', 0, '', 'float:left;width:20%;margin-top:3px;margin-left:5px;'),
(360, 7, 'customer_nama_bank_30', '30. Nama Bank', 'NULL', '21.604', '2', 0, 'NULL', 0, '', 'float:left;width:20%;margin-top:3px;'),
(361, 7, 'no_rek_customer_30', 'No. Rekening yang Dituju', 'NULL', '21.604', '6.7', 0, 'NULL', 0, 'customer', 'float:left;margin-left:5px;width:20%;'),
(362, 7, 'nama_customer_30', 'Nama Pemilik Rekening', 'NULL', '21.604', '9.8', 0, 'NULL', 0, 'NULL', 'float:left;margin-left:5px;margin-top:3px;width:25%;'),
(363, 7, 'customer_nominal_30', 'Nominal', 'numeric', '21.604', '16.2', 0, 'nominal', 0, '', 'float:left;width:20%;margin-top:3px;margin-left:5px;'),
(364, 7, 'total_jumlah_rupiah', 'Total Nominal', 'numeric', '22.122', '16.2', 0, 'total', 0, '', 'float:left;margin-left:66.2%;width:20%;');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slipsetor_transaction`
--

CREATE TABLE `tbl_slipsetor_transaction` (
  `ObjectID` int(11) NOT NULL,
  `Trans_No` varchar(150) DEFAULT NULL,
  `Bank_Name` varchar(50) DEFAULT NULL,
  `Slip_Name` varchar(100) DEFAULT NULL,
  `Receiver_Name` varchar(150) DEFAULT NULL,
  `Receiver_Rek` varchar(150) DEFAULT NULL,
  `Depositor_Name` varchar(150) DEFAULT NULL,
  `Depositor_Rek` varchar(150) DEFAULT NULL,
  `Trans_Dt` datetime DEFAULT NULL,
  `Entry_Dt` datetime DEFAULT NULL,
  `Slip_Var_ID` int(11) DEFAULT NULL,
  `Slip_Var_Value` varchar(225) DEFAULT NULL,
  `Trans_Amount` float DEFAULT NULL,
  `Trans_Desc` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_evan_slipsetor_transaction`
--
CREATE TABLE `view_evan_slipsetor_transaction` (
`Trans_No` varchar(150)
,`Bank_Name` varchar(50)
,`Slip_Name` varchar(100)
,`Trans_Dt` datetime
,`Entry_Dt` datetime
,`Trans_Amount` float
,`Trans_Desc` text
);

-- --------------------------------------------------------

--
-- Structure for view `view_evan_slipsetor_transaction`
--
DROP TABLE IF EXISTS `view_evan_slipsetor_transaction`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_evan_slipsetor_transaction`  AS  select distinct `tbl_slipsetor_transaction`.`Trans_No` AS `Trans_No`,`tbl_slipsetor_transaction`.`Bank_Name` AS `Bank_Name`,`tbl_slipsetor_transaction`.`Slip_Name` AS `Slip_Name`,`tbl_slipsetor_transaction`.`Trans_Dt` AS `Trans_Dt`,`tbl_slipsetor_transaction`.`Entry_Dt` AS `Entry_Dt`,`tbl_slipsetor_transaction`.`Trans_Amount` AS `Trans_Amount`,`tbl_slipsetor_transaction`.`Trans_Desc` AS `Trans_Desc` from `tbl_slipsetor_transaction` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_slipsetor_ms_bank`
--
ALTER TABLE `tbl_slipsetor_ms_bank`
  ADD PRIMARY KEY (`ObjectID`);

--
-- Indexes for table `tbl_slipsetor_ms_curr`
--
ALTER TABLE `tbl_slipsetor_ms_curr`
  ADD PRIMARY KEY (`ObjectID`);

--
-- Indexes for table `tbl_slipsetor_ms_currrate`
--
ALTER TABLE `tbl_slipsetor_ms_currrate`
  ADD PRIMARY KEY (`ObjectID`);

--
-- Indexes for table `tbl_slipsetor_ms_depositor`
--
ALTER TABLE `tbl_slipsetor_ms_depositor`
  ADD PRIMARY KEY (`ObjectID`);

--
-- Indexes for table `tbl_slipsetor_ms_rec`
--
ALTER TABLE `tbl_slipsetor_ms_rec`
  ADD PRIMARY KEY (`ObjectID`);

--
-- Indexes for table `tbl_slipsetor_ms_receiver`
--
ALTER TABLE `tbl_slipsetor_ms_receiver`
  ADD PRIMARY KEY (`ObjectID`);

--
-- Indexes for table `tbl_slipsetor_ms_slip`
--
ALTER TABLE `tbl_slipsetor_ms_slip`
  ADD PRIMARY KEY (`ObjectID`);

--
-- Indexes for table `tbl_slipsetor_ms_type_slip`
--
ALTER TABLE `tbl_slipsetor_ms_type_slip`
  ADD PRIMARY KEY (`ObjectID`);

--
-- Indexes for table `tbl_slipsetor_ms_user`
--
ALTER TABLE `tbl_slipsetor_ms_user`
  ADD PRIMARY KEY (`ObjectID`);

--
-- Indexes for table `tbl_slipsetor_setupslip_var`
--
ALTER TABLE `tbl_slipsetor_setupslip_var`
  ADD PRIMARY KEY (`ObjectID`);

--
-- Indexes for table `tbl_slipsetor_transaction`
--
ALTER TABLE `tbl_slipsetor_transaction`
  ADD PRIMARY KEY (`ObjectID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_slipsetor_ms_bank`
--
ALTER TABLE `tbl_slipsetor_ms_bank`
  MODIFY `ObjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_slipsetor_ms_curr`
--
ALTER TABLE `tbl_slipsetor_ms_curr`
  MODIFY `ObjectID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_slipsetor_ms_currrate`
--
ALTER TABLE `tbl_slipsetor_ms_currrate`
  MODIFY `ObjectID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_slipsetor_ms_depositor`
--
ALTER TABLE `tbl_slipsetor_ms_depositor`
  MODIFY `ObjectID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_slipsetor_ms_rec`
--
ALTER TABLE `tbl_slipsetor_ms_rec`
  MODIFY `ObjectID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_slipsetor_ms_receiver`
--
ALTER TABLE `tbl_slipsetor_ms_receiver`
  MODIFY `ObjectID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_slipsetor_ms_slip`
--
ALTER TABLE `tbl_slipsetor_ms_slip`
  MODIFY `ObjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_slipsetor_ms_type_slip`
--
ALTER TABLE `tbl_slipsetor_ms_type_slip`
  MODIFY `ObjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_slipsetor_ms_user`
--
ALTER TABLE `tbl_slipsetor_ms_user`
  MODIFY `ObjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_slipsetor_setupslip_var`
--
ALTER TABLE `tbl_slipsetor_setupslip_var`
  MODIFY `ObjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=365;
--
-- AUTO_INCREMENT for table `tbl_slipsetor_transaction`
--
ALTER TABLE `tbl_slipsetor_transaction`
  MODIFY `ObjectID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
