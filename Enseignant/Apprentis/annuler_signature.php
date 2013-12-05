<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 23/04/06
/***********************************************************/

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
require_once($LEA_REP."modele/bdd/classe_document_declare.php");

/***********************************************************/

include("../test_responsable.php");

$id_dec = $_REQUEST['id_dec'];
$id_usager = $_REQUEST['id_usager'];

$declaration = new Declaration($id_dec);
$declaration->set_detail();
$declaration->delete_signature($id_usager);

html_refresh("apprentis.php?cmd=cons_dec_app&type_suivi=$declaration->type_suivi&id_periode=$declaration->id_periode&id_app_select=$declaration->id_app");
?>

