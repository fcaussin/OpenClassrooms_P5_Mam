-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 29, 2018 at 12:48 PM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `p5mam`
--

-- --------------------------------------------------------

--
-- Table structure for table `children`
--

CREATE TABLE `children` (
  `id` int(11) NOT NULL,
  `parentId` int(11) NOT NULL,
  `childName` varchar(255) NOT NULL,
  `familyName` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `height` int(11) NOT NULL,
  `weight` decimal(6,2) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `children`
--

INSERT INTO `children` (`id`, `parentId`, `childName`, `familyName`, `birthday`, `height`, `weight`, `note`) VALUES
(1, 2, 'Romain', 'Lepetit', '2017-06-22', 80, '10.23', 'A le nez qui coule, peut-être un debut de rhume. A surveiller'),
(2, 3, 'Julie', 'Dupont', '2017-11-09', 70, '9.50', 'Fait des RGO'),
(4, 3, 'Elodie', 'Dupont', '2017-05-02', 55, '8.35', ''),
(9, 3, 'Aurélien', 'Dupont', '2017-10-25', 75, '10.31', 'Aurélien a oublié sa casquette à la M.A.M.');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `childId` int(11) NOT NULL,
  `dateReport` date NOT NULL,
  `behavior` varchar(255) NOT NULL,
  `comments` text NOT NULL,
  `activities` text NOT NULL,
  `meal` text NOT NULL,
  `nap` text NOT NULL,
  `info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `childId`, `dateReport`, `behavior`, `comments`, `activities`, `meal`, `nap`, `info`) VALUES
(1, 1, '2018-07-18', 'Parfait', 'Romain a bien mangé, il a été très sage. Une nette amélioration depuis une semaine, il s\'est habitué à son nouvel environnement.', 'Jeux de ballon et coloriage', 'Purée, jambon, yaourt et jus de fruit', '1h30', 'N\'oublie pas de préparer un goûter pour la semaine prochaine, une sortie au parc est prévu pour améliorer le contact en société.'),
(2, 2, '2018-07-18', 'Parfait', 'Julie a été adorable aujourd\'hui', 'Coloriage et jeux e groupe', 'Carottes râpées, blanc de poulet et flan', '2h', ''),
(3, 9, '2018-06-04', 'Bon', 'Première journée avec tous les enfants', 'Ballon', 'Purée, jambon, fromage', '2h', ''),
(4, 9, '2018-07-10', 'Mauvais', 'Ne veut pas prêter les jouets avec le nouveau copain de jeu', 'lego', 'viande, riz, yaourt', '1h45', ''),
(5, 9, '2018-07-17', 'Parfait', 'Aurélien a été un vrai petit ange aujourd\'hui\r\n', 'parc de jeu, piscine', 'pâte, poisson, tarte aux pommes', '1h30', 'Prévoir un goûter pour la sortie en vélo de demain'),
(6, 9, '2017-08-16', 'Bon', 'eefzfz frjneao rgonaeriogn gergaer', 'ergaergaerg', 'ger', '4H', ''),
(7, 9, '2017-07-12', 'Mauvais', 'ecdazefzefz evozenrtobine meng oenrgoeingt ozengeb ebneb', 'tbvzee ion ioezeteb ', 'lorem', 'fera', ''),
(8, 9, '2017-04-23', 'Bon', 'nounouend uceçc eiucnencencoec ecuneoucnecne', 'eucnueoncenc', 'cjcekjc ecec ecj ec ec', 'zninzcznc', ''),
(9, 9, '2018-07-02', 'Bon', 'Aurélien a été calme toute la journée, il a juste fait un petit caprice en partant du jardin d\'enfant', 'Jardin d\'enfants, jeux de société', 'poisson, légume et salade de fruits', '2h30', '&lt;script&gt;alert(&quot;Aurélien&quot;);&lt;/script&gt;'),
(11, 1, '2018-05-10', 'Parfait', 'afazfazf', 'fzafafergerb', 'azf', 'beber', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `admin`) VALUES
(1, 'Fabien', '$2y$10$YNjlTzW3v0TSjpOIP2k4rumEhV57MfksrfL1g/rKKwN7awdcbYTJG', 1),
(2, 'Lepetit', '$2y$10$YNjlTzW3v0TSjpOIP2k4rumEhV57MfksrfL1g/rKKwN7awdcbYTJG', 0),
(3, 'Dupont', '$2y$10$kQ8KpwnNKWm12LgA0B72Gu/B2jlhLtGAnouvgCBh0RJBW4cWjS/9q', 0),
(9, 'admin1', '$2y$10$.IrmV0YcefbWX1Tu2KFheeL/a8Vp9PiPeJXMPUSNfU24lzG2Yb8bm', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `children`
--
ALTER TABLE `children`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent` (`parentId`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `childCom` (`childId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `children`
--
ALTER TABLE `children`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `children`
--
ALTER TABLE `children`
  ADD CONSTRAINT `parent` FOREIGN KEY (`parentId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `childCom` FOREIGN KEY (`childId`) REFERENCES `children` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
