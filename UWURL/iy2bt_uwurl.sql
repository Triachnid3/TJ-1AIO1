-- phpMyAdmin SQL Dump
-- version 4.9.6
-- https://www.phpmyadmin.net/
--
-- Hôte : iy2bt.myd.infomaniak.com
-- Généré le :  Dim 29 mai 2022 à 17:16
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
-- Base de données :  `iy2bt_uwurl`
--

-- --------------------------------------------------------

--
-- Structure de la table `url`
--

CREATE TABLE `url` (
  `id` int(11) NOT NULL,
  `shorten_url` varchar(200) NOT NULL,
  `full_url` varchar(1000) NOT NULL,
  `clicks` int(11) NOT NULL,
  `qrcode` varchar(500) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `creator_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `url`
--

INSERT INTO `url` (`id`, `shorten_url`, `full_url`, `clicks`, `qrcode`, `status`, `creator_id`) VALUES
(48, '60793', 'https://www.w3schools.com/html/default.asp', 1, '', 1, 0),
(49, 'Github', 'https://github.com/E6KTeam7', 4, '', 1, 0),
(50, 'urlshortener', 'https://www.youtube.com/watch?v=V8C4BIKCVUA', 6, '', 1, 0),
(51, 'testTwitch', 'https://www.twitch.tv/nekuzaky', 1, '', 1, 0),
(52, 'cf06d', 'http://www.uwurl.fr/urlshortener', 3, '', 1, 0),
(54, 'OwO', 'https://www.youtube.com/watch?v=cvh0nX08nRw&t=36s', 7, '', 1, 0),
(55, 'c6095', 'https://learn.wallangues.be/platform/#/profile/lg-details/en_GB', 2, '', 1, 0),
(56, 'ff085', 'https://www.youtube.com/watch?v=V8C4BIKCVUA', 2, '', 1, 0),
(57, '195b6', 'https://www.w3schools.com/html/default.asp', 3, '', 1, 0),
(58, 'AdobeCrackN{Basique}', 'https://www.mediafire.com/folder/kjy2pzt4djqzd/adobe+pack', 2, '', 1, 0),
(59, 'd052b', 'http://www.uwurl.fr/urlshortener', 0, '', 1, 0),
(60, '6c122', 'https://www.w3schools.com/html/default.asp', 0, '', 1, 0),
(61, '782fa', 'http://www.youtube.com/watch?v=cvh0nX08nRw&t', 0, '', 1, 0),
(62, '96a33', 'http://www.youtube.com/watch?v=cvh0nX08nRw&t', 2, '', 1, 0),
(63, 'f7fbb', 'http://www.uwurl.fr/FreeNitro', 0, '', 1, 0),
(64, 'ea492', 'https://www.youtube.com/watch?v=suZEn78vWgs', 87, '', 1, 0),
(65, '69970', 'https://www.pierre-giraud.com/javascript-apprendre-coder-cours/operateur-arithmetique-affectation/', 3, '', 1, 0),
(66, '8b73b', 'https://www.youtube.com/watch?v=f02mOEt11OQ', 1, '', 1, 0),
(67, '0f1f9', 'https://stackoverflow.com/questions/16720627/using-a-variable-in-a-mysqli-query', 0, '', 1, 0),
(68, '4a67c', 'https://www.google.com/', 0, '', 1, 0),
(69, '15fa6', 'www.google.com', 1, '', 1, 2),
(70, 'c4965', 'https://www.google.com/', 0, '', 1, 0),
(71, 'dd9c1', 'https://www.youtube.com/watch?v=_ITiwPMUzho', 0, '', 1, 0),
(72, '52aff', 'https://www.google.com/', 0, '', 1, 0),
(73, '33cf0', 'https://www.youtube.com/watch?v=nYbPHaX6eAY', 1, '', 1, 0),
(74, 'a90f3', 'https://www.youtube.com/watch?v=r2ojSP0bkYY', 0, '', 1, 0),
(75, '4eaec', 'https://www.youtube.com/watch?v=r2ojSP0bkYY', 0, '', 1, 0),
(76, '6b603', 'https://www.youtube.com/watch?v=r2ojSP0bkYY', 0, '', 1, 0),
(77, '3c321', 'https://www.youtube.com/watch?v=IykZsZX5dUU', 0, '', 1, 0),
(78, '8a73b', 'https://www.youtube.com/watch?v=IykZsZX5dUU', 0, '', 1, 0),
(79, 'de50c', 'https://www.youtube.com/watch?v=p_KHnOIqia8', 0, '', 1, 0),
(80, 'd6661', 'https://www.youtube.com/watch?v=p_KHnOIqia8', 0, '', 1, 0),
(81, '8a303', 'https://www.youtube.com/watch?v=N09x0dQq2P0', 0, '', 1, 0),
(82, 'e0ffc', 'https://www.youtube.com/watch?v=wdBFroJC2-I', 0, '', 1, 0),
(83, 'e9bdc', 'https://www.youtube.com/watch?v=_fIye1BSKBY', 1, '', 1, 0),
(84, 'ae9c1', 'https://www.youtube.com/watch?v=qxloV18IOHE', 0, '', 1, 0),
(85, '94932', 'https://www.youtube.com/watch?v=BVd1uSjU_Ss', 0, '', 1, 0),
(86, 'dc921', 'https://www.youtube.com/watch?v=VMp6pq6_QjI', 0, '', 1, 0),
(87, 'test', 'https://www.youtube.com/watch?v=VMp6pq6_QjI', 0, '', 1, 0),
(88, '839ec', 'https://www.youtube.com/watch?v=KNMbDIKJ6T0', 0, '', 1, 0),
(89, 'c669c', 'https://www.youtube.com/watch?v=KNMbDIKJ6T0', 1, '', 1, 0),
(90, '6fc60', 'https://www.youtube.com/watch?v=Gk1qAMm0cqo', 0, '', 1, 0),
(91, '82c5d', 'https://www.youtube.com/watch?v=Gk1qAMm0cqo', 0, '', 1, 0),
(92, 'b1cb2', 'https://www.youtube.com/watch?v=Gk1qAMm0cqo', 0, '', 1, 0),
(93, 'ea85d', 'https://www.youtube.com/watch?v=Gk1qAMm0cqo', 0, '', 1, 0),
(94, '2e0c2', 'https://www.google.com/search?q=rename+sql+column+name&sxsrf=APq-WBvG5qyPupzOLv4YGNX8aD3rVmvEmA%3A1647279528794&source=hp&ei=qH0vYtiDLqeDi-gPy_2B2AQ&iflsig=AHkkrS4AAAAAYi-LuLxYGZAaT83MYz5KAMFOKoTJlVuk&oq=rename+sql+col&gs_lcp=Cgdnd3Mtd2l6EAEYATIFCAAQywEyBQgAEMsBMgUIABDLATIGCAAQFhAeMgYIABAWEB4yCAgAEBYQChAeMgYIABAWEB4yBggAEBYQHjIGCAAQFhAeMggIABAWEAoQHjoECCMQJzoLCC4QgAQQsQMQgwE6EQguEIAEELEDEIMBEMcBENEDOgsIABCABBCxAxCDAToECAAQQzoICAAQgAQQsQM6DgguEIAEELEDEMcBEKMCOggILhCABBCxAzoNCC4QsQMQxwEQowIQQzoHCAAQsQMQCjoFCAAQgARQAFjQFGDUH2gAcAB4AIABWYgBhwiSAQIxNJgBAKABAQ&sclient=gws-wiz', 0, '', 1, 0),
(95, 'zafzefz', 'https://www.google.com/search?q=rename+sql+column+name&sxsrf=APq-WBvG5qyPupzOLv4YGNX8aD3rVmvEmA%3A1647279528794&source=hp&ei=qH0vYtiDLqeDi-gPy_2B2AQ&iflsig=AHkkrS4AAAAAYi-LuLxYGZAaT83MYz5KAMFOKoTJlVuk&oq=rename+sql+col&gs_lcp=Cgdnd3Mtd2l6EAEYATIFCAAQywEyBQgAEMsBMgUIABDLATIGCAAQFhAeMgYIABAWEB4yCAgAEBYQChAeMgYIABAWEB4yBggAEBYQHjIGCAAQFhAeMggIABAWEAoQHjoECCMQJzoLCC4QgAQQsQMQgwE6EQguEIAEELEDEIMBEMcBENEDOgsIABCABBCxAxCDAToECAAQQzoICAAQgAQQsQM6DgguEIAEELEDEMcBEKMCOggILhCABBCxAzoNCC4QsQMQxwEQowIQQzoHCAAQsQMQCjoFCAAQgARQAFjQFGDUH2gAcAB4AIABWYgBhwiSAQIxNJgBAKABAQ&sclient=gws-wiz', 0, '', 1, 0),
(96, 'zaferzgrte\"ah', 'https://www.youtube.com/watch?v=Gk1qAMm0cqo', 0, '', 1, 0),
(97, 'f4802', 'https://stackoverflow.com/questions/9778888/uncaught-typeerror-cannot-set-property-onclick-of-null', 0, '', 1, 2),
(99, '565e0', 'https://sql.sh/cours/truncate-table', 1, '', 1, 2),
(100, '46383', 'https://sql.sh/cours/truncate-table', 0, '', 1, 2),
(101, '6d97b', 'https://sql.sh/cours/truncate-table', 0, '', 1, 2),
(102, '5f5a7', 'https://sql.sh/cours/truncate-table', 0, '', 1, 2),
(103, 'test2', 'https://sql.sh/cours/truncate-table', 1, '', 0, 2),
(104, 'update', 'https://sql.sh/cours/update', 2, NULL, 1, 2),
(105, 'furret', 'https://www.youtube.com/watch?v=ih9zBLDr_ro', 5, NULL, 1, 2),
(106, 'ff9', 'https://www.youtube.com/watch?v=xFaJ1A-d2y8&t=1s', 1, NULL, 1, 2),
(107, 'stellar', 'https://www.youtube.com/watch?v=wH3JmLBOnMU&list=RDEM1NYpcs6ZNbT4tRc9HVCVVQ&index=13', 3, NULL, 1, 2),
(108, 'glitchgta', 'https://www.youtube.com/watch?v=ih9zBLDr_ro', 2, NULL, 0, 2),
(109, 'headetbody', 'https://youtu.be/EbrOll5Y0k4', 2, NULL, 0, 2),
(110, 'entreleheadetlebody', 'https://youtu.be/EbrOll5Y0k4', 9, NULL, 1, 2),
(111, 'kirito', 'https://youtu.be/PkjPN6jee8w', 0, NULL, 0, 2),
(112, 'asuna', 'https://youtu.be/PkjPN6jee8w', 8, NULL, 1, 2),
(113, 'discord', 'https://discord.gg/JqmSZZpf', 26, NULL, 1, 2),
(114, 'professionnel', 'https://www.youtube.com/watch?v=rJuSTglqwlo', 5, NULL, 1, 2),
(115, '-_-', 'https://youtu.be/NZh5YxDpuK4', 9, NULL, 1, 2),
(116, 'discordgift', 'https://www.youtube.com/watch?v=cvh0nX08nRw&t=37s', 7, NULL, 1, 2),
(117, 'test0212', 'https://getbootstrap.com/docs/5.1/utilities/borders/#sizes', 1, NULL, 1, 2),
(118, 'doucemusique', 'https://youtu.be/hkUJv6wz0RI', 1, NULL, 1, 2),
(119, 'gwa-sport', 'https://www.gwa-sport.be/index.php', 1, NULL, 1, 2),
(120, 'edc79', 'https://github.com/Triachnid3/TJ-1AIO1', 0, NULL, 1, 2),
(121, '42a66', 'https://github.com/Triachnid3/TJ-1AIO1', 0, NULL, 1, 2),
(122, '0ddd3', 'https://github.com/Triachnid3/TJ-1AIO1', 0, NULL, 1, 2),
(123, 'test12345623', 'https://github.com/Triachnid3/TJ-1AIO1', 0, NULL, 1, 2),
(124, 'tj', 'https://github.com/Triachnid3/TJ-1AIO1', 0, NULL, 1, 2),
(125, 'retest', 'https://github.com/Triachnid3/TJ-1AIO1', 0, NULL, 1, 2),
(126, '9d0bd', 'https://wiki.minecolonies.ldtteam.com/source/tutorials/getting-started', 0, NULL, 1, 9),
(127, '8cba7', 'https://wordcounter.net/', 0, NULL, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(500) NOT NULL,
  `rank` int(11) NOT NULL DEFAULT 0,
  `isdeleted` tinyint(1) NOT NULL DEFAULT 0,
  `datecreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `modifieruser` int(11) DEFAULT NULL,
  `modifieddate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `rank`, `isdeleted`, `datecreated`, `modifieruser`, `modifieddate`) VALUES
(2, 'test', 'test@test.be', '$2y$10$UTfBCzMDyxXNm9fe4uAV0eXFRcWQzPs0gE7gUwFTLwUhLG2CgHEGK', 1, 0, '2022-03-14 11:28:47', 2, '2022-04-13 10:38:57'),
(3, 'test2', 'test2@test2.be', '$2y$10$id7/4Ap/127MQVH3LOOEL.no6FeNjV/hNWgZC/NPld6QC2qlFuDGS', 0, 0, '2022-03-14 11:31:14', 2, '2022-05-27 18:08:09'),
(4, 'test333', 'test333@test3.be', '$2y$10$HsAI/kBK/kEiIrbB/NwYIu3T0WLFosiYFqMwlj1STrWZodRCsZweq', 0, 0, '2022-03-14 11:36:33', 2, '2022-03-15 11:48:22'),
(5, 'Triachnid', 'mattias.cavalier3@gmail.com', '$2y$10$WPIXq9V7EYoOoxUrNFobIekFkPRZMelTM1VkCYxFpa80GABCS5ul.', 0, 0, '2022-03-14 11:50:07', 2, '2022-03-15 23:16:40'),
(6, 'TriachnidUPDATE2', 'mattias.cavalier3test@gmail.com', '$2y$10$F5m2kWHIn/dAqSsSkJ4BLO63RsA8o8RTHUoYyTP8nDXUN8aJ0v.ZS', 0, 1, '2022-03-14 11:51:11', 2, '2022-03-15 11:46:37'),
(7, 'aaab', 'aaab@aaa.aaa', '$2y$10$2iGLzq8S/N4Cnbjo7hNG4OMaUHLJjS8PynqVIlgGKjaq2CeZC/qTC', 0, 1, '2022-03-14 11:51:30', 2, '2022-03-29 18:31:07'),
(8, 'bbba', 'bbb@bbb.bbb', '$2y$10$1Ik09exdE4trVFhovi7o2Obq5Wez8QgbS.RbhvbmdHGpT.5U3sVN2', 0, 0, '2022-03-14 11:52:48', 2, '2022-03-29 18:16:52'),
(9, 'ccc', 'ccc@ccc.ccc', '$2y$10$9L7oQOmkdMFJZnVK1AMupeQ2I2/B3B2.o5lMM/5xcCtF5EnDTX9ci', 0, 0, '2022-03-14 11:54:27', NULL, '2022-03-14 20:02:12'),
(10, 'Thomas', 'thomas@lachevillekc.uwu', '$2y$10$n2lPvHxTAqRI1Sg01ISwvOxdZQu/oSau1x2ug9Vuzj9YBj77qLkEm', 0, 0, '2022-03-14 12:20:14', NULL, '2022-03-14 20:02:12'),
(12, 'Wanek', 'will.rougerie@gmail.com', '$2y$10$QOO.2BBkAbZ31wbi2J72vu2YULmMI554ub3wHAcmGsAqniL1JSBQi', 0, 0, '2022-03-16 19:20:34', 2, '2022-03-16 19:25:00'),
(13, 'www', 'www@www.www', '$2y$10$pnzLsdlctphxK9tpFt5rl.MN8Cb/qrgtPv8nTy.YQlw.2WZTCHCtG', 0, 0, '2022-03-16 19:20:48', NULL, '2022-03-16 19:20:48');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `url`
--
ALTER TABLE `url`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `url`
--
ALTER TABLE `url`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
