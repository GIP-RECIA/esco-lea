<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 06/09/05
  // Contenu: Script de validation de la mise à jour de la charte graphique 
/***********************************************************/
include_once("../../secure.php");

if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	  require_once("../../config/config.inc.php");
elseif	(file_exists("./../config/config.inc.php"))      require_once("./../config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
/***********************************************************/
$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];
$charte = $formation->get_charte_graphique();

if($charte->id_charte == 0){
	
	$charte->id_for = $formation->id_for; // création d'une nouvelle charte pour la formation
	$charte->insert();
}	

$repertoireDestination = $LEA_REP."images/charte_graphique/";

// $rep_img le répertoires des images par défaut

if(isset($_FILES['logo'])) {
		$attribut ='logo';
		$session_attr = 'LEA_LOGO_FORMATION';
		$rep_img = $LEA_REP."images/default_logos/";
}		
elseif(isset($_FILES['img_accueil'])) {
		 $attribut ='img_accueil';
		 $session_attr = 'LEA_IMAGE_ACCUEIL';		 
		 $rep_img = $LEA_REP."images/default_img_accueil/";
}		 
elseif(isset($_FILES['bandeau'])) {
		$attribut ='bandeau';
		$session_attr = 'LEA_BACKGROUND_HEAD';
		$rep_img = $LEA_REP."images/default_bandeaux/";
}		
elseif(isset($_FILES['logo_cfa'])) {
		 $attribut ='logo_cfa';
		 $session_attr = 'LEA_LOGO_CFA';
		 $rep_img = $LEA_REP."images/default_logos/";
}
elseif(isset($_REQUEST['theme'])){
		$charte->update('theme', to_sql($_REQUEST['theme']) );
		$_SESSION['options_lea']['LEA_THEME'] = $_REQUEST['theme'];
		html_refresh("../options.php?cmd=maj_charte_graphique");
}		 
else html_refresh("../options.php?cmd=maj_charte_graphique");


if( !$_FILES[$attribut]['error']) {

	$src = $_FILES[$attribut]['tmp_name']; 
	$nom = $_FILES[$attribut]['name']; // le nom de l'image téléchargée    	 
        			 
  // on vérifie maintenant l'extension
  
  $type_file = $_FILES[$attribut]['type'];

    if( !strstr($type_file, 'jpg') && 
	    !strstr($type_file, 'jpeg')&& 
		!strstr($type_file, 'bmp') && 
		!strstr($type_file, 'png') && 
		!strstr($type_file, 'gif') ){

		 Afficher_msg_erreur(" Le fichier n'est pas une image (jpg, jpeg, bmp, png, gif )  ");
	     Afficher_boutton_retour(); exit();
   }
	
	     	  		
	$filename = "$repertoireDestination".$_SESSION['options_lea'][$session_attr];			
			
			  
				$dest = ($formation->id_for)."_".$attribut.".".get_extension($nom); 											
						
			 //echo'coucou';
			 if (file_exists($filename) ) {
				
				$list_default_img = array('default_logo.gif', 'default_img_accueil.png',
										  'default_bandeau.jpg', 'default_logo_cfa.png'); 								
				
				if(! in_array($_SESSION['options_lea'][$session_attr], $list_default_img ))
					@unlink($filename);
			} 
							
		     if  (move_uploaded_file($src, $repertoireDestination.$dest)) {			 					
		
										    
				$_SESSION['options_lea'][$session_attr] = $dest;				
				
			 	$charte->update($attribut, to_sql($dest) );
				
				if(isset($_REQUEST['ajout_bib'])) // test si le l'usager veut ajouter le fichier joint à la bibliotheque des images
				copy($repertoireDestination.$dest, $rep_img.date("dmy-His").'.'.get_extension($dest)) ;
			 }

}
			  			 			 						 			
html_refresh("../options.php?cmd=maj_charte_graphique");

 ?>	
