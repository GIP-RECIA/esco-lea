<?php
require_once("../modele/bdd/connexion_bdd_lea.php");
$bdd = new Connexion_BDD_LEA();
$sql="CREATE TABLE les_sous_resp (
`id` DOUBLE NOT NULL AUTO_INCREMENT PRIMARY KEY,
`id_usager` DOUBLE NOT NULL ,
`id_for` DOUBLE NOT NULL
) DEFAULT CHARSET=utf8";
$bdd->executer($sql);

$sql = "CREATE TABLE les_droits (
`id_droit` VARCHAR(10) NOT NULL PRIMARY KEY,
`dr_soumis` VARCHAR(30) NOT NULL 
) DEFAULT CHARSET=utf8";
$bdd->executer($sql);

$sql = "CREATE TABLE les_droits_formations (
`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
`id_for_without_parent` BIGINT NOT NULL ,
`id_for_without_suivi` BIGINT NOT NULL
) DEFAULT CHARSET=utf8";
$bdd->executer($sql);

$sql = "CREATE TABLE les_sous_resp_droits (
`id_for` BIGINT NOT NULL PRIMARY KEY,
`droit` VARCHAR( 40 ) NOT NULL
) DEFAULT CHARSET=utf8";
$bdd->executer($sql);

$sql = "ALTER TABLE `les_messages` ADD `nature` VARCHAR( 30 ) NOT NULL";
$bdd->executer($sql);

$sql = "ALTER TABLE `les_messages` ADD `dossier` VARCHAR( 40 ) NOT NULL";
$bdd->executer($sql);

$sql = "ALTER TABLE `les_messages_recus_usagers` ADD `suppression` VARCHAR( 3 ) DEFAULT 'NON' NOT NULL";
$bdd->executer($sql);

$sql = "ALTER TABLE `les_messages_recus_usagers` ADD `dossier` VARCHAR( 40 ) NOT NULL";
$bdd->executer($sql);

$sql = "ALTER TABLE `les_usagers` CHANGE `profil` `profil` VARCHAR( 30 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL";
$bdd->executer($sql);

$sql = "ALTER TABLE `les_enseignants_formations` DROP FOREIGN KEY `les_enseignants_formations_ibfk_1`";
$bdd->executer($sql);

$sql = "ALTER TABLE `les_enseignants_formations` ADD CONSTRAINT `les_enseignants_formations_ibfk_1` FOREIGN KEY (`id_ens`) REFERENCES `les_usagers` (`id_usager`) ON DELETE CASCADE ON UPDATE CASCADE;";
$bdd->executer($sql);

$sql="insert into les_droits values ('admin','admin')";
$bdd->executer($sql);
$sql="insert into les_droits values ('rvs','rvs')";
$bdd->executer($sql);
$sql="insert into les_droits values ('ens','ens')";
$bdd->executer($sql);
$sql="insert into les_droits values ('ma','ma')";
$bdd->executer($sql);
$sql="insert into les_droits values ('sr','')";
$bdd->executer($sql);
$sql="insert into les_droits values ('unite_peda','true')";
$bdd->executer($sql);
$sql="insert into les_droits values ('supp_suivi','true')";
$bdd->executer($sql);
$sql="insert into les_droits values ('parent','true')";
$bdd->executer($sql);

$sql = "update les_chartes_graphiques set theme = 'cub_default' where theme not like 'cub%'";
$bdd->executer($sql);
$sql = "update les_options set valeur = 'cub_default' where nom = 'LEA_THEME' and valeur not like 'cub%'";
$bdd->executer($sql);

echo "La mise à jour en version 3.1 de la base a été effectuée";
?>