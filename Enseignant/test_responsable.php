<?php 
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");
session_name("LEA_$RNE_ETAB");
@session_start();
$enseignant = new Enseignant($_SESSION['id_ens']);
$est_responsable = $enseignant->est_responsable($_SESSION['id_for']); 
if(!$est_responsable) {
	afficher_msg_erreur("Espace r&eacute;serv&eacute; ".$_SESSION['nom_formation']);
	exit();
}		
?>