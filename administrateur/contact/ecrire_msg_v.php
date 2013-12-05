<?php
/***********************************************************/
// Copyright ï¿½ 2005-2006 
// CFA des 3 villes
// Web: www.cfa3villes.com.
// Auteur : Faouzi AMIER
// Version : 1.0
// Date: 15/12/05
/***********************************************************/
if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once ($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_message.php");
require_once($LEA_REP."modele/bdd/classe_usager.php");
/***********************************************************/
session_name("LEA_$RNE_ETAB");
session_start();

$msg=new Message(0);
$msg->objet = to_sql($_REQUEST['objet']);
$msg->message = to_sql($_REQUEST['message']);
$msg->id_usager = to_sql($_REQUEST['id_usager_expe']);

$les_id_usager_dest = $_REQUEST['les_id_usager_dest'];
$id_msg_reponse = $_REQUEST['id_msg_reponse'];

$msg_reponse = new Message($id_msg_reponse);

$msg_reponse->update_reponse($msg->id_usager); // l'usager ayant écrit le message $msg a répondu au message d'identifiant $id_msg_reponse


if($msg->objet == "")  $msg->objet = "[n&eacute;ant]";

//-------------------Ennregistrement du fichier joint --------

if(isset($_FILES['fichier_joint']) && $_FILES['fichier_joint']['error']==0) {

	$src = $_FILES['fichier_joint']['tmp_name']; // nom du nouvau fichier télechargé sur le tempo de serveur
	$nom = $_FILES['fichier_joint']['name'];// nom  du nouvau fichier télechargé sur le poste client		
		
	$dest = changer_nom_fichier($nom);
    $dest = prefixer_date($dest); 

	if ( is_php($dest) ) 	$dest.=".txt"; // protection des fichiers d'extention .php pou .inc
	if  (move_uploaded_file($src, $LEA_REP.'documents/fichiers_joints_msg/'.$dest)) {
			
		$msg->fichier_joint = to_sql($dest);
	}
}

// Enregistrement du message
$msg->insert($les_id_usager_dest);

if (isset($_REQUEST['mail']) && $_REQUEST['mail'] == 'on')
	$msg->envoyer_mail($_REQUEST['les_id_usager_dest'], $msg->id_usager, $msg->objet, $msg->message);

?>
<html>
<head>
<link rel="stylesheet" type="text/css"
	href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'administrateur.css');?>"
	media="screen" />
</head>
<body>
<table width="100%" height="2%" border="0" cellpadding="0"
	cellspacing="0">
	<tr align="center">
		<td height="18"><?php echo"Votre message a bien &eacute;t&eacute; envoy&eacute; <br /><br />"; afficher_boutton_fermer(0); ?>
		</td>
	</tr>
</table>

</body>
</html>
