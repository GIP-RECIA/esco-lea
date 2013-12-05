<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
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
require_once($LEA_REP."modele/bdd/classe_categorie_document.php");
/***********************************************************/
session_name("LEA_$RNE_ETAB");
session_start();

if(isset($_SESSION['id_ens'])) ;
else exit();

	
	if(isset($_FILES['fichier_joint'])) { 
		
		$id_doc = $_REQUEST['id_doc'];

		$document = new Document_administratif($id_doc);
		$document->set_detail();

		$old_fichier_joint = $document->fichier_joint; // rï¿½cupï¿½ration du l'ancien nom du fichier joint.
		
		$document->id_categ = to_sql($_REQUEST['id_categ']);	
		$document->titre = to_sql($_REQUEST['titre']);
		$document->commentaire = to_sql($_REQUEST['commentaire']);			

		$src = $_FILES['fichier_joint']['tmp_name']; // nom de fichier tï¿½lechargï¿½ sur le tempo du serveur
		$nom = $_FILES['fichier_joint']['name'];

		//-------------------Ennregistrement des fichiers telechargï¿½s sur le serveur--------------------------------
   			$repertoireDestination = $LEA_REP."documents/documents_administratifs/";
			
			$filename = "$repertoireDestination"."$old_fichier_joint";
			
			if (file_exists($filename)&& $old_fichier_joint!="" && $nom!="") {
				unlink($filename);
			}
			$nb = date("dmy-His");  // la date et l'heure du systï¿½me
			
                if(is_php($nom)) 
					 $dest = '$'.$nb.".".get_extension($nom).".txt" ; 
				else $dest = '$'.$nb.".".get_extension($nom)  ; // nom du fichier sur la base de donnï¿½es.					               								     		   
				           
		     if  (move_uploaded_file($src, $repertoireDestination.$dest))  {			 
				 $document->fichier_joint = to_sql($dest);
				
			 }
			
	} 
	else{ 
		afficher_boutton_retour();
		echo(" <br> Ce fichier ne peut &ecirc;tre t&eacute;l&eacute;charg&eacute; : La taille du fichier joint ne doit pas d&eacute;passer 8M");
		
		exit();
		 
	
	}	
	
		//------------------- enregistrement du document dans la base de donnï¿½es ------------------
		
	if ($id_doc == 0) $document->insert();	
	else $document->update();

$categorie = new Categorie_document($document->id_categ);
$categorie->set_detail();
	
if(isset($_SESSION['id_ens'])) $url_gest_doc = $LEA_URL.'Enseignant/gest_doc/';
else exit();

html_refresh($url_gest_doc."gest_doc.php?cmd=cons_doc&id_categ=$document->id_categ");
 
?>