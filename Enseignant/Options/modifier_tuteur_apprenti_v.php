<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
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

$apprenti = new Apprenti($_REQUEST['id_app']);
$apprenti->update_tuteur_cfa($_REQUEST['id_ens']);

if (isset($_GET['ancre']))
{
	html_refresh($_SERVER['HTTP_REFERER'].'#'.$_GET['ancre']);
}
else
	html_refresh($_SERVER['HTTP_REFERER']);
?>		
