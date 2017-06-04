-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 27, 2017 at 11:49 AM
-- Server version: 5.6.34-log
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `home_made_food`
--

-- --------------------------------------------------------

--
-- Table structure for table `adresa`
--

CREATE TABLE IF NOT EXISTS `adresa` (
  `id` int(11) NOT NULL,
  `shteti` int(11) NOT NULL,
  `qyteti` int(11) NOT NULL,
  `adresa` varchar(80) NOT NULL,
  `lat` float(10,6) DEFAULT NULL,
  `lng` float(10,6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kategoria`
--

CREATE TABLE IF NOT EXISTS `kategoria` (
  `id` int(11) NOT NULL,
  `emri` varchar(50) NOT NULL,
  `parent` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategoria`
--

INSERT INTO `kategoria` (`id`, `emri`, `parent`) VALUES
(1, 'gjellera', NULL),
(2, 'Gullash', 1),
(3, 'Pasul', 1),
(6, 'pasul me mish', 3),
(7, 'me mish viqi', 6);

-- --------------------------------------------------------

--
-- Table structure for table `kerkesa`
--

CREATE TABLE IF NOT EXISTS `kerkesa` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `shpallja` int(11) NOT NULL,
  `data_koha` datetime NOT NULL,
  `eaprovuar` enum('PO','JO') DEFAULT NULL,
  `pershkrimi` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `qyteti`
--

CREATE TABLE IF NOT EXISTS `qyteti` (
  `id` int(11) NOT NULL,
  `emri` varchar(80) NOT NULL,
  `shteti` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qyteti`
--

INSERT INTO `qyteti` (`id`, `emri`, `shteti`) VALUES
(1, 'Prishtina', 1),
(2, 'Mitrovica', 1),
(3, 'Prizreni', 1),
(4, 'Peja', 1),
(5, 'Tirana', 2),
(6, 'Durres', 2);

-- --------------------------------------------------------

--
-- Table structure for table `raportim`
--

CREATE TABLE IF NOT EXISTS `raportim` (
  `id` int(11) NOT NULL,
  `raportuesi` int(11) NOT NULL,
  `shpallja` int(11) NOT NULL,
  `Arsya` text NOT NULL,
  `data_raportimit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `shpallja` int(11) NOT NULL,
  `koment` text,
  `rating` enum('1','2','3','4','5') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roli`
--

CREATE TABLE IF NOT EXISTS `roli` (
  `id` int(11) NOT NULL,
  `roli` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roli`
--

INSERT INTO `roli` (`id`, `roli`) VALUES
(1, 'user'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `shpallja`
--

CREATE TABLE IF NOT EXISTS `shpallja` (
  `id` int(11) NOT NULL,
  `titulli` varchar(50) NOT NULL,
  `short_pershkrimi` varchar(150) NOT NULL,
  `pershkrimi` text,
  `user` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `eshtepublike` enum('PO','JO') NOT NULL DEFAULT 'PO',
  `eaprovuar` enum('JO','PO') NOT NULL DEFAULT 'JO',
  `cmimi` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shpallja`
--

INSERT INTO `shpallja` (`id`, `titulli`, `short_pershkrimi`, `pershkrimi`, `user`, `created_date`, `eshtepublike`, `eaprovuar`, `cmimi`) VALUES
(1, 'Gullash ', 'Gullash i klasit te pare', 'Gullash Gullash Gullash Gullash Gullash Gullash Gullash Gullash Gullash Gullash Gullash Gullash Gullash Gullash Gullash Gullash Gullash Gullash Gullash Gullash Gullash Gullash Gullash Gullash Gullash Gullash', 50, '2017-05-15 21:23:51', 'PO', 'JO', 4),
(2, 'Pasul', 'Pasul me mishe', 'Pasul dsknsdhndjfhjdfhfdhndfjh', 47, '2017-05-23 17:50:40', 'PO', 'PO', 3),
(3, 'Laknure', 'laknur i sapo dalun prej furre', 'laknur i sapo dalun prej furrelaknur i sapo dalun prej furrelaknur i sapo dalun prej furrelaknur i sapo dalun prej furrelaknur i sapo dalun prej furrelaknur i sapo dalun prej furrelaknur i sapo dalun prej furre', 47, '2017-05-15 19:47:55', 'PO', 'JO', 1),
(4, 'Fli me Saq', 'Fli e pjekun me saq e me maz', 'agsdgdsgsd ', 47, '2017-05-15 19:47:55', 'PO', 'JO', 10),
(5, 'testtt', 'agagagag', '', 47, '2017-05-19 12:51:15', 'PO', 'JO', 1),
(6, 'agasg', 'sdgdsg', '', 50, '2017-05-19 07:23:46', 'PO', 'JO', 21),
(7, 'afafa', 'afaf', '', 47, '2017-05-19 07:24:38', 'PO', 'JO', 12),
(8, 'agag', 'agag', '', 47, '2017-05-19 07:24:58', 'PO', 'JO', 121),
(9, 'sdgdsg', 'sdgsdg', 'sdgd', 47, '2017-05-19 07:24:58', 'PO', 'JO', 222),
(20, 'Bakllava', 'bakllava bakllava bakllava', 'bakllava', 50, '2017-05-20 12:04:03', 'PO', 'JO', 15),
(21, 'krelane', 'krelane krelane test', '', 50, '2017-05-20 12:04:39', 'PO', 'JO', 6),
(22, 'Pite me spinaq', 'thjesht pite', '', 50, '2017-05-20 12:07:51', 'PO', 'JO', 8);

-- --------------------------------------------------------

--
-- Table structure for table `shpallja_ditet`
--

CREATE TABLE IF NOT EXISTS `shpallja_ditet` (
  `id` int(11) NOT NULL,
  `shpallja` int(11) NOT NULL,
  `dita` tinyint(1) NOT NULL,
  `prej` time DEFAULT NULL,
  `deri` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shpallja_gallery`
--

CREATE TABLE IF NOT EXISTS `shpallja_gallery` (
  `id` int(11) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `shpallja` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shpallja_gallery`
--

INSERT INTO `shpallja_gallery` (`id`, `foto`, `shpallja`) VALUES
(1, 'gullash.jpg', 1),
(2, 'pasul.jpg', 2),
(3, 'laknur.jpg', 3),
(4, 'fli.jpg', 4),
(7, '1495281843.jpg', 20),
(8, '1495281880.jpg', 21),
(9, '1495282071.jpg', 22);

-- --------------------------------------------------------

--
-- Table structure for table `shpallja_kategoria`
--

CREATE TABLE IF NOT EXISTS `shpallja_kategoria` (
  `shpallja` int(11) NOT NULL,
  `kategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shteti`
--

CREATE TABLE IF NOT EXISTS `shteti` (
  `id` int(11) NOT NULL,
  `emri` varchar(80) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shteti`
--

INSERT INTO `shteti` (`id`, `emri`) VALUES
(1, 'Kosova'),
(2, 'Shqiperia');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `emri` varchar(50) NOT NULL,
  `mbiemri` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telefoni1` int(11) DEFAULT NULL,
  `telefoni2` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gjinia` enum('M','F') DEFAULT NULL,
  `data_lindjes` date DEFAULT NULL,
  `pershkrimi` text,
  `foto` varchar(100) DEFAULT NULL,
  `profesioni` varchar(50) DEFAULT NULL,
  `aktiv` enum('PO','JO') NOT NULL DEFAULT 'JO',
  `roli` int(11) NOT NULL DEFAULT '1',
  `adresa` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `emri`, `mbiemri`, `email`, `password`, `telefoni1`, `telefoni2`, `created_date`, `gjinia`, `data_lindjes`, `pershkrimi`, `foto`, `profesioni`, `aktiv`, `roli`, `adresa`) VALUES
(47, 'Agron', 'Ajvazi', 'aa33562@ubt-uni.net', '$2y$10$9NyRCU70iXjf6RHNNPBZ9eHQzBFVF64OguZAmTR36ZrITLC0UUMvy', 44123456, 0, '2017-05-15 19:44:27', 'M', '1994-12-24', NULL, '1494877467.jpg', NULL, 'PO', 2, NULL),
(50, 'Artan', 'Ajvazi', 'artanajvazi@msn.com', '$2y$10$OpqQapqvy/2B1u6Z7Uw1guoEZnIDKO.w5rVm7LSWGpOlsAr5r5KkO', NULL, NULL, '2017-05-15 21:20:15', NULL, NULL, NULL, NULL, NULL, 'JO', 1, NULL),
(51, 'Filan', 'Fisteku', 'fil@fist.tek', '$2y$10$OWhrqcGE1UKavpWbWSxijedNKMpNca1ftXURpKf7Te9C1TbeJ24Z.', 44959656, 0, '2017-05-27 09:07:44', 'M', '1992-02-01', NULL, '1495876064.', NULL, 'PO', 1, NULL),
(52, 'Naser', 'Hoti', 'naser@hoti.hot', '$2y$10$drqp8msuxf20hWxorvPEPuS9HhtrXhvO0DpqjeIEgnlAFgDiWTGNm', 44555478, 0, '2017-05-27 09:10:06', 'M', '1994-04-05', NULL, '1495876207.', NULL, 'PO', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_ban`
--

CREATE TABLE IF NOT EXISTS `user_ban` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `moderator` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `arsya` text NOT NULL,
  `isbanned` enum('PO','JO') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adresa`
--
ALTER TABLE `adresa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shteti` (`shteti`),
  ADD KEY `qyteti` (`qyteti`);

--
-- Indexes for table `kategoria`
--
ALTER TABLE `kategoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent` (`parent`);

--
-- Indexes for table `kerkesa`
--
ALTER TABLE `kerkesa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `shpallja` (`shpallja`);

--
-- Indexes for table `qyteti`
--
ALTER TABLE `qyteti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shteti` (`shteti`);

--
-- Indexes for table `raportim`
--
ALTER TABLE `raportim`
  ADD PRIMARY KEY (`id`),
  ADD KEY `raportuesi` (`raportuesi`),
  ADD KEY `shpallja` (`shpallja`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `shpallja` (`shpallja`);

--
-- Indexes for table `roli`
--
ALTER TABLE `roli`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shpallja`
--
ALTER TABLE `shpallja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD FULLTEXT KEY `titulli` (`titulli`);
ALTER TABLE `shpallja`
  ADD FULLTEXT KEY `short_pershkrimi` (`short_pershkrimi`);
ALTER TABLE `shpallja`
  ADD FULLTEXT KEY `titulli_2` (`titulli`);
ALTER TABLE `shpallja`
  ADD FULLTEXT KEY `short_pershkrimi_2` (`short_pershkrimi`);
ALTER TABLE `shpallja`
  ADD FULLTEXT KEY `titulli_3` (`titulli`,`short_pershkrimi`);
ALTER TABLE `shpallja`
  ADD FULLTEXT KEY `kerko` (`titulli`,`short_pershkrimi`);

--
-- Indexes for table `shpallja_ditet`
--
ALTER TABLE `shpallja_ditet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shpallja` (`shpallja`);

--
-- Indexes for table `shpallja_gallery`
--
ALTER TABLE `shpallja_gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shpallja` (`shpallja`);

--
-- Indexes for table `shpallja_kategoria`
--
ALTER TABLE `shpallja_kategoria`
  ADD PRIMARY KEY (`kategoria`,`shpallja`),
  ADD KEY `kategoria` (`kategoria`),
  ADD KEY `shpallja` (`shpallja`),
  ADD KEY `kategoria_2` (`kategoria`);

--
-- Indexes for table `shteti`
--
ALTER TABLE `shteti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `telefoni1` (`telefoni1`),
  ADD KEY `roli` (`roli`),
  ADD KEY `adresa` (`adresa`);

--
-- Indexes for table `user_ban`
--
ALTER TABLE `user_ban`
  ADD PRIMARY KEY (`id`),
  ADD KEY `moderator` (`moderator`),
  ADD KEY `user` (`user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adresa`
--
ALTER TABLE `adresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kategoria`
--
ALTER TABLE `kategoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `kerkesa`
--
ALTER TABLE `kerkesa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `qyteti`
--
ALTER TABLE `qyteti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `raportim`
--
ALTER TABLE `raportim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roli`
--
ALTER TABLE `roli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `shpallja`
--
ALTER TABLE `shpallja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `shpallja_ditet`
--
ALTER TABLE `shpallja_ditet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shpallja_gallery`
--
ALTER TABLE `shpallja_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `shteti`
--
ALTER TABLE `shteti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `user_ban`
--
ALTER TABLE `user_ban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `adresa`
--
ALTER TABLE `adresa`
  ADD CONSTRAINT `adresa_ibfk_2` FOREIGN KEY (`shteti`) REFERENCES `shteti` (`id`),
  ADD CONSTRAINT `adresa_ibfk_3` FOREIGN KEY (`qyteti`) REFERENCES `qyteti` (`id`);

--
-- Constraints for table `kategoria`
--
ALTER TABLE `kategoria`
  ADD CONSTRAINT `kategoria_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `kategoria` (`id`);

--
-- Constraints for table `kerkesa`
--
ALTER TABLE `kerkesa`
  ADD CONSTRAINT `kerkesa_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `kerkesa_ibfk_2` FOREIGN KEY (`shpallja`) REFERENCES `shpallja` (`id`);

--
-- Constraints for table `qyteti`
--
ALTER TABLE `qyteti`
  ADD CONSTRAINT `qyteti_ibfk_1` FOREIGN KEY (`shteti`) REFERENCES `shteti` (`id`);

--
-- Constraints for table `raportim`
--
ALTER TABLE `raportim`
  ADD CONSTRAINT `raportim_ibfk_1` FOREIGN KEY (`raportuesi`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `raportim_ibfk_2` FOREIGN KEY (`shpallja`) REFERENCES `shpallja` (`id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`shpallja`) REFERENCES `shpallja` (`id`);

--
-- Constraints for table `shpallja`
--
ALTER TABLE `shpallja`
  ADD CONSTRAINT `shpallja_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`);

--
-- Constraints for table `shpallja_ditet`
--
ALTER TABLE `shpallja_ditet`
  ADD CONSTRAINT `shpallja_ditet_ibfk_1` FOREIGN KEY (`shpallja`) REFERENCES `shpallja` (`id`);

--
-- Constraints for table `shpallja_gallery`
--
ALTER TABLE `shpallja_gallery`
  ADD CONSTRAINT `shpallja_gallery_ibfk_1` FOREIGN KEY (`shpallja`) REFERENCES `shpallja` (`id`);

--
-- Constraints for table `shpallja_kategoria`
--
ALTER TABLE `shpallja_kategoria`
  ADD CONSTRAINT `shpallja_kategoria_ibfk_1` FOREIGN KEY (`shpallja`) REFERENCES `shpallja` (`id`),
  ADD CONSTRAINT `shpallja_kategoria_ibfk_2` FOREIGN KEY (`kategoria`) REFERENCES `kategoria` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`roli`) REFERENCES `roli` (`id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`adresa`) REFERENCES `adresa` (`id`);

--
-- Constraints for table `user_ban`
--
ALTER TABLE `user_ban`
  ADD CONSTRAINT `user_ban_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `user_ban_ibfk_2` FOREIGN KEY (`moderator`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
