<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 12/09/05
  // Contenu: ce script permet de supprimer l'unite d'identifiant id_unite passsé en paramètre
/***********************************************************/
include_once("../secure.php");
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_unite_pedagogique.php");
/***********************************************************/
if (isset($_REQUEST['id_unite'])){
$id_unite=$_REQUEST['id_unite'];
$unite=new Unite_pedagogique($id_unite);
$unite->set_detail();

$unite->delete();

html_refresh($_SERVER['HTTP_REFERER']);

}else { html_refresh("../accueil.php"); exit();
	  }
 ?>		
