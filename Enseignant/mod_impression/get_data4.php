<?php
/***********************************************************/
  // CFA des 3 villes
  // Web: www.cfa3villes.com.
    
  // Auteur : Matthieu DANET
  // Web: www.matthieu-danet.fr
  
  // Version : 1.1
  // Date: 04/04/07
/***********************************************************/
require_once('../secure.php');

/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

/***********************************************************/

require_once($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
require_once($LEA_REP."modele/bdd/classe_arbre.php");
require_once($LEA_REP."modele/bdd/classe_entreprise.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_maitre_apprentissage.php");
require_once($LEA_REP."modele/bdd/classe_declaration.php");
require_once($LEA_REP."modele/bdd/classe_param_criteres.php");

// On initialise les variables concernant l'enseignant qui est en train d'utiliser le LEA
$enseignant = new Enseignant($_SESSION['id_ens']);
$enseignant_est_responsable = $enseignant->est_responsable($_SESSION['id_for']);
$enseignant_est_tuteur = ($enseignant->id_ens == $apprenti->id_ens);

if($enseignant_est_responsable) {
	$acteur = "";
} elseif ($enseignant_est_tuteur) {
	$acteur ='tuteur_cfa';
} else {
  	$acteur ='ens';
}

//Instanciation d'un apprenti
$apprenti = new Apprenti($_SESSION["imp_apprenti_tmp"]);
$apprenti->set_detail();

// Instanciation de la classe de l'apprenti
$classe = new Classe($apprenti->id_cla);
$classe->set_detail();


// Instanciation de la formation de l'apprenti
$formation = new Formation($_SESSION['id_for']);
$formation->set_detail();

// Instanciation d'un MA de l'apprenti
$ma = new Maitre_apprentissage($apprenti->id_ma);
$ma->set_detail();

// Instanciation de l'entreprise du MA
$entreprise = new Entreprise($ma->id_entr);
$entreprise->set_detail();

// Instanciation du tuteur CFA
$tuteur = new Enseignant($apprenti->id_ens);
$tuteur->set_detail();

echo "<br /><strong>Nom prenom apprenti :</strong><br />";
echo $apprenti->nom." ".$apprenti->prenom;

echo "<br /><strong>Classe :</strong><br />";
echo $classe->libelle;

echo "<br /><strong>Formation :</strong><br />";
echo $formation->nom;

echo "<br /><strong>Adresse apprenti :</strong><br />";
echo $apprenti->adresse;

echo "<br /><strong>Maitre d'apprentissage (nom prenom):</strong><br />";
if($apprenti->id_ma > 0) {
	echo $ma->nom." ".$ma->prenom;
} else {
	echo "<i>Non renseignÃ©</i>";
}

echo "<br /><strong>Nom entreprise :</strong><br />";
echo $entreprise->nom;

echo "<br /><strong>Tuteur CFA (nom prenom) :</strong><br />";
if($apprenti->id_ens > 0) {
	echo $tuteur->nom." ".$tuteur->prenom;
} else {
	echo "<i>Non renseignÃ©</i>";
}
echo "<br />";

// ***************************************************************** //
// ***************************************************************** //
// Affichage des dÃ©clarations
// ***************************************************************** //
// ***************************************************************** //

$config_lea	= $formation->get_config_lea();
$les_periodes = $formation->get_periodes("entr_et_cfa", $acteur);

$tab_tmp = array();

//debug
//$tmp_count_cfa = 0;
//$tmp_count_entr = 0;

foreach($les_periodes as $une_periode) {
	if($une_periode->suivi_cfa == "1") {
		$mon_id_declaration = $apprenti->get_id_declaration($une_periode->id_periode, "cfa");
		if($mon_id_declaration > 0) {
			array_push($tab_tmp, $mon_id_declaration);
		}

	}
	if($une_periode->suivi_entr == "1") {
		$mon_id_declaration = $apprenti->get_id_declaration($une_periode->id_periode, "entr");
		if($mon_id_declaration > 0) {
			array_push($tab_tmp, $mon_id_declaration);
		}
	}
}

//debug
//echo "<br/><br/>On compte le nombre de d&eacute;claration &agrave; partir d'un truc stable :<br/>";
//echo $apprenti->get_num_declarations("cfa");
//echo "<br/>";
//echo $apprenti->get_num_declarations("entr");
//echo "<br/><br/>On verifie le truc pas stable :<br/>";
//echo $tmp_count_cfa;
//echo "<br/>";
//echo $tmp_count_entr;

foreach($tab_tmp as $une_declaration_id) {
	
	// CrÃ©ation de la dÃ©claration
	$declaration = new Declaration($une_declaration_id);
	$declaration->set_detail();

	$date_declaration = trans_date($declaration->date_dec);
	echo " ---------------------------------------------------------------------------------------------------------------<br />";
	echo " ---------------------------------------------------------------------------------------------------------------<br />";
	echo " la d&eacute;claration existe pour la p&eacute;riode id = ".$declaration->id_periode."<br />";
	echo " Date de la d&eacute;claration : ".$date_declaration."<br />";	
	echo " ".$declaration->type_suivi."<br />";	
	echo " ---------------------------------------------------------------------------------------------------------------<br />";
	echo " ---------------------------------------------------------------------------------------------------------------<br />";		
	
	$les_arbres = $config_lea->get_arbres($declaration->type_suivi);
	
	if(count($les_arbres) > 0 ) {
		foreach($les_arbres as $arbre){
			if($feuilles_declarees = $declaration->afficher_feuilles_declarees_pdf($arbre, $declaration->id_periode) ) {
				echo "<br /><br />-------- Feuilles d&eacute;clar&eacute;e ---------<br />";
				svM($feuilles_declarees);
			}											
		}
	}	
	
	if($tableau_modalites_suivi_libre = $declaration->afficher_tableau_modalites_suivi_libre_pdf($config_lea, $declaration->id_periode)) {
		// variable contenant le tableau_modalites_suivi_libres 
		// $tableau_modalites_suivi_libre;
		echo "<br /><br />-------- Modalit&eacute;s ---------<br />";
		svM($tableau_modalites_suivi_libre);
	}

	if ($fichiers_joints = $declaration->afficher_fichiers_joints_pdf()) {
		// variable contenant les fichiers joints
		// $fichiers_joints
		echo "<br /><br />-------- Fichiers joints ---------<br />";
		svM($fichiers_joints);
	}

	if($signatures = $declaration->afficher_signatures_pdf()) {
		// variable contenant les signatures
		// $signatures
		echo "<br /><br />-------- Signatures ---------<br />";
		svM($signatures);
	}
}

?>