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
session_name("LEA_$RNE_ETAB");
@session_start();

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_message.php");
require_once($LEA_REP."modele/bdd/classe_usager.php");
/***********************************************************/

if(isset($_REQUEST['id_msg'])) $id_msg=$_REQUEST['id_msg']; 
else { include("../../erreur.php"); exit();}


$msg=new Message($id_msg);

if (isset($_SESSION['id_admin'])) $id_usager_dest=$_SESSION['id_admin'];
elseif (isset($_SESSION['id_rvs'])) $id_usager_dest=$_SESSION['id_rvs'];
elseif (isset($_SESSION['id_ens'])) $id_usager_dest=$_SESSION['id_ens'];
elseif (isset($_SESSION['id_app'])) $id_usager_dest=$_SESSION['id_app'];
elseif (isset($_SESSION['id_ma'])) $id_usager_dest=$_SESSION['id_ma'];
elseif (isset($_SESSION['id_rl'])) $id_usager_dest=$_SESSION['id_rl'];
else html_refresh($LEA_URL);

if(! $msg->recu_par($id_usager_dest)) { include("../../erreur.php"); exit();}

$msg->set_detail();
$msg->update_lecture($id_usager_dest);

$usager_expe=new Usager($msg->id_usager);
$usager_expe->set_detail();

$url_fichier_joint = $LEA_URL.'documents/fichiers_joints_msg/'.urlencode($msg->fichier_joint);


?>
<div id="top_l"></div><div id="top_m"><h1><span class="orange">M</span>essage re&ccedil;u</h1></div><div id="top_r"></div>
<div id="m_contenu">
<table width="85%" class="bordure" >
  <tr>
    <td width="16%" height="30"> De :</td>
    <td width="84%">
      <p class="txt_gras"><?php echo $usager_expe->nom."&nbsp;&nbsp;".$usager_expe->prenom; ?></p>
    </td>
  </tr>
  <tr>
    <td height="30">Objet :</td>
    <td height="30">
      <p ><?php echo"$msg->objet " ?></p>
    </td>
  </tr>
  <tr>
    <td height="30"> Date :</td>
    <td height="30">
      <p >
        <?php 					
		echo ( trans_date_time ($msg->date_creation) );					
		?>
    </td>
  </tr>
  <tr>
    <td height="30">Fichier joint</td>
    <td height="30">
	<?php 					
		echo("
			<a href=\"".$url_fichier_joint."\" target=\"_blank\">
				$msg->fichier_joint
			</a>
			");					
	?>
    </td>
  </tr>
  <tr>
    <td height="74" colspan="2">
      <p><?php echo(nl2br($msg->message)) ?></p>
    </td>
  </tr>
  <tr>
    <td height="23" colspan="2" align="center">&nbsp;</td>
  </tr>
</table>
<p>
  <?php
			
			echo" 
			<input type='button' value='R&eacute;pondre'
			onClick=\"window.open('../../administrateur/contact/ecrire_msg.php?les_id_usager_dest[]=".$usager_expe->id_usager."&id_msg_reponse=".$msg->id_msg."','','height=400, width=600, left=150, top=300, scrollbars=no')\">
			";
			 
			 ?>
</p>

</div>