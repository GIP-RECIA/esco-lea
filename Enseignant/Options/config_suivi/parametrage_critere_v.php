<?php
/***********************************************************/   
  // Auteur : FrÃ©dÃ©ric Goyer
  // Version : 1.0.2
  // Date: 05/07  
/***********************************************************/
if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php"))      require_once("../config/config.inc.php");

include_once($LEA_REP."Enseignant/secure.php");

require_once($LEA_REP."modele/bdd/classe_param_criteres.php");
require_once($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
/***********************************************************/
include($LEA_REP."Enseignant/test_responsable.php");
function clearsession() {
	$clearSessionArrayValue = array("id_modalite_classe", "id_choix", "mode_affichage", "mode_textuel", "mode_graphique", "param_graphique");
	foreach($clearSessionArrayValue as $ThisSessionValue) {
		unset($_SESSION[$ThisSessionValue]);
	}
}
/***********************************************************/
/****  Recuperation des donnees des GET
/***********************************************************/
$cmd		  =	$_GET['cmd'];
$cmd_id_arbre = $_GET['id_arbre'];
$type_suivi   =	$_GET['type_suivi'];
$suivi 		  = $_GET['suivi'];
$selmenu 	  =	$_GET['selmenu'];

list ($id_modalite, $classe_modalite) = explode(":", $_SESSION['id_modalite_classe']);

if(isset($_SESSION['id_choix'])){
	$param_crit = new Param_criteres($id_modalite, $_SESSION['id_choix']);
} else{
	$param_crit = new Param_criteres($id_modalite);
}

$param_crit->mode_affichage = $_SESSION['mode_affichage'];
switch($param_crit->mode_affichage) {
	case "tout":
		$param_crit->afficher_texuel 		= TRUE;
		$param_crit->afficher_graphique 	= TRUE;
		break;
	case "graphique":
		$param_crit->afficher_texuel 		= FALSE;
		$param_crit->afficher_graphique 	= TRUE;
		break;
	case "textuel":
		$param_crit->afficher_texuel 		= TRUE;
		$param_crit->afficher_graphique 	= FALSE;
		unset($_SESSION['param_graphique']);
		break;
	case "aucun":
		$param_crit->afficher_texuel 		= FALSE;
		$param_crit->afficher_graphique 	= FALSE;
		unset($_SESSION['param_graphique']);
		break;		
	default:
		$param_crit->afficher_texuel 		= NULL;
		$param_crit->afficher_graphique 	= NULL;
		unset($_SESSION['mode_graphique']);
		unset($_SESSION['param_graphique']);
		break;	
}
$param_crit->mode_textuel = $_SESSION['mode_textuel'];
if(isset($_SESSION['mode_graphique'])) $param_crit->mode_graphique = $_SESSION['mode_graphique'];
if(isset($_SESSION['mode_graphique']) && $_SESSION['mode_graphique'] == "smilies"){
	$param_crit->param_graphique = $_SESSION['param_graphique'];
} else{
	$param_crit->param_graphique = NULL;
}
if(isset($_POST['validerOK']) && $_POST['validerOK'] == "OK"){
	$param_crit->update();
	clearsession();
}

html_refresh("../options.php?cmd=".$cmd."&type_suivi=".$type_suivi."&suivi=".$suivi."&selmenu=".$selmenu."&id_arbre=".$cmd_id_arbre);
?>