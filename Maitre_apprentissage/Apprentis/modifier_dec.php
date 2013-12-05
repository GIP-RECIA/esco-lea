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
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
require_once($LEA_REP."modele/bdd/classe_declaration.php");
require_once($LEA_REP."modele/bdd/classe_document_declare.php");
session_start();
/**********************************************************/

$id_dec = $_REQUEST['id_dec'];

$declaration = new Declaration($id_dec);
$declaration->set_detail();

$apprenti = new Apprenti($declaration->id_app);

$config_lea = $apprenti->get_config_lea();

if($declaration->type_suivi=='entr') $arbre = $config_lea->get_arbre('ref_entr');
else $arbre = $config_lea->get_arbre('ref_cfa');

$les_modalites_suivi_guide = array_merge ($arbre->get_modalites('app'), $arbre->get_modalites('ma') );

$les_modalites_suivi_libre = array_merge ($config_lea->get_modalites($declaration->type_suivi, 'app'),
										  $config_lea->get_modalites($declaration->type_suivi, 'ma') );		

$_SESSION['declaration'] = $declaration;

$les_id_noeud = $declaration->get_id_feuilles_declarees();


if(count($les_modalites_suivi_guide ) > 0 ) {  // le maitre d'apprentissage a au moins une modalité à déclarer
	
	$_SESSION['les_id_noeud'] =  $les_id_noeud ;

  foreach($les_id_noeud as $id_noeud) {

	foreach($les_modalites_suivi_guide as $modalite) {
		
		$classe = get_class($modalite); 
		
		if($classe == "modalite_numerique_frequence" )
			$_SESSION['les_noeuds_modalites_nf'][$id_noeud][$modalite->id_modalite] 
			= $declaration->get_valeur_validee_modalite_frequence($modalite->id_modalite, $id_noeud);
		
		elseif($classe == "modalite_numerique_note" )	
			$_SESSION['les_noeuds_modalites_nn'][$id_noeud][$modalite->id_modalite] 
			= $declaration->get_valeur_validee_modalite_note($modalite->id_modalite, $id_noeud);
		
		elseif($classe == "modalite_multiple" )
			$_SESSION['les_noeuds_modalites_m'][$id_noeud][$modalite->id_modalite] 
			= $declaration->get_id_choix_valides_modalite_multiple($modalite->id_modalite, $id_noeud);
	}	  
	
  }

}

	foreach($les_modalites_suivi_libre as $modalite) {
		
		$classe = get_class($modalite); 
		
		if($classe == "modalite_reponse_libre" )
			$_SESSION['les_modalites_rl'][$modalite->id_modalite] 
			= $declaration->get_texte_valide_modalite_reponse_libre($modalite->id_modalite);

		elseif($classe == "modalite_reponse_choix" )		
			$_SESSION['les_modalites_rc'][$modalite->id_modalite] 
			= $declaration->get_id_reponses_modalite_reponse_choix($modalite->id_modalite);
	}	  

	

html_refresh("apprentis.php?cmd=modif_dec_ref");

?>