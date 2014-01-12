# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.14)
# Database: snap
# Generation Time: 2014-01-12 19:58:36 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table companies
# ------------------------------------------------------------

DROP TABLE IF EXISTS `companies`;

CREATE TABLE `companies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;

INSERT INTO `companies` (`id`, `name`, `created_at`, `updated_at`)
VALUES
	(1,'Company','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table company_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `company_users`;

CREATE TABLE `company_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(10) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_user` (`company_id`,`user_id`),
  KEY `company_id_from_company_users_to_company` (`company_id`),
  KEY `user_id_from_company_users_to_user` (`user_id`),
  CONSTRAINT `company_id_from_company_users_to_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `user_id_from_company_users_to_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `company_users` WRITE;
/*!40000 ALTER TABLE `company_users` DISABLE KEYS */;

INSERT INTO `company_users` (`id`, `company_id`, `user_id`, `created_at`, `updated_at`)
VALUES
	(1,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `company_users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table department_members
# ------------------------------------------------------------

DROP TABLE IF EXISTS `department_members`;

CREATE TABLE `department_members` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `department_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `unique_user` (`department_id`,`user_id`),
  KEY `department_id_from_department_member_to_department` (`department_id`),
  KEY `user_id_from_department_member_to_user` (`user_id`),
  CONSTRAINT `department_id_from_department_member_to_department` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `user_id_from_department_member_to_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `department_members` WRITE;
/*!40000 ALTER TABLE `department_members` DISABLE KEYS */;

INSERT INTO `department_members` (`id`, `department_id`, `user_id`, `created_at`, `updated_at`)
VALUES
	(1,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `department_members` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table departments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `departments`;

CREATE TABLE `departments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;

INSERT INTO `departments` (`id`, `name`, `created_at`, `updated_at`)
VALUES
	(1,'Soporte Técnico','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table laravel_migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `laravel_migrations`;

CREATE TABLE `laravel_migrations` (
  `bundle` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`bundle`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table messages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ticket_id_from_message_to_ticket` (`ticket_id`),
  KEY `user_id_from_message_to_user` (`user_id`),
  CONSTRAINT `ticket_id_from_message_to_ticket` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `user_id_from_message_to_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;

INSERT INTO `messages` (`id`, `ticket_id`, `user_id`, `content`, `created_at`, `updated_at`)
VALUES
	(1,1,1,'Message.','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table role_assignments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `role_assignments`;

CREATE TABLE `role_assignments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_assignment` (`role_id`,`user_id`),
  KEY `role_id_from_role_assignment_to_role` (`role_id`),
  KEY `user_id_from_role_assignment_to_user` (`user_id`),
  CONSTRAINT `role_id_from_role_assignment_to_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `user_id_from_role_assignment_to_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `role_assignments` WRITE;
/*!40000 ALTER TABLE `role_assignments` DISABLE KEYS */;

INSERT INTO `role_assignments` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`)
VALUES
	(1,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `role_assignments` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`)
VALUES
	(1,'Role','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `value` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;

INSERT INTO `settings` (`id`, `name`, `value`, `created_at`, `updated_at`)
VALUES
	(1,'smtp_host','mail.example.com','0000-00-00 00:00:00','2013-12-10 09:33:28'),
	(2,'smtp_port','587','0000-00-00 00:00:00','2013-12-10 09:33:28'),
	(3,'smtp_user','user@example.com','0000-00-00 00:00:00','2013-12-10 09:33:28'),
	(4,'smtp_pass','pass','0000-00-00 00:00:00','2013-12-10 09:33:28'),
	(5,'smtp_crypto','off','0000-00-00 00:00:00','2013-12-10 09:33:28'),
	(6,'smtp_name','Name','0000-00-00 00:00:00','2013-12-10 09:33:28'),
	(7,'smtp_enabled','1','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(8,'per_page','50','0000-00-00 00:00:00','2013-12-10 09:33:28'),
	(9,'system_message','','2013-05-24 11:55:51','2013-12-10 09:33:28'),
	(10,'system_message_title','','2013-05-24 11:55:51','2013-12-10 09:33:28');

/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tickets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tickets`;

CREATE TABLE `tickets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `reported_by` bigint(20) unsigned NOT NULL,
  `assigned_to` bigint(20) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'open',
  `department` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `department_from_ticket_to_department` (`department`),
  CONSTRAINT `department_from_ticket_to_department` FOREIGN KEY (`department`) REFERENCES `departments` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;

INSERT INTO `tickets` (`id`, `subject`, `content`, `reported_by`, `assigned_to`, `created_at`, `updated_at`, `status`, `department`)
VALUES
	(1,'Asunto','Contenido del mensaje.',1,NULL,NULL,NULL,'open',1);

/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(100) NOT NULL,
  `deleted` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `email`, `deleted`, `created_at`, `updated_at`)
VALUES
	(1,'Admin','User','admin','$2a$08$6rofU7gCMChat6QmGt0eL.CkQ3WPXLfs7p5smTwglrsuliWLg/ai2','admin@admin.com',0,'0000-00-00 00:00:00','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
