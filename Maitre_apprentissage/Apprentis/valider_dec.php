<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 18/04/06

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


// les_modalites_rl : tableau   contenant les textes saisis pour valider  les  modalités à Réponse Libre
// les_modalites_rc : tableau contenant les identifiants des réponses sélectionnés pour valider  les  modalités à Réponse multiple(au Choix)

if(isset($_REQUEST['les_modalites_rl'])) $_SESSION['les_modalites_rl'] = $_REQUEST['les_modalites_rl'];
if(isset($_REQUEST['les_modalites_rc'])) $_SESSION['les_modalites_rc'] = $_REQUEST['les_modalites_rc'];

$declaration = $_SESSION['declaration'];


$periode = new Periode ($_SESSION['declaration']->id_periode);
$periode->set_detail();

$apprenti = new Apprenti($declaration->id_app);
$apprenti->set_detail();

$config_lea = $apprenti->get_config_lea();

$declaration->etat = "nv"; // non vérrouilée		

$declaration->update();

$_SESSION['declaration'] = $declaration; 

	//-------------------Ennregistrement du fichier telechargé sur le serveur--------
		// Pour distinguer deux fichiers téléchargés portant le même nom, 
        // le nom de fichier teléchargé qui sera stocké physiquemnt dans le répertoirDestination
	    // est  composé de de 3 parties. partie1: la lettre f, partie2: la date et l'heur du système,
	    //  partie 3: le nom sur fichier telechrgé su le poste client.
	if(isset($_FILES['fichier'])) {
			 $src = $_FILES['fichier']['tmp_name']; // nom de nouvau fichier télechargé sur le tempo de serveur
			 $nom = $_FILES['fichier']['name'];// nom  de nouvau fichier télechargé sur le poste client						 
			
    		
                $dest = "";		
                				
				$nb = date("dmy-His");  // la date et l'heure du système
     		    if ($nom!=""){ 
				$dest = $nb."_".$nom; 
				
				if ( is_php($dest) ) 	$dest.=".txt"; // protection des fichiers d'extention .php pou .inc
				
				}
				
			if(isset($_REQUEST['confidentialite'])) $confidentialite = 1;
			else $confidentialite = 0;
			 	
			if  (move_uploaded_file($src, $SRC_DOCUMENTS_DECLARES.$dest)) { 						 		 		 		
				if ($dest!=""){                 
					$dest = to_sql($dest);
					$document = new Document_declare(0);
					$document->src_doc = $dest;
					$document->confidentialite = $confidentialite;
					$document->id_dec = $declaration->id_dec ;		
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

if(isset($_SESSION['les_id_noeud'])){
 
 $les_id_noeud = $_SESSION['les_id_noeud'];

	$declaration->update_feuilles_declarees( $les_id_noeud );	 
 
} 

// enregistrement des modalités utilsées pour le suivi guidé

// --------- enregistrement des valeurs saisies pour valider  les feuilles sélectionnées avec les modalités numériques frequence -------------

if(isset($_SESSION['les_noeuds_modalites_nf'])){
 
 $les_noeuds_modalites_nf = $_SESSION['les_noeuds_modalites_nf'];

 foreach($les_noeuds_modalites_nf as $id_noeud => $les_modalites ){
 	
	foreach($les_modalites as $id_modalite => $valeur) {
	
	$declaration->validation_feuille_mod_num_freq($id_noeud, $id_modalite, to_sql($valeur));	
	}
 
 }
} 
 // --------- enregistrement des valeurs saisies pour valider les feuilles sélectionnées avec les modalités numériques note -------------

if(isset($_SESSION['les_noeuds_modalites_nn'])){ 
 
 $les_noeuds_modalites_nn = $_SESSION['les_noeuds_modalites_nn'];

 foreach($les_noeuds_modalites_nn as $id_noeud => $les_modalites ){
 	
	foreach($les_modalites as $id_modalite => $valeur) {
	
	$declaration->validation_feuille_mod_num_note($id_noeud, $id_modalite, to_sql($valeur));	
	}
 
 }
 
} 

 // --------- enregistrement des choix séléctionnés  pour valider les feuilles sélectionnées avec les modalités à choix multiple   -------------

if(isset($_SESSION['les_noeuds_modalites_m'])){
 
 $les_noeuds_modalites_m = $_SESSION['les_noeuds_modalites_m'];

 foreach($les_noeuds_modalites_m as $id_noeud => $les_modalites ){
 	
	foreach($les_modalites as $id_modalite => $les_id_choix) {
	
		if(count($les_id_choix) > 0) $declaration->validation_feuille_mod_choix($id_noeud, $id_modalite, $les_id_choix);
			
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


$_SESSION['declaration'] = NULL;
$_SESSION['les_id_noeud'] = NULL;
$_SESSION['les_noeuds_modalites_nf'] = NULL;
$_SESSION['les_noeuds_modalites_nn'] = NULL;
$_SESSION['les_noeuds_modalites_m'] = NULL;
$_SESSION['les_modalites_rl'] = NULL;
$_SESSION['les_modalites_rc'] = NULL;

$type_suivi = $declaration->type_suivi;

html_refresh("apprentis.php?cmd=cons_dec&id_app_select=$declaration->id_app&type_suivi=$type_suivi&id_periode=$declaration->id_periode");
?>