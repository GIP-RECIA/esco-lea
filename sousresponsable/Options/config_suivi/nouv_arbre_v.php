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

include_once($LEA_REP."sousresponsable/secure.php");

require_once ($LEA_REP."modele/bdd/classe_arbre.php");
require_once ($LEA_REP."modele/bdd/classe_formation.php");
require_once ($LEA_REP."lib/stdlib.php");
/***********************************************************/
ini_set("max_execution_time",300); // la durï¿½e maximale d'exï¿½cution du script est 300 secondes

include($LEA_REP."Enseignant/test_responsable.php");

$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];
$config_lea = $formation->get_config_lea();
		   		   
   if(isset($_REQUEST['libelles_niveaux']))  {
	
		$libelles_niveaux = $_REQUEST['libelles_niveaux'];

		foreach($libelles_niveaux as $no => $libelle) {
			if($libelle == "") { 
				afficher_msg_erreur("Le libell&eacute; du niveau ".$no." est vide ");
				afficher_boutton_retour(); exit();
			}		
		}
	} else { 
		afficher_msg_erreur("Cet arbre ne comporte aucun niveau    ");  
		afficher_boutton_retour();
		exit(); 
	}
		
	if(isset($_REQUEST['id_arbre'])) $id_arbre = $_REQUEST['id_arbre'];
	else $id_arbre = 0;
	
	$arbre = new Arbre($id_arbre);

	if($id_arbre == 0) {
		$arbre->id_config = $config_lea->id_config;													
		$arbre->nom = to_sql($_REQUEST['nom']);
		$arbre->type = $_REQUEST['type_suivi'];
		$arbre->insert();
							
		foreach($libelles_niveaux as $no => $libelle) {
			$arbre->insert_libelle_niveau($no, to_sql($libelle));
		}	
	} else { 
		$arbre->set_detail();
		$arbre->nom = to_sql($_REQUEST['nom']);
		$arbre->update();
		
		foreach($libelles_niveaux as $no => $libelle) {
		  $arbre->update_libelle_niveau($no, to_sql($libelle));
		}									
	}																			
	html_refresh("../options.php?cmd=maj_arbre&id_arbre=".$arbre->id_arbre."&type_suivi=".$_GET['type_suivi']."&suivi=".$_GET['suivi']."&selmenu=".$_GET['selmenu']);	
?>							
