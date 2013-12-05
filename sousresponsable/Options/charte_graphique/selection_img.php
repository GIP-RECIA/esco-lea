<?php 
 // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 10/08/05
  // Contenu:   Ce script permet au responsable d'une formation de sï¿½lectionner une images dans une liste d'images 
  //			proposï¿½es 
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

$formation = new Formation($_SESSION['id_for']);
$formation->nom = $_SESSION['nom_formation'];
$charte = $formation->get_charte_graphique();

if($charte->id_charte == 0){
	
	$charte->id_for = $formation->id_for; // crï¿½ation d'une nouvelle charte pour la formation
	$charte->insert();
}

$type_img = $_REQUEST['type_img'];

if($type_img=='logo') {
	$rep_img = $LEA_REP."images/default_logos/";
	$url_img = $LEA_URL."images/default_logos/";  
	$rep_charte = $LEA_REP."images/charte_graphique/";
	$session_attr = 'LEA_LOGO_FORMATION';
}
elseif($type_img=='img_accueil'){
	$rep_img = $LEA_REP."images/default_img_accueil/"; 
	$url_img = $LEA_URL."images/default_img_accueil/"; 
	$rep_charte = $LEA_REP."images/charte_graphique/";
	$session_attr = 'LEA_IMAGE_ACCUEIL';
}
elseif($type_img=='bandeau') {
	$rep_img = $LEA_REP."images/default_bandeaux/"; 
	$url_img = $LEA_URL."images/default_bandeaux/"; 
	$rep_charte = $LEA_REP."images/charte_graphique/";
	$session_attr = 'LEA_BACKGROUND_HEAD';
}
elseif($type_img=='logo_cfa') {
	$rep_img = $LEA_REP."images/default_logos/";
	$url_img = $LEA_URL."images/default_logos/";
	$rep_charte = $LEA_REP."images/charte_graphique/";
	$session_attr = 'LEA_LOGO_CFA';
}
else exit();	

if(isset($_REQUEST['file']) ) {

	$file = $_REQUEST['file']; 
	
	$file_copy = ($formation->id_for)."_".$type_img.".".get_extension($file);
		
	
		// supression de l'ancienne image
		 
		$filename = $rep_charte.$_SESSION['options_lea'][$session_attr]; 
		
    	if (file_exists($filename) ){ 
				
				$list_default_img = array('default_logo.gif', 'default_img_accueil.png',
										  'default_bandeau.jpg', 'default_logo_cfa.png'); 
				
				if(! in_array($_SESSION['options_lea'][$session_attr], $list_default_img ))
					@unlink($filename);				
		}
	
	
	if (copy($rep_img.$file, $rep_charte.$file_copy) ){ 
				
			    $_SESSION['options_lea'][$session_attr] = $file_copy;
				
			 	$charte->update($type_img, to_sql($file_copy) );
				echo" 
					<script langage='javascript'>
						window.opener.location.reload();
						window.close();
					</script>					
					";
				exit();	
				
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
		<title>S&eacute;lection d'un &eacute;cran d'accueil</title>
		<link rel="stylesheet" type="text/css" 
			href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'enseignant.css');?>" 
			media="screen" />
		
	</head>
<body>
	<div id="contenu">
		
		<span><?php afficher_boutton_fermer();?></span>
		<p>S&eacute;lectionnez une image</p>
		<?php  	
			 if(($nb = count($files)) > 0 ){
			 	echo"<table>";
				$nb_ligne =  ceil($nb/5);
				$k = 0;
				for($i=1; $i<= $nb_ligne; $i++){
					echo"<tr>";	  	
					for($j=1; $j <= 5; $j++){	   		   
						echo"<td>";	
						if(isset($files[$k])) {
				   			$file = $files[$k];					
							echo"<a href=\"?file=$file&type_img=$type_img\">\n";					
							echo("<img src=\"". $url_img.urlencode ($file)."\" class=\"imggrand\" border=\"0\" />\n");
							echo"</a>";
					   	}
						else echo"&nbsp;";
							echo"</td>";  	  		   
							$k++;
	  					}	  	
						echo"</tr>";
	  
				}	 
				echo"</table>";
 				}else afficher_msg_erreur("D&eacute;sol&eacute; ! : Aucun ï¿½cran n'est enregistr&eacute;"); 
			?>
	</div>

</body>
</html>
