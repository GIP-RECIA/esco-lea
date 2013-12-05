<?php
/***********************************************************/
  // CFA des 3 villes
  // Web: www.cfa3villes.com.

  // Auteur : Matthieu DANET
  // Web: www.matthieu-danet.fr

  // Version : 1.1
  // Date: 16/05/07
/***********************************************************/
//require_once("../config/config.inc.php");
function afficher_aide($id_aide) {
	
	global $LEA_REP;
	
	if(is_numeric($id_aide)) {
		$fp_aide = fopen($LEA_REP."espace_de_partage/aide.csv","r"); 	
		while ($ligne = fgetcsv($fp_aide, 10000, ",")) {    		
		    if(isset($ligne) && $ligne[0]!= NULL) { 			    			
				if(trim($ligne[0])== $id_aide) {
					$titre = $ligne[2];
					$texte = $ligne[1];
					$lien_img = $ligne[3];
					break;
				} else {
					$titre = "Aucune aide n'est disponible";
					$texte = "";
					$lien_img = "";
				}
			}		
		}
		$r = "
		<div id='popup_aide'>
		<h1>".$titre."</h1>
		<p>".nl2br($texte)."</p>
		".(($lien_img != "") ? "<a target='_blank' href=".$LEA_REP."/images/aide/".$lien_img."><img src=\"".$LEA_REP."/images/aide/".$lien_img."\" border=\"0\" /></a>" : "")."
		</div>";
		
		fclose($fp_aide);
		return $r;
	}
}
?>