-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 5.6.16 - MySQL Community Server (GPL)
-- OS Server:                    Win32
-- HeidiSQL Versi:               9.2.0.4947
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for ourca
CREATE DATABASE IF NOT EXISTS `ourca` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ourca`;


-- Dumping structure for table ourca.pending_cert
CREATE TABLE IF NOT EXISTS `pending_cert` (
  `idpending` int(11) NOT NULL AUTO_INCREMENT,
  `userpending` varchar(50) NOT NULL,
  `datepending` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `contentpending` text NOT NULL,
  `signed` tinyint(1) NOT NULL,
  PRIMARY KEY (`idpending`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table ourca.pending_cert: ~1 rows (approximately)
DELETE FROM `pending_cert`;
/*!40000 ALTER TABLE `pending_cert` DISABLE KEYS */;
INSERT INTO `pending_cert` (`idpending`, `userpending`, `datepending`, `contentpending`, `signed`) VALUES
	(1, 'surya.igede@gmail.com', '2015-05-07 03:28:27', '-----BEGIN CERTIFICATE REQUEST-----\r\nMIIB2zCCAUYCAQAwgaAxCzAJBgNVBAYMAklEMQ0wCwYDVQQIDARCYWxpMRAwDgYD\r\nVQQHDAdUYWJhbmFuMRowGAYDVQQKDBF5YXN1cnlhIGNvcnBvcmF0ZTEeMBwGA1UE\r\nCwwVZGl2aXNpIHRlbGVrb211bmlrYXNpMRQwEgYDVQQDDAt5YXN1cnlhLmNvbTEe\r\nMBwGCSqGSIb3DQEJAQwPc3VyeWFAZ21haWwuY29tMIGdMAsGCSqGSIb3DQEBAQOB\r\njQAwgYkCgYEAop7TW7UGNAJSZSrlLn0VQtx7IvurXDAx/VaiIGIQeUS5PUXckPmS\r\nA63Ub0krma7JOCWJCWlbvrRZYndKqYc00Z38/sj8NkPzK1XIofNQjy20IWIkyzGT\r\nd6xjmYvFKzisiQMpqgWiyD7e1+fg3IrEd4zfaXZRDjn1wV1hcdqIkdcCAwEAATAL\r\nBgkqhkiG9w0BAQUDgYEAJwHW/WM3web9deKqXVIugmCItt/5ulE62WCHO3B7VkNC\r\nV7M8nP+CW6RW7N7TUoaTChB/SbESy8fB8HQtg8vR5HpFZUGaKj9ThCspdkfNtESy\r\nFtYwHi05X1UqYAAfYYgow3YMDyR56CuDd9lO0FirrV8GOds8+RrvC9Tw5hhe5NY=\r\n-----END CERTIFICATE REQUEST-----				', 0);
/*!40000 ALTER TABLE `pending_cert` ENABLE KEYS */;


-- Dumping structure for table ourca.signed_cert
CREATE TABLE IF NOT EXISTS `signed_cert` (
  `idsigned` int(11) NOT NULL AUTO_INCREMENT,
  `usersigned` varchar(50) NOT NULL,
  `datesigned` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `contentsigned` text NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`idsigned`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ourca.signed_cert: ~0 rows (approximately)
DELETE FROM `signed_cert`;
/*!40000 ALTER TABLE `signed_cert` DISABLE KEYS */;
/*!40000 ALTER TABLE `signed_cert` ENABLE KEYS */;


-- Dumping structure for table ourca.user
CREATE TABLE IF NOT EXISTS `user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `userpass` varchar(30) NOT NULL,
  `usertype` tinyint(1) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table ourca.user: ~3 rows (approximately)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`userid`, `username`, `userpass`, `usertype`) VALUES
	(1, 'surya.igede@gmail.com', '1234', 1),
	(2, 'agus.4171.wirawan@gmail.com', '1234', 1),
	(3, 'earthhoursurabaya@gmail.com', '1234', 1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
