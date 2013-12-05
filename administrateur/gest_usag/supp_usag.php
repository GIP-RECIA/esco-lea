<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 06/09/05
  // Contenu: 
/***********************************************************/
require_once("../secure.php");
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_usager.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
/***********************************************************/
$id_usager = (isset($_REQUEST['id_usager']))? $_REQUEST['id_usager']:0;	
$profil = (isset($_REQUEST['profil']))? $_REQUEST['profil']:"";
	
$usager = new Usager($id_usager);
if($profil=="app") { 
	$apprenti= new Apprenti($id_usager);
	$apprenti->set_detail(); 
	
	$classe = $apprenti->get_classe(); // la classe de l'apprenti
	
	$apprenti->set_detail();
}

$usager->delete_usager();

switch($profil){
	case "app": //-------------------suppression de src_photo-------------------------------
		$repertoireDestination = "../../Apprenti/Photos/";
		$src_photo = $apprenti->src_photo;
		$filename = $repertoireDestination.$src_photo;
		if (file_exists($filename)) {
			@unlink($filename);
		}
				
		if( isset($classe) ) {
			 $id_cla=$classe->id_cla;
			 $id_for=$classe->id_for;			
		}
		else { $id_for=$_REQUEST['id_for']; $id_cla='all'; }
		html_refresh($_SERVER['HTTP_REFERER']);
		break;
	case "ens": 
		html_refresh($_SERVER['HTTP_REFERER']);
		break;
	case "ma": 
		html_refresh($_SERVER['HTTP_REFERER']);
		break;
	case "rl": 
		html_refresh($_SERVER['HTTP_REFERER']);
		break;
	case "rvs": 
		html_refresh($_SERVER['HTTP_REFERER']);
		break;			
	case "admin": 
		html_refresh($_SERVER['HTTP_REFERER']);
		break;
	default     : 
		break;			
}
?>