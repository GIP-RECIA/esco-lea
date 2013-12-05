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
session_start();

require_once ($LEA_REP."lib/stdlib.php");
require_once ($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/classe_usager.php");
require_once($LEA_REP."modele/bdd/classe_message.php");
/***********************************************************/

//l'identifiant de la personne à laquelle est adressé le message
if(isset($_REQUEST['les_id_usager_dest'])) $les_id_usager_dest=$_REQUEST['les_id_usager_dest']; 
else { echo"Aucune personne n'est s&eacute;lectionn&eacute;e &nbsp;&nbsp;&nbsp;&nbsp;"; afficher_boutton_fermer(); exit();}

if(isset($_REQUEST['id_msg_reponse'])) 
	$id_msg_reponse = $_REQUEST['id_msg_reponse']; 
else $id_msg_reponse=0; 

$message_reponse=new Message($id_msg_reponse);
$message_reponse->set_detail();

if (isset($_SESSION['id_admin'])) $id_usager_expe = $_SESSION['id_admin'];
elseif (isset($_SESSION['id_rvs'])) $id_usager_expe= $_SESSION['id_rvs'];
elseif (isset($_SESSION['id_ens'])) $id_usager_expe = $_SESSION['id_ens'];
elseif (isset($_SESSION['id_app'])) $id_usager_expe = $_SESSION['id_app'];
elseif (isset($_SESSION['id_ma'])) $id_usager_expe = $_SESSION['id_ma'];
elseif (isset($_SESSION['id_rl'])) $id_usager_expe = $_SESSION['id_rl'];

else html_refresh($LEA_URL);

?>
<html>
	<head>
		<title>&Eacute;crire un message</title>	
		<link rel="stylesheet" type="text/css" 
			href="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/'.'administrateur.css');?>" 
			media="screen" />
		<script type="text/javascript">
			function envoyer_msg(theForm){
				 var confirmer=false;
 
				 if (theForm.objet.value=="") { 	
					confirmer=confirm("Ce message ne comporte pas d'objet. Voulez-vous quand même l'envoyer? ");	
				 }
				 else  confirmer=true;

				 if (theForm.message.value=="") { 	
					confirmer=confirm("Ce message est vide. Voulez-vous quand même l'envoyer? ");	
				 }
 				 return confirmer;  
			}
		</script> 
		<style type="text/css">
			.labelEnvoi
			{
				display:block;
				float:left;
				width:100px;
			}
			
			.labelChoix
			{
				float:left;
				width:235px;
			}
		</style>
	</head>
<body class="fenetreMessage">
<div id='popup_head'>
	<?php afficher_boutton_fermer(0) ?>
</div>
<div id='popup_aide' style="text-indent:0;">
<form name="theForm" method="post" action="ecrire_msg_v.php" onSubmit="return envoyer_msg(this)" enctype="multipart/form-data">
	<fieldset>
		<label for="" class="labelEnvoi">Destinataire :</label>
		<?php
			echo"<input type=\"hidden\" name=\"id_usager_expe\" value=\"$id_usager_expe\" />";
			echo"<input type=\"hidden\" name=\"id_msg_reponse\" value=\"$id_msg_reponse\" />";
			$tab = array();
			$premier=true;
			foreach($les_id_usager_dest as $id_usager_dest) {
				if(!in_array($id_usager_dest, $tab )){ // filtre du tableau $les_id_usager_dest(élimine les doublons)
					$tab[] = $id_usager_dest;
					$usager_dest = new Usager($id_usager_dest);
					$usager_dest->set_detail();
					echo "<input type=\"hidden\" name=\"les_id_usager_dest[]\" value=\"$id_usager_dest\" />";
					if ($premier) {
						$premier=false;
					} else {
						echo " |";
					}
					echo" $usager_dest->nom &nbsp; $usager_dest->prenom"; 
				}	
			}	
		?>	
	</fieldset>
	<fieldset>		
		<label for="" class="labelEnvoi">Objet :</label>
		<input name="objet" type="text" value="" size="50" maxlength="70" />
	</fieldset>
	<fieldset>		
		<label for="" class="labelEnvoi">Pi&egrave;ce jointe :</label> 
		<input name="fichier_joint" type="file" size="35"/>
	</fieldset>
	<fieldset>
		<label>Votre message :</label>
		<textarea name="message" cols="55" rows="6"></textarea>
	</fieldset>
	<fieldset>
		<p style="text-align:left;">
			<table>
				<tr>
					<td style="color:#0C83AE; font-size:0.8em; font-weight:bold;">
						<label for="informerContact" class="labelChoix">Informer le contact par e-mail ?</label>
						<input type="checkbox" id="informerContact" name="informer"></label>
						<br />
						<label for="envoyerMail" class="labelChoix">Envoyer le message en e-mail ?</label>
						<input type="checkbox" id="envoyerMail" name="mail" />
					</td>
					
					<td style="padding-left:50px;">
						<input class="submit" type="submit" name="Submit" value="Envoyer" style="margin-left:0px;" />
						<input type="reset" value="Vider" />
					</td>
				</tr>
			</table>
		</p>
	</fieldset>
</form>	
<script type="text/javascript">
	window.document.forms['theForm'].objet.focus();
</script></div>
</body>
</html>
