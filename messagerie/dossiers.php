<?php
	require_once("../config/config.inc.php");
	session_name("LEA_$RNE_ETAB");
	session_start();
	$_SESSION['messagerie'] = 'dossiers'; 
	include("header.php");
	
	$dossiers = array();
	foreach ($messages as $message)
	{
		$message->set_detail($id_usager);
		if ($message->nature == 'dossier')
			$dossiers[] = $message->dossier;
	}
	
	if (isset($_GET['creer']))
	{
		$existe = false;
		foreach ($dossiers as $dossier)
		{
			if (strtoupper($dossier) == strtoupper($_GET['creer']))
				$existe = true;
		}
		
		if (!$existe && trim($_GET['creer']) != '')
		{
			$msg = new Message(0);
			$msg->objet = '';
			$msg->message = '';				
			$msg->id_usager = $id_usager;
			$msg->nature = 'dossier';
			$msg->dossier = substr(to_sql($_GET['creer']), 0, 40);
			
			$msg->insert(array($id_usager));
		}
	}
	
	if (isset($_GET['suppDossier']))
	{
		$suppDossier = $_GET['suppDossier'];
		$existe = false;
		foreach ($dossiers as $dossier)
		{
			if ($suppDossier == $dossier)
				$existe = true;
		}
		if ($existe == true)
		{
			$sql = "DELETE FROM les_messages WHERE nature='dossier' AND dossier='".$suppDossier."'";
			$result = $bdd->executer($sql);
		}
	}
	
	// Rafraichissement
	if (isset($_GET['suppDossier']) || isset($_GET['creer']))
	{
		$messages = $liste->getListeMessageRempli();
		$dossiers = array();
		foreach ($messages as $message)
		{
			$message->set_detail($id_usager);
			if ($message->nature == 'dossier')
				$dossiers[] = $message->dossier;
		}
	}
	
	if(isset($messages)) 
	{
		include('boutonMessagerie.php');
?>

<table id="tabMessages">
	<tr>
		<th class="check"><input type="checkbox" id="selection" /></th>
		<th class="dossier">Dossier</th>
		<th class="blanc">&nbsp;</th>
		<th class="exp">Exp&eacute;diteur</th>
		<th class="objet">Objet</th>
		<th class="date">Date</th>
	</tr>
	<?php 
		// TO-DO :
		// Faire la vérification qu'un dossier existe lors d'un déplacement
		foreach ($dossiers as $dossier)
		{
			$nomDossier = str_replace(" ", "", $dossier);

			echo '	<tr class="fond_dossier">'."\n";
			echo '		<td class="check"><input type="checkbox" class="dossier_'.$nomDossier.'" onclick="selectionDossier(this);" /></td>'."\n";
			echo '		<td class="dossier" colspan="5" style="border-bottom:1px dotted black;">
							<img class="croixDossier" src="images/croix.jpg" alt="Supprimer le dossier" title="Supprimer le dossier" onclick="supprimerDossier(this, \''.$dossier.'\');" />
							<a href="#" onclick="afficherMessages(this, \'dossier_'.$nomDossier.'\');">'.$dossier.'</a></div>
						</td>'."\n";
			//echo '		<td class="blanc">&nbsp;</td>'."\n";
			//echo '		<td>&nbsp;</td>'."\n";
			//echo '		<td>&nbsp;</td>'."\n";
			//echo '		<td>&nbsp;</td>'."\n";
			echo '	</tr>'."\n";
			
			foreach ($messages as $message)
			{
				$message->set_detail($id_usager);
				if ($message->suppression == 'OUI' || $message->dossier == "" || $message->nature == 'dossier') continue;
				
				if ($message->dossier == $dossier)
				{
					$expediteur = new Usager($message->id_usager);
					$expediteur->set_detail();
					
					$classeMess = $message->lecture == "OUI" ? ($message->reponse == "OUI" ? "rep" : "normal") : "non-lu";
					echo '	<tr id="'.$message->id_msg.'" class="'.$classeMess.'">'."\n";
					$classInput = empty($message->dossier) ? '' : 'class="dossier_'.$nomDossier.'"';
					echo '		<td class="check"><input type="checkbox" '.$classInput.' /></td>'."\n";
					echo '		<td class="dossier"></td>'."\n";
					echo '		<td class="blanc">';
					switch ($message->nature)
					{
						case 'important':
							echo '<img src="images/important.jpg" alt="important" />'."\n";
							break;
						case 'fichier':
							echo '<img src="images/fichier.jpg" alt="fichier joint" />'."\n";
							break;
						default:
							echo '&nbsp;'."\n";
							break;
					}
					echo '		</td>'."\n";
					echo '		<td class="exp">'."\n";
					echo '			<a href="lecture.php?id_msg='.$message->id_msg.'">'.to_html($expediteur->nom).' '.to_html($expediteur->prenom).'</a>'."\n";
					echo '		</td>'."\n";
					echo '		<td class="objet">'."\n";
					echo '			<a href="lecture.php?id_msg='.$message->id_msg.'">'.to_html($message->objet).'</a>'."\n";
					echo '		</td>'."\n";
					echo '		<td class="date">'."\n";
					echo '			'.date("H:i - d/m/y", strtotime($message->date_creation))."\n";
					echo '		</td>'."\n";
					echo '	</tr>'."\n";
				}
			}
		}
	}
	?>
</table>

</div>

<?php include("footer.php"); ?>