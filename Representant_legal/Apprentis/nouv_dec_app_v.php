<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 18/05/06

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

$periode = new Periode ($_SESSION['declaration']->id_periode);
$periode->set_detail();

$apprenti = new Apprenti($_SESSION['declaration']->id_app );
$config_lea = $apprenti->get_config_lea();


// les valeurs des feuilles déclarées

if(isset($_REQUEST['les_feuilles_modalite_va_unique']))   $_SESSION['les_feuilles_modalite_va_unique'] = $_REQUEST['les_feuilles_modalite_va_unique'];
if(isset($_REQUEST['les_feuilles_modalite_va_multiple'])) $_SESSION['les_feuilles_modalite_va_multiple'] = $_REQUEST['les_feuilles_modalite_va_multiple'];


// les_modalites_rl : tableau   contenant les textes saisis pour valider  les  modalités à Réponse Libre
// les_modalites_rc : tableau contenant les identifiants des réponses sélectionnés pour valider  les  modalités à Réponse choix 

if(isset($_REQUEST['les_modalites_rl'])) $_SESSION['les_modalites_rl'] = $_REQUEST['les_modalites_rl'];
if(isset($_REQUEST['les_modalites_rc'])) $_SESSION['les_modalites_rc'] = $_REQUEST['les_modalites_rc'];

if(isset($_SESSION['declaration']))
	$declaration = $_SESSION['declaration'];
else exit();	

//print_r($_SESSION)		;

if($declaration->id_dec > 0 ) $declaration->update();  // la déclaration est modifiée
else $declaration->insert();

$_SESSION['declaration'] = $declaration; 

	//-------------------Ennregistrement du fichier telechargé sur le serveur--------

	if(isset($_FILES['fichier'])) {
			 $src = $_FILES['fichier']['tmp_name']; // nom du nouvau fichier télechargé sur le tempo de serveur
			 $nom = $_FILES['fichier']['name'];// nom  du nouvau fichier télechargé sur le poste client 
             $dest = "";		
     		 if ($nom!=""){ 
                 $dest = $nom; 
                 if ( is_php($dest) ) 	$dest.=".txt"; // protection des fichiers d'extention .php pou .inc
			 }
		     $dest = changer_nom_fichier($dest); 
		     $dest = prefixer_date($dest); 
				
			if(isset($_REQUEST['confidentialite'])) $confidentialite = 1;
			else $confidentialite = 0;
			 	
			if  (move_uploaded_file($src, $SRC_DOCUMENTS_DECLARES.$dest)) { 						 		 		 		
				if ($dest!=""){                 
					$dest = to_sql($dest);
					$document = new Document_declare(0);
					$document->src_doc = $dest;
					$document->confidentialite = $confidentialite;
					$document->id_dec = $declaration->id_dec ;
					$document->id_usager = $_SESSION['id_rl'] ;				
					$document->insert(); 										
				}	
			}
	}	

// --------- Mise de la confidentialité des fichiers  -------------

if(isset($_REQUEST['files_modif']))
 $files_modif = $_REQUEST['files_modif'];
else  $files_modif = array();
 
 $documents_declares = $declaration->get_documents_declares();
 
 foreach( $documents_declares as $document){ 
 	
	if(in_array($document->id_doc, $files_modif) )
		 $confidentialite = 1;
	else $confidentialite = 0;	
	
	$document->confidentialite = $confidentialite;
	$document->update(); 
 }
 

// --------- enregistrement des des feuilles sélectionnées -------------

if(isset($_SESSION['les_feuilles_declarees'])){
 
 $les_feuilles_declarees = $_SESSION['les_feuilles_declarees'];
	
	$les_id_noeud = array();
	
	foreach($les_feuilles_declarees as $id_arbre => $les_id_feuilles){
		
		$les_id_noeud = array_merge($les_id_noeud, $les_id_feuilles);
	}
	$declaration->update_feuilles_declarees( $les_id_noeud );	 
 
} 

// enregistrement des modalités utilsées pour le suivi guidé

// --------- enregistrement des valeurs saisies pour valider  les feuilles déclarrée avec les modalités à unique réponse -------------

if(isset($_SESSION['les_feuilles_modalite_va_unique'])){
 
 $les_feuilles_modalite_va_unique = $_SESSION['les_feuilles_modalite_va_unique'];

 foreach($les_feuilles_modalite_va_unique as $id_noeud => $les_modalites ){
 	
	foreach($les_modalites as $id_modalite => $valeur) {
	
	$declaration->validation_feuille_modalite_va_unique($id_noeud, $id_modalite, to_sql($valeur));	
	}
 
 }
} 
 
 // --------- enregistrement des choix séléctionnés  pour valider les feuilles sélectionnées avec les modalités à choix multiple   -------------

if(isset($_SESSION['les_feuilles_modalite_va_multiple'])){
 
 $les_feuilles_modalite_va_multiple = $_SESSION['les_feuilles_modalite_va_multiple'];

 foreach($les_feuilles_modalite_va_multiple as $id_noeud => $les_modalites ){
 	
	foreach($les_modalites as $id_modalite => $les_id_choix) { 
	
		if(count($les_id_choix) > 0) {
			 $declaration->validation_feuille_modalite_va_multiple($id_noeud, $id_modalite, $les_id_choix);
			 
		}	 
			
	}
 
 }
 
} 

 // enregistrement des modalités utilsées pour le suivi libre

 // --------- enregistrement  des textes saisis pour valider les modalités à réponse libre  -------------

if(isset($_SESSION['les_modalites_rl'])){
 
 $les_modalites_rl = $_SESSION['les_modalites_rl'];

 foreach($les_modalites_rl as $id_modalite => $txt ){
 
	$declaration->validation_mod_rep_libre($id_modalite, to_sql($txt));	

 }
 
} 

// --------- enregistrement des choix séléctionnés pour valider les modalités à plusieurs réponses  -------------

if(isset($_SESSION['les_modalites_rc'])){
 
 $les_modalites_rc = $_SESSION['les_modalites_rc'];

 foreach($les_modalites_rc as $id_modalite => $les_id_reponse ){
 		 
		if(count($les_id_reponse) > 0 ) $declaration->validation_mod_rep_choix($id_modalite, $les_id_reponse);		

 }
 
} 

$type_suivi = $declaration->type_suivi;

html_refresh("apprentis.php?cmd=cons_dec_app&type_suivi=$type_suivi&id_periode=$declaration->id_periode&id_app_select=$declaration->id_app");

?>
