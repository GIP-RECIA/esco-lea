<?php
	if (isset($_SESSION['messagerie']))
	{
		$listeDossiers = $liste->getDossier($id_usager);
	
		if (isset($_GET['supp']))
		{
			$tab = explode('|', $_GET['supp']);
			foreach ($tab as $id)
			{
				$tmp = new Message($id);
				//if ($tmp->destinataire == $id_usager)
					$tmp->update_suppression($id_usager);
			}
		}
		if (isset($_GET['cible']) && isset($_GET['msg']))
		{
			$tab = explode('|', $_GET['msg']);
			foreach ($tab as $id)
			{
				$tmp = new Message($id);
				$tmp->set_detail($id_usager);
				
				$existe = false;
				foreach ($listeDossiers as $d)
				{
					if ($d == $_GET['cible']) 
						$existe = true;
				}
				if ($tmp->destinataire == $id_usager && $existe)
				{
					$tmp->changer_dossier($_GET['cible'], $id_usager);
					$tmp->update_suppression($id_usager, true);
				}
			}
		}
		
		if (isset($_GET['vider']))
		{
			$tab = explode('|', $_GET['vider']);
			foreach ($tab as $id)
			{
				$tmp = new Message($id);
				if($id_usager == $tmp->destinataire)
					$tmp->delete();
			}
			$messages = $liste->getListeMessageRempli();
		}
	
		$pos = $_SESSION['messagerie'];
		
		switch ($profil)
		{
			case 'admin':
				$nouveau = $LEA_URL.'administrateur/contact/contact.php?cmd=chercher_usager';
				break;
			case 'app':
				$nouveau = $LEA_URL.'Apprenti/Contact/contact.php?cmd=envoi';
				break;
			case 'ens':
				$nouveau = $LEA_URL.'Enseignant/Contact/contact.php?cmd=contact_app';
				break;
			case 'ma':
				$nouveau = $LEA_URL.'Maitre_apprentissage/Contact/contact.php?cmd=ecrire_msg';
				break;
			case 'rl':
				$nouveau = $LEA_URL.'Representant_legal/Contact/contact.php?cmd=ecrire_msg';
				break;
			case 'rvs':
				$nouveau = $LEA_URL.'Responsable_vie_scolaire/Contact/contact.php?cmd=ecrire_msg';
				break;
		}
		
		switch ($pos)
		{
			case 'reception':
				?>
				<div class="boutonMessagerie">
					<!--<a onclick="lightbox('nouveauMessage');" href="#" style="background:url('images/dossier.jpg')">Nouveau</a>-->
					<a href="<?php echo $nouveau; ?>" style="background:url('images/nouveau.jpg')">Nouveau</a>
					<a href="javascript:supprimer();" style="background:url('images/supprimer.jpg')">Supprimer</a>
					<a href="javascript:deplacer();" style="background:url('images/dossier.jpg')">D&eacute;placer vers</a>
					<select id="cible">
						<?php
							foreach ($listeDossiers as $dossier)
							{
								echo "<option>$dossier</option>";
							}
						?>
					</select>
				</div>
				<?php
				break;
			case 'envoi':
				?>
				<div class="boutonMessagerie">
					<!--<a onclick="lightbox('nouveauMessage');" href="#" style="background:url('images/dossier.jpg')">Nouveau</a>-->
					<a href="<?php echo $nouveau; ?>" style="background:url('images/nouveau.jpg')">Nouveau</a>
				</div>
				<?php
				break;
			case 'corbeille':
				?>
				<div class="boutonMessagerie">
					<!--<a onclick="lightbox('nouveauMessage');" href="#" style="background:url('images/dossier.jpg')">Nouveau</a>-->
					<a href="<?php echo $nouveau; ?>" style="background:url('images/nouveau.jpg')">Nouveau</a>
					<a href="javascript:vider();" style="background:url('images/vider.jpg')">Vider</a>
					<a href="javascript:deplacer();" style="background:url('images/dossier.jpg')">D&eacute;placer vers</a>
					<select id="cible">
						<?php
							foreach ($listeDossiers as $dossier)
							{
								echo "<option value=\"$dossier\">$dossier</option>";
							}
						?>
					</select>
				</div>
				<?php
				break;
			case 'dossiers':
				?>
				<div class="boutonMessagerie">
					<!--<a onclick="lightbox('nouveauMessage');" href="#" style="background:url('images/dossier.jpg')">Nouveau</a>-->
					<a href="<?php echo $nouveau; ?>" style="background:url('images/nouveau.jpg')">Nouveau</a>
					<a href="javascript:creerDossier();" style="background:url('images/dossier.jpg')" id="creerDossier">Créer un dossier</a>
					<a href="javascript:supprimer();" style="background:url('images/supprimer.jpg')">Supprimer</a>
					<a href="javascript:deplacer();" style="background:url('images/dossier.jpg')">D&eacute;placer vers</a>
					<select id="cible">
						<?php
							foreach ($listeDossiers as $dossier)
							{
								echo "<option>$dossier</option>";
							}
						?>
					</select>
				</div>
				<?php
				break;
		}
	}
?>