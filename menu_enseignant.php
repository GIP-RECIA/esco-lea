<?php  if(!isset($_REQUEST['imprimer'])) { ?>		
<div id="header">
	<div id="session">
    	<?php 				
			$nom_ens=$_SESSION['nom_ens'];
			$prenom_ens=$_SESSION['prenom_ens'];
			echo "Bonjour <strong>".$prenom_ens."&nbsp;".$nom_ens.", </strong>";
			echo "Formation : <strong>".$_SESSION['nom_formation']."</strong>"; 
		?>
		<br>
		 <?php if (!$AUTHENTIFICATION_CAS) {?>
  	   	<a href="<?php echo($LEA_URL.'fermer_session.php') ?>">
			 <img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_quitter.gif');?>" border="0">
			 D&eacute;connexion
		</a>&nbsp;&nbsp;
		<?php }?>

		<a href="#" onclick="lightbox('box2', '<?php echo $LEA_URL?>')">
		 	<img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_rafraichir.gif');?>" width="18"  height="18"  border="0">	
		 	Voir d'autres formations 
		</a>		
				
	</div>									
	<?php include($LEA_REP."header.php"); ?>
	
</div>		 
<div id="menu">
	<ul>
		<li id="menu1" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)">
			<a href="<?php echo($LEA_URL.'Enseignant/accueil.php') ?>">Accueil</a>
		</li>
		<?php 
			$enseignant = new Enseignant($_SESSION['id_ens']);
			$est_responsable = $enseignant->est_responsable($_SESSION['id_for']);
			if( $est_responsable ) {				
		?>
		<li id="menu5" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)" >
			<a href="<?php echo($LEA_URL.'Enseignant/Options/options.php?cmd=cons_options') ?>">Configuration LEA</a>
		</li>			
		<?php 
		}
		?>
		<li id="menu6" class="onglet" onmouseover="menu(this.id)" onmouseout="menuoff(this.id)" >
			<a href="<?php echo($LEA_URL.'Enseignant/gest_doc/gest_doc.php'); ?>">Documents</a>
		</li>
		<li id="menu2" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)">
			<a href="<?php echo($LEA_URL.'Enseignant/Apprentis/apprentis.php?cmd=cons_liste_app') ?>">Suivi </a>
		</li>
		<li id="menu4" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)">
			<a href="<?php echo($LEA_URL.'Enseignant/Contact/contact.php') ?>">Messagerie</a>
		</li>
		<!-- // projet_tut ------------ DEBUT -->		
		<li id="menu7" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)" onclick="javascript:montre();">
			<a href="<?php echo($LEA_URL.'espace_de_partage/consult_espace.php')?>" >Espace de partage</a>
		</li>
		<!--  // projet_tut ------------ FIN -->
		<li id="menu3" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)">
			<a href="<?php echo($LEA_URL.'Enseignant/Info_perso/info_perso.php?cmd=cons_coordonnee') ?>">Profil</a>
		</li>
		<li id="menu8" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)">
			<a href="<?php echo($LEA_URL.'Enseignant/mod_impression/imp_livret.php') ?>">Module d'impression</a>
		</li>
		<?php //include ('./sel_formation.php')?>
	</ul>	
</div>		
<?php 
}else {
	$img = $LEA_URL."images/print.gif";	
	echo "<a href='#' onClick='window.print()'> 
			<img src='$img' border='0'> 
			Imprimer
		 </a>&nbsp&nbsp&nbsp&nbsp&nbsp";
	afficher_boutton_fermer();
	}
?>	