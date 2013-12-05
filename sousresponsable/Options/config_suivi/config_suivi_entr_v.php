<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 10/02/06
/***********************************************************/
if 		(file_exists("../../../config/config.inc.php"))	require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php"))	require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php"))		require_once("../config/config.inc.php");

include_once($LEA_REP."sousresponsable/secure.php");

require_once($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
/***********************************************************/
include($LEA_REP."sousresponsable/test_responsable.php");


$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];
$config_lea = $formation->get_config_lea();
$les_apprentis = $formation->get_apprentis();

$config_lea->DMSA_dec_entr = $_REQUEST['DMSA_dec_entr'];

if(isset($_REQUEST['app_joint_fichiers_suivi_entr'])) $config_lea->app_joint_fichiers_suivi_entr = 1;
else $config_lea->app_joint_fichiers_suivi_entr = 0;

if(isset($_REQUEST['suivi_entr_guide'])) {
	$config_lea->suivi_entr_guide_actif =1;
	$guide = true;
}else {
	$config_lea->suivi_entr_guide_actif = 0;
	$guide = false;
}

if(isset($_REQUEST['suivi_entr_libre'])) {
	$config_lea->suivi_entr_libre_actif =1;
	$libre = true;
}else {
	$config_lea->suivi_entr_libre_actif = 0;
	$libre = false;
}


$config_lea->update();

// la liste  des identifiants d'apprentis qui seront autorisï¿½s 
// ï¿½ modifier la dï¿½claration de leur mettre d'apprentissage

if(isset($_REQUEST['les_id_app'])) $les_id_app = $_REQUEST['les_id_app'];
else $les_id_app = array();

foreach($les_apprentis as $apprenti){

	if(in_array($apprenti->id_app, $les_id_app))	
		 $apprenti->update_attribut('modif_dec_ma', 1);
	else $apprenti->update_attribut('modif_dec_ma', 0);	
}

if($libre && $guide) $suivi="tous";
elseif($libre) $suivi="libre";
else $suivi="guide";

//if(!isset($_REQUEST['suivi_entr_libre'])) html_refresh("nouv_arbre.php?type_suivi=entr");
//else html_refresh("config_suivi_libre.php?type_suivi=entr");
if(!isset($_REQUEST['suivi_entr_libre'])) html_refresh("../options.php?cmd=suivi_guide_entr&type_suivi=entr&suivi=".$suivi."&selmenu=guide");
else html_refresh("../options.php?cmd=suivi_libre_entr&type_suivi=entr&suivi=".$suivi."&selmenu=libre");


?>