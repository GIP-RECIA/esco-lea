<?php 
require_once($LEA_REP."modele/bdd/classe_terminologie.php");
$config_term = new Terminologie();
$config_term->set_detail();
 if(!isset($_REQUEST['imprimer'])) { ?>
	<div id="header">
		<div id="session">
			<?php 				
				$nom_rvs = $_SESSION['nom_rvs'];
				$prenom_rvs = $_SESSION['prenom_rvs'];
				echo"Bonjour <strong>".$prenom_rvs."&nbsp;".$nom_rvs."</strong>"; 
			?>
			<?php 
					if($_SESSION['unite']=="true"){	if(isset($_SESSION['nom_unite'])) echo"Responsable de ".$_SESSION['nom_unite']; }
			?><br>
			 <?php if (!$AUTHENTIFICATION_CAS) {?>
  	   		<a href="<?php echo($LEA_URL.'fermer_session.php') ?>">
				<img src="<?php echo($LEA_URL.'themes/'.$_SESSION['options_lea']['LEA_THEME'].'/images/picto_quitter.gif');?>" border="0">
				D&eacute;connexion
			</a>
			<?php }?>
		</div>
	<?php include($LEA_REP."header.php")?>
	</div>
	<div id="menu">
		<ul>
			<li id="menu1" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)" ><a href="<?php echo($LEA_URL.'Responsable_vie_scolaire/accueil.php'); ?>">Accueil</a></li>
			<li id="menu2" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)" ><a href="<?php echo($LEA_URL.'Responsable_vie_scolaire/Gest_usag/gest_usag.php'); ?>">Gestion des usagers</a></li>
			<li id="menu3" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)" ><a href="<?php echo($LEA_URL.'Responsable_vie_scolaire/Gest_clas/gest_clas.php'); ?>">Gestion des <?php echo($config_term->terminologie_formation); ?>s</a></li>
			<li id="menu4" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)" ><a href="<?php echo($LEA_URL.'Responsable_vie_scolaire/Gest_entr/gest_entr.php'); ?>">Gestion des <?php echo($config_term->terminologie_entr); ?>s</a></li>
			<li id="menu5" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)"><a href="<?php echo($LEA_URL.'Responsable_vie_scolaire/Contact/contact.php') ?>">Messagerie</a></li>				
		    <li id="menu6" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)"><a href="<?php echo($LEA_URL.'Responsable_vie_scolaire/Info_perso/info_perso.php?cmd=cons_coordonnee') ?>">Profil</a></li>
		    <li id="menu9" class="onglet"  onmouseover="menu(this.id)" onmouseout="menuoff(this.id)"> <a href="<?php echo($LEA_URL.'Responsable_vie_scolaire/affich_mdp.php?cmd=affich'); ?>">Affichage des login/pass</a></li>				
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