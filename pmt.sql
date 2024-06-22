-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 22 juin 2024 à 21:32
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
-- Base de données : `pmt`
--

-- --------------------------------------------------------

--
-- Structure de la table `affectation`
--

CREATE TABLE `affectation` (
  `id` int(11) NOT NULL,
  `WorkOrderID` int(11) NOT NULL,
  `RessourceID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `affectation`
--

INSERT INTO `affectation` (`id`, `WorkOrderID`, `RessourceID`) VALUES
(3, 53, 15),
(9, 57, 12),
(10, 60, 9),
(11, 57, 8),
(12, 60, 11),
(14, 57, 9),
(21, 57, 1),
(22, 57, 12),
(23, 57, 8),
(24, 57, 8),
(25, 57, 8),
(26, 57, 8),
(32, 60, 11);

-- --------------------------------------------------------

--
-- Structure de la table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `ProjectName` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `projects`
--

INSERT INTO `projects` (`id`, `ProjectName`, `Description`, `StartDate`, `EndDate`, `Status`, `CreatedAt`, `UpdatedAt`) VALUES
(22, 'Project 1', 'Description 2', '2024-06-12', '2024-06-21', 'Planned', '2024-06-14 08:47:51', '2024-06-19 15:12:23'),
(23, 'Project 2', 'Description 3', '2024-06-16', '2024-06-17', 'Completed', '2024-06-14 08:59:33', '2024-06-19 15:33:47'),
(24, 'Project 3', 'Description 4', '2024-06-15', '2024-06-17', 'Completed', '2024-06-14 10:53:12', '2024-06-14 10:56:17'),
(25, 'Project 4', 'Description 5', '2024-06-20', '2024-06-29', 'Ongoing', '2024-06-19 08:23:08', '2024-06-19 15:33:25'),
(27, 'project 5', 'Description 1', '2024-06-20', '2024-07-07', 'Ongoing', '2024-06-19 14:48:33', '2024-06-19 15:04:33'),
(28, 'project 3', 'Description 22', '2024-06-20', '2024-06-25', 'Planned', '2024-06-19 15:12:09', '2024-06-19 15:12:33'),
(29, 'project Test', 'Description 10', '2024-06-28', '2024-07-07', 'Planned', '2024-06-19 15:33:06', '2024-06-19 15:34:30'),
(30, 'proejcr111', 'Description 12', '2024-06-24', '2024-06-25', 'Completed', '2024-06-20 08:50:54', '2024-06-22 18:37:35');

-- --------------------------------------------------------

--
-- Structure de la table `ressouce`
--

CREATE TABLE `ressouce` (
  `id` int(11) NOT NULL,
  `WorkOrderID` int(11) NOT NULL,
  `nameressource` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `adresse` varchar(255) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAT` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ressouce`
--

INSERT INTO `ressouce` (`id`, `WorkOrderID`, `nameressource`, `email`, `description`, `adresse`, `CreatedAt`, `UpdatedAT`) VALUES
(1, 58, 'Mouna Reda  ', 'mouna.reda@alten.com', 'description 1', 'rabat,rabat-morocco', '2024-06-20 09:52:50', '2024-06-22 12:12:01'),
(8, 57, 'Douae Iraqui El houssani', 'douae.iraqui@alten.com', 'ssss', 'Kenitra,Morocco', '2024-06-20 10:28:30', '2024-06-20 10:36:39'),
(9, 58, 'Imad El Idrssi', 'imad.elidrissi@alten.com', 'des', 'fes,Fes-Morocco', '2024-06-20 10:37:29', '2024-06-20 10:37:39'),
(11, 58, 'ssss', 'sss@alten.com', 'sss', '', '2024-06-20 10:45:08', '2024-06-20 10:45:26'),
(12, 57, 'Idriss boudhar', 'idriss.boudhar@alten.com', 'description1', 'Casablanca-Morocco', '2024-06-20 11:48:12', '2024-06-20 11:48:12'),
(15, 60, 'Hamza el hasnaoui', 'hamza.elhasnaoui@alten.com', '', 'Fes,Fes-Morocco', '2024-06-20 13:48:46', '2024-06-20 13:48:46');

-- --------------------------------------------------------

--
-- Structure de la table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `WorkOrderID` int(11) NOT NULL,
  `TaskName` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `Priority` varchar(50) DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `tasks`
--

INSERT INTO `tasks` (`id`, `WorkOrderID`, `TaskName`, `Description`, `Status`, `Priority`, `StartDate`, `EndDate`, `CreatedAt`, `UpdatedAt`) VALUES
(38, 57, 'tache1', 'description 2', 'Ongoing', 'Medium', '2024-06-17', '2024-06-24', '2024-06-19 11:19:29', '2024-06-19 11:19:29'),
(39, 53, 'tache 2', 'desctip12', 'Planned', 'Medium', '2024-06-17', '2024-06-22', '2024-06-19 15:52:53', '2024-06-20 13:37:46');

-- --------------------------------------------------------

--
-- Structure de la table `workorders`
--

CREATE TABLE `workorders` (
  `id` int(11) NOT NULL,
  `ProjectID` int(11) NOT NULL,
  `WorkOrderNumber` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Country` varchar(255) DEFAULT NULL,
  `Plant` varchar(255) DEFAULT NULL,
  `STELLANTISRequester` varchar(255) DEFAULT NULL,
  `ALTENPilot` varchar(255) DEFAULT NULL,
  `ReceptionDateWO` date DEFAULT NULL,
  `DeadlineSTELLANTISWO` date DEFAULT NULL,
  `StartOfProductionALTEN` date DEFAULT NULL,
  `DeliveryDate` date DEFAULT NULL,
  `ValidationCriteria` text DEFAULT NULL,
  `Priority` varchar(255) DEFAULT NULL,
  `NumberOfDeliverables` int(11) DEFAULT NULL,
  `NumberOfValidatedDeliverablesRFT` int(11) DEFAULT NULL,
  `RFT` varchar(255) DEFAULT NULL,
  `NumberOfValidatedDeliverablesOTD` int(11) DEFAULT NULL,
  `OTD` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `workorders`
--

INSERT INTO `workorders` (`id`, `ProjectID`, `WorkOrderNumber`, `Description`, `StartDate`, `EndDate`, `Status`, `CreatedAt`, `UpdatedAt`, `Country`, `Plant`, `STELLANTISRequester`, `ALTENPilot`, `ReceptionDateWO`, `DeadlineSTELLANTISWO`, `StartOfProductionALTEN`, `DeliveryDate`, `ValidationCriteria`, `Priority`, `NumberOfDeliverables`, `NumberOfValidatedDeliverablesRFT`, `RFT`, `NumberOfValidatedDeliverablesOTD`, `OTD`) VALUES
(53, 23, 'WorkOrderNumber2', 'Description of Project 2', '2024-06-10', '2024-06-15', 'Ongoing', '2024-06-14 10:08:54', '2024-06-20 13:37:22', 'Eurreupeen', 'PLANT2', 'sssss', '', '2024-06-10', '2024-06-15', '2024-06-10', '2024-06-10', 'Validate3', 'High', 100, 100, '100%', 101, '10%'),
(57, 22, 'WorkOrderNumber3', 'Description of Project 3', '2024-06-15', '2024-06-17', 'Completed', '2024-06-14 14:22:56', '2024-06-20 13:34:24', 'Africain ', '', '', '', '2024-06-17', '2024-06-21', '2024-06-24', '2024-06-27', 'Validate2', 'High', 88, 72, '908%', 90, '102%'),
(58, 25, 'WorkOrderNumber4', 'Description of Project 4', '2024-06-21', '2024-06-22', 'Completed', '2024-06-19 09:31:39', '2024-06-20 13:33:49', 'Morocco', 'Plant 4', '', '', '2024-06-28', '2024-06-23', '2024-06-24', '2024-06-26', 'Validate3', 'Medium', 79, 100, '113%', 90, '114%'),
(60, 29, 'WorkOrderNumber5', 'Description of Project 5', '2024-06-26', '2024-06-25', 'Ongoing', '2024-06-20 13:44:09', '2024-06-20 13:44:09', 'Morocco', 'Plant 1', 'By requester 2', 'Pilot 2', NULL, '2024-07-07', '2024-07-01', '2024-07-03', 'validate2', 'Medium', 100, 19, '', 22, '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `affectation`
--
ALTER TABLE `affectation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `affec_ibkf_1` (`RessourceID`),
  ADD KEY `affec_ibkf_2` (`WorkOrderID`);

--
-- Index pour la table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ressouce`
--
ALTER TABLE `ressouce`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ressource_ibkf_1` (`WorkOrderID`);

--
-- Index pour la table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_ibfk_2` (`WorkOrderID`);

--
-- Index pour la table `workorders`
--
ALTER TABLE `workorders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_ibkf_1` (`ProjectID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `affectation`
--
ALTER TABLE `affectation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `ressouce`
--
ALTER TABLE `ressouce`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `workorders`
--
ALTER TABLE `workorders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `affectation`
--
ALTER TABLE `affectation`
  ADD CONSTRAINT `affec_ibkf_1` FOREIGN KEY (`RessourceID`) REFERENCES `ressouce` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `affec_ibkf_2` FOREIGN KEY (`WorkOrderID`) REFERENCES `workorders` (`id`);

--
-- Contraintes pour la table `ressouce`
--
ALTER TABLE `ressouce`
  ADD CONSTRAINT `ressource_ibkf_1` FOREIGN KEY (`WorkOrderID`) REFERENCES `workorders` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`WorkOrderID`) REFERENCES `workorders` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `workorders`
--
ALTER TABLE `workorders`
  ADD CONSTRAINT `projects_ibkf_1` FOREIGN KEY (`ProjectID`) REFERENCES `projects` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
