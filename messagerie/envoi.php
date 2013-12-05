<?php 
	require_once("../config/config.inc.php");
	session_name("LEA_$RNE_ETAB");
	session_start();
	$_SESSION['messagerie'] = 'envoi'; 
	include("header.php");
	
	$messages = $liste->getMessagesEnvoiRempli();
	
	if(isset($messages)) 
	{
		include('boutonMessagerie.php');
		
		// On crée le tableau contenant uniquement les messages qui nous intéressent
		$tab = array();
		foreach ($messages as $message)
		{
			$message->set_detail();
			if ($message->nature == 'dossier') continue;
			else $tab[] = $message;
		}
		
		if (count($tab) != 0)
		{
?>

<table id="tabMessages">
	<tr>
		<th class="check"><input type="checkbox" id="selection" /></th>
		<th class="blanc">&nbsp;</th>
		<th class="exp">Destinataires</th>
		<th class="objet">Objet</th>
		<th class="date">Date</th>
	</tr>
	
<?php
			// Pagination :
			$totalMessages = count($tab);
			$nbMessagesParPage = 30; 
			$nbPages  = ceil($totalMessages / $nbMessagesParPage);
			if (isset($_GET['page']))
				$min = $_GET['page'];
			else
				$min = 1;
			
			$min = ($min - 1) * $nbMessagesParPage;
			$messageActuel = $min;
			// Fin

			for ($i = $min ; $i < count($tab) ; $i++) 
			{
				$message = $tab[$i];
			
				// Afficher message :
				$message->set_detail();
				$destinataires = "";
				$tabDest = explode(",", $message->destinataire);
				foreach($tabDest as $nb=>$id) {
					$destinataire = new Usager($id);
					$destinataire->set_detail();
					
					if ($nb != 0) $destinataires .= ",";
					$destinataires .= to_html($destinataire->nom)." ".to_html($destinataire->prenom);
				}
				
				echo '<tr id="'.$message->id_msg.'">'."\n";
				echo '		<td class="check"><input type="checkbox" /></td>'."\n";
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
				echo '			<a href="lecture.php?id_msg='.$message->id_msg.'">'.$destinataires.'</a>'."\n";
				echo '		</td>'."\n";
				echo '		<td class="objet">'."\n";
				echo '			<a href="lecture.php?id_msg='.$message->id_msg.'">'.to_html($message->objet).'</a>'."\n";
				echo '		</td>'."\n";
				echo '		<td class="date">'."\n";
				echo '			'.date("H:i - d/m/y", strtotime($message->date_creation))."\n";
				echo '		</td>'."\n";
				echo '	</tr>'."\n";
				// Fin
				
				// Pagination :
				$messageActuel += 1;
				if ($messageActuel >= ($min + $nbMessagesParPage)) 
					break;
				// Fin
			}
?>
</table>

<center style="margin-top:5px;">
<?php  
			// Pagination :
			echo 'Page : ';
			for ($i = 1 ; $i <= $nbPages ; $i++)
			{
				echo '<a href="envoi.php?page=' . $i . '">' . $i . '</a> ';
			}
			// Fin
		}
	}
?>
</center>

</div>

<?php include("footer.php"); ?>