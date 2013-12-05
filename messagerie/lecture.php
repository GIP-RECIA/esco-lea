<?php
	require_once("../config/config.inc.php");
	session_name("LEA_$RNE_ETAB");
	@session_start();
	$_SESSION['messagerie'] = 'lecture';
	include("header.php");
	
	if(isset($_REQUEST['id_msg'])) 
		$id_msg = $_REQUEST['id_msg']; 
	else 
	{ 
		include("../../erreur.php"); 
		exit();
	}
	
	$msg = new Message($id_msg);
	
	if (isset($_SESSION['id_admin'])) $id_usager_dest=$_SESSION['id_admin'];
	elseif (isset($_SESSION['id_rvs'])) $id_usager_dest=$_SESSION['id_rvs'];
	elseif (isset($_SESSION['id_ens'])) $id_usager_dest=$_SESSION['id_ens'];
	elseif (isset($_SESSION['id_app'])) $id_usager_dest=$_SESSION['id_app'];
	elseif (isset($_SESSION['id_ma'])) $id_usager_dest=$_SESSION['id_ma'];
	elseif (isset($_SESSION['id_rl'])) $id_usager_dest=$_SESSION['id_rl'];
	else html_refresh($LEA_URL);
	
	if(!$msg->recu_par($id_usager_dest) && !$msg->envoye_par($id_usager_dest)) { 
		include("../erreur.php"); 
		exit();
	}

	$msg->set_detail($id_usager);
	$msg->update_lecture($id_usager_dest);

	$usager_expe = new Usager($msg->id_usager);
	$usager_expe->set_detail();

	$url_fichier_joint = $LEA_URL.'documents/fichiers_joints_msg/'.urlencode($msg->fichier_joint);

?>

	<div id="lectureMessage">

			<p style="border-bottom: 1px solid #FDA714;">Expéditeur : <?php echo $usager_expe->nom.' '.$usager_expe->prenom; ?></p>
			
			<p>Objet : <?php echo $msg->objet; ?></p>
			
			<p>Date : <?php echo date("H:i - d/m/y", strtotime($msg->date_creation)); ?></p>

			<?php 
				if (!empty($msg->fichier_joint))
				{
			?>
			<p>Fichier : <?php echo "<a href=\"".$url_fichier_joint."\" target=\"_blank\">$msg->fichier_joint</a>"; ?></p>
			<?php
				}
			?>
			
			<p style="border:1px solid #0C83AE; min-height:200px; padding:10px;">
				<?php echo(nl2br($msg->message)) ?>
			</p>
			
			<center>
			<?php
					
				echo" 
				<input type='button' value='R&eacute;pondre'
				onClick=\"window.open('".$LEA_URL."administrateur/contact/ecrire_msg.php?les_id_usager_dest[]=".$usager_expe->id_usager."&id_msg_reponse=".$msg->id_msg."','','height=400, width=600, left=150, top=300, scrollbars=no')\">
				";
					 
			?>
			</center>
	</div>

</div>

<?php include("footer.php");
