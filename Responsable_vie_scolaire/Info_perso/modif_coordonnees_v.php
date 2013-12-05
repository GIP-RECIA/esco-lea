<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 05/09/05

/***********************************************************/

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_usager.php");
require_once($LEA_REP."lib/stdlib.php");
require_once("../secure.php");
/***********************************************************/
$rvs = new Usager($_SESSION['id_rvs']);
$rvs->set_detail();


	$rvs->nom = addslashes($rvs->nom);
	$rvs->prenom = addslashes($rvs->prenom);
	$rvs->adresse = to_sql($_REQUEST['adresse']);
	$rvs->tel_fixe = to_sql($_REQUEST['tel_fixe']);
	$rvs->tel_mobile = to_sql($_REQUEST['tel_mobile']);
	$rvs->email = to_sql($_REQUEST['email']);
	$rvs->url_site = to_sql($_REQUEST['url_site']);	
	$mdp = to_sql($_REQUEST['mdp']);

if ($mdp!="") $rvs->mdp = $mdp;
$rvs->update();

html_refresh('info_perso.php?cmd=cons_coordonnees.php');
?>
