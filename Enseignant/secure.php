<?php 
if 		(file_exists("../../../config/config.inc.php"))  include("../../../config/config.inc.php");
elseif 	(file_exists("../../config/config.inc.php"))  include("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  include("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      include("./config/config.inc.php");

session_name("LEA_$RNE_ETAB");
@session_start();
if (!isset($_SESSION['id_ens'])){
	header('Location: '.$LEA_URL);
	exit();
}
?>
