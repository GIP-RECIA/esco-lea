<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 06/09/05
  // Contenu: Script de validation des  options de LEA.
/***********************************************************/
include_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
/***********************************************************/
$bdd = new Connexion_BDD_LEA();

$repertoireDestination = $LEA_REP."images/charte_graphique/";


if(isset($_FILES['LEA_LOGO_CFA']) || isset($_FILES['LEA_BACKGROUND_HEAD'])) {

	if(isset($_FILES['LEA_LOGO_CFA'])) {
						$attribut ='LEA_LOGO_CFA';
						$rep_img = $LEA_REP."images/default_logos/";
	}					
	else{
		 $attribut ='LEA_BACKGROUND_HEAD';
		 $rep_img = $LEA_REP."images/default_bandeaux/";
		 
	}	 


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

		 Afficher_msg_erreur(" Le fichier attaché n'est pas une image (jpg, jpeg, bmp, png, gif )  ");
	     Afficher_boutton_retour(); exit();
   }
	
			
				$dest = "";     			
				 
     		    if ($nom!="") $dest = $attribut.".".get_extension($nom); 											
			
				$filename = "$repertoireDestination".$_SESSION['options_lea'][$attribut];
					
				if ($_SESSION['options_lea'][$attribut]!="" && file_exists($filename) ) {
								
					unlink($filename);
				} 	
			 					
		     if  (move_uploaded_file($src, $repertoireDestination.$dest)) {  			 			    
		
			    $_SESSION['options_lea'][$attribut] = $dest;
					
				$bdd->update_option($attribut, to_sql($dest));
			 	copy($repertoireDestination.$dest, $rep_img.date("dmy-His").'.'.get_extension($dest)) ;
			 }

	}
}
elseif(isset($_REQUEST['THEME'])) {
														 
							$bdd->update_option("LEA_THEME", to_sql($_REQUEST['THEME']));
							$_SESSION['options_lea']['LEA_THEME'] = $_REQUEST['THEME'];

}

		  			 			 						 			
html_refresh("options.php?cmd=modif_options");

 ?>	
