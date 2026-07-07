-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 07 juil. 2026 à 09:04
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données : `oneblog`
--
DROP DATABASE IF EXISTS `oneblog`;
CREATE DATABASE IF NOT EXISTS `oneblog` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `oneblog`;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(90) NOT NULL,
  `content` text NOT NULL,
  `datetime` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'ou now(), temps actuel si non renseigné',
  `actif` tinyint DEFAULT '0' COMMENT '0 => non visible\n1 => visible\n2 =>  article caché',
  `user_id` smallint UNSIGNED NOT NULL COMMENT 'clef étrangère qui fait le lien avec la table user',
  PRIMARY KEY (`id`),
  KEY `fk_article_user_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `datetime`, `actif`, `user_id`) VALUES
(1, 'Les factures de l\'IA laissent les dirigeants perplexes!', 'Les factures de l\'IA laissent les dirigeants perplexes après le passage à une tarification basée sur la consommation.\r\n\r\nSeuls 26 % des organisations parviennent à suivre leurs coûts en temps réel.\r\n\r\nLes dirigeants d\'entreprise éprouvent des difficultés à anticiper et à maîtriser les coûts opérationnels de l\'IA en raison du passage à la tarification basée sur l\'usage. \r\n\r\nSelon KPMG, ce manque de visibilité financière pousse près de la moitié des organisations à revoir le calendrier de leurs déploiements technologiques. Parallèlement, des géants comme Amazon et Microsoft investissent dans l\'ingénierie pour aider leurs clients à rentabiliser ces outils. Certaines organisations recherchent des modèles plus économiques. Enfin, le secteur reste confronté à des enjeux majeurs de gouvernance et de fiabilité des données produites par ces systèmes automatisés.\r\n\r\nLes développeurs d\'IA délaissent progressivement les abonnements à prix fixe au profit d\'une tarification à l\'usage, calquée sur la consommation réelle de tokens ou de prompts. Cette approche leur permet d\'aligner les revenus sur les coûts d\'infrastructure, souvent très élevés, tout en captant davantage de valeur auprès des utilisateurs les plus intensifs. Cependant, cette tarification a introduit des défis majeurs pour les utilisateurs et les entreprises.\r\n\r\nLes études montrent que pour les clients, cette flexibilité apparente cache un piège : les coûts deviennent imprévisibles et peuvent grimper très vite dès que l\'usage s\'intensifie, notamment avec des agents d\'IA autonomes ou des applications à fort volume. Cette imprévisibilité complique la budgétisation des entreprises et peut décourager l\'adoption, surtout pour les PME qui n\'ont pas la visibilité nécessaire pour anticiper leur facture mensuelle pour l\'IA.\r\n\r\nLes dirigeants d\'entreprises se retrouvent déconcertés par les factures liées à l\'IA. Une nouvelle étude menée par KPMG auprès de 2 145 hauts dirigeants à travers 20 pays révèle que près d\'un tiers d\'entre eux peinent à comprendre et à maîtriser les coûts opérationnels lors du déploiement de l\'IA à grande échelle.\r\n\r\n<a href=\"https://intelligence-artificielle.developpez.com/actu/384839/Les-factures-de-l-IA-laissent-les-dirigeants-perplexes-apres-le-passage-a-une-tarification-basee-sur-la-consommation-seuls-26-pourcent-des-organisations-parviennent-a-suivre-leurs-couts-en-temps-reel/\" target=\"_blank\">Suite et source</a>', '2026-07-07 10:32:31', 1, 1),
(2, 'Pourquoi les navigateurs HTML ralentissent les minuteries JavaScript ?', 'Il y a près de dix ans, lorsque je faisais partie de l\'équipe Microsoft Edge, on m\'a expliqué que les navigateurs faisaient cela pour éviter les « abus ». En d\'autres termes, il existe de nombreux sites web qui spamment setTimeout. Pour éviter de vider la batterie de l\'utilisateur ou de bloquer l\'interactivité, les navigateurs fixent un minimum spécial « bridé » de 4 ms.\r\n\r\nCela explique également pourquoi certains navigateurs augmentent l\'étranglement pour les appareils sur batterie (16 ms dans le cas de l\'ancien Edge), ou l\'étranglent encore plus agressivement pour les onglets en arrière-plan (1 seconde dans Chrome !).\r\n\r\nUne question m\'a toujours taraudé : si setTimeout était si mal utilisé, pourquoi les navigateurs ont-ils continué à introduire de nouveaux temporisateurs comme setImmediate (RIP), Promises, ou même de nouvelles fantaisies comme scheduler.postTask() ? Si setTimeout devait être affaibli, ces temporisateurs ne subiraient-ils pas le même sort ?\r\n\r\nJ\'ai écrit un long billet sur les timers JavaScript en 2018, mais jusqu\'à récemment, je n\'avais pas de bonne raison de revenir sur cette question. Puis j\'ai travaillé sur fake-indexeddb, qui est une implémentation purement JavaScript de l\'API IndexedDB, et cette question a refait surface. Il s\'avère qu\'IndexedDB souhaite auto-commettre les transactions lorsqu\'il n\'y a pas de travail en cours dans la boucle d\'événements - en d\'autres termes, une fois que toutes les micro-tâches sont terminées, mais avant qu\'aucune tâche (puis-je dire effrontément « macro-tâches » ?) n\'ait commencé.\r\n\r\nPour ce faire, fake-indexeddb utilisait setImmediate dans Node.js (qui partage certaines similitudes avec la version héritée du navigateur) et setTimeout dans le navigateur. Dans Node, setImmediate est en quelque sorte parfait, car il s\'exécute après les microtâches mais immédiatement avant toute autre tâche, et sans serrage. Dans le navigateur, cependant, setTimeout est plutôt sous-optimal : dans un benchmark, je voyais Chrome prendre 4,8 secondes pour quelque chose qui ne prenait que 300 millisecondes dans Node (un ralentissement de 16x !).\r\n\r\n<a href=\"https://javascript.developpez.com/actu/378970/Pourquoi-les-navigateurs-ralentissent-ils-les-minuteries-JavaScript-par-Nolan-Lawson/\" target=\"_blank\">Suite et source</a>', '2026-02-06 10:35:27', 1, 2),
(3, 'La version 7.0 du CMS pour PHP WordPress est disponible avec un nouveau tableau de bord IA', 'La version 7.0 du CMS pour PHP WordPress est disponible avec un nouveau tableau de bord d\'administration, des améliorations de l\'éditeur de blocs et une plateforme d\'intégration d\'IA.\r\n\r\nLa version officielle WordPress 7.0 « Armstrong » a été publiée avec un tableau de bord d\'administration repensé, des commandes d\'éditeur de blocs étendues et une nouvelle section « Connecteurs » permettant de gérer les intégrations IA directement depuis votre site web. Cette mise à jour modernise l’expérience du tableau de bord avec des transitions de page plus fluides. Cette version améliore également l’édition de contenu et la gestion des révisions. L\'une des principales nouveautés de cette mise à jour est également une nouvelle section « Connecteurs » dans les paramètres, offrant aux propriétaires de sites une plateforme centrale pour gérer les intégrations externes telles que Claude, Gemini, OpenAI et d\'autres services via des clés API ou des identifiants.\r\n\r\nWordPress (WP ou WordPress.org) est un système de gestion de contenu web. Conçu à l\'origine comme un outil de publication de blogs, il a évolué pour prendre en charge la publication d\'autres types de contenu web, notamment des sites web plus traditionnels, des listes de diffusion, des forums Internet, des galeries multimédias, des sites d\'adhésion, des systèmes de gestion de l\'apprentissage et des boutiques en ligne. Disponible sous forme de logiciel libre et open source, WordPress figure parmi les systèmes de gestion de contenu les plus populaires. WordPress est écrit en langage de programmation PHP et s\'appuie sur une base de données MySQL ou MariaDB. Ses fonctionnalités comprennent une architecture de plugins et un système de modèles, appelés « thèmes ».\r\n\r\nAprès plusieurs mois de développement, la version officielle WordPress 7.0 « Armstrong » a été publiée avec un tableau de bord d\'administration repensé, des commandes d\'éditeur de blocs étendues et une nouvelle section « Connecteurs » permettant de gérer les intégrations IA directement depuis votre site web. Cette mise à jour modernise l’expérience du tableau de bord avec des transitions de page plus fluides grâce à l’API CSS View Transitions, une nouvelle palette de commandes accessible via ⌘K ou Ctrl+K, et un nouveau jeu de couleurs par défaut harmonisé avec l’éditeur de blocs. Les utilisateurs qui préfèrent l’ancien look peuvent toujours revenir à la palette « Fresh » depuis les paramètres de leur profil.\r\n\r\nCette version améliore également l’édition de contenu et la gestion des révisions. Les révisions visuelles remplacent désormais les comparaisons de texte brut par des aperçus codés par couleur, permettant aux utilisateurs de parcourir les versions précédentes à l’aide d’un curseur comprenant des horodatages. WordPress 7.0 ajoute également de nouveaux blocs « Fil d’Ariane » et « Icône », améliore les blocs « Grille » et « Couverture » avec des options de mise en page plus réactives et des arrière-plans vidéo, et introduit des contrôles de visibilité basés sur l’appareil afin que des blocs spécifiques puissent être affichés ou masqués sur ordinateur, tablette ou mobile.\r\n\r\n<a href=\"https://php.developpez.com/actu/383489/La-version-7-0-du-CMS-pour-PHP-WordPress-est-disponible-avec-un-nouveau-tableau-de-bord-d-administration-des-ameliorations-de-l-editeur-de-blocs-et-une-plateforme-d-integration-d-IA/\" target=\"_blank\">Suite et source</a>', '2026-06-22 10:56:51', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` smallint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `title`, `description`) VALUES
(1, 'PHP', 'PHP (acronyme récursif pour PHP: Hypertext Preprocessor) est un langage de script open source incontournable pour le développement web dynamique. Il s\'exécute côté serveur pour générer du code HTML, qui est ensuite envoyé au navigateur de l\'utilisateur.'),
(2, 'SQL', 'SQL signifie Structured Query Language (Langage de Requêtes Structurées). C\'est le langage informatique standard utilisé pour communiquer avec et gérer les bases de données relationnelles.'),
(3, 'JavaScript', 'JavaScript est un langage de programmation interprété qui permet de rendre les pages web interactives et dynamiques. Avec le HTML et le CSS, il est l\'un des piliers du développement web. Il permet de créer des animations, de valider des formulaires et de modifier le contenu sans recharger la page.'),
(4, 'HTML', 'Le HTML (HyperText Markup Language) est le langage informatique standard utilisé pour créer et structurer le contenu des pages web. Il sert de \"squelette\" à un site internet en utilisant un système de balises (ex. <p> pour les paragraphes) pour organiser le texte, les images et les liens.'),
(5, 'CSS', 'Le CSS (Cascading Style Sheets ou feuilles de style en cascade) est le langage informatique fondamental qui décrit la mise en forme et la présentation visuelle des documents HTML et XML. Il gère l\'agencement, les couleurs, les polices et l\'apparence des pages web.'),
(6, 'GIT', 'Git est un système de contrôle de version distribué, gratuit et open-source. Il permet de suivre l\'historique des modifications apportées à des fichiers et de collaborer efficacement sur des projets. Créé en 2005 par Linus Torvalds, c\'est un outil fondamental pour le développement de logiciels...'),
(7, 'Python', 'Python est l\'un des langages les plus populaires, utilisé dans divers domaines : apprentissage automatique, création de sites web, tests logiciels, ...'),
(8, 'IA', 'L\'intelligence artificielle (IA) est l\'ensemble des systèmes informatiques capables d\'effectuer des tâches typiquement associées à l\'intelligence, telles que l\'apprentissage, le raisonnement, la résolution de problèmes, la perception ou la prise de décision. L\'intelligence artificielle est également');

-- --------------------------------------------------------

--
-- Structure de la table `category_has_article`
--

DROP TABLE IF EXISTS `category_has_article`;
CREATE TABLE IF NOT EXISTS `category_has_article` (
  `category_id` smallint UNSIGNED NOT NULL,
  `article_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`category_id`,`article_id`),
  KEY `fk_category_has_article_article1_idx` (`article_id`),
  KEY `fk_category_has_article_category1_idx` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `category_has_article`
--

INSERT INTO `category_has_article` (`category_id`, `article_id`) VALUES
(1, 3),
(2, 3),
(3, 2),
(4, 2),
(4, 3),
(5, 3),
(8, 1),
(8, 3);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` smallint UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID unique unsigned auto increment not null',
  `login` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL COMMENT 'login unique mais case sentive ( ADMIN != Admin )   not null\ncs case sensitive\nci case insensitive',
  `realname` varchar(100) DEFAULT NULL COMMENT 'NULL : non obligatoire',
  `pwd` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL COMMENT 'Mot de passe hash (empreinte), avec 255 max, case sensitive, actuellement 60  not null',
  `email` varchar(120) NOT NULL COMMENT 'email utilisateur  not null',
  `actif` tinyint UNSIGNED DEFAULT '2' COMMENT '0 => actif\n1 => banni\n2 => non activé\n3 => RGPD avec articles anonymes\n4 => RGPD avec articles cachés',
  `uniqid` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_UNIQUE` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `realname`, `pwd`, `email`, `actif`, `uniqid`) VALUES
(1, 'Admin', 'Pitz Michaël', '$2y$12$wuyHc9LiyhpqfVQyYxbij.aSnt63VaRnDEC8xjjdZ2d/rqn.16wum', 'michael.j.pitz@cf2m.be', 0, 'id_6a4cb91293cb15.20645681_-8e86b8107a52477984b3a043b410fc9df3597e664e45a641946e'),
(2, 'ThePiet', 'Sandron Pierre', '$2y$12$4diidcBDIDy3.ohejY/SYOeXKN9Id/l7sls/XF3Ir62t3xl7SNhBC', 'pierre.sandron@cf2m.be', 0, 'id_6a4cbb56589681.78326100_-78ff04a7675b38fbf5144c16ba89e92ef5f26186b98278b77e21');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `fk_article_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `category_has_article`
--
ALTER TABLE `category_has_article`
  ADD CONSTRAINT `fk_category_has_article_article1` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_category_has_article_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
