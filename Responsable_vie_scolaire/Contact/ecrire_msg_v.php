<?php
/***********************************************************/
  // Copyright © 2005-2006 
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
@session_start();

$unite = new Unite_pedagogique($_SESSION['id_unite']);
$bdd = new Connexion_BDD_LEA();

$les_classes = $unite->get_classes(); 

		$msg = new Message(0);
		$msg->objet = to_sql($_REQUEST['objet']);
		$msg->message = to_sql($_REQUEST['message']);				
		$msg->id_usager = to_sql($_SESSION['id_rvs']);
		$dest = $_REQUEST['dest'];			
		
switch($dest){

case 'all_ens' :$les_id_usager_dest = array() ; // A développer 
				break;
case 'all_ma' : $les_id_usager_dest = array() ; // A développer 
				break;
case 'all_rl' : $les_id_usager_dest = array() ; // A développer 
				break;
case 'all_app' : $les_id_usager_dest = array() ; // A développer 
				break;

}

if($msg->objet=="")  $msg->objet="[néant]";

$msg->insert($les_id_usager_dest);

?>
<link rel="stylesheet" href="../../styles/admin.css" type="text/css">
        <table width="100%" height="2%" border="0" cellpadding="0" cellspacing="0" >
          <tr>
            <td width="100%"class="titre_page"> 
			<img src="../../images/message.gif" border="0" width="50" height="40">
			 Écrire un message
              <hr class="trait"> </td>
          </tr>
          <tr align="center">
            <td height="18" >
			<?php echo"Votre Messager a été bien envoyé <br><br>"; afficher_boutton_retour(); ?>
			</td>
          </tr>
</table>
