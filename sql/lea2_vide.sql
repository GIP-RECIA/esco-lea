-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Jeudi 12 Octobre 2006 à 17:00
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `modif_dec_ma` binary(1) NOT NULL default '0',
  PRIMARY KEY  (`id_app`),
  KEY `id_cla` (`id_cla`),
  KEY `id_ma` (`id_ma`),
  KEY `id_ens` (`id_ens`),
  KEY `id_rl` (`id_rl`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

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

-- --------------------------------------------------------

-- 
-- Structure de la table `les_documents_administratifs`
-- 

CREATE TABLE `les_documents_administratifs` (
  `id_doc` bigint(20) NOT NULL auto_increment,
  `titre` varchar(250) NOT NULL default '',
  `commentaire` mediumtext NOT NULL,
  `categorie` varchar(250) NOT NULL default '',
  `fichier_joint` varchar(250) NOT NULL default '',
  `date_maj` timestamp NOT NULL default '0000-00-00 00:00:00',
  `id_usager` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_doc`),
  KEY `id_usager` (`id_usager`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `les_enseignants`
-- 

CREATE TABLE `les_enseignants` (
  `id_ens` bigint(20) NOT NULL default '0',
  `discipline` tinytext,
  PRIMARY KEY  (`id_ens`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=2201 ;

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
  `fichier_joint` tinytext NOT NULL,
  `id_usager` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_msg`),
  KEY `id_usager` (`id_usager`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=130 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=154 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `les_options`
-- 

CREATE TABLE `les_options` (
  `nom` varchar(50) NOT NULL default '',
  `valeur` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`nom`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=25518 ;

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
-- Contraintes pour la table `les_documents_administratifs`
-- 
ALTER TABLE `les_documents_administratifs`
  ADD CONSTRAINT `les_documents_administratifs_ibfk_1` FOREIGN KEY (`id_usager`) REFERENCES `les_usagers` (`id_usager`) ON DELETE CASCADE ON UPDATE CASCADE;

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
