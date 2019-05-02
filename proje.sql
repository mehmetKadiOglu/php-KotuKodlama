-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 03 May 2019, 00:50:12
-- Sunucu sürümü: 10.1.30-MariaDB
-- PHP Sürümü: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `proje`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `aromalar`
--

CREATE TABLE `aromalar` (
  `uzanti` varchar(100) NOT NULL,
  `aroma` varchar(19) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `aromalar`
--

INSERT INTO `aromalar` (`uzanti`, `aroma`, `stok`) VALUES
('image/proteinler/152136716525256.jpeg', 'Çikolata', 70),
('image/proteinler/152136716525256.jpeg', 'Çilek', 41),
('image/proteinler/152136716525463.jpeg', 'Tarcın', 3),
('image/proteinler/152136716525463.jpeg', 'Karamel', 3);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `begeni`
--

CREATE TABLE `begeni` (
  `numara` text NOT NULL,
  `begenenKullanici` varchar(50) NOT NULL,
  `durum` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `begeni`
--

INSERT INTO `begeni` (`numara`, `begenenKullanici`, `durum`) VALUES
('24', '4@outlook.com', '1'),
('24152657722284y1', '4@outlook.com', '0'),
('24', '1@outlook.com', '1'),
('241526577147288y115265771891y2', '4@outlook.com', '0'),
('24', 'admin@outlook.com', '1'),
('24152657722284y1', 'admin@outlook.com', '0'),
('241526577147288y115265771891y2', 'admin@outlook.com', '0');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `markalar`
--

CREATE TABLE `markalar` (
  `marka_kod` int(11) NOT NULL,
  `marka` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `markalar`
--

INSERT INTO `markalar` (`marka_kod`, `marka`) VALUES
(1, 'Weider'),
(2, 'Universal'),
(3, 'BE Sports'),
(4, 'Big Joy'),
(5, 'BSN'),
(6, 'Cellucor'),
(7, 'Dymatize'),
(8, 'Grenade'),
(9, 'Hardline'),
(10, 'Inkospor'),
(11, 'Multipower'),
(12, 'Musclemeds'),
(13, 'Musclepharm'),
(14, 'Muscletech'),
(15, 'Myprotein'),
(16, 'Nanox'),
(17, 'Nutrade'),
(18, 'Nutrend'),
(19, 'Olimp'),
(20, 'Optimum Nutrition'),
(21, 'Queen Fit'),
(22, 'Quest Nutrition'),
(23, 'Sci-Mx'),
(24, 'Scitec'),
(25, 'Stacker2 Europe'),
(26, 'Ultimate');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `musteriler`
--

CREATE TABLE `musteriler` (
  `Adi` varchar(30) CHARACTER SET utf8 NOT NULL,
  `Soyadi` varchar(30) CHARACTER SET utf8 NOT NULL,
  `Sifre` varchar(50) NOT NULL,
  `mail` varchar(40) CHARACTER SET utf8 NOT NULL,
  `Telefon` int(11) NOT NULL,
  `Cinsiyet` varchar(6) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `musteriler`
--

INSERT INTO `musteriler` (`Adi`, `Soyadi`, `Sifre`, `mail`, `Telefon`, `Cinsiyet`) VALUES
('Büşra', 'Gören', 'c4ca4238a0b923820dcc509a6f75849b', '10@outlook.com', 32, 'Kadın'),
('Büşra', 'Aras', 'c4ca4238a0b923820dcc509a6f75849b', '11@outlook.com', 32, 'Kadın'),
('Davur', 'Peker', 'c4ca4238a0b923820dcc509a6f75849b', '13@outlook.com', 32, 'Erkek'),
('Hatice', 'Yeşil', 'c4ca4238a0b923820dcc509a6f75849b', '1@outlook.com', 32, 'Kadın'),
('Hatice', 'çalışkan', 'c4ca4238a0b923820dcc509a6f75849b', '2@outlook.com', 52, 'Kadın'),
('Leman', 'Vonal', 'c4ca4238a0b923820dcc509a6f75849b', '4@outlook.com', 8, 'Kadın'),
('Admingeldi', 'Sdflşksdşfkds', 'c4ca4238a0b923820dcc509a6f75849b', '852@outlook.com', 3232, 'Erkek'),
('Sporcu Besinleri', 'Admin', 'c4ca4238a0b923820dcc509a6f75849b', 'admin@outlook.com', 2, 'Erkek');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `proteinler`
--

CREATE TABLE `proteinler` (
  `tur` varchar(18) NOT NULL,
  `fiyat` varchar(11) NOT NULL,
  `alimadeti` int(11) NOT NULL,
  `aciklama` text NOT NULL,
  `uzanti` varchar(100) NOT NULL,
  `cesit` varchar(20) DEFAULT NULL,
  `marka_kod` int(11) DEFAULT NULL,
  `skt` date DEFAULT NULL,
  `indirim` int(11) DEFAULT NULL,
  `satis` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `proteinler`
--

INSERT INTO `proteinler` (`tur`, `fiyat`, `alimadeti`, `aciklama`, `uzanti`, `cesit`, `marka_kod`, `skt`, `indirim`, `satis`) VALUES
('Protein', '289,00 TL', 110, 'Weider Premium Whey Protein Tozu 2300 Gr', 'image/proteinler/152136716525256.jpeg', 'Whey Protein', 1, NULL, NULL, 100),
('Protein', '149,00 TL', 5, 'Weider Gold Whey 908 Gr', 'image/proteinler/152136716525463.jpeg', 'Whey Protein', 1, NULL, NULL, 0),
('Protein', '239,00 TL', 5, 'Scitec Whey Professional Whey Protein 2350 Gr', 'image/proteinler/152136716526783.jpeg', 'Whey Protein', 24, NULL, NULL, 0),
('Protein', '229,00 TL', 5, 'Dymatize Elite Casein Protein 1818 Gr', 'image/proteinler/152136716532123.jpeg', 'Kazein', 7, NULL, NULL, 0),
('Protein', '239,00 TL', 5, 'Universal Animal Whey 1800 Gr', 'image/proteinler/152136716536682.jpeg', 'Whey Protein', 2, NULL, NULL, 0),
('Protein', '219,00 TL', 5, 'Nutrade Premium Protein 2250 Gr', 'image/proteinler/152136716537372.jpeg', 'Whey Protein', 17, NULL, NULL, 0),
('Protein', '229,00 TL', 5, 'Stacker Europe Whey Isolate 1500 Gram', 'image/proteinler/152136716538400.jpeg', 'İzole Protein', 25, NULL, NULL, 0),
('Protein', '10,00 TL', 5, 'Big Joy CLA Max Protein Bar 45 Gr', 'image/proteinler/152136716576847.png', 'Protein Bar', 4, NULL, NULL, 0),
('Protein', '79,00 TL', 5, 'Myprotein Peanut Butter 1000 gr', 'image/proteinler/152136716577078.jpeg', 'Protein Shake', 15, NULL, NULL, 0),
('Protein', '259,00 TL', 5, 'Nutrend Micellar Casein 2250 Gr', 'image/proteinler/152136716577151.jpeg', 'Kazein', 18, NULL, NULL, 0),
('Protein', '239,00 TL', 5, 'Big Joy Big Whey Protein 2244 Gr 68 Saşe', 'image/proteinler/152136716584263.png', 'Whey Protein', 4, NULL, NULL, 0),
('Protein', '350,00 TL', 5, 'Weider Double Bar Protein Bar 60 gr 24 Adet', 'image/proteinler/152136716587649.jpeg', 'Protein Bar', 1, NULL, NULL, 0),
('Protein', '309,00 TL', 5, 'Nutrade Premium Isolate Protein 2100 Gr', 'image/proteinler/152136716588310.jpeg', 'İzole Protein', 17, NULL, NULL, 0),
('Protein', '195,00 TL', 5, 'BSN DNA Series Whey Protein 1870 Gr', 'image/proteinler/152136716595105.jpeg', 'Whey Protein', 5, NULL, NULL, 0),
('Protein', '209,00 TL', 5, 'Weider CFM Whey Overload Protein 100% 908 Gr', 'image/proteinler/152136716597386.jpeg', 'İzole Protein', 1, NULL, NULL, 0),
('Protein', '159,00 TL', 5, 'Multipower %100 Pure Whey Protein 900 Gr', 'image/proteinler/152136874618712.jpeg', 'Whey Protein', 11, NULL, NULL, 0),
('Protein', '429,00 TL', 5, 'Optimum Gold Standard Whey Protein Tozu 4540 Gr', 'image/proteinler/152136874619541.jpeg', 'Whey Protein', 20, NULL, NULL, 0),
('Protein', '165,00 TL', 5, 'Sci-Mx Ultra Whey Protein 908 Gr', 'image/proteinler/152136874621219.jpeg', 'Whey Protein', 23, NULL, NULL, 0),
('Protein', '50,00 TL', 5, 'Nanox Carnilox Hydrolyzed Beef Protein Isolate 2000 Gr', 'image/proteinler/152136874636327.jpeg', 'Et Proteini', 16, NULL, NULL, 0),
('Protein', '189,00 TL', 5, 'Hardline Whey Zone 2300 Gr', 'image/proteinler/152136874657509.png', 'Kompleks Protein', 9, NULL, NULL, 0),
('Protein', '239,00 TL', 0, 'Optimum Gold Standard Casein 1818 Gr', 'image/proteinler/152136874660068.jpeg', 'Kazein', 20, NULL, NULL, 0),
('Protein', '299,00 TL', 0, 'Musclepharm Combat %100 Isolate Protein 2269 Gr', 'image/proteinler/152136874660170.png', 'İzole Protein', 13, NULL, NULL, 0),
('Protein', '179,00 TL', 0, 'Muscletech Nitrotech Performance 908 Gr', 'image/proteinler/152136874679671.jpeg', 'Whey Protein', 14, NULL, NULL, 0),
('Protein', '135,00 TL', 0, 'Optimum Gold Standard Whey 908 Gr', 'image/proteinler/152136874681798.jpeg', 'Whey Protein', 20, NULL, NULL, 0),
('Protein', '144,00 TL', 0, 'Grenade Carb Killa Protein Bar 60 Gr (12 Adet)', 'image/proteinler/152136874683095.png', 'Protein Bar', 8, NULL, NULL, 0),
('Protein', '269,00 TL', 0, 'Sci-Mx Whey Plus Hardcore Protein 2100 Gr', 'image/proteinler/152136874685143.jpeg', 'Whey Protein', 23, NULL, NULL, 0),
('Protein', '29,00 TL', 0, 'Big Joy Yer Fıstığı Ezmesi 360 Gr', 'image/proteinler/152136874689181.png', 'Protein Bar', 4, NULL, NULL, 0),
('Protein', '279,00 TL', 0, 'Optimum Platinum Hydrowhey 1590 Gram', 'image/proteinler/152136874693757.jpeg', 'İzole Protein', 20, NULL, NULL, 0),
('Protein', '269,00 TL', 0, 'Muscletech Essential Series Platinum %100 Casein 1700 Gr', 'image/proteinler/152136874696863.jpeg', 'Kazein', 14, NULL, NULL, 0),
('Protein', '219,00 TL', 0, 'Hardline Casein Matrix 1800 Gr', 'image/proteinler/152136874699759.jpeg', 'Kazein', 9, NULL, NULL, 0),
('Protein', '309,00 TL', 0, 'Muscletech Iso Zero % 100 Whey Protein Isolate 1816 Gr', 'image/proteinler/152137032412569.jpeg', 'Whey Protein', 14, NULL, NULL, 0),
('Protein', '239,00 TL', 0, 'Optimum Gold Standard Whey Protein Tozu 2273 Gr', 'image/proteinler/152137032417211.png', 'Whey Protein', 20, NULL, NULL, 0),
('Protein', '249,00 TL', 0, 'Musclepharm Combat Powder 2269 Gr', 'image/proteinler/152137032436507.jpeg', 'Whey Protein', 13, NULL, NULL, 0),
('Protein', '225,00 TL', 0, 'Nanox Protilox Whey 2000 Gr', 'image/proteinler/152137032452849.jpeg', 'Whey Protein', 16, NULL, NULL, 0),
('Protein', '239,00 TL', 0, 'Inkospor X-Treme Muscle 95 Protein 1800 Gr', 'image/proteinler/152173905111825.jpeg', 'Kazein', 10, NULL, NULL, 0),
('Protein', '109,00 TL', 0, 'Queen Fit Sweet Dreams Lady Protein Shake 750 Gr', 'image/proteinler/152173905117868.png', 'Kompleks Protein', 21, NULL, NULL, 0),
('Protein', '125,00 TL', 0, 'Nutrend Whey Core 100 Protein 1000 Gr', 'image/proteinler/152173905134758.jpeg', 'Whey Protein', 18, NULL, NULL, 0),
('Protein', '219,00 TL', 0, 'Nutrend Whey Core 100 Protein 2250 Gr', 'image/proteinler/152173905145754.jpeg', 'Whey Protein', 18, NULL, NULL, 0),
('Protein', '229,00 TL', 0, 'Ultimate Prostar %100 Whey 2390 Gr', 'image/proteinler/152173905160721.png', 'Whey Protein', 26, NULL, NULL, 0),
('Protein', '299,00 TL', 0, 'Olimp Pure Whey Protein Isolate 2200 Gr', 'image/proteinler/152173905166535.png', 'İzole Protein', 19, NULL, NULL, 0),
('Protein', '239,00 TL', 0, 'Ultimate Carnebolic Hydrolyzed Beef Protein Isolate 1680 Gr', 'image/proteinler/152173905166931.png', 'Et Proteini', 26, NULL, NULL, 0),
('Protein', '249,00 TL', 0, 'Muscletech Nitrotech Performance 1816 Gr', 'image/proteinler/152173905192692.jpeg', 'Whey Protein', 14, NULL, NULL, 0),
('Protein', '109,00 TL', 0, 'Queen Fit Good Morning Lady Protein Shake 720 Gr', 'image/proteinler/152173905197405.png', 'Whey Protein', 21, NULL, NULL, 0),
('Protein', '109,00 TL', 0, 'Olimp Whey Protein 700 Gr', 'image/proteinler/152173905198767.jpeg', 'Whey Protein', 19, NULL, NULL, 0),
('Protein', '239,00 TL', 0, 'Muscletech Premium Whey Protein 2270 Gr', 'image/proteinler/152173905199538.jpeg', 'Whey Protein', 14, NULL, NULL, 0),
('Protein', '239,00 TL', 0, 'Inkospor X-Treme Whey 2000 Gr', 'image/proteinler/152174089130840.jpeg', 'Whey Protein', 10, NULL, NULL, 0),
('Protein', '90,00 TL', 0, 'Multipower Formula 80 Evo 510 Gr', 'image/proteinler/152174089155948.jpeg', 'Kompleks Protein', 11, NULL, NULL, 0),
('Protein', '180,00 TL', 0, 'Olimp Twister Hi Protein Bar 60 Gr (24 Adet)', 'image/proteinler/152174089157890.jpeg', 'Protein Bar', 19, NULL, NULL, 0),
('Protein', '139,32 TL', 0, 'Quest Protein Bar 60 Gr (12 Adet)', 'image/proteinler/152174089159551.jpeg', 'Protein Bar', 22, NULL, NULL, 0),
('Protein', '279,00 TL', 0, 'Olimp Whey Protein 2200 Gr', 'image/proteinler/152174089160553.png', 'Kompleks Protein', 19, NULL, NULL, 0),
('Protein', '289,00 TL', 0, 'Multipower %100 Pure Whey Protein 2000 Gr', 'image/proteinler/152174089165429.jpeg', 'Whey Protein', 11, NULL, NULL, 0),
('Protein', '309,00 TL', 0, 'Multipower %100 Whey Isolate Protein 2000 Gr', 'image/proteinler/152174089169739.jpeg', 'İzole Protein', 11, NULL, NULL, 0),
('Protein', '130,00 TL', 0, 'Big Joy L-Carnitine Protein Bar 35 Gr (24 Adet)', 'image/proteinler/152174089174700.png', 'Protein Bar', 4, NULL, NULL, 0),
('Protein', '219,00 TL', 0, 'Hardline Whey 3Matrix 2300 Gr', 'image/proteinler/152174089178239.jpeg', 'Kompleks Protein', 9, NULL, NULL, 0),
('Protein', '264,00 TL', 0, 'Grenade Hydra 6 Ultra Premium Protein Isolate 1816 Gr', 'image/proteinler/152174089181687.jpeg', 'İzole Protein', 8, NULL, NULL, 0),
('Protein', '239,00 TL', 0, 'Musclemeds Carnivor Protein 2088 Gr', 'image/proteinler/152174089182237.jpeg', 'Et Proteini', 12, NULL, NULL, 0),
('Protein', '109,00 TL', 0, 'Hardline Whey 3Matrix 908 Gr', 'image/proteinler/152174089182316.jpeg', 'Kompleks Protein', 9, NULL, NULL, 0),
('Protein', '289,00 TL', 0, 'Sci-Mx Ultra Whey Protein 2280 Gr', 'image/proteinler/152174089184160.png', 'Whey Protein', 23, NULL, NULL, 0),
('Protein', '189,00 TL', 0, 'Musclepharm Coco Protein Drink 355 ML (12 Adet)', 'image/proteinler/152174089185514.jpeg', 'Protein Shake', 13, NULL, NULL, 0),
('Protein', '59,00 TL', 0, 'High Protein Hazır İçecek 200 ML (6 Adet)', 'image/proteinler/152174089196682.jpeg', 'Protein Shake', NULL, NULL, NULL, 0),
('Protein', '229,00 TL', 0, 'Myprotein Impact Whey Protein 2500gr', 'image/proteinler/152174305114541.jpeg', 'Whey Protein', 15, NULL, NULL, 0),
('Protein', '99,76 TL', 0, 'Dymatize Elite Fusion 7 Protein 908 Gr', 'image/proteinler/152174305121669.jpeg', 'Kompleks Protein', 7, NULL, NULL, 0),
('Protein', '118,00 TL', 0, 'Big Joy Classic Protein Bar 65 Gr (12 Adet)', 'image/proteinler/152174305124268.png', 'Protein Bar', 4, NULL, NULL, 0),
('Protein', '289,00 TL', 0, 'Myprotein Impact Whey Isolate 2500gr', 'image/proteinler/152174305124488.jpeg', 'İzole Protein', 15, NULL, NULL, 0),
('Protein', '96,00 TL', 0, 'Big Joy Xtend BCAA Protein Bar (12 Adet)', 'image/proteinler/152174305133848.png', 'Protein Bar', 4, NULL, NULL, 0),
('Protein', '309,00 TL', 0, 'Muscletech Nitrotech %100 Whey Gold Protein 2721 Gr', 'image/proteinler/152174305134591.jpeg', 'Whey Protein', 14, NULL, NULL, 0),
('Protein', '132,00 TL', 0, 'Big Joy Gourmet Protein Bar 35 Gr (24 Adet)', 'image/proteinler/152174305146436.png', 'Protein Bar', 4, NULL, NULL, 0),
('Protein', '219,00 TL', 0, 'Bsn Syntha-6 Isolate Protein 1820 Gr', 'image/proteinler/152174305151750.jpeg', 'İzole Protein', 5, NULL, NULL, 0),
('Protein', '149,00 TL', 0, 'Be Sports Casein Matrix 900 Gr', 'image/proteinler/152174305157207.jpeg', 'Kazein', 3, NULL, NULL, 0),
('Protein', '179,00 TL', 0, 'BSN Syntha-6 Edge 1870 Gr', 'image/proteinler/152174305157657.jpeg', 'Kompleks Protein', 5, NULL, NULL, 0),
('Protein', '285,00 TL', 0, 'Cellucor Cor-Performance Whey 1820 Gr', 'image/proteinler/152174305163901.jpeg', 'Whey Protein', 6, NULL, NULL, 0),
('Protein', '109,00 TL', 0, 'Myprotein Impact Whey Protein 1000 gr', 'image/proteinler/152174305169761.jpeg', 'Whey Protein', 15, NULL, NULL, 0),
('Protein', '230,00 TL', 0, 'High Protein Hazır İçecek 200 ML (24 Adet)', 'image/proteinler/152174305187361.jpeg', 'Protein Shake', NULL, NULL, NULL, 0),
('Protein', '180,00 TL', 0, 'Multipower Power Pack XXL Classic 60 Gr (24 Adet)', 'image/proteinler/152174305194010.jpeg', 'Protein Bar', 11, NULL, NULL, 0),
('Protein', '108,91 TL', 0, 'Dymatize Elite Casein 908 Gr', 'image/proteinler/152174305199046.jpeg', 'Kazein', 7, NULL, NULL, 0),
('Protein', '121,00 TL', 0, 'Ultimate Isocool Peachy Peach', 'image/proteinler/152174405812445.jpeg', 'İzole Protein', 26, NULL, NULL, 0),
('Protein', '154,00 TL', 0, 'Universal Casein Pro 908 Gr', 'image/proteinler/152174405821272.jpeg', 'Kazein', 2, NULL, NULL, 0),
('Protein', '99,00 TL', 0, 'Scitec Protein Pancake 1036 Gr', 'image/proteinler/152174405825482.jpeg', 'Whey Protein', 24, NULL, NULL, 0),
('Protein', '279,00 TL', 0, 'Weider Pure Casein 1800 Gr', 'image/proteinler/152174405836061.jpeg', 'Kazein', 1, NULL, NULL, 0),
('Protein', '237,00 TL', 0, 'Universal Casein Pro 1816 Gr', 'image/proteinler/152174405838048.jpeg', 'Kazein', 2, NULL, NULL, 0),
('Protein', '144,00 TL', 0, 'Ultimate Carnebolic Hydrolyzed Beef Protein Isolate 840 Gr', 'image/proteinler/152174405841291.png', 'Et Proteini', 26, NULL, NULL, 0),
('Protein', '309,00 TL', 0, 'Weider 100% Whey 2270 Gr (USA)', 'image/proteinler/152174405848114.jpeg', 'Whey Protein', 1, NULL, NULL, 0),
('Protein', '280,00 TL', 0, 'Ultimate Isocool 2270 Gr', 'image/proteinler/152174405861512.png', 'İzole Protein', 26, NULL, NULL, 0),
('Protein', '195,00 TL', 0, 'Scitec Whey Protein 2350 Gr', 'image/proteinler/152174405867968.jpeg', 'Whey Protein', 24, NULL, NULL, 0),
('Protein', '80,00 TL', 0, 'Weider Premium Whey Protein Tozu 500 Gr', 'image/proteinler/152174405884553.jpeg', 'Whey Protein', 1, NULL, NULL, 0),
('Protein', '389,00 TL', 0, 'Sci-Mx Whey Plus Hardcore Protein 3600 Gr', 'image/proteinler/152174405886889.jpeg', 'Whey Protein', 23, NULL, NULL, 0),
('Protein', '309,00 TL', 0, 'Weider Power Whey Protein 3178 Gr', 'image/proteinler/152174405888304.jpeg', 'Whey Protein', 1, NULL, NULL, 0),
('Protein', '160,00 TL', 0, 'Multipower Staybol Protein 900 Gr', 'image/proteinler/152174405888750.jpeg', 'Kompleks Protein', 11, NULL, NULL, 0),
('Protein', '89,00 TL', 0, 'Weider Gold Whey 500 Gr', 'image/proteinler/152174405890281.jpeg', 'Whey Protein', 1, NULL, NULL, 0),
('Protein', '169,00 TL', 0, 'Weider Whey Protein Tozu 908 Gr', 'image/proteinler/152174405895610.jpeg', 'Whey Protein', 1, NULL, NULL, 0),
('Amino Asit', '116,10 TL', 0, 'Grenade Glutamine %100 Pure L-Glutamine 500 Gr', 'image/proteinler/152657180926985.png', 'Glutamin', 8, NULL, NULL, 0),
('Amino Asit', '119,00 TL', 0, 'Muscletech Essential Series Platinum %100 Ultra-Pure Micronized Glutamine 302 Gr', 'image/proteinler/152657180929505.jpeg', 'Glutamin', 14, NULL, NULL, 0),
('Amino Asit', '159,00 TL', 0, 'Olimp Glutamine XPlode 500 Gr', 'image/proteinler/152657180930646.jpeg', 'Glutamin', 19, NULL, NULL, 0),
('Amino Asit', '159,00 TL', 0, 'Sci-Mx Glutamine Powder 500 Gr', 'image/proteinler/152657180932019.jpeg', 'Glutamin', 23, NULL, NULL, 0),
('Amino Asit', '93,00 TL', 0, 'Nutrend Glutamine 300 Gr', 'image/proteinler/152657180933252.jpeg', 'Glutamin', 18, NULL, NULL, 0),
('Amino Asit', '135,00 TL', 0, 'Optimum Glutamine Powder 630 Gr', 'image/proteinler/152657180946939.jpeg', 'Glutamin', 20, NULL, NULL, 0),
('Amino Asit', '115,00 TL', 0, 'Nutrade L-Glutamine 700 Gr', 'image/proteinler/152657180948760.jpeg', 'Glutamin', 17, NULL, NULL, 0),
('Amino Asit', '99,00 TL', 0, 'Hardline Glutapure 500 Gr', 'image/proteinler/152657180951085.jpeg', 'Glutamin', 9, NULL, NULL, 0),
('Amino Asit', '89,00 TL', 0, 'BSN Amino X 435 Gr', 'image/proteinler/152657180951909.jpeg', 'BCAA', 5, NULL, NULL, 0),
('Amino Asit', '75,00 TL', 0, 'Big Joy Gluta Big %100 Glutamine Powder 300 Gr', 'image/proteinler/152657180953929.png', 'Glutamin', 4, NULL, NULL, 0),
('Amino Asit', '159,00 TL', 0, 'Multipower L-Glutamine 500 G', 'image/proteinler/152657180966869.jpeg', 'Glutamin', 11, NULL, NULL, 0),
('Amino Asit', '125,00 TL', 0, 'Hardline BCAA Fusion 500 Gr', 'image/proteinler/152657180968734.png', 'BCAA', 9, NULL, NULL, 0),
('Amino Asit', '54,00 TL', 0, 'Hardline Glutapure 120 Kapsül', 'image/proteinler/152657180999625.png', 'Glutamin', 9, NULL, NULL, 0),
('Kilo ve Hacim', '280,00', 0, 'Muscletech Premium Mass Gainer 5440 Gr', 'image/proteinler/152657972633567.jpeg', NULL, 14, NULL, NULL, 0),
('Kilo ve Hacim', '170,00', 0, 'Optimum Serious Mass 2727 Gr', 'image/proteinler/152658018912748.jpeg', NULL, 20, NULL, NULL, 0),
('Kilo ve Hacim', '249,00', 0, 'Optimum Gold Standard Gainer 3250 Gr', 'image/proteinler/152658018914325.jpeg', NULL, 20, NULL, NULL, 0),
('Kilo ve Hacim', '220,00', 0, 'Big Joy Big Mass 5000 Gr 50 Saşe', 'image/proteinler/152658018915236.jpeg', NULL, 4, NULL, NULL, 0),
('Kilo ve Hacim', '175,00', 0, 'Weider Mega Mass 2000 3000 Gr', 'image/proteinler/152658018929075.jpeg', NULL, 1, NULL, NULL, 0),
('Kilo ve Hacim', '240,00', 0, 'Muscletech Mass Tech Performance 3180 Gr', 'image/proteinler/152658018935928.jpeg', NULL, 14, NULL, NULL, 0),
('Kilo ve Hacim', '240,00', 0, 'Optimum Serious Mass 5450 Gr', 'image/proteinler/152658018944917.jpeg', NULL, 20, NULL, NULL, 0),
('Kilo ve Hacim', '400,00', 0, 'Multipower Mass Gainer 5440 Gr', 'image/proteinler/152658018945306.jpeg', NULL, 11, NULL, NULL, 0),
('Kilo ve Hacim', '149,00', 0, 'Big Joy Big Mass 3000 Gr 30 Saşe', 'image/proteinler/152658018959115.png', NULL, 4, NULL, NULL, 0),
('Kilo ve Hacim', '239,00', 0, 'Dymatize Super Mass Gainer 5443 Gr', 'image/proteinler/152658018959544.jpeg', NULL, 7, NULL, NULL, 0),
('Kilo ve Hacim', '500,00', 0, 'Weider Mega Mass 4000 7000 Gr', 'image/proteinler/152658018964569.jpeg', NULL, 1, NULL, NULL, 0),
('Kilo ve Hacim', '80,00', 0, 'Big Joy Big Mass 1600 Gr 16 Saşe', 'image/proteinler/152658018975419.png', NULL, 4, NULL, NULL, 0),
('Kilo ve Hacim', '120,00', 0, 'Hardline Progainer 1406 Gr', 'image/proteinler/152658018984808.jpeg', NULL, 9, NULL, NULL, 0),
('Kilo ve Hacim', '80,00', 0, 'Olimp Gain Bolic 6000 1000 Gr', 'image/proteinler/152658018991651.jpeg', NULL, 19, NULL, NULL, 0),
('Kilo ve Hacim', '150,00', 0, 'Weider Crash Weight Gain 1500 Gr', 'image/proteinler/152658018997570.jpeg', NULL, 1, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparisler`
--

CREATE TABLE `siparisler` (
  `id` varchar(100) DEFAULT NULL,
  `miktar` int(11) DEFAULT NULL,
  `aroma` varchar(20) DEFAULT NULL,
  `tarih` datetime DEFAULT NULL,
  `durum` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `siparisler`
--

INSERT INTO `siparisler` (`id`, `miktar`, `aroma`, `tarih`, `durum`) VALUES
('image/proteinler/152136716526783.jpeg', 1, '', '2018-07-11 10:56:13', '0'),
('image/proteinler/152136716525256.jpeg', 1, 'Çikolata', '2018-08-24 15:26:20', '0');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumlar`
--

CREATE TABLE `yorumlar` (
  `uzanti` varchar(60) NOT NULL,
  `yorum` text NOT NULL,
  `yorumTarihi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `yorumYapan` varchar(23) NOT NULL,
  `numara` int(11) NOT NULL,
  `altYorum` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `yorumlar`
--

INSERT INTO `yorumlar` (`uzanti`, `yorum`, `yorumTarihi`, `yorumYapan`, `numara`, `altYorum`) VALUES
('image/proteinler/152136716525256.jpeg', 'Bu protein tozu için bu kadar fiyat verilmesi çok yanlış. Aşırı derecede pahalı.Bu protein tozu için bu kadar fiyat verilmesi çok yanlış. Aşırı derecede pahalı.Bu protein tozu için bu kadar fiyat verilmesi çok yanlış. Aşırı derecede pahalı.Bu protein tozu için bu kadar fiyat verilmesi çok yanlış. Aşırı derecede pahalı.Bu protein tozu için bu kadar fiyat verilmesi çok yanlış. Aşırı derecede pahalı.Bu protein tozu için bu kadar fiyat verilmesi çok yanlış. Aşırı derecede pahalı.Bu protein tozu için bu kadar fiyat verilmesi çok yanlış. Aşırı derecede pahalı', '2018-05-17 17:23:30', 'Hatice Yeşil', 24, ''),
('image/proteinler/152136716525256.jpeg', 'Bencede çok haklısınız', '2018-05-17 20:12:36', 'Hatice çalışkan', 31, '241526577147288y1'),
('image/proteinler/152136716525256.jpeg', 'deneme 2', '2018-05-17 20:13:18', 'Büşra Gören', 32, '241526577147288y115265771891y2'),
('image/proteinler/152136716525256.jpeg', 'İçinde izole whey var', '2018-05-17 20:13:52', 'Sporcu Besinleri Admin', 33, '24152657722284y1'),
('image/proteinler/152136716525256.jpeg', 'dnjj', '2018-08-24 14:57:55', 'Hatice Yeşil', 34, '24152657722284y1153511183985y2');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `aromalar`
--
ALTER TABLE `aromalar`
  ADD KEY `FK_Aroma` (`uzanti`);

--
-- Tablo için indeksler `markalar`
--
ALTER TABLE `markalar`
  ADD PRIMARY KEY (`marka_kod`);

--
-- Tablo için indeksler `musteriler`
--
ALTER TABLE `musteriler`
  ADD PRIMARY KEY (`mail`);

--
-- Tablo için indeksler `proteinler`
--
ALTER TABLE `proteinler`
  ADD PRIMARY KEY (`uzanti`),
  ADD KEY `FK_numara` (`marka_kod`);

--
-- Tablo için indeksler `siparisler`
--
ALTER TABLE `siparisler`
  ADD KEY `fk_numsd` (`id`);

--
-- Tablo için indeksler `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD PRIMARY KEY (`numara`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `markalar`
--
ALTER TABLE `markalar`
  MODIFY `marka_kod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Tablo için AUTO_INCREMENT değeri `yorumlar`
--
ALTER TABLE `yorumlar`
  MODIFY `numara` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `aromalar`
--
ALTER TABLE `aromalar`
  ADD CONSTRAINT `FK_Aroma` FOREIGN KEY (`uzanti`) REFERENCES `proteinler` (`uzanti`);

--
-- Tablo kısıtlamaları `proteinler`
--
ALTER TABLE `proteinler`
  ADD CONSTRAINT `FK_numara` FOREIGN KEY (`marka_kod`) REFERENCES `markalar` (`marka_kod`);

--
-- Tablo kısıtlamaları `siparisler`
--
ALTER TABLE `siparisler`
  ADD CONSTRAINT `fk_numsd` FOREIGN KEY (`id`) REFERENCES `proteinler` (`uzanti`);

DELIMITER $$
--
-- Olaylar
--
CREATE DEFINER=`root`@`localhost` EVENT `satis_azaltma` ON SCHEDULE EVERY 30 MINUTE STARTS '2018-05-17 13:24:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE proteinler p, siparisler pp SET p.satis = p.satis-pp.miktar WHERE pp.id = p.uzanti AND pp.tarih<now() AND pp.durum='0'$$

CREATE DEFINER=`root`@`localhost` EVENT `siparis_silme` ON SCHEDULE EVERY 34 MINUTE STARTS '2018-05-17 13:24:00' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM siparisler WHERE tarih<now()$$

CREATE DEFINER=`root`@`localhost` EVENT `aroma_tablosuna_ekleme` ON SCHEDULE EVERY 30 MINUTE STARTS '2018-05-17 13:24:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE aromalar p, siparisler pp SET p.stok = p.stok+pp.miktar WHERE pp.id = p.uzanti AND pp.tarih<now() AND pp.durum='0'$$

CREATE DEFINER=`root`@`localhost` EVENT `proteinler_tablosuna_miktar_ekleme` ON SCHEDULE EVERY 30 MINUTE STARTS '2018-05-17 13:24:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE proteinler INNER JOIN siparisler ON proteinler.uzanti=siparisler.id SET proteinler.alimadeti=proteinler.alimadeti+siparisler.miktar WHERE siparisler.tarih <now() AND siparisler.durum='0'$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
