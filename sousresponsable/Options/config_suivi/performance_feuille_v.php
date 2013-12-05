<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/08/05
/***********************************************************/
if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php"))      require_once("../config/config.inc.php");

require_once($LEA_REP."sousresponsable/secure.php");

require_once ($LEA_REP."modele/bdd/classe_arbre.php");
require_once ($LEA_REP."modele/bdd/classe_formation.php");
require_once ($LEA_REP."lib/stdlib.php");
/***********************************************************/

if(isset($_REQUEST['les_eva_modalite_va_unique'])) 
				$les_eva_modalite_va_unique = $_REQUEST['les_eva_modalite_va_unique'];
else $les_eva_modalite_va_unique = array();

//print_r($les_eva_modalite_va_unique); exit();

if(isset($_REQUEST['les_eva_choix'])) 
				$les_eva_choix = $_REQUEST['les_eva_choix'];
else  $les_eva_choix = array();			

$noeud = new Noeud($_REQUEST['id_noeud']);
$noeud->set_detail();

if(isset($_REQUEST['meme_param'])){		
	
	$arbre = new Arbre($noeud->id_arbre); 	

		foreach($les_eva_modalite_va_unique as $id_modalite => $evaluation_max ){
			$arbre->update_evaluation_modalite_va_unique($id_modalite, $evaluation_max);
		}

		foreach($les_eva_choix as $id_choix => $evaluation_max ){
			$arbre->update_evaluation_choix($id_choix, $evaluation_max);
		}
}
else {

	foreach($les_eva_modalite_va_unique as $id_modalite => $evaluation_max ){
		$noeud->update_evaluation_modalite_va_unique($id_modalite, $evaluation_max);
	}

	foreach($les_eva_choix as $id_choix => $evaluation_max ){
		$noeud->update_evaluation_choix($id_choix, $evaluation_max);
	}

}
																				
echo" 
	<script langage='javascript'>
		window.close();
	</script>					
	";

?>		