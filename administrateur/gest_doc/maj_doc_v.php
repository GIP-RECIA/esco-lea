<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 11/08/05
  
/***********************************************************/

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_document_administratif.php");
/***********************************************************/
session_name("LEA_$RNE_ETAB");
session_start();

if(isset($_SESSION['id_admin'])) $id_usager =  $_SESSION['id_admin'];
elseif(isset($_SESSION['id_rvs'])) $id_usager =  $_SESSION['id_rvs'];
elseif(isset($_SESSION['id_ens'])) $id_usager =  $_SESSION['id_ens'];
else exit();

$id_doc = $_REQUEST['id_doc'];

$document = new Document_administratif($id_doc);
$document->set_detail();

$old_fichier_joint = $document->fichier_joint; // récupération du l'ancien nom du fichier joint.
	
	if( trim($_REQUEST['autre_categorie'])  != '')
		 $document->categorie = to_sql($_REQUEST['autre_categorie']);
	elseif(isset($_REQUEST['categorie'])) $document->categorie = to_sql($_REQUEST['categorie']);
	else $document->categorie ='';	
	
	$document->titre = to_sql($_REQUEST['titre']);
	$document->commentaire = to_sql($_REQUEST['commentaire']);		
	$document->id_usager = $id_usager;
	
	if(isset($_FILES['fichier_joint'])) { 
		
		$src = $_FILES['fichier_joint']['tmp_name']; // nom de fichier télechargé sur le tempo du serveur
		$nom = $_FILES['fichier_joint']['name'];

		//-------------------Ennregistrement des fichiers telechargés sur le serveur--------------------------------
   			$repertoireDestination = $LEA_REP."documents/documents_administratifs/";
			
			$filename = "$repertoireDestination"."$old_fichier_joint";
			
			if (file_exists($filename)&& $old_fichier_joint!="" && $nom!="") {
				unlink($filename);
			}
			$nb = date("dmy-His");  // la date et l'heure du système
			
                if(is_php($nom)) 
					 $dest = '$'.$nb.".".get_extension($nom).".txt" ; 
				else $dest = '$'.$nb.".".get_extension($nom)  ; // nom du fichier sur la base de données.					               								     		   
				           
		     if  (move_uploaded_file($src, $repertoireDestination.$dest))  			 
				 $document->fichier_joint = to_sql($dest);			 			 			 			 		
	}	
	
		//------------------- enregistrement de la formation sur la base de données ------------------
		
	if ($id_doc==0) $document->insert();	
	else $document->update();
	
if(isset($_SESSION['id_admin'])) $url_gest_doc =  $LEA_URL.'administrateur/gest_doc/';
elseif(isset($_SESSION['id_rvs'])) $url_gest_doc = $LEA_URL.'Responsable_vie_scolaire/gest_doc/';
elseif(isset($_SESSION['id_ens'])) $url_gest_doc = $LEA_URL.'Enseignant/gest_doc/';
else exit();

html_refresh($url_gest_doc."gest_doc.php?cmd=cons_doc&categorie=$document->categorie");
 
?>