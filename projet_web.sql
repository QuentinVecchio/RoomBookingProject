-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 10 Novembre 2013 à 22:34
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `projet_web`
--
CREATE DATABASE IF NOT EXISTS `projet_web` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `projet_web`;

-- --------------------------------------------------------

--
-- Structure de la table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `departments`
--

INSERT INTO `departments` (`id`, `name`, `created`) VALUES
(1, 'INFO', '2013-10-04'),
(2, 'GMP', '2013-10-04'),
(3, 'GEA', '2013-10-04'),
(4, 'TC', '2013-10-04');

-- --------------------------------------------------------

--
-- Structure de la table `loans`
--

CREATE TABLE IF NOT EXISTS `loans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `remark` text NOT NULL,
  `status_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `room_id` (`room_id`),
  KEY `department_id` (`department_id`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `loans`
--

INSERT INTO `loans` (`id`, `room_id`, `department_id`, `date`, `start_time`, `end_time`, `remark`, `status_id`) VALUES
(1, 1, 3, '2013-10-16', '08:00:00', '10:00:00', 'test', 2);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'users'),
(2, 'managers'),
(3, 'administrators');

-- --------------------------------------------------------

--
-- Structure de la table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `projector` int(11) NOT NULL,
  `has_PC` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `remark` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_dept` (`department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Contenu de la table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `projector`, `has_PC`, `capacity`, `remark`, `slug`, `department_id`) VALUES
(1, 'F39', 1, 1, 30, '', 'info-f39', 1),
(2, 'E33', 1, 0, 50, '', 'info-e33', 1),
(3, 'E32', 1, 1, 42, '', '', 1),
(4, 'A1', 1, 0, 125, '', '', 2),
(5, 'A321', 0, 1, 20, '', '', 2),
(6, 'A21', 1, 1, 50, '', '', 2),
(8, 'A2', 0, 1, 35, '', '', 3),
(9, 'A3', 1, 1, 41, '', '', 3),
(10, 'A5', 1, 0, 20, '', '', 3),
(11, 'A5', 0, 1, 30, '', '', 3),
(12, 'B5', 1, 0, 40, '', '', 2),
(13, 'B6', 0, 1, 30, '', '', 2),
(14, 'B7', 1, 0, 60, '', '', 2),
(15, 'G3', 1, 0, 30, '', '', 1),
(16, 'E50', 0, 0, 50, '', '', 1),
(17, 'E45', 0, 1, 20, '', '', 1),
(18, 'E5', 1, 0, 20, '', '', 4),
(19, 'E6', 0, 1, 25, '', '', 4),
(20, 'E7', 1, 0, 35, '', '', 4),
(21, 'E8', 1, 1, 32, '', '', 4),
(22, 'E9', 0, 1, 15, '', '', 4),
(23, 'E10', 1, 0, 24, '', '', 4),
(24, 'E12', 0, 0, 34, '', '', 4),
(25, 'A05', 0, 0, 44, '', '', 3),
(26, 'E33', 1, 1, 550, '', '', 3);

-- --------------------------------------------------------

--
-- Structure de la table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(3, 'non'),
(1, 'oui'),
(2, 'peut-être');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_dept` (`department_id`),
  KEY `role` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `email`, `password`, `role_id`, `department_id`) VALUES
(2, 'laropier', 'Pierre', 'Laroche', 'pierre.laroche@wanadoo.fr', 'a25198027db5eb8939e7e9c3840f475f7931cf24', 3, 1),
(3, 'spenanne', 'Anne', ' Spengler', 'anne.spengler@wanadoo.fr', '78f86c7e06a7dce5444fcf7dba0b638cb7e9b64f', 2, 1),
(4, 'lyndzert', 'Lynda', ' Zertal', 'lynda.zertal@wanadoo.fr', '0989046dc079b2f78f99aa9df1f535df60fec307', 1, 1);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `loans_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `loans_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Contraintes pour la table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
