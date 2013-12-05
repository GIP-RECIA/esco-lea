<?php 
require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_usager.php");
session_name("LEA_$RNE_ETAB");
session_start();

if (isset($_SESSION['id_admin'])) { 
		$id_usager=$_SESSION['id_admin'];		
}		
elseif (isset($_SESSION['id_ens'])){
	$id_usager=$_SESSION['id_ens'];
}	
elseif (isset($_SESSION['id_app'])) {
	$id_usager=$_SESSION['id_app'];

}	 
elseif (isset($_SESSION['id_ma'])){
	$id_usager=$_SESSION['id_ma'];

}	 
elseif (isset($_SESSION['id_rl'])) {
	$id_usager=$_SESSION['id_rl'];

}
elseif (isset($_SESSION['id_rvs'])) {
	$id_usager=$_SESSION['id_rvs'];

}	 		 
else exit();

$usager = new Usager($id_usager);
$usager->set_detail();
$usager->update_log("D&eacute;connexion");


if ($AUTHENTIFICATION_CAS) {
	require_once('./lib/Cas/CAS.php');
	phpCAS::client(SAML_VERSION_1_1, $SERVEUR_CAS_HOSTNAME, $SERVEUR_CAS_PORT, $SERVEUR_CAS_URI);
	phpCAS::logout();
} else {
	$_SESSION = array();
	session_destroy();
}

header('Location: '.$LEA_URL);
?>