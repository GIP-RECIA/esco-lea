<?
// Copyright © 2005-2006 
// CFA des 3 villes
// Web: www.cfa3villes.com.
// Auteur : Faouzi AMIER
// Version : 1.0
// Date: 10/08/05
// Contenu:   Ce script permet au responsable d'une formation de sélectionner une image d'accueil 
//           pour la formation
/***********************************************************/
if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	  require_once("../../config/config.inc.php");
elseif	(file_exists("./../config/config.inc.php"))      require_once("../config/config.inc.php");
session_name("LEA_$RNE_ETAB");
session_start();

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
//-----------------------------------------------------------------------------------

$type_img = $_REQUEST['type_img'];

if($type_img=='logo') {
	$rep_img = $LEA_REP."images/default_logos/";
	$url_img = $LEA_URL."images/default_logos/";

}
elseif($type_img=='img_accueil'){
	$rep_img = $LEA_REP."images/default_img_accueil/";
	$url_img = $LEA_URL."images/default_img_accueil/";

}
elseif($type_img=='bandeau') {
	$rep_img = $LEA_REP."images/default_bandeaux/";
	$url_img = $LEA_URL."images/default_bandeaux/";

}
else exit();

if(isset($_REQUEST['name_img_delete']) ) {

	$name_img_delete = $_REQUEST['name_img_delete'];

	foreach($name_img_delete as $name){
		$filename = $rep_img.$name;
		@unlink($filename);
	}
}
elseif(isset($_FILES['new_image'])){

	if( !$_FILES['new_image']['error']) {

		$src = $_FILES['new_image']['tmp_name'];
		$nom = $_FILES['new_image']['name']; // le nom de l'image téléchargée

		// on vérifie maintenant l'extension

		$type_file = $_FILES['new_image']['type'];

		if( !strstr($type_file, 'jpg') &&
		!strstr($type_file, 'jpeg')&&
		!strstr($type_file, 'bmp') &&
		!strstr($type_file, 'png') &&
		!strstr($type_file, 'gif') ){

			Afficher_msg_erreur(" Le fichier n'est pas une image (jpg, jpeg, bmp, png, gif )  ");
			Afficher_boutton_retour(); exit();
		}
		$dest = $rep_img.date("dmy-His").".".get_extension($nom);
		move_uploaded_file($src, $dest);

	}

}

$files = array();

$rep = opendir($rep_img);

while ($file = readdir($rep)){
	if($file != '..' && $file !='.' && $file !=''){
		if (!is_dir($file)){
			$files[] = $file;

		}
	}
}

closedir($rep);
clearstatcache();

?>

<html>
<head>
<title>S&eacute;lection d'un écran d'accueil</title>
<link rel="stylesheet" type="text/css"
	href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'administrateur.css');?>"
	media="screen" />
<script language="JavaScript" type="text/javascript"
	src="../../javascript/stdlib.js">
     </script>
</head>
<body>
<div id="contenu"><span><?php afficher_boutton_fermer();?></span> <?php  	
if(($nb = count($files)) > 0 ){
	echo"		<form method=\"post\" action=\"\" onSubmit=\"return deleteConfirm('les images sélectionnées')\">
					<input type=\"hidden\" name=\"type_img\" value=\"$type_img\">
				<table>
					<tr>
						<th colspan=\"5\">
							Cochez les images &agrave; supprimer
						</th>
					</tr>
				";
	$nb_lignes =  ceil($nb/5);
	$k = 0;
	for($i=1; $i<= $nb_lignes; $i++){
		echo"<tr>";
		for($j=1; $j <= 5; $j++){

			if(isset($files[$k])) {
				$file = $files[$k];
				echo"<td>";
				echo"	<div id=\"$file\" >";
				echo"		<input type=\"checkbox\" name=\"name_img_delete[]\" value=\"$file\"
											onClick=\"(document.getElementById('$file')).class='selected'\"
										 >";

				echo"		<br>";
				echo"		<img src=\"". $url_img.urlencode ($file)."\"  class=\"imggrand\" border=\"0\" />\n";
				echo"	</div>";
				echo"</td>";
			}
			else {
				echo"<td>&nbsp;</td>";  	  		   
			}
			$k++;
		}
		echo"</tr>";
			
	}
	echo"<tr>
		 	<th colspan=\"5\">
				<br>
				<input type=\"submit\" value=\"Supprimer les images cochées\" >
			</th>
		 <tr>";	 
	echo"</table>
		</form>";
}else afficher_msg_erreur("D&eacute;sol&eacute; ! : Aucune images enregistr&eacute;");
?>
<form action='' method='post' enctype="multipart/form-data">
	<p><input name="type_img" value="<?php echo"$type_img"?>" type="hidden">Ajouter une nouvelle image</p>
	<p><input type="file" name="new_image"> <input type="submit" name="Submit" value="Ajouter"></p>
</form>

</div>

</body>
</html>
