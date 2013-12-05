<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 24/04/06

/***********************************************************/

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_usager.php");

/**********************************************************/

$id_dec = $_REQUEST['id_dec'];
$id_usager = $_REQUEST['id_usager'];

$declaration = new Declaration($id_dec);
$declaration->set_detail();

$declaration->signer($id_usager);

html_refresh("apprentis.php?cmd=cons_dec_app&id_app_select=$declaration->id_app&type_suivi=$declaration->type_suivi&id_periode=$declaration->id_periode");

?>