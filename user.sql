-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 16 mars 2025 à 19:01
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `users`
--

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `ID` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `profil` varchar(255) NOT NULL DEFAULT 'PAS DE PHOTO',
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`ID`, `name`, `firstname`, `login`, `profil`, `password`) VALUES
(6, 'ken', 'takakura', 'okarun', 'admin', '$2y$10$tO0hiAVgX5AtIGVmGkTaTOxXWeEpnaBTIUhrS1PzH5ia.TNciQZMS'),
(13, 'Diatta', 'Mouhamed Ibrahim', 'moshi', 'uploads/mage1.jpeg', '$2y$10$ATfOBz3WjKV/UXCVftClVev3GHwGWmlM68eUKxjZcwbJnxcSJGXb6'),
(14, 'Mariane', 'Seck', 'mariane1', 'uploads/mage3.jpeg', '$2y$10$zVIF3l5JzqJS6IXz3CIZ7ONl33opajwAj/H0aPOpuLkvjDkg7rFKq'),
(16, 'Fatigba', 'Lamine', 'lamine1', 'uploads/mage5.jpeg', '$2y$10$wypIUeUY.5Kz92DylNd9IeZc5D9Wm4v3rd0u.axgE2vUDwNwpHko6'),
(17, 'Samba', 'Amadou', 'samb45', 'uploads/mage4.jpeg', '$2y$10$6AIjEAuQfKJhKQduaanLn.9R9cZyCkr2XPkWsMDNTaZ/VWW80qAKO'),
(18, 'ndoye', 'malick', 'malick1', 'uploads/mage12.jpeg', '$2y$10$EkOq4Qb1q5Cdb9O/uvTb/.zTNLQhH.K6eNNRMRq8QFaVHUweMLDo2');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
