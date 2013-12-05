<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 24/05/06

/***********************************************************/

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_declaration.php");
require_once($LEA_REP."modele/bdd/classe_document_declare.php");
session_start();
/**********************************************************/

$declaration = new Declaration(0);
$declaration->id_periode = $_REQUEST['id_periode'];
$declaration->id_app = $_REQUEST['id_app'];
$declaration->type_suivi = $_REQUEST['type_suivi'];

$declaration->insert();
	
html_refresh("modifier_dec_app.php?id_dec=".$declaration->id_dec);

?>