<?php
/***********************************************************/
  // Copyright ï¿½ 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 25/09/05
  // Contenu: 
/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");
session_name("LEA_$RNE_ETAB");
@session_start();

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_classe.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
/***********************************************************/
if (isset($_REQUEST['id_cla'])){
	$id_cla = $_REQUEST['id_cla'];
}else { 
	html_refresh("../accueil.php");exit();
}  			
$classe = new Classe($id_cla);
$classe->set_detail();
$les_id_apprentis = $classe->get_id_apprentis(); // les identifiant des apprentis affectï¿½s ï¿½ cette classe

foreach($les_id_apprentis as $id_app){
	$usager = new Usager($id_app);
	$usager->delete_usager();
}
html_refresh("gest_usag.php?cmd=cons_liste_app&id_cla=$id_cla");
 ?>		
