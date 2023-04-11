-- MySQL dump 10.19  Distrib 10.3.34-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: teologim_db_hmj
-- ------------------------------------------------------
-- Server version	10.3.34-MariaDB-cll-lve

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `dokumen_proker`
--

DROP TABLE IF EXISTS `dokumen_proker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dokumen_proker` (
  `id_dokumen` int(11) NOT NULL AUTO_INCREMENT,
  `id_proker` varchar(100) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `no_surat` varchar(100) NOT NULL,
  `perihal` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `status` enum('0','1','2','3','4','5','6') NOT NULL COMMENT '0=belum; 1=setuju sekum; 2=tolak sekum, 3=setuju kahim, 4=tolak kahim, 5=setuju pendamping, 6=tolak pendamping',
  `lampiran` varchar(255) NOT NULL,
  `tolak` varchar(100) NOT NULL,
  `tgl_input` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_dokumen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dokumen_proker`
--

LOCK TABLES `dokumen_proker` WRITE;
/*!40000 ALTER TABLE `dokumen_proker` DISABLE KEYS */;
/*!40000 ALTER TABLE `dokumen_proker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dokumen_umum`
--

DROP TABLE IF EXISTS `dokumen_umum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dokumen_umum` (
  `id_dokumen` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `no_dok` varchar(100) NOT NULL,
  `nama_dok` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `status` enum('0','1') NOT NULL,
  `lampiran` varchar(255) NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_dokumen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dokumen_umum`
--

LOCK TABLES `dokumen_umum` WRITE;
/*!40000 ALTER TABLE `dokumen_umum` DISABLE KEYS */;
/*!40000 ALTER TABLE `dokumen_umum` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dokumen_user`
--

DROP TABLE IF EXISTS `dokumen_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dokumen_user` (
  `id_dokumen` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `krs` varchar(255) DEFAULT NULL COMMENT 'form = krs',
  `karya` varchar(255) DEFAULT NULL,
  `pkkmb` varchar(255) DEFAULT NULL COMMENT 'dokumen_lain = pkkmb',
  `nilai_organisasi` varchar(5) DEFAULT NULL,
  `catatan_organisasi` text DEFAULT NULL,
  `nilai_penalaran` varchar(5) DEFAULT NULL,
  `catatan_penalaran` text DEFAULT NULL,
  `nilai_kesejahteraan` varchar(5) DEFAULT NULL,
  `catatan_kesejahteraan` text DEFAULT NULL,
  `nilai_bakat` varchar(5) DEFAULT NULL,
  `catatan_bakat` text DEFAULT NULL,
  `nilai_pengabdian` varchar(5) DEFAULT NULL,
  `catatan_pengabdian` text DEFAULT NULL,
  `nilai_ketum` varchar(5) DEFAULT NULL,
  `nilai_wawancara` varchar(5) DEFAULT NULL COMMENT 'rata-rata nilai wawancara',
  `total_nilai` varchar(5) DEFAULT NULL,
  `status` enum('0','1','2') NOT NULL COMMENT '0="Menunggu keputusan",1="Ditolak",2="Diterima"',
  `keterangan` text DEFAULT NULL COMMENT 'keterangan ditolak',
  `tgl_input` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_dokumen`)
) ENGINE=InnoDB AUTO_INCREMENT=243 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dokumen_user`
--

LOCK TABLES `dokumen_user` WRITE;
/*!40000 ALTER TABLE `dokumen_user` DISABLE KEYS */;
INSERT INTO `dokumen_user` VALUES (8,'180533631584','180533631584_Formulir.pdf','180533631584_Karya.pdf','180533631584_Sertifikat.pdf',NULL,NULL,NULL,NULL,NULL,'',NULL,'',NULL,'',NULL,NULL,NULL,'2','','2021-01-14 18:38:00'),(161,'100',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,'',NULL,'',NULL,NULL,NULL,'2',NULL,'2022-01-21 02:32:02'),(162,'101',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,'',NULL,'',NULL,NULL,NULL,'2',NULL,'2022-01-21 02:32:02'),(163,'102',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,'',NULL,'',NULL,NULL,NULL,'2',NULL,'2022-01-21 02:32:02'),(164,'103',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,'',NULL,'',NULL,NULL,NULL,'2',NULL,'2022-01-21 02:32:02'),(165,'104',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,'',NULL,'',NULL,NULL,NULL,'2',NULL,'2022-01-21 02:32:02'),(166,'105',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,'',NULL,'',NULL,NULL,NULL,'2',NULL,'2022-01-21 02:32:02'),(184,'210534615644','210534615644-KRS.jpg',NULL,'210534615644-PKKMB.jpg','70',NULL,'75',NULL,'75','','80','','100','','75',NULL,'0.815','1','mohon maaf, terima kasih','2022-02-07 04:58:19'),(185,'210534615640','210534615640-KRS.pdf',NULL,'210534615640-PKKMB.pdf','70',NULL,'75',NULL,'75','','80','','100','','75',NULL,'0.815','1','mohon maaf, terima kasih','2022-02-07 04:59:01'),(186,'210534615624','210534615624-KRS.jpg','210534615624-Karya.jpg','210534615624-PKKMB.jpg','70',NULL,'75',NULL,'80','','80','','100','','80',NULL,'0.975','2',NULL,'2022-02-07 04:53:04'),(187,'210533616027','210533616027-KRS.pdf',NULL,'210533616027-PKKMB.jpg','70',NULL,'75',NULL,'80','','80','','100','','80',NULL,'0.825','2',NULL,'2022-02-07 04:54:53'),(188,'210534615631',NULL,NULL,NULL,'70',NULL,'75',NULL,'75','','80','','100','','75',NULL,'0.465','2',NULL,'2022-02-07 05:02:17'),(189,'210534615619','210534615619-KRS.pdf',NULL,'210534615619-PKKMB.pdf','70',NULL,'75',NULL,'75','','80','','100','','75',NULL,'0.815','2',NULL,'2022-02-07 04:59:21'),(190,'210535614858',NULL,NULL,NULL,'70',NULL,'75',NULL,'80','','80','','100','','75',NULL,'0.470','2',NULL,'2022-02-07 05:01:55'),(191,'210534615602','210534615602-KRS.jpg',NULL,'210534615602-PKKMB.png','70',NULL,'75',NULL,'80','','80','','100','','75',NULL,'0.820','2',NULL,'2022-02-07 04:55:12'),(192,'210534615648','210534615648-KRS.pdf',NULL,'210534615648-PKKMB.pdf','70',NULL,'75',NULL,'75','','80','','100','','75',NULL,'0.815','2',NULL,'2022-02-07 04:59:35'),(193,'210534615650','210534615650-KRS.pdf',NULL,'210534615650-PKKMB.pdf','70',NULL,'75',NULL,'75','','80','','100','','75',NULL,'0.815','2',NULL,'2022-02-07 04:59:51'),(194,'210536615211','210536615211-KRS.png',NULL,'210536615211-PKKMB.jpeg','70',NULL,'75',NULL,'80','','80','','100','','75',NULL,'0.820','2',NULL,'2022-02-07 04:55:31'),(195,'210533616054','210533616054-KRS.pdf',NULL,'210533616054-PKKMB.jpeg','70',NULL,'75',NULL,'80','','80','','100','','75',NULL,'0.820','2',NULL,'2022-02-07 04:55:57'),(196,'210534615634','210534615634-KRS1.pdf',NULL,'210534615634-PKKMB1.pdf','70',NULL,'75',NULL,'75','','80','','100','','75',NULL,'0.815','2',NULL,'2022-02-07 05:00:17'),(197,'210534615633','210534615633-KRS.pdf',NULL,'210534615633-PKKMB.pdf','70',NULL,'75',NULL,'75','','80','','100','','75',NULL,'0.815','2',NULL,'2022-02-07 05:00:28'),(198,'210534615646','210534615646-KRS.jpg',NULL,'210534615646-PKKMB.jpg','70',NULL,'75',NULL,'80','','80','','100','','75',NULL,'0.820','2',NULL,'2022-02-07 04:56:14'),(199,'210534615614','210534615614-KRS.png',NULL,'210534615614-PKKMB.jpg','70',NULL,'75',NULL,'80','','80','','100','','75',NULL,'0.820','2',NULL,'2022-02-07 04:56:29'),(200,'210533616042','210533616042-KRS.pdf',NULL,'210533616042-PKKMB.pdf','70',NULL,'75',NULL,'75','','80','','100','','75',NULL,'0.815','2',NULL,'2022-02-07 05:00:51'),(201,'210535614852','210535614852-KRS.pdf',NULL,'210535614852-PKKMB.pdf','70',NULL,'75',NULL,'75','','80','','100','','75',NULL,'0.815','2',NULL,'2022-02-07 05:01:04'),(202,'210535614846','210535614846-KRS.pdf',NULL,'210535614846-PKKMB.pdf','75',NULL,'80',NULL,'80','','85','','90','','80',NULL,'0.830','2',NULL,'2022-02-07 04:54:34'),(203,'210535614870','210535614870-KRS.jpg',NULL,'210535614870-PKKMB.pdf','75',NULL,'80',NULL,'80','','80','','95','','85',NULL,'0.835','2',NULL,'2022-02-07 04:54:20'),(204,'210536615243','210536615243-KRS.jpeg',NULL,NULL,'75',NULL,'75',NULL,'75','','90','','80','','80',NULL,'0.615','2',NULL,'2022-02-07 05:01:23'),(205,'210535614856','210535614856-KRS.pdf','210535614856-Karya.png','210535614856-PKKMB.pdf','75',NULL,'70',NULL,'75','','70','','75','','85',NULL,'0.941','2',NULL,'2022-02-07 04:53:36'),(206,'210533616032','210533616032-KRS.pdf','210533616032-Karya.pdf','210533616032-PKKMB.pdf','75',NULL,'75',NULL,'70','','75','','70','','80',NULL,'0.936','2',NULL,'2022-02-07 04:54:01'),(207,'210536615210',NULL,NULL,NULL,'70',NULL,'75',NULL,'70','','70','','75','','85',NULL,'0.436','1','mohon maaf, terima kasih','2022-02-07 05:06:43'),(208,'210533616001',NULL,NULL,NULL,'70',NULL,'75',NULL,'70','','70','','75','','90',NULL,'0.441','2',NULL,'2022-02-07 05:05:33'),(209,'210533616009',NULL,NULL,NULL,'70',NULL,'75',NULL,'70','','75','','70','','80',NULL,'0.431','1','mohon maaf, terima kasih','2022-02-07 05:08:03'),(210,'210534615613',NULL,NULL,NULL,'70',NULL,'75',NULL,'70','','75','','70','','85',NULL,'0.436','1','mohon maaf, terima kasih','2022-02-07 05:07:05'),(211,'210535614848',NULL,NULL,NULL,'70',NULL,'75',NULL,'70','','70','','80','','80',NULL,'0.436','1','mohon maaf, terima kasih','2022-02-07 05:07:28'),(212,'210534615632',NULL,NULL,NULL,'70',NULL,'75',NULL,'70','','70','','80','','85',NULL,'0.441','2',NULL,'2022-02-07 05:05:56'),(213,'210535614883',NULL,NULL,NULL,'70',NULL,'75',NULL,'70','','75','','75','','80',NULL,'0.436','1','mohon maaf, terima kasih','2022-02-07 05:07:48'),(214,'210536615247',NULL,NULL,NULL,'70',NULL,'75',NULL,'70','','75','','75','','85',NULL,'0.441','1','mohon maaf, terima kasih','2022-02-07 05:06:24'),(215,'210533616059',NULL,NULL,NULL,'70',NULL,'75',NULL,'70','','70','','70','','80',NULL,'0.426','1','mohon maaf, terima kasih','2022-02-07 05:08:27'),(216,'210534615601',NULL,NULL,NULL,'70',NULL,'75',NULL,'70','','70','','70','','85',NULL,'0.431','1','mohon maaf, terima kasih','2022-02-07 05:08:14'),(217,'210535614864',NULL,NULL,NULL,'75',NULL,'80',NULL,'75','','80','','80','','80',NULL,'0.460','1','mohon maaf, terima kasih','2022-02-07 05:03:28'),(218,'210534615625',NULL,NULL,NULL,'75',NULL,'80',NULL,'75','','80','','80','','85',NULL,'0.465','2',NULL,'2022-02-07 05:03:04'),(219,'210534615611',NULL,NULL,NULL,'75',NULL,'80',NULL,'75','','75','','75','','80',NULL,'0.450','1','mohon maaf, terima kasih\r\n','2022-02-07 05:04:41'),(220,'210533616044',NULL,NULL,NULL,'75',NULL,'80',NULL,'75','','75','','75','','85',NULL,'0.455','1','mohon maaf, terima kasih','2022-02-07 05:04:04'),(221,'210534615608',NULL,NULL,NULL,'75',NULL,'80',NULL,'75','','80','','70','','80',NULL,'0.450','2',NULL,'2022-02-07 05:04:55'),(222,'210534615639',NULL,NULL,NULL,'75',NULL,'80',NULL,'75','','80','','70','','80',NULL,'0.450','2',NULL,'2022-02-07 05:05:20'),(223,'210536615214',NULL,NULL,NULL,'75',NULL,'80',NULL,'75','','75','','80','','80',NULL,'0.455','2',NULL,'2022-02-07 05:04:18'),(241,'201',NULL,NULL,NULL,'80',NULL,'75',NULL,'50','','90','','85','',NULL,'0.905','0.464','0',NULL,'2022-05-24 09:36:06'),(242,'202',NULL,NULL,NULL,'85','catatan\r\nwawancara\r\nyang sangat\r\npanjang\r\nsekali','80',NULL,'75','','80','','90','',NULL,'0.976','0.5','0',NULL,'2022-05-24 09:36:06');
/*!40000 ALTER TABLE `dokumen_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `format_surat`
--

DROP TABLE IF EXISTS `format_surat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `format_surat` (
  `id_form` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `nama_form` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `file` varchar(255) NOT NULL,
  `role` enum('0','1') NOT NULL COMMENT '0="Sekum",1="Bendahara"',
  PRIMARY KEY (`id_form`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `format_surat`
--

LOCK TABLES `format_surat` WRITE;
/*!40000 ALTER TABLE `format_surat` DISABLE KEYS */;
/*!40000 ALTER TABLE `format_surat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_progress`
--

DROP TABLE IF EXISTS `log_progress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_progress` (
  `id_progress` int(11) NOT NULL AUTO_INCREMENT,
  `id_proker` varchar(11) NOT NULL,
  `tanggal` date NOT NULL,
  `kegiatan` text NOT NULL,
  `kendala` text NOT NULL,
  `masukan` text DEFAULT NULL,
  PRIMARY KEY (`id_progress`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_progress`
--

LOCK TABLES `log_progress` WRITE;
/*!40000 ALTER TABLE `log_progress` DISABLE KEYS */;
/*!40000 ALTER TABLE `log_progress` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lpj`
--

DROP TABLE IF EXISTS `lpj`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lpj` (
  `id_lpj` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `tahun` varchar(10) NOT NULL,
  `lpj` varchar(255) NOT NULL,
  PRIMARY KEY (`id_lpj`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lpj`
--

LOCK TABLES `lpj` WRITE;
/*!40000 ALTER TABLE `lpj` DISABLE KEYS */;
INSERT INTO `lpj` VALUES (11,'170533628595','2019','LPJ_Ketua Umum_2019.zip');
/*!40000 ALTER TABLE `lpj` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pendaftaran`
--

DROP TABLE IF EXISTS `pendaftaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pendaftaran` (
  `id` varchar(15) NOT NULL,
  `pengumpulan_awal` date NOT NULL,
  `pengumpulan_akhir` date NOT NULL,
  `administrasi_awal` date NOT NULL,
  `administrasi_akhir` date NOT NULL,
  `wawancara_awal` date NOT NULL,
  `wawancara_akhir` date NOT NULL,
  `pengumuman` date NOT NULL,
  `formulir` text DEFAULT NULL,
  `persyaratan` text DEFAULT NULL,
  `link_persyaratan` text DEFAULT NULL,
  `status` enum('0','1') NOT NULL COMMENT '0="Aktif",1="Non Aktif"',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pendaftaran`
--

LOCK TABLES `pendaftaran` WRITE;
/*!40000 ALTER TABLE `pendaftaran` DISABLE KEYS */;
INSERT INTO `pendaftaran` VALUES ('pendaftaran','2022-02-04','2022-05-31','2022-03-08','2022-03-08','2022-03-08','2022-03-08','2022-03-09','facebook.com/anggarateomen','                                                                                                                                                                                                                                                                                                                  <div>- Mahasiswa aktif departemen teknik elektro semester 2</div><div>- memiliki sertifikat positron 2021 dibuktikan dengan mengirimkan soft file pada form pendaftaran</div>','http://bit.ly/FormulirPendaftaranHMJTEum2022','0');
/*!40000 ALTER TABLE `pendaftaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proker`
--

DROP TABLE IF EXISTS `proker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proker` (
  `id_proker` int(11) NOT NULL AUTO_INCREMENT,
  `nama_proker` varchar(100) NOT NULL,
  `ketua` varchar(100) NOT NULL,
  `bidang` varchar(2) NOT NULL,
  `divisi` varchar(2) NOT NULL,
  `panitia` varchar(255) DEFAULT NULL,
  `tgl_pelaksanaan` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `status` enum('0','1','2','3','4') NOT NULL COMMENT '0="Belum Disetujui",1="Belum Dikerjakan",2="Progress",3="Selesai",4="Ditolak"',
  `evaluasi` varchar(255) DEFAULT NULL,
  `lpj` varchar(255) DEFAULT NULL,
  `lpj_sekum` enum('0','1','2') NOT NULL COMMENT '0="Belum Disetujui",1="Disetujui",2="Ditolak"',
  `lpj_bendum` enum('0','1','2') NOT NULL COMMENT '0="Belum Disetujui",1="Disetujui",2="Ditolak"',
  `lpj_kabid` enum('0','1','2') NOT NULL COMMENT '0=belum; 1=setuju; 2=tolak',
  `lpj_kadiv` enum('0','1','2') NOT NULL COMMENT '0=belum; 1=setuju; 2=tolak',
  `tgl_input` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_proker`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proker`
--

LOCK TABLES `proker` WRITE;
/*!40000 ALTER TABLE `proker` DISABLE KEYS */;
/*!40000 ALTER TABLE `proker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_bidang`
--

DROP TABLE IF EXISTS `role_bidang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_bidang` (
  `id_bidang` int(11) NOT NULL AUTO_INCREMENT,
  `bidang` varchar(50) NOT NULL,
  PRIMARY KEY (`id_bidang`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_bidang`
--

LOCK TABLES `role_bidang` WRITE;
/*!40000 ALTER TABLE `role_bidang` DISABLE KEYS */;
INSERT INTO `role_bidang` VALUES (1,'-'),(2,'Organisasi dan Kepemimpinan'),(3,'Penalaran dan Keilmuan'),(4,'Kesejahteraan'),(5,'Bakat dan Minat'),(6,'Pengabdian Masyarakat');
/*!40000 ALTER TABLE `role_bidang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_divisi`
--

DROP TABLE IF EXISTS `role_divisi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_divisi` (
  `id_divisi` int(11) NOT NULL AUTO_INCREMENT,
  `id_bidang` varchar(2) NOT NULL,
  `divisi` varchar(100) NOT NULL,
  PRIMARY KEY (`id_divisi`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_divisi`
--

LOCK TABLES `role_divisi` WRITE;
/*!40000 ALTER TABLE `role_divisi` DISABLE KEYS */;
INSERT INTO `role_divisi` VALUES (1,'1','-'),(2,'2','-'),(3,'2','Kemahasiswaan'),(4,'2','Kemitraan'),(5,'2','Kominfo'),(6,'3','-'),(7,'3','Produk dan Jasa'),(8,'3','Robotik'),(9,'3','Power Control'),(10,'3','Information Technology'),(11,'4','-'),(12,'4','Kerohanian'),(13,'4','Rumah Tangga'),(14,'4','Kewirausahaan'),(15,'5','Pengembangan Sumber Daya Mahasiswa'),(16,'5','Olahraga'),(17,'5','Seni'),(18,'6','-'),(19,'6','Kajian Aspirasi dan Aksi Strategis'),(20,'6','Sosial Kemasyarakatan');
/*!40000 ALTER TABLE `role_divisi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_jabatan`
--

DROP TABLE IF EXISTS `role_jabatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_jabatan` (
  `id_jabatan` int(11) NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(25) NOT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_jabatan`
--

LOCK TABLES `role_jabatan` WRITE;
/*!40000 ALTER TABLE `role_jabatan` DISABLE KEYS */;
INSERT INTO `role_jabatan` VALUES (1,'Staff'),(2,'Ketua Divisi'),(3,'Ketua Bidang'),(4,'Bendahara'),(5,'Sekretaris'),(6,'Ketua Umum'),(7,'Wakil Ketua Umum'),(8,'Pendamping'),(9,'Sekretaris Bidang');
/*!40000 ALTER TABLE `role_jabatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `saldo`
--

DROP TABLE IF EXISTS `saldo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `saldo` (
  `id_saldo` int(11) NOT NULL AUTO_INCREMENT,
  `id_proker` varchar(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keperluan` text NOT NULL,
  `sumber` varchar(100) NOT NULL,
  `pemasukan` int(100) NOT NULL,
  `pengeluaran` int(100) NOT NULL,
  `sisa` int(100) NOT NULL,
  `bukti` varchar(255) NOT NULL,
  `tgl_ajukan` datetime NOT NULL,
  `tgl_terima` datetime NOT NULL,
  `role` enum('0','1') NOT NULL COMMENT '0="Pengajuan",1="Rekap"',
  `status` enum('0','1','2') NOT NULL COMMENT '0="Belum Disetujui",1="Setuju",2="Tolak"',
  PRIMARY KEY (`id_saldo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saldo`
--

LOCK TABLES `saldo` WRITE;
/*!40000 ALTER TABLE `saldo` DISABLE KEYS */;
/*!40000 ALTER TABLE `saldo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `username` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `no_hp` varchar(25) NOT NULL,
  `jabatan` varchar(2) NOT NULL,
  `bidang` varchar(2) NOT NULL,
  `divisi` varchar(50) NOT NULL,
  `masuk` datetime NOT NULL,
  `keluar` datetime NOT NULL,
  `status` enum('0','1','2','3') NOT NULL COMMENT '0="Tidak Aktif",1="Aktif",2="Berhenti",3="Selesai"',
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('100','Ketua Umum','','teum@gmail.com','0800000','6','4','13','2021-12-27 19:04:43','0000-00-00 00:00:00','1'),('101','Bidang Organisasi dan Kepemimpinan','','teum@gmail.com','0800000','3','2','3','2021-12-27 19:05:09','0000-00-00 00:00:00','1'),('102','Bidang Penalaran dan Keilmuan','','teum@gmail.com','0800000','3','3','7','2021-12-27 19:05:14','0000-00-00 00:00:00','1'),('103','Bidang Kesejahteraan','','teum@gmail.com','0800000','3','4','12','2021-12-27 19:05:18','0000-00-00 00:00:00','1'),('104','Bidang Bakat dan Minat','','teum@gmail.com','0800000','3','5','15','2021-12-27 19:05:23','0000-00-00 00:00:00','1'),('105','Bidang Pengabdian Masyarakat','','teum@gmail.com','0800000','3','6','19','2021-12-27 19:05:47','0000-00-00 00:00:00','1'),('180533631584','MUHAMMAD LUTFI SHOLEH AR-RIDHO','','180533631584@um.ac.id','0800000','6','5','16','2019-12-30 16:16:59','0000-00-00 00:00:00','3'),('200534627618','Sabina Hermilia','','teum@gmail.com','0800000','3','2','1','0000-00-00 00:00:00','0000-00-00 00:00:00','1'),('200534627647','Abizar Alghifari','','teum@gmail.com','0800000','3','6','1','0000-00-00 00:00:00','0000-00-00 00:00:00','1'),('200535626848','Refanza Pradiptha','','teum@gmail.com','0800000','3','3','1','0000-00-00 00:00:00','0000-00-00 00:00:00','1'),('200535626853','Andika Cahya Darmawan Putra','','teum@gmail.com','0800000','3','5','1','0000-00-00 00:00:00','0000-00-00 00:00:00','1'),('200536626431','Muhammad Fajar Sidiq','','teum@gmail.com','0800000','6','1','1','0000-00-00 00:00:00','0000-00-00 00:00:00','1'),('200536626460','Abrar Zaidan Dwi Syah Putra','','teum@gmail.com','0800000','3','4','1','0000-00-00 00:00:00','0000-00-00 00:00:00','1'),('201','Pendaftar Satu','','teum.123        @gmail.com','07080900-123@','','3','8','0000-00-00 00:00:00','0000-00-00 00:00:00','0'),('202','Pendaftar Dua','','teum@gmail.com','0800000','','2','4','0000-00-00 00:00:00','0000-00-00 00:00:00','0'),('203','Pendaftar Tiga','','teum@gmail.com','0800000','','6','20','0000-00-00 00:00:00','0000-00-00 00:00:00','0'),('204','Pendaftar Empat','','teum@gmail.com','0800000','','4','12','0000-00-00 00:00:00','0000-00-00 00:00:00','0'),('205','Pendaftar Lima','','teum@gmail.com','0800000','','2','4','0000-00-00 00:00:00','0000-00-00 00:00:00','0'),('210532516421','Muhammad Zaky Airlangga','','teum@gmail.com','0800000','','','','0000-00-00 00:00:00','0000-00-00 00:00:00','0'),('210533616001','Mohamad Yusuf Firmansyah','','teum@gmail.com','0800000','1','3','7','2022-02-07 12:05:33','0000-00-00 00:00:00','1'),('210533616009','Arif Herfian Zaen Chartiko','','teum@gmail.com','0800000','','4','12','0000-00-00 00:00:00','0000-00-00 00:00:00','0'),('210533616024','Nur Aliyah Rohma','','teum@gmail.com','0800000','','','','0000-00-00 00:00:00','0000-00-00 00:00:00','0'),('210533616027','Adiftya Bayu Prihandicha','','teum@gmail.com','0800000','1','2','5','2022-02-07 11:54:53','0000-00-00 00:00:00','1'),('210533616032','Jessica Arista Faradilla','','teum@gmail.com','0800000','1','3','10','2022-02-07 11:54:01','0000-00-00 00:00:00','1'),('210533616042','Ayu Najmatus Zahiroh','','teum@gmail.com','0800000','1','6','19','2022-02-07 12:00:51','0000-00-00 00:00:00','1'),('210533616044','Alif Suci Kharisma','','teum@gmail.com','0800000','','5','17','0000-00-00 00:00:00','0000-00-00 00:00:00','0'),('210533616054','Shalma Annisa Desyanti','','teum@gmail.com','0800000','1','2','4','2022-02-07 11:55:57','0000-00-00 00:00:00','1'),('210533616059','Qonita Afifa','','teum@gmail.com','0800000','','5','17','0000-00-00 00:00:00','0000-00-00 00:00:00','0'),('210534615601','Cheri Adelia','','teum@gmail.com','0800000','','5','15','0000-00-00 00:00:00','0000-00-00 00:00:00','0'),('210534615602','Virham Anugrah Jayansyah','','teum@gmail.com','0800000','1','6','20','2022-02-07 11:55:12','0000-00-00 00:00:00','1'),('210534615608','Akfan Wahyu Wardhana','','teum@gmail.com','0800000','1','3','9','2022-02-07 12:04:55','0000-00-00 00:00:00','1'),('210534615611','Khoirotun Nisa','','teum@gmail.com','0800000','','4','13','0000-00-00 00:00:00','0000-00-00 00:00:00','0'),('210534615613','Amanda Bunga Devi Ariyanti','','teum@gmail.com','0800000','','4','14','0000-00-00 00:00:00','0000-00-00 00:00:00','0'),('210534615614','Aisyah Nur Kumala','','teum@gmail.com','0800000','1','4','12','2022-02-07 11:56:29','0000-00-00 00:00:00','1'),('210534615619','Muhamad Aqshal','','teum@gmail.com','0800000','1','6','19','2022-02-07 11:59:21','0000-00-00 00:00:00','1'),('210534615622','Rohma Endar Puspita','','teum@gmail.com','0800000','','','','0000-00-00 00:00:00','0000-00-00 00:00:00','0'),('210534615624','Sulthon Dwi Husni Hamdani','','teum@gmail.com','0800000','1','3','10','2022-02-07 11:53:04','0000-00-00 00:00:00','1'),('210534615625','Sulthon Dwi Husni Hamdani','','teum@gmail.com','0800000','1','5','16','2022-02-07 12:03:04','0000-00-00 00:00:00','1'),('210534615631','Rosita Dewi','','teum@gmail.com','0800000','1','5','17','2022-02-07 12:02:17','0000-00-00 00:00:00','1'),('210534615632','Riski Amrullah','','teum@gmail.com','0800000','1','4','13','2022-02-07 12:05:56','0000-00-00 00:00:00','1'),('210534615633','Karisma Islamia','','teum@gmail.com','0800000','1','6','20','2022-02-07 12:00:28','0000-00-00 00:00:00','1'),('210534615634','Dania Eka Ayuningtyas','','teum@gmail.com','0800000','1','4','14','2022-02-07 12:00:17','0000-00-00 00:00:00','1'),('210534615639','Ahmad Fuadi','','teum@gmail.com','0800000','1','3','10','2022-02-07 12:05:20','0000-00-00 00:00:00','1'),('210534615640','Destina Twisty Susilo','','teum@gmail.com','0800000','','6','20','0000-00-00 00:00:00','0000-00-00 00:00:00','0'),('210534615644','Mohammad Rosyadi Anwar','','teum@gmail.com','0800000','','2','3','0000-00-00 00:00:00','0000-00-00 00:00:00','0'),('210534615646','Evan Kautsar Musyaffa','','teum@gmail.com','0800000','1','4','14','2022-02-07 11:56:14','0000-00-00 00:00:00','1'),('210534615648','Muhammad Rafi Dhiyaulhaq','','teum@gmail.com','0800000','1','2','3','2022-02-07 11:59:35','0000-00-00 00:00:00','1'),('210534615650','Rizqy Arrahman','','teum@gmail.com','0800000','1','2','4','2022-02-07 11:59:51','0000-00-00 00:00:00','1'),('210535614846','Dhea Fanny Putri Syarifa','','teum@gmail.com','0800000','1','5','16','2022-02-07 11:54:34','0000-00-00 00:00:00','1'),('210535614848','Muhammad Rayhan Ardhinar','','teum@gmail.com','0800000','','5','16','0000-00-00 00:00:00','0000-00-00 00:00:00','0'),('210535614852','Muhammad Zidan Brilliant','','teum@gmail.com','0800000','1','5','16','2022-02-07 12:01:04','0000-00-00 00:00:00','1'),('210535614856','Anita Qotrun Nada','','teum@gmail.com','0800000','1','4','14','2022-02-07 11:53:36','0000-00-00 00:00:00','1'),('210535614858','Muhammad Anandha Fritama','','teum@gmail.com','0800000','1','3','10','2022-02-07 12:01:55','0000-00-00 00:00:00','1'),('210535614864','Achmad Iffad','','teum@gmail.com','0800000','','6','20','0000-00-00 00:00:00','0000-00-00 00:00:00','0'),('210535614870','Muhammad Zaky Rahmatsyah','','zakyrahmatsyah@gmail.com','081334884383','1','5','16','2022-02-07 11:54:20','0000-00-00 00:00:00','1'),('210535614883','Shohwatul Hana','','teum@gmail.com','0800000','','5','16','0000-00-00 00:00:00','0000-00-00 00:00:00','0'),('210536615210','Agung Nugroho','','teum@gmail.com','0800000','','2','3','0000-00-00 00:00:00','0000-00-00 00:00:00','0'),('210536615211','Hanif Afifah Sandi','','teum@gmail.com','0800000','1','5','17','2022-02-07 11:55:31','0000-00-00 00:00:00','1'),('210536615214','Suhiro Wongso Susilo','','teum@gmail.com','0800000','1','3','9','2022-02-07 12:04:18','0000-00-00 00:00:00','1'),('210536615243','Theorilus Pardede','','teum@gmail.com','0800000','1','3','8','2022-02-07 12:01:23','0000-00-00 00:00:00','1'),('210536615247','Arih Maindra','','teum@gmail.com','0800000','','6','20','0000-00-00 00:00:00','0000-00-00 00:00:00','0');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'teologim_db_hmj'
--

--
-- Dumping routines for database 'teologim_db_hmj'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-25  9:17:34
