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
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once("../secure.php");
/***********************************************************/
$enseignant = new Enseignant($_SESSION['id_ens']);
$enseignant->set_detail();


	$enseignant->nom = addslashes($enseignant->nom);
	$enseignant->prenom = addslashes($enseignant->prenom);	
	$enseignant->adresse = to_sql($_REQUEST['adresse']);
	$enseignant->tel_fixe = to_sql($_REQUEST['tel_fixe']);
	$enseignant->tel_mobile = to_sql($_REQUEST['tel_mobile']);
	$enseignant->email = to_sql($_REQUEST['email']);
	$enseignant->url_site = to_sql($_REQUEST['url_site']);
	$enseignant->login = addslashes($enseignant->login);
	$mdp = to_sql($_REQUEST['mdp']);


if ($mdp!="") 
	$enseignant->mdp = $mdp;

$enseignant->update();


html_refresh('info_perso.php?cmd=cons_coordonnees.php');

?>
