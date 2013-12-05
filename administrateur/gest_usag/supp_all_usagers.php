<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 25/09/05
  // Contenu: 
/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");
session_start();
@session_start();

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_usager.php");
/***********************************************************/
 $bdd = new Connexion_bdd_lea();

if(isset($_REQUEST['profil'])){
	$profil = $_REQUEST['profil'];
}else{
	$profil='';
}

if(isset($_REQUEST['mot_cle'])){
	$mot_cle = $_REQUEST['mot_cle'];
}else{
	$mot_cle ='';
}
	
$bdd->delete_all_usagers($profil, $mot_cle);	

html_refresh($_SERVER['HTTP_REFERER']);
?>