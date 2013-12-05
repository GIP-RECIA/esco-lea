CREATE TABLE IF NOT EXISTS `les_param_impression` (
  `id_param` bigint(20) NOT NULL auto_increment,
  `id_usager` bigint(20) NOT NULL default '0',
  `id_for` bigint(20) NOT NULL default '0',
  `params` text NOT NULL,
  `libelle` varchar(255) NOT NULL,
  PRIMARY KEY  (`id_param`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `les_param_criteres` (
  `id_choix` bigint(20) NOT NULL default '0',
  `id_modalite` bigint(20) NOT NULL default '0',
  `mode_affichage` enum('tout','graphique','textuel','aucun') default NULL,
  `mode_textuel` enum('brut','calcule') default NULL,
  `mode_graphique` enum('bpp','bps','smilies') default NULL,
  `param_graphique` text,
  PRIMARY KEY  (`id_choix`,`id_modalite`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `les_terminologies` (
  `id` bigint(20) NOT NULL default '1',
  `terminologie_ma` varchar(50) NOT NULL default '',
  `terminologie_tuteur_cfa` varchar(50) NOT NULL default '',
  `terminologie_app` varchar(50) NOT NULL default '',
  `terminologie_classe` varchar(50) NOT NULL default '',
  `terminologie_ens` varchar(50) NOT NULL default '',
  `terminologie_rl` varchar(50) NOT NULL default '',
  `terminologie_entr` varchar(50) NOT NULL default '',
  `terminologie_suivi_cfa` varchar(50) NOT NULL default '',
  `terminologie_suivi_entr` varchar(50) NOT NULL default '',
  `terminologie_lea` varchar(50) NOT NULL default '',
  `terminologie_admin` varchar(50) NOT NULL default '',
  `terminologie_cfa` varchar(50) NOT NULL default '',
  `terminologie_unit_pedag` varchar(50) NOT NULL default '',
  `terminologie_rvs` varchar(50) NOT NULL default '',
  `terminologie_formation` varchar(50) NOT NULL default '',
  `terminologie_rf` varchar(50) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `les_usagers` DROP INDEX `nom` , ADD UNIQUE `nom` ( `nom` , `prenom` , `profil` );

ALTER TABLE `les_usagers` CHANGE `adresse` `adresse` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL; 
 
ALTER TABLE `les_configs_lea` ADD `appelation_app` VARCHAR( 50 ) NOT NULL ;
ALTER TABLE `les_configs_lea` ADD `appelation_classe` VARCHAR( 50 ) NOT NULL ;
ALTER TABLE `les_configs_lea` ADD `appelation_rl` VARCHAR( 50 ) NOT NULL ;
ALTER TABLE `les_configs_lea` ADD `appelation_ens` VARCHAR( 50 ) NOT NULL ;
ALTER TABLE `les_configs_lea` ADD `appelation_entr` VARCHAR( 50 ) NOT NULL ;
ALTER TABLE `les_configs_lea` ADD `appelation_suivi_entr` VARCHAR( 50 ) NOT NULL ;
ALTER TABLE `les_configs_lea` ADD `appelation_suivi_cfa` VARCHAR( 50 ) NOT NULL ;

UPDATE `les_chartes_graphiques` SET `theme` = 'cub_default';