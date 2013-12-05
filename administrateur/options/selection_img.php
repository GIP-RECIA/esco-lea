<?php 
 // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 01/09/06
  // Contenu:   Ce script permet ï¿½ l'administrateur de sï¿½lectionner un arriï¿½re plan parmis 
  //			une liste prï¿½ dï¿½finie des bandeaux
/***********************************************************/
if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	  require_once("../../config/config.inc.php");
elseif	(file_exists("./../config/config.inc.php"))      require_once("../config/config.inc.php");
session_name("LEA_$RNE_ETAB");
session_start();

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");

//-----------------------------------------------------------------------------------

$type_img = $_REQUEST['type_img'];

if($type_img=='LEA_BACKGROUND_HEAD') {
	$rep_img = $LEA_REP."images/default_bandeaux/"; 
	$url_img = $LEA_URL."images/default_bandeaux/"; 
	$rep_charte = $LEA_REP."images/charte_graphique/";
}
elseif($type_img=='LEA_LOGO_CFA') {
	$rep_img = $LEA_REP."images/default_logos/";
	$url_img = $LEA_URL."images/default_logos/";
	$rep_charte = $LEA_REP."images/charte_graphique/";
}
else exit();


if(isset($_REQUEST['file']) ) {

	$file = $_REQUEST['file']; 
									     		  
	
	$file_copy = $type_img.".".get_extension($file);;
	
	
	$filename = $rep_charte.$_SESSION['options_lea'][$type_img]; 
		
    	if (file_exists($filename) ){ 
				
					unlink($filename);				
		}
	
	if (@copy($rep_img.$file, $rep_charte.$file_copy)) {
		
		
			    $_SESSION['options_lea'][$type_img] = $file_copy;
				
				$bdd = new Connexion_BDD_LEA();
			 	$bdd->update_option($type_img, to_sql($file_copy));
				
				echo" 
					<script langage='javascript'>
						window.opener.location.reload();
						window.close();
					</script>					
					";
				exit();	
				
	}
	else echo("Impossibe de copier le fichier $file");
	
}

$files = array();

$rep = opendir($rep_img);

while ( ($file = readdir($rep)) !== false){ 
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
		<title>S&eacute;lection d'une image</title>
		<link rel="stylesheet" type="text/css" 
			href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'administrateur.css');?>" 
			media="screen" />
		
	</head>
<body>
	<div id="contenu">		
		<span><?php afficher_boutton_fermer();?></span>
		<p>S&eacute;lectionnez une image </p>
		<?php  	
			 if(($nb = count($files)) > 0 ){
			 	echo"<table>";
				$nb_lignes =  ceil($nb/5);
				$k = 0;
				for($i=1; $i<= $nb_lignes; $i++){
					echo"<tr>";	  	
					for($j=1; $j <= 5; $j++){	   		   
						echo"<td>";	
						if(isset($files[$k])) {
				   			$file = $files[$k];					
							echo"<a href=\"?file=$file&type_img=$type_img \">\n";
							//echo("$file");					
							echo("<img src=\"". $url_img .urlencode ($file)."\" class=\"imggrand\" border=\"0\" />\n");
							echo"</a>";
					   	}
						else echo"&nbsp;";
							echo"</td>";  	  		   
							$k++;
	  					}	  	
						echo"</tr>";
	  
				}	 
				echo"</table>";
 				}else afficher_msg_erreur("D&eacute;sol&eacute; ! : aucun bandeau n'est enregistr&eacute;"); 
			?>
	</div>

</body>
</html>
