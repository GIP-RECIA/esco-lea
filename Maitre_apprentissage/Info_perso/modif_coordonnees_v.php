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
require_once($LEA_REP."modele/bdd/classe_maitre_apprentissage.php");
require_once($LEA_REP."modele/bdd/classe_entreprise.php");
/***********************************************************/
$id_ma_select=$_SESSION['id_ma'];

$maitre=new Maitre_apprentissage($id_ma_select);
$maitre->set_detail();

	$maitre->nom = addslashes($maitre->nom);
	$maitre->prenom = addslashes($maitre->prenom);

	$maitre->adresse = to_sql($_REQUEST['adresse']);
	$maitre->tel_fixe = to_sql($_REQUEST['tel_fixe']);
	$maitre->tel_mobile  = to_sql($_REQUEST['tel_mobile']);
	$maitre->email = to_sql($_REQUEST['email']);
	$maitre->url_site = to_sql($_REQUEST['url_site']);
	$mdp = to_sql($_REQUEST['mdp']);
	
	if ($mdp!="") $maitre->mdp=$mdp;
	$maitre->update();

	$entreprise = new Entreprise($maitre->id_entr);
	$entreprise->set_detail(0);

	$entreprise->nom = addslashes($entreprise->nom);
	$entreprise->adresse = addslashes($entreprise->adresse);



		$entreprise->tel_fixe1 = to_sql($_REQUEST['tel_fixe1_entr']);
		$entreprise->tel_fixe2 = to_sql($_REQUEST['tel_fixe2_entr']);
		$entreprise->fax = to_sql($_REQUEST['fax_entr']);
		$entreprise->email = to_sql($_REQUEST['email_entr']);
		$entreprise->url_site = to_sql($_REQUEST['url_site_entr']);
		$entreprise->secteur_activite = to_sql($_REQUEST['secteur_activite_entr']);
		$entreprise->nb_salaries = to_sql($_REQUEST['nb_salaries_entr']);
		$entreprise->nb_apprentis = to_sql($_REQUEST['nb_apprentis_entr']);
		$entreprise->nom_contact = to_sql($_REQUEST['nom_contact_entr']);
		$entreprise->prenom_contact = to_sql($_REQUEST['prenom_contact_entr']);

$entreprise->update();

include("cons_coordonnees.php");

?>
