-- phpMyAdmin SQL Dump
-- version 2.6.0-pl3
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost:3306
-- Généré le : Lundi 25 Septembre 2006 à 14:28
-- Version du serveur: 4.1.12
-- Version de PHP: 4.3.10
-- 
-- Base de données: `livretapp`
-- 
CREATE DATABASE `livretapp` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE livretapp;

-- --------------------------------------------------------

-- 
-- Structure de la table `acteurs_espace`
-- 

CREATE TABLE `acteurs_espace` (
  `id_espace` int(10) unsigned NOT NULL default '0',
  `id_acteur` bigint(20) NOT NULL default '0',
  `nouveaute_espace` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id_espace`,`id_acteur`),
  KEY `id_acteur` (`id_acteur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `acteurs_espace`
-- 

INSERT INTO `acteurs_espace` VALUES (1, 23283, 1);
INSERT INTO `acteurs_espace` VALUES (1, 23291, 1);
INSERT INTO `acteurs_espace` VALUES (1, 23293, 1);
INSERT INTO `acteurs_espace` VALUES (1, 23305, 0);
INSERT INTO `acteurs_espace` VALUES (3, 23899, 1);
INSERT INTO `acteurs_espace` VALUES (3, 23901, 0);
INSERT INTO `acteurs_espace` VALUES (5, 23352, 1);
INSERT INTO `acteurs_espace` VALUES (5, 23828, 0);
INSERT INTO `acteurs_espace` VALUES (5, 23830, 1);
INSERT INTO `acteurs_espace` VALUES (6, 23371, 0);
INSERT INTO `acteurs_espace` VALUES (6, 23899, 1);
INSERT INTO `acteurs_espace` VALUES (6, 23904, 1);
INSERT INTO `acteurs_espace` VALUES (6, 23908, 1);
INSERT INTO `acteurs_espace` VALUES (6, 23911, 1);
INSERT INTO `acteurs_espace` VALUES (6, 23914, 1);
INSERT INTO `acteurs_espace` VALUES (6, 23920, 1);
INSERT INTO `acteurs_espace` VALUES (6, 23926, 1);
INSERT INTO `acteurs_espace` VALUES (6, 23928, 1);
INSERT INTO `acteurs_espace` VALUES (6, 23931, 1);
INSERT INTO `acteurs_espace` VALUES (7, 23371, 0);
INSERT INTO `acteurs_espace` VALUES (7, 23607, 1);
INSERT INTO `acteurs_espace` VALUES (7, 23901, 1);
INSERT INTO `acteurs_espace` VALUES (7, 23903, 1);
INSERT INTO `acteurs_espace` VALUES (7, 23907, 1);
INSERT INTO `acteurs_espace` VALUES (7, 23910, 1);
INSERT INTO `acteurs_espace` VALUES (7, 23913, 1);
INSERT INTO `acteurs_espace` VALUES (7, 23916, 1);
INSERT INTO `acteurs_espace` VALUES (7, 23918, 1);
INSERT INTO `acteurs_espace` VALUES (7, 23922, 1);
INSERT INTO `acteurs_espace` VALUES (7, 23924, 1);
INSERT INTO `acteurs_espace` VALUES (7, 23930, 1);
INSERT INTO `acteurs_espace` VALUES (7, 23933, 1);

-- --------------------------------------------------------

-- 
-- Structure de la table `aide`
-- 

CREATE TABLE `aide` (
  `id_aide` int(11) NOT NULL auto_increment,
  `texte_aide` longtext NOT NULL,
  `titre_aide` varchar(200) NOT NULL default '',
  `url_image_aide` longtext NOT NULL,
  PRIMARY KEY  (`id_aide`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

-- 
-- Contenu de la table `aide`
-- 

INSERT INTO `aide` VALUES (2, 'L''apprenti pourra joindre des documents lorsqu''il saisira des données sur LEA. Ces documents seront accessibles par les acteurs autorisés du livret.', 'Joindre des fichiers à la déclaration', '');
INSERT INTO `aide` VALUES (3, 'Une déclaration est effectuée pour une période en particulier. Chaque période comporte une date de fin. Après cette date, on accepte un certain délai au delà duquel la déclaration sera bloquée et non modifiable. Ex : 15 jours, pour une période allant du 01/01/2006 au 31/01/2006, laissent jusqu''au 15/02/2006 aux acteurs du livret four effectuer leur déclaration. Passée cette date, la déclaration est vérouillée en l''état.\r\nNB : ce délai s''applique de façon homogène à toutes les déclarations, quelles que soient les périodes.', 'La durée d''activation d''une déclaration', '');
INSERT INTO `aide` VALUES (4, 'La modalité " libre " permet aux acteurs du livret de saisir dans LEA certaines appréciations.  les données saisies seront enregistrées par LEA et disponibles, mais elles ne feront pas l''objet d''un traitement statistique.', 'Déclaration d''activités libre', '');
INSERT INTO `aide` VALUES (5, 'La déclaration d''activités " guidée " oriente l''apprenti, ou tout autre acteur, en lui proposant de compléter certaines données. Il est ainsi guidé par une arborescence que vous serez amené à élaborer (exemple d''arborescence : référentiel métier, référentiel de tâches, programme de formation...).\r\nLes données saisies (évaluant par exemple : des activités réalisées, des matières abordées, des compétences acquises...) feront l''objet d''un traitement statistique par LEA. Ceci permet à l''apprenti de s''évaluer au regard de critères de performance (nombre de fois mini, note maxi, acquis/en cours d''acquisition/non acquis, etc.) que vous allez déterminer.', 'Déclaration d''activités guidée avec un référentiel', '');
INSERT INTO `aide` VALUES (8, 'Indiquez ici l''acteur du livret à qui vous proposez la, ou les, modalité que vous allez déterminer.\r\nUne modalité proposée à un acteur va déterminer la façon dont celui-ci saisira des données sur le livret. Il peut s''agir de champ libre (texte), d''une liste de choix (à cliquer), etc.\r\nPour créer une nouvelle modalité à l''acteur choisi, cliquez sur  " Proposer une modalité ".\r\n\r\nNB : Vous retrouvez dans ce menu déroulant la désignation des acteurs que vous avez décidé (sur la page précédente) d''utiliser.', 'Modalités', '');
INSERT INTO `aide` VALUES (10, 'Aperçu de la modalité créée', 'Affichage comme suit', '');
INSERT INTO `aide` VALUES (11, 'La modalité traitée apparaîtra aux dates suivantes, comptant un délai de 15 jours après l''échéance affichée. Les périodes sont définies dans la rubrique préalable « mettre à jour les périodes ».', 'Déclaration aux périodes suivantes', '');
INSERT INTO `aide` VALUES (15, 'Donnez un titre significatif à la modalité que vous allez créer. Ce sont les mots, ou la phrase, que vous allez écrire ici qui seront proposés à l''acteur concerné. Exemple :" Votre avis sur la période en entreprise " ou bien " Inscrivez ici les activités réalisées durant la période ", etc.', 'Nouvelle modalité de saisie', '');
INSERT INTO `aide` VALUES (16, 'Indiquez ici l''acteur du livret à qui vous proposez la, ou les, modalité que vous allez déterminer. Elle devra losqu''elle se connectera à LEA compléter la rubrique que vous proposez.\r\n\r\nNB : Vous retrouvez dans ce menu déroulant la désignation des acteurs que vous avez décidé (sur la page précédente) d''utiliser.\r\n', 'Nouvelle modalité de saisie', '');
INSERT INTO `aide` VALUES (17, 'Choisissez ici les périodes auxquelles la modalité sera proposée à l''acteur concerné', 'Nouvelle modalité de saisie', '');
INSERT INTO `aide` VALUES (19, 'Indiquez ici le nombre de choix proposés à l''utilisateur. (ex : 3 choix pour "acquis, en cours d''acquisition, non acquis " ).', 'Liste de choix', '');
INSERT INTO `aide` VALUES (20, 'Intitulé de la réponse ', 'Titre du choix(n)', '');
INSERT INTO `aide` VALUES (21, 'L''apprenti ne peut cocher qu''une seule réponse parmis tous les choix proposés', 'Choix unique', '');
INSERT INTO `aide` VALUES (22, 'L''apprenti peut cocher plusieurs réponses parmis les choix proposés', 'Choix multiple', '');
INSERT INTO `aide` VALUES (23, 'La déclaration d''activités guidée avec un référentiel oriente l''apprenti, ou tout autre acteur, en lui proposant de compléter des données. Pour ce faire, il devra suivre une arborescence que vous allez concevoir.\r\n\r\nPour effectuer le suivi d''un apprenti, que ce soit en entreprise ou au centre de formation, on peu utiliser un tableau de compétences, un programme, etc. Souvent sous la forme de tableaux, ces référentiels peuvent prendre la forme d''une arborescence. C''est ce fonctionnement qu''adopte LEA.\r\n\r\nDessin de l''arbre ici\r\n\r\n\r\nChaque " branche "appartient à un " niveau ". Cet arbre possède deux " niveaux ", le dernier étant le niveau " feuille". Les" branches " et les " feuilles "  portent chacune un nom (ici : Coquilles...... pour les branches et : ,,,,, pour les feuilles.\r\n\r\n La validation se fait toujours au niveau d''une " feuille ". Dans l''exemple, l''utilisateur devra indiquer pour chaque feuille si l''activité est acquise;;;)\r\n\r\nLes données saisies feront l''objet d''un traitement statistique par LEA. Ceci permet à l''apprenti de s''évaluer au regard de critères de performance que vous allez déterminer (ici par exemple : nombre de fois où une activité doit être acquise). Cela permet aussi à un enseignant de mesurer, par exemple,  l''évolution des acquisistions d''un apprenti en regard de sa classe.', 'Création d''un arbre pour le suivi guidé en entreprise', 'arbre.jpg');
INSERT INTO `aide` VALUES (24, 'L''arbre correspond à la forme adoptée pour référencier les données. Un thème, ou ensemble, représente un tronc qui se décompose en différentes branches correspondant aux niveaux chronologiques à compléter par les protagonistes. Chaque branche se décompose en feuilles, ou taches, finalités de l''arbre.', 'L''arbre', '');
INSERT INTO `aide` VALUES (25, 'Niveaux successifs (exemple d''intitulés pour deux niveaux : « activités », suivi de « taches »)\r\n', 'Libellé des niveaux', '');
INSERT INTO `aide` VALUES (26, 'Entrer les données correspondant au premier niveau, puis en cliquant sur cette information, remplir le champ de texte du second niveau (exemple : niveau « activités » : pâtisserie,  tâche : tarte aux fraises)', 'Modifier le contenu', '');
INSERT INTO `aide` VALUES (27, 'Dernier niveau de l''arborescence', 'Feuille', '');
INSERT INTO `aide` VALUES (28, 'Changer le contenu d''une tache', 'Modifier ou mettre à jour une feuille', '');
INSERT INTO `aide` VALUES (29, 'Changer le titre du contenu de la feuille ', 'Modifier le libellé', '');
INSERT INTO `aide` VALUES (30, 'Les critères de performance vont permettre aux apprentis d''être suivis selon un axe de travail commun, ou encore comparés entre eux. Ces critères sont établis dans la rubrique "validation"\r\nLes objectifs de performance doivent restés cohérents avec le nombre de tâches et le nombre de périodes.  \r\nLes précisions apportées à la déclaration , s''afficheront devant chaque tâche déclarée. \r\nLes étapes suivantes consistent à modifier le niveau de performance attendu (nombre de fois qu''une tache x devra-t-être déclarée par l''apprenti, par exemple). \r\nLes précisions apportées à la déclaration s''afficheront devant chaque tâche déclarée\r\nSi un 0 (fois) est conservé, cela signifie qu''aucun objectif n''est fixé pour une tâche, ce qui n''empêche pas l''apprenti de la déclarer. Elle sera alors automatiquement considérée comme validée.', 'Critères de performance', '');
INSERT INTO `aide` VALUES (31, 'L''apprenti devra déclarer avoir effectué, au moins un certain nombre de fois, l''action de la modalité, de manière autonome', 'Réalisation d''une tache en autonomie', '');
INSERT INTO `aide` VALUES (32, 'L''apprenti devra déclarer avoir effectué, au moins un certain nombre de fois, l''action de la modalité, en profitant d''une aide (de son maître de stage par exemple)', 'Réalisation d''une tache assisté', '');
INSERT INTO `aide` VALUES (33, 'L''apprenti devra déclarer avoir acquis la tâche, au moins un certain nombre de fois sur l''ensemble des périodes', 'Acquisition de la tâche', '');
INSERT INTO `aide` VALUES (34, 'L''apprenti pourra déclaré au moins... fois ne pas avoir acquis une tâche', 'Non acquisition de la tâche', '');
INSERT INTO `aide` VALUES (35, 'Déterminer le barème sur lequel l''apprenti sera évalué (exemple : notes sur 20, sur 10, etc)', 'Ratio d''évaluation', '');
INSERT INTO `aide` VALUES (36, 'Apporter des modification au titre de l''arbre ainsi qu''aux intitulés des niveaux. Les titres attribués précédemment aux feuilles ne sont pas modifiables.\r\n', 'Modifier l''intitulé de l''arbre', '');
INSERT INTO `aide` VALUES (37, 'Supprimer l''arbre entier. Toutes les informations initialisées seront effacées.', 'Supprimer l''arbre', '');
INSERT INTO `aide` VALUES (38, 'Effacer le contenu de l''arbre. L''arbre, son intitulé et ses niveaux seront toujours existants. Seule la totalité des tâches de chaque niveau sera supprimée.', 'Vider l''arbre', '');
INSERT INTO `aide` VALUES (39, 'Afficher l''arborescence de l''arbre afin de visionner la structure des tâches créées précédemment.', 'Afficher l''arbre', '');
INSERT INTO `aide` VALUES (40, 'La validation consiste à apporter des précisions aux déclarations. En créant une modalité de validation, vous pourrez définir la personne qui devra apporter les précisions pour une période donnée. Un type de traitement des informations est à choisir : sous forme de fréquence, de ratio, de texte ou d''une liste de choix. ', 'Valider l''arbre', '');
INSERT INTO `aide` VALUES (41, 'Affichage de la globalité du contenu de l''arbre. \r\nEn cliquant sur le graphique d''une tâche, il est possible de mettre à jour les critères de performance qui peuvent avoir déjà été établi lors de la première étape de modification du contenu. \r\nLes objectifs de performance doivent restés cohérents avec le nombre de tâches et le nombre de périodes. \r\nGrâce à cette fonctionnalité, l''arbre atteint sa maturité : les apprentis peuvent être comparés entre eux, par rapport à des critères définis. \r\n', 'Performance', '');
INSERT INTO `aide` VALUES (42, 'Vous pouvez ici établir des périodes. Ces périodes correspondent à des déclarations réalisées par l''un des acteurs du livret. Il peut s''agir de périodes calendaires régulières (ex : période 1, du 01/01/2006 au 31/01/2006, 01/02/2006 au 28/02/2006) ou occasionnelles (ex :bilan fin d''année, du 20/12/2006 au 22/12/2006). LEA prendra en compte la date de fin de période comme une date d''échéance.', 'Mettre à jour le calendrier des périodes', '');
INSERT INTO `aide` VALUES (43, 'Vous pouvez ici élaborer l''environnement de suivi de l''apprenti en entreprise.\r\nC''est ici que vous pourrez désigner le nom de la personne référente de l''apprenti en entreprise ainsi que la personne responsable pédagogiquement qui suit l''apprenti pour le centre de formation.\r\nCe suivi peut être guidé : LEA pourra effectuer des opérations statistiques avec les données saisies par les acteurs du livret; ou libre : les données saisies seront enregistrées par LEA et disponibles mais ne feront pas l''objet d''un traitement statistique.', 'Configurer le suivi de vos apprentis en entreprise', '');
INSERT INTO `aide` VALUES (44, 'Cette fonctionnalité permet d''élaborer l''environnement de suivi de l''apprenti au CFA. Les étapes suivantes vont vous permettre de créer une arborescence, assimilable à la forme d''un arbre. Cet arbre servira de lien direct entre le CFA et l''apprenti. Vous aurez la possibilité d''instaurer des modules pouvant concerner aussi bien les matières de travail évaluées, les compétences, que les programmes, etc. \r\nLe suivi pourra être effectué de manière libre ou bien guidée. Un suivi libre consiste à permettre à l''apprenti de remplir, en autonomie, des champs de texte ou cocher des cases , correspondant à une rubrique. Les données que l''élève aura fourni seront informatives et différentes selon les apprentis. \r\nLe suivi guidé va également autoriser l''apprenti à compléter des champs par des informations concernant son travail, mais elles seront à caractère général et commun à tous les élèves de la classe. Ces modules concernent les notes, la réalisation de tâches définies selon une fréquence fixée, référentielle, etc. Ainsi les critères de suivi commun à la classe, permettront à  l''apprenti d''être évalué selon une référence de temps, de travail effectué ou encore comparé aux autres élèves. ', 'Configurer le suivi de vos apprentis au CFA', '');
INSERT INTO `aide` VALUES (45, 'La mise à jour de la liste des enseignants de la formation permet d''accéder à l''ensemble des enseignants du CFA. Les noms sont classés en ordre alphabétique. Vous pourrez ainsi cocher les enseignants intervenant dans la formation que vous traitez actuellement.', 'Mettre à jour la liste des enseignants de votre formation', '');
INSERT INTO `aide` VALUES (46, 'Cette rubrique vous permet d''attribuer ou de modifier, le tuteur propre à  chaque apprenti. ', 'Mettre à jour les TUTEUR(s) de vos apprentis', '');
INSERT INTO `aide` VALUES (47, 'Il vous est proposé choisir vous même le graphisme que vous souhaitez attribuer au site, espace de travail commun aux apprentis, maître d''apprentissage, tuteurs, enseignants, parents. \r\nVous pourrez intégrer votre propre logo du CFA, ou en choisir un préexistant dans une liste.\r\nL''image de la page d''accueil, de la formation concernée, peut également être intégrée librement, ou emprunter à une bibliothèque d''image disponibles.\r\nUn choix de couleurs et d''organisation des menus vous est également proposé, à travers deux styles graphiques. \r\n', 'Configurer la charte graphique de votre formation', '');
INSERT INTO `aide` VALUES (48, 'Mettre à jour le calendrier des périodes \r\nCette première étape permet d''établir des périodes, selon l''ordre que vous désirez. Ces périodes seront associées à des tâches, qui devront se dérouler durant les dates spécifiées. A la création de l''arborescence des modalités (étape suivant), vous retrouverez cette période, et ainsi leur attribuer un contenu de tâches. Les périodes sont des limites temporelles référentielles.  \r\nVous aurez la possibilité de choisir à quelles classes seront déclarées les périodes que vous aurez définies.\r\n\r\nConfigurer le suivi de vos apprentis en entreprise \r\nCette fonctionnalité permet d''élaborer l''environnement de suivi de l''apprenti en entreprise. Les étapes suivantes vont vous permettre de créer une arborescence, assimilable à la forme d''un arbre. Cet arbre servira de lien direct entre l''entreprise et l''apprenti. Vous aurez la possibilité d''instaurer des modules pouvant concerner aussi bien les matières de travail évaluées, les compétences, que les programmes, etc. \r\nLe suivi pourra être effectué de manière libre ou bien guidée. Un suivi libre consiste à permettre à l''apprenti de remplir, en autonomie, des champs de texte ou cocher des cases , correspondant à une rubrique. Les données que l''élève aura fourni seront informatives et différentes selon les apprentis. \r\nLe suivi guidé va également autoriser l''apprenti à compléter des champs par des informations concernant son travail, mais elles seront à caractère général et commun à tous les élèves de la classe. Ces modules concernent les notes, la réalisation de tâches définies selon une fréquence fixée, référentielle, etc. Ainsi les critères de suivi commun à la classe, permettront à  l''apprenti d''être évalué selon une référence de temps, de travail effectué ou encore comparé aux autres élèves. \r\n\r\nConfigurer le suivi de vos apprentis au CFA  \r\nCette fonctionnalité permet d''élaborer l''environnement de suivi de l''apprenti au CFA. Les étapes suivantes vont vous permettre de créer une arborescence, assimilable à la forme d''un arbre. Cet arbre servira de lien direct entre le CFA et l''apprenti. Vous aurez la possibilité d''instaurer des modules pouvant concerner aussi bien les matières de travail évaluées, les compétences, que les programmes, etc. \r\nLe suivi pourra être effectué de manière libre ou bien guidée. Un suivi libre consiste à permettre à l''apprenti de remplir, en autonomie, des champs de texte ou cocher des cases , correspondant à une rubrique. Les données que l''élève aura fourni seront informatives et différentes selon les apprentis. \r\nLe suivi guidé va également autoriser l''apprenti à compléter des champs par des informations concernant son travail, mais elles seront à caractère général et commun à tous les élèves de la classe. Ces modules concernent les notes, la réalisation de tâches définies selon une fréquence fixée, référentielle, etc. Ainsi les critères de suivi commun à la classe, permettront à  l''apprenti d''être évalué selon une référence de temps, de travail effectué ou encore comparé aux autres élèves. \r\n\r\nMettre à jour la liste des enseignants de votre formation \r\nLa mise à jour de la liste des enseignants de la formation permet d''accéder à l''ensemble des enseignants du CFA. Les noms sont classés en ordre alphabétique. Vous pourrez ainsi cocher les enseignants intervenant dans la formation que vous traitez actuellement.\r\n\r\n\r\nMettre à jour les TUTEUR(s) de vos apprentis \r\nCette rubrique vous permet d''attribuer ou de modifier, le tuteur propre à  chaque apprenti. \r\n\r\nConfigurer la charte graphique de votre formation \r\nIl vous est proposé choisir vous même le graphisme que vous souhaitez attribuer au site, espace de travail commun aux apprentis, maître d''apprentissage, tuteurs, enseignants, parents. \r\nVous pourrez intégrer votre propre logo du CFA, ou en choisir un préexistant dans une liste.\r\nL''image de la page d''accueil, de la formation concernée, peut également être intégrée librement, ou emprunter à une bibliothèque d''image disponibles.\r\nUn choix de couleurs et d''organisation des menus vous est également proposé, à travers deux styles graphiques. ', 'Aide générale', '');
INSERT INTO `aide` VALUES (49, 'Déterminer les critères de suivi de l''apprenti en établissant des rubriques que soit le maître d''apprentissage, le parent, le tuteur, l''enseignant de la formation, le responsable de la formation, ou encore  l''apprenti lui même, devra compléter', 'Elaboration de l''environnement de suivi libre au CFA', '');

-- --------------------------------------------------------

-- 
-- Structure de la table `espace`
-- 

CREATE TABLE `espace` (
  `id_espace` int(10) unsigned NOT NULL auto_increment,
  `nom_espace` varchar(255) NOT NULL default '',
  `id_createur_espace` bigint(20) NOT NULL default '0',
  `date_creation_espace` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id_espace`),
  KEY `id_createur_espace` (`id_createur_espace`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- 
-- Contenu de la table `espace`
-- 

INSERT INTO `espace` VALUES (1, 'espace de test', 23305, '2006-06-29 10:59:15');
INSERT INTO `espace` VALUES (3, 'mes documents', 23901, '2006-06-30 08:45:18');
INSERT INTO `espace` VALUES (5, 'Relation Tuteur', 23828, '2006-07-04 18:53:32');
INSERT INTO `espace` VALUES (6, 'Infos Pratiques / MA', 23371, '2006-09-12 22:35:27');
INSERT INTO `espace` VALUES (7, 'Infos Pratiques / Apprentis MAV 1', 23371, '2006-09-13 10:06:07');

-- --------------------------------------------------------

-- 
-- Structure de la table `espace_partage`
-- 

CREATE TABLE `espace_partage` (
  `id_espace_partage` int(10) unsigned NOT NULL auto_increment,
  `com_espace_partage` text NOT NULL,
  `date_ajout` datetime NOT NULL default '0000-00-00 00:00:00',
  `id_auteur_espace_partage` bigint(20) NOT NULL default '0',
  `nom_fichier` varchar(255) NOT NULL default '',
  `lien_id_espace` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_espace_partage`),
  KEY `lien_id_espace` (`lien_id_espace`),
  KEY `id_auteur_espace_partage` (`id_auteur_espace_partage`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Contenu de la table `espace_partage`
-- 

INSERT INTO `espace_partage` VALUES (2, 'c''est un message déstiné à tout le monde', '2006-06-29 11:07:19', 23305, '', 1);
INSERT INTO `espace_partage` VALUES (3, 'hfghfhfh fhfhfhfghgf', '2006-06-30 10:45:50', 23901, '', 3);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_apprentis`
-- 

CREATE TABLE `les_apprentis` (
  `id_app` bigint(20) NOT NULL default '0',
  `date_nais` date default NULL,
  `no_insc` varchar(50) NOT NULL default '',
  `no_secu` varchar(50) default NULL,
  `dern_classe_freq` tinytext,
  `diplomes_obtenus` text,
  `src_photo` tinytext,
  `adresse_perso` varchar(250) default NULL,
  `email_perso` text,
  `tel_perso` varchar(30) default NULL,
  `date_debut_contrat` date default NULL,
  `date_fin_contrat` date default NULL,
  `id_cla` bigint(20) default NULL,
  `id_ma` bigint(20) default NULL,
  `id_ens` bigint(20) default NULL,
  `id_rl` bigint(20) default NULL,
  PRIMARY KEY  (`id_app`),
  KEY `id_cla` (`id_cla`),
  KEY `id_ma` (`id_ma`),
  KEY `id_ens` (`id_ens`),
  KEY `id_rl` (`id_rl`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `les_apprentis`
-- 

INSERT INTO `les_apprentis` VALUES (23161, 0x313938392d31312d3134, '3857', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x303030302d30302d3030, 0x303030302d30302d3030, 0, 23158, 23160, 23159);
INSERT INTO `les_apprentis` VALUES (23165, 0x313938382d30392d3032, '4070', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x303030302d30302d3030, 0x303030302d30302d3030, 0, 23162, 23164, 23163);
INSERT INTO `les_apprentis` VALUES (23168, 0x313939302d30312d3132, '3967', '', '', 'BREVET', '', '', '', '', 0x303030302d30302d3030, 0x303030302d30302d3030, 0, 23166, 23164, 23167);
INSERT INTO `les_apprentis` VALUES (23171, 0x313938392d30392d3230, '3859', '', '', 'C.F.G.', '', '', '', '', 0x303030302d30302d3030, 0x303030302d30302d3030, 0, 23169, 23160, 23170);
INSERT INTO `les_apprentis` VALUES (23174, 0x313938352d31322d3034, '4089', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x303030302d30302d3030, 0x303030302d30302d3030, 0, 23172, 23164, 23173);
INSERT INTO `les_apprentis` VALUES (23177, 0x313938392d30372d3131, '3910', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x303030302d30302d3030, 0x303030302d30302d3030, 0, 23175, 23164, 23176);
INSERT INTO `les_apprentis` VALUES (23180, 0x313938372d30382d3231, '3950', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x303030302d30302d3030, 0x303030302d30302d3030, 0, 23178, 23164, 23179);
INSERT INTO `les_apprentis` VALUES (23183, 0x313938382d30342d3039, '4063', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x303030302d30302d3030, 0x303030302d30302d3030, 0, 23181, 23164, 23182);
INSERT INTO `les_apprentis` VALUES (23186, 0x313939302d30382d3131, '3856', '', '', 'BREVET', '', '', '', '', 0x303030302d30302d3030, 0x303030302d30302d3030, 0, 23184, 23160, 23185);
INSERT INTO `les_apprentis` VALUES (23188, 0x313938392d31312d3231, '4088', '', '', 'C.F.G.', '', '', '', '', 0x303030302d30302d3030, 0x303030302d30302d3030, 0, 23172, 23164, 23187);
INSERT INTO `les_apprentis` VALUES (23387, 0x313938372d31302d3233, '2487', '', '', 'CAP', 'photo_240506-113944.jpg', '', 'flopyflop@hotmail.fr', '0624399095', 0x323030352d30382d3232, 0x323030372d30382d3231, 12, 23386, 23317, 0);
INSERT INTO `les_apprentis` VALUES (23390, 0x313938372d31322d3131, '2417', '', '', 'CAP', '', '', '', '', 0x323030352d30392d3031, 0x323030372d30382d3331, 12, 23388, 0, 23389);
INSERT INTO `les_apprentis` VALUES (23393, 0x313938362d30392d3138, '1556', '', '', 'BEP', '', '', '', '', 0x323030352d30392d3031, 0x323030372d30382d3331, 12, 23391, 0, 23392);
INSERT INTO `les_apprentis` VALUES (23396, 0x313938372d30362d3031, '2190', '', '', 'BEP', 'photo_240506-113113.jpg', '', 'totti.dounet@hotmail.fr', '0630689156', 0x323030352d30372d3033, 0x323030372d30372d3032, 12, 23394, 0, 23395);
INSERT INTO `les_apprentis` VALUES (23399, 0x313938352d30362d3232, '3972', '', '', 'BEP', '', '', '', '', 0x323030352d30392d3036, 0x323030372d30392d3035, 12, 23397, 0, 23398);
INSERT INTO `les_apprentis` VALUES (23402, 0x313938372d30362d3230, '2546', '', '', 'BEP', '', '', '', '0613512391', 0x323030352d30392d3031, 0x323030372d30382d3331, 12, 23400, 0, 23401);
INSERT INTO `les_apprentis` VALUES (23405, 0x313938382d30342d3037, '2462', '', '', 'CAP', '', '52 grande rue laval', '', '', 0x323030352d30392d3031, 0x323030372d30372d3331, 12, 23403, 0, 23404);
INSERT INTO `les_apprentis` VALUES (23407, 0x313938362d31302d3239, '3974', '', '', 'BEP', '', '20 rue du général de gaule 53600 EVRON', '', '0631627913', 0x323030352d30392d3031, 0x323030372d30382d3331, 12, 0, 0, 23406);
INSERT INTO `les_apprentis` VALUES (23410, 0x313938372d30312d3133, '1692', '', '', 'BEP', '', '', '', '', 0x323030342d30392d3031, 0x323030362d31302d3330, 13, 23408, 0, 23409);
INSERT INTO `les_apprentis` VALUES (23413, 0x313938372d30322d3037, '319', '', '', 'BEP', '', '', '', '', 0x323030342d31302d3031, 0x323030362d31302d3331, 13, 23411, 0, 23412);
INSERT INTO `les_apprentis` VALUES (23416, 0x313938372d30362d3139, '1548', '', '', 'BEP', '', '', '', '', 0x323030342d30382d3032, 0x323030362d31302d3331, 13, 23414, 0, 23415);
INSERT INTO `les_apprentis` VALUES (23419, 0x313938332d31312d3235, '3277', '', '', 'M.C.', '', '', '', '', 0x323030342d30372d3038, 0x323030362d30372d3037, 13, 23417, 0, 23418);
INSERT INTO `les_apprentis` VALUES (23422, 0x313938372d31302d3330, '3382', '', '', 'BEP', '', '', '', '', 0x323030352d30332d3139, 0x323030362d31302d3331, 13, 23420, 0, 23421);
INSERT INTO `les_apprentis` VALUES (23424, 0x313938362d31322d3039, '4054', '', '', 'BEP', '', '', '', '', 0x323030342d31312d3035, 0x323030362d31302d3331, 13, 0, 0, 23423);
INSERT INTO `les_apprentis` VALUES (23427, 0x313938362d30352d3239, '775', '', '', 'BEP', '', '', '', '', 0x323030342d30392d3039, 0x323030362d31302d3331, 13, 23425, 0, 23426);
INSERT INTO `les_apprentis` VALUES (23430, 0x313938372d30342d3135, '2860', '', '', 'BEP', '', '', '', '', 0x323030342d30392d3031, 0x323030362d31302d3331, 13, 23428, 0, 23429);
INSERT INTO `les_apprentis` VALUES (23433, 0x313938342d30342d3039, '3339', '', '', 'BEP', '', '', '', '', 0x323030342d30392d3037, 0x323030362d31302d3331, 13, 23431, 0, 23432);
INSERT INTO `les_apprentis` VALUES (23447, 0x313938362d30372d3136, '1514', '', '', 'BEP', '', '', '', '', 0x323030342d30392d3031, 0x323030362d31302d3331, 15, 23445, 0, 23446);
INSERT INTO `les_apprentis` VALUES (23450, 0x313938362d30362d3034, '1440', '', '', 'BEP', '', '', '', '', 0x323030342d30392d3133, 0x323030362d31302d3331, 15, 23448, 0, 23449);
INSERT INTO `les_apprentis` VALUES (23453, 0x313938362d30312d3234, '2137', '', '', 'BEP', '', '', '', '', 0x323030352d30312d3034, 0x323030362d30382d3331, 15, 23451, 0, 23452);
INSERT INTO `les_apprentis` VALUES (23456, 0x313938362d31312d3133, '1720', '', '', 'CAP', '', '', '', '', 0x323030342d30392d3031, 0x323030362d31302d3330, 15, 23454, 0, 23455);
INSERT INTO `les_apprentis` VALUES (23459, 0x313938362d30362d3035, '1441', '', '', 'BEP', '', '', '', '', 0x323030342d30392d3038, 0x323030362d31302d3331, 15, 23457, 0, 23458);
INSERT INTO `les_apprentis` VALUES (23462, 0x313938372d31312d3234, '3636', '', '', 'BEP', '', '', '', '', 0x323030352d30382d3232, 0x323030372d30382d3231, 46, 23460, 0, 23461);
INSERT INTO `les_apprentis` VALUES (23465, 0x313938372d30342d3138, '3633', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030352d30382d3131, 0x323030372d30382d3130, 20, 23463, 0, 23464);
INSERT INTO `les_apprentis` VALUES (23468, 0x313939302d30322d3237, '3512', '', '', 'BREVET', '', '', '', '', 0x323030362d30382d3137, 0x323030372d30382d3135, 45, 24026, 0, 23467);
INSERT INTO `les_apprentis` VALUES (23471, 0x313939302d30332d3039, '3642', '', '', 'BREVET', '', '', '', '', 0x323030352d30382d3137, 0x323030372d30382d3136, 45, 23469, 0, 23470);
INSERT INTO `les_apprentis` VALUES (23473, 0x313939302d31312d3136, '3886', '', '', 'BREVET', '', '', '', '', 0x323030352d30392d3132, 0x323030372d30382d3331, 45, 24027, 0, 23472);
INSERT INTO `les_apprentis` VALUES (23476, 0x313938382d31302d3139, '3485', '', '', 'BREVET', '', '', '', '', 0x323030352d30372d3035, 0x323030372d30372d3034, 45, 23474, 0, 23475);
INSERT INTO `les_apprentis` VALUES (23479, 0x313939302d31302d3133, '3893', '', '', 'BREVET', '', '', '', '', 0x323030352d30392d3132, 0x323030372d30382d3331, 45, 23477, 0, 23478);
INSERT INTO `les_apprentis` VALUES (23482, 0x313938382d31322d3033, '4115', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030352d31302d3235, 0x323030372d30382d3331, 20, 23480, 0, 23481);
INSERT INTO `les_apprentis` VALUES (23484, 0x313938392d31312d3035, '3494', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030362d30372d3034, 0x323030372d30372d3034, 45, 24028, 0, 23483);
INSERT INTO `les_apprentis` VALUES (23487, 0x313938372d30382d3032, '3225', '', '', 'BREVET', '', '', '', '', 0x323030342d31302d3031, 0x323030362d30382d3331, 21, 23485, 0, 23486);
INSERT INTO `les_apprentis` VALUES (23490, 0x313938362d31302d3234, '4143', '', '', 'BEP', '', '', '', '', 0x323030352d31312d3238, 0x323030362d30382d3330, 21, 23488, 0, 23489);
INSERT INTO `les_apprentis` VALUES (23493, 0x313938382d30372d3239, '2853', '', '', 'BREVET', '', '', '', '', 0x323030342d30382d3233, 0x323030362d30382d3232, 21, 23491, 0, 23492);
INSERT INTO `les_apprentis` VALUES (23496, 0x313938372d30382d3037, '2881', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030342d30392d3031, 0x323030362d30382d3331, 21, 23494, 0, 23495);
INSERT INTO `les_apprentis` VALUES (23499, 0x313938372d30382d3139, '2896', '', '', 'BREVET', '', '', '', '', 0x323030352d30382d3032, 0x323030362d30382d3330, 21, 23497, 0, 23498);
INSERT INTO `les_apprentis` VALUES (23502, 0x313938382d31302d3139, '2879', '', '', 'BREVET', '', '', '', '', 0x323030342d30392d3031, 0x323030362d30382d3331, 21, 23500, 0, 23501);
INSERT INTO `les_apprentis` VALUES (23504, 0x313938372d30342d3132, '2870', '', '', 'BREVET', '', '', '', '', 0x323030352d30342d3031, 0x323030362d30362d3330, 21, 23469, 0, 23503);
INSERT INTO `les_apprentis` VALUES (23507, 0x313938332d30332d3032, '4164', '', '', 'BAC TECHNOLOGIQUE', '', '', '', '', 0x323030352d31312d3039, 0x323030372d30382d3331, 46, 23505, 0, 23506);
INSERT INTO `les_apprentis` VALUES (23510, 0x313938372d31312d3237, '3765', '', '', 'BEP', '', '', '', '', 0x323030352d30392d3031, 0x323030362d30382d3331, 22, 23508, 0, 23509);
INSERT INTO `les_apprentis` VALUES (23513, 0x313938372d30382d3131, '2302', '', '', 'CAP', '', '', '', '', 0x323030352d30372d3031, 0x323030362d30362d3330, 22, 23511, 0, 23512);
INSERT INTO `les_apprentis` VALUES (23516, 0x313938372d30322d3230, '3767', '', '', 'BEP', '', '', '', '', 0x323030352d30382d3031, 0x323030362d30372d3331, 22, 23514, 0, 23515);
INSERT INTO `les_apprentis` VALUES (23519, 0x313938352d30362d3036, '3836', '', '', 'BAC TECHNOLOGIQUE', '', '', '', '', 0x323030352d30382d3138, 0x323030362d30382d3137, 22, 23517, 0, 23518);
INSERT INTO `les_apprentis` VALUES (23522, 0x313938382d30312d3031, '3772', '', '', 'BEP', '', '', '', '', 0x323030352d30372d3031, 0x323030362d30362d3330, 22, 23520, 0, 23521);
INSERT INTO `les_apprentis` VALUES (23524, 0x313938372d31312d3037, '2550', '', '', 'BEP', '', '', '', '', 0x323030362d30392d3031, 0x323030382d30382d3331, 12, 23445, 0, 23975);
INSERT INTO `les_apprentis` VALUES (23527, 0x313938322d31312d3138, '3884', '', '', 'BAC GENERAL', '', '', '', '', 0x323030352d30372d3236, 0x323030372d30372d3235, 46, 23525, 0, 23526);
INSERT INTO `les_apprentis` VALUES (23530, 0x313938362d30362d3031, '3300', '', '', 'BEP', '', '', '', '', 0x323030352d30392d3031, 0x323030362d30382d3331, 22, 23528, 0, 23529);
INSERT INTO `les_apprentis` VALUES (23533, 0x313938392d30352d3331, '3499', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030352d31312d3031, 0x323030372d30382d3331, 45, 23531, 0, 23532);
INSERT INTO `les_apprentis` VALUES (23536, 0x313938382d30392d3239, '3828', '', '', 'BREVET', '', '', '', '', 0x323030352d30392d3139, 0x323030372d30382d3331, 40, 23534, 0, 23535);
INSERT INTO `les_apprentis` VALUES (23538, 0x313938382d30342d3231, '3882', '', '', 'BREVET', '', '', '', '', 0x323030352d30392d3031, 0x323030372d30382d3331, 40, 24077, 0, 23537);
INSERT INTO `les_apprentis` VALUES (23541, 0x313938392d31312d3231, '3797', '', '', 'C.F.G.', '', '', '', '', 0x323030352d30392d3031, 0x323030372d30382d3331, 40, 23539, 0, 23540);
INSERT INTO `les_apprentis` VALUES (23543, 0x313938372d30382d3132, '3926', '', '', 'CAP', '', '', '', '', 0x323030352d30372d3139, 0x323030372d30372d3138, 40, 24078, 0, 23542);
INSERT INTO `les_apprentis` VALUES (23545, 0x313938342d30382d3035, '3954', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030352d30392d3139, 0x323030372d30382d3331, 40, 23474, 23376, 23544);
INSERT INTO `les_apprentis` VALUES (23547, 0x313938392d30372d3031, '3824', '', '', 'BREVET', '', '', '', '', 0x323030352d30392d3031, 0x323030372d30382d3331, 45, 24013, 0, 23546);
INSERT INTO `les_apprentis` VALUES (23550, 0x313938392d30382d3331, '3628', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030352d30392d3031, 0x323030372d30382d3331, 40, 23548, 0, 23549);
INSERT INTO `les_apprentis` VALUES (23553, 0x313938382d30392d3236, '3913', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030352d30382d3136, 0x323030372d30382d3135, 40, 23551, 0, 23552);
INSERT INTO `les_apprentis` VALUES (23556, 0x313938382d30392d3036, '2852', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030342d30392d3031, 0x323030362d30382d3331, 17, 23554, 0, 23555);
INSERT INTO `les_apprentis` VALUES (23559, 0x313938392d30322d3035, '2963', '', '', 'BREVET', '', '', '', '', 0x323030342d30392d3031, 0x323030362d30382d3331, 17, 23557, 0, 23558);
INSERT INTO `les_apprentis` VALUES (23562, 0x313938382d30392d3034, '3286', '', '', 'BREVET', '', '', '', '', 0x323030342d30392d3038, 0x323030362d30382d3331, 17, 23560, 0, 23561);
INSERT INTO `les_apprentis` VALUES (23564, 0x313938382d31302d3230, '2961', '', '', 'C.F.G.', '', '', '', '', 0x323030342d30382d3033, 0x323030362d30382d3032, 17, 0, 0, 23563);
INSERT INTO `les_apprentis` VALUES (23567, 0x313938382d31312d3035, '2962', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030342d30372d3033, 0x323030362d30372d3032, 17, 23565, 0, 23566);
INSERT INTO `les_apprentis` VALUES (23570, 0x313938382d30392d3330, '2965', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030342d30382d3033, 0x323030362d30382d3032, 17, 23568, 0, 23569);
INSERT INTO `les_apprentis` VALUES (23573, 0x313938382d30352d3134, '2966', '', '', 'C.F.G.', '', '', '', '', 0x323030342d30382d3234, 0x323030362d30382d3233, 17, 23571, 23376, 23572);
INSERT INTO `les_apprentis` VALUES (23575, 0x313938372d30362d3039, '2204', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030362d30372d3034, 0x323030372d30372d3036, 40, 24079, 0, 23574);
INSERT INTO `les_apprentis` VALUES (23577, 0x313938382d30352d3133, '2968', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030342d30392d3031, 0x323030362d30382d3331, 17, 0, 0, 23576);
INSERT INTO `les_apprentis` VALUES (23580, 0x313938382d30392d3235, '2862', '', '', 'C.F.G.', '', '', '', '', 0x323030342d30372d3239, 0x323030362d30372d3331, 17, 23578, 0, 23579);
INSERT INTO `les_apprentis` VALUES (23583, 0x313938372d30312d3133, '3940', '', '', 'CAP', '', '', '', '', 0x323030352d30392d3035, 0x323030362d30382d3331, 19, 23581, 0, 23582);
INSERT INTO `les_apprentis` VALUES (23585, 0x313938342d30322d3135, '3935', '', '', 'CAP', '', '', '', '', 0x323030352d30392d3035, 0x323030362d30382d3331, 19, 23539, 0, 23584);
INSERT INTO `les_apprentis` VALUES (23588, 0x313938352d30332d3134, '3952', '', '', 'CAP', '', '', '', '', 0x323030352d30392d3035, 0x323030362d30382d3331, 19, 23586, 0, 23587);
INSERT INTO `les_apprentis` VALUES (23590, 0x313938352d31302d3034, '3939', '', '', 'CAP', '', '', '', '', 0x323030352d30392d3035, 0x323030362d30382d3331, 19, 23466, 0, 23589);
INSERT INTO `les_apprentis` VALUES (23593, 0x313938362d30332d3236, '2970', '', '', 'BEP', '', '', '', '', 0x323030352d30392d3031, 0x323030362d30382d3330, 18, 23591, 0, 23592);
INSERT INTO `les_apprentis` VALUES (23596, 0x313938372d30372d3230, '4019', '', '', 'CAP', '', '', '', '', 0x323030352d30392d3031, 0x323030362d30382d3331, 18, 23594, 0, 23595);
INSERT INTO `les_apprentis` VALUES (23599, 0x313938352d31312d3330, '3924', '', '', 'BEP', '', '', '', '', 0x323030352d30382d3330, 0x323030362d30382d3239, 18, 23597, 0, 23598);
INSERT INTO `les_apprentis` VALUES (23601, 0x313938372d31302d3031, '3751', '', '', 'BEP', '', '', '', '', 0x323030352d30392d3135, 0x323030362d30392d3134, 18, 23551, 0, 23600);
INSERT INTO `les_apprentis` VALUES (23604, 0x313938372d31322d3038, '3763', '', '', 'CAP', '', '', '', '', 0x323030352d30372d3031, 0x323030362d30362d3330, 18, 23602, 0, 23603);
INSERT INTO `les_apprentis` VALUES (23607, 0x313938362d31302d3237, '1419', '', '', 'CAP', '', '', '', '', 0x323030352d30392d3031, 0x323030372d30382d3331, 37, 23926, 23906, 23927);
INSERT INTO `les_apprentis` VALUES (23610, 0x313938372d30332d3133, '3847', '', '', 'CAP', '', '', '', '', 0x323030352d30392d3036, 0x323030362d30382d3331, 18, 23608, 0, 23609);
INSERT INTO `les_apprentis` VALUES (23612, 0x313938352d30382d3234, '3827', '', '', 'BAC TECHNOLOGIQUE', '', '', '', '', 0x323030352d30392d3031, 0x323030372d30382d3331, 23, 0, 0, 23611);
INSERT INTO `les_apprentis` VALUES (23615, 0x313938372d30312d3236, '3805', '', '', 'BAC GENERAL', '', '', '', '', 0x323030352d30392d3031, 0x323030372d30382d3331, 23, 23613, 0, 23614);
INSERT INTO `les_apprentis` VALUES (23617, 0x313938352d30312d3039, '3817', '', '', 'BAC TECHNOLOGIQUE', '', '', '', '', 0x323030352d30392d3031, 0x323030372d30382d3331, 23, 0, 0, 23616);
INSERT INTO `les_apprentis` VALUES (23620, 0x313938352d30332d3135, '3806', '', '', 'BAC GENERAL', '', '', '', '', 0x323030352d30382d3031, 0x323030372d30372d3331, 23, 23618, 0, 23619);
INSERT INTO `les_apprentis` VALUES (23623, 0x313938372d30392d3038, '3808', '', '', 'BAC GENERAL', '', '', '', '', 0x323030352d30382d3232, 0x323030372d30382d3231, 23, 23621, 0, 23622);
INSERT INTO `les_apprentis` VALUES (23626, 0x313938352d30352d3136, '3902', '', '', 'BAC TECHNOLOGIQUE', '', '', '', '', 0x323030352d30392d3031, 0x323030372d30382d3331, 23, 23624, 0, 23625);
INSERT INTO `les_apprentis` VALUES (23629, 0x313938352d30352d3133, '3905', '', '', 'BAC TECHNOLOGIQUE', '', '', '', '', 0x323030352d30392d3031, 0x323030372d30382d3331, 23, 23627, 0, 23628);
INSERT INTO `les_apprentis` VALUES (23631, 0x313938362d31302d3232, '3811', '', '', 'BAC TECHNOLOGIQUE', '', '', '', '', 0x323030352d30392d3031, 0x323030372d30382d3331, 23, 0, 0, 23630);
INSERT INTO `les_apprentis` VALUES (23634, 0x313938362d30322d3233, '3406', '', '', 'BAC TECHNOLOGIQUE', '', '', '', '', 0x323030342d31302d3138, 0x323030372d30382d3330, 23, 23632, 0, 23633);
INSERT INTO `les_apprentis` VALUES (23637, 0x313938362d30372d3237, '3813', '', '', 'BAC TECHNOLOGIQUE', '', '', '', '', 0x323030352d30392d3031, 0x323030372d30382d3331, 23, 23635, 0, 23636);
INSERT INTO `les_apprentis` VALUES (23640, 0x313938372d30392d3039, '3814', '', '', 'BAC TECHNOLOGIQUE', '', '', '', '', 0x323030352d30392d3031, 0x323030372d30382d3331, 23, 23638, 0, 23639);
INSERT INTO `les_apprentis` VALUES (23643, 0x313938362d30312d3039, '3066', '', '', 'BAC TECHNOLOGIQUE', '', '', '', '', 0x323030342d30382d3136, 0x323030372d30382d3135, 24, 23641, 0, 23642);
INSERT INTO `les_apprentis` VALUES (23646, 0x313938362d30372d3238, '3497', '', '', 'BAC TECHNOLOGIQUE', '', '', '', '', 0x323030352d30392d3031, 0x323030372d30382d3331, 24, 23644, 0, 23645);
INSERT INTO `les_apprentis` VALUES (23649, 0x313938342d30342d3032, '3370', '', '', 'B.T.', '', '', '', '', 0x323030342d31302d3034, 0x323030372d30362d3330, 24, 23647, 0, 23648);
INSERT INTO `les_apprentis` VALUES (23652, 0x313938342d31312d3233, '3276', '', '', 'BAC GENERAL', '', '', '', '', 0x323030342d30392d3031, 0x323030372d30382d3331, 24, 23650, 0, 23651);
INSERT INTO `les_apprentis` VALUES (23655, 0x313938372d30312d3330, '4081', '', '', 'BAC TECHNOLOGIQUE', '', '', '', '', 0x323030352d31302d3137, 0x323030372d30382d3331, 24, 23653, 0, 23654);
INSERT INTO `les_apprentis` VALUES (23658, 0x313938372d30372d3034, '3988', '', '', 'BAC TECHNOLOGIQUE', '', '', '', '', 0x323030352d30392d3133, 0x323030372d30362d3330, 24, 23656, 0, 23657);
INSERT INTO `les_apprentis` VALUES (23661, 0x313938362d30342d3237, '3069', '', '', 'BAC GENERAL', '', '', '', '', 0x323030342d30392d3031, 0x323030372d30382d3331, 24, 23659, 0, 23660);
INSERT INTO `les_apprentis` VALUES (23664, 0x313938352d30372d3233, '3070', '', '', 'BAC TECHNOLOGIQUE', '', '', '', '', 0x323030342d30392d3031, 0x323030372d30382d3331, 24, 23662, 0, 23663);
INSERT INTO `les_apprentis` VALUES (23667, 0x313938342d30332d3031, '4076', '', '', 'DUT', '', '', '', '', 0x323030352d31302d3137, 0x323030372d30382d3331, 24, 23665, 0, 23666);
INSERT INTO `les_apprentis` VALUES (23670, 0x313938372d30392d3237, '3835', '', '', 'BAC GENERAL', '', '', '', '', 0x323030352d30392d3031, 0x323030372d30382d3331, 24, 23668, 0, 23669);
INSERT INTO `les_apprentis` VALUES (23673, 0x313938342d31302d3236, '3377', '', '', 'BAC TECHNOLOGIQUE', '', '', '', '', 0x323030342d30392d3232, 0x323030372d30382d3331, 24, 23671, 0, 23672);
INSERT INTO `les_apprentis` VALUES (23676, 0x313938362d30332d3035, '3815', '', '', 'BAC TECHNOLOGIQUE', '', '', '', '', 0x323030352d30382d3031, 0x323030372d30362d3230, 24, 23674, 0, 23675);
INSERT INTO `les_apprentis` VALUES (23679, 0x313938322d31312d3233, '67', '', '', 'BEP', '', '', '', '', 0x323030332d30392d3031, 0x323030352d30392d3330, 25, 23677, 0, 23678);
INSERT INTO `les_apprentis` VALUES (23682, 0x313938362d31302d3038, '3067', '', '', 'BAC GENERAL', '', '', '', '', 0x323030342d30392d3031, 0x323030362d30382d3331, 25, 23680, 0, 23681);
INSERT INTO `les_apprentis` VALUES (23685, 0x313938352d30342d3131, '3346', '', '', 'BAC GENERAL', '', '', '', '', 0x323030342d30392d3237, 0x323030362d30382d3331, 25, 23683, 0, 23684);
INSERT INTO `les_apprentis` VALUES (23688, 0x313938352d31322d3234, '3214', '', '', 'BAC TECHNOLOGIQUE', '', '', '', '', 0x323030342d30392d3133, 0x323030362d30382d3331, 25, 23686, 0, 23687);
INSERT INTO `les_apprentis` VALUES (23690, 0x313938362d30392d3031, '3360', '', '', 'BAC GENERAL', '', '', '', '', 0x323030342d31302d3031, 0x323030362d30382d3331, 25, 0, 0, 23689);
INSERT INTO `les_apprentis` VALUES (23693, 0x313938362d30372d3038, '3075', '', '', 'BAC TECHNOLOGIQUE', '', '', '', '', 0x323030342d30392d3031, 0x323030362d30382d3331, 25, 23691, 0, 23692);
INSERT INTO `les_apprentis` VALUES (23696, 0x313938342d30372d3136, '2847', '', '', 'BAC GENERAL', '', '', '', '', 0x323030342d30392d3031, 0x323030362d30382d3331, 25, 23694, 0, 23695);
INSERT INTO `les_apprentis` VALUES (23699, 0x313938322d30372d3033, '3265', '', '', 'BAC TECHNOLOGIQUE', '', '', '', '', 0x323030352d30312d3236, 0x323030362d30382d3331, 25, 23697, 0, 23698);
INSERT INTO `les_apprentis` VALUES (23702, 0x313938362d30392d3035, '3076', '', '', 'BAC TECHNOLOGIQUE', '', '', '', '', 0x323030342d30392d3031, 0x323030362d30382d3331, 25, 23700, 0, 23701);
INSERT INTO `les_apprentis` VALUES (23705, 0x313938342d30382d3233, '2036', '', '', 'BAC TECHNOLOGIQUE', '', '', '', '', 0x323030352d30392d3031, 0x323030362d30382d3331, 25, 23703, 0, 23704);
INSERT INTO `les_apprentis` VALUES (23708, 0x313938352d31302d3330, '3394', '', '', 'BAC GENERAL', '', '', '', '', 0x323030352d30372d3138, 0x323030362d30382d3331, 25, 23706, 0, 23707);
INSERT INTO `les_apprentis` VALUES (23710, 0x313938322d31312d3235, '3080', '', '', 'BAC GENERAL', '', '', '', '', 0x323030342d30392d3031, 0x323030362d30392d3330, 25, 23627, 0, 23709);
INSERT INTO `les_apprentis` VALUES (23713, 0x313938352d30382d3034, '3259', '', '', 'BAC GENERAL', '', '', '', '', 0x323030342d30392d3031, 0x323030362d31302d3330, 25, 23711, 0, 23712);
INSERT INTO `les_apprentis` VALUES (23715, 0x313938342d30322d3236, '3283', '', '', 'BAC TECHNOLOGIQUE', '', '', '', '', 0x323030342d30392d3031, 0x323030362d30382d3331, 25, 23624, 0, 23714);
INSERT INTO `les_apprentis` VALUES (23717, 0x313938362d30362d3231, '3073', '', '', 'BAC TECHNOLOGIQUE', '', '', '', '', 0x323030342d30392d3031, 0x323030362d30382d3331, 27, 23703, 0, 23716);
INSERT INTO `les_apprentis` VALUES (23720, 0x313938322d31322d3330, '2270', '', '', 'BAC PRO', '', '', '', '', 0x323030332d30392d3031, 0x323030362d30382d3331, 27, 23718, 0, 23719);
INSERT INTO `les_apprentis` VALUES (23722, 0x313938312d30392d3131, '2271', '', '', 'B.T.', '', '', '', '', 0x323030332d30392d3031, 0x323030362d30392d3330, 27, 0, 0, 23721);
INSERT INTO `les_apprentis` VALUES (23729, 0x313938322d31312d3138, '3369', '', '', 'BAC TECHNOLOGIQUE', '', '', '', '', 0x323030342d31302d3031, 0x323030362d30382d3331, 27, 23727, 0, 23728);
INSERT INTO `les_apprentis` VALUES (23732, 0x313938342d30372d3232, '2274', '', '', 'BAC TECHNOLOGIQUE', '', '', '', '', 0x323030332d30392d3031, 0x323030362d30392d3330, 27, 23730, 0, 23731);
INSERT INTO `les_apprentis` VALUES (23735, 0x313938332d31312d3233, '3263', '', '', 'BAC GENERAL', '', '', '', '', 0x323030342d30392d3031, 0x323030362d30382d3331, 27, 23733, 0, 23734);
INSERT INTO `les_apprentis` VALUES (23739, 0x313938392d30322d3134, '4012', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030352d30392d3139, 0x323030352d30392d3139, 29, 23737, 23358, 23738);
INSERT INTO `les_apprentis` VALUES (23742, 0x313938382d30342d3239, '3040', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030352d31302d3033, 0x323030352d31302d3033, 29, 23740, 23358, 23741);
INSERT INTO `les_apprentis` VALUES (23745, 0x313938392d31302d3036, '3552', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030352d31312d3134, 0x323030352d31312d3134, 29, 23743, 23358, 23744);
INSERT INTO `les_apprentis` VALUES (23748, 0x313938392d30372d3230, '3508', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030352d30382d3031, 0x323030352d30382d3031, 29, 23746, 23358, 23747);
INSERT INTO `les_apprentis` VALUES (23751, 0x313938392d30322d3136, '3638', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030352d30392d3032, 0x323030352d30392d3032, 29, 23749, 23358, 23750);
INSERT INTO `les_apprentis` VALUES (23754, 0x313938392d31312d3135, '3640', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030352d30382d3232, 0x323030352d30382d3232, 29, 23752, 23358, 23753);
INSERT INTO `les_apprentis` VALUES (23757, 0x313938392d30372d3330, '3550', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030352d30372d3034, 0x323030352d30372d3034, 29, 23755, 23358, 23756);
INSERT INTO `les_apprentis` VALUES (23760, 0x313938392d30342d3137, '3507', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030352d30372d3031, 0x323030352d30372d3031, 29, 23758, 23358, 23759);
INSERT INTO `les_apprentis` VALUES (23763, 0x313938392d30322d3138, '3551', '', '', 'BREVET', '', '', '', '', 0x323030352d30372d3034, 0x323030352d30372d3034, 29, 23761, 23358, 23762);
INSERT INTO `les_apprentis` VALUES (23827, 0x313939302d30362d3230, '', '', '', '', '', '', '', '', 0x303030302d30302d3030, 0x303030302d30302d3030, 29, 0, 0, 0);
INSERT INTO `les_apprentis` VALUES (23830, 0x313938372d30322d3133, '3731', '', '', 'BREVET', '', '', '', '', 0x323030352d30392d3031, 0x323030352d30392d3031, 33, 23828, 23352, 23829);
INSERT INTO `les_apprentis` VALUES (23833, 0x313938392d30312d3239, '3871', '', '', 'BREVET', '', '', '', '', 0x323030352d30392d3035, 0x323030372d30382d3331, 33, 23831, 0, 23832);
INSERT INTO `les_apprentis` VALUES (23836, 0x313938392d30312d3330, '3742', '', '', 'BREVET', '', '', '', '', 0x323030352d30392d3035, 0x323030372d30382d3331, 33, 23834, 0, 23835);
INSERT INTO `les_apprentis` VALUES (23839, 0x313938382d31312d3239, '3743', '', '', 'BREVET', '', '', '', '', 0x323030352d30382d3232, 0x323030372d30382d3231, 33, 23837, 0, 23838);
INSERT INTO `les_apprentis` VALUES (23842, 0x313938382d30342d3238, '4023', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030352d30392d3139, 0x323030372d30382d3331, 33, 23840, 0, 23841);
INSERT INTO `les_apprentis` VALUES (23845, 0x313938372d31302d3234, '3714', '', '', 'BREVET', '', '', '', '', 0x323030352d30392d3035, 0x323030372d30382d3331, 33, 23843, 0, 23844);
INSERT INTO `les_apprentis` VALUES (23848, 0x313938342d31302d3033, '3995', '', '', 'BAC GENERAL', '', '', '', '', 0x323030352d31302d3031, 0x323030372d30382d3331, 33, 23846, 0, 23847);
INSERT INTO `les_apprentis` VALUES (23851, 0x313939302d30312d3234, '3745', '', '', 'BREVET', '', '', '', '', 0x323030352d30382d3035, 0x323030372d30382d3034, 33, 23849, 0, 23850);
INSERT INTO `les_apprentis` VALUES (23854, 0x313938372d31322d3236, '3727', '', '', 'CAP', '', '', '', '', 0x323030352d30382d3232, 0x323030372d30382d3231, 33, 23852, 0, 23853);
INSERT INTO `les_apprentis` VALUES (23857, 0x313938392d30372d3230, '3749', '', '', 'BREVET', '', '', '', '', 0x323030352d30392d3031, 0x323030372d30382d3331, 33, 23855, 0, 23856);
INSERT INTO `les_apprentis` VALUES (23859, 0x313938392d30372d3031, '3735', '', '', 'BREVET', '', '', '', '', 0x323030352d30372d3034, 0x323030372d30372d3033, 33, 23858, 0, 23546);
INSERT INTO `les_apprentis` VALUES (23862, 0x313938392d30342d3033, '3738', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030352d30372d3132, 0x323030372d30372d3131, 33, 23860, 0, 23861);
INSERT INTO `les_apprentis` VALUES (23866, 0x313938392d30382d3236, '4046', '', '', 'BREVET', '', '', '', '', 0x323030352d30392d3035, 0x323030372d30382d3331, 33, 23864, 23378, 23865);
INSERT INTO `les_apprentis` VALUES (23869, 0x313938382d30352d3136, '3029', '', '', 'BREVET', '', '', '', '', 0x323030342d30382d3330, 0x323030342d30382d3330, 34, 23867, 23284, 23868);
INSERT INTO `les_apprentis` VALUES (23872, 0x313938382d30342d3231, '2941', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030342d30382d3233, 0x323030372d30382d3232, 34, 23870, 23284, 23871);
INSERT INTO `les_apprentis` VALUES (23875, 0x313938382d30362d3231, '3032', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030342d30392d3031, 0x323030372d30382d3331, 34, 23873, 23378, 23874);
INSERT INTO `les_apprentis` VALUES (23878, 0x313938382d30382d3132, '2953', '', '', 'C.F.G.', '', '', '', '', 0x323030342d30382d3136, 0x323030372d30382d3135, 34, 23876, 23378, 23877);
INSERT INTO `les_apprentis` VALUES (23881, 0x313938372d30392d3137, '2897', '', '', 'BREVET', '', '', '', '', 0x323030342d30392d3036, 0x323030372d30382d3331, 35, 23879, 23327, 23880);
INSERT INTO `les_apprentis` VALUES (23884, 0x313938372d30362d3234, '2588', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030342d30392d3031, 0x323030372d30382d3331, 35, 23882, 23360, 23883);
INSERT INTO `les_apprentis` VALUES (23888, 0x313938382d30382d3331, '2971', '', '', 'BREVET', '', '', '', '', 0x323030342d30392d3031, 0x323030372d30382d3331, 35, 23885, 23887, 23886);
INSERT INTO `les_apprentis` VALUES (23891, 0x313938382d30332d3139, '3258', '', '', 'BREVET', '', '', '', '', 0x323030342d30392d3033, 0x323030372d30382d3331, 35, 23889, 23324, 23890);
INSERT INTO `les_apprentis` VALUES (23901, 0x313938352d30362d3132, '3840', '', '', 'BEP', 'photo_300606-113753.jpg', '', '', '', 0x323030352d30392d3035, 0x323030352d30392d3035, 37, 23899, 23371, 23900);
INSERT INTO `les_apprentis` VALUES (23903, 0x313938372d31302d3036, '3908', '', '', 'BEP', '', '', '', '', 0x323030352d30392d3035, 0x323030372d30392d3034, 37, 0, 0, 23902);
INSERT INTO `les_apprentis` VALUES (23907, 0x313938362d31322d3239, '2603', '', '', 'CAP', '', '', '', '', 0x323030352d30392d3031, 0x323030372d30382d3331, 37, 23904, 23906, 23905);
INSERT INTO `les_apprentis` VALUES (23910, 0x313938382d30342d3039, '3812', '', '', 'BEP', '', '', '', '', 0x323030352d30392d3031, 0x323030372d30382d3331, 37, 23908, 23906, 23909);
INSERT INTO `les_apprentis` VALUES (23913, 0x313938382d30322d3135, '4069', '', '', 'BEP', '', '', '', '', 0x323030352d31302d3130, 0x323030372d30382d3331, 37, 23911, 23906, 23912);
INSERT INTO `les_apprentis` VALUES (23916, 0x313938362d30372d3134, '1873', '', '', 'CAP', '', '', '', '', 0x323030352d30392d3031, 0x323030372d30382d3331, 37, 23914, 23906, 23915);
INSERT INTO `les_apprentis` VALUES (23918, 0x313938382d30312d3230, '3698', '', '', 'BEP', '', '', '', '', 0x323030352d30392d3031, 0x323030372d30372d3331, 37, 0, 23906, 23917);
INSERT INTO `les_apprentis` VALUES (23922, 0x313938372d30352d3235, '3661', '', '', 'CAP', '', '', '', '', 0x323030352d30392d3031, 0x323030372d30382d3331, 37, 23920, 23906, 23921);
INSERT INTO `les_apprentis` VALUES (23924, 0x313938372d30382d3130, '3558', '', '', 'CAP', '', '', '', '', 0x323030352d30382d3239, 0x323030372d30382d3238, 37, 0, 23906, 23923);
INSERT INTO `les_apprentis` VALUES (23930, 0x313938342d31322d3031, '4050', '', '', 'BEP', '', '', '', '', 0x323030352d30392d3031, 0x323030372d31312d3330, 37, 23928, 0, 23929);
INSERT INTO `les_apprentis` VALUES (23933, 0x313938382d30342d3136, '2602', '', '', 'CAP', '', '', '', '', 0x323030352d30392d3031, 0x323030372d30382d3331, 37, 23931, 23906, 23932);
INSERT INTO `les_apprentis` VALUES (23934, 0x303030302d30302d3030, '', '', '', '', '', '', '', '', 0x303030302d30302d3030, 0x303030302d30302d3030, 0, 0, 0, 0);
INSERT INTO `les_apprentis` VALUES (23938, 0x313938382d30342d3036, '4275', '', '', 'BEP', 'photo_210906-083451.png', '', 'netbru_belfigor@hotmail.com', '06.99.57.70.43', 0x323030362d30392d3031, 0x323030382d30382d3331, 38, 23936, 23294, 23937);
INSERT INTO `les_apprentis` VALUES (23941, 0x313938392d30332d3033, '2949', '', '', 'BREVET', 'photo_210906-083442.jpg', '', '', '', 0x323030362d30372d3031, 0x323030382d30362d3330, 38, 23939, 23294, 23940);
INSERT INTO `les_apprentis` VALUES (23944, 0x313938362d31302d3132, '2470', '', '', 'CAP', 'photo_210906-083625.gif', '', '', '06-85-34-90-91', 0x323030362d30392d3031, 0x323030382d30382d3331, 38, 23942, 23294, 23943);
INSERT INTO `les_apprentis` VALUES (23947, 0x313938362d30352d3139, '2747', '', '', 'BEP', 'photo_210906-182424.jpg', '', '', '', 0x323030362d30392d3034, 0x323030382d30382d3331, 38, 23945, 23294, 23946);
INSERT INTO `les_apprentis` VALUES (23949, 0x313938392d30322d3031, '2841', '', '', 'BREVET', '', '', '', '', 0x323030362d30392d3031, 0x323030382d30382d3331, 12, 23408, 0, 23948);
INSERT INTO `les_apprentis` VALUES (23951, 0x313938372d30322d3031, '3848', '', '', 'BEP', '', '', '', '', 0x323030362d30392d3034, 0x323030382d30382d3331, 12, 23445, 0, 23950);
INSERT INTO `les_apprentis` VALUES (23954, 0x313938362d31312d3034, '4464', '', '', 'BEP', '', '', '', '', 0x323030362d30372d3138, 0x323030382d30372d3137, 12, 23952, 0, 23953);
INSERT INTO `les_apprentis` VALUES (23957, 0x313938372d30392d3139, '4467', '', '', 'BREVET', '', '', '', '', 0x323030362d30382d3138, 0x323030382d30382d3137, 12, 23955, 0, 23956);
INSERT INTO `les_apprentis` VALUES (23959, 0x313938372d30322d3139, '2170', '', '', 'BEP', '', '', '', '', 0x323030362d30392d3031, 0x323030382d30382d3331, 12, 23388, 0, 23958);
INSERT INTO `les_apprentis` VALUES (23961, 0x313938372d30392d3237, '4053', '', '', 'CAP', '', '', '', '', 0x323030362d30382d3238, 0x323030382d30382d3237, 12, 23425, 0, 23960);
INSERT INTO `les_apprentis` VALUES (23963, 0x313938392d30322d3034, '3106', '', '', 'BREVET', '', '', '', '', 0x323030362d30382d3136, 0x323030382d30382d3135, 12, 23586, 0, 23962);
INSERT INTO `les_apprentis` VALUES (23966, 0x313938372d30382d3131, '2162', '', '', 'BREVET', '', '', '', '', 0x323030362d30392d3131, 0x323030382d30382d3331, 12, 23964, 0, 23965);
INSERT INTO `les_apprentis` VALUES (23968, 0x313938382d30392d3230, '3110', '', '', 'BREVET', '', '', '', '', 0x323030362d30382d3137, 0x323030382d30382d3136, 12, 23586, 0, 23967);
INSERT INTO `les_apprentis` VALUES (23971, 0x313938382d30352d3031, '4608', '', '', 'CAP', '', '', '', '', 0x323030362d30392d3031, 0x323030382d30382d3331, 12, 23969, 0, 23970);
INSERT INTO `les_apprentis` VALUES (23974, 0x313938382d30372d3137, '2830', '', '', 'CAP', '', '', '', '', 0x323030362d30392d3031, 0x323030382d30382d3331, 12, 23972, 0, 23973);
INSERT INTO `les_apprentis` VALUES (23978, 0x313938362d30372d3138, '4599', '', '', 'BEP', '', '', '', '', 0x323030362d30392d3034, 0x323030382d30382d3331, 12, 23976, 0, 23977);
INSERT INTO `les_apprentis` VALUES (23981, 0x313938392d30322d3131, '3022', '', '', 'CAP', '', '', '', '', 0x323030362d30392d3031, 0x323030382d30382d3331, 12, 23979, 0, 23980);
INSERT INTO `les_apprentis` VALUES (23984, 0x313938382d30392d3035, '4463', '', '', 'BEP', '', '', '', '', 0x323030362d30372d3238, 0x323030382d30372d3237, 12, 23982, 0, 23983);
INSERT INTO `les_apprentis` VALUES (23987, 0x313938372d31302d3230, '4598', '', '', 'BEP', '', '', '', '', 0x323030362d30382d3238, 0x323030382d30382d3237, 14, 23985, 0, 23986);
INSERT INTO `les_apprentis` VALUES (23990, 0x313938392d30332d3238, '4476', '', '', 'BREVET', '', '', '', '', 0x323030362d30392d3031, 0x323030382d30382d3331, 14, 23988, 0, 23989);
INSERT INTO `les_apprentis` VALUES (23992, 0x313938382d30392d3237, '4474', '', '', 'BREVET', '', '', '', '', 0x323030362d30392d3031, 0x323030382d30382d3331, 14, 23454, 0, 23991);
INSERT INTO `les_apprentis` VALUES (23995, 0x313938382d31302d3236, '4475', '', '', 'CAP', '', '', '', '', 0x323030362d30382d3239, 0x323030382d30382d3038, 14, 23993, 0, 23994);
INSERT INTO `les_apprentis` VALUES (23998, 0x313938382d30352d3330, '3130', '', '', 'BEP', '', '', '', '', 0x323030362d30382d3239, 0x323030382d30382d3238, 14, 23996, 0, 23997);
INSERT INTO `les_apprentis` VALUES (24000, 0x313939302d31322d3231, '4455', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030362d30392d3031, 0x323030382d30382d3331, 44, 23491, 0, 23999);
INSERT INTO `les_apprentis` VALUES (24002, 0x313939302d30352d3238, '4183', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030362d30382d3135, 0x323030382d30382d3134, 44, 23469, 0, 24001);
INSERT INTO `les_apprentis` VALUES (24004, 0x313939312d30322d3233, '4458', '', '', 'BREVET', '', '', '', '', 0x323030362d30372d3131, 0x323030382d30372d3131, 44, 23480, 0, 24003);
INSERT INTO `les_apprentis` VALUES (24007, 0x313939302d30312d3331, '4230', '', '', 'DONNEE INCONNUE', '', '', '', '', 0x323030362d30372d3138, 0x323030382d30372d3138, 44, 24005, 0, 24006);
INSERT INTO `les_apprentis` VALUES (24010, 0x313939312d30372d3238, '4462', '', '', 'BREVET', '', '', '', '', 0x323030362d30382d3238, 0x323030382d30382d3237, 44, 24008, 0, 24009);
INSERT INTO `les_apprentis` VALUES (24012, 0x313939302d31322d3039, '4469', '', '', 'BREVET', '', '', '', '', 0x323030362d30382d3031, 0x323030382d30372d3331, 44, 23568, 0, 24011);
INSERT INTO `les_apprentis` VALUES (24015, 0x313939302d30372d3035, '4198', '', '', 'BREVET', '', '', '', '', 0x323030362d30382d3031, 0x323030382d30372d3331, 44, 24013, 0, 24014);
INSERT INTO `les_apprentis` VALUES (24017, 0x313939302d31312d3134, '4470', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030362d30382d3232, 0x323030382d30382d3231, 44, 23477, 0, 24016);
INSERT INTO `les_apprentis` VALUES (24020, 0x313939312d30312d3236, '4472', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030362d30392d3031, 0x323030382d30382d3331, 44, 24018, 0, 24019);
INSERT INTO `les_apprentis` VALUES (24023, 0x313939312d30392d3236, '4258', '', '', 'DONNEE INCONNUE', '', '', '', '', 0x323030362d30392d3035, 0x323030382d30392d3034, 44, 24021, 0, 24022);
INSERT INTO `les_apprentis` VALUES (24025, 0x313939312d30312d3135, '4197', '', '', 'DONNEE INCONNUE', '', '', '', '', 0x323030362d30382d3033, 0x323030382d30382d3032, 44, 23578, 0, 24024);
INSERT INTO `les_apprentis` VALUES (24030, 0x313938392d31302d3033, '4560', '', '', 'BEP', '', '', '', '', 0x323030362d30382d3034, 0x323030372d30382d3033, 46, 23514, 0, 24029);
INSERT INTO `les_apprentis` VALUES (24033, 0x313938392d31312d3033, '4661', '', '', 'BEP', '', '', '', '', 0x323030362d30372d3034, 0x323030372d30372d3033, 46, 24031, 0, 24032);
INSERT INTO `les_apprentis` VALUES (24036, 0x313938382d30382d3130, '2181', '', '', 'BEP', '', '', '', '', 0x323030362d30382d3235, 0x323030372d30382d3234, 46, 24034, 0, 24035);
INSERT INTO `les_apprentis` VALUES (24038, 0x313938392d31302d3131, '4625', '', '', 'BEP', '', '', '', '', 0x323030362d30392d3035, 0x323030372d30392d3035, 46, 23597, 0, 24037);
INSERT INTO `les_apprentis` VALUES (24040, 0x313938372d31302d3133, '4619', '', '', 'BAC TECHNOLOGIQUE', '', '', '', '', 0x323030362d30392d3031, 0x323030372d30382d3331, 46, 23520, 0, 24039);
INSERT INTO `les_apprentis` VALUES (24042, 0x313938362d31312d3238, '4529', '', '', 'BEP', '', '', '', '', 0x323030362d30392d3035, 0x323030372d30382d3331, 46, 23605, 0, 24041);
INSERT INTO `les_apprentis` VALUES (24044, 0x313938342d30322d3132, '4232', '', '', 'DEUG', '', '', '', '', 0x323030362d30372d3031, 0x323030372d30362d3330, 46, 23581, 0, 24043);
INSERT INTO `les_apprentis` VALUES (24047, 0x313938372d31312d3037, '4559', '', '', 'BAC PRO', '', '', '', '', 0x323030362d30382d3136, 0x323030372d30382d3135, 46, 24045, 0, 24046);
INSERT INTO `les_apprentis` VALUES (24050, 0x313938342d31322d3132, '3942', '', '', 'CAP', '', '', '', '', 0x323030362d30392d3031, 0x323030372d30382d3331, 43, 24048, 0, 24049);
INSERT INTO `les_apprentis` VALUES (24052, 0x313938302d31322d3139, '4640', '', '', 'CAP', '', '', '', '', 0x323030362d30392d3039, 0x323030372d30382d3330, 43, 23586, 0, 24051);
INSERT INTO `les_apprentis` VALUES (24054, 0x313938362d30312d3230, '4639', '', '', 'BAC GENERAL', '', '', '', '', 0x323030362d30392d3038, 0x323030372d30382d3331, 43, 24045, 0, 24053);
INSERT INTO `les_apprentis` VALUES (24057, 0x313939302d30382d3034, '4460', '', '', 'BREVET', '', '', '', '', 0x323030362d30372d3031, 0x323030382d30362d3330, 39, 24055, 0, 24056);
INSERT INTO `les_apprentis` VALUES (24059, 0x313939302d30342d3230, '4596', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030362d30392d3031, 0x323030382d30382d3331, 39, 23554, 0, 24058);
INSERT INTO `les_apprentis` VALUES (24062, 0x313938392d30372d3237, '4421', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030362d30382d3039, 0x323030382d30382d3038, 39, 24060, 0, 24061);
INSERT INTO `les_apprentis` VALUES (24064, 0x313939312d30352d3135, '4428', '', '', 'DONNEE INCONNUE', '', '', '', '', 0x323030362d30392d3031, 0x323030382d30382d3330, 39, 23539, 0, 24063);
INSERT INTO `les_apprentis` VALUES (24066, 0x313939312d30382d3232, '4679', '', '', 'BREVET', '', '', '', '', 0x323030362d30392d3035, 0x323030382d30392d3034, 39, 23565, 0, 24065);
INSERT INTO `les_apprentis` VALUES (24069, 0x313938302d30322d3137, '4257', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030362d30372d3031, 0x323030382d30362d3330, 39, 24067, 0, 24068);
INSERT INTO `les_apprentis` VALUES (24071, 0x313939312d30352d3037, '4590', '', '', 'BREVET', '', '', '', '', 0x323030362d30392d3031, 0x323030382d30382d3331, 39, 23500, 0, 24070);
INSERT INTO `les_apprentis` VALUES (24074, 0x313939302d30322d3233, '4437', '', '', 'C.F.G.', '', '', '', '', 0x323030362d30382d3134, 0x323030382d30382d3133, 39, 24072, 0, 24073);
INSERT INTO `les_apprentis` VALUES (24076, 0x313939302d30342d3130, '4186', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030362d30382d3233, 0x323030362d30382d3331, 39, 23571, 0, 24075);
INSERT INTO `les_apprentis` VALUES (24099, 0x313939302d30372d3230, '4394', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030362d30392d3034, 0x323030382d30392d3033, 28, 24096, 24098, 24097);
INSERT INTO `les_apprentis` VALUES (24101, 0x313938392d31312d3135, '4395', '', '', 'C.F.G.', '', '', '', '', 0x323030362d30392d3034, 0x323030382d30392d3033, 28, 23804, 24098, 24100);
INSERT INTO `les_apprentis` VALUES (24104, 0x313938392d30332d3234, '4720', '', '', 'BREVET', '', '', '', '', 0x323030362d30392d3132, 0x323030382d30392d3131, 28, 24102, 24098, 24103);
INSERT INTO `les_apprentis` VALUES (24107, 0x313938382d30322d3133, '4686', '', '', 'BEP', '', '', '', '', 0x323030362d30392d3131, 0x323030372d30392d3130, 32, 24105, 23358, 24106);
INSERT INTO `les_apprentis` VALUES (24108, 0x313938372d30372d3137, '2447', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030362d30382d3034, 0x323030372d30382d3033, 32, 23771, 23358, 23772);
INSERT INTO `les_apprentis` VALUES (24109, 0x313938382d30332d3139, '3189', '', '', 'BREVET', '', '', '', '', 0x323030362d30392d3031, 0x323030372d30382d3331, 32, 23774, 23358, 23775);
INSERT INTO `les_apprentis` VALUES (24111, 0x313938362d30352d3033, '3224', '', '', 'BREVET', '', '', '', '', 0x323030362d30392d3031, 0x323030372d30382d3331, 32, 24110, 23358, 23778);
INSERT INTO `les_apprentis` VALUES (24112, 0x313938382d30382d3239, '3195', '', '', 'BREVET', '', '', '', '', 0x323030362d30382d3136, 0x323030372d30382d3135, 32, 23780, 23358, 23781);
INSERT INTO `les_apprentis` VALUES (24114, 0x313938382d30352d3137, '3226', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030362d30392d3031, 0x323030372d30382d3331, 32, 24113, 23358, 23784);
INSERT INTO `les_apprentis` VALUES (24115, 0x313938382d30322d3137, '3191', '', '', 'C.F.G.', '', '', '', '', 0x323030362d30392d3031, 0x323030372d30382d3331, 32, 23786, 23358, 23787);
INSERT INTO `les_apprentis` VALUES (24117, 0x313938372d30392d3330, '3192', '', '', 'BREVET', '', '', '', '', 0x323030362d30392d3031, 0x323030372d30382d3331, 32, 24116, 23358, 23790);
INSERT INTO `les_apprentis` VALUES (24119, 0x313938382d30392d3130, '3188', '', '', 'AUCUN DIPLOME', '', '', '', '', 0x323030362d30392d3131, 0x323030372d30382d3331, 32, 24118, 23358, 23793);
INSERT INTO `les_apprentis` VALUES (24121, 0x313938382d30322d3034, '3193', '', '', 'BREVET', '', '', '', '', 0x323030362d30392d3031, 0x323030372d30382d3331, 32, 24120, 23358, 23796);
INSERT INTO `les_apprentis` VALUES (24124, 0x313938362d30322d3038, '3909', '', '', 'BREVET', '', '', '', '', 0x323030362d30392d3131, 0x323030382d30382d3331, 38, 24122, 23294, 24123);
INSERT INTO `les_apprentis` VALUES (24137, 0x313938352d30372d3237, '4730', '', '', 'BAC PRO', '', '', '', '', 0x323030362d30392d3031, 0x323030382d30372d3331, 47, 24135, 0, 24136);
INSERT INTO `les_apprentis` VALUES (24140, 0x313938362d30382d3036, '4731', '', '', 'BAC PRO', '', '', '', '', 0x323030362d30392d3031, 0x323030382d30382d3331, 47, 24138, 0, 24139);
INSERT INTO `les_apprentis` VALUES (24143, 0x313938362d30362d3138, '4728', '', '', 'BAC PRO', '', '', '', '', 0x323030362d30372d3033, 0x323030382d30362d3330, 47, 24141, 0, 24142);
INSERT INTO `les_apprentis` VALUES (24146, 0x313938372d31322d3137, '4721', '', '', 'BAC PRO', '', '', '', '', 0x323030362d30392d3034, 0x323030382d30382d3331, 47, 24144, 0, 24145);
INSERT INTO `les_apprentis` VALUES (24149, 0x313938372d30332d3131, '4727', '', '', 'BAC PRO', '', '', '', '', 0x323030362d30392d3031, 0x323030382d30382d3331, 47, 24147, 0, 24148);
INSERT INTO `les_apprentis` VALUES (24152, 0x313938372d31302d3131, '4722', '', '', 'BAC PRO', '', '', '', '', 0x323030362d30392d3034, 0x323030382d30382d3331, 47, 24150, 0, 24151);
INSERT INTO `les_apprentis` VALUES (24155, 0x313938362d30342d3037, '4726', '', '', 'BAC PRO', '', '', '', '', 0x323030362d30392d3034, 0x323030382d30382d3331, 47, 24153, 0, 24154);
INSERT INTO `les_apprentis` VALUES (24158, 0x313938352d30392d3130, '4725', '', '', 'BAC PRO', '', '', '', '', 0x323030362d30392d3034, 0x323030382d30382d3331, 47, 24156, 0, 24157);
INSERT INTO `les_apprentis` VALUES (24161, 0x313938332d31302d3238, '3994', '', '', 'BAC PRO', '', '', '', '', 0x323030352d30392d3139, 0x323030372d30362d3330, 49, 24159, 0, 24160);
INSERT INTO `les_apprentis` VALUES (24164, 0x313938352d30382d3031, '3999', '', '', 'BAC PRO', '', '', '', '', 0x323030352d30392d3032, 0x323030372d30362d3330, 49, 24162, 0, 24163);
INSERT INTO `les_apprentis` VALUES (24167, 0x313938362d30322d3236, '4051', '', '', 'BAC TECHNOLOGIQUE', '', '', '', '', 0x323030352d30392d3232, 0x323030372d30382d3331, 49, 24165, 0, 24166);
INSERT INTO `les_apprentis` VALUES (24170, 0x313938372d30322d3230, '3993', '', '', 'BAC TECHNOLOGIQUE', '', '', '', '', 0x323030352d30382d3239, 0x323030372d30382d3331, 49, 24168, 0, 24169);
INSERT INTO `les_apprentis` VALUES (24173, 0x313938362d30332d3233, '4047', '', '', 'BAC TECHNOLOGIQUE', '', '', '', '', 0x323030352d30392d3139, 0x323030372d30382d3331, 49, 24171, 0, 24172);
INSERT INTO `les_apprentis` VALUES (24176, 0x313938362d30342d3231, '3997', '', '', 'BAC PRO', '', '', '', '', 0x323030352d30392d3031, 0x323030372d30372d3237, 49, 24174, 0, 24175);
INSERT INTO `les_apprentis` VALUES (24179, 0x313938352d30362d3137, '3996', '', '', 'BAC TECHNOLOGIQUE', '', '', '', '', 0x323030352d30392d3035, 0x323030372d30382d3331, 49, 24177, 0, 24178);
INSERT INTO `les_apprentis` VALUES (24182, 0x313938322d30382d3135, '3412', '', '', 'BAC PRO', '', '', '', '', 0x323030342d30392d3031, 0x323030362d30382d3331, 49, 24180, 0, 24181);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_arbres`
-- 

CREATE TABLE `les_arbres` (
  `id_arbre` bigint(20) NOT NULL auto_increment,
  `nom` varchar(100) NOT NULL default '',
  `type` varchar(10) NOT NULL default '',
  `valider_all_feuilles` binary(1) NOT NULL default '0',
  `id_config` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_arbre`),
  KEY `id_config` (`id_config`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=82 ;

-- 
-- Contenu de la table `les_arbres`
-- 

INSERT INTO `les_arbres` VALUES (49, 'OBJECTIFS DU PROGRAMME DE PRATIQUE PROFESSIONNELLE', 'cfa', 0x30, 5);
INSERT INTO `les_arbres` VALUES (53, 'OBJECTIFS DU PROGRAMME DE PRATIQUE PROFESSIONNELLE', 'entr', 0x30, 5);
INSERT INTO `les_arbres` VALUES (54, 'Progression TP, TA, Orga & Technologie', 'cfa', 0x30, 6);
INSERT INTO `les_arbres` VALUES (55, 'Compétences développées en Entreprise', 'entr', 0x30, 10);
INSERT INTO `les_arbres` VALUES (58, 'TRAVAIL AU CFA', 'cfa', 0x30, 10);
INSERT INTO `les_arbres` VALUES (59, 'programme', 'cfa', 0x30, 12);
INSERT INTO `les_arbres` VALUES (61, 'Référentiel des activités Professionnelles', 'entr', 0x30, 12);
INSERT INTO `les_arbres` VALUES (65, 'Référentiel professionnel', 'entr', 0x30, 13);
INSERT INTO `les_arbres` VALUES (67, 'enseignement général', 'cfa', 0x30, 7);
INSERT INTO `les_arbres` VALUES (70, 'PROGRAMME  FORMATION  AVMS', 'entr', 0x30, 11);
INSERT INTO `les_arbres` VALUES (78, 'CEEJ', 'cfa', 0x30, 6);
INSERT INTO `les_arbres` VALUES (79, 'PROGRAMME  FORMATION  AVMS', 'cfa', 0x30, 11);
INSERT INTO `les_arbres` VALUES (80, 'Tàches éffectuées en entreprise', 'entr', 0x30, 7);
INSERT INTO `les_arbres` VALUES (81, 'Activités et Techniques', 'entr', 0x30, 6);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_chartes_graphiques`
-- 

CREATE TABLE `les_chartes_graphiques` (
  `id_charte` bigint(20) NOT NULL auto_increment,
  `logo` varchar(100) NOT NULL default '',
  `background_page` varchar(100) NOT NULL default '',
  `img_accueil` varchar(100) NOT NULL default '',
  `id_for` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_charte`),
  KEY `id_for` (`id_for`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

-- 
-- Contenu de la table `les_chartes_graphiques`
-- 

INSERT INTO `les_chartes_graphiques` VALUES (7, '13_logo.jpg', '', 'BP_CUISINE_img_accueil_.png', 13);
INSERT INTO `les_chartes_graphiques` VALUES (8, '16_logo.jpg', '', '16_img_accueil.jpg', 16);
INSERT INTO `les_chartes_graphiques` VALUES (9, 'BAC_PRO_METAL_ALU_VERRE_logo_.jpg', '', 'BAC_PRO_METAL_ALU_VERRE_img_accueil_.png', 23);
INSERT INTO `les_chartes_graphiques` VALUES (10, 'PEINTRE_APPLICATEUR_logo_.gif', '', 'PEINTRE_APPLICATEUR_img_accueil_.jpg', 18);
INSERT INTO `les_chartes_graphiques` VALUES (11, 'BP_PREPARATEUR_EN_PHARMACIE_logo_.jpg', '', 'default_img_accueil.png', 17);
INSERT INTO `les_chartes_graphiques` VALUES (12, 'BP_RESTAURANT_logo_.jpg', '', 'default_img_accueil.png', 14);
INSERT INTO `les_chartes_graphiques` VALUES (13, 'EBENISTE_logo_.JPG', '', 'EBENISTE_img_accueil_.jpg', 19);
INSERT INTO `les_chartes_graphiques` VALUES (15, 'CARROSSIER_REPARATEUR_logo_.gif', '', 'CARROSSIER_REPARATEUR_img_accueil_.png', 20);
INSERT INTO `les_chartes_graphiques` VALUES (16, '15_logo.jpg', '', '15_img_accueil.jpg', 15);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_choix_modalite_multiple`
-- 

CREATE TABLE `les_choix_modalite_multiple` (
  `id_choix` bigint(20) NOT NULL auto_increment,
  `libelle` varchar(100) NOT NULL default '',
  `id_modalite` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_choix`),
  KEY `id_modalite` (`id_modalite`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=81 ;

-- 
-- Contenu de la table `les_choix_modalite_multiple`
-- 

INSERT INTO `les_choix_modalite_multiple` VALUES (53, 'TRES BIEN', 18);
INSERT INTO `les_choix_modalite_multiple` VALUES (54, 'BIEN', 18);
INSERT INTO `les_choix_modalite_multiple` VALUES (55, 'MOYEN', 18);
INSERT INTO `les_choix_modalite_multiple` VALUES (56, 'MAUVAIS', 18);
INSERT INTO `les_choix_modalite_multiple` VALUES (64, 'fait', 22);
INSERT INTO `les_choix_modalite_multiple` VALUES (65, 'Avec aide', 23);
INSERT INTO `les_choix_modalite_multiple` VALUES (66, 'En autonomie', 23);
INSERT INTO `les_choix_modalite_multiple` VALUES (67, 'Acquis', 23);
INSERT INTO `les_choix_modalite_multiple` VALUES (72, 'Avec aide', 27);
INSERT INTO `les_choix_modalite_multiple` VALUES (73, 'En autonomie', 27);
INSERT INTO `les_choix_modalite_multiple` VALUES (74, 'Acquis', 27);
INSERT INTO `les_choix_modalite_multiple` VALUES (75, 'EN DESACCORD AVEC LA DECLARATION', 28);
INSERT INTO `les_choix_modalite_multiple` VALUES (76, 'EVALUATION JUSTE', 28);
INSERT INTO `les_choix_modalite_multiple` VALUES (77, 'BON TRAVAIL', 28);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_choix_reponse`
-- 

CREATE TABLE `les_choix_reponse` (
  `id_reponse` bigint(20) NOT NULL auto_increment,
  `reponse` varchar(250) NOT NULL default '',
  `id_modalite` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_reponse`),
  KEY `id_question` (`id_modalite`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

-- 
-- Contenu de la table `les_choix_reponse`
-- 

INSERT INTO `les_choix_reponse` VALUES (25, 'Aucune maîtrise', 5);
INSERT INTO `les_choix_reponse` VALUES (26, 'Maîtrise insuffisante', 5);
INSERT INTO `les_choix_reponse` VALUES (27, 'Conforme aux exigences', 5);
INSERT INTO `les_choix_reponse` VALUES (28, 'Supérieur aux exigences', 5);
INSERT INTO `les_choix_reponse` VALUES (29, 'Aucune maîtrise', 6);
INSERT INTO `les_choix_reponse` VALUES (30, 'Maîtrise insuffisante', 6);
INSERT INTO `les_choix_reponse` VALUES (31, 'Conforme aux exigences', 6);
INSERT INTO `les_choix_reponse` VALUES (32, 'Supérieur aux exigences', 6);
INSERT INTO `les_choix_reponse` VALUES (35, 'Acquis en autonomie', 8);
INSERT INTO `les_choix_reponse` VALUES (36, 'Acquis avec aide', 8);
INSERT INTO `les_choix_reponse` VALUES (37, 'Non Acquis', 8);
INSERT INTO `les_choix_reponse` VALUES (38, 'Observé', 8);
INSERT INTO `les_choix_reponse` VALUES (39, 'Acquis', 9);
INSERT INTO `les_choix_reponse` VALUES (40, 'Acquis avec aide', 9);
INSERT INTO `les_choix_reponse` VALUES (41, 'Non acquis', 9);
INSERT INTO `les_choix_reponse` VALUES (42, 'Observé', 9);
INSERT INTO `les_choix_reponse` VALUES (43, 'Vu', 10);
INSERT INTO `les_choix_reponse` VALUES (44, 'Absent', 10);
INSERT INTO `les_choix_reponse` VALUES (45, 'Aucune maîtrise', 11);
INSERT INTO `les_choix_reponse` VALUES (46, 'Maîtrise insuffisante', 11);
INSERT INTO `les_choix_reponse` VALUES (47, 'Conforme aux exigences', 11);
INSERT INTO `les_choix_reponse` VALUES (48, 'Supérieur aux exigences', 11);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_classes`
-- 

CREATE TABLE `les_classes` (
  `id_cla` bigint(20) NOT NULL auto_increment,
  `libelle` varchar(100) NOT NULL default '',
  `niveau_etude` tinyint(4) NOT NULL default '0',
  `id_for` bigint(20) NOT NULL default '0',
  `id_ens` bigint(20) default NULL,
  PRIMARY KEY  (`id_cla`),
  KEY `id_for` (`id_for`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

-- 
-- Contenu de la table `les_classes`
-- 

INSERT INTO `les_classes` VALUES (12, 'L-HOTE-BP1C', 1, 13, 0);
INSERT INTO `les_classes` VALUES (13, 'L-HOTE-BP2C', 2, 13, 0);
INSERT INTO `les_classes` VALUES (14, 'L-HOTE-BP1R', 1, 14, 0);
INSERT INTO `les_classes` VALUES (15, 'L-HOTE-BP2R', 2, 14, 0);
INSERT INTO `les_classes` VALUES (23, 'L-PHAR-BP1A', 1, 17, 0);
INSERT INTO `les_classes` VALUES (24, 'L-PHAR-BP1B', 1, 17, 0);
INSERT INTO `les_classes` VALUES (25, 'L-PHAR-BP2A', 2, 17, 0);
INSERT INTO `les_classes` VALUES (27, 'L-PHAR-BP2B', 2, 17, 0);
INSERT INTO `les_classes` VALUES (28, '1ere année carrossier', 1, 20, 0);
INSERT INTO `les_classes` VALUES (29, '2nde année CARROSSIER', 2, 20, 0);
INSERT INTO `les_classes` VALUES (32, 'CAP Parcours dérogatoire peint', 2, 22, 0);
INSERT INTO `les_classes` VALUES (33, 'EMFPA PA1B', 1, 18, 0);
INSERT INTO `les_classes` VALUES (34, 'CAP3 PA2B', 2, 18, 0);
INSERT INTO `les_classes` VALUES (35, 'EMFPA EB2A', 2, 19, 0);
INSERT INTO `les_classes` VALUES (37, 'BAC PRO MAV2', 2, 23, 0);
INSERT INTO `les_classes` VALUES (38, 'BAC PRO AVMS 1', 1, 23, 0);
INSERT INTO `les_classes` VALUES (39, 'L-PATI-PAT1', 1, 15, 0);
INSERT INTO `les_classes` VALUES (40, 'L-PATI-PAT2', 2, 15, 0);
INSERT INTO `les_classes` VALUES (41, 'L-PATI-PAT2 DISP', 2, 15, 0);
INSERT INTO `les_classes` VALUES (43, 'L-PATI-EUROPE PAT2', 2, 15, 0);
INSERT INTO `les_classes` VALUES (44, 'L-PATI-BEPPAT1', 1, 16, 0);
INSERT INTO `les_classes` VALUES (45, 'L-PATI-BEPPAT2', 2, 16, 0);
INSERT INTO `les_classes` VALUES (46, 'L-PATI-BEPPAT2 DISP', 2, 16, 0);
INSERT INTO `les_classes` VALUES (47, 'L-INDU-BTSCPI1', 1, 24, 0);
INSERT INTO `les_classes` VALUES (49, 'L-INDU--BTSCPI2', 2, 24, 0);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_configs_lea`
-- 

CREATE TABLE `les_configs_lea` (
  `id_config` bigint(11) NOT NULL auto_increment,
  `suivi_entr_guide_actif` char(1) character set latin1 collate latin1_bin NOT NULL default '0',
  `suivi_entr_libre_actif` char(1) character set latin1 collate latin1_bin NOT NULL default '0',
  `suivi_cfa_guide_actif` char(1) character set latin1 collate latin1_bin NOT NULL default '0',
  `suivi_cfa_libre_actif` char(1) character set latin1 collate latin1_bin NOT NULL default '0',
  `appelation_ma` varchar(50) NOT NULL default '',
  `appelation_tuteur_cfa` varchar(50) NOT NULL default '',
  `DMSA_dec_entr` tinyint(4) NOT NULL default '0',
  `DMSA_dec_cfa` tinyint(4) NOT NULL default '0',
  `app_joint_fichiers_suivi_entr` char(1) character set latin1 collate latin1_bin NOT NULL default '1',
  `app_joint_fichiers_suivi_cfa` char(1) character set latin1 collate latin1_bin NOT NULL default '1',
  `id_for` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_config`),
  KEY `id_for` (`id_for`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- 
-- Contenu de la table `les_configs_lea`
-- 

INSERT INTO `les_configs_lea` VALUES (5, 0x31, 0x31, 0x31, 0x31, 'maitre d''apprentissage', 'formateur', 21, 21, 0x31, 0x31, 13);
INSERT INTO `les_configs_lea` VALUES (6, 0x31, 0x31, 0x31, 0x31, 'maitre apprentissage', 'tuteur', 15, 21, 0x31, 0x31, 14);
INSERT INTO `les_configs_lea` VALUES (7, 0x31, 0x31, 0x31, 0x31, 'maître d''apprentissage', 'formateur', 127, 127, 0x31, 0x31, 16);
INSERT INTO `les_configs_lea` VALUES (8, 0x30, 0x30, 0x30, 0x30, 'maitre apprentissage', 'tuteur', 15, 15, 0x31, 0x31, 22);
INSERT INTO `les_configs_lea` VALUES (9, 0x30, 0x30, 0x30, 0x30, 'maitre apprentissage', 'tuteur', 15, 15, 0x31, 0x31, 15);
INSERT INTO `les_configs_lea` VALUES (10, 0x31, 0x31, 0x31, 0x31, 'Maître d''apprentissage', 'TUTEUR', 20, 20, 0x31, 0x31, 18);
INSERT INTO `les_configs_lea` VALUES (11, 0x31, 0x31, 0x31, 0x30, 'maître apprentissage', 'tuteur', 15, 15, 0x31, 0x31, 23);
INSERT INTO `les_configs_lea` VALUES (12, 0x31, 0x31, 0x31, 0x31, 'maitre apprentissage', 'tuteur', 60, 60, 0x31, 0x31, 17);
INSERT INTO `les_configs_lea` VALUES (13, 0x31, 0x31, 0x31, 0x31, 'maitre apprentissage', 'référent', 15, 15, 0x31, 0x31, 20);
INSERT INTO `les_configs_lea` VALUES (15, 0x30, 0x30, 0x30, 0x30, 'maitre apprentissage', 'tuteur', 15, 15, 0x31, 0x31, 19);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_declarations`
-- 

CREATE TABLE `les_declarations` (
  `id_dec` bigint(20) NOT NULL auto_increment,
  `id_app` bigint(20) NOT NULL default '0',
  `id_periode` bigint(20) NOT NULL default '0',
  `date_dec` date NOT NULL default '0000-00-00',
  `etat` char(2) NOT NULL default 'v',
  `type_suivi` varchar(4) NOT NULL default 'entr',
  PRIMARY KEY  (`id_dec`),
  UNIQUE KEY `id_app_2` (`id_app`,`id_periode`,`type_suivi`),
  KEY `id_periode` (`id_periode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=161 ;

-- 
-- Contenu de la table `les_declarations`
-- 

INSERT INTO `les_declarations` VALUES (66, 23387, 42, 0x323030362d30352d3233, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (67, 23390, 42, 0x323030362d30352d3233, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (68, 23393, 42, 0x323030362d30352d3233, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (69, 23396, 42, 0x323030362d30352d3233, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (70, 23399, 42, 0x323030362d30352d3233, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (71, 23402, 42, 0x323030362d30352d3233, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (72, 23405, 42, 0x323030362d30352d3233, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (73, 23407, 42, 0x323030362d30352d3233, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (74, 23387, 42, 0x323030362d30352d3233, 'nv', '');
INSERT INTO `les_declarations` VALUES (75, 23390, 42, 0x323030362d30352d3233, 'nv', '');
INSERT INTO `les_declarations` VALUES (76, 23393, 42, 0x323030362d30352d3233, 'nv', '');
INSERT INTO `les_declarations` VALUES (77, 23396, 42, 0x323030362d30352d3233, 'nv', '');
INSERT INTO `les_declarations` VALUES (78, 23399, 42, 0x323030362d30352d3233, 'nv', '');
INSERT INTO `les_declarations` VALUES (79, 23402, 42, 0x323030362d30352d3233, 'nv', '');
INSERT INTO `les_declarations` VALUES (80, 23405, 42, 0x323030362d30352d3233, 'nv', '');
INSERT INTO `les_declarations` VALUES (81, 23407, 42, 0x323030362d30352d3233, 'nv', '');
INSERT INTO `les_declarations` VALUES (82, 23387, 43, 0x323030362d30352d3233, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (83, 23390, 43, 0x323030362d30352d3233, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (84, 23393, 43, 0x323030362d30352d3233, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (85, 23396, 43, 0x323030362d30352d3233, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (86, 23399, 43, 0x323030362d30352d3233, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (87, 23402, 43, 0x323030362d30352d3233, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (88, 23405, 43, 0x323030362d30352d3233, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (89, 23407, 43, 0x323030362d30352d3233, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (90, 23387, 44, 0x323030362d30352d3233, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (91, 23390, 44, 0x323030362d30352d3233, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (92, 23393, 44, 0x323030362d30352d3233, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (93, 23396, 44, 0x323030362d30352d3233, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (94, 23399, 44, 0x323030362d30352d3233, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (95, 23402, 44, 0x323030362d30352d3233, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (96, 23405, 44, 0x323030362d30352d3233, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (97, 23407, 44, 0x323030362d30352d3233, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (106, 23387, 42, 0x323030362d30352d3234, 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (107, 23387, 45, 0x323030362d30352d3234, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (108, 23387, 43, 0x323030362d30352d3234, 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (109, 23387, 46, 0x323030362d30352d3234, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (110, 23396, 44, 0x323030362d30352d3234, 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (111, 23407, 44, 0x323030362d30352d3234, 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (112, 23393, 44, 0x323030362d30352d3234, 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (113, 23402, 44, 0x323030362d30352d3234, 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (114, 23387, 44, 0x323030362d30352d3234, 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (115, 23405, 44, 0x323030362d30352d3234, 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (116, 23402, 45, 0x323030362d30352d3234, 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (117, 23407, 45, 0x323030362d30352d3234, 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (118, 23393, 45, 0x323030362d30352d3234, 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (119, 23396, 45, 0x323030362d30352d3234, 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (120, 23405, 45, 0x323030362d30352d3234, 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (121, 23387, 45, 0x323030362d30352d3234, 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (122, 23407, 42, 0x323030362d30352d3234, 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (123, 23390, 46, 0x323030362d30352d3234, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (124, 23393, 46, 0x323030362d30352d3234, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (125, 23396, 46, 0x323030362d30352d3234, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (126, 23399, 46, 0x323030362d30352d3234, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (127, 23402, 46, 0x323030362d30352d3234, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (128, 23405, 46, 0x323030362d30352d3234, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (129, 23407, 46, 0x323030362d30352d3234, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (130, 23387, 46, 0x323030362d30352d3234, 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (131, 23402, 46, 0x323030362d30352d3234, 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (132, 23407, 46, 0x323030362d30352d3234, 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (133, 23830, 71, 0x323030362d30362d3232, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (134, 23830, 71, 0x323030362d30362d3232, 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (135, 23869, 71, 0x323030362d30362d3232, 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (138, 23739, 85, 0x323030362d30362d3236, 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (139, 23901, 102, 0x323030362d30362d3330, 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (140, 23901, 103, 0x323030362d30362d3330, 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (144, 23830, 81, 0x323030362d30372d3032, 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (145, 23390, 48, 0x323030362d30372d3037, 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (146, 23869, 71, 0x323030362d30392d3031, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (147, 23869, 81, 0x323030362d30392d3031, 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (148, 23901, 104, 0x323030362d30392d3131, 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (151, 23901, 102, 0x323030362d30392d3132, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (152, 23901, 105, 0x323030362d30392d3133, 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (153, 23901, 103, 0x323030362d30392d3133, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (154, 23484, 122, 0x323030362d30392d3134, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (155, 23949, 42, 0x323030362d30392d3139, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (156, 23947, 102, 0x323030362d30392d3230, 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (157, 23947, 102, 0x323030362d30392d3231, 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (159, 23947, 103, 0x323030362d30392d3231, 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (160, 23987, 66, 0x323030362d30392d3231, 'nv', 'cfa');

-- --------------------------------------------------------

-- 
-- Structure de la table `les_declarations_modalite_reponse_choix`
-- 

CREATE TABLE `les_declarations_modalite_reponse_choix` (
  `id_dec` bigint(20) NOT NULL default '0',
  `id_modalite` bigint(20) NOT NULL default '0',
  `id_reponse` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_dec`,`id_modalite`,`id_reponse`),
  KEY `id_reponse` (`id_reponse`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `les_declarations_modalite_reponse_choix`
-- 

INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (67, 6, 30);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (83, 6, 30);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (87, 6, 30);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (88, 6, 30);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (89, 6, 30);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (91, 6, 30);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (127, 6, 30);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (66, 6, 31);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (68, 6, 31);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (69, 6, 31);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (70, 6, 31);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (71, 6, 31);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (72, 6, 31);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (73, 6, 31);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (82, 6, 31);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (85, 6, 31);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (86, 6, 31);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (90, 6, 31);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (92, 6, 31);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (93, 6, 31);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (94, 6, 31);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (95, 6, 31);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (96, 6, 31);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (97, 6, 31);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (109, 6, 31);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (124, 6, 31);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (125, 6, 31);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (126, 6, 31);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (128, 6, 31);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (129, 6, 31);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (84, 6, 32);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (144, 8, 35);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (147, 8, 35);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (134, 8, 36);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (144, 9, 39);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (134, 9, 40);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (160, 10, 43);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_declarations_modalite_reponse_libre`
-- 

CREATE TABLE `les_declarations_modalite_reponse_libre` (
  `id_dec` bigint(20) NOT NULL default '0',
  `id_modalite` bigint(20) NOT NULL default '0',
  `texte` text NOT NULL,
  PRIMARY KEY  (`id_dec`,`id_modalite`),
  KEY `id_modalite` (`id_modalite`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `les_declarations_modalite_reponse_libre`
-- 

INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (66, 17, 'Bon travail, revoir la conduite de cuisson rôtir et la réalisation du jus en entreprise');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (67, 17, 'Absent');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (68, 17, 'Bon travail mené sur les cuissons. Quelques difficultés rencontrées sur le travail de pâtisserie (parfait glacé).');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (69, 17, 'Bon travail mené sur la cuisson rôtir. Revoir la réalisation du parfait glacé en entreprise.');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (70, 17, 'Difficultés rencontrées dans la conduite de cuisson rôtir et la réalisation du jus. Bon travail mené sur le parfait glacé.');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (71, 17, 'Bon travail sur cette séance. Attention à l''hygiène et à l''organisation.');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (72, 17, 'Bono travail mené sur cette séance. RAS.');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (73, 17, 'Très bon travail, RAS.');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (82, 17, 'Pas d''évaluation.');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (83, 17, 'Pas d''évaluation.');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (84, 17, 'Pas d''évaluation.');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (85, 17, 'Pas d''évaluation.');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (86, 17, 'Pas d''évaluation.');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (87, 17, 'Pas d''évaluation.');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (88, 17, 'Pas d''évaluation.');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (89, 17, 'Pas d''évaluation.');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (90, 17, 'Bon travail. Revoir le Paris Brest en entreprise.');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (91, 17, 'Des imprécisions, notamment sur la pâte à choux.');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (92, 17, 'Très bon travail, notamment sur le velouté Agnès Sorel. Bonne maîtrise des textures et des assaisonnements.');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (93, 17, 'Bon travail mené sur cette séance. Revoir le Paris Brest en entreprise.');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (94, 17, 'Bon travail mené sur cette séance. Attention aux techniues de base (pâte à choux).');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (95, 17, 'Bon travail mené sur cette séance. Revoir le Paris Brest en entreprise.');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (96, 17, 'Bon travail. Revoir la technique du Paris Brest en entreprise.');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (97, 17, 'Bon travail sur cette séance. Attention aux assaisonnements et liaison d''un velouté.');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (109, 17, 'Travail sérieux sur la période, revoir le velouté en entreprise');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (123, 17, 'absent');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (124, 17, 'Bon travail mené sur la séance, attention à la réalisation du riz impératrice');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (125, 17, 'Bon travail mené sur la séance, revoir la réalisation du riz impératrice en entreprise');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (126, 17, 'Travail sérieux sur la séance, revoir le riz impératrice en entreprise');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (127, 17, 'Travail correct. En difficulté sur la réalisation du riz impératrice, à revoir impérativement en entreprise');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (128, 17, 'Bon travail mené sur la séance, revoir le riz impératrice en entreprise');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (129, 17, 'Bon travail mené sur la séance, revoir le riz impératrice en entreprise');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (133, 25, '');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (133, 27, '');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (133, 28, 'HJGO IU PIUGYBKJYHMO');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (133, 33, 'Ne pas oublier les devoirs de quinzaine.\r\nEn VSP aussi\r\n\r\nOù sont les dessins de style de la période ?');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (134, 21, 'nsqekdjhzaoeifhqksjdfbKAQJSB');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (134, 31, 'HYTFIUVYMOIUMONINJ');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (134, 33, 'Ne pas oublier les devoirs de quinzaine.\r\nEn VSP aussi');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (144, 21, 'Bonne volonté, il faudrait plus d''attention !');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (144, 31, 'Des choses sont difficiles, il faut beaucoup regarder.');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (146, 28, 'Je suis très content');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (147, 31, 'J''ai fait beaucoup de choses');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (151, 43, 'OPERATION DE METRAGE\r\n\r\nCALCUL DE SURFACE DE VERRE');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (151, 44, '');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (151, 45, '');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (151, 46, '');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (151, 47, '');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (151, 48, '');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (151, 49, '');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (153, 43, 'RAPPELS  SUR LES CALCULS DE SUPERFICIE');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (153, 44, '');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (153, 45, '');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (153, 46, '');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (153, 47, '');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (153, 48, '');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (156, 43, 'GEOMETRIE PLANE:\r\n\r\nRAPPELS:Calcul de surface - Métrage\r\n\r\nOK');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (156, 44, 'Apprentisssage DAO Autocad');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (156, 45, 'BIOGRAPHIE');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (156, 46, 'structure des elements');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (156, 47, 'CHRONOLOGIE');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (156, 48, 'VOCABULAIRE TECHNIQUE/METIER');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (156, 49, 'MATHS   - OK, c''est compris.');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (157, 43, 'GEOMETRIE PLANE:\r\n\r\nRAPPELS:Calcul de surface - Métrage\r\n\r\nOK');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (157, 44, 'Apprentisssage DAO Autocad');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (157, 45, 'BIOGRAPHIE');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (157, 46, 'structure des elements');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (157, 47, 'CHRONOLOGIE');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (157, 48, 'VOCABULAIRE TECHNIQUE/METIER');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (157, 49, 'MATHS   - OK, c''est compris.');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (159, 43, '');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (159, 44, 'autocad');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (159, 45, '');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (159, 46, '');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (159, 47, '');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (159, 48, '');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (159, 50, '');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (160, 65, 'Fiche produit : Agneau, Dorade, Bacardi, Bronx\r\nRestaurants Etoilés');

-- --------------------------------------------------------

-- 
-- Structure de la table `les_documents_declares`
-- 

CREATE TABLE `les_documents_declares` (
  `id_doc` bigint(20) NOT NULL auto_increment,
  `src_doc` varchar(100) NOT NULL default '',
  `confidentialite` char(1) character set latin1 collate latin1_bin NOT NULL default '1',
  `id_dec` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_doc`),
  KEY `id_dec` (`id_dec`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- Contenu de la table `les_documents_declares`
-- 

INSERT INTO `les_documents_declares` VALUES (1, 'slide_background_.jpeg', 0x30, 135);
INSERT INTO `les_documents_declares` VALUES (2, 'Coucher_de_soleil_.jpg', 0x30, 148);
INSERT INTO `les_documents_declares` VALUES (3, '.jpg', 0x30, 152);
INSERT INTO `les_documents_declares` VALUES (4, '.jghkghjkjkhjkhjkhjkhkjhkhjkjhkjhkhkhkjhjkhkhjkh', 0x30, 154);
INSERT INTO `les_documents_declares` VALUES (6, 'cloison_indust_.gif', 0x30, 157);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_enseignants`
-- 

CREATE TABLE `les_enseignants` (
  `id_ens` bigint(20) NOT NULL default '0',
  `discipline` tinytext,
  PRIMARY KEY  (`id_ens`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `les_enseignants`
-- 

INSERT INTO `les_enseignants` VALUES (23283, '');
INSERT INTO `les_enseignants` VALUES (23284, 'Fran&ccedil;ais-Histoire G&eacute;o.');
INSERT INTO `les_enseignants` VALUES (23285, '');
INSERT INTO `les_enseignants` VALUES (23286, '');
INSERT INTO `les_enseignants` VALUES (23287, 'Maçonnerie Gros Oeuvre');
INSERT INTO `les_enseignants` VALUES (23288, '');
INSERT INTO `les_enseignants` VALUES (23289, 'SANITAIRES & THERMIQUES');
INSERT INTO `les_enseignants` VALUES (23290, 'Maçonnerie - Gros Oeuvre');
INSERT INTO `les_enseignants` VALUES (23291, '');
INSERT INTO `les_enseignants` VALUES (23292, 'MENUISERIE INSTALLATEUR - CHARPENTE');
INSERT INTO `les_enseignants` VALUES (23293, '');
INSERT INTO `les_enseignants` VALUES (23294, '');
INSERT INTO `les_enseignants` VALUES (23295, 'BOIS - MENUISERIE FABRICANT');
INSERT INTO `les_enseignants` VALUES (23296, '');
INSERT INTO `les_enseignants` VALUES (23297, '');
INSERT INTO `les_enseignants` VALUES (23298, '');
INSERT INTO `les_enseignants` VALUES (23299, '');
INSERT INTO `les_enseignants` VALUES (23300, '');
INSERT INTO `les_enseignants` VALUES (23301, '');
INSERT INTO `les_enseignants` VALUES (23302, '');
INSERT INTO `les_enseignants` VALUES (23303, '');
INSERT INTO `les_enseignants` VALUES (23304, '');
INSERT INTO `les_enseignants` VALUES (23305, '');
INSERT INTO `les_enseignants` VALUES (23306, 'DESSIN D&#039;ART &amp; DE STYLE');
INSERT INTO `les_enseignants` VALUES (23307, 'COUVERTURE - TECHNIQUES DU TOIT');
INSERT INTO `les_enseignants` VALUES (23308, '');
INSERT INTO `les_enseignants` VALUES (23309, '');
INSERT INTO `les_enseignants` VALUES (23310, '');
INSERT INTO `les_enseignants` VALUES (23311, 'DESSIN CONSTRUCTION');
INSERT INTO `les_enseignants` VALUES (23312, 'PLATRERIE-CARRELAGE-MAÇONNERIE');
INSERT INTO `les_enseignants` VALUES (23313, '');
INSERT INTO `les_enseignants` VALUES (23314, '');
INSERT INTO `les_enseignants` VALUES (23315, 'MATH - SCIENCES');
INSERT INTO `les_enseignants` VALUES (23316, '');
INSERT INTO `les_enseignants` VALUES (23317, '');
INSERT INTO `les_enseignants` VALUES (23318, '');
INSERT INTO `les_enseignants` VALUES (23319, '');
INSERT INTO `les_enseignants` VALUES (23320, 'MATH - SCIENCES');
INSERT INTO `les_enseignants` VALUES (23321, '');
INSERT INTO `les_enseignants` VALUES (23322, '');
INSERT INTO `les_enseignants` VALUES (23323, '');
INSERT INTO `les_enseignants` VALUES (23324, 'FRANÇAIS - HISTOIRE GEO.');
INSERT INTO `les_enseignants` VALUES (23326, '');
INSERT INTO `les_enseignants` VALUES (23327, 'Ebenisterie');
INSERT INTO `les_enseignants` VALUES (23328, 'V.S.P. - LANGUES');
INSERT INTO `les_enseignants` VALUES (23329, '');
INSERT INTO `les_enseignants` VALUES (23330, '');
INSERT INTO `les_enseignants` VALUES (23331, '');
INSERT INTO `les_enseignants` VALUES (23332, 'E.P.S.');
INSERT INTO `les_enseignants` VALUES (23333, '');
INSERT INTO `les_enseignants` VALUES (23334, '');
INSERT INTO `les_enseignants` VALUES (23335, '');
INSERT INTO `les_enseignants` VALUES (23336, '');
INSERT INTO `les_enseignants` VALUES (23337, '');
INSERT INTO `les_enseignants` VALUES (23338, '');
INSERT INTO `les_enseignants` VALUES (23339, '');
INSERT INTO `les_enseignants` VALUES (23340, 'DESSIN CONSTRUCTION');
INSERT INTO `les_enseignants` VALUES (23341, '');
INSERT INTO `les_enseignants` VALUES (23342, '');
INSERT INTO `les_enseignants` VALUES (23343, '');
INSERT INTO `les_enseignants` VALUES (23344, '');
INSERT INTO `les_enseignants` VALUES (23345, '');
INSERT INTO `les_enseignants` VALUES (23346, '');
INSERT INTO `les_enseignants` VALUES (23347, '');
INSERT INTO `les_enseignants` VALUES (23348, '');
INSERT INTO `les_enseignants` VALUES (23349, '');
INSERT INTO `les_enseignants` VALUES (23350, '');
INSERT INTO `les_enseignants` VALUES (23351, 'FRANÇAIS - HISTOIRE GEO.');
INSERT INTO `les_enseignants` VALUES (23352, 'MATH - SCIENCES');
INSERT INTO `les_enseignants` VALUES (23353, '');
INSERT INTO `les_enseignants` VALUES (23354, '');
INSERT INTO `les_enseignants` VALUES (23355, 'E.P.S.');
INSERT INTO `les_enseignants` VALUES (23356, '');
INSERT INTO `les_enseignants` VALUES (23357, '');
INSERT INTO `les_enseignants` VALUES (23358, '');
INSERT INTO `les_enseignants` VALUES (23359, '');
INSERT INTO `les_enseignants` VALUES (23360, 'V.S.P. - E.C.J.');
INSERT INTO `les_enseignants` VALUES (23361, '');
INSERT INTO `les_enseignants` VALUES (23362, '');
INSERT INTO `les_enseignants` VALUES (23363, 'HISTOIRE DE L''ART-DESSIN D''ART & DE STYLE');
INSERT INTO `les_enseignants` VALUES (23364, '');
INSERT INTO `les_enseignants` VALUES (23365, 'FRANÇAIS-HISTOIRE GEO.');
INSERT INTO `les_enseignants` VALUES (23366, '');
INSERT INTO `les_enseignants` VALUES (23367, '');
INSERT INTO `les_enseignants` VALUES (23368, '');
INSERT INTO `les_enseignants` VALUES (23369, '');
INSERT INTO `les_enseignants` VALUES (23370, 'DESSIN CONSTRUCTION');
INSERT INTO `les_enseignants` VALUES (23371, 'DESSIN CONSTRUCTION &TECHNIQUE');
INSERT INTO `les_enseignants` VALUES (23372, '');
INSERT INTO `les_enseignants` VALUES (23373, '');
INSERT INTO `les_enseignants` VALUES (23374, '');
INSERT INTO `les_enseignants` VALUES (23375, '');
INSERT INTO `les_enseignants` VALUES (23376, '');
INSERT INTO `les_enseignants` VALUES (23377, '');
INSERT INTO `les_enseignants` VALUES (23378, 'PEINTURE');
INSERT INTO `les_enseignants` VALUES (23379, '');
INSERT INTO `les_enseignants` VALUES (23380, '');
INSERT INTO `les_enseignants` VALUES (23381, '');
INSERT INTO `les_enseignants` VALUES (23382, '');
INSERT INTO `les_enseignants` VALUES (23383, '');
INSERT INTO `les_enseignants` VALUES (23384, '');
INSERT INTO `les_enseignants` VALUES (23385, '');
INSERT INTO `les_enseignants` VALUES (23887, 'MATH - SCIENCES');
INSERT INTO `les_enseignants` VALUES (23892, '');
INSERT INTO `les_enseignants` VALUES (23894, '');
INSERT INTO `les_enseignants` VALUES (23895, 'MATH-SCIENCES');
INSERT INTO `les_enseignants` VALUES (23896, 'TECHNIQUE DU TOIT');
INSERT INTO `les_enseignants` VALUES (23897, 'Enseignement Adapté');
INSERT INTO `les_enseignants` VALUES (23898, 'INDIVIDUALISATION - C.D.R.');
INSERT INTO `les_enseignants` VALUES (23906, '');
INSERT INTO `les_enseignants` VALUES (23935, '');
INSERT INTO `les_enseignants` VALUES (24098, '');

-- --------------------------------------------------------

-- 
-- Structure de la table `les_enseignants_formations`
-- 

CREATE TABLE `les_enseignants_formations` (
  `id_ens` bigint(20) NOT NULL default '0',
  `id_for` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_ens`,`id_for`),
  KEY `id_for` (`id_for`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `les_enseignants_formations`
-- 

INSERT INTO `les_enseignants_formations` VALUES (23304, 13);
INSERT INTO `les_enseignants_formations` VALUES (23317, 13);
INSERT INTO `les_enseignants_formations` VALUES (23321, 13);
INSERT INTO `les_enseignants_formations` VALUES (23322, 13);
INSERT INTO `les_enseignants_formations` VALUES (23349, 13);
INSERT INTO `les_enseignants_formations` VALUES (23351, 13);
INSERT INTO `les_enseignants_formations` VALUES (23372, 13);
INSERT INTO `les_enseignants_formations` VALUES (23374, 13);
INSERT INTO `les_enseignants_formations` VALUES (23377, 13);
INSERT INTO `les_enseignants_formations` VALUES (23892, 13);
INSERT INTO `les_enseignants_formations` VALUES (23297, 16);
INSERT INTO `les_enseignants_formations` VALUES (23304, 16);
INSERT INTO `les_enseignants_formations` VALUES (23317, 16);
INSERT INTO `les_enseignants_formations` VALUES (23319, 16);
INSERT INTO `les_enseignants_formations` VALUES (23330, 16);
INSERT INTO `les_enseignants_formations` VALUES (23363, 16);
INSERT INTO `les_enseignants_formations` VALUES (23373, 16);
INSERT INTO `les_enseignants_formations` VALUES (23377, 16);
INSERT INTO `les_enseignants_formations` VALUES (23892, 16);
INSERT INTO `les_enseignants_formations` VALUES (23288, 17);
INSERT INTO `les_enseignants_formations` VALUES (23297, 17);
INSERT INTO `les_enseignants_formations` VALUES (23303, 17);
INSERT INTO `les_enseignants_formations` VALUES (23304, 17);
INSERT INTO `les_enseignants_formations` VALUES (23326, 17);
INSERT INTO `les_enseignants_formations` VALUES (23331, 17);
INSERT INTO `les_enseignants_formations` VALUES (23349, 17);
INSERT INTO `les_enseignants_formations` VALUES (23351, 17);
INSERT INTO `les_enseignants_formations` VALUES (23369, 17);
INSERT INTO `les_enseignants_formations` VALUES (23284, 18);
INSERT INTO `les_enseignants_formations` VALUES (23306, 18);
INSERT INTO `les_enseignants_formations` VALUES (23311, 18);
INSERT INTO `les_enseignants_formations` VALUES (23315, 18);
INSERT INTO `les_enseignants_formations` VALUES (23320, 18);
INSERT INTO `les_enseignants_formations` VALUES (23324, 18);
INSERT INTO `les_enseignants_formations` VALUES (23332, 18);
INSERT INTO `les_enseignants_formations` VALUES (23340, 18);
INSERT INTO `les_enseignants_formations` VALUES (23352, 18);
INSERT INTO `les_enseignants_formations` VALUES (23360, 18);
INSERT INTO `les_enseignants_formations` VALUES (23363, 18);
INSERT INTO `les_enseignants_formations` VALUES (23365, 18);
INSERT INTO `les_enseignants_formations` VALUES (23378, 18);
INSERT INTO `les_enseignants_formations` VALUES (23887, 18);
INSERT INTO `les_enseignants_formations` VALUES (23895, 18);
INSERT INTO `les_enseignants_formations` VALUES (23897, 18);
INSERT INTO `les_enseignants_formations` VALUES (23898, 18);
INSERT INTO `les_enseignants_formations` VALUES (23327, 19);
INSERT INTO `les_enseignants_formations` VALUES (23305, 20);
INSERT INTO `les_enseignants_formations` VALUES (23286, 23);
INSERT INTO `les_enseignants_formations` VALUES (23293, 23);
INSERT INTO `les_enseignants_formations` VALUES (23294, 23);
INSERT INTO `les_enseignants_formations` VALUES (23306, 23);
INSERT INTO `les_enseignants_formations` VALUES (23339, 23);
INSERT INTO `les_enseignants_formations` VALUES (23346, 23);
INSERT INTO `les_enseignants_formations` VALUES (23355, 23);
INSERT INTO `les_enseignants_formations` VALUES (23371, 23);
INSERT INTO `les_enseignants_formations` VALUES (23383, 23);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_entreprises`
-- 

CREATE TABLE `les_entreprises` (
  `id_entr` bigint(20) NOT NULL auto_increment,
  `nom` varchar(100) NOT NULL default '',
  `adresse` tinytext NOT NULL,
  `code_postal` int(10) unsigned NOT NULL default '0',
  `ville` varchar(100) NOT NULL default '',
  `tel_fixe1` varchar(30) NOT NULL default '0',
  `tel_fixe2` varchar(30) default NULL,
  `fax` varchar(30) default NULL,
  `email` tinytext,
  `url_site` tinytext,
  `secteur_activite` tinytext,
  `nom_contact` varchar(100) NOT NULL default '',
  `prenom_contact` varchar(100) NOT NULL default '',
  `nb_salaries` int(11) default NULL,
  `nb_apprentis` int(11) default NULL,
  PRIMARY KEY  (`id_entr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=258 ;

-- 
-- Contenu de la table `les_entreprises`
-- 

INSERT INTO `les_entreprises` VALUES (1, 'GORGUIS  Raif', '50 rue Fabre d''Eglantine\n', 53810, 'CHANGE', '02-43-58-11-99', '', '02-43-49-22-49', '', '', '', 'GORGUIS', 'Raif', 0, 0);
INSERT INTO `les_entreprises` VALUES (2, '', '75 RUE Charles de Gaulle \n ', 49770, 'LA MEMBROLLE-SUR-LONGUENEE', '', '', '', '', '', '', '', '', 507, 0);
INSERT INTO `les_entreprises` VALUES (10, 'MARIEL  Martine', '168 rue de Bretagne \n ', 53000, 'LAVAL', '02-43-69-07-81', '', '02-43-91-15-02', '', '', '', 'MARIEL', 'Martine', 6, 0);
INSERT INTO `les_entreprises` VALUES (3, 'LENORMAND  Philippe', 'ZA DU PONT DE PIERRE\n', 53240, 'ANDOUILLE', '02-43-26-16-16', '', '02-43-26-16-15', '', '', '', 'LENORMAND', 'Philippe', 19, 0);
INSERT INTO `les_entreprises` VALUES (4, 'LERAY  JEAN CHARLES', '8 RUE DU CANAL\n', 53440, 'ARON', '02-43-04-21-50', '', '02-43-04-12-61', '', '', '', 'LERAY', 'JEAN CHARLES', 1, 0);
INSERT INTO `les_entreprises` VALUES (5, 'LEMEE  MICHEL', '1 RUE LANCELIN\nZA DE MAUBUARD', 53600, 'EVRON', '02-43-01-60-92', '', '', '', '', '', 'LEMEE', 'MICHEL', 2, 0);
INSERT INTO `les_entreprises` VALUES (6, 'ROLLANT  Pierre', 'ZA Bd Pasteur\n', 53800, 'RENAZE', '02-43-09-56-56', '', '02-43-09-56-57', '', '', '', 'ROLLANT', 'Pierre', 7, 0);
INSERT INTO `les_entreprises` VALUES (7, 'CESARE  NATHALIE', '166 Rue Nationale\n', 72000, 'LE MANS', '02-43-78-00-63', '', '02-43-75-92-83', '', '', '', 'CESARE', 'NATHALIE', 4, 0);
INSERT INTO `les_entreprises` VALUES (8, 'DERRIEN  Stéphane', '14 rue du Cormier\n', 72550, 'DEGRE', '02-43-76-21-48', '', '', '', '', '', 'DERRIEN', 'Stéphane', 5, 0);
INSERT INTO `les_entreprises` VALUES (9, 'BLANCHARD', '16 ZA du grand chemin\n', 53970, 'L''HUISSERIE', '02-43-68-70-91', '', '02-43-68-72-17', '', '', '', 'BLANCHARD', '', 2, 0);
INSERT INTO `les_entreprises` VALUES (11, 'LEVEQUE  Patrick', 'Etang de la Fenderie \n ', 53150, 'DEUX EVAILLES', '02-43-90-00-95', '', '02-43-90-02-52', 'la.fenderie@wanadoo.fr', '', '', 'LEVEQUE', 'Patrick', 7, 0);
INSERT INTO `les_entreprises` VALUES (12, 'ETCHEVERRY  David', 'Impasse du Vieux Bourg \n ', 35760, 'SAINT-GREGOIRE', '02-99-68-79-35', '', '02-99-68-92-71', '', '', '', 'ETCHEVERRY', 'David', 13, 0);
INSERT INTO `les_entreprises` VALUES (13, 'VALSAINT ET ARNAUD', 'Fontaine Daniel \n ', 53100, 'SAINT-GEORGES-BUTTAVENT', '02-43-00-34-85', '', '', '', '', '', 'VALSAINT ET ARNAUD', '', 0, 0);
INSERT INTO `les_entreprises` VALUES (14, 'BLASZCZYR  Pascal', '16, Palce Albert Liebault \n ', 72350, 'BRULON', '02-43-95-60-40', '', '02-43-95-27-55', '', '', '', 'BLASZCZYR', 'Pascal', 2, 0);
INSERT INTO `les_entreprises` VALUES (15, 'GARREAU  PASCAL', '63 Grande Rue \n ', 53000, 'LAVAL', '02-43-53-29-43', '', '', '', '', '', 'GARREAU', 'PASCAL', 4, 0);
INSERT INTO `les_entreprises` VALUES (16, 'LEMERCIER  GUY', '67 rue du Val de Mayenne \n ', 53000, 'LAVAL', '02-43-56-98-29', '', '02-43-56-52-85', '', '', '', 'LEMERCIER', 'GUY', 9, 0);
INSERT INTO `les_entreprises` VALUES (17, 'TOUILLER  THIERRY', '66 rue Vaufleury \n ', 53000, 'LAVAL', '02-43-66-02-02', '', '02-43-66-13-50', '', '', '', 'TOUILLER', 'THIERRY', 5, 0);
INSERT INTO `les_entreprises` VALUES (18, 'JOUANEN  ERIC', '83 rue Victor Boissel \n ', 53000, 'LAVAL', '02-43-53-14-10', '', '02-43-49-02-84', '', '', '', 'JOUANEN', 'ERIC', 5, 0);
INSERT INTO `les_entreprises` VALUES (19, 'POSSEME  Christian', 'le Bourg \n ', 53340, 'SAULGES', '02-43-64-66-00', '', '02-43-90-56-61', '', '', '', 'POSSEME', 'Christian', 8, 0);
INSERT INTO `les_entreprises` VALUES (20, 'JAQUET  MICHELE', '16, Place Dom Guéranger \n ', 72300, 'SOLESMES', '02-43-95-45-10', '', '02-43-95-22-26', '', '', '', 'JAQUET', 'MICHELE', 18, 0);
INSERT INTO `les_entreprises` VALUES (21, 'TESTARD  FRANCIS', '23 quai Sadi Carnot \n ', 53000, 'LAVAL', '02-43-53-55-66', '', '', '', '', '', 'TESTARD', 'FRANCIS', 0, 0);
INSERT INTO `les_entreprises` VALUES (22, 'VAN MARLE  RICHARD', '2 rue A. de Loré \n ', 53100, 'MAYENNE', '02-43-00-96-00', '', '02-43-00-69-20', '', '', '', 'VAN MARLE', 'RICHARD', 8, 0);
INSERT INTO `les_entreprises` VALUES (23, 'PUZOS', '7 rue du Lieutenant \n ', 53000, 'LAVAL', '02-43-56-25-77', '', '', '', '', '', 'PUZOS', '', 3, 0);
INSERT INTO `les_entreprises` VALUES (24, 'EMERY  Bruno', 'Pendu \n ', 53200, 'ST FORT', '02-43-70-15-44', '', '02-43-07-88-67', 'l.aquarelle@tiscali.fr', '', '', 'EMERY', 'Bruno', 2, 0);
INSERT INTO `les_entreprises` VALUES (25, 'BOULAND  STEPHANIE', '18 RN \n ', 37210, 'VOUVRAY', '02-47-52-70-18', '', '', '', '', '', 'BOULAND', 'STEPHANIE', 2, 0);
INSERT INTO `les_entreprises` VALUES (26, 'OGER  SAMUEL', 'Rue du Fief des Moines \n ', 53480, 'VAIGES', '02-43-90-50-07', '', '02-43-90-57-40', '', '', '', 'OGER', 'SAMUEL', 7, 0);
INSERT INTO `les_entreprises` VALUES (27, 'PARIS ET PESCHARD', 'Route de Mayenne \n ', 53600, 'EVRON', '02-43-91-20-00', '', '02-43-91-20-10', '', '', '', 'PARIS ET PESCHARD', '', 9, 0);
INSERT INTO `les_entreprises` VALUES (28, 'PRETEUX  Jean-Marc', '4, Place de Hercé \n ', 53100, 'MAYENNE', '02-43-04-22-89', '', '', '', '', '', 'PRETEUX', 'Jean-Marc', 2, 0);
INSERT INTO `les_entreprises` VALUES (29, 'LE GALL  Sébastien', '4, Rue du Maine \n ', 53410, 'BOURGON', '02-43-37-71-79', '', '', '', '', '', 'LE GALL', 'Sébastien', 0, 0);
INSERT INTO `les_entreprises` VALUES (30, 'HUGER  JEAN-CLAUDE', '27 rue St Martin \n ', 53100, 'MAYENNE', '02-43-04-13-43', '', '02-43-04-13-43', 'jc-huger@wanadoo.fr', '', '', 'HUGER', 'JEAN-CLAUDE', 1, 0);
INSERT INTO `les_entreprises` VALUES (31, 'RAMAUGE  Sandrine', '15, Rue Thiers \n ', 53200, 'CHATEAU GONTIER', '02-43-07-22-75', '', '', '', '', '', 'RAMAUGE', 'Sandrine', 0, 0);
INSERT INTO `les_entreprises` VALUES (32, 'DERVAL  MOISE', '24 avenue de Chanzy \n ', 53000, 'LAVAL', '02-43-53-20-98', '', '02-43-49-17-82', '', '', '', 'DERVAL', 'MOISE', 5, 0);
INSERT INTO `les_entreprises` VALUES (33, 'HUCHEDE  Philippe', '13, Rue Division Leclerc \n ', 53200, 'CHATEAU-GONTIER', '02-43-07-27-07', '06-71-30-83-07', '02-43-07-27-07', '', '', '', 'HUCHEDE', 'Philippe', 2, 0);
INSERT INTO `les_entreprises` VALUES (34, 'LUCAS  MICHEL', '26 place Renault Morlière \n ', 53500, 'ERNEE', '02-43-05-12-68', '06-17-95-80-34', '', '', '', '', 'LUCAS', 'MICHEL', 1, 0);
INSERT INTO `les_entreprises` VALUES (35, 'VERDIER  JACKY', '11 rue Charles de Gaulle \n ', 53810, 'CHANGE', '02-43-53-38-57', '', '', '', '', '', 'VERDIER', 'JACKY', 0, 0);
INSERT INTO `les_entreprises` VALUES (36, 'LECHAT', 'Route de Laval \n ', 53600, 'EVRON', '02-43-01-34-82', '', '02-43-01-74-43', '', '', '', 'LECHAT', '', 80, 0);
INSERT INTO `les_entreprises` VALUES (37, 'DUGUET  JACQUES', '17 rue Charles Landelle \n ', 53000, 'LAVAL', '02-43-53-28-39', '06-73-53-06-99', '', '', '', '', 'DUGUET', 'JACQUES', 4, 0);
INSERT INTO `les_entreprises` VALUES (38, 'MESLIER  OLIVIER', '7 Rue de Paris \n ', 35500, 'VITRE', '02-99-75-33-52', '', '', '', '', '', 'MESLIER', 'OLIVIER', 0, 0);
INSERT INTO `les_entreprises` VALUES (39, 'GASSE  PHILIPPE', '2 rue de la Perrière \n ', 53600, 'EVRON', '02-43-01-60-41', '', '', '', '', '', 'GASSE', 'PHILIPPE', 0, 0);
INSERT INTO `les_entreprises` VALUES (40, 'BURNEL  Christophe', '13, Rue de Bouchevreau \n ', 53300, 'AMBRIERES-LES-VALLEES', '02-43-04-92-84', '', '', '', '', '', 'BURNEL', 'Christophe', 2, 0);
INSERT INTO `les_entreprises` VALUES (41, 'BOUVERET  Jean-Philippe', '2, Rue de la Montée \n ', 53120, 'GORRON', '02-43-08-64-81', '', '', '', '', '', 'BOUVERET', 'Jean-Philippe', 2, 0);
INSERT INTO `les_entreprises` VALUES (42, 'BERTHE  CHRISTIAN', 'Place de la Poste \n ', 53940, 'LE GENEST ST ISLE', '02-43-02-11-61', '', '', '', '', '', 'BERTHE', 'CHRISTIAN', 2, 0);
INSERT INTO `les_entreprises` VALUES (43, 'BOUILLE  Régis', '5, Rue des Déportés \n ', 53000, 'LAVAL', '02-43-53-20-29', '', '', '', '', '', 'BOUILLE', 'Régis', 2, 0);
INSERT INTO `les_entreprises` VALUES (44, 'GUIBERT  Jessie', '8, Rue des Forges \n ', 53410, 'PORT BRILLET', '02-43-68-83-71', '', '', '', '', '', 'GUIBERT', 'Jessie', 1, 0);
INSERT INTO `les_entreprises` VALUES (45, 'BRILHAULT  CHRISTIAN', '6, Rue Amiral Courbet \n ', 53500, 'ERNEE', '02-43-05-23-37', '', '', '', '', '', 'BRILHAULT', 'CHRISTIAN', 3, 0);
INSERT INTO `les_entreprises` VALUES (46, 'SERGENT  JEAN-NOEL', '6 bld Victor Hugo \n ', 53200, 'CHATEAU GONTIER', '02-43-70-46-29', '', '', '', '', '', 'SERGENT', 'JEAN-NOEL', 8, 0);
INSERT INTO `les_entreprises` VALUES (47, 'HEINRY  MICHEL', '10 rue de la Libération \n ', 53400, 'CRAON', '02-43-06-29-08', '', '', '', '', '', 'HEINRY', 'MICHEL', 4, 0);
INSERT INTO `les_entreprises` VALUES (48, 'BOITTIN  ALAIN', '7 place Crottigné \n ', 53150, 'MONTSURS', '02-43-01-02-90', '', '', '', '', '', 'BOITTIN', 'ALAIN', 3, 0);
INSERT INTO `les_entreprises` VALUES (49, 'RIBOT  Hervé', '6, Rue Echelle Marteau \n ', 53000, 'LAVAL', '02-43-53-15-85', '', '', '', '', '', 'RIBOT', 'Hervé', 2, 0);
INSERT INTO `les_entreprises` VALUES (50, 'RENOUARD  Sébastien', '7, Place Jean Buchet \n ', 53800, 'LA SELLE-CRAONNAISE', '02-43-06-17-68', '06-80-81-02-71', '', '', '', '', 'RENOUARD', 'Sébastien', 0, 0);
INSERT INTO `les_entreprises` VALUES (51, 'CHEVY  BERTRAND', '64 rue de Rennes \n ', 53000, 'LAVAL', '02-43-68-26-34', '', '', '', '', '', 'CHEVY', 'BERTRAND', 4, 0);
INSERT INTO `les_entreprises` VALUES (52, 'MEZIERE  PHILIPPE', '4 rue Relais des Diligences \n ', 53390, 'ST AIGNAN S/ROE', '02-43-06-51-22', '', '', '', '', '', 'MEZIERE', 'PHILIPPE', 4, 0);
INSERT INTO `les_entreprises` VALUES (53, 'HUBERT  Yohann', '34, Rue du Coq Hardi \n ', 72140, 'SILLE-LE-GUILLAUME', '02-43-20-17-15', '', '', '', '', '', 'HUBERT', 'Yohann', 1, 0);
INSERT INTO `les_entreprises` VALUES (54, 'GRIMAULT  Patrick', 'CENTRE COMMERCIAL MURAT \n ', 53000, 'LAVAL', '02-43-49-19-18', '', '', '', '', '', 'GRIMAULT', 'Patrick', 1, 0);
INSERT INTO `les_entreprises` VALUES (55, 'GUY  PATRICE', '2 rue de la Fontaine \n ', 53600, 'EVRON', '02-43-01-61-38', '', '', '', '', '', 'GUY', 'PATRICE', 1, 0);
INSERT INTO `les_entreprises` VALUES (56, 'BARDIN  Philippe', '11 rue Victor Foucault \n ', 53800, 'RENAZE', '02-43-06-41-04', '', '', '', '', '', 'BARDIN', 'Philippe', 2, 0);
INSERT INTO `les_entreprises` VALUES (57, 'NEAU  JEAN-PATRICK', '11, Place du Pilori \n ', 53600, 'EVRON', '02-43-01-91-93', '06-77-01-70-29', '', '', '', '', 'NEAU', 'JEAN-PATRICK', 3, 0);
INSERT INTO `les_entreprises` VALUES (58, 'CLAVREUL  BERTRAND', '1 RUE DE LA GARE \n ', 53150, 'MONTSURS', '02-43-01-00-38', '', '', '', '', '', 'CLAVREUL', 'BERTRAND', 3, 0);
INSERT INTO `les_entreprises` VALUES (59, 'ROBINET  BRUNO', '42 rue de la Perrière \n ', 53600, 'EVRON', '02-43-01-62-43', '', '', '', '', '', 'ROBINET', 'BRUNO', 2, 0);
INSERT INTO `les_entreprises` VALUES (60, 'FOUQUET  JEAN-CHRISTOPHE', '117-119, rue de Bretagne \n ', 53000, 'LAVAL', '02-43-69-55-05', '', '', '', '', '', 'FOUQUET', 'JEAN-CHRISTOPHE', 1, 0);
INSERT INTO `les_entreprises` VALUES (61, 'GIRAULT  STEPHANE', '114, Rue Victor Boissel \n ', 53000, 'LAVAL', '02-43-53-28-26', '', '', '', '', '', 'GIRAULT', 'STEPHANE', 0, 0);
INSERT INTO `les_entreprises` VALUES (62, 'CHAPIN  JEAN-MARIE', 'Le Domaine du Bas Mont \n ', 53100, 'MOULAY', '02-43-00-48-42', '', '02-43-08-10-58', 'lamarjolaine@wanadoo.fr', '', '', 'CHAPIN', 'JEAN-MARIE', 10, 0);
INSERT INTO `les_entreprises` VALUES (63, 'GAIGNE  Jean Jacques', '7 route de Tours \n ', 53260, 'FORCE', '02-43-53-64-47', '', '', '', '', '', 'GAIGNE', 'Jean Jacques', 0, 0);
INSERT INTO `les_entreprises` VALUES (64, 'GOUGEON  LAURENT', '110 GRANDE RUE \n ', 53200, 'CHATEAU-GONTIER', '02-43-07-82-01', '', '', '', '', '', 'GOUGEON', 'LAURENT', 3, 0);
INSERT INTO `les_entreprises` VALUES (65, 'LAIGRE  CHRISTIAN', '60 Route de Nantes \n ', 53230, 'COSSE LE VIVIEN', '02-43-98-85-48', '', '', '', '', '', 'LAIGRE', 'CHRISTIAN', 3, 0);
INSERT INTO `les_entreprises` VALUES (66, 'MICHEL  Sylvain', '4, Rue de Bretagne \n ', 53410, 'SAINT-PIERRE-LA-COUR', '02-43-01-85-48', '', '', '', '', '', 'MICHEL', 'Sylvain', 1, 0);
INSERT INTO `les_entreprises` VALUES (67, 'PARIS  JEAN-PIERRE', '113, Rue du Pont de Mayenne \n ', 53000, 'LAVAL', '02-43-53-39-55', '', '', '', '', '', 'PARIS', 'JEAN-PIERRE', 0, 0);
INSERT INTO `les_entreprises` VALUES (68, 'ROBILLARD  JOEL', '13 Rue Centrale \n ', 53940, 'AHUILLE', '02-43-68-93-29', '', '', '', '', '', 'ROBILLARD', 'JOEL', 1, 0);
INSERT INTO `les_entreprises` VALUES (69, 'ROUMEGOUS  GEORGES', '17, Rue de Normandie \n ', 53440, 'ARON', '02-43-32-14-00', '', '02-43-04-56-39', '', '', '', 'ROUMEGOUS', 'GEORGES', 4, 0);
INSERT INTO `les_entreprises` VALUES (70, 'GUITTET  Thérèse', '1, Carrefour du Centre \n ', 53170, 'MESLAY DU MAINE', '02-43-98-41-33', '', '02-43-98-71-05', '', '', '', 'GUITTET', 'Thérèse', 5, 0);
INSERT INTO `les_entreprises` VALUES (71, 'COIFFIER  Catherine', ' \n ', 53700, 'VILLAINES-LA-JUHEL', '02-43-03-21-64', '', '', '', '', '', 'COIFFIER', 'Catherine', 0, 0);
INSERT INTO `les_entreprises` VALUES (72, 'HUBERT  Françoise', 'Place du Marché \n ', 61350, 'PASSAIS', '02-33-38-71-22', '02-33-38-59-53', '', '', '', '', 'HUBERT', 'Françoise', 3, 0);
INSERT INTO `les_entreprises` VALUES (73, 'GEFFRAY  Anne', '37, Rue Aristide Briand \n ', 44110, 'CHATEAUBRIANT', '02-40-81-00-34', '', '02-40-81-09-98', '', '', '', 'GEFFRAY', 'Anne', 7, 0);
INSERT INTO `les_entreprises` VALUES (74, 'HERVE  FRANCOIS', '3 rue des Forges \n ', 53410, 'PORT BRILLET', '02-43-68-83-56', '', '02-43-68-86-42', '', '', '', 'HERVE', 'FRANCOIS', 5, 0);
INSERT INTO `les_entreprises` VALUES (75, 'SIMON  PHILIPPE', '1 rue des Sports \n ', 53940, 'AHUILLE', '02-43-68-92-68', '', '02-43-68-96-50', '', '', '', 'SIMON', 'PHILIPPE', 1, 0);
INSERT INTO `les_entreprises` VALUES (76, 'RANDRIANALIMANANA  Lalao', '1, Place de la Porte \n ', 35150, 'PIRE-SUR-SEICHE', '02-99-44-21-13', '', '', '', '', '', 'RANDRIANALIMANANA', 'Lalao', 2, 0);
INSERT INTO `les_entreprises` VALUES (77, 'LE LAY  VERONIQUE', '2, rue du Docteur Roux \n ', 53000, 'LAVAL', '02-43-68-02-57', '', '02-43-68-67-17', '', '', '', 'LE LAY', 'VERONIQUE', 3, 0);
INSERT INTO `les_entreprises` VALUES (78, 'DESJOBERT  Jacques', '9, Rue Thiers \n ', 53200, 'CHATEAU-GONTIER', '02-43-07-21-83', '', '02-43-07-37-98', '', '', '', 'DESJOBERT', 'Jacques', 3, 0);
INSERT INTO `les_entreprises` VALUES (79, 'BESNIER  Nicole', '3, Rue du Maine \n ', 53960, 'BONCHAMP-LES-LAVAL', '02-43-90-36-72', '', '02-43-90-92-90', '', '', '', 'BESNIER', 'Nicole', 1, 0);
INSERT INTO `les_entreprises` VALUES (80, 'PEPIN ET HEUZE', '7 B, Rue Saint-Aventin \n ', 53200, 'AZE', '02-43-07-29-61', '', '02-43-07-46-12', '', '', '', 'PEPIN ET HEUZE', '', 14, 0);
INSERT INTO `les_entreprises` VALUES (81, 'HUBERT DE FRAISSE  François', '4 place du Pilori \n ', 53200, 'CHATEAU GONTIER', '02-43-07-12-39', '', '02-43-07-66-30', '', '', '', 'HUBERT DE FRAISSE', 'François', 4, 0);
INSERT INTO `les_entreprises` VALUES (82, 'LOXQ  Christine', '67 avenue Robert Buron \n ', 53000, 'LAVAL', '02-43-53-60-98', '', '02-43-53-45-65', '', '', '', 'LOXQ', 'Christine', 7, 0);
INSERT INTO `les_entreprises` VALUES (83, 'RAIMBAULT  Marie-Pascale', '42 avenue du Maréchal Joffre \n ', 53200, 'CHATEAU GONTIER', '02-43-70-44-76', '', '02-43-07-98-10', '', '', '', 'RAIMBAULT', 'Marie-Pascale', 3, 0);
INSERT INTO `les_entreprises` VALUES (84, 'SORIEUX  LOUIS', '15 Place du Marché \n ', 53230, 'COSSE LE VIVIEN', '02-43-98-80-07', '', '', '', '', '', 'SORIEUX', 'LOUIS', 4, 0);
INSERT INTO `les_entreprises` VALUES (85, 'DEUIL  CATHERINE', '6 Place du Marché \n ', 53170, 'MESLAY DU MAINE', '02-43-98-40-15', '', '02-43-64-23-93', '', '', '', 'DEUIL', 'CATHERINE', 5, 0);
INSERT INTO `les_entreprises` VALUES (86, 'GOURET  Nathalie', '13, Rue du Maine \n ', 53240, 'ANDOUILLE', '02-43-69-74-07', '', '', '', '', '', 'GOURET', 'Nathalie', 1, 0);
INSERT INTO `les_entreprises` VALUES (87, 'CARPENTIER  Françoise', 'Place Saint Martin \n ', 53950, 'LOUVERNE', '02-43-01-10-67', '', '02-43-37-81-12', '', '', '', 'CARPENTIER', 'Françoise', 4, 0);
INSERT INTO `les_entreprises` VALUES (88, 'PINCON  ERIC', '15, 17 Rue du Gal de Gaulle \n ', 53810, 'CHANGE', '02-43-53-57-97', '', '02-43-56-05-29', '', '', '', 'PINCON', 'ERIC', 2, 0);
INSERT INTO `les_entreprises` VALUES (89, 'POINCET  GUILLEMOT', '58 Avenue de la Division Leclerc \n ', 53200, 'CHATEAU GONTIER', '02-43-07-17-82', '', '02-43-70-13-50', '', '', '', 'POINCET', 'GUILLEMOT', 7, 0);
INSERT INTO `les_entreprises` VALUES (90, 'JACOVIAC  CHRISTIAN', '20, rue de Nantes \n ', 53230, 'COSSE LE VIVIEN', '02-43-98-90-80', '', '02-43-91-79-16', '', '', '', 'JACOVIAC', 'CHRISTIAN', 0, 0);
INSERT INTO `les_entreprises` VALUES (91, 'RABILLOUD-CHEVALIER', '2 Impasse des Ecoles \n ', 53290, 'GREZ EN BOUERE', '02-43-70-50-08', '', '02-43-70-64-78', '', '', '', 'RABILLOUD-CHEVALIER', '', 3, 0);
INSERT INTO `les_entreprises` VALUES (92, 'ROULLAND', 'Route de Mayenne \n ', 53100, 'MOULAY', '02-43-00-44-66', '', '02-43-00-44-66', '', '', '', 'ROULLAND', '', 0, 0);
INSERT INTO `les_entreprises` VALUES (93, 'PIETRERA  LUCETTE', '52 Grande Rue \n ', 53400, 'CRAON', '02-43-06-11-72', '', '02-43-06-06-09', '', '', '', 'PIETRERA', 'LUCETTE', 3, 0);
INSERT INTO `les_entreprises` VALUES (94, 'COIFFIER  JEAN-PIERRE', '17 rue St Nicolas \n ', 53700, 'VILLAINES LA JUHEL', '02-43-03-20-89', '', '02-43-04-94-58', '', '', '', 'COIFFIER', 'JEAN-PIERRE', 7, 0);
INSERT INTO `les_entreprises` VALUES (95, 'LEYRAT  OLIVIER', '10 rue Neuve \n ', 53400, 'CRAON', '02-43-06-13-77', '', '02-43-06-25-98', '', '', '', 'LEYRAT', 'OLIVIER', 5, 0);
INSERT INTO `les_entreprises` VALUES (96, 'BARDOU  JACQUELINE', '47 avenue de la Libération \n ', 53940, 'ST BERTHEVIN', '02-43-69-01-78', '', '02-43-26-22-58', '', '', '', 'BARDOU', 'JACQUELINE', 0, 0);
INSERT INTO `les_entreprises` VALUES (97, 'BARACH  Joseph', '10, Place République \n ', 49500, 'SEGRE', '02-41-92-23-08', '', '02-41-92-87-30', '', '', '', 'BARACH', 'Joseph', 4, 0);
INSERT INTO `les_entreprises` VALUES (98, 'AUBRY TRUCHOT', '11 rue du Général de Gaulle \n ', 53000, 'LAVAL', '02-43-53-21-37', '', '02-43-53-73-45', '', '', '', 'AUBRY TRUCHOT', '', 4, 0);
INSERT INTO `les_entreprises` VALUES (99, 'BRETON BOUTIER QUEMENEUR', '4 PLACE DE LA TREMOILLE \n ', 53000, 'LAVAL', '02-43-53-54-40', '', '02-43-53-21-90', '', '', '', 'BRETON BOUTIER QUEMENEUR', '', 9, 0);
INSERT INTO `les_entreprises` VALUES (100, 'LESUEUR  SONIA', '21 rue Aristide Briand \n ', 53100, 'MAYENNE', '02-43-04-10-96', '', '02-43-32-17-08', '', '', '', 'LESUEUR', 'SONIA', 4, 0);
INSERT INTO `les_entreprises` VALUES (101, 'KRETZ', '29 rue de la Paix \n ', 53000, 'LAVAL', '02-43-67-08-76', '', '02-43-53-26-23', '', '', '', 'KRETZ', '', 0, 0);
INSERT INTO `les_entreprises` VALUES (102, 'POULIQUEN  BESSON BOUZIANE', '11 PLACE JEAN MOULIN \n ', 53000, 'LAVAL', '02-43-53-76-92', '', '02-43-53-96-05', '', '', '', 'POULIQUEN  BESSON BOUZIANE', '', 4, 0);
INSERT INTO `les_entreprises` VALUES (103, 'BOUDAUD', 'SNC BOUDAUD \n ', 53000, 'LAVAL', '02-43-69-00-03', '', '02-43-66-13-58', '', '', '', 'BOUDAUD', '', 9, 0);
INSERT INTO `les_entreprises` VALUES (104, 'GUILMAULT', '643 Avenue Gutenberg \n ', 53100, 'MAYENNE', '02-43-30-44-44', '', '02-43-04-57-83', '', '', '', 'GUILMAULT', '', 46, 0);
INSERT INTO `les_entreprises` VALUES (105, 'MARION', '66 Avenue de Paris \n ', 53940, 'ST BERTHEVIN', '02-43-01-24-24', '', '02-43-01-24-29', '', '', '', 'MARION', '', 45, 0);
INSERT INTO `les_entreprises` VALUES (106, 'CRONIER  MICKAEL', 'ZI SUD \n ', 53960, 'BONCHAMP-LES-LAVAL', '02-43-56-61-61', '02-43-49-14-88', '', '', '', '', 'CRONIER', 'MICKAEL', 0, 0);
INSERT INTO `les_entreprises` VALUES (107, 'FOURNIER  DIDIER', 'Route de Laval  LD La Hainaud \n ', 53500, 'ERNEE', '02-43-05-23-71', '', '', '', '', '', 'FOURNIER', 'DIDIER', 6, 0);
INSERT INTO `les_entreprises` VALUES (108, 'POISSON', 'ZA rue de la Forge \n ', 53800, 'RENAZE', '02-43-06-73-68', '', '02-43-06-71-67', '', '', '', 'POISSON', '', 6, 0);
INSERT INTO `les_entreprises` VALUES (109, 'ANNE', 'ROUTE DE MAYENNE \n ', 53300, 'AMBRIERES-LES-VALLEES', '02-43-04-91-04', '', '', '', '', '', 'ANNE', '', 0, 0);
INSERT INTO `les_entreprises` VALUES (110, 'BEDOUET  Yvan', '515 rue de la peyenniere \n ', 53100, 'MAYENNE', '02-43-04-18-25', '', '02-43-00-74-77', 'garage.bedouet.mayenne@wanadoo.fr', '', '', 'BEDOUET', 'Yvan', 3, 0);
INSERT INTO `les_entreprises` VALUES (111, 'CIRON', 'ZAC des Morandières \n ', 53810, 'CHANGE', '02-43-59-73-00', '', '02-43-53-43-02', '', '', '', 'CIRON', '', 11, 0);
INSERT INTO `les_entreprises` VALUES (112, 'CLAIRAY  JOEL', '14, Rue Jean Baptiste Lafosse \n ', 53000, 'LAVAL', '02-43-49-17-55', '', '02-43-49-02-29', '', '', '', 'CLAIRAY', 'JOEL', 41, 0);
INSERT INTO `les_entreprises` VALUES (113, 'MARCHAND', 'ZI la chalopinière \n ', 53170, 'MESLAY DU MAINE', '02-43-98-41-07', '', '02-43-64-20-03', '', '', '', 'MARCHAND', '', 21, 0);
INSERT INTO `les_entreprises` VALUES (114, 'LHERMELIN  Alain', 'ZA RUE DES BORDAGERS \n ', 53810, 'CHANGE', '02-43-56-25-11', '', '02-43-53-95-73', '', '', '', 'LHERMELIN', 'Alain', 4, 0);
INSERT INTO `les_entreprises` VALUES (115, 'DANVEAU  THIERRY', 'LD SANS SOUCI \n ', 53300, 'SAINT-FRAIMBAULT-DE-PRIERES', '02-43-00-87-21', '', '', '', '', '', 'DANVEAU', 'THIERRY', 2, 0);
INSERT INTO `les_entreprises` VALUES (116, 'WEIBEL  BERNARD', '4 route du Mans \n ', 53960, 'BONCHAMP-LES-LAVAL', '02-43-90-96-53', '', '', '', '', '', 'WEIBEL', 'BERNARD', 0, 0);
INSERT INTO `les_entreprises` VALUES (117, 'FEURPRIER  Alain', '8 RUE BOSNIEUL \n ', 53370, 'ST PIERRE DES NIDS', '02-43-03-50-71', '', '02-43-03-63-40', '', '', '', 'FEURPRIER', 'Alain', 0, 0);
INSERT INTO `les_entreprises` VALUES (128, 'LE BOUCHER  Alain', '67 avenue de la Verrerie \n ', 35300, 'FOUGERES', '02-99-99-83-00', '', '', '', '', '', 'LE BOUCHER', 'Alain', 6, 0);
INSERT INTO `les_entreprises` VALUES (118, 'BARADA  Patrice', '35 Avenue des sablonnieres \n ', 53200, 'SAINT-FORT', '02-43-07-23-90', '', '', '', '', '', 'BARADA', 'Patrice', 0, 0);
INSERT INTO `les_entreprises` VALUES (119, 'PAILLARD  DIDIER', '5 route de laval \n ', 53390, 'ST AIGNAN S/ROE', '02-43-06-51-35', '', '02-43-06-92-72', '', '', '', 'PAILLARD', 'DIDIER', 0, 0);
INSERT INTO `les_entreprises` VALUES (120, 'CHAPLAIN  Marcel', 'LES BOUILLONS \n ', 53140, 'LA PALLU', '02-43-03-87-18', '', '02-43-03-88-52', '', '', '', 'CHAPLAIN', 'Marcel', 5, 0);
INSERT INTO `les_entreprises` VALUES (121, 'LEFEBVRE', '35 bd Clément Ader \n ', 53020, 'LAVAL CEDEX 9', '02-43-53-11-73', '', '02-43-49-20-70', '', '', '', 'LEFEBVRE', '', 13, 0);
INSERT INTO `les_entreprises` VALUES (122, 'PELE', 'ZA DES MORANDIERES \n ', 53000, 'LAVAL', '02-43-59-21-59', '', '', '', '', '', 'PELE', '', 0, 0);
INSERT INTO `les_entreprises` VALUES (123, 'BODIN', 'Bd Maréchal Leclerc \n ', 53600, 'EVRON', '02-43-01-63-26', '', '02-43-37-28-56', '', '', '', 'BODIN', '', 5, 0);
INSERT INTO `les_entreprises` VALUES (124, 'NEVEU', '15 AVENUE RENE CASSIN \n ', 53200, 'AZE', '02-43-70-33-90', '', '02-43-07-35-72', '', '', '', 'NEVEU', '', 1, 0);
INSERT INTO `les_entreprises` VALUES (125, 'BOUFFORT', '9 RUE DU MAINE \n ', 53190, 'FOUGEROLLES-DU-PLESSIS', '02-43-05-58-87', '', '', '', '', '', 'BOUFFORT', '', 0, 0);
INSERT INTO `les_entreprises` VALUES (126, 'ROUSSEAU', 'ZI des nochetieres \n ', 53600, 'EVRON', '02-43-01-36-74', '', '02-43-37-28-32', '', '', '', 'ROUSSEAU', '', 14, 0);
INSERT INTO `les_entreprises` VALUES (127, 'PARIS', 'LA COUR CHALMEL \n ', 61600, 'MAGNY-LE-DESERT', '02-33-37-72-45', '', '02-33-37-75-65', '', '', '', 'PARIS', '', 0, 0);
INSERT INTO `les_entreprises` VALUES (129, 'HOCDE  Benoit', 'Les trois Carrières \n ', 53260, 'ENTRAMMES', '02-43-98-32-18', '06-22-48-30-42', '02-43-98-32-18', 'benoit.hocde@wanadoo.fr', '', '', 'HOCDE', 'Benoit', 0, 0);
INSERT INTO `les_entreprises` VALUES (130, 'BARRE  JEAN BAPTISTE', '10 rue Réaumur \n ', 53100, 'MAYENNE', '02-43-04-44-31', '', '02-43-04-51-90', '', '', '', 'BARRE', 'JEAN BAPTISTE', 7, 0);
INSERT INTO `les_entreprises` VALUES (131, 'MURY  LOIC', 'ZA de la Hainaud \n ', 53500, 'ERNEE', '02-43-05-83-73', '06-24-24-13-20', '02-43-05-28-36', 'sarlmury@wanadoo.fr', '', '', 'MURY', 'LOIC', 6, 0);
INSERT INTO `les_entreprises` VALUES (132, 'GELU  Mickaël', '11, rue Letort \n ', 53390, 'ST AIGNAN S/ROE', '02-43-06-51-68', '', '', '', '', '', 'GELU', 'Mickaël', 2, 0);
INSERT INTO `les_entreprises` VALUES (133, 'MARIN  Marc', 'TIVOLI route de Laval \n ', 53810, 'CHANGE', '02-43-59-72-72', '', '02-43-56-40-59', '', '', '', 'MARIN', 'Marc', 40, 0);
INSERT INTO `les_entreprises` VALUES (134, 'METAYER  Arsène', 'Le Bas Mesnil \n ', 35240, 'MARCILLE-ROBERT', '02-99-43-58-28', '', '02-99-43-58-28', '', '', '', 'METAYER', 'Arsène', 2, 0);
INSERT INTO `les_entreprises` VALUES (135, 'COTTEVERTE  Stéphane', '60 rue de la Gare \n ', 53400, 'CRAON', '02-43-07-83-06', '06-09-77-54-45', '02-43-06-38-23', '', '', '', 'COTTEVERTE', 'Stéphane', 5, 0);
INSERT INTO `les_entreprises` VALUES (136, 'LEBRANCHU  DANIEL', '1147 rue de la Peyennière \n ', 53100, 'MAYENNE', '02-43-00-42-41', '', '02-43-00-41-24', '', '', '', 'LEBRANCHU', 'DANIEL', 12, 0);
INSERT INTO `les_entreprises` VALUES (137, 'THIRION  JEANNETTE', '16 route de Laval \n ', 53200, 'AZE', '02-43-07-16-26', '', '02-43-70-14-39', '', '', '', 'THIRION', 'JEANNETTE', 5, 0);
INSERT INTO `les_entreprises` VALUES (138, 'HUCHEDE  PATRICK', '10 Rue R Gleton \n ', 53480, 'VAIGES', '02-43-90-21-91', '', '', '', '', '', 'HUCHEDE', 'PATRICK', 1, 0);
INSERT INTO `les_entreprises` VALUES (139, 'PINCON  Jean Louis', '41, Rue de Saint Denis \n ', 53500, 'ERNEE', '02-43-05-10-07', '', '02-43-05-07-30', '', '', '', 'PINCON', 'Jean Louis', 8, 0);
INSERT INTO `les_entreprises` VALUES (140, 'MARCHAND  Gérard', '43 rue du Bourny', 53003, 'LAVAL CEDEX', '02-43-68-16-16', '', '02-43-68-59-50', '', '', '', 'MARCHAND', 'Gérard', 46, 0);
INSERT INTO `les_entreprises` VALUES (141, 'FOUILLEUL  Joël', 'Rue du Trianon \n ', 53410, 'LE BOURGNEUF LA FORET', '02-43-37-10-03', '06-03-13-26-01', '02-43-37-10-03', '', '', '', 'FOUILLEUL', 'Joël', 3, 0);
INSERT INTO `les_entreprises` VALUES (142, 'DAVOUST  MARCEL', 'Le Bourg \n ', 53270, 'CHAMMES', '02-43-01-44-17', '06-25-16-13-65', '02-43-01-47-94', '', '', '', 'DAVOUST', 'MARCEL', 4, 0);
INSERT INTO `les_entreprises` VALUES (143, 'RENARD  Philippe', 'ZI La Carie \n ', 53210, 'ARGENTRE', '02-43-37-82-26', '06-80-07-79-25', '02-43-37-82-50', '', '', '', 'RENARD', 'Philippe', 7, 0);
INSERT INTO `les_entreprises` VALUES (144, 'FRETIGNE  AUGUSTE', 'ZA DES DAHINIERES \n ', 53810, 'CHANGE', '02-43-69-60-36', '', '02-43-68-77-35', '', '', '', 'FRETIGNE', 'AUGUSTE', 45, 0);
INSERT INTO `les_entreprises` VALUES (145, 'DESMAIRES  PATRICK', 'Route de Fougères \n ', 53120, 'LEVARE', '02-43-08-49-61', '', '', '', '', '', 'DESMAIRES', 'PATRICK', 2, 0);
INSERT INTO `les_entreprises` VALUES (146, 'DOUDARD  Didier Et Xavier', '28 quai Carnot \n ', 53100, 'MAYENNE', '02-43-00-97-62', '06-67-35-03-58', '02-43-00-97-62', '', '', '', 'DOUDARD', 'Didier Et Xavier', 0, 0);
INSERT INTO `les_entreprises` VALUES (147, 'PLARD  BERNARD', 'Route de Sablé \n ', 53290, 'GREZ EN BOUERE', '02-43-70-62-06', '', '02-43-70-61-67', '', '', '', 'PLARD', 'BERNARD', 3, 0);
INSERT INTO `les_entreprises` VALUES (148, 'BLIN  Michel', 'Les Maisons Neuves \n ', 53410, 'BOURGON', '02-43-01-83-85', '', '', '', '', '', 'BLIN', 'Michel', 0, 0);
INSERT INTO `les_entreprises` VALUES (149, 'DEBRUYNE', '2 CA DU LANDREAU \n ', 49070, 'BEAUCOUZE', '02-41-73-23-73', '', '02-41-79-29-00', '', '', '', 'DEBRUYNE', '', 7, 0);
INSERT INTO `les_entreprises` VALUES (150, 'BRISEMONTIER', 'ZI LA VIOLETTE    BP 72 \n ', 49240, 'AVRILLE', '02-41-69-27-93', '', '02-41-69-67-97', '', '', '', 'BRISEMONTIER', '', 9, 0);
INSERT INTO `les_entreprises` VALUES (151, 'COPPENS', '8 Route de Sablé \n ', 53200, 'CHATEAU GONTIER', '02-43-09-12-12', '', '02-43-09-12-18', '', '', '', 'COPPENS', '', 54, 0);
INSERT INTO `les_entreprises` VALUES (152, 'GUYON  Dominique', 'ZA DE LA CHAMBROUILLERE \n ', 53960, 'BONCHAMP LES LAVAL', '02-43-53-02-30', '06-85-90-62-59', '02-43-53-36-90', '', '', '', 'GUYON', 'Dominique', 19, 0);
INSERT INTO `les_entreprises` VALUES (153, 'BOUCARD', '15 rue de la Gibaudière \n ', 49124, 'SAINT-BARTHELEMY-D ANJOU', '02-41-43-96-96', '', '02-41-43-94-33', '', '', '', 'BOUCARD', '', 40, 0);
INSERT INTO `les_entreprises` VALUES (154, 'LOISEAU  Olivier', 'ZI de Pierre Brune \n ', 85110, 'CHANTONNAY', '02-51-48-54-54', '', '02-51-94-81-61', '', '', '', 'LOISEAU', 'Olivier', 31, 0);
INSERT INTO `les_entreprises` VALUES (155, 'DABIN', '1 rue du Pont - BP 53 \n ', 72300, 'SABLE SUR SARTHE', '02-43-95-10-65', '', '02-43-92-27-07', '', '', '', 'DABIN', '', 16, 0);
INSERT INTO `les_entreprises` VALUES (156, 'LAUNAY  PASCAL', 'LE HAUT BOURG \n ', 53940, 'LE GENEST ST ISLE', '02-43-26-24-70', '06-20-69-81-40', '02-43-01-16-58', '', '', '', 'LAUNAY', 'PASCAL', 0, 0);
INSERT INTO `les_entreprises` VALUES (157, 'DAVID', '5 Rue de la Gibaudière \n ', 49124, 'SAINT-BARTHELEMY-D ANJOU', '02-41-60-02-00', '', '02-41-27-00-50', '', '', '', 'DAVID', '', 24, 0);
INSERT INTO `les_entreprises` VALUES (158, 'GITEAU  Jacky', 'ZA DE LA CHALOPINIERE \n ', 53170, 'MESLAY DU MAINE', '02-43-98-74-12', '', '02-43-98-10-60', '', '', '', 'GITEAU', 'Jacky', 24, 0);
INSERT INTO `les_entreprises` VALUES (160, 'JOLIFF Robert', '63 Rue ROMAIN DESFOSSES \n ', 29200, 'BREST', '02-98-41-01-01', '', '02-98-41-01-02', '', '', '', 'LAMOUR', 'Dominique', 5, 0);
INSERT INTO `les_entreprises` VALUES (161, 'PRUNIER STEPHANE', 'ZA AMBROISE PARE \n ', 53500, 'ERNEE', '02-43-05-83-92', '', '02-43-05-75-09', '', '', '', 'PRUNIER', 'Isabelle', 4, 0);
INSERT INTO `les_entreprises` VALUES (162, 'HACHET REMY', '5 rue Marcelin Berthelot \n ', 53012, 'LAVAL CEDEX', '02-43-53-52-53', '', '02-43-49-58-69', '', '', '', 'DEBAS', 'Alain', 61, 0);
INSERT INTO `les_entreprises` VALUES (163, 'GITEAU Jacky', 'ZI DU FRESNE \n ', 53170, 'MESLAY-DU-MAINE', '02-43-98-74-12', '', '02-43-98-10-60', '', '', '', 'GITEAU', 'JACKY', 25, 0);
INSERT INTO `les_entreprises` VALUES (164, 'TOUILLER Thierry', '66, Rue Vaufleury \n ', 53000, 'LAVAL', '02-43-66-02-02', '', '02-43-66-13-50', '', '', '', 'TOUILLER', 'THIERRY', 5, 0);
INSERT INTO `les_entreprises` VALUES (165, 'LEMERCIER Guy', '67, Rue du Val de Mayenne \n ', 53000, 'LAVAL', '02-43-56-98-29', '', '02-43-56-52-85', 'bistro.paris@wanadoo.fr', '', '', 'LEMERCIER', 'GUY', 9, 0);
INSERT INTO `les_entreprises` VALUES (166, 'LAUNAY Sébastien', 'Le Domaine du Bas Mont \n ', 53100, 'MOULAY', '02-43-00-48-42', '', '02-43-08-10-58', 'lamarjolaine@wanadoo.fr', '', '', 'CHAPIN', 'JEAN-MARIE', 11, 0);
INSERT INTO `les_entreprises` VALUES (167, 'LEBRETON Jérôme', '7, Rue des Béliers \n ', 53000, 'LAVAL', '02-43-53-66-76', '', '02-43-56-92-18', '', '', '', 'LEBRETON', 'Jérôme', 2, 0);
INSERT INTO `les_entreprises` VALUES (168, 'LEVEQUE Patrick', 'Etang de la Fenderie \n ', 53150, 'DEUX EVAILLES', '02-43-90-00-95', '', '02-43-90-02-52', 'la.fenderie@wanadoo.fr', '', '', 'LEVEQUE', 'Patrick', 7, 0);
INSERT INTO `les_entreprises` VALUES (169, 'TESTARD Francis', '23, Quai Sadi Carnot \n ', 53000, 'LAVAL', '02-43-53-55-66', '', '', '', '', '', 'TESTARD', 'FRANCIS', 0, 0);
INSERT INTO `les_entreprises` VALUES (170, 'CHAPIN Jean-Marie', 'Le Domaine du Bas Mont \n ', 53100, 'MOULAY', '02-43-00-48-42', '', '02-43-08-10-58', 'lamarjolaine@wanadoo.fr', '', '', 'CHAPIN', 'JEAN-MARIE', 11, 0);
INSERT INTO `les_entreprises` VALUES (171, 'DALENS Christophe', '12, Rue Baudrairie \n ', 35500, 'VITRE', '02-99-75-11-09', '', '02-99-75-82-97', '', '', '', 'DALENS', 'Christophe', 2, 0);
INSERT INTO `les_entreprises` VALUES (172, 'QUILLET Patrick', '2 route de Tours \n ', 53260, 'FORCE', '02-43-53-29-96', '', '02-43-49-35-22', '8', '', '', 'QUILLET', 'Patrick', 1, 0);
INSERT INTO `les_entreprises` VALUES (173, 'RICOU Yannick', '99-101, Avenue Robert Buron \n ', 53000, 'LAVAL', '02-43-53-11-00', '', '', '', '', '', 'RICOU', 'YANNICK', 4, 0);
INSERT INTO `les_entreprises` VALUES (174, 'BOUTTIER Vincent', '71, Avenue de Paris \n ', 53940, 'ST BERTHEVIN', '02-43-69-92-24', '06-10-23-44-28', '02-43-91-13-79', '', '', '', 'BOUTTIER', 'Vincent', 0, 0);
INSERT INTO `les_entreprises` VALUES (175, 'HOUSSAY Nicolas', 'Place Christian d''Elva \n ', 53810, 'CHANGE', '02-43-53-43-33', '', '02-43-49-05-60', '', '', '', 'HOUSSAY', 'Véronique', 3, 0);
INSERT INTO `les_entreprises` VALUES (176, 'PINHEIRO Frédéric', 'Route d''Olivet \n ', 53940, 'LE GENEST ST ISLE', '02-43-37-14-37', '', '03-43-37-70-48', '', '', '', 'BERTIN', 'Sophie', 0, 0);
INSERT INTO `les_entreprises` VALUES (177, 'PIHOURS Céline', '12, Rue Gambetta \n ', 49400, 'SAUMUR', '02-41-67-66-66', '', '02-41-50-83-23', '', '', '', 'PIHOURS', 'Mickaël', 0, 0);
INSERT INTO `les_entreprises` VALUES (178, 'VAM MARLE Richard', '2 rue Ambroise de Loré \n ', 53100, 'MAYENNE', '02-43-00-96-00', '', '02-43-00-69-20', '', '', '', 'VAN MARLE', 'RICHARD', 5, 0);
INSERT INTO `les_entreprises` VALUES (179, 'MOREL Marie-Christine', '66, Rue Vaufleury \n ', 53000, 'LAVAL', '02-43-66-02-02', '', '02-43-66-13-50', '', '', '', 'TOUILLER', 'THIERRY', 5, 0);
INSERT INTO `les_entreprises` VALUES (180, 'CAUDRON Céline', '67, Rue du Val de Mayenne \n ', 53000, 'LAVAL', '02-43-56-98-29', '', '02-43-56-52-85', 'bistro.paris@wanadoo.fr', '', '', 'LEMERCIER', 'GUY', 9, 0);
INSERT INTO `les_entreprises` VALUES (181, 'LEMERCIER Brigitte', '67, Rue du Val de Mayenne \n ', 53000, 'LAVAL', '02-43-56-98-29', '', '02-43-56-52-85', 'bistro.paris@wanadoo.fr', '', '', 'LEMERCIER', 'GUY', 9, 0);
INSERT INTO `les_entreprises` VALUES (182, 'DUGUET JACQUES', '17 rue Charles Landelle \n ', 53000, 'LAVAL', '02-43-53-28-39', '06-73-53-06-99', '', '', '', '', 'DUGUET', 'JACQUES', 4, 0);
INSERT INTO `les_entreprises` VALUES (183, 'RAMAUGE Cyrille', '15, Rue Thiers \n ', 53200, 'CHATEAU GONTIER', '02-43-07-22-75', '', '', '', '', '', 'RAMAUGE', 'Sandrine', 0, 0);
INSERT INTO `les_entreprises` VALUES (184, 'LUCAS MICHEL', '26 place Renault Morlière \n ', 53500, 'ERNEE', '02-43-05-12-68', '06-17-95-80-34', '', '', '', '', 'LUCAS', 'MICHEL', 3, 0);
INSERT INTO `les_entreprises` VALUES (185, 'PELE Jean-François', '86, Rue Bernard Le Pecq \n ', 53000, 'LAVAL', '', '', '', '', '', '', 'HELAINE', '', 2, 0);
INSERT INTO `les_entreprises` VALUES (186, 'CHIGNON Joel', '39, Avenue des Sports \n ', 53600, 'EVRON', '02-43-01-64-69', '', '', '', '', '', 'ANGOT', 'Isabelle', 4, 0);
INSERT INTO `les_entreprises` VALUES (187, 'CLAVREUL BERTRAND', '1 RUE DE LA GARE \n ', 53150, 'MONTSURS', '02-43-01-00-38', '', '', '', '', '', 'CLAVREUL', 'BERTRAND', 3, 0);
INSERT INTO `les_entreprises` VALUES (188, 'MAUDET JEAN-CHRISTOPHE', '2, Place de l''Eglise \n ', 53210, 'ARGENTRE', '02-43-37-31-12', '', '', '', '', '', 'MAUDET', 'JEAN-CHRISTOPHE', 2, 0);
INSERT INTO `les_entreprises` VALUES (189, 'DOUAY PIERRE', '13, Rue Division Leclerc \n ', 53200, 'CHATEAU-GONTIER', '02-43-07-27-07', '06-71-30-83-07', '02-43-07-27-07', '', '', '', 'HUCHEDE', 'Philippe', 2, 0);
INSERT INTO `les_entreprises` VALUES (190, 'TRIHAN Jérôme', '4, place de l''Eglise \n ', 35500, 'ERBREE', '02-99-49-40-19', '', '02-99-49-40-19', '', '', '', 'TRIHAN', 'Jérôme', 0, 0);
INSERT INTO `les_entreprises` VALUES (191, 'VIGNEAU Richard', '14 RUE DES TROIS MARCHANDS \n ', 53230, 'COSSE LE VIVIEN', '02-43-98-81-40', '', '', '', '', '', 'VIGNEAU', 'RICHARD', 2, 0);
INSERT INTO `les_entreprises` VALUES (192, 'FOUQUET Jean-Christophe', '117-119, rue de Bretagne \n ', 53000, 'LAVAL', '02-43-69-55-05', '', '', '', '', '', 'FOUQUET', 'JEAN-CHRISTOPHE', 0, 0);
INSERT INTO `les_entreprises` VALUES (193, 'RIBOT Hervé', '6, Rue Echelle Marteau \n ', 53000, 'LAVAL', '02-43-53-15-85', '', '', '', '', '', 'RIBOT', 'Hervé', 2, 0);
INSERT INTO `les_entreprises` VALUES (194, 'TRIHON Rémi', '6, Rue Amiral Courbet \n ', 53500, 'ERNEE', '02-43-05-23-37', '', '', '', '', '', 'BRILHAULT', 'CHRISTIAN', 5, 0);
INSERT INTO `les_entreprises` VALUES (195, 'BEUNARD Jérôme', '29, Rue d''Anjou \n ', 53260, 'ENTRAMMES', '02-43-98-00-50', '', '02-43-98-00-50', '', '', '', 'ONNO', 'Noël', 3, 0);
INSERT INTO `les_entreprises` VALUES (196, 'DERVAL MOISE', '24 avenue de Chanzy \n ', 53000, 'LAVAL', '02-43-53-20-98', '', '02-43-49-17-82', '', '', '', 'DERVAL', 'MOISE', 5, 0);
INSERT INTO `les_entreprises` VALUES (197, 'LOUVARD Stéphane', '43-45 Rue Miromesnil \n ', 75000, 'PARIS', '01-42-65-56-90', '', '01-42-65-02-74', '', '', '', 'LOUVARD', 'Stéphane', 11, 0);
INSERT INTO `les_entreprises` VALUES (198, 'BOUVERET Jean-Philippe', '2, Rue de la Montée \n ', 53120, 'GORRON', '02-43-08-64-81', '', '', '', '', '', 'BOUVERET', 'Jean-Philippe', 2, 0);
INSERT INTO `les_entreprises` VALUES (199, 'GUIBERT Jérôme', '8, Rue des Forges \n ', 53410, 'PORT-BRILLET', '02-43-68-83-71', '', '02-43-68-83-71', '', '', '', 'GUIBERT', 'Jessie', 2, 0);
INSERT INTO `les_entreprises` VALUES (200, 'CERISIER Jean Yves', '10 carrefour aux toiles \n ', 53000, 'LAVAL', '02-43-66-86-87', '', '', '', '', '', 'CERISIER', 'Christine', 4, 0);
INSERT INTO `les_entreprises` VALUES (201, 'CHRETIEN Philippe', '19, Rue Maurice Courcelle \n ', 53240, 'SAINT-JEAN-SUR-MAYENNE', '02-43-01-13-28', '', '', '', '', '', 'CHRETIEN', 'Philippe', 1, 0);
INSERT INTO `les_entreprises` VALUES (202, 'LE GODAIS Franck', '4, Place de Hercé \n ', 53100, 'MAYENNE', '02-43-04-22-89', '', '', '', '', '', 'PRETEUX', 'Jean-Marc', 2, 0);
INSERT INTO `les_entreprises` VALUES (203, 'BOURGUILLEAU Jérôme', '60 Route de Nantes \n ', 53230, 'COSSE LE VIVIEN', '02-43-98-85-48', '', '', '', '', '', 'LAIGRE', 'CHRISTIAN', 3, 0);
INSERT INTO `les_entreprises` VALUES (204, 'RICOU Jean-Michel', '6 bld Victor Hugo \n ', 53200, 'CHATEAU GONTIER', '02-43-70-46-29', '', '', '', '', '', 'SERGENT', 'JEAN-NOEL', 7, 0);
INSERT INTO `les_entreprises` VALUES (205, 'PARIS Jean-Pierre', '113, Rue du Pont de Mayenne \n ', 53000, 'LAVAL', '02-43-53-39-55', '', '', '', '', '', 'PARIS', 'Jean-Pierre', 0, 0);
INSERT INTO `les_entreprises` VALUES (206, 'HEINRY MICHEL', '10 rue de la Libération \n ', 53400, 'CRAON', '02-43-06-29-08', '', '', '', '', '', 'HEINRY', 'MICHEL', 4, 0);
INSERT INTO `les_entreprises` VALUES (207, 'GIRAULT Stéphane', '114, Rue Victor Boissel \n ', 53000, 'LAVAL', '02-43-53-28-26', '', '', '', '', '', 'GIRAULT', 'STEPHANE', 2, 0);
INSERT INTO `les_entreprises` VALUES (208, 'MASSOT Jean François', '10, Rue de Loré \n ', 53000, 'LAVAL', '02-43-53-99-42', '', '', '', '', '', 'MASSOT', 'Jean-François', 4, 0);
INSERT INTO `les_entreprises` VALUES (209, 'LESAULNIER Daniel', 'Route de Paris \n ', 35133, 'BEAUCE', '02-99-99-81-55', '', '02-99-99-98-45', '', '', '', 'LESAULNIER', '', 12, 0);
INSERT INTO `les_entreprises` VALUES (210, 'DOMEDE Didier', '15, Rue Saint-Nicolas \n ', 53700, 'VILLAINES LA JUHEL', '02-43-03-25-79', '', '', '', '', '', 'DOMEDE', 'Didier', 3, 0);
INSERT INTO `les_entreprises` VALUES (211, 'GRIMAULT Patrick', 'CENTRE COMMERCIAL MURAT \n ', 53000, 'LAVAL', '02-43-49-19-18', '', '', '', '', '', 'GRIMAULT', 'Patrick', 1, 0);
INSERT INTO `les_entreprises` VALUES (212, 'RENAULT STEPHANE', '17 place du 9 Juin 1944 \n ', 53100, 'MAYENNE', '02-43-04-43-41', '', '02-43-04-43-41', '', '', '', 'RENAULT', 'STEPHANE', 7, 0);
INSERT INTO `les_entreprises` VALUES (213, 'CHEVY BERTRAND', '64, Rue de Rennes \n ', 53000, 'LAVAL', '02-43-68-26-34', '', '', '', '', '', 'CHEVY', 'BERTRAND', 4, 0);
INSERT INTO `les_entreprises` VALUES (214, 'NEAU JEAN-PATRICK', '11, Place du Pilori \n ', 53600, 'EVRON', '02-43-01-91-93', '06-77-01-70-29', '', '', '', '', 'NEAU', 'JEAN-PATRICK', 3, 0);
INSERT INTO `les_entreprises` VALUES (215, 'DURAND Richard', 'L''Huilerie - Route de Laval \n ', 53100, 'MAYENNE', '02-43-00-47-85', '', '', '', '', '', 'BOUDIN', 'BRUNO', 8, 0);
INSERT INTO `les_entreprises` VALUES (216, 'BADIN Laurent', '13, Rue de Bouchevreau \n ', 53300, 'AMBRIERES-LES-VALLEES', '02-43-04-92-84', '', '', '', '', '', 'BURNEL', 'Christophe', 2, 0);
INSERT INTO `les_entreprises` VALUES (217, 'FANOUILLET Sébastien', '8, Grande Rue \n ', 53170, 'MESLAY-DU-MAINE', '02-43-98-40-21', '', '', '', '', '', 'FANOUILLET', 'Marlène', 3, 0);
INSERT INTO `les_entreprises` VALUES (218, 'ROBINET BRUNO', '42 rue de la Perrière \n ', 53600, 'EVRON', '02-43-01-62-43', '', '', '', '', '', 'ROBINET', 'BRUNO', 2, 0);
INSERT INTO `les_entreprises` VALUES (219, 'RENOUARD Sébastien', '7, Place Jean Buchet \n ', 53800, 'LA SELLE-CRAONNAISE', '02-43-06-17-68', '06-80-81-02-71', '', '', '', '', 'RENOUARD', 'Sébastien', 0, 0);
INSERT INTO `les_entreprises` VALUES (220, 'HOUDAYER Marc', '1 rue René D''Anjou \n ', 53200, 'CHATEAU GONTIER', '', '', '', '', '', '', 'HOUDAYER', 'Marc', 5, 0);
INSERT INTO `les_entreprises` VALUES (221, 'MEZIERE MICHEL', '8, Rue de Laval \n ', 53970, 'L''HUISSERIE', '02-43-69-62-28', '', '', '', '', '', 'CADOT', 'DOMINIQUE', 4, 0);
INSERT INTO `les_entreprises` VALUES (222, 'MAUNY Pascal', '4, Rue de la Madeleine \n ', 53100, 'MAYENNE', '02-43-04-23-95', '', '', '', '', '', 'MAUNY', 'Pascal', 0, 0);
INSERT INTO `les_entreprises` VALUES (223, 'MEZIERE PHILIPPE', '4 rue Relais des Diligences \n ', 53390, 'ST AIGNAN S/ROE', '02-43-06-51-22', '', '', '', '', '', 'MEZIERE', 'PHILIPPE', 4, 0);
INSERT INTO `les_entreprises` VALUES (224, 'HUBERT Yohann', '34, Rue du Coq Hardi \n ', 72140, 'SILLE-LE-GUILLAUME', '02-43-20-17-15', '', '', '', '', '', 'HUBERT', 'Yohann', 1, 0);
INSERT INTO `les_entreprises` VALUES (225, 'GOHAU', 'ZI la Chambrouillère \n ', 53960, 'BONCHAMP-LES-LAVAL', '02-43-59-23-80', '', '02-43-58-15-81', '', '', '', 'GOHAU', '', 200, 0);
INSERT INTO `les_entreprises` VALUES (226, 'CHAMBARD PIERRE', 'Rue des Frères Lumière \n ', 53230, 'COSSE LE VIVIEN', '02-43-98-27-76', '', '02-43-64-33-90', '', '', '', 'CHAMBARD', 'PIERRE', 85, 0);
INSERT INTO `les_entreprises` VALUES (227, 'ANGOT', '366 RUE DE CHAUVRIE \n ', 53100, 'MAYENNE', '02-43-04-13-82', '', '02-43-04-84-87', '', '', '', 'ANGOT', '', 19, 0);
INSERT INTO `les_entreprises` VALUES (228, 'DELANGLE Didier', 'Zone d''activité \n ', 53950, 'LOUVERNE', '02-43-01-58-00', '', '', '', '', '', 'DELANGLE', 'Didier', 16, 0);
INSERT INTO `les_entreprises` VALUES (229, 'ROMAGNE', '144 Avenue de Fougeres \n ', 53000, 'LAVAL', '02-43-90-70-87', '', '02-43-66-17-56', '', '', '', 'ROMAGNE', '', 4, 0);
INSERT INTO `les_entreprises` VALUES (230, 'BOUVIER JEAN CLAUDE', 'Route de Laval  LD La Hainaud \n ', 53500, 'ERNEE', '02-43-05-23-71', '', '', '', '', '', 'FOURNIER', 'DIDIER', 6, 0);
INSERT INTO `les_entreprises` VALUES (231, 'NOEL Bruno', '38 rue de la libération \n ', 53500, 'SAINT-PIERRE-DES-LANDES', '02-43-05-90-89', '', '02-43-05-94-76', '', '', '', 'NOEL', 'Bruno', 0, 0);
INSERT INTO `les_entreprises` VALUES (232, 'JANVIER', 'ZA DU HAUT MERAL \n ', 53150, 'MONTSURS', '02-43-01-01-67', '', '02-43-01-04-30', '', '', '', 'JANVIER', '', 0, 0);
INSERT INTO `les_entreprises` VALUES (233, 'LHERMELIN Alain', 'ZA RUE DES BORDAGERS \n ', 53810, 'CHANGE', '02-43-56-25-11', '', '02-43-53-95-73', '', '', '', 'LHERMELIN', 'Alain', 4, 0);
INSERT INTO `les_entreprises` VALUES (234, 'DANVEAU THIERRY', 'LD SANS SOUCI \n ', 53300, 'SAINT-FRAIMBAULT-DE-PRIERES', '02-43-00-87-21', '', '', '', '', '', 'DANVEAU', 'THIERRY', 2, 0);
INSERT INTO `les_entreprises` VALUES (235, 'WEIBEL BERNARD', '4 route du Mans \n ', 53960, 'BONCHAMP-LES-LAVAL', '02-43-90-96-53', '', '02-43-90-43-99', '', '', '', 'WEIBEL', 'BERNARD', 0, 0);
INSERT INTO `les_entreprises` VALUES (236, 'FEURPRIER Alain', '8 RUE BOSNIEUL \n ', 53370, 'ST PIERRE DES NIDS', '02-43-03-50-71', '', '02-43-03-63-40', '', '', '', 'FEURPRIER', 'Alain', 0, 0);
INSERT INTO `les_entreprises` VALUES (237, 'BARADA Patrice', '35 Avenue des sablonnieres \n ', 53200, 'SAINT-FORT', '02-43-07-23-90', '', '', '', '', '', 'BARADA', 'Patrice', 0, 0);
INSERT INTO `les_entreprises` VALUES (238, 'RENOUX', '66 Avenue de Paris \n ', 53940, 'ST BERTHEVIN', '02-43-01-24-24', '', '02-43-01-24-29', '', '', '', 'MARION', '', 45, 0);
INSERT INTO `les_entreprises` VALUES (239, 'ETIENNE Claude', '250 RUE DE RENNES \n ', 53100, 'MAYENNE', '02-43-04-36-71', '', '02-43-04-52-06', '', '', '', 'LEON', '', 24, 0);
INSERT INTO `les_entreprises` VALUES (240, 'AUTIER', '35 bd Clément Ader \n ', 53020, 'LAVAL CEDEX 9', '02-43-53-11-73', '', '02-43-49-20-70', '', '', '', 'LEFEBVRE', '', 13, 0);
INSERT INTO `les_entreprises` VALUES (241, 'GAUTIER Gérard', '66 Avenue du Révérend Père Umbricht \n ', 35400, 'SAINT-MALO', '02-99-56-07-26', '', '02-99-56-65-54', '', '', '', 'HUBERT', '', 32, 0);
INSERT INTO `les_entreprises` VALUES (242, 'RAVENEL Thierry', 'ZI du Château de la Mare \n ', 50200, 'COUTANCES', '02-33-45-67-75', '', '02-33-45-84-16', '', '', '', '', '', 235, 0);
INSERT INTO `les_entreprises` VALUES (243, 'HENUT Patrice', '260, Rue des noisetiers \n ', 50110, 'TOURLAVILLE', '02-33-28-88-88', '', '', '', '', '', '', '', 300, 0);
INSERT INTO `les_entreprises` VALUES (244, 'GROSBOIS Didier', 'Z.A du Pré Barreau \n ', 49630, 'MAZE', '02-41-54-31-22', '', '02-41-54-01-90', '', '', '', '', '', 44, 0);
INSERT INTO `les_entreprises` VALUES (245, 'PLANCHENAULT Pierre', ' \n ', 14550, 'BLAINVILLE-SUR-ORNE', '02-31-70-54-57', '', '02-31-70-52-57', '', '', '', 'REMY', 'Michel', 2460, 0);
INSERT INTO `les_entreprises` VALUES (246, 'TALONNEAU PATRICK', 'ZI De Toul Garros \n ', 56400, 'AURAY', '02-97-56-65-21', '', '02-97-56-65-18', '', '', '', '', '', 67, 0);
INSERT INTO `les_entreprises` VALUES (247, 'PORCHER Alain', 'Les Petites Buttes \n ', 35600, 'BAINS-SUR-OUST', '02-99-91-74-11', '', '02-99-91-61-08', '', '', '', '', '', 50, 0);
INSERT INTO `les_entreprises` VALUES (248, 'BEDOUAIN Patricia', '130 avenue de Mayenne \n ', 53000, 'LAVAL', '02-43-49-42-00', '02-43-49-42-76', '02-43-49-41-42', '', '', '', '', '', 565, 0);
INSERT INTO `les_entreprises` VALUES (249, 'LEGARE Philippe', 'Rue Robert Surmont \n ', 72400, 'LA FERTE-BERNARD', '02-43-60-33-00', '', '02-43-60-33-05', '', '', '', '', '', 377, 0);
INSERT INTO `les_entreprises` VALUES (250, 'GIRARD Dominique', '50, Avenue du Préfet \n ', 53032, 'LAVAL CEDEX 9', '02-43-49-66-00', '', '02-43-53-27-02', '', '', '', 'LECONTE', 'Jean-Marie', 450, 0);
INSERT INTO `les_entreprises` VALUES (251, 'GAUBERT Jean-Pierre', 'Route de Fougères \n ', 53120, 'GORRON', '02-43-08-49-49', '', '02-43-08-66-19', '', '', '', 'MARY', '', 165, 0);
INSERT INTO `les_entreprises` VALUES (252, 'CAMPAGNE Frédéric', 'Rue des Frères Lumière \n ', 53230, 'COSSE LE VIVIEN', '02-43-98-27-76', '', '02-43-64-33-90', '', '', '', 'CHAMBARD', 'PIERRE', 85, 0);
INSERT INTO `les_entreprises` VALUES (253, 'LEVRARD Laurent', '15, Avenue Pierre Piffault \n ', 72086, 'LE MANS CEDEX', '02-43-16-42-34', '', '02-43-16-51-88', '', '', '', '', '', 2900, 0);
INSERT INTO `les_entreprises` VALUES (254, 'TREMBLAY Guy', 'Avenue d''Angers \n ', 53032, 'LAVAL', '02-43-49-80-00', '', '02-43-56-23-97', '', '', '', '', '', 280, 0);
INSERT INTO `les_entreprises` VALUES (255, 'TERRIER Jean-Pierre', '9, Rue des Combattants \n ', 53170, 'MESLAY-DU-MAINE', '02-43-90-93-29', '', '02-43-90-93-30', '', '', '', '', '', 5, 0);
INSERT INTO `les_entreprises` VALUES (256, 'JUBAULT Christophe', 'Route des Eaux \n ', 35500, 'VITRE', '02-99-75-87-40', '', '02-99-75-87-50', '', '', '', '', '', 1297, 0);
INSERT INTO `les_entreprises` VALUES (257, 'DECORE BERTRAND', 'Route d''Evron \n ', 72140, 'SILLE-LE-GUILLAUME', '02-43-52-52-52', '', '02-43-52-52-53', '', '', '', '', '', 650, 0);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_evaluations_feuilles_modalite_choix`
-- 

CREATE TABLE `les_evaluations_feuilles_modalite_choix` (
  `id_choix` bigint(20) NOT NULL default '0',
  `id_noeud` bigint(20) NOT NULL default '0',
  `evaluation_max` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_choix`,`id_noeud`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `les_evaluations_feuilles_modalite_choix`
-- 

INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (53, 1194, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (53, 1195, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (53, 1200, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (53, 1201, 0);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (53, 1202, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (53, 1203, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (53, 1204, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (53, 1205, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (53, 1206, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (53, 1207, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (53, 1213, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (53, 1214, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (53, 1215, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (53, 1216, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (53, 1218, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (53, 1219, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (53, 1221, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (53, 1222, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (54, 1194, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (54, 1195, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (54, 1200, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (54, 1201, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (54, 1202, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (54, 1203, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (54, 1204, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (54, 1205, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (54, 1206, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (54, 1207, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (54, 1213, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (54, 1214, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (54, 1215, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (54, 1216, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (54, 1218, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (54, 1219, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (54, 1221, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (54, 1222, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (55, 1194, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (55, 1195, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (55, 1200, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (55, 1201, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (55, 1202, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (55, 1203, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (55, 1204, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (55, 1205, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (55, 1206, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (55, 1207, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (55, 1213, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (55, 1214, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (55, 1215, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (55, 1216, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (55, 1218, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (55, 1219, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (55, 1221, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (55, 1222, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (56, 1194, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (56, 1195, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (56, 1200, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (56, 1201, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (56, 1202, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (56, 1203, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (56, 1204, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (56, 1205, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (56, 1206, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (56, 1207, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (56, 1213, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (56, 1214, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (56, 1215, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (56, 1216, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (56, 1218, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (56, 1219, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (56, 1221, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (56, 1222, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 1999, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2000, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2001, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2002, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2003, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2004, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2005, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2006, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2007, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2009, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2010, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2011, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2012, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2013, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2014, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2015, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2016, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2017, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2018, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2019, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2020, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2021, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2022, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2023, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2024, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2025, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2026, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2027, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2028, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2029, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2030, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2031, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2032, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2033, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2034, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2035, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (65, 2036, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 1999, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2000, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2001, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2002, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2003, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2004, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2005, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2006, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2007, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2009, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2010, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2011, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2012, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2013, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2014, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2015, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2016, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2017, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2018, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2019, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2020, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2021, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2022, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2023, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2024, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2025, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2026, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2027, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2028, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2029, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2030, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2031, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2032, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2033, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2034, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2035, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (66, 2036, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 1999, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2000, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2001, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2002, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2003, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2004, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2005, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2006, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2007, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2009, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2010, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2011, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2012, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2013, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2014, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2015, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2016, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2017, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2018, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2019, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2020, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2021, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2022, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2023, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2024, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2025, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2026, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2027, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2028, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2029, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2030, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2031, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2032, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2033, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2034, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2035, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (67, 2036, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2102, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2103, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2104, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2106, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2107, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2108, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2109, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2110, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2111, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2113, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2114, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2115, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2116, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2117, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2118, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2119, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2120, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2121, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2122, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2123, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2124, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2126, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2127, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2128, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2129, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2130, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2131, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2132, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2133, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2134, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2135, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2136, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2137, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2138, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2139, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2140, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (72, 2142, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2102, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2103, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2104, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2106, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2107, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2108, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2109, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2110, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2111, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2113, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2114, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2115, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2116, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2117, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2118, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2119, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2120, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2121, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2122, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2123, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2124, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2126, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2127, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2128, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2129, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2130, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2131, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2132, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2133, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2134, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2135, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2136, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2137, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2138, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2139, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2140, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (73, 2142, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2102, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2103, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2104, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2106, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2107, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2108, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2109, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2110, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2111, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2113, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2114, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2115, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2116, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2117, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2118, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2119, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2120, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2121, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2122, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2123, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2124, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2126, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2127, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2128, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2129, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2130, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2131, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2132, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2133, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2134, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2135, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2136, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2137, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2138, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2139, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2140, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (74, 2142, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 1999, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2000, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2001, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2002, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2003, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2004, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2005, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2006, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2007, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2009, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2010, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2011, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2012, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2013, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2014, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2015, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2016, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2017, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2018, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2019, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2020, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2021, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2022, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2023, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2024, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2025, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2026, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2027, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2028, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2029, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2030, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2031, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2032, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2033, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2034, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2035, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (75, 2036, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 1999, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2000, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2001, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2002, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2003, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2004, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2005, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2006, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2007, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2009, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2010, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2011, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2012, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2013, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2014, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2015, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2016, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2017, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2018, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2019, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2020, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2021, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2022, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2023, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2024, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2025, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2026, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2027, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2028, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2029, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2030, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2031, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2032, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2033, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2034, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2035, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (76, 2036, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 1999, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2000, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2001, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2002, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2003, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2004, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2005, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2006, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2007, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2009, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2010, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2011, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2012, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2013, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2014, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2015, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2016, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2017, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2018, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2019, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2020, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2021, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2022, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2023, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2024, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2025, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2026, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2027, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2028, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2029, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2030, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2031, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2032, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2033, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2034, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2035, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (77, 2036, 4);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_evaluations_feuilles_modalite_va_unique`
-- 

CREATE TABLE `les_evaluations_feuilles_modalite_va_unique` (
  `id_modalite` bigint(20) NOT NULL default '0',
  `id_noeud` bigint(20) NOT NULL default '0',
  `evaluation_max` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_modalite`,`id_noeud`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `les_evaluations_feuilles_modalite_va_unique`
-- 

INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (12, 1194, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (12, 1195, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (12, 1200, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (12, 1201, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (12, 1202, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (12, 1203, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (12, 1204, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (12, 1205, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (12, 1206, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (12, 1207, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (12, 1213, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (12, 1214, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (12, 1215, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (12, 1216, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (12, 1218, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (12, 1219, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (12, 1221, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (12, 1222, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (17, 1144, 5);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (17, 1145, 5);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (17, 1146, 5);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (17, 1147, 5);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (17, 1148, 3);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (17, 1149, 2);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (17, 1151, 5);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (17, 1152, 8);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (17, 1153, 5);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (17, 1154, 5);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (17, 1657, 6);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (17, 1661, 4);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (17, 1664, 4);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (17, 1665, 4);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (17, 1667, 4);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (17, 1670, 2);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (17, 1671, 4);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (17, 1672, 4);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (20, 1671, 20);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_feuilles_declarees`
-- 

CREATE TABLE `les_feuilles_declarees` (
  `id_noeud` bigint(20) NOT NULL default '0',
  `id_dec` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_noeud`,`id_dec`),
  KEY `id_dec` (`id_dec`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `les_feuilles_declarees`
-- 

INSERT INTO `les_feuilles_declarees` VALUES (743, 66);
INSERT INTO `les_feuilles_declarees` VALUES (800, 66);
INSERT INTO `les_feuilles_declarees` VALUES (865, 66);
INSERT INTO `les_feuilles_declarees` VALUES (866, 66);
INSERT INTO `les_feuilles_declarees` VALUES (743, 67);
INSERT INTO `les_feuilles_declarees` VALUES (800, 67);
INSERT INTO `les_feuilles_declarees` VALUES (865, 67);
INSERT INTO `les_feuilles_declarees` VALUES (866, 67);
INSERT INTO `les_feuilles_declarees` VALUES (743, 68);
INSERT INTO `les_feuilles_declarees` VALUES (800, 68);
INSERT INTO `les_feuilles_declarees` VALUES (865, 68);
INSERT INTO `les_feuilles_declarees` VALUES (866, 68);
INSERT INTO `les_feuilles_declarees` VALUES (743, 69);
INSERT INTO `les_feuilles_declarees` VALUES (800, 69);
INSERT INTO `les_feuilles_declarees` VALUES (865, 69);
INSERT INTO `les_feuilles_declarees` VALUES (866, 69);
INSERT INTO `les_feuilles_declarees` VALUES (743, 70);
INSERT INTO `les_feuilles_declarees` VALUES (800, 70);
INSERT INTO `les_feuilles_declarees` VALUES (865, 70);
INSERT INTO `les_feuilles_declarees` VALUES (866, 70);
INSERT INTO `les_feuilles_declarees` VALUES (743, 71);
INSERT INTO `les_feuilles_declarees` VALUES (800, 71);
INSERT INTO `les_feuilles_declarees` VALUES (865, 71);
INSERT INTO `les_feuilles_declarees` VALUES (866, 71);
INSERT INTO `les_feuilles_declarees` VALUES (743, 72);
INSERT INTO `les_feuilles_declarees` VALUES (800, 72);
INSERT INTO `les_feuilles_declarees` VALUES (865, 72);
INSERT INTO `les_feuilles_declarees` VALUES (866, 72);
INSERT INTO `les_feuilles_declarees` VALUES (743, 73);
INSERT INTO `les_feuilles_declarees` VALUES (800, 73);
INSERT INTO `les_feuilles_declarees` VALUES (865, 73);
INSERT INTO `les_feuilles_declarees` VALUES (866, 73);
INSERT INTO `les_feuilles_declarees` VALUES (682, 74);
INSERT INTO `les_feuilles_declarees` VALUES (682, 75);
INSERT INTO `les_feuilles_declarees` VALUES (682, 76);
INSERT INTO `les_feuilles_declarees` VALUES (682, 77);
INSERT INTO `les_feuilles_declarees` VALUES (682, 78);
INSERT INTO `les_feuilles_declarees` VALUES (682, 79);
INSERT INTO `les_feuilles_declarees` VALUES (682, 80);
INSERT INTO `les_feuilles_declarees` VALUES (682, 81);
INSERT INTO `les_feuilles_declarees` VALUES (871, 82);
INSERT INTO `les_feuilles_declarees` VALUES (871, 83);
INSERT INTO `les_feuilles_declarees` VALUES (871, 84);
INSERT INTO `les_feuilles_declarees` VALUES (871, 85);
INSERT INTO `les_feuilles_declarees` VALUES (871, 86);
INSERT INTO `les_feuilles_declarees` VALUES (871, 87);
INSERT INTO `les_feuilles_declarees` VALUES (871, 88);
INSERT INTO `les_feuilles_declarees` VALUES (871, 89);
INSERT INTO `les_feuilles_declarees` VALUES (686, 90);
INSERT INTO `les_feuilles_declarees` VALUES (708, 90);
INSERT INTO `les_feuilles_declarees` VALUES (750, 90);
INSERT INTO `les_feuilles_declarees` VALUES (775, 90);
INSERT INTO `les_feuilles_declarees` VALUES (872, 90);
INSERT INTO `les_feuilles_declarees` VALUES (686, 91);
INSERT INTO `les_feuilles_declarees` VALUES (708, 91);
INSERT INTO `les_feuilles_declarees` VALUES (750, 91);
INSERT INTO `les_feuilles_declarees` VALUES (775, 91);
INSERT INTO `les_feuilles_declarees` VALUES (872, 91);
INSERT INTO `les_feuilles_declarees` VALUES (686, 92);
INSERT INTO `les_feuilles_declarees` VALUES (708, 92);
INSERT INTO `les_feuilles_declarees` VALUES (750, 92);
INSERT INTO `les_feuilles_declarees` VALUES (775, 92);
INSERT INTO `les_feuilles_declarees` VALUES (872, 92);
INSERT INTO `les_feuilles_declarees` VALUES (686, 93);
INSERT INTO `les_feuilles_declarees` VALUES (708, 93);
INSERT INTO `les_feuilles_declarees` VALUES (750, 93);
INSERT INTO `les_feuilles_declarees` VALUES (775, 93);
INSERT INTO `les_feuilles_declarees` VALUES (872, 93);
INSERT INTO `les_feuilles_declarees` VALUES (686, 94);
INSERT INTO `les_feuilles_declarees` VALUES (708, 94);
INSERT INTO `les_feuilles_declarees` VALUES (750, 94);
INSERT INTO `les_feuilles_declarees` VALUES (775, 94);
INSERT INTO `les_feuilles_declarees` VALUES (872, 94);
INSERT INTO `les_feuilles_declarees` VALUES (686, 95);
INSERT INTO `les_feuilles_declarees` VALUES (708, 95);
INSERT INTO `les_feuilles_declarees` VALUES (750, 95);
INSERT INTO `les_feuilles_declarees` VALUES (775, 95);
INSERT INTO `les_feuilles_declarees` VALUES (872, 95);
INSERT INTO `les_feuilles_declarees` VALUES (686, 96);
INSERT INTO `les_feuilles_declarees` VALUES (708, 96);
INSERT INTO `les_feuilles_declarees` VALUES (750, 96);
INSERT INTO `les_feuilles_declarees` VALUES (775, 96);
INSERT INTO `les_feuilles_declarees` VALUES (872, 96);
INSERT INTO `les_feuilles_declarees` VALUES (686, 97);
INSERT INTO `les_feuilles_declarees` VALUES (708, 97);
INSERT INTO `les_feuilles_declarees` VALUES (750, 97);
INSERT INTO `les_feuilles_declarees` VALUES (775, 97);
INSERT INTO `les_feuilles_declarees` VALUES (872, 97);
INSERT INTO `les_feuilles_declarees` VALUES (686, 109);
INSERT INTO `les_feuilles_declarees` VALUES (752, 109);
INSERT INTO `les_feuilles_declarees` VALUES (774, 109);
INSERT INTO `les_feuilles_declarees` VALUES (786, 109);
INSERT INTO `les_feuilles_declarees` VALUES (894, 110);
INSERT INTO `les_feuilles_declarees` VALUES (908, 110);
INSERT INTO `les_feuilles_declarees` VALUES (918, 110);
INSERT INTO `les_feuilles_declarees` VALUES (927, 110);
INSERT INTO `les_feuilles_declarees` VALUES (929, 110);
INSERT INTO `les_feuilles_declarees` VALUES (883, 111);
INSERT INTO `les_feuilles_declarees` VALUES (886, 111);
INSERT INTO `les_feuilles_declarees` VALUES (888, 111);
INSERT INTO `les_feuilles_declarees` VALUES (888, 112);
INSERT INTO `les_feuilles_declarees` VALUES (894, 112);
INSERT INTO `les_feuilles_declarees` VALUES (908, 112);
INSERT INTO `les_feuilles_declarees` VALUES (918, 112);
INSERT INTO `les_feuilles_declarees` VALUES (922, 112);
INSERT INTO `les_feuilles_declarees` VALUES (893, 113);
INSERT INTO `les_feuilles_declarees` VALUES (894, 113);
INSERT INTO `les_feuilles_declarees` VALUES (896, 113);
INSERT INTO `les_feuilles_declarees` VALUES (897, 113);
INSERT INTO `les_feuilles_declarees` VALUES (874, 114);
INSERT INTO `les_feuilles_declarees` VALUES (893, 114);
INSERT INTO `les_feuilles_declarees` VALUES (894, 114);
INSERT INTO `les_feuilles_declarees` VALUES (896, 114);
INSERT INTO `les_feuilles_declarees` VALUES (898, 114);
INSERT INTO `les_feuilles_declarees` VALUES (899, 114);
INSERT INTO `les_feuilles_declarees` VALUES (916, 114);
INSERT INTO `les_feuilles_declarees` VALUES (927, 114);
INSERT INTO `les_feuilles_declarees` VALUES (928, 114);
INSERT INTO `les_feuilles_declarees` VALUES (930, 114);
INSERT INTO `les_feuilles_declarees` VALUES (936, 114);
INSERT INTO `les_feuilles_declarees` VALUES (947, 114);
INSERT INTO `les_feuilles_declarees` VALUES (951, 114);
INSERT INTO `les_feuilles_declarees` VALUES (953, 114);
INSERT INTO `les_feuilles_declarees` VALUES (954, 114);
INSERT INTO `les_feuilles_declarees` VALUES (876, 115);
INSERT INTO `les_feuilles_declarees` VALUES (894, 115);
INSERT INTO `les_feuilles_declarees` VALUES (928, 115);
INSERT INTO `les_feuilles_declarees` VALUES (1005, 115);
INSERT INTO `les_feuilles_declarees` VALUES (881, 116);
INSERT INTO `les_feuilles_declarees` VALUES (881, 117);
INSERT INTO `les_feuilles_declarees` VALUES (881, 118);
INSERT INTO `les_feuilles_declarees` VALUES (881, 119);
INSERT INTO `les_feuilles_declarees` VALUES (881, 120);
INSERT INTO `les_feuilles_declarees` VALUES (881, 121);
INSERT INTO `les_feuilles_declarees` VALUES (881, 122);
INSERT INTO `les_feuilles_declarees` VALUES (686, 123);
INSERT INTO `les_feuilles_declarees` VALUES (752, 123);
INSERT INTO `les_feuilles_declarees` VALUES (774, 123);
INSERT INTO `les_feuilles_declarees` VALUES (786, 123);
INSERT INTO `les_feuilles_declarees` VALUES (686, 124);
INSERT INTO `les_feuilles_declarees` VALUES (752, 124);
INSERT INTO `les_feuilles_declarees` VALUES (774, 124);
INSERT INTO `les_feuilles_declarees` VALUES (786, 124);
INSERT INTO `les_feuilles_declarees` VALUES (686, 125);
INSERT INTO `les_feuilles_declarees` VALUES (752, 125);
INSERT INTO `les_feuilles_declarees` VALUES (774, 125);
INSERT INTO `les_feuilles_declarees` VALUES (786, 125);
INSERT INTO `les_feuilles_declarees` VALUES (686, 126);
INSERT INTO `les_feuilles_declarees` VALUES (752, 126);
INSERT INTO `les_feuilles_declarees` VALUES (774, 126);
INSERT INTO `les_feuilles_declarees` VALUES (786, 126);
INSERT INTO `les_feuilles_declarees` VALUES (686, 127);
INSERT INTO `les_feuilles_declarees` VALUES (752, 127);
INSERT INTO `les_feuilles_declarees` VALUES (774, 127);
INSERT INTO `les_feuilles_declarees` VALUES (786, 127);
INSERT INTO `les_feuilles_declarees` VALUES (686, 128);
INSERT INTO `les_feuilles_declarees` VALUES (752, 128);
INSERT INTO `les_feuilles_declarees` VALUES (774, 128);
INSERT INTO `les_feuilles_declarees` VALUES (786, 128);
INSERT INTO `les_feuilles_declarees` VALUES (686, 129);
INSERT INTO `les_feuilles_declarees` VALUES (752, 129);
INSERT INTO `les_feuilles_declarees` VALUES (774, 129);
INSERT INTO `les_feuilles_declarees` VALUES (786, 129);
INSERT INTO `les_feuilles_declarees` VALUES (965, 130);
INSERT INTO `les_feuilles_declarees` VALUES (972, 130);
INSERT INTO `les_feuilles_declarees` VALUES (973, 130);
INSERT INTO `les_feuilles_declarees` VALUES (987, 130);
INSERT INTO `les_feuilles_declarees` VALUES (894, 131);
INSERT INTO `les_feuilles_declarees` VALUES (906, 131);
INSERT INTO `les_feuilles_declarees` VALUES (970, 131);
INSERT INTO `les_feuilles_declarees` VALUES (898, 132);
INSERT INTO `les_feuilles_declarees` VALUES (903, 132);
INSERT INTO `les_feuilles_declarees` VALUES (910, 132);
INSERT INTO `les_feuilles_declarees` VALUES (911, 132);
INSERT INTO `les_feuilles_declarees` VALUES (957, 132);
INSERT INTO `les_feuilles_declarees` VALUES (969, 132);
INSERT INTO `les_feuilles_declarees` VALUES (982, 132);
INSERT INTO `les_feuilles_declarees` VALUES (1194, 133);
INSERT INTO `les_feuilles_declarees` VALUES (1202, 133);
INSERT INTO `les_feuilles_declarees` VALUES (1206, 133);
INSERT INTO `les_feuilles_declarees` VALUES (1213, 133);
INSERT INTO `les_feuilles_declarees` VALUES (1214, 133);
INSERT INTO `les_feuilles_declarees` VALUES (1215, 133);
INSERT INTO `les_feuilles_declarees` VALUES (1216, 133);
INSERT INTO `les_feuilles_declarees` VALUES (1218, 133);
INSERT INTO `les_feuilles_declarees` VALUES (1219, 133);
INSERT INTO `les_feuilles_declarees` VALUES (1144, 135);
INSERT INTO `les_feuilles_declarees` VALUES (1145, 135);
INSERT INTO `les_feuilles_declarees` VALUES (1146, 135);
INSERT INTO `les_feuilles_declarees` VALUES (1833, 138);
INSERT INTO `les_feuilles_declarees` VALUES (1930, 138);
INSERT INTO `les_feuilles_declarees` VALUES (1932, 138);
INSERT INTO `les_feuilles_declarees` VALUES (1999, 139);
INSERT INTO `les_feuilles_declarees` VALUES (2000, 139);
INSERT INTO `les_feuilles_declarees` VALUES (2002, 139);
INSERT INTO `les_feuilles_declarees` VALUES (2009, 139);
INSERT INTO `les_feuilles_declarees` VALUES (2012, 139);
INSERT INTO `les_feuilles_declarees` VALUES (1999, 140);
INSERT INTO `les_feuilles_declarees` VALUES (2003, 140);
INSERT INTO `les_feuilles_declarees` VALUES (2005, 140);
INSERT INTO `les_feuilles_declarees` VALUES (2007, 140);
INSERT INTO `les_feuilles_declarees` VALUES (2010, 140);
INSERT INTO `les_feuilles_declarees` VALUES (1146, 144);
INSERT INTO `les_feuilles_declarees` VALUES (1151, 144);
INSERT INTO `les_feuilles_declarees` VALUES (1652, 144);
INSERT INTO `les_feuilles_declarees` VALUES (1653, 144);
INSERT INTO `les_feuilles_declarees` VALUES (1659, 144);
INSERT INTO `les_feuilles_declarees` VALUES (1662, 144);
INSERT INTO `les_feuilles_declarees` VALUES (1194, 146);
INSERT INTO `les_feuilles_declarees` VALUES (1195, 146);
INSERT INTO `les_feuilles_declarees` VALUES (1144, 147);
INSERT INTO `les_feuilles_declarees` VALUES (1146, 147);
INSERT INTO `les_feuilles_declarees` VALUES (1154, 147);
INSERT INTO `les_feuilles_declarees` VALUES (1194, 147);
INSERT INTO `les_feuilles_declarees` VALUES (1195, 147);
INSERT INTO `les_feuilles_declarees` VALUES (1672, 147);
INSERT INTO `les_feuilles_declarees` VALUES (2002, 148);
INSERT INTO `les_feuilles_declarees` VALUES (2012, 148);
INSERT INTO `les_feuilles_declarees` VALUES (2023, 148);
INSERT INTO `les_feuilles_declarees` VALUES (2102, 151);
INSERT INTO `les_feuilles_declarees` VALUES (2103, 151);
INSERT INTO `les_feuilles_declarees` VALUES (1999, 152);
INSERT INTO `les_feuilles_declarees` VALUES (2007, 152);
INSERT INTO `les_feuilles_declarees` VALUES (2010, 152);
INSERT INTO `les_feuilles_declarees` VALUES (2018, 152);
INSERT INTO `les_feuilles_declarees` VALUES (2102, 153);
INSERT INTO `les_feuilles_declarees` VALUES (2107, 153);
INSERT INTO `les_feuilles_declarees` VALUES (2102, 156);
INSERT INTO `les_feuilles_declarees` VALUES (2107, 156);
INSERT INTO `les_feuilles_declarees` VALUES (2111, 156);
INSERT INTO `les_feuilles_declarees` VALUES (2113, 156);
INSERT INTO `les_feuilles_declarees` VALUES (1999, 157);
INSERT INTO `les_feuilles_declarees` VALUES (2001, 157);
INSERT INTO `les_feuilles_declarees` VALUES (2004, 157);
INSERT INTO `les_feuilles_declarees` VALUES (2007, 157);
INSERT INTO `les_feuilles_declarees` VALUES (1999, 159);
INSERT INTO `les_feuilles_declarees` VALUES (2000, 159);
INSERT INTO `les_feuilles_declarees` VALUES (2003, 159);
INSERT INTO `les_feuilles_declarees` VALUES (2006, 159);
INSERT INTO `les_feuilles_declarees` VALUES (2007, 159);
INSERT INTO `les_feuilles_declarees` VALUES (2010, 159);
INSERT INTO `les_feuilles_declarees` VALUES (2033, 159);
INSERT INTO `les_feuilles_declarees` VALUES (2034, 159);
INSERT INTO `les_feuilles_declarees` VALUES (2035, 159);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_feuilles_declarees_modalite_choix`
-- 

CREATE TABLE `les_feuilles_declarees_modalite_choix` (
  `id_noeud` bigint(20) NOT NULL default '0',
  `id_dec` bigint(20) NOT NULL default '0',
  `id_modalite` bigint(20) NOT NULL default '0',
  `id_choix` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_noeud`,`id_dec`,`id_choix`),
  KEY `id_choix` (`id_choix`),
  KEY `id_dec` (`id_dec`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `les_feuilles_declarees_modalite_choix`
-- 

INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (1194, 133, 18, 54);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (1194, 146, 18, 53);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (1194, 147, 18, 53);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (1195, 146, 18, 53);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (1195, 147, 18, 53);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (1213, 133, 18, 53);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (1999, 139, 23, 66);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (1999, 140, 23, 65);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (1999, 152, 23, 67);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (1999, 157, 23, 67);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (1999, 159, 23, 67);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (2000, 139, 23, 67);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (2000, 159, 23, 66);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (2001, 157, 23, 66);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (2002, 139, 23, 65);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (2002, 148, 23, 67);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (2003, 140, 23, 66);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (2003, 159, 23, 65);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (2004, 157, 23, 66);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (2005, 140, 23, 67);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (2006, 159, 23, 67);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (2007, 152, 23, 66);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (2007, 157, 23, 67);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (2007, 159, 23, 67);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (2009, 139, 23, 67);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (2010, 152, 23, 66);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (2010, 159, 23, 65);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (2012, 139, 23, 65);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (2012, 148, 23, 67);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (2018, 152, 23, 67);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (2023, 148, 23, 66);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (2033, 159, 23, 66);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (2034, 159, 23, 65);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (2035, 159, 23, 66);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (2102, 153, 27, 73);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (2102, 156, 27, 73);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (2107, 153, 27, 74);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (2107, 156, 27, 73);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (2111, 156, 27, 72);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (2113, 156, 27, 72);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_feuilles_declarees_modalite_va_unique`
-- 

CREATE TABLE `les_feuilles_declarees_modalite_va_unique` (
  `id_noeud` bigint(20) NOT NULL default '0',
  `id_dec` bigint(20) NOT NULL default '0',
  `id_modalite` bigint(20) NOT NULL default '0',
  `evaluation` longtext NOT NULL,
  PRIMARY KEY  (`id_noeud`,`id_dec`,`id_modalite`),
  KEY `id_modalite` (`id_modalite`),
  KEY `id_dec` (`id_dec`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `les_feuilles_declarees_modalite_va_unique`
-- 

INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1144, 147, 17, '3');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1146, 144, 17, '2');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1146, 144, 20, '10');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1146, 147, 17, '5');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1151, 144, 17, '2');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1151, 144, 20, '10');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1154, 147, 17, '5');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1194, 133, 10, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1194, 133, 12, '15');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1194, 133, 13, 'Manque de révisions');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1202, 133, 10, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1202, 133, 12, '6');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1202, 133, 13, 'A raté son dessin !!!');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1206, 133, 10, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1206, 133, 12, '7.5');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1206, 133, 13, 'Doit apprendre ses leçons');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1213, 133, 10, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1213, 133, 12, '12');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1213, 133, 13, '0');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1214, 133, 10, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1214, 133, 12, '13');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1214, 133, 13, '0');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1215, 133, 10, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1215, 133, 12, '9');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1215, 133, 13, 'Il faut faire des efforts !');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1216, 133, 10, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1216, 133, 12, '12');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1216, 133, 13, '0');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1218, 133, 10, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1218, 133, 12, '7');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1218, 133, 13, '0');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1219, 133, 10, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1219, 133, 12, '8');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1219, 133, 13, '0');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1652, 144, 17, '2');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1652, 144, 20, '9');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1653, 144, 17, '3');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1653, 144, 20, '11');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1659, 144, 17, '1');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1659, 144, 20, '15');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1662, 144, 17, '3');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1662, 144, 20, '11');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1672, 147, 17, '1');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1999, 139, 24, '10');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1999, 140, 24, '0');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1999, 152, 24, 'METRAGE LINEAIRE');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1999, 157, 24, 'cloisons industrielles');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1999, 159, 24, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (1999, 159, 27, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2000, 139, 24, '2');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2000, 159, 24, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2000, 159, 27, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2001, 157, 24, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2002, 139, 24, '4');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2002, 148, 24, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2003, 140, 24, '0');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2003, 159, 24, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2003, 159, 27, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2004, 157, 24, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2005, 140, 24, '0');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2006, 159, 24, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2006, 159, 27, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2007, 140, 24, '0');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2007, 152, 24, 'ALU');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2007, 157, 24, 'ALU');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2007, 159, 24, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2007, 159, 27, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2009, 139, 24, '4');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2010, 140, 24, '0');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2010, 152, 24, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2010, 159, 24, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2010, 159, 27, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2012, 139, 24, '4');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2012, 148, 24, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2018, 152, 24, 'CHASSIS FIXE');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2023, 148, 24, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2033, 159, 24, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2033, 159, 27, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2034, 159, 24, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2034, 159, 27, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2035, 159, 24, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2035, 159, 27, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2102, 151, 26, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2102, 153, 26, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2102, 156, 26, 'Relevé / plan BE');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2103, 151, 26, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2107, 153, 26, 'INSTALLER UNE FRAISEUSE');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2107, 156, 26, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2111, 156, 26, 'ALU');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (2113, 156, 26, 'ALU');

-- --------------------------------------------------------

-- 
-- Structure de la table `les_formations`
-- 

CREATE TABLE `les_formations` (
  `id_for` bigint(20) NOT NULL auto_increment,
  `nom` varchar(100) NOT NULL default '',
  `nb_semestres` tinyint(4) NOT NULL default '0',
  `src_fiche_metier` tinytext,
  `secteur` varchar(100) default NULL,
  `niveau` varchar(100) default NULL,
  `date_maj` date NOT NULL default '0000-00-00',
  `id_ens` bigint(20) NOT NULL default '0',
  `id_unite` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_for`),
  KEY `id_unite` (`id_unite`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

-- 
-- Contenu de la table `les_formations`
-- 

INSERT INTO `les_formations` VALUES (13, 'BP CUISINE', 4, '', 'HOTELLERIE', 'IV', 0x323030362d30352d3232, 23322, 8);
INSERT INTO `les_formations` VALUES (14, 'BP RESTAURANT', 4, '', 'HOTELLERIE', 'IV', 0x323030362d30352d3232, 23310, 8);
INSERT INTO `les_formations` VALUES (15, 'CAP PATISSIER - GLACIER - CHOCOLATIER', 4, '', 'PATISSERIE', 'V', 0x323030362d30352d3232, 23319, 8);
INSERT INTO `les_formations` VALUES (16, 'BEP ALIMENTATION OPTION PATISSERIE', 4, '', 'PATISSERIE', 'V', 0x323030362d30352d3232, 23319, 8);
INSERT INTO `les_formations` VALUES (17, 'BP PREPARATEUR EN PHARMACIE', 4, '', 'PHARMACIE', 'IV', 0x323030362d30352d3232, 23326, 8);
INSERT INTO `les_formations` VALUES (18, 'PEINTRE APPLICATEUR', 6, '', 'Finition', '5', 0x323030362d30352d3235, 23378, 7);
INSERT INTO `les_formations` VALUES (19, 'MENUISIER FABRICANT', 6, '', 'Bois', '5', 0x323030362d30372d3032, 23327, 7);
INSERT INTO `les_formations` VALUES (20, 'CARROSSIER - REPARATEUR', 4, '', 'AUTOMOBILE', '5', 0x323030362d30392d3235, 23358, 4);
INSERT INTO `les_formations` VALUES (22, 'Peinture  en  Carrosserie', 2, '', 'Automobile', '5', 0x323030362d30352d3232, 23358, 4);
INSERT INTO `les_formations` VALUES (23, 'BAC PRO METAL ALU VERRE', 2, '', 'BATIMENT', 'IV', 0x323030362d30362d3031, 23371, 5);
INSERT INTO `les_formations` VALUES (24, 'BTS C.P.I (Conception de Produits Industriels)', 4, '', 'INDUSTRIE', 'III', 0x323030362d30392d3232, 23935, 8);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_maitres_apprentissage`
-- 

CREATE TABLE `les_maitres_apprentissage` (
  `id_ma` bigint(20) NOT NULL default '0',
  `id_entr` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_ma`),
  KEY `id_entr` (`id_entr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `les_maitres_apprentissage`
-- 

INSERT INTO `les_maitres_apprentissage` VALUES (23386, 10);
INSERT INTO `les_maitres_apprentissage` VALUES (23437, 10);
INSERT INTO `les_maitres_apprentissage` VALUES (23391, 12);
INSERT INTO `les_maitres_apprentissage` VALUES (23394, 13);
INSERT INTO `les_maitres_apprentissage` VALUES (23397, 14);
INSERT INTO `les_maitres_apprentissage` VALUES (23400, 15);
INSERT INTO `les_maitres_apprentissage` VALUES (23403, 16);
INSERT INTO `les_maitres_apprentissage` VALUES (23411, 18);
INSERT INTO `les_maitres_apprentissage` VALUES (23414, 19);
INSERT INTO `les_maitres_apprentissage` VALUES (23420, 19);
INSERT INTO `les_maitres_apprentissage` VALUES (23417, 20);
INSERT INTO `les_maitres_apprentissage` VALUES (23457, 21);
INSERT INTO `les_maitres_apprentissage` VALUES (23428, 22);
INSERT INTO `les_maitres_apprentissage` VALUES (23431, 23);
INSERT INTO `les_maitres_apprentissage` VALUES (23434, 24);
INSERT INTO `les_maitres_apprentissage` VALUES (23442, 25);
INSERT INTO `les_maitres_apprentissage` VALUES (23448, 26);
INSERT INTO `les_maitres_apprentissage` VALUES (23451, 27);
INSERT INTO `les_maitres_apprentissage` VALUES (23463, 29);
INSERT INTO `les_maitres_apprentissage` VALUES (23466, 30);
INSERT INTO `les_maitres_apprentissage` VALUES (23485, 35);
INSERT INTO `les_maitres_apprentissage` VALUES (23488, 36);
INSERT INTO `les_maitres_apprentissage` VALUES (23494, 38);
INSERT INTO `les_maitres_apprentissage` VALUES (23497, 39);
INSERT INTO `les_maitres_apprentissage` VALUES (23508, 42);
INSERT INTO `les_maitres_apprentissage` VALUES (23511, 43);
INSERT INTO `les_maitres_apprentissage` VALUES (23517, 45);
INSERT INTO `les_maitres_apprentissage` VALUES (23528, 48);
INSERT INTO `les_maitres_apprentissage` VALUES (23557, 55);
INSERT INTO `les_maitres_apprentissage` VALUES (23560, 56);
INSERT INTO `les_maitres_apprentissage` VALUES (23591, 63);
INSERT INTO `les_maitres_apprentissage` VALUES (23594, 64);
INSERT INTO `les_maitres_apprentissage` VALUES (23602, 66);
INSERT INTO `les_maitres_apprentissage` VALUES (23608, 68);
INSERT INTO `les_maitres_apprentissage` VALUES (23613, 69);
INSERT INTO `les_maitres_apprentissage` VALUES (23650, 70);
INSERT INTO `les_maitres_apprentissage` VALUES (23618, 71);
INSERT INTO `les_maitres_apprentissage` VALUES (23621, 72);
INSERT INTO `les_maitres_apprentissage` VALUES (23624, 73);
INSERT INTO `les_maitres_apprentissage` VALUES (23627, 74);
INSERT INTO `les_maitres_apprentissage` VALUES (23632, 75);
INSERT INTO `les_maitres_apprentissage` VALUES (23635, 76);
INSERT INTO `les_maitres_apprentissage` VALUES (23638, 77);
INSERT INTO `les_maitres_apprentissage` VALUES (23706, 77);
INSERT INTO `les_maitres_apprentissage` VALUES (23641, 78);
INSERT INTO `les_maitres_apprentissage` VALUES (23644, 79);
INSERT INTO `les_maitres_apprentissage` VALUES (23647, 80);
INSERT INTO `les_maitres_apprentissage` VALUES (23653, 81);
INSERT INTO `les_maitres_apprentissage` VALUES (23656, 82);
INSERT INTO `les_maitres_apprentissage` VALUES (23723, 82);
INSERT INTO `les_maitres_apprentissage` VALUES (23659, 83);
INSERT INTO `les_maitres_apprentissage` VALUES (23662, 84);
INSERT INTO `les_maitres_apprentissage` VALUES (23718, 84);
INSERT INTO `les_maitres_apprentissage` VALUES (23665, 85);
INSERT INTO `les_maitres_apprentissage` VALUES (23668, 86);
INSERT INTO `les_maitres_apprentissage` VALUES (23671, 87);
INSERT INTO `les_maitres_apprentissage` VALUES (23674, 88);
INSERT INTO `les_maitres_apprentissage` VALUES (23677, 89);
INSERT INTO `les_maitres_apprentissage` VALUES (23700, 89);
INSERT INTO `les_maitres_apprentissage` VALUES (23680, 90);
INSERT INTO `les_maitres_apprentissage` VALUES (23683, 91);
INSERT INTO `les_maitres_apprentissage` VALUES (23686, 92);
INSERT INTO `les_maitres_apprentissage` VALUES (23691, 93);
INSERT INTO `les_maitres_apprentissage` VALUES (23694, 94);
INSERT INTO `les_maitres_apprentissage` VALUES (23697, 95);
INSERT INTO `les_maitres_apprentissage` VALUES (23703, 96);
INSERT INTO `les_maitres_apprentissage` VALUES (23711, 97);
INSERT INTO `les_maitres_apprentissage` VALUES (23724, 98);
INSERT INTO `les_maitres_apprentissage` VALUES (23725, 99);
INSERT INTO `les_maitres_apprentissage` VALUES (23726, 100);
INSERT INTO `les_maitres_apprentissage` VALUES (23727, 101);
INSERT INTO `les_maitres_apprentissage` VALUES (23730, 102);
INSERT INTO `les_maitres_apprentissage` VALUES (23733, 103);
INSERT INTO `les_maitres_apprentissage` VALUES (23736, 104);
INSERT INTO `les_maitres_apprentissage` VALUES (23758, 104);
INSERT INTO `les_maitres_apprentissage` VALUES (23768, 104);
INSERT INTO `les_maitres_apprentissage` VALUES (23783, 104);
INSERT INTO `les_maitres_apprentissage` VALUES (24113, 104);
INSERT INTO `les_maitres_apprentissage` VALUES (23737, 105);
INSERT INTO `les_maitres_apprentissage` VALUES (23818, 105);
INSERT INTO `les_maitres_apprentissage` VALUES (23740, 106);
INSERT INTO `les_maitres_apprentissage` VALUES (23743, 107);
INSERT INTO `les_maitres_apprentissage` VALUES (23746, 108);
INSERT INTO `les_maitres_apprentissage` VALUES (23749, 109);
INSERT INTO `les_maitres_apprentissage` VALUES (23752, 110);
INSERT INTO `les_maitres_apprentissage` VALUES (23755, 111);
INSERT INTO `les_maitres_apprentissage` VALUES (23761, 111);
INSERT INTO `les_maitres_apprentissage` VALUES (23815, 111);
INSERT INTO `les_maitres_apprentissage` VALUES (23764, 112);
INSERT INTO `les_maitres_apprentissage` VALUES (23765, 113);
INSERT INTO `les_maitres_apprentissage` VALUES (23777, 116);
INSERT INTO `les_maitres_apprentissage` VALUES (23789, 119);
INSERT INTO `les_maitres_apprentissage` VALUES (23792, 120);
INSERT INTO `les_maitres_apprentissage` VALUES (23795, 121);
INSERT INTO `les_maitres_apprentissage` VALUES (23798, 122);
INSERT INTO `les_maitres_apprentissage` VALUES (23801, 123);
INSERT INTO `les_maitres_apprentissage` VALUES (23807, 124);
INSERT INTO `les_maitres_apprentissage` VALUES (23812, 125);
INSERT INTO `les_maitres_apprentissage` VALUES (23821, 126);
INSERT INTO `les_maitres_apprentissage` VALUES (23824, 127);
INSERT INTO `les_maitres_apprentissage` VALUES (23828, 128);
INSERT INTO `les_maitres_apprentissage` VALUES (23831, 129);
INSERT INTO `les_maitres_apprentissage` VALUES (23834, 130);
INSERT INTO `les_maitres_apprentissage` VALUES (23873, 130);
INSERT INTO `les_maitres_apprentissage` VALUES (23837, 131);
INSERT INTO `les_maitres_apprentissage` VALUES (23840, 132);
INSERT INTO `les_maitres_apprentissage` VALUES (23843, 133);
INSERT INTO `les_maitres_apprentissage` VALUES (23846, 134);
INSERT INTO `les_maitres_apprentissage` VALUES (23849, 135);
INSERT INTO `les_maitres_apprentissage` VALUES (23852, 136);
INSERT INTO `les_maitres_apprentissage` VALUES (23855, 137);
INSERT INTO `les_maitres_apprentissage` VALUES (23858, 138);
INSERT INTO `les_maitres_apprentissage` VALUES (23860, 139);
INSERT INTO `les_maitres_apprentissage` VALUES (23863, 140);
INSERT INTO `les_maitres_apprentissage` VALUES (23864, 141);
INSERT INTO `les_maitres_apprentissage` VALUES (23867, 142);
INSERT INTO `les_maitres_apprentissage` VALUES (23870, 143);
INSERT INTO `les_maitres_apprentissage` VALUES (23876, 144);
INSERT INTO `les_maitres_apprentissage` VALUES (23879, 145);
INSERT INTO `les_maitres_apprentissage` VALUES (23882, 146);
INSERT INTO `les_maitres_apprentissage` VALUES (23885, 147);
INSERT INTO `les_maitres_apprentissage` VALUES (23889, 148);
INSERT INTO `les_maitres_apprentissage` VALUES (23899, 149);
INSERT INTO `les_maitres_apprentissage` VALUES (23904, 150);
INSERT INTO `les_maitres_apprentissage` VALUES (23908, 150);
INSERT INTO `les_maitres_apprentissage` VALUES (23911, 151);
INSERT INTO `les_maitres_apprentissage` VALUES (23914, 152);
INSERT INTO `les_maitres_apprentissage` VALUES (23919, 153);
INSERT INTO `les_maitres_apprentissage` VALUES (23920, 154);
INSERT INTO `les_maitres_apprentissage` VALUES (23925, 155);
INSERT INTO `les_maitres_apprentissage` VALUES (23926, 156);
INSERT INTO `les_maitres_apprentissage` VALUES (23928, 157);
INSERT INTO `les_maitres_apprentissage` VALUES (23931, 158);
INSERT INTO `les_maitres_apprentissage` VALUES (23936, 160);
INSERT INTO `les_maitres_apprentissage` VALUES (23939, 161);
INSERT INTO `les_maitres_apprentissage` VALUES (23942, 162);
INSERT INTO `les_maitres_apprentissage` VALUES (23945, 163);
INSERT INTO `les_maitres_apprentissage` VALUES (23408, 164);
INSERT INTO `les_maitres_apprentissage` VALUES (23445, 165);
INSERT INTO `les_maitres_apprentissage` VALUES (23952, 166);
INSERT INTO `les_maitres_apprentissage` VALUES (23955, 167);
INSERT INTO `les_maitres_apprentissage` VALUES (23388, 168);
INSERT INTO `les_maitres_apprentissage` VALUES (23425, 169);
INSERT INTO `les_maitres_apprentissage` VALUES (23586, 170);
INSERT INTO `les_maitres_apprentissage` VALUES (23964, 171);
INSERT INTO `les_maitres_apprentissage` VALUES (23969, 172);
INSERT INTO `les_maitres_apprentissage` VALUES (23972, 173);
INSERT INTO `les_maitres_apprentissage` VALUES (23976, 174);
INSERT INTO `les_maitres_apprentissage` VALUES (23979, 175);
INSERT INTO `les_maitres_apprentissage` VALUES (23982, 176);
INSERT INTO `les_maitres_apprentissage` VALUES (23985, 177);
INSERT INTO `les_maitres_apprentissage` VALUES (23988, 178);
INSERT INTO `les_maitres_apprentissage` VALUES (23454, 179);
INSERT INTO `les_maitres_apprentissage` VALUES (23993, 180);
INSERT INTO `les_maitres_apprentissage` VALUES (23996, 181);
INSERT INTO `les_maitres_apprentissage` VALUES (23491, 182);
INSERT INTO `les_maitres_apprentissage` VALUES (23469, 183);
INSERT INTO `les_maitres_apprentissage` VALUES (23480, 184);
INSERT INTO `les_maitres_apprentissage` VALUES (24005, 185);
INSERT INTO `les_maitres_apprentissage` VALUES (24008, 186);
INSERT INTO `les_maitres_apprentissage` VALUES (23568, 187);
INSERT INTO `les_maitres_apprentissage` VALUES (24013, 188);
INSERT INTO `les_maitres_apprentissage` VALUES (23477, 189);
INSERT INTO `les_maitres_apprentissage` VALUES (24018, 190);
INSERT INTO `les_maitres_apprentissage` VALUES (24021, 191);
INSERT INTO `les_maitres_apprentissage` VALUES (23578, 192);
INSERT INTO `les_maitres_apprentissage` VALUES (23531, 193);
INSERT INTO `les_maitres_apprentissage` VALUES (24026, 194);
INSERT INTO `les_maitres_apprentissage` VALUES (24027, 195);
INSERT INTO `les_maitres_apprentissage` VALUES (23474, 196);
INSERT INTO `les_maitres_apprentissage` VALUES (24028, 197);
INSERT INTO `les_maitres_apprentissage` VALUES (23505, 198);
INSERT INTO `les_maitres_apprentissage` VALUES (23514, 199);
INSERT INTO `les_maitres_apprentissage` VALUES (24031, 200);
INSERT INTO `les_maitres_apprentissage` VALUES (24034, 201);
INSERT INTO `les_maitres_apprentissage` VALUES (23460, 202);
INSERT INTO `les_maitres_apprentissage` VALUES (23597, 203);
INSERT INTO `les_maitres_apprentissage` VALUES (23520, 204);
INSERT INTO `les_maitres_apprentissage` VALUES (23605, 205);
INSERT INTO `les_maitres_apprentissage` VALUES (23525, 206);
INSERT INTO `les_maitres_apprentissage` VALUES (23581, 207);
INSERT INTO `les_maitres_apprentissage` VALUES (24045, 208);
INSERT INTO `les_maitres_apprentissage` VALUES (24048, 209);
INSERT INTO `les_maitres_apprentissage` VALUES (24055, 210);
INSERT INTO `les_maitres_apprentissage` VALUES (23554, 211);
INSERT INTO `les_maitres_apprentissage` VALUES (24060, 212);
INSERT INTO `les_maitres_apprentissage` VALUES (23539, 213);
INSERT INTO `les_maitres_apprentissage` VALUES (23565, 214);
INSERT INTO `les_maitres_apprentissage` VALUES (24067, 215);
INSERT INTO `les_maitres_apprentissage` VALUES (23500, 216);
INSERT INTO `les_maitres_apprentissage` VALUES (24072, 217);
INSERT INTO `les_maitres_apprentissage` VALUES (23571, 218);
INSERT INTO `les_maitres_apprentissage` VALUES (23534, 219);
INSERT INTO `les_maitres_apprentissage` VALUES (24077, 220);
INSERT INTO `les_maitres_apprentissage` VALUES (24078, 221);
INSERT INTO `les_maitres_apprentissage` VALUES (24079, 222);
INSERT INTO `les_maitres_apprentissage` VALUES (23548, 223);
INSERT INTO `les_maitres_apprentissage` VALUES (23551, 224);
INSERT INTO `les_maitres_apprentissage` VALUES (24082, 225);
INSERT INTO `les_maitres_apprentissage` VALUES (24085, 226);
INSERT INTO `les_maitres_apprentissage` VALUES (24088, 227);
INSERT INTO `les_maitres_apprentissage` VALUES (24093, 228);
INSERT INTO `les_maitres_apprentissage` VALUES (24096, 229);
INSERT INTO `les_maitres_apprentissage` VALUES (23804, 230);
INSERT INTO `les_maitres_apprentissage` VALUES (24102, 231);
INSERT INTO `les_maitres_apprentissage` VALUES (24105, 232);
INSERT INTO `les_maitres_apprentissage` VALUES (23771, 233);
INSERT INTO `les_maitres_apprentissage` VALUES (23774, 234);
INSERT INTO `les_maitres_apprentissage` VALUES (24110, 235);
INSERT INTO `les_maitres_apprentissage` VALUES (23780, 236);
INSERT INTO `les_maitres_apprentissage` VALUES (23786, 237);
INSERT INTO `les_maitres_apprentissage` VALUES (24116, 238);
INSERT INTO `les_maitres_apprentissage` VALUES (24118, 239);
INSERT INTO `les_maitres_apprentissage` VALUES (24120, 240);
INSERT INTO `les_maitres_apprentissage` VALUES (24122, 241);
INSERT INTO `les_maitres_apprentissage` VALUES (24135, 242);
INSERT INTO `les_maitres_apprentissage` VALUES (24138, 243);
INSERT INTO `les_maitres_apprentissage` VALUES (24141, 244);
INSERT INTO `les_maitres_apprentissage` VALUES (24144, 245);
INSERT INTO `les_maitres_apprentissage` VALUES (24147, 246);
INSERT INTO `les_maitres_apprentissage` VALUES (24150, 247);
INSERT INTO `les_maitres_apprentissage` VALUES (24153, 248);
INSERT INTO `les_maitres_apprentissage` VALUES (24156, 249);
INSERT INTO `les_maitres_apprentissage` VALUES (24159, 250);
INSERT INTO `les_maitres_apprentissage` VALUES (24162, 251);
INSERT INTO `les_maitres_apprentissage` VALUES (24165, 252);
INSERT INTO `les_maitres_apprentissage` VALUES (24168, 253);
INSERT INTO `les_maitres_apprentissage` VALUES (24171, 254);
INSERT INTO `les_maitres_apprentissage` VALUES (24174, 255);
INSERT INTO `les_maitres_apprentissage` VALUES (24177, 256);
INSERT INTO `les_maitres_apprentissage` VALUES (24180, 257);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_messages`
-- 

CREATE TABLE `les_messages` (
  `id_msg` bigint(20) NOT NULL auto_increment,
  `objet` tinytext NOT NULL,
  `message` text NOT NULL,
  `date_creation` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `date_expiration` date NOT NULL default '0000-00-00',
  `fichier_joint` tinytext NOT NULL,
  `id_usager` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_msg`),
  KEY `id_usager` (`id_usager`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

-- 
-- Contenu de la table `les_messages`
-- 

INSERT INTO `les_messages` VALUES (1, 'Mot de passe', 'Bonjour,\r\n\r\nMerci de  modifier votre mot de passe par défaut.\r\n\r\nFouzi Amier', 0x323030362d30352d32322031343a33323a3139, 0x303030302d30302d3030, '', 23157);
INSERT INTO `les_messages` VALUES (2, 'Utilisation du livret d''apprentissage', 'Bienvenue sur LEA.', 0x323030362d30352d32332032303a30323a3139, 0x303030302d30302d3030, '', 23322);
INSERT INTO `les_messages` VALUES (9, 'test', 'test', 0x323030362d30362d32302031353a34303a3236, 0x303030302d30302d3030, '', 23900);
INSERT INTO `les_messages` VALUES (10, 'Vous avez été ajouté à l''espace : espace de test', 'Vous avez été ajouté à l''espace : espace de test.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', 0x323030362d30362d32392031303a35393a3135, 0x303030302d30302d3030, '', 23305);
INSERT INTO `les_messages` VALUES (11, 'Vous avez été ajouté à l''espace : espace de test', 'Vous avez été ajouté à l''espace : espace de test.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', 0x323030362d30362d32392031313a30363a3338, 0x303030302d30302d3030, '', 23305);
INSERT INTO `les_messages` VALUES (12, 'Vous avez été supprimé de l''espace : espace de test', 'Vous avez été supprimé de l''espace : espace de test.\n\r\n					Contacter le créateur de l''espace pour de plus amples informations.', 0x323030362d30362d32392031313a30363a3338, 0x303030302d30302d3030, '', 23305);
INSERT INTO `les_messages` VALUES (13, 'Nouveauté sur l''espace : espace de test', 'Du nouveau contenu à été ajouté à l''espace : espace de test', 0x323030362d30362d32392031313a30373a3034, 0x303030302d30302d3030, '', 23305);
INSERT INTO `les_messages` VALUES (14, 'Vous avez été ajouté à l''espace : aa', 'Vous avez été ajouté à l''espace : aa.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', 0x323030362d30362d32392031333a33353a3233, 0x303030302d30302d3030, '', 23818);
INSERT INTO `les_messages` VALUES (15, 'Espace aa supprimé', 'L''espace aa a été supprimé.\n\r\n					Contacter le créateur de l''espace pour de plus amples informations.', 0x323030362d30362d32392031333a33353a3537, 0x303030302d30302d3030, '', 23818);
INSERT INTO `les_messages` VALUES (16, 'Vous avez été ajouté à l''espace : mes documents', 'Vous avez été ajouté à l''espace : mes documents.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', 0x323030362d30362d33302030383a34353a3138, 0x303030302d30302d3030, '', 23901);
INSERT INTO `les_messages` VALUES (17, 'Nouveauté sur l''espace : mes documents', 'Du nouveau contenu à été ajouté à l''espace : mes documents', 0x323030362d30362d33302030383a34353a3338, 0x303030302d30302d3030, '', 23901);
INSERT INTO `les_messages` VALUES (18, 'modif emploi du temps semaine 32', 'Consulter votre nouvel emploi du temps', 0x323030362d30362d33302030393a30323a3034, 0x303030302d30302d3030, '', 23371);
INSERT INTO `les_messages` VALUES (20, 'Utilisation LEA', 'Fabien,\r\nnous travaillons actuellement sur le LEA. Des changements seront effectués, donc pas d''inquiétudes pour l''instant.\r\nBon courage.\r\nM. Delhommeau', 0x323030362d30362d33302030393a31323a3530, 0x303030302d30302d3030, '', 23322);
INSERT INTO `les_messages` VALUES (22, 'Vous avez été ajouté à l''espace : mes documents', 'Vous avez été ajouté à l''espace : mes documents.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', 0x323030362d30362d33302031303a34353a3038, 0x303030302d30302d3030, '', 23901);
INSERT INTO `les_messages` VALUES (23, 'Vous avez été supprimé de l''espace : mes documents', 'Vous avez été supprimé de l''espace : mes documents.\n\r\n					Contacter le créateur de l''espace pour de plus amples informations.', 0x323030362d30362d33302031303a34353a3038, 0x303030302d30302d3030, '', 23901);
INSERT INTO `les_messages` VALUES (24, 'Vous avez été ajouté à l''espace : espace de teste', 'Vous avez été ajouté à l''espace : espace de teste.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', 0x323030362d30362d33302031313a32393a3432, 0x303030302d30302d3030, '', 23378);
INSERT INTO `les_messages` VALUES (25, 'Nouveauté sur l''espace : espace de teste', 'Du nouveau contenu à été ajouté à l''espace : espace de teste', 0x323030362d30362d33302031313a32393a3530, 0x303030302d30302d3030, '', 23378);
INSERT INTO `les_messages` VALUES (26, 'Espace espace de teste supprimé', 'L''espace espace de teste a été supprimé.\n\r\n					Contacter le créateur de l''espace pour de plus amples informations.', 0x323030362d30362d33302031313a33303a3338, 0x303030302d30302d3030, '', 23378);
INSERT INTO `les_messages` VALUES (27, 'Vous avez été ajouté à l''espace : sfsf', 'Vous avez été ajouté à l''espace : sfsf.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', 0x323030362d30362d33302031353a33303a3034, 0x303030302d30302d3030, '', 23378);
INSERT INTO `les_messages` VALUES (28, 'Vous avez été ajouté à l''espace : sfsf', 'Vous avez été ajouté à l''espace : sfsf.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', 0x323030362d30362d33302031353a33303a3132, 0x303030302d30302d3030, '', 23378);
INSERT INTO `les_messages` VALUES (29, 'Vous avez été supprimé de l''espace : sfsf', 'Vous avez été supprimé de l''espace : sfsf.\n\r\n					Contacter le créateur de l''espace pour de plus amples informations.', 0x323030362d30362d33302031353a33303a3132, 0x303030302d30302d3030, '', 23378);
INSERT INTO `les_messages` VALUES (30, 'Espace sfsf supprimé', 'L''espace sfsf a été supprimé.\n\r\n					Contacter le créateur de l''espace pour de plus amples informations.', 0x323030362d30362d33302031353a33303a3230, 0x303030302d30302d3030, '', 23378);
INSERT INTO `les_messages` VALUES (32, 'Vous avez été ajouté à l''espace : Relation Tuteur', 'Vous avez été ajouté à l''espace : Relation Tuteur.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', 0x323030362d30372d30342031383a35333a3332, 0x303030302d30302d3030, '', 23828);
INSERT INTO `les_messages` VALUES (33, 'Vous avez été ajouté à l''espace : Infos Pratiques / MA', 'Vous avez été ajouté à l''espace : Infos Pratiques / MA.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', 0x323030362d30392d31322032323a33353a3237, 0x303030302d30302d3030, '', 23371);
INSERT INTO `les_messages` VALUES (34, 'Vous avez été ajouté à l''espace : Infos Pratiques / Apprentis MAV 1', 'Vous avez été ajouté à l''espace : Infos Pratiques / Apprentis MAV 1.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', 0x323030362d30392d31332031303a30363a3037, 0x303030302d30302d3030, '', 23371);
INSERT INTO `les_messages` VALUES (35, 'modif', 'modif sem 15', 0x323030362d30392d31332031303a30383a3432, 0x303030302d30302d3030, '', 23371);
INSERT INTO `les_messages` VALUES (38, 'Vous avez été ajouté à l''espace : sdfsdf\\''fsdf', 'Vous avez été ajouté à l''espace : sdfsdf\\''fsdf.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', 0x323030362d30392d32302031373a33353a3135, 0x303030302d30302d3030, '', 23371);
INSERT INTO `les_messages` VALUES (39, 'Vous avez été ajouté à l''espace : sdf', 'Vous avez été ajouté à l''espace : sdf.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', 0x323030362d30392d32302031373a33353a3337, 0x303030302d30302d3030, '', 23371);
INSERT INTO `les_messages` VALUES (40, 'Vous avez été supprimé de l''espace : sdf', 'Vous avez été supprimé de l''espace : sdf.\n\r\n					Contacter le créateur de l''espace pour de plus amples informations.', 0x323030362d30392d32302031373a33353a3337, 0x303030302d30302d3030, '', 23371);
INSERT INTO `les_messages` VALUES (41, 'Modification de l''espace : sdfsdf''fsdf', 'L''espace sdfsdf''fsdf a changé de nom en sdf.', 0x323030362d30392d32302031373a33353a3337, 0x303030302d30302d3030, '', 23371);
INSERT INTO `les_messages` VALUES (42, 'Espace sdf supprimé', 'L''espace sdf a été supprimé.\n\r\n					Contacter le créateur de l''espace pour de plus amples informations.', 0x323030362d30392d32302031373a33353a3434, 0x303030302d30302d3030, '', 23371);
INSERT INTO `les_messages` VALUES (44, 'Vous avez été ajouté à l''espace : freddy.g', 'Vous avez été ajouté à l''espace : freddy.g.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', 0x323030362d30392d32312030383a32353a3034, 0x303030302d30302d3030, '', 23944);
INSERT INTO `les_messages` VALUES (45, 'Espace freddy.g supprimé', 'L''espace freddy.g a été supprimé.\n\r\n					Contacter le créateur de l''espace pour de plus amples informations.', 0x323030362d30392d32312030383a32363a3430, 0x303030302d30302d3030, '', 23944);
INSERT INTO `les_messages` VALUES (46, 'modif edt', 'Attention !\r\n\r\nModif séance atelier \r\n\r\nLundi 2 octobre au lieu du mardi 3\r\n\r\nPensez a vos tenue de travail!', 0x323030362d30392d32312031303a32363a3139, 0x303030302d30302d3030, '', 23371);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_messages_recus_usagers`
-- 

CREATE TABLE `les_messages_recus_usagers` (
  `id_msg` bigint(20) NOT NULL default '0',
  `id_usager` bigint(20) NOT NULL default '0',
  `lecture` char(3) NOT NULL default 'NON',
  `reponse` char(3) NOT NULL default 'NON',
  PRIMARY KEY  (`id_msg`,`id_usager`),
  KEY `id_usager` (`id_usager`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `les_messages_recus_usagers`
-- 

INSERT INTO `les_messages_recus_usagers` VALUES (1, 23189, 'OUI', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (2, 23387, 'OUI', 'OUI');
INSERT INTO `les_messages_recus_usagers` VALUES (2, 23390, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (2, 23393, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (2, 23396, 'OUI', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (2, 23399, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (2, 23402, 'OUI', 'OUI');
INSERT INTO `les_messages_recus_usagers` VALUES (2, 23405, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (2, 23407, 'OUI', 'OUI');
INSERT INTO `les_messages_recus_usagers` VALUES (10, 23283, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (10, 23291, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (10, 23293, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (13, 23283, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (13, 23291, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (13, 23293, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (16, 23899, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (17, 23899, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (18, 23901, 'OUI', 'OUI');
INSERT INTO `les_messages_recus_usagers` VALUES (18, 23903, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (18, 23907, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (18, 23910, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (18, 23913, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (18, 23916, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (18, 23918, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (20, 23407, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (24, 23830, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (25, 23830, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (26, 23830, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (27, 23284, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (27, 23306, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (27, 23311, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (27, 23315, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (27, 23831, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (30, 23284, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (30, 23306, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (30, 23311, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (30, 23315, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (30, 23831, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (32, 23352, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (32, 23830, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (33, 23899, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (33, 23904, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (33, 23908, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (33, 23911, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (33, 23914, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (33, 23920, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (33, 23926, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (33, 23928, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (33, 23931, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (34, 23607, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (34, 23901, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (34, 23903, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (34, 23907, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (34, 23910, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (34, 23913, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (34, 23916, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (34, 23918, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (34, 23922, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (34, 23924, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (34, 23930, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (34, 23933, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (35, 23607, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (35, 23901, 'OUI', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (35, 23903, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (35, 23907, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (35, 23910, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (35, 23913, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (35, 23916, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (35, 23918, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (35, 23922, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (35, 23924, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (35, 23930, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (35, 23933, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (46, 23938, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (46, 23941, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (46, 23944, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (46, 23947, 'OUI', 'NON');

-- --------------------------------------------------------

-- 
-- Structure de la table `les_modalites_reponse_choix`
-- 

CREATE TABLE `les_modalites_reponse_choix` (
  `id_modalite` bigint(20) NOT NULL auto_increment,
  `libelle` varchar(250) NOT NULL default '',
  `acteur` varchar(30) NOT NULL default '',
  `type_suivi` varchar(30) NOT NULL default '',
  `type_choix` varchar(30) NOT NULL default '',
  `id_config` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_modalite`),
  KEY `id_config` (`id_config`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- 
-- Contenu de la table `les_modalites_reponse_choix`
-- 

INSERT INTO `les_modalites_reponse_choix` VALUES (5, 'EVALUATION DU MAITRE D''APPRENTISSAGE SUR LA PERIODE', 'ma', 'entr', 'unique', 5);
INSERT INTO `les_modalites_reponse_choix` VALUES (6, 'EVALUATION DE L''APPRENTI AU CFA SUR LA PERIODE', 'tuteur_cfa', 'cfa', 'unique', 5);
INSERT INTO `les_modalites_reponse_choix` VALUES (8, 'Connaissances', 'app', 'entr', 'unique', 10);
INSERT INTO `les_modalites_reponse_choix` VALUES (9, 'Avis du Maître d''apprentissage', 'ma', 'entr', 'unique', 10);
INSERT INTO `les_modalites_reponse_choix` VALUES (10, 'Pratique', 'app', 'cfa', 'multiple', 6);
INSERT INTO `les_modalites_reponse_choix` VALUES (11, 'Aquisition d''une technique', 'ma', 'entr', 'unique', 6);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_modalites_reponse_libre`
-- 

CREATE TABLE `les_modalites_reponse_libre` (
  `id_modalite` bigint(20) NOT NULL auto_increment,
  `libelle` varchar(250) NOT NULL default '',
  `acteur` varchar(30) NOT NULL default '',
  `type_suivi` varchar(30) NOT NULL default '',
  `id_config` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_modalite`),
  KEY `id_config` (`id_config`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

-- 
-- Contenu de la table `les_modalites_reponse_libre`
-- 

INSERT INTO `les_modalites_reponse_libre` VALUES (13, 'APPRECIATION DU MAITRE D''APPRENTISSAGE SUR LA PERIODE', 'ma', 'entr', 5);
INSERT INTO `les_modalites_reponse_libre` VALUES (17, 'APPRECIATION DU FORMATEUR CUISINE AU CFA', 'tuteur_cfa', 'cfa', 5);
INSERT INTO `les_modalites_reponse_libre` VALUES (21, 'Observations du Maître d''apprentissage', 'ma', 'entr', 10);
INSERT INTO `les_modalites_reponse_libre` VALUES (22, 'Observations Tuteur CFA', 'tuteur_cfa', 'entr', 10);
INSERT INTO `les_modalites_reponse_libre` VALUES (23, 'Avis des Parents', 'rl', 'entr', 10);
INSERT INTO `les_modalites_reponse_libre` VALUES (24, 'Observations du Maître d''apprentissage', 'ma', 'cfa', 10);
INSERT INTO `les_modalites_reponse_libre` VALUES (25, 'Observation et avis Responsable de formation', 'rf', 'cfa', 10);
INSERT INTO `les_modalites_reponse_libre` VALUES (26, 'Avis des Parents', 'rl', 'cfa', 10);
INSERT INTO `les_modalites_reponse_libre` VALUES (27, 'Observations Tuteur CFA', 'tuteur_cfa', 'cfa', 10);
INSERT INTO `les_modalites_reponse_libre` VALUES (28, 'Commentaires de l''apprenti(e)', 'app', 'cfa', 10);
INSERT INTO `les_modalites_reponse_libre` VALUES (29, 'Observation et avis Responsable de formation', 'rf', 'entr', 10);
INSERT INTO `les_modalites_reponse_libre` VALUES (30, 'avis du maître d''apprentissage', 'ma', 'entr', 12);
INSERT INTO `les_modalites_reponse_libre` VALUES (31, 'Commentaires Apprenti(e)', 'app', 'entr', 10);
INSERT INTO `les_modalites_reponse_libre` VALUES (33, 'Avis des Professeurs', 'ens', 'cfa', 10);
INSERT INTO `les_modalites_reponse_libre` VALUES (37, 'remarque(s)', 'app', 'entr', 13);
INSERT INTO `les_modalites_reponse_libre` VALUES (38, 'question(s) technique(s)', 'app', 'entr', 13);
INSERT INTO `les_modalites_reponse_libre` VALUES (39, 'difficulté(s) rencontrée(s)', 'app', 'entr', 13);
INSERT INTO `les_modalites_reponse_libre` VALUES (41, 'divers', 'app', 'cfa', 13);
INSERT INTO `les_modalites_reponse_libre` VALUES (43, 'MATHEMATIQUES', 'app', 'cfa', 11);
INSERT INTO `les_modalites_reponse_libre` VALUES (44, 'CONSTRUCTION-D.A.O.', 'app', 'cfa', 11);
INSERT INTO `les_modalites_reponse_libre` VALUES (45, 'FRANCAIS', 'app', 'cfa', 11);
INSERT INTO `les_modalites_reponse_libre` VALUES (46, 'SCIENCES-PHYSIQUES', 'app', 'cfa', 11);
INSERT INTO `les_modalites_reponse_libre` VALUES (47, 'HISTOIRE-GEOGRAPHIE', 'app', 'cfa', 11);
INSERT INTO `les_modalites_reponse_libre` VALUES (48, 'LANGUE ETRANGERE', 'app', 'cfa', 11);
INSERT INTO `les_modalites_reponse_libre` VALUES (49, 'COMMENTAIRES  DES  ENSEIGNANTS', 'ens', 'cfa', 11);
INSERT INTO `les_modalites_reponse_libre` VALUES (50, 'COMMENTAIRES', 'ma', 'entr', 11);
INSERT INTO `les_modalites_reponse_libre` VALUES (51, 'commentaire', 'app', 'cfa', 12);
INSERT INTO `les_modalites_reponse_libre` VALUES (52, 'commentaire', 'app', 'entr', 12);
INSERT INTO `les_modalites_reponse_libre` VALUES (53, 'commentaire sur le travail en entreprise de la période', 'ma', 'entr', 12);
INSERT INTO `les_modalites_reponse_libre` VALUES (54, 'commentaire', 'app', 'entr', 7);
INSERT INTO `les_modalites_reponse_libre` VALUES (55, 'Français', 'app', 'cfa', 7);
INSERT INTO `les_modalites_reponse_libre` VALUES (56, 'Art appliqué', 'app', 'cfa', 7);
INSERT INTO `les_modalites_reponse_libre` VALUES (57, 'EPS', 'app', 'cfa', 7);
INSERT INTO `les_modalites_reponse_libre` VALUES (58, 'Technologie', 'app', 'cfa', 7);
INSERT INTO `les_modalites_reponse_libre` VALUES (59, 'CEEJ', 'app', 'cfa', 7);
INSERT INTO `les_modalites_reponse_libre` VALUES (60, 'Sciences appliquées', 'app', 'cfa', 7);
INSERT INTO `les_modalites_reponse_libre` VALUES (61, 'VSP', 'app', 'cfa', 7);
INSERT INTO `les_modalites_reponse_libre` VALUES (62, 'Histoire géographie', 'app', 'cfa', 7);
INSERT INTO `les_modalites_reponse_libre` VALUES (63, 'Anglais', 'app', 'cfa', 7);
INSERT INTO `les_modalites_reponse_libre` VALUES (64, 'APPRECIATION(S) DU RESPONSABLE EN ENTREPRISE :', 'ma', 'cfa', 11);
INSERT INTO `les_modalites_reponse_libre` VALUES (65, 'Organisation & Technologie', 'app', 'cfa', 6);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_modalites_va_multiple`
-- 

CREATE TABLE `les_modalites_va_multiple` (
  `id_modalite` bigint(20) NOT NULL auto_increment,
  `libelle` varchar(100) NOT NULL default '',
  `type_choix` varchar(10) NOT NULL default '',
  `acteur` varchar(20) NOT NULL default '',
  `id_arbre` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_modalite`),
  KEY `id_arbre` (`id_arbre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

-- 
-- Contenu de la table `les_modalites_va_multiple`
-- 

INSERT INTO `les_modalites_va_multiple` VALUES (18, 'Autoévaluation', 'unique', 'app', 58);
INSERT INTO `les_modalites_va_multiple` VALUES (22, 'Travail effectué', 'multiple', 'app', 65);
INSERT INTO `les_modalites_va_multiple` VALUES (23, 'Critères d''acquisition', 'unique', 'app', 70);
INSERT INTO `les_modalites_va_multiple` VALUES (27, 'CRITERES D'' ACQUISITION', 'unique', 'app', 79);
INSERT INTO `les_modalites_va_multiple` VALUES (28, 'APPRECIATION(S) DU RESPONSABLE EN ENTREPRISE', 'unique', 'ma', 70);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_modalites_va_unique`
-- 

CREATE TABLE `les_modalites_va_unique` (
  `id_modalite` bigint(20) NOT NULL auto_increment,
  `libelle` varchar(100) NOT NULL default '',
  `acteur` varchar(20) NOT NULL default '',
  `type_reponse` varchar(10) NOT NULL default 'texte',
  `id_arbre` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_modalite`),
  KEY `id_arbre` (`id_arbre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

-- 
-- Contenu de la table `les_modalites_va_unique`
-- 

INSERT INTO `les_modalites_va_unique` VALUES (10, 'Observations Tuteur CFA', 'tuteur_cfa', 'texte', 58);
INSERT INTO `les_modalites_va_unique` VALUES (12, 'Notation', 'ens', 'note', 58);
INSERT INTO `les_modalites_va_unique` VALUES (13, 'Appréciations et commentaires', 'ens', 'texte', 58);
INSERT INTO `les_modalites_va_unique` VALUES (17, 'Nombre de fois', 'app', 'frequence', 55);
INSERT INTO `les_modalites_va_unique` VALUES (20, 'Validation des tâches Par le Maître d''apprentissage', 'ma', 'note', 55);
INSERT INTO `les_modalites_va_unique` VALUES (24, 'INFORMATIONS COMPLEMENTAIRES', 'app', 'texte', 70);
INSERT INTO `les_modalites_va_unique` VALUES (26, 'INFORMATIONS COMPLEMENTAIRES', 'app', 'texte', 79);
INSERT INTO `les_modalites_va_unique` VALUES (27, 'COMMENTAIRES', 'ma', 'texte', 70);
INSERT INTO `les_modalites_va_unique` VALUES (29, 'acquisition des techniques', 'app', 'frequence', 54);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_niveaux_arbre`
-- 

CREATE TABLE `les_niveaux_arbre` (
  `no` smallint(5) unsigned NOT NULL default '1',
  `libelle` varchar(100) NOT NULL default '',
  `id_arbre` bigint(20) NOT NULL default '0',
  KEY `id_arbre` (`id_arbre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `les_niveaux_arbre`
-- 

INSERT INTO `les_niveaux_arbre` VALUES (1, 'FONCTIONS', 49);
INSERT INTO `les_niveaux_arbre` VALUES (2, 'ACTIVITES', 49);
INSERT INTO `les_niveaux_arbre` VALUES (3, 'TECHNIQUES', 49);
INSERT INTO `les_niveaux_arbre` VALUES (1, 'FONCTIONS', 53);
INSERT INTO `les_niveaux_arbre` VALUES (2, 'ACTIVITES', 53);
INSERT INTO `les_niveaux_arbre` VALUES (3, 'TECHNIQUES', 53);
INSERT INTO `les_niveaux_arbre` VALUES (1, 'Semaine', 54);
INSERT INTO `les_niveaux_arbre` VALUES (2, 'Intitulé', 54);
INSERT INTO `les_niveaux_arbre` VALUES (3, 'Savoir faire et connaissances', 54);
INSERT INTO `les_niveaux_arbre` VALUES (1, 'Activités', 55);
INSERT INTO `les_niveaux_arbre` VALUES (2, 'Tâches', 55);
INSERT INTO `les_niveaux_arbre` VALUES (1, 'Matières', 58);
INSERT INTO `les_niveaux_arbre` VALUES (2, 'Enseignement', 58);
INSERT INTO `les_niveaux_arbre` VALUES (3, 'Notation', 58);
INSERT INTO `les_niveaux_arbre` VALUES (1, 'matière', 59);
INSERT INTO `les_niveaux_arbre` VALUES (2, 'chapitre', 59);
INSERT INTO `les_niveaux_arbre` VALUES (3, 'thème', 59);
INSERT INTO `les_niveaux_arbre` VALUES (1, 'fonction', 61);
INSERT INTO `les_niveaux_arbre` VALUES (2, 'compétence', 61);
INSERT INTO `les_niveaux_arbre` VALUES (3, 'tâche', 61);
INSERT INTO `les_niveaux_arbre` VALUES (1, 'Capacités', 65);
INSERT INTO `les_niveaux_arbre` VALUES (2, 'Compétences', 65);
INSERT INTO `les_niveaux_arbre` VALUES (3, 'tâches', 65);
INSERT INTO `les_niveaux_arbre` VALUES (1, 'matière', 67);
INSERT INTO `les_niveaux_arbre` VALUES (2, 'activité/chapitre', 67);
INSERT INTO `les_niveaux_arbre` VALUES (1, 'ACTIVITES', 70);
INSERT INTO `les_niveaux_arbre` VALUES (2, 'TACHES', 70);
INSERT INTO `les_niveaux_arbre` VALUES (3, 'SOUS-TACHES', 70);
INSERT INTO `les_niveaux_arbre` VALUES (1, 'LE DROIT DU TRAVAIL', 78);
INSERT INTO `les_niveaux_arbre` VALUES (2, 'LE DROIT SOCIAL', 78);
INSERT INTO `les_niveaux_arbre` VALUES (1, 'ACTIVITES', 79);
INSERT INTO `les_niveaux_arbre` VALUES (2, 'TACHES', 79);
INSERT INTO `les_niveaux_arbre` VALUES (3, 'SOUS-TACHES', 79);
INSERT INTO `les_niveaux_arbre` VALUES (1, 'Domaines professionnels', 80);
INSERT INTO `les_niveaux_arbre` VALUES (2, 'Tâches', 80);
INSERT INTO `les_niveaux_arbre` VALUES (1, 'Activités', 81);
INSERT INTO `les_niveaux_arbre` VALUES (2, 'Tâches', 81);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_noeuds`
-- 

CREATE TABLE `les_noeuds` (
  `id_noeud` bigint(20) NOT NULL auto_increment,
  `libelle` varchar(250) NOT NULL default '',
  `type` varchar(10) NOT NULL default 'branche',
  `id_noeud_parent` bigint(20) default NULL,
  `id_arbre` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_noeud`),
  KEY `id_arbre` (`id_arbre`),
  KEY `id_noeud_parent` (`id_noeud_parent`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=2156 ;

-- 
-- Contenu de la table `les_noeuds`
-- 

INSERT INTO `les_noeuds` VALUES (678, 'CONCEVOIR', 'branche', 0, 49);
INSERT INTO `les_noeuds` VALUES (679, 'Réaliser des fabrications', 'feuille', 678, 49);
INSERT INTO `les_noeuds` VALUES (680, 'Organiser sontravail en respectant une fiche technique', 'feuille', 678, 49);
INSERT INTO `les_noeuds` VALUES (681, 'Réaliser des sauces émulsionnées', 'feuille', 678, 49);
INSERT INTO `les_noeuds` VALUES (682, 'Réaliser des fonds de base', 'feuille', 678, 49);
INSERT INTO `les_noeuds` VALUES (683, 'Utilisaer rationnellement des produits', 'feuille', 678, 49);
INSERT INTO `les_noeuds` VALUES (684, 'Réaliser des fabrications à partir de produits semi-élaborés', 'feuille', 678, 49);
INSERT INTO `les_noeuds` VALUES (685, 'Assurer des préparations et des cuissons en limitant les apports caloriques', 'feuille', 678, 49);
INSERT INTO `les_noeuds` VALUES (686, 'Réaliser des potages et leurs dérivés', 'feuille', 678, 49);
INSERT INTO `les_noeuds` VALUES (687, 'Concevoir des recettes régionales à partir de fiches techniques', 'feuille', 678, 49);
INSERT INTO `les_noeuds` VALUES (688, 'Réaliser des buffets et des cocktails', 'feuille', 678, 49);
INSERT INTO `les_noeuds` VALUES (689, 'Réaliser harmonieusement des préparations', 'feuille', 678, 49);
INSERT INTO `les_noeuds` VALUES (690, 'ORGANISER', 'branche', 0, 49);
INSERT INTO `les_noeuds` VALUES (691, 'Préparer les marchandises et le matériel', 'feuille', 690, 49);
INSERT INTO `les_noeuds` VALUES (692, 'Prévoir les approvisionnements en fonction de la production', 'feuille', 690, 49);
INSERT INTO `les_noeuds` VALUES (693, 'Dresser une liste de matériel et de marchandises', 'feuille', 690, 49);
INSERT INTO `les_noeuds` VALUES (694, 'Organiser un poste, des tâches', 'feuille', 690, 49);
INSERT INTO `les_noeuds` VALUES (695, 'Distribuer des tâches avec un support écrit', 'feuille', 690, 49);
INSERT INTO `les_noeuds` VALUES (696, 'Diriger un commis', 'feuille', 690, 49);
INSERT INTO `les_noeuds` VALUES (697, 'PREPARER PRELIMINAIREMENT', 'branche', 0, 49);
INSERT INTO `les_noeuds` VALUES (698, 'Habiller un poisson', 'feuille', 697, 49);
INSERT INTO `les_noeuds` VALUES (699, 'Tailler des légumes', 'feuille', 697, 49);
INSERT INTO `les_noeuds` VALUES (700, 'Tourner des légumes', 'feuille', 697, 49);
INSERT INTO `les_noeuds` VALUES (701, 'Habiller une volaille', 'feuille', 697, 49);
INSERT INTO `les_noeuds` VALUES (702, 'Brider une volaille', 'feuille', 697, 49);
INSERT INTO `les_noeuds` VALUES (703, 'Découper une volaille à cru', 'feuille', 697, 49);
INSERT INTO `les_noeuds` VALUES (704, 'Désarêter et farcir un poisson rond par le dos', 'feuille', 697, 49);
INSERT INTO `les_noeuds` VALUES (705, 'Désarêter et farcir un poisson plat', 'feuille', 697, 49);
INSERT INTO `les_noeuds` VALUES (706, 'Parer et détailler des steaks', 'feuille', 697, 49);
INSERT INTO `les_noeuds` VALUES (707, 'Habiller et désosser un carré', 'feuille', 697, 49);
INSERT INTO `les_noeuds` VALUES (708, 'Habiller et ficeler une pièce de viande', 'feuille', 697, 49);
INSERT INTO `les_noeuds` VALUES (709, 'Détailler des darnes', 'feuille', 697, 49);
INSERT INTO `les_noeuds` VALUES (710, 'étailler des tronçons', 'feuille', 697, 49);
INSERT INTO `les_noeuds` VALUES (711, 'Lever des poissons plats', 'feuille', 697, 49);
INSERT INTO `les_noeuds` VALUES (712, 'Lever des poissons ronds', 'feuille', 697, 49);
INSERT INTO `les_noeuds` VALUES (713, 'Monder des poivrons', 'feuille', 697, 49);
INSERT INTO `les_noeuds` VALUES (714, 'Préparer préliminairementdes abats', 'feuille', 697, 49);
INSERT INTO `les_noeuds` VALUES (715, 'Désosser un gigot', 'feuille', 697, 49);
INSERT INTO `les_noeuds` VALUES (716, 'Détailler des escalopes', 'feuille', 697, 49);
INSERT INTO `les_noeuds` VALUES (717, 'Préparer préliminairement des coquillages', 'feuille', 697, 49);
INSERT INTO `les_noeuds` VALUES (718, 'MENER DES CUISSONS', 'branche', 0, 49);
INSERT INTO `les_noeuds` VALUES (719, 'Cuire des omelettes roulées et plates', 'feuille', 718, 49);
INSERT INTO `les_noeuds` VALUES (720, 'Cuire au bleu', 'feuille', 718, 49);
INSERT INTO `les_noeuds` VALUES (721, 'Cuire une préparation panée', 'feuille', 718, 49);
INSERT INTO `les_noeuds` VALUES (722, 'Cuire des fruits', 'feuille', 718, 49);
INSERT INTO `les_noeuds` VALUES (723, 'Cuire un riz composé', 'feuille', 718, 49);
INSERT INTO `les_noeuds` VALUES (724, 'Cuire des légumes secs', 'feuille', 718, 49);
INSERT INTO `les_noeuds` VALUES (725, 'Braiser à brun', 'feuille', 718, 49);
INSERT INTO `les_noeuds` VALUES (726, 'Braiser à blanc', 'feuille', 718, 49);
INSERT INTO `les_noeuds` VALUES (727, 'Cuire de la semoule', 'feuille', 718, 49);
INSERT INTO `les_noeuds` VALUES (728, 'Cuire au repère', 'feuille', 718, 49);
INSERT INTO `les_noeuds` VALUES (729, 'Confire des viandes (gésiers, canard, etc.)', 'feuille', 718, 49);
INSERT INTO `les_noeuds` VALUES (730, 'Confire des fruits', 'feuille', 718, 49);
INSERT INTO `les_noeuds` VALUES (731, 'Grilles des grosses pièces (volaille, etc.)', 'feuille', 718, 49);
INSERT INTO `les_noeuds` VALUES (732, 'Pocher des oeufs', 'feuille', 718, 49);
INSERT INTO `les_noeuds` VALUES (733, 'Cuire des oeufs mollets', 'feuille', 718, 49);
INSERT INTO `les_noeuds` VALUES (734, 'Sauter des viandes', 'feuille', 718, 49);
INSERT INTO `les_noeuds` VALUES (735, 'Pocher', 'feuille', 718, 49);
INSERT INTO `les_noeuds` VALUES (736, 'Cuire des abats', 'feuille', 718, 49);
INSERT INTO `les_noeuds` VALUES (737, 'Cuire des PCA', 'feuille', 718, 49);
INSERT INTO `les_noeuds` VALUES (738, 'Réaliser des soufflés', 'feuille', 718, 49);
INSERT INTO `les_noeuds` VALUES (739, 'Cuire une pomme duchesse', 'feuille', 718, 49);
INSERT INTO `les_noeuds` VALUES (740, 'Mener une clarification', 'feuille', 718, 49);
INSERT INTO `les_noeuds` VALUES (741, 'Griller', 'feuille', 718, 49);
INSERT INTO `les_noeuds` VALUES (742, 'Glacer des légumes (à blanc, à blond, à brun)', 'feuille', 718, 49);
INSERT INTO `les_noeuds` VALUES (743, 'Rôtir', 'feuille', 718, 49);
INSERT INTO `les_noeuds` VALUES (744, 'Mener une cuisson en gratin', 'feuille', 718, 49);
INSERT INTO `les_noeuds` VALUES (745, 'Cuire des coquillages', 'feuille', 718, 49);
INSERT INTO `les_noeuds` VALUES (746, 'Pocher des fruits', 'feuille', 718, 49);
INSERT INTO `les_noeuds` VALUES (747, 'Frire', 'feuille', 718, 49);
INSERT INTO `les_noeuds` VALUES (748, 'Frire des oeufs', 'feuille', 718, 49);
INSERT INTO `les_noeuds` VALUES (749, 'REALISER DES APPAREILS, DES FONDS, DES SAUCES', 'branche', 0, 49);
INSERT INTO `les_noeuds` VALUES (750, 'Réaliser un velouté', 'feuille', 749, 49);
INSERT INTO `les_noeuds` VALUES (751, 'Réaliser un consommé', 'feuille', 749, 49);
INSERT INTO `les_noeuds` VALUES (752, 'Réaliser une farce mousseline', 'feuille', 749, 49);
INSERT INTO `les_noeuds` VALUES (753, 'Réaliser une farce à la panade', 'feuille', 749, 49);
INSERT INTO `les_noeuds` VALUES (754, 'Réaliser un beurre émulsionné (beurre blanc)', 'feuille', 749, 49);
INSERT INTO `les_noeuds` VALUES (755, 'Réaliser une sauce émulsionnée (hollandaise)', 'feuille', 749, 49);
INSERT INTO `les_noeuds` VALUES (756, 'Réaliser un fond brun', 'feuille', 749, 49);
INSERT INTO `les_noeuds` VALUES (757, 'Réaliser un fond blanc', 'feuille', 749, 49);
INSERT INTO `les_noeuds` VALUES (758, 'Réaliser un fumet de poisson', 'feuille', 749, 49);
INSERT INTO `les_noeuds` VALUES (759, 'Réaliser une sauce tomate', 'feuille', 749, 49);
INSERT INTO `les_noeuds` VALUES (760, 'Réaliser une glace de viande', 'feuille', 749, 49);
INSERT INTO `les_noeuds` VALUES (761, 'Réaliser une sauce émulsionnée froide (mayonnaise)', 'feuille', 749, 49);
INSERT INTO `les_noeuds` VALUES (762, 'Réaliser un  appareil à flan', 'feuille', 749, 49);
INSERT INTO `les_noeuds` VALUES (763, 'Réaliser une bisque', 'feuille', 749, 49);
INSERT INTO `les_noeuds` VALUES (764, 'Réaliser un fumet au vin rouge', 'feuille', 749, 49);
INSERT INTO `les_noeuds` VALUES (765, 'Réaliser une sauce espagnole', 'feuille', 749, 49);
INSERT INTO `les_noeuds` VALUES (766, 'Réaliser un chaud froid', 'feuille', 749, 49);
INSERT INTO `les_noeuds` VALUES (767, 'Réaliser une sauce américaine', 'feuille', 749, 49);
INSERT INTO `les_noeuds` VALUES (768, 'REALISER DE LA PATISSERIE', 'branche', 0, 49);
INSERT INTO `les_noeuds` VALUES (769, 'Réaliser une pâte à nouille', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (770, 'Détailler des tagliatelles, des ravioles', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (771, 'Réaliser une pâte à crêpes', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (772, 'Chemiser un moule à charlotte', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (773, 'Réaliser un coulis de fruits', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (774, 'Cuire du riz au lait', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (775, 'Réaliser et cuire une pâte à choux', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (776, 'Réaliser une pâte brisée', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (777, 'Réaliser un  appareil à crème prise', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (778, 'Foncer des tartelettes', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (779, 'Utiliser du riz en entremet', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (780, 'Tabler et utiliser du chocolat', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (781, 'Utiliser des crêpes', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (782, 'Réaliser une pâte à frire', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (783, 'Réaliser une crème au beurre', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (784, 'Réaliser une génoise', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (785, 'Réaliser une pâte levée', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (786, 'Réaliser une crème anglaise', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (787, 'Réaliser une ganache', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (788, 'Utiliser la pâte à glacer', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (789, 'Réaliser de la meringue française', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (790, 'Réaliser de la meringue Italienne', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (791, 'Réaliser une crème Chiboust', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (792, 'Réaliser un biscuit cuillère', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (793, 'Réaliser un biscuit Joconde', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (794, 'Panification', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (795, 'Réaliser des glaces et sorbets', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (796, 'Réaliser une pâte à brioche', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (797, 'Réaliser un appareil à soufflé chaud', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (798, 'Réaliser un appareil à soufflé chaud', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (799, 'Réaliser un appareil à soufflé froid', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (800, 'Réaliser un appareil à bombe', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (801, 'Cuire du sucre', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (802, 'Réaliser une pâte feuilletée', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (803, 'Travailler au cornet', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (804, 'PRESENTER ET FINIR UNE PRODUCTION', 'branche', 0, 49);
INSERT INTO `les_noeuds` VALUES (805, 'Décorer à partir de blanc manger', 'feuille', 804, 49);
INSERT INTO `les_noeuds` VALUES (806, 'Distribuer une production', 'feuille', 804, 49);
INSERT INTO `les_noeuds` VALUES (807, 'Dresser une production', 'feuille', 804, 49);
INSERT INTO `les_noeuds` VALUES (808, 'Assembler une salade composée', 'feuille', 804, 49);
INSERT INTO `les_noeuds` VALUES (809, 'Rectifier une situation (dressage, assaisonnement, cuisson)', 'feuille', 804, 49);
INSERT INTO `les_noeuds` VALUES (810, 'Dresser harmonieusement', 'feuille', 804, 49);
INSERT INTO `les_noeuds` VALUES (811, 'Utiliser la salamandre', 'feuille', 804, 49);
INSERT INTO `les_noeuds` VALUES (812, 'APPRECIER UNE PRODUCTION', 'branche', 0, 49);
INSERT INTO `les_noeuds` VALUES (813, 'Maîtriser les cuissons', 'feuille', 812, 49);
INSERT INTO `les_noeuds` VALUES (814, 'Tenir compte de réactions physico-chimiques lors de la réalisation', 'feuille', 812, 49);
INSERT INTO `les_noeuds` VALUES (815, 'Exploiter judicieusement une fiche technique', 'feuille', 812, 49);
INSERT INTO `les_noeuds` VALUES (816, 'Préparer un plat typique', 'feuille', 812, 49);
INSERT INTO `les_noeuds` VALUES (817, 'Vérifier qualitativement et quantitativement les marchandises', 'feuille', 812, 49);
INSERT INTO `les_noeuds` VALUES (818, 'Maîtriser les préparations préliminaires aux produits', 'feuille', 812, 49);
INSERT INTO `les_noeuds` VALUES (819, 'Stocker les marchandises en respectant la législation en vigueur', 'feuille', 812, 49);
INSERT INTO `les_noeuds` VALUES (820, 'Effectuer un lien entre les aspetcs théoriques et les aspects pratiques', 'feuille', 812, 49);
INSERT INTO `les_noeuds` VALUES (821, 'Classer des documents ou des informations', 'feuille', 812, 49);
INSERT INTO `les_noeuds` VALUES (822, 'Apprécier une production de pâtisserie de base', 'feuille', 812, 49);
INSERT INTO `les_noeuds` VALUES (823, 'Analyser une situation professionnelle et identifier les problèmes', 'feuille', 812, 49);
INSERT INTO `les_noeuds` VALUES (824, 'Produire en fonction de différents systèmes de distribution', 'feuille', 812, 49);
INSERT INTO `les_noeuds` VALUES (825, 'Utiliser judicieusement des PAI', 'feuille', 812, 49);
INSERT INTO `les_noeuds` VALUES (826, 'Mener des analyses sensorielles', 'feuille', 812, 49);
INSERT INTO `les_noeuds` VALUES (827, 'Accorder les mets et les alcools', 'feuille', 812, 49);
INSERT INTO `les_noeuds` VALUES (828, 'Faire ^pruve de compétences humaines dans la conduite des commis', 'feuille', 812, 49);
INSERT INTO `les_noeuds` VALUES (829, 'Maîtriser les associations gustatives de base', 'feuille', 812, 49);
INSERT INTO `les_noeuds` VALUES (830, 'Assurer la gestion du temps de travail', 'feuille', 812, 49);
INSERT INTO `les_noeuds` VALUES (831, 'Gérer des situations imprévues', 'feuille', 812, 49);
INSERT INTO `les_noeuds` VALUES (832, 'COMMUNIQUER', 'branche', 0, 49);
INSERT INTO `les_noeuds` VALUES (833, 'Interpréter et annoncer les bons de restaurant', 'feuille', 832, 49);
INSERT INTO `les_noeuds` VALUES (834, 'Justifier et argumenter un point de vue', 'feuille', 832, 49);
INSERT INTO `les_noeuds` VALUES (835, 'Formuler des propositions', 'feuille', 832, 49);
INSERT INTO `les_noeuds` VALUES (865, 'Réaliser un jus de rôti', 'feuille', 749, 49);
INSERT INTO `les_noeuds` VALUES (866, 'Réalisser une dacquoise', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (869, 'DIVERS', 'branche', 0, 49);
INSERT INTO `les_noeuds` VALUES (870, 'Travaux pratiques de cuisine', 'branche', 869, 49);
INSERT INTO `les_noeuds` VALUES (871, 'Pas de notation', 'feuille', 869, 49);
INSERT INTO `les_noeuds` VALUES (872, 'Réaliser une crème mousseline', 'feuille', 768, 49);
INSERT INTO `les_noeuds` VALUES (873, 'CONCEVOIR', 'branche', 0, 53);
INSERT INTO `les_noeuds` VALUES (874, 'Réaliser des fabrications', 'feuille', 873, 53);
INSERT INTO `les_noeuds` VALUES (875, 'Organiser sontravail en respectant une fiche technique', 'feuille', 873, 53);
INSERT INTO `les_noeuds` VALUES (876, 'Réaliser des sauces émulsionnées', 'feuille', 873, 53);
INSERT INTO `les_noeuds` VALUES (877, 'Réaliser des fonds de base', 'feuille', 873, 53);
INSERT INTO `les_noeuds` VALUES (878, 'Utilisaer rationnellement des produits', 'feuille', 873, 53);
INSERT INTO `les_noeuds` VALUES (879, 'Réaliser des fabrications à partir de produits semi-élaborés', 'feuille', 873, 53);
INSERT INTO `les_noeuds` VALUES (880, 'Assurer des préparations et des cuissons en limitant les apports caloriques', 'feuille', 873, 53);
INSERT INTO `les_noeuds` VALUES (881, 'Réaliser des potages et leurs dérivés', 'feuille', 873, 53);
INSERT INTO `les_noeuds` VALUES (882, 'Concevoir des recettes régionales à partir de fiches techniques', 'feuille', 873, 53);
INSERT INTO `les_noeuds` VALUES (883, 'Réaliser des buffets et des cocktails', 'feuille', 873, 53);
INSERT INTO `les_noeuds` VALUES (884, 'Réaliser harmonieusement des préparations', 'feuille', 873, 53);
INSERT INTO `les_noeuds` VALUES (885, 'ORGANISER', 'branche', 0, 53);
INSERT INTO `les_noeuds` VALUES (886, 'Préparer les marchandises et le matériel', 'feuille', 885, 53);
INSERT INTO `les_noeuds` VALUES (887, 'Prévoir les approvisionnements en fonction de la production', 'feuille', 885, 53);
INSERT INTO `les_noeuds` VALUES (888, 'Dresser une liste de matériel et de marchandises', 'feuille', 885, 53);
INSERT INTO `les_noeuds` VALUES (889, 'Organiser un poste, des tâches', 'feuille', 885, 53);
INSERT INTO `les_noeuds` VALUES (890, 'Distribuer des tâches avec un support écrit', 'feuille', 885, 53);
INSERT INTO `les_noeuds` VALUES (891, 'Diriger un commis', 'feuille', 885, 53);
INSERT INTO `les_noeuds` VALUES (892, 'PREPARER PRELIMINAIREMENT', 'branche', 0, 53);
INSERT INTO `les_noeuds` VALUES (893, 'Habiller un poisson', 'feuille', 892, 53);
INSERT INTO `les_noeuds` VALUES (894, 'Tailler des légumes', 'feuille', 892, 53);
INSERT INTO `les_noeuds` VALUES (895, 'Tourner des légumes', 'feuille', 892, 53);
INSERT INTO `les_noeuds` VALUES (896, 'Habiller une volaille', 'feuille', 892, 53);
INSERT INTO `les_noeuds` VALUES (897, 'Brider une volaille', 'feuille', 892, 53);
INSERT INTO `les_noeuds` VALUES (898, 'Découper une volaille à cru', 'feuille', 892, 53);
INSERT INTO `les_noeuds` VALUES (899, 'Désarêter et farcir un poisson rond par le dos', 'feuille', 892, 53);
INSERT INTO `les_noeuds` VALUES (900, 'Désarêter et farcir un poisson plat', 'feuille', 892, 53);
INSERT INTO `les_noeuds` VALUES (901, 'Parer et détailler des steaks', 'feuille', 892, 53);
INSERT INTO `les_noeuds` VALUES (902, 'Habiller et désosser un carré', 'feuille', 892, 53);
INSERT INTO `les_noeuds` VALUES (903, 'Habiller et ficeler une pièce de viande', 'feuille', 892, 53);
INSERT INTO `les_noeuds` VALUES (904, 'Détailler des darnes', 'feuille', 892, 53);
INSERT INTO `les_noeuds` VALUES (905, 'étailler des tronçons', 'feuille', 892, 53);
INSERT INTO `les_noeuds` VALUES (906, 'Lever des poissons plats', 'feuille', 892, 53);
INSERT INTO `les_noeuds` VALUES (907, 'Lever des poissons ronds', 'feuille', 892, 53);
INSERT INTO `les_noeuds` VALUES (908, 'Monder des poivrons', 'feuille', 892, 53);
INSERT INTO `les_noeuds` VALUES (909, 'Préparer préliminairementdes abats', 'feuille', 892, 53);
INSERT INTO `les_noeuds` VALUES (910, 'Désosser un gigot', 'feuille', 892, 53);
INSERT INTO `les_noeuds` VALUES (911, 'Détailler des escalopes', 'feuille', 892, 53);
INSERT INTO `les_noeuds` VALUES (912, 'Préparer préliminairement des coquillages', 'feuille', 892, 53);
INSERT INTO `les_noeuds` VALUES (913, 'MENER DES CUISSONS', 'branche', 0, 53);
INSERT INTO `les_noeuds` VALUES (914, 'Cuire des omelettes roulées et plates', 'feuille', 913, 53);
INSERT INTO `les_noeuds` VALUES (915, 'Cuire au bleu', 'feuille', 913, 53);
INSERT INTO `les_noeuds` VALUES (916, 'Cuire une préparation panée', 'feuille', 913, 53);
INSERT INTO `les_noeuds` VALUES (917, 'Cuire des fruits', 'feuille', 913, 53);
INSERT INTO `les_noeuds` VALUES (918, 'Cuire un riz composé', 'feuille', 913, 53);
INSERT INTO `les_noeuds` VALUES (919, 'Cuire des légumes secs', 'feuille', 913, 53);
INSERT INTO `les_noeuds` VALUES (920, 'Braiser à brun', 'feuille', 913, 53);
INSERT INTO `les_noeuds` VALUES (921, 'Braiser à blanc', 'feuille', 913, 53);
INSERT INTO `les_noeuds` VALUES (922, 'Cuire de la semoule', 'feuille', 913, 53);
INSERT INTO `les_noeuds` VALUES (923, 'Cuire au repère', 'feuille', 913, 53);
INSERT INTO `les_noeuds` VALUES (924, 'Confire des viandes (gésiers, canard, etc.)', 'feuille', 913, 53);
INSERT INTO `les_noeuds` VALUES (925, 'Confire des fruits', 'feuille', 913, 53);
INSERT INTO `les_noeuds` VALUES (926, 'Grilles des grosses pièces (volaille, etc.)', 'feuille', 913, 53);
INSERT INTO `les_noeuds` VALUES (927, 'Pocher des oeufs', 'feuille', 913, 53);
INSERT INTO `les_noeuds` VALUES (928, 'Cuire des oeufs mollets', 'feuille', 913, 53);
INSERT INTO `les_noeuds` VALUES (929, 'Sauter des viandes', 'feuille', 913, 53);
INSERT INTO `les_noeuds` VALUES (930, 'Pocher', 'feuille', 913, 53);
INSERT INTO `les_noeuds` VALUES (931, 'Cuire des abats', 'feuille', 913, 53);
INSERT INTO `les_noeuds` VALUES (932, 'Cuire des PCA', 'feuille', 913, 53);
INSERT INTO `les_noeuds` VALUES (933, 'Réaliser des soufflés', 'feuille', 913, 53);
INSERT INTO `les_noeuds` VALUES (934, 'Cuire une pomme duchesse', 'feuille', 913, 53);
INSERT INTO `les_noeuds` VALUES (935, 'Mener une clarification', 'feuille', 913, 53);
INSERT INTO `les_noeuds` VALUES (936, 'Griller', 'feuille', 913, 53);
INSERT INTO `les_noeuds` VALUES (937, 'Glacer des légumes (à blanc, à blond, à brun)', 'feuille', 913, 53);
INSERT INTO `les_noeuds` VALUES (938, 'Rôtir', 'feuille', 913, 53);
INSERT INTO `les_noeuds` VALUES (939, 'Mener une cuisson en gratin', 'feuille', 913, 53);
INSERT INTO `les_noeuds` VALUES (940, 'Cuire des coquillages', 'feuille', 913, 53);
INSERT INTO `les_noeuds` VALUES (941, 'Pocher des fruits', 'feuille', 913, 53);
INSERT INTO `les_noeuds` VALUES (942, 'Frire', 'feuille', 913, 53);
INSERT INTO `les_noeuds` VALUES (943, 'Frire des oeufs', 'feuille', 913, 53);
INSERT INTO `les_noeuds` VALUES (944, 'REALISER DES APPAREILS, DES FONDS, DES SAUCES', 'branche', 0, 53);
INSERT INTO `les_noeuds` VALUES (945, 'Réaliser un velouté', 'feuille', 944, 53);
INSERT INTO `les_noeuds` VALUES (946, 'Réaliser un consommé', 'feuille', 944, 53);
INSERT INTO `les_noeuds` VALUES (947, 'Réaliser une farce mousseline', 'feuille', 944, 53);
INSERT INTO `les_noeuds` VALUES (948, 'Réaliser une farce à la panade', 'feuille', 944, 53);
INSERT INTO `les_noeuds` VALUES (949, 'Réaliser un beurre émulsionné (beurre blanc)', 'feuille', 944, 53);
INSERT INTO `les_noeuds` VALUES (950, 'Réaliser une sauce émulsionnée (hollandaise)', 'feuille', 944, 53);
INSERT INTO `les_noeuds` VALUES (951, 'Réaliser un fond brun', 'feuille', 944, 53);
INSERT INTO `les_noeuds` VALUES (952, 'Réaliser un fond blanc', 'feuille', 944, 53);
INSERT INTO `les_noeuds` VALUES (953, 'Réaliser un fumet de poisson', 'feuille', 944, 53);
INSERT INTO `les_noeuds` VALUES (954, 'Réaliser une sauce tomate', 'feuille', 944, 53);
INSERT INTO `les_noeuds` VALUES (955, 'Réaliser une glace de viande', 'feuille', 944, 53);
INSERT INTO `les_noeuds` VALUES (956, 'Réaliser une sauce émulsionnée froide (mayonnaise)', 'feuille', 944, 53);
INSERT INTO `les_noeuds` VALUES (957, 'Réaliser un  appareil à flan', 'feuille', 944, 53);
INSERT INTO `les_noeuds` VALUES (958, 'Réaliser une bisque', 'feuille', 944, 53);
INSERT INTO `les_noeuds` VALUES (959, 'Réaliser un fumet au vin rouge', 'feuille', 944, 53);
INSERT INTO `les_noeuds` VALUES (960, 'Réaliser une sauce espagnole', 'feuille', 944, 53);
INSERT INTO `les_noeuds` VALUES (961, 'Réaliser un chaud froid', 'feuille', 944, 53);
INSERT INTO `les_noeuds` VALUES (962, 'Réaliser une sauce américaine', 'feuille', 944, 53);
INSERT INTO `les_noeuds` VALUES (963, 'Réaliser un jus de rôti', 'feuille', 944, 53);
INSERT INTO `les_noeuds` VALUES (964, 'REALISER DE LA PATISSERIE', 'branche', 0, 53);
INSERT INTO `les_noeuds` VALUES (965, 'Réaliser une pâte à nouille', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (966, 'Détailler des tagliatelles, des ravioles', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (967, 'Réaliser une pâte à crêpes', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (968, 'Chemiser un moule à charlotte', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (969, 'Réaliser un coulis de fruits', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (970, 'Cuire du riz au lait', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (971, 'Réaliser et cuire une pâte à choux', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (972, 'Réaliser une pâte brisée', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (973, 'Réaliser un  appareil à crème prise', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (974, 'Foncer des tartelettes', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (975, 'Utiliser du riz en entremet', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (976, 'Tabler et utiliser du chocolat', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (977, 'Utiliser des crêpes', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (978, 'Réaliser une pâte à frire', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (979, 'Réaliser une crème au beurre', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (980, 'Réaliser une génoise', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (981, 'Réaliser une pâte levée', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (982, 'Réaliser une crème anglaise', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (983, 'Réaliser une ganache', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (984, 'Utiliser la pâte à glacer', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (985, 'Réaliser de la meringue française', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (986, 'Réaliser de la meringue Italienne', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (987, 'Réaliser une crème Chiboust', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (988, 'Réaliser un biscuit cuillère', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (989, 'Réaliser un biscuit Joconde', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (990, 'Panification', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (991, 'Réaliser des glaces et sorbets', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (992, 'Réaliser une pâte à brioche', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (993, 'Réaliser un appareil à soufflé chaud', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (994, 'Réaliser un appareil à soufflé chaud', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (995, 'Réaliser un appareil à soufflé froid', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (996, 'Réaliser un appareil à bombe', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (997, 'Cuire du sucre', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (998, 'Réaliser une pâte feuilletée', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (999, 'Travailler au cornet', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (1000, 'Réalisser une dacquoise', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (1001, 'Réaliser une crème mousseline', 'feuille', 964, 53);
INSERT INTO `les_noeuds` VALUES (1002, 'PRESENTER ET FINIR UNE PRODUCTION', 'branche', 0, 53);
INSERT INTO `les_noeuds` VALUES (1003, 'Décorer à partir de blanc manger', 'feuille', 1002, 53);
INSERT INTO `les_noeuds` VALUES (1004, 'Distribuer une production', 'feuille', 1002, 53);
INSERT INTO `les_noeuds` VALUES (1005, 'Dresser une production', 'feuille', 1002, 53);
INSERT INTO `les_noeuds` VALUES (1006, 'Assembler une salade composée', 'feuille', 1002, 53);
INSERT INTO `les_noeuds` VALUES (1007, 'Rectifier une situation (dressage, assaisonnement, cuisson)', 'feuille', 1002, 53);
INSERT INTO `les_noeuds` VALUES (1008, 'Dresser harmonieusement', 'feuille', 1002, 53);
INSERT INTO `les_noeuds` VALUES (1009, 'Utiliser la salamandre', 'feuille', 1002, 53);
INSERT INTO `les_noeuds` VALUES (1010, 'APPRECIER UNE PRODUCTION', 'branche', 0, 53);
INSERT INTO `les_noeuds` VALUES (1011, 'Maîtriser les cuissons', 'feuille', 1010, 53);
INSERT INTO `les_noeuds` VALUES (1012, 'Tenir compte de réactions physico-chimiques lors de la réalisation', 'feuille', 1010, 53);
INSERT INTO `les_noeuds` VALUES (1013, 'Exploiter judicieusement une fiche technique', 'feuille', 1010, 53);
INSERT INTO `les_noeuds` VALUES (1014, 'Préparer un plat typique', 'feuille', 1010, 53);
INSERT INTO `les_noeuds` VALUES (1015, 'Vérifier qualitativement et quantitativement les marchandises', 'feuille', 1010, 53);
INSERT INTO `les_noeuds` VALUES (1016, 'Maîtriser les préparations préliminaires aux produits', 'feuille', 1010, 53);
INSERT INTO `les_noeuds` VALUES (1017, 'Stocker les marchandises en respectant la législation en vigueur', 'feuille', 1010, 53);
INSERT INTO `les_noeuds` VALUES (1018, 'Effectuer un lien entre les aspetcs théoriques et les aspects pratiques', 'feuille', 1010, 53);
INSERT INTO `les_noeuds` VALUES (1019, 'Classer des documents ou des informations', 'feuille', 1010, 53);
INSERT INTO `les_noeuds` VALUES (1020, 'Apprécier une production de pâtisserie de base', 'feuille', 1010, 53);
INSERT INTO `les_noeuds` VALUES (1021, 'Analyser une situation professionnelle et identifier les problèmes', 'feuille', 1010, 53);
INSERT INTO `les_noeuds` VALUES (1022, 'Produire en fonction de différents systèmes de distribution', 'feuille', 1010, 53);
INSERT INTO `les_noeuds` VALUES (1023, 'Utiliser judicieusement des PAI', 'feuille', 1010, 53);
INSERT INTO `les_noeuds` VALUES (1024, 'Mener des analyses sensorielles', 'feuille', 1010, 53);
INSERT INTO `les_noeuds` VALUES (1025, 'Accorder les mets et les alcools', 'feuille', 1010, 53);
INSERT INTO `les_noeuds` VALUES (1026, 'Faire ^pruve de compétences humaines dans la conduite des commis', 'feuille', 1010, 53);
INSERT INTO `les_noeuds` VALUES (1027, 'Maîtriser les associations gustatives de base', 'feuille', 1010, 53);
INSERT INTO `les_noeuds` VALUES (1028, 'Assurer la gestion du temps de travail', 'feuille', 1010, 53);
INSERT INTO `les_noeuds` VALUES (1029, 'Gérer des situations imprévues', 'feuille', 1010, 53);
INSERT INTO `les_noeuds` VALUES (1030, 'COMMUNIQUER', 'branche', 0, 53);
INSERT INTO `les_noeuds` VALUES (1031, 'Interpréter et annoncer les bons de restaurant', 'feuille', 1030, 53);
INSERT INTO `les_noeuds` VALUES (1032, 'Justifier et argumenter un point de vue', 'feuille', 1030, 53);
INSERT INTO `les_noeuds` VALUES (1033, 'Formuler des propositions', 'feuille', 1030, 53);
INSERT INTO `les_noeuds` VALUES (1034, 'DIVERS', 'branche', 0, 53);
INSERT INTO `les_noeuds` VALUES (1035, 'Travaux pratiques de cuisine', 'branche', 1034, 53);
INSERT INTO `les_noeuds` VALUES (1036, 'Pas de notation', 'feuille', 1034, 53);
INSERT INTO `les_noeuds` VALUES (1051, 'Semaine N° 01', 'branche', 0, 54);
INSERT INTO `les_noeuds` VALUES (1052, 'Semaine N° 02', 'branche', 0, 54);
INSERT INTO `les_noeuds` VALUES (1053, 'Semaine N° 03', 'branche', 0, 54);
INSERT INTO `les_noeuds` VALUES (1054, 'Semaine N° 04', 'branche', 0, 54);
INSERT INTO `les_noeuds` VALUES (1055, 'Semaine N° 05', 'branche', 0, 54);
INSERT INTO `les_noeuds` VALUES (1056, 'Semaine N°06', 'branche', 0, 54);
INSERT INTO `les_noeuds` VALUES (1058, 'Semaine N°07', 'branche', 0, 54);
INSERT INTO `les_noeuds` VALUES (1059, 'Semaine N°08', 'branche', 0, 54);
INSERT INTO `les_noeuds` VALUES (1060, 'Semaine N°09', 'branche', 0, 54);
INSERT INTO `les_noeuds` VALUES (1061, 'Semaine N°10', 'branche', 0, 54);
INSERT INTO `les_noeuds` VALUES (1062, 'Semaine N°11', 'branche', 0, 54);
INSERT INTO `les_noeuds` VALUES (1063, 'Semaine N°12', 'branche', 0, 54);
INSERT INTO `les_noeuds` VALUES (1065, 'Dorade flambée au Pastis', 'branche', 1051, 54);
INSERT INTO `les_noeuds` VALUES (1066, 'Poulet Rôti - Démonstration', 'branche', 1051, 54);
INSERT INTO `les_noeuds` VALUES (1068, 'Filetage & Flambage d''un poisson', 'feuille', 1065, 54);
INSERT INTO `les_noeuds` VALUES (1069, 'Découpage d''une volaille pour 4.', 'feuille', 1066, 54);
INSERT INTO `les_noeuds` VALUES (1070, 'Avocat Cocktail', 'branche', 1052, 54);
INSERT INTO `les_noeuds` VALUES (1071, 'Sauce cocktail, Organisation et propreté du poste, Présentation', 'feuille', 1070, 54);
INSERT INTO `les_noeuds` VALUES (1072, 'Carré d''Agneau', 'branche', 1052, 54);
INSERT INTO `les_noeuds` VALUES (1073, 'Pintadeau Rôti sur Canapé', 'branche', 1052, 54);
INSERT INTO `les_noeuds` VALUES (1074, 'Pomme', 'branche', 1052, 54);
INSERT INTO `les_noeuds` VALUES (1075, 'Ananas', 'branche', 1052, 54);
INSERT INTO `les_noeuds` VALUES (1076, 'Découpage de l''ananas', 'feuille', 1075, 54);
INSERT INTO `les_noeuds` VALUES (1077, 'Réalisation d''un caramel et Flambage de l''ananas', 'feuille', 1075, 54);
INSERT INTO `les_noeuds` VALUES (1078, 'Découpage d''une volaille pour 4', 'feuille', 1073, 54);
INSERT INTO `les_noeuds` VALUES (1079, 'Découpage du carré d''agneau', 'feuille', 1072, 54);
INSERT INTO `les_noeuds` VALUES (1080, 'Découpage d''une pomme', 'feuille', 1074, 54);
INSERT INTO `les_noeuds` VALUES (1081, 'Velouté Agnès Sorel', 'branche', 1053, 54);
INSERT INTO `les_noeuds` VALUES (1082, 'Jambon Cru', 'branche', 1053, 54);
INSERT INTO `les_noeuds` VALUES (1083, 'Saumon Fumé', 'branche', 1053, 54);
INSERT INTO `les_noeuds` VALUES (1084, 'Truite au bleu - Beurre Blanc', 'branche', 1053, 54);
INSERT INTO `les_noeuds` VALUES (1085, 'Contre Filet Nivernaise', 'branche', 1053, 54);
INSERT INTO `les_noeuds` VALUES (1086, 'Salade d''Oranges', 'branche', 1053, 54);
INSERT INTO `les_noeuds` VALUES (1087, 'Service & Débarrassage Potage', 'feuille', 1081, 54);
INSERT INTO `les_noeuds` VALUES (1088, 'Découpage & dressage du Saumon Fumé', 'feuille', 1083, 54);
INSERT INTO `les_noeuds` VALUES (1089, 'Découpage & dressage du Jambon', 'feuille', 1082, 54);
INSERT INTO `les_noeuds` VALUES (1090, 'Préparation de la Truite', 'feuille', 1084, 54);
INSERT INTO `les_noeuds` VALUES (1091, 'Découpage & dressage d''un Contre Filet', 'feuille', 1085, 54);
INSERT INTO `les_noeuds` VALUES (1092, 'Lever les segments et dressage d''une salade d''Orange', 'feuille', 1086, 54);
INSERT INTO `les_noeuds` VALUES (1093, 'Steak au poivre', 'branche', 1054, 54);
INSERT INTO `les_noeuds` VALUES (1094, 'Flambage d''une viande et Réalisation d''un sauce poivre', 'feuille', 1093, 54);
INSERT INTO `les_noeuds` VALUES (1095, 'Pruneaux flambés & glace', 'branche', 1054, 54);
INSERT INTO `les_noeuds` VALUES (1096, 'Flambage sans caramel et dressage', 'feuille', 1095, 54);
INSERT INTO `les_noeuds` VALUES (1097, 'Potage Compiègne', 'branche', 1055, 54);
INSERT INTO `les_noeuds` VALUES (1098, 'Assiette de cochonnailles', 'branche', 1055, 54);
INSERT INTO `les_noeuds` VALUES (1099, 'Darnes de saumon pochée sauce hollandaise', 'branche', 1055, 54);
INSERT INTO `les_noeuds` VALUES (1100, 'Longe de porc au cidre  garniture Excelsior', 'branche', 1055, 54);
INSERT INTO `les_noeuds` VALUES (1101, 'Cerises Jubilé', 'branche', 1055, 54);
INSERT INTO `les_noeuds` VALUES (1102, 'Service et débarrassage d''un potage', 'feuille', 1097, 54);
INSERT INTO `les_noeuds` VALUES (1103, 'Technique de réalisation, présentation', 'feuille', 1098, 54);
INSERT INTO `les_noeuds` VALUES (1104, 'Connaissance produit', 'feuille', 1098, 54);
INSERT INTO `les_noeuds` VALUES (1105, 'Connaissance produit, Origines, Types, Accords Mets / Vins, Accompagnements', 'feuille', 1082, 54);
INSERT INTO `les_noeuds` VALUES (1106, 'Connaissance produit : "Poissons Fumés" - Origines, Types, Accords Mets / Vins, Accompagnements', 'feuille', 1083, 54);
INSERT INTO `les_noeuds` VALUES (1107, 'Connaissance produit : "les Agrumes"', 'feuille', 1086, 54);
INSERT INTO `les_noeuds` VALUES (1108, 'Préparation de la Darne', 'feuille', 1099, 54);
INSERT INTO `les_noeuds` VALUES (1109, 'Flambage & réalisation de la Sauce', 'feuille', 1100, 54);
INSERT INTO `les_noeuds` VALUES (1110, 'Flambage sans caramel', 'feuille', 1101, 54);
INSERT INTO `les_noeuds` VALUES (1111, 'Pintadeau aux raisin / garniture Florian', 'branche', 1056, 54);
INSERT INTO `les_noeuds` VALUES (1113, 'Coupe Florida', 'branche', 1056, 54);
INSERT INTO `les_noeuds` VALUES (1114, 'Mousse au chocolat', 'branche', 1056, 54);
INSERT INTO `les_noeuds` VALUES (1115, 'Confectionner des quenelles à la cuillère', 'feuille', 1114, 54);
INSERT INTO `les_noeuds` VALUES (1116, 'Découpage fruit', 'feuille', 1113, 54);
INSERT INTO `les_noeuds` VALUES (1117, 'Technologie & Organisation', 'branche', 1051, 54);
INSERT INTO `les_noeuds` VALUES (1118, 'Evolution de la restauration, les formes de service, les bons de commande, l’annonce au passe.', 'feuille', 1117, 54);
INSERT INTO `les_noeuds` VALUES (1119, 'Cocktail', 'branche', 1051, 54);
INSERT INTO `les_noeuds` VALUES (1120, 'Catégories et ustensiles : Bacardi + Bronx', 'feuille', 1119, 54);
INSERT INTO `les_noeuds` VALUES (1121, 'Géographie gastronomique', 'branche', 1051, 54);
INSERT INTO `les_noeuds` VALUES (1122, 'Connaissance des régions viticoles à partir d’une carte', 'feuille', 1121, 54);
INSERT INTO `les_noeuds` VALUES (1123, 'Fiche produit de l''Agneau: Les différents morceaux, Appellations culinaires, Origines géographiques, Labels, Accords Mets / Vins.', 'feuille', 1072, 54);
INSERT INTO `les_noeuds` VALUES (1124, 'Fiche produit des Volailles : Les différents morceaux, Appellations culinaires, Origines géographiques, Labels, Accords Mets / Vins.', 'feuille', 1066, 54);
INSERT INTO `les_noeuds` VALUES (1125, 'Cocktail', 'branche', 1052, 54);
INSERT INTO `les_noeuds` VALUES (1126, 'Le Bronx', 'feuille', 1125, 54);
INSERT INTO `les_noeuds` VALUES (1127, 'Technologie & Organisation', 'branche', 1052, 54);
INSERT INTO `les_noeuds` VALUES (1128, 'Restauration à vocation commerciale et sociale (les différentes formules de restauration). La main courante. Les produits du bar, les groupes de boissons et licences', 'feuille', 1127, 54);
INSERT INTO `les_noeuds` VALUES (1129, 'Connaissance produit, Origines, Types.', 'feuille', 1075, 54);
INSERT INTO `les_noeuds` VALUES (1130, 'Fiche produit de l''Avocat : Origines, Variétés.', 'feuille', 1070, 54);
INSERT INTO `les_noeuds` VALUES (1131, 'Fiche produit de la Dorade : Origines géographiques, Accords Mets / Vins.', 'feuille', 1065, 54);
INSERT INTO `les_noeuds` VALUES (1132, 'Les sauces émulsionnées', 'feuille', 1084, 54);
INSERT INTO `les_noeuds` VALUES (1133, 'Paris Brest', 'branche', 1053, 54);
INSERT INTO `les_noeuds` VALUES (1134, 'Les différentes utilisations de la "Pâte à choux".', 'feuille', 1133, 54);
INSERT INTO `les_noeuds` VALUES (1135, 'Technologie & Organisation', 'branche', 1053, 54);
INSERT INTO `les_noeuds` VALUES (1136, 'Les plans de salles, salons....(ratios)', 'feuille', 1135, 54);
INSERT INTO `les_noeuds` VALUES (1137, 'Géographie Gastronomique', 'branche', 1053, 54);
INSERT INTO `les_noeuds` VALUES (1139, 'Alsace, Jura, Savoie', 'feuille', 1137, 54);
INSERT INTO `les_noeuds` VALUES (1140, 'Cocktail', 'branche', 1053, 54);
INSERT INTO `les_noeuds` VALUES (1141, 'Black Russian', 'feuille', 1140, 54);
INSERT INTO `les_noeuds` VALUES (1142, 'Connaissance produit : Agrumes', 'feuille', 1113, 54);
INSERT INTO `les_noeuds` VALUES (1143, 'Préparation', 'branche', 0, 55);
INSERT INTO `les_noeuds` VALUES (1144, 'Connaissance des documents', 'feuille', 1143, 55);
INSERT INTO `les_noeuds` VALUES (1145, 'Vérification des supports', 'feuille', 1143, 55);
INSERT INTO `les_noeuds` VALUES (1146, 'Contrôle des quantités', 'feuille', 1143, 55);
INSERT INTO `les_noeuds` VALUES (1147, 'Aménager l''aire de travail', 'feuille', 1143, 55);
INSERT INTO `les_noeuds` VALUES (1148, 'Préparer les outillages', 'feuille', 1143, 55);
INSERT INTO `les_noeuds` VALUES (1149, 'Installer un échafaudage roulant', 'feuille', 1143, 55);
INSERT INTO `les_noeuds` VALUES (1150, 'Traiter & décider', 'branche', 0, 55);
INSERT INTO `les_noeuds` VALUES (1151, 'Traduire graphiquement une solution', 'feuille', 1150, 55);
INSERT INTO `les_noeuds` VALUES (1152, 'Choisir des matériaux et produits', 'feuille', 1150, 55);
INSERT INTO `les_noeuds` VALUES (1153, 'Vérifier les quantités à mettre en oeuvre', 'feuille', 1150, 55);
INSERT INTO `les_noeuds` VALUES (1154, 'Utiliser un mode opératoire', 'feuille', 1150, 55);
INSERT INTO `les_noeuds` VALUES (1187, 'Enseignement Professionnel', 'branche', 0, 58);
INSERT INTO `les_noeuds` VALUES (1192, 'Enseignement Général', 'branche', 0, 58);
INSERT INTO `les_noeuds` VALUES (1193, 'Technologie', 'branche', 1187, 58);
INSERT INTO `les_noeuds` VALUES (1194, 'Devoirs Technologie', 'feuille', 1193, 58);
INSERT INTO `les_noeuds` VALUES (1195, 'Participation Technologie', 'feuille', 1193, 58);
INSERT INTO `les_noeuds` VALUES (1196, 'Atelier (pratique)', 'branche', 1187, 58);
INSERT INTO `les_noeuds` VALUES (1197, 'Dessin construction & Lecture de Plan', 'branche', 1187, 58);
INSERT INTO `les_noeuds` VALUES (1198, 'Dessin d''art ou de Style', 'branche', 1187, 58);
INSERT INTO `les_noeuds` VALUES (1199, 'Vie Sociale et Professionnelle', 'branche', 1187, 58);
INSERT INTO `les_noeuds` VALUES (1200, 'Devoirs en ateliers', 'feuille', 1196, 58);
INSERT INTO `les_noeuds` VALUES (1201, 'Participation en ateliers', 'feuille', 1196, 58);
INSERT INTO `les_noeuds` VALUES (1202, 'Devoirs Dessin construction', 'feuille', 1197, 58);
INSERT INTO `les_noeuds` VALUES (1203, 'Participation Dessin Lecture de Plan', 'feuille', 1197, 58);
INSERT INTO `les_noeuds` VALUES (1204, 'Dessin d''art ou de Style', 'feuille', 1198, 58);
INSERT INTO `les_noeuds` VALUES (1205, 'Participation dessin d''Art', 'feuille', 1198, 58);
INSERT INTO `les_noeuds` VALUES (1206, 'Devoir VSP', 'feuille', 1199, 58);
INSERT INTO `les_noeuds` VALUES (1207, 'Participation VSP', 'feuille', 1199, 58);
INSERT INTO `les_noeuds` VALUES (1208, 'Français Histoire Géo.', 'branche', 1192, 58);
INSERT INTO `les_noeuds` VALUES (1209, 'Mathématiques', 'branche', 1192, 58);
INSERT INTO `les_noeuds` VALUES (1210, 'Sciences', 'branche', 1192, 58);
INSERT INTO `les_noeuds` VALUES (1211, 'E.P.S.', 'branche', 1192, 58);
INSERT INTO `les_noeuds` VALUES (1213, 'Devoirs Français-Hist.Géo', 'feuille', 1208, 58);
INSERT INTO `les_noeuds` VALUES (1214, 'Participation Français-Hist.Géo', 'feuille', 1208, 58);
INSERT INTO `les_noeuds` VALUES (1215, 'Devoir Maths', 'feuille', 1209, 58);
INSERT INTO `les_noeuds` VALUES (1216, 'Participation Maths', 'feuille', 1209, 58);
INSERT INTO `les_noeuds` VALUES (1218, 'Devoirs Sciences', 'feuille', 1210, 58);
INSERT INTO `les_noeuds` VALUES (1219, 'Participation Sciences', 'feuille', 1210, 58);
INSERT INTO `les_noeuds` VALUES (1221, 'Performances EPS', 'feuille', 1211, 58);
INSERT INTO `les_noeuds` VALUES (1222, 'Participation EPS', 'feuille', 1211, 58);
INSERT INTO `les_noeuds` VALUES (1223, 'chimie', 'branche', 0, 59);
INSERT INTO `les_noeuds` VALUES (1224, 'chimie générale', 'branche', 1223, 59);
INSERT INTO `les_noeuds` VALUES (1225, 'chimie organique', 'branche', 1223, 59);
INSERT INTO `les_noeuds` VALUES (1226, 'constitution de la matière', 'feuille', 1224, 59);
INSERT INTO `les_noeuds` VALUES (1227, 'rappel de concentrations et titre', 'feuille', 1224, 59);
INSERT INTO `les_noeuds` VALUES (1228, 'chimie minérale', 'branche', 1223, 59);
INSERT INTO `les_noeuds` VALUES (1229, 'hydrocarbure', 'feuille', 1225, 59);
INSERT INTO `les_noeuds` VALUES (1230, 'fonctions et nomenclature', 'feuille', 1225, 59);
INSERT INTO `les_noeuds` VALUES (1231, 'analyse élémentaire', 'feuille', 1225, 59);
INSERT INTO `les_noeuds` VALUES (1232, 'structure d''une molécule et isomère', 'feuille', 1225, 59);
INSERT INTO `les_noeuds` VALUES (1233, 'fonctions alcool et phénol', 'feuille', 1225, 59);
INSERT INTO `les_noeuds` VALUES (1234, 'fonctions aldéhyde et cétone', 'feuille', 1225, 59);
INSERT INTO `les_noeuds` VALUES (1235, 'fonction amine', 'feuille', 1225, 59);
INSERT INTO `les_noeuds` VALUES (1236, 'fonction acide carboxylique', 'feuille', 1225, 59);
INSERT INTO `les_noeuds` VALUES (1237, 'fonctions dérivées des acides', 'feuille', 1225, 59);
INSERT INTO `les_noeuds` VALUES (1238, 'composés terpéniques', 'feuille', 1225, 59);
INSERT INTO `les_noeuds` VALUES (1254, 'Délivrance', 'branche', 0, 61);
INSERT INTO `les_noeuds` VALUES (1255, 'Préparation et conditionnement', 'branche', 0, 61);
INSERT INTO `les_noeuds` VALUES (1256, 'Conseil, prévention, information, formation', 'branche', 0, 61);
INSERT INTO `les_noeuds` VALUES (1257, 'Vigilance', 'branche', 0, 61);
INSERT INTO `les_noeuds` VALUES (1258, 'Accueil et vente', 'branche', 0, 61);
INSERT INTO `les_noeuds` VALUES (1259, 'Documentation', 'branche', 0, 61);
INSERT INTO `les_noeuds` VALUES (1260, 'Gestion des stocks', 'branche', 0, 61);
INSERT INTO `les_noeuds` VALUES (1261, 'Administrative', 'branche', 0, 61);
INSERT INTO `les_noeuds` VALUES (1262, 'Hygiène', 'branche', 0, 61);
INSERT INTO `les_noeuds` VALUES (1263, 'Maintenance', 'branche', 0, 61);
INSERT INTO `les_noeuds` VALUES (1264, 'conseil', 'branche', 1256, 61);
INSERT INTO `les_noeuds` VALUES (1265, 'prévention', 'branche', 1256, 61);
INSERT INTO `les_noeuds` VALUES (1266, 'information', 'branche', 1256, 61);
INSERT INTO `les_noeuds` VALUES (1267, 'formation', 'branche', 1256, 61);
INSERT INTO `les_noeuds` VALUES (1268, 'Vérifier que le cas exposé entre dans les limites du conseil', 'feuille', 1264, 61);
INSERT INTO `les_noeuds` VALUES (1269, 'Diriger, si nécessaire, le demandeur vers un pharmacien', 'feuille', 1264, 61);
INSERT INTO `les_noeuds` VALUES (1270, 'Rechercher la ou les solutions répondant le mieux aux cas exposés', 'feuille', 1264, 61);
INSERT INTO `les_noeuds` VALUES (1271, 'Donner alors les explications et recommandations nécessaires', 'feuille', 1264, 61);
INSERT INTO `les_noeuds` VALUES (1272, 'Mettre en garde contre les risques d’automédication.', 'feuille', 1264, 61);
INSERT INTO `les_noeuds` VALUES (1273, 'Participer à la prévention individuelle et aux actions de prévention collective', 'feuille', 1265, 61);
INSERT INTO `les_noeuds` VALUES (1274, 'Répondre à une demande d’information', 'feuille', 1266, 61);
INSERT INTO `les_noeuds` VALUES (1275, 'Rendre compte de ses activités et (ou) de ses propositions', 'feuille', 1266, 61);
INSERT INTO `les_noeuds` VALUES (1276, 'Transmettre les consignes', 'feuille', 1266, 61);
INSERT INTO `les_noeuds` VALUES (1277, 'Participer à la formation des élèves préparateurs et des autres agents non pharmaciens', 'feuille', 1267, 61);
INSERT INTO `les_noeuds` VALUES (1278, 'Participer au recueil des informations sur les effets inattendus des médicaments, des dispositifs médicaux et autres produits.', 'feuille', 1257, 61);
INSERT INTO `les_noeuds` VALUES (1279, 'Signaler au pharmacien les effets graves et/ou inattendus des médicaments, des dispositifs médicaux et autres produits.', 'feuille', 1257, 61);
INSERT INTO `les_noeuds` VALUES (1280, 'Vérifier les conditions de conservation des médicaments, dispositifs médicaux et autres produits.', 'feuille', 1257, 61);
INSERT INTO `les_noeuds` VALUES (1281, 'Participer au recueil d’informations contribuant au suivi thérapeutique.', 'feuille', 1257, 61);
INSERT INTO `les_noeuds` VALUES (1282, 'chimie descriptive', 'feuille', 1228, 59);
INSERT INTO `les_noeuds` VALUES (1283, 'vitesse d''une réaction et loi de Le Chatelier', 'feuille', 1228, 59);
INSERT INTO `les_noeuds` VALUES (1284, 'acide, base, constante d''acidité, force relative', 'feuille', 1228, 59);
INSERT INTO `les_noeuds` VALUES (1285, 'réaction acido-basique, calcul de Ph, dosage et solution tampon', 'feuille', 1228, 59);
INSERT INTO `les_noeuds` VALUES (1286, 'solubilité, précipitation et saturation', 'feuille', 1228, 59);
INSERT INTO `les_noeuds` VALUES (1287, 'complexation', 'feuille', 1228, 59);
INSERT INTO `les_noeuds` VALUES (1288, 'oxydoréduction, oxydant réducteur, demi-équation électronique, nombres d''oxydation', 'feuille', 1228, 59);
INSERT INTO `les_noeuds` VALUES (1289, 'législation du travail', 'branche', 0, 59);
INSERT INTO `les_noeuds` VALUES (1290, 'notions générales de droit', 'feuille', 1289, 59);
INSERT INTO `les_noeuds` VALUES (1291, 'le droit du travail', 'branche', 1289, 59);
INSERT INTO `les_noeuds` VALUES (1292, 'le contrat de travail', 'feuille', 1291, 59);
INSERT INTO `les_noeuds` VALUES (1293, 'le contrat de travail à durée déterminée', 'feuille', 1291, 59);
INSERT INTO `les_noeuds` VALUES (1294, 'le travail à temps partiel', 'feuille', 1291, 59);
INSERT INTO `les_noeuds` VALUES (1295, 'travail temporaire', 'feuille', 1291, 59);
INSERT INTO `les_noeuds` VALUES (1296, 'l''embauche', 'feuille', 1291, 59);
INSERT INTO `les_noeuds` VALUES (1297, 'la rémunération', 'feuille', 1291, 59);
INSERT INTO `les_noeuds` VALUES (1298, 'la durée du travail', 'feuille', 1291, 59);
INSERT INTO `les_noeuds` VALUES (1299, 'les congés payés', 'feuille', 1291, 59);
INSERT INTO `les_noeuds` VALUES (1300, 'la maladie', 'feuille', 1291, 59);
INSERT INTO `les_noeuds` VALUES (1301, 'les accidents du travail et maladies professionnelles', 'feuille', 1291, 59);
INSERT INTO `les_noeuds` VALUES (1302, 'la maternité', 'feuille', 1291, 59);
INSERT INTO `les_noeuds` VALUES (1303, 'la démission', 'feuille', 1291, 59);
INSERT INTO `les_noeuds` VALUES (1304, 'le pouvoir disciplinaire de l''employeur', 'feuille', 1291, 59);
INSERT INTO `les_noeuds` VALUES (1305, 'le licenciement non économique', 'feuille', 1291, 59);
INSERT INTO `les_noeuds` VALUES (1306, 'le licenciement économique', 'feuille', 1291, 59);
INSERT INTO `les_noeuds` VALUES (1307, 'la formation en alternance', 'feuille', 1291, 59);
INSERT INTO `les_noeuds` VALUES (1308, 'les syndicats et le droits syndical', 'feuille', 1291, 59);
INSERT INTO `les_noeuds` VALUES (1309, 'les institutions représentatives du personnel dans l''entreprise', 'feuille', 1291, 59);
INSERT INTO `les_noeuds` VALUES (1310, 'le chômage', 'feuille', 1291, 59);
INSERT INTO `les_noeuds` VALUES (1311, 'hygiène et sécurité', 'feuille', 1291, 59);
INSERT INTO `les_noeuds` VALUES (1312, 'inspection du travail', 'feuille', 1291, 59);
INSERT INTO `les_noeuds` VALUES (1313, 'médecine du travail', 'feuille', 1291, 59);
INSERT INTO `les_noeuds` VALUES (1314, 'le conseil de prud''hommes', 'feuille', 1291, 59);
INSERT INTO `les_noeuds` VALUES (1315, 'les structures paritaires', 'feuille', 1291, 59);
INSERT INTO `les_noeuds` VALUES (1316, 'législation pharmaceutique', 'branche', 0, 59);
INSERT INTO `les_noeuds` VALUES (1317, 'la pharmacie', 'feuille', 1316, 59);
INSERT INTO `les_noeuds` VALUES (1318, 'les produits commercialisés à l''officine', 'branche', 1316, 59);
INSERT INTO `les_noeuds` VALUES (1319, 'la définition du médicament', 'feuille', 1318, 59);
INSERT INTO `les_noeuds` VALUES (1320, 'la dénomination du médicament', 'feuille', 1318, 59);
INSERT INTO `les_noeuds` VALUES (1321, 'l''étiquetage des médicaments', 'feuille', 1318, 59);
INSERT INTO `les_noeuds` VALUES (1322, 'les autorisations préalables de mise sur le marché', 'feuille', 1318, 59);
INSERT INTO `les_noeuds` VALUES (1323, 'la publicité pour les médicaments', 'feuille', 1318, 59);
INSERT INTO `les_noeuds` VALUES (1324, 'le remboursement des médicaments', 'feuille', 1318, 59);
INSERT INTO `les_noeuds` VALUES (1325, 'les autres produits vendus en officine', 'feuille', 1318, 59);
INSERT INTO `les_noeuds` VALUES (1326, 'l''exercice de la profession de pharmacien, de préparateur en pharmacie, d''employé en pharmacie', 'branche', 1316, 59);
INSERT INTO `les_noeuds` VALUES (1327, 'les professionnels', 'feuille', 1326, 59);
INSERT INTO `les_noeuds` VALUES (1328, 'les conditions d''exercice', 'feuille', 1326, 59);
INSERT INTO `les_noeuds` VALUES (1329, 'les modalités d''exercice', 'feuille', 1326, 59);
INSERT INTO `les_noeuds` VALUES (1330, 'l''officine de pharmacie', 'branche', 1316, 59);
INSERT INTO `les_noeuds` VALUES (1331, 'la définition de l''officine', 'feuille', 1330, 59);
INSERT INTO `les_noeuds` VALUES (1332, 'l''approvisionnement de l''officine', 'feuille', 1330, 59);
INSERT INTO `les_noeuds` VALUES (1333, 'ouvrages officiels et autres ouvrages de référence', 'feuille', 1330, 59);
INSERT INTO `les_noeuds` VALUES (1334, 'les modalités de délivrance', 'branche', 1316, 59);
INSERT INTO `les_noeuds` VALUES (1335, 'la réglementation des substances vénéneuses', 'branche', 1316, 59);
INSERT INTO `les_noeuds` VALUES (1336, 'le conseil national de l''ordre des pharmaciens', 'branche', 1316, 59);
INSERT INTO `les_noeuds` VALUES (1337, 'les autorités publiques', 'feuille', 1316, 59);
INSERT INTO `les_noeuds` VALUES (1338, 'l''europe', 'feuille', 1316, 59);
INSERT INTO `les_noeuds` VALUES (1339, 'les prescripteurs', 'feuille', 1334, 59);
INSERT INTO `les_noeuds` VALUES (1340, 'l''ordonnance', 'feuille', 1334, 59);
INSERT INTO `les_noeuds` VALUES (1341, 'le portage et la dispensation à l''officine', 'feuille', 1334, 59);
INSERT INTO `les_noeuds` VALUES (1342, 'la pharmacovigilance', 'feuille', 1334, 59);
INSERT INTO `les_noeuds` VALUES (1343, 'le statut des substances vénéneuses', 'feuille', 1335, 59);
INSERT INTO `les_noeuds` VALUES (1344, 'les classement des substances vénéneuses', 'feuille', 1335, 59);
INSERT INTO `les_noeuds` VALUES (1345, 'le régime particulier des substances vénéneuses', 'feuille', 1335, 59);
INSERT INTO `les_noeuds` VALUES (1346, 'organisation', 'feuille', 1336, 59);
INSERT INTO `les_noeuds` VALUES (1347, 'rôle', 'feuille', 1336, 59);
INSERT INTO `les_noeuds` VALUES (1348, 'le code de déontologie des pharmaciens', 'feuille', 1336, 59);
INSERT INTO `les_noeuds` VALUES (1349, 'le médicament vétérinaire', 'branche', 1316, 59);
INSERT INTO `les_noeuds` VALUES (1350, 'définition du médicament vétérinaire', 'feuille', 1349, 59);
INSERT INTO `les_noeuds` VALUES (1351, 'l''étiquetage', 'feuille', 1349, 59);
INSERT INTO `les_noeuds` VALUES (1352, 'l''A.M.M.', 'feuille', 1349, 59);
INSERT INTO `les_noeuds` VALUES (1353, 'la préparation des médicaments vétérinaires', 'feuille', 1349, 59);
INSERT INTO `les_noeuds` VALUES (1354, 'la détention des médicaments vétérinaires', 'feuille', 1349, 59);
INSERT INTO `les_noeuds` VALUES (1355, 'la délivrance des médicaments vétérinaires', 'feuille', 1349, 59);
INSERT INTO `les_noeuds` VALUES (1356, 'l''ordonnancier', 'feuille', 1349, 59);
INSERT INTO `les_noeuds` VALUES (1357, 'la publicité des médicaments vétérinaires', 'feuille', 1349, 59);
INSERT INTO `les_noeuds` VALUES (1358, 'les autres produits à usage vétérinaire ne répondant pas à la définition du médicament vétérinaire', 'feuille', 1349, 59);
INSERT INTO `les_noeuds` VALUES (1359, 'la documentation vétérinaire', 'feuille', 1349, 59);
INSERT INTO `les_noeuds` VALUES (1360, 'gestion à l''officine', 'branche', 0, 59);
INSERT INTO `les_noeuds` VALUES (1361, 'le commerçant et ses obligations', 'feuille', 1360, 59);
INSERT INTO `les_noeuds` VALUES (1362, 'le fond de commerce', 'feuille', 1360, 59);
INSERT INTO `les_noeuds` VALUES (1363, 'les différentes formes d''entreprises commerciales', 'feuille', 1360, 59);
INSERT INTO `les_noeuds` VALUES (1364, 'notions de gestion comptable en officine. Bilan. Compte de résultat', 'feuille', 1360, 59);
INSERT INTO `les_noeuds` VALUES (1365, 'la rotation de stock', 'feuille', 1360, 59);
INSERT INTO `les_noeuds` VALUES (1366, 'la mini fiche de stock', 'feuille', 1360, 59);
INSERT INTO `les_noeuds` VALUES (1367, 'le code à barre', 'feuille', 1360, 59);
INSERT INTO `les_noeuds` VALUES (1368, 'réception, déballage et vérification d''une commande', 'feuille', 1360, 59);
INSERT INTO `les_noeuds` VALUES (1369, 'les fiches de stock', 'feuille', 1360, 59);
INSERT INTO `les_noeuds` VALUES (1370, 'les différents modes de rangement des produits', 'feuille', 1360, 59);
INSERT INTO `les_noeuds` VALUES (1371, 'les différentes méthodes de conservation des médicaments', 'feuille', 1360, 59);
INSERT INTO `les_noeuds` VALUES (1372, 'rangement des produits livrés', 'feuille', 1360, 59);
INSERT INTO `les_noeuds` VALUES (1373, 'les produits périmés ou périmables', 'feuille', 1360, 59);
INSERT INTO `les_noeuds` VALUES (1374, 'les taux de T.V.A. différentes catégories de médicaments assujettis', 'feuille', 1360, 59);
INSERT INTO `les_noeuds` VALUES (1375, 'rédaction et vérification d''une facture et d''autres documents commerciaux', 'feuille', 1360, 59);
INSERT INTO `les_noeuds` VALUES (1376, 'calcul et répartition de la T.V.A. sur les factures', 'feuille', 1360, 59);
INSERT INTO `les_noeuds` VALUES (1377, 'calcul du prix de vente T.T.C. à partir du P.A.H.T.', 'feuille', 1360, 59);
INSERT INTO `les_noeuds` VALUES (1378, 'utilisation d''un taux de marque et des coefficients multiplicateurs', 'feuille', 1360, 59);
INSERT INTO `les_noeuds` VALUES (1379, 'l''ordonnance', 'feuille', 1360, 59);
INSERT INTO `les_noeuds` VALUES (1380, 'inscriptions sur les feuilles de maladie', 'feuille', 1360, 59);
INSERT INTO `les_noeuds` VALUES (1381, 'établissement de factures en paiement différé', 'feuille', 1360, 59);
INSERT INTO `les_noeuds` VALUES (1382, 'gestion des dossiers dans le cadre du remboursement du pharmacien', 'feuille', 1360, 59);
INSERT INTO `les_noeuds` VALUES (1383, 'inventaire de l''officine', 'feuille', 1360, 59);
INSERT INTO `les_noeuds` VALUES (1384, 'communication professionnelle', 'branche', 0, 59);
INSERT INTO `les_noeuds` VALUES (1385, 'la protection de l''information', 'feuille', 1384, 59);
INSERT INTO `les_noeuds` VALUES (1386, 'les différentes formes de communication', 'feuille', 1384, 59);
INSERT INTO `les_noeuds` VALUES (1387, 'les sources documentaires', 'feuille', 1384, 59);
INSERT INTO `les_noeuds` VALUES (1388, 'les techniques de communication', 'feuille', 1384, 59);
INSERT INTO `les_noeuds` VALUES (1389, 'biochimie', 'branche', 0, 59);
INSERT INTO `les_noeuds` VALUES (1390, 'organisation moléculaire de la matière vivante', 'branche', 1389, 59);
INSERT INTO `les_noeuds` VALUES (1391, 'composition élémentaire de la matière vivante', 'feuille', 1390, 59);
INSERT INTO `les_noeuds` VALUES (1392, 'constituants minéraux', 'feuille', 1390, 59);
INSERT INTO `les_noeuds` VALUES (1393, 'méthodes d''étude et d''analyse des biomolécules', 'branche', 1389, 59);
INSERT INTO `les_noeuds` VALUES (1394, 'structures et propriétés des biomolécules', 'branche', 1389, 59);
INSERT INTO `les_noeuds` VALUES (1395, 'enzymologie', 'branche', 1389, 59);
INSERT INTO `les_noeuds` VALUES (1396, 'le métabolisme énergétique', 'feuille', 1389, 59);
INSERT INTO `les_noeuds` VALUES (1397, 'l''échantillon', 'feuille', 1393, 59);
INSERT INTO `les_noeuds` VALUES (1398, 'méthodes d''extraction', 'feuille', 1393, 59);
INSERT INTO `les_noeuds` VALUES (1399, 'méthodes de fractionnement et de purification', 'feuille', 1393, 59);
INSERT INTO `les_noeuds` VALUES (1400, 'méthodes de dosage', 'feuille', 1393, 59);
INSERT INTO `les_noeuds` VALUES (1401, 'les glucides', 'feuille', 1394, 59);
INSERT INTO `les_noeuds` VALUES (1402, 'les protides', 'feuille', 1394, 59);
INSERT INTO `les_noeuds` VALUES (1403, 'les acides nucléiques', 'feuille', 1394, 59);
INSERT INTO `les_noeuds` VALUES (1404, 'les lipides', 'feuille', 1394, 59);
INSERT INTO `les_noeuds` VALUES (1405, 'catalyse enzymatique', 'feuille', 1395, 59);
INSERT INTO `les_noeuds` VALUES (1406, 'nature biochimique des enzymes', 'feuille', 1395, 59);
INSERT INTO `les_noeuds` VALUES (1407, 'activité enzymatique', 'feuille', 1395, 59);
INSERT INTO `les_noeuds` VALUES (1408, 'coenzymes et vitamines', 'feuille', 1395, 59);
INSERT INTO `les_noeuds` VALUES (1409, 'microbiologie', 'branche', 0, 59);
INSERT INTO `les_noeuds` VALUES (1410, 'diversité du monde microbien', 'feuille', 1409, 59);
INSERT INTO `les_noeuds` VALUES (1411, 'morphologie et structure des micro-organismes', 'branche', 1409, 59);
INSERT INTO `les_noeuds` VALUES (1412, 'nutrition et croissance des bactéries', 'branche', 1409, 59);
INSERT INTO `les_noeuds` VALUES (1413, 'métabolisme bactérien et fongique', 'branche', 1409, 59);
INSERT INTO `les_noeuds` VALUES (1414, 'élément de taxonomie', 'feuille', 1409, 59);
INSERT INTO `les_noeuds` VALUES (1415, 'agents antimicrobiens', 'branche', 1409, 59);
INSERT INTO `les_noeuds` VALUES (1416, 'les virus', 'feuille', 1409, 59);
INSERT INTO `les_noeuds` VALUES (1417, 'micro-organismes et milieu', 'branche', 1409, 59);
INSERT INTO `les_noeuds` VALUES (1418, 'morphologie et structure des bactéries', 'feuille', 1411, 59);
INSERT INTO `les_noeuds` VALUES (1419, 'morphologie et structure des cellules fungiques', 'feuille', 1411, 59);
INSERT INTO `les_noeuds` VALUES (1420, 'besoins nutritifs', 'feuille', 1412, 59);
INSERT INTO `les_noeuds` VALUES (1421, 'multiplication des bactéries', 'feuille', 1412, 59);
INSERT INTO `les_noeuds` VALUES (1422, 'croissance d''une population bactérienne en milieu non renouvelé', 'feuille', 1412, 59);
INSERT INTO `les_noeuds` VALUES (1423, 'types respiratoires', 'feuille', 1413, 59);
INSERT INTO `les_noeuds` VALUES (1424, 'fermentations', 'feuille', 1413, 59);
INSERT INTO `les_noeuds` VALUES (1425, 'agents physiques', 'feuille', 1415, 59);
INSERT INTO `les_noeuds` VALUES (1426, 'agents chimiques', 'feuille', 1415, 59);
INSERT INTO `les_noeuds` VALUES (1427, 'relations entre les micro-organismes et leur environnement', 'feuille', 1417, 59);
INSERT INTO `les_noeuds` VALUES (1428, 'pouvoir pathogène des bactéries', 'feuille', 1417, 59);
INSERT INTO `les_noeuds` VALUES (1429, 'immunologie', 'branche', 0, 59);
INSERT INTO `les_noeuds` VALUES (1430, 'botanique', 'branche', 0, 59);
INSERT INTO `les_noeuds` VALUES (1431, 'anatomie physiologie', 'branche', 0, 59);
INSERT INTO `les_noeuds` VALUES (1432, 'pathologie', 'branche', 0, 59);
INSERT INTO `les_noeuds` VALUES (1433, 'pharmacologie', 'branche', 0, 59);
INSERT INTO `les_noeuds` VALUES (1434, 'toxicologie', 'branche', 0, 59);
INSERT INTO `les_noeuds` VALUES (1435, 'le "soi" et le "non soi" ou l''identité biologique', 'feuille', 1429, 59);
INSERT INTO `les_noeuds` VALUES (1436, 'tissus et cellules de l''immunité', 'feuille', 1429, 59);
INSERT INTO `les_noeuds` VALUES (1437, 'l''immunité non spécifique', 'feuille', 1429, 59);
INSERT INTO `les_noeuds` VALUES (1438, 'l''immunité spécifique', 'branche', 1429, 59);
INSERT INTO `les_noeuds` VALUES (1439, 'les caractéristiques de l''immunité spécifique', 'feuille', 1438, 59);
INSERT INTO `les_noeuds` VALUES (1440, 'les anticorps et l''immunité spécifique', 'feuille', 1438, 59);
INSERT INTO `les_noeuds` VALUES (1441, 'l''immunité à médiation cellulaire', 'feuille', 1438, 59);
INSERT INTO `les_noeuds` VALUES (1442, 'la mémoire immunitaire', 'feuille', 1438, 59);
INSERT INTO `les_noeuds` VALUES (1443, 'la tolérance immunitaire', 'feuille', 1438, 59);
INSERT INTO `les_noeuds` VALUES (1444, 'l''immunité anti-infectieuse', 'feuille', 1429, 59);
INSERT INTO `les_noeuds` VALUES (1445, 'dysfonctionnement su système immunitaire', 'branche', 1429, 59);
INSERT INTO `les_noeuds` VALUES (1446, 'les réactions d''hypersensibilité', 'feuille', 1445, 59);
INSERT INTO `les_noeuds` VALUES (1447, 'les maladies auto-immunes', 'feuille', 1445, 59);
INSERT INTO `les_noeuds` VALUES (1448, 'les déficits immunitaires', 'feuille', 1445, 59);
INSERT INTO `les_noeuds` VALUES (1449, 'applications médicales', 'branche', 1429, 59);
INSERT INTO `les_noeuds` VALUES (1450, 'vaccination et sérothérapie', 'feuille', 1449, 59);
INSERT INTO `les_noeuds` VALUES (1451, 'greffes et transplantations d''organes', 'feuille', 1449, 59);
INSERT INTO `les_noeuds` VALUES (1452, 'la cellule végétale', 'feuille', 1430, 59);
INSERT INTO `les_noeuds` VALUES (1453, 'les tissus végétaux', 'feuille', 1430, 59);
INSERT INTO `les_noeuds` VALUES (1454, 'organisation du règne végétal', 'branche', 1430, 59);
INSERT INTO `les_noeuds` VALUES (1455, 'présentation', 'feuille', 1454, 59);
INSERT INTO `les_noeuds` VALUES (1456, 'étude systématique des principaux groupes', 'feuille', 1454, 59);
INSERT INTO `les_noeuds` VALUES (1457, 'utilisation d''une clé botanique simple pour une identification dans la nature', 'feuille', 1430, 59);
INSERT INTO `les_noeuds` VALUES (1458, 'notions élémentaires sur la répartition des végétaux', 'feuille', 1430, 59);
INSERT INTO `les_noeuds` VALUES (1459, 'influence du milieu', 'feuille', 1430, 59);
INSERT INTO `les_noeuds` VALUES (1460, 'influence de l''homme', 'feuille', 1430, 59);
INSERT INTO `les_noeuds` VALUES (1461, 'pharmacognosie', 'branche', 0, 59);
INSERT INTO `les_noeuds` VALUES (1462, 'homéopathie', 'branche', 0, 59);
INSERT INTO `les_noeuds` VALUES (1463, 'phytothérapie', 'branche', 0, 59);
INSERT INTO `les_noeuds` VALUES (1464, 'dispositifs médicaux', 'branche', 0, 59);
INSERT INTO `les_noeuds` VALUES (1465, 'pharmacie galénique', 'branche', 0, 59);
INSERT INTO `les_noeuds` VALUES (1466, 'organisation des systèmes vivants', 'branche', 1431, 59);
INSERT INTO `les_noeuds` VALUES (1467, 'organes et appareils', 'feuille', 1466, 59);
INSERT INTO `les_noeuds` VALUES (1468, 'cellules et tissus', 'feuille', 1466, 59);
INSERT INTO `les_noeuds` VALUES (1469, 'fonctions de relation', 'branche', 1431, 59);
INSERT INTO `les_noeuds` VALUES (1470, 'les structures excitables', 'feuille', 1469, 59);
INSERT INTO `les_noeuds` VALUES (1471, 'système locomoteur', 'feuille', 1469, 59);
INSERT INTO `les_noeuds` VALUES (1472, 'le système nerveux', 'feuille', 1469, 59);
INSERT INTO `les_noeuds` VALUES (1473, 'fonctions de nutrition', 'branche', 1431, 59);
INSERT INTO `les_noeuds` VALUES (1474, 'le milieu intérieur', 'feuille', 1473, 59);
INSERT INTO `les_noeuds` VALUES (1475, 'la circulation sanguine', 'feuille', 1473, 59);
INSERT INTO `les_noeuds` VALUES (1476, 'la respiration', 'feuille', 1473, 59);
INSERT INTO `les_noeuds` VALUES (1477, 'digestion et absorption', 'feuille', 1473, 59);
INSERT INTO `les_noeuds` VALUES (1478, 'fonctions rénales', 'feuille', 1473, 59);
INSERT INTO `les_noeuds` VALUES (1479, 'le système endocrinien', 'feuille', 1431, 59);
INSERT INTO `les_noeuds` VALUES (1480, 'la peau et ses fonctions', 'feuille', 1431, 59);
INSERT INTO `les_noeuds` VALUES (1481, 'transmission de la vie', 'branche', 1431, 59);
INSERT INTO `les_noeuds` VALUES (1482, 'organisation de l''appareil génital', 'feuille', 1481, 59);
INSERT INTO `les_noeuds` VALUES (1483, 'gamétogénèse', 'feuille', 1481, 59);
INSERT INTO `les_noeuds` VALUES (1484, 'déterminisme neuro-hormonal de la physiologie sexuelle', 'feuille', 1481, 59);
INSERT INTO `les_noeuds` VALUES (1485, 'fécondation', 'feuille', 1481, 59);
INSERT INTO `les_noeuds` VALUES (1486, 'maîtrise de la reproduction', 'feuille', 1481, 59);
INSERT INTO `les_noeuds` VALUES (1487, 'gestation', 'feuille', 1481, 59);
INSERT INTO `les_noeuds` VALUES (1488, 'méthodes et moyens d''études des maladies', 'branche', 1432, 59);
INSERT INTO `les_noeuds` VALUES (1489, 'généralités sur le diagnostic', 'feuille', 1488, 59);
INSERT INTO `les_noeuds` VALUES (1490, 'notion de pronostic', 'feuille', 1488, 59);
INSERT INTO `les_noeuds` VALUES (1491, 'étude clinique', 'feuille', 1488, 59);
INSERT INTO `les_noeuds` VALUES (1492, 'examens paracliniques', 'feuille', 1488, 59);
INSERT INTO `les_noeuds` VALUES (1493, 'infectiologie et parasitologie', 'branche', 1432, 59);
INSERT INTO `les_noeuds` VALUES (1494, 'pathologie de l''appareil locomoteur', 'feuille', 1432, 59);
INSERT INTO `les_noeuds` VALUES (1495, 'affections du système nerveux', 'feuille', 1432, 59);
INSERT INTO `les_noeuds` VALUES (1496, 'affections mentales', 'feuille', 1432, 59);
INSERT INTO `les_noeuds` VALUES (1497, 'affections cardiovasculaires', 'feuille', 1432, 59);
INSERT INTO `les_noeuds` VALUES (1498, 'maladies du sang', 'feuille', 1432, 59);
INSERT INTO `les_noeuds` VALUES (1499, 'maladies de l''appareil respiratoire', 'feuille', 1432, 59);
INSERT INTO `les_noeuds` VALUES (1500, 'maladies de l''appaeril digestif et de ses annexes', 'feuille', 1432, 59);
INSERT INTO `les_noeuds` VALUES (1501, 'maladies de l''appareil urinaire', 'feuille', 1432, 59);
INSERT INTO `les_noeuds` VALUES (1502, 'affections des organes des sens', 'feuille', 1432, 59);
INSERT INTO `les_noeuds` VALUES (1503, 'affections cutanées', 'feuille', 1432, 59);
INSERT INTO `les_noeuds` VALUES (1504, 'maladies des glandes endocrines', 'feuille', 1432, 59);
INSERT INTO `les_noeuds` VALUES (1505, 'troubles métaboliques', 'feuille', 1432, 59);
INSERT INTO `les_noeuds` VALUES (1506, 'cancers', 'feuille', 1432, 59);
INSERT INTO `les_noeuds` VALUES (1507, 'les processus infectieux et parasitaires', 'feuille', 1493, 59);
INSERT INTO `les_noeuds` VALUES (1508, 'les circonstances d''apparition des processus infectieux et parasitaires', 'feuille', 1493, 59);
INSERT INTO `les_noeuds` VALUES (1509, 'la chaine de transmission', 'feuille', 1493, 59);
INSERT INTO `les_noeuds` VALUES (1510, 'réservoirs de germes et modes de transmission', 'feuille', 1493, 59);
INSERT INTO `les_noeuds` VALUES (1511, 'principales maladies infectieuses et parasitaires dans le monde', 'feuille', 1493, 59);
INSERT INTO `les_noeuds` VALUES (1512, 'prévention', 'feuille', 1493, 59);
INSERT INTO `les_noeuds` VALUES (1513, 'exemple d''une pandémie', 'feuille', 1493, 59);
INSERT INTO `les_noeuds` VALUES (1514, 'éléments de pharmacologie générale', 'branche', 1433, 59);
INSERT INTO `les_noeuds` VALUES (1515, 'les médicaments anti-infectieux', 'feuille', 1433, 59);
INSERT INTO `les_noeuds` VALUES (1516, 'les médicaments anticancéreux', 'feuille', 1433, 59);
INSERT INTO `les_noeuds` VALUES (1517, 'les médicaments antalgiques', 'feuille', 1433, 59);
INSERT INTO `les_noeuds` VALUES (1518, 'les médicaments antiinflammatoires', 'feuille', 1433, 59);
INSERT INTO `les_noeuds` VALUES (1519, 'les médicaments intervenants dans les réactions immunitaires', 'feuille', 1433, 59);
INSERT INTO `les_noeuds` VALUES (1520, 'les médicaments corrigeants les troubles neurologiques et:les médicamentsu neuropsychiques', 'feuille', 1433, 59);
INSERT INTO `les_noeuds` VALUES (1521, 'les médicaments corrigeants les troubles cardiovasculaires et/ou vasculaires', 'feuille', 1433, 59);
INSERT INTO `les_noeuds` VALUES (1522, 'les médicaments corrigeants les troubles sanguins', 'feuille', 1433, 59);
INSERT INTO `les_noeuds` VALUES (1523, 'les médicaments corrigeants les troubles broncho-pulmonaires', 'feuille', 1433, 59);
INSERT INTO `les_noeuds` VALUES (1524, 'les médicaments corrigeants les troubles gastro-intestinaux', 'feuille', 1433, 59);
INSERT INTO `les_noeuds` VALUES (1525, 'les médicaments corrigeants les troubles endocriniens', 'feuille', 1433, 59);
INSERT INTO `les_noeuds` VALUES (1526, 'les médicaments corrigeants les troubles métaboliques', 'feuille', 1433, 59);
INSERT INTO `les_noeuds` VALUES (1527, 'les médicaments en dermatologie', 'feuille', 1433, 59);
INSERT INTO `les_noeuds` VALUES (1528, 'les médicamenst en ophtalmologie', 'feuille', 1433, 59);
INSERT INTO `les_noeuds` VALUES (1529, 'les médicaments utilisés en ORL et stomatologie', 'feuille', 1433, 59);
INSERT INTO `les_noeuds` VALUES (1530, 'les médicaments corrigeants les troubles génito-urinaires', 'feuille', 1433, 59);
INSERT INTO `les_noeuds` VALUES (1531, 'les médicaments utilisés en gynéco-obstétrique', 'feuille', 1433, 59);
INSERT INTO `les_noeuds` VALUES (1532, 'les produits de contraste', 'feuille', 1433, 59);
INSERT INTO `les_noeuds` VALUES (1533, 'les médicaments des traitements de substitution dans le cadre de la prise en charge des toxicomanies', 'feuille', 1433, 59);
INSERT INTO `les_noeuds` VALUES (1534, 'les interactions majeures et dangereuses', 'feuille', 1433, 59);
INSERT INTO `les_noeuds` VALUES (1535, 'le devenir du médicament dans l''organisme (pharmacocinétique)', 'feuille', 1514, 59);
INSERT INTO `les_noeuds` VALUES (1536, 'les mécanismes d''action des médicaments (pharmacodynamie)', 'feuille', 1514, 59);
INSERT INTO `les_noeuds` VALUES (1537, 'les interactions médicamenteuses', 'feuille', 1514, 59);
INSERT INTO `les_noeuds` VALUES (1538, 'les dangers des médicaments', 'feuille', 1514, 59);
INSERT INTO `les_noeuds` VALUES (1539, 'caractères généraux', 'branche', 1434, 59);
INSERT INTO `les_noeuds` VALUES (1540, 'produits responsables d''intoxication', 'branche', 1434, 59);
INSERT INTO `les_noeuds` VALUES (1541, 'lutte contre l''intoxication', 'branche', 1434, 59);
INSERT INTO `les_noeuds` VALUES (1542, 'définitions', 'feuille', 1539, 59);
INSERT INTO `les_noeuds` VALUES (1543, 'doses et modulation des effets toxiques', 'feuille', 1539, 59);
INSERT INTO `les_noeuds` VALUES (1544, 'effets toxiques', 'feuille', 1539, 59);
INSERT INTO `les_noeuds` VALUES (1545, 'médicaments toxicomanogènes', 'feuille', 1540, 59);
INSERT INTO `les_noeuds` VALUES (1546, 'médicaments détournés de leur utilisation normale à des fins d''intoxication volontaire', 'feuille', 1540, 59);
INSERT INTO `les_noeuds` VALUES (1547, 'médicaments utilisés pour le dopage', 'feuille', 1540, 59);
INSERT INTO `les_noeuds` VALUES (1548, 'végétaux toxiques', 'feuille', 1540, 59);
INSERT INTO `les_noeuds` VALUES (1549, 'traitement symptomatique et antidotes', 'feuille', 1541, 59);
INSERT INTO `les_noeuds` VALUES (1550, 'pharmacovigilance', 'feuille', 1541, 59);
INSERT INTO `les_noeuds` VALUES (1551, 'production des plantes pharmaceutiques', 'feuille', 1461, 59);
INSERT INTO `les_noeuds` VALUES (1552, 'drogues à glucides', 'feuille', 1461, 59);
INSERT INTO `les_noeuds` VALUES (1553, 'plantes à lipides', 'feuille', 1461, 59);
INSERT INTO `les_noeuds` VALUES (1554, 'plantes à huiles essentielles', 'feuille', 1461, 59);
INSERT INTO `les_noeuds` VALUES (1555, 'plantes à résines, oléorésines et baumes', 'feuille', 1461, 59);
INSERT INTO `les_noeuds` VALUES (1556, 'plantes à alcaloïdes', 'feuille', 1461, 59);
INSERT INTO `les_noeuds` VALUES (1557, 'plantes à iridoïdes', 'feuille', 1461, 59);
INSERT INTO `les_noeuds` VALUES (1558, 'autres groupes', 'feuille', 1461, 59);
INSERT INTO `les_noeuds` VALUES (1559, 'définitions de l''homéopathie', 'feuille', 1462, 59);
INSERT INTO `les_noeuds` VALUES (1560, 'législation', 'feuille', 1462, 59);
INSERT INTO `les_noeuds` VALUES (1561, 'galénique homéopathique', 'feuille', 1462, 59);
INSERT INTO `les_noeuds` VALUES (1562, 'diathèses et terrains', 'branche', 1462, 59);
INSERT INTO `les_noeuds` VALUES (1563, 'les diathèses', 'feuille', 1562, 59);
INSERT INTO `les_noeuds` VALUES (1564, 'les constitutions', 'feuille', 1562, 59);
INSERT INTO `les_noeuds` VALUES (1565, 'caractéristiques des remèdes', 'feuille', 1462, 59);
INSERT INTO `les_noeuds` VALUES (1566, 'l''ordonnance homéopathique', 'feuille', 1462, 59);
INSERT INTO `les_noeuds` VALUES (1567, 'définition de la phytothérapie', 'feuille', 1463, 59);
INSERT INTO `les_noeuds` VALUES (1568, 'galénique phytothérapique', 'feuille', 1463, 59);
INSERT INTO `les_noeuds` VALUES (1569, 'législation phytothérapique', 'feuille', 1463, 59);
INSERT INTO `les_noeuds` VALUES (1570, 'toxicité et limites de la phytothérapie', 'feuille', 1463, 59);
INSERT INTO `les_noeuds` VALUES (1571, 'le conseil en phytothérapie', 'feuille', 1463, 59);
INSERT INTO `les_noeuds` VALUES (1572, 'le stockage à l''officine', 'feuille', 1463, 59);
INSERT INTO `les_noeuds` VALUES (1573, 'définition d''un dispositif médical', 'feuille', 1464, 59);
INSERT INTO `les_noeuds` VALUES (1574, 'poires, bock à douche et canules', 'feuille', 1464, 59);
INSERT INTO `les_noeuds` VALUES (1575, 'seringues et aiguilles', 'feuille', 1464, 59);
INSERT INTO `les_noeuds` VALUES (1576, 'sondes', 'feuille', 1464, 59);
INSERT INTO `les_noeuds` VALUES (1577, 'aiguilles serties', 'feuille', 1464, 59);
INSERT INTO `les_noeuds` VALUES (1578, 'articles anticonceptionnels', 'feuille', 1464, 59);
INSERT INTO `les_noeuds` VALUES (1579, 'articles de pansement', 'feuille', 1464, 59);
INSERT INTO `les_noeuds` VALUES (1580, 'thermomètres', 'feuille', 1464, 59);
INSERT INTO `les_noeuds` VALUES (1581, 'poches de recueil pour stomie', 'feuille', 1464, 59);
INSERT INTO `les_noeuds` VALUES (1582, 'articles pour incontinence urinaire', 'feuille', 1464, 59);
INSERT INTO `les_noeuds` VALUES (1583, 'les autotests', 'feuille', 1464, 59);
INSERT INTO `les_noeuds` VALUES (1584, 'produits pour l''entretien des lentilles de contact', 'feuille', 1464, 59);
INSERT INTO `les_noeuds` VALUES (1585, 'opérations de mesure en officine', 'branche', 1465, 59);
INSERT INTO `les_noeuds` VALUES (1586, 'opérations pharmaceutiques', 'branche', 1465, 59);
INSERT INTO `les_noeuds` VALUES (1587, 'les voies d''administration des médicaments', 'feuille', 1465, 59);
INSERT INTO `les_noeuds` VALUES (1588, 'les différentes formes pharmaceutiques', 'branche', 1465, 59);
INSERT INTO `les_noeuds` VALUES (1589, 'excipients, adjuvants et colorants', 'branche', 1465, 59);
INSERT INTO `les_noeuds` VALUES (1590, 'conservation et conditionnement des préparations', 'feuille', 1465, 59);
INSERT INTO `les_noeuds` VALUES (1591, 'aspects réglementaires et assurance qualité de la pharmacie galénique', 'feuille', 1465, 59);
INSERT INTO `les_noeuds` VALUES (1592, 'mesure en masse', 'feuille', 1585, 59);
INSERT INTO `les_noeuds` VALUES (1593, 'les balances', 'feuille', 1585, 59);
INSERT INTO `les_noeuds` VALUES (1594, 'mesure en gouttes', 'feuille', 1585, 59);
INSERT INTO `les_noeuds` VALUES (1595, 'mesures en volume', 'feuille', 1585, 59);
INSERT INTO `les_noeuds` VALUES (1596, 'masses volumiques et densités', 'feuille', 1585, 59);
INSERT INTO `les_noeuds` VALUES (1597, 'les conversions', 'feuille', 1585, 59);
INSERT INTO `les_noeuds` VALUES (1598, 'le matériel d''usage courant', 'feuille', 1585, 59);
INSERT INTO `les_noeuds` VALUES (1599, 'la dessication', 'feuille', 1586, 59);
INSERT INTO `les_noeuds` VALUES (1600, 'la pulvérisation', 'feuille', 1586, 59);
INSERT INTO `les_noeuds` VALUES (1601, 'les mélanges et dispersions', 'feuille', 1586, 59);
INSERT INTO `les_noeuds` VALUES (1602, 'la dissolution', 'feuille', 1586, 59);
INSERT INTO `les_noeuds` VALUES (1603, 'les opérations de séparation', 'feuille', 1586, 59);
INSERT INTO `les_noeuds` VALUES (1604, 'la distillation', 'feuille', 1586, 59);
INSERT INTO `les_noeuds` VALUES (1605, 'la stérilisation', 'feuille', 1586, 59);
INSERT INTO `les_noeuds` VALUES (1606, 'les formes solides destinées à la voie orale', 'feuille', 1588, 59);
INSERT INTO `les_noeuds` VALUES (1607, 'les formes liquides destinées à la voie orale', 'feuille', 1588, 59);
INSERT INTO `les_noeuds` VALUES (1608, 'les formes galéniques à usage parentéral', 'feuille', 1588, 59);
INSERT INTO `les_noeuds` VALUES (1609, 'les formes galéniques destinées à l''administration transmucosale', 'feuille', 1588, 59);
INSERT INTO `les_noeuds` VALUES (1610, 'les formes galéniques destinées à l''application cutanée', 'feuille', 1588, 59);
INSERT INTO `les_noeuds` VALUES (1611, 'excipients et adjuvants', 'feuille', 1589, 59);
INSERT INTO `les_noeuds` VALUES (1612, 'colorants et aromatisants', 'feuille', 1589, 59);
INSERT INTO `les_noeuds` VALUES (1613, 'Analyser l''ordonnance ou la demande sans ordonnance de médicaments, de matériel et dispositifs médicaux, de produits diététiques, cosmétiques et d''hygiène corporelle, de gaz médicaux ou de produits non médicamenteux du monopole', 'branche', 1254, 61);
INSERT INTO `les_noeuds` VALUES (1614, 'Délivrer des médicaments, des dispositifs médicaux et des produits et matériels de nature non médicamenteuse.', 'branche', 1254, 61);
INSERT INTO `les_noeuds` VALUES (1615, 'Donner des explications et des recommandations accompagnant la délivrance des médicaments, des dispositifs médicaux et autres produits', 'branche', 1254, 61);
INSERT INTO `les_noeuds` VALUES (1616, 'Procéder à l’analyse réglementaire : vérifier la recevabilité de la prescription ou de la demande', 'feuille', 1613, 61);
INSERT INTO `les_noeuds` VALUES (1617, 'Vérifier l’adaptation de la demande ou de la prescription aux besoins', 'feuille', 1613, 61);
INSERT INTO `les_noeuds` VALUES (1618, 'Prendre en compte les renseignements fournis par le malade', 'feuille', 1613, 61);
INSERT INTO `les_noeuds` VALUES (1619, 'Rechercher et préparer les éléments nécessaires à la vérification technique', 'feuille', 1613, 61);
INSERT INTO `les_noeuds` VALUES (1620, 'Procéder à l’analyse technique : dénomination, forme, dosage', 'feuille', 1613, 61);
INSERT INTO `les_noeuds` VALUES (1621, 'Rechercher et préparer les éléments nécessaires à l’analyse scientifique : contre indications, interactions, posologies, incompatibilités physico-chimiques.', 'feuille', 1613, 61);
INSERT INTO `les_noeuds` VALUES (1622, 'Prendre en compte les aspects réglementaires éventuels', 'feuille', 1613, 61);
INSERT INTO `les_noeuds` VALUES (1623, 'Calculer les quantités à délivrer', 'feuille', 1614, 61);
INSERT INTO `les_noeuds` VALUES (1624, 'Collecter les médicaments, les dispositifs médicaux et les produits et matériels de nature non médicamenteuse à délivrer et vérifier leur identité et l’intégrité de leur conditionnement', 'feuille', 1614, 61);
INSERT INTO `les_noeuds` VALUES (1625, 'Porter les inscriptions réglementaires éventuelles sur l’ordonnance, l’ordonnancier, les conditionnements et les carnets de surveillance ou les supports assurant la traçabilité des produits, matériels et/ou des lots.', 'feuille', 1614, 61);
INSERT INTO `les_noeuds` VALUES (1626, 'Respecter la réglementation existante', 'feuille', 1614, 61);
INSERT INTO `les_noeuds` VALUES (1627, 'Indiquer la posologie.', 'feuille', 1614, 61);
INSERT INTO `les_noeuds` VALUES (1628, 'Procéder a la délivrance', 'feuille', 1614, 61);
INSERT INTO `les_noeuds` VALUES (1629, 'Transmettre les informations concernant l’utilisation des médicaments délivrés et leurs effets secondaires ainsi que les modes d''utilisation des dispositifs médicaux et autres produits.', 'feuille', 1615, 61);
INSERT INTO `les_noeuds` VALUES (1630, 'Donner des explications sur leurs conditions de conservation et de stockage ainsi que sur leurs modalités de reconstitution ou leurs conditions de maintenance.', 'feuille', 1615, 61);
INSERT INTO `les_noeuds` VALUES (1631, 'enregistrer, vérifier, identifier et stocker les matières premières et les articles de conditionnement', 'branche', 1255, 61);
INSERT INTO `les_noeuds` VALUES (1632, 'Réaliser des préparations magistrales, officinales, vétérinaires et de produits officinaux divisés', 'branche', 1255, 61);
INSERT INTO `les_noeuds` VALUES (1633, 'conditionner', 'branche', 1255, 61);
INSERT INTO `les_noeuds` VALUES (1634, 'étiqueter conformément à la législation les préparations terminées et les produits officinaux divisés destinés à la dispensation au public.', 'feuille', 1255, 61);
INSERT INTO `les_noeuds` VALUES (1635, 'établir tous les documents nécessaires', 'branche', 1255, 61);
INSERT INTO `les_noeuds` VALUES (1636, 'tarifer Conformément à la réglementation en vigueur.', 'feuille', 1255, 61);
INSERT INTO `les_noeuds` VALUES (1637, 'Vérifier la conformité entre la commande et la livraison', 'feuille', 1631, 61);
INSERT INTO `les_noeuds` VALUES (1638, 'Vérifier l’intégrité des emballages et de l’étiquetage', 'feuille', 1631, 61);
INSERT INTO `les_noeuds` VALUES (1639, 'Vérifier l’identité des matières premières en mettant en oeuvre des réactions d’identification organoleptiques, physiques, chimiques et des examens microscopiques', 'feuille', 1631, 61);
INSERT INTO `les_noeuds` VALUES (1640, 'Stocker les matières premières', 'feuille', 1631, 61);
INSERT INTO `les_noeuds` VALUES (1641, 'Analyser la prescription pour la réalisation des préparations magistrales et des préparations reconstituées ou associées ou adaptées posologiquement à des cas ou des situations thérapeutiques particuliers ou rechercher la formule à la pharmacopée', 'feuille', 1632, 61);
INSERT INTO `les_noeuds` VALUES (1642, 'Organiser le poste de travail et préparer le matériel et les produits', 'feuille', 1632, 61);
INSERT INTO `les_noeuds` VALUES (1643, 'Calculer les quantités', 'feuille', 1632, 61);
INSERT INTO `les_noeuds` VALUES (1644, 'Réaliser la préparation dans le respect des procédures dans le cadre d’un système d’assurance qualité. o Vérifier l’étiquetage des matières premières, avant pendant et après la préparation, o Peser ou mesurer les principes actifs et les excipients, o', 'feuille', 1632, 61);
INSERT INTO `les_noeuds` VALUES (1645, 'Vérifier l’identité du produit avant les opérations de répartition', 'feuille', 1633, 61);
INSERT INTO `les_noeuds` VALUES (1646, 'Veiller à l’adéquation des conditionnements, à la conservation et à l’utilisation du produit', 'feuille', 1633, 61);
INSERT INTO `les_noeuds` VALUES (1647, 'Répartir dans les unités de conditionnement.', 'feuille', 1633, 61);
INSERT INTO `les_noeuds` VALUES (1648, 'Mise en oeuvre des peintures', 'branche', 0, 55);
INSERT INTO `les_noeuds` VALUES (1649, 'Mise en oeuvre des revêtements muraux', 'branche', 0, 55);
INSERT INTO `les_noeuds` VALUES (1650, 'Mise en oeuvre des revêtements de sol', 'branche', 0, 55);
INSERT INTO `les_noeuds` VALUES (1651, 'Mise en oeuvre des produits de façade', 'branche', 0, 55);
INSERT INTO `les_noeuds` VALUES (1652, 'Les Travaux de préparation peinture', 'feuille', 1648, 55);
INSERT INTO `les_noeuds` VALUES (1653, 'Les Travaux d''apprêts peinture', 'feuille', 1648, 55);
INSERT INTO `les_noeuds` VALUES (1655, 'Réaliser ou corriger une teinte', 'feuille', 1648, 55);
INSERT INTO `les_noeuds` VALUES (1656, 'Appliquer les peintures', 'feuille', 1648, 55);
INSERT INTO `les_noeuds` VALUES (1657, 'Les Travaux de préparation muraux', 'feuille', 1649, 55);
INSERT INTO `les_noeuds` VALUES (1658, 'Les Travaux d''apprêts muraux', 'feuille', 1649, 55);
INSERT INTO `les_noeuds` VALUES (1659, 'Poser des papiers peints', 'feuille', 1649, 55);
INSERT INTO `les_noeuds` VALUES (1660, 'Poser des revêtements à peindre', 'feuille', 1649, 55);
INSERT INTO `les_noeuds` VALUES (1661, 'Poser des revêtements muraux collés', 'feuille', 1649, 55);
INSERT INTO `les_noeuds` VALUES (1662, 'Les Travaux de préparation sols', 'feuille', 1650, 55);
INSERT INTO `les_noeuds` VALUES (1664, 'Les Travaux d''apprêts sols', 'feuille', 1650, 55);
INSERT INTO `les_noeuds` VALUES (1665, 'Poser des revêtements textiles collés', 'feuille', 1650, 55);
INSERT INTO `les_noeuds` VALUES (1666, 'Poser des revêtements plastiques collés', 'feuille', 1650, 55);
INSERT INTO `les_noeuds` VALUES (1667, 'Les Travaux de préparation façade', 'feuille', 1651, 55);
INSERT INTO `les_noeuds` VALUES (1670, 'Les Travaux d''apprêts façade', 'feuille', 1651, 55);
INSERT INTO `les_noeuds` VALUES (1671, 'Appliquer des produits de façaces', 'feuille', 1651, 55);
INSERT INTO `les_noeuds` VALUES (1672, 'Appliquer un système d''imperméabilité', 'feuille', 1651, 55);
INSERT INTO `les_noeuds` VALUES (1673, 'accueillir le public', 'branche', 1258, 61);
INSERT INTO `les_noeuds` VALUES (1674, 'animer les activités de l''officine', 'branche', 1258, 61);
INSERT INTO `les_noeuds` VALUES (1675, 'Se présenter dans une tenue adaptée aux exigences de la profession', 'feuille', 1673, 61);
INSERT INTO `les_noeuds` VALUES (1676, 'Assurer l’accueil en faisant preuve d’attention, de disponibilité et de confidentialité', 'feuille', 1673, 61);
INSERT INTO `les_noeuds` VALUES (1677, 'Entretenir des relations courtoises avec le public et l’équipe de travail', 'feuille', 1673, 61);
INSERT INTO `les_noeuds` VALUES (1678, 'Participer à la réalisation des vitrines', 'feuille', 1674, 61);
INSERT INTO `les_noeuds` VALUES (1679, 'Participer à la bonne présentation des produits', 'feuille', 1674, 61);
INSERT INTO `les_noeuds` VALUES (1680, 'Relatifs aux obligations légales', 'feuille', 1635, 61);
INSERT INTO `les_noeuds` VALUES (1681, 'Recommandés par les bonnes pratiques', 'feuille', 1635, 61);
INSERT INTO `les_noeuds` VALUES (1682, 'Recenser et sélectionner les différentes sources documentaires professionnelles et réglementairesRecenser et sélectionner les différentes sources documentaires professionnelles et réglementaires', 'feuille', 1259, 61);
INSERT INTO `les_noeuds` VALUES (1683, 'Consulter une banque de données', 'feuille', 1259, 61);
INSERT INTO `les_noeuds` VALUES (1684, 'Référencer l’information', 'feuille', 1259, 61);
INSERT INTO `les_noeuds` VALUES (1685, 'Traiter l’information', 'feuille', 1259, 61);
INSERT INTO `les_noeuds` VALUES (1686, 'Stocker l’information', 'feuille', 1259, 61);
INSERT INTO `les_noeuds` VALUES (1687, 'Estimer les besoins et déclencher la commande', 'feuille', 1260, 61);
INSERT INTO `les_noeuds` VALUES (1688, 'Préparer le bon de commande', 'feuille', 1260, 61);
INSERT INTO `les_noeuds` VALUES (1689, 'Transmettre la commande', 'feuille', 1260, 61);
INSERT INTO `les_noeuds` VALUES (1690, 'Réceptionner la livraison', 'feuille', 1260, 61);
INSERT INTO `les_noeuds` VALUES (1691, 'Vérifier la conformité de la livraison à la commande effective', 'feuille', 1260, 61);
INSERT INTO `les_noeuds` VALUES (1692, 'Vérifier la conformité de la facture à la livraison', 'feuille', 1260, 61);
INSERT INTO `les_noeuds` VALUES (1693, 'Etablir le prix de vente', 'feuille', 1260, 61);
INSERT INTO `les_noeuds` VALUES (1694, 'Ranger les médicaments, produits et dispositifs médicaux (après quarantaine éventuelle)', 'feuille', 1260, 61);
INSERT INTO `les_noeuds` VALUES (1695, 'Enregistrer les entrées : numéro de lot et péremption. Enregistrer les sorties.', 'feuille', 1260, 61);
INSERT INTO `les_noeuds` VALUES (1696, 'Etablir les factures', 'feuille', 1260, 61);
INSERT INTO `les_noeuds` VALUES (1697, 'Participer au suivi des médicaments, produits et dispositifs médicaux périmés', 'feuille', 1260, 61);
INSERT INTO `les_noeuds` VALUES (1698, 'Participer à la gestion des médicaments inutilisés', 'feuille', 1260, 61);
INSERT INTO `les_noeuds` VALUES (1699, 'Participer à l’inventaire.', 'feuille', 1260, 61);
INSERT INTO `les_noeuds` VALUES (1700, 'Etablir les formalités nécessaires aux remboursements par les divers organismes scociaux et/ou payeurs', 'feuille', 1261, 61);
INSERT INTO `les_noeuds` VALUES (1701, 'Vérifier l''ouverture des droits permettant une subrogation de paiement', 'feuille', 1261, 61);
INSERT INTO `les_noeuds` VALUES (1702, 'Etablir une facturation pour un paiement comptant', 'feuille', 1261, 61);
INSERT INTO `les_noeuds` VALUES (1703, 'Etablir une facturation par subrogation (dans le respect des règles qui régissent le fonctionnement de l’hôpital).', 'feuille', 1261, 61);
INSERT INTO `les_noeuds` VALUES (1704, 'Transmettre éventuellement le dossier pour remboursement aux divers organismes payeurs', 'feuille', 1261, 61);
INSERT INTO `les_noeuds` VALUES (1705, 'Contrôler les remboursements effectués par les organismes payeurs', 'feuille', 1261, 61);
INSERT INTO `les_noeuds` VALUES (1706, 'S’assurer que les conditions d’hygiène soient bien remplies', 'feuille', 1262, 61);
INSERT INTO `les_noeuds` VALUES (1707, 'Déceler et identifier les dysfonctionnements et les anomalies', 'feuille', 1263, 61);
INSERT INTO `les_noeuds` VALUES (1708, 'Décider du niveau de l’intervention de remédiation (intervention directe ou transmission à la hiérarchie)', 'feuille', 1263, 61);
INSERT INTO `les_noeuds` VALUES (1709, 'Contrôler l’état et le bon fonctionnement des matériels et des équipements', 'feuille', 1263, 61);
INSERT INTO `les_noeuds` VALUES (1710, 'Effectuer l’entretien courant des matériels et des équipements (premier et deuxième niveaux : pose et dépose de pièces standard ou d’éléments simples).', 'feuille', 1263, 61);
INSERT INTO `les_noeuds` VALUES (1711, 'Assurer le suivi et l’enregistrement des opérations d’entretien et de maintenance.', 'feuille', 1263, 61);
INSERT INTO `les_noeuds` VALUES (1734, 'C1 COMMUNIQUER', 'branche', 0, 65);
INSERT INTO `les_noeuds` VALUES (1735, 'C2 ANALYSER', 'branche', 0, 65);
INSERT INTO `les_noeuds` VALUES (1737, 'C3 REALISER', 'branche', 0, 65);
INSERT INTO `les_noeuds` VALUES (1740, 'C4 EVALUER', 'branche', 0, 65);
INSERT INTO `les_noeuds` VALUES (1744, 'S''informer - informer', 'branche', 1734, 65);
INSERT INTO `les_noeuds` VALUES (1756, 'Analyser', 'branche', 1735, 65);
INSERT INTO `les_noeuds` VALUES (1760, 'Préparer un poste de travail', 'branche', 1737, 65);
INSERT INTO `les_noeuds` VALUES (1762, 'Manutentionner', 'branche', 1737, 65);
INSERT INTO `les_noeuds` VALUES (1764, 'Déposer, reposer des éléments amovibles', 'branche', 1737, 65);
INSERT INTO `les_noeuds` VALUES (1766, 'Déssassembler des éléments inamovibles', 'branche', 1737, 65);
INSERT INTO `les_noeuds` VALUES (1768, 'Restructurer', 'branche', 1737, 65);
INSERT INTO `les_noeuds` VALUES (1771, 'Régler des éléments et/ou des mécanismes non motorisés', 'branche', 1737, 65);
INSERT INTO `les_noeuds` VALUES (1773, 'Conformer', 'branche', 1737, 65);
INSERT INTO `les_noeuds` VALUES (1776, 'Remettre en forme par garnissage', 'branche', 1737, 65);
INSERT INTO `les_noeuds` VALUES (1778, 'Mettre en oeuvre des matériaux composites', 'branche', 1737, 65);
INSERT INTO `les_noeuds` VALUES (1781, 'Mesurer, contrôler', 'branche', 1737, 65);
INSERT INTO `les_noeuds` VALUES (1783, 'Laver un véhicule', 'branche', 1737, 65);
INSERT INTO `les_noeuds` VALUES (1785, 'Traiter des surfaces', 'branche', 1737, 65);
INSERT INTO `les_noeuds` VALUES (1786, 'Entretenir l''outillage', 'branche', 1737, 65);
INSERT INTO `les_noeuds` VALUES (1789, 'Evaluer la conformité d''une intervention', 'branche', 1740, 65);
INSERT INTO `les_noeuds` VALUES (1791, 'Préparer le véhicule à la livraison', 'branche', 1740, 65);
INSERT INTO `les_noeuds` VALUES (1833, 's''approprier et transmettre les informations (remplir un O.R)', 'feuille', 1744, 65);
INSERT INTO `les_noeuds` VALUES (1837, 'Analyser un véhicule pour choisirla méthode de réparation', 'feuille', 1756, 65);
INSERT INTO `les_noeuds` VALUES (1930, 'Rassembler les pièces, les produits les outillages', 'feuille', 1760, 65);
INSERT INTO `les_noeuds` VALUES (1931, 'Choisir des points de levage', 'feuille', 1762, 65);
INSERT INTO `les_noeuds` VALUES (1932, 'Déposer, reposer (un pare-choc, une aile AV, etc...)', 'feuille', 1764, 65);
INSERT INTO `les_noeuds` VALUES (1933, 'Déposer, assembler des éléments soudés (aile AR , bas de caisse, etc...)', 'feuille', 1766, 65);
INSERT INTO `les_noeuds` VALUES (1934, 'Remettre en ligne par vérinage', 'feuille', 1768, 65);
INSERT INTO `les_noeuds` VALUES (1935, 'Régler des éléments (porte , phare , etc...)', 'feuille', 1771, 65);
INSERT INTO `les_noeuds` VALUES (1936, 'Remettre en forme par planage', 'feuille', 1773, 65);
INSERT INTO `les_noeuds` VALUES (1937, 'Remettre en forme par masticage ou étamage', 'feuille', 1776, 65);
INSERT INTO `les_noeuds` VALUES (1938, 'Réparer un élément plastique', 'feuille', 1778, 65);
INSERT INTO `les_noeuds` VALUES (1939, 'Appliquer des produits anticorrosion après réparation', 'feuille', 1785, 65);
INSERT INTO `les_noeuds` VALUES (1940, 'Réaliser la maintenance', 'feuille', 1786, 65);
INSERT INTO `les_noeuds` VALUES (1941, 'Relever des mesures à l''aide d''une pige ou d''un banc', 'feuille', 1781, 65);
INSERT INTO `les_noeuds` VALUES (1942, 'Vérifier la réparation en relation avec l'' O.R', 'feuille', 1789, 65);
INSERT INTO `les_noeuds` VALUES (1943, 'Laver un véhicule', 'feuille', 1783, 65);
INSERT INTO `les_noeuds` VALUES (1944, 'Préparer le véhicule jusqu''à la livraison', 'feuille', 1791, 65);
INSERT INTO `les_noeuds` VALUES (1951, 'EPS', 'branche', 0, 67);
INSERT INTO `les_noeuds` VALUES (1952, 'Dessin', 'branche', 0, 67);
INSERT INTO `les_noeuds` VALUES (1953, 'CEEJ', 'branche', 0, 67);
INSERT INTO `les_noeuds` VALUES (1954, 'Technologie', 'branche', 0, 67);
INSERT INTO `les_noeuds` VALUES (1955, 'Sciences appliquées', 'branche', 0, 67);
INSERT INTO `les_noeuds` VALUES (1956, 'Français', 'branche', 0, 67);
INSERT INTO `les_noeuds` VALUES (1957, 'Mathématiques', 'branche', 0, 67);
INSERT INTO `les_noeuds` VALUES (1958, 'Histoire géographie', 'branche', 0, 67);
INSERT INTO `les_noeuds` VALUES (1959, 'Anglais', 'branche', 0, 67);
INSERT INTO `les_noeuds` VALUES (1960, 'Tennis de table', 'feuille', 1951, 67);
INSERT INTO `les_noeuds` VALUES (1961, 'Badminton', 'feuille', 1951, 67);
INSERT INTO `les_noeuds` VALUES (1962, '3 fois 500', 'feuille', 1951, 67);
INSERT INTO `les_noeuds` VALUES (1963, 'Composition géometrique', 'feuille', 1952, 67);
INSERT INTO `les_noeuds` VALUES (1964, 'bordure', 'feuille', 1952, 67);
INSERT INTO `les_noeuds` VALUES (1965, 'Lettrage', 'feuille', 1952, 67);
INSERT INTO `les_noeuds` VALUES (1993, 'PREPARATION', 'branche', 0, 70);
INSERT INTO `les_noeuds` VALUES (1994, 'FABRICATION', 'branche', 0, 70);
INSERT INTO `les_noeuds` VALUES (1995, 'POSE & INSTALLATION', 'branche', 0, 70);
INSERT INTO `les_noeuds` VALUES (1996, 'ENTRETIEN & MAINTENANCE', 'branche', 0, 70);
INSERT INTO `les_noeuds` VALUES (1999, '1.	Relever des cotes et des formes d’ouvrages (Métré, DAO, …)', 'feuille', 1993, 70);
INSERT INTO `les_noeuds` VALUES (2000, '2.	Elaborer et/ou compléter un dossier de fabrication et/ou de pose.(Logiciel devis/débit)', 'feuille', 1993, 70);
INSERT INTO `les_noeuds` VALUES (2001, '3.	Optimiser les découpes.', 'feuille', 1993, 70);
INSERT INTO `les_noeuds` VALUES (2002, '4.	Contrôler les approvisionnements / Gérer les stocks.', 'feuille', 1993, 70);
INSERT INTO `les_noeuds` VALUES (2003, '5.	Organiser un poste de travail.', 'feuille', 1993, 70);
INSERT INTO `les_noeuds` VALUES (2004, '6.	Sécuriser un poste de travail.', 'feuille', 1993, 70);
INSERT INTO `les_noeuds` VALUES (2005, '7.	Manutentionner et stocker les produits de base, les composants et les matériels.', 'feuille', 1993, 70);
INSERT INTO `les_noeuds` VALUES (2006, '1.	Tracer un usinage sur produits plans et profilés.', 'feuille', 1994, 70);
INSERT INTO `les_noeuds` VALUES (2007, '2.	Débiter des profilés.', 'feuille', 1994, 70);
INSERT INTO `les_noeuds` VALUES (2008, '3.	Usiner les profilés Alu., PVC ou Acier - CHASSIS A FRAPPE', 'branche', 1994, 70);
INSERT INTO `les_noeuds` VALUES (2009, '4 - AUTOMATISME, ASSERVISSEMENT', 'feuille', 1994, 70);
INSERT INTO `les_noeuds` VALUES (2010, '-	Usiner les profilés Alu., PVC ou Acier - CHASSIS COULISSANT', 'feuille', 2008, 70);
INSERT INTO `les_noeuds` VALUES (2011, '-	Usiner les profilés Alu., PVC ou Acier - CHASSIS COMPOSE', 'feuille', 2008, 70);
INSERT INTO `les_noeuds` VALUES (2012, '-	Usiner les profilés Alu., PVC ou Acier - VERANDA/VERRIERE', 'feuille', 2008, 70);
INSERT INTO `les_noeuds` VALUES (2013, '-	Usiner les profilés Alu., PVC ou Acier - MUR RIDEAU', 'feuille', 2008, 70);
INSERT INTO `les_noeuds` VALUES (2014, '-	Usiner les profilés Alu., PVC ou Acier - GARDE CORPS / RAMPES.', 'feuille', 2008, 70);
INSERT INTO `les_noeuds` VALUES (2015, '-	Usiner les profilés Alu., PVC ou Acier - PORTAIL ET CLOTURE', 'feuille', 2008, 70);
INSERT INTO `les_noeuds` VALUES (2016, '-	Usiner les profilés Alu., PVC ou Acier - SYSTEME D’OCCULTATIONS (VOLET ROULANT, BATTANTS, …)', 'feuille', 2008, 70);
INSERT INTO `les_noeuds` VALUES (2017, '-	Usiner les profilés Alu., PVC ou Acier - STRUCTURES METALLIQUES DIVERSES', 'feuille', 2008, 70);
INSERT INTO `les_noeuds` VALUES (2018, '1.	Réceptionner un ouvrage et l’implanter.', 'feuille', 1995, 70);
INSERT INTO `les_noeuds` VALUES (2019, '2.	Déposer un ouvrage à remplacer et/ou adapter le support.', 'feuille', 1995, 70);
INSERT INTO `les_noeuds` VALUES (2020, '3.	Poser, fixer et étancher des ouvrages menuisés - CHASSIS A FRAPPE', 'feuille', 1995, 70);
INSERT INTO `les_noeuds` VALUES (2021, '4.	Poser, fixer et étancher des ouvrages menuisés - CHASSIS COULISSANT', 'feuille', 1995, 70);
INSERT INTO `les_noeuds` VALUES (2022, '5.	Poser, fixer et étancher des ouvrages menuisés - CHASSIS COMPOSE', 'feuille', 1995, 70);
INSERT INTO `les_noeuds` VALUES (2023, '6.	Poser, fixer et étancher des ouvrages menuisés - VERANDA/VERRIERE', 'feuille', 1995, 70);
INSERT INTO `les_noeuds` VALUES (2024, '7.	Poser, fixer et étancher des ouvrages menuisés - MUR RIDEAU', 'feuille', 1995, 70);
INSERT INTO `les_noeuds` VALUES (2025, '8.	Poser, fixer et étancher des ouvrages menuisés - GARDE CORPS / RAMPES', 'feuille', 1995, 70);
INSERT INTO `les_noeuds` VALUES (2026, '9.	Poser, fixer et étancher des ouvrages menuisés - PORTAIL ET CLOTURE', 'feuille', 1995, 70);
INSERT INTO `les_noeuds` VALUES (2027, '10.	Poser, fixer et étancher des ouvrages menuisés - SYSTEME D’OCCULTATIONS (VOLET ROULANT, BATTANTS, …)', 'feuille', 1995, 70);
INSERT INTO `les_noeuds` VALUES (2028, '11.	Poser, fixer et étancher des ouvrages menuisés - STRUCTURES METALLIQUES DIVERSES', 'feuille', 1995, 70);
INSERT INTO `les_noeuds` VALUES (2029, '12.	Poser, fixer et étancher des ouvrages menuisés - AUTOMATISME, ASSERVISSEMENT', 'feuille', 1995, 70);
INSERT INTO `les_noeuds` VALUES (2030, '13.	Poser, fixer et étancher des ouvrages menuisés - VEC / VEA / VEP', 'feuille', 1995, 70);
INSERT INTO `les_noeuds` VALUES (2031, '14.	Contrôle qualité', 'feuille', 1995, 70);
INSERT INTO `les_noeuds` VALUES (2032, '1.	Assurer sur site l’entretien préventif courant d’organes de fonctionnement.', 'feuille', 1996, 70);
INSERT INTO `les_noeuds` VALUES (2033, '2.	Vérifier et maintenir en état les outils.', 'feuille', 1996, 70);
INSERT INTO `les_noeuds` VALUES (2034, '3.	Vérifier et maintenir en état les matériels.', 'feuille', 1996, 70);
INSERT INTO `les_noeuds` VALUES (2035, '4.	Vérifier et maintenir en état l’aire de travail.', 'feuille', 1996, 70);
INSERT INTO `les_noeuds` VALUES (2036, '5.	Vérifier et maintenir en état le site de pose.', 'feuille', 1996, 70);
INSERT INTO `les_noeuds` VALUES (2076, 'CDD', 'branche', 0, 78);
INSERT INTO `les_noeuds` VALUES (2077, 'CDI', 'branche', 0, 78);
INSERT INTO `les_noeuds` VALUES (2083, '', 'feuille', 0, 78);
INSERT INTO `les_noeuds` VALUES (2086, '', 'feuille', 0, 78);
INSERT INTO `les_noeuds` VALUES (2096, '', 'feuille', 1117, 54);
INSERT INTO `les_noeuds` VALUES (2097, '', 'branche', 0, 49);
INSERT INTO `les_noeuds` VALUES (2098, 'PREPARATION', 'branche', 0, 79);
INSERT INTO `les_noeuds` VALUES (2099, 'FABRICATION', 'branche', 0, 79);
INSERT INTO `les_noeuds` VALUES (2100, 'POSE & INSTALLATION', 'branche', 0, 79);
INSERT INTO `les_noeuds` VALUES (2101, 'ENTRETIEN & MAINTENANCE', 'branche', 0, 79);
INSERT INTO `les_noeuds` VALUES (2102, '1.	Relever des cotes et des formes d’ouvrages (Métré, DAO, …)', 'feuille', 2098, 79);
INSERT INTO `les_noeuds` VALUES (2103, '2.	Elaborer et/ou compléter un dossier de fabrication et/ou de pose.(Logiciel devis/débit)', 'feuille', 2098, 79);
INSERT INTO `les_noeuds` VALUES (2104, '3.	Optimiser les découpes.', 'feuille', 2098, 79);
INSERT INTO `les_noeuds` VALUES (2106, '4.	Contrôler les approvisionnements / Gérer les stocks.', 'feuille', 2098, 79);
INSERT INTO `les_noeuds` VALUES (2107, '5.	Organiser un poste de travail.', 'feuille', 2098, 79);
INSERT INTO `les_noeuds` VALUES (2108, '6.	Sécuriser un poste de travail.', 'feuille', 2098, 79);
INSERT INTO `les_noeuds` VALUES (2109, '7.	Manutentionner et stocker les produits de base, les composants et les matériels.', 'feuille', 2098, 79);
INSERT INTO `les_noeuds` VALUES (2110, '1.	Tracer un usinage sur produits plans et profilés.', 'feuille', 2099, 79);
INSERT INTO `les_noeuds` VALUES (2111, '2.	Débiter des profilés.', 'feuille', 2099, 79);
INSERT INTO `les_noeuds` VALUES (2112, '3.	Usiner les profilés', 'branche', 2099, 79);
INSERT INTO `les_noeuds` VALUES (2113, '- Usiner les profilés Alu., PVC ou Acier - CHASSIS A FRAPPE', 'feuille', 2112, 79);
INSERT INTO `les_noeuds` VALUES (2114, '-	Usiner les profilés Alu., PVC ou Acier - CHASSIS COULISSANT', 'feuille', 2112, 79);
INSERT INTO `les_noeuds` VALUES (2115, '-	Usiner les profilés Alu., PVC ou Acier - CHASSIS COMPOSE', 'feuille', 2112, 79);
INSERT INTO `les_noeuds` VALUES (2116, '-	Usiner les profilés Alu., PVC ou Acier - VERANDA/VERRIERE', 'feuille', 2112, 79);
INSERT INTO `les_noeuds` VALUES (2117, '-	Usiner les profilés Alu., PVC ou Acier - MUR RIDEAU', 'feuille', 2112, 79);
INSERT INTO `les_noeuds` VALUES (2118, '-	Usiner les profilés Alu., PVC ou Acier - GARDE CORPS / RAMPES', 'feuille', 2112, 79);
INSERT INTO `les_noeuds` VALUES (2119, '-	Usiner les profilés Alu., PVC ou Acier - PORTAIL ET CLOTURE', 'feuille', 2112, 79);
INSERT INTO `les_noeuds` VALUES (2120, '-	Usiner les profilés Alu., PVC ou Acier - SYSTEME D’OCCULTATIONS (VOLET ROULANT, BATTANTS, …)', 'feuille', 2112, 79);
INSERT INTO `les_noeuds` VALUES (2121, '-	Usiner les profilés Alu., PVC ou Acier - STRUCTURES METALLIQUES DIVERSES', 'feuille', 2112, 79);
INSERT INTO `les_noeuds` VALUES (2122, '4. AUTOMATISME, ASSERVISSEMENT', 'feuille', 2099, 79);
INSERT INTO `les_noeuds` VALUES (2123, '1.	Réceptionner un ouvrage et l’implanter.', 'feuille', 2100, 79);
INSERT INTO `les_noeuds` VALUES (2124, '2.	Déposer un ouvrage à remplacer et/ou adapter le support.', 'feuille', 2100, 79);
INSERT INTO `les_noeuds` VALUES (2125, '3.	Poser, fixer et étancher des ouvrages menuisés', 'branche', 2100, 79);
INSERT INTO `les_noeuds` VALUES (2126, '- CHASSIS A FRAPPE', 'feuille', 2125, 79);
INSERT INTO `les_noeuds` VALUES (2127, '- CHASSIS COULISSANT', 'feuille', 2125, 79);
INSERT INTO `les_noeuds` VALUES (2128, '- CHASSIS COMPOSE', 'feuille', 2125, 79);
INSERT INTO `les_noeuds` VALUES (2129, '- VERANDA/VERRIERE', 'feuille', 2125, 79);
INSERT INTO `les_noeuds` VALUES (2130, '- MUR RIDEAU', 'feuille', 2125, 79);
INSERT INTO `les_noeuds` VALUES (2131, '- GARDE CORPS / RAMPES', 'feuille', 2125, 79);
INSERT INTO `les_noeuds` VALUES (2132, '- PORTAIL ET CLOTURE', 'feuille', 2125, 79);
INSERT INTO `les_noeuds` VALUES (2133, '- SYSTEME D’OCCULTATIONS (VOLET ROULANT, BATTANTS, …)', 'feuille', 2125, 79);
INSERT INTO `les_noeuds` VALUES (2134, '- STRUCTURES METALLIQUES DIVERSES', 'feuille', 2125, 79);
INSERT INTO `les_noeuds` VALUES (2135, '- AUTOMATISME, ASSERVISSEMENT', 'feuille', 2125, 79);
INSERT INTO `les_noeuds` VALUES (2136, '- VEC / VEA / VEP', 'feuille', 2125, 79);
INSERT INTO `les_noeuds` VALUES (2137, '4.	Contrôle qualité', 'feuille', 2100, 79);
INSERT INTO `les_noeuds` VALUES (2138, '1.	Assurer sur site l’entretien préventif courant d’organes de fonctionnement.', 'feuille', 2101, 79);
INSERT INTO `les_noeuds` VALUES (2139, '2.	Vérifier et maintenir en état les outils.', 'feuille', 2101, 79);
INSERT INTO `les_noeuds` VALUES (2140, '3.	Vérifier et maintenir en état les matériels.', 'feuille', 2101, 79);
INSERT INTO `les_noeuds` VALUES (2141, '4.	Vérifier et maintenir en état l’aire de travail.', 'branche', 2101, 79);
INSERT INTO `les_noeuds` VALUES (2142, '5.	Vérifier et maintenir en état le site de pose.', 'feuille', 2101, 79);
INSERT INTO `les_noeuds` VALUES (2143, 'Jambon de Parme', 'branche', 1051, 54);
INSERT INTO `les_noeuds` VALUES (2144, 'Découpage et Dressage', 'feuille', 2143, 54);
INSERT INTO `les_noeuds` VALUES (2145, 'Préparation du Poste, connaissance et dosage', 'feuille', 1119, 54);
INSERT INTO `les_noeuds` VALUES (2146, 'Pâtisserie', 'branche', 0, 80);
INSERT INTO `les_noeuds` VALUES (2147, 'Chocolat', 'branche', 0, 80);
INSERT INTO `les_noeuds` VALUES (2148, 'Glace', 'branche', 0, 80);
INSERT INTO `les_noeuds` VALUES (2149, 'Confiserie', 'branche', 0, 80);
INSERT INTO `les_noeuds` VALUES (2150, 'crème pâtissière', 'feuille', 2146, 80);
INSERT INTO `les_noeuds` VALUES (2151, 'Mise au point couverture', 'feuille', 2147, 80);
INSERT INTO `les_noeuds` VALUES (2152, 'sorbet', 'feuille', 2148, 80);
INSERT INTO `les_noeuds` VALUES (2153, 'cuisson du sucre', 'feuille', 2149, 80);
INSERT INTO `les_noeuds` VALUES (2154, 'Entretien', 'branche', 0, 81);
INSERT INTO `les_noeuds` VALUES (2155, 'Mobilier, matériel et des locaux', 'feuille', 2154, 81);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_options`
-- 

CREATE TABLE `les_options` (
  `nom` varchar(50) NOT NULL default '',
  `valeur` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`nom`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `les_options`
-- 

INSERT INTO `les_options` VALUES ('LEA_LOGO_CFA', 'LEA_LOGO_CFA.png');
INSERT INTO `les_options` VALUES ('LEA_BACKGROUND_HEAD', 'LEA_BACKGROUND_HEAD.jpg');
INSERT INTO `les_options` VALUES ('LEA_THEME', 'theme2');

-- --------------------------------------------------------

-- 
-- Structure de la table `les_periodes`
-- 

CREATE TABLE `les_periodes` (
  `id_periode` bigint(20) NOT NULL auto_increment,
  `libelle` varchar(100) NOT NULL default '',
  `rang` int(10) unsigned NOT NULL default '0',
  `suivi_cfa` binary(1) NOT NULL default '1',
  `suivi_entr` binary(1) NOT NULL default '1',
  `consult_app` binary(1) NOT NULL default '1',
  `consult_ma` binary(1) NOT NULL default '1',
  `consult_tuteur_cfa` binary(1) NOT NULL default '1',
  `consult_ens` binary(1) NOT NULL default '1',
  `consult_rl` binary(1) NOT NULL default '1',
  `id_for` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_periode`),
  KEY `id_cla` (`id_for`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=132 ;

-- 
-- Contenu de la table `les_periodes`
-- 

INSERT INTO `les_periodes` VALUES (42, 'PERIODE 1 (SEPTEMBRE)', 1, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 13);
INSERT INTO `les_periodes` VALUES (43, 'PERIODE 2 (OCTOBRE)', 2, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 13);
INSERT INTO `les_periodes` VALUES (44, 'PERIODE 3 (NOVEMBRE)', 3, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 13);
INSERT INTO `les_periodes` VALUES (45, 'PERIODE 4 (NOVEMBRE)', 4, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 13);
INSERT INTO `les_periodes` VALUES (46, 'PERIODE 5 (DECEMBRE)', 5, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 13);
INSERT INTO `les_periodes` VALUES (47, 'PERIODE 6 (JANVIER)', 6, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 13);
INSERT INTO `les_periodes` VALUES (48, 'PERIODE 7 (FEVRIER)', 7, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 13);
INSERT INTO `les_periodes` VALUES (49, 'PERIODE 8 (MARS)', 8, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 13);
INSERT INTO `les_periodes` VALUES (50, 'PERIODE 9 (AVRIL)', 9, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 13);
INSERT INTO `les_periodes` VALUES (51, 'PERIODE 10 (MAI)', 10, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 13);
INSERT INTO `les_periodes` VALUES (52, 'PERIODE 11 (MAI)', 11, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 13);
INSERT INTO `les_periodes` VALUES (53, 'PERIODE 12 (JUIN)', 12, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 13);
INSERT INTO `les_periodes` VALUES (54, 'PERIODE 13 (SEPTEMBRE)', 13, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 13);
INSERT INTO `les_periodes` VALUES (55, 'PERIODE 14 (OCTOBRE)', 14, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 13);
INSERT INTO `les_periodes` VALUES (56, 'PERIODE 15(NOVEMBRE)', 15, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 13);
INSERT INTO `les_periodes` VALUES (57, 'PERIODE 16 (NOVEMBRE)', 16, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 13);
INSERT INTO `les_periodes` VALUES (58, 'PERIODE 17 (DECEMBRE)', 17, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 13);
INSERT INTO `les_periodes` VALUES (59, 'PERIODE 18 (JANVIER)', 18, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 13);
INSERT INTO `les_periodes` VALUES (60, 'PERIODE 19 (FEVRIER)', 19, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 13);
INSERT INTO `les_periodes` VALUES (61, 'PERIODE 20 (MARS)', 20, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 13);
INSERT INTO `les_periodes` VALUES (62, 'PERIODE 21 (AVRIL)', 21, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 13);
INSERT INTO `les_periodes` VALUES (63, 'PERIODE 22 (MAI)', 22, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 13);
INSERT INTO `les_periodes` VALUES (64, 'PERIODE 23 (MAI)', 23, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 13);
INSERT INTO `les_periodes` VALUES (65, 'PERIODE 24 (JUIN)', 24, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 13);
INSERT INTO `les_periodes` VALUES (66, 'Semaine N° 01', 1, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 14);
INSERT INTO `les_periodes` VALUES (67, 'Semaine N° 02', 2, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 14);
INSERT INTO `les_periodes` VALUES (68, 'Semaine N° 03', 3, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 14);
INSERT INTO `les_periodes` VALUES (69, 'Semaine N° 04', 4, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 14);
INSERT INTO `les_periodes` VALUES (70, 'Semaine N° 05', 5, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 14);
INSERT INTO `les_periodes` VALUES (71, '1er SEMESTRE, Septembre-Octobre', 1, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 18);
INSERT INTO `les_periodes` VALUES (74, '2ème SEMESTRE, Février-Mars', 4, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 18);
INSERT INTO `les_periodes` VALUES (81, '1er SEMESTRE, Octobre-Novembre', 2, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 18);
INSERT INTO `les_periodes` VALUES (82, '1er SEMESTRE, Décembre-Janvier', 3, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 18);
INSERT INTO `les_periodes` VALUES (83, '2ème SEMESTRE, Mars-Avril', 5, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 18);
INSERT INTO `les_periodes` VALUES (84, '2ème SEMESTRE, Mai-Juin', 6, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 18);
INSERT INTO `les_periodes` VALUES (85, 'Période 1', 1, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 20);
INSERT INTO `les_periodes` VALUES (86, 'Période2', 2, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 20);
INSERT INTO `les_periodes` VALUES (87, 'Période3', 3, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 20);
INSERT INTO `les_periodes` VALUES (88, 'Période4', 4, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 20);
INSERT INTO `les_periodes` VALUES (89, 'Péridoe5', 5, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 20);
INSERT INTO `les_periodes` VALUES (90, 'Période6', 6, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 20);
INSERT INTO `les_periodes` VALUES (91, 'Période7', 7, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 20);
INSERT INTO `les_periodes` VALUES (92, 'Période8', 8, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 20);
INSERT INTO `les_periodes` VALUES (93, 'Période9', 9, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 20);
INSERT INTO `les_periodes` VALUES (94, 'Période10', 10, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 20);
INSERT INTO `les_periodes` VALUES (95, 'Période11', 11, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 20);
INSERT INTO `les_periodes` VALUES (96, 'Période12', 12, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 20);
INSERT INTO `les_periodes` VALUES (98, 'Période13', 13, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 20);
INSERT INTO `les_periodes` VALUES (102, 'Regroupement 1', 1, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 23);
INSERT INTO `les_periodes` VALUES (103, 'Regroupement 2', 2, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 23);
INSERT INTO `les_periodes` VALUES (104, 'Regroupement 3', 3, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 23);
INSERT INTO `les_periodes` VALUES (105, 'Regroupement 4', 4, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 23);
INSERT INTO `les_periodes` VALUES (106, 'Regroupement 5', 5, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 23);
INSERT INTO `les_periodes` VALUES (107, 'Regroupement 6', 6, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 23);
INSERT INTO `les_periodes` VALUES (108, 'Regroupement 7', 7, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 23);
INSERT INTO `les_periodes` VALUES (109, 'Regroupement 8', 8, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 23);
INSERT INTO `les_periodes` VALUES (110, 'Regroupement 9', 9, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 23);
INSERT INTO `les_periodes` VALUES (111, 'Regroupement 10', 10, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 23);
INSERT INTO `les_periodes` VALUES (112, 'Regroupement 11', 11, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 23);
INSERT INTO `les_periodes` VALUES (113, 'Regroupement 12', 12, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 23);
INSERT INTO `les_periodes` VALUES (114, 'Regroupement 13', 13, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 23);
INSERT INTO `les_periodes` VALUES (115, 'Regroupement 14', 14, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 23);
INSERT INTO `les_periodes` VALUES (116, 'Regroupement 15', 15, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 23);
INSERT INTO `les_periodes` VALUES (117, 'Regroupement 16', 16, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 23);
INSERT INTO `les_periodes` VALUES (118, 'Regroupement 17', 17, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 23);
INSERT INTO `les_periodes` VALUES (119, 'Regroupement 18', 18, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 23);
INSERT INTO `les_periodes` VALUES (120, 'Regroupement 19', 19, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 23);
INSERT INTO `les_periodes` VALUES (121, 'Regroupement 20', 20, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 23);
INSERT INTO `les_periodes` VALUES (122, 'période 1', 1, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 16);
INSERT INTO `les_periodes` VALUES (123, 'période 2', 2, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 16);
INSERT INTO `les_periodes` VALUES (124, 'période 3', 3, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 16);
INSERT INTO `les_periodes` VALUES (125, 'période 4', 4, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 16);
INSERT INTO `les_periodes` VALUES (126, 'période 5', 5, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 16);
INSERT INTO `les_periodes` VALUES (127, 'période 6', 6, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 16);
INSERT INTO `les_periodes` VALUES (128, 'période 7', 7, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 16);
INSERT INTO `les_periodes` VALUES (129, 'période 8', 8, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 16);
INSERT INTO `les_periodes` VALUES (130, 'période 9', 9, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 16);
INSERT INTO `les_periodes` VALUES (131, 'période 10', 10, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 0x31, 16);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_periodes_classes`
-- 

CREATE TABLE `les_periodes_classes` (
  `id_periode` bigint(20) NOT NULL default '0',
  `id_cla` bigint(20) NOT NULL default '0',
  `date_debut_cfa` date NOT NULL default '0000-00-00',
  `date_fin_cfa` date NOT NULL default '0000-00-00',
  `date_debut_entr` date NOT NULL default '0000-00-00',
  `date_fin_entr` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id_periode`,`id_cla`),
  KEY `id_cla` (`id_cla`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `les_periodes_classes`
-- 

INSERT INTO `les_periodes_classes` VALUES (42, 12, 0x323030352d30392d3034, 0x323030352d30392d3130, 0x323030352d30392d3131, 0x323030352d30392d3234);
INSERT INTO `les_periodes_classes` VALUES (43, 12, 0x323030352d31302d3137, 0x323030352d31302d3231, 0x323030352d31302d3232, 0x323030352d31312d3035);
INSERT INTO `les_periodes_classes` VALUES (44, 12, 0x323030352d31312d3134, 0x323030352d31312d3138, 0x323030352d31302d3232, 0x323030352d31312d3133);
INSERT INTO `les_periodes_classes` VALUES (45, 12, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030);
INSERT INTO `les_periodes_classes` VALUES (46, 12, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030);
INSERT INTO `les_periodes_classes` VALUES (47, 12, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030);
INSERT INTO `les_periodes_classes` VALUES (48, 12, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030);
INSERT INTO `les_periodes_classes` VALUES (49, 12, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030);
INSERT INTO `les_periodes_classes` VALUES (50, 12, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030);
INSERT INTO `les_periodes_classes` VALUES (51, 12, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030);
INSERT INTO `les_periodes_classes` VALUES (52, 12, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030);
INSERT INTO `les_periodes_classes` VALUES (53, 12, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030);
INSERT INTO `les_periodes_classes` VALUES (54, 13, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030);
INSERT INTO `les_periodes_classes` VALUES (55, 13, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030);
INSERT INTO `les_periodes_classes` VALUES (56, 13, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030);
INSERT INTO `les_periodes_classes` VALUES (57, 13, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030);
INSERT INTO `les_periodes_classes` VALUES (58, 13, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030);
INSERT INTO `les_periodes_classes` VALUES (59, 13, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030);
INSERT INTO `les_periodes_classes` VALUES (60, 13, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030);
INSERT INTO `les_periodes_classes` VALUES (61, 13, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030);
INSERT INTO `les_periodes_classes` VALUES (62, 13, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030);
INSERT INTO `les_periodes_classes` VALUES (63, 13, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030);
INSERT INTO `les_periodes_classes` VALUES (64, 13, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030);
INSERT INTO `les_periodes_classes` VALUES (65, 13, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030);
INSERT INTO `les_periodes_classes` VALUES (66, 14, 0x323030362d30352d3031, 0x323030362d30352d3035, 0x323030362d30352d3038, 0x323030362d30352d3139);
INSERT INTO `les_periodes_classes` VALUES (67, 14, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030);
INSERT INTO `les_periodes_classes` VALUES (68, 14, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030);
INSERT INTO `les_periodes_classes` VALUES (69, 14, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030);
INSERT INTO `les_periodes_classes` VALUES (71, 33, 0x323030352d30392d3031, 0x323030352d31302d3135, 0x323030352d30392d3031, 0x323030352d31302d3135);
INSERT INTO `les_periodes_classes` VALUES (71, 34, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030);
INSERT INTO `les_periodes_classes` VALUES (74, 33, 0x323030362d30312d3239, 0x323030362d30332d3138, 0x323030362d30312d3239, 0x323030362d30332d3138);
INSERT INTO `les_periodes_classes` VALUES (74, 34, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030);
INSERT INTO `les_periodes_classes` VALUES (81, 33, 0x323030352d31302d3136, 0x323030352d31312d3236, 0x323030352d31302d3136, 0x323030352d31312d3236);
INSERT INTO `les_periodes_classes` VALUES (81, 34, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030);
INSERT INTO `les_periodes_classes` VALUES (82, 33, 0x323030352d31312d3237, 0x323030362d30312d3238, 0x323030352d31312d3237, 0x323030362d30312d3238);
INSERT INTO `les_periodes_classes` VALUES (82, 34, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030);
INSERT INTO `les_periodes_classes` VALUES (83, 33, 0x323030362d30332d3139, 0x323030362d30342d3239, 0x323030362d30332d3139, 0x323030362d30342d3239);
INSERT INTO `les_periodes_classes` VALUES (83, 34, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030);
INSERT INTO `les_periodes_classes` VALUES (84, 33, 0x323030362d30352d3031, 0x323030362d30362d3330, 0x323030362d30352d3031, 0x323030362d30362d3330);
INSERT INTO `les_periodes_classes` VALUES (84, 34, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030, 0x303030302d30302d3030);
INSERT INTO `les_periodes_classes` VALUES (85, 28, 0x323030362d30392d3131, 0x323030362d30392d3135, 0x323030362d30392d3138, 0x323030362d30392d3239);
INSERT INTO `les_periodes_classes` VALUES (85, 29, 0x323030362d30392d3034, 0x323030362d30392d3038, 0x323030362d30392d3131, 0x323030362d30392d3232);
INSERT INTO `les_periodes_classes` VALUES (86, 28, 0x323030362d31302d3032, 0x323030362d31302d3036, 0x323030362d31302d3039, 0x323030362d31302d3230);
INSERT INTO `les_periodes_classes` VALUES (86, 29, 0x323030362d30392d3235, 0x323030362d30392d3239, 0x323030362d31302d3032, 0x323030362d31302d3133);
INSERT INTO `les_periodes_classes` VALUES (87, 28, 0x323030362d31302d3233, 0x323030362d31302d3235, 0x323030362d31302d3330, 0x323030362d31312d3137);
INSERT INTO `les_periodes_classes` VALUES (87, 29, 0x323030362d31302d3136, 0x323030362d31312d3230, 0x323030362d31302d3233, 0x323030362d31312d3130);
INSERT INTO `les_periodes_classes` VALUES (88, 28, 0x323030362d31312d3230, 0x323030362d31312d3234, 0x323030362d31312d3237, 0x323030362d31322d3038);
INSERT INTO `les_periodes_classes` VALUES (88, 29, 0x323030362d31312d3133, 0x323030362d31312d3137, 0x323030362d31312d3230, 0x323030362d31322d3031);
INSERT INTO `les_periodes_classes` VALUES (89, 28, 0x323030362d31322d3131, 0x323030362d31322d3135, 0x323030362d31322d3138, 0x323030372d30312d3132);
INSERT INTO `les_periodes_classes` VALUES (89, 29, 0x323030362d31322d3034, 0x323030362d31322d3038, 0x323030362d31322d3131, 0x323030372d30312d3035);
INSERT INTO `les_periodes_classes` VALUES (90, 28, 0x323030372d30312d3135, 0x323030372d30312d3139, 0x323030362d30312d3232, 0x323030362d30322d3032);
INSERT INTO `les_periodes_classes` VALUES (90, 29, 0x323030372d30312d3038, 0x323030372d30312d3132, 0x323030372d30312d3135, 0x323030372d30312d3236);
INSERT INTO `les_periodes_classes` VALUES (91, 28, 0x323030372d30322d3035, 0x323030372d30322d3039, 0x323030372d30322d3132, 0x323030372d30332d3039);
INSERT INTO `les_periodes_classes` VALUES (91, 29, 0x323030372d30312d3239, 0x323030372d30322d3032, 0x323030372d30322d3035, 0x323030372d30332d3032);
INSERT INTO `les_periodes_classes` VALUES (92, 28, 0x323030372d30332d3132, 0x323030372d30332d3136, 0x323030372d30332d3139, 0x323030372d30342d3133);
INSERT INTO `les_periodes_classes` VALUES (92, 29, 0x323030372d30332d3035, 0x323030372d30332d3039, 0x323030372d30332d3132, 0x323030372d30332d3233);
INSERT INTO `les_periodes_classes` VALUES (93, 28, 0x323030372d30342d3136, 0x323030372d30342d3230, 0x323030372d30342d3233, 0x323030372d30352d3235);
INSERT INTO `les_periodes_classes` VALUES (93, 29, 0x323030372d30332d3236, 0x323030372d30332d3330, 0x323030372d30342d3032, 0x323030372d30342d3237);
INSERT INTO `les_periodes_classes` VALUES (94, 28, 0x323030372d30352d3239, 0x323030372d30362d3031, 0x323030372d30362d3034, 0x323030372d30362d3135);
INSERT INTO `les_periodes_classes` VALUES (94, 29, 0x323030372d30342d3330, 0x323030372d30352d3034, 0x323030372d30352d3037, 0x323030372d30352d3138);
INSERT INTO `les_periodes_classes` VALUES (95, 28, 0x323030362d30362d3138, 0x323030362d30362d3139, 0x323030362d30362d3230, 0x323030362d30362d3236);
INSERT INTO `les_periodes_classes` VALUES (95, 29, 0x323030372d30352d3231, 0x323030372d30352d3235, 0x323030372d30352d3238, 0x323030372d30362d3038);
INSERT INTO `les_periodes_classes` VALUES (96, 28, 0x323030372d30362d3237, 0x323030372d30362d3239, 0x323030372d30372d3032, 0x323030372d30372d3036);
INSERT INTO `les_periodes_classes` VALUES (96, 29, 0x323030372d30362d3131, 0x323030372d30362d3135, 0x323030372d30362d3138, 0x323030372d30362d3232);
INSERT INTO `les_periodes_classes` VALUES (98, 29, 0x323030372d30362d3235, 0x323030372d30362d3236, 0x323030372d30362d3237, 0x323030372d30362d3330);
INSERT INTO `les_periodes_classes` VALUES (102, 37, 0x323030352d30312d3031, 0x323130302d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (103, 37, 0x323030352d30312d3031, 0x323130302d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (104, 37, 0x323030352d30312d3031, 0x323130302d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (105, 37, 0x323030352d30312d3031, 0x323130302d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (106, 37, 0x323030352d30312d3031, 0x323130302d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (107, 37, 0x323030352d30312d3031, 0x323130302d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (108, 37, 0x323030352d30312d3031, 0x323130302d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (109, 37, 0x323030352d30312d3031, 0x323130302d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (110, 37, 0x323030352d30312d3031, 0x323130302d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (111, 37, 0x323030352d30312d3031, 0x323130302d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (112, 37, 0x323030352d30312d3031, 0x323130302d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (113, 37, 0x323030352d30312d3031, 0x323130302d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (114, 37, 0x323030352d30312d3031, 0x323130302d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (115, 37, 0x323030352d30312d3031, 0x323130302d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (116, 37, 0x323030352d30312d3031, 0x323130302d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (117, 37, 0x323030352d30312d3031, 0x323130302d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (118, 37, 0x323030352d30312d3031, 0x323130302d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (119, 37, 0x323030352d30312d3031, 0x323130302d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (120, 37, 0x323030352d30312d3031, 0x323130302d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (121, 37, 0x323030352d30312d3031, 0x323130302d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (122, 44, 0x323030352d30312d3031, 0x323031352d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (122, 45, 0x323030352d30312d3031, 0x323031352d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (122, 46, 0x323030352d30312d3031, 0x323031352d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (126, 44, 0x323030352d30312d3031, 0x323031352d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (126, 45, 0x323030352d30312d3031, 0x323031352d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (126, 46, 0x323030352d30312d3031, 0x323031352d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (127, 44, 0x323030352d30312d3031, 0x323031352d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (127, 45, 0x323030352d30312d3031, 0x323031352d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (127, 46, 0x323030352d30312d3031, 0x323031352d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (128, 44, 0x323030352d30312d3031, 0x323031352d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (128, 45, 0x323030352d30312d3031, 0x323031352d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (128, 46, 0x323030352d30312d3031, 0x323031352d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (129, 44, 0x323030352d30312d3031, 0x323031352d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (129, 45, 0x323030352d30312d3031, 0x323031352d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (129, 46, 0x323030352d30312d3031, 0x323031352d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (130, 44, 0x323030352d30312d3031, 0x323031352d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (130, 45, 0x323030352d30312d3031, 0x323031352d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (130, 46, 0x323030352d30312d3031, 0x323031352d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (131, 44, 0x323030352d30312d3031, 0x323031352d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (131, 45, 0x323030352d30312d3031, 0x323031352d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);
INSERT INTO `les_periodes_classes` VALUES (131, 46, 0x323030352d30312d3031, 0x323031352d30312d3031, 0x323030352d30312d3031, 0x323130302d30312d3031);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_periodes_modalite_reponse_choix`
-- 

CREATE TABLE `les_periodes_modalite_reponse_choix` (
  `id_periode` bigint(20) NOT NULL default '0',
  `id_modalite` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_periode`,`id_modalite`),
  KEY `id_modalite` (`id_modalite`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `les_periodes_modalite_reponse_choix`
-- 

INSERT INTO `les_periodes_modalite_reponse_choix` VALUES (71, 8);
INSERT INTO `les_periodes_modalite_reponse_choix` VALUES (74, 8);
INSERT INTO `les_periodes_modalite_reponse_choix` VALUES (81, 8);
INSERT INTO `les_periodes_modalite_reponse_choix` VALUES (82, 8);
INSERT INTO `les_periodes_modalite_reponse_choix` VALUES (83, 8);
INSERT INTO `les_periodes_modalite_reponse_choix` VALUES (84, 8);
INSERT INTO `les_periodes_modalite_reponse_choix` VALUES (71, 9);
INSERT INTO `les_periodes_modalite_reponse_choix` VALUES (74, 9);
INSERT INTO `les_periodes_modalite_reponse_choix` VALUES (81, 9);
INSERT INTO `les_periodes_modalite_reponse_choix` VALUES (82, 9);
INSERT INTO `les_periodes_modalite_reponse_choix` VALUES (83, 9);
INSERT INTO `les_periodes_modalite_reponse_choix` VALUES (66, 10);
INSERT INTO `les_periodes_modalite_reponse_choix` VALUES (67, 10);
INSERT INTO `les_periodes_modalite_reponse_choix` VALUES (68, 10);
INSERT INTO `les_periodes_modalite_reponse_choix` VALUES (69, 10);
INSERT INTO `les_periodes_modalite_reponse_choix` VALUES (70, 10);
INSERT INTO `les_periodes_modalite_reponse_choix` VALUES (66, 11);
INSERT INTO `les_periodes_modalite_reponse_choix` VALUES (67, 11);
INSERT INTO `les_periodes_modalite_reponse_choix` VALUES (68, 11);
INSERT INTO `les_periodes_modalite_reponse_choix` VALUES (69, 11);
INSERT INTO `les_periodes_modalite_reponse_choix` VALUES (70, 11);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_periodes_modalite_reponse_libre`
-- 

CREATE TABLE `les_periodes_modalite_reponse_libre` (
  `id_periode` bigint(20) NOT NULL default '0',
  `id_modalite` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_periode`,`id_modalite`),
  KEY `id_modalite` (`id_modalite`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `les_periodes_modalite_reponse_libre`
-- 

INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (71, 21);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (74, 21);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (81, 21);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (82, 21);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (83, 21);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (84, 21);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (71, 22);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (74, 22);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (81, 22);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (82, 22);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (83, 22);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (84, 22);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (71, 23);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (74, 23);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (81, 23);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (82, 23);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (83, 23);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (84, 23);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (71, 24);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (74, 24);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (81, 24);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (82, 24);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (83, 24);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (84, 24);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (71, 25);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (74, 25);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (81, 25);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (82, 25);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (83, 25);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (84, 25);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (71, 26);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (74, 26);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (81, 26);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (82, 26);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (83, 26);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (84, 26);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (71, 27);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (74, 27);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (81, 27);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (82, 27);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (83, 27);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (84, 27);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (71, 28);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (74, 28);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (81, 28);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (82, 28);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (83, 28);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (84, 28);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (71, 29);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (74, 29);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (81, 29);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (82, 29);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (83, 29);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (84, 29);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (71, 31);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (74, 31);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (81, 31);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (82, 31);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (83, 31);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (71, 33);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (74, 33);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (81, 33);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (82, 33);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (83, 33);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (84, 33);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (85, 37);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (86, 37);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (87, 37);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (88, 37);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (89, 37);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (90, 37);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (91, 37);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (92, 37);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (93, 37);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (94, 37);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (95, 37);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (96, 37);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (98, 37);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (85, 38);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (86, 38);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (87, 38);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (88, 38);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (89, 38);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (90, 38);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (91, 38);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (92, 38);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (93, 38);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (94, 38);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (95, 38);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (96, 38);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (98, 38);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (85, 41);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (86, 41);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (87, 41);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (88, 41);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (89, 41);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (90, 41);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (91, 41);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (92, 41);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (93, 41);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (94, 41);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (95, 41);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (96, 41);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (98, 41);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (102, 43);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (103, 43);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (104, 43);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (105, 43);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (106, 43);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (107, 43);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (108, 43);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (109, 43);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (110, 43);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (111, 43);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (112, 43);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (113, 43);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (114, 43);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (115, 43);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (116, 43);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (117, 43);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (118, 43);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (119, 43);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (120, 43);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (121, 43);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (102, 44);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (103, 44);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (104, 44);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (105, 44);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (106, 44);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (107, 44);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (108, 44);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (109, 44);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (110, 44);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (111, 44);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (112, 44);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (113, 44);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (114, 44);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (115, 44);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (116, 44);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (117, 44);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (118, 44);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (119, 44);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (120, 44);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (121, 44);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (102, 45);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (103, 45);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (104, 45);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (105, 45);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (106, 45);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (107, 45);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (108, 45);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (109, 45);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (110, 45);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (111, 45);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (112, 45);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (113, 45);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (114, 45);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (115, 45);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (116, 45);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (117, 45);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (118, 45);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (119, 45);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (120, 45);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (121, 45);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (102, 46);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (103, 46);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (104, 46);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (105, 46);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (106, 46);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (107, 46);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (108, 46);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (109, 46);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (110, 46);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (111, 46);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (112, 46);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (113, 46);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (114, 46);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (115, 46);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (116, 46);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (117, 46);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (118, 46);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (119, 46);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (120, 46);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (121, 46);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (102, 47);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (103, 47);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (104, 47);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (105, 47);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (106, 47);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (107, 47);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (108, 47);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (109, 47);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (110, 47);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (111, 47);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (112, 47);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (113, 47);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (114, 47);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (115, 47);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (116, 47);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (117, 47);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (118, 47);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (119, 47);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (120, 47);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (121, 47);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (102, 48);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (103, 48);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (104, 48);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (105, 48);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (106, 48);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (107, 48);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (108, 48);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (109, 48);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (110, 48);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (111, 48);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (112, 48);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (113, 48);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (114, 48);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (115, 48);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (116, 48);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (117, 48);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (118, 48);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (119, 48);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (120, 48);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (121, 48);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (102, 49);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (103, 49);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (104, 49);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (105, 49);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (106, 49);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (107, 49);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (108, 49);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (109, 49);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (110, 49);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (111, 49);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (112, 49);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (113, 49);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (114, 49);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (115, 49);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (116, 49);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (117, 49);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (118, 49);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (119, 49);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (120, 49);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (121, 49);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (102, 50);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (103, 50);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (104, 50);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (105, 50);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (106, 50);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (107, 50);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (108, 50);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (109, 50);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (110, 50);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (111, 50);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (112, 50);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (113, 50);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (114, 50);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (115, 50);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (116, 50);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (117, 50);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (118, 50);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (119, 50);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (120, 50);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (121, 50);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (122, 54);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (123, 54);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (124, 54);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (125, 54);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (126, 54);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (127, 54);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (128, 54);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (129, 54);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (130, 54);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (131, 54);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (122, 55);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (123, 55);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (124, 55);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (125, 55);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (126, 55);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (127, 55);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (128, 55);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (129, 55);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (130, 55);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (131, 55);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (122, 56);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (123, 56);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (124, 56);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (125, 56);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (126, 56);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (127, 56);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (128, 56);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (129, 56);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (130, 56);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (131, 56);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (122, 57);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (123, 57);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (124, 57);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (125, 57);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (126, 57);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (127, 57);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (128, 57);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (129, 57);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (130, 57);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (131, 57);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (122, 58);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (123, 58);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (124, 58);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (125, 58);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (126, 58);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (127, 58);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (128, 58);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (129, 58);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (130, 58);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (131, 58);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (122, 59);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (123, 59);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (124, 59);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (125, 59);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (126, 59);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (127, 59);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (128, 59);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (129, 59);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (130, 59);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (131, 59);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (122, 60);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (123, 60);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (124, 60);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (125, 60);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (126, 60);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (127, 60);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (128, 60);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (129, 60);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (130, 60);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (131, 60);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (122, 61);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (123, 61);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (124, 61);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (125, 61);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (126, 61);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (127, 61);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (128, 61);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (129, 61);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (130, 61);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (131, 61);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (122, 62);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (123, 62);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (124, 62);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (125, 62);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (126, 62);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (127, 62);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (128, 62);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (129, 62);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (130, 62);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (131, 62);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (122, 63);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (123, 63);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (124, 63);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (125, 63);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (126, 63);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (127, 63);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (128, 63);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (129, 63);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (130, 63);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (131, 63);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (102, 64);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (103, 64);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (104, 64);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (105, 64);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (106, 64);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (107, 64);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (108, 64);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (109, 64);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (110, 64);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (111, 64);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (112, 64);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (113, 64);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (114, 64);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (115, 64);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (116, 64);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (117, 64);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (118, 64);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (119, 64);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (120, 64);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (121, 64);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (66, 65);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (67, 65);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (68, 65);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (69, 65);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (70, 65);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_periodes_modalite_va_multiple`
-- 

CREATE TABLE `les_periodes_modalite_va_multiple` (
  `id_periode` bigint(20) NOT NULL default '0',
  `id_modalite` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_periode`,`id_modalite`),
  KEY `id_modalite` (`id_modalite`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `les_periodes_modalite_va_multiple`
-- 

INSERT INTO `les_periodes_modalite_va_multiple` VALUES (71, 18);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (74, 18);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (81, 18);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (82, 18);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (83, 18);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (84, 18);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (85, 22);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (86, 22);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (87, 22);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (88, 22);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (89, 22);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (90, 22);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (91, 22);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (92, 22);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (93, 22);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (94, 22);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (95, 22);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (96, 22);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (98, 22);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (102, 23);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (103, 23);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (104, 23);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (105, 23);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (106, 23);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (107, 23);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (108, 23);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (109, 23);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (110, 23);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (111, 23);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (112, 23);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (113, 23);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (114, 23);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (115, 23);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (116, 23);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (117, 23);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (118, 23);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (119, 23);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (120, 23);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (121, 23);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (102, 27);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (103, 27);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (104, 27);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (105, 27);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (106, 27);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (107, 27);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (108, 27);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (109, 27);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (110, 27);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (111, 27);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (112, 27);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (113, 27);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (114, 27);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (115, 27);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (116, 27);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (117, 27);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (118, 27);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (119, 27);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (120, 27);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (121, 27);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (102, 28);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (103, 28);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (104, 28);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (105, 28);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (106, 28);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (107, 28);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (108, 28);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (109, 28);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (110, 28);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (111, 28);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (112, 28);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (113, 28);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (114, 28);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (115, 28);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (116, 28);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (117, 28);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (118, 28);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (119, 28);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (120, 28);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (121, 28);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_periodes_modalite_va_unique`
-- 

CREATE TABLE `les_periodes_modalite_va_unique` (
  `id_periode` bigint(20) NOT NULL default '0',
  `id_modalite` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_periode`,`id_modalite`),
  KEY `id_modalite` (`id_modalite`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `les_periodes_modalite_va_unique`
-- 

INSERT INTO `les_periodes_modalite_va_unique` VALUES (71, 10);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (74, 10);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (81, 10);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (82, 10);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (83, 10);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (84, 10);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (71, 12);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (74, 12);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (81, 12);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (82, 12);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (83, 12);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (84, 12);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (71, 13);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (74, 13);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (81, 13);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (82, 13);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (83, 13);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (84, 13);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (71, 17);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (74, 17);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (81, 17);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (82, 17);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (83, 17);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (84, 17);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (71, 20);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (74, 20);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (81, 20);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (82, 20);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (83, 20);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (102, 24);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (103, 24);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (104, 24);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (105, 24);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (106, 24);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (107, 24);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (108, 24);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (109, 24);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (110, 24);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (111, 24);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (112, 24);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (113, 24);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (114, 24);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (115, 24);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (116, 24);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (117, 24);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (118, 24);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (119, 24);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (120, 24);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (121, 24);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (102, 26);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (103, 26);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (104, 26);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (105, 26);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (106, 26);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (107, 26);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (108, 26);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (109, 26);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (110, 26);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (111, 26);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (112, 26);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (113, 26);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (114, 26);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (115, 26);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (116, 26);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (117, 26);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (118, 26);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (119, 26);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (120, 26);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (121, 26);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (102, 27);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (103, 27);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (104, 27);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (105, 27);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (106, 27);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (107, 27);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (108, 27);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (109, 27);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (110, 27);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (111, 27);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (112, 27);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (113, 27);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (114, 27);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (115, 27);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (116, 27);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (117, 27);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (118, 27);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (119, 27);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (120, 27);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (121, 27);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (66, 29);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (67, 29);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (68, 29);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (69, 29);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (70, 29);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_representants_legaux`
-- 

CREATE TABLE `les_representants_legaux` (
  `id_rl` bigint(20) NOT NULL default '0',
  `profession` tinytext,
  `adresse_prof` text,
  PRIMARY KEY  (`id_rl`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `les_representants_legaux`
-- 

INSERT INTO `les_representants_legaux` VALUES (23389, '', '');
INSERT INTO `les_representants_legaux` VALUES (23392, '', '');
INSERT INTO `les_representants_legaux` VALUES (23395, '', '');
INSERT INTO `les_representants_legaux` VALUES (23398, '', '');
INSERT INTO `les_representants_legaux` VALUES (23401, '', '');
INSERT INTO `les_representants_legaux` VALUES (23404, '', '');
INSERT INTO `les_representants_legaux` VALUES (23406, '', '');
INSERT INTO `les_representants_legaux` VALUES (23409, '', '');
INSERT INTO `les_representants_legaux` VALUES (23412, '', '');
INSERT INTO `les_representants_legaux` VALUES (23415, '', '');
INSERT INTO `les_representants_legaux` VALUES (23418, '', '');
INSERT INTO `les_representants_legaux` VALUES (23421, '', '');
INSERT INTO `les_representants_legaux` VALUES (23423, '', '');
INSERT INTO `les_representants_legaux` VALUES (23426, '', '');
INSERT INTO `les_representants_legaux` VALUES (23429, '', '');
INSERT INTO `les_representants_legaux` VALUES (23432, '', '');
INSERT INTO `les_representants_legaux` VALUES (23446, '', '');
INSERT INTO `les_representants_legaux` VALUES (23449, '', '');
INSERT INTO `les_representants_legaux` VALUES (23452, '', '');
INSERT INTO `les_representants_legaux` VALUES (23455, '', '');
INSERT INTO `les_representants_legaux` VALUES (23458, '', '');
INSERT INTO `les_representants_legaux` VALUES (23461, '', '');
INSERT INTO `les_representants_legaux` VALUES (23464, '', '');
INSERT INTO `les_representants_legaux` VALUES (23467, '', '');
INSERT INTO `les_representants_legaux` VALUES (23470, '', '');
INSERT INTO `les_representants_legaux` VALUES (23472, '', '');
INSERT INTO `les_representants_legaux` VALUES (23475, '', '');
INSERT INTO `les_representants_legaux` VALUES (23478, '', '');
INSERT INTO `les_representants_legaux` VALUES (23481, '', '');
INSERT INTO `les_representants_legaux` VALUES (23483, '', '');
INSERT INTO `les_representants_legaux` VALUES (23486, '', '');
INSERT INTO `les_representants_legaux` VALUES (23489, '', '');
INSERT INTO `les_representants_legaux` VALUES (23492, '', '');
INSERT INTO `les_representants_legaux` VALUES (23495, '', '');
INSERT INTO `les_representants_legaux` VALUES (23498, '', '');
INSERT INTO `les_representants_legaux` VALUES (23501, '', '');
INSERT INTO `les_representants_legaux` VALUES (23503, '', '');
INSERT INTO `les_representants_legaux` VALUES (23506, '', '');
INSERT INTO `les_representants_legaux` VALUES (23509, '', '');
INSERT INTO `les_representants_legaux` VALUES (23512, '', '');
INSERT INTO `les_representants_legaux` VALUES (23515, '', '');
INSERT INTO `les_representants_legaux` VALUES (23518, '', '');
INSERT INTO `les_representants_legaux` VALUES (23521, '', '');
INSERT INTO `les_representants_legaux` VALUES (23523, '', '');
INSERT INTO `les_representants_legaux` VALUES (23526, '', '');
INSERT INTO `les_representants_legaux` VALUES (23529, '', '');
INSERT INTO `les_representants_legaux` VALUES (23532, '', '');
INSERT INTO `les_representants_legaux` VALUES (23535, '', '');
INSERT INTO `les_representants_legaux` VALUES (23537, '', '');
INSERT INTO `les_representants_legaux` VALUES (23540, '', '');
INSERT INTO `les_representants_legaux` VALUES (23542, '', '');
INSERT INTO `les_representants_legaux` VALUES (23544, '', '');
INSERT INTO `les_representants_legaux` VALUES (23546, '', '');
INSERT INTO `les_representants_legaux` VALUES (23549, '', '');
INSERT INTO `les_representants_legaux` VALUES (23552, '', '');
INSERT INTO `les_representants_legaux` VALUES (23555, '', '');
INSERT INTO `les_representants_legaux` VALUES (23558, '', '');
INSERT INTO `les_representants_legaux` VALUES (23561, '', '');
INSERT INTO `les_representants_legaux` VALUES (23563, '', '');
INSERT INTO `les_representants_legaux` VALUES (23566, '', '');
INSERT INTO `les_representants_legaux` VALUES (23569, '', '');
INSERT INTO `les_representants_legaux` VALUES (23572, '', '');
INSERT INTO `les_representants_legaux` VALUES (23574, '', '');
INSERT INTO `les_representants_legaux` VALUES (23576, '', '');
INSERT INTO `les_representants_legaux` VALUES (23579, '', '');
INSERT INTO `les_representants_legaux` VALUES (23582, '', '');
INSERT INTO `les_representants_legaux` VALUES (23584, '', '');
INSERT INTO `les_representants_legaux` VALUES (23587, '', '');
INSERT INTO `les_representants_legaux` VALUES (23589, '', '');
INSERT INTO `les_representants_legaux` VALUES (23592, '', '');
INSERT INTO `les_representants_legaux` VALUES (23595, '', '');
INSERT INTO `les_representants_legaux` VALUES (23598, '', '');
INSERT INTO `les_representants_legaux` VALUES (23600, '', '');
INSERT INTO `les_representants_legaux` VALUES (23603, '', '');
INSERT INTO `les_representants_legaux` VALUES (23606, '', '');
INSERT INTO `les_representants_legaux` VALUES (23609, '', '');
INSERT INTO `les_representants_legaux` VALUES (23611, '', '');
INSERT INTO `les_representants_legaux` VALUES (23614, '', '');
INSERT INTO `les_representants_legaux` VALUES (23616, '', '');
INSERT INTO `les_representants_legaux` VALUES (23619, '', '');
INSERT INTO `les_representants_legaux` VALUES (23622, '', '');
INSERT INTO `les_representants_legaux` VALUES (23625, '', '');
INSERT INTO `les_representants_legaux` VALUES (23628, '', '');
INSERT INTO `les_representants_legaux` VALUES (23630, '', '');
INSERT INTO `les_representants_legaux` VALUES (23633, '', '');
INSERT INTO `les_representants_legaux` VALUES (23636, '', '');
INSERT INTO `les_representants_legaux` VALUES (23639, '', '');
INSERT INTO `les_representants_legaux` VALUES (23642, '', '');
INSERT INTO `les_representants_legaux` VALUES (23645, '', '');
INSERT INTO `les_representants_legaux` VALUES (23648, '', '');
INSERT INTO `les_representants_legaux` VALUES (23651, '', '');
INSERT INTO `les_representants_legaux` VALUES (23654, '', '');
INSERT INTO `les_representants_legaux` VALUES (23657, '', '');
INSERT INTO `les_representants_legaux` VALUES (23660, '', '');
INSERT INTO `les_representants_legaux` VALUES (23663, '', '');
INSERT INTO `les_representants_legaux` VALUES (23666, '', '');
INSERT INTO `les_representants_legaux` VALUES (23669, '', '');
INSERT INTO `les_representants_legaux` VALUES (23672, '', '');
INSERT INTO `les_representants_legaux` VALUES (23675, '', '');
INSERT INTO `les_representants_legaux` VALUES (23678, '', '');
INSERT INTO `les_representants_legaux` VALUES (23681, '', '');
INSERT INTO `les_representants_legaux` VALUES (23684, '', '');
INSERT INTO `les_representants_legaux` VALUES (23687, '', '');
INSERT INTO `les_representants_legaux` VALUES (23689, '', '');
INSERT INTO `les_representants_legaux` VALUES (23692, '', '');
INSERT INTO `les_representants_legaux` VALUES (23695, '', '');
INSERT INTO `les_representants_legaux` VALUES (23698, '', '');
INSERT INTO `les_representants_legaux` VALUES (23701, '', '');
INSERT INTO `les_representants_legaux` VALUES (23704, '', '');
INSERT INTO `les_representants_legaux` VALUES (23707, '', '');
INSERT INTO `les_representants_legaux` VALUES (23709, '', '');
INSERT INTO `les_representants_legaux` VALUES (23712, '', '');
INSERT INTO `les_representants_legaux` VALUES (23714, '', '');
INSERT INTO `les_representants_legaux` VALUES (23716, '', '');
INSERT INTO `les_representants_legaux` VALUES (23719, '', '');
INSERT INTO `les_representants_legaux` VALUES (23721, '', '');
INSERT INTO `les_representants_legaux` VALUES (23728, '', '');
INSERT INTO `les_representants_legaux` VALUES (23731, '', '');
INSERT INTO `les_representants_legaux` VALUES (23734, '', '');
INSERT INTO `les_representants_legaux` VALUES (23738, '', '');
INSERT INTO `les_representants_legaux` VALUES (23741, '', '');
INSERT INTO `les_representants_legaux` VALUES (23744, '', '');
INSERT INTO `les_representants_legaux` VALUES (23747, '', '');
INSERT INTO `les_representants_legaux` VALUES (23750, '', '');
INSERT INTO `les_representants_legaux` VALUES (23753, '', '');
INSERT INTO `les_representants_legaux` VALUES (23756, '', '');
INSERT INTO `les_representants_legaux` VALUES (23759, '', '');
INSERT INTO `les_representants_legaux` VALUES (23762, '', '');
INSERT INTO `les_representants_legaux` VALUES (23766, '', '');
INSERT INTO `les_representants_legaux` VALUES (23769, '', '');
INSERT INTO `les_representants_legaux` VALUES (23772, '', '');
INSERT INTO `les_representants_legaux` VALUES (23775, '', '');
INSERT INTO `les_representants_legaux` VALUES (23778, '', '');
INSERT INTO `les_representants_legaux` VALUES (23781, '', '');
INSERT INTO `les_representants_legaux` VALUES (23784, '', '');
INSERT INTO `les_representants_legaux` VALUES (23787, '', '');
INSERT INTO `les_representants_legaux` VALUES (23790, '', '');
INSERT INTO `les_representants_legaux` VALUES (23793, '', '');
INSERT INTO `les_representants_legaux` VALUES (23796, '', '');
INSERT INTO `les_representants_legaux` VALUES (23802, '', '');
INSERT INTO `les_representants_legaux` VALUES (23805, '', '');
INSERT INTO `les_representants_legaux` VALUES (23808, '', '');
INSERT INTO `les_representants_legaux` VALUES (23810, '', '');
INSERT INTO `les_representants_legaux` VALUES (23813, '', '');
INSERT INTO `les_representants_legaux` VALUES (23816, '', '');
INSERT INTO `les_representants_legaux` VALUES (23819, '', '');
INSERT INTO `les_representants_legaux` VALUES (23822, '', '');
INSERT INTO `les_representants_legaux` VALUES (23825, '', '');
INSERT INTO `les_representants_legaux` VALUES (23829, '', '');
INSERT INTO `les_representants_legaux` VALUES (23832, '', '');
INSERT INTO `les_representants_legaux` VALUES (23835, '', '');
INSERT INTO `les_representants_legaux` VALUES (23838, '', '');
INSERT INTO `les_representants_legaux` VALUES (23841, '', '');
INSERT INTO `les_representants_legaux` VALUES (23844, '', '');
INSERT INTO `les_representants_legaux` VALUES (23847, '', '');
INSERT INTO `les_representants_legaux` VALUES (23850, '', '');
INSERT INTO `les_representants_legaux` VALUES (23853, '', '');
INSERT INTO `les_representants_legaux` VALUES (23856, '', '');
INSERT INTO `les_representants_legaux` VALUES (23861, '', '');
INSERT INTO `les_representants_legaux` VALUES (23865, '', '');
INSERT INTO `les_representants_legaux` VALUES (23868, '', '');
INSERT INTO `les_representants_legaux` VALUES (23871, '', '');
INSERT INTO `les_representants_legaux` VALUES (23874, '', '');
INSERT INTO `les_representants_legaux` VALUES (23877, '', '');
INSERT INTO `les_representants_legaux` VALUES (23880, '', '');
INSERT INTO `les_representants_legaux` VALUES (23883, '', '');
INSERT INTO `les_representants_legaux` VALUES (23886, '', '');
INSERT INTO `les_representants_legaux` VALUES (23890, '', '');
INSERT INTO `les_representants_legaux` VALUES (23900, '', '');
INSERT INTO `les_representants_legaux` VALUES (23902, '', '');
INSERT INTO `les_representants_legaux` VALUES (23905, '', '');
INSERT INTO `les_representants_legaux` VALUES (23909, '', '');
INSERT INTO `les_representants_legaux` VALUES (23912, '', '');
INSERT INTO `les_representants_legaux` VALUES (23915, '', '');
INSERT INTO `les_representants_legaux` VALUES (23917, '', '');
INSERT INTO `les_representants_legaux` VALUES (23921, '', '');
INSERT INTO `les_representants_legaux` VALUES (23923, '', '');
INSERT INTO `les_representants_legaux` VALUES (23927, '', '');
INSERT INTO `les_representants_legaux` VALUES (23929, '', '');
INSERT INTO `les_representants_legaux` VALUES (23932, '', '');
INSERT INTO `les_representants_legaux` VALUES (23937, '', '');
INSERT INTO `les_representants_legaux` VALUES (23940, '', '');
INSERT INTO `les_representants_legaux` VALUES (23943, '', '');
INSERT INTO `les_representants_legaux` VALUES (23946, '', '');
INSERT INTO `les_representants_legaux` VALUES (23948, '', '');
INSERT INTO `les_representants_legaux` VALUES (23950, '', '');
INSERT INTO `les_representants_legaux` VALUES (23953, '', '');
INSERT INTO `les_representants_legaux` VALUES (23956, '', '');
INSERT INTO `les_representants_legaux` VALUES (23958, '', '');
INSERT INTO `les_representants_legaux` VALUES (23960, '', '');
INSERT INTO `les_representants_legaux` VALUES (23962, '', '');
INSERT INTO `les_representants_legaux` VALUES (23965, '', '');
INSERT INTO `les_representants_legaux` VALUES (23967, '', '');
INSERT INTO `les_representants_legaux` VALUES (23970, '', '');
INSERT INTO `les_representants_legaux` VALUES (23973, '', '');
INSERT INTO `les_representants_legaux` VALUES (23975, '', '');
INSERT INTO `les_representants_legaux` VALUES (23977, '', '');
INSERT INTO `les_representants_legaux` VALUES (23980, '', '');
INSERT INTO `les_representants_legaux` VALUES (23983, '', '');
INSERT INTO `les_representants_legaux` VALUES (23986, '', '');
INSERT INTO `les_representants_legaux` VALUES (23989, '', '');
INSERT INTO `les_representants_legaux` VALUES (23991, '', '');
INSERT INTO `les_representants_legaux` VALUES (23994, '', '');
INSERT INTO `les_representants_legaux` VALUES (23997, '', '');
INSERT INTO `les_representants_legaux` VALUES (23999, '', '');
INSERT INTO `les_representants_legaux` VALUES (24001, '', '');
INSERT INTO `les_representants_legaux` VALUES (24003, '', '');
INSERT INTO `les_representants_legaux` VALUES (24006, '', '');
INSERT INTO `les_representants_legaux` VALUES (24009, '', '');
INSERT INTO `les_representants_legaux` VALUES (24011, '', '');
INSERT INTO `les_representants_legaux` VALUES (24014, '', '');
INSERT INTO `les_representants_legaux` VALUES (24016, '', '');
INSERT INTO `les_representants_legaux` VALUES (24019, '', '');
INSERT INTO `les_representants_legaux` VALUES (24022, '', '');
INSERT INTO `les_representants_legaux` VALUES (24024, '', '');
INSERT INTO `les_representants_legaux` VALUES (24029, '', '');
INSERT INTO `les_representants_legaux` VALUES (24032, '', '');
INSERT INTO `les_representants_legaux` VALUES (24035, '', '');
INSERT INTO `les_representants_legaux` VALUES (24037, '', '');
INSERT INTO `les_representants_legaux` VALUES (24039, '', '');
INSERT INTO `les_representants_legaux` VALUES (24041, '', '');
INSERT INTO `les_representants_legaux` VALUES (24043, '', '');
INSERT INTO `les_representants_legaux` VALUES (24046, '', '');
INSERT INTO `les_representants_legaux` VALUES (24049, '', '');
INSERT INTO `les_representants_legaux` VALUES (24051, '', '');
INSERT INTO `les_representants_legaux` VALUES (24053, '', '');
INSERT INTO `les_representants_legaux` VALUES (24056, '', '');
INSERT INTO `les_representants_legaux` VALUES (24058, '', '');
INSERT INTO `les_representants_legaux` VALUES (24061, '', '');
INSERT INTO `les_representants_legaux` VALUES (24063, '', '');
INSERT INTO `les_representants_legaux` VALUES (24065, '', '');
INSERT INTO `les_representants_legaux` VALUES (24068, '', '');
INSERT INTO `les_representants_legaux` VALUES (24070, '', '');
INSERT INTO `les_representants_legaux` VALUES (24073, '', '');
INSERT INTO `les_representants_legaux` VALUES (24075, '', '');
INSERT INTO `les_representants_legaux` VALUES (24097, '', '');
INSERT INTO `les_representants_legaux` VALUES (24100, '', '');
INSERT INTO `les_representants_legaux` VALUES (24103, '', '');
INSERT INTO `les_representants_legaux` VALUES (24106, '', '');
INSERT INTO `les_representants_legaux` VALUES (24123, '', '');
INSERT INTO `les_representants_legaux` VALUES (24136, '', '');
INSERT INTO `les_representants_legaux` VALUES (24139, '', '');
INSERT INTO `les_representants_legaux` VALUES (24142, '', '');
INSERT INTO `les_representants_legaux` VALUES (24145, '', '');
INSERT INTO `les_representants_legaux` VALUES (24148, '', '');
INSERT INTO `les_representants_legaux` VALUES (24151, '', '');
INSERT INTO `les_representants_legaux` VALUES (24154, '', '');
INSERT INTO `les_representants_legaux` VALUES (24157, '', '');
INSERT INTO `les_representants_legaux` VALUES (24160, '', '');
INSERT INTO `les_representants_legaux` VALUES (24163, '', '');
INSERT INTO `les_representants_legaux` VALUES (24166, '', '');
INSERT INTO `les_representants_legaux` VALUES (24169, '', '');
INSERT INTO `les_representants_legaux` VALUES (24172, '', '');
INSERT INTO `les_representants_legaux` VALUES (24175, '', '');
INSERT INTO `les_representants_legaux` VALUES (24178, '', '');
INSERT INTO `les_representants_legaux` VALUES (24181, '', '');

-- --------------------------------------------------------

-- 
-- Structure de la table `les_responsables_unites_pedagogiques`
-- 

CREATE TABLE `les_responsables_unites_pedagogiques` (
  `id_rvs` bigint(20) NOT NULL default '0',
  `id_unite` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_rvs`,`id_unite`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `les_responsables_unites_pedagogiques`
-- 

INSERT INTO `les_responsables_unites_pedagogiques` VALUES (23189, 4);
INSERT INTO `les_responsables_unites_pedagogiques` VALUES (23190, 5);
INSERT INTO `les_responsables_unites_pedagogiques` VALUES (23191, 7);
INSERT INTO `les_responsables_unites_pedagogiques` VALUES (23192, 8);
INSERT INTO `les_responsables_unites_pedagogiques` VALUES (23193, 6);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_signatures_declarations`
-- 

CREATE TABLE `les_signatures_declarations` (
  `id_dec` bigint(20) NOT NULL default '0',
  `id_usager` bigint(20) NOT NULL default '0',
  `date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id_dec`,`id_usager`),
  KEY `id_usager` (`id_usager`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `les_signatures_declarations`
-- 

INSERT INTO `les_signatures_declarations` VALUES (83, 23390, 0x323030362d30362d3330);
INSERT INTO `les_signatures_declarations` VALUES (90, 23322, 0x323030362d30352d3233);
INSERT INTO `les_signatures_declarations` VALUES (90, 23387, 0x323030362d30352d3234);
INSERT INTO `les_signatures_declarations` VALUES (92, 23393, 0x323030362d30352d3234);
INSERT INTO `les_signatures_declarations` VALUES (95, 23402, 0x323030362d30352d3234);
INSERT INTO `les_signatures_declarations` VALUES (123, 23390, 0x323030362d30372d3031);
INSERT INTO `les_signatures_declarations` VALUES (124, 23393, 0x323030362d30352d3234);
INSERT INTO `les_signatures_declarations` VALUES (125, 23396, 0x323030362d30352d3234);
INSERT INTO `les_signatures_declarations` VALUES (127, 23402, 0x323030362d30352d3234);
INSERT INTO `les_signatures_declarations` VALUES (128, 23405, 0x323030362d30352d3234);
INSERT INTO `les_signatures_declarations` VALUES (129, 23407, 0x323030362d30352d3234);
INSERT INTO `les_signatures_declarations` VALUES (133, 23306, 0x323030362d30392d3133);
INSERT INTO `les_signatures_declarations` VALUES (133, 23352, 0x323030362d30392d3133);
INSERT INTO `les_signatures_declarations` VALUES (133, 23830, 0x323030362d30362d3232);
INSERT INTO `les_signatures_declarations` VALUES (134, 23828, 0x323030362d30362d3330);
INSERT INTO `les_signatures_declarations` VALUES (134, 23830, 0x323030362d30362d3232);
INSERT INTO `les_signatures_declarations` VALUES (139, 23899, 0x323030362d30362d3330);
INSERT INTO `les_signatures_declarations` VALUES (139, 23901, 0x323030362d30362d3330);
INSERT INTO `les_signatures_declarations` VALUES (152, 23901, 0x323030362d30392d3133);
INSERT INTO `les_signatures_declarations` VALUES (156, 23371, 0x323030362d30392d3231);
INSERT INTO `les_signatures_declarations` VALUES (157, 23371, 0x323030362d30392d3231);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_unites_pedagogiques`
-- 

CREATE TABLE `les_unites_pedagogiques` (
  `id_unite` bigint(20) NOT NULL auto_increment,
  `nom` tinytext NOT NULL,
  `adresse` text,
  `email` tinytext,
  `tel_fixe1` varchar(20) default NULL,
  `tel_fixe2` varchar(20) default NULL,
  `fax` varchar(20) default NULL,
  `url_site` tinytext,
  `nom_contact` varchar(50) NOT NULL default '',
  `prenom_contact` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id_unite`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- 
-- Contenu de la table `les_unites_pedagogiques`
-- 

INSERT INTO `les_unites_pedagogiques` VALUES (4, 'MAYENNE', '129 bd de l\\\\\\''Europe\r\nBP 127\r\n53103 Mayenne Cedex', '', '02.43.00.77.67', '', '02.43.04.80', '', 'LOUVEL', 'Christelle');
INSERT INTO `les_unites_pedagogiques` VALUES (5, 'CHATEAU GONTIER', '1 rue Branly\r\nBP 408\r\n53204 Château Gontier Cedex', '', '02.43.07.63.60', '', '02.43.07.06.73', '', 'CHEVALIER', 'Béatrice');
INSERT INTO `les_unites_pedagogiques` VALUES (7, 'BATIMENT', '84 bd Volney\r\nBP 1537\r\n53015 Laval Cedex', '', '02.43.91.19.14', '', '02.43.69.51.55', '', 'KUNTZ', 'Pierre');
INSERT INTO `les_unites_pedagogiques` VALUES (8, 'SIEGE', '84 bd Volney\r\nBP 1537\r\n53015 Laval Cedex', '', '02.43.59.03.60', '', '02.43.49.20.02', '', '', '');

-- --------------------------------------------------------

-- 
-- Structure de la table `les_usagers`
-- 

CREATE TABLE `les_usagers` (
  `id_usager` bigint(20) NOT NULL auto_increment,
  `civilite` varchar(15) NOT NULL default '',
  `nom` varchar(100) NOT NULL default '',
  `prenom` varchar(100) NOT NULL default '',
  `adresse` varchar(250) default NULL,
  `tel_fixe` varchar(30) default NULL,
  `tel_mobile` varchar(30) default NULL,
  `email` tinytext NOT NULL,
  `url_site` text,
  `profil` varchar(10) NOT NULL default '',
  `date_creation` date NOT NULL default '0000-00-00',
  `date_derniere_connexion` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `nombre_connexions` int(10) unsigned NOT NULL default '0',
  `mode_acces` tinyint(4) NOT NULL default '0',
  `date_debut_acces` date NOT NULL default '0000-00-00',
  `date_fin_acces` date NOT NULL default '0000-00-00',
  `login` varchar(100) NOT NULL default '',
  `mdp` varchar(100) NOT NULL default '',
  `img_accueil` varchar(250) default NULL,
  PRIMARY KEY  (`id_usager`),
  UNIQUE KEY `nom` (`nom`,`prenom`,`adresse`,`profil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=24183 ;

-- 
-- Contenu de la table `les_usagers`
-- 

INSERT INTO `les_usagers` VALUES (23157, 'Monsieur', 'admin', 'admin', '39 av de Chanzy''a', '', '', '', '', 'admin', 0x303030302d30302d3030, 0x323030362d30392d32352031333a34303a3331, 284, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'aadmin', 'CIROTEL', NULL);
INSERT INTO `les_usagers` VALUES (23161, 'Monsieur', 'BAINBRIDGE', 'Daniel', 'LE MOULIN A VENT\n\n53340   COSSE-EN-CHAMPAGNE', '02-43-67-83-32', '', '', '', 'app', 0x323030362d30352d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Daniel_BAINBRIDGE', 'YuYBGh', NULL);
INSERT INTO `les_usagers` VALUES (23165, 'Monsieur', 'BOUCONTET', 'Grégory', '11 rue des Bigottières\n\n72300   VION', '02-43-92-34-07', '', '', '', 'app', 0x323030362d30352d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Grégory_BOUCONTET', 'sqjzst', NULL);
INSERT INTO `les_usagers` VALUES (23168, 'Monsieur', 'CHAUDET', 'Fabien', 'Les Grillons\n\n53200   LOIGNE-SUR-MAYENNE', '02-43-70-31-70', '06-81-59-81-90', '', '', 'app', 0x323030362d30352d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Fabien_CHAUDET', 'HBVFF8', NULL);
INSERT INTO `les_usagers` VALUES (23171, 'Monsieur', 'DAVOUST', 'Johnny', '6 rue Beausoleil\n\n53440   LA CHAPELLE-AU-RIBOUL', '02-43-00-74-48', '', '', '', 'app', 0x323030362d30352d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Johnny_DAVOUST', 'rrfrS9', NULL);
INSERT INTO `les_usagers` VALUES (23174, 'Monsieur', 'GRANDJEAN', 'Jonathan', '10 Square Alexandre de Yougoslavie\n\n53100   MAYENNE', '', '', '', '', 'app', 0x323030362d30352d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Jonathan_GRANDJEAN', 'EyR2aF', NULL);
INSERT INTO `les_usagers` VALUES (23177, 'Monsieur', 'JORANT', 'Anthony', 'Le Haut Vissay\n\n53800   LA SELLE-CRAONNAISE', '02-43-06-84-79', '', '', '', 'app', 0x323030362d30352d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Anthony_JORANT', 'bmH5Cb', NULL);
INSERT INTO `les_usagers` VALUES (23180, 'Monsieur', 'LAM', 'Donat', '124 rue Nationale\n\n72000   LE MANS', '02-43-84-65-88', '', '', '', 'app', 0x323030362d30352d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Donat_LAM', '2Z7uEa', NULL);
INSERT INTO `les_usagers` VALUES (23183, 'Monsieur', 'LEPROVOST', 'Fabien', 'FOYER POURQUOI PAS\n3 BD ST NICOLAS\n72190   COULAINES', '02-43-76-21-48', '', '', '', 'app', 0x323030362d30352d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Fabien_LEPROVOST', 'MuePZX', NULL);
INSERT INTO `les_usagers` VALUES (23186, 'Monsieur', 'MONSIMER', 'JEAN-LOUP', 'LA ROUSSELIERE\n\n53170   LE BURET', '02-43-98-73-75', '', '', '', 'app', 0x323030362d30352d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JEAN-LOUP_MONSIMER', '8djZE5', NULL);
INSERT INTO `les_usagers` VALUES (23188, 'Monsieur', 'QUENTIN', 'Jérémy', 'La Grande Marre\n\n72140   ROUESSE-VASSE', '06-10-86-20-09', '', '', '', 'app', 0x323030362d30352d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Jérémy_QUENTIN', 'JaUuWu', NULL);
INSERT INTO `les_usagers` VALUES (23189, 'Madame', 'LOUVEL', 'Christelle', '129 bd de l''Europe\r\nBP 127\r\n53103 Mayenne Cedex', '02.43.0077.67', '', 'clouvel@cfa-apam.com', 'http://', 'rvs', 0x323030362d30352d3232, 0x323030362d30392d32352031313a35393a3039, 27, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CLOUVEL', '123456', NULL);
INSERT INTO `les_usagers` VALUES (23190, 'Madame', 'CHEVALIER', 'Béatrice', '1 rue Branly\r\nBP 408\r\n53204 Château Gontier Cedex', '', '', '', '', 'rvs', 0x323030362d30352d3232, 0x323030362d30392d31342031373a31323a3538, 22, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'BCHEVALIER', '123456', NULL);
INSERT INTO `les_usagers` VALUES (23191, 'Monsieur', 'KUNTZ', 'Pierre', '84 bd Volney \r\nBP 1537\r\n53015 Laval Cedex', '02 43 91 48 10', '', 'pkuntz.cfabat@caf-apam.com', 'http://', 'rvs', 0x323030362d30352d3232, 0x323030362d30392d31332031373a32373a3337, 84, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PKUNTZ', '123456', NULL);
INSERT INTO `les_usagers` VALUES (23192, 'Madame', 'LOTTIN', 'Nathalie', '39 av de Chanzy\r\nBP 1329\r\n53013 Laval Cedex', '02.43.59.03.60', '', 'lottinn@cfa-apam.com', 'http://', 'rvs', 0x323030362d30352d3232, 0x323030362d30392d32322031343a32363a3339, 28, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'NLOTTIN', 'loulou', NULL);
INSERT INTO `les_usagers` VALUES (23193, 'Monsieur', 'BOISBUNON', 'Paul', '39 av de Chanzy\r\nBP 1329\r\n53013 Laval Cedex', '', '', '', '', 'rvs', 0x323030362d30352d3232, 0x323030362d30372d30372030393a33383a3436, 6, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PBOISBUNON', '123456', NULL);
INSERT INTO `les_usagers` VALUES (23283, '', 'AGUIR', 'MICHELE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MICHELE_AGUIR', '8Z9Wmk', NULL);
INSERT INTO `les_usagers` VALUES (23284, 'Monsieur', 'AMIOT', 'Claude', 'CFA 3 Villes\r\nUNITE Bâtiment', '02-43-66-02-83', '', '', 'http://', 'ens', 0x323030362d30352d3232, 0x323030362d30392d30382031313a30333a3538, 16, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Claude_AMIOT', '123456', NULL);
INSERT INTO `les_usagers` VALUES (23285, '', 'ANGER', 'CELINE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CELINE_ANGER', 'F6P6rm', NULL);
INSERT INTO `les_usagers` VALUES (23286, 'Monsieur', 'ANGOT', 'FABIEN', 'x', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30392d30342031303a33363a3031, 1, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FABIEN_ANGOT', '8QEgsc', NULL);
INSERT INTO `les_usagers` VALUES (23287, 'Monsieur', 'AUDUSSEAU', 'Marc', 'CFA 3 Villes\r\nUNITE Bâtiment', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30362d30342031303a34333a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Marc_AUDUSSEAU', 'dZYsDA', NULL);
INSERT INTO `les_usagers` VALUES (23288, '', 'AUGER', 'VIRGINIE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'VIRGINIE_AUGER', 'SqjjMH', NULL);
INSERT INTO `les_usagers` VALUES (23289, 'Monsieur', 'BAUSSON', 'Renan', 'CFA 3 Villes\r\nUNITE Bâtiment', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30362d30342031303a34343a3234, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Renan_BAUSSON', 'keMPKC', NULL);
INSERT INTO `les_usagers` VALUES (23290, 'Monsieur', 'BELLANGER', 'Joël', 'CFA 3 Villes\r\nUNITE Bâtiment', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30362d30342031303a34373a3038, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Jo_l_BELLANGER', 'ZzWeXD', NULL);
INSERT INTO `les_usagers` VALUES (23291, 'Monsieur', 'BELLAY', 'Guillaume', 'LE BOIS DES HOMMES \n\n53400   CRAON', '06-83-56-56-87', '', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30392d32312031373a32323a3338, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GUILLAUME_BELLAY', 'Z2DPxt', NULL);
INSERT INTO `les_usagers` VALUES (23292, 'Monsieur', 'BENAIS', 'Christophe', 'CFA 3 Villes\r\nUNITE Bâtiment', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30362d30342031303a34363a3031, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Christophe_BENAIS', '5UQzYW', NULL);
INSERT INTO `les_usagers` VALUES (23293, '', 'BESSIERE', 'LAURENT', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'LAURENT_BESSIERE', 'DCupcU', NULL);
INSERT INTO `les_usagers` VALUES (23294, 'Madame', 'BLAIE', 'Emmanuelle', '\n\n', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30392d31332031333a33303a3434, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'EMMANUELLE_BLAIE', '76uGM4', NULL);
INSERT INTO `les_usagers` VALUES (23295, 'Monsieur', 'BLANCHOUIN', 'Guillaume', 'CFA 3 Villes\r\nUNITE Bâtiment', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30362d30342031303a34383a3531, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Guillaume_BLANCHOUIN', 'pR2kC6', NULL);
INSERT INTO `les_usagers` VALUES (23296, '', 'BLANDEAU', 'FLORIANE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FLORIANE_BLANDEAU', 'BQbMz5', NULL);
INSERT INTO `les_usagers` VALUES (23297, '', 'BLIN', 'DOMINIQUE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DOMINIQUE_BLIN', 'wwHrU5', NULL);
INSERT INTO `les_usagers` VALUES (23298, '', 'BODIN', 'JULIEN', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JULIEN_BODIN', 'y44PEh', NULL);
INSERT INTO `les_usagers` VALUES (23299, '', 'BONNET DE VILLER', 'FRANCOIS', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FRANCOIS_BONNET_DE_VILLER', 'zfwDnU', NULL);
INSERT INTO `les_usagers` VALUES (23300, '', 'BOULEN', 'MARYVONNE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MARYVONNE_BOULEN', 'mhdkUd', NULL);
INSERT INTO `les_usagers` VALUES (23301, '', 'BOURGEOIS', 'DOMINIQUE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DOMINIQUE_BOURGEOIS', 'wWhtp2', NULL);
INSERT INTO `les_usagers` VALUES (23302, '', 'BOUSSIQUOT', 'MARIE-DOMINIQUE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MARIE-DOMINIQUE_BOUSSIQUOT', '5wV8AS', NULL);
INSERT INTO `les_usagers` VALUES (23303, '', 'BOUTIER', 'JEAN-LOUIS', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JEAN-LOUIS_BOUTIER', 'JDY4gM', NULL);
INSERT INTO `les_usagers` VALUES (23304, 'Madame', 'BRISHOUAL', 'GWENAELLE', 'a', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30362d33302031363a33393a3238, 4, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GWENAELLE_BRISHOUAL', '123456', NULL);
INSERT INTO `les_usagers` VALUES (23305, '', 'BURON', 'BEATRICE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30372d31322031323a31393a3531, 23, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'BEATRICE_BURON', 'n4jUZY', NULL);
INSERT INTO `les_usagers` VALUES (23306, 'Mademoiselle', 'CAIGNON', 'Anne', 'CFA 3 Villes', '', '', '', 'http://', 'ens', 0x323030362d30352d3232, 0x323030362d30392d31332030383a34373a3436, 1, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Anne_CAIGNON', '123456', NULL);
INSERT INTO `les_usagers` VALUES (23307, 'Monsieur', 'CATROUILLET', 'Jacky', 'CFA 3 Villes\r\nUNITE Bâtiment', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30362d30342031303a35323a3034, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Jacky_CATROUILLET', 'yRUbx9', NULL);
INSERT INTO `les_usagers` VALUES (23308, '', 'CAUCANAS', 'CLAIRE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CLAIRE_CAUCANAS', '6QkfX7', NULL);
INSERT INTO `les_usagers` VALUES (23309, '', 'CERISIER', 'CHRISTOPHE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CHRISTOPHE_CERISIER', 'w9CfdT', NULL);
INSERT INTO `les_usagers` VALUES (23310, '', 'CHALAIN', 'VINCENT', '72 rue des oiseaux', '02.41.34.16.82', '06.63.18.36.59', 'v.chalain@voila.fr', 'http://', 'ens', 0x323030362d30352d3232, 0x323030362d30392d32332031353a33363a3338, 73, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'VINCENT_CHALAIN', 'LULU11', NULL);
INSERT INTO `les_usagers` VALUES (23311, 'Monsieur', 'CHAUVEL', 'Christian', 'CFA 3 Villes\r\nUNITE Bâtiment', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30362d30342031303a35333a3037, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Christian_CHAUVEL', 'GPmJYX', NULL);
INSERT INTO `les_usagers` VALUES (23312, 'Monsieur', 'CHEVALIER', 'Anthony', 'CFA 3 Villes\r\nUNITE Bâtiment', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30362d30342031303a35343a3335, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Anthony_CHEVALIER', '9uTBEv', NULL);
INSERT INTO `les_usagers` VALUES (23313, '', 'CHIEN CHOW CHINE', 'ANTONY', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ANTONY_CHIEN_CHOW_CHINE', 'hqNjCg', NULL);
INSERT INTO `les_usagers` VALUES (23314, 'Monsieur', 'CONTANT', 'Maxime', 'BEL AIR\n\n44170   NOZAY', '02-43-00-93-17', '', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30352d32322031353a32343a3331, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MAXIME_CONTANT', 'pUANzb', NULL);
INSERT INTO `les_usagers` VALUES (23315, 'Monsieur', 'CORNU', 'Nicolas', 'CFA 3 Villes\r\nUNITE Bâtiment', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30362d30342031303a35353a3336, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Nicolas_CORNU', 'WMyRAk', NULL);
INSERT INTO `les_usagers` VALUES (23316, '', 'COUSIN', 'GILLES', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GILLES_COUSIN', 'Yd67JG', NULL);
INSERT INTO `les_usagers` VALUES (23317, '', 'COUSIN', 'EMMANUEL', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'EMMANUEL_COUSIN', 'fnWsW7', NULL);
INSERT INTO `les_usagers` VALUES (23318, '', 'DABIN', 'SYLVIE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SYLVIE_DABIN', 'sx4wYU', NULL);
INSERT INTO `les_usagers` VALUES (23319, '', 'DAUPHIN', 'DIDIER', 'cfa''', '', '', '', 'http://', 'ens', 0x323030362d30352d3232, 0x323030362d30392d32322030393a34353a3437, 69, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DIDIER_DAUPHIN', 'pQsfAt', NULL);
INSERT INTO `les_usagers` VALUES (23320, 'Madame', 'DAVIERE', 'Danielle', 'CFA 3 Villes\r\nUNITE Bâtiment', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30362d30342031303a35363a3537, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Danielle_DAVIERE', 'ZzCqX3', NULL);
INSERT INTO `les_usagers` VALUES (23321, '', 'DE CHEFFONTAINES', 'YOLANDE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'YOLANDE_DE_CHEFFONTAINES', 'QZSRxW', NULL);
INSERT INTO `les_usagers` VALUES (23322, 'Monsieur', 'DELHOMMEAU''', 'GUILLAUME', '4, rue Denis Papin\r\n53600 Evron', '02.43.01.33.02', '06.84.19.69.68', 'guillaume.delhommeau@voila.fr', 'http://cfa3villes.com', 'ens', 0x323030362d30352d3232, 0x323030362d30392d32352030393a34373a3330, 117, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GUILLAUME_DELHOMMEAU', '181198', NULL);
INSERT INTO `les_usagers` VALUES (23323, '', 'DESLAIS', 'JULIEN', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JULIEN_DESLAIS', 'NwRzck', NULL);
INSERT INTO `les_usagers` VALUES (23324, 'Monsieur', 'DOSSET', 'Mathieu', 'CFA 3 Villes\r\nUNITE Bâtiment', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30362d30342031303a35383a3432, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Mathieu_DOSSET', 'j7sN6e', NULL);
INSERT INTO `les_usagers` VALUES (23326, '', 'DUBOIS', 'PASCAL', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30392d31342031323a32373a3431, 26, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PASCAL_DUBOIS', 'TGW3vg', NULL);
INSERT INTO `les_usagers` VALUES (23327, 'Monsieur', 'HAVY', 'Patrice', 'CFA 3 Villes\r\nUNITE Bâtiment', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30392d30382030393a35343a3337, 8, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Patrice_HAVY', 'MWNejV', NULL);
INSERT INTO `les_usagers` VALUES (23328, 'Mademoiselle', 'HERVE', 'Géraldine', 'CFA 3 Villes\r\nUNITE Bâtiment', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30362d30352032303a33393a3139, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'G_raldine_HERVE', 'ackQt4', NULL);
INSERT INTO `les_usagers` VALUES (23329, '', 'HEUZE', 'ALAIN', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ALAIN_HEUZE', '5AKe7v', NULL);
INSERT INTO `les_usagers` VALUES (23330, '', 'HUNEAU', 'ISABELLE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ISABELLE_HUNEAU', 'dN6det', NULL);
INSERT INTO `les_usagers` VALUES (23331, '', 'JAMMES', 'PIERRE-MARIE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PIERRE-MARIE_JAMMES', 'MmT66Z', NULL);
INSERT INTO `les_usagers` VALUES (23332, 'Monsieur', 'JAMOTEAU', 'Hugues', 'CFA 3 Villes\r\nUNITE Bâtiment', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30362d30352032303a34303a3132, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Hugues_JAMOTEAU', 'T2RBB4', NULL);
INSERT INTO `les_usagers` VALUES (23333, '', 'JEUDY', 'ANTHONY', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ANTHONY_JEUDY', 'gASUMz', NULL);
INSERT INTO `les_usagers` VALUES (23334, '', 'JOUSSET', 'JEAN YVES', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JEAN_YVES_JOUSSET', 'uwYXHB', NULL);
INSERT INTO `les_usagers` VALUES (23335, '', 'KOUMTANI', 'MOHAMED', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MOHAMED_KOUMTANI', 'qw5ub4', NULL);
INSERT INTO `les_usagers` VALUES (23336, '', 'LANGEARD', 'REMY', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'REMY_LANGEARD', 'MWYgn4', NULL);
INSERT INTO `les_usagers` VALUES (23337, '', 'LANGLAIS', 'NATHALIE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'NATHALIE_LANGLAIS', 'xFJG3k', NULL);
INSERT INTO `les_usagers` VALUES (23338, '', 'LAVENANT', 'JOCELYNE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JOCELYNE_LAVENANT', 'dpEcbd', NULL);
INSERT INTO `les_usagers` VALUES (23339, '', 'LE BORGNE', 'SAMUEL', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SAMUEL_LE_BORGNE', 'raq4RR', NULL);
INSERT INTO `les_usagers` VALUES (23340, 'Madame', 'LE BRIS', 'Catherine', 'CFA 3 Villes\r\nUNITE Bâtiment', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30362d30352032303a34313a3132, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Catherine_LE_BRIS', 'eGBz6F', NULL);
INSERT INTO `les_usagers` VALUES (23341, '', 'LE DILY', 'YVES-MARIE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'YVES-MARIE_LE_DILY', 'nz3pTN', NULL);
INSERT INTO `les_usagers` VALUES (23342, '', 'LE GOFF', 'PHILIPPE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PHILIPPE_LE_GOFF', 'uWgN7h', NULL);
INSERT INTO `les_usagers` VALUES (23343, '', 'LE SCORNET', 'CYRIL', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CYRIL_LE_SCORNET', 'tnUVzM', NULL);
INSERT INTO `les_usagers` VALUES (23344, '', 'LEMOINE', 'DELPHINE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DELPHINE_LEMOINE', 'HvSxtM', NULL);
INSERT INTO `les_usagers` VALUES (23345, '', 'LEPAGE', 'ANGELIQUE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ANGELIQUE_LEPAGE', 'U6StxD', NULL);
INSERT INTO `les_usagers` VALUES (23346, '', 'LEPECQ', 'MYRIAM', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MYRIAM_LEPECQ', 'MHcwjm', NULL);
INSERT INTO `les_usagers` VALUES (23347, '', 'LEVEQUE', 'LIONEL', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'LIONEL_LEVEQUE', 'zCjr9t', NULL);
INSERT INTO `les_usagers` VALUES (23348, '', 'LEVY', 'FABIENNE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FABIENNE_LEVY', '58FpCu', NULL);
INSERT INTO `les_usagers` VALUES (23349, '', 'LOUAISIL', 'MARYSE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30362d33302031363a31343a3036, 5, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MARYSE_LOUAISIL', '59w2kN', NULL);
INSERT INTO `les_usagers` VALUES (23350, '', 'LOUVIGNE', 'CHRISTIAN', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CHRISTIAN_LOUVIGNE', 'yaU99c', NULL);
INSERT INTO `les_usagers` VALUES (23351, 'Madame', 'MARSAT', 'Estelle', 'CFA 3 Villes', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30362d33302031363a31303a3239, 4, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Estelle_MARSAT', 'MSHd2B', NULL);
INSERT INTO `les_usagers` VALUES (23352, 'Monsieur', 'MASSON', 'Christian', 'CFA 3 Villes\r\nUNITE Bâtiment', '', '', '', 'http://', 'ens', 0x323030362d30352d3232, 0x323030362d30392d31332030383a34323a3238, 3, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Christian_MASSON', '123456', NULL);
INSERT INTO `les_usagers` VALUES (23353, '', 'MEZIERE', 'NATHALIE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'NATHALIE_MEZIERE', 'k28mFr', NULL);
INSERT INTO `les_usagers` VALUES (23354, '', 'MONTAROU', 'CYRILLE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CYRILLE_MONTAROU', 'Shtj9w', NULL);
INSERT INTO `les_usagers` VALUES (23355, 'Madame', 'MORILLON', 'Syvie', 'CFA 3 Villes', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30362d30352032303a34363a3337, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Syvie_MORILLON', 'Yuh5Vu', NULL);
INSERT INTO `les_usagers` VALUES (23356, '', 'MOYSAN', 'ELISABETH', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ELISABETH_MOYSAN', 'Y2BanF', NULL);
INSERT INTO `les_usagers` VALUES (23357, '', 'NOUET', 'PATRICE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PATRICE_NOUET', 'PquRbt', NULL);
INSERT INTO `les_usagers` VALUES (23358, 'Monsieur', 'PARMENTIER', 'Gérald', 'LA HAIRIE\n\n53440   GRAZAY', '02-43-04-58-31', '06-18-61-28-95', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30382d32352031353a31333a3539, 14, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GERALD_PARMENTIER', 'QxzgjR', NULL);
INSERT INTO `les_usagers` VALUES (23359, '', 'PEIGNE', 'DENISE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DENISE_PEIGNE', 'jmAS4G', NULL);
INSERT INTO `les_usagers` VALUES (23360, 'Madame', 'PETIT', 'Agnes', 'CFA 3 Villes\r\nUNITE Bâtiment', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30362d30352032303a34383a3038, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Agnes_PETIT', 'NScWjF', NULL);
INSERT INTO `les_usagers` VALUES (23361, '', 'PHILOUZE', 'MARIE-LAURE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MARIE-LAURE_PHILOUZE', '7ykUCf', NULL);
INSERT INTO `les_usagers` VALUES (23362, 'Monsieur', 'PIERRE', 'Patrice', 'LA FORGE\n\n53240   SAINT GERMAIN LE FOUILLOUX', '02-43-01-14-25', '', 'pierrep.besnie@free.fr', '', 'ens', 0x323030362d30352d3232, 0x323030362d30352d32322031353a32333a3237, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PATRICE_PIERRE', 'e8pgPW', NULL);
INSERT INTO `les_usagers` VALUES (23363, 'Monsieur', 'PINÇON', 'François', 'CFA 3 Villes', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30362d30352032303a34393a3530, 1, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'François_PIN_ON', '8wdGa5', NULL);
INSERT INTO `les_usagers` VALUES (23364, '', 'PINEAU', 'NAJIA', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'NAJIA_PINEAU', 'r36B4y', NULL);
INSERT INTO `les_usagers` VALUES (23365, 'Madame', 'PIRAULT', 'Reine', 'CFA 3 Villes\r\nUNITE Bâtiment', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30362d30352032303a35313a3032, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Reine_PIRAULT', '5sD3fX', NULL);
INSERT INTO `les_usagers` VALUES (23366, '', 'POUPARD', 'ELINA', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ELINA_POUPARD', 'dSbgJD', NULL);
INSERT INTO `les_usagers` VALUES (23367, '', 'PUECH DEJEAN', 'MAURICE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MAURICE_PUECH_DEJEAN', 'MaAhAn', NULL);
INSERT INTO `les_usagers` VALUES (23368, '', 'PUIZILLOUT', 'ANNE-MARIE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ANNE-MARIE_PUIZILLOUT', 'R54P4h', NULL);
INSERT INTO `les_usagers` VALUES (23369, '', 'QUEMENEUR', 'JEAN', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JEAN_QUEMENEUR', '7t3s3w', NULL);
INSERT INTO `les_usagers` VALUES (23370, 'Monsieur', 'RAHAL', 'Mohamed', 'CFA 3 Villes\r\nUNITE Bâtiment', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30362d30352032303a35323a3132, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Mohamed_RAHAL', 'krkbaD', NULL);
INSERT INTO `les_usagers` VALUES (23371, 'Monsieur', 'RENAUDIN', 'Laurent', 'CFA 3 Villes', '', '', 'l.renaudin.cfabat@cfa-apam.com', 'http://', 'ens', 0x323030362d30352d3232, 0x323030362d30392d32352030393a32363a3136, 97, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Laurent_RENAUDIN', '654321', NULL);
INSERT INTO `les_usagers` VALUES (23372, '', 'RIGOUIN', 'MARIE-CHRISTINE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MARIE-CHRISTINE_RIGOUIN', 'gQx9sb', NULL);
INSERT INTO `les_usagers` VALUES (23373, '', 'ROBERT', 'JEROME', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JEROME_ROBERT', 'CkwKCV', NULL);
INSERT INTO `les_usagers` VALUES (23374, '', 'ROCTON', 'INGRID', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30362d33302031363a30383a3232, 1, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'INGRID_ROCTON', 'qsfNCk', NULL);
INSERT INTO `les_usagers` VALUES (23375, '', 'ROEHRICH', 'PIERRE-HENRI', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30362d32392030393a34363a3130, 1, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PIERRE-HENRI_ROEHRICH', 'sSqujA', NULL);
INSERT INTO `les_usagers` VALUES (23376, 'Madame', 'SCHAETTEL', 'Marie', 'Enseignement Spécialisé\n\n', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30352d32322031343a31363a3035, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MARIE_SCHAETTEL', 'CZNtZr', NULL);
INSERT INTO `les_usagers` VALUES (23377, '', 'SERVEAU', 'ALICIA', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x323030362d30362d33302031363a30383a3039, 1, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ALICIA_SERVEAU', 'ykBvvV', NULL);
INSERT INTO `les_usagers` VALUES (23378, 'Monsieur', 'SOUHARD', 'Christian', 'CFA 3 Villes\r\nUNITE Bâtiment', '', '', '', 'http://', 'ens', 0x323030362d30352d3232, 0x323030362d30392d31332030383a35313a3337, 51, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Christian_SOUHARD', '123456', NULL);
INSERT INTO `les_usagers` VALUES (23379, '', 'THEZE', 'GUILLEMETTE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GUILLEMETTE_THEZE', 'erqB8Y', NULL);
INSERT INTO `les_usagers` VALUES (23380, '', 'THIAUDIERE', 'CHRISTINE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CHRISTINE_THIAUDIERE', 'Ye43r5', NULL);
INSERT INTO `les_usagers` VALUES (23381, '', 'TRAHAY', 'MARIE-THERESE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MARIE-THERESE_TRAHAY', 'c8dQeu', NULL);
INSERT INTO `les_usagers` VALUES (23382, '', 'TURCOT', 'ISABELLE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ISABELLE_TURCOT', '87kBSc', NULL);
INSERT INTO `les_usagers` VALUES (23383, '', 'VACHER', 'GISELA', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GISELA_VACHER', 'JJGNrA', NULL);
INSERT INTO `les_usagers` VALUES (23384, '', 'VEILLE', 'CAROLINE', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CAROLINE_VEILLE', 'FWrgVv', NULL);
INSERT INTO `les_usagers` VALUES (23385, '', 'ZOURAIR', 'KHALIL', '', '', '', '', '', 'ens', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'KHALIL_ZOURAIR', 'E5Egq3', NULL);
INSERT INTO `les_usagers` VALUES (23386, 'Monsieur', 'MARIEL', 'Marc', '168 rue de Bretagne\n\n53000   LAVAL', '02-43-69-07-81', '', '', '', 'ma', 0x323030362d30352d3232, 0x323030362d30372d31312031353a33343a3334, 2, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MMARIEL', 'MAhKCW', NULL);
INSERT INTO `les_usagers` VALUES (23387, 'Mademoiselle', 'CHAUVET', 'Sabrina', '1, Impasse des 3 Trompettes\n\n53000   LAVAL', '06-27-70-05-58', '', '', 'http://', 'app', 0x323030362d30352d3232, 0x323030362d30392d30312031373a30313a3537, 25, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SCHAUVET', 'sabrina', NULL);
INSERT INTO `les_usagers` VALUES (23388, 'Monsieur', 'LEVEQUE', 'Patrick', 'Etang de la Fenderie\n\n53150   DEUX EVAILLES', '02-43-90-00-95', '', 'la.fenderie@wanadoo.fr', '', 'ma', 0x323030362d30352d3232, 0x323030362d30392d31342031363a34343a3532, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PLEVEQUE', 'JUgggg', NULL);
INSERT INTO `les_usagers` VALUES (23389, 'Monsieur', 'GALLOU', 'Dominique', '14, Rue du Général de Gaulle\n\n53600   EVRON', '02-43-01-79-14', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DGALLOU', '7GqrK6', NULL);
INSERT INTO `les_usagers` VALUES (23390, 'Monsieur', 'GALLOU', 'Mathieu', '14, Rue du Général de Gaulle\n\n53600   EVRON', '02-43-01-79-14', '', '', '', 'app', 0x323030362d30352d3232, 0x323030362d30372d30372032313a31363a3539, 6, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MGALLOU', 'Dz64eU', NULL);
INSERT INTO `les_usagers` VALUES (23391, 'Monsieur', 'ETCHEVERRQ', 'David', 'Impasse du Vieux Bourg\n\n35760   SAINT-GREGOIRE', '02-99-68-79-35', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DETCHEVERRQ', '2Twq6r', NULL);
INSERT INTO `les_usagers` VALUES (23392, 'Monsieur', 'GASTON', '', '35, Boulevard Jean Mermoz\n\n35136   SAINT-JACQUES-DE-LA-LANDE', '06-71-48-32-39', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GASTON', 'YjtkCk', NULL);
INSERT INTO `les_usagers` VALUES (23393, 'Monsieur', 'GASTON', 'Sébastien', '35, Boulevard Jean Mermoz\n\n35136   SAINT-JACQUES-DE-LA-LANDE', '06-71-48-32-39', '', '', 'http://', 'app', 0x323030362d30352d3232, 0x323030362d30352d32342031313a33303a3232, 2, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SGASTON', 'YDWSEU', NULL);
INSERT INTO `les_usagers` VALUES (23394, 'Monsieur', 'VALSAINT', 'Jonathan', 'Fontaine Daniel\n\n53100   SAINT-GEORGES-BUTTAVENT', '02-43-00-34-85', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JVALSAINT', 'dvNcps', NULL);
INSERT INTO `les_usagers` VALUES (23395, 'Monsieur', 'LEPETIT', 'Yannick', '36 rue Saint Martin\n\n53100   MAYENNE', '02-43-32-12-05', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'YLEPETIT', 'w6RW33', NULL);
INSERT INTO `les_usagers` VALUES (23396, 'Monsieur', 'LEPETIT', 'Vincent', '36 rue Saint Martin\n\n53100   MAYENNE', '02-43-32-12-05', '', '', 'http://', 'app', 0x323030362d30352d3232, 0x323030362d30352d32342031313a33303a3038, 2, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'VLEPETIT', 'dounet', NULL);
INSERT INTO `les_usagers` VALUES (23397, 'Madame', 'CLAIR', 'Christelle', '16, Palce Albert Liebault\n\n72350   BRULON', '02-43-95-60-40', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CCLAIR', 'veuCAQ', NULL);
INSERT INTO `les_usagers` VALUES (23398, 'Mademoiselle', 'LUZU', 'Audrey', 'La Grande Maison\n\n72140   PARENNES', '02-43-29-57-40', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_ALUZU', 'Ppuzur', NULL);
INSERT INTO `les_usagers` VALUES (23399, 'Mademoiselle', 'LUZU', 'Audrey', 'La Grande Maison\n\n72140   PARENNES', '02-43-29-57-40', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ALUZU', 'Rybbgq', NULL);
INSERT INTO `les_usagers` VALUES (23400, 'Monsieur', 'GARREAU', 'PASCAL', '63 Grande Rue\n\n53000   LAVAL', '02-43-53-29-43', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PGARREAU', 'x6cD75', NULL);
INSERT INTO `les_usagers` VALUES (23401, 'Monsieur', 'MEIGRET', 'Jean-Luc', '44, Rue Victor\n\n53000   LAVAL', '06-15-60-83-75', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_JMEIGRET', 'Z5UHXn', NULL);
INSERT INTO `les_usagers` VALUES (23402, 'Monsieur', 'MEIGRET', 'Julien', '44, Rue Victor\n\n53000   LAVAL', '06-15-60-83-75', '', '', 'http://', 'app', 0x323030362d30352d3232, 0x323030362d30352d32342031313a33303a3130, 2, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JMEIGRET', 'MARSEILLE', NULL);
INSERT INTO `les_usagers` VALUES (23403, 'Madame', 'PLOT', 'Céline', '67 rue du Val de Mayenne\n\n53000   LAVAL', '02-43-56-98-29', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CPLOT', 'HPMj9d', NULL);
INSERT INTO `les_usagers` VALUES (23404, 'Monsieur', 'RACINEUX', 'Fernand', '2, Allée de la Vaige\n\n53170   MESLAY DU MAINE', '02-43-98-74-27', '06-86-35-12-47', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FRACINEUX', 'f4paVC', NULL);
INSERT INTO `les_usagers` VALUES (23405, 'Monsieur', 'RACINEUX', 'Aurélien', '2, Allée de la Vaige\n\n53170   MESLAY DU MAINE', '02-43-98-74-27', '06-86-35-12-47', '', 'http://', 'app', 0x323030362d30352d3232, 0x323030362d30352d32342031313a33373a3532, 3, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ARACINEUX', 'aurelien', NULL);
INSERT INTO `les_usagers` VALUES (23406, 'Monsieur', 'TEREAU', '', 'La Petite Aufrière\n\n53170   BAZOUGERS', '02-43-02-33-10', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'TEREAU', '22cKMH', NULL);
INSERT INTO `les_usagers` VALUES (23407, 'Monsieur', 'TEREAU', 'Fabien', 'La Petite Aufrière\n\n53170   BAZOUGERS', '02-43-02-33-10', '', '', 'http://', 'app', 0x323030362d30352d3232, 0x323030362d30352d32342031333a31373a3139, 3, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FTEREAU', 'FABIEN', NULL);
INSERT INTO `les_usagers` VALUES (23408, 'Monsieur', 'TOUILLER', 'Thierry', '66, Rue Vaufleury\n\n53000   LAVAL', '02-43-66-02-02', '', '', '', 'ma', 0x323030362d30352d3232, 0x323030362d30392d31342031363a34343a3530, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'TTOUILLER', 'kaGDVc', NULL);
INSERT INTO `les_usagers` VALUES (23409, 'Monsieur', 'BARILLER', 'Roger', '19, Avenue Robert Buron\n\n53000   LAVAL', '02-43-02-19-95', '06-64-72-36-95', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'RBARILLER', 'D2QK9B', NULL);
INSERT INTO `les_usagers` VALUES (23410, 'Monsieur', 'BARILLER', 'Alexandre', '19, Avenue Robert Buron\n\n53000   LAVAL', '02-43-02-19-95', '06-64-72-36-95', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ABARILLER', 'gZWZjQ', NULL);
INSERT INTO `les_usagers` VALUES (23411, 'Monsieur', 'JOUANEN', 'ERIC', '83 rue Victor Boissel\n\n53000   LAVAL', '02-43-53-14-10', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'EJOUANEN', 'X6U6f7', NULL);
INSERT INTO `les_usagers` VALUES (23412, 'Monsieur', 'CROM', 'Francis', '2, Rue du Pin\n\n53240   ST GERMAIN LE GUILLAUME', '02-43-02-68-46', '06-99-37-27-28', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FCROM', '2FsanW', NULL);
INSERT INTO `les_usagers` VALUES (23413, 'Monsieur', 'CROM', 'Yoann', '2, Rue du Pin\n\n53240   ST GERMAIN LE GUILLAUME', '02-43-02-68-46', '06-99-37-27-28', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'YCROM', 'Tu4dD8', NULL);
INSERT INTO `les_usagers` VALUES (23414, 'Monsieur', 'PHILOUZE', 'SEBASTIEN', 'le Bourg\n\n53340   SAULGES', '02-43-64-66-00', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SPHILOUZE', 'mm3u5B', NULL);
INSERT INTO `les_usagers` VALUES (23415, 'Monsieur', 'FLEURY', 'Alfred', '15, Point du Jour\n\n53220   MONTAUDIN', '02-43-05-64-69', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'AFLEURY', 'UVyc6v', NULL);
INSERT INTO `les_usagers` VALUES (23416, 'Monsieur', 'FLEURY', 'Dany', '15, Point du Jour\n\n53220   MONTAUDIN', '02-43-05-64-69', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DFLEURY', 'HSH23G', NULL);
INSERT INTO `les_usagers` VALUES (23417, 'Monsieur', 'FAVREL', 'Ludovic', '16, Place Dom Guéranger\n\n72300   SOLESMES', '02-43-95-45-10', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'LFAVREL', 'gXbcdm', NULL);
INSERT INTO `les_usagers` VALUES (23418, 'Monsieur', 'FOUSSIER', 'Eric', '3, Allée des Acacias\n\n72300   SABLE-SUR-SARTHE', '02-43-92-20-97', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_EFOUSSIER', 'UHD3mq', NULL);
INSERT INTO `les_usagers` VALUES (23419, 'Monsieur', 'FOUSSIER', 'Eric', '3, Allée des Acacias\n\n72300   SABLE-SUR-SARTHE', '02-43-92-20-97', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'EFOUSSIER', 'ma2ZWH', NULL);
INSERT INTO `les_usagers` VALUES (23420, 'Monsieur', 'TERRIER', 'ERIC', 'le Bourg\n\n53340   SAULGES', '02-43-64-66-00', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ETERRIER', 'Sd66uz', NULL);
INSERT INTO `les_usagers` VALUES (23421, 'Monsieur', 'GUYARD', 'Jacky', '13, Rue Principale\n\n72540   MAREIL-EN-CHAMPAGNE', '02-43-21-61-94', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JGUYARD', 'q3kRmF', NULL);
INSERT INTO `les_usagers` VALUES (23422, 'Monsieur', 'GUYARD', 'Sébastien', '13, Rue Principale\n\n72540   MAREIL-EN-CHAMPAGNE', '02-43-21-61-94', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SGUYARD', 'GcP7MM', NULL);
INSERT INTO `les_usagers` VALUES (23423, 'Monsieur', 'HAUTBOIS', 'Marc', 'Le Petit Rome\n\n53400   CRAON', '02-43-06-38-72', '06-76-00-16-79', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MHAUTBOIS', 'KscMNP', NULL);
INSERT INTO `les_usagers` VALUES (23424, 'Monsieur', 'HAUTBOIS', 'Arnaud', 'Le Petit Rome\n\n53400   CRAON', '02-43-06-38-72', '06-76-00-16-79', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'AHAUTBOIS', 'MgQVmX', NULL);
INSERT INTO `les_usagers` VALUES (23425, 'Monsieur', 'TESTARD', 'Francis', '23, Quai Sadi Carnot\n\n53000   LAVAL', '02-43-53-55-66', '', '', '', 'ma', 0x323030362d30352d3232, 0x323030362d30392d31342031363a34343a3532, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FTESTARD', 'pKTr3T', NULL);
INSERT INTO `les_usagers` VALUES (23426, 'Monsieur', 'KERVRAN', 'André', '51, rue des Closeaux\n\n53240   ST JEAN S/MAYENNE', '02-43-01-18-15', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'AKERVRAN', 'sUMD74', NULL);
INSERT INTO `les_usagers` VALUES (23427, 'Monsieur', 'KERVRAN', 'Laurent', '51, rue des Closeaux\n\n53240   ST JEAN S/MAYENNE', '02-43-01-18-15', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'LKERVRAN', 'Ztby8t', NULL);
INSERT INTO `les_usagers` VALUES (23428, 'Monsieur', 'QUEGUINEUR', 'GERARD', '2 rue A. de Loré\n\n53100   MAYENNE', '02-43-00-96-00', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GQUEGUINEUR', 'EQJNyM', NULL);
INSERT INTO `les_usagers` VALUES (23429, 'Madame', 'LAIR', '', 'Colmont\n\n53300   OISSEAU', '02-43-04-38-87', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'LAIR', 'ydZQZR', NULL);
INSERT INTO `les_usagers` VALUES (23430, 'Mademoiselle', 'LAIR', 'Amélie', 'Colmont\n\n53300   OISSEAU', '02-43-04-38-87', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ALAIR', 'w6MBrk', NULL);
INSERT INTO `les_usagers` VALUES (23431, 'Monsieur', 'BEUNET', 'Arnaud', '7 rue du Lieutenant\n\n53000   LAVAL', '02-43-56-25-77', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ABEUNET', 'UMUV2N', NULL);
INSERT INTO `les_usagers` VALUES (23432, 'Monsieur', 'PHILIPPE', '', '12, Bis Rue Echelle Marteau\n\n53000   LAVAL', '02-43-67-15-95', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PHILIPPE', 'pBsPSa', NULL);
INSERT INTO `les_usagers` VALUES (23433, 'Monsieur', 'PHILIPPE', 'Anthony', '12, Bis Rue Echelle Marteau\n\n53000   LAVAL', '02-43-67-15-95', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'APHILIPPE', 'ubnMcC', NULL);
INSERT INTO `les_usagers` VALUES (23434, 'Mademoiselle', 'ZABBERONI', 'Angélique', 'Pendu\n\n53200   ST FORT', '02-43-70-15-44', '', '', '', 'ma', 0x323030362d30352d3232, 0x323030362d30382d32352031353a31323a3238, 2, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'AZABBERONI', 'AZABBERONI', NULL);
INSERT INTO `les_usagers` VALUES (23437, 'Madame', 'MARIEL', 'Martine', '168 rue de Bretagne\n\n53000   LAVAL', '02-43-69-07-81', '', '', '', 'ma', 0x323030362d30352d3232, 0x323030362d30382d32352031353a30383a3238, 1, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MMARIEL', 'MMARIEL', NULL);
INSERT INTO `les_usagers` VALUES (23442, 'Madame', 'BOULAND', 'Stéphanie', '18 RN\n\n37210   VOUVRAY', '02-47-52-70-18', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SBOULAND', 'SBOULAND', NULL);
INSERT INTO `les_usagers` VALUES (23445, 'Monsieur', 'LEMERCIER', 'Guy', '67, Rue du Val de Mayenne\n\n53000   LAVAL', '02-43-56-98-29', '', 'bistro.paris@wanadoo.fr', '', 'ma', 0x323030362d30352d3232, 0x323030362d30392d31342031363a34343a3531, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GLEMERCIER', 'GLEMERCIER', NULL);
INSERT INTO `les_usagers` VALUES (23446, 'Monsieur', 'BOUTIER', 'Michel', '3, Rue Alain Gerbault\n\n53200   CHATEAU-GONTIER', '02-43-70-33-78', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MBOUTIER', 'MBOUTIER', NULL);
INSERT INTO `les_usagers` VALUES (23447, 'Mademoiselle', 'BOUTIER', 'Eloïse', '3, Rue Alain Gerbault\n\n53200   CHATEAU-GONTIER', '02-43-70-33-78', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'EBOUTIER', 'EBOUTIER', NULL);
INSERT INTO `les_usagers` VALUES (23448, 'Madame', 'OGER', 'MARIE JOSE', 'Rue du Fief des Moines\n\n53480   VAIGES', '02-43-90-50-07', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MJOGER', 'MJOGER', NULL);
INSERT INTO `les_usagers` VALUES (23449, 'Monsieur', 'CHEVREUIL', 'Eric', '10, Lot de la Nayère\n\n53340   BALLEE', '02-43-69-19-61', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ECHEVREUIL', 'ECHEVREUIL', NULL);
INSERT INTO `les_usagers` VALUES (23450, 'Mademoiselle', 'CHEVREUIL', 'Céline', '10, Lot de la Nayère\n\n53340   BALLEE', '02-43-69-19-61', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CCHEVREUIL', 'CCHEVREUIL', NULL);
INSERT INTO `les_usagers` VALUES (23451, 'Madame', 'PARIS', 'JANINE', 'Route de Mayenne\n\n53600   EVRON', '02-43-91-20-00', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JPARIS', 'JPARIS', NULL);
INSERT INTO `les_usagers` VALUES (23452, 'Monsieur', 'LE DUFF', 'Jean-Luc', '70 bld de la grande Valaisière\n\n53600   EVRON', '06-60-06-32-24', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JLDUFF', 'JLDUFF', NULL);
INSERT INTO `les_usagers` VALUES (23453, 'Monsieur', 'LE DUFF', 'Valentin', '70 bld de la grande Valaisière\n\n53600   EVRON', '06-60-06-32-24', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'VLDUFF', 'VLDUFF', NULL);
INSERT INTO `les_usagers` VALUES (23454, 'Madame', 'MOREL', 'Marie-Christine', '66, Rue Vaufleury\n\n53000   LAVAL', '02-43-66-02-02', '', '', '', 'ma', 0x323030362d30352d3232, 0x323030362d30392d31342031363a34383a3531, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MMOREL', 'MMOREL', NULL);
INSERT INTO `les_usagers` VALUES (23455, 'Madame', 'SAMSON', '', '5 av Maréchal leclerc\n\n53000   LAVAL', '02-43-56-54-83', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SAMSON', 'SAMSON', NULL);
INSERT INTO `les_usagers` VALUES (23456, 'Monsieur', 'SAMSON', 'Christopher', '5 av Maréchal leclerc\n\n53000   LAVAL', '02-43-56-54-83', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CSAMSON', 'CSAMSON', NULL);
INSERT INTO `les_usagers` VALUES (23457, 'Madame', 'TESTARD', 'Fabienne', '23 quai Sadi Carnot\n\n53000   LAVAL', '02-43-53-55-66', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FTESTARD', 'FTESTARD', NULL);
INSERT INTO `les_usagers` VALUES (23458, 'Monsieur', 'THEREAU', 'Christian', 'La Basse Daligaudais\n\n53380   JUVIGNE', '02-43-68-57-87', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CTHEREAU', 'CTHEREAU', NULL);
INSERT INTO `les_usagers` VALUES (23459, 'Mademoiselle', 'THEREAU', 'Gwladys', 'La Basse Daligaudais\n\n53380   JUVIGNE', '02-43-68-57-87', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GTHEREAU', 'GTHEREAU', NULL);
INSERT INTO `les_usagers` VALUES (23460, 'Monsieur', 'LE GODAIS', 'Franck', '4, Place de Hercé\n\n53100   MAYENNE', '02-43-04-22-89', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FLGODAIS', 'FLGODAIS', NULL);
INSERT INTO `les_usagers` VALUES (23461, 'Monsieur', 'GOUADON', 'Daniel', '15, Rue du Neufbourg\n\n53220   LARCHAMP', '02-43-05-34-14', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DGOUADON', 'DGOUADON', NULL);
INSERT INTO `les_usagers` VALUES (23462, 'Monsieur', 'GOUADON', 'Jérémy', '15, Rue du Neufbourg\n\n53220   LARCHAMP', '02-43-05-34-14', '', '', '', 'app', 0x323030362d30352d3232, 0x323030362d30392d30352031323a33353a3239, 3, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JGOUADON', 'JGOUADON', NULL);
INSERT INTO `les_usagers` VALUES (23463, 'Monsieur', 'LE GALL', 'Sébastien', '4, Rue du Maine\n\n53410   BOURGON', '02-43-37-71-79', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SLGALL', 'SLGALL', NULL);
INSERT INTO `les_usagers` VALUES (23464, 'Monsieur', 'GRANGER', 'Antoine', '6, Rue Babin\n\n35500   SAINT-M HERVE', '02-99-76-71-82', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_AGRANGER', 'AGRANGER', NULL);
INSERT INTO `les_usagers` VALUES (23465, 'Monsieur', 'GRANGER', 'Antoine', '6, Rue Babin\n\n35500   SAINT-M HERVE', '02-99-76-71-82', '', '', '', 'app', 0x323030362d30352d3232, 0x323030362d30362d33302031313a34333a3237, 5, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'AGRANGER', 'AGRANGER', NULL);
INSERT INTO `les_usagers` VALUES (23466, 'Monsieur', 'HUGER', 'JEAN-CLAUDE', '27 rue St Martin\n\n53100   MAYENNE', '02-43-04-13-43', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JHUGER', 'JHUGER', NULL);
INSERT INTO `les_usagers` VALUES (23467, 'Monsieur', 'GUERIN', 'Didier', 'La Triconnière\n\n53100   CHATILLON-SUR-COLMONT', '02-43-00-23-96', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DGUERIN', 'DGUERIN', NULL);
INSERT INTO `les_usagers` VALUES (23468, 'Monsieur', 'GUERIN', 'Hermann', 'La Triconnière\n\n53100   CHATILLON-SUR-COLMONT', '02-43-00-23-96', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'HGUERIN', 'HGUERIN', NULL);
INSERT INTO `les_usagers` VALUES (23469, 'Monsieur', 'RAMAUGE', 'Cyrille', '15, Rue Thiers\n\n53200   CHATEAU GONTIER', '02-43-07-22-75', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CRAMAUGE', 'CRAMAUGE', NULL);
INSERT INTO `les_usagers` VALUES (23470, 'Madame', 'MARCHAND', 'Sylvie', '13, Rue Saint-Martin\n\n53200   MENIL', '02-43-70-34-39', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SMARCHAND', 'SMARCHAND', NULL);
INSERT INTO `les_usagers` VALUES (23471, 'Monsieur', 'MARCHAND', 'Damien', '13, Rue Saint-Martin\n\n53200   MENIL', '02-43-70-34-39', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DMARCHAND', 'DMARCHAND', NULL);
INSERT INTO `les_usagers` VALUES (23472, 'Monsieur', 'MOREAU', 'Daniel', '19, Rue des Primevères\n\n53970   MONTIGNE-LE-BRILLANT', '02-43-98-02-67', '06-15-37-21-70', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DMOREAU', 'DMOREAU', NULL);
INSERT INTO `les_usagers` VALUES (23473, 'Monsieur', 'MOREAU', 'François', '19, Rue des Primevères\n\n53970   MONTIGNE-LE-BRILLANT', '02-43-98-02-67', '06-15-37-21-70', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FMOREAU', 'FMOREAU', NULL);
INSERT INTO `les_usagers` VALUES (23474, 'Monsieur', 'DERVAL', 'MOISE', '24 avenue de Chanzy\n\n53000   LAVAL', '02-43-53-20-98', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MDERVAL', 'MDERVAL', NULL);
INSERT INTO `les_usagers` VALUES (23475, 'Monsieur', 'OUTIN', 'Roland', 'Mle Outin Tiphaine\n\n53000   LAVAL', '', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ROUTIN', 'ROUTIN', NULL);
INSERT INTO `les_usagers` VALUES (23476, 'Mademoiselle', 'OUTIN', 'Tiphaine', 'LA Bougrièvre\n\n53960   BONCHAMP LES L', '02-43-90-97-97', '', 'famille-outin@wanadoo.fr', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'TOUTIN', 'TOUTIN', NULL);
INSERT INTO `les_usagers` VALUES (23477, 'Monsieur', 'DOUAY', 'PIERRE', '13, Rue Division Leclerc\n\n53200   CHATEAU-GONTIER', '02-43-07-27-07', '', '', '', 'ma', 0x323030362d30352d3232, 0x323030362d30392d31392031343a35323a3334, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PDOUAY', 'PDOUAY', NULL);
INSERT INTO `les_usagers` VALUES (23478, 'Madame', 'PANNIER', 'Martine', '7, Rue des Grives\n\n53200   AZE', '02-43-07-14-66', '06-75-41-64-45', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MPANNIER', 'MPANNIER', NULL);
INSERT INTO `les_usagers` VALUES (23479, 'Monsieur', 'PANNIER', 'Aurélien', '7, Rue des Grives\n\n53200   AZE', '02-43-07-14-66', '06-75-41-64-45', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'APANNIER', 'APANNIER', NULL);
INSERT INTO `les_usagers` VALUES (23480, 'Monsieur', 'LUCAS', 'MICHEL', '26 place Renault Morlière\n\n53500   ERNEE', '02-43-05-12-68', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MLUCAS', 'MLUCAS', NULL);
INSERT INTO `les_usagers` VALUES (23481, 'Monsieur', 'TOURNERIE', 'Pierre', '16, Rue des Hortensias\n\n53500   ERNEE', '02-43-05-65-58', '06-73-66-54-44', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PTOURNERIE', 'PTOURNERIE', NULL);
INSERT INTO `les_usagers` VALUES (23482, 'Monsieur', 'TOURNERIE', 'Morgan', '16, Rue des Hortensias\n\n53500   ERNEE', '02-43-05-65-58', '06-73-66-54-44', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MTOURNERIE', 'MTOURNERIE', NULL);
INSERT INTO `les_usagers` VALUES (23483, 'Monsieur', 'VIVIER', 'Marie-Anne', '4, Résidence de la Filousière\n\n53100   MAYENNE', '02-43-04-82-13', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MVIVIER', 'MVIVIER', NULL);
INSERT INTO `les_usagers` VALUES (23484, 'Monsieur', 'VIVIER', 'Cédric', '4, Résidence de la Filousière\n\n53100   MAYENNE', '02-43-04-82-13', '', '', '', 'app', 0x323030362d30352d3232, 0x323030362d30392d31342031313a33363a3139, 1, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CVIVIER', 'CVIVIER', NULL);
INSERT INTO `les_usagers` VALUES (23485, 'Monsieur', 'VERDIER', 'JACKY', '11 rue Charles de Gaulle\n\n53810   CHANGE', '02-43-53-38-57', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JVERDIER', 'JVERDIER', NULL);
INSERT INTO `les_usagers` VALUES (23486, 'Monsieur', 'GARROT', 'Michel', 'Les Pommiers\n\n53320   LOIRON', '02-43-02-47-46', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MGARROT', 'MGARROT', NULL);
INSERT INTO `les_usagers` VALUES (23487, 'Monsieur', 'GARROT', 'Vincent', 'Les Pommiers\n\n53320   LOIRON', '02-43-02-47-46', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'VGARROT', 'VGARROT', NULL);
INSERT INTO `les_usagers` VALUES (23488, 'Monsieur', 'POUSSIER', 'Bruno', 'Route de Laval\n\n53600   EVRON', '02-43-01-34-82', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'BPOUSSIER', 'BPOUSSIER', NULL);
INSERT INTO `les_usagers` VALUES (23489, 'Mademoiselle', 'HOUSSAIS', 'Audrey', '6, La Haute Harie\n\n44540   SAINT-MARS-LA-JAILLE', '06-23-28-47-53', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_AHOUSSAIS', 'AHOUSSAIS', NULL);
INSERT INTO `les_usagers` VALUES (23490, 'Mademoiselle', 'HOUSSAIS', 'Audrey', '6, La Haute Harie\n\n44540   SAINT-MARS-LA-JAILLE', '06-23-28-47-53', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'AHOUSSAIS', 'AHOUSSAIS', NULL);
INSERT INTO `les_usagers` VALUES (23491, 'Monsieur', 'DUGUET', 'JACQUES', '17 rue Charles Landelle\n\n53000   LAVAL', '02-43-53-28-39', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JDUGUET', 'JDUGUET', NULL);
INSERT INTO `les_usagers` VALUES (23492, 'Monsieur', 'JOHAN', 'Philippe', '11, Allée des Trois Frères Gruau\n\n53000   LAVAL', '02-43-02-41-13', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PJOHAN', 'PJOHAN', NULL);
INSERT INTO `les_usagers` VALUES (23493, 'Monsieur', 'JOHAN', 'David', '11, Allée des Trois Frères Gruau\n\n53000   LAVAL', '02-43-02-41-13', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DJOHAN', 'DJOHAN', NULL);
INSERT INTO `les_usagers` VALUES (23494, 'Monsieur', 'MESLIER', 'OLIVIER', '7 Rue de Paris\n\n35500   VITRE', '02-99-75-33-52', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'OMESLIER', 'OMESLIER', NULL);
INSERT INTO `les_usagers` VALUES (23495, 'Monsieur', 'LE BOLLOCH', 'Ludovic', '13, Rue Pasteur\n\n35500   VITRE', '06-09-22-49-07', '02-99-49-36-03', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_LLBOLLOCH', 'LLBOLLOCH', NULL);
INSERT INTO `les_usagers` VALUES (23496, 'Monsieur', 'LE BOLLOCH', 'Ludovic', '13, Rue Pasteur\n\n35500   VITRE', '06-09-22-49-07', '02-99-49-36-03', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'LLBOLLOCH', 'LLBOLLOCH', NULL);
INSERT INTO `les_usagers` VALUES (23497, 'Monsieur', 'GASSE', 'Philippe', '2 rue de la Perrière\n\n53600   EVRON', '02-43-01-60-41', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PGASSE', 'PGASSE', NULL);
INSERT INTO `les_usagers` VALUES (23498, 'Monsieur', 'LETOURNEUR', 'Didier', '86, Rue Sainte-Suzanne\n\n53600   EVRON', '06-03-84-96-22', '02-43-07-81-14', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DLETOURNEUR', 'DLETOURNEUR', NULL);
INSERT INTO `les_usagers` VALUES (23499, 'Mademoiselle', 'LETOURNEUR', 'Emilie', '86, Rue Sainte-Suzanne\n\n53600   EVRON', '06-03-84-96-22', '02-43-07-81-14', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ELETOURNEUR', 'ELETOURNEUR', NULL);
INSERT INTO `les_usagers` VALUES (23500, 'Monsieur', 'BADIN', 'Laurent', '13, Rue de Bouchevreau\n\n53300   AMBRIERES-LES-VALLEES', '02-43-04-92-84', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'LBADIN', 'LBADIN', NULL);
INSERT INTO `les_usagers` VALUES (23501, 'Monsieur', 'MEZIERE', 'Gilbert', 'La Brancherie\n\n53300   AMBRIERES-LES-VALLEES', '02-43-04-94-78', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_GMEZIERE', 'GMEZIERE', NULL);
INSERT INTO `les_usagers` VALUES (23502, 'Monsieur', 'MEZIERE', 'Grégory', 'La Brancherie\n\n53300   AMBRIERES-LES-VALLEES', '02-43-04-94-78', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GMEZIERE', 'GMEZIERE', NULL);
INSERT INTO `les_usagers` VALUES (23503, 'Monsieur', 'PINEAU', 'Yvan', '47, Avenue Aristide Briand\n\n53200   CHATEAU-GONTIER', '02-43-06-04-91', '06-74-75-19-07', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'YPINEAU', 'YPINEAU', NULL);
INSERT INTO `les_usagers` VALUES (23504, 'Monsieur', 'PINEAU', 'Stéphane', '47, Avenue Aristide Briand\n\n53200   CHATEAU-GONTIER', '02-43-06-04-91', '06-74-75-19-07', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SPINEAU', 'SPINEAU', NULL);
INSERT INTO `les_usagers` VALUES (23505, 'Monsieur', 'BOUVERET', 'Jean-Philippe', '2, Rue de la Montée\n\n53120   GORRON', '02-43-08-64-81', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JBOUVERET', 'JBOUVERET', NULL);
INSERT INTO `les_usagers` VALUES (23506, 'Mademoiselle', 'BLAIS', 'Julie', '3, Rue du Pré\n\n53120   GORRON', '06-89-32-89-92', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_JBLAIS', 'JBLAIS', NULL);
INSERT INTO `les_usagers` VALUES (23507, 'Mademoiselle', 'BLAIS', 'Julie', '3, Rue du Pré\n\n53120   GORRON', '06-89-32-89-92', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JBLAIS', 'JBLAIS', NULL);
INSERT INTO `les_usagers` VALUES (23508, 'Monsieur', 'BERTHE', 'CHRISTIAN', 'Place de la Poste\n\n53940   LE GENEST ST ISLE', '02-43-02-11-61', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CBERTHE', 'CBERTHE', NULL);
INSERT INTO `les_usagers` VALUES (23509, 'Monsieur', 'CHARON', 'Raymond', '1, Rue des Jasmins\n\n53240   LA BACONNIERE', '02-43-02-64-29', '06-79-60-71-21', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'RCHARON', 'RCHARON', NULL);
INSERT INTO `les_usagers` VALUES (23510, 'Monsieur', 'CHARON', 'Emmanuel', '1, Rue des Jasmins\n\n53240   LA BACONNIERE', '02-43-02-64-29', '06-79-60-71-21', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ECHARON', 'ECHARON', NULL);
INSERT INTO `les_usagers` VALUES (23511, 'Monsieur', 'BOUILLE', 'REGIS', '5, Rue des Déportés\n\n53000   LAVAL', '02-43-53-20-29', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'RBOUILLE', 'RBOUILLE', NULL);
INSERT INTO `les_usagers` VALUES (23512, 'Monsieur', 'GOUGEON', 'Joël', '37, Rue Berthe Marcou\n\n53810   CHANGE', '02-43-53-74-81', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_JGOUGEON', 'JGOUGEON', NULL);
INSERT INTO `les_usagers` VALUES (23513, 'Monsieur', 'GOUGEON', 'Jérémy', '37, Rue Berthe Marcou\n\n53810   CHANGE', '02-43-53-74-81', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JGOUGEON', 'JGOUGEON', NULL);
INSERT INTO `les_usagers` VALUES (23514, 'Monsieur', 'GUIBERT', 'Jérôme', '8, Rue des Forges\n\n53410   PORT-BRILLET', '02-43-68-83-71', '', '', '', 'ma', 0x323030362d30352d3232, 0x323030362d30392d31342031373a32333a3235, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JGUIBERT', 'JGUIBERT', NULL);
INSERT INTO `les_usagers` VALUES (23515, 'Monsieur', 'JULIEN', 'Ivan', 'La Croix au Vanneur\n\n53410   LA BRULATTE', '02-43-02-00-58', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_IJULIEN', 'IJULIEN', NULL);
INSERT INTO `les_usagers` VALUES (23516, 'Monsieur', 'JULIEN', 'Ivan', 'La Croix au Vanneur\n\n53410   LA BRULATTE', '02-43-02-00-58', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'IJULIEN', 'IJULIEN', NULL);
INSERT INTO `les_usagers` VALUES (23517, 'Monsieur', 'BRIHAULT', 'Christian', '6, Rue Amiral Courbet\n\n53500   ERNEE', '02-43-05-23-37', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CBRIHAULT', 'CBRIHAULT', NULL);
INSERT INTO `les_usagers` VALUES (23518, 'Monsieur', 'LABBE', 'Willy', '11, Rue LOUIS pasteur\n\n53120   GORRON', '02-43-08-48-67', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_WLABBE', 'WLABBE', NULL);
INSERT INTO `les_usagers` VALUES (23519, 'Monsieur', 'LABBE', 'Willy', '11, Rue LOUIS pasteur\n\n53120   GORRON', '02-43-08-48-67', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'WLABBE', 'WLABBE', NULL);
INSERT INTO `les_usagers` VALUES (23520, 'Monsieur', 'RICOU', 'Jean-Michel', '6 bld Victor Hugo\n\n53200   CHATEAU GONTIER', '02-43-70-46-29', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JRICOU', 'JRICOU', NULL);
INSERT INTO `les_usagers` VALUES (23521, 'Monsieur', 'LAUTRU', 'Lucien', '11, Rue des Erables\n\n53200   SAINT-FORT', '02-43-07-21-49', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'LLAUTRU', 'LLAUTRU', NULL);
INSERT INTO `les_usagers` VALUES (23522, 'Monsieur', 'LAUTRU', 'Damien', '11, Rue des Erables\n\n53200   SAINT-FORT', '02-43-07-21-49', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DLAUTRU', 'DLAUTRU', NULL);
INSERT INTO `les_usagers` VALUES (23523, 'Madame', 'QUESNE', 'Nicole', 'Buru\n\n53170   MESLAY DU MAINE', '02-43-98-62-58', '06-76-70-88-74', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_NQUESNE', 'NQUESNE', NULL);
INSERT INTO `les_usagers` VALUES (23524, 'Monsieur', 'QUESNE', 'Nicolas', 'Buru\n\n53170   MESLAY DU MAINE', '02-43-98-62-58', '06-76-70-88-74', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'NQUESNE', 'NQUESNE', NULL);
INSERT INTO `les_usagers` VALUES (23525, 'Monsieur', 'HEINRY', 'MICHEL', '10 rue de la Libération\n\n53400   CRAON', '02-43-06-29-08', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MHEINRY', 'MHEINRY', NULL);
INSERT INTO `les_usagers` VALUES (23526, 'Monsieur', 'SANTERRE', 'Marie', '3, Rue de la Moisson\n\n53320   BEAULIEU-SUR-OUDON', '02-43-02-47-32', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_MSANTERRE', 'MSANTERRE', NULL);
INSERT INTO `les_usagers` VALUES (23527, 'Mademoiselle', 'SANTERRE', 'Marie', '3, Rue de la Moisson\n\n53320   BEAULIEU-SUR-OUDON', '02-43-02-47-32', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MSANTERRE', 'MSANTERRE', NULL);
INSERT INTO `les_usagers` VALUES (23528, 'Monsieur', 'BOITTIN', 'ALAIN', '7 place Crottigné\n\n53150   MONTSURS', '02-43-01-02-90', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ABOITTIN', 'ABOITTIN', NULL);
INSERT INTO `les_usagers` VALUES (23529, 'Monsieur', 'TALOIS', 'Guillaume', 'La Petite Meulayère\n\n53440   LA CHAPELLE-AU-RIBOUL', '02-43-00-77-69', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_GTALOIS', 'GTALOIS', NULL);
INSERT INTO `les_usagers` VALUES (23530, 'Monsieur', 'TALOIS', 'Guillaume', 'La Petite Meulayère\n\n53440   LA CHAPELLE-AU-RIBOUL', '02-43-00-77-69', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GTALOIS', 'GTALOIS', NULL);
INSERT INTO `les_usagers` VALUES (23531, 'Monsieur', 'RIBOT', 'Hervé', '6, Rue Echelle Marteau\n\n53000   LAVAL', '02-43-53-15-85', '', '', '', 'ma', 0x323030362d30352d3232, 0x323030362d30382d32352031353a30343a3433, 2, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'HRIBOT', 'HRIBOT', NULL);
INSERT INTO `les_usagers` VALUES (23532, 'Monsieur', 'BRISARD', 'René', '17, Rue des Ridelleries\n\n53000   LAVAL', '02-43-53-11-78', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'RBRISARD', 'RBRISARD', NULL);
INSERT INTO `les_usagers` VALUES (23533, 'Monsieur', 'BRISARD', 'Fabien', '17, Rue des Ridelleries\n\n53000   LAVAL', '02-43-53-11-78', '', '', '', 'app', 0x323030362d30352d3232, 0x323030362d30392d30312031363a34333a3033, 4, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FBRISARD', 'FBRISARD', NULL);
INSERT INTO `les_usagers` VALUES (23534, 'Monsieur', 'RENOUARD', 'Sébastien', '7, Place Jean Buchet\n\n53800   LA SELLE-CRAONNAISE', '02-43-06-17-68', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SRENOUARD', 'SRENOUARD', NULL);
INSERT INTO `les_usagers` VALUES (23535, 'Monsieur', 'BRUNET', 'Romain', '2, Rue de la Roche\n\n53800   LA SELLE-CRAONNAISE', '02-43-06-01-76', '06-13-31-81-62', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_RBRUNET', 'RBRUNET', NULL);
INSERT INTO `les_usagers` VALUES (23536, 'Monsieur', 'BRUNET', 'Romain', '2, Rue de la Roche\n\n53800   LA SELLE-CRAONNAISE', '02-43-06-01-76', '06-13-31-81-62', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'RBRUNET', 'RBRUNET', NULL);
INSERT INTO `les_usagers` VALUES (23537, 'Monsieur', 'CHARTIER', 'Jacky', 'La Rouaudière\n\n53200   LAIGNE', '02-43-70-01-59', '06-76-46-89-45', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JCHARTIER', 'JCHARTIER', NULL);
INSERT INTO `les_usagers` VALUES (23538, 'Monsieur', 'CHARTIER', 'Vincent', 'La Rouaudière\n\n53200   LAIGNE', '02-43-70-01-59', '06-76-46-89-45', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'VCHARTIER', 'VCHARTIER', NULL);
INSERT INTO `les_usagers` VALUES (23539, 'Monsieur', 'CHEVY', 'BERTRAND', '64, Rue de Rennes\n\n53000   LAVAL', '02-43-68-26-34', '', '', '', 'ma', 0x323030362d30352d3232, 0x323030362d30392d31342031373a32353a3339, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'BCHEVY', 'BCHEVY', NULL);
INSERT INTO `les_usagers` VALUES (23540, 'Madame', 'GUESDON', 'Fabienne', '34, Rue Pierre Brossolette\n\n53000   LAVAL', '02-43-02-95-18', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FGUESDON', 'FGUESDON', NULL);
INSERT INTO `les_usagers` VALUES (23541, 'Monsieur', 'GUESDON', 'Antoine', '34, Rue Pierre Brossolette\n\n53000   LAVAL', '02-43-02-95-18', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'AGUESDON', 'AGUESDON', NULL);
INSERT INTO `les_usagers` VALUES (23542, 'Monsieur', 'LELIEVRE', 'Christian', 'La Basse Hune\n\n53170   BAZOUGERS', '02-43-98-04-60', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CLELIEVRE', 'CLELIEVRE', NULL);
INSERT INTO `les_usagers` VALUES (23543, 'Monsieur', 'LELIEVRE', 'Florian', 'La Basse Hune\n\n53170   BAZOUGERS', '02-43-98-04-60', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FLELIEVRE', 'FLELIEVRE', NULL);
INSERT INTO `les_usagers` VALUES (23544, 'Monsieur', 'LETOUZE', '', 'Les Naudières\n\n53640   LE HORPS', '02-43-03-93-69', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'LETOUZE', 'LETOUZE', NULL);
INSERT INTO `les_usagers` VALUES (23545, 'Monsieur', 'LETOUZE', 'Marc', 'Les Naudières\n\n53640   LE HORPS', '02-43-03-93-69', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MLETOUZE', 'MLETOUZE', NULL);
INSERT INTO `les_usagers` VALUES (23546, 'Monsieur', 'LOYAU', 'Philippe', '12, lot du Prieuré\n\n53170   BAZOUGERS', '02-43-02-39-44', '', '', '', 'rl', 0x323030362d30352d3232, 0x323030362d30392d31342031373a32323a3236, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PLOYAU', 'PLOYAU', NULL);
INSERT INTO `les_usagers` VALUES (23547, 'Monsieur', 'LOYAU', 'Julien', '12, lot du Prieuré\n\n53170   BAZOUGERS', '02-43-02-39-44', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JLOYAU', 'JLOYAU', NULL);
INSERT INTO `les_usagers` VALUES (23548, 'Monsieur', 'MEZIERE', 'PHILIPPE', '4 rue Relais des Diligences\n\n53390   ST AIGNAN S/ROE', '02-43-06-51-22', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PMEZIERE', 'PMEZIERE', NULL);
INSERT INTO `les_usagers` VALUES (23549, 'Monsieur', 'ROBINET', 'Patrick', '12, Rue du Semnon\n\n53800   CONGRIER', '02-43-06-79-37', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PROBINET', 'PROBINET', NULL);
INSERT INTO `les_usagers` VALUES (23550, 'Monsieur', 'ROBINET', 'Florian', '12, Rue du Semnon\n\n53800   CONGRIER', '02-43-06-79-37', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FROBINET', 'FROBINET', NULL);
INSERT INTO `les_usagers` VALUES (23551, 'Monsieur', 'HUBERT', 'Yohann', '34, Rue du Coq Hardi\n\n72140   SILLE-LE-GUILLAUME', '02-43-20-17-15', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'YHUBERT', 'YHUBERT', NULL);
INSERT INTO `les_usagers` VALUES (23552, 'Madame', 'VAUGEOIS', 'Myriam', '10B, Rue des Cerisiers\n\n53440   LA CHAPELLE-AU-RIBOUL', '06-33-61-54-35', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MVAUGEOIS', 'MVAUGEOIS', NULL);
INSERT INTO `les_usagers` VALUES (23553, 'Monsieur', 'VAUGEOIS', 'Victor', '10B, Rue des Cerisiers\n\n53440   LA CHAPELLE-AU-RIBOUL', '06-33-61-54-35', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'VVAUGEOIS', 'VVAUGEOIS', NULL);
INSERT INTO `les_usagers` VALUES (23554, 'Monsieur', 'GRIMAULT', 'Patrick', 'CENTRE COMMERCIAL MURAT\n\n53000   LAVAL', '02-43-49-19-18', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PGRIMAULT', 'PGRIMAULT', NULL);
INSERT INTO `les_usagers` VALUES (23555, 'Monsieur', 'CAPEL', 'Alain', '45, Rue Docteur Jules Amaudrut\n\n53000   LAVAL', '02-43-49-38-47', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ACAPEL', 'ACAPEL', NULL);
INSERT INTO `les_usagers` VALUES (23556, 'Monsieur', 'CAPEL', 'Mathieu', '45, Rue Docteur Jules Amaudrut\n\n53000   LAVAL', '02-43-49-38-47', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MCAPEL', 'MCAPEL', NULL);
INSERT INTO `les_usagers` VALUES (23557, 'Monsieur', 'GUY', 'PATRICE', '2 rue de la Fontaine\n\n53600   EVRON', '02-43-01-61-38', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PGUY', 'PGUY', NULL);
INSERT INTO `les_usagers` VALUES (23558, 'Monsieur', 'DAVOINE', 'Jean Yves', '15 impasse Pierre Urbain\n\n53600   EVRON', '02-43-01-79-00', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JYDAVOINE', 'JYDAVOINE', NULL);
INSERT INTO `les_usagers` VALUES (23559, 'Monsieur', 'DAVOINE', 'Jérémy', '15 impasse Pierre Urbain\n\n53600   EVRON', '02-43-01-79-00', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JDAVOINE', 'JDAVOINE', NULL);
INSERT INTO `les_usagers` VALUES (23560, 'Monsieur', 'VIRMONTOIS', 'Pascal', '11 rue Victor Foucault\n\n53800   RENAZE', '02-43-06-41-04', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PVIRMONTOIS', 'PVIRMONTOIS', NULL);
INSERT INTO `les_usagers` VALUES (23561, 'Monsieur', 'GIRET', 'Hubert', '7, Résidence des Acacias\n\n53390   SAINT-AIGNAN-SUR-ROE', '02-43-06-59-47', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'HGIRET', 'HGIRET', NULL);
INSERT INTO `les_usagers` VALUES (23562, 'Monsieur', 'GIRET', 'Sylvain', '7, Résidence des Acacias\n\n53390   SAINT-AIGNAN-SUR-ROE', '02-43-06-59-47', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SGIRET', 'SGIRET', NULL);
INSERT INTO `les_usagers` VALUES (23563, 'Monsieur', 'GUIBOUX', 'Jean-Noël', 'La Bizardière\n\n53950   LA CHAPELLE-ANTHENAISE', '02-43-90-47-05', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JGUIBOUX', 'JGUIBOUX', NULL);
INSERT INTO `les_usagers` VALUES (23564, 'Monsieur', 'GUIBOUX', 'Mickaël', 'La Bizardière\n\n53950   LA CHAPELLE-ANTHENAISE', '02-43-90-47-05', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MGUIBOUX', 'MGUIBOUX', NULL);
INSERT INTO `les_usagers` VALUES (23565, 'Monsieur', 'NEAU', 'JEAN-PATRICK', '11, Place du Pilori\n\n53600   EVRON', '02-43-01-91-93', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JNEAU', 'JNEAU', NULL);
INSERT INTO `les_usagers` VALUES (23566, 'Madame', 'DASSE', 'Anne Marie', '5 rue du Docteur Kelle\n\n53270   STE SUZANNE', '02-43-01-42-20', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'AMDASSE', 'AMDASSE', NULL);
INSERT INTO `les_usagers` VALUES (23567, 'Monsieur', 'LEFAUCHEUX', 'Dylan', '5 rue du Docteur Kelle\n\n53270   STE SUZANNE', '02-43-01-42-20', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DLEFAUCHEUX', 'DLEFAUCHEUX', NULL);
INSERT INTO `les_usagers` VALUES (23568, 'Monsieur', 'CLAVREUL', 'BERTRAND', '1 RUE DE LA GARE\n\n53150   MONTSURS', '02-43-01-00-38', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'BCLAVREUL', 'BCLAVREUL', NULL);
INSERT INTO `les_usagers` VALUES (23569, 'Monsieur', 'LEPAGE', 'Christian', 'Le Plessis Belle Bosse\n\n53150   GESNES', '02-43-02-20-52', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CLEPAGE', 'CLEPAGE', NULL);
INSERT INTO `les_usagers` VALUES (23570, 'Monsieur', 'LEPAGE', 'Julien', 'Le Plessis Belle Bosse\n\n53150   GESNES', '02-43-02-20-52', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JLEPAGE', 'JLEPAGE', NULL);
INSERT INTO `les_usagers` VALUES (23571, 'Monsieur', 'ROBINET', 'BRUNO', '42 rue de la Perrière\n\n53600   EVRON', '02-43-01-62-43', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'BROBINET', 'BROBINET', NULL);
INSERT INTO `les_usagers` VALUES (23572, 'Monsieur', 'LEROY TERQUEM', 'Pierre', '35 rue de la Fontaine\n\n53600   ASSE-LE-BERENGER', '02-43-37-28-53', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PLTERQUEM', 'PLTERQUEM', NULL);
INSERT INTO `les_usagers` VALUES (23573, 'Monsieur', 'LEROY TERQUEM', 'Martin', '35 rue de la Fontaine\n\n53600   ASSE-LE-BERENGER', '02-43-37-28-53', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MLTERQUEM', 'MLTERQUEM', NULL);
INSERT INTO `les_usagers` VALUES (23574, 'Monsieur', 'MONNIER', 'Eric', 'Les Riveries\n\n53300   ST FRAIMBAULT DE PRIERES', '02-43-00-87-82', '06-07-55-17-05', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_EMONNIER', 'EMONNIER', NULL);
INSERT INTO `les_usagers` VALUES (23575, 'Mademoiselle', 'MONNIER', 'Elodie', 'Les Riveries\n\n53300   ST FRAIMBAULT DE PRIERES', '02-43-00-87-82', '06-07-55-17-05', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'EMONNIER', 'EMONNIER', NULL);
INSERT INTO `les_usagers` VALUES (23576, 'Monsieur', 'MORIN', 'Didier', '99 rue du Point du Jour\n\n53100   MAYENNE', '02-43-04-94-29', '06-71-15-56-67', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DMORIN', 'DMORIN', NULL);
INSERT INTO `les_usagers` VALUES (23577, 'Monsieur', 'MORIN', 'Wilfried', '99 rue du Point du Jour\n\n53100   MAYENNE', '02-43-04-94-29', '06-71-15-56-67', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'WMORIN', 'WMORIN', NULL);
INSERT INTO `les_usagers` VALUES (23578, 'Monsieur', 'FOUQUET', 'Jean-Christophe', '117-119, rue de Bretagne\n\n53000   LAVAL', '02-43-69-55-05', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JFOUQUET', 'JFOUQUET', NULL);
INSERT INTO `les_usagers` VALUES (23579, 'Monsieur', 'TRANCHARD', 'Pascal', '32, Avenue de la Reine Jehanne\n\n53000   LAVAL', '02-43-56-46-74', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_PTRANCHARD', 'PTRANCHARD', NULL);
INSERT INTO `les_usagers` VALUES (23580, 'Monsieur', 'TRANCHARD', 'Pascal', '32, Avenue de la Reine Jehanne\n\n53000   LAVAL', '02-43-56-46-74', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PTRANCHARD', 'PTRANCHARD', NULL);
INSERT INTO `les_usagers` VALUES (23581, 'Monsieur', 'GIRAULT', 'Stéphane', '114, Rue Victor Boissel\n\n53000   LAVAL', '02-43-53-28-26', '', '', '', 'ma', 0x323030362d30352d3232, 0x323030362d30392d31342031373a32333a3237, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SGIRAULT', 'SGIRAULT', NULL);
INSERT INTO `les_usagers` VALUES (23582, 'Mademoiselle', 'DIETZE', 'Ulrike', 'FJT du Pont de Mayenne\n\n53000   LAVAL', '02-43-59-72-80', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_UDIETZE', 'UDIETZE', NULL);
INSERT INTO `les_usagers` VALUES (23583, 'Mademoiselle', 'DIETZE', 'Ulrike', 'FJT du Pont de Mayenne\n\n53000   LAVAL', '02-43-59-72-80', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'UDIETZE', 'UDIETZE', NULL);
INSERT INTO `les_usagers` VALUES (23584, 'Mademoiselle', 'KOHLER', 'Anne', 'FJT du Pont de Paris\n\n53000   LAVAL', '02-43-59-72-80', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_AKOHLER', 'AKOHLER', NULL);
INSERT INTO `les_usagers` VALUES (23585, 'Mademoiselle', 'KOHLER', 'Anne', 'FJT du Pont de Paris\n\n53000   LAVAL', '02-43-59-72-80', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'AKOHLER', 'AKOHLER', NULL);
INSERT INTO `les_usagers` VALUES (23586, 'Monsieur', 'CHAPIN', 'Jean-Marie', 'Le Domaine du Bas Mont\n\n53100   MOULAY', '02-43-00-48-42', '', 'lamarjolaine@wanadoo.fr', '', 'ma', 0x323030362d30352d3232, 0x323030362d30392d31342031363a34343a3532, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JCHAPIN', 'JCHAPIN', NULL);
INSERT INTO `les_usagers` VALUES (23587, 'Monsieur', 'OESTERLEIN', 'Benedikt', '2 Place Louis de Hercé\n\n53100   MAYENNE', '', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_BOESTERLEIN', 'BOESTERLEIN', NULL);
INSERT INTO `les_usagers` VALUES (23588, 'Monsieur', 'OESTERLEIN', 'Benedickt', '2 Place Louis de Hercé\n\n53100   MAYENNE', '', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'BOESTERLEIN', 'BOESTERLEIN', NULL);
INSERT INTO `les_usagers` VALUES (23589, 'Mademoiselle', 'STIFER', 'Adelina', '12, Rue Henri Duriant\n\n53100   MAYENNE', '', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ASTIFER', 'ASTIFER', NULL);
INSERT INTO `les_usagers` VALUES (23590, 'Mademoiselle', 'STIFLER', 'Adelina', '12, Rue Henri Duriant\n\n53100   MAYENNE', '', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ASTIFLER', 'ASTIFLER', NULL);
INSERT INTO `les_usagers` VALUES (23591, 'Monsieur', 'GAIGNE', 'Jean Jacques', '7 route de Tours\n\n53260   FORCE', '02-43-53-64-47', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JJGAIGNE', 'JJGAIGNE', NULL);
INSERT INTO `les_usagers` VALUES (23592, 'Madame', 'COCHET', 'Clodette', '(AUBRY Mickaël)\n\n53260   ENTRAMMES', '06-75-26-48-11', '06-32-37-90-84', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CCOCHET', 'CCOCHET', NULL);
INSERT INTO `les_usagers` VALUES (23593, 'Monsieur', 'AUBRY', 'Mickaël', '(AUBRY Mickaël)\n\n53260   ENTRAMMES', '06-75-26-48-11', '06-32-37-90-84', '', '', 'app', 0x323030362d30352d3232, 0x323030362d30362d32302031343a33323a3131, 2, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MAUBRY', 'MAUBRY', NULL);
INSERT INTO `les_usagers` VALUES (23594, 'Monsieur', 'VASSORT', 'ERIC', '110 GRANDE RUE\n\n53200   CHATEAU-GONTIER', '02-43-07-82-01', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'EVASSORT', 'EVASSORT', NULL);
INSERT INTO `les_usagers` VALUES (23595, 'Monsieur', 'BEDOUET', 'Thomas', '16, Rue Gaston Martin\n\n53200   CHATEAU-GONTIER', '06-86-84-11-95', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_TBEDOUET', 'TBEDOUET', NULL);
INSERT INTO `les_usagers` VALUES (23596, 'Monsieur', 'BEDOUET', 'Thomas', '16, Rue Gaston Martin\n\n53200   CHATEAU-GONTIER', '06-86-84-11-95', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'TBEDOUET', 'TBEDOUET', NULL);
INSERT INTO `les_usagers` VALUES (23597, 'Monsieur', 'BOURGUILLEAU', 'Jérôme', '60 Route de Nantes\n\n53230   COSSE LE VIVIEN', '02-43-98-85-48', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JBOURGUILLEAU', 'JBOURGUILLEAU', NULL);
INSERT INTO `les_usagers` VALUES (23598, 'Monsieur', 'BLIN', '', '25, Allée Peupleraie\n\n53970   L HUISSERIE', '02-43-90-00-46', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'BLIN', 'BLIN', NULL);
INSERT INTO `les_usagers` VALUES (23599, 'Monsieur', 'BLIN', 'Antony', '25, Allée Peupleraie\n\n53970   L HUISSERIE', '02-43-90-00-46', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ABLIN', 'ABLIN', NULL);
INSERT INTO `les_usagers` VALUES (23600, 'Monsieur', 'BOUTELOUP', 'Hervé', 'La Mitrie\n\n53160   CHAMPGENETEUX', '02-43-37-05-66', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'HBOUTELOUP', 'HBOUTELOUP', NULL);
INSERT INTO `les_usagers` VALUES (23601, 'Monsieur', 'BOUTELOUP', 'Aurélien', 'La Mitrie\n\n53160   CHAMPGENETEUX', '02-43-37-05-66', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ABOUTELOUP', 'ABOUTELOUP', NULL);
INSERT INTO `les_usagers` VALUES (23602, 'Monsieur', 'MICHEL', 'Sylvain', '4, Rue de Bretagne\n\n53410   SAINT-PIERRE-LA-COUR', '02-43-01-85-48', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SMICHEL', 'SMICHEL', NULL);
INSERT INTO `les_usagers` VALUES (23603, 'Monsieur', 'GERAULT', 'Didier', '12, Rue du Petit Bois Brûlé\n\n53410   LE BOURGNEUF-LA-FORET', '02-43-37-17-74', '06-32-05-18-00', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DGERAULT', 'DGERAULT', NULL);
INSERT INTO `les_usagers` VALUES (23604, 'Monsieur', 'GERAULT', 'Guillaume', '12, Rue du Petit Bois Brûlé\n\n53410   LE BOURGNEUF-LA-FORET', '02-43-37-17-74', '06-32-05-18-00', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GGERAULT', 'GGERAULT', NULL);
INSERT INTO `les_usagers` VALUES (23605, 'Monsieur', 'PARIS', 'Jean-Pierre', '113, Rue du Pont de Mayenne\n\n53000   LAVAL', '02-43-53-39-55', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JPARIS', 'JPARIS', NULL);
INSERT INTO `les_usagers` VALUES (23606, 'Monsieur', 'LAUNAY', 'Guy', 'le Haut Chatenay\n\n53380   JUVIGNE', '02-43-68-55-96', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GLAUNAY', 'GLAUNAY', NULL);
INSERT INTO `les_usagers` VALUES (23607, 'Monsieur', 'LAUNAY', 'Frédéric', '38 rue Jean Mermoz\n\n53000   LAVAL', '06-22-33-95-02', '', '', '', 'app', 0x323030362d30352d3232, 0x323030362d30362d30362030393a34343a3035, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FLAUNAY', 'FLAUNAY', NULL);
INSERT INTO `les_usagers` VALUES (23608, 'Monsieur', 'ROBILLARD', 'Joël', '13 Rue Centrale\n\n53940   AHUILLE', '02-43-68-93-29', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JROBILLARD', 'JROBILLARD', NULL);
INSERT INTO `les_usagers` VALUES (23609, 'Monsieur', 'PENNETIER', 'Adrien', '\n\n53410   LE BOURGNEUF-LA-FORET', '', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_APENNETIER', 'APENNETIER', NULL);
INSERT INTO `les_usagers` VALUES (23610, 'Monsieur', 'PENNETIER', 'Adrien', '\n\n53410   LE BOURGNEUF-LA-FORET', '', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'APENNETIER', 'APENNETIER', NULL);
INSERT INTO `les_usagers` VALUES (23611, 'Mademoiselle', 'BELLIER', 'Anne-Françoise', 'Maubusson\n\n35130   RANNEE', '02-99-96-36-22', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_ABELLIER', 'ABELLIER', NULL);
INSERT INTO `les_usagers` VALUES (23612, 'Mademoiselle', 'BELLIER', 'Anne-Françoise', 'Maubusson\n\n35130   RANNEE', '02-99-96-36-22', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ABELLIER', 'ABELLIER', NULL);
INSERT INTO `les_usagers` VALUES (23613, 'Monsieur', 'ROUMEGOUS', 'Georges', '17, Rue de Normandie\n\n53440   ARON', '02-43-32-14-00', '', '', '', 'ma', 0x323030362d30352d3232, 0x323030362d30372d31302031323a31303a3430, 2, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GROUMEGOUS', 'GROUMEGOUS', NULL);
INSERT INTO `les_usagers` VALUES (23614, 'Mademoiselle', 'CHANGEON', 'Charlotte', '32, Rue des Hirondelles\n\n53300   AMBRIERES-LES-VALLEES', '02-43-08-98-65', '06-23-08-33-46', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_CCHANGEON', 'CCHANGEON', NULL);
INSERT INTO `les_usagers` VALUES (23615, 'Mademoiselle', 'CHANGEON', 'Charlotte', '32, Rue des Hirondelles\n\n53300   AMBRIERES-LES-VALLEES', '02-43-08-98-65', '06-23-08-33-46', '', '', 'app', 0x323030362d30352d3232, 0x323030362d30372d31302031323a30363a3433, 3, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CCHANGEON', 'CCHANGEON', NULL);
INSERT INTO `les_usagers` VALUES (23616, 'Mademoiselle', 'DELORY', 'Aurélie', '7, Boulevard du Collège\n\n53170   MESLAY-DU-MAINE', '02-43-69-11-93', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_ADELORY', 'ADELORY', NULL);
INSERT INTO `les_usagers` VALUES (23617, 'Mademoiselle', 'DELORY', 'Aurélie', '7, Boulevard du Collège\n\n53170   MESLAY-DU-MAINE', '02-43-69-11-93', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ADELORY', 'ADELORY', NULL);
INSERT INTO `les_usagers` VALUES (23618, 'Madame', 'COIFFIER', 'Catherine', '\n\n53700   VILLAINES-LA-JUHEL', '02-43-03-21-64', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CCOIFFIER', 'CCOIFFIER', NULL);
INSERT INTO `les_usagers` VALUES (23619, 'Mademoiselle', 'DUVAL', 'Sidonie', 'La Goupillère\n\n53400   CRAON', '02-43-06-13-05', '06-07-59-31-81', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_SDUVAL', 'SDUVAL', NULL);
INSERT INTO `les_usagers` VALUES (23620, 'Mademoiselle', 'DUVAL', 'Sidonie', 'La Goupillère\n\n53400   CRAON', '02-43-06-13-05', '06-07-59-31-81', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SDUVAL', 'SDUVAL', NULL);
INSERT INTO `les_usagers` VALUES (23621, 'Madame', 'HUBERT', 'Françoise', 'Place du Marché\n\n61350   PASSAIS', '02-33-38-71-22', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FHUBERT', 'FHUBERT', NULL);
INSERT INTO `les_usagers` VALUES (23622, 'Madame', 'GOBE', 'Nathalie', 'Le Haut Manoir\n\n50600   SAINT-HILAIRE-DU-HARCOUET', '02-33-59-03-54', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'NGOBE', 'NGOBE', NULL);
INSERT INTO `les_usagers` VALUES (23623, 'Mademoiselle', 'GOBE', 'Pauline', 'Le Haut Manoir\n\n50600   SAINT-HILAIRE-DU-HARCOUET', '02-33-59-03-54', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PGOBE', 'PGOBE', NULL);
INSERT INTO `les_usagers` VALUES (23624, 'Madame', 'GEFFRAY', 'Anne', '37, Rue Aristide Briand\n\n44110   CHATEAUBRIANT', '02-40-81-00-34', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'AGEFFRAY', 'AGEFFRAY', NULL);
INSERT INTO `les_usagers` VALUES (23625, 'Monsieur', 'GUINOISEAU', 'Gaël', '16, Rue de la Ville Marie\n\n44110   CHATEAUBRIANT', '', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_GGUINOISEAU', 'GGUINOISEAU', NULL);
INSERT INTO `les_usagers` VALUES (23626, 'Mademoiselle', 'GUINOISEAU', 'Gaël', '16, Rue de la Ville Marie\n\n44110   CHATEAUBRIANT', '', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GGUINOISEAU', 'GGUINOISEAU', NULL);
INSERT INTO `les_usagers` VALUES (23627, 'Monsieur', 'HERVE', 'FRANCOIS', '3 rue des Forges\n\n53410   PORT BRILLET', '02-43-68-83-56', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FHERVE', 'FHERVE', NULL);
INSERT INTO `les_usagers` VALUES (23628, 'Mademoiselle', 'JAGLINE', 'Estelle', '6, Allée Jean Hunaut\n\n53000   LAVAL', '02-43-68-08-04', '06-25-44-33-06', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_EJAGLINE', 'EJAGLINE', NULL);
INSERT INTO `les_usagers` VALUES (23629, 'Mademoiselle', 'JAGLINE', 'Estelle', '6, Allée Jean Hunaut\n\n53000   LAVAL', '02-43-68-08-04', '06-25-44-33-06', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'EJAGLINE', 'EJAGLINE', NULL);
INSERT INTO `les_usagers` VALUES (23630, 'Mademoiselle', 'LELIEVRE', 'Anne-Sophie', 'La Gautrie\n\n53470   COMMER', '02-43-00-47-81', '06-78-19-72-73', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_ALELIEVRE', 'ALELIEVRE', NULL);
INSERT INTO `les_usagers` VALUES (23631, 'Mademoiselle', 'LELIEVRE', 'Anne-Sophie', 'La Gautrie\n\n53470   COMMER', '02-43-00-47-81', '06-78-19-72-73', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ALELIEVRE', 'ALELIEVRE', NULL);
INSERT INTO `les_usagers` VALUES (23632, 'Monsieur', 'SIMON', 'PHILIPPE', '1 rue des Sports\n\n53940   AHUILLE', '02-43-68-92-68', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PSIMON', 'PSIMON', NULL);
INSERT INTO `les_usagers` VALUES (23633, 'Mademoiselle', 'RONCIN', 'Mylène', 'Le Frêne\n\n53170   BAZOUGERS', '02-43-98-03-23', '06-86-83-66-69', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_MRONCIN', 'MRONCIN', NULL);
INSERT INTO `les_usagers` VALUES (23634, 'Mademoiselle', 'RONCIN', 'Mylène', 'Le Frêne\n\n53170   BAZOUGERS', '02-43-98-03-23', '06-86-83-66-69', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MRONCIN', 'MRONCIN', NULL);
INSERT INTO `les_usagers` VALUES (23635, 'Monsieur', 'RANDRIANALIMANANA', 'Lalao', '1, Place de la Porte\n\n35150   PIRE-SUR-SEICHE', '02-99-44-21-13', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'LRANDRIANALIMANANA', 'LRANDRIANALIMANANA', NULL);
INSERT INTO `les_usagers` VALUES (23636, 'Monsieur', 'RUBIN', 'Pierre-Alexandre', '2 Ter, Rue du Capitaine Fr. Guézault\n\n35370   ETRELLES', '02-99-96-53-08', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_PRUBIN', 'PRUBIN', NULL);
INSERT INTO `les_usagers` VALUES (23637, 'Monsieur', 'RUBIN', 'Pierre-Alexandre', '2 Ter, Rue du Capitaine Fr. Guézault\n\n35370   ETRELLES', '02-99-96-53-08', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PRUBIN', 'PRUBIN', NULL);
INSERT INTO `les_usagers` VALUES (23638, 'Madame', 'LE LAY', 'VERONIQUE', '2, rue du Docteur Roux\n\n53000   LAVAL', '02-43-68-02-57', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'VLLAY', 'VLLAY', NULL);
INSERT INTO `les_usagers` VALUES (23639, 'Monsieur', 'VIOL', 'Denis', '8, Rue des Rosiers\n\n53240   SAINT-JEAN-SUR-MAYENNE', '02-43-37-84-26', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DVIOL', 'DVIOL', NULL);
INSERT INTO `les_usagers` VALUES (23640, 'Mademoiselle', 'VIOL', 'Sylvanie', '8, Rue des Rosiers\n\n53240   SAINT-JEAN-SUR-MAYENNE', '02-43-37-84-26', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SVIOL', 'SVIOL', NULL);
INSERT INTO `les_usagers` VALUES (23641, 'Monsieur', 'DESJOBERT', 'Jacques', '9, Rue Thiers\n\n53200   CHATEAU-GONTIER', '02-43-07-21-83', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JDESJOBERT', 'JDESJOBERT', NULL);
INSERT INTO `les_usagers` VALUES (23642, 'Mademoiselle', 'BERTRON', 'Laure', 'La Guichardière\n\n53970   MONTIGNE-LE-BRILLANT', '02-43-68-94-80', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_LBERTRON', 'LBERTRON', NULL);
INSERT INTO `les_usagers` VALUES (23643, 'Mademoiselle', 'BERTRON', 'Laure', 'La Guichardière\n\n53970   MONTIGNE-LE-BRILLANT', '02-43-68-94-80', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'LBERTRON', 'LBERTRON', NULL);
INSERT INTO `les_usagers` VALUES (23644, 'Madame', 'BESNIER', 'Nicole', '3, Rue du Maine\n\n53960   BONCHAMP-LES-LAVAL', '02-43-90-36-72', '', '', '', 'ma', 0x323030362d30352d3232, 0x323030362d30362d32302031353a33313a3136, 1, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'NBESNIER', 'NBESNIER', NULL);
INSERT INTO `les_usagers` VALUES (23645, 'Mademoiselle', 'BESNEUX', 'Charlène', '5, Impasse de la Perrière\n\n53240   SAINT-JEAN-SUR-MAYENNE', '02-43-37-60-43', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_CBESNEUX', 'CBESNEUX', NULL);
INSERT INTO `les_usagers` VALUES (23646, 'Mademoiselle', 'BESNEUX', 'Charlène', '5, Impasse de la Perrière\n\n53240   SAINT-JEAN-SUR-MAYENNE', '02-43-37-60-43', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CBESNEUX', 'CBESNEUX', NULL);
INSERT INTO `les_usagers` VALUES (23647, 'Monsieur', 'HEUZE', 'ALAIN', '7 B, Rue Saint-Aventin\n\n53200   AZE', '02-43-07-29-61', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'AHEUZE', 'AHEUZE', NULL);
INSERT INTO `les_usagers` VALUES (23648, 'Mademoiselle', 'CHEVALIER', 'Marie-Hélène', '10, Rue de la Promenade\n\n53170   MESLAY-DU-MAINE', '02-43-98-74-33', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_MCHEVALIER', 'MCHEVALIER', NULL);
INSERT INTO `les_usagers` VALUES (23649, 'Mademoiselle', 'CHEVALIER', 'Marie-Hélène', '10, Rue de la Promenade\n\n53170   MESLAY-DU-MAINE', '02-43-98-74-33', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MCHEVALIER', 'MCHEVALIER', NULL);
INSERT INTO `les_usagers` VALUES (23650, 'Madame', 'GUITTET', 'Thérèse', '1, Carrefour du Centre\n\n53170   MESLAY DU MAINE', '02-43-98-41-33', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'TGUITTET', 'TGUITTET', NULL);
INSERT INTO `les_usagers` VALUES (23651, 'Mademoiselle', 'FREITAS', 'Osithe', '21, Rue Division Leclerc\n\n53290   GREZ-EN-BOUERE', '06-20-76-55-67', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_OFREITAS', 'OFREITAS', NULL);
INSERT INTO `les_usagers` VALUES (23652, 'Mademoiselle', 'FREITAS', 'Osithe', '21, Rue Division Leclerc\n\n53290   GREZ-EN-BOUERE', '06-20-76-55-67', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'OFREITAS', 'OFREITAS', NULL);
INSERT INTO `les_usagers` VALUES (23653, 'Monsieur', 'HUBERT  DE FRAISSE', 'FRANCOIS', '4 place du Pilori\n\n53200   CHATEAU GONTIER', '02-43-07-12-39', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FHDFRAISSE', 'FHDFRAISSE', NULL);
INSERT INTO `les_usagers` VALUES (23654, 'Mademoiselle', 'FREREUX', 'Cécilia', '14, Rue de la Gaiété\n\n35220   MARPIRE', '06-79-41-70-22', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_CFREREUX', 'CFREREUX', NULL);
INSERT INTO `les_usagers` VALUES (23655, 'Mademoiselle', 'FREREUX', 'Cécilia', '14, Rue de la Gaiété\n\n35220   MARPIRE', '06-79-41-70-22', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CFREREUX', 'CFREREUX', NULL);
INSERT INTO `les_usagers` VALUES (23656, 'Monsieur', 'GLEYSES', 'Eric', '67 avenue Robert Buron\n\n53000   LAVAL', '02-43-53-60-98', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'EGLEYSES', 'EGLEYSES', NULL);
INSERT INTO `les_usagers` VALUES (23657, 'Mademoiselle', 'GONNET', 'Larissa', '19, Impasse des Noyers\n\n53150   MONTSURS', '02-43-01-00-97', '06-85-69-72-99', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_LGONNET', 'LGONNET', NULL);
INSERT INTO `les_usagers` VALUES (23658, 'Mademoiselle', 'GONNET', 'Larissa', '19, Impasse des Noyers\n\n53150   MONTSURS', '02-43-01-00-97', '06-85-69-72-99', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'LGONNET', 'LGONNET', NULL);
INSERT INTO `les_usagers` VALUES (23659, 'Madame', 'RAIMBAULT', 'Marie-Pascale', '42 avenue du Maréchal Joffre\n\n53200   CHATEAU GONTIER', '02-43-70-44-76', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MRAIMBAULT', 'MRAIMBAULT', NULL);
INSERT INTO `les_usagers` VALUES (23660, 'Mademoiselle', 'LABATTE', 'Coralie', 'Les Vignes\n\n53200   AZE', '02-43-07-85-32', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_CLABATTE', 'CLABATTE', NULL);
INSERT INTO `les_usagers` VALUES (23661, 'Mademoiselle', 'LABATTE', 'Coralie', 'Les Vignes\n\n53200   AZE', '02-43-07-85-32', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CLABATTE', 'CLABATTE', NULL);
INSERT INTO `les_usagers` VALUES (23662, 'Monsieur', 'SORIEUX', 'LOUIS', '15 Place du Marché\n\n53230   COSSE LE VIVIEN', '02-43-98-80-07', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'LSORIEUX', 'LSORIEUX', NULL);
INSERT INTO `les_usagers` VALUES (23663, 'Mademoiselle', 'LECOULES', 'Laétitia', 'Les Halitières\n\n53940   LE GENEST-SAINT-ISLE', '06-20-87-59-31', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_LLECOULES', 'LLECOULES', NULL);
INSERT INTO `les_usagers` VALUES (23664, 'Mademoiselle', 'LECOULES', 'Laétitia', 'Les Halitières\n\n53940   LE GENEST-SAINT-ISLE', '06-20-87-59-31', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'LLECOULES', 'LLECOULES', NULL);
INSERT INTO `les_usagers` VALUES (23665, 'Madame', 'DEUIL', 'CATHERINE', '6 Place du Marché\n\n53170   MESLAY DU MAINE', '02-43-98-40-15', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CDEUIL', 'CDEUIL', NULL);
INSERT INTO `les_usagers` VALUES (23666, 'Mademoiselle', 'LEMONNIER', 'Julie', '2, Impasse des Chênes\n\n53260   ENTRAMMES', '02-43-98-09-71', '06-18-13-33-67', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_JLEMONNIER', 'JLEMONNIER', NULL);
INSERT INTO `les_usagers` VALUES (23667, 'Mademoiselle', 'LEMONNIER', 'Julie', '2, Impasse des Chênes\n\n53260   ENTRAMMES', '02-43-98-09-71', '06-18-13-33-67', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JLEMONNIER', 'JLEMONNIER', NULL);
INSERT INTO `les_usagers` VALUES (23668, 'Madame', 'GOURET', 'Nathalie', '13, Rue du Maine\n\n53240   ANDOUILLE', '02-43-69-74-07', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'NGOURET', 'NGOURET', NULL);
INSERT INTO `les_usagers` VALUES (23669, 'Monsieur', 'NOUVEAU', 'Jean-Yves', '29, bis Rue de Bretagne\n\n53500   VAUTORTE', '02-43-00-54-61', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_JNOUVEAU', 'JNOUVEAU', NULL);
INSERT INTO `les_usagers` VALUES (23670, 'Mademoiselle', 'NOUVEAU', 'Julie', '29, bis Rue de Bretagne\n\n53500   VAUTORTE', '02-43-00-54-61', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JNOUVEAU', 'JNOUVEAU', NULL);
INSERT INTO `les_usagers` VALUES (23671, 'Madame', 'CARPENTIER', 'Françoise', 'Place Saint Martin\n\n53950   LOUVERNE', '02-43-01-10-67', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FCARPENTIER', 'FCARPENTIER', NULL);
INSERT INTO `les_usagers` VALUES (23672, 'Monsieur', 'RACINE', 'Marie', '5, Impasse des Tilleuls\n\n53970   MONTIGNE-LE-BRILLANT', '06-19-38-27-52', '06-12-96-99-94', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_MRACINE', 'MRACINE', NULL);
INSERT INTO `les_usagers` VALUES (23673, 'Mademoiselle', 'RACINE', 'Marie', '5, Impasse des Tilleuls\n\n53970   MONTIGNE-LE-BRILLANT', '06-19-38-27-52', '06-12-96-99-94', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MRACINE', 'MRACINE', NULL);
INSERT INTO `les_usagers` VALUES (23674, 'Monsieur', 'PINCON', 'ERIC', '15, 17 Rue du Gal de Gaulle\n\n53810   CHANGE', '02-43-53-57-97', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'EPINCON', 'EPINCON', NULL);
INSERT INTO `les_usagers` VALUES (23675, 'Mademoiselle', 'VORIN', 'Anaïs', '21, Rue de la Borderie\n\n35500   VITRE', '02-43-01-39-16', '06-88-90-57-56', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_AVORIN', 'AVORIN', NULL);
INSERT INTO `les_usagers` VALUES (23676, 'Mademoiselle', 'VORIN', 'Anaïs', '21, Rue de la Borderie\n\n35500   VITRE', '02-43-01-39-16', '06-88-90-57-56', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'AVORIN', 'AVORIN', NULL);
INSERT INTO `les_usagers` VALUES (23677, 'Messieurs', 'POINCET', 'GUILLEMOT', '58 Avenue de la Division Leclerc\n\n53200   CHATEAU GONTIER', '02-43-07-17-82', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GPOINCET', 'GPOINCET', NULL);
INSERT INTO `les_usagers` VALUES (23678, 'Monsieur', 'BESCHUS', 'Dominique', '5, rue Jules Renard\n\n53200   CHATEAU GONTIER', '02-43-07-00-88', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DBESCHUS', 'DBESCHUS', NULL);
INSERT INTO `les_usagers` VALUES (23679, 'Mademoiselle', 'BESCHUS', 'Manouchka', '5, rue Jules Renard\n\n53200   CHATEAU GONTIER', '02-43-07-00-88', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MBESCHUS', 'MBESCHUS', NULL);
INSERT INTO `les_usagers` VALUES (23680, 'Monsieur', 'JACOVIAC', 'Christian', '20, rue de Nantes\n\n53230   COSSE LE VIVIEN', '02-43-98-90-80', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CJACOVIAC', 'CJACOVIAC', NULL);
INSERT INTO `les_usagers` VALUES (23681, 'Monsieur', 'DENUAULT', 'Alain', '7, Rue de la Maison Neuve\n\n53230   MERAL', '02-43-98-93-61', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_ADENUAULT', 'ADENUAULT', NULL);
INSERT INTO `les_usagers` VALUES (23682, 'Monsieur', 'DENUAULT', 'Alexandre', '7, Rue de la Maison Neuve\n\n53230   MERAL', '02-43-98-93-61', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ADENUAULT', 'ADENUAULT', NULL);
INSERT INTO `les_usagers` VALUES (23683, 'Madame', 'RABILLOUD', 'Jacqueline', '2 Impasse des Ecoles\n\n53290   GREZ EN BOUERE', '02-43-70-50-08', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JRABILLOUD', 'JRABILLOUD', NULL);
INSERT INTO `les_usagers` VALUES (23684, 'Mademoiselle', 'DESHARBES', 'Angélique', '8, Rue des Chèvres\n\n53400   CRAON', '02-43-06-24-93', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_ADESHARBES', 'ADESHARBES', NULL);
INSERT INTO `les_usagers` VALUES (23685, 'Mademoiselle', 'DESHARBES', 'Angélique', '8, Rue des Chèvres\n\n53400   CRAON', '02-43-06-24-93', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ADESHARBES', 'ADESHARBES', NULL);
INSERT INTO `les_usagers` VALUES (23686, 'Monsieur', 'ROULLAND', 'BERTRAND', 'Route de Mayenne\n\n53100   MOULAY', '02-43-00-44-66', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'BROULLAND', 'BROULLAND', NULL);
INSERT INTO `les_usagers` VALUES (23687, 'Mademoiselle', 'DUVAL', 'Anne-Laure', 'Les Petits Vaux\n\n53220   LARCHAMP', '02-43-05-65-00', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ADUVAL', 'ADUVAL', NULL);
INSERT INTO `les_usagers` VALUES (23688, 'Mademoiselle', 'DUVAL', 'Anne Laure', 'Les Petits Vaux\n\n53220   LARCHAMP', '02-43-05-65-00', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ALDUVAL', 'ALDUVAL', NULL);
INSERT INTO `les_usagers` VALUES (23689, 'Mademoiselle', 'GENDRY', 'Audrey', 'La Guesnière\n\n53200   LAIGNE', '02-43-70-43-05', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_AGENDRY', 'AGENDRY', NULL);
INSERT INTO `les_usagers` VALUES (23690, 'Mademoiselle', 'GENDRY', 'Audrey', 'La Guesnière\n\n53200   LAIGNE', '02-43-70-43-05', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'AGENDRY', 'AGENDRY', NULL);
INSERT INTO `les_usagers` VALUES (23691, 'Madame', 'PIETRERA', 'LUCETTE', '52 Grande Rue\n\n53400   CRAON', '02-43-06-11-72', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'LPIETRERA', 'LPIETRERA', NULL);
INSERT INTO `les_usagers` VALUES (23692, 'Mademoiselle', 'GOHIER', 'Tiphaine', 'Le Grand Assé\n\n53350   BALLOTS', '02-43-06-67-59', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_TGOHIER', 'TGOHIER', NULL);
INSERT INTO `les_usagers` VALUES (23693, 'Mademoiselle', 'GOHIER', 'Tiphaine', 'Le Grand Assé\n\n53350   BALLOTS', '02-43-06-67-59', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'TGOHIER', 'TGOHIER', NULL);
INSERT INTO `les_usagers` VALUES (23694, 'Monsieur', 'COIFFIER', 'Jean-Pierre', '17 rue St Nicolas\n\n53700   VILLAINES LA JUHEL', '02-43-03-20-89', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JCOIFFIER', 'JCOIFFIER', NULL);
INSERT INTO `les_usagers` VALUES (23695, 'Mademoiselle', 'GRISON', 'Charlène', '27, Rue de la Grange\n\n53440   ARON', '02-43-04-36-51', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_CGRISON', 'CGRISON', NULL);
INSERT INTO `les_usagers` VALUES (23696, 'Mademoiselle', 'GRISON', 'Charlène', '27, Rue de la Grange\n\n53440   ARON', '02-43-04-36-51', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CGRISON', 'CGRISON', NULL);
INSERT INTO `les_usagers` VALUES (23697, 'Madame', 'KYSSEL', 'Janine', '10 rue Neuve\n\n53400   CRAON', '02-43-06-13-77', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JKYSSEL', 'JKYSSEL', NULL);
INSERT INTO `les_usagers` VALUES (23698, 'Monsieur', 'HALARD', 'Aurélien', '10, Rue de Normandie\n\n53940   AHUILLE', '06-16-38-53-90', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_AHALARD', 'AHALARD', NULL);
INSERT INTO `les_usagers` VALUES (23699, 'Monsieur', 'HALARD', 'Aurélien', '10, Rue de Normandie\n\n53940   AHUILLE', '06-16-38-53-90', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'AHALARD', 'AHALARD', NULL);
INSERT INTO `les_usagers` VALUES (23700, 'Monsieur', 'POINCET', 'BRUNO', '58 Avenue de la Division Leclerc\n\n53200   CHATEAU GONTIER', '02-43-07-17-82', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'BPOINCET', 'BPOINCET', NULL);
INSERT INTO `les_usagers` VALUES (23701, 'Monsieur', 'HUET', 'Patrick', '4, Rue des Rouges Gorges\n\n53200   CHATEAU-GONTIER', '06-13-29-00-63', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PHUET', 'PHUET', NULL);
INSERT INTO `les_usagers` VALUES (23702, 'Mademoiselle', 'HUET', 'Aurore', '4, Rue des Rouges Gorges\n\n53200   CHATEAU-GONTIER', '06-13-29-00-63', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'AHUET', 'AHUET', NULL);
INSERT INTO `les_usagers` VALUES (23703, 'Madame', 'BARDOUX', 'JACQUELINE', '47 avenue de la Libération\n\n53940   ST BERTHEVIN', '02-43-69-01-78', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JBARDOUX', 'JBARDOUX', NULL);
INSERT INTO `les_usagers` VALUES (23704, 'Mademoiselle', 'LAURENT', '', '5, Rue Prairial\n\n53810   CHANGE', '02-43-49-11-20', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'LAURENT', 'LAURENT', NULL);
INSERT INTO `les_usagers` VALUES (23705, 'Mademoiselle', 'LAURENT', 'Mélanie', '5, Rue Prairial\n\n53810   CHANGE', '02-43-49-11-20', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MLAURENT', 'MLAURENT', NULL);
INSERT INTO `les_usagers` VALUES (23706, 'Monsieur', 'VALLIN', 'Philippe', '2, rue du Docteur Roux\n\n53000   LAVAL', '02-43-68-02-57', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PVALLIN', 'PVALLIN', NULL);
INSERT INTO `les_usagers` VALUES (23707, 'Mademoiselle', 'LERAY', 'Aurélie', '9, Impasse du Verger\n\n53500   MONTENAY', '02-43-05-23-54', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_ALERAY', 'ALERAY', NULL);
INSERT INTO `les_usagers` VALUES (23708, 'Mademoiselle', 'LERAY', 'Aurélie', '9, Impasse du Verger\n\n53500   MONTENAY', '02-43-05-23-54', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ALERAY', 'ALERAY', NULL);
INSERT INTO `les_usagers` VALUES (23709, 'Mademoiselle', 'MELLIER', 'Gâelle', '3, Rue des Acacias\n\n53320   RUILLE-LE-GRAVELAIS', '06-16-89-81-29', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_GMELLIER', 'GMELLIER', NULL);
INSERT INTO `les_usagers` VALUES (23710, 'Mademoiselle', 'MELLIER', 'Gâelle', '3, Rue des Acacias\n\n53320   RUILLE-LE-GRAVELAIS', '06-16-89-81-29', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GMELLIER', 'GMELLIER', NULL);
INSERT INTO `les_usagers` VALUES (23711, 'Monsieur', 'BARACH', 'JOSEPH', '10, Place République\n\n49500   SEGRE', '02-41-92-23-08', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JBARACH', 'JBARACH', NULL);
INSERT INTO `les_usagers` VALUES (23712, 'Mademoiselle', 'PAILLARD', 'Amélie', '2, Allée des Primevères\n\n35130   LA GUERCHE-DE-BRETAGNE', '06-27-02-42-20', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_APAILLARD', 'APAILLARD', NULL);
INSERT INTO `les_usagers` VALUES (23713, 'Mademoiselle', 'PAILLARD', 'Amélie', '2, Allée des Primevères\n\n35130   LA GUERCHE-DE-BRETAGNE', '06-27-02-42-20', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'APAILLARD', 'APAILLARD', NULL);
INSERT INTO `les_usagers` VALUES (23714, 'Mademoiselle', 'REMBOURG', 'Caroline', '3, Paul Cézanne\n\n44110   CHATEAUBRIANT', '02-40-28-14-43', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_CREMBOURG', 'CREMBOURG', NULL);
INSERT INTO `les_usagers` VALUES (23715, 'Mademoiselle', 'REMBOURG', 'Caroline', '3, Paul Cézanne\n\n44110   CHATEAUBRIANT', '02-40-28-14-43', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CREMBOURG', 'CREMBOURG', NULL);
INSERT INTO `les_usagers` VALUES (23716, 'Monsieur', 'DHERSIN', 'Maxime', '1, Rue des Combattants volontaires\n\n53000   LAVAL', '02-43-66-98-67', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_MDHERSIN', 'MDHERSIN', NULL);
INSERT INTO `les_usagers` VALUES (23717, 'Monsieur', 'DHERSIN', 'Maxime', '1, Rue des Combattants volontaires\n\n53000   LAVAL', '02-43-66-98-67', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MDHERSIN', 'MDHERSIN', NULL);
INSERT INTO `les_usagers` VALUES (23718, 'Madame', 'SORIEUX', 'Noëlle', '15 Place du Marché\n\n53230   COSSE LE VIVIEN', '02-43-98-80-07', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'NSORIEUX', 'NSORIEUX', NULL);
INSERT INTO `les_usagers` VALUES (23719, 'Madame', 'DORIZON(CHEMIN)', 'Sonia', '8, Rue de la Frenouse\n\n53230   COSSE-LE-VIVIEN', '02-43-66-08-11', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_SDCHEMIN', 'SDCHEMIN', NULL);
INSERT INTO `les_usagers` VALUES (23720, 'Madame', 'DORIZON (CHEMIN)', 'Sonia', '8, Rue de la Frenouse\n\n53230   COSSE-LE-VIVIEN', '02-43-66-08-11', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SDCHEMIN', 'SDCHEMIN', NULL);
INSERT INTO `les_usagers` VALUES (23721, 'Mademoiselle', 'GANDON', 'Delphine', '65, Rue Sainte-Catherine\n\n53000   LAVAL', '02-43-08-46-05', '06-09-43-37-01', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_DGANDON', 'DGANDON', NULL);
INSERT INTO `les_usagers` VALUES (23722, 'Mademoiselle', 'GANDON', 'Delphine', '65, Rue Sainte-Catherine\n\n53000   LAVAL', '02-43-08-46-05', '06-09-43-37-01', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DGANDON', 'DGANDON', NULL);
INSERT INTO `les_usagers` VALUES (23723, 'Madame', 'LOXQ', 'CHRISTINE', '67 avenue Robert Buron\n\n53000   LAVAL', '02-43-53-60-98', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CLOXQ', 'CLOXQ', NULL);
INSERT INTO `les_usagers` VALUES (23724, 'Madame', 'TRUCHOT', '', '11 rue du Général de Gaulle\n\n53000   LAVAL', '02-43-53-21-37', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'TRUCHOT', 'TRUCHOT', NULL);
INSERT INTO `les_usagers` VALUES (23725, 'Monsieur', 'BOUTIER', 'JEAN-LOUIS', '4 PLACE DE LA TREMOILLE\n\n53000   LAVAL', '02-43-53-54-40', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JBOUTIER', 'JBOUTIER', NULL);
INSERT INTO `les_usagers` VALUES (23726, 'Madame', 'LESUEUR', 'SONIA', '21 rue Aristide Briand\n\n53100   MAYENNE', '02-43-04-10-96', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SLESUEUR', 'SLESUEUR', NULL);
INSERT INTO `les_usagers` VALUES (23727, 'Monsieur', 'KRETZ', 'PASCAL', '29 rue de la Paix\n\n53000   LAVAL', '02-43-67-08-76', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PKRETZ', 'PKRETZ', NULL);
INSERT INTO `les_usagers` VALUES (23728, 'Mademoiselle', 'SIMON', 'Emeline', '163, Boulevard Jourdan\n\n53000   LAVAL', '06-87-39-72-33', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_ESIMON', 'ESIMON', NULL);
INSERT INTO `les_usagers` VALUES (23729, 'Mademoiselle', 'SIMON', 'Emeline', '163, Boulevard Jourdan\n\n53000   LAVAL', '06-87-39-72-33', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ESIMON', 'ESIMON', NULL);
INSERT INTO `les_usagers` VALUES (23730, 'Madame', 'BOUZIANE', 'NADIA', '11 PLACE JEAN MOULIN\n\n53000   LAVAL', '02-43-53-76-92', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'NBOUZIANE', 'NBOUZIANE', NULL);
INSERT INTO `les_usagers` VALUES (23731, 'Mademoiselle', 'THOREAU', 'Virginie', '86 rue Victor Boissel\n\n53000   LAVAL', '02-43-66-08-41', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_VTHOREAU', 'VTHOREAU', NULL);
INSERT INTO `les_usagers` VALUES (23732, 'Mademoiselle', 'THOREAU', 'Virginie', '86 rue Victor Boissel\n\n53000   LAVAL', '02-43-66-08-41', '', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'VTHOREAU', 'VTHOREAU', NULL);
INSERT INTO `les_usagers` VALUES (23733, 'Monsieur', 'BOUDAUD', 'ALAIN', 'SNC BOUDAUD\n\n53000   LAVAL', '02-43-69-00-03', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ABOUDAUD', 'ABOUDAUD', NULL);
INSERT INTO `les_usagers` VALUES (23734, 'Mademoiselle', 'WAFFLARD', 'Floriane', '27, Allée Corbineau\n\n53000   LAVAL', '06-22-80-39-92', '06-70-70-50-35', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_FWAFFLARD', 'FWAFFLARD', NULL);
INSERT INTO `les_usagers` VALUES (23735, 'Mademoiselle', 'WAFFLARD', 'Floriane', '27, Allée Corbineau\n\n53000   LAVAL', '06-22-80-39-92', '06-70-70-50-35', '', '', 'app', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FWAFFLARD', 'FWAFFLARD', NULL);
INSERT INTO `les_usagers` VALUES (23736, 'Monsieur', 'HAUTBOIS', '', '11 avenue Rene Cassin\n\n53200   AZE', '02-43-09-15-15', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'HAUTBOIS', 'HAUTBOIS', NULL);
INSERT INTO `les_usagers` VALUES (23737, 'Monsieur', 'JOUSSET', 'Philippe', '66 Avenue de Paris\n\n53940   ST BERTHEVIN', '02-43-01-24-24', '', '', '', 'ma', 0x323030362d30352d3232, 0x323030362d30382d32352031353a31383a3436, 2, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PJOUSSET', 'PJOUSSET', NULL);
INSERT INTO `les_usagers` VALUES (23738, 'Monsieur', 'BOURDAIS', 'Bertrand', '58 RUE DES TILLEULS\n\n53100   MAYENNE', '02-43-32-02-42', '06-11-92-59-19', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'BBOURDAIS', 'BBOURDAIS', NULL);
INSERT INTO `les_usagers` VALUES (23739, 'Monsieur', 'BOURDAIS', 'Sylvain', '58 RUE DES TILLEULS\r\n\r\n53100   MAYENNE', '02-43-32-02-42', '06-11-92-59-19', '', '', 'app', 0x323030362d30352d3232, 0x323030362d30392d32302031313a30353a3536, 6, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SBOURDAIS', 'SBOURDAIS', NULL);
INSERT INTO `les_usagers` VALUES (23740, 'Monsieur', 'CRONIER', '', 'ZI SUD\n\n53960   BONCHAMP-LES-LAVAL', '02-43-56-61-61', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CRONIER', 'CRONIER', NULL);
INSERT INTO `les_usagers` VALUES (23741, 'Madame', 'MENTEUR', 'Chantal', '16 rue Hebert\n\n53000   LAVAL', '02-43-68-03-54', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CMENTEUR', 'CMENTEUR', NULL);
INSERT INTO `les_usagers` VALUES (23742, 'Monsieur', 'CHRETIEN', 'Frédéric', '16 rue Hebert\r\n\r\n53000   LAVAL', '02-43-68-03-54', '', '', '', 'app', 0x323030362d30352d3232, 0x323030362d30392d32302031313a30363a3439, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FCHRETIEN', 'FCHRETIEN', NULL);
INSERT INTO `les_usagers` VALUES (23743, 'Monsieur', 'MERIENNE', 'FABRICE', 'Route de Laval  LD La Hainaud\n\n53500   ERNEE', '02-43-05-23-71', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FMERIENNE', 'FMERIENNE', NULL);
INSERT INTO `les_usagers` VALUES (23744, 'Monsieur', 'CLOSSAIS', 'Gérard', 'LA BELLOUVRIE\n\n53500   SAINT-PIERRE-DES-LANDES', '02-43-05-94-16', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GCLOSSAIS', 'GCLOSSAIS', NULL);
INSERT INTO `les_usagers` VALUES (23745, 'Monsieur', 'CLOSSAIS', 'Emmanuel', 'LA BELLOUVRIE\r\n\r\n53500   SAINT-PIERRE-DES-LANDES', '02-43-05-94-16', '', '', '', 'app', 0x323030362d30352d3232, 0x323030362d30392d32302031313a30373a3433, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ECLOSSAIS', 'ECLOSSAIS', NULL);
INSERT INTO `les_usagers` VALUES (23746, 'Monsieur', 'POISSON', '', 'ZA rue de la Forge\n\n53800   RENAZE', '02-43-06-73-68', '', '', '', 'ma', 0x323030362d30352d3232, 0x323030362d30392d32312031373a32323a3338, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'POISSON', 'POISSON', NULL);
INSERT INTO `les_usagers` VALUES (23747, 'Monsieur', 'FORVEILLE', 'Didier', '12 rue du maine\n\n53220   LA PELLERINE', '02-43-05-92-95', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DFORVEILLE', 'DFORVEILLE', NULL);
INSERT INTO `les_usagers` VALUES (23748, 'Monsieur', 'FORVEILLE', 'Alban', '12 rue du maine\r\n\r\n53220   LA PELLERINE', '02-43-05-92-95', '', '', '', 'app', 0x323030362d30352d3232, 0x323030362d30392d32302031313a30383a3330, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'AFORVEILLE', 'AFORVEILLE', NULL);
INSERT INTO `les_usagers` VALUES (23749, 'Monsieur', 'LEGEARD', 'Philippe', 'ROUTE DE MAYENNE\n\n53300   AMBRIERES-LES-VALLEES', '02-43-04-91-04', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PLEGEARD', 'PLEGEARD', NULL);
INSERT INTO `les_usagers` VALUES (23750, 'Monsieur', 'GUILMIN', 'Christian', '128 Rue du Val de Mayenne\n\n53100   MAYENNE', '06-78-72-41-78', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CGUILMIN', 'CGUILMIN', NULL);
INSERT INTO `les_usagers` VALUES (23751, 'Monsieur', 'GUILMIN', 'Anthony', 'Mme POULET\r\n\r\n53500   MONTENAY', '', '', '', '', 'app', 0x323030362d30352d3232, 0x323030362d30392d32302031313a30383a3531, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'AGUILMIN', 'AGUILMIN', NULL);
INSERT INTO `les_usagers` VALUES (23752, 'Monsieur', 'CHESNAIS', '', '515 rue de la peyenniere\n\n53100   MAYENNE', '02-43-04-18-25', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CHESNAIS', 'CHESNAIS', NULL);
INSERT INTO `les_usagers` VALUES (23753, 'Monsieur', 'LESAGE', 'Didier', '7 RUE DE LA MAIRIE\n\n53440   LA BAZOGE-MONTPINCON', '02-43-08-11-41', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DLESAGE', 'DLESAGE', NULL);
INSERT INTO `les_usagers` VALUES (23754, 'Monsieur', 'LESAGE', 'Emmanuel', '7 RUE DE LA MAIRIE\r\n\r\n53440   LA BAZOGE-MONTPINCON', '02-43-08-11-41', '', '', '', 'app', 0x323030362d30352d3232, 0x323030362d30392d32302031313a30393a3132, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ELESAGE', 'ELESAGE', NULL);
INSERT INTO `les_usagers` VALUES (23755, 'Monsieur', 'GALLIENNE', 'Anthony', 'ZAC des Morandières\n\n53810   CHANGE', '02-43-59-73-00', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'AGALLIENNE', 'AGALLIENNE', NULL);
INSERT INTO `les_usagers` VALUES (23756, 'Monsieur', 'MORIN', 'Francis', '26 rue pricipale\n\n53100   CONTEST', '02-43-00-45-49', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FMORIN', 'FMORIN', NULL);
INSERT INTO `les_usagers` VALUES (23757, 'Monsieur', 'MORIN', 'Cédric', '26 rue pricipale\r\n\r\n53100   CONTEST', '02-43-00-45-49', '', '', '', 'app', 0x323030362d30352d3232, 0x323030362d30392d32302031313a30393a3439, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CMORIN', 'CMORIN', NULL);
INSERT INTO `les_usagers` VALUES (23758, 'Monsieur', 'CHAMPION', '', 'BLD DE LAVAL\n\n35500   VITRE', '02-99-75-00-53', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CHAMPION', 'CHAMPION', NULL);
INSERT INTO `les_usagers` VALUES (23759, 'Monsieur', 'PENNETIER', 'Loic', '10 RUE DU PETIT BOIS BRULE\n\n53410   LE BOURGNEUF-LA-FORET', '02-43-37-18-30', '06-13-05-55-44', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'LPENNETIER', 'LPENNETIER', NULL);
INSERT INTO `les_usagers` VALUES (23760, 'Monsieur', 'PENNETIER', 'Sébastien', '10 RUE DU PETIT BOIS BRULE\r\n\r\n53410   LE BOURGNEUF-LA-FORET', '02-43-37-18-30', '06-13-05-55-44', '', '', 'app', 0x323030362d30352d3232, 0x323030362d30392d32302031313a31303a3037, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SPENNETIER', 'SPENNETIER', NULL);
INSERT INTO `les_usagers` VALUES (23761, 'Monsieur', 'MORIN', 'Francis', 'ZAC des Morandières\n\n53810   CHANGE', '02-43-59-73-00', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FMORIN', 'FMORIN', NULL);
INSERT INTO `les_usagers` VALUES (23762, 'Monsieur', 'BOURILLON', 'Eric', 'LA CONTRIE\n\n53100   PARIGNE-SUR-BRAYE', '06-23-57-37-44', '02-43-00-38-03', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'EBOURILLON', 'EBOURILLON', NULL);
INSERT INTO `les_usagers` VALUES (23763, 'Monsieur', 'SAUDUBRAY', 'Francois', 'LA CONTRIE\r\n\r\n53100   PARIGNE-SUR-BRAYE', '06-23-57-37-44', '02-43-00-38-03', '', '', 'app', 0x323030362d30352d3232, 0x323030362d30392d32302031313a31303a3436, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FSAUDUBRAY', 'FSAUDUBRAY', NULL);
INSERT INTO `les_usagers` VALUES (23764, 'Monsieur', 'TERROITIN', '', '14, Rue Jean Baptiste Lafosse\n\n53000   LAVAL', '02-43-49-17-55', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'TERROITIN', 'TERROITIN', NULL);
INSERT INTO `les_usagers` VALUES (23765, 'Monsieur', 'MARCHAND', '', 'ZI la chalopinière\n\n53170   MESLAY DU MAINE', '02-43-98-41-07', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MARCHAND', 'MARCHAND', NULL);
INSERT INTO `les_usagers` VALUES (23766, 'Monsieur', 'LEPAGE', 'Dominique', 'Le Pâtis\n\n53260   PARNE-S/ROC', '02-43-98-32-82', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DLEPAGE', 'DLEPAGE', NULL);
INSERT INTO `les_usagers` VALUES (23768, 'Monsieur', 'GAUTIER', 'JOEL', 'ESPACE 23 SUD\n\n44150   ANCENIS', '02-40-96-40-40', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JGAUTIER', 'JGAUTIER', NULL);
INSERT INTO `les_usagers` VALUES (23769, 'Monsieur', 'BRICAUD', 'Xavier', 'LIBERBIERE\n\n44522   LA ROCHE-BLANCHE', '02-40-98-47-03', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'XBRICAUD', 'XBRICAUD', NULL);
INSERT INTO `les_usagers` VALUES (23771, 'Monsieur', 'LHERMELIN', 'Alain', 'ZA RUE DES BORDAGERS\n\n53810   CHANGE', '02-43-56-25-11', '', '', '', 'ma', 0x323030362d30352d3232, 0x323030362d30392d32312031373a32353a3236, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ALHERMELIN', 'ALHERMELIN', NULL);
INSERT INTO `les_usagers` VALUES (23772, 'Monsieur', 'JEUDY', 'Thierry', '16 rue du 11 Novembre \n\n53940   ST BERTHEVIN', '02-43-68-15-23', '', '', '', 'rl', 0x323030362d30352d3232, 0x323030362d30392d32312031373a32353a3236, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'TJEUDY', 'TJEUDY', NULL);
INSERT INTO `les_usagers` VALUES (23774, 'Monsieur', 'DANVEAU', 'THIERRY', 'LD SANS SOUCI\n\n53300   SAINT-FRAIMBAULT-DE-PRIERES', '02-43-00-87-21', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'TDANVEAU', 'TDANVEAU', NULL);
INSERT INTO `les_usagers` VALUES (23775, 'Monsieur', 'LEFEBVRE', 'Patrick', '166 rue des platanes\n\n53100   MAYENNE', '02-43-00-94-63', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PLEFEBVRE', 'PLEFEBVRE', NULL);
INSERT INTO `les_usagers` VALUES (23777, 'Monsieur', 'PESLIER', 'Thierry', '4 route du Mans\n\n53960   BONCHAMP-LES-LAVAL', '02-43-90-96-53', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'TPESLIER', 'TPESLIER', NULL);
INSERT INTO `les_usagers` VALUES (23778, 'Monsieur', 'LEVRARD', '', '5 RUE DU SOBLOMET\n\n53100   MOULAY', '02-43-00-03-20', '06-88-06-04-32', '', '', 'rl', 0x323030362d30352d3232, 0x323030362d30392d32312031373a32353a3236, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'LEVRARD', 'LEVRARD', NULL);
INSERT INTO `les_usagers` VALUES (23780, 'Monsieur', 'FEURPRIER', 'Alain', '8 RUE BOSNIEUL\n\n53370   ST PIERRE DES NIDS', '02-43-03-50-71', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'AFEURPRIER', 'AFEURPRIER', NULL);
INSERT INTO `les_usagers` VALUES (23781, 'Monsieur', 'LOUTELLIER', 'Daniel', '6  LOT DES LILAS\n\n53700   SAINT-AUBIN-DU-DESERT', '02-43-03-34-38', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DLOUTELLIER', 'DLOUTELLIER', NULL);
INSERT INTO `les_usagers` VALUES (23783, 'Monsieur', 'PASQUIER', '', '643 Avenue Gutenberg\n\n53100   MAYENNE', '02-43-30-44-44', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PASQUIER', 'PASQUIER', NULL);
INSERT INTO `les_usagers` VALUES (23784, 'Madame', 'MARTIN', 'Marie Thèrese', '9 résidence ste Catheine \n\n53100   MAYENNE', '02-43-30-44-44', '', '', '', 'rl', 0x323030362d30352d3232, 0x323030362d30392d32312031373a32353a3236, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MTMARTIN', 'MTMARTIN', NULL);
INSERT INTO `les_usagers` VALUES (23786, 'Monsieur', 'BARADA', 'Patrice', '35 Avenue des sablonnieres\n\n53200   SAINT-FORT', '02-43-07-23-90', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PBARADA', 'PBARADA', NULL);
INSERT INTO `les_usagers` VALUES (23787, 'Monsieur', 'MOUGINS', 'Christophe', '36 rue Jules Renard\n\n53200   CHATEAU GONTIER', '06-24-32-40-52', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CMOUGINS', 'CMOUGINS', NULL);
INSERT INTO `les_usagers` VALUES (23789, 'Monsieur', 'PAILLARD', 'DIDIER', '5 route de laval\n\n53390   ST AIGNAN S/ROE', '02-43-06-51-35', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DPAILLARD', 'DPAILLARD', NULL);
INSERT INTO `les_usagers` VALUES (23790, 'Madame', 'MONCEAU', 'Isabelle', 'LE ROCHER\n\n53410   ST OUEN DES TOITS', '02-43-37-75-33', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'IMONCEAU', 'IMONCEAU', NULL);
INSERT INTO `les_usagers` VALUES (23792, 'Monsieur', 'CHAPLAIN', 'Marcel', 'LES BOUILLONS\n\n53140   LA PALLU', '02-43-03-87-18', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MCHAPLAIN', 'MCHAPLAIN', NULL);
INSERT INTO `les_usagers` VALUES (23793, 'Monsieur', 'RIOUL', 'Dominique', 'LE BOUILLON\n\n53140   LA PALLU', '02-43-03-83-95', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DRIOUL', 'DRIOUL', NULL);
INSERT INTO `les_usagers` VALUES (23795, 'Monsieur', 'LEFEBVRE', '', '35 bd Clément Ader\n\n53020   LAVAL CEDEX 9', '02-43-53-11-73', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'LEFEBVRE', 'LEFEBVRE', NULL);
INSERT INTO `les_usagers` VALUES (23796, 'Monsieur', 'ROULLIERE', 'Joseph', 'Appt 844\n\n53000   LAVAL', '06-73-75-32-20', '', '', '', 'rl', 0x323030362d30352d3232, 0x323030362d30392d32312031373a32353a3237, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_JROULLIERE', 'JROULLIERE', NULL);
INSERT INTO `les_usagers` VALUES (23798, 'Monsieur', 'COUVEY', '', 'ZA DES MORANDIERES\n\n53000   LAVAL', '02-43-59-21-59', '', '', '', 'ma', 0x323030362d30352d3232, 0x323030362d30372d31322031323a31363a3332, 2, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'COUVEY', 'COUVEY', NULL);
INSERT INTO `les_usagers` VALUES (23801, 'Monsieur', 'BODIN', 'Jean Claude', 'Bd Maréchal Leclerc\n\n53600   EVRON', '02-43-01-63-26', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JCBODIN', 'JCBODIN', NULL);
INSERT INTO `les_usagers` VALUES (23802, 'Monsieur', 'BEAUCE', 'Jean Claude', 'BELLE VUE\n\n53440   ARON', '02-43-00-93-60', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JCBEAUCE', 'JCBEAUCE', NULL);
INSERT INTO `les_usagers` VALUES (23804, 'Monsieur', 'BOUVIER', 'JEAN CLAUDE', 'Route de Laval  LD La Hainaud\n\n53500   ERNEE', '02-43-05-23-71', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JCBOUVIER', 'JCBOUVIER', NULL);
INSERT INTO `les_usagers` VALUES (23805, 'Monsieur', 'BOURGAULT', 'Andre', '10 impasse de la loge\n\n53240   ST JEAN S/MAYENNE', '02-43-01-17-71', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ABOURGAULT', 'ABOURGAULT', NULL);
INSERT INTO `les_usagers` VALUES (23807, 'Monsieur', 'NEVEU', 'Christian', '15 AVENUE RENE CASSIN\n\n53200   AZE', '02-43-70-33-90', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CNEVEU', 'CNEVEU', NULL);
INSERT INTO `les_usagers` VALUES (23808, 'Monsieur', 'COTTIER', 'Gérard', 'la maison neuve\n\n53200   MENIL', '02-43-70-27-50', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GCOTTIER', 'GCOTTIER', NULL);
INSERT INTO `les_usagers` VALUES (23810, 'Madame', 'DELAUNAY', 'Marie-Claude', '9 rue du Grand jardin\n\n35133   JAVENE', '02-99-99-08-17', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_MDELAUNAY', 'MDELAUNAY', NULL);
INSERT INTO `les_usagers` VALUES (23812, 'Monsieur', 'BOUFFORT', '', '9 RUE DU MAINE\n\n53190   FOUGEROLLES-DU-PLESSIS', '02-43-05-58-87', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'BOUFFORT', 'BOUFFORT', NULL);
INSERT INTO `les_usagers` VALUES (23813, 'Monsieur', 'LENGRONNE', '', '8 RUE DE NORMANDIE\n\n53190   FOUGEROLLES-DU-PLESSIS', '02-43-05-58-87', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'LENGRONNE', 'LENGRONNE', NULL);
INSERT INTO `les_usagers` VALUES (23815, 'Monsieur', 'GIRAULT', 'Laurent', 'ZAC des Morandières\n\n53810   CHANGE', '02-43-59-73-00', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'LGIRAULT', 'LGIRAULT', NULL);
INSERT INTO `les_usagers` VALUES (23816, 'Madame', 'MONCEAUX', 'Michèle', 'Beauséjour\n\n53440   ARON', '02-43-32-14-52', '06-12-04-10-30', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MMONCEAUX', 'MMONCEAUX', NULL);
INSERT INTO `les_usagers` VALUES (23818, 'Monsieur', 'ANSART', '', '66 Avenue de Paris\r\n\r\n53940   ST BERTHEVIN', '02-43-01-24-24', '', '', 'http://', 'ma', 0x323030362d30352d3232, 0x323030362d30362d32392031333a33343a3531, 3, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ANSART', 'ANSART', NULL);
INSERT INTO `les_usagers` VALUES (23819, 'Monsieur', 'ROISIL', 'Florent', 'LA GRANDE DURIERE\n\n53240   ANDOUILLE', '06-32-68-94-52', '', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_FROISIL', 'FROISIL', NULL);
INSERT INTO `les_usagers` VALUES (23821, 'Monsieur', 'GAUTIER', 'Anthony', 'ZI des nochetieres\n\n53600   EVRON', '02-43-01-36-74', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'AGAUTIER', 'AGAUTIER', NULL);
INSERT INTO `les_usagers` VALUES (23822, 'Monsieur', 'THION', 'Thomas', '5 rue des coevrons\n\n53600   SAINT-GEORGES-SUR-ERVE', '', '06-71-28-76-49', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_TTHION', 'TTHION', NULL);
INSERT INTO `les_usagers` VALUES (23824, 'Monsieur', 'PARIS', 'Christian', 'LA COUR CHALMEL\n\n61600   MAGNY-LE-DESERT', '02-33-37-72-45', '', '', '', 'ma', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CPARIS', 'CPARIS', NULL);
INSERT INTO `les_usagers` VALUES (23825, 'Monsieur', 'THOMMERET', '', '4 RUE DES VALLES\n\n53300   CHANTRIGNE', '02-43-00-82-67', '06-16-31-48-38', '', '', 'rl', 0x323030362d30352d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'THOMMERET', 'THOMMERET', NULL);
INSERT INTO `les_usagers` VALUES (23827, 'Monsieur', 'BAZIN', 'MAXIME', 'L''industrie\r\n53200\r\nAMPOIGNE', '02.43.70.03.36', '', '', '', 'app', 0x323030362d30352d3232, 0x323030362d30352d32332031313a35303a3034, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MAXIME_BAZIN', '6vBmBc', NULL);
INSERT INTO `les_usagers` VALUES (23828, 'Monsieur', 'LE BOUCHER', 'Alain', '67 avenue de la Verrerie\n\n35300   FOUGERES', '02-99-99-83-00', '', '', '', 'ma', 0x323030362d30352d3234, 0x323030362d30372d30352031353a33343a3533, 5, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ALBOUCHER', 'ALBOUCHER', NULL);
INSERT INTO `les_usagers` VALUES (23829, 'Mademoiselle', 'BEURDOUCHE', 'Fanny', '3 rue de la Dorangerie\n\n35300   FOUGERES', '06-22-31-69-42', '', '', '', 'rl', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_FBEURDOUCHE', 'FBEURDOUCHE', NULL);
INSERT INTO `les_usagers` VALUES (23830, 'Mademoiselle', 'BEURDOUCHE', 'Fanny', '3 rue de la Dorangerie\r\n\r\n35300   FOUGERES', '06-22-31-69-42', '', '', '', 'app', 0x323030362d30352d3234, 0x323030362d30392d31322032313a33393a3433, 14, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FBEURDOUCHE', 'FBEURDOUCHE', NULL);
INSERT INTO `les_usagers` VALUES (23831, 'Monsieur', 'HOCDE', 'Benoit', 'Les trois Carrières\n\n53260   ENTRAMMES', '02-43-98-32-18', '', '', '', 'ma', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'BHOCDE', 'BHOCDE', NULL);
INSERT INTO `les_usagers` VALUES (23832, 'Madame', 'BOUCHER', 'Catherine', '23 rue des Roches\n\n53260   PARNE-SUR-ROC', '02-43-98-34-18', '', '', '', 'rl', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CBOUCHER', 'CBOUCHER', NULL);
INSERT INTO `les_usagers` VALUES (23833, 'Monsieur', 'BOUCHER', 'Mickaël', '23 rue des Roches\n\n53260   PARNE-SUR-ROC', '02-43-98-34-18', '', '', '', 'app', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MBOUCHER', 'MBOUCHER', NULL);
INSERT INTO `les_usagers` VALUES (23834, 'Monsieur', 'GOUPIL', 'ANTOINE', '10 rue Réaumur\n\n53100   MAYENNE', '02-43-04-44-31', '', '', '', 'ma', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'AGOUPIL', 'AGOUPIL', NULL);
INSERT INTO `les_usagers` VALUES (23835, 'Monsieur', 'BOUIN', 'Claude', '4 impasse des Cerisiers\n\n53300   SAINT-FRAIMBAULT-DE-PRIERES', '02-43-00-25-16', '', '', '', 'rl', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CBOUIN', 'CBOUIN', NULL);
INSERT INTO `les_usagers` VALUES (23836, 'Monsieur', 'BOUIN', 'Guillaume', '4 impasse des Cerisiers\n\n53300   SAINT-FRAIMBAULT-DE-PRIERES', '02-43-00-25-16', '', '', '', 'app', 0x323030362d30352d3234, 0x323030362d30352d33312031343a30313a3438, 1, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GBOUIN', 'GBOUIN', NULL);
INSERT INTO `les_usagers` VALUES (23837, 'Monsieur', 'MURY', 'LOIC', 'ZA de la Hainaud\n\n53500   ERNEE', '02-43-05-83-73', '', '', '', 'ma', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'LMURY', 'LMURY', NULL);
INSERT INTO `les_usagers` VALUES (23838, 'Monsieur', 'COULANGE', 'Georges', '4 rue Alfred Jarry\n\n53500   ERNEE', '02-43-05-17-57', '', '', '', 'rl', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GCOULANGE', 'GCOULANGE', NULL);
INSERT INTO `les_usagers` VALUES (23839, 'Monsieur', 'COULANGE', 'Brice', '4 rue Alfred Jarry\n\n53500   ERNEE', '02-43-05-17-57', '', '', '', 'app', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'BCOULANGE', 'BCOULANGE', NULL);
INSERT INTO `les_usagers` VALUES (23840, 'Monsieur', 'GELU', 'Mickaël', '11, rue Letort\n\n53390   ST AIGNAN S/ROE', '02-43-06-51-68', '', '', '', 'ma', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MGELU', 'MGELU', NULL);
INSERT INTO `les_usagers` VALUES (23841, 'Monsieur', 'DUS', 'Sante', 'La Gare\n\n53800   LA SELLE-CRAONNAISE', '02-43-06-38-91', '', '', '', 'rl', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SDUS', 'SDUS', NULL);
INSERT INTO `les_usagers` VALUES (23842, 'Monsieur', 'DUS', 'Teddy', 'La Gare\n\n53800   LA SELLE-CRAONNAISE', '02-43-06-38-91', '', '', '', 'app', 0x323030362d30352d3234, 0x323030362d30352d33312031353a33363a3332, 3, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'TDUS', 'TDUS', NULL);
INSERT INTO `les_usagers` VALUES (23843, 'Monsieur', 'BROUX', 'Eric', 'TIVOLI route de Laval\n\n53810   CHANGE', '02-43-59-72-72', '', '', '', 'ma', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'EBROUX', 'EBROUX', NULL);
INSERT INTO `les_usagers` VALUES (23844, 'Monsieur', 'FEVRIER', '', '10 Impasse St.Anne\n\n53600   EVRON', '02-43-01-34-51', '', '', '', 'rl', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FEVRIER', 'FEVRIER', NULL);
INSERT INTO `les_usagers` VALUES (23845, 'Monsieur', 'FEVRIER', 'Kévin', '10 Impasse St.Anne\n\n53600   EVRON', '02-43-01-34-51', '', '', '', 'app', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'KFEVRIER', 'KFEVRIER', NULL);
INSERT INTO `les_usagers` VALUES (23846, 'Monsieur', 'METAYER', 'Arsène', 'Le Bas Mesnil\n\n35240   MARCILLE-ROBERT', '02-99-43-58-28', '', '', '', 'ma', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'AMETAYER', 'AMETAYER', NULL);
INSERT INTO `les_usagers` VALUES (23847, 'Monsieur', 'FLASQUIN', 'Mickaël', '1 rue des Tulipiers\n\n35130   LA GUERCHE-DE-BRETAGNE', '02-99-96-08-12', '', '', '', 'rl', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_MFLASQUIN', 'MFLASQUIN', NULL);
INSERT INTO `les_usagers` VALUES (23848, 'Monsieur', 'FLASQUIN', 'Mickaël', '1 rue des Tulipiers\n\n35130   LA GUERCHE-DE-BRETAGNE', '02-99-96-08-12', '', '', '', 'app', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MFLASQUIN', 'MFLASQUIN', NULL);
INSERT INTO `les_usagers` VALUES (23849, 'Monsieur', 'COTTEVERTE', 'Stéphane', '60 rue de la Gare\n\n53400   CRAON', '02-43-07-83-06', '', '', '', 'ma', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SCOTTEVERTE', 'SCOTTEVERTE', NULL);
INSERT INTO `les_usagers` VALUES (23850, 'Monsieur', 'GENDRY', 'Gérard', 'La Guesnière\n\n53200   LAIGNE', '02-43-70-43-05', '', '', '', 'rl', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GGENDRY', 'GGENDRY', NULL);
INSERT INTO `les_usagers` VALUES (23851, 'Mademoiselle', 'GENDRY', 'Pauline', 'La Guesnière\n\n53200   LAIGNE', '02-43-70-43-05', '', '', '', 'app', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PGENDRY', 'PGENDRY', NULL);
INSERT INTO `les_usagers` VALUES (23852, 'Monsieur', 'CAILLEBOTTE', 'Christian', '1147 rue de la Peyennière\n\n53100   MAYENNE', '02-43-00-42-41', '', '', '', 'ma', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CCAILLEBOTTE', 'CCAILLEBOTTE', NULL);
INSERT INTO `les_usagers` VALUES (23853, 'Madame', 'HELARD', 'Elisabeth', '2 Résidence des Rochettes\n\n53470   MARTIGNE-SUR-MAYENNE', '02-43-26-38-17', '', '', '', 'rl', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'EHELARD', 'EHELARD', NULL);
INSERT INTO `les_usagers` VALUES (23854, 'Monsieur', 'HELARD', 'Florian', '2 Résidence des Rochettes\n\n53470   MARTIGNE-SUR-MAYENNE', '02-43-26-38-17', '', '', '', 'app', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FHELARD', 'FHELARD', NULL);
INSERT INTO `les_usagers` VALUES (23855, 'Monsieur', 'HOUSSIN', 'Jérémy', '16 route de Laval\n\n53200   AZE', '02-43-07-16-26', '', '', '', 'ma', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JHOUSSIN', 'JHOUSSIN', NULL);
INSERT INTO `les_usagers` VALUES (23856, 'Monsieur', 'LEROUX', 'Jean Yves', '2 rue des Chênes\n\n53200   GENNES-SUR-GLAIZE', '02-43-70-07-47', '', '', '', 'rl', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JYLEROUX', 'JYLEROUX', NULL);
INSERT INTO `les_usagers` VALUES (23857, 'Monsieur', 'LEROUX', 'Anthony', '2 rue des Chênes\n\n53200   GENNES-SUR-GLAIZE', '02-43-70-07-47', '', '', '', 'app', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ALEROUX', 'ALEROUX', NULL);
INSERT INTO `les_usagers` VALUES (23858, 'Monsieur', 'HUCHEDE', 'PATRICK', '10 Rue R Gleton\n\n53480   VAIGES', '02-43-90-21-91', '', '', '', 'ma', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PHUCHEDE', 'PHUCHEDE', NULL);
INSERT INTO `les_usagers` VALUES (23859, 'Monsieur', 'LOYAU', 'Thomas', '12 lotissement du Prieuré\n\n53170   BAZOUGERS', '02-43-02-39-44', '', '', '', 'app', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'TLOYAU', 'TLOYAU', NULL);
INSERT INTO `les_usagers` VALUES (23860, 'Monsieur', 'PINÇON', 'Jean Louis', '41, Rue de Saint Denis\n\n53500   ERNEE', '02-43-05-10-07', '', '', '', 'ma', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JLPINÇON', 'JLPINÇON', NULL);
INSERT INTO `les_usagers` VALUES (23861, 'Monsieur', 'MULOT', 'Jean Yves', '10 Chemin du Fay\n\n53500   ERNEE', '02-43-05-77-71', '', '', '', 'rl', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JYMULOT', 'JYMULOT', NULL);
INSERT INTO `les_usagers` VALUES (23862, 'Monsieur', 'MULOT', 'Alexis', '10 Chemin du Fay\n\n53500   ERNEE', '02-43-05-77-71', '', '', '', 'app', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'AMULOT', 'AMULOT', NULL);
INSERT INTO `les_usagers` VALUES (23863, 'Monsieur', 'JOUENNE', 'Loïc', '43 rue du Bourny\n\n53003   LAVAL CEDEX', '02-43-68-16-16', '', '', '', 'ma', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'LJOUENNE', 'LJOUENNE', NULL);
INSERT INTO `les_usagers` VALUES (23864, 'Monsieur', 'FOUILLEUL', 'JOEL', 'Rue du Trianon\n\n53410   LE BOURGNEUF LA FORET', '02-43-37-10-03', '', '', '', 'ma', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JFOUILLEUL', 'JFOUILLEUL', NULL);
INSERT INTO `les_usagers` VALUES (23865, 'Monsieur', 'TAUNEL', 'Martine', '9 rue de la Mauvière\n\n53410   SAINT-PIERRE-LA-COUR', '', '', '', '', 'rl', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MTAUNEL', 'MTAUNEL', NULL);
INSERT INTO `les_usagers` VALUES (23866, 'Mademoiselle', 'TEILLAS', 'Jessy', '9 rue de la Mauvière\n\n53410   SAINT-PIERRE-LA-COUR', '', '', '', '', 'app', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JTEILLAS', 'JTEILLAS', NULL);
INSERT INTO `les_usagers` VALUES (23867, 'Monsieur', 'DAVOUST', 'Marcel', 'Le Bourg\n\n53270   CHAMMES', '02-43-01-44-17', '', '', '', 'ma', 0x323030362d30352d3234, 0x323030362d30382d32352031353a32393a3139, 1, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MDAVOUST', 'MDAVOUST', NULL);
INSERT INTO `les_usagers` VALUES (23868, 'Monsieur', 'MONCEAU', 'André', '97 Bd de la Grande Valaisière\n\n53600   EVRON', '02-43-01-65-93', '', '', '', 'rl', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'AMONCEAU', 'AMONCEAU', NULL);
INSERT INTO `les_usagers` VALUES (23869, 'Monsieur', 'MONCEAU', 'Steven', '97 Bd de la Grande Valaisière\r\n\r\n53600   EVRON', '02-43-01-65-93', '', '', '', 'app', 0x323030362d30352d3234, 0x323030362d30392d30312031373a32333a3033, 4, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SMONCEAU', 'SMONCEAU', NULL);
INSERT INTO `les_usagers` VALUES (23870, 'Monsieur', 'MOREAU', 'Pierrick', 'ZI La Carie\n\n53210   ARGENTRE', '02-43-37-82-26', '', '', '', 'ma', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PMOREAU', 'PMOREAU', NULL);
INSERT INTO `les_usagers` VALUES (23871, 'Monsieur', 'MOREAU', 'Pierrick', '10 rue des Genêts\n\n53210   ARGENTRE', '02-43-37-38-15', '', '', '', 'rl', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PMOREAU', 'PMOREAU', NULL);
INSERT INTO `les_usagers` VALUES (23872, 'Monsieur', 'MOREAU', 'Damien', '10 rue des Genêts\n\n53210   ARGENTRE', '02-43-37-38-15', '', '', '', 'app', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DMOREAU', 'DMOREAU', NULL);
INSERT INTO `les_usagers` VALUES (23873, 'Monsieur', 'CHEMINEAU', 'Didier', '10 rue Réaumur\n\n53100   MAYENNE', '02-43-04-44-31', '', '', '', 'ma', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DCHEMINEAU', 'DCHEMINEAU', NULL);
INSERT INTO `les_usagers` VALUES (23874, 'Monsieur', 'PRIMAUX', 'Joël', '1 impasse les Ponceaux\n\n53300   ST FRAIMBAULT DE PRIERES', '06-15-82-64-36', '', '', '', 'rl', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JPRIMAUX', 'JPRIMAUX', NULL);
INSERT INTO `les_usagers` VALUES (23875, 'Monsieur', 'PRIMAUX', 'Arnaud', '1 impasse les Ponceaux\n\n53300   ST FRAIMBAULT DE PRIERES', '06-15-82-64-36', '', '', '', 'app', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'APRIMAUX', 'APRIMAUX', NULL);
INSERT INTO `les_usagers` VALUES (23876, 'Monsieur', 'MAUGERE', 'HERVE', 'ZA DES DAHINIERES\n\n53810   CHANGE', '02-43-69-60-36', '', '', '', 'ma', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'HMAUGERE', 'HMAUGERE', NULL);
INSERT INTO `les_usagers` VALUES (23877, 'Monsieur', 'SOUVESTRE', 'Yannick', '3 rue du Pavement\n\n53000   LAVAL', '', '', '', '', 'rl', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'YSOUVESTRE', 'YSOUVESTRE', NULL);
INSERT INTO `les_usagers` VALUES (23878, 'Monsieur', 'SOUVESTRE', 'Julien', '3 rue du Pavement\n\n53000   LAVAL', '', '', '', '', 'app', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JSOUVESTRE', 'JSOUVESTRE', NULL);
INSERT INTO `les_usagers` VALUES (23879, 'Monsieur', 'DESMAIRES', 'PATRICK', 'Route de Fougères\n\n53120   LEVARE', '02-43-08-49-61', '', '', '', 'ma', 0x323030362d30352d3234, 0x323030362d30382d32352031353a30323a3434, 1, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PDESMAIRES', 'PDESMAIRES', NULL);
INSERT INTO `les_usagers` VALUES (23880, 'Madame', 'AZE-BELLANGER', 'Régine', '24 rue des Sports\n\n53210   ARGENTRE', '06-70-49-02-11', '', '', '', 'rl', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'RAZE-BELLANGER', 'RAZE-BELLANGER', NULL);
INSERT INTO `les_usagers` VALUES (23881, 'Monsieur', 'AZE', 'Pierre-Louis', '24 rue des Sports\n\n53210   ARGENTRE', '06-70-49-02-11', '', '', '', 'app', 0x323030362d30352d3234, 0x323030362d30382d32352031353a30313a3236, 1, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PAZE', 'PAZE', NULL);
INSERT INTO `les_usagers` VALUES (23882, 'Monsieur', 'DOUDARD', 'XAVIER DIDIER', '28 quai Carnot\n\n53100   MAYENNE', '02-43-00-97-62', '', '', '', 'ma', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'XDDOUDARD', 'XDDOUDARD', NULL);
INSERT INTO `les_usagers` VALUES (23883, 'Madame', 'QUERRU', 'Lucienne', '51 rue Saint Martin\n\n53100   MAYENNE', '06-68-30-55-22', '', '', '', 'rl', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'LQUERRU', 'LQUERRU', NULL);
INSERT INTO `les_usagers` VALUES (23884, 'Mademoiselle', 'GUEDON', 'Noémie', '51 rue Saint Martin\n\n53100   MAYENNE', '06-68-30-55-22', '', '', '', 'app', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'NGUEDON', 'NGUEDON', NULL);
INSERT INTO `les_usagers` VALUES (23885, 'Monsieur', 'PLARD', 'BERNARD', 'Route de Sablé\n\n53290   GREZ EN BOUERE', '02-43-70-62-06', '', '', '', 'ma', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'BPLARD', 'BPLARD', NULL);
INSERT INTO `les_usagers` VALUES (23886, 'Monsieur', 'JAHIER', 'Pascal', 'Les Penellières\n\n53290   GREZ-EN-BOUERE', '02-43-70-08-87', '', '', '', 'rl', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PJAHIER', 'PJAHIER', NULL);
INSERT INTO `les_usagers` VALUES (23887, 'Mademoiselle', 'DOUDARD', 'Anne Gaëlle', 'CFA 3 Villes\r\nUNITE Bâtiment', '', '', '', '', 'ens', 0x323030362d30352d3234, 0x323030362d30362d30352032303a33343a3136, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Anne_Ga_lle_DOUDARD', '3MJ9Ba', NULL);
INSERT INTO `les_usagers` VALUES (23888, 'Monsieur', 'JAHIER', 'Anthony', 'Les Penellières\n\n53290   GREZ-EN-BOUERE', '02-43-70-08-87', '', '', '', 'app', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'AJAHIER', 'AJAHIER', NULL);
INSERT INTO `les_usagers` VALUES (23889, 'Monsieur', 'BLIN', 'Michel', 'Les Maisons Neuves\n\n53410   BOURGON', '02-43-01-83-85', '', '', '', 'ma', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MBLIN', 'MBLIN', NULL);
INSERT INTO `les_usagers` VALUES (23890, 'Monsieur', 'LAUNAY', 'Roger', 'Valnéau\n\n53380   JUVIGNE', '02-43-68-50-50', '', '', '', 'rl', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'RLAUNAY', 'RLAUNAY', NULL);
INSERT INTO `les_usagers` VALUES (23891, 'Monsieur', 'LAUNAY', 'Ludovic', 'Valnéau\n\n53380   JUVIGNE', '02-43-68-50-50', '', '', '', 'app', 0x323030362d30352d3234, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'LLAUNAY', 'LLAUNAY', NULL);
INSERT INTO `les_usagers` VALUES (23892, 'Madame', 'GOSNET', 'Florence', 'à saisir', '', '', '', '', 'ens', 0x323030362d30352d3234, 0x323030362d30362d33302031363a30383a3438, 3, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FGOSNET', '123456', NULL);
INSERT INTO `les_usagers` VALUES (23894, 'Monsieur', 'BODET', 'Mickaël', 'x', '', '', '', '', 'ens', 0x323030362d30352d3331, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MBODET', '123456', NULL);
INSERT INTO `les_usagers` VALUES (23895, 'Madame', 'GAUTIER', 'Nadine', 'CFA 3 Villes\r\nUNITE Bâtiment', '', '', '', 'http://', 'ens', 0x323030362d30352d3331, 0x323030362d30362d30352032303a33383a3130, 1, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Nadine_GAUTIER', 'AGdKde', NULL);
INSERT INTO `les_usagers` VALUES (23896, 'Monsieur', 'LEFEVRE', 'Alain', 'CFA 3 Villes\r\nUNITE Bâtiment', '', '', '', '', 'ens', 0x323030362d30352d3331, 0x323030362d30362d30352032303a34323a3135, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Alain_LEFEVRE', 'V237Ja', NULL);
INSERT INTO `les_usagers` VALUES (23897, 'Madame', 'MAREAU', 'Nadia', 'CFA 3 Villes\r\nUNITE Bâtiment', '', '', '', '', 'ens', 0x323030362d30352d3331, 0x323030362d30362d30352032303a34333a3034, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'Nadia_MAREAU', 'sdRRqn', NULL);
INSERT INTO `les_usagers` VALUES (23898, 'Madame', 'DUCLOS-LEBLANC', 'Stéphanie', 'CFA 3 Villes\r\nUNITE Bâtiment', '', '', '', '', 'ens', 0x323030362d30352d3331, 0x323030362d30362d30352032303a33373a3133, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'St_phanie_DUCLOS-LEBLANC', 'BbV7Sd', NULL);
INSERT INTO `les_usagers` VALUES (23899, 'Monsieur', 'BLATIER', 'YVES', '2 CA DU LANDREAU\n\n49070   BEAUCOUZE', '02-41-73-23-73', '', '', '', 'ma', 0x323030362d30362d3036, 0x323030362d30392d31332031303a32353a3435, 6, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'YBLATIER', 'YBLATIER', NULL);
INSERT INTO `les_usagers` VALUES (23900, 'Monsieur', 'ATTMANI', 'Mohamed', '4 rue Gagarine\n\n49000   ANGERS', '06-87-87-87-09', '', '', '', 'rl', 0x323030362d30362d3036, 0x323030362d30362d32302031353a33393a3234, 1, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_MATTMANI', 'MATTMANI', NULL);
INSERT INTO `les_usagers` VALUES (23901, 'Monsieur', 'ATTMANI', 'Mohamed', '4 rue Gagarine\r\n\r\n49000   ANGERS', '06-87-87-87-09', '', '', 'http://', 'app', 0x323030362d30362d3036, 0x323030362d30392d31332031313a32313a3135, 33, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MATTMANI', 'MATTMANI', 'img_accueil_23901_img_accueil_20867_portail.jpeg');
INSERT INTO `les_usagers` VALUES (23902, 'Madame', 'BODI', 'Françoise', '8  rue Agatha Christie\n\n49000   ANGERS', '02-72-73-34-69', '', '', '', 'rl', 0x323030362d30362d3036, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FBODI', 'FBODI', NULL);
INSERT INTO `les_usagers` VALUES (23903, 'Monsieur', 'BODI', 'Matthieu', '8  rue Agatha Christie\n\n49000   ANGERS', '02-72-73-34-69', '', '', '', 'app', 0x323030362d30362d3036, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MBODI', 'MBODI', NULL);
INSERT INTO `les_usagers` VALUES (23904, 'Monsieur', 'OTT', 'Antoin', 'ZI LA VIOLETTE    BP 72\n\n49240   AVRILLE', '02-41-69-27-93', '', '', '', 'ma', 0x323030362d30362d3036, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'AOTT', 'AOTT', NULL);
INSERT INTO `les_usagers` VALUES (23905, 'Madame', 'BORIE - GUIHEUX', 'Véronique', 'LA REAUTE\n\n49460   FENEU', '02-41-32-26-53', '', '', '', 'rl', 0x323030362d30362d3036, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'VBGUIHEUX', 'VBGUIHEUX', NULL);
INSERT INTO `les_usagers` VALUES (23906, 'Monsieur', 'LEBORGNE', 'Samuel', '\n\n', '', '', '', '', 'ens', 0x323030362d30362d3036, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SLEBORGNE', 'SLEBORGNE', NULL);
INSERT INTO `les_usagers` VALUES (23907, 'Monsieur', 'BORIE', 'Mickaël', 'LA REAUTE\n\n49460   FENEU', '02-41-32-26-53', '', '', '', 'app', 0x323030362d30362d3036, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MBORIE', 'MBORIE', NULL);
INSERT INTO `les_usagers` VALUES (23908, 'Monsieur', 'MARION', 'Michel', 'ZI LA VIOLETTE    BP 72\n\n49240   AVRILLE', '02-41-69-27-93', '', '', '', 'ma', 0x323030362d30362d3036, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MMARION', 'MMARION', NULL);
INSERT INTO `les_usagers` VALUES (23909, 'Madame', 'GALLET', 'Béatrice', '3 rue de Champagne\n\n49000   ANGERS', '02-41-60-46-96', '', '', '', 'rl', 0x323030362d30362d3036, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'BGALLET', 'BGALLET', NULL);
INSERT INTO `les_usagers` VALUES (23910, 'Monsieur', 'GALLET', 'Mickaël', '3 rue de Champagne\n\n49000   ANGERS', '02-41-60-46-96', '', '', '', 'app', 0x323030362d30362d3036, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MGALLET', 'MGALLET', NULL);
INSERT INTO `les_usagers` VALUES (23911, 'Monsieur', 'SORIN', 'Thierry', '8 Route de Sablé\n\n53200   CHATEAU GONTIER', '02-43-09-12-12', '', '', '', 'ma', 0x323030362d30362d3036, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'TSORIN', 'TSORIN', NULL);
INSERT INTO `les_usagers` VALUES (23912, 'Monsieur', 'GUILLET', 'Pascal', '107 rue de la Chalouère\n\n49000   ANGERS', '06-72-45-21-63', '06-98-23-16-18', '', '', 'rl', 0x323030362d30362d3036, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PGUILLET', 'PGUILLET', NULL);
INSERT INTO `les_usagers` VALUES (23913, 'Mademoiselle', 'GUILLET', 'Sabrina', '107 rue de la Chalouère\n\n49000   ANGERS', '06-72-45-21-63', '06-98-23-16-18', '', '', 'app', 0x323030362d30362d3036, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SGUILLET', 'SGUILLET', NULL);
INSERT INTO `les_usagers` VALUES (23914, 'Monsieur', 'GUYON', 'JEAN PIERRE', 'ZA DE LA CHAMBROUILLERE\n\n53960   BONCHAMP LES LAVAL', '02-43-53-02-30', '', '', '', 'ma', 0x323030362d30362d3036, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JPGUYON', 'JPGUYON', NULL);
INSERT INTO `les_usagers` VALUES (23915, 'Madame', 'HEGY', 'SYLVIANE', 'CHEZ Mme BLANDIN ANNICK\n\n53000   LAVAL', '02-43-67-14-20', '', '', '', 'rl', 0x323030362d30362d3036, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SHEGY', 'SHEGY', NULL);
INSERT INTO `les_usagers` VALUES (23916, 'Monsieur', 'HEGY', 'Teddy', 'CHEZ Mme BLANDIN ANNICK\n\n53000   LAVAL', '02-43-67-14-20', '', '', '', 'app', 0x323030362d30362d3036, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'THEGY', 'THEGY', NULL);
INSERT INTO `les_usagers` VALUES (23917, 'Monsieur', 'ORION', 'Jean Pierre', '2 Square de Touraine\n\n49000   ANGERS', '06-14-45-29-99', '', '', '', 'rl', 0x323030362d30362d3036, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JPORION', 'JPORION', NULL);
INSERT INTO `les_usagers` VALUES (23918, 'Monsieur', 'ORION', 'David', '2 Square de Touraine\n\n49000   ANGERS', '06-14-45-29-99', '', '', '', 'app', 0x323030362d30362d3036, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DORION', 'DORION', NULL);
INSERT INTO `les_usagers` VALUES (23919, 'Monsieur', 'POIRIER', 'Pascal', '15 rue de la Gibaudière\n\n49124   SAINT-BARTHELEMY-D ANJOU', '02-41-43-96-96', '', '', '', 'ma', 0x323030362d30362d3036, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PPOIRIER', 'PPOIRIER', NULL);
INSERT INTO `les_usagers` VALUES (23920, 'Monsieur', 'GRELET', 'Pierre', 'ZI de Pierre Brune\n\n85110   CHANTONNAY', '02-51-48-54-54', '', '', '', 'ma', 0x323030362d30362d3036, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PGRELET', 'PGRELET', NULL);
INSERT INTO `les_usagers` VALUES (23921, 'Monsieur', 'BONNEAU', 'ADRIEN', '18 Cité du Beugnon\n\n85700   REAUMUR', '02-51-57-93-25', '', '', '', 'rl', 0x323030362d30362d3036, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_ABONNEAU', 'ABONNEAU', NULL);
INSERT INTO `les_usagers` VALUES (23922, 'Monsieur', 'BONNEAU', 'Adrien', '18 Cité du Beugnon\n\n85700   REAUMUR', '02-51-57-93-25', '', '', '', 'app', 0x323030362d30362d3036, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ABONNEAU', 'ABONNEAU', NULL);
INSERT INTO `les_usagers` VALUES (23923, 'Monsieur', 'BUREAU', 'Vincent', '2 rue des Quatres Vents\n\n85190   LA GENETOUZE', '02-51-34-80-74', '', '', '', 'rl', 0x323030362d30362d3036, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'VBUREAU', 'VBUREAU', NULL);
INSERT INTO `les_usagers` VALUES (23924, 'Monsieur', 'BUREAU', 'Pierre-Alexandre', '2 rue des Quatres Vents\n\n85190   LA GENETOUZE', '02-51-34-80-74', '', '', '', 'app', 0x323030362d30362d3036, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PBUREAU', 'PBUREAU', NULL);
INSERT INTO `les_usagers` VALUES (23925, 'Monsieur', 'JULIOT', 'Didier', '1 rue du Pont - BP 53\n\n72300   SABLE SUR SARTHE', '02-43-95-10-65', '', '', '', 'ma', 0x323030362d30362d3036, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DJULIOT', 'DJULIOT', NULL);
INSERT INTO `les_usagers` VALUES (23926, 'Monsieur', 'LAUNAY', 'PASCAL', 'LE HAUT BOURG\n\n53940   LE GENEST ST ISLE', '02-43-26-24-70', '', '', '', 'ma', 0x323030362d30362d3036, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PLAUNAY', 'PLAUNAY', NULL);
INSERT INTO `les_usagers` VALUES (23927, 'Monsieur', 'LAUNAY', 'Frédéric', '38 rue Jean Mermoz\n\n53000   LAVAL', '06-22-33-95-02', '', '', '', 'rl', 0x323030362d30362d3036, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_FLAUNAY', 'FLAUNAY', NULL);
INSERT INTO `les_usagers` VALUES (23928, 'Monsieur', 'DAVID', '', '5 Rue de la Gibaudière\n\n49124   SAINT-BARTHELEMY-D ANJOU', '02-41-60-02-00', '', '', '', 'ma', 0x323030362d30362d3036, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DAVID', 'DAVID', NULL);
INSERT INTO `les_usagers` VALUES (23929, 'Monsieur', 'PAPIN', 'Jérémy', '49 rue Edouard Vaillant\n\n49800   TRELAZE', '02-41-69-95-71', '', '', '', 'rl', 0x323030362d30362d3036, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_JPAPIN', 'JPAPIN', NULL);
INSERT INTO `les_usagers` VALUES (23930, 'Monsieur', 'PAPIN', 'Jérémy', '49 rue Edouard Vaillant\n\n49800   TRELAZE', '02-41-69-95-71', '', '', '', 'app', 0x323030362d30362d3036, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JPAPIN', 'JPAPIN', NULL);
INSERT INTO `les_usagers` VALUES (23931, 'Monsieur', 'MORTIER', 'Stéphane', 'ZA DE LA CHALOPINIERE\n\n53170   MESLAY DU MAINE', '02-43-98-74-12', '', '', '', 'ma', 0x323030362d30362d3036, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SMORTIER', 'SMORTIER', NULL);
INSERT INTO `les_usagers` VALUES (23932, 'Monsieur', 'PICHON', 'Eugene', '7 allée de la Vaige\n\n53170   MESLAY DU MAINE', '02-43-98-47-25', '', '', '', 'rl', 0x323030362d30362d3036, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'EPICHON', 'EPICHON', NULL);
INSERT INTO `les_usagers` VALUES (23933, 'Monsieur', 'PICHON', 'Jovanny', '7 allée de la Vaige\n\n53170   MESLAY DU MAINE', '02-43-98-47-25', '', '', '', 'app', 0x323030362d30362d3036, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JPICHON', 'JPICHON', NULL);
INSERT INTO `les_usagers` VALUES (23934, 'Monsieur', 'dd', 'dd', 'dd', '', '', '', '', 'app', 0x323030362d30362d3239, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'dddddd', 'dddddd', NULL);
INSERT INTO `les_usagers` VALUES (23935, 'Monsieur', 'PAPOUIN', 'jacky', 'x', '', '', '', '', 'ens', 0x323030362d30372d3037, 0x323030362d30392d30382031383a32353a3233, 2, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'jPAPOUIN', '123456', NULL);
INSERT INTO `les_usagers` VALUES (23936, 'Monsieur', 'JOLIFF', 'Robert', '63 Rue ROMAIN DESFOSSES\n\n29200   BREST', '02-98-41-01-01', '', '', '', 'ma', 0x323030362d30392d3133, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'RJOLIFF', 'RJOLIFF', NULL);
INSERT INTO `les_usagers` VALUES (23937, 'Monsieur', 'BRUNET', 'Cédric', '6 Allée des Houx\n\n29280   PLOUZANE', '', '', '', '', 'rl', 0x323030362d30392d3133, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_CBRUNET', 'CBRUNET', NULL);
INSERT INTO `les_usagers` VALUES (23938, 'Monsieur', 'BRUNET', 'Cédric', '6 Allée des Houx\n\n29280   PLOUZANE', '', '', '', 'http://', 'app', 0x323030362d30392d3133, 0x323030362d30392d32322030383a33353a3539, 2, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CBRUNET', '34toenescom', NULL);
INSERT INTO `les_usagers` VALUES (23939, 'Monsieur', 'PRUNIER', 'STEPHANE', 'ZA AMBROISE PARE\n\n53500   ERNEE', '02-43-05-83-92', '', '', '', 'ma', 0x323030362d30392d3133, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SPRUNIER', 'SPRUNIER', NULL);
INSERT INTO `les_usagers` VALUES (23940, 'Monsieur', 'FOUCHET', 'Christian', '62 rue de la Libération\n\n53500   ST PIERRE DES LANDES', '02-43-05-90-22', '', '', '', 'rl', 0x323030362d30392d3133, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CFOUCHET', 'CFOUCHET', NULL);
INSERT INTO `les_usagers` VALUES (23941, 'Monsieur', 'FOUCHET', 'Yvan', '62 rue de la Libération\n\n53500   ST PIERRE DES LANDES', '02-43-05-90-22', '', '', 'http://', 'app', 0x323030362d30392d3133, 0x323030362d30392d32312030383a32313a3332, 1, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'YFOUCHET', 'YFOUCHET', NULL);
INSERT INTO `les_usagers` VALUES (23942, 'Monsieur', 'HACHET', 'REMY', '5 rue Marcelin Berthelot\n\n53012   LAVAL CEDEX', '02-43-53-52-53', '', '', '', 'ma', 0x323030362d30392d3133, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'RHACHET', 'RHACHET', NULL);
INSERT INTO `les_usagers` VALUES (23943, 'Monsieur', 'GORGUIS', 'Raif', '50 rue Fabre d''Eglantine\n\n53810   CHANGE', '02-43-49-22-49', '06-08-78-90-17', '', '', 'rl', 0x323030362d30392d3133, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'RGORGUIS', 'RGORGUIS', NULL);
INSERT INTO `les_usagers` VALUES (23944, 'Monsieur', 'GORGUIS', 'Freddy', '50 rue Fabre d''Eglantine\n\n53810   CHANGE', '02-43-49-22-49', '06-08-78-90-17', '', 'http://', 'app', 0x323030362d30392d3133, 0x323030362d30392d32312030393a31363a3438, 2, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FGORGUIS', 'FGORGUIS', NULL);
INSERT INTO `les_usagers` VALUES (23945, 'Monsieur', 'GITEAU', 'Jacky', 'ZI DU FRESNE\n\n53170   MESLAY-DU-MAINE', '02-43-98-74-12', '', '', '', 'ma', 0x323030362d30392d3133, 0x323030362d30392d32352031333a34363a3532, 16, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JGITEAU', 'JGITEAU', NULL);
INSERT INTO `les_usagers` VALUES (23946, 'Monsieur', 'LOCHIN', 'Eric', '2 impasse des Vanniers\n\n53260   ENTRAMMES', '02-43-98-31-97', '06-32-58-14-46', '', '', 'rl', 0x323030362d30392d3133, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ELOCHIN', 'ELOCHIN', NULL);
INSERT INTO `les_usagers` VALUES (23947, 'Monsieur', 'LOCHIN', 'Anthony', '2 impasse des Vanniers\n\n53260   ENTRAMMES', '02-43-98-31-97', '06-32-58-14-46', '', 'http://', 'app', 0x323030362d30392d3133, 0x323030362d30392d32322031383a35313a3338, 12, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ALOCHIN', 'ALOCHIN', 'img_accueil_23947_Triangle.jpg');
INSERT INTO `les_usagers` VALUES (23948, 'Monsieur', 'BARRIDAS', 'Philippe', '1, Place de l''Eglise\n\n53410   LAUNAY-VILLIERS', '02-43-37-50-39', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PBARRIDAS', 'PBARRIDAS', NULL);
INSERT INTO `les_usagers` VALUES (23949, 'Monsieur', 'BARRIDAS', 'Nicolas', '1, Place de l''Eglise\n\n53410   LAUNAY-VILLIERS', '02-43-37-50-39', '', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'NBARRIDAS', 'NBARRIDAS', NULL);
INSERT INTO `les_usagers` VALUES (23950, 'Monsieur', 'BENABDELLAH', '', '10, Rue Jules Verne\n\n53200   CHATEAU-GONTIER', '02-43-07-99-31', '06-87-48-93-31', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'BENABDELLAH', 'BENABDELLAH', NULL);
INSERT INTO `les_usagers` VALUES (23951, 'Mademoiselle', 'BENABDELLAH', 'Hanane Zehore', '10, Rue Jules Verne\n\n53200   CHATEAU-GONTIER', '02-43-07-99-31', '06-87-48-93-31', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'HZBENABDELLAH', 'HZBENABDELLAH', NULL);
INSERT INTO `les_usagers` VALUES (23952, 'Monsieur', 'LAUNAY', 'Sébastien', 'Le Domaine du Bas Mont\n\n53100   MOULAY', '02-43-00-48-42', '', 'lamarjolaine@wanadoo.fr', '', 'ma', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SLAUNAY', 'SLAUNAY', NULL);
INSERT INTO `les_usagers` VALUES (23953, 'Monsieur', 'BINOIST', 'Alexandre', 'La Campagne\n\n61400   MAUVES SUR HUISNE', '02-33-83-87-14', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_ABINOIST', 'ABINOIST', NULL);
INSERT INTO `les_usagers` VALUES (23954, 'Monsieur', 'BINOIST', 'Alexandre', 'La Campagne\n\n61400   MAUVES SUR HUISNE', '02-33-83-87-14', '', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ABINOIST', 'ABINOIST', NULL);
INSERT INTO `les_usagers` VALUES (23955, 'Monsieur', 'LEBRETON', 'Jérôme', '7, Rue des Béliers\n\n53000   LAVAL', '02-43-53-66-76', '', '', '', 'ma', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JLEBRETON', 'JLEBRETON', NULL);
INSERT INTO `les_usagers` VALUES (23956, 'Monsieur', 'BOULANGER', 'Allan', 'Mondemault\n\n53940   LE GENEST-SAINT-ISLE', '02-43-02-15-74', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_ABOULANGER', 'ABOULANGER', NULL);
INSERT INTO `les_usagers` VALUES (23957, 'Monsieur', 'BOULANGER', 'Allan', 'Mondemault\n\n53940   LE GENEST-SAINT-ISLE', '02-43-02-15-74', '', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ABOULANGER', 'ABOULANGER', NULL);
INSERT INTO `les_usagers` VALUES (23958, 'Monsieur', 'DUBOIS', 'Anthony', '2, Place Saint-Pierre\n\n53150   MONTOURTIER', '02-43-90-00-95', '06-70-46-42-32', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_ADUBOIS', 'ADUBOIS', NULL);
INSERT INTO `les_usagers` VALUES (23959, 'Monsieur', 'DUBOIS', 'Anthony', '2, Place Saint-Pierre\n\n53150   MONTOURTIER', '02-43-90-00-95', '06-70-46-42-32', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ADUBOIS', 'ADUBOIS', NULL);
INSERT INTO `les_usagers` VALUES (23960, 'Monsieur', 'GUESNON', 'Kévin', '29, Rue Oudinot\n\n53000   LAVAL', '06-09-55-89-69', '06-14-72-50-03', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_KGUESNON', 'KGUESNON', NULL);
INSERT INTO `les_usagers` VALUES (23961, 'Monsieur', 'GUESNON', 'Kévin', '29, Rue Oudinot\n\n53000   LAVAL', '06-09-55-89-69', '06-14-72-50-03', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'KGUESNON', 'KGUESNON', NULL);
INSERT INTO `les_usagers` VALUES (23962, 'Monsieur', 'LANDEMAINE', 'Maurice', '5, Rue de la Mairie\n\n53440   LA BAZOGE-MONTPINCON', '02-43-04-43-59', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MLANDEMAINE', 'MLANDEMAINE', NULL);
INSERT INTO `les_usagers` VALUES (23963, 'Monsieur', 'LANDEMAINE', 'Vincent', '5, Rue de la Mairie\n\n53440   LA BAZOGE-MONTPINCON', '02-43-04-43-59', '', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'VLANDEMAINE', 'VLANDEMAINE', NULL);
INSERT INTO `les_usagers` VALUES (23964, 'Monsieur', 'DALENS', 'Christophe', '12, Rue Baudrairie\n\n35500   VITRE', '02-99-75-11-09', '', '', '', 'ma', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CDALENS', 'CDALENS', NULL);
INSERT INTO `les_usagers` VALUES (23965, 'Monsieur', 'LE BORGNE', 'Jacques', '8, Rue de Normandie\n\n53410   SAINT-PIERRE-LA-COUR', '06-03-27-61-21', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JLBORGNE', 'JLBORGNE', NULL);
INSERT INTO `les_usagers` VALUES (23966, 'Monsieur', 'LE BORGNE', 'Geoffrey', '8, Rue de Normandie\n\n53410   SAINT-PIERRE-LA-COUR', '06-03-27-61-21', '', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GLBORGNE', 'GLBORGNE', NULL);
INSERT INTO `les_usagers` VALUES (23967, 'Monsieur', 'LORENT', 'Jean-Claude', 'L''EPLUS\n\n53220   MONTAUDIN', '02-43-05-12-77', '06-27-38-33-98', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JLORENT', 'JLORENT', NULL);
INSERT INTO `les_usagers` VALUES (23968, 'Monsieur', 'LORENT', 'Gaétan', 'L''EPLUS\n\n53220   MONTAUDIN', '02-43-05-12-77', '06-27-38-33-98', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GLORENT', 'GLORENT', NULL);
INSERT INTO `les_usagers` VALUES (23969, 'Monsieur', 'QUILLET', 'Patrick', '2 route de Tours\n\n53260   FORCE', '02-43-53-29-96', '', '8', '', 'ma', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PQUILLET', 'PQUILLET', NULL);
INSERT INTO `les_usagers` VALUES (23970, 'Mademoiselle', 'PERRAULT', 'Virginie', '37, Rue de la Tannerie\n\n53260   PARNE-SUR-ROC', '02-43-98-05-15', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_VPERRAULT', 'VPERRAULT', NULL);
INSERT INTO `les_usagers` VALUES (23971, 'Mademoiselle', 'PERRAULT', 'Virginie', '37, Rue de la Tannerie\n\n53260   PARNE-SUR-ROC', '02-43-98-05-15', '', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'VPERRAULT', 'VPERRAULT', NULL);
INSERT INTO `les_usagers` VALUES (23972, 'Monsieur', 'RICOU', 'Yannick', '99-101, Avenue Robert Buron\n\n53000   LAVAL', '02-43-53-11-00', '', '', '', 'ma', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'YRICOU', 'YRICOU', NULL);
INSERT INTO `les_usagers` VALUES (23973, 'Monsieur', 'POTTIER', 'Michel', '31, Balade des Colibris\n\n53000   LAVAL', '', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MPOTTIER', 'MPOTTIER', NULL);
INSERT INTO `les_usagers` VALUES (23974, 'Mademoiselle', 'POTTIER', 'Elodie', 'Mme POTTIER Béatrice\n\n53230   COSSE-LE-VIVIEN', '06-13-21-96-03', '', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'EPOTTIER', 'EPOTTIER', NULL);
INSERT INTO `les_usagers` VALUES (23975, 'Monsieur', 'QUESNE', 'Nicolas', 'Buru\n\n53170   MESLAY DU MAINE', '02-43-98-62-58', '06-76-70-88-74', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_NQUESNE', 'NQUESNE', NULL);
INSERT INTO `les_usagers` VALUES (23976, 'Monsieur', 'BOUTTIER', 'Vincent', '71, Avenue de Paris\n\n53940   ST BERTHEVIN', '02-43-69-92-24', '', '', '', 'ma', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'VBOUTTIER', 'VBOUTTIER', NULL);
INSERT INTO `les_usagers` VALUES (23977, 'Monsieur', 'TETU', '', 'F.J.T du Pont de Mayenne\n\n53000   LAVAL', '', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'TETU', 'TETU', NULL);
INSERT INTO `les_usagers` VALUES (23978, 'Monsieur', 'TETU', 'David', 'F.J.T du Pont de Mayenne\n\n53000   LAVAL', '', '', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DTETU', 'DTETU', NULL);
INSERT INTO `les_usagers` VALUES (23979, 'Monsieur', 'HOUSSAY', 'Nicolas', 'Place Christian d''Elva\n\n53810   CHANGE', '02-43-53-43-33', '', '', '', 'ma', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'NHOUSSAY', 'NHOUSSAY', NULL);
INSERT INTO `les_usagers` VALUES (23980, 'Monsieur', 'THEREAU', 'Pascal', '10 bis rue Félix Jean marchais\n\n53240   ANDOUILLE', '02-43-69-49-52', '06-72-45-57-38', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PTHEREAU', 'PTHEREAU', NULL);
INSERT INTO `les_usagers` VALUES (23981, 'Monsieur', 'THEREAU', 'Camille', '10 bis rue Félix Jean marchais\n\n53240   ANDOUILLE', '02-43-69-49-52', '06-72-45-57-38', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CTHEREAU', 'CTHEREAU', NULL);
INSERT INTO `les_usagers` VALUES (23982, 'Monsieur', 'PINHEIRO', 'Frédéric', 'Route d''Olivet\n\n53940   LE GENEST ST ISLE', '02-43-37-14-37', '', '', '', 'ma', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FPINHEIRO', 'FPINHEIRO', NULL);
INSERT INTO `les_usagers` VALUES (23983, 'Madame', 'BOILLETET', 'Katherine', 'THOMAS Jean-Mickaël\n\n72230   GUECELARD', '02-43-87-79-11', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'KBOILLETET', 'KBOILLETET', NULL);
INSERT INTO `les_usagers` VALUES (23984, 'Monsieur', 'THOMAS', 'Jean-Mickaël', 'THOMAS Jean-Mickaël\n\n72230   GUECELARD', '02-43-87-79-11', '', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JTHOMAS', 'JTHOMAS', NULL);
INSERT INTO `les_usagers` VALUES (23985, 'Madame', 'PIHOURS', 'Céline', '12, Rue Gambetta\n\n49400   SAUMUR', '02-41-67-66-66', '', '', '', 'ma', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CPIHOURS', 'CPIHOURS', NULL);
INSERT INTO `les_usagers` VALUES (23986, 'Mademoiselle', 'FERNANDEZ', 'Céline', '17, Rue de la Tonnelle\n\n49400   SAUMUR', '02-41-67-95-13', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_CFERNANDEZ', 'CFERNANDEZ', NULL);
INSERT INTO `les_usagers` VALUES (23987, 'Mademoiselle', 'FERNANDEZ', 'Céline', '17, Rue de la Tonnelle\n\n49400   SAUMUR', '02-41-67-95-13', '', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CFERNANDEZ', 'CFERNANDEZ', NULL);
INSERT INTO `les_usagers` VALUES (23988, 'Monsieur', 'VAM MARLE', 'Richard', '2 rue Ambroise de Loré\n\n53100   MAYENNE', '02-43-00-96-00', '', '', '', 'ma', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'RVMARLE', 'RVMARLE', NULL);
INSERT INTO `les_usagers` VALUES (23989, 'Monsieur', 'FILOCHE', 'Gilbert', '9, Impasse du Trésor\n\n53700   VILLAINES-LA-JUHEL', '02-43-03-72-36', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GFILOCHE', 'GFILOCHE', NULL);
INSERT INTO `les_usagers` VALUES (23990, 'Mademoiselle', 'FILOCHE', 'Vanessa', '9, Impasse du Trésor\n\n53700   VILLAINES-LA-JUHEL', '02-43-03-72-36', '', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'VFILOCHE', 'VFILOCHE', NULL);
INSERT INTO `les_usagers` VALUES (23991, 'Monsieur', 'RICHAUDEAU', 'Benoît', 'La Sirotière\n\n49160   LONGUE-JUMELLES', '02-41-52-78-28', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_BRICHAUDEAU', 'BRICHAUDEAU', NULL);
INSERT INTO `les_usagers` VALUES (23992, 'Monsieur', 'RICHAUDEAU', 'Benoît', '41 Place de la Commune\n\n53000   LAVAL', '', '', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'BRICHAUDEAU', 'BRICHAUDEAU', NULL);
INSERT INTO `les_usagers` VALUES (23993, 'Madame', 'CAUDRON', 'Céline', '67, Rue du Val de Mayenne\n\n53000   LAVAL', '02-43-56-98-29', '', 'bistro.paris@wanadoo.fr', '', 'ma', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CCAUDRON', 'CCAUDRON', NULL);
INSERT INTO `les_usagers` VALUES (23994, 'Monsieur', 'SALLES', 'Jean-Marc', '19, Rue du Centre\n\n72160   LA CHAPELLE-SAINT-REMY', '02-43-93-86-44', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JSALLES', 'JSALLES', NULL);
INSERT INTO `les_usagers` VALUES (23995, 'Mademoiselle', 'SALLES', 'Angélique', '19, Rue du Centre\n\n72160   LA CHAPELLE-SAINT-REMY', '02-43-93-86-44', '', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ASALLES', 'ASALLES', NULL);
INSERT INTO `les_usagers` VALUES (23996, 'Monsieur', 'LEMERCIER', 'Brigitte', '67, Rue du Val de Mayenne\n\n53000   LAVAL', '02-43-56-98-29', '', 'bistro.paris@wanadoo.fr', '', 'ma', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'BLEMERCIER', 'BLEMERCIER', NULL);
INSERT INTO `les_usagers` VALUES (23997, 'Monsieur', 'VANNIER', 'Michel', 'La Secourie\n\n53500   ERNEE', '02-43-05-25-53', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MVANNIER', 'MVANNIER', NULL);
INSERT INTO `les_usagers` VALUES (23998, 'Monsieur', 'VANNIER', 'Benoit', 'La Secourie\n\n53500   ERNEE', '02-43-05-25-53', '', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'BVANNIER', 'BVANNIER', NULL);
INSERT INTO `les_usagers` VALUES (23999, 'Monsieur', 'BAHIER', 'Olivier', '118, Rue de Bretagne\n\n53000   LAVAL', '02-43-68-31-69', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'OBAHIER', 'OBAHIER', NULL);
INSERT INTO `les_usagers` VALUES (24000, 'Monsieur', 'BAHIER', 'Romain', '118, Rue de Bretagne\n\n53000   LAVAL', '02-43-68-31-69', '', 'olivier.bahier@wanadoo.fr', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'RBAHIER', 'RBAHIER', NULL);
INSERT INTO `les_usagers` VALUES (24001, 'Madame', 'CHESNEAU', 'Florence', '(BANVILLE Kévin)\n\n53200   CHATEAU-GONTIER', '02-43-70-94-96', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FCHESNEAU', 'FCHESNEAU', NULL);
INSERT INTO `les_usagers` VALUES (24002, 'Monsieur', 'BANVILLE', 'Kévin', '(BANVILLE Kévin)\n\n53200   CHATEAU-GONTIER', '02-43-70-94-96', '', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'KBANVILLE', 'KBANVILLE', NULL);
INSERT INTO `les_usagers` VALUES (24003, 'Monsieur', 'BOUDIN', 'Daniel', '25, Rue Dutertre\n\n53500   ERNEE', '02-43-05-78-44', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DBOUDIN', 'DBOUDIN', NULL);
INSERT INTO `les_usagers` VALUES (24004, 'Monsieur', 'BOUDIN', 'Francis', '25, Rue Dutertre\n\n53500   ERNEE', '02-43-05-78-44', '', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FBOUDIN', 'FBOUDIN', NULL);
INSERT INTO `les_usagers` VALUES (24005, 'Monsieur', 'PELE', 'Jean-François', '86, Rue Bernard Le Pecq\n\n53000   LAVAL', '', '', '', '', 'ma', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JPELE', 'JPELE', NULL);
INSERT INTO `les_usagers` VALUES (24006, 'Monsieur', 'BOULLIER', 'Fabrice', '32, Rue de la javelle\n\n53810   CHANGE', '02-43-53-32-75', '06-89-78-69-40', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FBOULLIER', 'FBOULLIER', NULL);
INSERT INTO `les_usagers` VALUES (24007, 'Monsieur', 'BOULLIER', 'Matthieu', '32, Rue de la javelle\n\n53810   CHANGE', '02-43-53-32-75', '06-89-78-69-40', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MBOULLIER', 'MBOULLIER', NULL);
INSERT INTO `les_usagers` VALUES (24008, 'Monsieur', 'CHIGNON', 'Joel', '39, Avenue des Sports\n\n53600   EVRON', '02-43-01-64-69', '', '', '', 'ma', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JCHIGNON', 'JCHIGNON', NULL);
INSERT INTO `les_usagers` VALUES (24009, 'Monsieur', 'CHIGNON', 'Joel', 'La Louvetière\n\n53160   HAMBERS', '02-43-37-98-89', '06-08-26-35-27', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JCHIGNON', 'JCHIGNON', NULL);
INSERT INTO `les_usagers` VALUES (24010, 'Monsieur', 'CHIGNON', 'Charly', 'La Louvetière\n\n53160   HAMBERS', '02-43-37-98-89', '06-08-26-35-27', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CCHIGNON', 'CCHIGNON', NULL);
INSERT INTO `les_usagers` VALUES (24011, 'Monsieur', 'GERNAIS', 'Jean-Luc', 'Les Petites Haies\n\n53150   BREE', '02-43-98-27-41', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JGERNAIS', 'JGERNAIS', NULL);
INSERT INTO `les_usagers` VALUES (24012, 'Monsieur', 'GERNAIS', 'Antoine', 'Les Petites Haies\n\n53150   BREE', '02-43-98-27-41', '', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'AGERNAIS', 'AGERNAIS', NULL);
INSERT INTO `les_usagers` VALUES (24013, 'Monsieur', 'MAUDET', 'JEAN-CHRISTOPHE', '2, Place de l''Eglise\n\n53210   ARGENTRE', '02-43-37-31-12', '', '', '', 'ma', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JMAUDET', 'JMAUDET', NULL);
INSERT INTO `les_usagers` VALUES (24014, 'Madame', 'LECRENAY', 'Laurence', '(LEROY Kévin)\n\n53270   TORCE-VIVIERS-EN-CHARNIE', '02-43-90-40-59', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'LLECRENAY', 'LLECRENAY', NULL);
INSERT INTO `les_usagers` VALUES (24015, 'Monsieur', 'LEROY', 'Kévin', '(LEROY Kévin)\n\n53270   TORCE-VIVIERS-EN-CHARNIE', '02-43-90-40-59', '', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'KLEROY', 'KLEROY', NULL);
INSERT INTO `les_usagers` VALUES (24016, 'Monsieur', 'MARTIN', 'Pascal', '41, Rue de la Fleurière\n\n53000   LAVAL', '02-43-56-65-32', '06-82-06-06-55', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PMARTIN', 'PMARTIN', NULL);
INSERT INTO `les_usagers` VALUES (24017, 'Monsieur', 'MARTIN', 'Quentin', '41, Rue de la Fleurière\n\n53000   LAVAL', '02-43-56-65-32', '06-82-06-06-55', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'QMARTIN', 'QMARTIN', NULL);
INSERT INTO `les_usagers` VALUES (24018, 'Monsieur', 'TRIHAN', 'Jérôme', '4, place de l''Eglise\n\n35500   ERBREE', '02-99-49-40-19', '', '', '', 'ma', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JTRIHAN', 'JTRIHAN', NULL);
INSERT INTO `les_usagers` VALUES (24019, 'Monsieur', 'MENARD', 'Daniel', '36, Rue Alain d''Argentré\n\n35370   ARGENTRE-DU-PLESSIS', '02-99-96-78-83', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DMENARD', 'DMENARD', NULL);
INSERT INTO `les_usagers` VALUES (24020, 'Monsieur', 'MENARD', 'Gwenolé', '36, Rue Alain d''Argentré\n\n35370   ARGENTRE-DU-PLESSIS', '02-99-96-78-83', '', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GMENARD', 'GMENARD', NULL);
INSERT INTO `les_usagers` VALUES (24021, 'Monsieur', 'VIGNEAU', 'Richard', '14 RUE DES TROIS MARCHANDS\n\n53230   COSSE LE VIVIEN', '02-43-98-81-40', '', '', '', 'ma', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'RVIGNEAU', 'RVIGNEAU', NULL);
INSERT INTO `les_usagers` VALUES (24022, 'Monsieur', 'PLANCHARD', 'Rémi', 'Le Mauperthuis\n\n53230   MERAL', '02-43-98-85-61', '06-08-53-46-40', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'RPLANCHARD', 'RPLANCHARD', NULL);
INSERT INTO `les_usagers` VALUES (24023, 'Monsieur', 'PLANCHARD', 'Damien', 'Le Mauperthuis\n\n53230   MERAL', '02-43-98-85-61', '06-08-53-46-40', 'damien2609@hotmail.fr', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DPLANCHARD', 'DPLANCHARD', NULL);
INSERT INTO `les_usagers` VALUES (24024, 'Madame', 'SEGURET', 'Christine', '5, Impasse des Verriers\n\n53970   L HUISSERIE', '02-43-64-27-34', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CSEGURET', 'CSEGURET', NULL);
INSERT INTO `les_usagers` VALUES (24025, 'Monsieur', 'SEGURET', 'Maxime', '5, Impasse des Verriers\n\n53970   L HUISSERIE', '02-43-64-27-34', '', 'seguret.fm@aliceadsl.fr', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MSEGURET', 'MSEGURET', NULL);
INSERT INTO `les_usagers` VALUES (24026, 'Monsieur', 'TRIHON', 'Rémi', '6, Rue Amiral Courbet\n\n53500   ERNEE', '02-43-05-23-37', '', '', '', 'ma', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'RTRIHON', 'RTRIHON', NULL);
INSERT INTO `les_usagers` VALUES (24027, 'Monsieur', 'BEUNARD', 'Jérôme', '29, Rue d''Anjou\n\n53260   ENTRAMMES', '02-43-98-00-50', '', '', '', 'ma', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JBEUNARD', 'JBEUNARD', NULL);
INSERT INTO `les_usagers` VALUES (24028, 'Monsieur', 'LOUVARD', 'Stéphane', '43-45 Rue Miromesnil\n\n75000   PARIS', '01-42-65-56-90', '', '', '', 'ma', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SLOUVARD', 'SLOUVARD', NULL);
INSERT INTO `les_usagers` VALUES (24029, 'Madame', 'BOULEAU', 'Claudine', '4, Rue de la Mairie\n\n53230   LA CHAPELLE-CRAONNAISE', '02-43-98-93-54', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CBOULEAU', 'CBOULEAU', NULL);
INSERT INTO `les_usagers` VALUES (24030, 'Monsieur', 'BOULEAU', 'Laurent', '4, Rue de la Mairie\n\n53230   LA CHAPELLE-CRAONNAISE', '02-43-98-93-54', '', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'LBOULEAU', 'LBOULEAU', NULL);
INSERT INTO `les_usagers` VALUES (24031, 'Monsieur', 'CERISIER', 'Jean Yves', '10 carrefour aux toiles\n\n53000   LAVAL', '02-43-66-86-87', '', '', '', 'ma', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JYCERISIER', 'JYCERISIER', NULL);
INSERT INTO `les_usagers` VALUES (24032, 'Monsieur', 'BRUNET', 'Hervé', '10, Rue Claude Bernard\n\n53940   SAINT-BERTHEVIN', '02-43-68-22-81', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'HBRUNET', 'HBRUNET', NULL);
INSERT INTO `les_usagers` VALUES (24033, 'Monsieur', 'BRUNET', 'Quentin', '10, Rue Claude Bernard\n\n53940   SAINT-BERTHEVIN', '02-43-68-22-81', '', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'QBRUNET', 'QBRUNET', NULL);
INSERT INTO `les_usagers` VALUES (24034, 'Monsieur', 'CHRETIEN', 'Philippe', '19, Rue Maurice Courcelle\n\n53240   SAINT-JEAN-SUR-MAYENNE', '02-43-01-13-28', '', '', '', 'ma', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PCHRETIEN', 'PCHRETIEN', NULL);
INSERT INTO `les_usagers` VALUES (24035, 'Monsieur', 'DUGUE', 'Victor', '12, Rue du Colonel Flatters\n\n53000   LAVAL', '06-88-17-07-62', '02-43-56-45-40', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'VDUGUE', 'VDUGUE', NULL);
INSERT INTO `les_usagers` VALUES (24036, 'Monsieur', 'DUGUE', 'Philippe', '12, Rue du Colonel Flatters\n\n53000   LAVAL', '06-88-17-07-62', '02-43-56-45-40', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PDUGUE', 'PDUGUE', NULL);
INSERT INTO `les_usagers` VALUES (24037, 'Monsieur', 'HUET', 'Daniel', 'Chemin Le Bois des hommes\n\n53400   CRAON', '02-43-06-38-71', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DHUET', 'DHUET', NULL);
INSERT INTO `les_usagers` VALUES (24038, 'Monsieur', 'HUET', 'Mickael', 'Chemin Le Bois des hommes\n\n53400   CRAON', '02-43-06-38-71', '', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MHUET', 'MHUET', NULL);
INSERT INTO `les_usagers` VALUES (24039, 'Monsieur', 'LEMOINE', '', '40, Rue Laval - Québec\n\n53000   LAVAL', '02-43-68-13-21', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'LEMOINE', 'LEMOINE', NULL);
INSERT INTO `les_usagers` VALUES (24040, 'Monsieur', 'LEMOINE', 'Arnaud', '40, Rue Laval - Québec\n\n53000   LAVAL', '02-43-68-13-21', '', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ALEMOINE', 'ALEMOINE', NULL);
INSERT INTO `les_usagers` VALUES (24041, 'Monsieur', 'LESAVOUREUX', 'Philippe', 'La Grémillère\n\n53340   PREAUX', '02-43-68-54-48', '06-85-12-75-68', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_PLESAVOUREUX', 'PLESAVOUREUX', NULL);
INSERT INTO `les_usagers` VALUES (24042, 'Monsieur', 'LESAVOUREUX', 'Philippe', 'La Grémillère\n\n53340   PREAUX', '02-43-68-54-48', '06-85-12-75-68', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PLESAVOUREUX', 'PLESAVOUREUX', NULL);
INSERT INTO `les_usagers` VALUES (24043, 'Monsieur', 'THOMASSAINT', 'Maxime', '3 Impasse des Postes\n\n53000   LAVAL', '', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_MTHOMASSAINT', 'MTHOMASSAINT', NULL);
INSERT INTO `les_usagers` VALUES (24044, 'Monsieur', 'THOMASSAINT', 'Maxime', '3 Impasse des Postes\n\n53000   LAVAL', '', '', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MTHOMASSAINT', 'MTHOMASSAINT', NULL);
INSERT INTO `les_usagers` VALUES (24045, 'Monsieur', 'MASSOT', 'Jean François', '10, Rue de Loré\n\n53000   LAVAL', '02-43-53-99-42', '', '', '', 'ma', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JFMASSOT', 'JFMASSOT', NULL);
INSERT INTO `les_usagers` VALUES (24046, 'Madame', 'MENGUY', 'Dominique', 'TOURNADE Dominique\n\n53000   LAVAL', '02-43-56-70-25', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DMENGUY', 'DMENGUY', NULL);
INSERT INTO `les_usagers` VALUES (24047, 'Monsieur', 'TOURNADE', 'Erwan', 'TOURNADE Dominique\n\n53000   LAVAL', '02-43-56-70-25', '', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ETOURNADE', 'ETOURNADE', NULL);
INSERT INTO `les_usagers` VALUES (24048, 'Monsieur', 'LESAULNIER', 'Daniel', 'Route de Paris\n\n35133   BEAUCE', '02-99-99-81-55', '', '', '', 'ma', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DLESAULNIER', 'DLESAULNIER', NULL);
INSERT INTO `les_usagers` VALUES (24049, 'Mademoiselle', 'GAILISA', 'Marite', 'Route d''Ernée\n\n35133   BEAUCE', '02-99-99-81-55', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_MGAILISA', 'MGAILISA', NULL);
INSERT INTO `les_usagers` VALUES (24050, 'Mademoiselle', 'GAILISA', 'Marite', 'Route d''Ernée\n\n35133   BEAUCE', '02-99-99-81-55', '', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MGAILISA', 'MGAILISA', NULL);
INSERT INTO `les_usagers` VALUES (24051, 'Monsieur', 'HUNGER', 'Philipp', '9, Rue du Perrin\n\n53100   MAYENNE', '', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_PHUNGER', 'PHUNGER', NULL);
INSERT INTO `les_usagers` VALUES (24052, 'Monsieur', 'HUNGER', 'Philipp', '9, Rue du Perrin\n\n53100   MAYENNE', '', '', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PHUNGER', 'PHUNGER', NULL);
INSERT INTO `les_usagers` VALUES (24053, 'Mademoiselle', 'TONJES', 'Maria', 'FJT du Pont de Mayenne\n\n53000   LAVAL', '', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_MTONJES', 'MTONJES', NULL);
INSERT INTO `les_usagers` VALUES (24054, 'Mademoiselle', 'TONJES', 'Maria', 'FJT du Pont de Mayenne\n\n53000   LAVAL', '', '', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MTONJES', 'MTONJES', NULL);
INSERT INTO `les_usagers` VALUES (24055, 'Monsieur', 'DOMEDE', 'Didier', '15, Rue Saint-Nicolas\n\n53700   VILLAINES LA JUHEL', '02-43-03-25-79', '', '', '', 'ma', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DDOMEDE', 'DDOMEDE', NULL);
INSERT INTO `les_usagers` VALUES (24056, 'Madame', 'BOULON', 'Françoise', '41, Rue du Bignon\n\n53700   VILLAINES-LA-JUHEL', '06-80-84-55-55', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FBOULON', 'FBOULON', NULL);
INSERT INTO `les_usagers` VALUES (24057, 'Monsieur', 'BOULON', 'Benjamin', '41, Rue du Bignon\n\n53700   VILLAINES-LA-JUHEL', '06-80-84-55-55', '', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'BBOULON', 'BBOULON', NULL);
INSERT INTO `les_usagers` VALUES (24058, 'Monsieur', 'BOURBON', 'Alain', 'Route d''Arquenay Les Mimosas\n\n53170   MESLAY-DU-MAINE', '02-43-64-21-06', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ABOURBON', 'ABOURBON', NULL);
INSERT INTO `les_usagers` VALUES (24059, 'Mademoiselle', 'BOURBON', 'Malika', 'Route d''Arquenay Les Mimosas\n\n53170   MESLAY-DU-MAINE', '02-43-64-21-06', '', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MBOURBON', 'MBOURBON', NULL);
INSERT INTO `les_usagers` VALUES (24060, 'Monsieur', 'RENAULT', 'STEPHANE', '17 place du 9 Juin 1944\n\n53100   MAYENNE', '02-43-04-43-41', '', '', '', 'ma', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SRENAULT', 'SRENAULT', NULL);
INSERT INTO `les_usagers` VALUES (24061, 'Monsieur', 'BREHIN', '', '1, Rue de la Guesnière\n\n53100   MAYENNE', '02-43-04-43-41', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'BREHIN', 'BREHIN', NULL);
INSERT INTO `les_usagers` VALUES (24062, 'Monsieur', 'BREHIN', 'Mathieu', '1, Rue de la Guesnière\n\n53100   MAYENNE', '02-43-04-43-41', '', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MBREHIN', 'MBREHIN', NULL);
INSERT INTO `les_usagers` VALUES (24063, 'Madame', 'HUNAULT', 'Françoise', '11, Rue D''Autan\n\n53810   CHANGE', '02-43-02-87-91', '06-12-13-56-24', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FHUNAULT', 'FHUNAULT', NULL);
INSERT INTO `les_usagers` VALUES (24064, 'Monsieur', 'EDOM', 'Lucas', '11, Rue D''Autan\n\n53810   CHANGE', '02-43-02-87-91', '06-12-13-56-24', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'LEDOM', 'LEDOM', NULL);
INSERT INTO `les_usagers` VALUES (24065, 'Monsieur', 'FLEURY', 'Michel', 'Le Fourneau\n\n53600   ASSE-LE-BERENGER', '02-43-01-37-46', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MFLEURY', 'MFLEURY', NULL);
INSERT INTO `les_usagers` VALUES (24066, 'Monsieur', 'FLEURY', 'Simon', 'Le Fourneau\n\n53600   ASSE-LE-BERENGER', '02-43-01-37-46', '', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SFLEURY', 'SFLEURY', NULL);
INSERT INTO `les_usagers` VALUES (24067, 'Monsieur', 'DURAND', 'Richard', 'L''Huilerie - Route de Laval\n\n53100   MAYENNE', '02-43-00-47-85', '', '', '', 'ma', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'RDURAND', 'RDURAND', NULL);
INSERT INTO `les_usagers` VALUES (24068, 'Monsieur', 'FOUASSIER', 'Jean-Claude', '8, Rue du Chardonneret\n\n53800   SAINT-MARTIN-DU-LIMET', '02-43-06-49-67', '06-65-73-54-22', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_JFOUASSIER', 'JFOUASSIER', NULL);
INSERT INTO `les_usagers` VALUES (24069, 'Monsieur', 'FOUASSIER', 'Jean-Baptiste', '8, Rue du Chardonneret\n\n53800   SAINT-MARTIN-DU-LIMET', '02-43-06-49-67', '06-65-73-54-22', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JFOUASSIER', 'JFOUASSIER', NULL);
INSERT INTO `les_usagers` VALUES (24070, 'Monsieur', 'LAKATOS', 'Richard', '1, Rue du Theil\n\n53300   SOUCE', '02-43-08-97-21', '06-22-44-35-88', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'RLAKATOS', 'RLAKATOS', NULL);
INSERT INTO `les_usagers` VALUES (24071, 'Monsieur', 'LAKATOS', 'Samuel', '1, Rue du Theil\n\n53300   SOUCE', '02-43-08-97-21', '06-22-44-35-88', 'lakatos@infonie.fr', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SLAKATOS', 'SLAKATOS', NULL);
INSERT INTO `les_usagers` VALUES (24072, 'Monsieur', 'FANOUILLET', 'Sébastien', '8, Grande Rue\n\n53170   MESLAY-DU-MAINE', '02-43-98-40-21', '', '', '', 'ma', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SFANOUILLET', 'SFANOUILLET', NULL);
INSERT INTO `les_usagers` VALUES (24073, 'Madame', 'PICHON', 'Chantal', '7, Allée de la Vaige\n\n53170   MESLAY-DU-MAINE', '02-43-98-47-29', '', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CPICHON', 'CPICHON', NULL);
INSERT INTO `les_usagers` VALUES (24074, 'Monsieur', 'PICHON', 'Tristan', '7, Allée de la Vaige\n\n53170   MESLAY-DU-MAINE', '02-43-98-47-29', '', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'TPICHON', 'TPICHON', NULL);
INSERT INTO `les_usagers` VALUES (24075, 'Monsieur', 'POULTIER', 'Alain', '16, Rue de la Gare de Sporting\n\n53150   NEAU', '02-43-98-23-08', '06-08-47-93-56', '', '', 'rl', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'APOULTIER', 'APOULTIER', NULL);
INSERT INTO `les_usagers` VALUES (24076, 'Monsieur', 'POULTIER - DUTERTRE', 'Maxime', '16, Rue de la Gare de Sporting\n\n53150   NEAU', '02-43-98-23-08', '06-08-47-93-56', '', '', 'app', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MPDUTERTRE', 'MPDUTERTRE', NULL);
INSERT INTO `les_usagers` VALUES (24077, 'Monsieur', 'HOUDAYER', 'Marc', '1 rue René D''Anjou\n\n53200   CHATEAU GONTIER', '', '', '', '', 'ma', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MHOUDAYER', 'MHOUDAYER', NULL);
INSERT INTO `les_usagers` VALUES (24078, 'Monsieur', 'MEZIERE', 'MICHEL', '8, Rue de Laval\n\n53970   L''HUISSERIE', '02-43-69-62-28', '', '', '', 'ma', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MMEZIERE', 'MMEZIERE', NULL);
INSERT INTO `les_usagers` VALUES (24079, 'Monsieur', 'MAUNY', 'Pascal', '4, Rue de la Madeleine\n\n53100   MAYENNE', '02-43-04-23-95', '', '', '', 'ma', 0x323030362d30392d3134, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PMAUNY', 'PMAUNY', NULL);
INSERT INTO `les_usagers` VALUES (24082, 'Monsieur', 'GOHAU', '', 'ZI la Chambrouillère\n\n53960   BONCHAMP-LES-LAVAL', '02-43-59-23-80', '', '', '', 'ma', 0x323030362d30392d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GOHAU', 'GOHAU', NULL);
INSERT INTO `les_usagers` VALUES (24085, 'Monsieur', 'CHAMBARD', 'PIERRE', 'Rue des Frères Lumière\n\n53230   COSSE LE VIVIEN', '02-43-98-27-76', '', '', '', 'ma', 0x323030362d30392d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PCHAMBARD', 'PCHAMBARD', NULL);
INSERT INTO `les_usagers` VALUES (24088, 'Monsieur', 'ANGOT', '', '366 RUE DE CHAUVRIE\n\n53100   MAYENNE', '02-43-04-13-82', '', '', '', 'ma', 0x323030362d30392d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ANGOT', 'ANGOT', NULL);
INSERT INTO `les_usagers` VALUES (24093, 'Monsieur', 'DELANGLE', 'Didier', 'Zone d''activité\n\n53950   LOUVERNE', '02-43-01-58-00', '', '', '', 'ma', 0x323030362d30392d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DDELANGLE', 'DDELANGLE', NULL);
INSERT INTO `les_usagers` VALUES (24096, 'Monsieur', 'ROMAGNE', '', '144 Avenue de Fougeres\n\n53000   LAVAL', '02-43-90-70-87', '', '', '', 'ma', 0x323030362d30392d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ROMAGNE', 'ROMAGNE', NULL);
INSERT INTO `les_usagers` VALUES (24097, 'Monsieur', 'GUETRES', 'Eugenes', '25 rue de chantepie\n\n53320   LOIRON', '02-43-02-44-78', '', '', '', 'rl', 0x323030362d30392d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'EGUETRES', 'EGUETRES', NULL);
INSERT INTO `les_usagers` VALUES (24098, 'Madame', 'RIFFAUD', 'Sylvie', '1 RUE DU BIGNON\n\n35000   RENNES', '02-99-33-97-00', '06-72-88-91-57', '', '', 'ens', 0x323030362d30392d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SRIFFAUD', 'SRIFFAUD', NULL);
INSERT INTO `les_usagers` VALUES (24099, 'Monsieur', 'GUETRES', 'Romain', '25 rue de chantepie\n\n53320   LOIRON', '02-43-02-44-78', '', '', '', 'app', 0x323030362d30392d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'RGUETRES', 'RGUETRES', NULL);
INSERT INTO `les_usagers` VALUES (24100, 'Monsieur', 'MOURRAINE', 'Noel', '24 rie Surcouf\n\n53500   ERNEE', '02-43-05-74-69', '06-10-99-91-84', '', '', 'rl', 0x323030362d30392d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'NMOURRAINE', 'NMOURRAINE', NULL);
INSERT INTO `les_usagers` VALUES (24101, 'Monsieur', 'MOURRAINE', 'Samuel', '24 rie Surcouf\n\n53500   ERNEE', '02-43-05-74-69', '06-10-99-91-84', '', '', 'app', 0x323030362d30392d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SMOURRAINE', 'SMOURRAINE', NULL);
INSERT INTO `les_usagers` VALUES (24102, 'Monsieur', 'NOEL', 'Bruno', '38 rue de la libération\n\n53500   SAINT-PIERRE-DES-LANDES', '02-43-05-90-89', '', '', '', 'ma', 0x323030362d30392d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'BNOEL', 'BNOEL', NULL);
INSERT INTO `les_usagers` VALUES (24103, 'Madame', 'PELLETIER', 'Nadia', '12 lotisssement des pins\n\n53120   BRECE', '02-43-11-27-10', '06-15-33-84-32', '', '', 'rl', 0x323030362d30392d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'NPELLETIER', 'NPELLETIER', NULL);
INSERT INTO `les_usagers` VALUES (24104, 'Monsieur', 'PELLETIER', 'Mathieu', '12 lotisssement des pins\n\n53120   BRECE', '02-43-11-27-10', '06-15-33-84-32', '', '', 'app', 0x323030362d30392d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MPELLETIER', 'MPELLETIER', NULL);
INSERT INTO `les_usagers` VALUES (24105, 'Monsieur', 'JANVIER', '', 'ZA DU HAUT MERAL\n\n53150   MONTSURS', '02-43-01-01-67', '', '', '', 'ma', 0x323030362d30392d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JANVIER', 'JANVIER', NULL);
INSERT INTO `les_usagers` VALUES (24106, 'Monsieur', 'BODEY', '', '32 ROUTE DE PINCE \n\n72300   SABLE-SUR-SARTHE', '02-43-55-18-60', '06-20-47-56-21', '', '', 'rl', 0x323030362d30392d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'BODEY', 'BODEY', NULL);
INSERT INTO `les_usagers` VALUES (24107, 'Monsieur', 'BODEY', 'Kevin', '32 ROUTE DE PINCE \n\n72300   SABLE-SUR-SARTHE', '02-43-55-18-60', '06-20-47-56-21', '', '', 'app', 0x323030362d30392d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'KBODEY', 'KBODEY', NULL);
INSERT INTO `les_usagers` VALUES (24108, 'Monsieur', 'JEUDY', 'Sylvain', '16 rue du 11 Novembre \n\n53940   ST BERTHEVIN', '02-43-68-15-23', '', '', '', 'app', 0x323030362d30392d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SJEUDY', 'SJEUDY', NULL);
INSERT INTO `les_usagers` VALUES (24109, 'Monsieur', 'LEFEBVRE', 'Arnaud', '166 rue des platanes\n\n53100   MAYENNE', '02-43-00-94-63', '', '', '', 'app', 0x323030362d30392d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ALEFEBVRE', 'ALEFEBVRE', NULL);
INSERT INTO `les_usagers` VALUES (24110, 'Monsieur', 'WEIBEL', 'BERNARD', '4 route du Mans\n\n53960   BONCHAMP-LES-LAVAL', '02-43-90-96-53', '', '', '', 'ma', 0x323030362d30392d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'BWEIBEL', 'BWEIBEL', NULL);
INSERT INTO `les_usagers` VALUES (24111, 'Monsieur', 'LEVRARD', 'Benoit', '5 RUE DU SOBLOMET\n\n53100   MOULAY', '02-43-00-03-20', '06-88-06-04-32', '', '', 'app', 0x323030362d30392d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'BLEVRARD', 'BLEVRARD', NULL);
INSERT INTO `les_usagers` VALUES (24112, 'Monsieur', 'LOUTELLIER', 'Vincent', '6  LOT DES LILAS\n\n53700   SAINT-AUBIN-DU-DESERT', '02-43-03-34-38', '', '', '', 'app', 0x323030362d30392d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'VLOUTELLIER', 'VLOUTELLIER', NULL);
INSERT INTO `les_usagers` VALUES (24113, 'Monsieur', 'GUILMAULT', '', '643 Avenue Gutenberg\n\n53100   MAYENNE', '02-43-30-44-44', '', '', '', 'ma', 0x323030362d30392d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GUILMAULT', 'GUILMAULT', NULL);
INSERT INTO `les_usagers` VALUES (24114, 'Monsieur', 'MARTIN', 'Fabien', '9 résidence ste Catheine \n\n53100   MAYENNE', '02-43-30-44-44', '', '', '', 'app', 0x323030362d30392d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FMARTIN', 'FMARTIN', NULL);
INSERT INTO `les_usagers` VALUES (24115, 'Monsieur', 'MOUGINS', 'Dany', '36 rue Jules Renard\n\n53200   CHATEAU GONTIER', '06-24-32-40-52', '', '', '', 'app', 0x323030362d30392d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DMOUGINS', 'DMOUGINS', NULL);
INSERT INTO `les_usagers` VALUES (24116, 'Monsieur', 'RENOUX', '', '66 Avenue de Paris\n\n53940   ST BERTHEVIN', '02-43-01-24-24', '', '', '', 'ma', 0x323030362d30392d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'RENOUX', 'RENOUX', NULL);
INSERT INTO `les_usagers` VALUES (24117, 'Monsieur', 'PITOIS', 'Charles', 'LE ROCHER\n\n53410   ST OUEN DES TOITS', '02-43-37-75-33', '', '', '', 'app', 0x323030362d30392d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CPITOIS', 'CPITOIS', NULL);
INSERT INTO `les_usagers` VALUES (24118, 'Monsieur', 'ETIENNE', 'Claude', '250 RUE DE RENNES\n\n53100   MAYENNE', '02-43-04-36-71', '', '', '', 'ma', 0x323030362d30392d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CETIENNE', 'CETIENNE', NULL);
INSERT INTO `les_usagers` VALUES (24119, 'Monsieur', 'RIOUL', 'Kévin', 'LE BOUILLON\n\n53140   LA PALLU', '02-43-03-83-95', '', '', '', 'app', 0x323030362d30392d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'KRIOUL', 'KRIOUL', NULL);
INSERT INTO `les_usagers` VALUES (24120, 'Monsieur', 'AUTIER', '', '35 bd Clément Ader\n\n53020   LAVAL CEDEX 9', '02-43-53-11-73', '', '', '', 'ma', 0x323030362d30392d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'AUTIER', 'AUTIER', NULL);
INSERT INTO `les_usagers` VALUES (24121, 'Monsieur', 'ROULLIERE', 'Jonathan', 'Appt 844\n\n53000   LAVAL', '06-73-75-32-20', '', '', '', 'app', 0x323030362d30392d3231, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JROULLIERE', 'JROULLIERE', NULL);
INSERT INTO `les_usagers` VALUES (24122, 'Monsieur', 'GAUTIER', 'Gérard', '66 Avenue du Révérend Père Umbricht\n\n35400   SAINT-MALO', '02-99-56-07-26', '', '', '', 'ma', 0x323030362d30392d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GGAUTIER', 'GGAUTIER', NULL);
INSERT INTO `les_usagers` VALUES (24123, 'Monsieur', 'LE BIAN', 'Anthony', '1 square du Trieux\n\n35400   SAINT-MALO', '02-99-81-96-10', '', '', '', 'rl', 0x323030362d30392d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_ALBIAN', 'ALBIAN', NULL);
INSERT INTO `les_usagers` VALUES (24124, 'Monsieur', 'LE BIAN', 'Anthony', '1 square du Trieux\n\n35400   SAINT-MALO', '02-99-81-96-10', '', '', '', 'app', 0x323030362d30392d3232, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ALBIAN', 'ALBIAN', NULL);
INSERT INTO `les_usagers` VALUES (24135, 'Monsieur', 'RAVENEL', 'Thierry', 'ZI du Château de la Mare\n\n50200   COUTANCES', '02-33-45-67-75', '', '', '', 'ma', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'TRAVENEL', 'TRAVENEL', NULL);
INSERT INTO `les_usagers` VALUES (24136, 'Monsieur', 'BELHAIRE', '', '22, Rue de la Capellière\n\n50190   PERIERS', '02-33-46-69-67', '', '', '', 'rl', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'BELHAIRE', 'BELHAIRE', NULL);
INSERT INTO `les_usagers` VALUES (24137, 'Monsieur', 'BELHAIRE', 'Vincent', '22, Rue de la Capellière\n\n50190   PERIERS', '02-33-46-69-67', '', '', '', 'app', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'VBELHAIRE', 'VBELHAIRE', NULL);
INSERT INTO `les_usagers` VALUES (24138, 'Monsieur', 'HENUT', 'Patrice', '260, Rue des noisetiers\n\n50110   TOURLAVILLE', '02-33-28-88-88', '', '', '', 'ma', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PHENUT', 'PHENUT', NULL);
INSERT INTO `les_usagers` VALUES (24139, 'Mademoiselle', 'CAPRON', '', '3, Route de la Sensurière\n\n50270   SURTAINVILLE', '06-16-39-90-76', '', '', '', 'rl', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CAPRON', 'CAPRON', NULL);
INSERT INTO `les_usagers` VALUES (24140, 'Mademoiselle', 'CAPRON', 'Gaêlle', '3, Route de la Sensurière\n\n50270   SURTAINVILLE', '06-16-39-90-76', '', '', '', 'app', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GCAPRON', 'GCAPRON', NULL);
INSERT INTO `les_usagers` VALUES (24141, 'Monsieur', 'GROSBOIS', 'Didier', 'Z.A du Pré Barreau\n\n49630   MAZE', '02-41-54-31-22', '', '', '', 'ma', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DGROSBOIS', 'DGROSBOIS', NULL);
INSERT INTO `les_usagers` VALUES (24142, 'Monsieur', 'CORNU', '', '24, Rue du Collège\n\n49160   LONGUE-JUMELLES', '02-41-52-68-57', '', '', '', 'rl', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CORNU', 'CORNU', NULL);
INSERT INTO `les_usagers` VALUES (24143, 'Monsieur', 'CORNU', 'François', '24, Rue du Collège\n\n49160   LONGUE-JUMELLES', '02-41-52-68-57', '', '', '', 'app', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FCORNU', 'FCORNU', NULL);
INSERT INTO `les_usagers` VALUES (24144, 'Monsieur', 'PLANCHENAULT', 'Pierre', '\n\n14550   BLAINVILLE-SUR-ORNE', '02-31-70-54-57', '', '', '', 'ma', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PPLANCHENAULT', 'PPLANCHENAULT', NULL);
INSERT INTO `les_usagers` VALUES (24145, 'Monsieur', 'FRITIAU', 'Erwan', '10, Village de la Roulais\n\n35300   FOUGERES', '06-26-25-87-51', '', '', '', 'rl', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_EFRITIAU', 'EFRITIAU', NULL);
INSERT INTO `les_usagers` VALUES (24146, 'Monsieur', 'FRITIAU', 'Erwan', '10, Village de la Roulais\n\n35300   FOUGERES', '06-26-25-87-51', '', '', '', 'app', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'EFRITIAU', 'EFRITIAU', NULL);
INSERT INTO `les_usagers` VALUES (24147, 'Monsieur', 'TALONNEAU', 'PATRICK', 'ZI De Toul Garros\n\n56400   AURAY', '02-97-56-65-21', '', '', '', 'ma', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PTALONNEAU', 'PTALONNEAU', NULL);
INSERT INTO `les_usagers` VALUES (24148, 'Monsieur', 'LE GOHEREL', '', '3, Impasse Saint-Fiacre\n\n56340   CARNAC', '02-97-52-98-14', '', '', '', 'rl', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'LGOHEREL', 'LGOHEREL', NULL);
INSERT INTO `les_usagers` VALUES (24149, 'Monsieur', 'LE GOHEBEL', 'Vincent', '3, Impasse Saint-Fiacre\n\n56340   CARNAC', '02-97-52-98-14', '', '', '', 'app', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'VLGOHEBEL', 'VLGOHEBEL', NULL);
INSERT INTO `les_usagers` VALUES (24150, 'Monsieur', 'PORCHER', 'Alain', 'Les Petites Buttes\n\n35600   BAINS-SUR-OUST', '02-99-91-74-11', '', '', '', 'ma', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'APORCHER', 'APORCHER', NULL);
INSERT INTO `les_usagers` VALUES (24151, 'Monsieur', 'LEGLAND', '', 'La Pierre Blanche\n\n53000   LAVAL', '02-99-71-96-99', '', '', '', 'rl', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'LEGLAND', 'LEGLAND', NULL);
INSERT INTO `les_usagers` VALUES (24152, 'Monsieur', 'LEGLAND', 'Guillaume', 'La Pierre Blanche\n\n53000   LAVAL', '02-99-71-96-99', '', '', '', 'app', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GLEGLAND', 'GLEGLAND', NULL);
INSERT INTO `les_usagers` VALUES (24153, 'Madame', 'BEDOUAIN', 'Patricia', '130 avenue de Mayenne\n\n53000   LAVAL', '02-43-49-42-00', '', '', '', 'ma', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PBEDOUAIN', 'PBEDOUAIN', NULL);
INSERT INTO `les_usagers` VALUES (24154, 'Monsieur', 'MIEGE', '', '111, Rue Marcel Sembat\n\n50120   EQUEURDREVILLE HAINNEVILLE', '', '', '', '', 'rl', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MIEGE', 'MIEGE', NULL);
INSERT INTO `les_usagers` VALUES (24155, 'Monsieur', 'MIEGE', 'Grégory', '111, Rue Marcel Sembat\n\n50120   EQUEURDREVILLE HAINNEVILLE', '', '', '', '', 'app', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GMIEGE', 'GMIEGE', NULL);
INSERT INTO `les_usagers` VALUES (24156, 'Monsieur', 'LEGARE', 'Philippe', 'Rue Robert Surmont\n\n72400   LA FERTE-BERNARD', '02-43-60-33-00', '', '', '', 'ma', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'PLEGARE', 'PLEGARE', NULL);
INSERT INTO `les_usagers` VALUES (24157, 'Monsieur', 'VERITE', '', '3, Rue des Tilleuls\n\n72550   LA QUINTE', '02-43-27-76-70', '', '', '', 'rl', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'VERITE', 'VERITE', NULL);
INSERT INTO `les_usagers` VALUES (24158, 'Monsieur', 'VERITE', 'Denis', '3, Rue des Tilleuls\n\n72550   LA QUINTE', '02-43-27-76-70', '', '', '', 'app', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DVERITE', 'DVERITE', NULL);
INSERT INTO `les_usagers` VALUES (24159, 'Monsieur', 'GIRARD', 'Dominique', '50, Avenue du Préfet\n\n53032   LAVAL CEDEX 9', '02-43-49-66-00', '', '', '', 'ma', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'DGIRARD', 'DGIRARD', NULL);
INSERT INTO `les_usagers` VALUES (24160, 'Monsieur', 'AUDIGE', 'Mickael', '3, Rue Haute Follis\n\n53000   LAVAL', '02-43-69-29-81', '06-25-74-94-00', '', '', 'rl', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_MAUDIGE', 'MAUDIGE', NULL);
INSERT INTO `les_usagers` VALUES (24161, 'Monsieur', 'AUDIGE', 'Mickael', '3, Rue Haute Follis\n\n53000   LAVAL', '02-43-69-29-81', '06-25-74-94-00', '', '', 'app', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'MAUDIGE', 'MAUDIGE', NULL);
INSERT INTO `les_usagers` VALUES (24162, 'Monsieur', 'GAUBERT', 'Jean-Pierre', 'Route de Fougères\n\n53120   GORRON', '02-43-08-49-49', '', '', '', 'ma', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JGAUBERT', 'JGAUBERT', NULL);
INSERT INTO `les_usagers` VALUES (24163, 'Monsieur', 'BOCHER', 'Julien', '5, Rue Jean Grimaud\n\n53000   LAVAL', '02-97-26-69-17', '', '', '', 'rl', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_JBOCHER', 'JBOCHER', NULL);
INSERT INTO `les_usagers` VALUES (24164, 'Monsieur', 'BOCHER', 'Julien', '5, Rue Jean Grimaud\n\n53000   LAVAL', '02-97-26-69-17', '', '', '', 'app', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JBOCHER', 'JBOCHER', NULL);
INSERT INTO `les_usagers` VALUES (24165, 'Monsieur', 'CAMPAGNE', 'Frédéric', 'Rue des Frères Lumière\n\n53230   COSSE LE VIVIEN', '02-43-98-27-76', '', '', '', 'ma', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FCAMPAGNE', 'FCAMPAGNE', NULL);
INSERT INTO `les_usagers` VALUES (24166, 'Monsieur', 'BOIN', 'Jérôme', 'La Touche Godet\n\n35370   LE PERTRE', '02-43-98-27-76', '', '', '', 'rl', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_JBOIN', 'JBOIN', NULL);
INSERT INTO `les_usagers` VALUES (24167, 'Monsieur', 'BOIN', 'Jérôme', 'La Touche Godet\n\n35370   LE PERTRE', '02-43-98-27-76', '', '', '', 'app', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JBOIN', 'JBOIN', NULL);
INSERT INTO `les_usagers` VALUES (24168, 'Monsieur', 'LEVRARD', 'Laurent', '15, Avenue Pierre Piffault\n\n72086   LE MANS CEDEX', '02-43-16-42-34', '', '', '', 'ma', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'LLEVRARD', 'LLEVRARD', NULL);
INSERT INTO `les_usagers` VALUES (24169, 'Monsieur', 'BRIARD', 'Jean', 'La Grande  Sapinière\n\n72250   CHALLES', '02-43-75-98-12', '', '', '', 'rl', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_JBRIARD', 'JBRIARD', NULL);
INSERT INTO `les_usagers` VALUES (24170, 'Monsieur', 'BRIARD', 'Jean', 'La Grande  Sapinière\n\n72250   CHALLES', '02-43-75-98-12', '', '', '', 'app', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JBRIARD', 'JBRIARD', NULL);
INSERT INTO `les_usagers` VALUES (24171, 'Monsieur', 'TREMBLAY', 'Guy', 'Avenue d''Angers\n\n53032   LAVAL', '02-43-49-80-00', '', '', '', 'ma', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'GTREMBLAY', 'GTREMBLAY', NULL);
INSERT INTO `les_usagers` VALUES (24172, 'Monsieur', 'BURON', 'Stéphane', '4, Rue des Anciens Combattants\n\n53000   LAVAL', '06-19-91-26-89', '', '', '', 'rl', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_SBURON', 'SBURON', NULL);
INSERT INTO `les_usagers` VALUES (24173, 'Monsieur', 'BURON', 'Stéphane', '4, Rue des Anciens Combattants\n\n53000   LAVAL', '06-19-91-26-89', '', '', '', 'app', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SBURON', 'SBURON', NULL);
INSERT INTO `les_usagers` VALUES (24174, 'Monsieur', 'TERRIER', 'Jean-Pierre', '9, Rue des Combattants\n\n53170   MESLAY-DU-MAINE', '02-43-90-93-29', '', '', '', 'ma', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'JTERRIER', 'JTERRIER', NULL);
INSERT INTO `les_usagers` VALUES (24175, 'Monsieur', 'MASSON', 'Sylvain', '1, Promenade de la Lande\n\n35640   MARTIGNE-FERCHAUD', '02-99-47-80-88', '', '', '', 'rl', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_SMASSON', 'SMASSON', NULL);
INSERT INTO `les_usagers` VALUES (24176, 'Monsieur', 'MASSON', 'Sylvain', '1, Promenade de la Lande\n\n35640   MARTIGNE-FERCHAUD', '02-99-47-80-88', '', '', '', 'app', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'SMASSON', 'SMASSON', NULL);
INSERT INTO `les_usagers` VALUES (24177, 'Monsieur', 'JUBAULT', 'Christophe', 'Route des Eaux\n\n35500   VITRE', '02-99-75-87-40', '', '', '', 'ma', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'CJUBAULT', 'CJUBAULT', NULL);
INSERT INTO `les_usagers` VALUES (24178, 'Monsieur', 'POUPARD', 'François', '12, Impasse Messidor\n\n53810   CHANGE', '02-43-56-41-38', '06-24-53-17-95', '', '', 'rl', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_FPOUPARD', 'FPOUPARD', NULL);
INSERT INTO `les_usagers` VALUES (24179, 'Monsieur', 'POUPARD', 'François', '12, Impasse Messidor\n\n53810   CHANGE', '02-43-56-41-38', '06-24-53-17-95', '', '', 'app', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'FPOUPARD', 'FPOUPARD', NULL);
INSERT INTO `les_usagers` VALUES (24180, 'Monsieur', 'DECORE', 'BERTRAND', 'Route d''Evron\n\n72140   SILLE-LE-GUILLAUME', '02-43-52-52-52', '', '', '', 'ma', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'BDECORE', 'BDECORE', NULL);
INSERT INTO `les_usagers` VALUES (24181, 'Mademoiselle', 'SEJOURNE', 'Armelle', '32, Rue du 11 Novembre 1918\n\n72140   SILLE-LE-GUILLAUME', '06-30-05-48-83', '', '', '', 'rl', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'rl_ASEJOURNE', 'ASEJOURNE', NULL);
INSERT INTO `les_usagers` VALUES (24182, 'Mademoiselle', 'SEJOURNE', 'Armelle', '32, Rue du 11 Novembre 1918\n\n72140   SILLE-LE-GUILLAUME', '06-30-05-48-83', '', '', '', 'app', 0x323030362d30392d3235, 0x303030302d30302d30302030303a30303a3030, 0, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 'ASEJOURNE', 'ASEJOURNE', NULL);

-- 
-- Contraintes pour les tables exportées
-- 

-- 
-- Contraintes pour la table `acteurs_espace`
-- 
ALTER TABLE `acteurs_espace`
  ADD CONSTRAINT `acteurs_espace_ibfk_1` FOREIGN KEY (`id_espace`) REFERENCES `espace` (`id_espace`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `acteurs_espace_ibfk_2` FOREIGN KEY (`id_acteur`) REFERENCES `les_usagers` (`id_usager`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `espace`
-- 
ALTER TABLE `espace`
  ADD CONSTRAINT `espace_ibfk_1` FOREIGN KEY (`id_createur_espace`) REFERENCES `les_usagers` (`id_usager`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `espace_partage`
-- 
ALTER TABLE `espace_partage`
  ADD CONSTRAINT `espace_partage_ibfk_1` FOREIGN KEY (`lien_id_espace`) REFERENCES `espace` (`id_espace`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `espace_partage_ibfk_2` FOREIGN KEY (`id_auteur_espace_partage`) REFERENCES `les_usagers` (`id_usager`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_apprentis`
-- 
ALTER TABLE `les_apprentis`
  ADD CONSTRAINT `les_apprentis_ibfk_1` FOREIGN KEY (`id_app`) REFERENCES `les_usagers` (`id_usager`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_arbres`
-- 
ALTER TABLE `les_arbres`
  ADD CONSTRAINT `les_arbres_ibfk_1` FOREIGN KEY (`id_config`) REFERENCES `les_configs_lea` (`id_config`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_chartes_graphiques`
-- 
ALTER TABLE `les_chartes_graphiques`
  ADD CONSTRAINT `les_chartes_graphiques_ibfk_1` FOREIGN KEY (`id_for`) REFERENCES `les_formations` (`id_for`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_choix_modalite_multiple`
-- 
ALTER TABLE `les_choix_modalite_multiple`
  ADD CONSTRAINT `les_choix_modalite_multiple_ibfk_1` FOREIGN KEY (`id_modalite`) REFERENCES `les_modalites_va_multiple` (`id_modalite`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_choix_reponse`
-- 
ALTER TABLE `les_choix_reponse`
  ADD CONSTRAINT `les_choix_reponse_ibfk_1` FOREIGN KEY (`id_modalite`) REFERENCES `les_modalites_reponse_choix` (`id_modalite`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_classes`
-- 
ALTER TABLE `les_classes`
  ADD CONSTRAINT `les_classes_ibfk_1` FOREIGN KEY (`id_for`) REFERENCES `les_formations` (`id_for`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_configs_lea`
-- 
ALTER TABLE `les_configs_lea`
  ADD CONSTRAINT `les_configs_lea_ibfk_1` FOREIGN KEY (`id_for`) REFERENCES `les_formations` (`id_for`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_declarations`
-- 
ALTER TABLE `les_declarations`
  ADD CONSTRAINT `les_declarations_ibfk_1` FOREIGN KEY (`id_app`) REFERENCES `les_apprentis` (`id_app`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `les_declarations_ibfk_2` FOREIGN KEY (`id_periode`) REFERENCES `les_periodes` (`id_periode`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_declarations_modalite_reponse_choix`
-- 
ALTER TABLE `les_declarations_modalite_reponse_choix`
  ADD CONSTRAINT `les_declarations_modalite_reponse_choix_ibfk_1` FOREIGN KEY (`id_dec`) REFERENCES `les_declarations` (`id_dec`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `les_declarations_modalite_reponse_choix_ibfk_2` FOREIGN KEY (`id_reponse`) REFERENCES `les_choix_reponse` (`id_reponse`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_declarations_modalite_reponse_libre`
-- 
ALTER TABLE `les_declarations_modalite_reponse_libre`
  ADD CONSTRAINT `les_declarations_modalite_reponse_libre_ibfk_1` FOREIGN KEY (`id_dec`) REFERENCES `les_declarations` (`id_dec`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `les_declarations_modalite_reponse_libre_ibfk_2` FOREIGN KEY (`id_modalite`) REFERENCES `les_modalites_reponse_libre` (`id_modalite`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_documents_declares`
-- 
ALTER TABLE `les_documents_declares`
  ADD CONSTRAINT `les_documents_declares_ibfk_1` FOREIGN KEY (`id_dec`) REFERENCES `les_declarations` (`id_dec`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_enseignants`
-- 
ALTER TABLE `les_enseignants`
  ADD CONSTRAINT `les_enseignants_ibfk_1` FOREIGN KEY (`id_ens`) REFERENCES `les_usagers` (`id_usager`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_enseignants_formations`
-- 
ALTER TABLE `les_enseignants_formations`
  ADD CONSTRAINT `les_enseignants_formations_ibfk_1` FOREIGN KEY (`id_ens`) REFERENCES `les_enseignants` (`id_ens`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `les_enseignants_formations_ibfk_2` FOREIGN KEY (`id_for`) REFERENCES `les_formations` (`id_for`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_evaluations_feuilles_modalite_choix`
-- 
ALTER TABLE `les_evaluations_feuilles_modalite_choix`
  ADD CONSTRAINT `les_evaluations_feuilles_modalite_choix_ibfk_1` FOREIGN KEY (`id_choix`) REFERENCES `les_choix_modalite_multiple` (`id_choix`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_evaluations_feuilles_modalite_va_unique`
-- 
ALTER TABLE `les_evaluations_feuilles_modalite_va_unique`
  ADD CONSTRAINT `les_evaluations_feuilles_modalite_va_unique_ibfk_1` FOREIGN KEY (`id_modalite`) REFERENCES `les_modalites_va_unique` (`id_modalite`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_feuilles_declarees`
-- 
ALTER TABLE `les_feuilles_declarees`
  ADD CONSTRAINT `les_feuilles_declarees_ibfk_1` FOREIGN KEY (`id_noeud`) REFERENCES `les_noeuds` (`id_noeud`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `les_feuilles_declarees_ibfk_2` FOREIGN KEY (`id_dec`) REFERENCES `les_declarations` (`id_dec`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_feuilles_declarees_modalite_choix`
-- 
ALTER TABLE `les_feuilles_declarees_modalite_choix`
  ADD CONSTRAINT `les_feuilles_declarees_modalite_choix_ibfk_1` FOREIGN KEY (`id_noeud`) REFERENCES `les_noeuds` (`id_noeud`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `les_feuilles_declarees_modalite_choix_ibfk_2` FOREIGN KEY (`id_choix`) REFERENCES `les_choix_modalite_multiple` (`id_choix`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `les_feuilles_declarees_modalite_choix_ibfk_3` FOREIGN KEY (`id_dec`) REFERENCES `les_declarations` (`id_dec`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_feuilles_declarees_modalite_va_unique`
-- 
ALTER TABLE `les_feuilles_declarees_modalite_va_unique`
  ADD CONSTRAINT `les_feuilles_declarees_modalite_va_unique_ibfk_1` FOREIGN KEY (`id_noeud`) REFERENCES `les_noeuds` (`id_noeud`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `les_feuilles_declarees_modalite_va_unique_ibfk_2` FOREIGN KEY (`id_modalite`) REFERENCES `les_modalites_va_unique` (`id_modalite`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `les_feuilles_declarees_modalite_va_unique_ibfk_3` FOREIGN KEY (`id_dec`) REFERENCES `les_declarations` (`id_dec`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_formations`
-- 
ALTER TABLE `les_formations`
  ADD CONSTRAINT `les_formations_ibfk_1` FOREIGN KEY (`id_unite`) REFERENCES `les_unites_pedagogiques` (`id_unite`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_maitres_apprentissage`
-- 
ALTER TABLE `les_maitres_apprentissage`
  ADD CONSTRAINT `les_maitres_apprentissage_ibfk_1` FOREIGN KEY (`id_ma`) REFERENCES `les_usagers` (`id_usager`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_messages`
-- 
ALTER TABLE `les_messages`
  ADD CONSTRAINT `les_messages_ibfk_1` FOREIGN KEY (`id_usager`) REFERENCES `les_usagers` (`id_usager`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_messages_recus_usagers`
-- 
ALTER TABLE `les_messages_recus_usagers`
  ADD CONSTRAINT `les_messages_recus_usagers_ibfk_1` FOREIGN KEY (`id_msg`) REFERENCES `les_messages` (`id_msg`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `les_messages_recus_usagers_ibfk_2` FOREIGN KEY (`id_usager`) REFERENCES `les_usagers` (`id_usager`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_modalites_reponse_choix`
-- 
ALTER TABLE `les_modalites_reponse_choix`
  ADD CONSTRAINT `les_modalites_reponse_choix_ibfk_1` FOREIGN KEY (`id_config`) REFERENCES `les_configs_lea` (`id_config`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_modalites_reponse_libre`
-- 
ALTER TABLE `les_modalites_reponse_libre`
  ADD CONSTRAINT `les_modalites_reponse_libre_ibfk_1` FOREIGN KEY (`id_config`) REFERENCES `les_configs_lea` (`id_config`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_modalites_va_multiple`
-- 
ALTER TABLE `les_modalites_va_multiple`
  ADD CONSTRAINT `les_modalites_va_multiple_ibfk_1` FOREIGN KEY (`id_arbre`) REFERENCES `les_arbres` (`id_arbre`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_modalites_va_unique`
-- 
ALTER TABLE `les_modalites_va_unique`
  ADD CONSTRAINT `les_modalites_va_unique_ibfk_1` FOREIGN KEY (`id_arbre`) REFERENCES `les_arbres` (`id_arbre`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_niveaux_arbre`
-- 
ALTER TABLE `les_niveaux_arbre`
  ADD CONSTRAINT `les_niveaux_arbre_ibfk_1` FOREIGN KEY (`id_arbre`) REFERENCES `les_arbres` (`id_arbre`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_noeuds`
-- 
ALTER TABLE `les_noeuds`
  ADD CONSTRAINT `les_noeuds_ibfk_1` FOREIGN KEY (`id_arbre`) REFERENCES `les_arbres` (`id_arbre`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_periodes`
-- 
ALTER TABLE `les_periodes`
  ADD CONSTRAINT `les_periodes_ibfk_1` FOREIGN KEY (`id_for`) REFERENCES `les_formations` (`id_for`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_periodes_classes`
-- 
ALTER TABLE `les_periodes_classes`
  ADD CONSTRAINT `les_periodes_classes_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `les_periodes` (`id_periode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `les_periodes_classes_ibfk_2` FOREIGN KEY (`id_cla`) REFERENCES `les_classes` (`id_cla`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_periodes_modalite_reponse_choix`
-- 
ALTER TABLE `les_periodes_modalite_reponse_choix`
  ADD CONSTRAINT `les_periodes_modalite_reponse_choix_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `les_periodes` (`id_periode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `les_periodes_modalite_reponse_choix_ibfk_2` FOREIGN KEY (`id_modalite`) REFERENCES `les_modalites_reponse_choix` (`id_modalite`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_periodes_modalite_reponse_libre`
-- 
ALTER TABLE `les_periodes_modalite_reponse_libre`
  ADD CONSTRAINT `les_periodes_modalite_reponse_libre_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `les_periodes` (`id_periode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `les_periodes_modalite_reponse_libre_ibfk_2` FOREIGN KEY (`id_modalite`) REFERENCES `les_modalites_reponse_libre` (`id_modalite`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_periodes_modalite_va_multiple`
-- 
ALTER TABLE `les_periodes_modalite_va_multiple`
  ADD CONSTRAINT `les_periodes_modalite_va_multiple_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `les_periodes` (`id_periode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `les_periodes_modalite_va_multiple_ibfk_2` FOREIGN KEY (`id_modalite`) REFERENCES `les_modalites_va_multiple` (`id_modalite`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_periodes_modalite_va_unique`
-- 
ALTER TABLE `les_periodes_modalite_va_unique`
  ADD CONSTRAINT `les_periodes_modalite_va_unique_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `les_periodes` (`id_periode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `les_periodes_modalite_va_unique_ibfk_2` FOREIGN KEY (`id_modalite`) REFERENCES `les_modalites_va_unique` (`id_modalite`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_representants_legaux`
-- 
ALTER TABLE `les_representants_legaux`
  ADD CONSTRAINT `les_representants_legaux_ibfk_1` FOREIGN KEY (`id_rl`) REFERENCES `les_usagers` (`id_usager`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_responsables_unites_pedagogiques`
-- 
ALTER TABLE `les_responsables_unites_pedagogiques`
  ADD CONSTRAINT `les_responsables_unites_pedagogiques_ibfk_1` FOREIGN KEY (`id_rvs`) REFERENCES `les_usagers` (`id_usager`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_signatures_declarations`
-- 
ALTER TABLE `les_signatures_declarations`
  ADD CONSTRAINT `les_signatures_declarations_ibfk_1` FOREIGN KEY (`id_dec`) REFERENCES `les_declarations` (`id_dec`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `les_signatures_declarations_ibfk_2` FOREIGN KEY (`id_usager`) REFERENCES `les_usagers` (`id_usager`) ON DELETE CASCADE ON UPDATE CASCADE;
