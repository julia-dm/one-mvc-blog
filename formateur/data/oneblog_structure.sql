-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 06 juil. 2026 à 20:18
-- Version du serveur : 8.4.7
-- Version de PHP : 8.4.15

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données : `oneblog`
--
CREATE DATABASE IF NOT EXISTS `oneblog` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `oneblog`;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(90) NOT NULL,
  `content` text NOT NULL,
  `datetime` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'ou now(), temps actuel si non renseigné',
  `actif` tinyint DEFAULT '0' COMMENT '0 => non visible\n1 => visible\n2 =>  article caché',
  `user_id` smallint UNSIGNED NOT NULL COMMENT 'clef étrangère qui fait le lien avec la table user',
  PRIMARY KEY (`id`),
  KEY `fk_article_user_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` smallint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `category_has_article`
--

DROP TABLE IF EXISTS `category_has_article`;
CREATE TABLE IF NOT EXISTS `category_has_article` (
  `category_id` smallint UNSIGNED NOT NULL,
  `article_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`category_id`,`article_id`),
  KEY `fk_category_has_article_article1_idx` (`article_id`),
  KEY `fk_category_has_article_category1_idx` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` smallint UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID unique unsigned auto increment not null',
  `login` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL COMMENT 'login unique mais case sentive ( ADMIN != Admin )   not null\ncs case sensitive\nci case insensitive',
  `realname` varchar(100) DEFAULT NULL COMMENT 'NULL : non obligatoire',
  `pwd` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL COMMENT 'Mot de passe hash (empreinte), avec 255 max, case sensitive, actuellement 60  not null',
  `email` varchar(120) NOT NULL COMMENT 'email utilisateur  not null',
  `actif` tinyint UNSIGNED DEFAULT '2' COMMENT '0 => actif\n1 => banni\n2 => non activé\n3 => RGPD avec articles anonymes\n4 => RGPD avec articles cachés',
  `uniqid` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_UNIQUE` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `fk_article_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `category_has_article`
--
ALTER TABLE `category_has_article`
  ADD CONSTRAINT `fk_category_has_article_article1` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_category_has_article_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
