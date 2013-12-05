<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 29/08/05
/***********************************************************/
include_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
/***********************************************************/
$id_cla_depart = $_REQUEST['id_cla_depart'];
$id_cla_dest = $_REQUEST['id_cla_dest'];  

$classe_depart = new Classe ($id_cla_depart);
$classe_depart->basculer_apprentis($id_cla_dest);

html_refresh("gest_clas.php?cmd=cons_app_clas&id_cla=$id_cla_dest");
?>