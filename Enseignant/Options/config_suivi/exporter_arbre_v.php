<?php

if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php"))      require_once("../config/config.inc.php");

require_once($LEA_REP."Enseignant/secure.php");

require_once ($LEA_REP."modele/bdd/classe_noeud.php");
require_once ($LEA_REP."modele/bdd/classe_modalite_va_multiple.php");
require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
/***********************************************************/
include($LEA_REP."Enseignant/test_responsable.php");

	$config_term = new Terminologie();
	$config_term->set_detail();
		
	$formation = new Formation($_SESSION['id_for']);
	$formation->nom = $_SESSION['nom_formation'];
	
	$config_lea = $formation->get_config_lea();
	
	if(isset($_REQUEST['type_suivi'])) $type_suivi = $_REQUEST['type_suivi'];
	
	if(isset($_REQUEST['id_arbre']))  {
		$arbre = new Arbre($_REQUEST['id_arbre']);
		$arbre->set_detail();
		$xml=$arbre->to_xml();
		
		header("Content-disposition: attachment; filename=\"".$arbre->nom.".xml\"");
		header("Content-Type: application/force-download");
		header("Content-Transfer-Encoding: 'text/xml'\n"); // Surtout ne pas enlever le \n
		header("Content-Length: ".strlen($xml));
		header("Pragma: no-cache");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0, public");
		header("Expires: 0");
		echo $xml;
	}
?>
