<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/01/06
/***********************************************************/
if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php"))      require_once("../config/config.inc.php");

include_once($LEA_REP."Enseignant/secure.php");

require_once ($LEA_REP."modele/bdd/classe_arbre.php");
require_once ($LEA_REP."modele/bdd/classe_formation.php");
require_once ($LEA_REP."lib/stdlib.php");
/***********************************************************/
include($LEA_REP."Enseignant/test_responsable.php");

$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];
$config_lea = $formation->get_config_lea();

$action = $_GET['action'];
$id_arbre = $_GET['id_arbre'];

$arbre = new Arbre($id_arbre);
$arbre->set_detail();
		   
if($_GET['action'] == "supprimer" ) {
	$arbre->delete();
	html_refresh("../options.php?cmd=suivi_guide_".$arbre->type."&type_suivi=".$_GET['type_suivi']."&suivi=".$_GET['suivi']."&selmenu=".$_GET['selmenu']."");
} elseif($_GET['action'] == "vider" ) {
  	$arbre->vider();
	html_refresh("../options.php?cmd=maj_arbre&id_arbre=".$arbre->id_arbre."&type_suivi=".$_GET['type_suivi']."&suivi=".$_GET['suivi']."&selmenu=".$_GET['selmenu']."");
}else  html_refresh($_SERVER['HTTP_REFERER']);		   													
																												
?>		
		

	