-- Adminer 4.2.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `calendar`;
CREATE TABLE `calendar` (
  `datefield` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `channel`;
CREATE TABLE `channel` (
  `channelID` int(11) NOT NULL AUTO_INCREMENT,
  `channelName` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `channelCode` varchar(45) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`channelID`),
  UNIQUE KEY `channelName` (`channelName`),
  UNIQUE KEY `channelCode` (`channelCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `channel_rules`;
CREATE TABLE `channel_rules` (
  `channel_rules_id` int(11) NOT NULL AUTO_INCREMENT,
  `rule_name` varchar(60) DEFAULT NULL,
  `rules_endpoint` text,
  `client_channelID` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`channel_rules_id`),
  UNIQUE KEY `rule_name` (`rule_name`),
  KEY `client_channelID` (`client_channelID`),
  CONSTRAINT `channel_rules_ibfk_1` FOREIGN KEY (`client_channelID`) REFERENCES `client_channels` (`client_channelID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `clientID` int(11) NOT NULL AUTO_INCREMENT,
  `clientName` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `clientCode` varchar(45) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`clientID`),
  UNIQUE KEY `clientName` (`clientName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `client_channels`;
CREATE TABLE `client_channels` (
  `client_channelID` int(11) NOT NULL AUTO_INCREMENT,
  `clientID` int(11) NOT NULL,
  `channelID` int(11) NOT NULL,
  `client_channel_name` varchar(60) NOT NULL,
  `status` varchar(45) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`client_channelID`),
  UNIQUE KEY `client_channel_name` (`client_channel_name`),
  KEY `clientID` (`clientID`),
  KEY `channelID` (`channelID`),
  CONSTRAINT `client_channels_ibfk_1` FOREIGN KEY (`clientID`) REFERENCES `clients` (`clientID`),
  CONSTRAINT `client_channels_ibfk_2` FOREIGN KEY (`channelID`) REFERENCES `channel` (`channelID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `client_channels_reference`;
CREATE TABLE `client_channels_reference` (
  `channel_ref_id` int(11) NOT NULL AUTO_INCREMENT,
  `clientID` int(11) NOT NULL,
  `destinationClientID` int(11) NOT NULL,
  `client_channelID` int(11) NOT NULL,
  `code` varchar(45) NOT NULL,
  `queue_name` varchar(50) DEFAULT NULL,
  `end_point` text,
  `callback` text,
  `senderid` varchar(30) NOT NULL,
  `notifyCustomer` enum('yes','no') DEFAULT 'no',
  `status` varchar(45) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`channel_ref_id`),
  UNIQUE KEY `code` (`code`),
  KEY `clientID` (`clientID`),
  KEY `client_channelID` (`client_channelID`),
  CONSTRAINT `client_channels_reference_ibfk_1` FOREIGN KEY (`clientID`) REFERENCES `clients` (`clientID`),
  CONSTRAINT `client_channels_reference_ibfk_2` FOREIGN KEY (`client_channelID`) REFERENCES `client_channels` (`client_channelID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `invoices`;
CREATE TABLE `invoices` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(60) NOT NULL,
  `channel_ref_id` int(11) DEFAULT NULL,
  `amount` float(10,2) DEFAULT '0.00',
  `message` text NOT NULL,
  `due_date` date DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`invoice_id`),
  KEY `channel_ref_id` (`channel_ref_id`),
  CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`channel_ref_id`) REFERENCES `client_channels_reference` (`channel_ref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `message_templates`;
CREATE TABLE `message_templates` (
  `template_id` int(11) NOT NULL AUTO_INCREMENT,
  `channel_ref_id` int(11) NOT NULL,
  `status_code_id` int(11) NOT NULL,
  `template` text NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


SET NAMES utf8mb4;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `requestLogID` int(11) NOT NULL,
  `senderid` varchar(30) DEFAULT NULL,
  `receiver` varchar(30) NOT NULL,
  `message` text NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`message_id`),
  KEY `requestLogID` (`requestLogID`),
  CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`requestLogID`) REFERENCES `request_logs` (`requestlogID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `request_logs`;
CREATE TABLE `request_logs` (
  `requestlogID` int(11) NOT NULL AUTO_INCREMENT,
  `channelID` int(11) NOT NULL,
  `external_ref_id` varchar(60) NOT NULL,
  `amount` float(10,2) NOT NULL,
  `source` varchar(45) NOT NULL,
  `source_account` varchar(60) NOT NULL,
  `destination` varchar(45) NOT NULL,
  `destination_account` varchar(60) DEFAULT NULL,
  `extras` text,
  `narration` text NOT NULL,
  `payment_date` datetime NOT NULL,
  `overalStatus` varchar(45) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`requestlogID`),
  UNIQUE KEY `external_ref_id` (`external_ref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `statusCodes`;
CREATE TABLE `statusCodes` (
  `statusCodeID` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) NOT NULL,
  `description` text NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`statusCodeID`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `transactionID` int(11) NOT NULL AUTO_INCREMENT,
  `requestlogID` int(11) DEFAULT NULL,
  `channel_ref_id` int(11) NOT NULL,
  `receipt_number` varchar(20) DEFAULT NULL,
  `destClientNarration` text,
  `date_created` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`transactionID`),
  KEY `requestlogID` (`requestlogID`),
  CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`requestlogID`) REFERENCES `request_logs` (`requestlogID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `ui_users`;
CREATE TABLE `ui_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userType` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'UI',
  `user_group` int(11) NOT NULL DEFAULT '1',
  `clientID` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '136',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ui_users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(60) NOT NULL,
  `userType` enum('UI','API') DEFAULT NULL,
  `clientID` int(11) NOT NULL,
  `status` varchar(45) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userGroup` int(10) DEFAULT NULL,
  PRIMARY KEY (`userID`),
  KEY `clientID` (`clientID`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`clientID`) REFERENCES `clients` (`clientID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `user_groups`;
CREATE TABLE `user_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `user_permissions`;
CREATE TABLE `user_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_group` int(11) NOT NULL,
  `permission` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 2017-11-17 09:44:31
