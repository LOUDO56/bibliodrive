-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 05 déc. 2023 à 19:32
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bibliodrive`
--

-- --------------------------------------------------------

--
-- Structure de la table `auteur`
--

CREATE TABLE `auteur` (
  `noauteur` int(11) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `auteur`
--

INSERT INTO `auteur` (`noauteur`, `nom`, `prenom`) VALUES
(1, 'Shakespeare', 'William'),
(2, 'Austen', 'Jane'),
(3, 'Hemingway', 'Ernest'),
(4, 'Tolstoy', 'Leo'),
(5, 'Rowling', 'J.K.'),
(6, 'Orwell', 'George'),
(7, 'Austen', 'Jane'),
(8, 'Dickens', 'Charles'),
(9, 'Twain', 'Mark'),
(10, 'Brontë', 'Charlotte'),
(11, 'Wilde', 'Oscar'),
(12, 'Fitzgerald', 'F. Scott'),
(13, 'Austen', 'Jane'),
(14, 'Dostoevsky', 'Fyodor'),
(15, 'Brontë', 'Emily'),
(16, 'Hugo', 'Victor'),
(17, 'Melville', 'Herman'),
(18, 'Verne', 'Jules'),
(19, 'Austen', 'Jane'),
(20, 'Wells', 'H.G.');

-- --------------------------------------------------------

--
-- Structure de la table `emprunter`
--

CREATE TABLE `emprunter` (
  `mel` varchar(40) NOT NULL,
  `nolivre` int(11) NOT NULL,
  `dateemprunt` date NOT NULL,
  `dateretour` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

CREATE TABLE `livre` (
  `nolivre` int(11) NOT NULL,
  `noauteur` int(11) NOT NULL,
  `titre` varchar(128) NOT NULL,
  `isbn13` char(13) NOT NULL,
  `anneeparution` int(11) NOT NULL,
  `resume` text NOT NULL,
  `dateajout` date DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`nolivre`, `noauteur`, `titre`, `isbn13`, `anneeparution`, `resume`, `dateajout`, `image`) VALUES
(6, 1, 'Roméo et Juliette', '978-1-234567-', 1597, 'Une tragédie intemporelle d\'amour interdit entre Roméo Montaigu et Juliette Capulet, deux jeunes épris issus de familles ennemies à Vérone. Leur histoire passionnée se termine de manière déchirante, soulignant les conséquences dévastatrices de la haine et des préjugés.', '2023-11-29', 'romeo et juliette.jpg'),
(7, 1, 'Hamlet', '978-1-234567-', 1603, 'Prince du Danemark, Hamlet cherche à venger la mort de son père, le roi, tué par son oncle, Claudius, qui a pris le trône. Cette tragédie explore la folie, la trahison et la quête de justice, tout en offrant des réflexions profondes sur la nature humaine.', '2023-11-29', 'hamlet.jpg'),
(8, 1, 'Macbeth', '978-1-234567-', 1623, 'L\'ambition dévorante conduit le noble Macbeth à commettre des actes impitoyables pour atteindre le pouvoir. Cette tragédie explore les thèmes de la culpabilité, de la corruption et de la destinée inéluctable dans l\'Écosse médiévale.', '2023-11-29', 'macbeth.jpg'),
(9, 1, 'Le Roi Lear', '978-1-234567-', 1608, ' Le roi Lear décide de diviser son royaume entre ses trois filles, basant sa décision sur leur amour pour lui. Cependant, la trahison, la folie et la cruauté émergent alors que Lear perd son pouvoir et sa santé mentale.\r\n', '2023-11-29', 'le roi lear.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `mel` varchar(40) NOT NULL,
  `motdepasse` varchar(100) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `ville` varchar(40) NOT NULL,
  `codepostal` int(11) NOT NULL,
  `profil` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`mel`, `motdepasse`, `nom`, `prenom`, `adresse`, `ville`, `codepostal`, `profil`) VALUES
('admin@admin.fr', '$argon2i$v=19$m=65536,t=4,p=1$eHVINndpWlNISWc1ZEc3bQ$rNKYtBTINQg6M/yc6DjQq4YWXmL7hMQUAacyMer7NWQ', 'Admin', 'Admin', 'Admin', 'Admin', 1, 'admin'),
('client@client.fr', '$argon2i$v=19$m=65536,t=4,p=1$cUlvYVBORGFhNHJtSDVXQQ$0yANCQSec2sda3kVUhy+QG7KWuGt+85r70F6IKewfVc', 'Client', 'Client', 'Client', 'Client', 2, 'client');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `auteur`
--
ALTER TABLE `auteur`
  ADD PRIMARY KEY (`noauteur`);

--
-- Index pour la table `emprunter`
--
ALTER TABLE `emprunter`
  ADD PRIMARY KEY (`mel`,`nolivre`,`dateemprunt`),
  ADD KEY `fk_emprunter_livre` (`nolivre`);

--
-- Index pour la table `livre`
--
ALTER TABLE `livre`
  ADD PRIMARY KEY (`nolivre`),
  ADD KEY `fk_livre_auteur` (`noauteur`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`mel`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `auteur`
--
ALTER TABLE `auteur`
  MODIFY `noauteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `livre`
--
ALTER TABLE `livre`
  MODIFY `nolivre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `emprunter`
--
ALTER TABLE `emprunter`
  ADD CONSTRAINT `fk_emprunter_livre` FOREIGN KEY (`nolivre`) REFERENCES `livre` (`nolivre`),
  ADD CONSTRAINT `fk_emprunter_utilisateur` FOREIGN KEY (`mel`) REFERENCES `utilisateur` (`mel`);

--
-- Contraintes pour la table `livre`
--
ALTER TABLE `livre`
  ADD CONSTRAINT `fk_livre_auteur` FOREIGN KEY (`noauteur`) REFERENCES `auteur` (`noauteur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
