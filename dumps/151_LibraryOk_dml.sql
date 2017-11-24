-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: libraryofknowledge
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.29-MariaDB-1~xenial

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `country`
--

LOCK TABLES `country` WRITE;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
INSERT INTO `country` VALUES (1,'Schweiz','CH');
/*!40000 ALTER TABLE `country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'Administrator'),(2,'Normal User');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'How to Install Vagrant','This is a documentation where you learn how to install vagrant','Installing Vagrant is extremely easy. Head over to the Vagrant downloads page and get the appropriate installer or package for your platform. Install the package using standard procedures for your operating system.','http://tech.osteel.me/images/2015/01/25/vagrant.png',1,1,'2017-11-17 10:13:57'),(2,'Advantages of PHP','What are the advantages and disadvantages of PHP? ','In school i have a project, where i need to figure out what the advantages of this programming is.','https://newrelic.com/assets/pages/apm/php/php-elephant-logo-bd4f9d83be8c8563248fe4793f90bae7.png',1,2,'2017-11-16 20:50:43'),(3,'Microsoft SQL Server',' Microsoft SQL Server and Sybase Functions (PDO_DBLIB) ','PDO_DBLIB is a driver that implements the PHP Data Objects (PDO) interface to enable access from PHP to Microsoft SQL Server and Sybase databases through the FreeTDS library.\r\n\r\nThis extension is not available anymore on Windows with PHP 5.3 or later.\r\n\r\nOn Windows, you should use SqlSrv, an alternative driver for MS SQL is available from Microsoft: Â» http://msdn.microsoft.com/en-us/sqlserver/ff657782.aspx .\r\n\r\nIf it is not possible to use SqlSrv, you can use the PDO_ODBC driver to connect to Microsoft SQL Server and Sybase databases, as the native Windows DB-LIB is ancient, thread un-safe and no longer supported by Microsoft.','http://www.sysadminslife.com/wp-content/uploads/2013/12/mssql-server.png',1,1,'2017-11-16 22:21:50'),(4,'Test Post','This is a test Post ','This is a test Post','',1,1,'2017-11-17 10:16:36');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `posttype`
--

LOCK TABLES `posttype` WRITE;
/*!40000 ALTER TABLE `posttype` DISABLE KEYS */;
INSERT INTO `posttype` VALUES (1,'Documentation'),(2,'Questions');
/*!40000 ALTER TABLE `posttype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `tag_has_posts`
--

LOCK TABLES `tag_has_posts` WRITE;
/*!40000 ALTER TABLE `tag_has_posts` DISABLE KEYS */;
INSERT INTO `tag_has_posts` VALUES (1,5,1),(2,6,1);
/*!40000 ALTER TABLE `tag_has_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (5,'PHP'),(6,'Web Development');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Dominik','OKerwin','dokerwin','c0b137fe2d792459f26ff763cce44574a5b5ab03',1,1,'2017-11-16 19:07:47'),(18,'David','Kalchofner','daka','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',2,1,'2017-11-16 21:52:13'),(20,'test','test','test','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3',1,1,'2017-11-17 10:08:06'),(22,'testing','testing','testing','dc724af18fbdd4e59189f5fe768a5f8311527050',2,1,'2017-11-16 21:58:12'),(23,'Mathias','von Orelli','vonOrelli','8980ae2b4f4b02f6a40bd8ed7e0e589cc237465a',2,1,'2017-11-17 10:15:15'),(24,'0','0','0','0',2,1,'2017-11-23 18:40:57');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-24 11:12:05
