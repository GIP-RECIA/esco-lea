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
require_once($LEA_REP."modele/bdd/classe_declaration.php");
require_once($LEA_REP."modele/bdd/classe_document_declare.php");
session_name("LEA_$RNE_ETAB");
session_start();
/**********************************************************/

$id_dec = $_REQUEST['id_dec'];

$declaration = new Declaration($id_dec);
$declaration->set_detail();
$apprenti = new Apprenti ($_SESSION['id_app']);

$config_lea = $apprenti->get_config_lea();


$les_arbres = $config_lea->get_arbres($declaration->type_suivi);

$les_modalites_suivi_libre = $config_lea->get_modalites($declaration->type_suivi, 'app', $declaration->id_periode);
  if($apprenti->modif_dec_ma)		// si l'apprenti est autorisé à valider les modalités de son maitre d'apprentissage
		$les_modalites_suivi_libre =array_merge($les_modalites_suivi_libre, $config_lea->get_modalites($declaration->type_suivi, 'ma', $declaration->id_periode) );

		
$_SESSION['declaration'] = $declaration;
$_SESSION['les_feuilles_declarees']= array();
$_SESSION['les_modalites_suivi_guide'] = array();

foreach ($les_arbres as $arbre ) {

	$les_id_noeud = $declaration->get_id_feuilles_declarees($arbre->id_arbre);
	
	$les_modalites_suivi_guide = $arbre->get_modalites('app', $declaration->id_periode);
	if($apprenti->modif_dec_ma)		// si l'apprenti est autorisé à valider les modalités de son maitre d'apprentissage
			$les_modalites_suivi_guide =array_merge($les_modalites_suivi_guide, $arbre->get_modalites('ma', $declaration->id_periode) );

	
	$_SESSION['les_feuilles_declarees'][$arbre->id_arbre] = $les_id_noeud ;
	 
	if(count($les_modalites_suivi_guide ) > 0 ) {  // l'apprenti a au moins une modalité à déclarer
	
	  foreach($les_id_noeud as $id_noeud) {

		foreach($les_modalites_suivi_guide as $modalite) {
		
			$classe = strtolower(get_class($modalite)); 
		
			if($classe == "modalite_va_unique" )
				$_SESSION['les_feuilles_modalite_va_unique'][$id_noeud][$modalite->id_modalite] 
				= $declaration->get_valeur_validee_modalite_va_unique($modalite->id_modalite, $id_noeud);					
		
			elseif($classe == "modalite_va_multiple" )
				$_SESSION['les_feuilles_modalite_va_multiple'][$id_noeud][$modalite->id_modalite] 
				= $declaration->get_id_choix_valides_modalite_va_multiple($modalite->id_modalite, $id_noeud);
		}	  
	
	  }

	}
}
	foreach($les_modalites_suivi_libre as $modalite) {
		
		$classe = strtolower(get_class($modalite)); 
		
		if($classe == "modalite_reponse_libre" )
			$_SESSION['les_modalites_rl'][$modalite->id_modalite] 
			= $declaration->get_texte_valide_modalite_reponse_libre($modalite->id_modalite);

		elseif($classe == "modalite_reponse_choix" )		
			$_SESSION['les_modalites_rc'][$modalite->id_modalite] 
			= $declaration->get_id_reponses_modalite_reponse_choix($modalite->id_modalite);
	}	  

	

html_refresh("livret.php?cmd=nouv_dec");

?>