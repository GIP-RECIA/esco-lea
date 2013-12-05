<?php 
 // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 01/09/06
  // Contenu:   Ce script permet à l'administrateur de sélectionner un arrière plan parmis 
  //			une liste pré définie des bandeaux
/***********************************************************/
if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	  require_once("../../config/config.inc.php");
elseif	(file_exists("./../config/config.inc.php"))      require_once("../config/config.inc.php");
session_name("LEA_$RNE_ETAB");
session_start();

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");

//-----------------------------------------------------------------------------------

$rep_bandeaux = $LEA_REP."images/default_bandeaux/";
$rep_charte = $LEA_REP."images/charte_graphique/";

if(isset($_REQUEST['file']) ) {

	$file = $_REQUEST['file']; 
									     		  
	
	$file_copy = "LEA_BACKGROUND_HEAD.".get_extension($file);;
	
	
	$filename = "$rep_charte".$_SESSION['options_lea']['LEA_BACKGROUND_HEAD']; 
		
    	if (file_exists($filename) ){ 
				
					unlink($filename);				
		}
	
	if (@copy($rep_bandeaux.$file, $rep_charte.$file_copy)) {
		
		
			    $_SESSION['options_lea']['LEA_BACKGROUND_HEAD'] = $file_copy;
				
				$bdd = new Connexion_BDD_LEA();
			 	$bdd->update_option("LEA_BACKGROUND_HEAD", to_sql($file_copy));
				
				echo" 
					<script langage='javascript'>
						window.opener.location.reload();
						window.close();
					</script>					
					";
				exit();	
				
	}
	else echo("Impossible de copier le fichier $file");
	
}

$files = array();

$rep = opendir($rep_bandeaux);

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
		<title>S&eacute;lection d'un logo</title>
		<link rel="stylesheet" type="text/css" 
			href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'administrateur.css');?>" 
			media="screen" />
		
	</head>
<body>
	<div id="contenu">
		<h1>Liste des bandeaux</h1>
		<span><?php afficher_boutton_fermer();?></span>
		<p>S&eacute;lectionnez votre bandeau</p>
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
							//echo("$file");					
							echo("<img src=\"". $LEA_URL."images/default_bandeaux/".urlencode ($file)."\" width=\"100\" height=\"100\" border=\"0\" />\n");
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
