-- phpMyAdmin SQL Dump
-- version 4.9.6
-- https://www.phpmyadmin.net/
--
-- Hôte : iy2bt.myd.infomaniak.com
-- Généré le :  Dim 29 mai 2022 à 17:17
-- Version du serveur :  10.4.22-MariaDB-1:10.4.22+maria~stretch-log
-- Version de PHP :  7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `iy2bt_fwjudo`
--

-- --------------------------------------------------------

--
-- Structure de la table `clubs`
--

CREATE TABLE `clubs` (
  `id` int(11) NOT NULL,
  `club_name` varchar(200) NOT NULL,
  `address` varchar(300) NOT NULL,
  `city` varchar(300) NOT NULL,
  `zip` varchar(25) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(300) NOT NULL,
  `tel` varchar(42) NOT NULL,
  `baby_price` float DEFAULT NULL,
  `young_price` float DEFAULT NULL,
  `adult_price` float DEFAULT NULL,
  `logo_club` varchar(450) DEFAULT NULL,
  `founding_date` date DEFAULT NULL,
  `bank_number` varchar(200) DEFAULT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT 1,
  `isdeleted` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(1) NOT NULL DEFAULT 'n',
  `created_user` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_user` int(11) DEFAULT NULL,
  `modified_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `clubs`
--

INSERT INTO `clubs` (`id`, `club_name`, `address`, `city`, `zip`, `email`, `password`, `tel`, `baby_price`, `young_price`, `adult_price`, `logo_club`, `founding_date`, `bank_number`, `isactive`, `isdeleted`, `status`, `created_user`, `created_date`, `modified_user`, `modified_date`) VALUES
(1, 'judoteo', 'chaussée du tapis bleu', 'judoland', '6051', 'judoteo@tapis.be', 'tapisbleu51', '0499522595', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 'n', NULL, '2022-05-02 08:49:30', NULL, NULL),
(2, 'judottias', 'chaussée du tatami 56 ', 'tamiville', '6052', 'tatamirouge@judo.com', 'heheboi', '0499522596', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 'n', NULL, '2022-05-02 09:47:51', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `federations`
--

CREATE TABLE `federations` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `tel` varchar(25) NOT NULL,
  `email` varchar(350) NOT NULL,
  `password` varchar(350) NOT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT 1,
  `isdeleted` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(1) NOT NULL DEFAULT 'n',
  `created_user` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_user` int(11) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `federations`
--

INSERT INTO `federations` (`id`, `firstname`, `lastname`, `tel`, `email`, `password`, `isactive`, `isdeleted`, `status`, `created_user`, `created_date`, `modified_user`, `modified_date`) VALUES
(1, 'admin', 'admin', '+32000000000', 'admin@admin.com', '$2y$10$6PkBFvzyygUv62JhXBbDHOIpAq8dIH1nvZfd9w44/UWs6QdqLi9JO', 1, 0, 'n', NULL, '2022-05-16 08:35:41', NULL, '2022-05-16 08:35:41');

-- --------------------------------------------------------

--
-- Structure de la table `judokas`
--

CREATE TABLE `judokas` (
  `id` int(11) NOT NULL,
  `serial_number` int(50) DEFAULT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `address` varchar(300) NOT NULL,
  `city` varchar(250) NOT NULL,
  `zip` varchar(25) NOT NULL,
  `country` varchar(250) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `sex` varchar(1) NOT NULL,
  `birthdate` date NOT NULL,
  `id_club` int(11) DEFAULT NULL,
  `certif_path` varchar(500) DEFAULT NULL,
  `mutuelle_path` varchar(500) DEFAULT NULL,
  `photo_path` varchar(500) DEFAULT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT 1,
  `isdeleted` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(1) NOT NULL DEFAULT 'n',
  `created_user` int(11) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT current_timestamp(),
  `modified_user` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `judokas`
--

INSERT INTO `judokas` (`id`, `serial_number`, `firstname`, `lastname`, `email`, `password`, `address`, `city`, `zip`, `country`, `tel`, `sex`, `birthdate`, `id_club`, `certif_path`, `mutuelle_path`, `photo_path`, `isactive`, `isdeleted`, `status`, `created_user`, `created_date`, `modified_user`, `modified_date`) VALUES
(1, NULL, 'mataillus', 'meridius', 'coucou@lol.com', '', 'rue du tapis bleu 34', 'judoland', '6051', 'belgique', '499522595', '', '2023-07-01', NULL, NULL, NULL, NULL, 1, 0, 'n', NULL, '2022-05-02 09:29:02', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `licenses`
--

CREATE TABLE `licenses` (
  `id` int(20) NOT NULL,
  `judoka_id` int(20) NOT NULL,
  `club_id` int(20) NOT NULL,
  `is_payed` tinyint(1) NOT NULL DEFAULT 0,
  `is_finished` tinyint(1) NOT NULL DEFAULT 0,
  `isactive` tinyint(1) NOT NULL DEFAULT 1,
  `isdeleted` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(1) NOT NULL DEFAULT 'n',
  `created_user` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modified_user` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `logs`
--

CREATE TABLE `logs` (
  `id` int(20) NOT NULL,
  `old_value` varchar(250) DEFAULT NULL,
  `new_value` varchar(250) DEFAULT NULL,
  `action` varchar(200) DEFAULT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'n',
  `modified_user` int(11) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `federations`
--
ALTER TABLE `federations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `judokas`
--
ALTER TABLE `judokas`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `federations`
--
ALTER TABLE `federations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `judokas`
--
ALTER TABLE `judokas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
