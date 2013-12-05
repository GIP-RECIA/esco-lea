<?php
/***********************************************************/
  // Copyright © 2005-2006 
  // CFA des 3 villes
  // Web: www.cfa3villes.com.   
  // Auteur : Faouzi AMIER
  // Version : 1.0
  // Date: 12/09/05
  // Contenu: ce script permet de supprimer l'entreprise d'identifiant id_entr passsé en paramètre
/***********************************************************/

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");
session_name("LEA_$RNE_ETAB");
session_start();

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_message.php");
require_once($LEA_REP."modele/bdd/classe_usager.php");

/***********************************************************/
if (isset($_REQUEST['les_id_msg'])){

if (isset($_SESSION['id_admin'])) $id_usager_dest=$_SESSION['id_admin'];
elseif (isset($_SESSION['id_rvs'])) $id_usager_dest=$_SESSION['id_rvs'];
elseif (isset($_SESSION['id_ens'])) $id_usager_dest=$_SESSION['id_ens'];
elseif (isset($_SESSION['id_app'])) $id_usager_dest=$_SESSION['id_app'];
elseif (isset($_SESSION['id_ma'])) $id_usager_dest=$_SESSION['id_ma'];
elseif (isset($_SESSION['id_rl'])) $id_usager_dest=$_SESSION['id_rl'];
else html_refresh($LEA_URL);



$les_id_msg = $_REQUEST['les_id_msg'];

	foreach($les_id_msg as $id_msg) {
		$msg = new Message($id_msg);		
		$msg->delete_message_recu($id_usager_dest);		
	}
}

html_refresh($_SERVER['HTTP_REFERER']);

?>		
