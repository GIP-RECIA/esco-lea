<?php
/***********************************************************/  
  // Auteur : GOYER Frédéric
  // Version : 1.0.2
  // Date: 04/05
/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_formation.php");
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
//-----------------------------------------------------------------------------------
$config_term = new Terminologie();

$config_term->set_detail();
$bdd = new Connexion_BDD_LEA();

$les_formations = $bdd->get_formations();

$enseignant = new Enseignant($_SESSION['id_sr']);

if( count($les_formations) == 0) {
	afficher_msg_erreur( "Aucune ".$config_term->terminologie_formation." n'est enregistr&eacute;e"); 
	afficher_boutton_retour(); 					  
					  
}
?>		
	<?php  		
	if(($nb = count($les_formations)) > 0 ){	 
			echo"<center><table cellspacing='10'>\n";	  	 
		
			$k = 0;
			$nbformation=0;
			for($i=1; $i<= $nb; $i++){
				if(isset($les_formations[$k]) ){
					if (($k % 2) == 1) echo "<tr>\n";
				 	$formation = $les_formations[$k];
					$charte = $formation->get_charte_graphique();
					if($enseignant->est_sous_responsable($formation->id_for,$_SESSION['id_sr']) ){
						$nbformation++;
						echo"<td>\n";
						echo"<a href=\"". $LEA_URL."sousresponsable/accueil.php?id_for=".$formation->id_for."\">";
						echo("<img src=". $LEA_URL."images/charte_graphique/".urlencode($charte->logo) ." border=\"0\" />");
						echo(to_html($formation->nom));												
						echo"</a>";
						echo"</td>\n";
						if (($k % 2) == 0) echo "</tr>\n";
					}
		 		}
				$k++;	  	
			}	 
			if (($k % 2) == 0) echo "</tr>\n";
			echo"</table></center>\n";	  	 
			
		} else {
			afficher_msg_erreur("Aucune ".$config_term->terminologie_formation." n'est enregistr&eacute;e");
		}
		
		if($nbformation==0) afficher_msg_erreur("Aucune ".$config_term->terminologie_formation." n'est affect&eacute;e");
		
	?>				

