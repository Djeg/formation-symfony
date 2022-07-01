-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql
-- Généré le : ven. 01 juil. 2022 à 11:50
-- Version du serveur : 8.0.28
-- Version de PHP : 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pizza-shop-php`
--
CREATE DATABASE IF NOT EXISTS `pizza-shop-php` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `pizza-shop-php`;

-- --------------------------------------------------------

--
-- Structure de la table `pizzas`
--

DROP TABLE IF EXISTS `pizzas`;
CREATE TABLE IF NOT EXISTS `pizzas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` float NOT NULL,
  `imageUrl` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `pizzas`
--

INSERT INTO `pizzas` (`id`, `name`, `description`, `price`, `imageUrl`) VALUES
(1, 'Margarita', 'kfsdlfsdlfhsdfds', 9.5, 'https://images.unsplash.com/photo-1513104890138-7c749659a591?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zipCode` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `supplement` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `phone`, `city`, `zipCode`, `street`, `supplement`) VALUES
(1, 'sdfsdfsdfsdfsdf', 'dfsdfsdfsdfsdfsdf', 'fsd@cdljd.com', 'test1234', '0020020202330', 'sdfsdfqsdfsd', 'fsdfsdfsdf', 'sdfsdfsdf', 'sdfsdfsdfsd'),
(2, 'sdfsdfsdfsdfsdf', 'dfsdfsdfsdfsdfsdf', 'fsd@cdljd.com', '$2y$10$.Cv5fCiflgveeff00Stu2O/yuQt4NMWzmIboCaWoLhRN7unJlDy9u', '0020020202330', 'sdfsdfqsdfsd', 'fsdfsdfsdf', 'sdfsdfsdf', 'sdfsdfsdfsd'),
(3, 'test', 'Test', 'test@test.com', '$2y$10$cxB2PMESJa1B6hQaE.QwJOIWV8xmMfX38Xzh7xmDDdcU17ybP0E9G', '06060606606', 'sfsdgfsd', 'gdfgsfdgs', 'dgdsfgsdfg', 'sdgsdfgsdfgsdfg'),
(4, 'dfgdfgdfgdfg', 'gfdgdfgfdgdfgdfgdfg', 'fddfgdfdf@dfgdfgdf.vp', '$2y$10$CCNdZbVVFocEkZlcSQte3uJ4Od/WYgTQ4CV.Ss0Rs1KNUdg5G3PYu', '02056065065', 'sdfdssdf', 'sdfsdfsdf', 'sdfsdfsdfsdf', 'sdfsdfsdfsdf'),
(5, 'coucouc', 'coucou', 'coucou@coucou.com', '$2y$10$/hZUW3BERPUR8I6sjvRQnuqHpzhOY5VdKja.8iWucChM23cGF/.SW', '030560605065', 'sdfksdhflkdhf', 'lsdhflshflkh', 'fsdkhfsldkhf', 'fklsdhflksdhf');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
