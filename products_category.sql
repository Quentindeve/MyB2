-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : mer. 25 oct. 2023 à 15:54
-- Version du serveur : 8.1.0
-- Version de PHP : 8.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `b2`
--

-- --------------------------------------------------------

--
-- Structure de la table `products_category`
--

CREATE TABLE `products_category` (
  `id_cat` int NOT NULL,
  `cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `products_category`
--

INSERT INTO `products_category` (`id_cat`, `cat_name`) VALUES
(0, 'Jeu PC'),
(1, 'Jeu PS5'),
(2, 'Jeu Wii'),
(3, 'Jeu DS'),
(4, 'Jeu PS2');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `products_category`
--
ALTER TABLE `products_category`
  ADD PRIMARY KEY (`id_cat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
