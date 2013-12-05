<?php 
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");
session_name("LEA_$RNE_ETAB");
@session_start(); 

// L'utilisateur n'est plus sur une formation en particulier
unset($_SESSION['id_for']);

if (!isset($_SESSION['id_admin'])){ 
	header('Location: '.$LEA_URL);
	exit();
}
?>
