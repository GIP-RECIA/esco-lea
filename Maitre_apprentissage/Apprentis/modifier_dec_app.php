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

include_once($LEA_REP."Maitre_apprentissage/secure.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_declaration.php");
require_once($LEA_REP."modele/bdd/classe_document_declare.php");
/**********************************************************/

$id_dec = $_REQUEST['id_dec'];

$ma = new Maitre_apprentissage($_SESSION['id_ma']);

$declaration = new Declaration($id_dec);
$declaration->set_detail();

if($id_dec == 0){ // il s'agit d'une nouvelle déclaration
	$declaration->id_periode = $_REQUEST['id_periode'];
	$declaration->id_app = $_REQUEST['id_app'];
	$declaration->type_suivi = $_REQUEST['type_suivi'];
}


$apprenti = new Apprenti ($declaration->id_app);
$apprenti->set_detail();

$config_lea = $apprenti->get_config_lea();

$les_arbres = $config_lea->get_arbres($declaration->type_suivi);


$les_modalites_suivi_libre_app = array();//$config_lea->get_modalites($declaration->type_suivi, 'app', $declaration->id_periode);
$les_modalites_suivi_libre_ma = $config_lea->get_modalites($declaration->type_suivi, 'ma', $declaration->id_periode);

$les_modalites_suivi_libre = array_merge(
$les_modalites_suivi_libre_app,
$les_modalites_suivi_libre_ma
);

$_SESSION['les_modalites_suivi_libre'] = $les_modalites_suivi_libre;

$_SESSION['declaration'] = $declaration;
$_SESSION['les_feuilles_declarees']= array();
$_SESSION['les_modalites_suivi_guide'] = array();

foreach ($les_arbres as $arbre ) {

	$les_id_noeud = $declaration->get_id_feuilles_declarees($arbre->id_arbre);

	$les_modalites_suivi_guide_app = array();//$arbre->get_modalites('app', $declaration->id_periode);
	$les_modalites_suivi_guide_ma = $arbre->get_modalites('ma', $declaration->id_periode);

	$les_modalites_suivi = array_merge($les_modalites_suivi_guide_app, $les_modalites_suivi_guide_ma);

	$_SESSION['les_modalites_suivi_guide'][$arbre->id_arbre] = $les_modalites_suivi;

	$_SESSION['les_feuilles_declarees'][$arbre->id_arbre] = $les_id_noeud ;

	if(count($les_modalites_suivi ) > 0 ) {
		foreach($les_id_noeud as $id_noeud) {
			foreach($les_modalites_suivi as $modalite) {
				$classe = strtolower(get_class($modalite));
				if($classe == "modalite_va_unique" ) {
					$_SESSION['les_feuilles_modalite_va_unique'][$id_noeud][$modalite->id_modalite] = $declaration->get_valeur_validee_modalite_va_unique($modalite->id_modalite, $id_noeud);
				}
				elseif($classe == "modalite_va_multiple" ) {
					$_SESSION['les_feuilles_modalite_va_multiple'][$id_noeud][$modalite->id_modalite] = $declaration->get_id_choix_valides_modalite_va_multiple($modalite->id_modalite, $id_noeud);
				}
			}

		}
	}
}


foreach($les_modalites_suivi_libre as $modalite) {

	$classe = strtolower(get_class($modalite));

	if($classe == "modalite_reponse_libre" ) {
		$_SESSION['les_modalites_rl'][$modalite->id_modalite] = $declaration->get_texte_valide_modalite_reponse_libre($modalite->id_modalite);
	}
	elseif($classe == "modalite_reponse_choix" ) {
		$_SESSION['les_modalites_rc'][$modalite->id_modalite] = $declaration->get_id_reponses_modalite_reponse_choix($modalite->id_modalite);
	}
}

html_refresh("apprentis.php?cmd=nouv_dec_app");

?>
