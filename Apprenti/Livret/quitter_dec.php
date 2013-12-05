<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/04/06

/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");
session_name("LEA_$RNE_ETAB");
@session_start();

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
require_once($LEA_REP."modele/bdd/classe_document_declare.php");

/**********************************************************/

$_SESSION['declaration'] = NULL;
$_SESSION['les_id_noeud'] = NULL;
$_SESSION['les_noeuds_modalites_nf'] = NULL;
$_SESSION['les_noeuds_modalites_nn'] = NULL;
$_SESSION['les_noeuds_modalites_m'] = NULL;
$_SESSION['les_modalites_rl'] = NULL;
$_SESSION['les_modalites_rc'] = NULL;

html_refresh("livret.php");

?>