<?php
 // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 10/08/05
  //Contenu:   Ce script permet au responsable d'une formation de sélectionner une image d'accueil 
  //           pour ça formation
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
	
	$charte->id_for = $formation->id_for; // création d'une nouvelle charte pour la formation
	$charte->insert();
}

$rep_img_accueil = $LEA_REP."images/default_img_accueil/"; 
$rep_charte = $LEA_REP."images/charte_graphique/";

if(isset($_REQUEST['file']) ) {

	$file = $_REQUEST['file']; 
	
	$file_copy = ($formation->id_for)."_img_accueil".".".get_extension($file);
		
	
		// supression de l'ancienne image
		 
		$filename = $rep_charte.$_SESSION['charte_graphique']['img_accueil']; 
		
    	if (file_exists($filename) ){ 
				
				$list_default_img = array('default_logo.gif', 'default_img_accueil.png'); 
				
				if(! in_array($_SESSION['charte_graphique']['img_accueil'], $list_default_img ))
					unlink($filename);				
		}
	
	
	if (copy($rep_img_accueil.$file, $rep_charte.$file_copy) ){ 
				
			    $_SESSION['charte_graphique']["img_accueil"] = $file_copy;
				
			 	$charte->update('img_accueil', to_sql($file_copy) );
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

$rep = opendir($rep_img_accueil);

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
			href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'enseignant.css');?>" 
			media="screen" />
		
	</head>
<body>
	<div id="contenu">
		<h1>Liste des &eacute;crans d'accueil</h1>
		<span><?php afficher_boutton_fermer();?></span>
		<p>S&eacute;lectionnez votre &eacute;cran d'accueil</p>
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
							echo"<a href=\"?file=$file\">\n";					
							echo("<img src=\"". $LEA_URL."images/default_img_accueil/".urlencode ($file)."\"  width=\"100\" height=\"100\" border=\"0\" />\n");
							echo"</a>";
					   	}
						else echo"&nbsp;";
							echo"</td>";  	  		   
							$k++;
	  					}	  	
						echo"</tr>";
	  
				}	 
				echo"</table>";
 				}else afficher_msg_erreur("D&eacute;sol&eacute; ! : Aucun écran n'est enregistr&eacute;"); 
			?>
	</div>

</body>
</html>
