-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : jeu. 21 jan. 2021 à 16:03
-- Version du serveur :  5.7.32
-- Version de PHP : 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `breaking_badge`
--

-- --------------------------------------------------------

--
-- Structure de la table `badges`
--

CREATE TABLE `badges` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `description` text COLLATE utf8mb4_bin NOT NULL,
  `shape` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `badges`
--

INSERT INTO `badges` (`id`, `name`, `description`, `shape`) VALUES
(1, 'JS', 'JS is life', 'Round'),
(2, 'HTML', 'Hypertext Markup Language', 'Triangle'),
(3, 'PHP', 'Php is good!', 'Round'),
(18, 'CSS', 'Vive le CSS !!!', 'Ellipse');

-- --------------------------------------------------------

--
-- Structure de la table `levels`
--

CREATE TABLE `levels` (
  `id` int(10) UNSIGNED NOT NULL,
  `level` varchar(20) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `levels`
--

INSERT INTO `levels` (`id`, `level`) VALUES
(1, 'Newbie'),
(2, 'Junior'),
(3, 'Senior'),
(4, 'Master');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `lastname` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `mail` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `pwd` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `account_type` enum('NORMIE','ADMIN') COLLATE utf8mb4_bin NOT NULL DEFAULT 'NORMIE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `mail`, `pwd`, `account_type`) VALUES
(1, 'Grace', 'Hopper', 'admin@example.com', '$2y$10$HnC5R/DMLctfv94iHORJH.kmaxrtYNJted4mmv0uhXVd0VCtHMCG.', 'ADMIN'),
(2, 'Johnny', 'Normie', 'normie@example.com', '$2y$10$mhE/p8tmq.dsZfK/HDIF1uJJBwSQwrJ0DTwaN4wCVSk3zoC15zTd6', 'NORMIE'),
(9, 'Simon', 'Doneux', 'simon@doneux.com', '$2y$10$ak6FkPHDZiN0PhieNzKp6.9o1x3cghxo9l5x8USiTQVIWn.ebng.S', 'NORMIE'),
(11, 'Guillaume', 'Vanleynseele', 'g.vanleynseele@posteo.net', '$2y$10$pQLLdDZ/dDYACC6qqkDVre159udbZtJs1mNcKTPWY5AwcRS6OHlD2', 'NORMIE'),
(12, 'Bernard', 'Lama', 'bernard@lama.com', '$2y$10$sQIDq7LsVNSuYFvORaFIq.ytmcOUwZyPufamo18bHtt0BLYxv5RJu', 'NORMIE'),
(13, 'Capitaine', 'Flamme', 'capitaine@flamme.com', '$2y$10$tCD4m8ntmdlyL5zIWr3HxOLEJwWxedUFu/O6KfCfy2HVPWNhGOuhW', 'NORMIE'),
(14, 'Alexandre', 'Albelice', 'alexandre@albelice.com', '$2y$10$gMHf4zmdw63dgFZ009C40.dv7.Yu7xTUD61AiBY3ZZR0kO7aler4m', 'NORMIE'),
(15, 'Marie', 'Fourriere', 'marie@fourriere.com', '$2y$10$cuznSZ146qq7sT7gXxxrVOX1Y9lf3L7vKHf5zZiY74rEh6uUFgpXy', 'NORMIE'),
(16, 'Kill', 'Coach', 'kill@coach.com', '$2y$10$qM0vzpiStVrshUFLBwkTQeN7RwQFMLS1Zn/OlvR.WDSbx0nuFmWiW', 'NORMIE');

-- --------------------------------------------------------

--
-- Structure de la table `users_has_badges`
--

CREATE TABLE `users_has_badges` (
  `id` int(10) UNSIGNED NOT NULL,
  `fk_users_id` int(10) UNSIGNED NOT NULL,
  `fk_badges_id` int(10) UNSIGNED NOT NULL,
  `fk_levels_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `users_has_badges`
--

INSERT INTO `users_has_badges` (`id`, `fk_users_id`, `fk_badges_id`, `fk_levels_id`) VALUES
(1, 2, 2, 1),
(4, 9, 1, 1),
(7, 2, 1, 1),
(8, 9, 1, 4);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `badges`
--
ALTER TABLE `badges`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Index pour la table `users_has_badges`
--
ALTER TABLE `users_has_badges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_badges_id` (`fk_badges_id`),
  ADD KEY `users_has_badges_ibfk_2` (`fk_users_id`),
  ADD KEY `fk_level_id` (`fk_levels_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `badges`
--
ALTER TABLE `badges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `users_has_badges`
--
ALTER TABLE `users_has_badges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `users_has_badges`
--
ALTER TABLE `users_has_badges`
  ADD CONSTRAINT `users_has_badges_ibfk_1` FOREIGN KEY (`fk_badges_id`) REFERENCES `badges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_has_badges_ibfk_2` FOREIGN KEY (`fk_users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_has_badges_ibfk_3` FOREIGN KEY (`fk_levels_id`) REFERENCES `levels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
