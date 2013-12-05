<?php
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");
session_name("LEA_$RNE_ETAB");
@session_start();

if ((isset($_SESSION['id_ens']))||(isset($_SESSION['id_app']))||(isset($_SESSION['id_ma']))||(isset($_SESSION['id_ens']))){
	
} else {
	header('Location: '.$LEA_URL);
	exit();
}
?>
