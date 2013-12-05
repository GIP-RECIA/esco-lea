<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 12/08/05
  // Contenu: 
/***********************************************************/
include_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_classe.php");

/***********************************************************/
if (isset($_REQUEST['id_cla'])){
$id_cla = $_REQUEST['id_cla'];
$classe = new Classe($id_cla);
$classe->set_detail();
$id_for_select = $classe->id_for;  
$classe->delete();

html_refresh("gest_clas.php?cmd=cons_clas&id_for=$id_for_select");
}
else { html_refresh("../accueil.php");exit();
	  }
 ?>		