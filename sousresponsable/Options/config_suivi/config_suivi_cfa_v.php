<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 10/02/06
/***********************************************************/
if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php"))      require_once("../config/config.inc.php");

include_once($LEA_REP."sousresponsable/secure.php");

require_once($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
/***********************************************************/
include($LEA_REP."sousresponsable/test_responsable.php");

$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];
$config_lea = $formation->get_config_lea();

$config_lea->DMSA_dec_cfa = $_REQUEST['DMSA_dec_cfa'];


if(isset($_REQUEST['app_joint_fichiers_suivi_cfa'])) $config_lea->app_joint_fichiers_suivi_cfa = 1;
else $config_lea->app_joint_fichiers_suivi_cfa = 0;


if(isset($_REQUEST['suivi_cfa_guide'])) {
	$config_lea->suivi_cfa_guide_actif =1;
	$guide = true;
}else {
	$config_lea->suivi_cfa_guide_actif = 0;
	$guide = false;
}

if(isset($_REQUEST['suivi_cfa_libre'])) {
	$config_lea->suivi_cfa_libre_actif =1;
	$libre = true;
}else {
	$config_lea->suivi_cfa_libre_actif = 0;
	$libre = false;
}

$config_lea->update();

if($libre && $guide) $suivi="tous";
elseif($libre) $suivi="libre";
else $suivi="guide";


if(!isset($_REQUEST['suivi_cfa_libre'])) html_refresh("../options.php?cmd=suivi_guide_cfa&type_suivi=cfa&suivi=".$suivi."&selmenu=guide");
else html_refresh("../options.php?cmd=suivi_libre_cfa&type_suivi=cfa&suivi=".$suivi."&selmenu=libre");

?>