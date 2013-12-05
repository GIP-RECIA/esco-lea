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
session_name("LEA_$RNE_ETAB");
session_start();
/**********************************************************/

$id_dec = $_REQUEST['id_dec'];
$id_usager = $_REQUEST['id_usager'];

$declaration = new Declaration($id_dec);
$declaration->set_detail();

$declaration->signer($id_usager);


if(isset($_SESSION['id_app'])) {
	html_refresh($LEA_URL."Apprenti/Livret/livret.php?cmd=cons_dec&type_suivi=$declaration->type_suivi&id_periode=$declaration->id_periode");
} elseif(isset($_SESSION['id_ens'])) {
	html_refresh($LEA_URL."Enseignant/Apprentis/apprentis.php?cmd=cons_dec_app&type_suivi=$declaration->type_suivi&id_periode=$declaration->id_periode&id_app_select=$declaration->id_app" );
} elseif(isset($_SESSION['id_ma'])) {
	html_refresh($LEA_URL."Maitre_apprentissage/Apprentis/apprentis.php?cmd=cons_dec_app&type_suivi=$declaration->type_suivi&id_periode=$declaration->id_periode&id_app_select=$declaration->id_app" );
} elseif(isset($_SESSION['id_rl'])) {
	html_refresh($LEA_URL."Representant_legal/Apprentis/apprentis.php?cmd=cons_dec_app&type_suivi=$declaration->type_suivi&id_periode=$declaration->id_periode&id_app_select=$declaration->id_app" );
}
else exit();

?>