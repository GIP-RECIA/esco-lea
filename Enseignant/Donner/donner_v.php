<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/01/06
  // Contenu: 
/***********************************************************/
require_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("config/config.inc.php"))      require_once("config/config.inc.php");


require_once ($LEA_REP."modele/bdd/classe_apprenti.php");
require_once ($LEA_REP."lib/stdlib.php");

/***********************************************************/

$formation = new Formation($_SESSION['id_for']);

if(isset($_REQUEST['les_id_ens'])) {
	
	$les_id_enseignants = $_REQUEST['les_id_ens']; 
	
		$formation->update_les_sous_resp($les_id_enseignants);	
}else{
$les_id_enseignants=array();
$formation->update_les_sous_resp($les_id_enseignants);	
}

html_refresh($_SERVER['HTTP_REFERER']);
?>		
