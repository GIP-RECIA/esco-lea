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

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
/***********************************************************/
session_name("LEA_$RNE_ETAB");
session_start();

if (isset($_SESSION['id_admin']))   $id_usager   = $_SESSION['id_admin'];
elseif (isset($_SESSION['id_rvs'])) $id_usager = $_SESSION['id_rvs'];
elseif (isset($_SESSION['id_ens'])) $id_usager = $_SESSION['id_ens'];
elseif (isset($_SESSION['id_app'])) $id_usager = $_SESSION['id_app'];
elseif (isset($_SESSION['id_ma']))  $id_usager  = $_SESSION['id_ma'];
elseif (isset($_SESSION['id_rl']))  $id_usager  = $_SESSION['id_rl'];
else html_refresh($LEA_URL);

$usager = new Usager($id_usager);

$repertoireDestination = $LEA_REP."images/img_accueil/";

if(isset($_FILES['img_accueil'])) $attribut ='img_accueil';
else exit();


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

	 
	$filename = "$repertoireDestination".$_SESSION['charte_graphique'][$attribut];
		
		
	$dest="";
		
	if ($nom!="") $dest = '$_'.$id_usager.'.'.get_extension($nom);

	if (file_exists($filename) ) {

		unlink($filename);
	}
	 
	if  (move_uploaded_file($src, $repertoireDestination.$dest)) {
		 
		$_SESSION['charte_graphique'][$attribut]= $dest;
			
		$usager->update_attribut($attribut, to_sql($dest));

	}

}

echo("
	<script language='javascript'> 
		window.opener.location.reload(); 
		window.close();
	</script>
	");

?>
