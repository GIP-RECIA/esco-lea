<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 15/11/05

/***********************************************************/

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_representant_legal.php");
require_once ("../secure.php");
/***********************************************************/

$id_rl_select = $_SESSION['id_rl'];

$parent=new Representant_legal($id_rl_select);
$parent->set_detail();

		$parent->nom = addslashes($parent->nom);
	    $parent->prenom = addslashes($parent->prenom);
		$parent->adresse = to_sql($_REQUEST['adresse']);
		$parent->tel_fixe = to_sql($_REQUEST['tel_fixe']);
		$parent->tel_mobile=  to_sql($_REQUEST['tel_mobile']);
		$parent->email = to_sql($_REQUEST['email']);
		$parent->url_site = to_sql($_REQUEST['url_site']);
		$parent->profession = to_sql($_REQUEST['profession']);
		$parent->adresse_prof = to_sql($_REQUEST['adresse_prof']);

$mdp = to_sql($_REQUEST['mdp']);

if ($mdp!="") $parent->mdp = $mdp;

$parent->update();

html_refresh("info_perso.php?cmd=cons_coordonnees");

?>
