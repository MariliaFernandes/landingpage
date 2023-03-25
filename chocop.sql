
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--

DROP TABLE IF EXISTS `contacts_msgs`;
CREATE TABLE IF NOT EXISTS `contacts_msgs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `contacts_msgs`
--

INSERT INTO `contacts_msgs` (`id`, `name`, `email`, `subject`, `content`, `created`, `modified`) VALUES
(1, 'Choco', 'chocolateovochoco@gmail.com', 'Escrever 1', 'Escrever 1', '2021-03-18 10:05:50', NULL);
COMMIT;


