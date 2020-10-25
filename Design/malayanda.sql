-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.8-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table malayanda.tbl_barang
CREATE TABLE IF NOT EXISTS `tbl_barang` (
  `kode_barang` char(8) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `satuan_barang` varchar(30) NOT NULL,
  PRIMARY KEY (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table malayanda.tbl_barang: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_barang` DISABLE KEYS */;
INSERT INTO `tbl_barang` (`kode_barang`, `nama_barang`, `satuan_barang`) VALUES
	('BRNG0001', 'Beras', 'Karung');
INSERT INTO `tbl_barang` (`kode_barang`, `nama_barang`, `satuan_barang`) VALUES
	('BRNG0002', 'Minyak', 'Liter');
/*!40000 ALTER TABLE `tbl_barang` ENABLE KEYS */;


-- Dumping structure for table malayanda.tbl_stok
CREATE TABLE IF NOT EXISTS `tbl_stok` (
  `id_stok` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_stok` date NOT NULL,
  `akhir_stok` int(11) NOT NULL,
  `penjualan_stok` int(11) NOT NULL,
  `persediaan_stok` int(11) NOT NULL,
  `kode_barang` char(8) NOT NULL,
  PRIMARY KEY (`id_stok`),
  KEY `tbl_stok_fk_kode_barang` (`kode_barang`),
  CONSTRAINT `tbl_stok_fk_kode_barang` FOREIGN KEY (`kode_barang`) REFERENCES `tbl_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table malayanda.tbl_stok: ~6 rows (approximately)
/*!40000 ALTER TABLE `tbl_stok` DISABLE KEYS */;
INSERT INTO `tbl_stok` (`id_stok`, `tanggal_stok`, `akhir_stok`, `penjualan_stok`, `persediaan_stok`, `kode_barang`) VALUES
	(1, '2020-01-31', 201, 151, 123, 'BRNG0001');
INSERT INTO `tbl_stok` (`id_stok`, `tanggal_stok`, `akhir_stok`, `penjualan_stok`, `persediaan_stok`, `kode_barang`) VALUES
	(2, '2020-02-29', 251, 121, 144, 'BRNG0001');
INSERT INTO `tbl_stok` (`id_stok`, `tanggal_stok`, `akhir_stok`, `penjualan_stok`, `persediaan_stok`, `kode_barang`) VALUES
	(3, '2020-03-30', 231, 221, 152, 'BRNG0001');
INSERT INTO `tbl_stok` (`id_stok`, `tanggal_stok`, `akhir_stok`, `penjualan_stok`, `persediaan_stok`, `kode_barang`) VALUES
	(4, '2020-04-30', 351, 251, 135, 'BRNG0001');
INSERT INTO `tbl_stok` (`id_stok`, `tanggal_stok`, `akhir_stok`, `penjualan_stok`, `persediaan_stok`, `kode_barang`) VALUES
	(5, '2020-05-31', 361, 241, 112, 'BRNG0001');
INSERT INTO `tbl_stok` (`id_stok`, `tanggal_stok`, `akhir_stok`, `penjualan_stok`, `persediaan_stok`, `kode_barang`) VALUES
	(6, '2020-06-30', 211, 161, 146, 'BRNG0001');
/*!40000 ALTER TABLE `tbl_stok` ENABLE KEYS */;


-- Dumping structure for table malayanda.tbl_user
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `foto_user` varchar(50) NOT NULL,
  `nama_user` varchar(30) NOT NULL,
  `jabatan_user` varchar(30) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table malayanda.tbl_user: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `foto_user`, `nama_user`, `jabatan_user`) VALUES
	(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '1603528493a462f8c334e328ba8f572ca0a51c4861.jpg', 'MA\'SHUM ABDUL JABBAR', 'admin');
INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `foto_user`, `nama_user`, `jabatan_user`) VALUES
	(2, 'pimpinan', '90973652b88fe07d05a4304f0a945de8', '1603602662779b7513263ef185b6d094af290ef540.png', 'JENK JENKS', 'pimpinan');
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
