-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Vendredi 30 Juin 2006 à 17:29
-- Version du serveur: 4.1.9
-- Version de PHP: 4.3.10
-- 
-- Base de données: `lea2`
-- 

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

INSERT INTO `acteurs_espace` VALUES (1, 20867, 1);
INSERT INTO `acteurs_espace` VALUES (1, 20871, 1);
INSERT INTO `acteurs_espace` VALUES (1, 20896, 0);
INSERT INTO `acteurs_espace` VALUES (1, 20897, 1);
INSERT INTO `acteurs_espace` VALUES (1, 20899, 1);
INSERT INTO `acteurs_espace` VALUES (8, 20896, 1);
INSERT INTO `acteurs_espace` VALUES (8, 20897, 1);
INSERT INTO `acteurs_espace` VALUES (8, 20899, 1);
INSERT INTO `acteurs_espace` VALUES (11, 20896, 0);
INSERT INTO `acteurs_espace` VALUES (11, 20897, 1);
INSERT INTO `acteurs_espace` VALUES (19, 20867, 1);
INSERT INTO `acteurs_espace` VALUES (19, 20896, 1);
INSERT INTO `acteurs_espace` VALUES (19, 20899, 1);
INSERT INTO `acteurs_espace` VALUES (21, 20867, 1);
INSERT INTO `acteurs_espace` VALUES (21, 20899, 1);

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
  `id_createur_espace` int(10) unsigned NOT NULL default '0',
  `date_creation_espace` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id_espace`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

-- 
-- Contenu de la table `espace`
-- 

INSERT INTO `espace` VALUES (1, 'zeze', 20896, '2006-06-26 09:04:13');
INSERT INTO `espace` VALUES (4, 'azeaze', 20897, '2006-06-28 13:40:01');
INSERT INTO `espace` VALUES (5, 'sdffsdfsd', 20897, '2006-06-28 13:43:46');
INSERT INTO `espace` VALUES (6, 'sdsd', 20897, '2006-06-28 14:21:23');
INSERT INTO `espace` VALUES (7, 'sdqsd', 20897, '2006-06-28 14:21:35');
INSERT INTO `espace` VALUES (8, 'vxv', 20897, '2006-06-28 14:22:12');
INSERT INTO `espace` VALUES (9, 'xcvx', 20897, '2006-06-28 14:22:21');
INSERT INTO `espace` VALUES (10, 'bcv', 20897, '2006-06-28 14:23:12');
INSERT INTO `espace` VALUES (11, 'vbcxvbc', 20897, '2006-06-28 14:23:18');
INSERT INTO `espace` VALUES (13, 'cbcbv', 20897, '2006-06-28 14:23:29');
INSERT INTO `espace` VALUES (14, 'cvb', 20897, '2006-06-28 14:23:39');
INSERT INTO `espace` VALUES (15, 'cvb', 20897, '2006-06-28 14:23:46');
INSERT INTO `espace` VALUES (19, 'ssdfqsf', 20867, '2006-06-28 16:05:52');
INSERT INTO `espace` VALUES (21, 'fsdsdf', 20867, '2006-06-29 19:54:40');

-- --------------------------------------------------------

-- 
-- Structure de la table `espace_partage`
-- 

CREATE TABLE `espace_partage` (
  `id_espace_partage` int(10) unsigned NOT NULL auto_increment,
  `com_espace_partage` text NOT NULL,
  `date_ajout` datetime NOT NULL default '0000-00-00 00:00:00',
  `id_auteur_espace_partage` int(10) unsigned NOT NULL default '0',
  `nom_fichier` varchar(255) NOT NULL default '',
  `lien_id_espace` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_espace_partage`),
  KEY `lien_id_espace` (`lien_id_espace`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Contenu de la table `espace_partage`
-- 

INSERT INTO `espace_partage` VALUES (1, 'test', '2006-06-26 10:37:25', 20896, '', 1);

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

INSERT INTO `les_apprentis` VALUES (20867, '1989-11-14', '3857', '', '', 'AUCUN DIPLOME', '', '', '', '', '2006-05-18', '2006-05-18', 19, 20897, 20896, 20895);
INSERT INTO `les_apprentis` VALUES (20871, '1988-09-02', '4070', '', '', 'AUCUN DIPLOME', '', '', '', '', '0000-00-00', '0000-00-00', 19, 20897, 20899, 20898);
INSERT INTO `les_apprentis` VALUES (20874, '1990-01-12', '3967', '', '', 'BREVET', '', '', '', '', '0000-00-00', '0000-00-00', 19, 20900, 20899, 20901);
INSERT INTO `les_apprentis` VALUES (20877, '1989-09-20', '3859', '', '', 'C.F.G.', '', '', '', '', '0000-00-00', '0000-00-00', 19, 20902, 20896, 20903);
INSERT INTO `les_apprentis` VALUES (20880, '1985-12-04', '4089', '', '', 'AUCUN DIPLOME', '', '', '', '', '0000-00-00', '0000-00-00', 19, 20904, 20899, 20905);
INSERT INTO `les_apprentis` VALUES (20883, '1989-07-11', '3910', '', '', 'AUCUN DIPLOME', '', '', '', '', '0000-00-00', '0000-00-00', 19, 20906, 20899, 20907);
INSERT INTO `les_apprentis` VALUES (20886, '1987-08-21', '3950', '', '', 'AUCUN DIPLOME', '', '', '', '', '0000-00-00', '0000-00-00', 19, 20908, 20899, 20909);
INSERT INTO `les_apprentis` VALUES (20889, '1988-04-09', '4063', '', '', 'AUCUN DIPLOME', '', '', '', '', '0000-00-00', '0000-00-00', 19, 20910, 20899, 20911);
INSERT INTO `les_apprentis` VALUES (20891, '1990-08-11', '3856', '', '', 'BREVET', '', '', '', '', '0000-00-00', '0000-00-00', 19, 0, 20896, 20912);
INSERT INTO `les_apprentis` VALUES (20893, '1989-11-21', '4088', '', '', 'C.F.G.', '', '', '', '', '0000-00-00', '0000-00-00', 19, 20904, 20899, 20913);
INSERT INTO `les_apprentis` VALUES (20915, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, 0, 0, 0);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_arbres`
-- 

CREATE TABLE `les_arbres` (
  `id_arbre` bigint(20) NOT NULL auto_increment,
  `nom` varchar(100) NOT NULL default '',
  `type` varchar(10) NOT NULL default '',
  `id_config` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_arbre`),
  KEY `id_config` (`id_config`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- 
-- Contenu de la table `les_arbres`
-- 

INSERT INTO `les_arbres` VALUES (7, 'Référentiel métiers', 'entr', 1);
INSERT INTO `les_arbres` VALUES (8, 'Arbre des matières', '', 1);
INSERT INTO `les_arbres` VALUES (11, 'Référentiel', 'cfa', 1);
INSERT INTO `les_arbres` VALUES (13, 'Matières', 'cfa', 1);
INSERT INTO `les_arbres` VALUES (14, 'Programme de Math', 'cfa', 1);
INSERT INTO `les_arbres` VALUES (15, 'Compétences développées', 'entr', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Contenu de la table `les_chartes_graphiques`
-- 

INSERT INTO `les_chartes_graphiques` VALUES (1, '16_logo.png', '', '16_img_accueil.png', 16);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

-- 
-- Contenu de la table `les_choix_modalite_multiple`
-- 

INSERT INTO `les_choix_modalite_multiple` VALUES (1, 'acquise', 1);
INSERT INTO `les_choix_modalite_multiple` VALUES (2, 'non acquise', 1);
INSERT INTO `les_choix_modalite_multiple` VALUES (3, 'Terminé', 2);
INSERT INTO `les_choix_modalite_multiple` VALUES (5, 'avec aide', 3);
INSERT INTO `les_choix_modalite_multiple` VALUES (6, 'en autonomie', 3);
INSERT INTO `les_choix_modalite_multiple` VALUES (7, 'C1', 4);
INSERT INTO `les_choix_modalite_multiple` VALUES (8, 'C2', 4);
INSERT INTO `les_choix_modalite_multiple` VALUES (9, 'C3', 4);
INSERT INTO `les_choix_modalite_multiple` VALUES (10, 'C4', 4);
INSERT INTO `les_choix_modalite_multiple` VALUES (11, 'C5', 4);
INSERT INTO `les_choix_modalite_multiple` VALUES (12, 'C6', 4);
INSERT INTO `les_choix_modalite_multiple` VALUES (13, 'C7', 4);
INSERT INTO `les_choix_modalite_multiple` VALUES (14, 'C8', 4);
INSERT INTO `les_choix_modalite_multiple` VALUES (15, 'C9', 4);
INSERT INTO `les_choix_modalite_multiple` VALUES (16, 'C10', 4);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- 
-- Contenu de la table `les_choix_reponse`
-- 

INSERT INTO `les_choix_reponse` VALUES (3, 'B', 2);
INSERT INTO `les_choix_reponse` VALUES (4, 'M', 2);
INSERT INTO `les_choix_reponse` VALUES (5, 'AB', 2);
INSERT INTO `les_choix_reponse` VALUES (6, 'Bien', 3);
INSERT INTO `les_choix_reponse` VALUES (7, 'moyen', 3);
INSERT INTO `les_choix_reponse` VALUES (8, 'passable', 3);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

-- 
-- Contenu de la table `les_classes`
-- 

INSERT INTO `les_classes` VALUES (19, 'MAv1', 1, 16, 0);
INSERT INTO `les_classes` VALUES (20, 'Mav2', 2, 16, 0);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_configs_lea`
-- 

CREATE TABLE `les_configs_lea` (
  `id_config` bigint(20) NOT NULL auto_increment,
  `suivi_entr_guide_actif` binary(1) NOT NULL default '0',
  `suivi_entr_libre_actif` binary(1) NOT NULL default '0',
  `suivi_cfa_guide_actif` binary(1) NOT NULL default '0',
  `suivi_cfa_libre_actif` binary(1) NOT NULL default '0',
  `appelation_ma` varchar(50) NOT NULL default '',
  `appelation_tuteur_cfa` varchar(50) NOT NULL default '',
  `DMSA_dec_entr` tinyint(4) NOT NULL default '0',
  `DMSA_dec_cfa` tinyint(4) NOT NULL default '0',
  `app_joint_fichiers_suivi_entr` binary(1) NOT NULL default '1',
  `app_joint_fichiers_suivi_cfa` binary(1) NOT NULL default '1',
  `id_for` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_config`),
  KEY `id_for` (`id_for`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Contenu de la table `les_configs_lea`
-- 

INSERT INTO `les_configs_lea` VALUES (1, 0x31, 0x31, 0x31, 0x31, 'maitre apprentissage', 'TUTEUR', 15, 15, 0x30, 0x31, 16);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- 
-- Contenu de la table `les_declarations`
-- 

INSERT INTO `les_declarations` VALUES (4, 20867, 3, '2006-06-07', 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (5, 20867, 2, '2006-06-07', 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (6, 20867, 1, '2006-06-07', 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (7, 20867, 4, '2006-06-07', 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (8, 20867, 3, '2006-06-07', 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (9, 20867, 4, '2006-06-09', 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (10, 20867, 2, '2006-06-09', 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (11, 20867, 1, '2006-06-09', 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (12, 20874, 2, '2006-06-14', 'nv', 'cfa');
INSERT INTO `les_declarations` VALUES (13, 20867, 5, '2006-06-15', 'nv', 'entr');
INSERT INTO `les_declarations` VALUES (14, 20867, 6, '2006-06-20', 'nv', 'entr');

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

INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (4, 2, 4);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (5, 2, 4);
INSERT INTO `les_declarations_modalite_reponse_choix` VALUES (10, 2, 4);

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

INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (5, 2, 'sdsdfsdfsdf');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (6, 2, 'sdsdfsdfsdf');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (7, 1, 'sdsf');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (8, 1, 'ok');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (10, 1, 'bien travaillé\r\nok');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (11, 1, 'sdsf');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (12, 2, 'sdfsfd sfsfd');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (13, 2, 'sdsdfsdfsdf');
INSERT INTO `les_declarations_modalite_reponse_libre` VALUES (14, 2, 'sdsdfsdfsdf');

-- --------------------------------------------------------

-- 
-- Structure de la table `les_documents_declares`
-- 

CREATE TABLE `les_documents_declares` (
  `id_doc` bigint(20) NOT NULL auto_increment,
  `src_doc` varchar(100) NOT NULL default '',
  `confidentialite` binary(1) NOT NULL default '1',
  `id_dec` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_doc`),
  KEY `id_dec` (`id_dec`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- 
-- Contenu de la table `les_documents_declares`
-- 

INSERT INTO `les_documents_declares` VALUES (4, 'image_.png', 0x30, 7);
INSERT INTO `les_documents_declares` VALUES (11, 'fond_.jpeg', 0x30, 12);

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

INSERT INTO `les_enseignants` VALUES (20896, '');
INSERT INTO `les_enseignants` VALUES (20899, '');

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

INSERT INTO `les_enseignants_formations` VALUES (20896, 16);
INSERT INTO `les_enseignants_formations` VALUES (20899, 16);

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=505 ;

-- 
-- Contenu de la table `les_entreprises`
-- 

INSERT INTO `les_entreprises` VALUES (1, 'BOURSIER  CHRISTOPHE', '6 rue Echelle Marteau\n', 53000, 'LAVAL', '02-43-53-15-85', '', '', '', '', '', 'BOURSIER', 'CHRISTOPHE', 1, 0);
INSERT INTO `les_entreprises` VALUES (2, 'RENOUARD  Sébastien', '7, Place Jean Buchet\n', 53800, 'LA SELLE-CRAONNAISE', '02-43-06-17-68', '06-80-81-02-71', '', '', '', '', 'RENOUARD', 'Sébastien', 0, 0);
INSERT INTO `les_entreprises` VALUES (3, 'HOUDAYER  Marc', '1 rue René D''Anjou\n', 53200, 'CHATEAU GONTIER', '', '', '', '', '', '', 'HOUDAYER', 'Marc', 5, 0);
INSERT INTO `les_entreprises` VALUES (4, 'CHEVY  BERTRAND', '64 rue de Rennes\n', 53000, 'LAVAL', '02-43-68-26-34', '', '', '', '', '', 'CHEVY', 'BERTRAND', 4, 0);
INSERT INTO `les_entreprises` VALUES (5, 'CADOT  DOMINIQUE', '8, Rue de Laval\n', 53970, 'L''HUISSERIE', '02-43-69-62-28', '', '', '', '', '', 'CADOT', 'DOMINIQUE', 4, 0);
INSERT INTO `les_entreprises` VALUES (6, 'DERVAL  MOISE', '24 avenue de Chanzy\n', 53000, 'LAVAL', '02-43-53-20-98', '', '02-43-49-17-82', '', '', '', 'DERVAL', 'MOISE', 5, 0);
INSERT INTO `les_entreprises` VALUES (7, 'MAUDET  JEAN-CHRISTOPHE', '2, Place de l''Eglise\n', 53210, 'ARGENTRE', '02-43-37-31-12', '', '', '', '', '', 'MAUDET', 'JEAN-CHRISTOPHE', 2, 0);
INSERT INTO `les_entreprises` VALUES (8, 'MEZIERE  PHILIPPE', '4 rue Relais des Diligences\n', 53390, 'ST AIGNAN S/ROE', '02-43-06-51-22', '', '', '', '', '', 'MEZIERE', 'PHILIPPE', 4, 0);
INSERT INTO `les_entreprises` VALUES (9, 'HUBERT  Yohann', '34, Rue du Coq Hardi\n', 72140, 'SILLE-LE-GUILLAUME', '02-43-20-17-15', '', '', '', '', '', 'HUBERT', 'Yohann', 1, 0);
INSERT INTO `les_entreprises` VALUES (10, 'GORGUIS  Raif', '50 rue Fabre d''Eglantine \n ', 53810, 'CHANGE', '02-43-58-11-99', '', '02-43-49-22-49', '', '', '', 'GORGUIS', 'Raif', 0, 0);
INSERT INTO `les_entreprises` VALUES (11, '', 'ZA LES VIGNES \n ', 72300, 'SABLE-SUR-SARTHE', '02-43-62-12-00', '02-43-62-12-01', '', '', '', '', '', '', 0, 0);
INSERT INTO `les_entreprises` VALUES (240, 'BOURGINE  JEAN-YVES', '37 rue de l''Aubinière\n', 53800, 'RENAZE', '02-43-06-79-01', '', '02-43-06-76-08', '', '', '', 'BOURGINE', 'JEAN-YVES', 5, 0);
INSERT INTO `les_entreprises` VALUES (12, 'LENORMAND  Philippe', 'ZA DU PONT DE PIERRE \n ', 53240, 'ANDOUILLE', '02-43-26-16-16', '', '02-43-26-16-15', '', '', '', 'LENORMAND', 'Philippe', 19, 0);
INSERT INTO `les_entreprises` VALUES (13, 'LERAY  JEAN CHARLES', '8 RUE DU CANAL \n ', 53440, 'ARON', '02-43-04-21-50', '', '02-43-04-12-61', '', '', '', 'LERAY', 'JEAN CHARLES', 1, 0);
INSERT INTO `les_entreprises` VALUES (14, 'LEMEE  MICHEL', '1 RUE LANCELIN \n ZA DE MAUBUARD', 53600, 'EVRON', '02-43-01-60-92', '', '', '', '', '', 'LEMEE', 'MICHEL', 2, 0);
INSERT INTO `les_entreprises` VALUES (15, 'ROLLANT  Pierre', 'ZA Bd Pasteur \n ', 53800, 'RENAZE', '02-43-09-56-56', '', '02-43-09-56-57', '', '', '', 'ROLLANT', 'Pierre', 7, 0);
INSERT INTO `les_entreprises` VALUES (16, 'CESARE  NATHALIE', '166 Rue Nationale \n ', 72000, 'LE MANS', '02-43-78-00-63', '', '02-43-75-92-83', '', '', '', 'CESARE', 'NATHALIE', 4, 0);
INSERT INTO `les_entreprises` VALUES (17, 'DERRIEN  Stéphane', '14 rue du Cormier \n ', 72550, 'DEGRE', '02-43-76-21-48', '', '', '', '', '', 'DERRIEN', 'Stéphane', 5, 0);
INSERT INTO `les_entreprises` VALUES (18, 'BLANCHARD', '16 ZA du grand chemin \n ', 53970, 'L''HUISSERIE', '02-43-68-70-91', '', '02-43-68-72-17', '', '', '', 'BLANCHARD', '', 2, 0);
INSERT INTO `les_entreprises` VALUES (19, 'HOUDAYER  PASCAL', '1 RUE NATIONALE\n', 53950, 'LOUVERNE', '02-43-01-16-46', '06-87-15-83-06', '02-43-01-16-40', '', '', '', 'HOUDAYER', 'PASCAL', 0, 0);
INSERT INTO `les_entreprises` VALUES (20, 'GUION  ROLAND', 'ZA RUE DU CHENAIE\n', 53360, 'QUELAINES ST GAULT', '02-43-98-90-06', '', '02-43-91-78-05', '', '', '', 'GUION', 'ROLAND', 2, 0);
INSERT INTO `les_entreprises` VALUES (21, 'BAUDET  PHILIPPE', 'ZI DE CHEVRAY\n', 53300, 'LA HAIE TRAVERSAINE', '02-43-08-89-05', '', '02-43-08-47-59', '', '', '', 'BAUDET', 'PHILIPPE', 6, 0);
INSERT INTO `les_entreprises` VALUES (22, 'POIRIER  ALAIN', '26 rue du Fouteau\n', 53300, 'AMBRIERES LES VALLEES', '02-43-04-93-04', '', '02-43-08-85-18', '', '', '', 'POIRIER', 'ALAIN', 13, 0);
INSERT INTO `les_entreprises` VALUES (23, 'CHAINEAU  Paul', 'Place de la Mairie\n', 53400, 'CRAON', '02-43-06-99-05', '', '02-43-06-39-20', '', '', '', 'CHAINEAU', 'Paul', 0, 0);
INSERT INTO `les_entreprises` VALUES (24, 'POISSON', 'lE BOURG\n', 53220, 'LA PELLERINE', '02-43-05-93-78', '06-08-80-49-81', '02-43-05-92-20', 'poisson.garage@wanadoo.fr', '', '', 'POISSON', '', 5, 0);
INSERT INTO `les_entreprises` VALUES (26, 'LUCAS  BRUNO', '27 Rue Marcelin Berthelot\n', 53000, 'LAVAL', '02-43-49-58-50', '', '02-43-49-58-51', '', '', '', 'LUCAS', 'BRUNO', 130, 0);
INSERT INTO `les_entreprises` VALUES (27, 'ROULIN  Michel', '11 Place de la Poste\n', 53410, 'SAINT-PIERRE-LA-COUR', '02-43-01-82-12', '06-33-35-16-15', '02-43-01-82-12', '', '', '', 'ROULIN', 'Michel', 1, 0);
INSERT INTO `les_entreprises` VALUES (28, 'CHURIN  DENIS', '36 RUE JULES DOITTEAU\n', 53700, 'VILLAINES LA JUHEL', '02-43-03-22-61', '06-07-01-05-09', '02-43-03-28-46', '', '', '', 'CHURIN', 'DENIS', 10, 0);
INSERT INTO `les_entreprises` VALUES (29, 'LEPANNETIER  CLAUDE', '21 rue de Bretagne\n', 53220, 'PONTMAIN', '02-43-05-08-30', '06-22-25-59-02', '02-43-05-05-93', '', '', '', 'LEPANNETIER', 'CLAUDE', 4, 0);
INSERT INTO `les_entreprises` VALUES (30, 'ALIX  Colette', '4 rue de la Libération\n', 49420, 'POUANCE', '02-41-92-46-40', '', '02-41-92-59-45', '', '', '', 'ALIX', 'Colette', 6, 0);
INSERT INTO `les_entreprises` VALUES (31, 'DUPRE  Luc', 'Lieu dit le Roc Ficière\n', 53940, 'AHUILLE', '02-43-68-91-32', '', '02-43-68-94-64', '', '', '', 'DUPRE', 'Luc', 2, 0);
INSERT INTO `les_entreprises` VALUES (32, 'BARBIER  ROLAND', 'ZA l''Ancrage\n', 53160, 'BAIS', '02-43-37-95-00', '06-77-11-78-85', '02-43-37-95-00', '', '', '', 'BARBIER', 'ROLAND', 7, 0);
INSERT INTO `les_entreprises` VALUES (33, 'GREFFIER  JEAN YVES', '3 rue de la Mairie\n', 49520, 'GRUGE L''HOPITAL', '02-41-92-50-16', '', '02-41-92-50-12', '', '', '', 'GREFFIER', 'JEAN YVES', 5, 0);
INSERT INTO `les_entreprises` VALUES (34, 'REBOURS  PASCAL', '38 rue de l''Anjou\n', 53200, 'AMPOIGNE', '02-43-70-01-37', '', '02-43-70-03-46', '', '', '', 'REBOURS', 'PASCAL', 21, 0);
INSERT INTO `les_entreprises` VALUES (35, 'SEVIN  GREGORY', '6 RUE DE LA SEILLE\nZA', 53640, 'LE HORPS', '02-43-03-95-78', '', '02-43-03-67-61', '', '', '', 'SEVIN', 'GREGORY', 7, 0);
INSERT INTO `les_entreprises` VALUES (36, 'COUSIN  JEAN LUC', '2 rue de la Fontaine\n', 53360, 'HOUSSAY', '02-43-07-76-73', '', '02-43-07-77-44', '', '', '', 'COUSIN', 'JEAN LUC', 4, 0);
INSERT INTO `les_entreprises` VALUES (37, 'LEPINAY  JEAN LUC', '2 rue Saint Martin\n', 53600, 'ST GEORGES S/ERVE', '02-43-01-79-78', '06-08-64-05-17', '02-43-01-79-78', '', '', '', 'LEPINAY', 'JEAN LUC', 1, 0);
INSERT INTO `les_entreprises` VALUES (38, 'MAUVIEUX  François', '24 route d''Evron\n', 53270, 'STE SUZANNE', '02-43-01-43-01', '', '02-43-01-46-10', 'conquerants@wanadoo.fr', '', '', 'MAUVIEUX', 'François', 32, 0);
INSERT INTO `les_entreprises` VALUES (39, 'BLONDEAU  Gilles', 'La Dolongère\n', 72400, 'SAINT-AUBIN-DES-COUDRAIS', '02-43-71-88-85', '', '', '', '', '', 'BLONDEAU', 'Gilles', 1, 0);
INSERT INTO `les_entreprises` VALUES (40, 'LAUNAY  PASCAL', 'LE HAUT BOURG\n', 53940, 'LE GENEST ST ISLE', '02-43-26-24-70', '06-20-69-81-40', '02-43-01-16-58', '', '', '', 'LAUNAY', 'PASCAL', 0, 0);
INSERT INTO `les_entreprises` VALUES (41, 'HEMERY  Gérard', 'ZA Route de ST.OUEN\n', 53240, 'ST GERMAIN LE FOUILLOUX', '02-43-37-60-67', '', '', '', '', '', 'HEMERY', 'Gérard', 0, 0);
INSERT INTO `les_entreprises` VALUES (42, 'LETORT  CHRISTIAN', 'LD LA FLEURIERE\n', 53400, 'MEE', '02-43-06-24-80', '', '', '', '', '', 'LETORT', 'CHRISTIAN', 1, 0);
INSERT INTO `les_entreprises` VALUES (43, 'TRIPOTIN  Anthony', '19 rue du Vieux Chateau\n', 53320, 'MONTJEAN', '02-43-26-22-18', '06-15-87-87-06', '02-43-26-22-18', '', '', '', 'TRIPOTIN', 'Anthony', 4, 0);
INSERT INTO `les_entreprises` VALUES (44, 'HERIAU', 'Les Lacs\n', 35500, 'CORNILLE', '02-99-49-56-28', '', '02-99-48-54-27', '', '', '', 'HERIAU', '', 26, 0);
INSERT INTO `les_entreprises` VALUES (45, 'GRANGÉ  DANIEL', 'Le Grand Gué\n', 53160, 'VIMARCE', '02-43-37-40-56', '06-70-10-90-60', '02-43-37-43-04', '', '', '', 'GRANGÉ', 'DANIEL', 8, 0);
INSERT INTO `les_entreprises` VALUES (46, 'GEORGEAULT  MICHEL', '13 Z.A. du Grand Chemin\n', 53970, 'L''HUISSERIE', '02-43-68-77-21', '06-07-05-75-39', '02-43-68-79-26', '', '', '', 'GEORGEAULT', 'MICHEL', 3, 0);
INSERT INTO `les_entreprises` VALUES (47, 'BELLIARD  THIERRY', 'Le Bourg\n', 53120, 'COLOMBIERS DU PLESSIS', '02-43-08-60-28', '06-16-67-38-42', '02-43-08-04-07', '', '', '', 'BELLIARD', 'THIERRY', 8, 0);
INSERT INTO `les_entreprises` VALUES (48, 'CRUARD  Olivier', '9 route de Saint Sulpice\n', 53200, 'CHATEAU-GONTIER', '02-43-07-21-16', '', '', '', '', '', 'CRUARD', 'Olivier', 0, 0);
INSERT INTO `les_entreprises` VALUES (49, 'CHEVALLIER  PATRICE', 'Zone Artisanale\n', 53100, 'ST BAUDELLE', '02-43-04-87-97', '', '', '', '', '', 'CHEVALLIER', 'PATRICE', 4, 0);
INSERT INTO `les_entreprises` VALUES (50, 'COURCELLE  BRUNO', '13 Route du Mans\n', 53960, 'BONCHAMP LES LAVAL', '02-43-90-36-78', '06-03-34-91-05', '02-43-90-92-27', '', '', '', 'COURCELLE', 'BRUNO', 24, 0);
INSERT INTO `les_entreprises` VALUES (51, 'HOUSSEAU  Laurent', 'Chemin de Vilmatier\n', 53600, 'VOUTRE', '02-43-01-32-53', '06-20-28-13-39', '02-43-01-32-53', '', '', '', 'HOUSSEAU', 'Laurent', 1, 0);
INSERT INTO `les_entreprises` VALUES (52, 'CHABRUN  Joël', '29 rue de la Libération\nBP 26', 53150, 'MONTSURS', '02-43-01-01-20', '', '02-43-02-24-85', '', '', '', 'CHABRUN', 'Joël', 26, 0);
INSERT INTO `les_entreprises` VALUES (53, 'LEBRETON  Jean Paul', 'Bd de Groslay\nLes Rottes', 35300, 'FOUGERES', '02-99-99-84-68', '', '', '', '', '', 'LEBRETON', 'Jean Paul', 3, 0);
INSERT INTO `les_entreprises` VALUES (54, 'MAIGNAN  MICHEL', 'Z.A. de Maubuard\n', 53600, 'EVRON', '02-43-01-72-11', '', '02-43-37-27-43', '', '', '', 'MAIGNAN', 'MICHEL', 5, 0);
INSERT INTO `les_entreprises` VALUES (55, 'BALIDAS  Philippe', '22 route de Laval\n', 53970, 'L HUISSERIE', '02-43-69-62-29', '06-72-73-33-61', '02-43-64-22-62', '', '', '', 'BALIDAS', 'Philippe', 5, 0);
INSERT INTO `les_entreprises` VALUES (56, 'PINEAU  Roger', '4 Bd. Okehampton - BP 3\n', 53400, 'CRAON', '02-43-06-19-92', '', '02-43-06-00-50', '', '', '', 'PINEAU', 'Roger', 48, 0);
INSERT INTO `les_entreprises` VALUES (57, 'JOUAN  Patrick', 'Le Rond Point\n25 rue de la Métrie', 35760, 'MONTGERMONT', '02-99-68-70-71', '', '02-99-68-91-98', '', '', '', 'JOUAN', 'Patrick', 30, 0);
INSERT INTO `les_entreprises` VALUES (58, 'LANDELLE  GERARD', '5 rue Edouard Bozée\n', 53210, 'SOULGE S/OUETTE', '02-43-02-33-62', '06-09-34-52-37', '02-43-02-37-07', '', '', '', 'LANDELLE', 'GERARD', 4, 0);
INSERT INTO `les_entreprises` VALUES (59, 'RIVARD  Georges', '17 avenue Paul Bigeon\n', 53230, 'COSSE LE VIVIEN', '02-43-98-87-99', '', '02-43-98-84-05', '', '', '', 'RIVARD', 'Georges', 4, 0);
INSERT INTO `les_entreprises` VALUES (60, 'CADIEU  Yves', 'avenue D''Helmstedt\n', 35502, 'VITRE', '02-99-75-06-96', '', '02-99-75-10-68', '', '', '', 'CADIEU', 'Yves', 13, 0);
INSERT INTO `les_entreprises` VALUES (61, 'MALIGORNE  Philippe', '14 Bd Louis Armand\n', 53940, 'ST BERTHEVIN', '02-43-69-20-04', '', '02-43-69-04-03', '', '', '', 'MALIGORNE', 'Philippe', 6, 0);
INSERT INTO `les_entreprises` VALUES (62, 'REAUTE  Dominique', '4 rue des Boisseliers\n', 53810, 'CHANGE', '02-43-56-51-80', '', '02-43-56-51-80', '', '', '', 'REAUTE', 'Dominique', 0, 0);
INSERT INTO `les_entreprises` VALUES (63, 'TROTTIER  Cyrille', '1 Allée des Chênes\n', 53200, 'MARIGNE PEUTON', '02-43-70-03-30', '06-21-37-23-33', '02-43-70-03-30', 'cyrille.trottier@wanadoo.fr', '', '', 'TROTTIER', 'Cyrille', 0, 0);
INSERT INTO `les_entreprises` VALUES (64, 'DJEMAI  AHMED', 'ZI les Pépinières\n', 53400, 'CRAON', '02-43-06-36-88', '', '', '', '', '', 'DJEMAI', 'AHMED', 2, 0);
INSERT INTO `les_entreprises` VALUES (65, 'GAUVIN  DOMINIQUE', '38 rue Jean Baptiste Robin\n', 53940, 'AHUILLE', '02-43-68-94-52', '', '02-43-68-92-08', '', '', '', 'GAUVIN', 'DOMINIQUE', 1, 0);
INSERT INTO `les_entreprises` VALUES (66, 'JARRY  PAUL', 'Z.I. de la Peyennière\nImpasse André Marie Ampère', 53100, 'MAYENNE', '02-43-32-10-71', '06-84-10-78-24', '02-43-04-11-44', '', '', '', 'JARRY', 'PAUL', 18, 0);
INSERT INTO `les_entreprises` VALUES (67, 'BUFFET  MICHEL', '13 rue Julien Gourdon\n', 53200, 'ST FORT', '02-43-70-22-53', '06-07-64-93-43', '02-43-70-22-53', '', '', '', 'BUFFET', 'MICHEL', 5, 0);
INSERT INTO `les_entreprises` VALUES (68, 'ROUSSEAU  JEAN JACQUES', 'IMPASSE DE LA BRIMANDIERE\n', 53120, 'GORRON', '02-43-08-69-54', '06-86-89-09-37', '', '', '', '', 'ROUSSEAU', 'JEAN JACQUES', 1, 0);
INSERT INTO `les_entreprises` VALUES (69, 'GRANDJEAN  Marcel', 'La Crotelière\n', 53970, 'NUILLE-SUR-VICOIN', '02-43-56-76-72', '06-80-63-92-74', '02-43-56-92-31', '', '', '', 'GRANDJEAN', 'Marcel', 10, 0);
INSERT INTO `les_entreprises` VALUES (70, 'VANNIER  Frédéric', 'Zone de l''Antinière\n', 53150, 'MONTSURS', '02-43-01-07-43', '', '02-43-01-07-43', '', '', '', 'VANNIER', 'Frédéric', 0, 0);
INSERT INTO `les_entreprises` VALUES (71, 'NEVEU  Joël', '12 rue des Marronniers\n', 35500, 'SAINT-M''HERVE', '02-99-76-72-55', '', '', '', '', '', 'NEVEU', 'Joël', 1, 0);
INSERT INTO `les_entreprises` VALUES (72, 'DELEBECQUE  ANDRE', '27 Rue du Bourny\nBP 0525', 53000, 'LAVAL', '02-43-68-16-83', '', '02-43-68-65-00', '', '', '', 'DELEBECQUE', 'ANDRE', 94, 0);
INSERT INTO `les_entreprises` VALUES (73, 'BOUILLY ET DE PONTBRIAND', '20 BD VOLNEY - BP 0711\n', 53007, 'LAVAL', '02-43-37-20-84', '', '02-43-68-25-11', '', '', '', 'BOUILLY ET DE PONTBRIAND', '', 31, 0);
INSERT INTO `les_entreprises` VALUES (74, 'BRECHETEAU  MARC', '10 rue Jacques Brel\n', 53290, 'BOUERE', '02-43-70-58-95', '', '02-43-70-51-33', '', '', '', 'BRECHETEAU', 'MARC', 3, 0);
INSERT INTO `les_entreprises` VALUES (75, 'VEILLE  Didier', '13 rue des Noyers\n', 53170, 'ARQUENAY', '02-43-98-42-13', '', '02-43-64-21-09', '', '', '', 'VEILLE', 'Didier', 38, 0);
INSERT INTO `les_entreprises` VALUES (76, 'FOUCHER  Moïse', '66 impasse du Bourny\n', 53000, 'LAVAL', '02-43-64-16-32', '', '02-43-66-12-66', '', '', '', 'FOUCHER', 'Moïse', 12, 0);
INSERT INTO `les_entreprises` VALUES (77, 'ROBERT  Thierry', 'Rue du Roquet\n', 53380, 'JUVIGNE', '02-43-68-52-33', '06-20-66-16-23', '02-43-68-84-16', '', '', '', 'ROBERT', 'Thierry', 2, 0);
INSERT INTO `les_entreprises` VALUES (78, 'LESAULNIER', '85, Avenue de Paris\n', 53940, 'ST BERTHEVIN', '02-43-26-22-11', '', '02-43-26-22-12', '', '', '', 'LESAULNIER', '', 27, 0);
INSERT INTO `les_entreprises` VALUES (79, 'WOJTALA  JACQUES', 'Z.A. de la Brique\n', 53810, 'CHANGE', '02-43-53-19-63', '06-10-72-00-93', '02-43-53-95-20', '', '', '', 'WOJTALA', 'JACQUES', 16, 0);
INSERT INTO `les_entreprises` VALUES (80, 'FONTAINE  ANNICK', '32 Avenue de l''Atlantique\n', 53000, 'LAVAL', '02-43-02-92-03', '', '02-43-68-32-76', '', '', '', 'FONTAINE', 'ANNICK', 8, 0);
INSERT INTO `les_entreprises` VALUES (81, 'HAUTBOIS  Pierre', 'ZI LA BOUGEOIRE\n', 35130, 'LA GUERCHE-DE-BRETAGNE', '02-99-96-26-61', '', '02-99-96-02-07', '', '', '', 'HAUTBOIS', 'Pierre', 19, 0);
INSERT INTO `les_entreprises` VALUES (82, 'POTTIER  DAVID', '36 rue de Normandie\n', 53160, 'BAIS', '02-43-37-97-03', '06-80-15-78-37', '02-43-37-99-20', '', '', '', 'POTTIER', 'DAVID', 3, 0);
INSERT INTO `les_entreprises` VALUES (83, 'AUBERT  Didier', '19 rue de la Mairie\n', 53240, 'SAINT-JEAN-SUR-MAYENNE', '02-43-26-01-58', '06-10-27-50-75', '02-43-26-01-58', '', '', '', 'AUBERT', 'Didier', 0, 0);
INSERT INTO `les_entreprises` VALUES (84, 'EVRARD  Michel', 'Le Bisson\n', 61100, 'CALIGNY', '02-33-65-41-54', '', '02-33-65-41-54', '', '', '', 'EVRARD', 'Michel', 1, 0);
INSERT INTO `les_entreprises` VALUES (85, 'DOUETTE  SERGE', 'Le Pont de Carelles\n', 53500, 'ERNEE', '02-43-05-10-52', '', '02-43-05-73-90', '', '', '', 'DOUETTE', 'SERGE', 18, 0);
INSERT INTO `les_entreprises` VALUES (86, 'SIGOILLOT  FRANÇOIS', '126 rue Françoise du Bailleul\n', 53100, 'MAYENNE', '02-43-04-53-61', '', '02-43-04-03-99', '', '', '', 'SIGOILLOT', 'FRANÇOIS', 1, 0);
INSERT INTO `les_entreprises` VALUES (87, 'DELLIERE  MARCEL', 'LD La Mauditière\n', 53260, 'FORCE', '02-43-53-57-49', '06-07-62-43-15', '02-43-53-57-50', '', '', '', 'DELLIERE', 'MARCEL', 3, 0);
INSERT INTO `les_entreprises` VALUES (88, 'MONNE  PATRICK', 'Passage des Ormeaux\n', 53000, 'LAVAL', '02-43-90-72-57', '', '02-43-91-14-18', '', '', '', 'MONNE', 'PATRICK', 7, 0);
INSERT INTO `les_entreprises` VALUES (89, 'PELE  LAURENT', '1 Place de l''Eglise\n', 53500, 'MONTENAY', '02-43-05-17-56', '06-07-76-38-75', '02-43-05-24-12', '', '', '', 'PELE', 'LAURENT', 16, 0);
INSERT INTO `les_entreprises` VALUES (90, 'BICHOT  Franck', '14 Place du Marché\n', 53230, 'COSSE-LE-VIVIEN', '02-43-01-05-50', '', '02-43-69-51-40', '', '', '', 'BICHOT', 'Franck', 4, 0);
INSERT INTO `les_entreprises` VALUES (91, 'PERRICHER  Joël', 'Z.A. Des Eturcies\n', 72200, 'LA FLECHE', '02-43-94-13-18', '', '02-43-45-79-55', '', '', '', 'PERRICHER', 'Joël', 11, 0);
INSERT INTO `les_entreprises` VALUES (92, 'BELOT  MICHEL', 'Le Tertre\n', 53150, 'ST CHRISTOPHE DU LUAT', '02-43-98-24-93', '', '02-43-98-24-93', '', '', '', 'BELOT', 'MICHEL', 1, 0);
INSERT INTO `les_entreprises` VALUES (93, 'BOUVET  DOMINIQUE', 'Chemin des Petites Fontaines\n', 53120, 'GORRON', '02-43-08-45-50', '06-08-92-95-64', '02-43-08-61-50', '', '', '', 'BOUVET', 'DOMINIQUE', 4, 0);
INSERT INTO `les_entreprises` VALUES (94, 'PELTIER', '45 rue de St.Hilaire\n', 53420, 'CHAILLAND', '02-43-02-70-69', '', '02-43-02-65-59', '', '', '', 'PELTIER', '', 28, 0);
INSERT INTO `les_entreprises` VALUES (95, 'CRUARD  Patrice', '3 rue des Sports\n', 53360, 'SIMPLE', '02-43-98-83-62', '', '02-43-98-58-02', '', '', '', 'CRUARD', 'Patrice', 33, 0);
INSERT INTO `les_entreprises` VALUES (96, 'ROBIEU  JEAN MARC', '22 RUE D''ANJOU\n', 53500, 'VAUTORTE', '02-43-69-80-28', '06-07-19-17-47', '02-43-68-78-46', '', '', '', 'ROBIEU', 'JEAN MARC', 5, 0);
INSERT INTO `les_entreprises` VALUES (97, 'DECRENNE  Stéphane', 'Les Noës\n', 61700, 'LONLAY-L ABBAYE', '02-33-38-57-74', '', '02-33-37-18-67', '', '', '', 'DECRENNE', 'Stéphane', 7, 0);
INSERT INTO `les_entreprises` VALUES (98, 'DESLAURIERS  CLAUDE', 'Z.A. 5 rue de la Présaie\n', 53600, 'EVRON', '02-43-01-63-89', '', '02-43-37-28-05', '', '', '', 'DESLAURIERS', 'CLAUDE', 6, 0);
INSERT INTO `les_entreprises` VALUES (99, 'BEAUCE  JEAN PAUL', 'ZI CHARNE - ROUTE DE MONTENAY\n', 53500, 'ERNEE', '02-43-05-13-43', '', '02-43-05-84-77', '', '', '', 'BEAUCE', 'JEAN PAUL', 6, 0);
INSERT INTO `les_entreprises` VALUES (100, 'HARDY  ERIC', 'Chemin de la Lande - BP 08\n', 53360, 'QUELAINES ST GAULT', '02-43-98-82-92', '06-07-62-73-85', '02-43-91-51-56', '', '', '', 'HARDY', 'ERIC', 10, 0);
INSERT INTO `les_entreprises` VALUES (101, 'DEBRUYNE', '2 CA DU LANDREAU\n', 49070, 'BEAUCOUZE', '02-41-73-23-73', '', '02-41-79-29-00', '', '', '', 'DEBRUYNE', '', 7, 0);
INSERT INTO `les_entreprises` VALUES (102, 'BRISEMONTIER', 'ZI LA VIOLETTE    BP 72\n', 49240, 'AVRILLE', '02-41-69-27-93', '', '02-41-69-67-97', '', '', '', 'BRISEMONTIER', '', 9, 0);
INSERT INTO `les_entreprises` VALUES (103, 'COPPENS', '8 Route de Sablé\nBP 417', 53200, 'CHATEAU GONTIER', '02-43-09-12-12', '', '02-43-09-12-18', '', '', '', 'COPPENS', '', 54, 0);
INSERT INTO `les_entreprises` VALUES (104, 'GUYON  Dominique', 'ZA DE LA CHAMBROUILLERE\n', 53960, 'BONCHAMP LES LAVAL', '02-43-53-02-30', '06-85-90-62-59', '02-43-53-36-90', '', '', '', 'GUYON', 'Dominique', 19, 0);
INSERT INTO `les_entreprises` VALUES (105, 'RABEAU  Jean Louis', 'ZI RUE DU CHENE VERT\n', 49124, 'ST BARTHELEMY D''ANJOU', '02-40-96-12-50', '', '02-41-43-20-21', '', '', '', 'RABEAU', 'Jean Louis', 20, 0);
INSERT INTO `les_entreprises` VALUES (106, 'BOUCARD', '15 rue de la Gibaudière\n', 49124, 'SAINT-BARTHELEMY-D ANJOU', '02-41-43-96-96', '', '02-41-43-94-33', '', '', '', 'BOUCARD', '', 40, 0);
INSERT INTO `les_entreprises` VALUES (107, 'LOISEAU  Bernard', 'ZI de Pierre Brune\n', 85110, 'CHANTONNAY', '02-51-48-54-54', '', '02-51-94-81-61', '', '', '', 'LOISEAU', 'Bernard', 31, 0);
INSERT INTO `les_entreprises` VALUES (134, 'PICHARD  CHANTAL', '28 AVENUE DE RAZILLY\n', 53200, 'CHATEAU GONTIER', '02-43-07-26-66', '', '02-43-07-28-14', '', '', '', 'PICHARD', 'CHANTAL', 3, 0);
INSERT INTO `les_entreprises` VALUES (108, 'DABIN', '1 rue du Pont - BP 53\n', 72300, 'SABLE SUR SARTHE', '02-43-95-10-65', '', '02-43-92-27-07', '', '', '', 'DABIN', '', 16, 0);
INSERT INTO `les_entreprises` VALUES (109, 'DAVID', '5 Rue de la Gibaudière\n', 49124, 'SAINT-BARTHELEMY-D ANJOU', '02-41-60-02-00', '', '02-41-27-00-50', '', '', '', 'DAVID', '', 24, 0);
INSERT INTO `les_entreprises` VALUES (110, 'GITEAU  Jacky', 'ZA DE LA CHALOPINIERE\n', 53170, 'MESLAY DU MAINE', '02-43-98-74-12', '', '02-43-98-10-60', '', '', '', 'GITEAU', 'Jacky', 24, 0);
INSERT INTO `les_entreprises` VALUES (111, 'TUE  Thierry', '21 Rue de la Roche\n', 85230, 'BEAUVOIR-SUR-MER', '02-51-93-89-89', '', '02-51-49-35-87', '', '', '', 'TUE', 'Thierry', 42, 0);
INSERT INTO `les_entreprises` VALUES (112, 'REAUTE  Jacques', 'ROUTE D''ANGERS\nBP 312', 53200, 'SAINT-FORT', '02-43-70-63-04', '', '02-43-70-62-88', '', '', '', 'REAUTE', 'Jacques', 3, 0);
INSERT INTO `les_entreprises` VALUES (113, 'BRIDEL  THIERRY', '46 RUE TROUVE\n', 53200, 'CHATEAU GONTIER', '02-43-07-13-52', '', '', '', '', '', 'BRIDEL', 'THIERRY', 2, 0);
INSERT INTO `les_entreprises` VALUES (114, 'FRANCHE  Carole', '4 Route d''Angers\n', 53290, 'ST DENIS D''ANJOU', '02-43-70-62-43', '', '02-43-70-59-71', '', '', '', 'FRANCHE', 'Carole', 1, 0);
INSERT INTO `les_entreprises` VALUES (115, 'BAZEAU  Gérard', '3 rue Victor Foureault\n', 53800, 'RENAZE', '02-43-70-59-63', '', '02-43-70-64-57', '', '', '', 'BAZEAU', 'Gérard', 1, 0);
INSERT INTO `les_entreprises` VALUES (116, 'BONNARD  BEATRICE', '20 Place Paul Doumer\n', 53200, 'CHATEAU-GONTIER', '02-43-07-81-23', '', '', '', '', '', 'BONNARD', 'BEATRICE', 0, 0);
INSERT INTO `les_entreprises` VALUES (117, 'COTRET  CLARA', '1-3 RUE HAUTE CHIFFOLIERE\n', 53000, 'LAVAL', '02-43-56-94-66', '', '', '', '', '', 'COTRET', 'CLARA', 2, 0);
INSERT INTO `les_entreprises` VALUES (118, 'THIRION  JEANNETTE', '16 route de Laval\n', 53200, 'AZE', '02-43-07-16-26', '', '02-43-70-14-39', '', '', '', 'THIRION', 'JEANNETTE', 5, 0);
INSERT INTO `les_entreprises` VALUES (119, 'ALVES FERREIRA  Abel', '24 rue de la Libération\n', 53400, 'CRAON', '02-23-55-50-94', '02-43-07-99-13', '', '', '', '', 'ALVES FERREIRA', 'Abel', 1, 0);
INSERT INTO `les_entreprises` VALUES (120, 'HUCHEDE  Philippe', '13, Rue Division Leclerc\n', 53200, 'CHATEAU-GONTIER', '02-43-07-27-07', '06-71-30-83-07', '02-43-07-27-07', '', '', '', 'HUCHEDE', 'Philippe', 2, 0);
INSERT INTO `les_entreprises` VALUES (121, 'PLESSIS  Pascal', '5 PLACE DU PILORI\n', 53200, 'CHATEAU-GONTIER', '02-43-70-29-79', '', '02-43-70-19-87', '', '', '', 'PLESSIS', 'Pascal', 2, 0);
INSERT INTO `les_entreprises` VALUES (122, 'LERAY  MYRIAM', '7 PLACE PAUL DOUMER\n', 53200, 'CHATEAU GONTIER', '02-43-07-23-40', '', '02-43-70-19-80', '', '', '', 'LERAY', 'MYRIAM', 3, 0);
INSERT INTO `les_entreprises` VALUES (123, 'MARQUIS', 'Z C DE LA FOUGETTERIE\n', 53200, 'CHATEAU-GONTIER', '02-43-07-19-19', '', '02-43-70-75-61', '', '', '', 'MARQUIS', '', 14, 0);
INSERT INTO `les_entreprises` VALUES (124, 'CHESNEAUX', 'Avenue Georges Pompidou\nZone de la Fougetterie', 53200, 'CHATEAU-GONTIER', '02-43-09-17-20', '', '02-43-09-17-29', '', '', '', 'CHESNEAUX', '', 155, 0);
INSERT INTO `les_entreprises` VALUES (125, 'GOUGEON  LAURENT', '110 GRANDE RUE\n', 53200, 'CHATEAU-GONTIER', '02-43-07-82-01', '', '', '', '', '', 'GOUGEON', 'LAURENT', 3, 0);
INSERT INTO `les_entreprises` VALUES (126, 'LANDEAU  Benoit', '1 Bis place de la République\n', 53200, 'CHATEAU-GONTIER', '02-43-06-84-72', '', '', '', '', '', 'LANDEAU', 'Benoit', 0, 0);
INSERT INTO `les_entreprises` VALUES (127, 'GENDROT  Frédéric', '8 Avenue Georges Pompidou\nZA de la Fougetterie', 53200, 'CHATEAU-GONTIER', '02-43-07-23-91', '', '02-43-07-15-15', '', '', '', 'GENDROT', 'Frédéric', 9, 0);
INSERT INTO `les_entreprises` VALUES (128, 'VARIN  Jérôme', 'Les Sablonnières\n', 53200, 'ST FORT', '02-43-70-01-80', '', '02-43-70-02-03', '', '', '', 'VARIN', 'Jérôme', 14, 0);
INSERT INTO `les_entreprises` VALUES (129, 'GRIVES  Josiane', '28 rue des Halles\n', 53400, 'CRAON', '02-43-06-11-98', '', '02-43-07-54-70', '', '', '', 'GRIVES', 'Josiane', 2, 0);
INSERT INTO `les_entreprises` VALUES (130, 'CHEVREUL  JEAN-PAUL', '3 Promenade Charles de Gaulle\n', 53400, 'CRAON', '02-43-06-15-79', '', '02-43-06-07-94', '', '', '', 'CHEVREUL', 'JEAN-PAUL', 8, 0);
INSERT INTO `les_entreprises` VALUES (131, 'BOUETE  MICKAEL', '18 Rue René d''Anjou\n', 53200, 'CHATEAU-GONTIER', '02-43-70-49-06', '', '', '', '', '', 'BOUETE', 'MICKAEL', 0, 0);
INSERT INTO `les_entreprises` VALUES (132, 'SAVINA  Chantal', 'Rue des Tilleuls\n', 53170, 'MESLAY-DU-MAINE', '02-43-98-60-46', '', '', '', '', '', 'SAVINA', 'Chantal', 0, 0);
INSERT INTO `les_entreprises` VALUES (133, 'PEIGNE  Christine', '1 place de la Mairie\n', 53200, 'BAZOUGES', '02-43-07-84-30', '', '', '', '', '', 'PEIGNE', 'Christine', 2, 0);
INSERT INTO `les_entreprises` VALUES (135, 'RAFFIN  DANIEL', '2 Rue de Bretagne\n', 53200, 'BAZOUGES', '02-43-07-67-57', '', '02-43-07-67-50', '', '', '', 'RAFFIN', 'DANIEL', 13, 0);
INSERT INTO `les_entreprises` VALUES (136, 'BARAT  Luc', 'BD DE L''EUROPE\nZI DE BELLEVUE', 72600, 'MAMERS', '02-43-97-97-00', '', '02-43-97-98-35', '', '', '', 'BARAT', 'Luc', 12, 0);
INSERT INTO `les_entreprises` VALUES (137, 'LEBLANC  DENIS', 'ZI DU DOUANIER ROUSSEAU\n', 53500, 'ERNEE', '02-43-05-15-91', '', '02-43-05-72-52', '', '', '', 'LEBLANC', 'DENIS', 45, 0);
INSERT INTO `les_entreprises` VALUES (138, 'DEBAS  ALAIN', '5 RUE MARCELIN BERTHELOT\nBP 1212', 53012, 'LAVAL CEDEX', '02-43-53-52-53', '', '02-43-49-58-69', '', '', '', 'DEBAS', 'ALAIN', 69, 0);
INSERT INTO `les_entreprises` VALUES (139, 'LOURY  Franck', 'Le Rouffigné\n', 35500, 'VITRE', '02-99-49-74-41', '', '02-99-49-74-41', '', '', '', 'LOURY', 'Franck', 0, 0);
INSERT INTO `les_entreprises` VALUES (140, 'TREMBLAY  Marianne', '7 rue de Paradis\n', 53000, 'LAVAL', '06-23-58-05-69', '', '02-43-59-21-29', '', '', '', 'TREMBLAY', 'Marianne', 0, 0);
INSERT INTO `les_entreprises` VALUES (141, 'CHERIF  MARCEL', 'Rue du Haut Eclair\n', 72610, 'ARCONNAY', '02-33-81-22-22', '', '02-33-81-22-20', '', '', '', 'CHERIF', 'MARCEL', 35, 0);
INSERT INTO `les_entreprises` VALUES (142, 'FUZEAUX  Wulfran', 'RUE DENIS PAPIN\nZI DE BRAIS', 44600, 'SAINT-NAZAIRE', '02-40-91-52-51', '', '02-40-91-56-41', '', '', '', 'FUZEAUX', 'Wulfran', 13, 0);
INSERT INTO `les_entreprises` VALUES (143, 'GERAULT  Didier', '32 boulevard des Manouvriers\n', 53810, 'CHANGE', '02-43-53-03-15', '', '02-43-49-16-72', '', '', '', 'GERAULT', 'Didier', 19, 0);
INSERT INTO `les_entreprises` VALUES (144, 'HUBERT', '66 Avenue du Révérend Père Umbricht\n', 35400, 'SAINT-MALO', '02-99-56-07-26', '', '02-99-56-65-54', '', '', '', 'HUBERT', '', 32, 0);
INSERT INTO `les_entreprises` VALUES (145, 'CORVE  Jean-Claude -Ludovic', 'IMPASSE DU PAVE\n', 53120, 'GORRON', '02-43-08-00-43', '', '', '', '', '', 'CORVE', 'Jean-Claude -Ludovic', 2, 0);
INSERT INTO `les_entreprises` VALUES (146, 'BARON  RAYMOND', '3 RUE DES ROULIERS\n', 53810, 'CHANGE', '02-43-53-90-72', '', '02-43-49-25-02', '', '', '', 'BARON', 'RAYMOND', 14, 0);
INSERT INTO `les_entreprises` VALUES (147, 'PRUNIER  Isabelle', 'ZA AMBROISE PARE\n', 53500, 'ERNEE', '02-43-05-83-92', '', '02-43-05-75-09', '', '', '', 'PRUNIER', 'Isabelle', 4, 0);
INSERT INTO `les_entreprises` VALUES (148, 'BARBIER  ALAIN', 'ROUTE DE COURCEMONT\nZ.I.', 72110, 'BONNETABLE', '02-43-29-71-58', '', '', '', '', '', 'BARBIER', 'ALAIN', 11, 0);
INSERT INTO `les_entreprises` VALUES (149, 'VIEL  OLIVIER', '2, Rue de Bretagne\n', 53360, 'QUELAINES ST GAULT', '02-43-98-82-50', '', '', '', '', '', 'VIEL', 'OLIVIER', 1, 0);
INSERT INTO `les_entreprises` VALUES (150, 'LECOMTE  Christian', '11 rue du Général Foucher\n', 53360, 'QUELAINES-SAINT-GAULT', '02-43-98-53-00', '', '', '', '', '', 'LECOMTE', 'Christian', 2, 0);
INSERT INTO `les_entreprises` VALUES (151, 'THIREAU', '2, Rue de la Perception\n', 53230, 'COSSE LE VIVIEN', '02-43-98-27-97', '', '02-43-64-33-57', '', '', '', 'THIREAU', '', 0, 0);
INSERT INTO `les_entreprises` VALUES (152, 'TANGUY', '26 Avenue des Sablonnières\nRte d''Angers', 53200, 'ST FORT', '02-43-07-04-78', '', '02-43-07-29-09', '', '', '', 'TANGUY', '', 22, 0);
INSERT INTO `les_entreprises` VALUES (153, 'RAMAUGE  Sandrine', '15, Rue Thiers\n', 53200, 'CHATEAU GONTIER', '02-43-07-22-75', '', '', '', '', '', 'RAMAUGE', 'Sandrine', 0, 0);
INSERT INTO `les_entreprises` VALUES (154, 'GASTINEAU  XAVIER', '7, Rue du Docteur Ramé\n', 53320, 'LOIRON', '02-43-02-10-20', '', '02-43-02-10-20', '', '', '', 'GASTINEAU', 'XAVIER', 3, 0);
INSERT INTO `les_entreprises` VALUES (155, 'NOURRY  ANDRE', '2 Place Henri IV\n', 53290, 'ST DENIS D''ANJOU', '02-43-70-52-39', '', '02-43-70-56-80', '', '', '', 'NOURRY', 'ANDRE', 3, 0);
INSERT INTO `les_entreprises` VALUES (156, 'DANDIN  Armelle', '54 Avenue de Paris\n', 53500, 'ERNEE', '02-43-05-73-73', '', '02-43-05-84-95', '', '', '', 'DANDIN', 'Armelle', 11, 0);
INSERT INTO `les_entreprises` VALUES (157, 'LE MAIRE', 'Place de l''Hôtel de Ville\n', 53000, 'LAVAL', '02-43-49-45-31', '', '02-43-49-46-92', '', '', '', 'LE MAIRE', '', 1500, 0);
INSERT INTO `les_entreprises` VALUES (158, 'MONTESI  Biagio', '9, Rue aux Mesles\n', 53000, 'LAVAL', '02-43-66-99-27', '06-30-08-39-01', '', '', '', '', 'MONTESI', 'Biagio', 2, 0);
INSERT INTO `les_entreprises` VALUES (159, 'BOUVET  PATRICK', 'Centre Commercial Pégase\nAvenue de la Communauté Européenne', 53000, 'LAVAL', '02-43-53-83-84', '', '02-43-56-60-95', '', '', '', 'BOUVET', 'PATRICK', 20, 0);
INSERT INTO `les_entreprises` VALUES (160, 'CHEVILLARD  Gabrielle', 'Maison de St-Georges de l''Isle\n', 53300, 'SAINT-FRAIMBAULT-DE-PRIERES', '02-43-00-87-64', '', '02-43-00-59-43', '', '', '', 'CHEVILLARD', 'Gabrielle', 48, 0);
INSERT INTO `les_entreprises` VALUES (161, 'ROBIN  Erwan', 'BP 416\n', 44606, 'SAINT-NAZAIRE CEDEX', '02-40-00-40-00', '', '', '', '', '', 'ROBIN', 'Erwan', 0, 0);
INSERT INTO `les_entreprises` VALUES (162, 'LEBLANC  Cyril', '1, Carrefour aux toiles\n', 53000, 'LAVAL', '02-43-64-18-19', '', '', '', '', '', 'LEBLANC', 'Cyril', 1, 0);
INSERT INTO `les_entreprises` VALUES (217, 'BOURDOISEAU  Serge', 'C.Cal. La Fougetterie\n', 53200, 'CHATEAU-GONTIER', '02-43-06-30-50', '', '02-43-12-29-95', '', '', '', 'BOURDOISEAU', 'Serge', 0, 0);
INSERT INTO `les_entreprises` VALUES (163, 'BOSSE  CYRILLE', '13, Rue Garnier\n', 53200, 'CHATEAU GONTIER', '02-43-07-63-04', '', '', '', '', '', 'BOSSE', 'CYRILLE', 3, 0);
INSERT INTO `les_entreprises` VALUES (164, 'DECKE  Marie-Thérèse', '2, Rue du Maine\n', 53970, 'NUILLE-SUR-VICOIN', '02-43-98-39-14', '', '', '', '', '', 'DECKE', 'Marie-Thérèse', 1, 0);
INSERT INTO `les_entreprises` VALUES (165, 'DUFEU  CHRISTOPHE', 'Restaurant\n', 53170, 'ST CHARLES LA FORET', '02-43-98-58-28', '', '', '', '', '', 'DUFEU', 'CHRISTOPHE', 1, 0);
INSERT INTO `les_entreprises` VALUES (166, 'CHAUVOIS  Jean Claude', '7 rue Saint Hilaire\n', 53420, 'CHAILLAND', '02-43-02-70-12', '', '02-43-37-05-23', '', '', '', 'CHAUVOIS', 'Jean Claude', 2, 0);
INSERT INTO `les_entreprises` VALUES (167, 'MEZIERE  Ulrich', '7, Route de Laval\n', 53170, 'MESLAY-DU-MAINE', '02-43-98-68-00', '06-82-40-73-71', '', '', '', '', 'MEZIERE', 'Ulrich', 0, 0);
INSERT INTO `les_entreprises` VALUES (168, 'TOUILLER  THIERRY', '66 rue Vaufleury\n', 53000, 'LAVAL', '02-43-66-02-02', '', '02-43-66-13-50', '', '', '', 'TOUILLER', 'THIERRY', 5, 0);
INSERT INTO `les_entreprises` VALUES (169, 'CHAPIN  JEAN-MARIE', 'Le Domaine du Bas Mont\n', 53100, 'MOULAY', '02-43-00-48-42', '', '02-43-08-10-58', 'lamarjolaine@wanadoo.fr', '', '', 'CHAPIN', 'JEAN-MARIE', 10, 0);
INSERT INTO `les_entreprises` VALUES (170, 'GARREAU  PASCAL', '63 Grande Rue\n', 53000, 'LAVAL', '02-43-53-29-43', '', '', '', '', '', 'GARREAU', 'PASCAL', 4, 0);
INSERT INTO `les_entreprises` VALUES (171, 'GIGAN  PHILIPPE', '23, Avenue Aristide Briand\n', 53500, 'ERNEE', '02-43-05-16-41', '', '', '', '', '', 'GIGAN', 'PHILIPPE', 2, 0);
INSERT INTO `les_entreprises` VALUES (172, 'HOUSSAY  Véronique', 'Place Christian d''Elva\n', 53810, 'CHANGE', '02-43-53-43-33', '', '02-43-49-05-60', '', '', '', 'HOUSSAY', 'Véronique', 3, 0);
INSERT INTO `les_entreprises` VALUES (173, 'GRIPPON', '14, Rue Nationale 12\n', 53100, 'SAINT-GEORGES-BUTTAVENT', '02-43-00-35-61', '', '', '', '', '', 'GRIPPON', '', 0, 0);
INSERT INTO `les_entreprises` VALUES (174, 'VAN MARLE  RICHARD', '2 rue A. de Loré\n', 53100, 'MAYENNE', '02-43-00-96-00', '', '02-43-00-69-20', '', '', '', 'VAN MARLE', 'RICHARD', 8, 0);
INSERT INTO `les_entreprises` VALUES (175, 'RICOU  YANNICK', '99-101 Avenue Robert Buron\n', 53000, 'LAVAL', '02-43-53-11-00', '', '', '', '', '', 'RICOU', 'YANNICK', 4, 0);
INSERT INTO `les_entreprises` VALUES (176, 'RANFT  BERTRAND', '22, Rue du Val de Mayenne\n', 53000, 'LAVAL', '02-43-49-24-30', '', '', '', '', '', 'RANFT', 'BERTRAND', 0, 0);
INSERT INTO `les_entreprises` VALUES (177, 'PATIN', '15, Rue de la Madeleine\n', 53100, 'MAYENNE', '02-43-04-87-34', '', '', '', '', '', 'PATIN', '', 0, 0);
INSERT INTO `les_entreprises` VALUES (178, 'LEVEQUE  Patrick', 'Etang de la Fenderie\n', 53150, 'DEUX EVAILLES', '02-43-90-00-95', '', '02-43-90-02-52', 'la.fenderie@wanadoo.fr', '', '', 'LEVEQUE', 'Patrick', 7, 0);
INSERT INTO `les_entreprises` VALUES (179, 'MARIEL  Martine', '168 rue de Bretagne\n', 53000, 'LAVAL', '02-43-69-07-81', '', '02-43-91-15-02', '', '', '', 'MARIEL', 'Martine', 6, 0);
INSERT INTO `les_entreprises` VALUES (180, 'HEVIN  Mickaël', 'Le Golf de Laval\nLa Chabossière', 53810, 'CHANGE', '02-43-53-51-36', '', '02-43-56-62-77', 'restaugreen@free.fr', '', '', 'HEVIN', 'Mickaël', 6, 0);
INSERT INTO `les_entreprises` VALUES (181, 'GILBERT  GERARD', '30 avenue Paul Bigeon\n', 53230, 'COSSE LE VIVIEN', '02-43-98-81-32', '', '02-43-98-91-09', '', '', '', 'GILBERT', 'GERARD', 9, 0);
INSERT INTO `les_entreprises` VALUES (182, 'RENARD  Andy', '28, boulevard Félix Grat\n', 53000, 'LAVAL', '02-43-53-37-47', '', '', '', '', '', 'RENARD', 'Andy', 2, 0);
INSERT INTO `les_entreprises` VALUES (183, 'YIU  TAT-HUNG', '17 rue des orfèvres\n', 53000, 'LAVAL', '02-43-53-32-84', '', '02-43-53-65-65', '', '', '', 'YIU', 'TAT-HUNG', 6, 0);
INSERT INTO `les_entreprises` VALUES (184, 'BATHO  PHILIPPE', '41 rue de Bretagne\n', 53120, 'GORRON', '02-43-08-63-67', '', '02-43-08-01-15', '', '', '', 'BATHO', 'PHILIPPE', 1, 0);
INSERT INTO `les_entreprises` VALUES (185, 'SARAGO  ALPHONSO', '5 rue René d''Anjou\n', 53200, 'CHATEAU GONTIER', '02-43-70-49-14', '', '', '', '', '', 'SARAGO', 'ALPHONSO', 2, 0);
INSERT INTO `les_entreprises` VALUES (186, 'SERRE  SOLANGE', '4 avenue Robert Buron\n', 53000, 'LAVAL', '02-43-53-12-59', '', '02-43-53-77-60', '', '', '', 'SERRE', 'SOLANGE', 3, 0);
INSERT INTO `les_entreprises` VALUES (187, 'POTTIER  JACQUES', '2, Rue de Daon\n', 53200, 'COUDRAY', '02-43-70-46-46', '', '02-43-70-42-93', '', '', '', 'POTTIER', 'JACQUES', 0, 0);
INSERT INTO `les_entreprises` VALUES (188, 'TROTTIER  Jérôme', '1, Rue de l''Oudon\n', 53400, 'ST QUENTIN LES ANGES', '02-43-06-10-62', '', '02-43-06-08-41', '', '', '', 'TROTTIER', 'Jérôme', 7, 0);
INSERT INTO `les_entreprises` VALUES (189, 'MENARD  FRANCINE', '4 rue des Prés\n', 53600, 'EVRON', '02-43-01-62-16', '', '02-43-37-20-01', '', '', '', 'MENARD', 'FRANCINE', 6, 0);
INSERT INTO `les_entreprises` VALUES (190, 'NARDIN  Dominique', '103, Avenue Robert Buron\n', 53000, 'LAVAL', '02-43-56-06-34', '', '02-43-49-35-60', '', '', '', 'NARDIN', 'Dominique', 2, 0);
INSERT INTO `les_entreprises` VALUES (191, 'VIOT  Laurent', '2 rue Saint Martin\n', 53260, 'VILLIERS CHARLEMAGNE', '02-43-07-70-46', '', '02-43-07-70-46', '', '', '', 'VIOT', 'Laurent', 0, 0);
INSERT INTO `les_entreprises` VALUES (192, 'GENEAUX  Gilles', 'BP 18\n', 50170, 'LE MONT-SAINT-MICHEL', '02-33-89-18-80', '', '02-33-89-18-83', '', '', '', 'GENEAUX', 'Gilles', 14, 0);
INSERT INTO `les_entreprises` VALUES (193, 'GIRARD  ANDRE', '319, Rue de Bretagne\n', 53000, 'LAVAL', '02-43-69-11-16', '', '02-43-02-80-44', '', '', '', 'GIRARD', 'ANDRE', 5, 0);
INSERT INTO `les_entreprises` VALUES (194, 'SAULNIER  FRANCK', '12, rue des trois croix\n', 53000, 'LAVAL', '02-43-56-64-17', '', '', '', '', '', 'SAULNIER', 'FRANCK', 2, 0);
INSERT INTO `les_entreprises` VALUES (195, 'PARIS ET PESCHARD', 'Route de Mayenne\n', 53600, 'EVRON', '02-43-91-20-00', '', '02-43-91-20-10', '', '', '', 'PARIS ET PESCHARD', '', 9, 0);
INSERT INTO `les_entreprises` VALUES (196, 'TALOUDEC  JACQUES', 'Centre Commercial Pégase\nLd les Bozées', 53000, 'LAVAL', '02-43-56-20-91', '', '02-43-07-74-60', '', '', '', 'TALOUDEC', 'JACQUES', 8, 0);
INSERT INTO `les_entreprises` VALUES (197, 'VALSAINT ET ARNAUD', 'Fontaine Daniel\n', 53100, 'SAINT-GEORGES-BUTTAVENT', '02-43-00-34-85', '', '', '', '', '', 'VALSAINT ET ARNAUD', '', 0, 0);
INSERT INTO `les_entreprises` VALUES (198, 'POSSEME  Christian', 'le Bourg\n3, Place St Pierre', 53340, 'SAULGES', '02-43-64-66-00', '', '02-43-90-56-61', '', '', '', 'POSSEME', 'Christian', 8, 0);
INSERT INTO `les_entreprises` VALUES (199, 'OGER  SAMUEL', 'Rue du Fief des Moines\n', 53480, 'VAIGES', '02-43-90-50-07', '', '02-43-90-57-40', '', '', '', 'OGER', 'SAMUEL', 7, 0);
INSERT INTO `les_entreprises` VALUES (200, 'AVENIER  Cécile', '25, Rue Chateaubriant\n', 53100, 'MAYENNE', '02-43-00-06-08', '', '', '', '', '', 'AVENIER', 'Cécile', 1, 0);
INSERT INTO `les_entreprises` VALUES (201, 'GALON  BLANDINE', 'zone de loisirs du Fresne\n', 53800, 'RENAZE', '02-43-09-17-40', '', '02-43-09-17-42', '', '', '', 'GALON', 'BLANDINE', 2, 0);
INSERT INTO `les_entreprises` VALUES (202, 'ETCHEVERRY  David', 'Impasse du Vieux Bourg\n', 35760, 'SAINT-GREGOIRE', '02-99-68-79-35', '', '02-99-68-92-71', '', '', '', 'ETCHEVERRY', 'David', 13, 0);
INSERT INTO `les_entreprises` VALUES (203, 'BLASZCZYR  Pascal', '16, Palce Albert Liebault\n', 72350, 'BRULON', '02-43-95-60-40', '', '02-43-95-27-55', '', '', '', 'BLASZCZYR', 'Pascal', 2, 0);
INSERT INTO `les_entreprises` VALUES (204, 'LEMERCIER  GUY', '67 rue du Val de Mayenne\n', 53000, 'LAVAL', '02-43-56-98-29', '', '02-43-56-52-85', '', '', '', 'LEMERCIER', 'GUY', 9, 0);
INSERT INTO `les_entreprises` VALUES (205, 'BOULLIER  BERTRAND', '2 rue d''Evron\n', 53150, 'NEAU', '02-43-98-23-41', '', '02-43-98-25-39', '', '', '', 'BOULLIER', 'BERTRAND', 5, 0);
INSERT INTO `les_entreprises` VALUES (206, 'EMERY  Bruno', 'Pendu\n2 rue Félix Marchand', 53200, 'ST FORT', '02-43-70-15-44', '', '02-43-07-88-67', 'l.aquarelle@tiscali.fr', '', '', 'EMERY', 'Bruno', 2, 0);
INSERT INTO `les_entreprises` VALUES (207, 'PAUVERT  GERARD', 'route d''Angers\n', 53200, 'ST FORT', '02-43-70-32-70', '', '02-43-07-89-73', '', '', '', 'PAUVERT', 'GERARD', 3, 0);
INSERT INTO `les_entreprises` VALUES (208, 'BOULAND  STEPHANIE', '18 RN\n', 37210, 'VOUVRAY', '02-47-52-70-18', '', '', '', '', '', 'BOULAND', 'STEPHANIE', 2, 0);
INSERT INTO `les_entreprises` VALUES (209, 'JOUANEN  ERIC', '83 rue Victor Boissel\n', 53000, 'LAVAL', '02-43-53-14-10', '', '02-43-49-02-84', '', '', '', 'JOUANEN', 'ERIC', 5, 0);
INSERT INTO `les_entreprises` VALUES (210, 'JAQUET  MICHELE', '16, Place Dom Guéranger\n', 72300, 'SOLESMES', '02-43-95-45-10', '', '02-43-95-22-26', '', '', '', 'JAQUET', 'MICHELE', 18, 0);
INSERT INTO `les_entreprises` VALUES (211, 'TESTARD  FRANCIS', '23 quai Sadi Carnot\n', 53000, 'LAVAL', '02-43-53-55-66', '', '', '', '', '', 'TESTARD', 'FRANCIS', 0, 0);
INSERT INTO `les_entreprises` VALUES (212, 'PUZOS', '7 rue du Lieutenant\n', 53000, 'LAVAL', '02-43-56-25-77', '', '', '', '', '', 'PUZOS', '', 3, 0);
INSERT INTO `les_entreprises` VALUES (213, 'BERTIN  Sophie', 'Route d''Olivet\n', 53940, 'LE GENEST ST ISLE', '02-43-37-14-37', '', '03-43-37-70-48', '', '', '', 'BERTIN', 'Sophie', 0, 0);
INSERT INTO `les_entreprises` VALUES (214, 'GUION', '63 rue du Général de Gaulle\n', 53000, 'LAVAL', '02-43-68-69-69', '', '', '', '', '', 'GUION', '', 3, 0);
INSERT INTO `les_entreprises` VALUES (215, 'DUBERT  Patrice', 'La Fourmondière\n', 53240, 'MONTFLOURS', '02-43-68-75-08', '', '02-43-91-15-54', '', '', '', 'DUBERT', 'Patrice', 3, 0);
INSERT INTO `les_entreprises` VALUES (216, 'TARDIF', '1, Place Crottigné\n', 53150, 'MONTSURS', '02-43-01-00-28', '', '02-43-01-06-60', 'rest-la-boule-dor@wanadoo.fr', '', '', 'TARDIF', '', 0, 0);
INSERT INTO `les_entreprises` VALUES (218, 'COUSIN', 'BP 133\n', 53200, 'CHATEAU GONTIER', '02-43-07-28-65', '', '02-43-07-02-31', '', '', '', 'COUSIN', '', 8, 0);
INSERT INTO `les_entreprises` VALUES (219, 'SORIN  Fabrice', 'Rue Alain Gerbault\n', 53400, 'CRAON', '02-43-06-05-25', '', '', '', '', '', 'SORIN', 'Fabrice', 0, 0);
INSERT INTO `les_entreprises` VALUES (220, 'GEAIRON  EMERIC', '3 place de l''Eglise\n', 53220, 'MONTAUDIN', '02-43-05-33-14', '', '', '', '', '', 'GEAIRON', 'EMERIC', 1, 0);
INSERT INTO `les_entreprises` VALUES (221, 'GALLIENNE  Joël', '70, Rue du Maine\n', 53260, 'ENTRAMMES', '02-43-98-08-65', '', '02-43-98-32-42', '', '', '', 'GALLIENNE', 'Joël', 3, 0);
INSERT INTO `les_entreprises` VALUES (222, 'REMY  Christophe', '6, Allée de Cambrai\n', 53000, 'LAVAL', '02-43-53-33-30', '', '02-43-49-23-16', '', '', '', 'REMY', 'Christophe', 5, 0);
INSERT INTO `les_entreprises` VALUES (223, 'PICOT  JEAN-NOEL', '14, place de l''Eglise\n', 53940, 'LE GENEST ST ISLE', '02-43-02-11-87', '', '02-43-02-08-05', '', '', '', 'PICOT', 'JEAN-NOEL', 2, 0);
INSERT INTO `les_entreprises` VALUES (224, 'CORMIER  Pierrick', '99, Rue Division Leclerc\n', 53200, 'CHATEAU-GONTIER', '02-43-07-98-76', '', '02-43-70-30-11', '', '', '', 'CORMIER', 'Pierrick', 6, 0);
INSERT INTO `les_entreprises` VALUES (225, 'COILLOT  Pascal', '\n', 53440, 'ARON', '02-43-04-13-64', '', '02-43-08-10-28', '', '', '', 'COILLOT', 'Pascal', 5, 0);
INSERT INTO `les_entreprises` VALUES (226, 'ROBERT', '37 bd Jean Jaurès\n', 35300, 'FOUGERES', '02-99-94-23-39', '', '02-99-94-99-75', '', '', '', 'ROBERT', '', 1, 0);
INSERT INTO `les_entreprises` VALUES (227, 'BOUTTIER  Vincent', '71, Avenue de Paris\n', 53940, 'ST BERTHEVIN', '02-43-69-92-24', '06-10-23-44-28', '', '', '', '', 'BOUTTIER', 'Vincent', 5, 0);
INSERT INTO `les_entreprises` VALUES (228, 'PINSON  Jocelyne', '7, Rue d''Anjou\n', 53290, 'BIERNE', '02-43-70-96-26', '', '', '', '', '', 'PINSON', 'Jocelyne', 0, 0);
INSERT INTO `les_entreprises` VALUES (229, 'LOUVEAU  Stéphane', 'Route du Mans\n', 53960, 'BONCHAMP LES LAVAL', '02-43-53-12-12', '', '02-43-53-82-37', '', '', '', 'LOUVEAU', 'Stéphane', 6, 0);
INSERT INTO `les_entreprises` VALUES (230, 'DOUDARD  Ginette', '28 ROUTE D''ERNEE\n', 53220, 'MONTAUDIN', '02-43-05-30-79', '', '', '', '', '', 'DOUDARD', 'Ginette', 0, 0);
INSERT INTO `les_entreprises` VALUES (231, 'HUBERT  GILLES', '5 rue des Béliers\n', 53000, 'LAVAL', '02-43-53-66-76', '', '02-43-56-92-18', '', '', '', 'HUBERT', 'GILLES', 2, 0);
INSERT INTO `les_entreprises` VALUES (232, 'BIENACIE  Bruno', '20, Rue Principale\n', 53410, 'LE BOURGNEUF LA FORET', '02-43-37-17-00', '', '02-43-37-17-00', '', '', '', 'BIENACIE', 'Bruno', 2, 0);
INSERT INTO `les_entreprises` VALUES (233, 'BUCHET  Claude', '2 rue de Mayenne\n', 53700, 'VILLAINES LA JUHEL', '02-43-30-46-10', '', '02-43-30-46-11', '', '', '', 'BUCHET', 'Claude', 5, 0);
INSERT INTO `les_entreprises` VALUES (234, 'HUCHET  STEPHANE', '4 - 6, Rue de la Libération\n', 53270, 'STE SUZANNE', '02-43-01-40-31', '', '02-43-01-46-21', '', '', '', 'HUCHET', 'STEPHANE', 3, 0);
INSERT INTO `les_entreprises` VALUES (235, 'GOMARD  Christian', 'SARL CLARISSE\n22, Rue de la Paix', 53000, 'LAVAL', '02-43-53-53-44', '', '02-43-56-23-56', '', '', '', 'GOMARD', 'Christian', 34, 0);
INSERT INTO `les_entreprises` VALUES (236, 'ABRAHAM  Rachida', '4, Place de l''Eglise\n', 53970, 'L''HUISSERIE', '02-43-69-61-42', '', '', '', '', '', 'ABRAHAM', 'Rachida', 5, 0);
INSERT INTO `les_entreprises` VALUES (237, 'PONSORT  VERONIQUE', '21 rue d''Anjou\n', 53970, 'L''HUISSERIE', '02-43-69-61-10', '', '', '', '', '', 'PONSORT', 'VERONIQUE', 0, 0);
INSERT INTO `les_entreprises` VALUES (238, 'QUELIN  BERTRAND', '333 route de Tours\n', 53000, 'LAVAL', '02-43-53-03-10', '', '02-43-56-85-24', '', '', '', 'QUELIN', 'BERTRAND', 2, 0);
INSERT INTO `les_entreprises` VALUES (239, 'GUERIN  ANTOINE', '19 rue Principale\n', 53800, 'ST SATURNIN DU LIMET', '02-43-06-77-26', '', '02-43-06-86-14', '', '', '', 'GUERIN', 'ANTOINE', 5, 0);
INSERT INTO `les_entreprises` VALUES (241, 'MOUTAULT  Sylvie', '14, Place du Marché\n', 53170, 'MESLAY-DU-MAINE', '02-43-02-80-17', '', '02-43-02-64-55', '', '', '', 'MOUTAULT', 'Sylvie', 1, 0);
INSERT INTO `les_entreprises` VALUES (242, 'GESLIN  STEPHANE', '16, Rue Relais des Diligences\n', 53390, 'ST AIGNAN S/ROE', '02-43-06-51-02', '', '02-43-06-97-84', '', '', '', 'GESLIN', 'STEPHANE', 1, 0);
INSERT INTO `les_entreprises` VALUES (243, 'MARTEL  David', '1, Rue d''Anjou\n', 35370, 'ARGENTRE-DU-PLESSIS', '02-99-96-61-30', '', '', '', '', '', 'MARTEL', 'David', 2, 0);
INSERT INTO `les_entreprises` VALUES (244, 'POUTEAU  ERIC', 'RN 12\nld la Coutancière', 53500, 'VAUTORTE', '02-43-00-56-27', '', '02-43-00-66-09', '', '', '', 'POUTEAU', 'ERIC', 4, 0);
INSERT INTO `les_entreprises` VALUES (245, 'ROYER', 'Quai Gambetta\n', 53000, 'LAVAL', '02-43-49-89-89', '', '02-43-49-00-50', '', '', '', 'ROYER', '', 20, 0);
INSERT INTO `les_entreprises` VALUES (246, 'BONNAIRE  Cédric', '1, Rue du Prieuré\n', 53200, 'AZE', '02-43-70-31-16', '02-43-70-31-16', '', '', '', '', 'BONNAIRE', 'Cédric', 2, 0);
INSERT INTO `les_entreprises` VALUES (247, 'BESSIERRE  Pierre-Denis', '12, Place de l''Eglise\n', 53410, 'LE BOURGNEUF LA FORET', '02-43-37-14-26', '', '02-43-37-14-26', '', '', '', 'BESSIERRE', 'Pierre-Denis', 2, 0);
INSERT INTO `les_entreprises` VALUES (248, 'GREENAWAY  MICKAEL', '30 Grande Rue\n', 53250, 'JAVRON LES CHAPELLES', '02-43-03-41-91', '', '02-43-04-49-48', '', '', '', 'GREENAWAY', 'MICKAEL', 3, 0);
INSERT INTO `les_entreprises` VALUES (249, 'JOLIVET  PHILIPPE', '2, Rue de Notre Dame\n', 53300, 'AMBRIERES LES VALLEES', '02-43-04-90-54', '', '02-43-08-89-33', '', '', '', 'JOLIVET', 'PHILIPPE', 3, 0);
INSERT INTO `les_entreprises` VALUES (250, 'POUTEAU  Christiane', 'Les Chênes Secs\n', 53810, 'CHANGE', '', '', '', '', '', '', 'POUTEAU', 'Christiane', 7, 0);
INSERT INTO `les_entreprises` VALUES (251, 'MOUSSU', '11, Faubourg d''Anjou\n', 35130, 'LA GUERCHE DE BRETAGNE', '02-99-96-23-10', '', '02-99-96-44-43', '', '', '', 'MOUSSU', '', 6, 0);
INSERT INTO `les_entreprises` VALUES (252, 'BERTIN  PHILIPPE', '2, rue du Val de Mayenne\n', 53000, 'LAVAL', '02-43-53-71-66', '', '', '', '', '', 'BERTIN', 'PHILIPPE', 5, 0);
INSERT INTO `les_entreprises` VALUES (253, 'RETAILLEAU  Miguel', '13, Rue Vieille des Halles\n', 53100, 'MAYENNE', '02-43-08-23-16', '', '', '', '', '', 'RETAILLEAU', 'Miguel', 2, 0);
INSERT INTO `les_entreprises` VALUES (254, 'LABERGERE  ANDRE', '8, rue du Dr Ramé\n', 53320, 'LOIRON', '02-43-02-10-01', '', '', '', '', '', 'LABERGERE', 'ANDRE', 1, 0);
INSERT INTO `les_entreprises` VALUES (255, 'LOISEL  MARIE-JOSEPHE', '1, Avenue du Maréchal Foch\n', 53200, 'CHATEAU-GONTIER', '02-43-70-43-97', '', '', '', '', '', 'LOISEL', 'MARIE-JOSEPHE', 2, 0);
INSERT INTO `les_entreprises` VALUES (256, 'HELBERT  Claudine', '105 rue victor Boissel\n', 53000, 'LAVAL', '02-43-56-69-64', '', '', '', '', '', 'HELBERT', 'Claudine', 4, 0);
INSERT INTO `les_entreprises` VALUES (257, 'DEMOOR', '56, Rue de Vaufleury\n', 53000, 'LAVAL', '02-43-66-03-81', '', '', '', '', '', 'DEMOOR', '', 0, 0);
INSERT INTO `les_entreprises` VALUES (258, 'LEMESLE  GENEVIEVE', '1 rue de la Chapelle\n', 53800, 'RENAZE', '02-43-06-48-47', '', '', '', '', '', 'LEMESLE', 'GENEVIEVE', 0, 0);
INSERT INTO `les_entreprises` VALUES (259, 'CHEDID', '5, Rue de la Gare\n', 53400, 'CRAON', '02-43-70-17-96', '', '', '', '', '', 'CHEDID', '', 0, 0);
INSERT INTO `les_entreprises` VALUES (260, 'POUSSARD  Franck', '17, Place Clémenceau\n', 53100, 'MAYENNE', '02-43-04-37-83', '', '02-43-00-39-49', '', '', '', 'POUSSARD', 'Franck', 0, 0);
INSERT INTO `les_entreprises` VALUES (261, 'HERAULT  SEBASTIEN', '92, Rue Victor Boissel\n', 53000, 'LAVAL', '02-43-53-40-95', '', '', '', '', '', 'HERAULT', 'SEBASTIEN', 0, 0);
INSERT INTO `les_entreprises` VALUES (262, 'FORET  YVES', '35 place du marché\n', 53170, 'MESLAY DU MAINE', '02-43-98-72-66', '', '', '', '', '', 'FORET', 'YVES', 0, 0);
INSERT INTO `les_entreprises` VALUES (263, 'BALDO  CLAUDE', '13 rue de la Mairie\n', 53440, 'LA BAZOGE MONTPINCON', '02-43-04-81-57', '', '', '', '', '', 'BALDO', 'CLAUDE', 1, 0);
INSERT INTO `les_entreprises` VALUES (264, 'CHAPELLIER', '28, Avenue Aristide Briand\n', 53200, 'CHATEAU-GONTIER', '02-43-07-21-50', '', '', '', '', '', 'CHAPELLIER', '', 0, 0);
INSERT INTO `les_entreprises` VALUES (265, 'MONNIER  STEPHANE', '39, Rue Saint Martin\n', 53100, 'MAYENNE', '02-43-04-88-02', '02-43-00-42-24', '', '', '', '', 'MONNIER', 'STEPHANE', 1, 0);
INSERT INTO `les_entreprises` VALUES (274, 'BOUVET  EMMANUEL', 'Bd Louis Armand\nZone de la Boutellerie', 53940, 'ST BERTHEVIN', '02-43-68-25-27', '', '02-43-90-74-78', '', '', '', 'BOUVET', 'EMMANUEL', 1, 0);
INSERT INTO `les_entreprises` VALUES (266, 'TRIPON  Stéphanie', '67 rue du Gué d''Orger\n', 53000, 'LAVAL', '02-43-02-92-13', '', '', '', '', '', 'TRIPON', 'Stéphanie', 0, 0);
INSERT INTO `les_entreprises` VALUES (267, 'COUPE  Bruno', 'Route d''Alençon\nBP 422', 53100, 'MAYENNE', '02-43-04-32-48', '', '02-43-04-43-65', '', '', '', 'COUPE', 'Bruno', 0, 0);
INSERT INTO `les_entreprises` VALUES (268, 'ALLEARD  ANNE-LAURE', '46, Avenue Maréchal Joffre\n', 53200, 'CHATEAU GONTIER', '02-43-07-28-41', '', '02-43-07-63-79', '', '', '', 'ALLEARD', 'ANNE-LAURE', 0, 0);
INSERT INTO `les_entreprises` VALUES (269, 'DANIEL', 'Boulevard des Trappistines\n', 53000, 'LAVAL', '02-43-02-88-88', '', '02-43-02-87-00', '', '', '', 'DANIEL', '', 7, 0);
INSERT INTO `les_entreprises` VALUES (270, 'COUTANT  Benoit', '31, Rue Garnier\n', 53200, 'CHATEAU-GONTIER', '02-43-07-25-13', '', '02-43-07-02-90', '', '', '', 'COUTANT', 'Benoit', 1, 0);
INSERT INTO `les_entreprises` VALUES (271, 'PIETE  Monique', '13, Rue du Centre\n', 44510, 'LE POULIGUEN', '02-40-42-31-03', '', '02-51-73-49-54', '', '', '', 'PIETE', 'Monique', 0, 0);
INSERT INTO `les_entreprises` VALUES (272, 'CHOPIN  PIERRE', 'Route d''Ernée\n', 35500, 'VITRE', '02-99-75-34-52', '', '', '', '', '', 'CHOPIN', 'PIERRE', 9, 0);
INSERT INTO `les_entreprises` VALUES (273, 'PAPIN  Patrick', '40, Promenade Maréchal Foch\n', 72200, 'LA FLECHE', '02-43-94-00-60', '', '', '', '', '', 'PAPIN', 'Patrick', 3, 0);
INSERT INTO `les_entreprises` VALUES (275, 'BEUCHER  Robert', '23, Place Jean Moulin\n', 53000, 'LAVAL', '02-43-56-81-55', '', '02-43-56-86-78', '', '', '', 'BEUCHER', 'Robert', 2, 0);
INSERT INTO `les_entreprises` VALUES (283, 'LESSARD  Philippe', '4 rue de la Paix\n', 53000, 'LAVAL', '02-43-56-69-65', '', '02-43-56-70-08', '', '', '', 'LESSARD', 'Philippe', 2, 0);
INSERT INTO `les_entreprises` VALUES (276, 'DROUET  Anthony', '50-52 Rue du Général De Gaulle\n', 53000, 'LAVAL', '02-43-56-31-94', '', '', '', '', '', 'DROUET', 'Anthony', 1, 0);
INSERT INTO `les_entreprises` VALUES (277, 'MOUSSET', 'Centre Cial la Motte\n550 bd Jean Monnet', 53100, 'MAYENNE', '02-43-00-96-90', '', '02-43-32-10-56', '', '', '', 'MOUSSET', '', 9, 0);
INSERT INTO `les_entreprises` VALUES (278, 'SCHERDEL  Hervé', '85, avenue de Paris\n', 53940, 'ST BERTHEVIN', '02-43-64-20-20', '', '02-43-64-29-29', '', '', '', 'SCHERDEL', 'Hervé', 4, 0);
INSERT INTO `les_entreprises` VALUES (279, 'GUESNEROT  JEAN-YVES', '84, Rue de Paris\n', 53000, 'LAVAL', '02-43-49-16-00', '', '02-43-53-70-54', '', '', '', 'GUESNEROT', 'JEAN-YVES', 4, 0);
INSERT INTO `les_entreprises` VALUES (280, 'MARC  XAVIER', '76, Rue du Bernard Le Pecq\n', 53000, 'LAVAL', '02-43-70-57-04', '', '02-43-02-80-47', '', '', '', 'MARC', 'XAVIER', 3, 0);
INSERT INTO `les_entreprises` VALUES (281, 'LEMARCHAND', 'Centre Commercial CARREFOUR LA MAYENNE\nAvenue de Lattre de Tassigny', 53000, 'LAVAL', '02-43-68-09-08', '', '', '', '', '', 'LEMARCHAND', '', 3, 0);
INSERT INTO `les_entreprises` VALUES (282, 'LEMOINE  Philippe', '10, RUE\n', 53170, 'LA BAZOUGE-DE-CHEMERE', '02-43-64-31-53', '', '', '', '', '', 'LEMOINE', 'Philippe', 0, 0);
INSERT INTO `les_entreprises` VALUES (284, 'HUNAULT  Irène', '20, Rue d''Anjou\n', 35130, 'LA GUERCHE DE BRETAGNE', '02-99-96-41-15', '', '', '', '', '', 'HUNAULT', 'Irène', 1, 0);
INSERT INTO `les_entreprises` VALUES (285, 'BASSET  VERONIQUE', '5 RUE DE LA PAIX\n', 53000, 'LAVAL', '02-43-53-13-35', '', '', '', '', '', 'BASSET', 'VERONIQUE', 7, 0);
INSERT INTO `les_entreprises` VALUES (286, 'MAHERAULT  Thérèse', '2 place du Général Barrabé\n', 53120, 'GORRON', '02-43-08-63-71', '', '02-43-08-63-71', '', '', '', 'MAHERAULT', 'Thérèse', 0, 0);
INSERT INTO `les_entreprises` VALUES (287, 'BOURILLON  Gérard', 'Route de Laval\nCentre Commercial Les Coévrons', 53600, 'EVRON', '02-43-37-29-44', '', '02-43-37-28-06', '', '', '', 'BOURILLON', 'Gérard', 0, 0);
INSERT INTO `les_entreprises` VALUES (288, 'JOLY  MONIQUE', '60, rue du Général de Gaulle\n', 53000, 'LAVAL', '02-43-68-08-23', '', '02-43-66-19-97', '', '', '', 'JOLY', 'MONIQUE', 2, 0);
INSERT INTO `les_entreprises` VALUES (289, 'VEILLARD  MARIE THERESE', '17 RUE THIERS\n', 53200, 'CHATEAU GONTIER', '02-43-07-30-51', '', '', '', '', '', 'VEILLARD', 'MARIE THERESE', 0, 0);
INSERT INTO `les_entreprises` VALUES (290, 'BERTHOLD  Jean Yves', 'CENTRE  COMMERCIAL LES SABLONS\n', 53810, 'CHANGE', '02-43-56-56-62', '', '02-43-56-81-91', '', '', '', 'BERTHOLD', 'Jean Yves', 25, 0);
INSERT INTO `les_entreprises` VALUES (291, 'BOURDIN  JACQUELINE', '32 rue des Halles\n', 53400, 'CRAON', '02-43-06-18-05', '', '', '', '', '', 'BOURDIN', 'JACQUELINE', 1, 0);
INSERT INTO `les_entreprises` VALUES (292, 'DAGUIN', 'Rue de la Peyennière\n', 53100, 'MAYENNE', '02-43-04-10-20', '', '02-43-00-74-85', '', '', '', 'DAGUIN', '', 20, 0);
INSERT INTO `les_entreprises` VALUES (293, 'LONGEANY  Gérard', 'Centre Commercial La Mayenne\n', 53000, 'LAVAL', '02-43-68-29-50', '02-43-39-26-15', '', '', '', '', 'LONGEANY', 'Gérard', 18, 0);
INSERT INTO `les_entreprises` VALUES (294, 'DEROUET  DOMINIQUE', '9 rue Bernard Le Pecq\n', 53000, 'LAVAL', '02-43-66-94-20', '', '', '', '', '', 'DEROUET', 'DOMINIQUE', 1, 0);
INSERT INTO `les_entreprises` VALUES (295, 'GENDRY  Annie', '1, Place du Général Barrabé\n', 53120, 'GORRON', '02-43-08-40-11', '02-43-08-02-42', '', '', '', '', 'GENDRY', 'Annie', 1, 0);
INSERT INTO `les_entreprises` VALUES (296, 'GUERIN  Gilbert', '37, Rue de la Paix\n', 53000, 'LAVAL', '02-43-53-67-37', '', '02-43-49-11-98', '', '', '', 'GUERIN', 'Gilbert', 1, 0);
INSERT INTO `les_entreprises` VALUES (297, 'DUEZ  RAPHAEL', 'bld Murat\n', 53000, 'LAVAL', '02-43-49-25-00', '', '02-43-49-26-96', '', '', '', 'DUEZ', 'RAPHAEL', 25, 0);
INSERT INTO `les_entreprises` VALUES (298, 'LEPLAY  CLAUDINE', '251 RUE CHARLES DE GAULLE\n', 53100, 'MAYENNE', '02-43-32-18-67', '02-43-08-11-19', '02-43-03-95-81', '', '', '', 'LEPLAY', 'CLAUDINE', 3, 0);
INSERT INTO `les_entreprises` VALUES (299, 'ROLA DE ROZYCKI', '6 RUE DE VERDUN\n', 53000, 'LAVAL', '02-43-53-08-87', '', '02-43-56-92-19', '', '', '', 'ROLA DE ROZYCKI', '', 2, 0);
INSERT INTO `les_entreprises` VALUES (300, 'LEGER', '42, Rue Jean Rostand\nZI DES TOUCHES', 53000, 'LAVAL', '02-43-56-27-90', '02-43-56-27-88', '', '', '', '', 'LEGER', '', 7, 0);
INSERT INTO `les_entreprises` VALUES (301, 'PIRION  CHANTAL', 'ZONE GRIVONNIERE\n63 Avenue de Lattre de Tassigny', 53000, 'LAVAL', '02-43-68-06-03', '', '', '', '', '', 'PIRION', 'CHANTAL', 1, 0);
INSERT INTO `les_entreprises` VALUES (302, 'BOUDIER  Jean', '5, Rue du Général De Gaulle\n', 53000, 'LAVAL', '02-43-56-30-06', '', '02-43-56-30-43', '', '', '', 'BOUDIER', 'Jean', 4, 0);
INSERT INTO `les_entreprises` VALUES (303, 'LECHAT', 'Route de Laval\n', 53600, 'EVRON', '02-43-01-34-82', '', '02-43-01-74-43', '', '', '', 'LECHAT', '', 80, 0);
INSERT INTO `les_entreprises` VALUES (304, 'GEHAN  CATHERINE', '27 rue de la Fontaine\n', 53600, 'EVRON', '02-43-01-76-46', '', '02-43-01-76-46', '', '', '', 'GEHAN', 'CATHERINE', 1, 0);
INSERT INTO `les_entreprises` VALUES (305, 'GIRARD  Jean-Jacques', '62, Boulevard Louis Armand\n', 53940, 'ST BERTHEVIN', '02-43-69-98-82', '', '02-43-69-98-83', '', '', '', 'GIRARD', 'Jean-Jacques', 2, 0);
INSERT INTO `les_entreprises` VALUES (306, 'LAMBERT  MARTINE', 'centre Commercial La Mayenne\n46 Av. de Lattre de Tassigny', 53000, 'LAVAL', '02-43-69-55-41', '', '02-43-69-54-13', '', '', '', 'LAMBERT', 'MARTINE', 0, 0);
INSERT INTO `les_entreprises` VALUES (307, 'TARDIF  GERARD', '47, Rue Crossardière\n', 53000, 'LAVAL', '02-43-56-60-28', '', '02-43-56-34-36', '', '', '', 'TARDIF', 'GERARD', 0, 0);
INSERT INTO `les_entreprises` VALUES (308, 'CHAPDELAINE  Hervé', '44, Rue des Feuteries\n', 35300, 'FOUGERES', '02-99-99-10-98', '02-99-99-39-64', '', 'lamarjolaine@wanadoo.fr', '', '', 'CHAPDELAINE', 'Hervé', 5, 0);
INSERT INTO `les_entreprises` VALUES (309, 'LIGER  LAURENT', '1, rue Alexandre III\n', 35300, 'FOUGERES', '02-99-99-46-30', '', '02-99-94-87-34', '', '', '', 'LIGER', 'LAURENT', 5, 0);
INSERT INTO `les_entreprises` VALUES (310, 'CARLY  GERALDINE', '30, rue de la Paix\n', 53000, 'LAVAL', '02-43-53-08-60', '', '02-43-53-22-36', '', '', '', 'CARLY', 'GERALDINE', 1, 0);
INSERT INTO `les_entreprises` VALUES (311, 'DELHOMMEAU', '8, Bis Rue des Déportés\n', 53000, 'LAVAL', '02-43-53-43-79', '', '', '', '', '', 'DELHOMMEAU', '', 2, 0);
INSERT INTO `les_entreprises` VALUES (312, 'FANOUILLLET  Marlène', '8, Grande Rue\n', 53170, 'MESLAY-DU-MAINE', '02-43-91-13-83', '', '', '', '', '', 'FANOUILLLET', 'Marlène', 3, 0);
INSERT INTO `les_entreprises` VALUES (313, 'NIVAULT  DAVID', '25, avenue de Paris\n', 53940, 'ST BERTHEVIN', '02-43-69-40-00', '', '02-43-69-27-20', '', '', '', 'NIVAULT', 'DAVID', 20, 0);
INSERT INTO `les_entreprises` VALUES (314, 'BRIHAULT  ISABELLE', 'L''HUILERIE\n', 53100, 'MAYENNE', '02-43-00-47-85', '', '', '', '', '', 'BRIHAULT', 'ISABELLE', 9, 0);
INSERT INTO `les_entreprises` VALUES (315, 'FORGIN  Christine', '10 Place du Marché\n', 53170, 'MESLAY DU MAINE', '02-43-98-40-66', '', '', '', '', '', 'FORGIN', 'Christine', 0, 0);
INSERT INTO `les_entreprises` VALUES (316, 'HARDY  Michel', '11, Rue du Maine\n', 53540, 'CUILLE', '02-43-06-54-25', '', '', '', '', '', 'HARDY', 'Michel', 1, 0);
INSERT INTO `les_entreprises` VALUES (317, 'LAVOLLEE  PIERRIK', '13, Rue du Général De Gaulle\n', 53000, 'LAVAL', '02-43-56-02-15', '', '', '', '', '', 'LAVOLLEE', 'PIERRIK', 5, 0);
INSERT INTO `les_entreprises` VALUES (318, 'JEUSSELIN  GUYLAINE', '7, Rue d''Ernée\n', 53240, 'LA BACONNIERE', '02-43-02-71-35', '', '', '', '', '', 'JEUSSELIN', 'GUYLAINE', 1, 0);
INSERT INTO `les_entreprises` VALUES (319, 'JARDIN  Alain', '90, Boulevard Frédéric Chaplet\n', 53000, 'LAVAL', '02-43-68-06-19', '', '', '', '', '', 'JARDIN', 'Alain', 5, 0);
INSERT INTO `les_entreprises` VALUES (320, 'MOTTA  BRUNO', '10 QUAI CARNOT\n', 53100, 'MAYENNE', '02-43-04-18-15', '', '', '', '', '', 'MOTTA', 'BRUNO', 0, 0);
INSERT INTO `les_entreprises` VALUES (321, 'CHENAIS  PASCAL', '51, Rue des Archives\n', 53000, 'LAVAL', '02-43-67-01-48', '', '', '', '', '', 'CHENAIS', 'PASCAL', 1, 0);
INSERT INTO `les_entreprises` VALUES (322, 'COUE  José', '57, Boulevard Louis Armand\n', 53940, 'SAINT-BERTHEVIN', '02-43-69-99-80', '', '', '', '', '', 'COUE', 'José', 3, 0);
INSERT INTO `les_entreprises` VALUES (323, 'DAMOURETTE  Dominique', '10, Place de l''Eglise\n', 53220, 'MONTAUDIN', '02-43-05-32-56', '', '', '', '', '', 'DAMOURETTE', 'Dominique', 0, 0);
INSERT INTO `les_entreprises` VALUES (324, 'HELUARD  Raymond', 'Route de Sillé\n', 53600, 'EVRON', '02-43-01-64-95', '', '02-43-26-85-85', '', '', '', 'HELUARD', 'Raymond', 41, 0);
INSERT INTO `les_entreprises` VALUES (325, 'VIENT  Yannick', 'Lieu dit les Bozées\n', 53000, 'LAVAL', '02-43-53-01-01', '02-43-49-00-01', '', '', '', '', 'VIENT', 'Yannick', 0, 0);
INSERT INTO `les_entreprises` VALUES (326, 'TURPIN  JACQUELINE', '31 RUE DE LA PAIX\n', 53000, 'LAVAL', '02-43-56-99-47', '', '', '', '', '', 'TURPIN', 'JACQUELINE', 3, 0);
INSERT INTO `les_entreprises` VALUES (327, 'FRAUDIN  CLAUDE', '98 bd Jean Jaurès\n', 53000, 'LAVAL', '02-43-68-17-14', '', '02-43-69-12-76', '', '', '', 'FRAUDIN', 'CLAUDE', 6, 0);
INSERT INTO `les_entreprises` VALUES (328, 'AURRIERE  THIERRY', '10 PL D''AVESNIERES\n', 53000, 'LAVAL', '02-43-53-21-42', '', '', '', '', '', 'AURRIERE', 'THIERRY', 0, 0);
INSERT INTO `les_entreprises` VALUES (330, 'PACORY  Laure', '13, Grande Rue\n', 53110, 'LASSAY-LES-CHATEAUX', '02-43-04-84-99', '', '', '', '', '', 'PACORY', 'Laure', 0, 0);
INSERT INTO `les_entreprises` VALUES (329, 'QUELLIER  Hélène', '62, Avenue du Général De Gaulle\n', 53000, 'LAVAL', '02-43-69-00-41', '06-12-68-89-09', '', '', '', '', 'QUELLIER', 'Hélène', 0, 0);
INSERT INTO `les_entreprises` VALUES (331, 'CADET  Pierrick', 'Rue du Génral de Gaulle\n', 53000, 'LAVAL', '02-43-64-36-20', '', '02-43-64-36-21', '', '', '', 'CADET', 'Pierrick', 12, 0);
INSERT INTO `les_entreprises` VALUES (332, 'COURCIER  Jean-Pierre', '14, Avenue de l''Atlantique\nB.P : 429', 53004, 'LAVAL CEDEX', '02-43-01-20-11', '', '02-43-68-17-15', '', '', '', 'COURCIER', 'Jean-Pierre', 31, 0);
INSERT INTO `les_entreprises` VALUES (333, 'THEBAULT  MICHEL', '55, rue de la Paix\n', 53000, 'LAVAL', '02-43-53-20-23', '', '02-43-56-84-02', '', '', '', 'THEBAULT', 'MICHEL', 4, 0);
INSERT INTO `les_entreprises` VALUES (334, 'MELO  ANDREE', 'Centre commercial de la Mayenne\nAv. de Lattre de Tassigny', 53000, 'LAVAL', '02-43-68-24-92', '', '02-43-91-40-06', '', '', '', 'MELO', 'ANDREE', 5, 0);
INSERT INTO `les_entreprises` VALUES (335, 'LOURERIO DA-COSTA  Camillo', 'Zone artisanale la Fouquerie\n', 72300, 'SOLESMES', '02-43-94-85-03', '', '', '', '', '', 'LOURERIO DA-COSTA', 'Camillo', 0, 0);
INSERT INTO `les_entreprises` VALUES (336, 'CERISIER  Christine', '10 carrefour aux toiles\n', 53000, 'LAVAL', '02-43-66-86-87', '', '', '', '', '', 'CERISIER', 'Christine', 2, 0);
INSERT INTO `les_entreprises` VALUES (337, 'CHAUVEAU  RAPHAEL', '6 Grande Rue\n', 53160, 'BAIS', '02-43-37-94-81', '', '02-43-37-94-81', '', '', '', 'CHAUVEAU', 'RAPHAEL', 2, 0);
INSERT INTO `les_entreprises` VALUES (338, 'GAUDIN  Philippe', '5, Rue de Bretagne\n', 53000, 'LAVAL', '02-43-66-99-93', '', '', '', '', '', 'GAUDIN', 'Philippe', 0, 0);
INSERT INTO `les_entreprises` VALUES (339, 'RABBE  Jacques', '84, Boulevard Frédéric Chaplet\n', 53000, 'LAVAL', '02-43-68-06-29', '', '', '', '', '', 'RABBE', 'Jacques', 9, 0);
INSERT INTO `les_entreprises` VALUES (340, 'CARPENTIER  Michel', '9 place clemenceau\n', 53100, 'MAYENNE', '02-43-04-17-87', '', '02-43-04-17-87', '', '', '', 'CARPENTIER', 'Michel', 1, 0);
INSERT INTO `les_entreprises` VALUES (341, 'FOLLIOT', '33 RUE ARISTIDE BRIAND\n', 53100, 'MAYENNE', '02-43-04-18-23', '', '', '', '', '', 'FOLLIOT', '', 2, 0);
INSERT INTO `les_entreprises` VALUES (342, 'REAUTE', '322, Route de Tours\n', 53000, 'LAVAL', '02-43-58-02-02', '', '', '', '', '', 'REAUTE', '', 2, 0);
INSERT INTO `les_entreprises` VALUES (359, 'GEORGES  Luc', 'Z.I NORD LA COLTERIE\n59, Rue de Paris', 53940, 'ST BERTHEVIN', '02-43-66-02-86', '', '02-43-68-09-64', '', '', '', 'GEORGES', 'Luc', 2, 0);
INSERT INTO `les_entreprises` VALUES (343, 'OUTREQUIN  Francis', '12, Rue Balzac\n', 35300, 'FOUGERES', '02-99-99-07-78', '', '', '', '', '', 'OUTREQUIN', 'Francis', 3, 0);
INSERT INTO `les_entreprises` VALUES (344, 'BIZEUL  Thierry', '1, Rue Saint-Louis\n', 35690, 'ACIGNE', '02-99-62-53-03', '', '', '', '', '', 'BIZEUL', 'Thierry', 3, 0);
INSERT INTO `les_entreprises` VALUES (345, 'CAUTY  Pascal', '3 rue de Ste Gemmes\n', 53600, 'EVRON', '02-43-01-61-24', '', '02-43-01-37-78', '', '', '', 'CAUTY', 'Pascal', 4, 0);
INSERT INTO `les_entreprises` VALUES (346, 'GUEGNIARD  DOMINIQUE', '18, Place d''Avesnières\n', 53000, 'LAVAL', '02-43-56-58-99', '', '', '', '', '', 'GUEGNIARD', 'DOMINIQUE', 3, 0);
INSERT INTO `les_entreprises` VALUES (347, 'MASSOT  JEAN-FRANCOIS', '10 rue de Loré\n', 53000, 'LAVAL', '02-43-53-99-42', '', '', '', '', '', 'MASSOT', 'JEAN-FRANCOIS', 5, 0);
INSERT INTO `les_entreprises` VALUES (348, 'BARCELOT  Lydie', '13, Rue des Trois Croix\n', 53000, 'LAVAL', '02-43-49-09-32', '', '', '', '', '', 'BARCELOT', 'Lydie', 3, 0);
INSERT INTO `les_entreprises` VALUES (349, 'DUBOIS', '4, rue de la Madeleine\n', 53100, 'MAYENNE', '02-43-04-23-95', '', '', '', '', '', 'DUBOIS', '', 0, 0);
INSERT INTO `les_entreprises` VALUES (350, 'BORDAIS  Jeanine', '3 rue du Couesnon\n', 35133, 'JAVENE', '02-99-99-15-16', '02-99-99-60-27', '', '', '', '', 'BORDAIS', 'Jeanine', 2, 0);
INSERT INTO `les_entreprises` VALUES (351, 'LE GALL  Sébastien', '4, Rue du Maine\n', 53410, 'BOURGON', '02-43-37-71-79', '', '', '', '', '', 'LE GALL', 'Sébastien', 0, 0);
INSERT INTO `les_entreprises` VALUES (352, 'PARIS  JEAN-PIERRE', '113, Rue du Pont de Mayenne\n', 53000, 'LAVAL', '02-43-53-39-55', '', '', '', '', '', 'PARIS', 'JEAN-PIERRE', 0, 0);
INSERT INTO `les_entreprises` VALUES (353, 'LOCHAIN  Philippe', '11, Place d''Avesnières\n', 53000, 'LAVAL', '02-43-53-24-80', '', '', '', '', '', 'LOCHAIN', 'Philippe', 2, 0);
INSERT INTO `les_entreprises` VALUES (354, 'VILLALARD  Jean-Yves', '34, Grande Rue\n', 53150, 'MONTSURS', '02-43-01-01-05', '', '', '', '', '', 'VILLALARD', 'Jean-Yves', 0, 0);
INSERT INTO `les_entreprises` VALUES (355, 'NARAS  ERICK', '10 Place de la Trémoille\n', 53000, 'LAVAL', '02-43-53-19-94', '', '', '', '', '', 'NARAS', 'ERICK', 3, 0);
INSERT INTO `les_entreprises` VALUES (356, 'MORICE  Christèle', '20, Rue des Forges\n', 53410, 'PORT-BRILLET', '02-43-68-82-48', '', '', '', '', '', 'MORICE', 'Christèle', 1, 0);
INSERT INTO `les_entreprises` VALUES (357, 'CHALOPIN  MARIE-EVE', '31, Place De Gaulle\n', 35420, 'LOUVIGNE-DU-DESERT', '02-99-98-09-04', '', '', '', '', '', 'CHALOPIN', 'MARIE-EVE', 1, 0);
INSERT INTO `les_entreprises` VALUES (358, 'CHAUVIERE  JEAN-YVES', 'Route de Laval\n', 53410, 'LE BOURGNEUF LA FORET', '02-43-37-17-92', '', '02-43-37-16-29', '', '', '', 'CHAUVIERE', 'JEAN-YVES', 40, 0);
INSERT INTO `les_entreprises` VALUES (360, 'CHEMINANT  Franck', 'LA HAINAUD\nROUTE DE LAVAL', 53500, 'ERNEE', '02-43-05-74-90', '', '02-43-05-81-83', '', '', '', 'CHEMINANT', 'Franck', 25, 0);
INSERT INTO `les_entreprises` VALUES (361, 'ROBINET  BRUNO', '42 rue de la Perrière\n', 53600, 'EVRON', '02-43-01-62-43', '', '', '', '', '', 'ROBINET', 'BRUNO', 2, 0);
INSERT INTO `les_entreprises` VALUES (362, 'DUVAL  DOMINIQUE', 'LE BOURG\n', 53190, 'FOUGEROLLES DU PLESSIS', '02-43-05-55-69', '', '', '', '', '', 'DUVAL', 'DOMINIQUE', 2, 0);
INSERT INTO `les_entreprises` VALUES (363, 'GIRAULT  STEPHANE', '114, Rue Victor Boissel\n', 53000, 'LAVAL', '02-43-53-28-26', '', '', '', '', '', 'GIRAULT', 'STEPHANE', 0, 0);
INSERT INTO `les_entreprises` VALUES (364, 'CERISIER  Jean Yves', '83 avenue Robert Buron\n', 53000, 'LAVAL', '02-43-53-17-83', '', '', '', '', '', 'CERISIER', 'Jean Yves', 5, 0);
INSERT INTO `les_entreprises` VALUES (365, 'BOITTIN  ALAIN', '7 place Crottigné\n', 53150, 'MONTSURS', '02-43-01-02-90', '', '', '', '', '', 'BOITTIN', 'ALAIN', 3, 0);
INSERT INTO `les_entreprises` VALUES (366, 'ONNO  Noël', '29, Rue d''Anjou\n', 53260, 'ENTRAMMES', '02-43-98-00-50', '', '02-43-98-00-50', '', '', '', 'ONNO', 'Noël', 3, 0);
INSERT INTO `les_entreprises` VALUES (367, 'MARTIN  Patrick', '80, Boulevard Jean Jaurès\n', 53000, 'LAVAL', '02-43-69-58-58', '06-19-27-44-59', '', '', '', '', 'MARTIN', 'Patrick', 4, 0);
INSERT INTO `les_entreprises` VALUES (368, 'RENAULT  STEPHANE', '17 place du 9 Juin 1944\n', 53100, 'MAYENNE', '02-43-04-43-41', '', '02-43-04-43-41', '', '', '', 'RENAULT', 'STEPHANE', 6, 0);
INSERT INTO `les_entreprises` VALUES (369, 'GRIMAULT  Patrick', 'CENTRE COMMERCIAL MURAT\n29, Rue Oudimot', 53000, 'LAVAL', '02-43-49-19-18', '', '', '', '', '', 'GRIMAULT', 'Patrick', 1, 0);
INSERT INTO `les_entreprises` VALUES (370, 'PESLIER  MARIE THERESE', '14 RUE DES DEPORTES\n', 53000, 'LAVAL', '02-43-53-15-07', '', '', '', '', '', 'PESLIER', 'MARIE THERESE', 3, 0);
INSERT INTO `les_entreprises` VALUES (371, 'SAUNIER  Nathalie', '3 rue de la Paix\n', 53000, 'LAVAL', '02-43-53-26-40', '', '', '', '', '', 'SAUNIER', 'Nathalie', 1, 0);
INSERT INTO `les_entreprises` VALUES (372, 'JOBARD  JEAN LUC', '4 rue Bernard Le Pecq\n', 53000, 'LAVAL', '02-43-66-13-30', '', '02-43-66-13-31', '', '', '', 'JOBARD', 'JEAN LUC', 3, 0);
INSERT INTO `les_entreprises` VALUES (373, 'GRANDJEAN-LERICHE  Sonia', '8 rue du Lieutenant\n', 53000, 'LAVAL', '02-43-49-17-96', '', '02-43-49-17-96', '', '', '', 'GRANDJEAN-LERICHE', 'Sonia', 0, 0);
INSERT INTO `les_entreprises` VALUES (374, 'PAQUET  PASCAL', '14 Rue de la Paix\n', 53000, 'LAVAL', '02-43-53-23-60', '', '02-43-56-19-03', '', '', '', 'PAQUET', 'PASCAL', 10, 0);
INSERT INTO `les_entreprises` VALUES (375, 'FAGOT  Emmanuelle', 'Avenue de Paris\n', 53940, 'SAINT-BERTHEVIN', '02-43-02-40-51', '', '02-43-02-40-51', '', '', '', 'FAGOT', 'Emmanuelle', 3, 0);
INSERT INTO `les_entreprises` VALUES (376, 'COCHON  DOMINIQUE', '1 RUE DU PORT\n', 53470, 'MARTIGNE S/MAYENNE', '02-43-02-53-09', '', '02-43-02-52-90', '', '', '', 'COCHON', 'DOMINIQUE', 2, 0);
INSERT INTO `les_entreprises` VALUES (377, 'LEPAGE  PATRICK', '4, Rue des Sports\n', 53210, 'ARGENTRE', '02-43-68-05-28', '', '02-43-68-05-28', '', '', '', 'LEPAGE', 'PATRICK', 1, 0);
INSERT INTO `les_entreprises` VALUES (378, 'RENARD', 'Rue de Wildeshausen\n', 53600, 'EVRON', '02-43-01-06-75', '', '02-43-37-40-80', '', '', '', 'RENARD', '', 5, 0);
INSERT INTO `les_entreprises` VALUES (379, 'LECONTE  Jean-Marie', '50, Avenue du Préfet\nB.P : 3847', 53032, 'LAVAL CEDEX 9', '02-43-49-66-00', '', '02-43-53-27-02', '', '', '', 'LECONTE', 'Jean-Marie', 450, 0);
INSERT INTO `les_entreprises` VALUES (380, 'MARY', 'Route de Fougères\n', 53120, 'GORRON', '02-43-08-49-49', '', '02-43-08-66-19', '', '', '', 'MARY', '', 165, 0);
INSERT INTO `les_entreprises` VALUES (381, 'CHAMBARD  PIERRE', 'Rue des Frères Lumière\n', 53230, 'COSSE LE VIVIEN', '02-43-98-27-76', '', '02-43-64-33-90', '', '', '', 'CHAMBARD', 'PIERRE', 76, 0);
INSERT INTO `les_entreprises` VALUES (382, 'BRIERE', '1, Rue Saint-Thomas\n', 35400, 'SAINT-MALO', '02-23-16-16-62', '', '02-23-18-17-03', '', '', '', 'BRIERE', '', 6, 0);
INSERT INTO `les_entreprises` VALUES (383, 'BELIS', 'Espace Jacques Cartier\nB.P : 37', 35360, 'MONTAUBAN DE BRETAGNE', '02-99-06-61-61', '', '02-99-06-36-36', '', '', '', 'BELIS', '', 96, 0);
INSERT INTO `les_entreprises` VALUES (384, 'LUET  Angelo', '2, Place de la Loge\n', 49500, 'SEGRE', '02-41-92-14-84', '06-16-60-18-08', '02-41-92-14-81', '', '', '', 'LUET', 'Angelo', 1, 0);
INSERT INTO `les_entreprises` VALUES (385, 'LOURY', 'ZI route de Cigné\n', 53300, 'AMBRIERES-LES-VALLEES', '02-43-04-92-22', '', '02-43-08-91-23', '', '', '', 'LOURY', '', 13, 0);
INSERT INTO `les_entreprises` VALUES (386, 'LAPOUDGE  Dominique', '36 impasse des Rives du Ter\n', 56270, 'PLOEMEUR', '02-97-85-21-37', '', '', '', '', '', 'LAPOUDGE', 'Dominique', 0, 0);
INSERT INTO `les_entreprises` VALUES (389, 'LEGAS  Christine', '1, Avenue de la Préfecture\n', 35042, 'RENNES CEDEX', '02-99-02-35-35', '', '', '', '', '', 'LEGAS', 'Christine', 0, 0);
INSERT INTO `les_entreprises` VALUES (387, 'SOUFFLET  Dominique', 'Rue Victor Baltard\n', 35500, 'VITRE', '02-99-74-65-94', '', '02-99-74-78-00', '', '', '', 'SOUFFLET', 'Dominique', 2036, 0);
INSERT INTO `les_entreprises` VALUES (388, 'BIGNON  Eric', 'L''Orrière\n', 53410, 'PORT BRILLET', '02-43-68-80-52', '', '02-43-68-86-64', '', '', '', 'BIGNON', 'Eric', 102, 0);
INSERT INTO `les_entreprises` VALUES (390, 'PAILLARD  Michel', 'ZA de la Brique\n', 53810, 'CHANGE', '02-43-49-37-00', '', '02-43-56-51-10', '', '', '', 'PAILLARD', 'Michel', 19, 0);
INSERT INTO `les_entreprises` VALUES (391, 'MAUPILIER  FABRICE', '6, Rue de la Concorde\n', 85460, 'L''AIGUILLON S/MER', '02-51-97-83-00', '', '02-51-97-83-10', '', '', '', 'MAUPILIER', 'FABRICE', 2, 0);
INSERT INTO `les_entreprises` VALUES (392, 'PRETEUX  Jean-Marc', '4, Place de Hercé\n', 53100, 'MAYENNE', '02-43-04-22-89', '', '', '', '', '', 'PRETEUX', 'Jean-Marc', 2, 0);
INSERT INTO `les_entreprises` VALUES (393, 'HUGER  JEAN-CLAUDE', '27 rue St Martin\n', 53100, 'MAYENNE', '02-43-04-13-43', '', '02-43-04-13-43', 'jc-huger@wanadoo.fr', '', '', 'HUGER', 'JEAN-CLAUDE', 1, 0);
INSERT INTO `les_entreprises` VALUES (394, 'LUCAS  MICHEL', '26 place Renault Morlière\n', 53500, 'ERNEE', '02-43-05-12-68', '06-17-95-80-34', '', '', '', '', 'LUCAS', 'MICHEL', 1, 0);
INSERT INTO `les_entreprises` VALUES (395, 'VERDIER  JACKY', '11 rue Charles de Gaulle\n', 53810, 'CHANGE', '02-43-53-38-57', '', '', '', '', '', 'VERDIER', 'JACKY', 0, 0);
INSERT INTO `les_entreprises` VALUES (396, 'DUGUET  JACQUES', '17 rue Charles Landelle\n', 53000, 'LAVAL', '02-43-53-28-39', '06-73-53-06-99', '', '', '', '', 'DUGUET', 'JACQUES', 4, 0);
INSERT INTO `les_entreprises` VALUES (397, 'MESLIER  OLIVIER', '7 Rue de Paris\n', 35500, 'VITRE', '02-99-75-33-52', '', '', '', '', '', 'MESLIER', 'OLIVIER', 0, 0);
INSERT INTO `les_entreprises` VALUES (398, 'GASSE  PHILIPPE', '2 rue de la Perrière\n', 53600, 'EVRON', '02-43-01-60-41', '', '', '', '', '', 'GASSE', 'PHILIPPE', 0, 0);
INSERT INTO `les_entreprises` VALUES (399, 'BURNEL  Christophe', '13, Rue de Bouchevreau\n', 53300, 'AMBRIERES-LES-VALLEES', '02-43-04-92-84', '', '', '', '', '', 'BURNEL', 'Christophe', 2, 0);
INSERT INTO `les_entreprises` VALUES (400, 'BOUVERET  Jean-Philippe', '2, Rue de la Montée\n', 53120, 'GORRON', '02-43-08-64-81', '', '', '', '', '', 'BOUVERET', 'Jean-Philippe', 2, 0);
INSERT INTO `les_entreprises` VALUES (401, 'BERTHE  CHRISTIAN', 'Place de la Poste\n', 53940, 'LE GENEST ST ISLE', '02-43-02-11-61', '', '', '', '', '', 'BERTHE', 'CHRISTIAN', 2, 0);
INSERT INTO `les_entreprises` VALUES (402, 'BOUILLE  Régis', '5, Rue des Déportés\n', 53000, 'LAVAL', '02-43-53-20-29', '', '', '', '', '', 'BOUILLE', 'Régis', 2, 0);
INSERT INTO `les_entreprises` VALUES (403, 'GUIBERT  Jessie', '8, Rue des Forges\n', 53410, 'PORT BRILLET', '02-43-68-83-71', '', '', '', '', '', 'GUIBERT', 'Jessie', 1, 0);
INSERT INTO `les_entreprises` VALUES (404, 'BRILHAULT  CHRISTIAN', '6, Rue Amiral Courbet\n', 53500, 'ERNEE', '02-43-05-23-37', '', '', '', '', '', 'BRILHAULT', 'CHRISTIAN', 3, 0);
INSERT INTO `les_entreprises` VALUES (405, 'SERGENT  JEAN-NOEL', '6 bld Victor Hugo\n', 53200, 'CHATEAU GONTIER', '02-43-70-46-29', '', '', '', '', '', 'SERGENT', 'JEAN-NOEL', 8, 0);
INSERT INTO `les_entreprises` VALUES (406, 'HEINRY  MICHEL', '10 rue de la Libération\n', 53400, 'CRAON', '02-43-06-29-08', '', '', '', '', '', 'HEINRY', 'MICHEL', 4, 0);
INSERT INTO `les_entreprises` VALUES (407, 'FOURMOND  Stéphane', '3, Boulevard Leclerc\n', 35300, 'FOUGERES', '02-99-99-09-14', '02-99-99-77-83', '', '', '', '', 'FOURMOND', 'Stéphane', 2, 0);
INSERT INTO `les_entreprises` VALUES (408, 'RIBOT  Hervé', '6, Rue Echelle Marteau\n', 53000, 'LAVAL', '02-43-53-15-85', '', '', '', '', '', 'RIBOT', 'Hervé', 2, 0);
INSERT INTO `les_entreprises` VALUES (409, 'GUY  PATRICE', '2 rue de la Fontaine\n', 53600, 'EVRON', '02-43-01-61-38', '', '', '', '', '', 'GUY', 'PATRICE', 1, 0);
INSERT INTO `les_entreprises` VALUES (410, 'BARDIN  Philippe', '11 rue Victor Foucault\n', 53800, 'RENAZE', '02-43-06-41-04', '', '', '', '', '', 'BARDIN', 'Philippe', 2, 0);
INSERT INTO `les_entreprises` VALUES (411, 'NEAU  JEAN-PATRICK', '11, Place du Pilori\n', 53600, 'EVRON', '02-43-01-91-93', '06-77-01-70-29', '', '', '', '', 'NEAU', 'JEAN-PATRICK', 3, 0);
INSERT INTO `les_entreprises` VALUES (412, 'CLAVREUL  BERTRAND', '1 RUE DE LA GARE\n', 53150, 'MONTSURS', '02-43-01-00-38', '', '', '', '', '', 'CLAVREUL', 'BERTRAND', 3, 0);
INSERT INTO `les_entreprises` VALUES (413, 'BOUDIN  BRUNO', 'L''Huilerie - Route de Laval\n', 53100, 'MAYENNE', '02-43-00-47-85', '', '', '', '', '', 'BOUDIN', 'BRUNO', 8, 0);
INSERT INTO `les_entreprises` VALUES (414, 'BIZERAY  BERNARD', '43 R 130e Régiment d''Infanterie\n', 53100, 'MAYENNE', '02-43-04-13-63', '', '', '', '', '', 'BIZERAY', 'BERNARD', 0, 0);
INSERT INTO `les_entreprises` VALUES (415, 'FOUQUET  JEAN-CHRISTOPHE', '117-119, rue de Bretagne\n', 53000, 'LAVAL', '02-43-69-55-05', '', '', '', '', '', 'FOUQUET', 'JEAN-CHRISTOPHE', 1, 0);
INSERT INTO `les_entreprises` VALUES (416, 'GAIGNE  Jean Jacques', '7 route de Tours\n', 53260, 'FORCE', '02-43-53-64-47', '', '', '', '', '', 'GAIGNE', 'Jean Jacques', 0, 0);
INSERT INTO `les_entreprises` VALUES (417, 'LAIGRE  CHRISTIAN', '60 Route de Nantes\n', 53230, 'COSSE LE VIVIEN', '02-43-98-85-48', '', '', '', '', '', 'LAIGRE', 'CHRISTIAN', 3, 0);
INSERT INTO `les_entreprises` VALUES (418, 'MICHEL  Sylvain', '4, Rue de Bretagne\n', 53410, 'SAINT-PIERRE-LA-COUR', '02-43-01-85-48', '', '', '', '', '', 'MICHEL', 'Sylvain', 1, 0);
INSERT INTO `les_entreprises` VALUES (419, 'ROBILLARD  JOEL', '13 Rue Centrale\n', 53940, 'AHUILLE', '02-43-68-93-29', '', '', '', '', '', 'ROBILLARD', 'JOEL', 1, 0);
INSERT INTO `les_entreprises` VALUES (420, 'FARDEAU  Emmanuel', '9, Rue des Ormeaux\n', 53500, 'MONTENAY', '02-43-05-11-54', '', '', '', '', '', 'FARDEAU', 'Emmanuel', 0, 0);
INSERT INTO `les_entreprises` VALUES (421, 'MAIGNER  Yvan', '8, Rue de la Fontaine\n', 53600, 'EVRON', '02-43-01-25-00', '', '', '', '', '', 'MAIGNER', 'Yvan', 0, 0);
INSERT INTO `les_entreprises` VALUES (422, 'TETU-DENIS', '62 Route de Laval\n', 53240, 'LA BACONNIERE', '02-43-02-63-10', '', '02-43-02-64-87', '', '', '', 'TETU-DENIS', '', 1, 0);
INSERT INTO `les_entreprises` VALUES (423, 'PEPIN ET HEUZE', '7 B, Rue Saint-Aventin\n', 53200, 'AZE', '02-43-07-29-61', '', '02-43-07-46-12', '', '', '', 'PEPIN ET HEUZE', '', 14, 0);
INSERT INTO `les_entreprises` VALUES (424, 'TANDE  Alain', '18 rue du Sergent Louvrier\n', 53100, 'MAYENNE', '02-43-00-09-09', '', '02-43-32-00-74', '', '', '', 'TANDE', 'Alain', 8, 0);
INSERT INTO `les_entreprises` VALUES (425, 'FUSIL  Yveline', '14, Rue d''Anjou\n', 35130, 'LA GUERCHE-DE-BRETAGNE', '02-99-96-21-76', '', '02-99-96-02-04', '', '', '', 'FUSIL', 'Yveline', 6, 0);
INSERT INTO `les_entreprises` VALUES (426, 'ROUMEGOUS  GEORGES', '17, Rue de Normandie\n', 53440, 'ARON', '02-43-32-14-00', '', '02-43-04-56-39', '', '', '', 'ROUMEGOUS', 'GEORGES', 4, 0);
INSERT INTO `les_entreprises` VALUES (427, 'GUITTET  Thérèse', '1, Carrefour du Centre\n', 53170, 'MESLAY DU MAINE', '02-43-98-41-33', '', '02-43-98-71-05', '', '', '', 'GUITTET', 'Thérèse', 5, 0);
INSERT INTO `les_entreprises` VALUES (428, 'COIFFIER  Catherine', '\n', 53700, 'VILLAINES-LA-JUHEL', '02-43-03-21-64', '', '', '', '', '', 'COIFFIER', 'Catherine', 0, 0);
INSERT INTO `les_entreprises` VALUES (429, 'HUBERT  Françoise', 'Place du Marché\n', 61350, 'PASSAIS', '02-33-38-71-22', '02-33-38-59-53', '', '', '', '', 'HUBERT', 'Françoise', 3, 0);
INSERT INTO `les_entreprises` VALUES (430, 'GEFFRAY  Anne', '37, Rue Aristide Briand\n', 44110, 'CHATEAUBRIANT', '02-40-81-00-34', '', '02-40-81-09-98', '', '', '', 'GEFFRAY', 'Anne', 7, 0);
INSERT INTO `les_entreprises` VALUES (431, 'HERVE  FRANCOIS', '3 rue des Forges\n', 53410, 'PORT BRILLET', '02-43-68-83-56', '', '02-43-68-86-42', '', '', '', 'HERVE', 'FRANCOIS', 5, 0);
INSERT INTO `les_entreprises` VALUES (432, 'SAAD  Remy', '5, Place de l''église\n', 53300, 'OISSEAU', '02-43-00-10-74', '', '', '', '', '', 'SAAD', 'Remy', 0, 0);
INSERT INTO `les_entreprises` VALUES (433, 'SIMON  PHILIPPE', '1 rue des Sports\n', 53940, 'AHUILLE', '02-43-68-92-68', '', '02-43-68-96-50', '', '', '', 'SIMON', 'PHILIPPE', 1, 0);
INSERT INTO `les_entreprises` VALUES (434, 'RANDRIANALIMANANA  Lalao', '1, Place de la Porte\n', 35150, 'PIRE-SUR-SEICHE', '02-99-44-21-13', '', '', '', '', '', 'RANDRIANALIMANANA', 'Lalao', 2, 0);
INSERT INTO `les_entreprises` VALUES (435, 'LE LAY  VERONIQUE', '2, rue du Docteur Roux\n', 53000, 'LAVAL', '02-43-68-02-57', '', '02-43-68-67-17', '', '', '', 'LE LAY', 'VERONIQUE', 3, 0);
INSERT INTO `les_entreprises` VALUES (436, 'DESJOBERT  Jacques', '9, Rue Thiers\n', 53200, 'CHATEAU-GONTIER', '02-43-07-21-83', '', '02-43-07-37-98', '', '', '', 'DESJOBERT', 'Jacques', 3, 0);
INSERT INTO `les_entreprises` VALUES (437, 'BESNIER  Nicole', '3, Rue du Maine\n', 53960, 'BONCHAMP-LES-LAVAL', '02-43-90-36-72', '', '02-43-90-92-90', '', '', '', 'BESNIER', 'Nicole', 1, 0);
INSERT INTO `les_entreprises` VALUES (438, 'HUBERT DE FRAISSE  François', '4 place du Pilori\n', 53200, 'CHATEAU GONTIER', '02-43-07-12-39', '', '02-43-07-66-30', '', '', '', 'HUBERT DE FRAISSE', 'François', 4, 0);
INSERT INTO `les_entreprises` VALUES (439, 'LOXQ  Christine', '67 avenue Robert Buron\n', 53000, 'LAVAL', '02-43-53-60-98', '', '02-43-53-45-65', '', '', '', 'LOXQ', 'Christine', 7, 0);
INSERT INTO `les_entreprises` VALUES (440, 'RAIMBAULT  Marie-Pascale', '42 avenue du Maréchal Joffre\n', 53200, 'CHATEAU GONTIER', '02-43-70-44-76', '', '02-43-07-98-10', '', '', '', 'RAIMBAULT', 'Marie-Pascale', 3, 0);
INSERT INTO `les_entreprises` VALUES (441, 'SORIEUX  LOUIS', '15 Place du Marché\n', 53230, 'COSSE LE VIVIEN', '02-43-98-80-07', '', '', '', '', '', 'SORIEUX', 'LOUIS', 4, 0);
INSERT INTO `les_entreprises` VALUES (442, 'DEUIL  CATHERINE', '6 Place du Marché\n', 53170, 'MESLAY DU MAINE', '02-43-98-40-15', '', '02-43-64-23-93', '', '', '', 'DEUIL', 'CATHERINE', 5, 0);
INSERT INTO `les_entreprises` VALUES (443, 'GOURET  Nathalie', '13, Rue du Maine\n', 53240, 'ANDOUILLE', '02-43-69-74-07', '', '', '', '', '', 'GOURET', 'Nathalie', 1, 0);
INSERT INTO `les_entreprises` VALUES (444, 'CARPENTIER  Françoise', 'Place Saint Martin\n', 53950, 'LOUVERNE', '02-43-01-10-67', '', '02-43-37-81-12', '', '', '', 'CARPENTIER', 'Françoise', 4, 0);
INSERT INTO `les_entreprises` VALUES (445, 'PINCON  ERIC', '15, 17 Rue du Gal de Gaulle\n', 53810, 'CHANGE', '02-43-53-57-97', '', '02-43-56-05-29', '', '', '', 'PINCON', 'ERIC', 2, 0);
INSERT INTO `les_entreprises` VALUES (446, 'LEMONNIER', '58 Avenue de la Division Leclerc\n', 53200, 'CHATEAU GONTIER', '02-43-07-17-82', '', '02-43-70-13-50', '', '', '', 'LEMONNIER', '', 7, 0);
INSERT INTO `les_entreprises` VALUES (447, 'JACOVIAC  CHRISTIAN', '20, rue de Nantes\n', 53230, 'COSSE LE VIVIEN', '02-43-98-90-80', '', '02-43-91-79-16', '', '', '', 'JACOVIAC', 'CHRISTIAN', 0, 0);
INSERT INTO `les_entreprises` VALUES (448, 'RABILLOUD-CHEVALIER', '2 Impasse des Ecoles\n', 53290, 'GREZ EN BOUERE', '02-43-70-50-08', '', '02-43-70-64-78', '', '', '', 'RABILLOUD-CHEVALIER', '', 3, 0);
INSERT INTO `les_entreprises` VALUES (449, 'ROULLAND', 'Route de Mayenne\n', 53100, 'MOULAY', '02-43-00-44-66', '', '02-43-00-44-66', '', '', '', 'ROULLAND', '', 0, 0);
INSERT INTO `les_entreprises` VALUES (450, 'LA MARLE  Christine', '2, Route de Bouère\n', 53290, 'ST DENIS D''ANJOU', '02-43-70-52-17', '', '', '', '', '', 'LA MARLE', 'Christine', 2, 0);
INSERT INTO `les_entreprises` VALUES (451, 'PIETRERA  LUCETTE', '52 Grande Rue\n', 53400, 'CRAON', '02-43-06-11-72', '', '02-43-06-06-09', '', '', '', 'PIETRERA', 'LUCETTE', 3, 0);
INSERT INTO `les_entreprises` VALUES (452, 'COIFFIER  JEAN-PIERRE', '17 rue St Nicolas\n', 53700, 'VILLAINES LA JUHEL', '02-43-03-20-89', '', '02-43-04-94-58', '', '', '', 'COIFFIER', 'JEAN-PIERRE', 7, 0);
INSERT INTO `les_entreprises` VALUES (453, 'LEYRAT  OLIVIER', '10 rue Neuve\n', 53400, 'CRAON', '02-43-06-13-77', '', '02-43-06-25-98', '', '', '', 'LEYRAT', 'OLIVIER', 5, 0);
INSERT INTO `les_entreprises` VALUES (454, 'BARDOU  JACQUELINE', '47 avenue de la Libération\n', 53940, 'ST BERTHEVIN', '02-43-69-01-78', '', '02-43-26-22-58', '', '', '', 'BARDOU', 'JACQUELINE', 0, 0);
INSERT INTO `les_entreprises` VALUES (455, 'BARACH  Joseph', '10, Place République\n', 49500, 'SEGRE', '02-41-92-23-08', '', '02-41-92-87-30', '', '', '', 'BARACH', 'Joseph', 4, 0);
INSERT INTO `les_entreprises` VALUES (456, 'HUGOT  Patrick', '20, PLace de l''Eglise\n', 53970, 'L''HUISSERIE', '02-43-69-61-61', '', '02-43-69-78-68', '', '', '', 'HUGOT', 'Patrick', 6, 0);
INSERT INTO `les_entreprises` VALUES (457, 'AUBRY TRUCHOT', '11 rue du Général de Gaulle\n', 53000, 'LAVAL', '02-43-53-21-37', '', '02-43-53-73-45', '', '', '', 'AUBRY TRUCHOT', '', 4, 0);
INSERT INTO `les_entreprises` VALUES (458, 'BRETON BOUTIER QUEMENEUR', '4 PLACE DE LA TREMOILLE\n', 53000, 'LAVAL', '02-43-53-54-40', '', '02-43-53-21-90', '', '', '', 'BRETON BOUTIER QUEMENEUR', '', 9, 0);
INSERT INTO `les_entreprises` VALUES (459, 'LESUEUR  SONIA', '21 rue Aristide Briand\n', 53100, 'MAYENNE', '02-43-04-10-96', '', '02-43-32-17-08', '', '', '', 'LESUEUR', 'SONIA', 4, 0);
INSERT INTO `les_entreprises` VALUES (460, 'KRETZ', '29 rue de la Paix\n', 53000, 'LAVAL', '02-43-67-08-76', '', '02-43-53-26-23', '', '', '', 'KRETZ', '', 0, 0);
INSERT INTO `les_entreprises` VALUES (461, 'POULIQUEN  BESSON BOUZIANE', '11 PLACE JEAN MOULIN\n', 53000, 'LAVAL', '02-43-53-76-92', '', '02-43-53-96-05', '', '', '', 'POULIQUEN  BESSON BOUZIANE', '', 4, 0);
INSERT INTO `les_entreprises` VALUES (462, 'BOUDAUD', 'SNC BOUDAUD\nAvenue de Lattre de Tassigny', 53000, 'LAVAL', '02-43-69-00-03', '', '02-43-66-13-58', '', '', '', 'BOUDAUD', '', 9, 0);
INSERT INTO `les_entreprises` VALUES (463, 'ORSONNEAU  Roger', '20, Avenue de Grésille\n', 49000, 'ANGERS', '02-51-37-01-96', '', '02-51-34-13-33', '', '', '', 'ORSONNEAU', 'Roger', 16, 0);
INSERT INTO `les_entreprises` VALUES (464, 'MAREY-VIGNARD', '39, Avenue Chanzy\nbp 1329', 53013, 'LAVAL CEDEX', '02-43-59-03-60', '', '02-43-53-38-60', '', '', '', 'MAREY-VIGNARD', '', 0, 0);
INSERT INTO `les_entreprises` VALUES (465, 'EUSTACHE  Thieery', '7, Place du Champ Clos\n', 22100, 'DINAN', '02-96-85-80-88', '', '02-96-85-16-93', '', '', '', 'EUSTACHE', 'Thieery', 1, 0);
INSERT INTO `les_entreprises` VALUES (466, 'GUILMAULT', 'BLD DE LAVAL\nBP 20228', 35500, 'VITRE', '02-99-75-00-53', '', '02-99-75-29-88', '', '', '', 'GUILMAULT', '', 0, 0);
INSERT INTO `les_entreprises` VALUES (467, 'LHERMELIN  Alain', 'ZA RUE DES BORDAGERS\n', 53810, 'CHANGE', '02-43-56-25-11', '', '02-43-53-95-73', '', '', '', 'LHERMELIN', 'Alain', 4, 0);
INSERT INTO `les_entreprises` VALUES (468, 'DANVEAU  THIERRY', 'LD SANS SOUCI\n', 53300, 'SAINT-FRAIMBAULT-DE-PRIERES', '02-43-00-87-21', '', '', '', '', '', 'DANVEAU', 'THIERRY', 2, 0);
INSERT INTO `les_entreprises` VALUES (469, 'WEIBEL  BERNARD', '4 route du Mans\n', 53960, 'BONCHAMP-LES-LAVAL', '02-43-90-96-53', '', '', '', '', '', 'WEIBEL', 'BERNARD', 0, 0);
INSERT INTO `les_entreprises` VALUES (470, 'FEURPRIER  Alain', '8 RUE BOSNIEUL\n', 53370, 'ST PIERRE DES NIDS', '02-43-03-50-71', '', '02-43-03-63-40', '', '', '', 'FEURPRIER', 'Alain', 0, 0);
INSERT INTO `les_entreprises` VALUES (485, 'MARGALLE  Christiane', 'ZONE DES HARAS\n', 53100, 'MAYENNE', '02-43-04-22-82', '', '', '', '', '', 'MARGALLE', 'Christiane', 0, 0);
INSERT INTO `les_entreprises` VALUES (471, 'BARADA  PATRICE', '35 AVENUE DES SABLONNIERES\nSAINT-FORT', 53200, 'CHATEAU GONTIER', '02-43-07-23-90', '', '02-43-07-99-09', '', '', '', 'BARADA', 'PATRICE', 5, 0);
INSERT INTO `les_entreprises` VALUES (472, 'PAILLARD  DIDIER', '5 route de laval\nBel orient', 53390, 'ST AIGNAN S/ROE', '02-43-06-51-35', '', '02-43-06-92-72', '', '', '', 'PAILLARD', 'DIDIER', 0, 0);
INSERT INTO `les_entreprises` VALUES (473, 'CHAPLAIN  Marcel', 'LES BOUILLONS\n', 53140, 'LA PALLU', '02-43-03-87-18', '', '02-43-03-88-52', '', '', '', 'CHAPLAIN', 'Marcel', 5, 0);
INSERT INTO `les_entreprises` VALUES (474, 'LEFEBVRE', '35 bd Clément Ader\nBP 2027', 53020, 'LAVAL CEDEX 9', '02-43-53-11-73', '', '02-43-49-20-70', '', '', '', 'LEFEBVRE', '', 13, 0);
INSERT INTO `les_entreprises` VALUES (475, 'PELE', 'ZA DES MORANDIERES\n', 53000, 'LAVAL', '02-43-59-21-59', '', '', '', '', '', 'PELE', '', 0, 0);
INSERT INTO `les_entreprises` VALUES (476, 'STASSE  Daniel', '37 RUE BELLE PLANTE\n', 53500, 'ERNEE', '02-43-05-43-05', '06-12-66-91-23', '02-43-05-49-12', '', '', '', 'STASSE', 'Daniel', 10, 0);
INSERT INTO `les_entreprises` VALUES (477, 'CLAIRAY  JOEL', '14, Rue Jean Baptiste Lafosse\nZI des Touches', 53000, 'LAVAL', '02-43-49-17-55', '', '02-43-49-02-29', '', '', '', 'CLAIRAY', 'JOEL', 41, 0);
INSERT INTO `les_entreprises` VALUES (478, 'MARCHAND', 'ZI la chalopinière\n', 53170, 'MESLAY DU MAINE', '02-43-98-41-07', '', '02-43-64-20-03', '', '', '', 'MARCHAND', '', 21, 0);
INSERT INTO `les_entreprises` VALUES (479, 'MARION', '66 Avenue de Paris\n', 53940, 'ST BERTHEVIN', '02-43-01-24-24', '', '02-43-01-24-29', '', '', '', 'MARION', '', 45, 0);
INSERT INTO `les_entreprises` VALUES (480, 'CRONIER  MICKAEL', 'ZI SUD\nIMPASSE BARBE', 53960, 'BONCHAMP-LES-LAVAL', '02-43-56-61-61', '02-43-49-14-88', '', '', '', '', 'CRONIER', 'MICKAEL', 0, 0);
INSERT INTO `les_entreprises` VALUES (481, 'ANDRADE', '33 ROUTE DE LAVAL\n', 53500, 'ERNEE', '02-43-05-14-56', '', '02-43-05-71-83', '', '', '', 'ANDRADE', '', 0, 0);
INSERT INTO `les_entreprises` VALUES (482, 'ANNE', 'ROUTE DE MAYENNE\n', 53300, 'AMBRIERES-LES-VALLEES', '02-43-04-91-04', '', '', '', '', '', 'ANNE', '', 0, 0);
INSERT INTO `les_entreprises` VALUES (483, 'BEDOUET  Yvan', '515 rue de la peyenniere\n', 53100, 'MAYENNE', '02-43-04-18-25', '', '02-43-00-74-77', 'garage.bedouet.mayenne@wanadoo.fr', '', '', 'BEDOUET', 'Yvan', 3, 0);
INSERT INTO `les_entreprises` VALUES (484, 'CIRON', 'ZAC des Morandières\nRue JB Lamarck', 53810, 'CHANGE', '02-43-59-73-00', '', '02-43-53-43-02', '', '', '', 'CIRON', '', 11, 0);
INSERT INTO `les_entreprises` VALUES (486, 'POUSSARD', '2 Place Aristide Briand\n', 35300, 'FOUGERES', '02-99-99-97-26', '', '02-99-94-28-26', '', '', '', 'POUSSARD', '', 5, 0);
INSERT INTO `les_entreprises` VALUES (487, 'CAHU  Philippe', '216 ROUTE DE COUTANCES\n', 50350, 'DONVILLE-LES-BAINS', '02-33-90-81-11', '', '', '', '', '', 'CAHU', 'Philippe', 1, 0);
INSERT INTO `les_entreprises` VALUES (488, 'COUASNON', 'Carrefour de Fontaine Daniel\nRN 12', 53100, 'SAINT-GEORGES-BUTTAVENT', '02-43-03-76-24', '', '', '', '', '', 'COUASNON', '', 0, 0);
INSERT INTO `les_entreprises` VALUES (489, 'LOUVIOT  Nathalie', '237 RUE CHARLES DE GAULLES\n', 53100, 'MAYENNE', '02-43-04-12-65', '', '', '', '', '', 'LOUVIOT', 'Nathalie', 0, 0);
INSERT INTO `les_entreprises` VALUES (490, 'PEAN  CHRISTIANE', '71, Grande Rue\n', 53150, 'MONTSURS', '02-43-01-00-94', '', '', '', '', '', 'PEAN', 'CHRISTIANE', 1, 0);
INSERT INTO `les_entreprises` VALUES (491, 'DENMAT', 'ZAC DU PARC\n', 35133, 'LECOUSSE', '02-99-94-19-49', '', '', '', '', '', 'DENMAT', '', 0, 0);
INSERT INTO `les_entreprises` VALUES (492, 'CAILLY  Jean Pierre', '3 rue de Bretagne\n', 53120, 'GORRON', '02-43-08-63-17', '', '', '', '', '', 'CAILLY', 'Jean Pierre', 3, 0);
INSERT INTO `les_entreprises` VALUES (493, 'DOUHET', '2 rue du Bignon\n', 53700, 'VILLAINES LA JUHEL', '02-43-03-21-52', '', '02-43-03-48-90', '', '', '', 'DOUHET', '', 3, 0);
INSERT INTO `les_entreprises` VALUES (494, 'LESAGE', '10 rue de Bretagne\n', 53120, 'GORRON', '02-43-08-62-18', '', '', '', '', '', 'LESAGE', '', 2, 0);
INSERT INTO `les_entreprises` VALUES (495, 'MICHEL  Moise', '7 27 Grande Rue\n', 53190, 'LANDIVY', '02-43-05-42-43', '', '', '', '', '', 'MICHEL', 'Moise', 0, 0);
INSERT INTO `les_entreprises` VALUES (496, 'HERON  JEROME', '50-52 GRANDE RUE\n', 53250, 'JAVRON-LES-CHAPELLES', '02-43-03-40-49', '', '', '', '', '', 'HERON', 'JEROME', 0, 0);
INSERT INTO `les_entreprises` VALUES (497, 'FONTAINE', '14 rue A. BRIAND\n', 53100, 'MAYENNE', '02-43-00-94-51', '', '', '', '', '', 'FONTAINE', '', 0, 0);
INSERT INTO `les_entreprises` VALUES (498, 'MASSAY', '54 avenue de Paris\n', 53500, 'ERNEE', '02-43-05-78-29', '', '02-43-05-78-29', '', '', '', 'MASSAY', '', 2, 0);
INSERT INTO `les_entreprises` VALUES (499, 'BODIN', 'Bd Maréchal Leclerc\n', 53600, 'EVRON', '02-43-01-63-26', '', '02-43-37-28-56', '', '', '', 'BODIN', '', 5, 0);
INSERT INTO `les_entreprises` VALUES (500, 'NEVEU', '15 AVENUE RENE CASSIN\nZI BELLITOURNE', 53200, 'AZE', '02-43-70-33-90', '', '02-43-07-35-72', '', '', '', 'NEVEU', '', 1, 0);
INSERT INTO `les_entreprises` VALUES (501, 'HOUDEMON', '100 ROUTE D''ERNEE\n', 35300, 'FOUGERES', '02-99-94-56-56', '', '', '', '', '', 'HOUDEMON', '', 0, 0);
INSERT INTO `les_entreprises` VALUES (502, 'BOUFFORT', '9 RUE DU MAINE\n', 53190, 'FOUGEROLLES-DU-PLESSIS', '02-43-05-58-87', '', '', '', '', '', 'BOUFFORT', '', 0, 0);
INSERT INTO `les_entreprises` VALUES (503, 'ROUSSEAU', 'ZI des nochetieres\n', 53600, 'EVRON', '02-43-01-36-74', '', '02-43-37-28-32', '', '', '', 'ROUSSEAU', '', 14, 0);
INSERT INTO `les_entreprises` VALUES (504, 'PARIS', 'LA COUR CHALMEL\n', 61600, 'MAGNY-LE-DESERT', '02-33-37-72-45', '', '02-33-37-75-65', '', '', '', 'PARIS', '', 0, 0);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_evaluations_feuilles_modalite_choix`
-- 

CREATE TABLE `les_evaluations_feuilles_modalite_choix` (
  `id_choix` bigint(20) NOT NULL default '0',
  `id_noeud` bigint(20) NOT NULL default '0',
  `evaluation_max` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_choix`,`id_noeud`),
  KEY `id_noeud` (`id_noeud`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `les_evaluations_feuilles_modalite_choix`
-- 

INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (1, 44, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (1, 45, 10);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (1, 125, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (1, 126, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (1, 127, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (1, 128, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (1, 129, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (1, 130, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (1, 131, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (1, 132, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (1, 133, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (1, 134, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (1, 135, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (1, 136, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (1, 137, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (1, 138, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (1, 139, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (1, 140, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (1, 141, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (1, 142, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (1, 143, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (1, 144, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (1, 145, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (1, 146, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (2, 44, 9);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (2, 45, 20);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (2, 125, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (2, 126, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (2, 127, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (2, 128, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (2, 129, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (2, 130, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (2, 131, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (2, 132, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (2, 133, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (2, 134, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (2, 135, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (2, 136, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (2, 137, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (2, 138, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (2, 139, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (2, 140, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (2, 141, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (2, 142, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (2, 143, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (2, 144, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (2, 145, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (2, 146, 1);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (3, 99, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (5, 118, 0);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (6, 118, 10);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (7, 44, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (7, 45, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (8, 44, 6);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (8, 45, 2);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (9, 44, 7);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (9, 45, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (10, 44, 10);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (10, 45, 2);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (11, 44, 3);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (11, 45, 7);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (12, 44, 6);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (12, 45, 2);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (13, 44, 7);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (13, 45, 5);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (14, 44, 9);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (14, 45, 4);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (15, 44, 10);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (15, 45, 10);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (16, 44, 6);
INSERT INTO `les_evaluations_feuilles_modalite_choix` VALUES (16, 45, 1);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_evaluations_feuilles_modalite_va_unique`
-- 

CREATE TABLE `les_evaluations_feuilles_modalite_va_unique` (
  `id_modalite` bigint(20) NOT NULL default '0',
  `id_noeud` bigint(20) NOT NULL default '0',
  `evaluation_max` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_modalite`,`id_noeud`),
  KEY `id_noeud` (`id_noeud`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `les_evaluations_feuilles_modalite_va_unique`
-- 

INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (8, 44, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (8, 45, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (8, 125, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (8, 126, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (8, 127, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (8, 128, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (8, 129, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (8, 130, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (8, 131, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (8, 132, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (8, 133, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (8, 134, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (8, 135, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (8, 136, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (8, 137, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (8, 138, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (8, 139, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (8, 140, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (8, 141, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (8, 142, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (8, 143, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (8, 144, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (8, 145, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (8, 146, 20);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (9, 90, 10);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (9, 91, 10);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (9, 92, 10);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (9, 93, 10);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (9, 94, 10);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (9, 95, 10);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (14, 109, 10);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (14, 110, 10);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (15, 118, 10);
INSERT INTO `les_evaluations_feuilles_modalite_va_unique` VALUES (16, 118, 20);

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

INSERT INTO `les_feuilles_declarees` VALUES (90, 4);
INSERT INTO `les_feuilles_declarees` VALUES (91, 4);
INSERT INTO `les_feuilles_declarees` VALUES (90, 5);
INSERT INTO `les_feuilles_declarees` VALUES (91, 5);
INSERT INTO `les_feuilles_declarees` VALUES (92, 5);
INSERT INTO `les_feuilles_declarees` VALUES (93, 5);
INSERT INTO `les_feuilles_declarees` VALUES (110, 5);
INSERT INTO `les_feuilles_declarees` VALUES (111, 5);
INSERT INTO `les_feuilles_declarees` VALUES (112, 5);
INSERT INTO `les_feuilles_declarees` VALUES (90, 6);
INSERT INTO `les_feuilles_declarees` VALUES (91, 6);
INSERT INTO `les_feuilles_declarees` VALUES (92, 6);
INSERT INTO `les_feuilles_declarees` VALUES (93, 6);
INSERT INTO `les_feuilles_declarees` VALUES (94, 6);
INSERT INTO `les_feuilles_declarees` VALUES (95, 6);
INSERT INTO `les_feuilles_declarees` VALUES (103, 6);
INSERT INTO `les_feuilles_declarees` VALUES (104, 6);
INSERT INTO `les_feuilles_declarees` VALUES (105, 6);
INSERT INTO `les_feuilles_declarees` VALUES (118, 7);
INSERT INTO `les_feuilles_declarees` VALUES (119, 7);
INSERT INTO `les_feuilles_declarees` VALUES (118, 8);
INSERT INTO `les_feuilles_declarees` VALUES (119, 8);
INSERT INTO `les_feuilles_declarees` VALUES (120, 8);
INSERT INTO `les_feuilles_declarees` VALUES (90, 9);
INSERT INTO `les_feuilles_declarees` VALUES (91, 9);
INSERT INTO `les_feuilles_declarees` VALUES (92, 9);
INSERT INTO `les_feuilles_declarees` VALUES (93, 9);
INSERT INTO `les_feuilles_declarees` VALUES (94, 9);
INSERT INTO `les_feuilles_declarees` VALUES (95, 9);
INSERT INTO `les_feuilles_declarees` VALUES (44, 10);
INSERT INTO `les_feuilles_declarees` VALUES (46, 10);
INSERT INTO `les_feuilles_declarees` VALUES (118, 10);
INSERT INTO `les_feuilles_declarees` VALUES (119, 10);
INSERT INTO `les_feuilles_declarees` VALUES (120, 10);
INSERT INTO `les_feuilles_declarees` VALUES (121, 10);
INSERT INTO `les_feuilles_declarees` VALUES (44, 11);
INSERT INTO `les_feuilles_declarees` VALUES (45, 11);
INSERT INTO `les_feuilles_declarees` VALUES (46, 11);
INSERT INTO `les_feuilles_declarees` VALUES (118, 11);
INSERT INTO `les_feuilles_declarees` VALUES (119, 11);
INSERT INTO `les_feuilles_declarees` VALUES (90, 12);
INSERT INTO `les_feuilles_declarees` VALUES (91, 12);
INSERT INTO `les_feuilles_declarees` VALUES (92, 12);
INSERT INTO `les_feuilles_declarees` VALUES (93, 12);
INSERT INTO `les_feuilles_declarees` VALUES (94, 12);
INSERT INTO `les_feuilles_declarees` VALUES (95, 12);
INSERT INTO `les_feuilles_declarees` VALUES (44, 14);

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
  KEY `id_dec` (`id_dec`),
  KEY `id_choix` (`id_choix`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `les_feuilles_declarees_modalite_choix`
-- 

INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (44, 10, 4, 7);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (44, 10, 4, 8);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (44, 10, 4, 9);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (44, 10, 4, 10);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (44, 10, 4, 11);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (44, 10, 4, 12);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (44, 14, 4, 7);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (44, 14, 4, 8);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (44, 14, 4, 9);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (44, 14, 4, 10);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (44, 14, 4, 11);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (44, 14, 4, 12);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (44, 14, 4, 13);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (44, 14, 4, 14);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (44, 14, 4, 15);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (46, 10, 4, 7);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (46, 10, 4, 8);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (46, 10, 4, 9);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (46, 10, 4, 10);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (46, 10, 4, 11);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (46, 10, 4, 12);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (46, 10, 4, 13);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (46, 10, 4, 14);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (46, 10, 4, 15);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (46, 10, 4, 16);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (103, 6, 2, 3);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (105, 6, 2, 3);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (118, 8, 3, 5);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (118, 10, 3, 5);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (119, 8, 3, 6);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (119, 10, 3, 5);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (120, 8, 3, 5);
INSERT INTO `les_feuilles_declarees_modalite_choix` VALUES (120, 10, 3, 5);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_feuilles_declarees_modalite_va_unique`
-- 

CREATE TABLE `les_feuilles_declarees_modalite_va_unique` (
  `id_noeud` bigint(20) NOT NULL default '0',
  `id_dec` bigint(20) NOT NULL default '0',
  `id_modalite` bigint(20) NOT NULL default '0',
  `evaluation` text NOT NULL,
  PRIMARY KEY  (`id_noeud`,`id_dec`,`id_modalite`),
  KEY `id_dec` (`id_dec`),
  KEY `id_modalite` (`id_modalite`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `les_feuilles_declarees_modalite_va_unique`
-- 

INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (90, 4, 9, '10');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (90, 4, 10, 'salut');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (90, 4, 17, 'sdfsdfsf');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (90, 5, 9, '10');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (90, 5, 10, 'coucou');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (90, 5, 17, 'xwcw');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (90, 6, 10, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (90, 6, 17, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (90, 9, 9, '3');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (90, 12, 9, '10');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (90, 12, 10, 'bien');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (90, 12, 17, 'sdf');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (91, 4, 9, '3');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (91, 4, 10, 'bonjour');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (91, 4, 17, 'zerzerz zerzerz');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (91, 5, 9, '4');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (91, 5, 10, 'dd');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (91, 5, 17, 'wcx');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (91, 6, 10, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (91, 6, 17, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (91, 9, 9, '4');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (91, 12, 9, '2');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (91, 12, 10, 'pas bien');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (91, 12, 17, 'sdf');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (92, 5, 9, '2');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (92, 5, 10, 'wcx');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (92, 5, 17, 'wcx');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (92, 6, 10, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (92, 6, 17, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (92, 9, 9, '2');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (92, 12, 9, '8');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (92, 12, 10, 'ff');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (92, 12, 17, 'sdf');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (93, 5, 9, '10');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (93, 5, 10, 'wxc');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (93, 5, 17, 'wxc');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (93, 6, 10, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (93, 6, 17, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (93, 9, 9, '10');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (93, 12, 9, '9');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (93, 12, 10, 'sdf');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (93, 12, 17, 'sdf');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (94, 6, 10, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (94, 6, 17, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (94, 9, 9, '14');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (94, 12, 9, '4');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (94, 12, 10, 'sdf');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (94, 12, 17, 'sdf');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (95, 6, 10, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (95, 6, 17, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (95, 9, 9, '5');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (95, 12, 9, '96');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (95, 12, 10, 'sdf');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (95, 12, 17, 'sdf');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (110, 5, 14, '1');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (111, 5, 14, '20');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (112, 5, 14, '10');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (118, 7, 15, '10');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (118, 8, 15, '3');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (118, 8, 16, '11');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (118, 10, 15, '10');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (118, 10, 16, '6');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (118, 11, 15, '7');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (119, 7, 15, '5');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (119, 8, 15, '0');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (119, 8, 16, '12');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (119, 10, 15, '5');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (119, 10, 16, '2');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (119, 11, 15, '1');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (120, 8, 15, '5');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (120, 8, 16, '14');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (120, 10, 15, '5');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (120, 10, 16, '14');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (121, 10, 15, '');
INSERT INTO `les_feuilles_declarees_modalite_va_unique` VALUES (121, 10, 16, '');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

-- 
-- Contenu de la table `les_formations`
-- 

INSERT INTO `les_formations` VALUES (16, 'Métal alu verre', 4, 'Métal_alu_verre_référentiel_et_programme_.doc', '', '', '2006-05-22', 20896, 4);

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

INSERT INTO `les_maitres_apprentissage` VALUES (20897, 11);
INSERT INTO `les_maitres_apprentissage` VALUES (20900, 12);
INSERT INTO `les_maitres_apprentissage` VALUES (20902, 13);
INSERT INTO `les_maitres_apprentissage` VALUES (20904, 14);
INSERT INTO `les_maitres_apprentissage` VALUES (20906, 15);
INSERT INTO `les_maitres_apprentissage` VALUES (20908, 16);
INSERT INTO `les_maitres_apprentissage` VALUES (20910, 17);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_messages`
-- 

CREATE TABLE `les_messages` (
  `id_msg` bigint(20) NOT NULL auto_increment,
  `objet` tinytext NOT NULL,
  `message` text NOT NULL,
  `date_creation` timestamp NOT NULL default '0000-00-00 00:00:00',
  `date_expiration` date NOT NULL default '0000-00-00',
  `id_usager` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_msg`),
  KEY `id_usager` (`id_usager`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=74 ;

-- 
-- Contenu de la table `les_messages`
-- 

INSERT INTO `les_messages` VALUES (11, 'bonjour', 'sds', '2006-06-22 15:37:18', '0000-00-00', 20896);
INSERT INTO `les_messages` VALUES (13, 'Vous avez été ajouté à l''espace : zeze', 'Vous avez été ajouté à l''espace : zeze.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', '2006-06-26 09:04:13', '0000-00-00', 20896);
INSERT INTO `les_messages` VALUES (14, 'Vous avez été ajouté à l''espace : aa', 'Vous avez été ajouté à l''espace : aa.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', '2006-06-27 18:39:56', '0000-00-00', 20867);
INSERT INTO `les_messages` VALUES (15, 'Vous avez été ajouté à l''espace : dqdqsd', 'Vous avez été ajouté à l''espace : dqdqsd.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', '2006-06-27 18:43:49', '0000-00-00', 20867);
INSERT INTO `les_messages` VALUES (16, 'Nouveauté sur l''espace : dqdqsd', 'Du nouveau contenu à été ajouté à l''espace : dqdqsd', '2006-06-27 18:43:57', '0000-00-00', 20867);
INSERT INTO `les_messages` VALUES (17, 'Nouveauté sur l''espace : dqdqsd', 'Du nouveau contenu à été ajouté à l''espace : dqdqsd', '2006-06-27 18:44:23', '0000-00-00', 20867);
INSERT INTO `les_messages` VALUES (18, 'Nouveauté sur l''espace : dqdqsd', 'Du nouveau contenu à été ajouté à l''espace : dqdqsd', '2006-06-27 18:47:34', '0000-00-00', 20896);
INSERT INTO `les_messages` VALUES (19, 'Vous avez été ajouté à l''espace : azeaze', 'Vous avez été ajouté à l''espace : azeaze.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', '2006-06-28 13:40:02', '0000-00-00', 20897);
INSERT INTO `les_messages` VALUES (20, 'Vous avez été ajouté à l''espace : sdffsdfsd', 'Vous avez été ajouté à l''espace : sdffsdfsd.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', '2006-06-28 13:43:46', '0000-00-00', 20897);
INSERT INTO `les_messages` VALUES (21, 'Vous avez été ajouté à l''espace : sdsd', 'Vous avez été ajouté à l''espace : sdsd.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', '2006-06-28 14:21:23', '0000-00-00', 20897);
INSERT INTO `les_messages` VALUES (22, 'Vous avez été ajouté à l''espace : sdqsd', 'Vous avez été ajouté à l''espace : sdqsd.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', '2006-06-28 14:21:35', '0000-00-00', 20897);
INSERT INTO `les_messages` VALUES (23, 'Vous avez été ajouté à l''espace : vxv', 'Vous avez été ajouté à l''espace : vxv.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', '2006-06-28 14:22:12', '0000-00-00', 20897);
INSERT INTO `les_messages` VALUES (24, 'Vous avez été ajouté à l''espace : xcvx', 'Vous avez été ajouté à l''espace : xcvx.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', '2006-06-28 14:22:21', '0000-00-00', 20897);
INSERT INTO `les_messages` VALUES (25, 'Vous avez été ajouté à l''espace : bcv', 'Vous avez été ajouté à l''espace : bcv.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', '2006-06-28 14:23:12', '0000-00-00', 20897);
INSERT INTO `les_messages` VALUES (26, 'Vous avez été ajouté à l''espace : vbcxvbc', 'Vous avez été ajouté à l''espace : vbcxvbc.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', '2006-06-28 14:23:18', '0000-00-00', 20897);
INSERT INTO `les_messages` VALUES (27, 'Vous avez été ajouté à l''espace : cvbcvb', 'Vous avez été ajouté à l''espace : cvbcvb.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', '2006-06-28 14:23:23', '0000-00-00', 20897);
INSERT INTO `les_messages` VALUES (28, 'Vous avez été ajouté à l''espace : cbcbv', 'Vous avez été ajouté à l''espace : cbcbv.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', '2006-06-28 14:23:29', '0000-00-00', 20897);
INSERT INTO `les_messages` VALUES (29, 'Vous avez été ajouté à l''espace : cvb', 'Vous avez été ajouté à l''espace : cvb.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', '2006-06-28 14:23:39', '0000-00-00', 20897);
INSERT INTO `les_messages` VALUES (30, 'Vous avez été ajouté à l''espace : cvb', 'Vous avez été ajouté à l''espace : cvb.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', '2006-06-28 14:23:46', '0000-00-00', 20897);
INSERT INTO `les_messages` VALUES (31, 'Vous avez été ajouté à l''espace : dd', 'Vous avez été ajouté à l''espace : dd.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', '2006-06-28 16:03:57', '0000-00-00', 20867);
INSERT INTO `les_messages` VALUES (32, 'Nouveauté sur l''espace : dd', 'Du nouveau contenu à été ajouté à l''espace : dd', '2006-06-28 16:04:00', '0000-00-00', 20867);
INSERT INTO `les_messages` VALUES (33, 'Espace aa supprimé', 'L''espace aa a été supprimé.\n\r\n					Contacter le créateur de l''espace pour de plus amples informations.', '2006-06-28 16:04:13', '0000-00-00', 20867);
INSERT INTO `les_messages` VALUES (34, 'Espace dd supprimé', 'L''espace dd a été supprimé.\n\r\n					Contacter le créateur de l''espace pour de plus amples informations.', '2006-06-28 16:04:15', '0000-00-00', 20867);
INSERT INTO `les_messages` VALUES (35, 'Espace dqdqsd supprimé', 'L''espace dqdqsd a été supprimé.\n\r\n					Contacter le créateur de l''espace pour de plus amples informations.', '2006-06-28 16:04:16', '0000-00-00', 20867);
INSERT INTO `les_messages` VALUES (36, 'Vous avez été ajouté à l''espace : dd', 'Vous avez été ajouté à l''espace : dd.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', '2006-06-28 16:04:37', '0000-00-00', 20867);
INSERT INTO `les_messages` VALUES (37, 'Espace dd supprimé', 'L''espace dd a été supprimé.\n\r\n					Contacter le créateur de l''espace pour de plus amples informations.', '2006-06-28 16:04:45', '0000-00-00', 20867);
INSERT INTO `les_messages` VALUES (38, 'Vous avez été ajouté à l''espace : dd', 'Vous avez été ajouté à l''espace : dd.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', '2006-06-28 16:04:49', '0000-00-00', 20867);
INSERT INTO `les_messages` VALUES (39, 'Nouveauté sur l''espace : dd', 'Du nouveau contenu à été ajouté à l''espace : dd', '2006-06-28 16:04:52', '0000-00-00', 20867);
INSERT INTO `les_messages` VALUES (40, 'Espace dd supprimé', 'L''espace dd a été supprimé.\n\r\n					Contacter le créateur de l''espace pour de plus amples informations.', '2006-06-28 16:05:10', '0000-00-00', 20867);
INSERT INTO `les_messages` VALUES (41, 'Vous avez été ajouté à l''espace : ssdfqsf', 'Vous avez été ajouté à l''espace : ssdfqsf.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', '2006-06-28 16:05:52', '0000-00-00', 20867);
INSERT INTO `les_messages` VALUES (42, 'sdf', 'sdf', '2006-06-29 10:53:38', '0000-00-00', 1116);
INSERT INTO `les_messages` VALUES (43, 'cwx', 'xcxc', '2006-06-29 16:57:41', '0000-00-00', 1116);
INSERT INTO `les_messages` VALUES (44, 'Vous avez été ajouté à l''espace : sqdqsdqsd', 'Vous avez été ajouté à l''espace : sqdqsdqsd.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', '2006-06-29 19:29:47', '0000-00-00', 20897);
INSERT INTO `les_messages` VALUES (45, 'Nouveauté sur l''espace : sqdqsdqsd', 'Du nouveau contenu à été ajouté à l''espace : sqdqsdqsd', '2006-06-29 19:29:52', '0000-00-00', 20897);
INSERT INTO `les_messages` VALUES (46, 'Espace sqdqsdqsd supprimé', 'L''espace sqdqsdqsd a été supprimé.\n\r\n					Contacter le créateur de l''espace pour de plus amples informations.', '2006-06-29 19:30:20', '0000-00-00', 20897);
INSERT INTO `les_messages` VALUES (47, 'Espace cvbcvb supprimé', 'L''espace cvbcvb a été supprimé.\n\r\n					Contacter le créateur de l''espace pour de plus amples informations.', '2006-06-29 19:30:23', '0000-00-00', 20897);
INSERT INTO `les_messages` VALUES (48, 'Vous avez été ajouté à l''espace : vxv', 'Vous avez été ajouté à l''espace : vxv.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', '2006-06-29 19:30:26', '0000-00-00', 20897);
INSERT INTO `les_messages` VALUES (49, 'Vous avez été supprimé de l''espace : vxv', 'Vous avez été supprimé de l''espace : vxv.\n\r\n					Contacter le créateur de l''espace pour de plus amples informations.', '2006-06-29 19:30:26', '0000-00-00', 20897);
INSERT INTO `les_messages` VALUES (50, 'Vous avez été ajouté à l''espace : vbcxvbc', 'Vous avez été ajouté à l''espace : vbcxvbc.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', '2006-06-29 19:30:51', '0000-00-00', 20897);
INSERT INTO `les_messages` VALUES (51, 'Vous avez été supprimé de l''espace : vbcxvbc', 'Vous avez été supprimé de l''espace : vbcxvbc.\n\r\n					Contacter le créateur de l''espace pour de plus amples informations.', '2006-06-29 19:30:51', '0000-00-00', 20897);
INSERT INTO `les_messages` VALUES (52, 'Vous avez été ajouté à l''espace : zeze', 'Vous avez été ajouté à l''espace : zeze.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', '2006-06-29 19:31:55', '0000-00-00', 20896);
INSERT INTO `les_messages` VALUES (53, 'Vous avez été supprimé de l''espace : zeze', 'Vous avez été supprimé de l''espace : zeze.\n\r\n					Contacter le créateur de l''espace pour de plus amples informations.', '2006-06-29 19:31:55', '0000-00-00', 20896);
INSERT INTO `les_messages` VALUES (54, 'Vous avez été ajouté à l''espace : vxv', 'Vous avez été ajouté à l''espace : vxv.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', '2006-06-29 19:32:15', '0000-00-00', 20897);
INSERT INTO `les_messages` VALUES (55, 'Vous avez été supprimé de l''espace : vxv', 'Vous avez été supprimé de l''espace : vxv.\n\r\n					Contacter le créateur de l''espace pour de plus amples informations.', '2006-06-29 19:32:15', '0000-00-00', 20897);
INSERT INTO `les_messages` VALUES (56, 'Vous avez été ajouté à l''espace : vxv', 'Vous avez été ajouté à l''espace : vxv.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', '2006-06-29 19:33:05', '0000-00-00', 20897);
INSERT INTO `les_messages` VALUES (57, 'Vous avez été supprimé de l''espace : vxv', 'Vous avez été supprimé de l''espace : vxv.\n\r\n					Contacter le créateur de l''espace pour de plus amples informations.', '2006-06-29 19:33:05', '0000-00-00', 20897);
INSERT INTO `les_messages` VALUES (58, 'Vous avez été ajouté à l''espace : vxv', 'Vous avez été ajouté à l''espace : vxv.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', '2006-06-29 19:33:19', '0000-00-00', 20897);
INSERT INTO `les_messages` VALUES (59, 'Vous avez été supprimé de l''espace : vxv', 'Vous avez été supprimé de l''espace : vxv.\n\r\n					Contacter le créateur de l''espace pour de plus amples informations.', '2006-06-29 19:33:19', '0000-00-00', 20897);
INSERT INTO `les_messages` VALUES (60, 'Vous avez été ajouté à l''espace : vxv', 'Vous avez été ajouté à l''espace : vxv.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', '2006-06-29 19:36:25', '0000-00-00', 20897);
INSERT INTO `les_messages` VALUES (61, 'Vous avez été supprimé de l''espace : vxv', 'Vous avez été supprimé de l''espace : vxv.\n\r\n					Contacter le créateur de l''espace pour de plus amples informations.', '2006-06-29 19:36:25', '0000-00-00', 20897);
INSERT INTO `les_messages` VALUES (62, 'Vous avez été ajouté à l''espace : vbcxvbc', 'Vous avez été ajouté à l''espace : vbcxvbc.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', '2006-06-29 19:36:45', '0000-00-00', 20897);
INSERT INTO `les_messages` VALUES (63, 'Vous avez été supprimé de l''espace : vbcxvbc', 'Vous avez été supprimé de l''espace : vbcxvbc.\n\r\n					Contacter le créateur de l''espace pour de plus amples informations.', '2006-06-29 19:36:45', '0000-00-00', 20897);
INSERT INTO `les_messages` VALUES (65, 'Vous avez été supprimé de l''espace : ssdfqsf', 'Vous avez été supprimé de l''espace : ssdfqsf.\n\r\n					Contacter le créateur de l''espace pour de plus amples informations.', '2006-06-29 19:54:33', '0000-00-00', 20867);
INSERT INTO `les_messages` VALUES (66, 'Vous avez été ajouté à l''espace : fsdsdf', 'Vous avez été ajouté à l''espace : fsdsdf.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', '2006-06-29 19:54:40', '0000-00-00', 20867);
INSERT INTO `les_messages` VALUES (67, 'Vous avez été ajouté à l''espace : fsdsdf', 'Vous avez été ajouté à l''espace : fsdsdf.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', '2006-06-29 19:55:00', '0000-00-00', 20867);
INSERT INTO `les_messages` VALUES (68, 'Vous avez été supprimé de l''espace : fsdsdf', 'Vous avez été supprimé de l''espace : fsdsdf.\n\r\n					Contacter le créateur de l''espace pour de plus amples informations.', '2006-06-29 19:55:00', '0000-00-00', 20867);
INSERT INTO `les_messages` VALUES (69, 'Vous avez été ajouté à l''espace : ssdfqsf', 'Vous avez été ajouté à l''espace : ssdfqsf.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', '2006-06-29 19:55:09', '0000-00-00', 20867);
INSERT INTO `les_messages` VALUES (70, 'Vous avez été ajouté à l''espace : vxv', 'Vous avez été ajouté à l''espace : vxv.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', '2006-06-30 15:28:12', '0000-00-00', 20897);
INSERT INTO `les_messages` VALUES (71, 'Vous avez été supprimé de l''espace : vxv', 'Vous avez été supprimé de l''espace : vxv.\n\r\n					Contacter le créateur de l''espace pour de plus amples informations.', '2006-06-30 15:28:12', '0000-00-00', 20897);
INSERT INTO `les_messages` VALUES (72, 'Vous avez été ajouté à l''espace : vxv', 'Vous avez été ajouté à l''espace : vxv.\n\r\n					Consultez la rubrique Espace de Partage pour prendre connaissance du contenu de cet espace.', '2006-06-30 15:28:50', '0000-00-00', 20897);
INSERT INTO `les_messages` VALUES (73, 'Vous avez été supprimé de l''espace : vxv', 'Vous avez été supprimé de l''espace : vxv.\n\r\n					Contacter le créateur de l''espace pour de plus amples informations.', '2006-06-30 15:28:50', '0000-00-00', 20897);

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

INSERT INTO `les_messages_recus_usagers` VALUES (11, 20867, 'OUI', 'OUI');
INSERT INTO `les_messages_recus_usagers` VALUES (15, 20899, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (16, 20899, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (17, 20899, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (18, 20867, 'OUI', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (18, 20899, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (23, 20899, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (26, 20896, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (27, 20899, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (31, 20896, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (31, 20899, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (32, 20896, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (32, 20899, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (33, 20896, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (33, 20899, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (34, 20896, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (34, 20899, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (35, 20896, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (35, 20899, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (36, 20896, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (36, 20899, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (37, 20896, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (37, 20899, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (38, 20896, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (39, 20896, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (40, 20896, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (41, 20896, 'OUI', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (41, 20899, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (42, 1116, 'OUI', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (43, 20867, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (43, 20871, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (43, 20874, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (43, 20877, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (43, 20880, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (43, 20883, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (43, 20886, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (43, 20889, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (43, 20891, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (43, 20893, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (43, 20915, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (44, 20867, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (44, 20871, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (44, 20896, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (44, 20899, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (45, 20867, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (45, 20871, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (45, 20896, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (45, 20899, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (46, 20867, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (46, 20871, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (46, 20896, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (46, 20899, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (47, 20899, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (52, 20867, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (52, 20871, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (52, 20899, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (56, 20896, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (59, 20896, 'OUI', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (59, 20899, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (60, 20896, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (60, 20899, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (66, 20896, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (66, 20899, 'NON', 'NON');
INSERT INTO `les_messages_recus_usagers` VALUES (68, 20896, 'OUI', 'NON');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Contenu de la table `les_modalites_reponse_choix`
-- 

INSERT INTO `les_modalites_reponse_choix` VALUES (2, 'Observation de tuteur', 'tuteur_cfa', 'cfa', 'unique', 1);
INSERT INTO `les_modalites_reponse_choix` VALUES (3, 'Observation du tuteur', 'tuteur_cfa', 'entr', 'unique', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Contenu de la table `les_modalites_reponse_libre`
-- 

INSERT INTO `les_modalites_reponse_libre` VALUES (1, 'Appréciation', 'app', 'entr', 1);
INSERT INTO `les_modalites_reponse_libre` VALUES (2, 'Appréciation apprenti', 'app', 'cfa', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Contenu de la table `les_modalites_va_multiple`
-- 

INSERT INTO `les_modalites_va_multiple` VALUES (1, 'Acquisition de la tâche', 'unique', 'ma', 7);
INSERT INTO `les_modalites_va_multiple` VALUES (2, 'Progression', 'multiple', 'app', 14);
INSERT INTO `les_modalites_va_multiple` VALUES (3, 'Réalisation', 'unique', 'app', 15);
INSERT INTO `les_modalites_va_multiple` VALUES (4, 'Compétence développées', 'multiple', 'app', 7);

-- --------------------------------------------------------

-- 
-- Structure de la table `les_modalites_va_unique`
-- 

CREATE TABLE `les_modalites_va_unique` (
  `id_modalite` bigint(20) NOT NULL auto_increment,
  `libelle` varchar(250) NOT NULL default '',
  `acteur` varchar(40) NOT NULL default '',
  `type_reponse` varchar(10) NOT NULL default 'texte',
  `id_arbre` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_modalite`),
  KEY `id_arbre` (`id_arbre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

-- 
-- Contenu de la table `les_modalites_va_unique`
-- 

INSERT INTO `les_modalites_va_unique` VALUES (8, 'Evaluation', 'ma', 'note', 7);
INSERT INTO `les_modalites_va_unique` VALUES (9, 'Note obtenue', 'app', 'note', 13);
INSERT INTO `les_modalites_va_unique` VALUES (10, 'Appréciation', 'app', 'texte', 13);
INSERT INTO `les_modalites_va_unique` VALUES (14, 'Fréquence', 'app', 'frequence', 11);
INSERT INTO `les_modalites_va_unique` VALUES (15, 'Fréquence', 'app', 'frequence', 15);
INSERT INTO `les_modalites_va_unique` VALUES (16, 'Note', 'app', 'note', 15);
INSERT INTO `les_modalites_va_unique` VALUES (17, 'avis de l''enseignant', 'ens', 'texte', 13);

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

INSERT INTO `les_niveaux_arbre` VALUES (1, 'Activité', 7);
INSERT INTO `les_niveaux_arbre` VALUES (2, 'Tâche', 7);
INSERT INTO `les_niveaux_arbre` VALUES (1, 'qsdq', 8);
INSERT INTO `les_niveaux_arbre` VALUES (2, 'qdsqds', 8);
INSERT INTO `les_niveaux_arbre` VALUES (1, 'Activité', 11);
INSERT INTO `les_niveaux_arbre` VALUES (2, 'Tâche', 11);
INSERT INTO `les_niveaux_arbre` VALUES (1, 'Catégorie', 13);
INSERT INTO `les_niveaux_arbre` VALUES (2, 'matière', 13);
INSERT INTO `les_niveaux_arbre` VALUES (1, 'Theme', 14);
INSERT INTO `les_niveaux_arbre` VALUES (2, 'chapitre', 14);
INSERT INTO `les_niveaux_arbre` VALUES (1, 'Capacité', 15);
INSERT INTO `les_niveaux_arbre` VALUES (2, 'compétence', 15);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=148 ;

-- 
-- Contenu de la table `les_noeuds`
-- 

INSERT INTO `les_noeuds` VALUES (38, 'sdqd', 'branche', 0, 7);
INSERT INTO `les_noeuds` VALUES (39, 'cbb', 'branche', 0, 7);
INSERT INTO `les_noeuds` VALUES (41, 'cbbc', 'branche', 0, 7);
INSERT INTO `les_noeuds` VALUES (42, 'cvbcb', 'branche', 0, 7);
INSERT INTO `les_noeuds` VALUES (44, 'xvxcv', 'feuille', 38, 7);
INSERT INTO `les_noeuds` VALUES (45, 'xcvxcv', 'feuille', 38, 7);
INSERT INTO `les_noeuds` VALUES (46, 'xcvwxv', 'feuille', 38, 7);
INSERT INTO `les_noeuds` VALUES (47, 'xcvxcv', 'feuille', 38, 7);
INSERT INTO `les_noeuds` VALUES (48, 'xvxv', 'feuille', 38, 7);
INSERT INTO `les_noeuds` VALUES (49, 'a', 'feuille', 39, 7);
INSERT INTO `les_noeuds` VALUES (50, 'aa', 'feuille', 39, 7);
INSERT INTO `les_noeuds` VALUES (51, 'aaa', 'feuille', 39, 7);
INSERT INTO `les_noeuds` VALUES (52, 'aaaa', 'feuille', 39, 7);
INSERT INTO `les_noeuds` VALUES (53, 'aaaaa', 'feuille', 39, 7);
INSERT INTO `les_noeuds` VALUES (54, 'aaaaaa', 'feuille', 39, 7);
INSERT INTO `les_noeuds` VALUES (55, 'aaaaaaa', 'feuille', 39, 7);
INSERT INTO `les_noeuds` VALUES (56, 'aaaaaa', 'feuille', 39, 7);
INSERT INTO `les_noeuds` VALUES (57, 'aaaaa', 'feuille', 39, 7);
INSERT INTO `les_noeuds` VALUES (58, 'aaaa', 'feuille', 39, 7);
INSERT INTO `les_noeuds` VALUES (59, 'aaa', 'feuille', 39, 7);
INSERT INTO `les_noeuds` VALUES (60, 'aa', 'feuille', 39, 7);
INSERT INTO `les_noeuds` VALUES (61, 'a', 'feuille', 39, 7);
INSERT INTO `les_noeuds` VALUES (88, 'Générale', 'branche', 0, 13);
INSERT INTO `les_noeuds` VALUES (89, 'Professionnele', 'branche', 0, 13);
INSERT INTO `les_noeuds` VALUES (90, 'matière 1', 'feuille', 88, 13);
INSERT INTO `les_noeuds` VALUES (91, 'matière 2', 'feuille', 88, 13);
INSERT INTO `les_noeuds` VALUES (92, 'Matière 3', 'feuille', 88, 13);
INSERT INTO `les_noeuds` VALUES (93, 'Matière 4', 'feuille', 88, 13);
INSERT INTO `les_noeuds` VALUES (94, 'Matière 5', 'feuille', 89, 13);
INSERT INTO `les_noeuds` VALUES (95, 'Matière 6', 'feuille', 89, 13);
INSERT INTO `les_noeuds` VALUES (96, 'theme1', 'branche', 0, 14);
INSERT INTO `les_noeuds` VALUES (97, 'theme2', 'branche', 0, 14);
INSERT INTO `les_noeuds` VALUES (98, 'theme3', 'branche', 0, 14);
INSERT INTO `les_noeuds` VALUES (99, 'chapitre1', 'feuille', 96, 14);
INSERT INTO `les_noeuds` VALUES (100, 'chapitre 2', 'feuille', 96, 14);
INSERT INTO `les_noeuds` VALUES (101, 'chapitre 3', 'feuille', 96, 14);
INSERT INTO `les_noeuds` VALUES (102, 'chapitre 4', 'feuille', 96, 14);
INSERT INTO `les_noeuds` VALUES (103, 'chapitre 5', 'feuille', 96, 14);
INSERT INTO `les_noeuds` VALUES (104, 'chapitre1', 'feuille', 97, 14);
INSERT INTO `les_noeuds` VALUES (105, 'chapitre 2', 'feuille', 97, 14);
INSERT INTO `les_noeuds` VALUES (106, 'chapitre 3', 'feuille', 97, 14);
INSERT INTO `les_noeuds` VALUES (107, 'activité 1', 'branche', 0, 11);
INSERT INTO `les_noeuds` VALUES (108, 'activité2', 'branche', 0, 11);
INSERT INTO `les_noeuds` VALUES (109, 'tâche 1', 'feuille', 107, 11);
INSERT INTO `les_noeuds` VALUES (110, 'tache2', 'feuille', 107, 11);
INSERT INTO `les_noeuds` VALUES (111, 'tache3', 'feuille', 107, 11);
INSERT INTO `les_noeuds` VALUES (112, 'tache4', 'feuille', 108, 11);
INSERT INTO `les_noeuds` VALUES (113, 'tache5', 'feuille', 108, 11);
INSERT INTO `les_noeuds` VALUES (114, 'tache6', 'feuille', 108, 11);
INSERT INTO `les_noeuds` VALUES (115, 'c1', 'branche', 0, 15);
INSERT INTO `les_noeuds` VALUES (116, 'c2', 'branche', 0, 15);
INSERT INTO `les_noeuds` VALUES (117, 'c3', 'branche', 0, 15);
INSERT INTO `les_noeuds` VALUES (118, 'cc1', 'feuille', 115, 15);
INSERT INTO `les_noeuds` VALUES (119, 'cc2', 'feuille', 115, 15);
INSERT INTO `les_noeuds` VALUES (120, 'cc3', 'feuille', 115, 15);
INSERT INTO `les_noeuds` VALUES (121, 'cc3', 'feuille', 116, 15);
INSERT INTO `les_noeuds` VALUES (122, 'aa', 'branche', 0, 7);
INSERT INTO `les_noeuds` VALUES (125, 'fsdfsdf', 'feuille', 122, 7);
INSERT INTO `les_noeuds` VALUES (126, 'sdfsdfsf', 'feuille', 122, 7);
INSERT INTO `les_noeuds` VALUES (127, 'sdfsdf', 'feuille', 122, 7);
INSERT INTO `les_noeuds` VALUES (128, 'sdfsdf', 'feuille', 122, 7);
INSERT INTO `les_noeuds` VALUES (129, 'dsdg', 'feuille', 41, 7);
INSERT INTO `les_noeuds` VALUES (130, 'dfgdfg', 'feuille', 41, 7);
INSERT INTO `les_noeuds` VALUES (131, 'dfgdfg', 'feuille', 41, 7);
INSERT INTO `les_noeuds` VALUES (132, 'dfgdfg', 'feuille', 41, 7);
INSERT INTO `les_noeuds` VALUES (133, 'dgdfg', 'feuille', 41, 7);
INSERT INTO `les_noeuds` VALUES (134, 'dfgdfg', 'feuille', 41, 7);
INSERT INTO `les_noeuds` VALUES (135, 'dgdfg', 'feuille', 41, 7);
INSERT INTO `les_noeuds` VALUES (136, 'dfgdg', 'feuille', 41, 7);
INSERT INTO `les_noeuds` VALUES (137, 'dfgdfg', 'feuille', 41, 7);
INSERT INTO `les_noeuds` VALUES (138, 'dgdfg', 'feuille', 41, 7);
INSERT INTO `les_noeuds` VALUES (139, 'dfgdfg', 'feuille', 41, 7);
INSERT INTO `les_noeuds` VALUES (140, 'dfdfg', 'feuille', 41, 7);
INSERT INTO `les_noeuds` VALUES (141, 'gdfg', 'feuille', 42, 7);
INSERT INTO `les_noeuds` VALUES (142, 'dfgdsfg', 'feuille', 42, 7);
INSERT INTO `les_noeuds` VALUES (143, 'dfgdfg', 'feuille', 42, 7);
INSERT INTO `les_noeuds` VALUES (144, 'dfgdfg', 'feuille', 42, 7);
INSERT INTO `les_noeuds` VALUES (145, 'dfgdfg', 'feuille', 42, 7);
INSERT INTO `les_noeuds` VALUES (146, 'dfgdfg', 'feuille', 42, 7);
INSERT INTO `les_noeuds` VALUES (147, 'qsdqsd', 'feuille', 38, 7);

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

INSERT INTO `les_options` VALUES ('LEA_LOGO_CFA', 'LEA_LOGO_CFA.gif');
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
  `id_for` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_periode`),
  KEY `id_cla` (`id_for`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- Contenu de la table `les_periodes`
-- 

INSERT INTO `les_periodes` VALUES (1, 'bilan 1er trimestre', 4, 16);
INSERT INTO `les_periodes` VALUES (2, 'Déclaration mois septembre', 1, 16);
INSERT INTO `les_periodes` VALUES (3, 'Déclaration:  mois octobre', 2, 16);
INSERT INTO `les_periodes` VALUES (4, 'déclaration mois novembre', 3, 16);
INSERT INTO `les_periodes` VALUES (5, 'déclaration mois de janvier', 5, 16);
INSERT INTO `les_periodes` VALUES (6, 'periode 6', 6, 16);

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

INSERT INTO `les_periodes_classes` VALUES (1, 19, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00');
INSERT INTO `les_periodes_classes` VALUES (5, 19, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00');
INSERT INTO `les_periodes_classes` VALUES (6, 19, '2005-01-01', '2100-01-01', '2005-01-01', '2100-01-01');

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

INSERT INTO `les_periodes_modalite_reponse_choix` VALUES (3, 2);
INSERT INTO `les_periodes_modalite_reponse_choix` VALUES (1, 3);

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

INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (1, 1);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (2, 1);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (3, 1);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (4, 1);
INSERT INTO `les_periodes_modalite_reponse_libre` VALUES (2, 2);

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

INSERT INTO `les_periodes_modalite_va_multiple` VALUES (1, 1);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (2, 1);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (3, 1);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (4, 1);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (5, 1);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (6, 1);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (1, 2);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (1, 3);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (2, 3);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (3, 3);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (4, 3);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (1, 4);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (2, 4);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (3, 4);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (4, 4);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (5, 4);
INSERT INTO `les_periodes_modalite_va_multiple` VALUES (6, 4);

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

INSERT INTO `les_periodes_modalite_va_unique` VALUES (1, 8);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (2, 8);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (3, 8);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (4, 8);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (5, 8);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (6, 8);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (2, 9);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (3, 9);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (4, 9);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (1, 10);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (2, 10);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (3, 10);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (2, 14);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (3, 14);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (1, 15);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (2, 15);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (3, 15);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (4, 15);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (1, 16);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (2, 16);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (3, 16);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (4, 16);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (1, 17);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (2, 17);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (3, 17);
INSERT INTO `les_periodes_modalite_va_unique` VALUES (4, 17);

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

INSERT INTO `les_representants_legaux` VALUES (20895, '', '');
INSERT INTO `les_representants_legaux` VALUES (20898, '', '');
INSERT INTO `les_representants_legaux` VALUES (20901, '', '');
INSERT INTO `les_representants_legaux` VALUES (20903, '', '');
INSERT INTO `les_representants_legaux` VALUES (20905, '', '');
INSERT INTO `les_representants_legaux` VALUES (20907, '', '');
INSERT INTO `les_representants_legaux` VALUES (20909, '', '');
INSERT INTO `les_representants_legaux` VALUES (20911, '', '');
INSERT INTO `les_representants_legaux` VALUES (20912, '', '');
INSERT INTO `les_representants_legaux` VALUES (20913, '', '');

-- --------------------------------------------------------

-- 
-- Structure de la table `les_responsables_unites_pedagogiques`
-- 

CREATE TABLE `les_responsables_unites_pedagogiques` (
  `id_rvs` bigint(20) NOT NULL default '0',
  `id_unite` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_rvs`,`id_unite`),
  KEY `id_unite` (`id_unite`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `les_responsables_unites_pedagogiques`
-- 

INSERT INTO `les_responsables_unites_pedagogiques` VALUES (20914, 4);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Contenu de la table `les_unites_pedagogiques`
-- 

INSERT INTO `les_unites_pedagogiques` VALUES (4, 'CFA LAVAL', 'x', '', '02-20-30-50-40', '02-10-20-60-40', '', '', '', '');

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
  `date_derniere_connexion` timestamp NOT NULL default '0000-00-00 00:00:00',
  `nombre_connexions` int(10) unsigned NOT NULL default '0',
  `mode_acces` tinyint(4) NOT NULL default '0',
  `date_debut_acces` date NOT NULL default '0000-00-00',
  `date_fin_acces` date NOT NULL default '0000-00-00',
  `login` varchar(100) NOT NULL default '',
  `mdp` varchar(100) NOT NULL default '',
  `img_accueil` varchar(250) default NULL,
  PRIMARY KEY  (`id_usager`),
  UNIQUE KEY `nom` (`nom`,`prenom`,`adresse`,`profil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=20916 ;

-- 
-- Contenu de la table `les_usagers`
-- 

INSERT INTO `les_usagers` VALUES (1116, 'Monsieur', 'admin', 'admin', '32 av de chanzy', '', '', '', '', 'admin', '2006-02-23', '2006-06-30 13:28:36', 329, 0, '0000-00-00', '0000-00-00', 'aadmin', '123456', NULL);
INSERT INTO `les_usagers` VALUES (20867, 'Monsieur', 'BAINBRIDGE', 'Daniel', 'LE MOULIN A VENT\r\n\r\n53340   COSSE-EN-CHAMPAGNE', '02-43-67-83-32', '', '', '', 'app', '2006-05-22', '2006-06-30 10:23:42', 48, 0, '0000-00-00', '0000-00-00', 'DBAINBRIDGE', '123456', 'img_accueil_20867_portail.jpeg');
INSERT INTO `les_usagers` VALUES (20871, 'Monsieur', 'BOUCONTET', 'Grégory', '11 rue des Bigottières\r\n\r\n72300   VION', '02-43-92-34-07', '', '', '', 'app', '2006-05-22', '0000-00-00 00:00:00', 0, 0, '0000-00-00', '0000-00-00', 'Gr_gory_BOUCONTET', '6RnVBn', NULL);
INSERT INTO `les_usagers` VALUES (20874, 'Monsieur', 'CHAUDET', 'Fabien', 'Les Grillons\n\n53200   LOIGNE-SUR-MAYENNE', '02-43-70-31-70', '06-81-59-81-90', '', '', 'app', '2006-05-22', '2006-06-14 18:02:55', 1, 0, '0000-00-00', '0000-00-00', 'Fabien_CHAUDET', 'jN4AUH', NULL);
INSERT INTO `les_usagers` VALUES (20877, 'Monsieur', 'DAVOUST', 'Johnny', '6 rue Beausoleil\n\n53440   LA CHAPELLE-AU-RIBOUL', '02-43-00-74-48', '', '', '', 'app', '2006-05-22', '0000-00-00 00:00:00', 0, 0, '0000-00-00', '0000-00-00', 'Johnny_DAVOUST', 'S58hnu', NULL);
INSERT INTO `les_usagers` VALUES (20880, 'Monsieur', 'GRANDJEAN', 'Jonathan', '10 Square Alexandre de Yougoslavie\n\n53100   MAYENNE', '', '', '', '', 'app', '2006-05-22', '0000-00-00 00:00:00', 0, 0, '0000-00-00', '0000-00-00', 'Jonathan_GRANDJEAN', 'pXqBgu', NULL);
INSERT INTO `les_usagers` VALUES (20883, 'Monsieur', 'JORANT', 'Anthony', 'Le Haut Vissay\n\n53800   LA SELLE-CRAONNAISE', '02-43-06-84-79', '', '', '', 'app', '2006-05-22', '0000-00-00 00:00:00', 0, 0, '0000-00-00', '0000-00-00', 'Anthony_JORANT', 'YSwtAb', NULL);
INSERT INTO `les_usagers` VALUES (20886, 'Monsieur', 'LAM', 'Donat', '124 rue Nationale\n\n72000   LE MANS', '02-43-84-65-88', '', '', '', 'app', '2006-05-22', '0000-00-00 00:00:00', 0, 0, '0000-00-00', '0000-00-00', 'Donat_LAM', '8JS3qa', NULL);
INSERT INTO `les_usagers` VALUES (20889, 'Monsieur', 'LEPROVOST', 'Fabien', 'FOYER POURQUOI PAS\n3 BD ST NICOLAS\n72190   COULAINES', '02-43-76-21-48', '', '', '', 'app', '2006-05-22', '0000-00-00 00:00:00', 0, 0, '0000-00-00', '0000-00-00', 'Fabien_LEPROVOST', 'j7zfz5', NULL);
INSERT INTO `les_usagers` VALUES (20891, 'Monsieur', 'MONSIMER', 'JEAN-LOUP', 'LA ROUSSELIERE\n\n53170   LE BURET', '02-43-98-73-75', '', '', '', 'app', '2006-05-22', '0000-00-00 00:00:00', 0, 0, '0000-00-00', '0000-00-00', 'JEAN-LOUP_MONSIMER', 'pDA9h8', NULL);
INSERT INTO `les_usagers` VALUES (20893, 'Monsieur', 'QUENTIN', 'Jérémy', 'La Grande Marre\n\n72140   ROUESSE-VASSE', '06-10-86-20-09', '', '', '', 'app', '2006-05-22', '0000-00-00 00:00:00', 0, 0, '0000-00-00', '0000-00-00', 'J_r_my_QUENTIN', 'da7zVM', NULL);
INSERT INTO `les_usagers` VALUES (20895, 'Madame', 'BAINBRIDGE', 'SUZANNE', 'LE MOULIN A VENT\r\n\r\n53340   COSSE-EN-CHAMPAGNE', '02-43-67-83-32', '', '', '', 'rl', '2006-05-22', '2006-06-28 14:20:30', 4, 0, '0000-00-00', '0000-00-00', 'SUZANNE_BAINBRIDGE', '123456', NULL);
INSERT INTO `les_usagers` VALUES (20896, 'Monsieur', 'ANGOT', 'Fabien', 'Le Chêne\r\n\r\n53290   GREZ EN BOUERE', '02-43-70-91-76', '', '', 'http://', 'ens', '2006-05-22', '2006-06-30 16:18:36', 103, 0, '0000-00-00', '0000-00-00', 'FANGOT', '123456', NULL);
INSERT INTO `les_usagers` VALUES (20897, 'Monsieur', 'DALIBARD', 'Jacky', 'ZA LES VIGNES\r\n\r\n72300   SABLE-SUR-SARTHE', '02-43-62-12-00', '', '', '', 'ma', '2006-05-22', '2006-06-30 13:28:56', 17, 0, '0000-00-00', '0000-00-00', 'Jacky_DALIBARD', '123456', NULL);
INSERT INTO `les_usagers` VALUES (20898, 'Monsieur', 'BOUCONTET', 'Pascal', '11 rue des Bigottières\n\n72300   VION', '02-43-92-34-07', '', '', '', 'rl', '2006-05-22', '0000-00-00 00:00:00', 0, 0, '0000-00-00', '0000-00-00', 'Pascal_BOUCONTET', '46ZxKp', NULL);
INSERT INTO `les_usagers` VALUES (20899, 'Monsieur', 'BESSIERE', 'Laurent', '7 rue du Belvédère\n\n53100   CONTEST', '02-43-08-10-52', '', '', '', 'ens', '2006-05-22', '2006-06-16 08:39:59', 4, 0, '0000-00-00', '0000-00-00', 'Laurent_BESSIERE', 'fD67H2', NULL);
INSERT INTO `les_usagers` VALUES (20900, 'Monsieur', 'PHELIPOT', 'BERNARD', 'ZA DU PONT DE PIERRE\n\n53240   ANDOUILLE', '02-43-26-16-16', '', '', '', 'ma', '2006-05-22', '0000-00-00 00:00:00', 0, 0, '0000-00-00', '0000-00-00', 'BERNARD_PHELIPOT', 'HWqKDY', NULL);
INSERT INTO `les_usagers` VALUES (20901, 'Monsieur', 'CHAUDET', 'Philippe', 'Les Grillons\n\n53200   LOIGNE-SUR-MAYENNE', '02-43-70-31-70', '06-81-59-81-90', '', '', 'rl', '2006-05-22', '0000-00-00 00:00:00', 0, 0, '0000-00-00', '0000-00-00', 'Philippe_CHAUDET', '3qFQdn', NULL);
INSERT INTO `les_usagers` VALUES (20902, 'Monsieur', 'LERAY', 'JEAN CHARLES', '8 RUE DU CANAL\n\n53440   ARON', '02-43-04-21-50', '', '', '', 'ma', '2006-05-22', '0000-00-00 00:00:00', 0, 0, '0000-00-00', '0000-00-00', 'JEAN_CHARLES_LERAY', '3JWNtD', NULL);
INSERT INTO `les_usagers` VALUES (20903, 'Madame', 'DAVOUST', 'Véronique', '6 rue Beausoleil\n\n53440   LA CHAPELLE-AU-RIBOUL', '02-43-00-74-48', '', '', '', 'rl', '2006-05-22', '0000-00-00 00:00:00', 0, 0, '0000-00-00', '0000-00-00', 'V_ronique_DAVOUST', 'QwVXn6', NULL);
INSERT INTO `les_usagers` VALUES (20904, 'Monsieur', 'URBAIN', 'Stéphane', '1 RUE LANCELIN\nZA DE MAUBUARD\n53600   EVRON', '02-43-01-60-92', '', '', '', 'ma', '2006-05-22', '0000-00-00 00:00:00', 0, 0, '0000-00-00', '0000-00-00', 'St_phane_URBAIN', 'Wdwa3s', NULL);
INSERT INTO `les_usagers` VALUES (20905, 'Monsieur', 'GRANDJEAN', '', '10 Square Alexandre de Yougoslavie\n\n53100   MAYENNE', '', '', '', '', 'rl', '2006-05-22', '0000-00-00 00:00:00', 0, 0, '0000-00-00', '0000-00-00', 'GRANDJEAN', '3GPQDP', NULL);
INSERT INTO `les_usagers` VALUES (20906, 'Monsieur', 'ROLLANT', 'Pierre', 'ZA Bd Pasteur\n\n53800   RENAZE', '02-43-09-56-56', '', '', '', 'ma', '2006-05-22', '0000-00-00 00:00:00', 0, 0, '0000-00-00', '0000-00-00', 'Pierre_ROLLANT', '3AG35s', NULL);
INSERT INTO `les_usagers` VALUES (20907, 'Monsieur', 'JORANT', 'Bruno', 'Le Haut Vissay\n\n53800   LA SELLE-CRAONNAISE', '02-43-06-84-79', '', '', '', 'rl', '2006-05-22', '0000-00-00 00:00:00', 0, 0, '0000-00-00', '0000-00-00', 'Bruno_JORANT', 'KYPfmd', NULL);
INSERT INTO `les_usagers` VALUES (20908, 'Monsieur', 'CAILLERE', 'Thierry', '166 Rue Nationale\n\n72000   LE MANS', '02-43-78-00-63', '', '', '', 'ma', '2006-05-22', '0000-00-00 00:00:00', 0, 0, '0000-00-00', '0000-00-00', 'Thierry_CAILLERE', 'HPZaDP', NULL);
INSERT INTO `les_usagers` VALUES (20909, 'Monsieur', 'LAM', 'Donat', '124 rue Nationale\n\n72000   LE MANS', '02-43-84-65-88', '', '', '', 'rl', '2006-05-22', '0000-00-00 00:00:00', 0, 0, '0000-00-00', '0000-00-00', 'rl_Donat_LAM', 'b9RJm7', NULL);
INSERT INTO `les_usagers` VALUES (20910, 'Monsieur', 'ROHEE', 'JEAN CHRISTOPHE', '14 rue du Cormier\n\n72550   DEGRE', '02-43-76-21-48', '', '', '', 'ma', '2006-05-22', '0000-00-00 00:00:00', 0, 0, '0000-00-00', '0000-00-00', 'JEAN_CHRISTOPHE_ROHEE', 'aJckuN', NULL);
INSERT INTO `les_usagers` VALUES (20911, 'Madame', 'BIDAULT', 'MARIE-THERESE', 'FOYER POURQUOI PAS\n3 BD ST NICOLAS\n72190   COULAINES', '02-43-76-21-48', '', '', '', 'rl', '2006-05-22', '0000-00-00 00:00:00', 0, 0, '0000-00-00', '0000-00-00', 'MARIE-THERESE_BIDAULT', '6ERRvB', NULL);
INSERT INTO `les_usagers` VALUES (20912, 'Madame', 'METEREAU', 'ELISABETH', 'LA ROUSSELIERE\n\n53170   LE BURET', '02-43-98-73-75', '', '', '', 'rl', '2006-05-22', '0000-00-00 00:00:00', 0, 0, '0000-00-00', '0000-00-00', 'ELISABETH_METEREAU', 'RCTNtZ', NULL);
INSERT INTO `les_usagers` VALUES (20913, 'Madame', 'LOCHU', 'PATRICIA', 'La Grande Marre\n\n72140   ROUESSE-VASSE', '06-10-86-20-09', '', '', '', 'rl', '2006-05-22', '0000-00-00 00:00:00', 0, 0, '0000-00-00', '0000-00-00', 'PATRICIA_LOCHU', 'a22XTf', NULL);
INSERT INTO `les_usagers` VALUES (20914, 'Monsieur', 'rvs', 'rvs', 'rvs', '', '', '', '', 'rvs', '2006-06-06', '2006-06-29 19:42:28', 3, 0, '0000-00-00', '0000-00-00', 'rvsrvs', '123456', NULL);
INSERT INTO `les_usagers` VALUES (20915, 'Monsieur', 'qs', 'sq', 'qs', '', '', '', '', 'app', '2006-06-06', '0000-00-00 00:00:00', 0, 0, '0000-00-00', '0000-00-00', 'qsqsqsqssqs', '123456', NULL);

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
-- Contraintes pour la table `espace_partage`
-- 
ALTER TABLE `espace_partage`
  ADD CONSTRAINT `espace_partage_ibfk_1` FOREIGN KEY (`lien_id_espace`) REFERENCES `espace` (`id_espace`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `les_evaluations_feuilles_modalite_choix_ibfk_1` FOREIGN KEY (`id_choix`) REFERENCES `les_choix_modalite_multiple` (`id_choix`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `les_evaluations_feuilles_modalite_choix_ibfk_2` FOREIGN KEY (`id_noeud`) REFERENCES `les_noeuds` (`id_noeud`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_evaluations_feuilles_modalite_va_unique`
-- 
ALTER TABLE `les_evaluations_feuilles_modalite_va_unique`
  ADD CONSTRAINT `les_evaluations_feuilles_modalite_va_unique_ibfk_2` FOREIGN KEY (`id_noeud`) REFERENCES `les_noeuds` (`id_noeud`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `les_evaluations_feuilles_modalite_va_unique_ibfk_3` FOREIGN KEY (`id_modalite`) REFERENCES `les_modalites_va_unique` (`id_modalite`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `les_feuilles_declarees_modalite_choix_ibfk_3` FOREIGN KEY (`id_dec`) REFERENCES `les_declarations` (`id_dec`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `les_feuilles_declarees_modalite_choix_ibfk_4` FOREIGN KEY (`id_choix`) REFERENCES `les_choix_modalite_multiple` (`id_choix`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_feuilles_declarees_modalite_va_unique`
-- 
ALTER TABLE `les_feuilles_declarees_modalite_va_unique`
  ADD CONSTRAINT `les_feuilles_declarees_modalite_va_unique_ibfk_1` FOREIGN KEY (`id_noeud`) REFERENCES `les_noeuds` (`id_noeud`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `les_feuilles_declarees_modalite_va_unique_ibfk_3` FOREIGN KEY (`id_dec`) REFERENCES `les_declarations` (`id_dec`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `les_feuilles_declarees_modalite_va_unique_ibfk_4` FOREIGN KEY (`id_modalite`) REFERENCES `les_modalites_va_unique` (`id_modalite`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `les_responsables_unites_pedagogiques_ibfk_2` FOREIGN KEY (`id_unite`) REFERENCES `les_unites_pedagogiques` (`id_unite`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `les_responsables_unites_pedagogiques_ibfk_3` FOREIGN KEY (`id_rvs`) REFERENCES `les_usagers` (`id_usager`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Contraintes pour la table `les_signatures_declarations`
-- 
ALTER TABLE `les_signatures_declarations`
  ADD CONSTRAINT `les_signatures_declarations_ibfk_1` FOREIGN KEY (`id_dec`) REFERENCES `les_declarations` (`id_dec`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `les_signatures_declarations_ibfk_2` FOREIGN KEY (`id_usager`) REFERENCES `les_usagers` (`id_usager`) ON DELETE CASCADE ON UPDATE CASCADE;
