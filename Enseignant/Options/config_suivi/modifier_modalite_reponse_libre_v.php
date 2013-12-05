<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/08/05
/***********************************************************/

require_once("../../secure.php");

if 		(file_exists("../../../config/config.inc.php"))  require_once("../../../config/config.inc.php");
elseif	(file_exists("../../config/config.inc.php")) 	  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php"))      require_once("../config/config.inc.php");


require_once ($LEA_REP."modele/bdd/classe_modalite_reponse_libre.php");
require_once ($LEA_REP."lib/stdlib.php");
/***********************************************************/

if(isset($_REQUEST['action'])) $action=$_REQUEST['action'];
else exit();

switch($action) {				
	case "modif":  
		if( isset($_REQUEST['id_modalite']))  {
						
			$modalite = new Modalite_reponse_libre($_REQUEST['id_modalite']);
			$modalite->set_detail();
			
			$modalite->libelle = to_sql($_REQUEST['libelle']);
			$modalite->acteur = to_sql($_REQUEST['acteur']);
									
			$modalite->update();
			
			if(isset($_REQUEST['les_id_periode'])) $les_id_periode = $_REQUEST['les_id_periode'];
			else  $les_id_periode = array();
			
			$modalite->update_periodes($les_id_periode);
		}
			echo" 
			<script langage='javascript'>
				window.opener.location.reload();
				window.close();
			</script>					
			";
		break;
	
	case "supp":   		
		$id_modalite = $_REQUEST['id_modalite'];
		$modalite = new Modalite_reponse_libre($_REQUEST['id_modalite']);													
		$modalite->delete();															
		html_refresh($_SERVER['HTTP_REFERER']);
		break;				
	
	default     : exit();

}
?>		