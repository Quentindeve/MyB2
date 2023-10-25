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
-- Structure de la table `products_notes`
--

CREATE TABLE `products_notes` (
  `product_id` int NOT NULL,
  `note` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `products_notes`
--

INSERT INTO `products_notes` (`product_id`, `note`) VALUES
(12, 5),
(12, 5),
(12, 5),
(13, 4),
(13, 3),
(13, 2),
(13, 5),
(14, 5),
(14, 4),
(14, 4),
(14, 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `products_notes`
--
ALTER TABLE `products_notes`
  ADD KEY `product_id` (`product_id`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `products_notes`
--
ALTER TABLE `products_notes`
  ADD CONSTRAINT `products_notes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
