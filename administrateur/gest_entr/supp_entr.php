<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 12/09/05
  // Contenu: ce script permet de supprimer l'entreprise d'identifiant id_entr passsé en paramètre
/***********************************************************/
require_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."modele/bdd/classe_entreprise.php");

/***********************************************************/
if (isset($_REQUEST['id_entr'])){
$id_entr=$_REQUEST['id_entr'];
$entreprise=new Entreprise($id_entr);
$entreprise->set_detail();
$entreprise->delete_all_ma();
$entreprise->delete();

html_refresh($_SERVER['HTTP_REFERER']);

}else { html_refresh("../accueil.php"); exit();
	  }
 ?>		
