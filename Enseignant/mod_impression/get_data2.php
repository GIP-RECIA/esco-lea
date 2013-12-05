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
require_once($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_entreprise.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_maitre_apprentissage.php");
require_once($LEA_REP."modele/bdd/classe_declaration.php");
require_once($LEA_REP."modele/classe_declaration_vierge.php");

function existe_t_il_une_Declaration($f_id_app, $f_id_periode, $f_type_suivi_periode) {
	$bdd_func = new Connexion_BDD_LEA();
	
	$sql = "SELECT id_dec
			FROM les_declarations
			WHERE id_app = '".$f_id_app."' and id_periode = '".$f_id_periode."' and type_suivi = '".$f_type_suivi_periode."'";

	$result = $bdd_func->executer($sql);		
	
	if ($ligne = mysql_fetch_assoc($result)) {
	  	return $ligne["id_dec"];
	} else {
		return 0;	
	}
}
$tep = unserialize($_SESSION["imp_apprenti"]);
//Instanciation d'un apprenti
$apprenti = new Apprenti($tep[0]);
$apprenti->set_detail();

// $apprenti->adresse
// $apprenti->nom
// $apprenti->prenom

// Instanciation de la classe de l'apprenti
$classe = new Classe($apprenti->id_cla);
$classe->set_detail();

// $classe->libelle

// Instanciation de la formation de l'apprenti
$formation = new Formation($_SESSION['id_for']);
$formation->set_detail();

// $formation->nom

// Instanciation d'un MA de l'apprenti
$ma = new Maitre_apprentissage($apprenti->id_ma);
$ma->set_detail();

// $ma->nom

// Instanciation de l'entreprise du MA
$entreprise = new Entreprise($ma->id_entr);
$entreprise->set_detail();

// $entreprise->nom

// Instanciation du tuteur CFA
$tuteur = new Enseignant($apprenti->id_ens);
$tuteur->set_detail();

// $tuteur->nom
// $tuteur->prenom

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
	echo "<i>Non renseign&eacude</i>";
}

echo "<br /><strong>Nom entreprise :</strong><br />";
echo $entreprise->nom;

echo "<br /><strong>Tuteur CFA (nom prenom) :</strong><br />";
if($apprenti->id_ens > 0) {
	echo $tuteur->nom." ".$tuteur->prenom;
} else {
	echo "<i>Non renseign&eacude</i>";
}

if($_SESSION['imp_type_formulaire'] != "vierge") {
	// la tu met les noms et prÃ©noms
} else {
	// ici tu ne met aucune donnÃ©e nominative, car on imprime du vierge
}

// ***************************************************************** //
// ***************************************************************** //
// Affichage des pÃ©riodes
// ***************************************************************** //
// ***************************************************************** //
$config_lea	= $formation->get_config_lea();

if($_SESSION["imp_type_livret"] == "periodes") {
	//on extrait tout de la variable session
	$tab_tmp = (isset($_SESSION["imp_periode"])) ? unserialize($_SESSION["imp_periode"]) : array();
	
	foreach($tab_tmp as $une_periode_et_suivi) {
		
		list($une_periode_id, $une_periode_type_suivi) = explode(":", $une_periode_et_suivi);

		if($_SESSION['imp_type_formulaire'] != "vierge") {
			// on check si une dÃ©claration existe
			$id_declaration = existe_t_il_une_Declaration($apprenti->id_app, $une_periode_id, $une_periode_type_suivi);
		} else {
			// on simule la "non-existance d'une dÃ©claration
			// puuisqu'on souhaite imprimer des pÃ©riodes vierges
			$id_declaration = 0;
		}
		
		// la dÃ©claration existe
		if($id_declaration > 0) {
		
			// CrÃ©ation de la dÃ©claration
			$declaration = new Declaration($id_declaration);
			$declaration->set_detail();
			
			echo "<div  style=\"background-color: #EEEEEE;\">";
			echo "<div  style=\"background-color: #FFF000;\">";
			
			$date_declaration = trans_date($declaration->date_dec);
			echo " ---------------------------------------------------------------------------------------------------------------<br />";
			echo " ---------------------------------------------------------------------------------------------------------------<br />";
			echo " la d&eacute;claration existe pour la p&eacute;riode id = ".$une_periode_id."<br />";
			echo " Date de la d&eacute;claration : ".$date_declaration."<br />";	
			echo " ".$une_periode_type_suivi."<br />";	
			echo " ---------------------------------------------------------------------------------------------------------------<br />";
			echo " ---------------------------------------------------------------------------------------------------------------<br />";
			
			echo "</div>";
			
			$les_arbres = $config_lea->get_arbres($declaration->type_suivi);
			
			echo "<br /><br />-------- Suivi guid&eacute; ---------<br />";
			foreach($les_arbres as $arbre){
				if($feuilles_declarees = $declaration->afficher_feuilles_declarees_pdf($arbre, $declaration->id_periode) ) {
					// variable contenant les feuilles dÃ©clarÃ©es 
					// $feuilles_declarees;									
					svM($feuilles_declarees);
				}											
			}	
			
			echo "<br /><br />-------- Suivi libre ---------<br />";
			if($tableau_modalites_suivi_libre = $declaration->afficher_tableau_modalites_suivi_libre_pdf($config_lea, $declaration->id_periode)) {
				// variable contenant le tableau_modalites_suivi_libres 
				// $tableau_modalites_suivi_libre;
				svM($tableau_modalites_suivi_libre);
			}	

			echo "<br /><br />-------- Fichiers joints ---------<br />";
			if($fichiers_joints = $declaration->afficher_fichiers_joints_pdf()) {
				$detail_declaration = 1;
				// variable contenant les fichiers joints
				// $fichiers_joints
				svM($fichiers_joints);
			}

			echo "<br /><br />-------- Signatures ---------<br />";
			if($signatures = $declaration->afficher_signatures_pdf()) {
				svM($signatures);
			}
			
			echo "</div>";
			
		} else {
			
			echo "<div  style=\"background-color: #EEEEEE;\">";
			echo "<div  style=\"background-color: #000FFF;\">";
			
			echo " ---------------------------------------------------------------------------------------------------------------<br />";
			echo " ---------------------------------------------------------------------------------------------------------------<br />";
			echo " la d&eacute;claration n'existe pas pour la p&eacute;riode id = ".$une_periode_id."<br />";
			echo " Date de la d&eacute;claration : <i>Pas encore d&eacute;clar&eacute;e</i><br />";
			echo " ".$une_periode_type_suivi."<br />";					
			echo " ---------------------------------------------------------------------------------------------------------------<br />";
			echo " ---------------------------------------------------------------------------------------------------------------<br />";
			
			echo "</div>";
			
			$declaration = new Declaration(0);
			$declaration->set_detail();
			
			$declaration->id_periode = $une_periode_id;
			$declaration->type_suivi = $une_periode_type_suivi;
			
			$config_lea = $apprenti->get_config_lea();
			$les_arbres = $config_lea->get_arbres($declaration->type_suivi);
			
			$declaration_vierge = new declaration_vierge($declaration);	
			
			echo "<br /><br />-------- Suivi guid&eacute; ---------<br />";
			foreach($les_arbres as $arbre) {
				svM($declaration_vierge->tableau_modalites_suivi_guide($arbre, $une_periode_id));
			}
			
			echo "<br /><br />-------- Suivi libre ---------<br />";
			svM($declaration_vierge->tableau_modalites_suivi_libre($config_lea));
			
			echo "<br /><br />-------- Signatures de cette dÃ©claration ---------<br />";			
			svM($declaration->afficher_signatures_pdf());
			echo "</div>";
		}
	}
}

debug();

?>