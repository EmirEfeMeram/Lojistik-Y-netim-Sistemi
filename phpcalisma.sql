-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 28 Tem 2021, 09:52:12
-- Sunucu sürümü: 5.7.24
-- PHP Sürümü: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `phpcalisma`
--

DELIMITER $$
--
-- Yordamlar
--
DROP PROCEDURE IF EXISTS `SORU_1`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SORU_1` ()  NO SQL
SELECT concat(araclar.Arac_Marka," ",araclar.Arac_Model) as 'arac ismi' , COUNT(gonderim.Gonderim_ID) as 'gonderim sayısı'
FROM araclar LEFT JOIN gonderim ON araclar.Arac_ID=gonderim.Arac_ID
GROUP BY araclar.Arac_ID
ORDER BY 'gonderim sayısı'$$

DROP PROCEDURE IF EXISTS `SORU_10`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SORU_10` (IN `uzunluk` INT(11))  NO SQL
SELECT concat(suruculer.Surucu_ad," ",suruculer.Surucu_soyad) as 'sürücü ismi' ,SUM(gonderim.Gonderim_Mesafe) as gonderim_mesafe
FROM suruculer,gonderim WHERE suruculer.Surucu_ID=gonderim.Surucu_ID GROUP BY suruculer.Surucu_ID HAVING gonderim_mesafe>uzunluk$$

DROP PROCEDURE IF EXISTS `SORU_2`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SORU_2` (IN `marka` VARCHAR(255))  NO SQL
SELECT concat(araclar.Arac_Marka," ",araclar.Arac_Model) as 'arac ismi' ,round(AVG(gonderim.Gonderim_Maliyeti),2) as 'ort gonderim maliyet'
FROM araclar LEFT JOIN gonderim ON araclar.Arac_ID=gonderim.Arac_ID WHERE araclar.Arac_Marka= marka$$

DROP PROCEDURE IF EXISTS `SORU_3`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SORU_3` (IN `sayi` INT(11))  NO SQL
SELECT concat(suruculer.Surucu_ad," ",suruculer.Surucu_soyad) AS 'Surucu ismi', COUNT(gonderim.Gonderim_ID) as gonderim_sayisi
FROM suruculer,gonderim
WHERE suruculer.Surucu_ID=gonderim.Surucu_ID
GROUP BY suruculer.Surucu_ID
HAVING gonderim_sayisi>sayi
ORDER BY gonderim_sayisi DESC$$

DROP PROCEDURE IF EXISTS `SORU_4`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SORU_4` ()  NO SQL
SELECT concat(suruculer.Surucu_ad," ",suruculer.Surucu_soyad) as surucu_isim ,COUNT(gonderim.Gonderim_ID) gonderim_sayisi
FROM suruculer,gonderim
WHERE suruculer.Surucu_ID=gonderim.Surucu_ID
GROUP BY suruculer.Surucu_ID
HAVING COUNT(gonderim.Gonderim_ID)=(SELECT MAX(toplam) FROM (SELECT COUNT(gonderim.Gonderim_ID) AS toplam FROM suruculer,gonderim WHERE suruculer.Surucu_ID=gonderim.Surucu_ID GROUP BY suruculer.Surucu_ID) AS sonuc)$$

DROP PROCEDURE IF EXISTS `SORU_5`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SORU_5` ()  NO SQL
SELECT subeler.Sube_Ad as sube_ismi,round(AVG(gonderim.Gonderim_T_Sure),0) as ort_gonderim_tahmini_suresi
FROM subeler,gonderim
WHERE subeler.Sube_ID=gonderim.Sube_ID AND subeler.Sube_Ad IN ("Konak","Karşıyaka","Bornova")
GROUP BY subeler.Sube_ID$$

DROP PROCEDURE IF EXISTS `SORU_6`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SORU_6` ()  NO SQL
SELECT * FROM gonderim,gonderimsure WHERE gonderim.Gonderim_ID=gonderimsure.Gonderim_ID AND gonderimsure.Gonderim_Basari NOT IN (1)  
ORDER BY `gonderim`.`Gonderim_Zamani`  DESC$$

DROP PROCEDURE IF EXISTS `SORU_7`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SORU_7` ()  NO SQL
SELECT gonderim.Gonderim_ID,gonderim.Gonderim_Mesafe FROM gonderim WHERE gonderim.Gonderim_Maliyeti> ALL (SELECT AVG(gonderim.Gonderim_Maliyeti) FROM gonderim )  
ORDER BY `gonderim`.`Gonderim_Mesafe`  DESC$$

DROP PROCEDURE IF EXISTS `SORU_8`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SORU_8` (IN `isim` VARCHAR(255))  NO SQL
SELECT subeler.Sube_Muduru AS sube_mudur,COUNT(gonderim.Gonderim_ID) AS gonderim_sayisi FROM subeler,gonderim WHERE subeler.Sube_ID=gonderim.Sube_ID AND subeler.Sube_Ad=isim GROUP BY subeler.Sube_ID$$

DROP PROCEDURE IF EXISTS `SORU_9`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SORU_9` (IN `marka` VARCHAR(255))  NO SQL
SELECT concat(araclar.Arac_Marka," ",araclar.Arac_Model) as 'arac ismi' ,SUM(gonderim.Gonderim_Mesafe) as gonderim_mesafe
FROM araclar LEFT JOIN gonderim ON araclar.Arac_ID=gonderim.Arac_ID WHERE araclar.Arac_Marka=marka$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `araclar`
--

DROP TABLE IF EXISTS `araclar`;
CREATE TABLE IF NOT EXISTS `araclar` (
  `Arac_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Arac_Marka` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `Arac_Model` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `Arac_Tuketim` float NOT NULL,
  PRIMARY KEY (`Arac_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `araclar`
--

INSERT INTO `araclar` (`Arac_ID`, `Arac_Marka`, `Arac_Model`, `Arac_Tuketim`) VALUES
(1, 'Fiat', 'Ducato', 0.09),
(2, 'Ford', 'Transit', 0.114),
(3, 'MAN', 'TGE', 0.112);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `gonderim`
--

DROP TABLE IF EXISTS `gonderim`;
CREATE TABLE IF NOT EXISTS `gonderim` (
  `Gonderim_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Sube_ID` int(11) NOT NULL,
  `Surucu_ID` int(11) NOT NULL,
  `Arac_ID` int(11) NOT NULL,
  `Gonderim_T_Sure` int(11) NOT NULL,
  `Gonderim_Mesafe` int(11) NOT NULL,
  `Gonderim_Maliyeti` float NOT NULL,
  `Gonderim_Zamani` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Gonderim_ID`),
  KEY `Sube_ID` (`Sube_ID`),
  KEY `Surucu_ID` (`Surucu_ID`),
  KEY `Arac_ID` (`Arac_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `gonderim`
--

INSERT INTO `gonderim` (`Gonderim_ID`, `Sube_ID`, `Surucu_ID`, `Arac_ID`, `Gonderim_T_Sure`, `Gonderim_Mesafe`, `Gonderim_Maliyeti`, `Gonderim_Zamani`) VALUES
(5, 1, 6, 1, 10, 10, 5, '2020-05-14 18:14:45'),
(6, 1, 8, 1, 16, 8, 5, '2020-05-14 18:20:54'),
(7, 2, 6, 1, 10, 10, 5, '2020-05-15 16:02:00'),
(8, 2, 6, 1, 10, 10, 5, '2020-05-15 16:02:52'),
(9, 2, 6, 1, 10, 10, 5, '2020-05-15 16:07:22'),
(10, 2, 6, 1, 10, 10, 5, '2020-05-15 16:07:42'),
(11, 2, 8, 1, 30, 16, 5, '2020-05-15 16:20:45'),
(12, 2, 6, 1, 50, 26, 5, '2020-05-15 16:21:36'),
(13, 4, 7, 3, 35, 19, 5, '2020-05-15 16:22:58'),
(14, 3, 9, 1, 34, 28, 13.4316, '2020-05-15 16:25:54'),
(15, 5, 7, 3, 20, 15, 8.9544, '2020-05-15 18:19:49'),
(16, 5, 10, 2, 35, 32, 19.8451, '2020-05-15 21:17:05'),
(17, 3, 6, 2, 45, 28, 17.3645, '2020-05-15 21:19:24'),
(18, 6, 6, 2, 63, 70, 43.4112, '2020-05-15 21:21:14'),
(19, 1, 7, 1, 14, 9, 4.4064, '2020-05-15 21:25:18'),
(20, 1, 7, 1, 14, 9, 4.4064, '2020-05-15 21:28:59'),
(21, 1, 6, 1, 10, 5, 2.448, '2020-05-15 22:38:05'),
(22, 2, 6, 1, 20, 6, 2.9376, '2020-05-15 22:40:48'),
(23, 3, 8, 3, 20, 19, 11.5763, '2020-05-15 22:42:35'),
(24, 4, 10, 2, 18, 21, 13.0234, '2020-05-15 22:44:23'),
(25, 5, 8, 3, 22, 24, 14.6227, '2020-05-16 11:15:31'),
(26, 6, 9, 1, 29, 37, 18.1152, '2020-05-16 11:48:17'),
(27, 6, 7, 2, 22, 22, 13.6435, '2020-05-16 14:57:50'),
(28, 4, 8, 3, 19, 21, 12.7949, '2020-05-16 22:32:08'),
(29, 2, 6, 2, 7, 5, 3.1008, '2020-05-17 13:47:07'),
(30, 5, 10, 3, 18, 11, 6.70208, '2020-05-17 13:47:52'),
(31, 4, 6, 1, 17, 20, 9.792, '2020-05-17 14:07:34'),
(32, 1, 9, 2, 16, 10, 6.2016, '2020-05-17 14:13:37'),
(33, 1, 6, 2, 16, 10, 6.2016, '2020-05-17 14:13:55'),
(34, 1, 6, 1, 16, 10, 4.896, '2020-05-17 14:16:44'),
(35, 3, 7, 3, 13, 19, 11.5763, '2020-05-17 14:18:08'),
(36, 3, 6, 1, 13, 19, 9.3024, '2020-05-17 14:21:33'),
(37, 2, 7, 3, 7, 5, 3.0464, '2020-05-17 14:22:27'),
(38, 1, 10, 2, 16, 10, 6.2016, '2020-05-17 14:27:11'),
(39, 1, 7, 3, 16, 10, 6.0928, '2020-05-17 14:28:09'),
(40, 3, 8, 2, 19, 20, 12.4032, '2020-05-17 14:31:43'),
(41, 5, 9, 2, 18, 11, 6.82176, '2020-05-17 14:39:41'),
(42, 5, 7, 1, 18, 11, 5.3856, '2020-05-17 14:41:25'),
(43, 5, 6, 3, 18, 11, 6.70208, '2020-05-17 14:41:39'),
(44, 1, 6, 1, 14, 10, 4.896, '2020-05-17 14:44:37'),
(45, 1, 6, 1, 19, 10, 4.896, '2020-05-17 15:09:40'),
(46, 1, 6, 1, 20, 15, 7.344, '2020-05-17 19:01:20'),
(47, 1, 9, 2, 20, 15, 9.3024, '2020-05-17 19:28:53'),
(48, 3, 9, 3, 30, 20, 12.1856, '2020-05-17 20:01:55'),
(49, 1, 9, 2, 20, 15, 9.3024, '2020-05-17 20:10:05'),
(50, 3, 6, 2, 35, 30, 18.6048, '2020-05-17 20:24:18'),
(51, 1, 6, 3, 20, 15, 9.1392, '2020-05-17 20:24:32'),
(52, 2, 6, 1, 10, 5, 2.448, '2020-05-17 20:29:48'),
(53, 4, 10, 2, 25, 19, 11.783, '2020-05-17 20:31:07'),
(54, 1, 9, 2, 22, 17, 10.5427, '2020-05-17 22:58:22'),
(55, 1, 9, 1, 15, 10, 4.896, '2020-05-18 17:42:21'),
(56, 1, 6, 1, 20, 15, 7.452, '2020-05-19 12:16:58'),
(57, 1, 8, 2, 20, 15, 9.4392, '2020-05-19 12:17:12'),
(58, 1, 7, 1, 20, 9, 4.4712, '2020-05-20 17:49:27'),
(59, 1, 7, 3, 19, 9, 5.56416, '2020-05-20 17:50:12'),
(60, 1, 9, 1, 19, 10, 4.968, '2020-05-20 17:51:35'),
(61, 5, 10, 2, 26, 16, 10.0685, '2020-05-20 17:52:57'),
(62, 5, 7, 1, 26, 16, 7.9488, '2020-05-20 17:54:26'),
(63, 4, 6, 1, 16, 16, 7.9488, '2020-05-20 17:57:22'),
(64, 1, 6, 1, 15, 10, 4.968, '2020-05-20 18:02:11'),
(65, 1, 10, 3, 15, 10, 6.1824, '2020-05-20 18:03:59'),
(66, 6, 7, 2, 22, 16, 10.0685, '2020-05-20 18:06:04'),
(67, 3, 9, 3, 26, 21, 12.983, '2020-05-20 18:09:36'),
(68, 3, 6, 1, 26, 21, 10.4328, '2020-05-20 18:11:31'),
(69, 6, 7, 1, 16, 17, 8.4456, '2020-05-20 18:18:45'),
(70, 6, 10, 3, 20, 11, 6.80064, '2020-05-20 18:19:46'),
(71, 2, 9, 1, 8, 4, 1.9872, '2020-05-20 18:22:32'),
(72, 2, 10, 2, 8, 4, 2.51712, '2020-05-20 19:00:58'),
(73, 3, 8, 1, 24, 30, 15.228, '2020-05-20 21:16:18'),
(74, 1, 6, 1, 19, 9, 4.5684, '2020-05-21 11:12:51'),
(75, 6, 10, 1, 185, 340, 172.584, '2020-05-21 11:46:15'),
(76, 1, 10, 2, 15, 4, 2.57184, '2020-05-21 14:09:41'),
(77, 1, 6, 1, 16, 9, 5.0625, '2020-10-29 21:49:29'),
(78, 2, 6, 1, 15, 10, 6.075, '2021-01-06 10:38:31'),
(79, 1, 10, 1, 18, 8, 4.7088, '2021-04-19 08:57:05'),
(80, 5, 10, 1, 27, 25, 16.47, '2021-05-27 13:35:13');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `gonderimsure`
--

DROP TABLE IF EXISTS `gonderimsure`;
CREATE TABLE IF NOT EXISTS `gonderimsure` (
  `Gonderim_Sure_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Gonderim_ID` int(11) NOT NULL,
  `Gonderim_Suresi` int(11) NOT NULL,
  `Gonderim_Basari` tinyint(1) NOT NULL,
  PRIMARY KEY (`Gonderim_Sure_ID`),
  KEY `Gonderim_ID` (`Gonderim_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `gonderimsure`
--

INSERT INTO `gonderimsure` (`Gonderim_Sure_ID`, `Gonderim_ID`, `Gonderim_Suresi`, `Gonderim_Basari`) VALUES
(1, 28, 35, 1),
(2, 27, 25, 0),
(3, 26, 34, 1),
(4, 25, 34, 0),
(5, 24, 34, 0),
(6, 23, 34, 0),
(7, 22, 34, 0),
(8, 21, 34, 0),
(9, 20, 34, 0),
(10, 19, 34, 0),
(11, 18, 34, 1),
(12, 17, 34, 1),
(13, 16, 34, 1),
(14, 15, 34, 0),
(15, 14, 34, 1),
(16, 13, 34, 1),
(17, 12, 34, 1),
(18, 11, 34, 1),
(19, 10, 34, 0),
(20, 9, 34, 0),
(21, 8, 34, 0),
(22, 7, 34, 0),
(23, 6, 34, 0),
(24, 5, 34, 0),
(25, 30, 34, 0),
(26, 29, 34, 0),
(27, 31, 20, 1),
(28, 33, 20, 1),
(29, 32, 20, 1),
(30, 32, 20, 1),
(31, 34, 56, 0),
(32, 35, 56, 0),
(33, 36, 20, 1),
(34, 37, 15, 1),
(35, 38, 15, 1),
(36, 39, 15, 1),
(37, 40, 15, 1),
(38, 41, 50, 0),
(39, 43, 35, 0),
(40, 42, 35, 0),
(41, 44, 45, 0),
(42, 5, 35, 0),
(43, 5, 46, 0),
(44, 5, 46, 0),
(45, 5, 34, 0),
(46, 5, 34, 0),
(47, 5, 34, 0),
(48, 5, 45, 0),
(49, 5, 25, 0),
(50, 5, 25, 0),
(51, 5, 25, 0),
(52, 5, 25, 0),
(53, 5, 25, 0),
(54, 5, 25, 0),
(55, 5, 25, 0),
(56, 5, 25, 0),
(57, 5, 25, 0),
(58, 5, 25, 0),
(59, 5, 25, 0),
(60, 5, 25, 0),
(61, 5, 15, 1),
(62, 5, 15, 1),
(63, 5, 15, 1),
(64, 5, 15, 1),
(65, 5, 15, 1),
(66, 5, 15, 1),
(67, 45, 15, 1),
(68, 5, 15, 1),
(69, 5, 50, 0),
(70, 5, 50, 0),
(71, 5, 50, 0),
(72, 5, 50, 0),
(73, 5, 50, 0),
(74, 5, 50, 0),
(75, 5, 35, 0),
(76, 5, 35, 0),
(77, 5, 35, 0),
(78, 5, 35, 0),
(79, 5, 35, 0),
(80, 46, 35, 0),
(81, 5, 45, 0),
(82, 5, 45, 0),
(83, 5, 35, 0),
(84, 5, 35, 0),
(85, 5, 35, 0),
(86, 5, 35, 0),
(87, 47, 35, 0),
(88, 48, 36, 1),
(89, 49, 45, 1),
(90, 51, 38, 1),
(91, 50, 38, 1),
(92, 52, 15, 1),
(93, 53, 45, 1),
(94, 54, 32, 1),
(95, 55, 20, 1),
(96, 57, 25, 1),
(97, 56, 25, 1),
(98, 58, 20, 1),
(99, 59, 25, 1),
(100, 60, 35, 1),
(101, 61, 30, 1),
(102, 62, 35, 1),
(103, 63, 26, 1),
(104, 64, 26, 0),
(105, 65, 20, 1),
(106, 66, 26, 1),
(107, 67, 40, 0),
(108, 68, 45, 0),
(109, 69, 26, 0),
(110, 70, 25, 1),
(111, 71, 20, 0),
(112, 72, 16, 1),
(113, 73, 34, 1),
(114, 74, 30, 0),
(115, 75, 160, 1),
(116, 76, 25, 1),
(117, 77, 20, 1),
(118, 78, 50, 0),
(119, 79, 20, 1),
(120, 80, 30, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `subeler`
--

DROP TABLE IF EXISTS `subeler`;
CREATE TABLE IF NOT EXISTS `subeler` (
  `Sube_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Sube_Ad` varchar(150) COLLATE utf8_turkish_ci NOT NULL,
  `Sube_Adresi` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  `Sube_Muduru` varchar(150) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`Sube_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `subeler`
--

INSERT INTO `subeler` (`Sube_ID`, `Sube_Ad`, `Sube_Adresi`, `Sube_Muduru`) VALUES
(1, 'Konak', 'Kemeraltı Çarşısı, Erler Mahallesi, 895. Sk. No:12, 35250 Konak/İzmir', 'Melis Yılmaz'),
(2, 'Şirinyer', 'Hürriyet Mah, Mehmet Akif Cd. No:62/A, 35380 Buca/İzmir', 'Erhan Kızıl'),
(3, 'Karşıyaka', 'Nergiz, 6328 Sok. No:26, 35550 Karşıyaka/İzmir', 'Mehmet Aydın'),
(4, 'Bornova', 'Mevlana, 1702. Sk. No:13, 35050 Bornova/İzmir', 'Burak Demir'),
(5, 'İnciraltı', 'İnciraltı, İnciraltı Cd. No.67, 35330 Balçova/İzmir', 'Ece Defne Yılmaz'),
(6, 'Diğer', 'Diğer', 'Diğer');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `suruculer`
--

DROP TABLE IF EXISTS `suruculer`;
CREATE TABLE IF NOT EXISTS `suruculer` (
  `Surucu_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Surucu_ad` varchar(150) COLLATE utf8_turkish_ci NOT NULL,
  `Surucu_soyad` varchar(150) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`Surucu_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `suruculer`
--

INSERT INTO `suruculer` (`Surucu_ID`, `Surucu_ad`, `Surucu_soyad`) VALUES
(6, 'ali', 'yılmaz'),
(7, 'Fatih', 'Çetin'),
(8, 'Enes', 'Taşçı'),
(9, 'Taha', 'Candan'),
(10, 'Yiğit', 'Kılıç');

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `gonderim`
--
ALTER TABLE `gonderim`
  ADD CONSTRAINT `gonderim_ibfk_1` FOREIGN KEY (`Arac_ID`) REFERENCES `araclar` (`Arac_ID`),
  ADD CONSTRAINT `gonderim_ibfk_2` FOREIGN KEY (`Sube_ID`) REFERENCES `subeler` (`Sube_ID`),
  ADD CONSTRAINT `gonderim_ibfk_3` FOREIGN KEY (`Surucu_ID`) REFERENCES `suruculer` (`Surucu_ID`);

--
-- Tablo kısıtlamaları `gonderimsure`
--
ALTER TABLE `gonderimsure`
  ADD CONSTRAINT `gonderimsure_ibfk_1` FOREIGN KEY (`Gonderim_ID`) REFERENCES `gonderim` (`Gonderim_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
