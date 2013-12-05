<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/01/06
/***********************************************************/

include_once("../../secure.php");

if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php"))      require_once("../config/config.inc.php");


require_once ($LEA_REP."modele/bdd/classe_arbre.php");
require_once ($LEA_REP."modele/bdd/classe_formation.php");
require_once ($LEA_REP."lib/stdlib.php");
/***********************************************************/
include("../../test_responsable.php");

$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];
$config_lea = $formation->get_config_lea();

 		   $action = $_REQUEST['action'];
		   $id_arbre = $_REQUEST['id_arbre'];

		   $arbre = new Arbre($id_arbre);
		   $arbre->set_detail();
           if($action =='supprimer' ) {
		   	
			$arbre->delete();
		   if($arbre->type=='ref_entr')	html_refresh("config_suivi_entr.php");
		   else html_refresh("config_suivi_cfa.php");
			
		   }
		   elseif($action =='vider' ){
		   
		   	$arbre->vider();
			html_refresh("maj_referentiel.php?id_arbre=$arbre->id_arbre");
			
		   }else  html_refresh($_SERVER['HTTP_REFERER']);		   													
																												
?>		
		

	