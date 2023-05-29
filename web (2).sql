-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 22 mai 2023 à 11:15
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `web`
--

-- --------------------------------------------------------

--
-- Structure de la table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `id_c` int NOT NULL AUTO_INCREMENT,
  `libelle_c` varchar(50) NOT NULL,
  `desc_c` text NOT NULL,
  `video_c` varchar(120) NOT NULL,
  `id_parent` int NOT NULL,
  `image_c` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `playlist_id` int NOT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id_c`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `course`
--

INSERT INTO `course` (`id_c`, `libelle_c`, `desc_c`, `video_c`, `id_parent`, `image_c`, `playlist_id`, `id_user`) VALUES
(20, 'CSS', 'CSS 1', '752a98c85e011895b631e32d4c17da68.mp4', 0, 'ce832c92316d9e743ec611cef08bae3f.jpg', 5, 0),
(21, 'js ', 'JavaScript ', '30afbac7ea5b6ff2e1f87f2c64031169.mp4', 0, '8d82c0f80da2d0865b15efef5049bdef.png', 6, 0),
(22, 'Adobe Photoshop', 'Adobe Photoshop is a raster graphics editor developed and published by Adobe Inc. for Windows and macOS. It was originally created in 1987 by Thomas and John Knoll. Since then, the software has become the most used tool for professional digital art, especially in raster graphics editing. The software\'s name is often colloquially used as a verb (e.g. \"to photoshop an image\", \"photoshopping\", and \"photoshop contest\")[6] although Adobe discourages such use', '00c6e80a91951cdcb97bb0234bd0428e.mp4', 6, '40d72a781c0a4c44e77382e4bfe8a1cd.png', 7, 0),
(23, 'HTML', 'The HyperText Markup Language or HTML is the standard markup language for documents designed to be displayed in a web browser. It is often assisted by technologies such as Cascading Style Sheets (CSS) and scripting languages such as JavaScript.', 'a026291771aa3fdd0e0c41669ff39da6.mp4', 0, '8e4a14eb2fbfbd8294e1c45767d5e966.png', 10, 0),
(24, 'Business Intelligence', 'Business intelligence (BI) is a technology-driven process for analyzing data and delivering actionable information that helps executives, managers and workers make informed business decisions. As part of the BI process, organizations collect data from internal IT systems and external sources, prepare it for analysis, run queries against the data and create data visualizations, BI dashboards and reports to make the analytics results available to business users for operational decision-making and strategic planning.', '24af67a013e61f73f85aed311e24737f.mp4', 2, '762b551d1115e1b8e8e56b6eeb855f2c.jpg', 11, 0),
(25, 'React', 'https://www.youtube.com/watch?v=Tn6-PIqc4UM', 'e6ca70163802c80f9520ca03caa5437c.mp4', 0, '98a88c079fbb805bc818384784320da4.png', 12, 0);

-- --------------------------------------------------------

--
-- Structure de la table `playlist`
--

DROP TABLE IF EXISTS `playlist`;
CREATE TABLE IF NOT EXISTS `playlist` (
  `id_p` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id_p`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `playlist`
--

INSERT INTO `playlist` (`id_p`, `id_user`, `title`, `description`, `thumb`, `date`) VALUES
(11, 1, 'Business Intelligence', 'this a BI playlist', '0f2d6e8d06c57eab80c7675a774a5bd8.jpg', '2023-04-12'),
(12, 1, 'React', 'this is a React playlist', '85b9764f52a9742bab777b7622740f6c.png', '2023-05-20'),
(5, 1, 'CSS', 'CSS', 'ddae7ab5f850592918d3e4b77fa42a38.jpg', '2023-05-08'),
(10, 1, 'HTML', 'this a HTML playlist', '34469e9ee009ed45c3ab0a5d19ace1b3.png', '2023-05-10'),
(7, 1, 'Adobe Photoshop', 'this an Adobe Photoshop playlist', 'be77e53eda48181835cc8448ff4b081c.png', '2023-11-02'),
(8, 1, 'JavaScript', 'this a JavaScript playlist', '6d6c8354d186148ae737eb4c7cb14170.png', '2023-01-22');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_u` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `motdepasse` varchar(20) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `role` varchar(50) NOT NULL,
  `image` varchar(120) NOT NULL,
  PRIMARY KEY (`id_u`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_u`, `nom`, `prenom`, `email`, `motdepasse`, `tel`, `role`, `image`) VALUES
(1, 'sidia', 'lobna', 'lobnasidia@gmail.com', '123456', '99563293', 'tutor', 'pic-7.jpg'),
(5, 'brahem', 'meryem', 'meryembrahem@gmail.com', '123', '5568723', 'student', ''),
(4, 'sidia', 'khaoula', 'khaoulaaa@gmail.com', '1234', '99563293', 'student', ''),
(11, 'nizar', 'tormane', 'nizar@gmail.com', '123456', '92922892', 'tutor', 'b0ac41bad80b0fb8e2c8704875b89d5d.jpg'),
(8, 'khaoula', 'sidia', 'khaoula@gmail.com', '123456', '92922892', 'tutor', 'pc-4.jpg'),
(12, 'mohamed', 'sidia', 'med@gmail.com', '1234', '92922893', 'tutor', 'f22ac62d313e286d438484f1fd84bb23.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
