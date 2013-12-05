<?php
/***********************************************************/   
  // Auteur : FrÃ©dÃ©ric Goyer
  // Version : 1.0.2
  // Date: 04/07  
/***********************************************************/
if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php"))      require_once("../config/config.inc.php");

include_once($LEA_REP."sousresponsable/secure.php");

require_once($LEA_REP."modele/bdd/classe_param_criteres.php");
require_once($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
/***********************************************************/
include($LEA_REP."Enseignant/test_responsable.php");

$cmd_id_modalite = 	$_GET['id_modalite'];
if(isset($_GET['id_choix'])) $cmd_id_choix = $_GET['id_choix'];
else $cmd_id_choix = NULL;
$param_crit = new Param_criteres($cmd_id_modalite, $cmd_id_choix);

$cmd = 			$_GET['cmd'];
$cmd_id_arbre = $_GET['id_arbre'];
$type_suivi = 	$_GET['type_suivi'];
$suivi = 		$_GET['suivi'];
$selmenu = 		$_GET['selmenu'];

$param_crit->mode_affichage = $_GET['mode_affichage'];
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
		break;
	case "aucun":
		$param_crit->afficher_texuel 		= FALSE;
		$param_crit->afficher_graphique 	= FALSE;
		break;		
	default:
		$param_crit->afficher_texuel 		= NULL;
		$param_crit->afficher_graphique 	= NULL;
		break;	
}
if(isset($_GET['mode_graphique']))	$param_crit->mode_graphique = $_GET['mode_graphique'];
if(isset($_GET['mode_textuel'])) $param_crit->mode_textuel = $_GET['mode_textuel'];

$param_crit->update();

html_refresh("../options.php?cmd=".$cmd."&type_suivi=".$type_suivi."&suivi=".$suivi."&selmenu=".$selmenu."&id_arbre=".$cmd_id_arbre."&id_choix=".$cmd_id_choix."&id_modalite=".$cmd_id_modalite."");

?>