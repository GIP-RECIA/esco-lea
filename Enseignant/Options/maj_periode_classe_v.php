<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 03/01/06
  // Contenu: 
/***********************************************************/
require_once("../secure.php");

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");


require_once ($LEA_REP."modele/bdd/classe_periode.php");
require_once ($LEA_REP."lib/stdlib.php");

/***********************************************************/
include("../test_responsable.php");


if(isset($_REQUEST['action'])) $action=$_REQUEST['action'];
else exit(); 

switch($action) {			
	case "modif":  
			$periode = new Periode($_REQUEST['id_periode']);
								
			$periode->update_classe(
				$_REQUEST['id_cla'],
				trans_date($_REQUEST['date_debut_cfa']),
				trans_date($_REQUEST['date_fin_cfa']),
				trans_date($_REQUEST['date_debut_entr']),
				trans_date($_REQUEST['date_fin_entr']));
			echo" <script langage='javascript'>
					window.opener.location.reload();
					window.close();
				  </script>";
			break;
	case "supp":   		
		$id_cla = $_REQUEST['id_cla'];					
		$id_periode = $_REQUEST['id_periode'];
		$periode = new Periode($id_periode);																				
		$periode->supprimer_classe($id_cla);					
		html_refresh($_SERVER['HTTP_REFERER']);
		break;				
	
	default     : exit();
}

?>		
